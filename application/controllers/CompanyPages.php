<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class CompanyPages extends Site_Controller {
	public function __construct() {
		parent::__construct();
		
		if ( $this->data['is_loggedin'] ) {
			$this->load->library( 'Auth' );
			$this->load->model( 'Tags_model' );
			$this->load->model( 'User_model' );
			$this->load->model( 'CompanyPage_model' );
			$this->load->model( 'Group_model' );
			$this->load->model( 'Country_model' );
			$this->load->model( 'Standart_model' );
			$this->load->model( 'Phone_type_model' );
			$this->load->model( 'Person_type_model' );
			$this->load->model( 'Product_type_model' );
			$this->load->model( 'Follow_model' );
			$this->load->helper( 'extra' );
			$this->load->library( "phpmailer_library" );


			


			if ( isset( $this->data['UserData']->product_type ) && ! empty( $this->data['UserData']->product_type ) && $this->data['UserData']->product_type != null ) {
				$this->data['selected_product_type']       = json_decode( $this->data['UserData']->product_type );
				$this->data['selected_product_type_names'] = array();
				if ( ! empty( $this->data['selected_product_type'] ) && is_array( $this->data['selected_product_type'] ) ) {
					foreach ( $this->data['selected_product_type'] as $key => $value ) {
						$name = $this->Product_type_model->fields( [ 'name' ] )->filter( [ 'id' => $value ] )->with_translation()->one();
						if ( $name && $name->name != '' ) {
							$this->data['selected_product_type_names'][] = $name->name;
						}
					}
				}
				$this->data['selected_product_type_names'] = implode( ', ', $this->data['selected_product_type_names'] );
			} else {
				$this->data['selected_product_type'][0]    = '';
				$this->data['selected_product_type_names'] = '';
			}


			if ( isset( $this->data['UserData']->standart ) && ! empty( $this->data['UserData']->standart ) && $this->data['UserData']->standart != null ) {
				$this->data['selected_standart'] = explode( ',', $this->data['UserData']->standart );
			} else {
				$this->data['selected_standart'][0] = '';
			}

			$cert = $this->db->select( 'image' )->where( 'user_id', $this->data['UserData']->id )->get( 'wc_confirm_account' )->result();
			if ( is_array( $cert ) && isset( $cert[0]->image ) ) {
				$this->data['UserData']->certificate = $cert[0]->image;
			}


			$this->data['get_standart'] = $this->User_model->get_standart([ 'user_id' => $this->data['user']['id'] ], 'wc_standart_translation.name st_name ,wc_user_standart_image.*');


			$this->data['get_user_group'] = $this->User_model->get_user_group([ 'user_id' => $this->data['user']['id'] ], '*' );
			if ( $this->data['get_user_group'] != false ) {
				foreach ( $this->data['get_user_group'] as $key => $value ) {
					$this->data['user']['group_id'] = $value['group_id'];
				}
			}
			$this->data['UserGroup'] = $this->Group_model->fields( [
				'id',
				'name'
			] )->filter( [ 'id' => $this->data['user']['group_id'] ] )->one();

			/* TAGS */
			if ( isset( $this->data['UserData']->tags ) && ! empty( $this->data['UserData']->tags ) ) {
				$this->data['tags'] = $this->data['UserData']->tags;
			} else {
				$this->data['tags'] = '';
			}
			$this->data['general_tags']       = $this->Tags_model->fields( [
				'id',
				'name'
			] )->with_translation()->all();
			$this->data['general_tags_inner'] = [];
			if ( $this->data['general_tags'] != false ) {
				foreach ( $this->data['general_tags'] as $tags ) {
					$this->data['general_tags_inner'][] = [
						'value' => $tags->id,
						'name'  => $tags->name
					];
				}
			}


			$this->data['tag_maps']       = json_encode( $this->data['general_tags_inner'], true );
			$this->data['person_info']    = json_decode( $this->auth->get_user_var( 'person' ) );

            $user = $this->data['UserData'];

            if (isset($user->company_id)){
                $company_id=$user->company_id;

                $this->data['company_info']   = $this->User_model->getCompanyPeople($company_id);
				$this->data['get_product_status'] =  $this->User_model->getProductStatus($company_id);
				

            }



			$this->data['user_following'] = $this->Follow_model->fields( [ 'count(*) as count' ] )->filter( [ 'follower_id' => $this->data['UserData']->id ] )->one()->count;
			$this->data['user_followers'] = $this->Follow_model->fields( [ 'count(*) as count' ] )->filter( [ 'followed_user' => $this->data['UserData']->id ] )->one()->count;



            
            $this->data['company']= $this->data['UserData'];


		} else {
			redirect( site_url_multi( '/' ), 'refresh' );
		}
	}

	public function index() {
		$this->data['title']       = translate( 'title' );
		$this->data['active_menu'] = 1;
		$this->data['new_page'] = 1;
        $this->data['phone_type']   = $this->Phone_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();
        $this->data['person_type']  = $this->Person_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();




		$this->template->render( 'company/profile' );
	}

	public function viewPage() {
		$this->data['title']       = translate( 'title' );
		$this->data['active_menu'] = 1;
		$this->data['new_page'] = 1;

		$this->data['phone_type']   = $this->Phone_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		$this->data['person_type']  = $this->Person_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();




		$this->template->render( 'company/profile' );
	}

	public function settings() {
		$this->data['active_menu']  = 5;
		$this->data['new_page'] = 1;
		$this->data['title']        = translate( 'title' );
		$this->data['countrys']     = $this->Country_model->fields( [
			'id',
			'name',
			'code'
		] )->with_translation()->all();
		$this->data['product_type'] = $this->Product_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		$this->data['standarts']    = $this->Standart_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		$this->data['phone_type']   = $this->Phone_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		$this->data['person_type']  = $this->Person_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();

		/* $check_group_type = ($this->uri->segment('4') == 'interests'|| $this->uri->segment('3') == 'create-page') ? 2 : 1;
		$this->data['groups']       = $this->Group_model->fields( [ 'id', 'name' ] )->filter(['type' => $check_group_type])->all();
		 */$this->data['get_standart'] = $this->User_model->get_standart([ 'user_id' => $this->data['user']['id'] ], 'wc_standart_translation.name st_name ,wc_user_standart_image.*');

		$this->data['title'] = translate( 'title_settings' );
		$this->template->render( 'company/settings' );
	}

	public function editPage() {
        $user = $this->data['UserData'];

		$this->data['active_menu']  = 8;
		$this->data['new_page'] = 1;
		$this->data['title']        = translate( 'title' );
		$this->data['countrys']     = $this->Country_model->fields( [
			'id',
			'name',
			'code'
		] )->with_translation()->all();
		$this->data['product_type'] = $this->Product_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		$this->data['standarts']    = $this->Standart_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		$this->data['phone_type']   = $this->Phone_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		$this->data['person_type']  = $this->Person_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();

		/* $check_group_type = ($this->uri->segment('4') == 'interests') ? 2 : 1;
		$this->data['groups']           = $this->Group_model->fields(['id', 'name'])->filter(['type' => $check_group_type])->all();
		 */$this->data['get_standart'] = $this->User_model->get_standart([ 'user_id' => $user->id ], 'wc_standart_translation.name st_name, wc_user_standart_image.*' );

		$this->data['title'] = translate( 'title_settings' );


		$this->template->render( 'company/edit' );
	}


	public function save() {

		if ( $this->input->method() == 'post' ) {

			if ( isset( $_FILES['userfile'] ) && count( $_FILES['userfile']['name'] ) > 0 ) {
				$directory               = DIR_IMAGE . 'catalog/standart';
				$config                  = array();
				$config['upload_path']   = $directory;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$config['overwrite']     = false;

				$this->load->library( 'upload' );

				$files = $_FILES;
				$total = count( $files['userfile']['name'] );
				unset( $_FILES );
				// $this->User_model->deleteStandart($this->data['user']['id']);
				foreach ( $files['userfile']['name'] as $i => $value ) {
					$_FILES['userfile']['name']     = $files['userfile']['name'][ $i ];
					$_FILES['userfile']['type']     = $files['userfile']['type'][ $i ];
					$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][ $i ];
					$_FILES['userfile']['error']    = $files['userfile']['error'][ $i ];
					$_FILES['userfile']['size']     = $files['userfile']['size'][ $i ];

					$this->upload->initialize( $config );

					if ( ! $this->upload->do_upload( 'userfile' ) ) {
						$json['error'] = $this->upload->display_errors();
					} else {
						$this->User_model->insertStandart( [
							'user_id'     => $this->data['user']['id'],
							'standart_id' => $i,
							'name'        => $files['userfile']['name'][ $i ]
						] );
					}
				}
			}

			$this->data['user_groups_id']     = $this->input->post( 'group_id' );
			$this->data['status']             = $this->input->post( 'status' );
			$this->data['establishment_date'] = $this->input->post( 'establishment_date' );
			$this->data['tags']               = $this->input->post( 'tags' );
			$this->data['company_info']       = $this->input->post( 'company_info' );
			$this->data['standart']           = $this->input->post( 'standart' );
			$this->data['email']              = $this->input->post( 'email' );
			$this->data['product_type']       = $this->input->post( 'product_type' );
			$this->data['country_id']         = $this->input->post( 'country_id' );
			$this->data['address']            = $this->input->post( 'address' );
			$this->data['website']            = $this->input->post( 'website' );
			$this->data['facebook']           = $this->input->post( 'facebook' );
			$this->data['youtube']            = $this->input->post( 'youtube' );
			$this->data['twitter']            = $this->input->post( 'twitter' );
			$this->data['linkedin']           = $this->input->post( 'linkedin' );
			$this->data['lat']                = $this->input->post( 'lat' );
			$this->data['lng']                = $this->input->post( 'lng' );

			if ( is_null( $this->data['standart'] ) ) {
				$this->data['standart'] = array();
			}
			$standart_images     = $this->User_model->get_standart([ 'user_id' => $this->data['user']['id'] ], 'wc_standart_translation.name st_name ,wc_user_standart_image.*');
			$standart_images_ids = array();
			if ( $standart_images ) {
				foreach ( $standart_images as $key => $value ) {
					$standart_images_ids[] = $value['standart_id'];
				}
			}
			if ( isset( $this->data['standart'] ) && $this->data['standart'] !== false ) {
				foreach ( $this->data['standart'] as $key => $value ) {
					if ( ! in_array( $value, $standart_images_ids ) ) {
						unset( $this->data['standart'][ $key ] );
					}
				}
			}

			//UPDATE USER GROUP
			$this->data['group_id'] = $this->input->post( 'group_id' );
			$update_group           = $this->User_model->update_group( $this->data['user']['id'], [ 'group_id' => $this->data['group_id'] ] );

			if ( $update_group ) {
				if ( isset( $this->data['tags'][0] ) ) {
					$tags = $this->data['tags'][0];
				} else {
					$tags = '';
				}
				$standarts = implode( ',', $this->data['standart'] );

				$array = array(
					'user_groups_id' => $this->data['group_id'],
					'country_id'     => $this->data['country_id'],
					'product_type'   => json_encode( $this->data['product_type'] ),
					'tags'           => $tags,
					'adress'         => $this->data['address'],
					'website'        => $this->data['website'],
					'standart'       => $standarts,
					'facebook'       => $this->data['facebook'],
					'twitter'        => $this->data['twitter'],
					'youtube'        => $this->data['youtube'],
					'linkedin'       => $this->data['linkedin'],
					'lat'            => $this->data['lat'],
					'lng'            => $this->data['lng']
				);

				if ( $this->input->post( 'fullname' ) != null ) {
					$this->data['fullname'] = $this->input->post( 'fullname' );
					$array['fullname']      = $this->data['fullname'];
					$array['slug']          = generateSeoURL( $this->data['fullname'] );
				}

				if ( $this->input->post( 'phone' ) != null ) {
					$this->data['phone'] = $this->input->post( 'phone' );
					$array['phone']      = $this->data['phone'];
				}

				if ( $this->input->post( 'position' ) != null ) {
					$this->data['position'] = $this->input->post( 'position' );
					$array['position']      = $this->data['position'];
				}

				if ( $this->input->post( 'company_name' ) != null ) {
					$this->data['company_name'] = $this->input->post( 'company_name' );
					$array['company_name']      = $this->data['company_name'];
					$array['slug']              = generateSeoURL( $this->data['company_name'] );
				}

				if ( $this->input->post( 'company_info' ) != null ) {
					$this->data['company_info'] = $this->input->post( 'company_info' );
					$array['company_info']      = $this->data['company_info'];
				}

				if ( $this->input->post( 'personal_info' ) != null ) {
					$this->data['personal_info'] = $this->input->post( 'personal_info' );
					$array['personal_info']      = $this->data['personal_info'];
				}

				if ( $this->input->post( 'establishment_date' ) != null ) {
					$this->data['establishment_date'] = $this->input->post( 'establishment_date' );
					$array['establishment_date']      = $this->data['establishment_date'];
				}

				if ( $this->input->post( 'brith_day' ) != null ) {
					$this->data['brith_day'] = $this->input->post( 'brith_day' );
					$array['brith_day']      = $this->data['brith_day'];
				}

				$updata_user = $this->User_model->save_fcm( $this->data['user']['id'], $array );

				if ( $updata_user ) {

					$this->auth->remove_all_var();
					$this->data['person'] = $this->input->post( 'person' );
					if ( ! empty( $this->data['person'] ) && isset( $this->data['person'] ) ) {
						$this->data['user_varabile'] = [];
						$this->data['new_var']       = [];
						foreach ( $this->data['person'] as $key => $value ) {
							if ( ( $key == 'phone' && ! empty( $value ) && $value[0] != '' ) || $key != 'phone' ) {
								foreach ( $value as $secret => $child ) {
									$this->data['user_varabile'][ $key ][ $secret ] = $child[0];
								}
							}
						}
						foreach ( $this->data['user_varabile'] as $key => $value ) {
							foreach ( $value as $k => $table ) {
								$this->data['new_var'][ $k ][ $key ] = $table;
							}
						}
						$this->auth->set_user_var( 'person', json_encode( $this->data['new_var'] ), false );
					}


					$this->data['company'] = $this->input->post( 'company' );
					if ( ! empty( $this->data['company'] ) && isset( $this->data['company'] ) ) {
						$this->data['user_varabile'] = [];
						$this->data['new_var']       = [];
						foreach ( $this->data['company'] as $key => $value ) {
							if ( ( $key == 'phone' && ! empty( $value ) && $value[0] != '' ) || $key != 'phone' ) {
								foreach ( $value as $secret => $child ) {
									$this->data['user_varabile'][ $key ][ $secret ] = $child[0];
								}
							}
						}
						foreach ( $this->data['user_varabile'] as $key => $value ) {
							foreach ( $value as $k => $table ) {
								$this->data['new_var'][ $k ][ $key ] = $table;
							}
						}
						$this->auth->set_user_var( 'company', json_encode( $this->data['new_var'] ), false );
					}
				}
			}
		}
	}

	public function companyInformation() {
		if ( $this->input->method() == 'post' ) {
			$array = [];
			if ( $this->input->post( 'establishment_date' ) != null ) {
				$this->data['establishment_date'] = $this->input->post( 'establishment_date' );
				$array['establishment_date']      = $this->data['establishment_date'];
			}
			if ( $this->input->post( 'company_info' ) != null ) {
				$this->data['company_info'] = $this->input->post( 'company_info' );
				$array['company_info']      = $this->data['company_info'];
			}
			if ( $this->input->post( 'company_name' ) != null ) {
				$this->data['company_name'] = $this->input->post( 'company_name' );
				$array['company_name']      = $this->data['company_name'];
				$array['slug']              = generateSeoURL( $this->data['company_name'] );
			}

			$comp_name = $this->data['company_name'];
			if ( $comp_name !== null && $comp_name != '' && $this->auth->user_exist_by_company( $comp_name ) ) {
				redirect( site_url_multi( 'profile/settings?same_comp' ), 'refresh' );

				return false;
			}

			$updata_user = $this->User_model->save_fcm( $this->data['user']['id'], $array );
			if ( $updata_user ) {
				redirect( site_url_multi( 'profile/settings/' ), 'refresh' );
			}
		}
	}

	public function deleteimg() {
		if ( $this->input->method() == 'post' ) {
			$this->data['standart_id'] = $this->input->post( 'value' );
			$this->data['user_id']     = $this->input->post( 'user_id' );
			$delete_standart           = $this->User_model->delete_standart( [
				'standart_id' => $this->data['standart_id'],
				'user_id'     => $this->data['user_id']
			] );
			if ( $delete_standart ) {
				echo 'true';
			} else {
				echo 'false';
			}
		}
	}

	public function userphotos() {
		if ( $this->input->method() == 'post' ) {

			if ( count( $_FILES['userphotos']['name'] ) > 0 ) {
				$directory               = DIR_IMAGE . 'catalog/users';
				$config                  = array();
				$config['upload_path']   = $directory;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite']     = false;

				$this->load->library( 'upload' );

				$this->upload->initialize( $config );

				if ( ! $this->upload->do_upload( 'userphotos' ) ) {
					echo 'false';
				} else {
					$this->db->set( [ 'images' => $_FILES['userphotos']['name'] ] );
					$this->db->where( 'id', $this->data['user']['id'] );
					$this->db->update( 'wc_users' );
					echo $_FILES['userphotos']['name'];
				}
			}
		}
	}

	public function accounts() {
		$this->data['active_menu'] = 3;
		$this->data['title']       = translate( 'title_account' );
		if ( $this->input->method() == 'post' ) {
			$ntf_comp_email = $this->input->post( 'ntf_comp_email' );
			$ntf_comp_sms   = $this->input->post( 'ntf_comp_sms' );
			$ntf_cert_email = $this->input->post( 'ntf_cert_email' );
			$ntf_cert_sms   = $this->input->post( 'ntf_cert_sms' );
			$ntf_pass_email = $this->input->post( 'ntf_pass_email' );
			$ntf_pass_sms   = $this->input->post( 'ntf_pass_sms' );

			$delete_ntf = $this->User_model->delete_ntf( $this->data['user']['id'] );

			$array = [
				'user_id'        => $this->data['user']['id'],
				'ntf_comp_email' => $ntf_comp_email,
				'ntf_comp_sms'   => $ntf_comp_sms,
				'ntf_cert_email' => $ntf_cert_email,
				'ntf_cert_sms'   => $ntf_cert_sms,
				'ntf_pass_email' => $ntf_pass_email,
				'ntf_pass_sms'   => $ntf_pass_sms
			];

			$insert_ntf_settings = $this->User_model->insert_ntf_settings( $array );
			if ( $insert_ntf_settings ) {
				redirect( site_url_multi( 'profile/accounts' ), 'location' );
			} else {
				redirect( site_url_multi( 'profile/accounts' ), 'location' );
			}
		}
		$this->data['account_settings'] = $this->User_model->account_settings( [ '*' ], [ 'user_id' => $this->data['user']['id'] ] )[0];
		//$this->debug($this->data['account_settings']);
		$this->template->render( 'profile/accounts' );
	}

    public function followers() {
        $this->data['active_menu'] = 'followers';

        $user = $this->data['UserData'];

        if ($this->input->method() == 'post' && isset($_POST['unfollow_user'])){

            $this->form_validation->set_rules( 'id', 'ID', 'trim|required' );
            $this->form_validation->set_rules( 'unfollow_user', 'User', 'required' );

            if ($this->form_validation->run()) {
                $id = $this->input->post( 'id' );

                $this->db->delete('wc_user_follow', [
                    'id' => $id,
                    'followed_user' => $this->data['user']['id']
                ]);

                $response = [
                    'type'    => 'success',
                    'message' => 'Your are removed user from follow user list'
                ];

            }else{
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }

            echo json_encode($response);

        }else{

            $user_id=$user->id;
            $check_type=( (isset($_GET['type']) && !empty($_GET['type']) && $_GET['type']==2) || isset($_POST['type']) && !empty($_POST['type']) && $_POST['type']==2 ) ? 2 : 1;

            $check_search=(isset($_POST['search_user']) && !empty($_POST['search_user'])) ? $_POST['search_user'] : "";
            $followers_users=($check_type==2) ? $this->User_model->getFollowersCompanies($user_id, $check_search) : $this->User_model->getFollowersUsers($user_id, $check_search);

            if ($check_search){
                echo json_encode(['data' => $followers_users]);
                exit;
            }

            $this->data['followers_users']=$followers_users;
            $this->data['check_type']=$check_type;


            $this->template->render( 'company/followers' );
        }

    }

    public function following() {
        $this->data['active_menu'] = 'following';

        $user = $this->data['UserData'];

        if ($this->input->method() == 'post' && isset($_POST['unfollow_user'])){

            $this->form_validation->set_rules( 'id', 'ID', 'trim|required' );
            $this->form_validation->set_rules( 'unfollow_user', 'User', 'required' );

            if ($this->form_validation->run()) {
                $id = $this->input->post( 'id' );

                $this->db->delete('wc_user_follow', [
                    'id' => $id,
                    'follower_id' => $this->data['user']['id']
                ]);

                $response = [
                    'type'    => 'success',
                    'message' => 'Your are removed user from follow user list'
                ];

            }else{
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }

            echo json_encode($response);

        }else{

            $user_id=$user->id;
            $check_type=( (isset($_GET['type']) && !empty($_GET['type']) && $_GET['type']==2) || isset($_POST['type']) && !empty($_POST['type']) && $_POST['type']==2 ) ? 2 : 1;

            $check_search=(isset($_POST['search_user']) && !empty($_POST['search_user'])) ? $_POST['search_user'] : "";
            $following_users=($check_type==2) ? $this->User_model->getFollowingCompanies($this->data['UserData']->id, $check_search) : $this->User_model->getFollowingUsers($this->data['UserData']->id, $check_search);

            if ($check_search){
                echo json_encode(['data' => $following_users]);
                exit;
            }

            $this->data['following_users']=$following_users;
            $this->data['check_type']=$check_type;


            $this->template->render( 'company/following' );
        }


    }

	public function interests() {
		$this->data['new_page'] = 1;
		$this->data['active_menu'] = 3;
		$this->data['title']       = translate( 'title_interest' );

        $user = $this->data['UserData'];

		if ( $this->input->method() == 'post' ) {
			$continent    = $this->input->post( 'continent' );
			$country      = $this->input->post( 'country' );
			$product_type = $this->input->post( 'product_type' );
			$status       = $this->input->post( 'status' );
			$standart     = $this->input->post( 'standart' );

			//$this->debug($this->input->post());

			$continent_key = [];
			if ( ! empty( $continent ) ) {
				foreach ( $continent as $key => $value ) {
					$continent_key[ $key ] = $value;
				}
			}

			$country_key = [];
			if ( ! empty( $country ) ) {
				foreach ( $country as $key => $value ) {
					$country_key[ $key ] = $value;
				}
			}

			$product_type_key = [];
			if ( ! empty( $product_type ) ) {
				foreach ( $product_type as $key => $value ) {
					$product_type_key[ $key ] = $value;
				}
			}

			$status_key = [];
			if ( ! empty( $status ) ) {
				foreach ( $status as $key => $value ) {
					$status_key[ $key ] = $value;
				}
			}

			$standart_key = [];
			if ( ! empty( $standart ) ) {
				foreach ( $standart as $key => $value ) {
					$standart_key[ $key ] = $value;
				}
			}

			if ( ! empty( $continent_key ) ) {

				$delete_interests = $this->User_model->delete_interests( $user->id, $user->company_id );
				$this->User_model->delete_any( 'wc_user_interests_continent', [ 'user_id' => $user->id, 'company_id' =>$user->company_id ] );
				$this->User_model->delete_any( 'wc_user_interests_country', [ 'user_id' => $user->id, 'company_id' =>$user->company_id ] );
				$this->User_model->delete_any( 'wc_user_interests_product_type', [ 'user_id' => $user->id, 'company_id' =>$user->company_id ] );
				$this->User_model->delete_any( 'wc_user_interests_status', [ 'user_id' => $user->id, 'company_id' =>$user->company_id ] );
				$this->User_model->delete_any( 'wc_user_interests_standart', [ 'user_id' => $user->id, 'company_id' =>$user->company_id ] );


				foreach ( $continent_key as $key => $value ) {
					/* $continent_text */
					if ( isset( $value ) ) {
						$continent_text = implode( ",", $value );
						foreach ( $value as $konti ) {
							$konti_data = [
								'user_id'      => $user->id,
								'company_id'      => $user->company_id,
								'continent_id' => $konti
							];
							$this->User_model->insert_any( 'wc_user_interests_continent', $konti_data );
						}
					} else {
						$continent_text = '';
					}

					/* $country_text */
					if ( isset( $country_key[ $key ] ) ) {
						$country_text = implode( ",", $country_key[ $key ] );
						foreach ( $country_key[ $key ] as $countries ) {
							$countries_data = [
                                'user_id'      => $user->id,
                                'company_id'      => $user->company_id,
								'country_id' => $countries
							];
							$this->User_model->insert_any( 'wc_user_interests_country', $countries_data );
						}
					} else {
						$country_text = '';
					}

					/* $product_type_text */
					if ( isset( $product_type_key[ $key ] ) ) {
						$product_type_text = implode( ",", $product_type_key[ $key ] );
						foreach ( $product_type_key[ $key ] as $product_typies ) {
							$product_typies_data = [
                                'user_id'      => $user->id,
                                'company_id'      => $user->company_id,
								'product_type_id' => $product_typies
							];
							$this->User_model->insert_any( 'wc_user_interests_product_type', $product_typies_data );
						}
					} else {
						$product_type_text = '';
					}

					/* $status_text */
					if ( isset( $status_key[ $key ] ) ) {
						$status_text = implode( ",", $status_key[ $key ] );
						foreach ( $status_key[ $key ] as $stat ) {
							$stat_data = [
                                'user_id'      => $user->id,
                                'company_id'      => $user->company_id,
								'group_id' => $stat
							];
							$this->User_model->insert_any( 'wc_user_interests_status', $stat_data );
						}
					} else {
						$status_text = '';
					}

					/* $standart_key */
					if ( isset( $standart_key[ $key ] ) ) {
						$standart_text = implode( ",", $standart_key[ $key ] );
						foreach ( $standart_key[ $key ] as $stand ) {
							$stand_data = [
                                'user_id'      => $user->id,
                                'company_id'      => $user->company_id,
								'standart_id' => $stand
							];
							$this->User_model->insert_any( 'wc_user_interests_standart', $stand_data );
						}
					} else {
						$standart_text = '';
					}
					$data             = [
                        'user_id'      => $user->id,
                        'company_id'      => $user->company_id,
						'continent'    => $continent_text,
						'country'      => $country_text,
						'product_type' => $product_type_text,
						'status'       => $status_text,
						'standart'     => $standart_text
					];
					$insert_interests = $this->User_model->insert_interests( $data );
				}
			}
		}
		
		$this->data['get_your_interests'] = $this->User_model->get_your_interests( [ '*' ], [ 'user_id' => $user->id, 'company_id' => $user->company_id ] );
		//$this->debug($this->data['get_your_interests']);
		$this->template->render( 'company/interests' );
	}

	public function products() {
		$this->data['new_page'] = 1;
		$this->data['title'] = translate( 'title' );
		redirect( site_url_multi( '/product' ), 'location' );
	}

	public function tenders() {
		$this->data['new_page'] = 1;
		$this->data['title'] = translate( 'title' );
		redirect( site_url_multi( '/tender' ), 'location' );
	}

	public function changeCompanyName() {
		if ( $this->input->method() == 'post' ) {
			$general = [
				'user_id' => $this->data['user']['id'],
				'name'    => $this->input->post( 'new_company_name' ),
				'status'  => 0,
				'sort'    => 1
			];

			$comp_name = $this->input->post( 'new_company_name' );
			if ( $comp_name !== null && $comp_name != '' && $this->auth->user_exist_by_company( $comp_name ) ) {
				echo "same";

				return false;
			}

			$companies_name = $this->User_model->insert_company_name( $general );
			if ( $companies_name ) {
				echo "true";
			} else {
				echo "false";
			}
		}
	}

	public function changePassword() {
		$response = [];
		if ( $this->input->method() == 'post' ) {
			$this->form_validation->set_rules( 'new_password', 'New password', 'trim|required' );
			$this->form_validation->set_rules( 're_password', 'Re new password', 'trim|required' );

			if ( $this->form_validation->run() ) {
				$this->data['new_password'] = $this->input->post( 'new_password' );
				$this->data['re_password']  = $this->input->post( 're_password' );
				if ( $this->data['new_password'] == $this->data['re_password'] ) {
					$this->data['get_user'] = $this->auth->get_user( $this->data['user']['id'] );
					if ( $this->data['get_user'] ) {
						$updata_user = $this->auth->update_user( $this->data['user']['id'], $this->data['get_user']->email, $this->data['new_password'] );
						if ( $updata_user ) {
							$response = [
								'type'    => 'success',
								'message' => 'You password is changed !'
							];


							$setting_user = $this->User_model->account_settings( 'ntf_comp_email,ntf_comp_sms', array( 'user_id' => $this->data['user']['id'] ) );


							if ( $setting_user[0]['ntf_comp_email'] == 1 ) {

								$mail = $this->phpmailer_library->load();
								//Server settings
								// $mail->SMTPDebug = 2;
								$mail->isSMTP();
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


								$message = "<h4>Hi " . $this->data['get_user']->company_name . "</h4>";
								$message .= 'Your password has been changed on ' . date( 'm/d/Y h:i:s a', time() ) . '.<br>';


								$mail->setFrom( 'support@makromedicine.com', 'Makromedicine' );
								$mail->addAddress( $this->data['get_user']->email );
								$mail->addReplyTo( 'support@makromedicine.com' );

								// Content
								$mail->isHTML( true );
								$mail->Subject = 'Password Change';
								$mail->Body    = $message;

								$mail->send();

							}

							if ( $setting_user[0]['ntf_comp_sms'] == 1 ) {

							}

						} else {
							$response = [
								'type'    => 'danger',
								'message' => 'System error please try again !'
							];
						}
					}
				} else {
					$response = [
						'type'    => 'danger',
						'message' => 'Passwords do not match'
					];
				}
			} else {
				$response = [
					'type'    => 'danger',
					'message' => validation_errors()
				];
			}
		} else {
			$response = [
				'type'    => 'danger',
				'message' => 'System error please try again !'
			];
		}
		echo json_encode( $response );
	}

	public function comfirmAccount() {
		$response = [];
		if ( $this->input->method() == 'post' ) {
			$this->form_validation->set_rules( 'info', 'Info', 'trim|required' );

			if ( $this->form_validation->run() ) {
				$this->data['info'] = $this->input->post( 'info' );
				if ( count( $_FILES['certifcate']['name'] ) > 0 ) {
					$directory               = DIR_IMAGE . 'catalog/certifcate';
					$config                  = array();
					$config['upload_path']   = $directory;
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
					$config['overwrite']     = false;

					$this->load->library( 'upload' );

					$this->upload->initialize( $config );

					if ( ! $this->upload->do_upload( 'certifcate' ) ) {
						$response = [
							'type'    => 'danger',
							'message' => $this->upload->display_errors()
						];
					} else {
						$general = [
							'user_id' => $this->data['user']['id'],
							'info'    => $this->data['info'],
							'image'   => $_FILES['certifcate']['name'],
							'status'  => 0,
							'sort'    => 1
						];
						$this->User_model->delete_certificate( $this->data['user']['id'] );
						$insert_certificate = $this->User_model->insert_certificate( $general );
						if ( $insert_certificate ) {
							$response = [
								'type'    => 'success',
								'message' => 'Your information has been sent successfully. We will send your information but after checking'
							];
						} else {
							$response = [
								'type'    => 'danger',
								'message' => validation_errors()
							];
						}
					}
				} else {
					$response = [
						'type'    => 'danger',
						'message' => 'Please select cerifcate'
					];
				}
			} else {
				$response = [
					'type'    => 'danger',
					'message' => validation_errors()
				];
			}
		} else {
			$response = [
				'type'    => 'danger',
				'message' => 'System error please try again !'
			];
		}
		echo json_encode( $response );
	}

	public function importer() {
		die();
		$this->data['users'] = $this->User_model->getLastUser();
		echo '<pre>';
		foreach ( $this->data['users'] as $key => $value ) {
			if ( $value['type'] == 1 ) {
				$type = 2;
			} else if ( $value['type'] == 2 ) {
				$type = 3;
			} else if ( $value['type'] == 3 ) {
				$type = 4;
			} else if ( $value['type'] == 4 ) {
				$type = 5;
			} else if ( $value['type'] == 5 ) {
				$type = 6;
			}

			$array       = array(
				'id'                 => $value['id'],
				'user_groups_id'     => $type,
				'fullname'           => $value['name'] . "" . $value['lastname'],
				'email'              => $value['email'],
				'pass'               => '$2y$10$0T6bYhs/PgzeTFl79EEHk.iPgXKsM3zXTSVOFUPZXt5KAR3m4NUbS',
				'phone'              => $value['phone'],
				'username'           => $value['login'],
				'country_id'         => $value['country'],
				'product_type'       => json_encode( explode( ',', $value['atc'] ) ),
				'company_name'       => $value['work'],
				'company_info'       => $value['company_info'],
				'tags'               => $value['tags'],
				'adress'             => $value['address'],
				'website'            => $value['web'],
				'standart'           => json_encode( explode( ',', $value['standart'] ) ),
				'facebook'           => $value['fb'],
				'twitter'            => $value['tw'],
				'youtube'            => $value['yt'],
				'linkedin'           => $value['lk'],
				'lat'                => $value['lat'],
				'lng'                => $value['log'],
				'establishment_date' => $value['birthday'],
				'banned'             => 0,
				'status'             => $value['checked']
			);
			$insert_user = $this->User_model->insert_user( $array );

			/*
			 * Manufacturer 1
			 * Distributor  2
			 * Agent        3
			 * Manager      4
			 * User         5
			 */

			if ( $insert_user ) {
				$sxf = array(
					'user_id'  => $insert_user,
					'group_id' => $type
				);

				$INSERT_GROUP = $this->User_model->insert_user_to_group( $sxf );
			}
		}

		//$this->debug($this->data['users']);
	}

	public function country() {
		if ( $this->input->method() == 'post' ) {
			$continent_id = $this->input->post( 'continent_id' );
			$this->debug( $this->input->post() );
		}
	}

	public function delete_interest() {
		if ( $this->input->method() == 'post' ) {
			$id  = $this->input->post( 'id' );
			$del = $this->User_model->delete_interest( $id );
			die( json_encode( $del ) );
		}
	}

	public function news( $slug ) {
		$page =  $this->input->get('page');
		if(!isset($page)) {
			$page = 1;
		}
		$this->data['new_page'] = 1;
		$user = $this->data['UserData'];

		if ( $user ) {
			$this->data['title']       = translate( 'title' );
			$this->data['active_menu'] = 2;

			$limit = 4;
			$offset = ($page - 1)*$limit;
			
			$this->data['total_news'] = $this->db->select( '*' )->from( 'wc_company_news' )->where( [ 'user_id' => $user->id, 'company_id' => $user->company_id ] )->count_all_results();
			$this->data['num_pages'] = ceil($this->data['total_news']/$limit);
			$this->data['curr_page'] = $page;
			$this->data['prev_page'] = $page-1;
			$this->data['next_page'] = $page+1;

			$this->db->select( '*' );
			$this->db->from( 'wc_company_news' )->where( [ 'user_id' => $user->id,  'company_id' => $user->company_id ] )->limit($limit, $offset)->order_by('id', 'DESC');


			$query = $this->db->get();


			$this->data['news'] = $query->result_array();
			$this->data['slug'] = $slug;
			$this->template->render( 'company/news' );
		}
	}

	public function viewNews($slug, $news_id) {
		$this->data['new_page'] = 1;
		$user = $this->data['UserData'];
		if ( $user ) {
			$this->db->select( '*' );
			$this->db->from( 'wc_company_news' )->where( [ 'user_id' => $user->id, 'id' => $news_id ] );
			$query = $this->db->get();
			$news = $query->result_array();

			if(count($news) > 0) {
				$this->data['news'] = $news[0];
				
				$this->data['title']       = translate( 'title' );
				$this->data['active_menu'] = 2;


                if ($_SESSION['id']!=$user->id){
                    $this->db->set('view', 'view+1', FALSE);
                    $this->db->where('id', $news_id);
                    $this->db->update('wc_company_news');
                }


                $this->db->select( '*' );
                $this->db->from( 'wc_company_news' )->where( [ 'user_id' => $user->id, 'id!=' => $news_id ] )->order_by('id', 'DESC');
                $query = $this->db->get();

                $this->data['slug'] = $slug;
                $this->data['other_news']=$query->result_array();

				$this->template->render( 'company/view-news' );
			} else {
				echo "Oops ! Wrong news.";
			}

		} else {
			echo "Oops ! Wrong news.";
		}
	}

	public function addNews( $slug ) {
		$this->data['new_page'] = 1;
		$user =$this->data['UserData'];

		if ( $this->input->method() == 'post' ) {
			if ( $this->input->post( 'title' ) != null && $this->input->post( 'description' ) != null && $_FILES['news_image'] != null ) {
				$title       = $this->input->post( 'title' );
				$description = $this->input->post( 'description' );
				$user_id     = $user->id;
                $company_id     = $user->company_id;
				$directory               = DIR_IMAGE . 'news';
				$config                  = array();
				$config['upload_path']   = $directory;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$config['overwrite']     = true;
				$config['file_name']     = $_FILES['news_image']['name'];

				$this->load->library( 'upload' );
				$this->upload->initialize( $config );

				$error = false;
				if ( ! $this->upload->do_upload( 'news_image' ) ) {
					$error = true;
				}

				$file_name = $this->upload->data()['file_name'];


				if ($error) {
					$json['error'] = $this->upload->display_errors();
				} else {
				    $insert_data=[
				        'user_id' => $user_id,
				        'company_id' => $company_id,
				        'title' => $title,
				        'description' => $description,
				        'image' => $file_name,
                    ];
                    $this->db->insert('wc_company_news', $insert_data);

					if ( $this->db->insert_id()) {
						redirect( site_url_multi( 'pages/' . $slug . '/news' ), 'refresh' );
					}
				}

			} else {
				redirect( site_url_multi( 'pages/' . $slug . '/add-news' ), 'refresh' );
			}
		}

		$this->data['title']       = translate( 'title' );
		$this->data['active_menu'] = 2;
		$this->template->render( 'company/add-news' );
	}

	public function editNews( $slug, $news_id ) {
		$this->data['new_page'] = 1;
		$user = $this->data['UserData'];

		if ( $user ) {
			$this->db->select( '*' );
			$this->db->from( 'wc_company_news' )->where( [ 'user_id' => $user->id, 'id' => $news_id, 'company_id' => $user->company_id ] );
			$query = $this->db->get();
			$news = $query->result_array();

			if(count($news) > 0) {
				$this->data['news'] = $news[0];
			} else {
				echo "Oops ! Wrong news.";
			}

		} else {
			echo "Oops ! Wrong news.";
		}


		if ( $this->input->method() == 'post' ) {
			if ( $this->input->post( 'title' ) != null ) {
				$title       = $this->input->post( 'title' );
			} else {
				$title = $this->data['news']['title'];
			}
			if ( $this->input->post( 'description' ) != null ) {
				$description = $this->input->post( 'description' );
			} else {
				$description = $this->data['news']['description'];
			}


			if ( $_FILES['news_image']['tmp_name'] != null ) {

				$user_id     = $user->id;
				$directory               = DIR_IMAGE . 'news';
				$config                  = array();
				$config['upload_path']   = $directory;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$config['overwrite']     = true;
				$config['file_name']     = $_FILES['news_image']['name'];

				

				$this->load->library( 'upload' );
				$this->upload->initialize( $config );

				

				if ( ! $this->upload->do_upload( 'news_image' ) ) {
					$json['error'] = $this->upload->display_errors();
				}

				$file_name = $this->upload->data()['file_name'];
			} else {
				$file_name = $this->data['news']['image'];
			}



				$newsUpdatedData = array(
					'title' => $title,
					'description' => $description,
					'image' => $file_name
				);


				$this->db->where('id', $this->data['news']['id']);

				// $query = "update into wc_company_news (user_id, title, description, image) values($user_id,'$title','$description','$file_name')";
				if ( $this->db->update('wc_company_news', $newsUpdatedData) ) {
					redirect( site_url_multi( 'pages/' . $slug . '/news' ), 'refresh' );
				}
		} else {
			$this->data['title']       = translate( 'title' );
			$this->data['active_menu'] = 2;
			$this->template->render( 'company/edit-news' );
		}
	}

	public function deleteNews($slug, $news_id) {
		$this->data['new_page'] = 1;
		$current_user = $this->session->userdata['id'];
		$newsuser = $this->data['UserData'];
		if ( $newsuser && $newsuser->id == $current_user ) {
			$this->db->delete('wc_company_news', array('id' => $news_id));
			redirect( site_url_multi( '/pages/'.$slug.'/news' ), 'refresh' );
		} else {
			redirect( site_url_multi( '/pages/'.$slug.'/news' ), 'refresh' );
		}
	}

	public function update_user_group_id(){
        $this->form_validation->set_rules('to_user_id', 'User ID', 'required|trim|numeric');
        $this->form_validation->set_rules('role_id', 'Role ID', 'required|trim|numeric');
        $this->form_validation->set_rules('id', 'ID', 'required|trim|numeric');
        $this->form_validation->set_rules('company_id', 'Company ID', 'required|trim|numeric');

        if ($this->form_validation->run()) {
            $role_id = $this->input->post('role_id');
            $id = $this->input->post('id');
            $to_user_id = $this->input->post('to_user_id');
			$company_id = $this->input->post('company_id');
            $group_text = $this->input->post('group_text');
            $page_name = $this->input->post('page_name');

            $this->db->where('id', $id);
            $this->db->update('wc_company_user_rel', [
				'position_id' => $role_id
            ]);

			$msg= $_SESSION['fullname'] . " change your position to " . $group_text . ' at ' . $page_name;

            $this->data['notify_data'] = [
                'user_id'     => $to_user_id,
				'company_id'     => $company_id,
                'send_id'     => $_SESSION['id'],
                'status'      => 1,
                'sender'      => 1,
                'type'        => 1,
                'title'       => $msg,
                'description' => "",
            ];


			$this->data['send_notify'] = $this->Notify_model->send( $this->data['notify_data'] );

			$invited_user_data = $this->User_model->getUserMainData(['u.id' => $to_user_id]);

			$this->sendMail([$invited_user_data->email], 'Change position', $msg);

        }
    }

	public function people($slug) {

		$current_user = $this->session->userdata['id'];
		$user = $this->data['UserData'];
		$page_user_id = $user->id;

	    if ( $this->input->method() == 'post'){

	        $this->update_user_group_id();

	        exit;
        }

		$this->data['new_page'] = 1;
		

		if ( $user ) {
			$this->data['title']       = translate( 'title' );
			$this->data['active_menu'] = 2;

			$company_id=$user->company_id;
            $admin_data=$this->User_model->getUserData( [ 'c.id' => $company_id] );



            $image = '';
            if ( empty( $admin_data->images ) ) {
                $image = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $admin_data->images, FILTER_VALIDATE_URL ) ) {
                    $image = base_url( 'uploads/catalog/users/' ) . $user->images;
                } else {
                    $image = $admin_data->images;
                }
            }

            $this->data['admin_data'] = array(
                'id'       => $admin_data->id,
                'name'     => $admin_data->fullname,
                'position' => $admin_data->position_name,
				'role_name' => $admin_data->role_name,
                'photo'    => $image,
                'slug_user'    => $admin_data->slug_user,
            );



            /**/
            $approved=$this->User_model->getApliedUsers($company_id, $page_user_id, 1);

            $approved_users = [];
            if ( !empty($approved) ) {
                foreach ( $approved as $approved_user ) {



                    $image = '';
                    if ( empty( $approved_user['images'] ) ) {
                        $image = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
                    } else {
                        if ( ! filter_var( $approved_user['images'], FILTER_VALIDATE_URL ) ) {
                            $image = base_url( 'uploads/catalog/users/' ) . $approved_user['images'];
                        } else {
                            $image = $approved_user['images'];
                        }
                    }

                    $user = [
                        'id'       => $approved_user['id'],
                        'rel_main_id'       => $approved_user['rel_main_id'],
                        'name'     => $approved_user['fullname'],
                        'position' => $approved_user['position_name'],
                        'photo'    => $image,
                        'user_page_role_id'    => $approved_user['position'],
                        'slug_user'    => $approved_user['slug_user'],
                        'country_name' => get_country_name($approved_user['country_id'])
                    ];
                    array_push( $approved_users, $user );
                }
            }
            $this->data['approved_users'] = $approved_users;



			$approval_waiting = $this->User_model->getApliedUsers($company_id, $page_user_id, 0);


			$approval_waiting_users = [];
			if (!empty($approval_waiting)) {
				foreach ($approval_waiting as $waiting_user) {



					$image = '';
					if (empty($waiting_user['images'])) {
						$image = base_url('uploads/catalog/users/') . "avatar-placeholder.png";
					} else {
						if (!filter_var($waiting_user['images'], FILTER_VALIDATE_URL)) {
							$image = base_url('uploads/catalog/users/') . $waiting_user['images'];
						} else {
							$image = $waiting_user['images'];
						}
					}

					$user = [
						'id'       => $waiting_user['id'],
						'rel_main_id'       => $waiting_user['rel_main_id'],
						'name'     => $waiting_user['fullname'],
						'position' => $waiting_user['position_name'],
						'photo'    => $image,
						'user_page_role_id'    => $waiting_user['position'],
						'slug_user'    => $waiting_user['slug_user'],
						'country_name' => get_country_name($waiting_user['country_id'])
					];
					array_push($approval_waiting_users, $user);
				}
			}

			$this->data['approval_waiting_users'] = $approval_waiting_users;



			$this->data['title']       = translate( 'title' );
			$this->data['active_menu'] = 7;



            $this->data['user_groups'] = $this->User_model->getUserGroups();

			$this->template->render( 'company/people' );
		}
	}

	public function people_add(){
        $user = $this->data['UserData'];
        $page_user_id = $user->id;

        $this->data['active_menu'] = 7;

        $company_id=$user->company_id;


        $approval_waiting= $this->User_model->getApliedUsers($company_id, $page_user_id, 0);

        $approval_waiting_users = [];
        if ( !empty($approval_waiting)) {
            foreach ( $approval_waiting as $waiting_user ) {



                $image = '';
                if ( empty( $waiting_user['images'] ) ) {
                    $image = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
                } else {
                    if ( ! filter_var( $waiting_user['images'], FILTER_VALIDATE_URL ) ) {
                        $image = base_url( 'uploads/catalog/users/' ) . $waiting_user['images'];
                    } else {
                        $image = $waiting_user['images'];
                    }
                }

                $user = [
                    'id'       => $waiting_user['id'],
                    'rel_main_id'       => $waiting_user['rel_main_id'],
                    'name'     => $waiting_user['fullname'],
                    'position' => $waiting_user['position_name'],
                    'photo'    => $image,
                    'user_page_role_id'    => $waiting_user['position'],
                    'slug_user'    => $waiting_user['slug_user'],
                    'country_name' => get_country_name($waiting_user['country_id'])
                ];
                array_push( $approval_waiting_users, $user );
            }
        }

        $this->data['approval_waiting_users'] = $approval_waiting_users;



        $this->data['user_groups'] = $this->User_model->getUserGroups();

        $this->template->render( 'company/people_add' );

    }

    public function search_employee(){
	    if ($this->input->method() == 'post' && isset($_POST['search_employee'])){
            $this->form_validation->set_rules( 'search_employee', '', 'trim|required' );
            $this->form_validation->set_rules( 'name', '', 'required' );

            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $company_id=$this->data['UserData']->company_id;

                $data=$this->User_model->searchEmployee($name, $company_id);

                echo json_encode(['ok' => true, 'data' => $data, 'position_list' => $this->User_model->getUserGroups()]);

            }

        }
    }

    public function add_employee(){
        if ($this->input->method() == 'post' && isset($_POST['add_employee'])){
            $this->form_validation->set_rules( 'add_employee', '', 'trim|required' );
            $this->form_validation->set_rules( 'user_id', '', 'required' );
            $this->form_validation->set_rules( 'position_id', '', 'required' );

            if ($this->form_validation->run()) {
                $user_id = $this->input->post('user_id');
                $position_id = $this->input->post('position_id');
                $company_id=$this->data['UserData']->company_id;

                $this->load->model('Company_model');

                $role_data=[
                    'company_id' => $company_id,
                    'user_id' => $user_id,
                    'role_id' => $position_id,
                    'approved' => 1
                ];

                if($this->Company_model->check_company_user_rel([
                    'company_id' => $company_id,
                    'user_id' => $user_id
                ])){
                    $this->Company_model->insert_company_user_rel($role_data);

                    $response = [
                        'type'    => 'success',
                        'message' => 'Request sent to user'
                    ];

					$msg = $_SESSION['fullname'] . " added you to company";

					$this->data['notify_data'] = [
						'user_id'     => $user_id,
						'company_id'     => $company_id,
						'send_id'     => $_SESSION['id'],
						'status'      => 1,
						'sender'      => 1,
						'type'        => 1,
						'title'       => $msg,
						'description' => "",
					];

					$this->data['send_notify'] = $this->Notify_model->send($this->data['notify_data']);

					$invited_user_data= $this->Company_model->getUserMainData(['u.id' => $user_id]);

					$this->sendMail([$invited_user_data->email], 'New position', $msg);

                }else{
                    $response = [
                        'type'    => 'danger',
                        'message' => 'This user already exits in your company'
                    ];
                }




            }else{
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }


            echo json_encode($response);

        }
    }


	public function peopleAction($slug, $id, $action) {

        $this->db->select(['user_id'] );
        $this->db->from( 'wc_company_user_rel' )->where(['id' => $id ]);
        $query= $this->db->get();
        $to_user_data=$query->row();
		$subject="";

		if($action == 1) {

			$msg=$_SESSION['fullname']." approve you";
			$subject = "Approve to page";

            $this->db->where('id', $id);
            $this->db->update('wc_company_user_rel', [
                'approved' => 1
            ]);

		} else {

            $this->db->where('id', $id);
            $this->db->delete('wc_company_user_rel');

			$msg=$_SESSION['fullname']." delete you";

			$subject = "Delete from page";
		}

		$current_user = $this->session->userdata['id'];



        $this->data['notify_data'] = [
            'user_id'     => $to_user_data->user_id,
            'company_id'     => $this->data['UserData']->company_id,
            'send_id'     => $current_user,
            'status'      => 1,
            'sender'      => 1,
            'type'        => 1,
            'title'       => $msg,
            'description' => "",
        ];
		$this->data['send_notify'] = $this->Notify_model->send( $this->data['notify_data'] );

		$invited_user_data = $this->User_model->getUserMainData(['u.id' => $to_user_data->user_id]);

		$this->sendMail([$invited_user_data->email], $subject, $msg);

		redirect( site_url_multi( '/pages/'.$slug.'/people_add' ), 'refresh' );
	}

	public function product( $slug = null, $page = 1 ) {
		$this->data['new_page'] = 1;
		if ( $slug !== null ) {
			$this->data['title']       = translate( 'title' );
			$this->data['active_menu'] = 4;

            $user = $this->data['UserData'];

			$this->data['company'] = $user;

			if ( $this->data['company'] ) {
				$this->load->model( 'Product_model' );
				$this->data['company_images'] = '';
				if ( empty( $this->data['company']->images ) ) {
					$this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
				} else {
					if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
						$this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
					} else {
						$this->data['company_images'] = $this->data['company']->images;
					}
				}

				$segment_array       = $this->uri->segment_array();

				$page                = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;
				$this->data['limit'] = ['per_page' => 10, 'page' => $page];

				$limit = $this->data['limit']['per_page'];
				$offset = $this->data['limit']['per_page'] * ($this->data['limit']['page'] - 1);

				$this->data['products']   = $this->Product_model->filter( [ 'user_id' => $user->id, 'company_id' => $user->company_id ])->limit($limit, $offset)->order_by('id', 'DESC')->with_translation()->all();
				$this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $user->id, 'company_id' => $user->company_id ] )->with_translation()->one()->count;

				

				//Pagination
				$config['full_tag_open']      = '<ul class="pagination">';
				$config['full_tag_close']     = '</ul>';
				$config['first_link']         = '&laquo;';
				$config['first_tag_open']     = '<li class="page-item">';
				$config['first_tag_close']    = '</li>';
				$config['last_link']          = '&raquo;';
				$config['last_tag_open']      = '<li class="page-item">';
				$config['last_tag_close']     = '</li>';
				$config['next_link']          = '&rarr;';
				$config['next_tag_open']      = '<li class="page-item">';
				$config['next_tag_close']     = '</li>';
				$config['prev_link']          = '&larr;';
				$config['prev_tag_open']      = '<li class="page-item">';
				$config['prev_tag_close']     = '</li>';
				$config['cur_tag_open']       = '<li class="page-item"><a href="">';
				$config['cur_tag_close']      = '</a></li>';
				$config['num_tag_open']       = '<li class="page-item">';
				$config['num_tag_close']      = '</li>';
				$config['anchor_class']       = 'follow_link';
				$config['reuse_query_string'] = true;
				$config['use_page_numbers']   = true;
				$config['base_url']           = site_url_multi('pages/'. $slug.'/products' );
				$config['total_rows']         = $this->data['total_rows'];
				$config['per_page']           = $this->data['limit']['per_page'];
				$this->pagination->initialize( $config );
				$this->data['pagination'] = $this->pagination->create_links();
				$this->data['title']      = $this->data['company']->company_name . ' | Makromedicine.com';
				$this->template->render( 'company/company-product' );
			} else {
				$this->template->render( 'error/404' );
			}
		} else {
			$this->template->render( 'error/404' );
		}
	}


}
