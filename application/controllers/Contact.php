<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Contact extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library( "phpmailer_library" );

		

	}

	public function index() {
		$this->data['title']            = translate( 'title' ) . ' | Makromedicine.com';
		$this->data['meta_title']       = translate( 'title' ) . ' | Makromedicine.com';
		$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
		$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
		$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
		$this->form_validation->set_rules( 'fullname', translate( 'form_name' ), 'required' );
		$this->form_validation->set_rules( 'email', translate( 'form_email' ), 'required|valid_email' );
		$this->form_validation->set_rules( 'message', translate( 'form_message' ), 'required' );
		$this->form_validation->set_rules( 'g-recaptcha-response', 'G-Recaptcha', 'required' );

		$settings               = new stdClass();
		$settings->cpt_pub_key  = '6LdXR5wUAAAAAGSyyEUUV2C4lGUwoxe0rQo66pMa';
		$this->data['settings'] = $settings;

		if ( $this->input->method() == 'post' ) {
			if ( $this->form_validation->run() == true ) {
				$mail = $this->phpmailer_library->load();
				$mail->isSMTP();
				// $mail->SMTPDebug = 2;
				$mail->Host        = 'smtp.yandex.com';
				$mail->SMTPAuth    = true;
				$mail->Username    = 'support@makromedicine.com';
				$mail->Password    = '72880105m';
				$mail->SMTPSecure  = 'tls';
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer'       => false,
						'verify_peer_name'  => false,
						'allow_self_signed' => true
					)
				);
				$mail->Port        = 587;

				//Recipients
				$mail->setFrom( 'support@makromedicine.com', 'Contact Form' );
				$mail->addAddress( 'support@makromedicine.com' );
				$mail->addReplyTo( $this->input->post( 'email' ), $this->input->post( 'name' ) );

				// Content
				$mail->isHTML( true );
				$mail->Subject = $this->data['title'];
				$mail->Body    = $this->input->post( 'message' );

				if ( $mail->send() ) {
					$this->data['success_message'] = '<div class="alert alert-success" data-closable="">Thank you! Your message has been sent.</div>';
				} else {
					$this->data['error_message'] = validation_errors();

				}

				//redirect(site_url_multi('contact'));
			} else {
				$this->data['error_message'] = validation_errors();

			}
		}
		$this->template->render( 'contact' );
	}

}
