<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Follow extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'User_model' );
		$this->load->model( 'Notify_model' );
		$this->load->model( 'Follow_model' );
		$this->load->helper( 'extra' );

		
	}

	public function index() {
		show_404();
	}

	public function follow() {
		if ( $this->data['is_loggedin'] !== false ) {
			if ( $this->input->method() == 'post' ) {

			    $user_id=$this->data['UserData']->id;
			    $company_id=$this->input->post('company_id');


				$this->data['check_follow'] = $this->Follow_model->check_follow( [
					'follower_id' => $user_id,
					'followed_company' => $company_id
				] );


				if ( ! $this->data['check_follow'] ) {

					$this->data['follow'] = $this->Follow_model->follow( [
						'follower_id' => $user_id,
						'followed_company' => $company_id
					] );

					if ( $this->data['follow'] ) {

						/*$this->data['check_notify'] = $this->Notify_model->check_notify( [
							'user_id' => $this->data['follow_id'],
							'send_id' => $this->data['my_id'],
							'status'  => 1,
							'sender'  => 1,
							'type'    => 1
						] );

						if ( $this->data['check_notify'] > 0 ) {
							$this->Notify_model->delete_notify( [
								'user_id' => $this->data['follow_id'],
								'send_id' => $this->data['my_id'],
								'status'  => 1,
								'sender'  => 1,
								'type'    => 1
							] );
						}
						$titles                    = get_company_name( $this->data['my_id'] )->company_name . " started following you.";
						$this->data['notify_data'] = [
							'user_id'     => $this->data['follow_id'],
							'send_id'     => $this->data['my_id'],
							'status'      => 1,
							'sender'      => 1,
							'type'        => 1,
							'title'       => $titles,
							'description' => "",
						];
						$this->data['send_notify'] = $this->Notify_model->send( $this->data['notify_data'] );*/
					}
				}
			}
		}
	}

	public function unfollow() {
		if ( $this->data['is_loggedin'] !== false ) {
			if ( $this->input->method() == 'post' ) {
                $user_id=$this->data['UserData']->id;
                $company_id=$this->input->post('company_id');


				$this->data['check_follow'] = $this->Follow_model->check_follow( [
					'follower_id' => $user_id,
					'followed_company' => $company_id
				] );


				if ( $this->data['check_follow'] ) {
					$this->data['unfollow'] = $this->Follow_model->unfollow( [
                        'follower_id' => $user_id,
                        'followed_company' => $company_id
					] );


					/*if ( $this->data['unfollow'] ) {
						$this->data['check_notify'] = $this->Notify_model->check_notify( [
							'user_id' => $this->data['follow_id'],
							'send_id' => $this->data['my_id'],
							'status'  => 1,
							'sender'  => 1,
							'type'    => 2
						] );
						if ( $this->data['check_notify'] > 0 ) {
							$this->Notify_model->delete_notify( [
								'user_id' => $this->data['follow_id'],
								'send_id' => $this->data['my_id'],
								'status'  => 1,
								'sender'  => 1,
								'type'    => 2
							] );
						}
						$titles                    = get_company_name( $this->data['my_id'] )->company_name . " unfollow you.";
						$this->data['notify_data'] = [
							'user_id'     => $this->data['follow_id'],
							'send_id'     => $this->data['my_id'],
							'status'      => 1,
							'sender'      => 1,
							'type'        => 2,
							'title'       => $titles,
							'description' => "",
						];
						$this->data['send_notify'] = $this->Notify_model->send( $this->data['notify_data'] );
					}*/
				}
			}
		}
	}

	public function followers() {
		if ( $this->input->method() == 'post' ) {
			$this->data['followers_id'] = [];
			$this->data['user_id']      = $this->input->post( 'user_id' );
			$this->data['followers']    = $this->Follow_model->fields( 'follower_id' )->filter( [ 'followed_user' => $this->data['user_id'] ] )->all();
			if ( $this->data['followers'] ) {
				foreach ( $this->data['followers'] as $value ) {
					$this->data['followers_id'][] = $value->follower_id;
				}
				$in                      = implode( ",", $this->data['followers_id'] );
				$this->data['user_list'] = $this->User_model->fields( [
					'id',
					'slug',
					'company_name',
					'fullname',
					'images',
					'adress',
					'website'
				] )->filter( [ "id IN ($in)" => null ] )->all();
				echo json_encode( $this->data['user_list'] );
			} else {
				echo json_encode( [] );
			}
		} else {
			echo json_encode( [] );
		}
	}

	public function following() {
		if ( $this->input->method() == 'post' ) {
			$this->data['following_id'] = [];
			$this->data['user_id']      = $this->input->post( 'user_id' );
			$this->data['following']    = $this->Follow_model->fields( 'followed_user' )->filter( [ 'follower_id' => $this->data['user_id'] ] )->all();
			if ( $this->data['following'] ) {
				foreach ( $this->data['following'] as $value ) {
					$this->data['following_id'][] = $value->followed_user;
				}
				$in                      = implode( ",", $this->data['following_id'] );
				$this->data['user_list'] = $this->User_model->fields( [
					'id',
					'slug',
					'company_name',
					'fullname',
					'images',
					'adress',
					'website'
				] )->filter( [ "id IN ($in)" => null ] )->all();
				echo json_encode( $this->data['user_list'] );
			} else {
				echo json_encode( [] );
			}
		} else {
			echo json_encode( [] );
		}
	}


}
