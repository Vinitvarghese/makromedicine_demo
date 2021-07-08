<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	/**
	 * The CodeIgniter object variable
	 * @access public
	 * @var object
	 */
	public $CI;

	/**
	 * Variable for loading the config array into
	 * @access public
	 * @var array
	 */
	public $config_vars;

	/**
	 * Array to store error messages
	 * @access public
	 * @var array
	 */
	public $errors = [];

	/**
	 * Array to store info messages
	 * @access public
	 * @var array
	 */
	public $infos = [];

	/**
	 * Local temporary storage for current flash errors
	 *
	 * Used to update current flash data list since flash data is only available on the next page refresh
	 * @access public
	 * var array
	 */
	public $flash_errors = [];

	/**
	 * Local temporary storage for current flash infos
	 *
	 * Used to update current flash data list since flash data is only available on the next page refresh
	 * @access public
	 * var array
	 */
	public $flash_infos = [];



	########################
	# Base Functions
	########################

	/**
	 * Constructor
	 */
	public function __construct() {

		// get main CI object
		$this->CI = & get_instance();

		// Dependancies
		if(CI_VERSION >= 2.2){
			$this->CI->load->library('driver');
		}

 		// config/auth.php
		$this->CI->config->load('auth');
		$this->config_vars = $this->CI->config->item('auth');

		// load error and info messages from flashdata (but don't store back in flashdata)
		$this->errors = $this->CI->session->flashdata('errors') ?: [];
		$this->infos = $this->CI->session->flashdata('infos') ?: []; 
	}


	########################
	# Login Functions
	########################

	//tested
	/**
	 * Login user
	 * Check provided details against the database. Add items to error array on fail, create session if success
	 * @param string $email
	 * @param string $pass
	 * @param bool $remember
	 * @return bool Indicates successful login.
	 */
	public function login($identifier, $pass, $remember = FALSE, $totp_code = NULL, $checked = NULL) {



		// Remove cookies first
		$cookie = [
			'name'	 => 'user',
			'value'	 => '',
			'expire' => -3600,
			'path'	 => '/',
		];
		$this->CI->input->set_cookie($cookie);
		if ($this->config_vars['ddos_protection'] && ! $this->update_login_attempts()) {

			$this->error($this->CI->lang->line('authentication_error_login_attempts_exceeded'));
			return FALSE;
		}

		if($this->config_vars['ddos_protection'] && $this->config_vars['recaptcha_active'] && $this->get_login_attempts() > $this->config_vars['recaptcha_login_attempts']){
			$this->CI->load->helper('recaptchalib');
			$reCaptcha = new ReCaptcha( $this->config_vars['recaptcha_secret']);
			$resp = $reCaptcha->verifyResponse( $this->CI->input->server("REMOTE_ADDR"), $this->CI->input->post("g-recaptcha-response") );

			if( ! $resp->success){
				$this->error($this->CI->lang->line('authentication_error_recaptcha_not_correct'));
				return FALSE;
			}
		}

 		if( $this->config_vars['login_with_name'] == TRUE){

			if( !$identifier OR strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max'] )
			{
				$this->error($this->CI->lang->line('authentication_error_login_failed_name'));
				return FALSE;
			}
			$db_identifier = 'username';
 		}else{
                        $this->CI->load->helper('email');
			if( !valid_email($identifier) OR strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max'] )
			{
				$this->error($this->CI->lang->line('authentication_error_login_failed_email'));
				return FALSE;
			}
			$db_identifier = 'email';
 		}



		// if user is not verified
		$query = null;
		$query = $this->CI->db->where($db_identifier, $identifier);
		$query = $this->CI->db->where('banned', 1);
		//$query = $this->CI->db->where('user_groups_id!=1', NULL);
		$query = $this->CI->db->where('deleted_at is NULL', NULL);
		$query = $this->CI->db->where('verification_code !=', '');
		$query = $this->CI->db->get($this->config_vars['users']);

		/*if ($query->num_rows() > 0) {
			$this->error($this->CI->lang->line('authentication_error_account_not_verified'));
			return FALSE;
		}*/



		// to find user id, create sessions and cookies
		$query = $this->CI->db->where($db_identifier, $identifier);
		//$query = $this->CI->db->where('user_groups_id!=1', NULL);
		$query = $this->CI->db->where('deleted_at is NULL', NULL);
		
		$query = $this->CI->db->get($this->config_vars['users']);

		if($query->num_rows() == 0){
			$this->error($this->CI->lang->line('authentication_error_no_user'));
			return FALSE;
		}



		if($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == FALSE AND $this->config_vars['totp_two_step_login_active'] == TRUE){
			if($this->config_vars['totp_two_step_login_active'] == TRUE){
				$this->CI->session->set_userdata('totp_required', true);
			}

			$query = null;
			$query = $this->CI->db->where($db_identifier, $identifier);
			$query = $this->CI->db->where('deleted_at is null', NULL);
			$query = $this->CI->db->get($this->config_vars['users']);
			$totp_secret =  $query->row()->totp_secret;
			if ($query->num_rows() > 0 AND !$totp_code) {
				$this->error($this->CI->lang->line('authentication_error_totp_code_required'));
				return FALSE;
			}else {
				if(!empty($totp_secret)){
					$this->CI->load->helper('googleauthenticator');
					$ga = new PHPGangsta_GoogleAuthenticator();
					$checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
					if (!$checkResult) {
						$this->error($this->CI->lang->line('authentication_error_totp_code_invalid'));
						return FALSE;
					}
				}
			}
	 	}



	 	if($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == TRUE){
			$query = null;
			$query = $this->CI->db->where($db_identifier, $identifier);
			$query = $this->CI->db->get($this->config_vars['users']);
			$totp_secret =  $query->row()->totp_secret;
			$ip_address = $query->row()->ip_address;
			$current_ip_address = $this->CI->input->ip_address();

			if ($query->num_rows() > 0 AND !$totp_code) {
				if($ip_address != $current_ip_address ){
					if($this->config_vars['totp_two_step_login_active'] == FALSE){
						$this->error($this->CI->lang->line('authentication_error_totp_code_required'));
						return FALSE;
					} else if($this->config_vars['totp_two_step_login_active'] == TRUE){
						$this->CI->session->set_userdata('totp_required', true);
					}
				}
			}else {
				if(!empty($totp_secret)){
					if($ip_address != $current_ip_address ){
						$this->CI->load->helper('googleauthenticator');
						$ga = new PHPGangsta_GoogleAuthenticator();
						$checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
						if (!$checkResult) {
							$this->error($this->CI->lang->line('authentication_error_totp_code_invalid'));
							return FALSE;
						}
					}
				}
			}
	 	}



		$query = null;
		$query = $this->CI->db->where($db_identifier, $identifier);
		$query = $this->CI->db->where('banned', 0);

		/* if(!$checked)
			$query = $this->CI->db->where('checked', 1); */

		//$query = $this->CI->db->where('user_groups_id!=1', NULL);
		$query = $this->CI->db->where('deleted_at is NULL', NULL);

		$query = $this->CI->db->get($this->config_vars['users']);

		$row = $query->row();


		// if email and pass matches and not banned
		$password = ($this->config_vars['use_password_hash'] ? $pass : $this->hash_password($pass, $row->id));



		if ( $query->num_rows() != 0 && $this->verify_password($password, $row->pass) ) {


			/*if($row->checked==0) {
				$this->error($this->CI->lang->line('authentication_error_account_not_verified'));
				return FALSE;
			} else {*/
				// If email and pass matches
				// create session
				$data = [
					'id' 		=> $row->id,
					'username' 	=> $row->username,
					'email' 	=> $row->email,
					'loggedin' 	=> TRUE
				];

				$this->CI->session->set_userdata($data);

				if ( $remember ){
					$expire = $this->config_vars['remember'];
					$today = date("Y-m-d");
					$remember_date = date("Y-m-d", strtotime($today . $expire) );
					$random_string = random_string('alnum', 16);
					$this->update_remember($row->id, $random_string, $remember_date );

					$cookie = [
						'name'	 => 'user',
						'value'	 => $row->id . "-" . $random_string,
						'expire' => 99*999*999,
						'path'	 => '/',
					];

					$this->CI->input->set_cookie($cookie);
				}

				// update last login
				$this->update_last_login($row->id);
				$this->update_activity();

				if($this->config_vars['remove_successful_attempts'] == TRUE){
					$this->reset_login_attempts();
				}

				return TRUE;
			//}
		}
		// if not matches
		else {

			$this->error($this->CI->lang->line('authentication_error_login_failed_all'));
			return FALSE;
		}


	}




	public function login_admin($identifier, $pass, $remember = FALSE, $totp_code = NULL) {

		// Remove cookies first
		$cookie = [
			'name'	 => 'user_a',
			'value'	 => '',
			'expire' => -3600,
			'path'	 => '/',
		];
		$this->CI->input->set_cookie($cookie);
		if ($this->config_vars['ddos_protection'] && ! $this->update_login_attempts()) {

			$this->error($this->CI->lang->line('authentication_error_login_attempts_exceeded'));
			return FALSE;
		}
		if($this->config_vars['ddos_protection'] && $this->config_vars['recaptcha_active'] && $this->get_login_attempts() > $this->config_vars['recaptcha_login_attempts']){
			$this->CI->load->helper('recaptchalib');
			$reCaptcha = new ReCaptcha( $this->config_vars['recaptcha_secret']);
			$resp = $reCaptcha->verifyResponse( $this->CI->input->server("REMOTE_ADDR"), $this->CI->input->post("g-recaptcha-response") );

			if( ! $resp->success){
				$this->error($this->CI->lang->line('authentication_error_recaptcha_not_correct'));
				return FALSE;
			}
		}
 		if( $this->config_vars['login_with_name'] == TRUE){

			if( !$identifier OR strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max'] )
			{
				$this->error($this->CI->lang->line('authentication_error_login_failed_name'));
				return FALSE;
			}
			$db_identifier = 'username';
 		}else{
                        $this->CI->load->helper('email');
			if( !valid_email($identifier) OR strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max'] )
			{
				$this->error($this->CI->lang->line('authentication_error_login_failed_email'));
				return FALSE;
			}
			$db_identifier = 'email';
 		}

		// if user is not verified
		$query = null;
		$query = $this->CI->db->where($db_identifier, $identifier);
		$query = $this->CI->db->where('banned', 1);
		$query = $this->CI->db->where('deleted_at is NULL', NULL);
		$query = $this->CI->db->where('verification_code !=', '');
		$query = $this->CI->db->get($this->config_vars['users']);

		if ($query->num_rows() > 0) {
			$this->error($this->CI->lang->line('authentication_error_account_not_verified'));
			return FALSE;
		}

		// to find user id, create sessions and cookies
		$query = $this->CI->db->where($db_identifier, $identifier);
		$query = $this->CI->db->get($this->config_vars['users']);

		if($query->num_rows() == 0){
			$this->error($this->CI->lang->line('authentication_error_no_user'));
			return FALSE;
		}
		if($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == FALSE AND $this->config_vars['totp_two_step_login_active'] == TRUE){
			if($this->config_vars['totp_two_step_login_active'] == TRUE){
				$this->CI->session->set_userdata('totp_required', true);
			}

			$query = null;
			$query = $this->CI->db->where($db_identifier, $identifier);
			$query = $this->CI->db->where('deleted_at is null', NULL);
			$query = $this->CI->db->get($this->config_vars['users']);
			$totp_secret =  $query->row()->totp_secret;
			if ($query->num_rows() > 0 AND !$totp_code) {
				$this->error($this->CI->lang->line('authentication_error_totp_code_required'));
				return FALSE;
			}else {
				if(!empty($totp_secret)){
					$this->CI->load->helper('googleauthenticator');
					$ga = new PHPGangsta_GoogleAuthenticator();
					$checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
					if (!$checkResult) {
						$this->error($this->CI->lang->line('authentication_error_totp_code_invalid'));
						return FALSE;
					}
				}
			}
	 	}

	 	if($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == TRUE){
			$query = null;
			$query = $this->CI->db->where($db_identifier, $identifier);
			$query = $this->CI->db->get($this->config_vars['users']);
			$totp_secret =  $query->row()->totp_secret;
			$ip_address = $query->row()->ip_address;
			$current_ip_address = $this->CI->input->ip_address();

			if ($query->num_rows() > 0 AND !$totp_code) {
				if($ip_address != $current_ip_address ){
					if($this->config_vars['totp_two_step_login_active'] == FALSE){
						$this->error($this->CI->lang->line('authentication_error_totp_code_required'));
						return FALSE;
					} else if($this->config_vars['totp_two_step_login_active'] == TRUE){
						$this->CI->session->set_userdata('totp_required', true);
					}
				}
			}else {
				if(!empty($totp_secret)){
					if($ip_address != $current_ip_address ){
						$this->CI->load->helper('googleauthenticator');
						$ga = new PHPGangsta_GoogleAuthenticator();
						$checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
						if (!$checkResult) {
							$this->error($this->CI->lang->line('authentication_error_totp_code_invalid'));
							return FALSE;
						}
					}
				}
			}
	 	}

		$query = null;
		$query = $this->CI->db->where($db_identifier, $identifier);
		$query = $this->CI->db->where('banned', 0);
		$query = $this->CI->db->where('checked', 1);
		$query = $this->CI->db->where('deleted_at is NULL', NULL);

		$query = $this->CI->db->get($this->config_vars['users']);

		$row = $query->row();



		// if email and pass matches and not banned
		$password = ($this->config_vars['use_password_hash'] ? $pass : $this->hash_password($pass, $row->id));




		if ( $query->num_rows() != 0 && $this->verify_password($password, $row->pass) ) {

			// If email and pass matches
			// create session
			$data = [
				'id_a' 		=> $row->id,
				'username_a' 	=> $row->username,
				'email_a' 	=> $row->email,
				'loggedin_a' 	=> TRUE
			];

			$this->CI->session->set_userdata($data);


			if ( $remember ){
				$expire = $this->config_vars['remember'];
				$today = date("Y-m-d");
				$remember_date = date("Y-m-d", strtotime($today . $expire) );
				$random_string = random_string('alnum', 16);
				$this->update_remember($row->id, $random_string, $remember_date );

				$cookie = [
					'name'	 => 'user_a',
					'value'	 => $row->id . "-" . $random_string,
					'expire' => 99*999*999,
					'path'	 => '/',
				];

				$this->CI->input->set_cookie($cookie);
			}

			// update last login
			$this->update_last_login($row->id);
			$this->update_activity();

			if($this->config_vars['remove_successful_attempts'] == TRUE){
				$this->reset_login_attempts();
			}

			return TRUE;
		}
		// if not matches
		else {

			$this->error($this->CI->lang->line('authentication_error_login_failed_all'));
			return FALSE;
		}
	}






		/**
	 * Login user from cms
	 * Check provided details against the database. Add items to error array on fail, create session if success
	 * @param string $email
	 * @param bool $remember
	 * @return bool Indicates successful login.
	 */
	public function login_cms($identifier, $remember = FALSE, $totp_code = NULL) {
		
		// Remove cookies first
		$cookie = [
			'name'	 => 'user',
			'value'	 => '',
			'expire' => -3600,
			'path'	 => '/',
		];
		$this->CI->input->set_cookie($cookie);
	

		$query = null;
		$query = $this->CI->db->where('id', $identifier);
		$query = $this->CI->db->get($this->config_vars['users']);

		$row = $query->row();

	
		if ( $query->num_rows() != 0 ) {

			// If email and pass matches
			// create session
			$data = [
				'id' 		=> $row->id,
				'username' 	=> $row->username,
				'email' 	=> $row->email,
				'loggedin' 	=> TRUE
			];

			$this->CI->session->set_userdata($data);

			if ( $remember ){
				$expire = $this->config_vars['remember'];
				$today = date("Y-m-d");
				$remember_date = date("Y-m-d", strtotime($today . $expire) );
				$random_string = random_string('alnum', 16);
				$this->update_remember($row->id, $random_string, $remember_date );

				$cookie = [
					'name'	 => 'user',
					'value'	 => $row->id . "-" . $random_string,
					'expire' => 99*999*999,
					'path'	 => '/',
				];

				$this->CI->input->set_cookie($cookie);
			}

			// update last login
			$this->update_last_login($row->id);
			$this->update_activity();

			if($this->config_vars['remove_successful_attempts'] == TRUE){
				$this->reset_login_attempts();
			}

			return TRUE;
		}
		// if not matches
		else {

			$this->error($this->CI->lang->line('authentication_error_login_failed_all'));
			return FALSE;
		}
	}




	public function emailLogin($identifier, $remember = FALSE, $totp_code = NULL)
	{
		 // Remove cookies first
		 $cookie = [
			 'name'	 => 'user',
			 'value'	 => '',
			 'expire' => -3600,
			 'path'	 => '/',
		 ];
		 $this->CI->input->set_cookie($cookie);
		 if ($this->config_vars['ddos_protection'] && ! $this->update_login_attempts()) {

			 $this->error($this->CI->lang->line('authentication_error_login_attempts_exceeded'));
			 return FALSE;
		 }
		 if($this->config_vars['ddos_protection'] && $this->config_vars['recaptcha_active'] && $this->get_login_attempts() > $this->config_vars['recaptcha_login_attempts']){
			 $this->CI->load->helper('recaptchalib');
			 $reCaptcha = new ReCaptcha( $this->config_vars['recaptcha_secret']);
			 $resp = $reCaptcha->verifyResponse( $this->CI->input->server("REMOTE_ADDR"), $this->CI->input->post("g-recaptcha-response") );

			 if( ! $resp->success){
				 $this->error($this->CI->lang->line('authentication_error_recaptcha_not_correct'));
				 return FALSE;
			 }
		 }
		 if( $this->config_vars['login_with_name'] == TRUE)
		 {
				 $db_identifier = 'username';
		 }
		 else
		 {
				 $this->CI->load->helper('email');
				 $db_identifier = 'email';
		 }

		 // if user is not verified
		 $query = null;
		 $query = $this->CI->db->where($db_identifier, $identifier);
		 $query = $this->CI->db->where('banned', 1);
		 $query = $this->CI->db->where('deleted_at is null', NULL);
		 $query = $this->CI->db->where('verification_code !=', '');

		 $query = $this->CI->db->get($this->config_vars['users']);

		 if ($query->num_rows() > 0) {
			 $this->error($this->CI->lang->line('authentication_error_account_not_verified'));
			 return FALSE;
		 }

		 // to find user id, create sessions and cookies
		 $query = $this->CI->db->where($db_identifier, $identifier);
		 $query = $this->CI->db->where('deleted_at is NULL', NULL);
		 $query = $this->CI->db->get($this->config_vars['users']);

		 if($query->num_rows() == 0){
			 $this->error($this->CI->lang->line('authentication_error_no_user'));
			 return FALSE;
		 }
		 if($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == FALSE AND $this->config_vars['totp_two_step_login_active'] == TRUE){
			 if($this->config_vars['totp_two_step_login_active'] == TRUE){
				 $this->CI->session->set_userdata('totp_required', true);
			 }

			 $query = null;
			 $query = $this->CI->db->where($db_identifier, $identifier);
			  $query = $this->CI->db->where('deleted_at is NULL', NULL);
			 $query = $this->CI->db->get($this->config_vars['users']);
			 $totp_secret =  $query->row()->totp_secret;
			 if ($query->num_rows() > 0 AND !$totp_code) {
				 $this->error($this->CI->lang->line('authentication_error_totp_code_required'));
				 return FALSE;
			 }else {
				 if(!empty($totp_secret)){
					 $this->CI->load->helper('googleauthenticator');
					 $ga = new PHPGangsta_GoogleAuthenticator();
					 $checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
					 if (!$checkResult) {
						 $this->error($this->CI->lang->line('authentication_error_totp_code_invalid'));
						 return FALSE;
					 }
				 }
			 }
		 }

		 if($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == TRUE){
			 $query = null;
			 $query = $this->CI->db->where($db_identifier, $identifier);
			  $query = $this->CI->db->where('deleted_at is NULL', NULL);
			 $query = $this->CI->db->get($this->config_vars['users']);
			 $totp_secret =  $query->row()->totp_secret;
			 $ip_address = $query->row()->ip_address;
			 $current_ip_address = $this->CI->input->ip_address();

			 if ($query->num_rows() > 0 AND !$totp_code) {
				 if($ip_address != $current_ip_address ){
					 if($this->config_vars['totp_two_step_login_active'] == FALSE){
						 $this->error($this->CI->lang->line('authentication_error_totp_code_required'));
						 return FALSE;
					 } else if($this->config_vars['totp_two_step_login_active'] == TRUE){
						 $this->CI->session->set_userdata('totp_required', true);
					 }
				 }
			 }else {
				 if(!empty($totp_secret)){
					 if($ip_address != $current_ip_address ){
						 $this->CI->load->helper('googleauthenticator');
						 $ga = new PHPGangsta_GoogleAuthenticator();
						 $checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
						 if (!$checkResult) {
							 $this->error($this->CI->lang->line('authentication_error_totp_code_invalid'));
							 return FALSE;
						 }
					 }
				 }
			 }
		 }
		 $query = null;
		 $query = $this->CI->db->where($db_identifier, $identifier);
		  $query = $this->CI->db->where('deleted_at is NULL', NULL);
		 $query = $this->CI->db->where('banned', 0);
	   $query = $this->CI->db->get($this->config_vars['users']);
	 	 $row = $query->row();
		 $data = [
			 'id' 		=> $row->id,
			 'username' 	=> $row->username,
			 'email' 	=> $row->email,
			 'loggedin' 	=> TRUE
		 ];
		 $this->CI->session->set_userdata($data);
		 if ( $remember ){
			 $expire = $this->config_vars['remember'];
			 $today = date("Y-m-d");
			 $remember_date = date("Y-m-d", strtotime($today . $expire) );
			 $random_string = random_string('alnum', 16);
			 $this->update_remember($row->id, $random_string, $remember_date );
			 $cookie = [
				 'name'	 => 'user',
				 'value'	 => $row->id . "-" . $random_string,
				 'expire' => 99*999*999,
				 'path'	 => '/',
			 ];
			 $this->CI->input->set_cookie($cookie);
		 }
		 // update last login
		 $this->update_last_login($row->id);
		 $this->update_activity();

		 if($this->config_vars['remove_successful_attempts'] == TRUE){
			 	$this->reset_login_attempts();
		 }

		 return TRUE;
	}

	//tested
	/**
	 * Check user login
	 * Checks if user logged in, also checks remember.
	 * @return bool
	 */
	public function is_loggedin() {

		if ( $this->CI->session->userdata('loggedin') ){
			return TRUE;
		} else {
			if( ! $this->CI->input->cookie('user', TRUE) ){
				return FALSE;
			} else {
				$cookie = explode('-', $this->CI->input->cookie('user', TRUE));
				if(!is_numeric( $cookie[0] ) OR strlen($cookie[1]) < 13 ){return FALSE;}
				else{
					$query = $this->CI->db->where('id', $cookie[0]);
					$query = $this->CI->db->where('remember_exp', $cookie[1]);
					$query = $this->CI->db->get($this->config_vars['users']);

					$row = $query->row();

					if ($query->num_rows() < 1) {
						$this->update_remember($cookie[0]);
						return FALSE;
					}else{

						if(strtotime($row->remember_time) > strtotime("now") ){
							$this->login_fast($cookie[0]);
							return TRUE;
						}
						// if time is expired
						else {
							return FALSE;
						}
					}
				}
			}
		}
		return FALSE;
	}


	public function is_loggedin_admin() {

		if ( $this->CI->session->userdata('loggedin_a') ){
			return TRUE;
		} else {
			if( ! $this->CI->input->cookie('user_a', TRUE) ){
				return FALSE;
			} else {
				$cookie = explode('-', $this->CI->input->cookie('user_a', TRUE));
				if(!is_numeric( $cookie[0] ) OR strlen($cookie[1]) < 13 ){return FALSE;}
				else{
					$query = $this->CI->db->where('id', $cookie[0]);
					$query = $this->CI->db->where('remember_exp', $cookie[1]);
					$query = $this->CI->db->get($this->config_vars['users']);

					$row = $query->row();

					if ($query->num_rows() < 1) {
						$this->update_remember($cookie[0]);
						return FALSE;
					}else{

						if(strtotime($row->remember_time) > strtotime("now") ){
							$this->login_fast_admin($cookie[0]);
							return TRUE;
						}
						// if time is expired
						else {
							return FALSE;
						}
					}
				}
			}
		}
		return FALSE;
	}

	/**
	 * Controls if a logged or public user has permission
	 *
	 * If user does not have permission to access page, it stops script and gives
	 * error message, unless 'no_permission' value is set in config.  If 'no_permission' is
	 * set in config it redirects user to the set url and passes the 'no_access' error message.
	 * It also updates last activity every time function called.
	 *
	 * @param bool $perm_par If not given just control user logged in or not
	 */
	public function control( $perm_par = FALSE ){

		if($this->CI->session->userdata('totp_required')){
			$this->error($this->CI->lang->line('authentication_error_totp_verification_required'));
			redirect($this->config_vars['totp_two_step_login_redirect']);
		}

		$perm_id = $this->get_perm_id($perm_par);
		$this->update_activity();
		if($perm_par == FALSE){
			if($this->is_loggedin()){
				return TRUE;
			}else if(!$this->is_loggedin()){
				$this->error($this->CI->lang->line('authentication_error_no_access'));
				if($this->config_vars['no_permission'] !== FALSE){
					redirect($this->config_vars['no_permission']);
				}
			}

		}else if ( ! $this->is_allowed($perm_id) OR ! $this->is_group_allowed($perm_id) ){
			if( $this->config_vars['no_permission'] ) {
				$this->error($this->CI->lang->line('authentication_error_no_access'));
				if($this->config_vars['no_permission'] !== FALSE){
					redirect($this->config_vars['no_permission']);
				}
			}
			else {
				echo $this->CI->lang->line('authentication_error_no_access');
				die();
			}
		}
	}

	//tested
	/**
	 * Logout user
	 * Destroys the CodeIgniter session and remove cookies to log out user.
	 * @return bool If session destroy successful
	 */
	public function logout() {

		$cookie = [
			'name'	 => 'user',
			'value'	 => '',
			'expire' => -3600,
			'path'	 => '/',
		];

		$this->CI->input->set_cookie($cookie);

		return $this->CI->session->sess_destroy();
	}

	//tested
	/**
	 * Fast login
	 * Login with just a user id
	 * @param int $user_id User id to log in
	 * @return bool TRUE if login successful.
	 */
	public function login_fast($user_id){

		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->where('banned', 0);
		$query = $this->CI->db->get($this->config_vars['users']);

		$row = $query->row();

		if ($query->num_rows() > 0) {

			// if id matches
			// create session
			$data = [
				'id' 		=> $row->id,
				'username' 	=> $row->username,
				'email' 	=> $row->email,
				'loggedin' 	=> TRUE
			];

			$this->CI->session->set_userdata($data);
			return TRUE;
		}
		return FALSE;
	}

	public function login_fast_admin($user_id){

		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->where('banned', 0);
		$query = $this->CI->db->get($this->config_vars['users']);

		$row = $query->row();

		if ($query->num_rows() > 0) {

			// if id matches
			// create session
			$data = [
				'id_a' 		=> $row->id,
				'username_a' 	=> $row->username,
				'email_a' 	=> $row->email,
				'loggedin_a' 	=> TRUE
			];

			$this->CI->session->set_userdata($data);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Reset last login attempts
	 * Removes a Login Attempt
	 * @return bool Reset fails/succeeds
	 */
	public function reset_login_attempts() {
		$ip_address = $this->CI->input->ip_address();
		$this->CI->db->where(
			[
				'ip_address'=>$ip_address,
				'timestamp >='=>date("Y-m-d H:i:s", strtotime("-".$this->config_vars['max_login_attempt_time_period']))
			]
		);
		return $this->CI->db->delete($this->config_vars['login_attempts']);
	}

	/**
	 * Remind password
	 * Emails user with link to reset password
	 * @param string $email Email for account to remind
	 * @return bool Remind fails/succeeds
	 */
	public function remind_password($email){

		$query = $this->CI->db->where( 'email', $email );
		$query = $this->CI->db->get( $this->config_vars['users'] );

		if ($query->num_rows() > 0){
			$row = $query->row();

			$ver_code = sha1(strtotime("now"));

			$data['verification_code'] = $ver_code;

			$this->CI->db->where('email', $email);
			$this->CI->db->update($this->config_vars['users'], $data);

			  $config = array();
              $config['protocol'] = get_setting("mail_server");
              // $config['smtp_host'] = get_setting("mail_hostname");
			  // $config['smtp_port'] = get_setting("mail_port");
              // $config['smtp_user'] = get_setting("mail_username");
			  // $config['smtp_pass'] = get_setting("mail_password");
			  $config['smtp_host'] = "smtp.yandex.com";
			  $config['smtp_port'] = 587;
			  $config['smtp_user'] = "support@makromedicine.com";
			  $config['smtp_pass'] = "72880105m";
			  $config['smtp_crypto'] = "tls";
              $config['mailtype'] = get_setting("mail_type");
              $config['smtp_timeout'] = get_setting("mail_timeout");
              // $config['mailpath']   = '/usr/sbin/sendmail';
              $config['mailtype']   = 'html';
              $config['charset'] = 'utf-8';
              $config['crlf'] = "\r\n";
              $config['newline'] = "\r\n";
			  $config['wordwrap'] = TRUE;

			$this->CI->email->initialize($config);
			$this->CI->email->from('support@makromedicine.com', 'Makromedicine.com');
			$this->CI->email->to($email);
			$this->CI->email->subject($this->CI->lang->line('authentication_email_reset_subject'));
			$this->CI->email->message($this->CI->lang->line('authentication_email_reset_text') . site_url() . $this->config_vars['reset_password_link'] . $ver_code );
			if ($this->CI->email->send()) {

			return TRUE;
			} else {
				show_error($this->CI->email->print_debugger());
			}
		}
		return FALSE;
	}

	public function generate_verification_code($email)
	{
			$query = $this->CI->db->where( 'email', $email );
			$query = $this->CI->db->get( $this->config_vars['users'] );
			if ($query->num_rows() > 0){
				$row = $query->row();
				$ver_code = sha1(strtotime("now"));
				$data['verification_code'] = $ver_code;
				$this->CI->db->where('email', $email);
				$this->CI->db->update($this->config_vars['users'], $data);
				return $data['verification_code'];
			}
			return FALSE;
	}

	/**
	 * Reset password
	 * Generate new password and email it to the user
	 * @param string $ver_code Verification code for account
	 * @return bool Password reset fails/succeeds
	 */
	public function reset_password($ver_code){

		$query = $this->CI->db->where('verification_code', $ver_code);
		$query = $this->CI->db->get( $this->config_vars['users'] );

		$pass_length = ($this->config_vars['min']&1 ? $this->config_vars['min']+1 : $this->config_vars['min']);
		$pass = random_string('alnum', $pass_length);

		if( $query->num_rows() > 0 ){

			$row = $query->row();

			$data =	 [
				'verification_code' => '',
				'pass' => $this->hash_password($pass, $row->id)
			];

		 	if($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_reset_over_reset_password'] == TRUE){
		 		$data['totp_secret'] = NULL;
		 	}

			$email = $row->email;

			$this->CI->db->where('id', $row->id);
			$this->CI->db->update($this->config_vars['users'] , $data);

		// 	$config = array();
        //   $config['protocol'] = get_setting("mail_server");
        //   $config['smtp_host'] = get_setting("mail_hostname");
        //   $config['smtp_port'] = get_setting("mail_port");
        //   $config['smtp_user'] = get_setting("mail_username");
        //   $config['smtp_pass'] = get_setting("mail_password");
        //   $config['mailtype'] = get_setting("mail_type");
        //   $config['smtp_timeout'] = get_setting("mail_timeout");
        //   $config['mailpath']   = '/usr/sbin/sendmail';
        //   $config['mailtype']   = 'html';
        //   $config['charset'] = 'utf-8';
        //   $config['crlf'] = "\r\n";
        //   $config['newline'] = "\r\n";
		//   $config['wordwrap'] = TRUE;
		
		$config = array();
              $config['protocol'] = get_setting("mail_server");
              // $config['smtp_host'] = get_setting("mail_hostname");
			  // $config['smtp_port'] = get_setting("mail_port");
              // $config['smtp_user'] = get_setting("mail_username");
			  // $config['smtp_pass'] = get_setting("mail_password");
			  $config['smtp_host'] = "smtp.yandex.com";
			  $config['smtp_port'] = 587;
			  $config['smtp_user'] = "support@makromedicine.com";
			  $config['smtp_pass'] = "72880105m";
			  $config['smtp_crypto'] = "tls";
              $config['mailtype'] = get_setting("mail_type");
              $config['smtp_timeout'] = get_setting("mail_timeout");
              // $config['mailpath']   = '/usr/sbin/sendmail';
              $config['mailtype']   = 'html';
              $config['charset'] = 'utf-8';
              $config['crlf'] = "\r\n";
              $config['newline'] = "\r\n";
			  $config['wordwrap'] = TRUE;

			$this->CI->email->initialize($config);
			$this->CI->email->from('support@makromedicine.com', 'Makromedicine.com');
			$this->CI->email->to($email);
			$this->CI->email->subject($this->CI->lang->line('authentication_email_reset_success_subject'));
			$this->CI->email->message($this->CI->lang->line('authentication_email_reset_success_new_password') . $pass);
			$this->CI->email->send();

			/*if(isset($this->config_vars['email_config']) && is_array($this->config_vars['email_config'])){
				$this->CI->email->initialize($this->config_vars['email_config']);
			}

			$this->CI->email->from( $this->config_vars['email'], $this->config_vars['name']);
			$this->CI->email->to($email);
			$this->CI->email->subject($this->CI->lang->line('authentication_email_reset_success_subject'));
			$this->CI->email->message($this->CI->lang->line('authentication_email_reset_success_new_password') . $pass);
			$this->CI->email->send();*/
			return TRUE;
		}

		$this->error($this->CI->lang->line('authentication_error_vercode_invalid'));
		return FALSE;
	}


	public function get_verification_code($ver_code)
	{
		$query = $this->CI->db->where('verification_code', $ver_code);
		$query = $this->CI->db->get( $this->config_vars['users'] );
		if( $query->num_rows() > 0 ){
			$row = $query->row();
			return $row;
		}else{
			return false;
		}
	}

	public function reset_verification_code($id)
	{
			$data =	['verification_code' => ''];
			$this->CI->db->where('id', $id);
			$update =  $this->CI->db->update($this->config_vars['users'] , $data);
			if($update)
			{
				return true;
			}
			else
			{
				return false;
			}
	}

	//tested
	/**
	 * Update last login
	 * Update user's last login date
	 * @param int|bool $user_id User id to update or FALSE for current user
	 * @return bool Update fails/succeeds
	 */
	public function update_last_login($user_id = FALSE) {

		if ($user_id == FALSE)
			$user_id = $this->CI->session->userdata('id');

		$data['last_login'] = date("Y-m-d H:i:s");
		$data['ip_address'] = $this->CI->input->ip_address();

		$this->CI->db->where('id', $user_id);
		return $this->CI->db->update($this->config_vars['users'], $data);
	}


	//tested
	/**
	 * Update login attempt and if exceeds return FALSE
	 * @return bool
	 */
	public function update_login_attempts() {
		$ip_address = $this->CI->input->ip_address();
		$query = $this->CI->db->where(
			[
				'ip_address' 	=> $ip_address,
				'timestamp >=' 	=> date("Y-m-d H:i:s", strtotime("-".$this->config_vars['max_login_attempt_time_period']))
			]
		);
		$query = $this->CI->db->get( $this->config_vars['login_attempts'] );

		if($query->num_rows() == 0){
			$data = [];
			$data['ip_address'] = $ip_address;
			$data['timestamp'] = date("Y-m-d H:i:s");
			$data['login_attempts'] = 1;
			$this->CI->db->insert($this->config_vars['login_attempts'], $data);
			return TRUE;
		}else{
			$row = $query->row();
			$data = [];
			$data['timestamp'] = date("Y-m-d H:i:s");
			$data['login_attempts'] = $row->login_attempts + 1;
			$this->CI->db->where('id', $row->id);
			$this->CI->db->update($this->config_vars['login_attempts'], $data);

			if ( $data['login_attempts'] > $this->config_vars['max_login_attempt'] ) {
				return FALSE;
			} else {
				return TRUE;
			}
		}

	}

	/**
	 * Get login attempt
	 * @return int
	 */
	public function get_login_attempts() {
		$ip_address = $this->CI->input->ip_address();
		$query = $this->CI->db->where(
			[
				'ip_address' 	=> $ip_address,
				'timestamp >=' 	=> date("Y-m-d H:i:s", strtotime("-".$this->config_vars['max_login_attempt_time_period']))
			]
		);
		$query = $this->CI->db->get( $this->config_vars['login_attempts'] );

		if($query->num_rows() != 0){
			$row = $query->row();
			return $row->login_attempts;
		}

		return 0;
	}

	/**
	 * Update remember
	 * Update amount of time a user is remembered for
	 * @param int $user_id User id to update
	 * @param int $expression
	 * @param int $expire
	 * @return bool Update fails/succeeds
	 */
	public function update_remember($user_id, $expression=null, $expire=null) {

		$data['remember_time'] = $expire;
		$data['remember_exp'] = $expression;

		$query = $this->CI->db->where('id',$user_id);
		return $this->CI->db->update($this->config_vars['users'], $data);
	}


	########################
	# User Functions
	########################

	//tested
	/**
	 * Create user
	 * Creates a new user
	 * @param string $email User's email address
	 * @param string $pass User's password
	 * @param string $username User's username
	 * @return int|bool False if create fails or returns user id if successful
	 */
	public function create_user($email, $pass, $phone=null, $username = FALSE, $fullname = '', $group_id = FALSE, $company_name = FALSE, $isgoogle = FALSE) {

		$valid = TRUE;

		if($this->config_vars['login_with_name'] == TRUE){
			if (empty($username)){
				$this->error($this->CI->lang->line('authentication_error_username_required'));
				$valid = FALSE;
			}
		}
		if ($this->user_exist_by_username($username) && $username != FALSE) {
			$this->error($this->CI->lang->line('authentication_error_username_exists'));
			$valid = FALSE;
		}

		if ($this->user_exist_by_company($company_name) && $company_name != FALSE) {
			$this->error($this->CI->lang->line('authentication_error_company_exists'));
			$valid = FALSE;
		}

		if ($this->user_exist_by_email($email)) {
			$this->error($this->CI->lang->line('authentication_error_email_exists'));
			$valid = FALSE;
		}
		$valid_email = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
		if (!$valid_email){
			$this->error($this->CI->lang->line('authentication_error_email_invalid'));
			$valid = FALSE;
		}
		if ( (strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max'] ) && !$isgoogle){
			$this->error($this->CI->lang->line('authentication_error_password_invalid'));
			$valid = FALSE;
		}
		if ($username != FALSE && !ctype_alnum(str_replace($this->config_vars['additional_valid_chars'], '', $username))){
			$this->error($this->CI->lang->line('authentication_error_username_invalid'));
			$valid = FALSE;
		}
		if (!$valid) {
			return FALSE;
		}

		if(strpos($email, 'yopmail') === false){
			$process = 3;
		}
		else{
			$process=0;
		}

		$data = [
			'email' 		=> $email,
			'pass' 			=> $this->hash_password($pass, 0), // Password cannot be blank but user_id required for salt, setting bad password for now
			'phone' 		=> $phone,
			'username' 		=> (!$username) ? '' : $username,
			'fullname'      => $fullname,
			'created_at'    => date("Y-m-d H:i:s"),
			'process'		=> $process
		];

		if ( $this->CI->db->insert($this->config_vars['users'], $data )){

			$user_id = $this->CI->db->insert_id();

			// set default group

			if(!$group_id){
				$group_id = $this->get_group_id($this->config_vars['default_group']);
			}

			$this->add_member($user_id, $group_id);

			// if verification activated
			if($this->config_vars['verification'] && !$this->is_admin()){
				$data = null;
				$data['banned'] = 1;

				$this->CI->db->where('id', $user_id);
				$this->CI->db->update($this->config_vars['users'], $data);

				// sends verifition ( !! e-mail settings must be set)
				$this->send_verification($user_id);
			}

			// Update to correct salted password
			if( !$this->config_vars['use_password_hash']){
				$data = null;
				$data['pass'] = $this->hash_password($pass, $user_id);
				$this->CI->db->where('id', $user_id);
				$this->CI->db->update($this->config_vars['users'], $data);
			}

			return $user_id;

		} else {
			return FALSE;
		}
	}

	//tested
	/**
	 * Update user
	 * Updates existing user details
	 * @param int $user_id User id to update
	 * @param string|bool $email User's email address, or FALSE if not to be updated
	 * @param string|bool $pass User's password, or FALSE if not to be updated
	 * @param string|bool $name User's name, or FALSE if not to be updated
	 * @return bool Update fails/succeeds
	 */


	public function update_user($user_id, $email = FALSE, $pass = FALSE, $username = FALSE, $fullname = '',$group_id = FALSE,$status=false,$isvisible=false) {

		$data = [];
		$valid = TRUE;
		$user = $this->get_user($user_id);

		if ($user->email == $email) {
			$email = FALSE;
		}
		if($status!==false)
		$data['status']=$status;

	if($isvisible!==false)
		$data['isvisible']=$isvisible;

		if ($email != FALSE) {
			if ($this->user_exist_by_email($email)) {
				$this->error($this->CI->lang->line('authentication_error_update_email_exists'));
				$valid = FALSE;
			}
			$valid_email = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
			if (!$valid_email){
				$this->error($this->CI->lang->line('authentication_error_email_invalid'));
				$valid = FALSE;
			}
			$data['email'] = $email;
		}

		if ($pass != FALSE) {
			if ( strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max'] ){
				$this->error($this->CI->lang->line('authentication_error_password_invalid'));
				$valid = FALSE;
			}
			$data['pass'] = $this->hash_password($pass, $user_id);
		}

		if ($user->username == $username) {
			$username = FALSE;
		}

		if ($username != FALSE) {
			if ($this->user_exist_by_username($username)) {
				$this->error($this->CI->lang->line('authentication_error_update_username_exists'));
				$valid = FALSE;
			}
			if ($username !='' && !ctype_alnum(str_replace($this->config_vars['additional_valid_chars'], '', $username))){
				$this->error($this->CI->lang->line('authentication_error_username_invalid'));
				$valid = FALSE;
			}
			$data['username'] = $username;
		}

		if ($fullname != FALSE) {
			$data['fullname'] = $fullname;
		}
	

		if ( !$valid || empty($data)) {
			return FALSE;
		}

		//edit user group
		if($group_id){
			$this->edit_member($user_id,['group_id'=>$group_id]);
		}

		$this->CI->db->where('id', $user_id);
		return $this->CI->db->update($this->config_vars['users'], $data);
	}

	//tested
	/**
	 * List users
	 * Return users as an object array
	 * @param bool|int $group_par Specify group id to list group or FALSE for all users
	 * @param string $limit Limit of users to be returned
	 * @param bool $offset Offset for limited number of users
	 * @param bool $include_banneds Include banned users
	 * @param string $sort Order by MYSQL string (e.g. 'name ASC', 'email DESC')
	 * @return array Array of users
	 */
	public function list_users($group_par = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE, $sort = FALSE) {

		// if group_par is given
		if ($group_par != FALSE) {

			$group_par = $this->get_group_id($group_par);
			$this->CI->db->select('*')
				->from($this->config_vars['users'])
				->join($this->config_vars['user_to_group'], $this->config_vars['users'] . ".id = " . $this->config_vars['user_to_group'] . ".user_id")
				->where($this->config_vars['user_to_group'] . ".group_id", $group_par);

			// if group_par is not given, lists all users
		} else {

			$this->CI->db->select('*')
				->from($this->config_vars['users']);
		}

		// banneds
		if (!$include_banneds) {
			$this->CI->db->where('banned != ', 1);
		}

		// order_by
		if ($sort) {
			$this->CI->db->order_by($sort);
		}

		// limit
		if ($limit) {

			if ($offset == FALSE)
				$this->CI->db->limit($limit);
			else
				$this->CI->db->limit($limit, $offset);
		}

		$query = $this->CI->db->get();

		return $query->result();
	}

	//tested
	/**
	 * Get user
	 * Get user information
	 * @param int|bool $user_id User id to get or FALSE for current user
	 * @return object User information
	 */
	public function get_user($user_id = FALSE) {

		if ($user_id == FALSE)
			$user_id = $this->CI->session->userdata('id');

		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->get($this->config_vars['users']);


		if ($query->num_rows() <= 0){
			$this->error($this->CI->lang->line('authentication_error_no_user'));
			return FALSE;
		}
		return $query->row();
	}

    // testing
    /**
     * Get user password
     * Get user information
     * @param int|bool $user_id User id to get or FALSE for current user
     * @return object User information
     */
    public function get_user_password($user_id = FALSE) {

        if ($user_id == FALSE)
            $user_id = $this->CI->session->userdata('id');

        $query = $this->CI->db->where('id', $user_id);
        $query = $this->CI->db->get($this->config_vars['users']);

        if ($query->num_rows() <= 0){
            $this->error($this->CI->lang->line('authentication_error_no_user'));
            return FALSE;
        }
        return $query->row();
    }

	public function get_user_admin($user_id = FALSE) {

		if ($user_id == FALSE)
			$user_id = $this->CI->session->userdata('id_a');

		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->get($this->config_vars['users']);

		if ($query->num_rows() <= 0){
			$this->error($this->CI->lang->line('authentication_error_no_user'));
			return FALSE;
		}
		return $query->row();
	}

	/**
	 * Verify user
	 * Activates user account based on verification code
	 * @param int $user_id User id to activate
	 * @param string $ver_code Code to validate against
	 * @return bool Activation fails/succeeds
	 */
	public function verify_user($user_id, $ver_code){

		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->where('verification_code', $ver_code);
		$query = $this->CI->db->get( $this->config_vars['users'] );

		// if ver code is TRUE
		if( $query->num_rows() > 0 ){

			$data =	 [
				'verification_code' => '',
				'banned' 			=> 0
			];

			$this->CI->db->where('id', $user_id);
			$this->CI->db->update($this->config_vars['users'] , $data);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Send verification email
	 * Sends a verification email based on user id
	 * @param int $user_id User id to send verification email to
	 * @todo return success indicator
	 */
	public function send_verification($user_id){

		$query = $this->CI->db->where( 'id', $user_id );
		$query = $this->CI->db->get( $this->config_vars['users'] );

		if ($query->num_rows() > 0){
			$row = $query->row();

			$ver_code = random_string('alnum', 16);

			$data['verification_code'] = $ver_code;

			$this->CI->db->where('id', $user_id);
			$this->CI->db->update($this->config_vars['users'], $data);

			if(isset($this->config_vars['email_config']) && is_array($this->config_vars['email_config'])){
				$this->CI->email->initialize($this->config_vars['email_config']);
			}

			$this->CI->email->from( $this->config_vars['email'], $this->config_vars['name']);
			$this->CI->email->to($row->email);
			$this->CI->email->subject($this->CI->lang->line('authentication_email_verification_subject'));
			$this->CI->email->message($this->CI->lang->line('authentication_email_verification_code') . $ver_code .
				$this->CI->lang->line('authentication_email_verification_text') . site_url() .$this->config_vars['verification_link'] . $user_id . '/' . $ver_code );
			$this->CI->email->send();
		}
	}

	//not tested excatly
	/**
	 * Delete user
	 * Delete a user from database. WARNING Can't be undone
	 * @param int $user_id User id to delete
	 * @return bool Delete fails/succeeds
	 */
	public function delete_user($user_id) {

		// delete from perm_to_user
		$this->CI->db->where('user_id', $user_id);
		$this->CI->db->delete($this->config_vars['perm_to_user']);

		// delete from user_to_group
		$this->CI->db->where('user_id', $user_id);
		$this->CI->db->delete($this->config_vars['user_to_group']);

		// delete user vars
		$this->CI->db->where('user_id', $user_id);
		$this->CI->db->delete($this->config_vars['user_variables']);

		// delete user
		$this->CI->db->where('id', $user_id);
		return $this->CI->db->delete($this->config_vars['users']);

	}

	//tested
	/**
	 * Ban user
	 * Bans a user account
	 * @param int $user_id User id to ban
	 * @return bool Ban fails/succeeds
	 */
	public function ban_user($user_id) {

		$data = [
			'banned' 			=> 1,
			'verification_code' => ''
		];

		$this->CI->db->where('id', $user_id);

		return $this->CI->db->update($this->config_vars['users'], $data);
	}

	//tested
	/**
	 * Unban user
	 * Activates user account
	 * Same with unlock_user()
	 * @param int $user_id User id to activate
	 * @return bool Activation fails/succeeds
	 */
	public function unban_user($user_id) {

		$data = [
			'banned' => 0
		];

		$this->CI->db->where('id', $user_id);

		return $this->CI->db->update($this->config_vars['users'], $data);
	}

	//tested
	/**
	 * Check user banned
	 * Checks if a user is banned
	 * @param int $user_id User id to check
	 * @return bool False if banned, True if not
	 */
	public function is_banned($user_id) {

		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->where('banned', 1);

		$query = $this->CI->db->get($this->config_vars['users']);

		if ($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	/**
	 * user_exist_by_username
	 * Check if user exist by username
	 * @param $user_id
	 *
	 * @return bool
	 */
	public function user_exist_by_username( $name ) {
		$query = $this->CI->db->where('username', $name);

		$query = $this->CI->db->get($this->config_vars['users']);

		if ($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

		/**
	 * user_exist_by_username
	 * Check if user exist by username
	 * @param $user_id
	 *
	 * @return bool
	 */
	public function user_exist_by_company( $name ) {
		$query = $this->CI->db->where('company_name', $name);

		$query = $this->CI->db->get($this->config_vars['companies']);

		if ($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	/**
	 * user_exist_by_email
	 * Check if user exist by user email
	 * @param $user_email
	 *
	 * @return bool
	 */
	public function user_exist_by_email( $user_email ) {
		$query = $this->CI->db->where('email', $user_email);
		$query = $this->CI->db->where('deleted_at is NULL', NULL);

		$query = $this->CI->db->get($this->config_vars['users']);

		if ($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}



	/**
	 * user_exist_by_id
	 * Check if user exist by user email
	 * @param $user_email
	 *
	 * @return bool
	 */
	public function user_exist_by_id( $user_id ) {
		$query = $this->CI->db->where('id', $user_id);

		$query = $this->CI->db->get($this->config_vars['users']);

		if ($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	/**
	 * Get user id
	 * Get user id from email address, if par. not given, return current user's id
	 * @param string|bool $email Email address for user
	 * @return int User id
	 */
	public function get_user_id($email=FALSE) {

		if( ! $email){
			$query = $this->CI->db->where('id', $this->CI->session->userdata('id'));
		} else {
			$query = $this->CI->db->where('email', $email);
		}

		$query = $this->CI->db->get($this->config_vars['users']);

		if ($query->num_rows() <= 0){
			$this->error($this->CI->lang->line('authentication_error_no_user'));
			return FALSE;
		}
		return $query->row()->id;
	}

	/**
	 * Get user groups
	 * Get groups a user is in
	 * @param int|bool $user_id User id to get or FALSE for current user
	 * @return array Groups
	 */
	public function get_user_groups($user_id = FALSE){

		if( !$user_id) { $user_id = $this->CI->session->userdata('id'); }
		if( !$user_id){
			$this->CI->db->where('name', $this->config_vars['public_group']);
			$query = $this->CI->db->get($this->config_vars['groups']);
		}else if($user_id){
			$this->CI->db->join($this->config_vars['groups'], "id = group_id");
			$this->CI->db->where('user_id', $user_id);
			$query = $this->CI->db->get($this->config_vars['user_to_group']);
		}
		return $query->result();
	}

	public function get_user_groups_admin($user_id = FALSE){

		if( !$user_id) { $user_id = $this->CI->session->userdata('id_a'); }
		if( !$user_id){
			$this->CI->db->where('name', $this->config_vars['public_group']);
			$query = $this->CI->db->get($this->config_vars['groups']);
		}else if($user_id){
			$this->CI->db->join($this->config_vars['groups'], "id = group_id");
			$this->CI->db->where('user_id', $user_id);
			$query = $this->CI->db->get($this->config_vars['user_to_group']);
		}
		return $query->result();
	}


	/**
	 * Get user permissions
	 * Get user permissions from user id ( ! Case sensitive)
	 * @param int|bool $user_id User id to get or FALSE for current user
	 * @return int Group id
	 */
	public function get_user_perms ( $user_id = FALSE ) {
		if( ! $user_id) { $user_id = $this->CI->session->userdata('id'); }

		if($user_id){
			$query = $this->CI->db->select($this->config_vars['perms'].'.*');
			$query = $this->CI->db->where('user_id', $user_id);
			$query = $this->CI->db->join($this->config_vars['perms'], $this->config_vars['perms'].'.id = '.$this->config_vars['perm_to_user'].'.perm_id');
			$query = $this->CI->db->get($this->config_vars['perm_to_user']);

			return $query->result();
		}

		return FALSE;
	}

	//tested
	/**
	 * Update activity
	 * Update user's last activity date
	 * @param int|bool $user_id User id to update or FALSE for current user
	 * @return bool Update fails/succeeds
	 */
	public function update_activity($user_id = FALSE) {

		if ($user_id == FALSE)
			$user_id = $this->CI->session->userdata('id');

		if($user_id==FALSE){return FALSE;}

		$data['last_activity'] = date("Y-m-d H:i:s");

		$query = $this->CI->db->where('id',$user_id);
		return $this->CI->db->update($this->config_vars['users'], $data);
	}

	//tested
	/**
	 * Hash password
	 * Hash the password for storage in the database
	 * (thanks to Jacob Tomlinson for contribution)
	 * @param string $pass Password to hash
	 * @param $userid
	 * @return string Hashed password
	 */
	function hash_password($pass, $userid) {
		if($this->config_vars['use_password_hash']){
			return password_hash($pass, $this->config_vars['password_hash_algo'], $this->config_vars['password_hash_options']);
		}else{
			$salt = md5($userid);
			return hash($this->config_vars['hash'], $salt.$pass);
		}
	}

	/**
	 * Verify password
	 * Verfies the hashed password
	 * @param string $password Password
	 * @param string $hash Hashed Password
	 * @param string $user_id
	 * @return bool False or True
	 */
	function verify_password($password, $hash) {
		if($this->config_vars['use_password_hash']){
			return password_verify($password, $hash);
		}else{
			return ($password == $hash ? TRUE : FALSE);
		}
	}

	########################
	# Group Functions
	########################

	//tested
	/**
	 * Create group
	 * Creates a new group
	 * @param string $group_name New group name
	 * @param string $definition Description of the group
	 * @return int|bool Group id or FALSE on fail
	 */
	public function create_group($group_name, $definition = '') {

		$query = $this->CI->db->get_where($this->config_vars['groups'], ['name' => $group_name]);

		if ($query->num_rows() < 1) {

			$data = [
				'name' => $group_name,
				'definition'=> $definition
			];

			$this->CI->db->insert($this->config_vars['groups'], $data);
			return $this->CI->db->insert_id();
		}

		$this->info($this->CI->lang->line('authentication_info_group_exists'));
		return FALSE;
	}

	//tested
	/**
	 * Update group
	 * Change a groups name
	 * @param int $group_id Group id to update
	 * @param string $group_name New group name
	 * @return bool Update success/failure
	 */
	public function update_group($group_par, $group_name=FALSE, $definition=FALSE) {

		$group_id = $this->get_group_id($group_par);

		if ($group_name != FALSE) {
			$data['name'] = $group_name;
		}

		if ($definition != FALSE) {
			$data['definition'] = $definition;
		}


		$this->CI->db->where('id', $group_id);
		return $this->CI->db->update($this->config_vars['groups'], $data);
	}

	//tested
	/**
	 * Delete group
	 * Delete a group from database. WARNING Can't be undone
	 * @param int $group_id User id to delete
	 * @return bool Delete success/failure
	 */
	public function delete_group($group_par) {

		$group_id = $this->get_group_id($group_par);

		$this->CI->db->where('id',$group_id);
		$query = $this->CI->db->get($this->config_vars['groups']);
		if ($query->num_rows() == 0){
			return FALSE;
		}

		// bug fixed
		// now users are deleted from user_to_group table
		$this->CI->db->where('group_id', $group_id);
		$this->CI->db->delete($this->config_vars['user_to_group']);

		$this->CI->db->where('group_id', $group_id);
		$this->CI->db->delete($this->config_vars['perm_to_group']);

		$this->CI->db->where('group_id', $group_id);
		$this->CI->db->delete($this->config_vars['group_to_group']);

		$this->CI->db->where('subgroup_id', $group_id);
		$this->CI->db->delete($this->config_vars['group_to_group']);

		$this->CI->db->where('id', $group_id);
		return $this->CI->db->delete($this->config_vars['groups']);
	}

	//tested
	/**
	 * Add member
	 * Add a user to a group
	 * @param int $user_id User id to add to group
	 * @param int|string $group_par Group id or name to add user to
	 * @return bool Add success/failure
	 */
	public function add_member($user_id, $group_id = FALSE) {

		if( !$group_id ) {
			$this->error( $this->CI->lang->line('authentication_error_no_group') );
			return FALSE;
		}

		$query = $this->CI->db->where('user_id',$user_id);
		$query = $this->CI->db->where('group_id',$group_id);
		$query = $this->CI->db->get($this->config_vars['user_to_group']);

		if ($query->num_rows() < 1) {
			$data = [
				'user_id' => $user_id,
				'group_id' => $group_id
			];

			return $this->CI->db->insert($this->config_vars['user_to_group'], $data);
		}
		$this->info($this->CI->lang->line('authentication_info_already_member'));
		return TRUE;
	}

	//tested
	/**
	 * Add member
	 * Add a user to a group
	 * @param int $user_id User id to add to group
	 * @param int|string $group_par Group id or name to add user to
	 * @return bool Add success/failure
	 */
	public function edit_member($user_id, $data) {

		$this->CI->db->where('user_id', $user_id);
		return $this->CI->db->update($this->config_vars['user_to_group'], $data);
	}

	//tested
	/**
	 * Remove member
	 * Remove a user from a group
	 * @param int $user_id User id to remove from group
	 * @param int|string $group_par Group id or name to remove user from
	 * @return bool Remove success/failure
	 */
	public function remove_member($user_id, $group_par) {

		$group_par = $this->get_group_id($group_par);
		$this->CI->db->where('user_id', $user_id);
		$this->CI->db->where('group_id', $group_par);
		return $this->CI->db->delete($this->config_vars['user_to_group']);
	}

	/**
	 * Add subgroup
	 * Add a subgroup to a group
	 * @param int $user_id User id to add to group
	 * @param int|string $group_par Group id or name to add user to
	 * @return bool Add success/failure
	 */
	public function add_subgroup($group_par, $subgroup_par) {

		$group_id = $this->get_group_id($group_par);
		$subgroup_id = $this->get_group_id($subgroup_par);

		if( ! $group_id ) {
			$this->error( $this->CI->lang->line('authentication_error_no_group') );
			return FALSE;
		}

		if( ! $subgroup_id ) {
			$this->error( $this->CI->lang->line('authentication_error_no_subgroup') );
			return FALSE;
		}

		$query = $this->CI->db->where('group_id',$group_id);
		$query = $this->CI->db->where('subgroup_id',$subgroup_id);
		$query = $this->CI->db->get($this->config_vars['group_to_group']);

		if ($query->num_rows() < 1) {
			$data = [
				'group_id' => $group_id,
				'subgroup_id' => $subgroup_id,
			];

			return $this->CI->db->insert($this->config_vars['group_to_group'], $data);
		}
		$this->info($this->CI->lang->line('authentication_info_already_subgroup'));
		return TRUE;
	}

	/**
	 * Remove subgroup
	 * Remove a subgroup from a group
	 * @param int|string $group_par Group id or name to remove
	 * @param int|string $subgroup_par Sub-Group id or name to remove
	 * @return bool Remove success/failure
	 */
	public function remove_subgroup($group_par, $subgroup_par) {

		$group_par = $this->get_group_id($group_par);
		$subgroup_par = $this->get_group_id($subgroup_par);
		$this->CI->db->where('group_id', $group_par);
		$this->CI->db->where('subgroup_id', $subgroup_par);
		return $this->CI->db->delete($this->config_vars['group_to_group']);
	}

	//tested
	/**
	 * Remove member
	 * Remove a user from all groups
	 * @param int $user_id User id to remove from all groups
	 * @return bool Remove success/failure
	 */
	public function remove_member_from_all($user_id) {

		$this->CI->db->where('user_id', $user_id);
		return $this->CI->db->delete($this->config_vars['user_to_group']);
	}
	//tested
	/**
	 * Is member
	 * Check if current user is a member of a group
	 * @param int|string $group_par Group id or name to check
	 * @param int|bool $user_id User id, if not given current user
	 * @return bool
	 */
	public function is_member( $group_par, $user_id = FALSE ) {

		// if user_id FALSE (not given), current user
		if( ! $user_id){
			$user_id = $this->CI->session->userdata('id_a');
		}

		$group_id = $this->get_group_id($group_par);

		$query = $this->CI->db->where('user_id', $user_id);
		$query = $this->CI->db->where('group_id', $group_id);
		$query = $this->CI->db->get($this->config_vars['user_to_group']);

		$row = $query->row();

		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//tested
	/**
	 * Is admin
	 * Check if current user is a member of the admin group
	 * @param int $user_id User id to check, if it is not given checks current user
	 * @return bool
	 */
	public function is_admin( $user_id = FALSE ) {

		return $this->is_member($this->config_vars['admin_group'], $user_id);
	}


	//tested
	/**
	 * Get group name
	 * Get group name from group id
	 * @param int $group_id Group id to get
	 * @return string Group name
	 */
	public function get_group_name($group_id) {

		$query = $this->CI->db->where('id', $group_id);
		$query = $this->CI->db->get($this->config_vars['groups']);

		if ($query->num_rows() == 0)
			return FALSE;

		$row = $query->row();
		return $row->name;
	}

	//tested
	/**
	 * Get group id
	 * Get group id from group name or id ( ! Case sensitive)
	 * @param int|string $group_par Group id or name to get
	 * @return int Group id
	 */
	public function get_group_id ( $group_par ) {

		if( is_numeric($group_par) ) { return $group_par; }

		$query = $this->CI->db->where('name', $group_par);
		$query = $this->CI->db->get($this->config_vars['groups']);

		if ($query->num_rows() == 0)
			return FALSE;

		$row = $query->row();
		return $row->id;
	}

	/**
	 * Get group
	 * Get group from group name or id ( ! Case sensitive)
	 * @param int|string $group_par Group id or name to get
	 * @return int Group id
	 */
	public function get_group ( $group_par ) {
		if ($group_id = $this->get_group_id($group_par)) {
			$query = $this->CI->db->where('id', $group_id);
			$query = $this->CI->db->get($this->config_vars['groups']);

			return $query->row();
		}

		return FALSE;
	}

	/**
	 * Get group permissions
	 * Get group permissions from group name or id ( ! Case sensitive)
	 * @param int|string $group_par Group id or name to get
	 * @return int Group id
	 */
	public function get_group_perms ( $group_par ) {
		if ($group_id = $this->get_group_id($group_par)) {
			$query = $this->CI->db->select($this->config_vars['perms'].'.*');
			$query = $this->CI->db->where('group_id', $group_id);
			$query = $this->CI->db->join($this->config_vars['perms'], $this->config_vars['perms'].'.id = '.$this->config_vars['perm_to_group'].'.perm_id');
			$query = $this->CI->db->get($this->config_vars['perm_to_group']);

			return $query->result();
		}

		return FALSE;
	}

	/**
	 * Get subgroups
	 * Get subgroups from group name or id ( ! Case sensitive)
	 * @param int|string $group_par Group id or name to get
	 * @return object Array of subgroup_id's
	 */
	public function get_subgroups ( $group_par ) {

		$group_id = $this->get_group_id($group_par);

		$query = $this->CI->db->where('group_id', $group_id);
		$query = $this->CI->db->select('subgroup_id');
		$query = $this->CI->db->get($this->config_vars['group_to_group']);

		if ($query->num_rows() == 0)
			return FALSE;

		return $query->result();
	}

	########################
	# Permission Functions
	########################

	//tested
	/**
	 * Create permission
	 * Creates a new permission type
	 * @param string $perm_name New permission name
	 * @param string $definition Permission description
	 * @return int|bool Permission id or FALSE on fail
	 */
	public function create_perm($perm_name, $definition='') {

		$query = $this->CI->db->get_where($this->config_vars['perms'], ['name' => $perm_name]);

		if ($query->num_rows() < 1) {

			$data = [
				'name' => $perm_name,
				'definition'=> $definition
			];

			$this->CI->db->insert($this->config_vars['perms'], $data);
			return $this->CI->db->insert_id();
		}
		$this->info($this->CI->lang->line('authentication_info_perm_exists'));
		return FALSE;
	}

	//tested
	/**
	 * Update permission
	 * Updates permission name and description
	 * @param int|string $perm_par Permission id or permission name
	 * @param string $perm_name New permission name
	 * @param string $definition Permission description
	 * @return bool Update success/failure
	 */
	public function update_perm($perm_par, $perm_name=FALSE, $definition=FALSE) {

		$perm_id = $this->get_perm_id($perm_par);

		if ($perm_name != FALSE)
			$data['name'] = $perm_name;

		if ($definition != FALSE)
			$data['definition'] = $definition;

		$this->CI->db->where('id', $perm_id);
		return $this->CI->db->update($this->config_vars['perms'], $data);
	}

	//not ok
	/**
	 * Delete permission
	 * Delete a permission from database. WARNING Can't be undone
	 * @param int|string $perm_par Permission id or perm name to delete
	 * @return bool Delete success/failure
	 */
	public function delete_perm($perm_par) {

		$perm_id = $this->get_perm_id($perm_par);

		// deletes from perm_to_gropup table
		$this->CI->db->where('perm_id', $perm_id);
		$this->CI->db->delete($this->config_vars['perm_to_group']);

		// deletes from perm_to_user table
		$this->CI->db->where('perm_id', $perm_id);
		$this->CI->db->delete($this->config_vars['perm_to_user']);

		// deletes from permission table
		$this->CI->db->where('id', $perm_id);
		return $this->CI->db->delete($this->config_vars['perms']);
	}

	/**
	 * List Group Permissions
	 * List all permissions by Group
 	 * @param int $group_par Group id or name to check
	 * @return object Array of permissions
	 */
	public function list_group_perms($group_par) {
		if(empty($group_par)){
			return false;
		}

		$group_par = $this->get_group_id($group_par);

		$this->CI->db->select('*');
		$this->CI->db->from($this->config_vars['perms']);
		$this->CI->db->join($this->config_vars['perm_to_group'], "perm_id = ".$this->config_vars['perms'].".id");
		$this->CI->db->where($this->config_vars['perm_to_group'].'.group_id', $group_par);

		$query = $this->CI->db->get();
		if ($query->num_rows() == 0)
			return FALSE;

		return $query->result();
	}

	/**
	 * Is user allowed
	 * Check if user allowed to do specified action, admin always allowed
	 * first checks user permissions then check group permissions
	 * @param int $perm_par Permission id or name to check
	 * @param int|bool $user_id User id to check, or if FALSE checks current user
	 * @return bool
	 */
	public function is_allowed($perm_par, $user_id=FALSE){

		if($this->CI->session->userdata('totp_required')){
			$this->error($this->CI->lang->line('authentication_error_totp_verification_required'));
			redirect($this->config_vars['totp_two_step_login_redirect']);
		}

		if( $user_id == FALSE){
			$user_id = $this->CI->session->userdata('id');
		}

		if($this->is_admin($user_id))
		{
			return true;
		}

		$perm_id = $this->get_perm_id($perm_par);

		$query = $this->CI->db->where('perm_id', $perm_id);
		$query = $this->CI->db->where('user_id', $user_id);
		$query = $this->CI->db->get( $this->config_vars['perm_to_user'] );

		if( $query->num_rows() > 0){
		    return TRUE;
		} else {
			$g_allowed=FALSE;
			foreach( $this->get_user_groups($user_id) as $group ){
				if ( $this->is_group_allowed($perm_id, $group->id) ){
					$g_allowed=TRUE;
					break;
				}
			}
			return $g_allowed;
	    }
	}

	/**
	 * Is Group allowed
	 * Check if group is allowed to do specified action, admin always allowed
	 * @param int $perm_par Permission id or name to check
	 * @param int|string|bool $group_par Group id or name to check, or if FALSE checks all user groups
	 * @return bool
	 */
	public function is_group_allowed($perm_par, $group_par=FALSE){

		$perm_id = $this->get_perm_id($perm_par);

		// if group par is given
		if($group_par != FALSE){

			// if group is admin group, as admin group has access to all permissions
			if (strcasecmp($group_par, $this->config_vars['admin_group']) == 0)
			{return TRUE;}

			$subgroup_ids = $this->get_subgroups($group_par);
			$group_par = $this->get_group_id($group_par);
			$query = $this->CI->db->where('perm_id', $perm_id);
			$query = $this->CI->db->where('group_id', $group_par);
			$query = $this->CI->db->get( $this->config_vars['perm_to_group'] );

			$g_allowed=FALSE;
			if(is_array($subgroup_ids)){
				foreach ($subgroup_ids as $g ){
					if($this->is_group_allowed($perm_id, $g->subgroup_id)){
						$g_allowed=TRUE;
					}
				}
			}

			if( $query->num_rows() > 0){
				$g_allowed=TRUE;
			}
			return $g_allowed;
		}
		// if group par is not given
		// checks current user's all groups
		else {
			// if public is allowed or he is admin
			if ( $this->is_admin( $this->CI->session->userdata('id')) OR
				$this->is_group_allowed($perm_id, $this->config_vars['public_group']) )
			{return TRUE;}

			// if is not login
			if (!$this->is_loggedin()){return FALSE;}

			$group_pars = $this->get_user_groups();
			foreach ($group_pars as $g ){
				if($this->is_group_allowed($perm_id, $g->id)){
					return TRUE;
				}
			}
			return FALSE;
		}
	}

	//tested
	/**
	 * Allow User
	 * Add User to permission
	 * @param int $user_id User id to deny
	 * @param int $perm_par Permission id or name to allow
	 * @return bool Allow success/failure
	 */
	public function allow_user($user_id, $perm_par) {

		$perm_id = $this->get_perm_id($perm_par);

		if( ! $perm_id) {
			return FALSE;
		}

		$query = $this->CI->db->where('user_id',$user_id);
		$query = $this->CI->db->where('perm_id',$perm_id);
		$query = $this->CI->db->get($this->config_vars['perm_to_user']);

		// if not inserted before
		if ($query->num_rows() < 1) {

			$data = [
				'user_id' => $user_id,
				'perm_id' => $perm_id
			];

			return $this->CI->db->insert($this->config_vars['perm_to_user'], $data);
		}
		return TRUE;
	}

	//tested
	/**
	 * Deny User
	 * Remove user from permission
	 * @param int $user_id User id to deny
	 * @param int $perm_par Permission id or name to deny
	 * @return bool Deny success/failure
	 */
	public function deny_user($user_id, $perm_par) {

		$perm_id = $this->get_perm_id($perm_par);

		$this->CI->db->where('user_id', $user_id);
		$this->CI->db->where('perm_id', $perm_id);

		return $this->CI->db->delete($this->config_vars['perm_to_user']);
	}

	//tested
	/**
	 * Allow Group
	 * Add group to permission
	 * @param int|string|bool $group_par Group id or name to allow
	 * @param int $perm_par Permission id or name to allow
	 * @return bool Allow success/failure
	 */
	public function allow_group($group_par, $perm_par) {

		$perm_id = $this->get_perm_id($perm_par);

		if( ! $perm_id) {
			return FALSE;
		}

		$group_id = $this->get_group_id($group_par);

		if( ! $group_id) {
			return FALSE;
		}

		$query = $this->CI->db->where('group_id',$group_id);
		$query = $this->CI->db->where('perm_id',$perm_id);
		$query = $this->CI->db->get($this->config_vars['perm_to_group']);

		if ($query->num_rows() < 1) {

			$data = [
				'group_id' 	=> $group_id,
				'perm_id' 	=> $perm_id
			];

			return $this->CI->db->insert($this->config_vars['perm_to_group'], $data);
		}

		return TRUE;
	}

	//tested
	/**
	 * Deny Group
	 * Remove group from permission
	 * @param int|string|bool $group_par Group id or name to deny
	 * @param int $perm_par Permission id or name to deny
	 * @return bool Deny success/failure
	 */
	public function deny_group($group_par, $perm_par) {

		$perm_id = $this->get_perm_id($perm_par);
		$group_id = $this->get_group_id($group_par);

		$this->CI->db->where('group_id', $group_id);
		$this->CI->db->where('perm_id', $perm_id);

		return $this->CI->db->delete($this->config_vars['perm_to_group']);
	}

	//tested
	/**
	 * List Permissions
	 * List all permissions
	 * @return object Array of permissions
	 */
	public function list_perms() {

		$query = $this->CI->db->get($this->config_vars['perms']);
		return $query->result();
	}

	//tested
	/**
	 * Get permission id
	 * Get permission id from permisison name or id
	 * @param int|string $perm_par Permission id or name to get
	 * @return int Permission id or NULL if perm does not exist
	 */
	public function get_perm_id($perm_par) {

		if( is_numeric($perm_par) ) { return $perm_par; }

		$query = $this->CI->db->where('name', $perm_par);
		$query = $this->CI->db->get($this->config_vars['perms']);

		if ($query->num_rows() == 0)
			return FALSE;

		$row = $query->row();
		return $row->id;
	}

	/**
	 * Get permission
	 * Get permission from permisison name or id
	 * @param int|string $perm_par Permission id or name to get
	 * @return int Permission id or NULL if perm does not exist
	 */
	public function get_perm($perm_par) {
		if ($perm_id = $this->get_perm_id($perm_par)) {
			$query = $this->CI->db->where('id', $perm_id);
			$query = $this->CI->db->get($this->config_vars['perms']);

			return $query->row();
		}

		return FALSE;
	}

	########################
	# Private Message Functions
	########################

	//tested
	/**
	 * Send Private Message
	 * Send a private message to another user
	 * @param int $sender_id User id of private message sender
	 * @param int $receiver_id User id of private message receiver
	 * @param string $title Message title/subject
	 * @param string $message Message body/content
	 * @return bool Send successful/failed
	 */
	public function send_pm( $sender_id, $receiver_id, $title, $message ){

		if ( !is_numeric($receiver_id) OR $sender_id == $receiver_id ){
			$this->error($this->CI->lang->line('authentication_error_self_pm'));
			return FALSE;
		}
		if (($this->is_banned($receiver_id) || !$this->user_exist_by_id($receiver_id)) || ($sender_id && ($this->is_banned($sender_id) || !$this->user_exist_by_id($sender_id)))){
			$this->error($this->CI->lang->line('authentication_error_no_user'));
			return FALSE;
		}
		if ( !$sender_id){
			$sender_id = 0;
		}

		if ($this->config_vars['pm_encryption']){
			$title = $this->CI->encrypt->encode($title);
			$message = $this->CI->encrypt->encode($message);
		}

		$data = [
			'sender_id' 	=> $sender_id,
			'receiver_id' 	=> $receiver_id,
			'title' 		=> $title,
			'message' 		=> $message,
			'date_sent' 	=> date('Y-m-d H:i:s')
		];

		return $this->CI->db->insert( $this->config_vars['pms'], $data );
	}

	/**
	 * Send multiple Private Messages
	 * Send multiple private messages to another users
	 * @param int $sender_id User id of private message sender
	 * @param array $receiver_ids Array of User ids of private message receiver
	 * @param string $title Message title/subject
	 * @param string $message Message body/content
	 * @return array/bool Array with User ID's as key and TRUE or a specific error message OR FALSE if sender doesn't exist
	 */
	public function send_pms( $sender_id, $receiver_ids, $title, $message ){
		if ($this->config_vars['pm_encryption']){
			$title = $this->CI->encrypt->encode($title);
			$message = $this->CI->encrypt->encode($message);
		}
		if ($sender_id && ($this->is_banned($sender_id) || !$this->user_exist_by_id($sender_id))){
			$this->error($this->CI->lang->line('authentication_error_no_user'));
			return FALSE;
		}
		if ( !$sender_id){
			$sender_id = 0;
		}
		if (is_numeric($receiver_ids)) {
			$receiver_ids = [$receiver_ids];
		}

		$return_array = [];
		foreach ($receiver_ids as $receiver_id) {
			if ($sender_id == $receiver_id ){
				$return_array[$receiver_id] = $this->CI->lang->line('authentication_error_self_pm');
				continue;
			}
			if ($this->is_banned($receiver_id) || !$this->user_exist_by_id($receiver_id)){
				$return_array[$receiver_id] = $this->CI->lang->line('authentication_error_no_user');
				continue;
			}

			$data = [
				'sender_id' => $sender_id,
				'receiver_id' => $receiver_id,
				'title' => $title,
				'message' => $message,
				'date_sent' => date('Y-m-d H:i:s')
			];

			$return_array[$receiver_id] = $this->CI->db->insert( $this->config_vars['pms'], $data );
		}

		return $return_array;
	}

	//tested
	/**
	 * List Private Messages
	 * If receiver id not given retruns current user's pms, if sender_id given, it returns only pms from given sender
	 * @param int $limit Number of private messages to be returned
	 * @param int $offset Offset for private messages to be returned (for pagination)
	 * @param int $sender_id User id of private message sender
	 * @param int $receiver_id User id of private message receiver
	 * @return object Array of private messages
	 */
	public function list_pms($limit=5, $offset=0, $receiver_id=NULL, $sender_id=NULL){
		if (is_numeric($receiver_id)){
			$query = $this->CI->db->where('receiver_id', $receiver_id);
			$query = $this->CI->db->where('pm_deleted_receiver', NULL);
		}
		if (is_numeric($sender_id)){
			$query = $this->CI->db->where('sender_id', $sender_id);
			$query = $this->CI->db->where('pm_deleted_sender', NULL);
		}

		$query = $this->CI->db->order_by('id','DESC');
		$query = $this->CI->db->get( $this->config_vars['pms'], $limit, $offset);

		$result = $query->result();

		if ($this->config_vars['pm_encryption']){

			foreach ($result as $k => $r)
			{
				$result[$k]->title = $this->CI->encrypt->decode($r->title);
				$result[$k]->message = $this->CI->encrypt->decode($r->message);
			}
		}

		return $result;
	}

	//tested
	/**
	 * Get Private Message
	 * Get private message by id
	 * @param int $pm_id Private message id to be returned
	 * @param int $user_id User ID of Sender or Receiver
	 * @param bool $set_as_read Whether or not to mark message as read
	 * @return object Private message
	 */
	public function get_pm($pm_id, $user_id = NULL, $set_as_read = TRUE){
		if(!$user_id){
			$user_id = $this->CI->session->userdata('id');
		}
		if( !is_numeric($user_id) || !is_numeric($pm_id)){
			$this->error( $this->CI->lang->line('authentication_error_no_pm') );
			return FALSE;
		}

		$query = $this->CI->db->where('id', $pm_id);
		$query = $this->CI->db->group_start();
		$query = $this->CI->db->where('receiver_id', $user_id);
		$query = $this->CI->db->or_where('sender_id', $user_id);
		$query = $this->CI->db->group_end();
		$query = $this->CI->db->get( $this->config_vars['pms'] );

		if ($query->num_rows() < 1) {
			$this->error( $this->CI->lang->line('authentication_error_no_pm') );
			return FALSE;
		}

		$result = $query->row();

		if ($user_id == $result->receiver_id && $set_as_read){
			$this->set_as_read_pm($pm_id);
		}

		if ($this->config_vars['pm_encryption']){
			$result->title = $this->CI->encrypt->decode($result->title);
			$result->message = $this->CI->encrypt->decode($result->message);
		}

		return $result;
	}

	//tested
	/**
	 * Delete Private Message
	 * Delete private message by id
	 * @param int $pm_id Private message id to be deleted
	 * @return bool Delete success/failure
	 */
	public function delete_pm($pm_id, $user_id = NULL){
		if(!$user_id){
			$user_id = $this->CI->session->userdata('id');
		}
		if( !is_numeric($user_id) || !is_numeric($pm_id)){
			$this->error( $this->CI->lang->line('authentication_error_no_pm') );
			return FALSE;
		}

		$query = $this->CI->db->where('id', $pm_id);
		$query = $this->CI->db->group_start();
		$query = $this->CI->db->where('receiver_id', $user_id);
		$query = $this->CI->db->or_where('sender_id', $user_id);
		$query = $this->CI->db->group_end();
		$query = $this->CI->db->get( $this->config_vars['pms'] );
		$result = $query->row();
		if ($user_id == $result->sender_id){
			if($result->pm_deleted_receiver == 1){
				return $this->CI->db->delete( $this->config_vars['pms'], ['id' => $pm_id]);
			}

			return $this->CI->db->update( $this->config_vars['pms'], ['pm_deleted_sender' => 1], ['id' => $pm_id]);
		}else if ($user_id == $result->receiver_id){
			if($result->pm_deleted_sender == 1){
				return $this->CI->db->delete( $this->config_vars['pms'], ['id' => $pm_id]);
			}

			return $this->CI->db->update( $this->config_vars['pms'], ['pm_deleted_receiver' => 1, 'date_read' => date('Y-m-d H:i:s')], ['id' => $pm_id]);
		}
	}

	/**
	 * Cleanup PMs
	 * Removes PMs older than 'pm_cleanup_max_age' (definied in auth config).
	 * recommend for a cron job
	 */
	public function cleanup_pms(){
		$pm_cleanup_max_age = $this->config_vars['pm_cleanup_max_age'];
		$date_sent = date('Y-m-d H:i:s', strtotime("now -".$pm_cleanup_max_age));
		$this->CI->db->where('date_sent <', $date_sent);

		return $this->CI->db->delete($this->config_vars['pms']);
	}

	//tested
	/**
	 * Count unread Private Message
	 * Count number of unread private messages
	 * @param int|bool $receiver_id User id for message receiver, if FALSE returns for current user
	 * @return int Number of unread messages
	 */
	public function count_unread_pms($receiver_id=FALSE){

		if(!$receiver_id){
			$receiver_id = $this->CI->session->userdata('id');
		}

		$query = $this->CI->db->where('receiver_id', $receiver_id);
		$query = $this->CI->db->where('date_read', NULL);
		$query = $this->CI->db->where('pm_deleted_sender', NULL);
		$query = $this->CI->db->where('pm_deleted_receiver', NULL);
		$query = $this->CI->db->get( $this->config_vars['pms'] );

		return $query->num_rows();
	}

	//tested
	/**
	 * Set Private Message as read
	 * Set private message as read
	 * @param int $pm_id Private message id to mark as read
	 */
	public function set_as_read_pm($pm_id){

		$data = [
			'date_read' => date('Y-m-d H:i:s')
		];

		$this->CI->db->update( $this->config_vars['pms'], $data, "id = $pm_id");
	}

	########################
	# Error / Info Functions
	########################

	/**
	 * Error
	 * Add message to error array and set flash data
	 * @param string $message Message to add to array
	 * @param boolean $flashdata if TRUE add $message to CI flashdata (deflault: FALSE)
	 */
	public function error($message = '', $flashdata = FALSE){
		$this->errors[] = $message;
		if($flashdata)
		{
			$this->flash_errors[] = $message;
			$this->CI->session->set_flashdata('errors', $this->flash_errors);
		}
	}

	/**
	 * Keep Errors
	 *
	 * Keeps the flashdata errors for one more page refresh.  Optionally adds the default errors into the
	 * flashdata list.  This should be called last in your controller, and with care as it could continue
	 * to revive all errors and not let them expire as intended.
	 * Benefitial when using Ajax Requests
	 * @see http://ellislab.com/codeigniter/user-guide/libraries/sessions.html
	 * @param boolean $include_non_flash TRUE if it should stow basic errors as flashdata (default = FALSE)
	 */
	public function keep_errors($include_non_flash = FALSE)
	{
		// NOTE: keep_flashdata() overwrites anything new that has been added to flashdata so we are manually reviving flash data
		// $this->CI->session->keep_flashdata('errors');

		if($include_non_flash)
		{
			$this->flash_errors = array_merge($this->flash_errors, $this->errors);
		}
		$this->flash_errors = array_merge($this->flash_errors, (array)$this->CI->session->flashdata('errors'));
		$this->CI->session->set_flashdata('errors', $this->flash_errors);
	}

	//tested
	/**
	 * Get Errors Array
	 * Return array of errors
	 * @return array Array of messages, empty array if no errors
	 */
	public function get_errors_array()
	{
		return $this->errors;
	}

	/**
	 * Print Errors
	 *
	 * Prints string of errors separated by delimiter
	 * @param string $divider Separator for errors
	 */
	public function print_errors($divider = '<br />')
	{
		$msg = '';
		$msg_num = count($this->errors);
		$i = 1;
		foreach ($this->errors as $e)
		{
			$msg .= $e;

			if ($i != $msg_num)
			{
				$msg .= $divider;
			}
			$i++;
		}
		return $msg;
	}

	/**
	 * Clear Errors
	 *
	 * Removes errors from error list and clears all associated flashdata
	 */
	public function clear_errors()
	{
		$this->errors = [];
		$this->CI->session->set_flashdata('errors', $this->errors);
	}

	/**
	 * Info
	 *
	 * Add message to info array and set flash data
	 *
	 * @param string $message Message to add to infos array
	 * @param boolean $flashdata if TRUE add $message to CI flashdata (deflault: FALSE)
	 */
	public function info($message = '', $flashdata = FALSE)
	{
		$this->infos[] = $message;
		if($flashdata)
		{
			$this->flash_infos[] = $message;
			$this->CI->session->set_flashdata('infos', $this->flash_infos);
		}
	}

	/**
	 * Keep Infos
	 *
	 * Keeps the flashdata infos for one more page refresh.  Optionally adds the default infos into the
	 * flashdata list.  This should be called last in your controller, and with care as it could continue
	 * to revive all infos and not let them expire as intended.
	 * Benefitial by using Ajax Requests
	 * @see http://ellislab.com/codeigniter/user-guide/libraries/sessions.html
	 * @param boolean $include_non_flash TRUE if it should stow basic infos as flashdata (default = FALSE)
	 */
	public function keep_infos($include_non_flash = FALSE)
	{
		// NOTE: keep_flashdata() overwrites anything new that has been added to flashdata so we are manually reviving flash data
		// $this->CI->session->keep_flashdata('infos');

		if($include_non_flash)
		{
			$this->flash_infos = array_merge($this->flash_infos, $this->infos);
		}
		$this->flash_infos = array_merge($this->flash_infos, (array)$this->CI->session->flashdata('infos'));
		$this->CI->session->set_flashdata('infos', $this->flash_infos);
	}

	/**
	 * Get Info Array
	 *
	 * Return array of infos
	 * @return array Array of messages, empty array if no errors
	 */
	public function get_infos_array()
	{
            return $this->infos;
	}


	/**
	 * Print Info
	 *
	 * Print string of info separated by delimiter
	 * @param string $divider Separator for info
	 *
	 */
	public function print_infos($divider = '<br />')
	{

		$msg = '';
		$msg_num = count($this->infos);
		$i = 1;
		foreach ($this->infos as $e)
		{
			$msg .= $e;

			if ($i != $msg_num)
			{
				$msg .= $divider;
			}
			$i++;
		}
		echo $msg;
	}

	/**
	 * Clear Info List
	 *
	 * Removes info messages from info list and clears all associated flashdata
	 */
	public function clear_infos()
	{
		$this->infos = [];
		$this->CI->session->set_flashdata('infos', $this->infos);
	}

	########################
	# User Variables
	########################

	//tested
	/**
	 * Set User Variable as key value
	 * if variable not set before, it will ve set
	 * if set, overwrites the value
	 * @param string $key
	 * @param string $value
	 * @param int $user_id ; if not given current user
	 * @return bool
	 */
	public function set_user_var( $key, $value, $user_id = FALSE ){

		var_dump($key);
		var_dump($value);

		if ( ! $user_id ){
			$user_id = $this->CI->session->userdata('id');
		}

		// if specified user is not found
		if ( ! $this->get_user($user_id)){
			return FALSE;
		}

		// if var not set, set
		 if ($this->get_user_var($key,$user_id) ===FALSE) {

			$data = [
				'data_key' 	=> $key,
				'value' 	=> $value,
				'user_id' 	=> $user_id
			];

			return $this->CI->db->insert( $this->config_vars['user_variables'] , $data);
		}
		// if var already set, overwrite
		else {

			$data = [
				'data_key' 	=> $key,
				'value' 	=> $value,
				'user_id' 	=> $user_id
			];

			$this->CI->db->where('data_key', $key);
			$this->CI->db->where('user_id', $user_id);

			return $this->CI->db->update( $this->config_vars['user_variables'], $data);
		}
	}

	//tested
	/**
	 * Unset User Variable as key value
	 * @param string $key
	 * @param int $user_id ; if not given current user
	 * @return bool
	 */
	public function unset_user_var( $key, $user_id = FALSE ) {

		if ( ! $user_id ){
			$user_id = $this->CI->session->userdata('id');
		}

		// if specified user is not found
		if ( ! $this->get_user($user_id)){
			return FALSE;
		}

		$this->CI->db->where('data_key', $key);
		$this->CI->db->where('user_id', $user_id);

		return $this->CI->db->delete( $this->config_vars['user_variables'] );
	}

        //tested
	/**
	 * Unset User Variable as key value
	 * @param string $key
	 * @param int $user_id ; if not given current user
	 * @return bool
	 */
	public function remove_all_var($user_id = false )
        {
            if (!$user_id){
                $user_id = $this->CI->session->userdata('id');
            }

            // if specified user is not found
            if (!$this->get_user($user_id)){
                return FALSE;
            }

            $this->CI->db->where('user_id', $user_id);

            return $this->CI->db->delete( $this->config_vars['user_variables'] );
	}

	//tested
	/**
	 * Get User Variable by key
	 * Return string of variable value or FALSE
	 * @param string $key
	 * @param int $user_id ; if not given current user
	 * @return bool|string , FALSE if var is not set, the value of var if set
	 */
	public function get_user_var( $key, $user_id = FALSE){

		if ( ! $user_id ){
			$user_id = $this->CI->session->userdata('id');
		}

		// if specified user is not found
		if ( ! $this->get_user($user_id)){
			return FALSE;
		}

		$query = $this->CI->db->where('user_id', $user_id);
		$query = $this->CI->db->where('data_key', $key);

		$query = $this->CI->db->get( $this->config_vars['user_variables'] );

		// if variable not set
		if ($query->num_rows() < 1) { return FALSE;}

		else {

			$row = $query->row();
			return $row->value;
		}

	}


    /**
	 * Get User Variables by user id
	 * Return array with all user keys & variables
	 * @param int $user_id ; if not given current user
	 * @return bool|array , FALSE if var is not set, the value of var if set
	 */
	public function get_user_vars( $user_id = FALSE){

		if ( ! $user_id ){
			$user_id = $this->CI->session->userdata('id');
		}

		// if specified user is not found
		if ( ! $this->get_user($user_id)){
			return FALSE;
		}

		$query = $this->CI->db->select('data_key, value');

		$query = $this->CI->db->where('user_id', $user_id);

		$query = $this->CI->db->get( $this->config_vars['user_variables'] );

		return $query->result();

	}

	/**
	 * List User Variable Keys by UserID
	 * Return array of variable keys or FALSE
	 * @param int $user_id ; if not given current user
	 * @return bool|array, FALSE if no user vars, otherwise array
	 */
	public function list_user_var_keys($user_id = FALSE){

		if ( ! $user_id ){
			$user_id = $this->CI->session->userdata('id');
		}

		// if specified user is not found
		if ( ! $this->get_user($user_id)){
			return FALSE;
		}
		$query = $this->CI->db->select('data_key');

		$query = $this->CI->db->where('user_id', $user_id);

		$query = $this->CI->db->get( $this->config_vars['user_variables'] );

		// if variable not set
		if ($query->num_rows() < 1) { return FALSE;}
		else {
			return $query->result();
		}
	}

	public function generate_recaptcha_field(){
		$content = '';
		if($this->config_vars['ddos_protection'] && $this->config_vars['recaptcha_active'] && $this->get_login_attempts() >= $this->config_vars['recaptcha_login_attempts']){
			$content .= "<script type='text/javascript' src='https://www.google.com/recaptcha/api.js'></script>";
			$siteKey = $this->config_vars['recaptcha_siteKey'];
			$content .= "<div class='g-recaptcha' data-sitekey='{$siteKey}'></div>";
		}
		return $content;
	}

	public function update_user_totp_secret( $secret,$user_id = FALSE) {

		if ($user_id == FALSE)
			$user_id = $this->CI->session->userdata('id');

		$data['totp_secret'] = $secret;

		$this->CI->db->where('id', $user_id);
		return $this->CI->db->update($this->config_vars['users'], $data);
	}

	public function generate_unique_totp_secret(){
		$this->CI->load->helper('googleauthenticator');
		$ga = new PHPGangsta_GoogleAuthenticator();
		$stop = false;
		while (!$stop) {
			$secret = $ga->createSecret();
			$query = $this->CI->db->where('totp_secret', $secret);
			$query = $this->CI->db->get($this->config_vars['users']);
			if ($query->num_rows() == 0) {
				return $secret;
				$stop = true;
			}
		}
	}

	public function generate_totp_qrcode($secret){
		$this->CI->load->helper('googleauthenticator');
		$ga = new PHPGangsta_GoogleAuthenticator();
		return $ga->getQRCodeGoogleUrl($this->config_vars['name'], $secret);
	}

	public function verify_user_totp_code($totp_code, $user_id = FALSE){
		if ( !$this->is_totp_required()) {
                    return TRUE;
		}
		if ($user_id == FALSE) {
			$user_id = $this->CI->session->userdata('id');
		}
		if (empty($totp_code)) {
			$this->error($this->CI->lang->line('authentication_error_totp_code_required'));
			return FALSE;
		}
		$query = $this->CI->db->where('id', $user_id);
		$query = $this->CI->db->get($this->config_vars['users']);
		$totp_secret =  $query->row()->totp_secret;
		$this->CI->load->helper('googleauthenticator');
		$ga = new PHPGangsta_GoogleAuthenticator();
		$checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
		if (!$checkResult) {
			$this->error($this->CI->lang->line('authentication_error_totp_code_invalid'));
			return FALSE;
		}else{
			$this->CI->session->unset_userdata('totp_required');
			return TRUE;
		}
	}

	public function is_totp_required(){
		if ( !$this->CI->session->userdata('totp_required')) {
			return FALSE;
		}else if ( $this->CI->session->userdata('totp_required')) {
			return TRUE;
		}
	}

} // end class

/* End of file auth.php */
/* Location: ./application/libraries/auth.php */
