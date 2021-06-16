<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Consultation extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper( 'news' );
		$this->load->helper( 'extra' );
		$this->load->library( "phpmailer_library" );

		

	}

	public function index() {
		$this->load->model( 'Page_model' );
		$this->data['get_about'] = $this->Page_model->filter( [ 'id' => 2, 'status' => 1 ] )->fields( [
			'id',
			'image',
			'title',
			'description'
		] )->with_translation()->one();
		if ( $this->data['get_about'] ) {
			$this->template->render( 'consultation/consultation' );
		} else {
			$this->template->render( 'erorr/404' );
		}
	}

	public function services( $page = false ) {
		$this->load->model( 'Services_model' );
		if ( $page == false || ! is_numeric( $page ) ) {
			$page = 1;
		}
		$this->data['limit']        = [ 'per_page' => 9, 'page' => $page ];
		$this->data['get_services'] = $this->Services_model->order_by( 'sort', 'ASC' )->filter( [ 'status' => 1 ] )->with_translation()->limit( $this->data['limit']['per_page'], $this->data['limit']['page'] )->all();

		$this->data['total_rows']     = $this->Services_model->get_count_rows();
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
		$config['base_url']           = site_url_multi( 'consultation/services' );
		$config['total_rows']         = $this->data['total_rows'];
		$config['per_page']           = $this->data['limit']['per_page'];

		$this->pagination->initialize( $config );
		$this->data['pagination'] = $this->pagination->create_links();
		$this->template->render( 'consultation/services' );
	}

	public function view( $services_slug = null ) {
		if ( $services_slug != null ) {
			$this->load->model( 'Services_model' );
			$this->data['get_service'] = $this->Services_model->filter( [
				'status' => 1,
				'slug'   => $services_slug
			] )->with_translation()->one();
			if ( $this->data['get_service'] ) {
				$this->data['get_services_country'] = $this->Services_model->get_services_country( 'country_id', [ 'services_id' => $this->data['get_service']->id ] );
				if ( $this->data['get_services_country'] ) {
					$country = '';
					foreach ( $this->data['get_services_country'] as $key => $value ) {
						$country .= $value['country_id'] . ",";
					}
					$country                   = rtrim( $country, ',' );
					$this->data['get_country'] = $this->Country_model->filter( [ 'id IN(' . $country . ')' => null ] )->with_translation()->all();
					if ( $this->data['get_country'] ) {
						$this->template->render( 'consultation/view' );
					} else {
						$this->template->render( 'error/404' );
					}
				} else {
					$this->template->render( 'error/404' );
				}
			} else {
				$this->template->render( 'error/404' );
			}
		} else {
			$this->template->render( 'error/404' );
		}
	}

	public function country( $country_id = false ) {
		$this->load->model( 'Services_model' );
		$this->load->model( 'Legislation_model' );
		if ( $country_id != false ) {
			$this->data['get_country'] = $this->Country_model->filter( [ 'id' => $country_id ] )->with_translation()->one();
			if ( $this->data['get_country'] ) {
				$this->data['get_services_country'] = $this->Services_model->get_services_country( 'services_id', [ 'country_id' => $this->data['get_country']->id ] );

				if ( $this->data['get_services_country'] ) {
					$services = '';
					foreach ( $this->data['get_services_country'] as $key => $value ) {
						$services .= $value['services_id'] . ",";
					}
					$services                      = rtrim( $services, ',' );
					$this->data['get_services']    = $this->Services_model->filter( [ 'id IN(' . $services . ')' => null ] )->with_translation()->all();
					$this->data['get_legislation'] = $this->Legislation_model->order_by( 'sort', 'DESC' )->filter( [ 'status' => 1 ] )->fields( [
						'id',
						'name',
						'file'
					] )->with_translation()->all();
					$this->template->render( 'consultation/country' );
				} else {
					$this->template->render( 'error/404' );
				}
			} else {
				$this->template->render( 'error/404' );
			}
		} else {
			$this->template->render( 'error/404' );
		}
	}

	public function legislation( $country = false, $page = false ) {
		$this->load->model( 'Legislation_model' );

		if ( $country != false ) {
			$this->data['country_id'] = $country;
			if ( $page == false || ! is_numeric( $page ) ) {
				$page = 1;
			}
			$this->data['limit']           = [ 'per_page' => 15, 'page' => $page ];
			$this->data['get_legislation'] = $this->Legislation_model->order_by( 'sort', 'DESC' )->filter( [ 'status' => 1 ] )->fields( [
				'id',
				'name',
				'file'
			] )->with_translation()->limit( $this->data['limit']['per_page'], $this->data['limit']['page'] )->all();

			$this->data['total_rows']     = $this->Legislation_model->get_count_rows();
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
			$config['base_url']           = site_url_multi( 'consultation/legislation' );
			$config['total_rows']         = $this->data['total_rows'];
			$config['per_page']           = $this->data['limit']['per_page'];

			$this->pagination->initialize( $config );
			$this->data['pagination'] = $this->pagination->create_links();

			$this->template->render( 'consultation/ledislation_country' );
		} else {
			$this->data['countries_count'] = [];
			$this->data['get_legislation'] = $this->Legislation_model->getLegislationCount();
			if ( $this->data['get_legislation'] != false ) {
				foreach ( $this->data['get_legislation'] as $value ) {
					$this->data['countries_count'][ $value['country'] ] = $value;
				}
			}
			$this->template->render( 'consultation/legislation' );
		}
	}

	public function order() {
		$this->data['child_services'] = [];
		$this->load->model( 'Services_model' );
		$this->load->model( 'Parent_services_model' );
		$this->load->model( 'Standart_model' );
		$this->load->model( 'Drug_type_model' );

		$this->data['get_parent_services'] = $this->Parent_services_model->filter( [ 'status' => 1 ] )->with_translation()->all();
		$this->data['get_child_services']  = $this->Services_model->filter( [
			'status'         => 1,
			'parent_id != 0' => null
		] )->with_translation()->all();
		$this->data['get_standarts']       = $this->Standart_model->filter( [ 'status' => 1 ] )->fields( [
			'id',
			'name'
		] )->with_translation()->all();
		$this->data['get_packing_type']    = $this->Packing_type_model->filter( [ 'status' => 1 ] )->fields( [
			'id',
			'name'
		] )->with_translation()->all();
		//$this->data['get_packing_type']     = $this->Drug_type_model->filter(['status'=>1])->fields(['id', 'name'])->with_translation()->all();

		if ( $this->data['get_child_services'] ) {
			foreach ( $this->data['get_child_services'] as $key => $value ) {
				$this->data['child_services'][ $value->parent_id ][] = $value;
			}
		}

		if ( $this->input->get( 'success' ) == 'true' ) {
			$this->data['success_message'] = 'Your request has been successfully sent. We will give you a response back after your company has checked.';
		} else {
			$this->data['success_message'] = false;
		}
		$this->template->render( 'consultation/order' );
	}

	public function form() {
		if ( $this->input->method() == 'post' ) {
			$this->form_validation->set_rules( 'company_name', 'Company name', 'trim|required' );
			$this->form_validation->set_rules( 'responsible_person', 'Responsible person', 'trim|required' );
			$this->form_validation->set_rules( 'phone_number', 'Phone number', 'trim|required' );
			$this->form_validation->set_rules( 'email_address', 'Email', 'trim|required' );
			$this->form_validation->set_rules( 'services', 'Services', 'trim|required' );
			$this->form_validation->set_rules( 'description', 'More information', 'trim|required' );

			if ( $this->form_validation->run() ) {
				if ( $this->input->post( 'standart' ) != null ) {
					if ( $this->input->post( 'country' ) != null ) {
						$this->data['company_name']       = $this->input->post( 'company_name' );
						$this->data['responsible_person'] = $this->input->post( 'responsible_person' );
						$this->data['phone_number']       = $this->input->post( 'phone_number' );
						$this->data['email_address']      = $this->input->post( 'email_address' );
						$this->data['services']           = $this->input->post( 'services' );
						$this->data['description']        = $this->input->post( 'description' );
						$this->data['standart']           = $this->input->post( 'standart' );
						$this->data['country']            = $this->input->post( 'country' );

						$this->data['company_country']  = implode( ', ', $this->data['country'] );
						$this->data['company_standart'] = implode( ', ', $this->data['standart'] );
						$product                        = [];
						if ( $this->input->post( 'content' ) != null ) {
							$product_country = [];
							foreach ( $this->input->post( 'content' ) as $key => $value ) {
								if ( isset( $this->input->post( 'product_country' )[ $key ] ) ) {
									$product_country[ $key ] = '';
									foreach ( $this->input->post( 'product_country' )[ $key ] as $countries ) {
										$product_country[ $key ] .= $countries . ",";
									}
									$product_country[ $key ] = rtrim( $product_country[ $key ], ',' );
								} else {
									$product_country[ $key ] = 'No Select Country';
								}

								$product[] = [
									'content'      => $this->input->post( 'content' )[ $key ],
									'packing_type' => $this->input->post( 'packing_type' )[ $key ],
									'product_type' => $this->input->post( 'product_type' )[ $key ],
									'dosier_be'    => ( $this->input->post( 'be' )[ $key ] != 0 ) ? 'Yes' : 'No',
									'dosier_ctd'   => ( $this->input->post( 'ctd' )[ $key ] != 0 ) ? 'Yes' : 'No',
									'countries'    => $product_country[ $key ]
								];
							}

							$message = '';
							$message .= '<table border=1>';
							$message .= '<tr>';
							$message .= '<td>Company Name</td>';
							$message .= '<td>' . $this->data['company_name'] . '</td>';
							$message .= '</tr>';

							$message .= '<tr>';
							$message .= '<td>Responsible Person</td>';
							$message .= '<td>' . $this->data['responsible_person'] . '</td>';
							$message .= '</tr>';

							$message .= '<tr>';
							$message .= '<td>Email Address</td>';
							$message .= '<td>' . $this->data['email_address'] . '</td>';
							$message .= '</tr>';

							$message .= '<tr>';
							$message .= '<td>Phone Number</td>';
							$message .= '<td>' . $this->data['phone_number'] . '</td>';
							$message .= '</tr>';

							$message .= '<tr>';
							$message .= '<td>Standard</td>';
							$message .= '<td>' . $this->data['company_standart'] . '</td>';
							$message .= '</tr>';

							$message .= '<tr>';
							$message .= '<td>Country</td>';
							$message .= '<td>' . $this->data['company_country'] . '</td>';
							$message .= '</tr>';

							$message .= '<tr>';
							$message .= '<td>Consulting Services</td>';
							$message .= '<td>' . $this->data['services'] . '</td>';
							$message .= '</tr>';

							$message .= '<tr>';
							$message .= '<td>General information</td>';
							$message .= '<td>' . $this->data['description'] . '</td>';
							$message .= '</tr>';
							$message .= '</table>';

							if ( $product ) {
								$message .= '<table border=1>';

								$message .= '<tr>';
								$message .= '<th>№</th>';
								$message .= '<th>Content</th>';
								$message .= '<th>Packing Type</th>';
								$message .= '<th>Product Type</th>';
								$message .= '<th>Country</th>';
								$message .= '<th>Dossier Format BE</th>';
								$message .= '<th>Dossier Format CTD</th>';
								$message .= '</tr>';

								foreach ( $product as $secret => $product_num ) {
									$num     = $secret + 1;
									$message .= '<tr>';
									$message .= '<td>' . $num . '</td>';
									$message .= '<td>' . $product_num['content'] . '</td>';
									$message .= '<td>' . $product_num['packing_type'] . '</td>';
									$message .= '<td>' . $product_num['product_type'] . '</td>';
									$message .= '<td>' . $product_num['dosier_be'] . '</td>';
									$message .= '<td>' . $product_num['dosier_ctd'] . '</td>';
									$message .= '<td>' . $product_num['countries'] . '</td>';
									$message .= '</tr>';
								}

								$message .= '</table>';
							}


							$mail = $this->phpmailer_library->load();
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

							//Recipients
							$mail->setFrom( 'support@makromedicine.com', 'Makromedicine.com' );
							$mail->addAddress( 'consultation@makromedicine.com' );

							// Content
							$mail->isHTML( true );
							$mail->Subject = 'Order form';
							$mail->Body    = $message;


							if ( $mail->send() ) {
								$response = [
									'type'    => 'success',
									'message' => 'Thank you. Your order has been successfully sent.'
								];
							} else {
								$response = [
									'type'    => 'danger',
									'message' => 'System error please try again !'
								];
							}

						} else {
							$response = [
								'type'    => 'danger',
								'message' => 'The product content is not null'
							];
						}
					} else {
						$response = [
							'type'    => 'danger',
							'message' => 'The Country field is required.'
						];
					}
				} else {
					$response = [
						'type'    => 'danger',
						'message' => 'The Standard field is required.'
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
}
