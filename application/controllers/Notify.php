<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Notify extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'User_model' );
		$this->load->model( 'Notify_model' );
		$this->load->model( 'Follow_model' );
		$this->load->helper( 'extra' );

		
	}

	public function index() {

	}

	public function view() {
		if ( $this->input->method() == 'post' ) {
			$this->data['data_type']   = (int) $this->input->post( 'data_type' );
			$this->data['data_target'] = (int) $this->input->post( 'data_target' );

			if ( $this->data['data_target'] ) {
				$this->data['notify_view'] = $this->Notify_model->fields( '*' )->filter( [ 'id' => $this->data['data_target'] ] )->one();
				$this->data['response']    = [
					'user_id'     => $this->data['notify_view']->user_id,
					'user_name'   => get_company_name( $this->data['notify_view']->user_id ),
					'send_id'     => $this->data['notify_view']->send_id,
					'send_name'   => get_company_name( $this->data['notify_view']->send_id ),
					'type'        => $this->data['notify_view']->type,
					'title'       => $this->data['notify_view']->title,
					'description' => $this->data['notify_view']->description,
					'data'        => $this->data['notify_view']->data
				];
				echo json_encode( $this->data['response'] );
			} else {
				echo json_encode( [] );
			}

		} else {
			echo json_encode( [] );
		}
	}

	public function read() {
		if ( $this->input->method() == 'post' ) {
			$id  = (int) $this->input->post( 'id' );
			$var = $this->db->set( 'status', 0, false )->where( 'id', $id )->update( 'wc_user_notify' );
			echo json_encode( [ 'st' => $var ] );
		}
	}
}
