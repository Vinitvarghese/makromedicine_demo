<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Messages extends Site_Controller {
	public function __construct() {
		parent::__construct();
		if ( $this->data['is_loggedin'] ) {
			$this->load->model( 'User_model' );
			$this->load->model( 'Messages_model' );
			$this->load->helper( 'messages' );
		} else {
			redirect( site_url_multi( '/' ), 'refresh' );
		}

		
	}

	public function index( $user_id = null ) {
		if ( $user_id != null ) {
			$this->data['sentto']             = $user_id;
			$this->data['sentby']             = $this->data['user']['id'];
			$this->data['check_conversation'] = $this->Messages_model->check_conversation( $this->data['sentby'], $this->data['sentto'] );
			if ( $this->data['check_conversation'] == false ) {
				$this->data['create_date']         = [
					'user_one' => $this->data['sentby'],
					'user_two' => $this->data['sentto'],
					'ip'       => $_SERVER['REMOTE_ADDR'],
					'time'     => time()
				];
				$this->data['create_conversation'] = $this->Messages_model->create_conversation( $this->data['create_date'] );
				$this->data['c_id']                = $this->data['create_conversation'];
			} else {
				$this->data['c_id'] = $this->data['check_conversation'][0]['c_id'];
			}
			$this->data['messages'] = $this->Messages_model->messages( $this->data['sentby'] );


			$this->data['title']    = translate( 'title' );
			$this->template->render( 'messages/messages' );
		}
	}

	public function sendMessage() {
		if ( $this->input->method() == 'post' ) {
			$this->data['sentby']   = $this->input->post( 'sentby' );
			$this->data['sentto']   = $this->input->post( 'sentto' );
			$this->data['messages'] = $this->input->post( 'messages' );
			$this->data['c_id']     = $this->input->post( 'c_id' );

			$this->data['messages_data'] = [
				'c_id_fk'     => $this->data['c_id'],
				'user_id_fk'  => $this->data['sentby'],
				'user_id_fk2' => $this->data['sentto'],
				'reply'       => $this->data['messages'],
				'ip'          => $_SERVER['REMOTE_ADDR'],
				'time'        => time()
			];

			$this->data['addMessage'] = $this->Messages_model->addMessage( $this->data['messages_data'] );
			echo json_encode( $this->input->post() );
		}
	}

	public function getMessage() {
		if ( $this->input->method() == 'post' ) {
			$this->data['limit']        = $this->input->post( 'limit' );
			$this->data['c_id']         = $this->input->post( 'c_id' );
			$this->data['get_messages'] = $this->Messages_model->getMessage( $this->data['c_id'], $this->data['limit'] );
			echo json_encode( $this->data['get_messages'] );
		}
	}
}
