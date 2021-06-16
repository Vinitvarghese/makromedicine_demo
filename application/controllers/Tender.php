<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Tender extends Site_Controller {
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
		$this->load->model( 'Continent_model' );
		$this->load->model( 'Trade_term_model' );
		$this->load->model( 'Tender_model' );
		$this->load->helper( 'extra' );

		
	}

	public function index() {
		if ( ! $this->auth->is_loggedin() ) {
			redirect( '/', 'refresh' );
			exit();
		}
		$this->data['title'] = translate( 'title' );
		/* ---------------------------------------------[HERBAL]-------------------------------------------------- */
		// HERABL
		$this->data['herbals'] = $this->Plants_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'name'
		] )->limit( 50, 1 )->with_translation()->all();
		// HERB PART
		$this->data['herb_parts'] = $this->Herb_part_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		// HERB FORM
		$this->data['herb_forms'] = $this->Herb_form_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		/* ---------------------------------------------[ANIMAL]-------------------------------------------------- */
		// ANIMALS
		$this->data['animals'] = $this->Animal_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'name'
		] )->limit( 50, 1 )->with_translation()->all();
		// ANIMALS PART
		$this->data['animal_parts'] = $this->Animal_part_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		// ANIMALS FORM
		$this->data['animal_forms'] = $this->Animal_form_model->fields( [ 'id', 'name' ] )->with_translation()->all();
		/* --------------------------------------------[CHEMICAL]------------------------------------------------- */
		// CHEMICAL NAME
		$this->data['chemichal'] = $this->Atc_code_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'atc_code',
			'meaning'
		] )->limit( 50, 1 )->filter( [ 'CHAR_LENGTH(atc_code)' => 7 ] )->with_translation()->all();
		/* --------------------------------------------[CAS NUMBER]----------------------------------------------- */  // CAS NUMBER
		$this->data['cas_numbers'] = $this->Cas_list_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'chemical_name',
			'cas_no',
			'molecular_formula'
		] )->limit( 50, 1 )->with_translation()->all();
		/* -------------------------------------------[DOSSAAGE FORM]--------------------------------------------- */  // DOSSAAGE FORM
		$this->data['dossageforms'] = $this->Packing_type_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'name'
		] )->limit( 50, 1 )->with_translation()->order_by( 'fr', 'desc' )->order_by( 'name', 'asc' )->all();
		$this->data['drug_types']   = $this->Drug_type_model->filter( [ 'status' => '1' ] )->fields( [
			'id',
			'name'
		] )->with_translation()->all();
		/* ---------------------------------------------[MEDICALS]------------------------------------------------ */
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
		$this->data['countrys']   = $this->Country_model->fields( [ 'id', 'name', 'code' ] )->with_translation()->all();
		$this->data['continents'] = $this->Continent_model->fields( [
			'id',
			'name',
			'code'
		] )->with_translation()->all();
		$this->data['trade_term'] = $this->Trade_term_model->fields( [
			'id',
			'short_name',
			'name'
		] )->with_translation()->all();

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
		$this->data['tenders']    = $this->Tender_model->filter( [ 'user_id' => $this->data['user']['id'] ] )->with_translation()->all();
		$this->data['message']    = $this->session->flashdata( 'message' );

		/*echo "<pre>";
		print_r($this->data['tenders']);
		die();*/

		if ( ! isset( $_GET['demo'] ) ) {
			$this->template->render( 'tender/add-tender' );
		} else {
			$this->template->render( 'tender/add-tender-demo' );
		}
	}


	public function add() {
		if ( $this->auth->is_loggedin() ) {
			$this->form_validation->set_rules( 'pr_type', translate( 'pr_type' ), 'trim|required' );
			$this->form_validation->set_rules( 'trade_term', translate( 'trade_term' ), 'trim|required' );
			$this->form_validation->set_rules( 'country', translate( 'country' ), 'trim|required' );
			$this->form_validation->set_rules( 'continent', translate( 'continent' ), 'trim|required' );
			$this->form_validation->set_rules( 'tenderstart', translate( 'tenderstart' ), 'trim|required' );
			$this->form_validation->set_rules( 'tenderend', translate( 'tenderend' ), 'trim|required' );
			$this->form_validation->set_rules( 'title', translate( 'title' ), 'trim|required' );
			if ( $this->input->method() == 'post' ) {
				if ( $this->form_validation->run() ) {
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
						$tender_data = [
							'user_id'      => $this->data['user']['id'],
							'checked'      => 0,
							'continent'    => (int) $this->input->post( 'continent' ),
							'country'      => (int) $this->input->post( 'country' ),
							'packing_type' => json_encode( $packing_type ),
							'herbal'       => json_encode( $herbal ),
							'atc_code'     => json_encode( $atc_code ),
							'animal'       => json_encode( $animal ),
							'cas'          => json_encode( $cas ),
							'pr_type'      => (int) $this->input->post( 'pr_type' ),
							'trade_term'   => (int) $this->input->post( 'trade_term' ),
							'startdate'    => $this->input->post( 'tenderstart' ),
							'enddate'      => $this->input->post( 'tenderend' ),
							'equipment'    => '',
							'moq'          => $this->input->post( 'moq' ),
							'ctd'          => ( $this->input->post( 'ctd' ) != null ) ? '1' : '0',
							'be'           => ( $this->input->post( 'be' ) != null ) ? '1' : '0'
						];
						if ( $this->input->post( 'request' ) == 'add' ) {
							$id = $this->{$this->model}->insert( $tender_data );
						} elseif ( $this->input->post( 'request' ) == 'update' ) {
							$id = (int) $this->input->post( 'tender_id' );
							$this->{$this->model}->update( $tender_data, $id );
						}
						if ( $id ) {
							if ( $this->input->post( 'request' ) == 'update' ) {
								$this->{$this->model}->delete_translation( $id );
							}
							$tender_translation_data = [
								'tender_id'   => $id,
								'language_id' => 1,
								'title'       => $title,
								'alias'       => slug( $this->input->post( 'title' ) ),
								'description' => $this->input->post( 'description' ),
								'storage'     => $this->input->post( 'storage' )
							];
							$this->{$this->model}->insert_translation( $tender_translation_data );


							/*if(isset($_FILES['userfile']) &&count($_FILES['userfile']['name']) > 0)
							{
									$directory = DIR_IMAGE . 'catalog/product';
									$config = array();
									$config['upload_path']   =  $directory;
									$config['allowed_types'] = 'gif|jpg|png';
									$config['overwrite']     =  FALSE;
									$this->load->library('upload');
									$files = $_FILES;
									$total = count($files['userfile']['name']);
									unset($_FILES);
									foreach($files['userfile']['name'] as $i => $value)
									{
											$_FILES['userfile']['name']= $files['userfile']['name'][$i];
											$_FILES['userfile']['type']= $files['userfile']['type'][$i];
											$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
											$_FILES['userfile']['error']= $files['userfile']['error'][$i];
											$_FILES['userfile']['size']= $files['userfile']['size'][$i];
											$this->upload->initialize($config);
											if (!$this->upload->do_upload('userfile'))
											{
													$json['error'] = $this->upload->display_errors();
											}
											else
											{
													$this->{$this->model}->insert_image(['tender_id' => $id, 'images'=>$files['userfile']['name'][$i]]);
											}
									}
							}*/

							$response = [
								'type'    => 'success',
								'message' => 'Your tender successfully added'
							];

							Redirect( site_url_multi( '/tender' ), 'location' );
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
		redirect( site_url_multi( 'tender' ) );
	}


	public function update( $id ) {
		if ( $id ) {
			$this->data['tender'] = $this->{$this->model}->filter( [ 'id' => $id ] )->with_translation()->one();
			if ( $this->data['tender'] ) {
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
				$this->data['unit']       = $this->Unit_model->fields( [
					'id',
					'name',
					'short_name'
				] )->with_translation()->all();
				$this->data['puritys']    = $this->Purity_unit_model->fields( [
					'id',
					'name',
					'code'
				] )->with_translation()->all();
				$this->data['countrys']   = $this->Country_model->fields( [
					'id',
					'name',
					'code'
				] )->with_translation()->all();
				$this->data['continents'] = $this->Continent_model->fields( [
					'id',
					'name',
					'code'
				] )->with_translation()->all();
				$this->data['trade_term'] = $this->Trade_term_model->fields( [
					'id',
					'short_name',
					'name'
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

				/*$this->db->where('tender_id', $id);
				$product_query = $this->db->get('product_images');
				$this->data['product_images'] = [];
				if($product_query->num_rows())
				{
					$resultsx = $product_query->result();
					foreach($resultsx as $resultx)
					{
						$this->data['product_images'][] = [
							'image_id' => $resultx->image_id,
							'image'     => $resultx->images
						];
					}
				}*/

				foreach ( $this->data['parent_atcs'] as $atc ) {
					$result[] = [
						'value' => $atc->id,
						'name'  => $atc->atc_code . " | " . $atc->meaning
					];
				}
				$this->data['parent_cal'] = json_encode( $result );
				$this->data['title']      = translate( 'title_edit' );
				if ( ! isset( $_GET['demo'] ) ) {
					$this->template->render( 'tender/edit-tender' );
				} else {
					$this->template->render( 'tender/edit-tender-demo' );
				}
			} else {
				$this->template->render( '404' );
			}
		} else {
			$this->template->render( '404' );
		}
	}


	public function delete( $id = false ) {
		if ( $id ) {
			$tender = $this->Tender_model->filter( [ 'user_id' => $this->data['user']['id'], 'id' => $id ] )->one();
			if ( $tender ) {
				$this->Tender_model->delete_pr( $id );
				$this->Tender_model->delete_translation( $id );
				redirect( site_url_multi( 'tender/' ), 'location' );
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
			$this->data['tender_id'] = (int) $this->input->post( 'tender_id' );
			$product                 = $this->Tender_model->filter( [ 'id' => $this->data['tender_id'] ] )->with_translation()->one();
			$this->output->set_content_type( 'application/json' )->set_output( json_encode( $product ) );
		}
	}

	public function copy( $id = false ) {
		if ( $id ) {
			$tender  = $this->Tender_model->filter( [ 'user_id' => $this->data['user']['id'], 'id' => $id ] )->one();
			$copy_id = $id;
			if ( $tender ) {
				$tender_data             = [
					'user_id'      => $tender->user_id,
					'checked'      => $tender->checked,
					'continent'    => $tender->continent,
					'country'      => $tender->country,
					'packing_type' => $tender->packing_type,
					'herbal'       => $tender->herbal,
					'atc_code'     => $tender->atc_code,
					'animal'       => $tender->animal,
					'cas'          => $tender->cas,
					'pr_type'      => $tender->pr_type,
					'trade_term'   => $tender->trade_term,
					'startdate'    => $tender->startdate,
					'enddate'      => $tender->enddate,
					'equipment'    => $tender->equipment,
					'moq'          => $tender->moq,
					'ctd'          => $tender->ctd,
					'be'           => $tender->be
				];
				$id                      = $this->{$this->model}->insert( $tender_data );
				$tender_translation      = $this->Tender_model->filter( [
					'user_id' => $this->data['user']['id'],
					'id'      => $copy_id
				] )->with_translation()->one();
				$tender_translation_data = [
					'tender_id'   => $id,
					'language_id' => 1,
					'title'       => $tender_translation->title,
					'alias'       => $tender_translation->alias,
					'description' => $tender_translation->description,
					'storage'     => $tender_translation->storage
				];
				$this->{$this->model}->insert_translation( $tender_translation_data );

				/*$get_product_images = $this->Tender_model->get_product_images(['*'],['tender_id'=>$copy_id]);
				foreach ($get_product_images as $key=> $value)
				{
					$array = [
						'tender_id'    => $id,
						'images'        => $value['images']
					];
					$this->{$this->model}->insert_image($array);
				}*/

				redirect( site_url_multi( 'tender/' ), 'location' );
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
			$delete_images          = $this->Tender_model->delete_image( $this->data['image_id'] );
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
				$this->data['tender_id'] = (int) $url_match[0];
				$this->data['tender']    = $this->Tender_model->fields( '*' )->filter( [ 'id' => $this->data['tender_id'] ] )->with_translation( $this->data['current_lang_id'] )->one();
				$this->data['title']     = ( $this->data['tender'] && ! is_null( $this->data['tender']->title ) && $this->data['tender']->title != '' ) ? $this->data['tender']->title . ' | Makromedicine.com' : translate( 'title_view' );
				if ( $this->data['tender'] ) {
					/*
					$this->db->where('tender_id', $this->data['tender']->id);
					$product_query = $this->db->get('product_images');
					$this->data['product_images'] = [];
					if($product_query->num_rows())
					{
							$resultsx = $product_query->result();
							foreach($resultsx as $resultx)
							{
									$this->data['product_images'][] = [
											'image_id' => $resultx->image_id,
											'image'     => $resultx->images
									];
							}
					}*/


					$this->data['company']        = $this->User_model->filter( [ 'id' => $this->data['tender']->user_id ] )->one();
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
					$atc_code_pr   = json_decode( $this->data['tender']->atc_code );
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
								'type'     => $this->data['tender_id'],
								'add_date' => time()
							] );
						}
					}
					$query_st = $this->db->get_where( 'wc_ip_filter', [
						'section' => 'product',
						'ip'      => $ip,
						'type'    => $this->data['tender_id']
					] );

					if ( ! $query_st || $query_st->num_rows() == 0 ) {
						$data  = array(
							'section' => 'product',
							'type'    => $this->data['tender_id'],
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
							'type'     => $this->data['tender_id'],
							'add_date' => time()
						] );
					}

					$query_st = $this->db->get_where( 'wc_ip_filter', [
						'section' => 'country',
						'ip'      => $ip,
						'type'    => $this->data['tender']->country
					] );
					if ( ! $query_st || $query_st->num_rows() == 0 ) {
						$data  = array(
							'section' => 'country',
							'type'    => $this->data['tender']->country,
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
							'type'     => $this->data['tender_id'],
							'add_date' => time()
						] );
					}
					$atc_codes_str = '';
					$atc_code_pr   = json_decode( $this->data['tender']->cas );
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
								'type'     => $this->data['tender_id'],
								'add_date' => time()
							] );
						}
					}
					$atc_codes_str = '';
					$atc_code_pr   = json_decode( $this->data['tender']->herbal );
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
								'type'     => $this->data['tender_id'],
								'add_date' => time()
							] );
						}
					}
					$atc_codes_str = '';
					$atc_code_pr   = json_decode( $this->data['tender']->animal );
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
								'type'     => $this->data['tender_id'],
								'add_date' => time()
							] );
						}
					}

					/* * * */
					$this->template->render( 'tender/view' );
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
		$this->data['companies']    = $this->User_model->fields( [
			'id',
			'company_name',
			'slug'
		] )->filter( [
			'checked'                              => 1,
			'status'                               => 1,
			'(isvisible is NULL or isvisible = 0)' => null,
			'user_groups_id in(2,3,4)'             => null
		] )->limit( $this->data['limit']['per_page'], ( $this->data['limit']['page'] - 1 ) * $this->data['limit']['per_page'] )->order_by( 'company_name' )->all();
		$this->data['total_rows']   = $this->User_model->filter( [
			'checked'                  => 1,
			'status'                   => 1,
			'user_groups_id in(2,3,4)' => null
		] )->get_count_rows();
		$config['use_page_numbers'] = true;
		$config['base_url']         = site_url_multi( 'company-list' );
		$config['total_rows']       = $this->data['total_rows'];
		$config['per_page']         = $this->data['limit']['per_page'];
		$this->pagination->initialize( $config );
		$this->data['pagination'] = $this->pagination->create_links();
		$this->template->render( 'prlist' );
	}
	/*public function import_product_data()
	{
		$this->data['products'] = $this->Tender_model->fields(['id', 'packing_type', 'atc_code', 'herbal', 'animal', 'cas', 'medical_cl'])->all();
		foreach ($this->data['products'] as $key => $value)
		{
			$packing_type   = json_decode($value->packing_type);
			$atc_code       = json_decode($value->atc_code);
			$herbals        = json_decode($value->herbal);
			$animals        = json_decode($value->animal);
			$cas_numbers    = json_decode($value->cas);
			$medical_cl     = explode(',', $value->medical_cl);
			//echo '<pre>';
			if(is_array($packing_type) && !empty($packing_type))
			{
				foreach ($packing_type as $packing)
				{
					$array_packing = array(
						'tender_id'        => $value->id,
						'packing_type_id'   => $packing->id,
						'mdoza'             => $packing->mdoza,
						'vdoza'             => $packing->vdoza,
						'mdoza2'            => $packing->mdoza2,
						'vdoza2'            => $packing->vdoza2,
					);
					if(!empty($packing->id)){
						$this->db->insert('product_packing_type', $array_packing);
					}
					// insert
					//$this->Tender_model->insert_relation('wc_product_packing_type', $array_packing);
				}
			}
			if(is_array($atc_code) && !empty($atc_code))
			{
				foreach ($atc_code as $chemical)
				{
					$array_chemical = array(
						'tender_id'    => $value->id,
						'chemical_id'   => $chemical->id,
						'mdoza'         => $chemical->mdoza,
						'vdoza'         => $chemical->vdoza,
						'mdoza2'        => $chemical->mdoza2,
						'vdoza2'        => $chemical->vdoza2
					);
					// insert
					//$this->Tender_model->insert_relation('wc_product_chemical', $array_chemical);
					if (!empty($chemical->id)){
						//$this->Tender_model->insert_relation('wc_product_chemical', $array_chemical);
						$this->db->insert('product_chemical', $array_chemical);
					}
				}
			}
			if(is_array($herbals) && !empty($herbals))
			{
				foreach ($herbals as $herbal) {
					$array_herbal = array(
						'tender_id'    => $value->id,
						'herbal_id'     => $herbal->id,
						'mdoza'         => $herbal->mdoza,
						'vdoza'         => $herbal->vdoza,
						'part'          => $herbal->part,
						'form'          => $herbal->form,
					);
					// insert
					//$this->Tender_model->insert_relation('wc_product_herbal', $array_herbal);
					if(!empty($herbal->id)){
						//$this->Tender_model->insert_relation('wc_product_herbal', $array_herbal);
						$this->db->insert('product_herbal', $array_herbal);
					}
				}
			}
			if(is_array($animals) && !empty($animals))
			{
				foreach ($animals as $animal) {
					$array_animal = array(
						'tender_id'    => $value->id,
						'herbal_id'     => $animal->id,
						'mdoza'         => $animal->mdoza,
						'vdoza'         => $animal->vdoza,
						'part'          => $animal->part,
						'form'          => $animal->form,
					);
					// insert
					//$this->Tender_model->insert_relation('wc_product_animal', $array_animal);
					if(!empty($animal->id)){
						//$this->Tender_model->insert_relation('wc_product_animal', $array_animal);
						$this->db->insert('product_animal', $array_animal);
					}
				}
			}
			if(is_array($cas_numbers) && !empty($cas_numbers))
			{
				foreach ($cas_numbers as $cas_number) {
					$array_cas_number = array(
						'tender_id'    => $value->id,
						'cas_id'        => $cas_number->id,
						'mdoza'         => $cas_number->mdoza,
						'vdoza'         => $cas_number->vdoza,
						'mdoza2'        => $cas_number->mdoza2,
						'vdoza2'        => $cas_number->vdoza2,
						'purity_unit'   => $cas_number->purity_unit,
						'purity'        => $cas_number->purity,
						'atc_code'      => $cas_number->atc_code
					);
					// insert
					//$this->Tender_model->insert_relation('wc_product_cas', $array_cas_number);
					if(!empty($cas_number->id)){
						//$this->Tender_model->insert_relation('wc_product_cas', $array_cas_number);
						$this->db->insert('product_cas', $array_cas_number);
					}
				}
			}
			if(is_array($medical_cl) && !empty($medical_cl))
			{
				foreach($medical_cl as $medical)
				{
					$array_mdeical = array(
						'tender_id'    => $value->id,
						'medical_cl_id' => $medical
					);
					// insert
					//$this->Tender_model->insert_relation('wc_product_medical_cl', $array_mdeical);
					if(!empty($medical)){
						//$this->Tender_model->insert_relation('wc_product_medical_cl', $array_mdeical);
						$this->db->insert('product_medical_cl', $array_mdeical);
					}
				}
			}
		}
	}*/
}
