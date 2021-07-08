<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Search extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'User_model' );
		$this->load->model( 'Product_model' );
		$this->load->model( 'Home_model' );
		$this->load->model( 'Search_model' );
		$this->load->model( 'Tender_model' );
		$this->load->helper( 'extra' );
		$this->load->library( 'Ssp' );

		
	}

	public function index() {

	    $this->data['search_page']=true;

		$this->data['title'] = translate( 'title' );


		if ( $this->input->get( 'search_type' ) != null ) {
			if ( $this->input->get( 'search_type' ) == 3 ) {
				$this->data['search_type'] = $this->input->get( 'search_type' );
                $this->data['company_ids'] = (isset($_GET['company_ids']) && !empty($_GET['company_ids'])) ? json_encode($this->input->get( 'company_ids' )) : json_encode([]);

				$filter                    = [];
				// PRODUCT TYPE
				if ( $this->input->get( 'pr_type' ) != null ) {
					$this->data['pr_type'] = $this->input->get( 'pr_type' );
					
					if (is_array($this->data['pr_type']) && !in_array('all', $this->data['pr_type'])) {
						$filter['product.pr_type IN (' . implode(',', $this->input->get('pr_type')) . ')'] = null;
					}
				}



				// COMPANY
				if ( $this->input->get( 'company_ids' ) != null ) {
					$this->data['company_id'] = $this->input->get( 'company_ids' );

					if (is_array($this->data['pr_type']) && !in_array('all', $this->data['company_id'])) {
						if ($this->input->get('standart') != null) {
							$this->data['search_standart'] = $this->input->get('standart');
							$standart_filter               = [];
							if (gettype($this->data['search_standart']) == 'array') {
								$this->load->model('User_standart_model');
								$standart_filter['standart_id IN (' . implode(',', $this->data['search_standart']) . ')'] = null;

								$this->data['standart_user'] = $this->User_standart_model->fields('user_id')->filter($standart_filter)->group_by('user_id')->all();

								if ($this->data['standart_user']) {
									$users_id = [];
									foreach ($this->data['standart_user'] as $key) {
										array_push($users_id, $key->user_id);
									}
									foreach ($this->input->get('company_ids') as $key) {
										array_push($users_id, $key);
									}
									$result = array_unique($users_id);
									sort($result);
									$this->data['standart_user_id']                                           = implode(',', $result);
									$filter['product.company_id IN (' . $this->data['standart_user_id'] . ')'] = null;
								}
							}
						} else {
							$filter['product.company_id IN (' . implode(',', $this->data['company_id']) . ')'] = null;
						}
					}
				} else {
					// USER STANDART
					if ($this->input->get('standart') != null) {
						$this->data['search_standart'] = $this->input->get('standart');

						if (is_array($this->data['search_standart']) && !in_array('all',
							$this->data['search_standart']
						)) {
							$standart_filter               = [];
							if (gettype($this->data['search_standart']) == 'array') {
								$this->load->model('User_standart_model');
								$standart_filter['standart_id IN (' . implode(',', $this->data['search_standart']) . ')'] = null;
								$this->data['standart_user']                                                                  = $this->User_standart_model->fields('user_id')->filter($standart_filter)->group_by('user_id')->all();
								if ($this->data['standart_user']) {
									$users_id = [];
									foreach ($this->data['standart_user'] as $key) {
										array_push($users_id, $key->user_id);
									}
									$this->data['standart_user_id'] = implode(',', $users_id);
									if ($this->data['standart_user_id']) {
										$filter['product.user_id IN (' . $this->data['standart_user_id'] . ')'] = null;
									}
								}
							}
						}
					}
				}

				// CONTINENT
				if ( $this->input->get( 'continent' ) != null ) {
					$this->data['search_continent'] = $this->input->get( 'continent' );

					if (is_array($this->data['search_continent']) && !in_array('all', $this->data['search_continent'])) {
						$cont_filter = '(';
						foreach ($this->data['search_continent'] as $continent_key => $continent_val) {
							$cont_filter .= 'product.country IN (select id from wc_country where continent_id="' . $continent_val . '") OR ';
						}

						$cont_filter = rtrim($cont_filter, 'OR ');
						$cont_filter .= ')';

						$filter[$cont_filter] = null;
					}

				}
				// COUNTRY
				if ( $this->input->get( 'country' ) != null ) {
					$this->data['search_country']                                   = $this->input->get( 'country' );
					if (is_array($this->data['search_country']) && !in_array('all', $this->data['search_country'])) {
						$filter['product.country = ' . $this->data['search_country']] = null;
					}
				}
				// CONTENT TYPE
				if ( $this->input->get( 'content_type' ) != null ) {
					$this->data['content_types'] = $this->input->get( 'content_type' );
					if (is_array($this->data['content_types']) && !in_array('all', $this->data['content_types'])) {
						$filter['product.poly']      = $this->data['content_types'][0];
					}
				}
				// STATUS
				if ( $this->input->get( 'group_id' ) != null ) {
					$this->data['search_status']                                                        = $this->input->get( 'group_id' );
					if (is_array($this->data['search_status']) && !in_array('all', $this->data['search_status'])) {
						$filter['groups.id IN (' . implode(',', $this->input->get('group_id')) . ')'] = null;
					}
				}

				// ATC CLASSIFICATION
				if ( $this->input->get( 'atc_classifiction' ) != null ) {
					/*$this->data['atc_classifiction'] = $this->input->get('atc_classifiction');
										$filter['atc_code_id in (select id from wc_atc_code where id_parent in(select id from wc_atc_code where id_parent in(select id from wc_atc_code where id_parent in('.implode(',', $this->data['atc_classifiction']).'))))'] = NULL;*/

					$this->data['atc_classifiction'] = $this->input->get( 'atc_classifiction' );

					if (is_array($this->data['atc_classifiction']) && !in_array('all', $this->data['atc_classifiction'])) {
						$like = array();
						foreach ($this->data['atc_classifiction'] as $key => $value) {
							$atc_id                = get_atc_code_id($value);
							$like[]                = 'product.atc_code like \'%' . $atc_id . '%\'';
							$this->data['keyword'] = $value;
						}
						$like            = '(' . implode(' or ', $like) . ')';
						$filter[$like] = null;
					}
				}

				//CAS

				if ( $this->input->get( 'casno' ) != null ) {
					/*$this->data['atc_classifiction'] = $this->input->get('atc_classifiction');
										$filter['atc_code_id in (select id from wc_atc_code where id_parent in(select id from wc_atc_code where id_parent in(select id from wc_atc_code where id_parent in('.implode(',', $this->data['atc_classifiction']).'))))'] = NULL;*/

					$this->data['casno'] = $this->input->get( 'casno' );

					if (is_array($this->data['casno']) && !in_array('all', $this->data['casno'])) {
						$like = array();
						foreach ($this->data['casno'] as $key => $value) {
							$like[]                = 'cas like "%' . $value . '%"';
							$this->data['keyword'] = $value;
						}
						$like            = '(' . implode(' or ', $like) . ')';
						$filter[$like] = null;
					}


				}

				// SEARCH KEYWORD
				if ( $this->input->get( 'title' ) != null && $this->input->get( 'title' ) != '' ) {
					$this->data['keyword'] = $this->input->get( 'title' );
					$atcgetid              = get_atc_code_id_from_mn( $this->input->get( 'title' ) );
					$atcstr                = '';
					$casstr                = '';
					if ( $atcgetid !== false ) {
						foreach ( $atcgetid as $getid_value ) {
							$atcstr .= ' OR product.atc_code like \'%"id":"' . $getid_value . '"%\'';
						}

					} else {

						$atcgetid = get_atc_code_id_like( $this->input->get( 'title' ) );

						if ( $atcgetid !== false ) {
							foreach ( $atcgetid as $getid_value ) {
								$atcstr .= ' OR product.atc_code like \'%"id":"' . $getid_value . '"%\'';
							}
						} else {
							$casgetid = get_cas_id_from_no( $this->input->get( 'title' ) );

							if ( $casgetid !== false ) {
								foreach ( $casgetid as $getid_value ) {
									$casstr .= ' OR product.cas like \'%"id":"' . $getid_value . '"%\'';
								}
							} else {
								$casgetid = get_cas_id_from_name( $this->input->get( 'title' ) );

								if ( $casgetid !== false ) {
									foreach ( $casgetid as $getid_value ) {
										$casstr .= ' OR product.cas like \'%"id":"' . $getid_value . '"%\'';
									}
								}

							}

						}

					}

					$filter[ '(product_translation.title LIKE "%' . $this->input->get( 'title' ) . '%"
									  OR  animal_translation.name LIKE "%' . $this->input->get( 'title' ) . '%"
									  OR  plants_translation.name LIKE "%' . $this->input->get( 'title' ) . '%"
								
									  OR  product_type_translation.name LIKE "%' . $this->input->get( 'title' ) . '%"
									  OR  medical_classifiction_translation.name LIKE "%' . $this->input->get( 'title' ) . '%"
									  OR  companies.company_name LIKE "%' . $this->input->get( 'title' ) . '%"
									  OR  packing_type_translation.name LIKE "%' . $this->input->get( 'title' ) . '%" ' . $atcstr . ' ' . $casstr . '
									  )' ] = null;
				}
				$filter['product_translation.title is not null']                                                                                                    = null;
				$filter['wc_product.company_id in (select id from wc_companies where deleted_at is null and checked=1 and (isvisible is null or isvisible = 0))'] = null;

				$order_by = [ 'column' => 'product_translation.title', 'sort' => 'ASC' ];

				$fields = [
					'product.id',
					'product.user_id',
					'product.pr_type',
					'product.atc_code',
					'product.herbal',
					'product.animal',
					'product.cas',
					'product.packing_type',
					'product.country',
					'product.medical_cl',
					'product_translation.title',
					'product_translation.alias',
					'companies.standart',
					'groups.id as status',
					'animal_translation.name',
					'plants_translation.name',
					/*	'cas_list_translation.chemical_name',
									'cas_list_translation.cas_no',
									'cas_list_translation.molecular_formula',*/
					/*	'atc_code_translation.atc_code_id as atc_code_id',
									'atc_code_translation.atc_code as atc_code_name',*/
					'medical_classifiction_translation.name',
					'packing_type_translation.name',
					'companies.company_name',
					'companies.slug AS company_slug'
				];
				$this->load->model( 'Search_model' );
				$filter['product.checked=1']          = null;
				$filter['companies.status!=0']          = null;
				$filter['product.deleted_at is NULL'] = null;

				/*echo "<pre>";
				print_r($filter); exit;*/


				/***/

				//if(isset($_GET['test1'])){

				$statistics = array();

				$ip = $_SERVER['REMOTE_ADDR'];

				if ( isset( $this->data['content_types'] ) && isset( $this->data['content_types'][0] ) ) {
					$content_type_st                        = $this->data['content_types'][0];
					$statistics['poly'][ $content_type_st ] = 1;
				}
				if ( isset( $this->data['pr_type'] ) ) {
					$ptype_st = $this->data['pr_type'];
					foreach ( $ptype_st as $key => $value ) {
						$statistics['pr_type'][ $value ] = 1;
					}
				}
				if ( isset( $this->data['search_continent'] ) ) {
					$continent = $this->data['search_continent'];
					foreach ( $continent as $key => $value ) {
						$statistics['continent'][ $value ] = 1;

						$query_country = $this->db->select( 'id' )->like( 'continent_id', $value )->get( 'wc_country' )->result();
						foreach ( $query_country as $key => $value ) {
							$statistics['country'][ $value->id ] = 0.1;
						}
					}
				}
				if ( isset( $this->data['search_status'] ) ) {
					$status_st = $this->data['search_status'];
					foreach ( $status_st as $key => $value ) {
						$statistics['status'][ $value ] = 1;
					}
				}
				if ( isset( $this->data['atc_classifiction'] ) ) {
					$atc_st = $this->data['atc_classifiction'];
					foreach ( $atc_st as $key => $value ) {
						$statistics['atc'][ $value ] = 1;
					}
				}
				if ( isset( $this->data['search_standart'] ) ) {
					$standart_st = $this->data['search_standart'];
					foreach ( $standart_st as $key => $value ) {
						$statistics['standart'][ $value ] = 1;
					}
				}
				if ( isset( $this->data['company_id'] ) ) {
					$user_st = $this->data['company_id'];
					foreach ( $user_st as $key => $value ) {
						$statistics['company'][ $value ] = 1;
					}
				}

				$country_id = $this->data['ip_country']->id;

				//print_r($statistics);

				foreach ( $statistics as $key => $value ) {
					foreach ( $value as $key1 => $val1 ) {

						$query_st = $this->db->get_where( 'wc_ip_filter', [
							'section' => $key,
							'ip'      => $ip,
							'type'    => $key1
						] );
						if ( ! $query_st || $query_st->num_rows() == 0 ) {
							$data = array(
								'section' => $key,
								'type'    => $key1,
								// 'value' =>$val1,
								'country' => $country_id,
								'month'   => date( 'm' ),
								'year'    => date( 'Y' )
							);

							$query = $this->db->get_where( 'wc_statistics', $data );

							if ( $query && $query->num_rows() > 0 ) {
								$res = $query->result()[0];
								if ( $res->section != 'country' ) {
									$this->db->set( 'value', 'value+1', false );
								} else if ( $res->section == 'country' ) {
									$this->db->set( 'value', 'value+0.1', false );
								}
								$this->db->where( 'id', $res->id );
								$this->db->update( 'wc_statistics' );
							} else {
								if ( $data['section'] != 'country' ) {
									$data['value'] = 1;
								} else {
									$data['value'] = 0.1;
								}
								$this->db->insert( 'wc_statistics', $data );
							}


							$this->db->insert( 'wc_ip_filter', [
								'section'  => $key,
								'type'     => $key1,
								'ip'       => $ip,
								'add_date' => time()
							] );
						}
					}
				}
				//}

                $new_filter=[];

				foreach ($filter as $k => $v){
				    $new_filter[]=$k;
                }

				$new_filter=implode(' OR ', $new_filter);



				/***/
				 $products=$this->Search_model->fields( $fields )->filter($filter)/*->filter2($new_filter)*/->with_user()->with_company()->with_group()->with_animal()->with_herbal()->with_chemical()->with_medical_cl()->with_packing_type()->with_product_type()->with_translation()->group_by( 'id' )->order_by( $order_by['column'], $order_by['sort'] );



                $this->data['products'] =$products->all();

				$_SESSION['lastsearchquery'] = $this->db->last_query();

				$this->template->render( 'search/search_data' );

			}
			elseif ( $this->input->get( 'search_type' ) == 5 ) {

				$this->data['search_type']    = $this->input->get( 'search_type' );
				$this->data['keyword']    = $this->input->get( 'title' );

				$this->data['event_continent'] = null !== $this->input->get( 'event_continent' ) ? $this->input->get( 'event_continent' ) : [];
				$this->data['event_country'] = null !== $this->input->get( 'event_country' ) ? $this->input->get( 'event_country' ) : [];
				$this->data['search_standart'] = null !== $this->input->get( 'standart' ) ? $this->input->get( 'standart' ) : [];
				$this->data['pr_type'] = null !== $this->input->get( 'pr_type' ) ? $this->input->get( 'pr_type' ) : [];
				$this->data['search_status'] = null !== $this->input->get('group_id') ? $this->input->get('group_id') : [];

				$this->data['dt_event_continent'] = json_encode($this->data['event_continent']);
				$this->data['dt_event_country'] = json_encode($this->data['event_country']);
				$this->data['dt_search_standart'] = json_encode($this->data['search_standart']);
				$this->data['dt_pr_type'] = json_encode($this->data['pr_type']);
				$this->data['dt_search_status'] = json_encode($this->data['search_status']);
				$this->data['company_ids'] = (isset($_GET['company_ids']) && !empty($_GET['company_ids'])) ? json_encode($this->input->get( 'company_ids' )) : json_encode([]);




				$filter                       = [];

				// SEARCH KEYWORD
				if ( $this->input->get( 'title' ) != null && $this->input->get( 'title' ) != '' ) {
					$search_string = $this->input->get( 'title' );
				}

				$this->load->model( 'User_model' );
				/*$this->data['products'] = $this->User_model->get_company_details();

								$_SESSION['lastsearchquery'] = $this->db->last_query();

								if (isset($_GET['test'])){
									echo $_SESSION['lastsearchquery'];
								}*/
				// $this->data['countrys']   = $this->Country_model->fields( [ 'id', 'name', 'code' ] )->with_translation()->all();



				$this->template->render( 'search/search_company' );
			}
			else if ( $this->input->get( 'search_type' ) == 1 ) {
				$this->data['search_type'] = $this->input->get( 'search_type' );
				$filter                    = [];

				if ( $this->input->get( 'event_type' ) != null ) {
					$this->data['event_type_con'] = (int) $this->input->get( 'event_type' );

					if (!in_array('all', $this->data['event_type_con'])) {
						$filter['type_id']            = (int) $this->input->get('event_type');
					}
				}

				if ( $this->input->get( 'event_country' ) != null ) {
					$this->data['event_continent'] = $this->input->get( 'event_continent' );
					//$this->debug($this->data['event_continent']);
				}

				if ( $this->input->get( 'event_country' ) != null ) {
					$this->data['event_country'] = $this->input->get('event_country');

					if (!in_array('all', $this->data['event_country'])) {
						$filter['wc_companies.country_id IN (' . implode(',', $this->data['event_country']) . ')'] = null;
					}
				}

				if ( $this->input->get( 'start' ) != null ) {
					$this->data['event_start']                                                                            = $this->input->get( 'start' );
					$filter[ "start_date >= '" . date( "Y-m-d H:i:s", strtotime( $this->input->get( 'start' ) ) ) . "'" ] = null;
				}

				if ( $this->input->get( 'end' ) != null ) {
					$this->data['event_end']                                                                          = $this->input->get( 'end' );
					$filter[ "end_date <= '" . date( "Y-m-d H:i:s", strtotime( $this->input->get( 'end' ) ) ) . "'" ] = null;
				}

				if ( $this->input->get( 'title' ) != null ) {
					$this->data['keyword']                                                                                                         = $this->input->get( 'title' );
					$filter[ '(name LIKE "%' . $this->input->get( 'title' ) . '%" OR description LIKE "%' . $this->input->get( 'title' ) . '%")' ] = null;
				}
				$order_by = [ 'column' => 'created_at', 'sort' => 'ASC' ];
				$per_page = 20;
				$page     = 1;
				$this->load->model( 'Event_model' );
				$this->load->model( 'Events_model' );
				$this->load->helper( 'events' );
				$this->data['papular_events']   = $this->Events_model->fields( [
					'id',
					'continent_id',
					'country_id',
					'name',
					'slug'
				] )->filter( [ 'status' => 1 ] )->limit( $per_page, $page )->order_by( 'view', 'ASC' )->with_translation()->all();
				$this->data['papular_events_c'] = $this->Events_model->fields( [ '*' ] )->filter( [
					'status'               => 1,
					'end_date > CURDATE()' => null
				] )->get_count_rows();
				$this->data['last_events']      = $this->Events_model->fields( [
					'id',
					'continent_id',
					'country_id',
					'name',
					'slug'
				] )->filter( [ 'status' => 1 ] )->with_translation()->limit( $per_page, $page )->all();
				$this->data['last_events_c']    = $this->Events_model->fields( [
					'id',
					'continent_id',
					'country_id',
					'name',
					'slug'
				] )->filter( [ 'status' => 1 ] )->get_count_rows();
				$this->data['events']           = $this->Events_model->filter( $filter )->order_by( $order_by['column'], $order_by['sort'] )->fields( [
					'id',
					'continent_id',
					'country_id',
					'name',
					'slug',
					'image',
					'lat',
					'lng',
					'start_date',
					'end_date',
					'type_id',
					'price_from',
					'price_to',
					'description'
				] )->with_translation()->limit( $per_page, $page )->all();
				if ( isset( $_GET['test'] ) ) {
					echo '<pre>';
					print_r( $this->data );
					//print_r( $this->data['events'] );
					echo '</pre>'; die;
				}
				$this->template->render( 'search/event_search' );
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function get_product_atc() {

		$data = $this->Atc_code_model->fields( [
			'meaning',
			'id'
		] )->filter( [ 'id in (select chemical_id from wc_product_chemical group by chemical_id)' => null ] )->group_by( 'meaning' )->order_by( 'meaning' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}

	public function get_product_packing() {

		$data = $this->Packing_type_model->fields( [
			'name',
			'id'
		] )->filter( [ 'id in (select packing_type_id from wc_product_packing_type group by packing_type_id)' => null ] )->group_by( 'name' )->order_by( 'name' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}

	public function get_product_type() {

		$data = $this->Product_type_model->fields( [
			'name',
			'id'
		] )->filter( [ 'id in (select pr_type from wc_product where checked=1 group by pr_type)' => null ] )->group_by( 'name' )->order_by( 'name' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}

	public function get_tender_product_type() {

		$data = $this->Product_type_model->fields( [
			'name',
			'id'
		] )->filter( [ 'id in (select pr_type from wc_tender where checked=1 group by pr_type)' => null ] )->group_by( 'name' )->order_by( 'name' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}

	public function get_product_country() {

		$data = $this->Country_model->fields( [
			'name',
			'id'
		] )->filter( [ 'id in (select country from wc_product where checked=1 group by country)' => null ] )->group_by( 'name' )->order_by( 'name' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}

	public function get_tender_country() {

		$data = $this->Country_model->fields( [
			'name',
			'id'
		] )->filter( [ 'id in (select country from wc_tender where checked=1 group by country)' => null ] )->group_by( 'name' )->order_by( 'name' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}

	public function get_tender_continent() {

		$data = $this->Continent_model->fields( [
			'name',
			'id'
		] )->filter( [ 'id in (select continent from wc_tender where checked=1 group by continent)' => null ] )->group_by( 'name' )->order_by( 'name' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}


	public function get_tender_trade_term() {

		$data = $this->Trade_term_model->fields( [
			'name',
			'id'
		] )->filter( [ 'id in (select trade_term from wc_tender where checked=1 group by trade_term)' => null ] )->group_by( 'name' )->order_by( 'name' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}

	public function get_product_medical() {

		$data = $this->Medical_classifiction_model->fields( [
			'name',
			'id'
		] )->filter( [ 'id in (select medical_cl_id from wc_product_medical_cl group by medical_cl_id)' => null ] )->group_by( 'name' )->order_by( 'name' )->with_translation()->all();

		print_r( json_encode( $data ) );

		return $data;

	}

	public function get_product_company() {

		$this->load->model( 'Company_model' );

		$data = $this->Company_model->fields( [
			'company_name',
			'id'
		] )->filter( [
			'id in (select company_id from wc_product where `checked`=1 and `deleted_at` is NULL)' => null,
			'status'                                                                            => 1
		] )->group_by( 'company_name' )->order_by( 'company_name' )->all();
		//	print_r($this->db->last_query());

		echo  json_encode( $data );

		return $data;

	}

	public function get_company_pages() {
		$term = strtolower($this->input->get('term'));
		$this->load->model( 'Company_model' );

		/*$data = $this->Company_model->fields( [
			'company_name as label',
			'id'
		] )
        ->like('company_name', $term, 'both')
		->group_by( 'company_name' )->order_by( 'company_name' )->all();*/

        $data = $this->Company_model->searchCompanyForApply($term, $this->data['UserData']->id);

		$response = [];
		if (!empty($data)){
            foreach ($data as $dataItem) {
                $response_item = [];
                $response_item['id'] = $dataItem->id;
                $response_item['value'] = $dataItem->label;
                $response_item['label'] = $dataItem->label;
                array_push($response, $response_item);
            }
        }
		echo(json_encode($response)); die;

	}

	public function get_formatted_results() {

		$table = 'wc_product';

		$primaryKey = 'id';
		$sql_details = array(
			'host' => $this->db->hostname,
			'user' => $this->db->username,
			'pass' => $this->db->password,
			'db'   => $this->db->database,
		);


		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
			 * If you just want to use the basic configuration for DataTables with PHP
			 * server-side, there is no need to edit below this line.
			 */


		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes



		$columns = array(
			array(
				'db'        => 'title',
				'dt'        => 0,
				'formatter' => function ( $d, $row, $db ) {
					return '&nbsp';
				}
			),
			array(
				'db'        => 'pr_type',
				'dt'        => 1,
				'formatter' => function ( $d, $row, $db ) {

					return '<p>' . get_product_type_name( $row['pr_type'] ) . '</p>';
				}
			),
			array(
				'db'        => 'title',
				'dt'        => 2,
				'formatter' => function ( $d, $row, $db ) {
					$pr_link = ( ! is_null( $row['alias'] ) && $row['alias'] != '' ) ? '-' . $row['alias'] : '';
					$brname  = strtoupper( $row['title'] );
					if ( $brname == '' ) {
						$casNumbers = json_decode( $row['cas'] );
						if ( count( $casNumbers ) > 0 ) {
							foreach ( $casNumbers as $casss ) {
								$casformule = get_cas_formula( $casss->id );
								$casname    = get_cas_name( $casss->id );
								if ( $casformule && $casformule != '' && ! empty( $casformule ) && ! is_null( $casformule ) ) {
									$brname = $casformule;
								} else {
									$brname = $casname;
								}


							}
						}
					}

					return '<p><a target="_blank" href="' . site_url_multi( 'product/' ).$row['company_slug'].'/view/'. $row['id'] . '">' . $brname . '</a></p>';
				}
			),
			array(
				'db'        => 'atc_code',
				'dt'        => 3,
				'formatter' => function ( $d, $row, $db ) {
					$atc_code   = json_decode( $row['atc_code'] );
					$herbal     = json_decode( $row['herbal'] );
					$animals    = json_decode( $row['animal'] );
					$casNumbers = json_decode( $row['cas'] );



					$pratc = '';

					if ( count( $atc_code ) > 0 ) {
						foreach ( $atc_code as $atc ) {
							$pratc    .= '<a href="' . base_url( 'search/?title=&button=&search_type=3&atc_classifiction%5B%5D=' . get_atc_code_name( $atc->id ) . '&event_type=&start=&end=' ) . '"><b>' . get_atc_code_no( $atc->id ) . '</b></a>';
							$unitname = $atc->mdoza . ' ' . get_unit_name( $atc->vdoza );
							if ( trim( $unitname ) != '' && trim( $unitname ) != '0' ) {
								$pratc .= '<span>(' . $unitname . ')</span>';
							}
							$pratc .= '<br>';
						}
					}

					if ( count( $herbal ) > 0 ) {
						foreach ( $herbal as $herb ) {
							$pratc    .= '<b>' . get_herbal_name( $herb->id ) . '</b>';
							$unitname = $herb->mdoza . ' ' . get_unit_name( $herb->vdoza );

							if ( trim( $unitname ) != '' && trim( $unitname ) != '0' ) {
								$pratc .= '<span>(' . $unitname . ')</span><br>';
							}
						}
					}

					if ( count( $animals ) > 0 ) {
						foreach ( $animals as $animal ) {
							$pratc .= '<b>' . get_herbal_name( $animal->id ) . '</b>
                            <span>(' . $animal->mdoza . ' ' . get_unit_name( $animal->vdoza ) . ')</span><br>';
						}
					}

					if ( count( $casNumbers ) > 0 ) {
						foreach ( $casNumbers as $casss ) {
							$pratc    .= '<a href="' . base_url( 'search/?title=&button=&search_type=3&casno%5B%5D=' . $casss->id . '&event_type=&start=&end=' ) . '"><b>' . get_cas_name( $casss->id ) . '</b></a>';
							$unitname = $casss->mdoza . ' ' . get_unit_name( $casss->vdoza );
							if ( trim( $unitname ) != '' && trim( $unitname ) != '0' ) {
								$pratc .= '<span>' . $unitname . '</span><br>';
							}
						}
					}

					return '<span>' . $pratc . '</span>';
				}

			),
			array(
				'db'        => 'packing_type',
				'dt'        => 4,
				'formatter' => function ( $d, $row, $db ) {

					$var          = json_decode( $row['packing_type'] );
					$returned_str = '';
					$unitname     = '';
					if ( count( $var ) > 0 ) {
						$f            = json_decode( json_encode( $var[0] ) );
						$returned_str .= '<b>' . get_packing_type_name( $f->id ) . '</b>';

						$unitname = '';
						if ( $f->mdoza2 != 0 ) {
							$unitname .= $f->mdoza2 . ' ';
							$unitname .= get_unit_name( $f->vdoza2 ) . ' ';
						}
						if ( $f->mdoza != 0 ) {
							$unitname .= $f->mdoza;
						}
						$unitname .= get_drug_type_code( $f->vdoza );
					}

					if ( trim( $unitname ) != '' && trim( $unitname ) != '0' ) {
						$returned_str .= ' <span>(' . $unitname . ')</span>';
					}

					return '<span>' . $returned_str . '</span>';
				}

			),

			array(
				'db'        => 'country',
				'dt'        => 5,
				'formatter' => function ( $d, $row, $db ) {

					return '<center><img src="' . base_url( 'templates/default/assets/img/country/' ) . get_country_code( $row['country'] ) . '.png" alt="' . get_country_name( $row['country'] ) . '" class="table-img"><p style="font-size:10px;color:#555;">' . get_country_name( $row['country'] ) . '</p></center>';
				}
			),
			array(
				'db'        => 'medical_cl',
				'dt'        => 6,
				'formatter' => function ( $d, $row, $db ) {
					$str = '';
					if ( ! empty( $row['medical_cl'] ) ) {
						foreach ( get_selected_medical( $row['medical_cl'] ) as $key => $value ) {
							$str .= '<b>' . $value->name . '</b>,&nbsp;';
						}
					}

					return '<span>' . rtrim( $str, ',&nbsp;' ) . '</span>';
				}
			),
			array(
				'db'        => 'user_id',
				'dt'        => 7,
				'formatter' => function ( $d, $row, $db ) {

					$company = get_company_name( $row['user_id'] );

					if ( isset( $company->company_name ) ) {
						return '<span><a href="' . site_url_multi( "companies/" ) . $company->slug . '">' . $company->company_name . '</a></span>';
					} else {
						return '';
					}
				}
			),

			array(
				'db'        => 'user_id',
				'dt'        => 8,
				'formatter' => function ( $d, $row, $db ) {
					$str = '';
					if ( $this->data['is_loggedin'] ) {
						$company = get_company_name( $row['user_id'] );
						$str     .= '<div class="btn-group" style="width:100px;margin-left:8px;">';
						if ( ! empty( $company->email ) ) {
							$str .= '<a href="mailto:' . $company->email . '" class="btn btn-success btn-bix"> <i class="fa fa-envelope-o"></i> </a>';
						}
						if ( ! empty( $company->website ) ) {
							if ( strpos( $company->website, 'http' ) !== 0 ) {
								$company->website = 'http://' . $company->website;
							}
							$str .= '<a href="' . $company->website . '" target="_blank" class="btn btn-info btn-bix"> <i class="fa fa-globe"></i></a>';
						}

						$str .= '</div>';
					} else {
						$company = get_company_name( $row['user_id'] );
						$str     .= '<div class="btn-group" style="width:100px;margin-left:8px;">';
						if ( ! empty( $company->email ) ) {
							$str .= '<a href="#" class="btn btn-success btn-bix reg-to-see triggerSignup" data-toggle="tooltip" data-placement="right" title="Register to view company email" > <i class="fa fa-envelope-o"></i> </a>';
						}
						if ( ! empty( $company->website ) ) {
							$str .= '<a href="#" data-toggle="tooltip" data-placement="right" title="Register to view company website" class="btn btn-info btn-bix reg-to-see triggerSignup"> <i class="fa fa-globe"></i></a>';
						}

						$str .= '</div>';
					}

					return $str;
				}
			),
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'alias', 'dt' => 'alias' ),
			array( 'db' => 'herbal', 'dt' => 'herbal' ),
			array( 'db' => 'animal', 'dt' => 'animal' ),
			array( 'db' => 'cas', 'dt' => 'cas' ),
			array( 'db' => 'animal', 'dt' => 'animal' ),
			array( 'db' => 'atc_code', 'dt' => 'atc_code' ),
			array( 'db' => 'packing_type', 'dt' => 'packing_type' ),
			array( 'db' => 'country', 'dt' => 'country' ),
			array( 'db' => 'medical_cl', 'dt' => 'medical_cl' ),
			array( 'db' => 'user_id', 'dt' => 'user_id' ),


		);



		

		//echo '<pre>';
		echo json_encode(
			$this->ssp->ssp_simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		);

	}


	public function get_formatted_results_company() {



		$company_details = $this->User_model->get_company_details();
		$data            = array();
		$no              = $_POST['start'];



        foreach ( $company_details as $company ) {


			$operations = '';
			if ( $this->data['is_loggedin'] ) {
				$operations .= '<div class="btn-group" style="width:100px;margin-left:8px;">';
				if ( ! empty( $company->email ) ) {
					$operations .= '<a href="mailto:' . $company->email . '" class="btn btn-success btn-bix"> <i class="fa fa-envelope-o"></i> </a>';
				}
				if ( ! empty( $company->website ) ) {
					if ( strpos( $company->website, 'http' ) !== 0 ) {
						$company->website = 'http://' . $company->website;
					}
					$operations .= '<a href="' . $company->website . '" target="_blank" class="btn btn-info btn-bix"> <i class="fa fa-globe"></i></a>';
				}

				$operations .= '</div>';
			} else {
				$operations .= '<div class="btn-group" style="width:100px;margin-left:8px;">';
				if ( ! empty( $company->email ) ) {
					$operations .= '<a href="#" class="btn btn-success btn-bix reg-to-see triggerSignup" data-toggle="tooltip" data-placement="right" title="Register to view company email" > <i class="fa fa-envelope-o"></i> </a>';
				}
				if ( ! empty( $company->website ) ) {
					$operations .= '<a href="#" data-toggle="tooltip" data-placement="right" title="Register to view company website" class="btn btn-info btn-bix reg-to-see triggerSignup"> <i class="fa fa-globe"></i></a>';
				}

				$operations .= '</div>';
			}

			$company_group_name = $this->Group_model->filter( [ 'id' => $company->user_groups_id ] )->fields( [ 'name' ] )->one();
			$number_of_products = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'company_id' => $company->company_id, 'checked' => 1 ] )->with_translation()->one()->count;
			if( ! empty( $company->company_name )){
			$no ++;
			$row   = array();
			$row[] = "<p>" . $no . "</p>";
			
			$row[]  = '<center><img src="'. $this->User_model->checkCompanyLogo($company).'" alt="" class="table-img"><p style="font-size:10px;color:#555;"></p></center>';
			
			$row[] = '<span><a href="' . site_url_multi( "companies/" ) . $company->slug . '" target="_blank" >' . $company->company_name . '</a></span>';
			// $row[] = "<p>".$company->establishment_date."</p>";
			$row[]  = isset( $company_group_name->name ) ? "<p>" . $company_group_name->name . "</p>" : "<p> </p>";
			
				$row[] = '<span><a href="' . site_url_multi( "companies/" ) . $company->slug . '/products" target="_blank">' . $number_of_products . '</a></span>';
			
			$product_types = json_decode($company->product_type);
			$product_type_names = '';
			if(isset($product_types)) {
				$product_types = array_filter($product_types);
				$number_of_product_types = sizeof($product_types);
				foreach ($product_types as $key => $product_type) {
					if($key < $number_of_product_types -1) {
						$product_type_names .= get_product_type_name($product_type).", ";
					} else {
						$product_type_names .= get_product_type_name($product_type);
					}
				}
			} else {
				$product_type_names = "";
			}
			$row[] = "<p>".$product_type_names."</p>";

			$company_standards = $company->standart;
			$company_standards_names = '';
			if(isset($company_standards)) {
				$company_standards = array_filter(explode(',', $company_standards));
				$number_of_company_standards = sizeof($company_standards);
				foreach ($company_standards as $key => $company_standard) {
					if($key < $number_of_company_standards -1) {
						$company_standards_names.= get_standart_name($company_standard).", ";
					} else {
						$company_standards_names.= get_standart_name($company_standard);
					}
				}
			} else {
				$company_standards_names = "";
			}

			$row[] = "<p>".$company_standards_names."</p>";

			// $row[]  = "<p>" . $number_of_products . "</p>";
			$row[]  = '<center><img src="' . base_url( 'templates/default/assets/img/country/' ) . get_country_code( $company->country_id ) . '.png" alt="' . get_country_name( $company->country_id ) . '" class="table-img"><p style="font-size:10px;color:#555;">' . get_country_name( $company->country_id ) . '</p></center>';
			$row[]  = $operations;
			$data[] = $row;

			//$_POST['draw']='';
		}
	}
		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->User_model->get_company_details_count_all(),
			"recordsFiltered" => $this->User_model->get_company_details_count_filtered(),
			"data"            => $data,
		);
		//output to json format
		echo json_encode( $output );
	}


	

	public function getproductlist() {
		$this->load->model( 'Cas_list_model' );

		$term = strtolower( $this->input->get( 'term' ) );

		$getAllProductContent = $this->Product_model->fields( [
			'atc_code',
			'cas'
		] )->filter( [ 'checked' => 1 ] )->all();
		$productAtc           = [];
		$productCas           = [];
		foreach ( $getAllProductContent as $key => $value ) {
			if ( ! is_null( $value->atc_code ) && $value->atc_code !== '' ) {
				$atc_curr = json_decode( $value->atc_code );
				if ( ! empty( $atc_curr ) ) {
					foreach ( $atc_curr as $key_atc => $value2 ) {
						if ( ! in_array( $value2->id, $productAtc ) ) {
							$productAtc[] = $value2->id;
						}
					}

				}
			}
			if ( ! is_null( $value->cas ) && $value->cas !== '' ) {
				$cas_curr = json_decode( $value->cas );
				if ( ! empty( $cas_curr ) ) {
					foreach ( $cas_curr as $key_cas => $value2 ) {
						if ( ! in_array( $value2->id, $productCas ) ) {
							$productCas[] = $value2->id;
						}
					}

				}
			}
		}
		$productAtc = implode( ',', $productAtc );
		$productCas = implode( ',', $productCas );
		//	$sql_term = $this->Product_model->fields(['id','title','alias'])->filter(['title like "'.$term.'%"'=>NULL,'checked'=>1])->with_translation()->limit(80)->all();
		$sql_term2 = $this->User_model->fields( [
			'id',
			'company_name',
			'slug'
		] )->filter( [
			'company_name like "' . $term . '%"' => null,
			'checked'                            => 1,
			'status'                             => 1
		] )->limit( 80 )->all();
		$sql_term3 = $this->Atc_code_model->fields( [
			'id',
			'meaning',
			'atc_code'
		] )->filter( [
			'(meaning like "%' . $term . '%" or atc_code like "%' . $term . '%")' => null,
			'id in (' . $productAtc . ')'                                         => null
		] )->group_by( 'atc_code' )->limit( 80 )->with_translation()->all();
		$sql_term4 = $this->Cas_list_model->fields( [
			'id',
			'chemical_name',
			'cas_no'
		] )->filter( [
			'(chemical_name like "%' . $term . '%" or cas_no like "%' . $term . '%")' => null,
			'id in (' . $productCas . ')'                                             => null
		] )->group_by( 'cas_no' )->limit( 80 )->with_translation()->all();
		$data      = array();
		/*	if($sql_term)
			foreach ($sql_term as $key => $value) {
				$pr_alias=site_url_multi('product/view/').$value->id.'-'.$value->alias;
				$arr = ($key == 0)? array('value'=>$value->title,'label'=>$value->title.'<span>Product</span>','alias'=>$pr_alias,'type'=>'First'): array('value'=>$value->title,'label'=>$value->title.'<span>Product</span>','alias'=>$pr_alias);
				$data[]=$arr;
			}*/
		if ( $sql_term2 ) {
			foreach ( $sql_term2 as $key => $value ) {
				$pr_alias = base_url( 'company/' ) . $value->slug;
				$arr      = ( $key == 0 ) ? array(
					'value' => $value->company_name,
					'label' => $value->company_name . '<span>Company</span>',
					'alias' => $pr_alias,
					'type'  => 'First'
				) : array(
					'value' => $value->company_name,
					'label' => $value->company_name . '<span>Company</span>',
					'alias' => $pr_alias
				);
				$data[]   = $arr;

			}
		}
		if ( $sql_term3 ) {
			foreach ( $sql_term3 as $key => $value ) {
				$pr_alias = base_url( 'search/?title=&button=&search_type=3&atc_classifiction%5B%5D=' . $value->atc_code . '&event_type=&start=&end=' );
				$arr      = ( $key == 0 ) ? array(
					'value' => $value->atc_code,
					'label' => $value->atc_code . ' (' . $value->meaning . ') <span>ATC Code</span>',
					'alias' => $pr_alias,
					'type'  => 'First'
				) : array(
					'value' => $value->atc_code,
					'label' => $value->atc_code . ' (' . $value->meaning . ') <span>ATC Code</span>',
					'alias' => $pr_alias
				);
				$data[]   = $arr;
			}
		}
		if ( $sql_term4 ) {
			foreach ( $sql_term4 as $key => $value ) {
				$pr_alias = base_url( 'search/?title=&button=&search_type=3&casno%5B%5D=' . $value->id . '&event_type=&start=&end=' );
				$lbl      = $value->cas_no . ' (' . $value->chemical_name . ')';
				if ( strlen( $lbl ) > 50 ) {
					$lbl = substr( $lbl, 0, 50 ) . '..';
				}
				$lbl    .= ' <span>CAS No</span>';
				$arr    = ( $key == 0 ) ? array(
					'value' => $value->id,
					'label' => $lbl,
					'alias' => $pr_alias,
					'type'  => 'First'
				) : array( 'value' => $value->id, 'label' => $lbl, 'alias' => $pr_alias );
				$data[] = $arr;
			}
		}

		die( json_encode( $data ) );
	}

	public function groups( $country = null, $id = null ) {


		$this->data['title'] = translate( 'user_title' );
		if ( $id == null && $country == null ) {
			show_404();
		} else {
			if ( empty( $country ) || empty( $id ) ) {
				show_404();
			} else {
				$this->data['group_id']   = $id;
				$this->data['country_id'] = get_country_id( $country );
				$this->data['searching']  = $this->Home_model->get_all_search( $this->data['group_id'], $this->data['country_id'] );


				$user_id = '';
				if ( $this->data['searching'] != false ) {
					foreach ( $this->data['searching'] as $key => $value ) {
						$user_id .= $value['user_id'] . ',';
					}

					$user_id = rtrim( $user_id, ',' );
				}


				if ( ! empty( $user_id ) ) {
					$this->data['get_user'] = $this->User_model->getUserData(["u.id" => explode(',', $user_id)], true, true); //$this->User_model->fields( '*' )->filter( [ 'id in(' . $user_id . ')' => null ] )->all();


					if ( $this->data['get_user'] ) {
						$this->data['pr_type'] = $this->User_model->select_any(  'wc_user_interests_product_type', [ 'user_id in(' . $user_id . ')' => null ],'user_id, product_type_id', 'product_type_id' );
						$this->data['pr']      = [];
						if ( $this->data['pr_type'] ) {
							$input = array_map( "unserialize", array_unique( array_map( "serialize", $this->data['pr_type'] ) ) );
							foreach ( $input as $key => $value ) {
								$this->data['pr'][ $value['user_id'] ][] = $value;
							}
						}

						$this->data['user_group']  = $this->User_model->select_any(  'wc_user_interests_status', [ 'user_id in(' . $user_id . ')' => null ],'user_id, group_id', 'group_id' );
						$this->data['user_groups'] = [];
						if ( $this->data['user_group'] ) {
							$input = array_map( "unserialize", array_unique( array_map( "serialize", $this->data['user_group'] ) ) );
							foreach ( $input as $key => $value ) {
								$this->data['user_groups'][ $value['user_id'] ][] = $value;
							}
						}

						$this->data['user_standart']  = $this->User_model->select_any(  'wc_user_interests_standart', [ 'user_id in(' . $user_id . ')' => null ],'user_id, standart_id', 'standart_id' );
						$this->data['user_standarts'] = [];
						if ( $this->data['user_standart'] ) {
							$input = array_map( "unserialize", array_unique( array_map( "serialize", $this->data['user_standart'] ) ) );
							foreach ( $input as $key => $value ) {
								$this->data['user_standarts'][ $value['user_id'] ][] = $value;
							}
						}
					} else {
					}

					$this->template->render( 'search/user_search' );
				} else {
					$this->template->render( 'search/user_search' );
				}
			}
		}
	}
}
