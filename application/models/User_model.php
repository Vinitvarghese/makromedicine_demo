<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class User_model extends Webcoder_Model {

	public $table = 'users';
	public $primary_key = 'id';
	public $protected = [];

	// Data tables
	var $column_order = array( null, 'company_name' );
	var $column_search = array( 'company_name' );
	var $table_order = array( 'id' => 'asc' );

	public $relation_tables = [
		[
			'name'   => 'user_variables',
			'column' => 'user_id'
		]
	];

	public function __construct() {
		parent::__construct();
	}

	public function get_user_group($where, $select = '*' ) {
		$this->db->select( $select );
		$this->db->from( 'wc_user_to_group' );

		$this->db->where( $where );
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function get_company_details() {

		$this->_get_query();
		$this->_searchWhereQuery();

		//$this->db->where_not_in('user_groups_id', [1, 6]);

		if ( isset( $_POST['length'] ) && $_POST['length'] < 1 ) {
			$_POST['length'] = '10';
		} else {
			$_POST['length'] = $_POST['length'];
		}

		if ( isset( $_POST['start'] ) && $_POST['start'] > 1 ) {
			$_POST['start'] = $_POST['start'];
		}
		/*$this->db->limit( $_POST['length'], $_POST['start'] );
		$query = $this->db->get();*/


        $this->db->limit( $_POST['length'], $_POST['start'] );
        $this->db->group_by("wc_companies.id");
        $this->db->order_by("wc_companies.created_at", "DESC");
        $query = $this->db->get();



		return $query->result();
	}

	private function _searchWhereQuery() {


		foreach ( $_POST['search'] as $search_column => $search_value ) {
			if ( $search_column !== 'value' && $search_column !== 'regex' ) {

				if($search_column=='company_ids'){
                    $this->db->where_in("wc_companies.id", $search_value );

                }else if($search_column=="country_id"){

                    if ( is_array( $search_value ) && !empty($search_value) ) {
                        $this->db->where_in("wc_companies.".$search_column, $search_value );
                    } else if (trim($search_value, " \t\n\r\0") !== '') {
                        $this->db->where( "wc_companies.".$search_column, $search_value );
                    }

                }else if($search_column=="continent_id"){

                    $this->db->where('wc_companies.country_id IN (select wc_country.id from wc_country where wc_country.continent_id IN("' . implode(',', $search_value) . '") )');

                    //$cont_filter .= 'product.country IN (select id from wc_country where continent_id="' . $continent_val . '") OR ';

                    /*if ( is_array( $search_value ) && !empty($search_value) ) {
                        $this->db->where_in("wc_companies.".$search_column, $search_value );
                    } else if (trim($search_value, " \t\n\r\0") !== '') {
                        $this->db->where( "wc_companies.".$search_column, $search_value );
                    }*/

                }else if ( $search_column !== 'product_type' && $search_column !== 'standart') {
					if ( is_array( $search_value ) && !empty($search_value) ) {
						$this->db->where_in( $search_column, $search_value );
					} else if (trim($search_value, " \t\n\r\0") !== '') {
						$this->db->where( $search_column, $search_value );
					}
				}else {
					if ( is_array( $search_value ) && !empty($search_value) ) {
						foreach ($search_value as $single_search_value) {
							$this->db->like( $search_column, $single_search_value );
						}
					} else if (trim($search_value, " \t\n\r\0") !== '') {
						$this->db->like( $search_column, $search_value );
					}
				}
			}
		}
	}

	private function _get_query() {
		//$this->db->from( $this->table );

        $this->db->select('wc_companies.*, wc_companies.id AS company_id, wc_users.*, wc_company_user_rel.role_id AS position');
        $this->db->from('wc_users');

        $this->db->join('wc_company_user_rel', 'wc_company_user_rel.user_id = wc_users.id AND wc_company_user_rel.approved=1  AND wc_company_user_rel.delete_at IS NULL', 'left');
        $this->db->join('wc_companies', 'wc_companies.id = wc_company_user_rel.company_id', 'left');
		$this->db->join('wc_industry AS in', 'in.id = wc_companies.industry_id AND in.create_company=1', 'inner');
        $this->db->where_in('wc_users.user_groups_id', [2,3,4,5]);




		$i = 0;
		foreach ( $this->column_search as $user ) // loop column
		{



			if ( isset( $_POST['search']['value'] ) && ! empty( $_POST['search']['value'] ) ) {
				$_POST['search']['value'] = $_POST['search']['value'];
			} else {
				$_POST['search']['value'] = '';
			}
			if ( $_POST['search']['value'] ) // if datatable send POST for search
			{
				if ( $i === 0 ) // first loop
				{
					$this->db->group_start();
					$this->db->like( $user, $_POST['search']['value'] );
				} else {
					$this->db->or_like( $user, $_POST['search']['value'] );
				}

				if ( count( $this->column_search ) - 1 == $i ) //last loop
				{
					$this->db->group_end();
				} //close bracket
			}
			$i ++;
		}

		if ( isset( $_POST['order'] ) ) // here order processing
		{
			$this->db->order_by( $this->column_order[ $_POST['order']['0']['column'] ], $_POST['order']['0']['dir'] );
		} else if ( isset( $this->order ) ) {
			$order = $this->order;
			$this->db->order_by( key( $order ), $order[ key( $order ) ] );
		}
	}

	public function get_company_details_count_filtered() {
		$this->_get_query();
		$this->_searchWhereQuery();
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function get_company_details_count_all() {
		$this->db->from( $this->table );

		return $this->db->count_all_results();
	}

	public function insert_user_to_group( $data ) {
		$this->db->insert( 'wc_user_to_group', $data );
	}

	public function insert_certificate( $data ) {
		$this->db->insert( 'wc_confirm_account', $data );

		return $this->db->insert_id();
	}

	public function delete_certificate( $user_id, $company_id ) {
		$this->db->delete( 'wc_confirm_account', array( 'user_id' => $user_id, 'company_id' =>$company_id  ) );

		return true;
	}

	public function save_fcm( $id, $data ) {
		$this->db->where( 'id', $id );

		return $this->db->update( 'wc_users', $data );
	}

	public function update_group( $id, $data ) {
		$this->db->where( 'user_id', $id );

		return $this->db->update( 'wc_user_to_group', $data );
	}

	public function deleteStandart( $user_id ) {
		$this->db->where( 'user_id', $user_id );

		return $this->db->delete( 'wc_user_standart_image' );
	}

    public function deleteStandart2( $user_id, $standart_ids ) {
        if (isset($user_id) && !empty($user_id) && isset($standart_ids) && !empty($standart_ids)){
            $this->db->where( 'user_id', $user_id );
            $this->db->where_not_in( 'standart_id', $standart_ids );

            $status= $this->db->delete( 'wc_user_standart_image' );
        }
    }

	public function delete_interests( $user_id, $company_id ) {
		$this->db->where( ['user_id' => $user_id, 'company_id' => $company_id] );

		return $this->db->delete( 'wc_user_interests' );
	}

	public function delete_interest( $id ) {
		$this->db->where( 'id', $id );

		return $this->db->delete( 'wc_user_interests' );
	}

	public function delete_any( $table, $where ) {
		$this->db->where( $where );

		return $this->db->delete( $table );
	}

	public function insert_any( $table, $data ) {
		return $this->db->insert( $table, $data );
	}

	public function select_any( $table, $where, $select = '*', $order = false ) {
		$this->db->select( $select );

		$this->db->from( $table );

		$this->db->where( $where );

		if ( $order != false ) {
			$this->db->order_by( $order, "ASC" );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function delete_ntf( $user_id ) {
		$this->db->where( 'user_id', $user_id );

		return $this->db->delete( 'wc_user_settings' );
	}

	public function delete_standart( $array ) {
		$this->db->where( $array );

		 $this->db->delete( 'wc_user_standart_image' );

		 $st_ids=$this->get_standart( [ 'user_id' => $array['user_id']],'*');
		 $ids=[];

		 if(!empty($st_ids)){
		     foreach ($st_ids as $id){
		         $ids[]=$id['standart_id'];
             }
         }

        $up_data=[
            'standart' => implode(',', $ids)
        ];

        $this->db->where( 'id', $array['user_id'] );
        return $this->db->update( 'wc_users', $up_data );

	}

	public function insertStandart( $data ) {
		return $this->db->insert( 'wc_user_standart_image', $data );
	}

	public function get_standart($where, $select = '*') {
		$this->db->select( $select );
		$this->db->from( 'wc_user_standart_image' );
		$this->db->join( 'wc_standart_translation', 'wc_standart_translation.standart_id=wc_user_standart_image.standart_id' );

		$this->db->where( $where );
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {

			$return_data = $query->result_array();
			foreach ( $return_data as $key => $value ) {
				$return_data[ $key ]['isPdf'] = ( strpos( $value['name'], 'pdf' ) !== false ) ? true : false;
			}

			return $return_data;
		}

		return false;
	}

	public function getLastUser() {
		$this->db->select( [ '*' ] );
		$this->db->from( 'wc_site_user' );

		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function get_your_interests( $select, $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_user_interests' );

		$this->db->where( $where );
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function account_settings( $select, $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_user_settings' );

		$this->db->where( $where );
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function insert_user( $data ) {
		$this->db->insert( 'wc_users', $data );

		return $this->db->insert_id();
	}

	public function insert_interests( $data ) {
		$this->db->insert( 'wc_user_interests', $data );

		return $this->db->insert_id();
	}

	public function insert_ntf_settings( $data ) {
		$this->db->insert( 'wc_user_settings', $data );

		return $this->db->insert_id();
	}

	public function insert_send_email_to_database( $data = [] ) {
		$this->db->insert( 'wc_emailsender', $data );

		return $this->db->insert_id();
	}

	public function getPersonType($id, $lang_id=1){
        $this->db->select("name");
        $this->db->from('wc_person_type_translation');
        $this->db->where(['person_type_id' => $id, 'language_id' => $lang_id]);
        $query = $this->db->get();
        $data=$query->row();

        return $data->name;
    }

    public function getUserIdByEmail($email){
        $this->db->select("id");
        $this->db->from('wc_users');
        $this->db->where(['email' => $email]);
        $query = $this->db->get();

        return ($query->num_rows() == 1) ? $query->row() : false;
    }

	public function checkUser($email, $data){
        $check=$this->getUserIdByEmail($email);

        $return_data=[];

        if ( !$check ) {
            //register user
            $this->load->library('Auth');

            $password=rand(111111, 999999);

            $pass = $this->auth->hash_password($password, 0);

            $this->db->insert('wc_users', [
                'fullname' => $data['fullname'],
                'email' => $email,
                'country_code' => $data['code'],
                'phone' => $data['phone'],
                'phone_type' => $data['phone_type'],
                'ext' => $data['ext'],
                'pass' => $pass,
                'user_groups_id' => 6,
                'login_type' => 1,
                'slug_user' => generateSeoURL($data['fullname'])
            ]);

            $user_id=$this->db->insert_id();

            /**/
            $this->db->insert('wc_company_user_rel', [
                'company_id' => $data['company_id'],
                'user_id' => $user_id,
				'role_id' => 4,
				'position_id' => $data['position_id']
            ]);

            /**/
            $array = [
                'user_id'           => $user_id,
                'ntf_comp_email'    => 0,
                'ntf_comp_sms'      => 0,
                'ntf_cert_email'    => 0,
                'ntf_cert_sms'      => 0,
                'ntf_pass_email'    => 0,
                'ntf_pass_sms'      => 0
            ];
            $insert_ntf_settings = $this->insert_ntf_settings($array);

            $return_data=[
                'is_new' => true,
                'user_id' => $user_id,
                'first_apply' => true,
                'change_position' => false
            ];


        }else{
            //update
            $user_id=$check->id;

            /**/
            $this->db->where(['id' => $user_id]);
            $this->db->update('wc_users', [
                'fullname' => $data['fullname'],
                'country_code' => $data['code'],
                'phone' => $data['phone'],
                'phone_type' => $data['phone_type'],
                'ext' => $data['ext'],
                'slug_user' => generateSeoURL($data['fullname'])
            ]);

            $first_apply=false;
            $change_position=false;


            /**/
            $this->db->select("id, role_id, position_id");
            $this->db->from('wc_company_user_rel');
            $this->db->where(['user_id' => $user_id, 'company_id' => $data['company_id']]);
            $query2 = $this->db->get();
            $rel_data=$query2->row();

            if($query2->num_rows() == 0){

                $first_apply=true;

                $this->db->insert('wc_company_user_rel', [
                    'company_id' => $data['company_id'],
                    'user_id' => $user_id,
					'role_id' => 4,
					'position_id' => $data['position_id']
                ]);

            }else{
                $this->db->where(['company_id' => $data['company_id'], 'user_id' => $user_id]);
                $this->db->update('wc_company_user_rel', [
					'position_id' => $data['position_id']
                ]);


                if ($rel_data->position_id!=$data['position_id']){
                    $change_position=true;
                }
            }

            $return_data=[
                'is_new' => false,
                'user_id' =>$user_id,
                'first_apply' => $first_apply,
                'change_position' => $change_position
            ];
        }

        /**/
        if($return_data['first_apply']){
            $mail = $this->phpmailer_library->load();

            //Server settings
            // $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.yandex.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'support@makromedicine.com';
            $mail->Password   = '72880105m';
            $mail->SMTPSecure = 'tls';
            $mail->SMTPOptions = array (
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true)
            );
            $mail->Port       =587;

            $verification_code = $this->auth->generate_verification_code($email);

            $message  = "<h1>Hi ".$data['fullname']."</h1>";
            $message .= "<h2>Thanks for registration at <a href=\"".site_url_multi('/')."\">makromedicine.com</a> </h2>";

            if ($return_data['change_position']){
                $message .= "<p><q>".$_SESSION['fullname']."</q> change your position at <a href='".site_url_multi('/')."companies/".$data['company_url']."'>".$data['company_name']."</a> as <q>".$data['position_name']."</q></p>";

            }else{
                $message .= "<p><q>".$_SESSION['fullname']."</q> registered you at <a href='".site_url_multi('/')."companies/".$data['company_url']."'>".$data['company_name']."</a> as <q>".$data['position_name']."</q></p>";
            }

            if($return_data['is_new']){
                $message .= "<p>Email: ".$email."</p>";
                $message .= "<p>Temporary password: ".$password."</p>";
                $message .= "<p>You have been successfully registrated. </p>";
                $message .= "<p>Please confirm your account from <a href='".base_url('authentication/confirm/').$verification_code."'>here</a></p>";
            }

            $mail->setFrom('support@makromedicine.com','Makromedicine');
            $mail->addAddress($email);
            $mail->addReplyTo('support@makromedicine.com');

            // Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = ($return_data['is_new']) ? 'Confirm your account' : 'Account updated';
            $mail->Body    = $message;

            $mail->send();

            /**/

            $mail2 = $this->phpmailer_library->load();

            //Server settings
            // $mail->SMTPDebug = 2;
            $mail2->isSMTP();
            $mail2->Host       = 'smtp.yandex.com';
            $mail2->SMTPAuth   = true;
            $mail2->Username   = 'support@makromedicine.com';
            $mail2->Password   = '72880105m';
            $mail2->SMTPSecure = 'ssl';
            $mail2->SMTPOptions = array (
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true)
            );
            $mail2->Port       =465;

            //Recipients
            $mail2->setFrom('support@makromedicine.com');
            $mail2->addAddress('support@makromedicine.com');

            // Content
            $mail2->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail2->Subject = 'New Account Registered';
            $mail2->Body    = 'New Account Created: '.$data['fullname'];

            $mail2->send();
        }

        return $return_data;
    }

    public function deleteUserFromCompany($company_id, $email){
        $check=$this->getUserIdByEmail($email);

        $this->db->where( [ 'user_id' => $check->id, 'company_id' => $company_id] );

        return $this->db->delete( 'wc_company_user_rel' );

    }

}
