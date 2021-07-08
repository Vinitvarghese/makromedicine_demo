<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Product extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'Cas_list_model' );
		$this->load->model( 'Plants_model' );
		$this->load->model( 'Herb_form_model' );
		$this->load->model( 'Herb_part_model' );
		$this->load->model( 'Animal_model' );
		$this->load->model( 'Animal_part_model' );
		$this->load->model( 'Animal_form_model' );
		$this->load->model( 'Unit_model' );
		$this->load->model( 'Drug_type_model' );
		$this->load->model( 'Purity_unit_model' );
		$this->load->model( 'Country_model' );
		$this->load->model( 'Product_model' );
        $this->load->model( 'Follow_model' );
		$this->load->helper( 'extra' );

		
	}

	public function index() {

		if ( ! $this->auth->is_loggedin() ) {
			redirect( '/', 'refresh' );
			exit();
		}
		$this->data['title'] = translate( 'title' );



		// HERABL
		$this->data['herbals'] = $this->Plants_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'name'
		] )->limit( 50, 1 )->with_translation()->all();
		// HERB PART
		$this->data['herb_parts'] = $this->Herb_part_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		// HERB FORM
		$this->data['herb_forms'] = $this->Herb_form_model->fields( [ 'id', 'name' ] )->with_translation()->all();

		// ANIMALS
		$this->data['animals'] = $this->Animal_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'name'
		] )->limit( 50, 1 )->with_translation()->all();
		// ANIMALS PART
		$this->data['animal_parts'] = $this->Animal_part_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		// ANIMALS FORM
		$this->data['animal_forms'] = $this->Animal_form_model->fields( [ 'id', 'name' ] )->with_translation()->all();

		// CHEMICAL NAME
		$this->data['chemichal'] = $this->Atc_code_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'atc_code',
			'meaning'
		] )->limit( 50, 1 )->filter( [ 'CHAR_LENGTH(atc_code)' => 7 ] )->with_translation()->all();

		  // CAS NUMBER
		$this->data['cas_numbers'] = $this->Cas_list_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'chemical_name',
			'cas_no',
			'molecular_formula'
		] )->limit( 50, 1 )->with_translation()->all();
		// DOSSAAGE FORM
		$this->data['dossageforms'] = $this->Packing_type_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'name'
		] )->limit( 50, 1 )->with_translation()->order_by( 'fr', 'desc' )->order_by( 'name', 'asc' )->all();
		$this->data['drug_types']   = $this->Drug_type_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'name'
		] )->with_translation()->all();

		// UNIT
		$this->data['unit'] = $this->Unit_model->fields( [
			'id',
			'name',
			'short_name'
		] )->order_by( 'fr', 'desc' )->order_by( 'name', 'asc' )->with_translation()->all();
		// UNIT
		$this->data['puritys'] = $this->Purity_unit_model->fields( [
			'id',
			'name',
			'code'
		] )->with_translation()->all();
		// COUNTRY
		$this->data['countrys'] = $this->Country_model->fields( [ 'id', 'name', 'code' ] )->with_translation()->all();
		// PRODUCT TYPE
		$this->data['product_type'] = $this->Product_type_model->fields( [
			'id',
			'name'
		] )->with_translation()->order_by( 'sort', 'ASC' )->all();

		$this->data['parent_atcs']  = $this->Atc_code_model->fields( [
			'id',
			'atc_code',
			'meaning'
		] )->filter( [ 'CHAR_LENGTH(atc_code)' => 7 ] )->with_translation()->all();
		foreach ( $this->data['parent_atcs'] as $atc ) {
			$result[] = [
				'value' => $atc->id,
				'name'  => $atc->atc_code . " | " . $atc->meaning
			];
		}
		$this->data['parent_cal'] = json_encode( $result );

        $user = $this->data['UserData'];

		$this->data['products']   = $this->Product_model->filter( [ 'user_id' => $user->id, 'company_id' => $user->company_id ] )->with_translation()->all();
		$this->data['message']    = $this->session->flashdata( 'message' );

        $this->template->render( 'product/add-product' );


	}


	public function add() {
		if ( $this->auth->is_loggedin() ) {
			$this->form_validation->set_rules( 'country', translate( 'country' ), 'trim|required' );
			$this->form_validation->set_rules( 'pr_type', translate( 'pr_type' ), 'trim|required' );
			if ( $this->input->method() == 'post' ) {
				if ( $this->form_validation->run() ) {

                    $user = $this->data['UserData'];

					if ( $this->input->post( 'herbals' ) || $this->input->post( 'atc_codes' ) || $this->input->post( 'animals' ) || $this->input->post( 'cass' ) ) {
						$title = $this->input->post( 'title' );
						// Dossage Form
						$packing_type = [];
						if ( $this->input->post( 'packing_types' ) ) {
							foreach ( $this->input->post( 'packing_types' ) as $packing_type_data ) {
								$packing_type[] = [
									'id'     => $packing_type_data['id'],
									'mdoza'  => $packing_type_data['mdoza'],
									'vdoza'  => $packing_type_data['vdoza'],
									'mdoza2' => ( isset( $packing_type_data['mdoza2'] ) ) ? $packing_type_data['mdoza2'] : false,
									'vdoza2' => ( isset( $packing_type_data['vdoza2'] ) ) ? $packing_type_data['vdoza2'] : false
								];
							}
						}
						//Herbals
						$herbal = [];
						if ( $this->input->post( 'herbals' ) ) {
							foreach ( $this->input->post( 'herbals' ) as $herbal_data ) {
								$herbal[] = [
									'id'    => $herbal_data['id'],
									'mdoza' => $herbal_data['mdoza'],
									'vdoza' => $herbal_data['vdoza'],
									'part'  => $herbal_data['part'],
									'form'  => $herbal_data['form'],
								];
							}
						}
						// Chemical code
						$atc_code = [];
						if ( $this->input->post( 'atc_codes' ) ) {
							foreach ( $this->input->post( 'atc_codes' ) as $atc_code_data ) {
								$atc_code[] = [
									'id'     => $atc_code_data['id'],
									'mdoza'  => $atc_code_data['mdoza'],
									'vdoza'  => $atc_code_data['vdoza'],
									'mdoza2' => ( isset( $atc_code_data['mdoza2'] ) ) ? $atc_code_data['mdoza2'] : false,
									'vdoza2' => ( isset( $atc_code_data['vdoza2'] ) ) ? $atc_code_data['vdoza2'] : false
								];
							}
						}
						//Animal
						$animal = [];
						if ( $this->input->post( 'animals' ) ) {
							foreach ( $this->input->post( 'animals' ) as $animal_data ) {
								$animal[] = [
									'id'    => $animal_data['id'],
									'mdoza' => $animal_data['mdoza'],
									'vdoza' => $animal_data['vdoza'],
									'part'  => $animal_data['part'],
									'form'  => $animal_data['form']
								];
							}
						}
						// Cas number
						$cas = [];
						if ( $this->input->post( 'cass' ) ) {
							foreach ( $this->input->post( 'cass' ) as $cas_data ) {
								$cas[] = [
									'id'          => $cas_data['id'],
									'mdoza'       => $cas_data['mdoza'],
									'vdoza'       => $cas_data['vdoza'],
									'mdoza2'      => ( isset( $cas_data['mdoza2'] ) ) ? $cas_data['mdoza2'] : false,
									'vdoza2'      => ( isset( $cas_data['vdoza2'] ) ) ? $cas_data['vdoza2'] : false,
									'purity_unit' => $cas_data['purity_unit'],
									'purity'      => $cas_data['purity'],
									'atc_code'    => ( isset( $cas_data['atc_code'] ) ) ? $cas_data['atc_code'] : false
								];
								if ( $this->input->post( 'pr_type' ) == '1' ) {
									$title = get_cas_no( $cas_data['id'] );
								} else if ( $this->input->post( 'pr_type' ) == '7' ) {
									$title = get_cas_no( $cas_data['id'] );
								}
							}
						}
						$product_data = [
                            'user_id' => $user->id,
                            'company_id' => $user->company_id,
							'checked'      => 0,
							'country'      => (int) $this->input->post( 'country' ),
							'packing_type' => json_encode( $packing_type ),
							'herbal'       => json_encode( $herbal ),
							'atc_code'     => json_encode( $atc_code ),
							'animal'       => json_encode( $animal ),
							'cas'          => json_encode( $cas ),
							'medical_cl'   => ( is_array( $this->input->post( 'classifiction' ) ) ) ? implode( ',', $this->input->post( 'classifiction' ) ) : '',
							'pr_type'      => (int) $this->input->post( 'pr_type' ),
							'equipment'    => '',
							'moq'          => $this->input->post( 'moq' ),
							'shelf_life'   => $this->input->post( 'shelf_life' ),
							'ctd'          => ( $this->input->post( 'ctd' ) != null ) ? '1' : '0',
							'be'           => ( $this->input->post( 'be' ) != null ) ? '1' : '0'
						];
						if ( $this->input->post( 'request' ) == 'add' ) {
							$id = $this->{$this->model}->insert( $product_data );

						} elseif ( $this->input->post( 'request' ) == 'update' ) {
							$id = (int) $this->input->post( 'product_id' );

							$this->{$this->model}->update( $product_data, $id );
						}



						if ( $id ) {
							if ( $this->input->post( 'request' ) == 'update' ) {
								$this->{$this->model}->delete_translation( $id );
							}
							$product_translation_data = [
								'product_id'  => $id,
								'language_id' => 1,
								'title'       => $title,
								'alias'       => slug( $this->input->post( 'title' ) ),
								'description' => $this->input->post( 'description' ),
								'storage'     => $this->input->post( 'storage' )
							];

							$this->{$this->model}->insert_translation( $product_translation_data );


							if ( isset( $_FILES['userfile'] ) && !empty($_FILES['userfile']['name']) ) {
								$directory               = DIR_IMAGE . 'catalog/product';
								$config                  = array();
								$config['upload_path']   = $directory;
								$config['allowed_types'] = 'gif|jpg|png';
								$config['overwrite']     = false;
								$this->load->library( 'upload' );
								$files = $_FILES;
								$total = count( $files['userfile']['name'] );
								unset( $_FILES );
								foreach ( $files['userfile']['name'] as $i => $value ) {
									$_FILES['userfile']['name']     = $files['userfile']['name'][ $i ];
									$_FILES['userfile']['type']     = $files['userfile']['type'][ $i ];
									$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][ $i ];
									$_FILES['userfile']['error']    = $files['userfile']['error'][ $i ];
									$_FILES['userfile']['size']     = $files['userfile']['size'][ $i ];

									$config['file_name'] = $_FILES['userfile']['name'];

									$this->upload->initialize( $config );


									if ( ! $this->upload->do_upload( 'userfile' ) ) {
										$json['error'] = $this->upload->display_errors();
									} else {
										$this->{$this->model}->insert_image( [
											'product_id' => $id,
											'images'     => $this->upload->data()['file_name']
										] );
									}
								}
							}
							$response = [
								'type'    => 'success',
								'message' => 'Your product successfully added'
							];

                            if($this->input->post( 'request' ) == 'update'){
                                redirect( site_url_multi( 'product' ).'/'.$user->slug.'/view/'.$id );

                            }else{
                                redirect( site_url_multi( 'pages' ).'/'.$user->slug.'/products' );
                            }

						}
					} else {
						$this->form_validation->set_rules( 'herbals', translate( 'herbals' ), 'trim|required' );
						$this->form_validation->set_rules( 'animals', translate( 'animals' ), 'trim|required' );
						$this->form_validation->set_rules( 'cass', translate( 'cass' ), 'trim|required' );
						$this->form_validation->set_rules( 'atc_codes', translate( 'atc_codes' ), 'trim|required' );
						$response = [
							'type'    => 'danger',
							'message' => validation_errors()
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
					'message' => 'Failed request'
				];
			}
		} else {
			$response = [
				'type'    => 'error',
				'message' => 'You are not logged in'
			];
		}
		$this->session->set_flashdata( 'message', $response );
		redirect( site_url_multi( 'product' ).'/'.$user->slug );
	}


	public function update( $id ) {

		if ( $id ) {
			$this->data['product'] = $this->{$this->model}->filter( [ 'id' => $id ] )->with_translation()->one();
			if ( $this->data['product'] ) {
				/* ---------------------------------------------[HERBAL]-------------------------------------------------- */
				$this->data['herbals']    = $this->Plants_model->filter( [ 'status' => '1' ] )->fields( [
					'id',
					'name'
				] )->limit( 50, 1 )->with_translation()->all();
				$this->data['herb_parts'] = $this->Herb_part_model->fields( [
					'id',
					'name'
				] )->with_translation()->all();
				$this->data['herb_forms'] = $this->Herb_form_model->fields( [
					'id',
					'name'
				] )->with_translation()->all();
				/* ---------------------------------------------[ANIMAL]-------------------------------------------------- */
				$this->data['animals']      = $this->Animal_model->filter( [ 'status' => '1' ] )->fields( [
					'id',
					'name'
				] )->limit( 50, 1 )->with_translation()->all();
				$this->data['animal_parts'] = $this->Animal_part_model->fields( [
					'id',
					'name'
				] )->with_translation()->all();
				$this->data['animal_forms'] = $this->Animal_form_model->fields( [
					'id',
					'name'
				] )->with_translation()->all();
				/* --------------------------------------------[CHEMICAL]------------------------------------------------- */
				$this->data['chemichal'] = $this->Atc_code_model->filter( [ 'status' => '1' ] )->fields( [
					'id',
					'atc_code',
					'meaning'
				] )->limit( 50, 1 )->filter( [ 'CHAR_LENGTH(atc_code)' => 7 ] )->with_translation()->all();
				/* --------------------------------------------[CAS NUMBER]----------------------------------------------- */
				$this->data['cas_numbers'] = $this->Cas_list_model->filter( [ 'status' => '1' ] )->fields( [
					'id',
					'chemical_name',
					'cas_no',
					'molecular_formula'
				] )->limit( 50, 1 )->with_translation()->all();
				/* -------------------------------------------[DOSSAAGE FORM]--------------------------------------------- */
				$this->data['drug_types'] = $this->Drug_type_model->filter( [ 'status' => '1' ] )->fields( [
					'id',
					'name'
				] )->with_translation()->all();
				/* ---------------------------------------------[MEDICALS]------------------------------------------------ */
				$this->data['medicals'] = $this->Medical_classifiction_model->filter( [ 'status' => '1' ] )->fields( [
					'id',
					'name'
				] )->limit( 50, 1 )->with_translation()->all();
				$this->data['unit']     = $this->Unit_model->fields( [
					'id',
					'name',
					'short_name'
				] )->with_translation()->all();
				$this->data['puritys']  = $this->Purity_unit_model->fields( [
					'id',
					'name',
					'code'
				] )->with_translation()->all();
				$this->data['countrys'] = $this->Country_model->fields( [
					'id',
					'name',
					'code'
				] )->with_translation()->all();
				// PRODUCT TYPE
				$this->data['product_type'] = $this->Product_type_model->fields( [
					'id',
					'name'
				] )->with_translation()->all();
				$this->data['parent_atcs']  = $this->Atc_code_model->fields( [
					'id',
					'atc_code',
					'meaning'
				] )->filter( [ 'CHAR_LENGTH(atc_code)' => 7 ] )->with_translation()->all();
				$this->db->where( 'product_id', $id );
				$product_query                = $this->db->get( 'product_images' );
				$this->data['product_images'] = [];
				if ( $product_query->num_rows() ) {
					$resultsx = $product_query->result();
					foreach ( $resultsx as $resultx ) {
						$this->data['product_images'][] = [
							'image_id' => $resultx->image_id,
							'image'    => $resultx->images
						];
					}
				}
				foreach ( $this->data['parent_atcs'] as $atc ) {
					$result[] = [
						'value' => $atc->id,
						'name'  => $atc->atc_code . " | " . $atc->meaning
					];
				}
				$this->data['parent_cal'] = json_encode( $result );
				$this->data['title']      = translate( 'title_edit' );



                $this->template->render( 'product/edit-product' );
			} else {
				$this->template->render( '404' );
			}
		} else {
			$this->template->render( '404' );
		}
	}


	public function delete( $id = false ) {
		if ( $id ) {
            $user = $this->data['UserData'];

			$product = $this->Product_model->filter( [ 'user_id' => $user->id, 'company_id' => $user->company_id, 'id' => $id ] )->one();
			if ( $product ) {
				$this->Product_model->delete_pr( $id );
				$this->Product_model->delete_translation( $id );
                redirect( site_url_multi( 'pages' ).'/'.$user->slug.'/products' );
			}
		}
	}


	public function get_chemical() {
		$this->data['chemical_id'] = (int) $this->input->post( 'chemical_id' );
		echo get_atc_code_no( $this->data['chemical_id'] );
	}

	public function get_herbal() {
		$this->data['herbal_id'] = (int) $this->input->post( 'herbal_id' );
		echo get_herbal_name( $this->data['herbal_id'] );
	}

	public function get_animal() {
		$this->data['animal_id'] = (int) $this->input->post( 'animal_id' );
		echo get_animal_name( $this->data['animal_id'] );
	}

	public function get_cas_number() {
		$this->data['cas_number_id'] = (int) $this->input->post( 'cas_number_id' );
		echo get_cas_name( $this->data['cas_number_id'] );
	}

	public function get_packing_type() {
		$this->data['packing_type_id'] = (int) $this->input->post( 'packing_type_id' );
		echo get_packing_type_name( $this->data['packing_type_id'] );
	}

	public function get_medical_class() {
		$this->data['medical_id'] = (int) $this->input->post( 'medical_id' );
		echo get_selected_medical_extra( $this->data['medical_id'] );
	}

	public function get_product_type() {
		$this->data['product_type_id'] = (int) $this->input->post( 'product_type_id' );
		echo get_product_type_name( $this->data['product_type_id'] );
	}

	public function volume_unit() {
		$this->data['unit_id'] = (int) $this->input->post( 'unit_id' );
		echo get_unit_name( $this->data['unit_id'] );
	}

	public function more() {
		if ( $this->input->method() == 'post' ) {
			$this->data['product_id'] = (int) $this->input->post( 'product_id' );
			$product                  = $this->Product_model->filter( [ 'id' => $this->data['product_id'] ] )->with_translation()->one();
			$this->output->set_content_type( 'application/json' )->set_output( json_encode( $product ) );
		}
	}

	public function copy( $id = false ) {
		if ( $id ) {
            $user = $this->data['UserData'];

			$product = $this->Product_model->filter( [ 'user_id' => $user->id, 'company_id' => $user->company_id, 'id' => $id ] )->one();
			$copy_id = $id;
			if ( $product ) {
				$product_data             = [
					'user_id'      => $user->id,
					'company_id'      => $user->company_id,
					'checked'      => $product->checked,
					'country'      => $product->country,
					'packing_type' => $product->packing_type,
					'herbal'       => $product->herbal,
					'atc_code'     => $product->atc_code,
					'animal'       => $product->animal,
					'cas'          => $product->cas,
					'medical_cl'   => $product->medical_cl,
					'pr_type'      => $product->pr_type,
					'equipment'    => $product->equipment,
					'moq'          => $product->moq,
					'shelf_life'   => $product->shelf_life,
					'ctd'          => $product->ctd,
					'be'           => $product->be
				];
				$id                       = $this->{$this->model}->insert( $product_data );
				$product_translation      = $this->Product_model->filter( [
					'user_id' => $this->data['user']['id'],
					'id'      => $copy_id
				] )->with_translation()->one();
				$product_translation_data = [
					'product_id'  => $id,
					'language_id' => 1,
					'title'       => $product_translation->title,
					'alias'       => $product_translation->alias,
					'description' => $product_translation->description,
					'storage'     => $product_translation->storage
				];
				$this->{$this->model}->insert_translation( $product_translation_data );
				$get_product_images = $this->Product_model->get_product_images( [ '*' ], [ 'product_id' => $copy_id ] );
				foreach ( $get_product_images as $key => $value ) {
					$array = [
						'product_id' => $id,
						'images'     => $value['images']
					];
					$this->{$this->model}->insert_image( $array );
				}
                redirect( site_url_multi( 'product' ).'/'.$user->slug );
			}
		}
	}

	public function type() {
		if ( $this->input->method() == 'post' && $this->input->is_ajax_request() ) {
			$this->data['product_type_id'] = $this->input->post( 'value' );
			$this->data['product_type']    = $this->Product_type_model->filter( [ 'id' => $this->data['product_type_id'] ] )->fields( [
				'id',
				'language_id',
				'name',
				'animal_visible',
				'brandName_visible',
				'medicalClassifiction_visible',
				'casNumber_visible',
				'chemical_visible',
				'country_visible',
				'dossageForm_visible',
				'herbal_visible',
				'moreInfo_visible',
				'herbal_multiple',
				'dossageForm_multiple',
				'casNumber_multiple',
				'medicalClassifiction_multiple',
				'chemical_multiple'
			] )->with_translation()->all();
			echo json_encode( $this->data['product_type'], true );
		}
	}

	public function search() {
		if ( $this->input->method() == 'post' && $this->input->is_ajax_request() ) {
			$limit  = 400;
			$offset = 0;
			$value  = trim( $this->input->post( 'value' ) );
			$types  = $this->input->post( 'types' );
			if ( $types == 'chemical' ) {
				$filter   = [
					"(atc_code LIKE '%" . $value . "%' or meaning LIKE '%" . $value . "%')" => null,
					'CHAR_LENGTH(atc_code)'                                                 => 7
				];
				$atc_code = $this->Atc_code_model->fields( [
					'id',
					'atc_code',
					'meaning'
				] )->filter( $filter )->limit( $limit, 0 )->with_translation()->all();
				//	print_r($this->db->last_query());
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $atc_code ) );
			} else if ( $types == 'herbal' ) {
				$filter = [ "name LIKE '%" . $value . "%'" => null ];
				$herbal = $this->Plants_model->fields( [
					'id',
					'name'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $herbal ) );
			} else if ( $types == 'animal' ) {
				$filter = [ "name LIKE '%" . $value . "%'" => null ];
				$animal = $this->Animal_model->fields( [
					'id',
					'name'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $animal ) );
			} else if ( $types == 'casNumber' ) {
				$filter      = [ "(chemical_name LIKE '%" . $value . "%' or cas_no LIKE '%" . $value . "%')" => null ];
				$cas_numbers = $this->Cas_list_model->fields( [
					'id',
					'chemical_name',
					'cas_no',
					'molecular_formula'
				] )->filter( $filter )->limit( $limit, 0 )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $cas_numbers ) );
			} else if ( $types == 'dossageForm' ) {
				$filter      = [ "name LIKE '%" . $value . "%'" => null ];
				$dossageForm = $this->Packing_type_model->fields( [
					'id',
					'name'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $dossageForm ) );
			} else if ( $types == 'medicalClassification' ) {
				$filter                = [ "name LIKE '%" . $value . "%'" => null ];
				$medicalClassification = $this->Medical_classifiction_model->fields( [
					'id',
					'name'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $medicalClassification ) );
			} else {
				return false;
			}
		}
	}

	public function ajax() {
		if ( $this->input->method() == 'post' && $this->input->is_ajax_request() ) {
			$limit    = ( $this->input->post( 'limit' ) ) ? (int) $this->input->post( 'limit' ) : 50;
			$offset   = ( $this->input->post( 'offset' ) ) ? (int) $this->input->post( 'offset' ) : 1;
			$key      = $this->input->post( 'key' );
			$periodic = $this->input->post( 'periodic' );
			if ( $periodic == 'chemical' ) {
				$filter   = [ "atc_code LIKE '%" . $key . "%'" => null, 'CHAR_LENGTH(atc_code)' => 7 ];
				$atc_code = $this->Atc_code_model->fields( [
					'id',
					'atc_code',
					'meaning'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $atc_code ) );
			} else if ( $periodic == 'herbal' ) {
				$filter = [ "name LIKE '%" . $key . "%'" => null ];
				$herbal = $this->Plants_model->fields( [
					'id',
					'name'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $herbal ) );
			} else if ( $periodic == 'animal' ) {
				$filter = [ "name LIKE '%" . $key . "%'" => null ];
				$animal = $this->Animal_model->fields( [
					'id',
					'name'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $animal ) );
			} else if ( $periodic == 'casNumber' ) {
				$filter      = [ "chemical_name LIKE '%" . $key . "%'" => null ];
				$cas_numbers = $this->Cas_list_model->fields( [
					'id',
					'chemical_name',
					'cas_no',
					'molecular_formula'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $cas_numbers ) );
			} else if ( $periodic == 'dossageForm' ) {
				$filter      = [ "name LIKE '%" . $key . "%'" => null ];
				$dossageForm = $this->Packing_type_model->fields( [
					'id',
					'name'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $dossageForm ) );
			} else if ( $periodic == 'medicalClassification' ) {
				$filter                = [ "name LIKE '%" . $key . "%'" => null ];
				$medicalClassification = $this->Medical_classifiction_model->fields( [
					'id',
					'name'
				] )->filter( $filter )->limit( $limit, $offset )->with_translation()->all();
				$this->output->set_content_type( 'application/json' )->set_output( json_encode( $medicalClassification ) );
			} else {
				return false;
			}
		}
	}

	public function atc_code() {
		$this->form_validation->set_rules( 'query', 'Query', 'trim|required' );
		if ( $this->input->method() == 'post' && $this->input->is_ajax_request() ) {
			if ( $this->form_validation->run() ) {
				$query    = (string) $this->input->post( 'query' );
				$filter   = [
					"atc_code LIKE '%" . $query . "%'" => null,
					'CHAR_LENGTH(atc_code)'            => 7
				];
				$atc_code = $this->Atc_code_model->fields( [
					'id',
					'atc_code',
					'meaning'
				] )->filter( $filter )->limit( '20', 1 )->with_translation()->all();
			} else {
				$filter   = [
					'CHAR_LENGTH(atc_code)' => 7
				];
				$atc_code = $this->Atc_code_model->fields( [
					'id',
					'atc_code',
					'meaning'
				] )->filter( $filter )->limit( '20', 1 )->with_translation()->all();
			}
			if ( isset( $atc_code ) && ! empty( $atc_code ) ) {
				foreach ( $atc_code as $atc ) {
					$result[] = [
						'value' => $atc->id,
						'name'  => $atc->atc_code
					];
				}
			}
		} else {
			$result = [];
		}
		$this->output->set_content_type( 'application/json' )->set_output( json_encode( $result ) );
	}

	public function delete_image() {
		if ( $this->input->method() == 'post' ) {
			$this->data['image_id'] = (int) $this->input->post( 'image_id' );
			$delete_images          = $this->Product_model->delete_image( $this->data['image_id'] );
			if ( $delete_images ) {
				echo 'true';
			} else {
				echo 'false';
			}
		}
	}

	public function view( $slug = null ) {
		if ( $slug == null ) {
			show_404();
		} else {
			$url_match = explode( "-", $slug );
			if ( isset( $url_match[0] ) ) {
                $user = $this->data['UserData'];

				$this->data['product_id'] = (int) $url_match[0];
				$this->data['product']    = $this->Product_model->fields( '*' )->filter( [ 'id' => $this->data['product_id'] ] )->with_translation( $this->data['current_lang_id'] )->one();
				$this->data['title']      = ( $this->data['product'] && ! is_null( $this->data['product']->title ) && $this->data['product']->title != '' ) ? $this->data['product']->title . ' | Makromedicine.com' : translate( 'title_view' );
				if ( $this->data['product'] ) {
					$this->db->where( 'product_id', $this->data['product']->id );
					$product_query                = $this->db->get( 'product_images' );
					$this->data['product_images'] = [];
					if ( $product_query->num_rows() ) {
						$resultsx = $product_query->result();
						foreach ( $resultsx as $resultx ) {
							$this->data['product_images'][] = [
								'image_id' => $resultx->image_id,
								'image'    => $resultx->images
							];
						}
					}
					$this->data['company']        = $user;
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
					/* INSERT STATISTICS */
					$country_id = $this->data['ip_country']->id;
					$ip         = $_SERVER['REMOTE_ADDR'];

					$atc_codes_str = '';
					$atc_code_pr   = json_decode( $this->data['product']->atc_code );
					if ( count( $atc_code_pr ) > 0 ) {
						foreach ( $atc_code_pr as $k => $val ) {
							$atc_codes_str .= get_atc_code_name( $val->id ) . ',';
						}
					}
					$atc_codes_str = rtrim( $atc_codes_str, ',' );
					if ( $atc_codes_str != '' ) {
						$query_st = $this->db->get_where( 'wc_ip_filter', [
							'section' => 'atc',
							'ip'      => $ip,
							'type'    => $atc_codes_str
						] );
						if ( ! $query_st || $query_st->num_rows() == 0 ) {


							$data  = array(
								'section' => 'atc',
								'type'    => $atc_codes_str,
								'country' => $country_id,
								'month'   => date( 'm' ),
								'year'    => date( 'Y' )
							);
							$query = $this->db->get_where( 'wc_statistics', $data );
							if ( $query && $query->num_rows() > 0 ) {
								if ( isset( $_GET['test11'] ) ) {
									echo 'increase';
								}
								$res = $query->result()[0];
								$this->db->set( 'value', 'value+1', false );
								$this->db->where( 'id', $res->id );
								$this->db->update( 'wc_statistics' );
							} else {
								if ( isset( $_GET['test11'] ) ) {
									echo 'insert';
								}
								$data['value'] = 1;
								$this->db->insert( 'wc_statistics', $data );
							}
							$this->db->insert( 'wc_ip_filter', [
								'section'  => 'atc',
								'ip'       => $ip,
								'type'     => $this->data['product_id'],
								'add_date' => time()
							] );

						}
					}
					$query_st = $this->db->get_where( 'wc_ip_filter', [
						'section' => 'product',
						'ip'      => $ip,
						'type'    => $this->data['product_id']
					] );

					if ( ! $query_st || $query_st->num_rows() == 0 ) {
						$data  = array(
							'section' => 'product',
							'type'    => $this->data['product_id'],
							'country' => $country_id,
							'month'   => date( 'm' ),
							'year'    => date( 'Y' )
						);
						$query = $this->db->get_where( 'wc_statistics', $data );
						if ( $query && $query->num_rows() > 0 ) {
							$res = $query->result()[0];
							$this->db->set( 'value', 'value+1', false );
							$this->db->where( 'id', $res->id );
							$this->db->update( 'wc_statistics' );
						} else {
							$data['value'] = 1;
							$this->db->insert( 'wc_statistics', $data );
						}
						$this->db->insert( 'wc_ip_filter', [
							'section'  => 'product',
							'ip'       => $ip,
							'type'     => $this->data['product_id'],
							'add_date' => time()
						] );
					}

					$query_st = $this->db->get_where( 'wc_ip_filter', [
						'section' => 'country',
						'ip'      => $ip,
						'type'    => $this->data['product']->country
					] );
					if ( ! $query_st || $query_st->num_rows() == 0 ) {
						$data  = array(
							'section' => 'country',
							'type'    => $this->data['product']->country,
							'country' => $country_id,
							'month'   => date( 'm' ),
							'year'    => date( 'Y' )
						);
						$query = $this->db->get_where( 'wc_statistics', $data );
						if ( $query && $query->num_rows() > 0 ) {
							if ( isset( $_GET['test11'] ) ) {
								echo 'increase country';
							}
							$res = $query->result()[0];
							$this->db->set( 'value', 'value+1', false );
							$this->db->where( 'id', $res->id );
							$this->db->update( 'wc_statistics' );
						} else {
							if ( isset( $_GET['test11'] ) ) {
								echo 'insert country';
							}
							$data['value'] = 1;
							$this->db->insert( 'wc_statistics', $data );
						}
						$this->db->insert( 'wc_ip_filter', [
							'section'  => 'country',
							'ip'       => $ip,
							'type'     => $this->data['product_id'],
							'add_date' => time()
						] );
					}
					$atc_codes_str = '';
					$atc_code_pr   = json_decode( $this->data['product']->cas );
					if ( count( $atc_code_pr ) > 0 ) {
						foreach ( $atc_code_pr as $k => $val ) {
							$atc_codes_str .= $val->id . ',';
						}
					}
					$atc_codes_str = rtrim( $atc_codes_str, ',' );
					if ( $atc_codes_str != '' ) {

						$query_st = $this->db->get_where( 'wc_ip_filter', [
							'section' => 'cas',
							'ip'      => $ip,
							'type'    => $atc_codes_str
						] );
						if ( ! $query_st || $query_st->num_rows() == 0 ) {

							$data  = array(
								'section' => 'cas',
								'type'    => $atc_codes_str,
								'country' => $country_id,
								'month'   => date( 'm' ),
								'year'    => date( 'Y' )
							);
							$query = $this->db->get_where( 'wc_statistics', $data );
							if ( $query && $query->num_rows() > 0 ) {
								if ( isset( $_GET['test11'] ) ) {
									echo 'increase country';
								}
								$res = $query->result()[0];
								$this->db->set( 'value', 'value+1', false );
								$this->db->where( 'id', $res->id );
								$this->db->update( 'wc_statistics' );
							} else {
								if ( isset( $_GET['test11'] ) ) {
									echo 'insert country';
								}
								$data['value'] = 1;
								$this->db->insert( 'wc_statistics', $data );
							}

							$this->db->insert( 'wc_ip_filter', [
								'section'  => 'cas',
								'ip'       => $ip,
								'type'     => $this->data['product_id'],
								'add_date' => time()
							] );
						}
					}
					$atc_codes_str = '';
					$atc_code_pr   = json_decode( $this->data['product']->herbal );
					if ( count( $atc_code_pr ) > 0 ) {
						foreach ( $atc_code_pr as $k => $val ) {
							$atc_codes_str .= $val->id . ',';
						}
					}
					$atc_codes_str = rtrim( $atc_codes_str, ',' );
					if ( $atc_codes_str != '' ) {
						$query_st = $this->db->get_where( 'wc_ip_filter', [
							'section' => 'herbal',
							'ip'      => $ip,
							'type'    => $atc_codes_str
						] );
						if ( ! $query_st || $query_st->num_rows() == 0 ) {

							$data  = array(
								'section' => 'herbal',
								'type'    => $atc_codes_str,
								'country' => $country_id,
								'month'   => date( 'm' ),
								'year'    => date( 'Y' )
							);
							$query = $this->db->get_where( 'wc_statistics', $data );
							if ( $query && $query->num_rows() > 0 ) {
								if ( isset( $_GET['test12'] ) ) {
									echo 'inc';
								}
								$res = $query->result()[0];
								$this->db->set( 'value', 'value+1', false );
								$this->db->where( 'id', $res->id );
								$this->db->update( 'wc_statistics' );
							} else {
								if ( isset( $_GET['test12'] ) ) {
									echo 'insert';
								}
								$data['value'] = 1;
								$this->db->insert( 'wc_statistics', $data );
							}

							$this->db->insert( 'wc_ip_filter', [
								'section'  => 'herbal',
								'ip'       => $ip,
								'type'     => $this->data['product_id'],
								'add_date' => time()
							] );
						}
					}
					$atc_codes_str = '';
					$atc_code_pr   = json_decode( $this->data['product']->animal );
					if ( count( $atc_code_pr ) > 0 ) {
						foreach ( $atc_code_pr as $k => $val ) {
							$atc_codes_str .= $val->id . ',';
						}
					}
					$atc_codes_str = rtrim( $atc_codes_str, ',' );
					if ( $atc_codes_str != '' ) {
						$query_st = $this->db->get_where( 'wc_ip_filter', [
							'section' => 'animal',
							'ip'      => $ip,
							'type'    => $atc_codes_str
						] );
						if ( ! $query_st || $query_st->num_rows() == 0 ) {

							$data  = array(
								'section' => 'animal',
								'type'    => $atc_codes_str,
								'country' => $country_id,
								'month'   => date( 'm' ),
								'year'    => date( 'Y' )
							);
							$query = $this->db->get_where( 'wc_statistics', $data );
							if ( $query && $query->num_rows() > 0 ) {

								$res = $query->result()[0];
								$this->db->set( 'value', 'value+1', false );
								$this->db->where( 'id', $res->id );
								$this->db->update( 'wc_statistics' );
							} else {

								$data['value'] = 1;
								$this->db->insert( 'wc_statistics', $data );
							}
							$this->db->insert( 'wc_ip_filter', [
								'section'  => 'animal',
								'ip'       => $ip,
								'type'     => $this->data['product_id'],
								'add_date' => time()
							] );
						}
					}


                    $this->data['user_following'] = $this->Follow_model->fields( [ 'count(*) as count' ] )->filter( [ 'follower_id' => $this->data['product']->user_id ] )->one()->count;
                    $this->data['user_followers'] = $this->Follow_model->fields( [ 'count(*) as count' ] )->filter( [ 'followed_user' => $this->data['product']->user_id ] )->one()->count;
                    $this->data['active_menu']=4;
                    if ( $this->data['is_loggedin'] == false ) {
                        $this->data['check_follow'] = 0;
                    } else {
                        $this->data['check_follow'] = $this->Follow_model->check_follow( [
                            'follower_id' => $this->data['product']->user_id,
                            'followed_user' => $this->data['product']->user_id
                        ] );
                    }

                    

                    $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user->id, 'company_id' => $user->company_id])->one();


                    $this->data['selected_product_type']       = json_decode( $user->product_type );



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

                    $this->data['get_standart'] = $this->User_model->get_standart([ 'user_id' => $user->id ], 'wc_standart_translation.name st_name ,wc_user_standart_image.*' );

                    $this->data['unit']     = $this->Unit_model->fields( [
                        'id',
                        'name',
                        'short_name'
                    ] )->with_translation()->all();

                    $this->data['puritys'] = $this->Purity_unit_model->fields( [
                        'id',
                        'name',
                        'code'
                    ] )->with_translation()->all();





					/* * * */
					$this->template->render( 'product/view' );
				} else {
					$this->template->render( '404' );
				}
			} else {
				$this->template->render( '404' );
			}
		}
	}

	public function getCompanyListAll() {

		$segment_array              = $this->uri->segment_array();
		$page                       = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
		$this->data['limit']        = [ 'per_page' => 50, 'page' => $page ];

		/*$this->data['companies']    = $this->User_model->fields( [
			'id',
			'slug'
		] )->filter( [
			'checked'                              => 1,
			'status'                               => 1,
			'(isvisible is NULL or isvisible = 0)' => null,
			'user_groups_id in(2,3,4)'             => null
		] )->limit( $this->data['limit']['per_page'], ( $this->data['limit']['page'] - 1 ) * $this->data['limit']['per_page'] )->all();

		$this->data['total_rows']   = $this->User_model->filter( [
			'checked'                  => 1,
			'status'                   => 1,
			'user_groups_id in(2,3,4)' => null
		] )->get_count_rows();*/

        $this->data['companies']    = $this->User_model->getUserData(["c.checked" => 1, "c.status" => 1], true);

		$config['use_page_numbers'] = true;
		$config['base_url']         = site_url_multi( 'company-list' );
		$config['total_rows']       = $this->data['total_rows'];
		$config['per_page']         = $this->data['limit']['per_page'];
		$this->pagination->initialize( $config );
		$this->data['pagination'] = $this->pagination->create_links();
		$this->template->render( 'prlist' );
	}

}
