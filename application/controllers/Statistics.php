<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Statistics extends Site_Controller {

	public function __construct() {
		ini_set( 'display_errors', 0 );
		parent::__construct();
		$this->load->model( 'Statistics_model' );
		$this->load->model( 'Atc_code_model' );
		$this->load->model( 'User_model' );
		$this->load->model( 'Company_model' );
		$this->load->model( 'Continent_model' );
		$this->load->model( 'Country_model' );
		$this->load->model( 'Group_model' );
		$this->load->model( 'Product_type_model' );
		$this->load->model( 'Product_model' );
		$this->load->model( 'Standart_model' );

		
	}

	public function index( $filter_country = '' ) {



		$statistics_sections = $this->Statistics_model->filter( [ 'section != "product"' => null ] )->fields( [ 'section' ] )->group_by( array( 'section' ) )->all();
		$statistics          = array();
		$section_sum         = array();



		foreach ( $statistics_sections as $all_st_key => $all_st_val ) {

			$statistics_sections->$all_st_key->name = '';

			$statistics_sections->$all_st_key->name = translate( $all_st_val->section );

			$statistics_data                              = $this->Statistics_model->filter( [
				'section'          => $all_st_val->section,
				'type is not null' => null,
				'type != ""'       => null,
				'type!=""'         => null
			] )->fields( [
				'section',
				'type',
				'SUM(value) as value_sum',
				'country'
			] )->group_by( array( 'type' ) )->order_by( 'value_sum', 'DESC' )->order_by( 'type', 'ASC' )->all();
			$statistics_sections->$all_st_key->statistics = array();
			$section_sum[ $all_st_val->section ]          = 0;
			foreach ( $statistics_data as $st_val ) {



				switch ( $all_st_val->section ) {
					case 'atc':
						$st_val->type = $this->getAtcName( $st_val->type );
						break;
					case 'company':
						$st_val->type = $this->getCompanyName( $st_val->type );
						break;
					case 'cas':
						$st_val->type = $this->getCasNo( $st_val->type );
						break;
					case 'herbal':
						$st_val->type = $this->getHerbalName( $st_val->type );
						break;
					case 'animal':
						$st_val->type = $this->getAnimalName( $st_val->type );
						break;
					case 'continent':
						$st_val->type = $this->getContinentName( $st_val->type );
						break;
					case 'country':
						$st_val->type = $this->getCountryName( $st_val->type );
						break;
					case 'poly':
						$st_val->type = ( $st_val->type == 1 ) ? 'Policomponent' : 'Monocomponent';
						break;
					case 'standart':
						$st_val->type = $this->getStName( $st_val->type );
						break;
					case 'pr_type':
						$st_val->type = $this->getPrtypeName( $st_val->type );
						break;
					case 'status':
						$st_val->type = $this->getStatusName( $st_val->type );
						break;
					case 'product':
						$st_val->type = $this->getProductName( $st_val->type );
						break;
					default:
						# code...
						break;
				}
				$section_sum[ $st_val->section ]                += $st_val->value_sum;
				$statistics_sections->$all_st_key->statistics[] = $st_val;


			}




			foreach ( $statistics_sections->$all_st_key->statistics as $st_arr ) {

				$st_arr->percent = 100 * $st_arr->value_sum / $section_sum[ $all_st_val->section ];
				$st_arr->percent = round( $st_arr->percent, 1 );

			}

		}


		$statistics_countries = $this->Statistics_model->fields( [
			'country',
			'count(*) count_all',
			'code'
		] )->join( 'wc_country', 'wc_country.id = wc_statistics.country', 'left' )->group_by( 'country' )->all();
		$countries            = array();
		foreach ( $statistics_countries as $key => $value ) {
			$countries[] = $value->country;
		}
		$countries = implode( ',', $countries );



		$statistics_months = $this->Statistics_model->fields( [
			'month',
			'year'
		] )->group_by( 'year,month' )->order_by( 'year', 'DESC' )->order_by( 'month', 'DESC' )->all();
		foreach ( $statistics_months as $key => $value ) {
			$value->month_name = date( 'F', mktime( 0, 0, 0, $value->month, 10 ) );
		}




		$this->data['statistics_sections']  = $statistics_sections;
		$this->data['statistics_countries'] = $statistics_countries;
		$this->data['options']              = $statistics_months;
		$this->data['filter_country']       = $filter_country;

		$this->data['title'] = translate( 'title' );
		$this->template->render( 'statistics' );


		//  $this->template->render('statistics-coming-soon');
	}

	public function test() {
		$statistics_sections = $this->Statistics_model->filter( [ 'section != "product"' => null ] )->fields( [ 'section' ] )->group_by( array( 'section' ) )->all();
		$statistics          = array();
		$section_sum         = array();

		foreach ( $statistics_sections as $all_st_key => $all_st_val ) {

			$statistics_sections->$all_st_key->name = '';

			$statistics_sections->$all_st_key->name = translate( $all_st_val->section );

			$statistics_data                              = $this->Statistics_model->filter( [
				'section'          => $all_st_val->section,
				'type is not null' => null,
				'type != ""'       => null,
				'type!=""'         => null
			] )->fields( [
				'section',
				'type',
				'SUM(value) as value_sum',
				'country'
			] )->group_by( array( 'type' ) )->order_by( 'value_sum', 'DESC' )->order_by( 'type', 'ASC' )->all();
			$statistics_sections->$all_st_key->statistics = array();
			$section_sum[ $all_st_val->section ]          = 0;
			foreach ( $statistics_data as $st_val ) {

				switch ( $all_st_val->section ) {
					case 'atc':
						$st_val->type = $this->getAtcName( $st_val->type );
						break;
					case 'company':
						$st_val->type = $this->getCompanyName( $st_val->type );
						break;
					case 'cas':
						$st_val->type = $this->getCasNo( $st_val->type );
						break;
					case 'herbal':
						$st_val->type = $this->getHerbalName( $st_val->type );
						break;
					case 'animal':
						$st_val->type = $this->getAnimalName( $st_val->type );
						break;
					case 'continent':
						$st_val->type = $this->getContinentName( $st_val->type );
						break;
					case 'country':
						$st_val->type = $this->getCountryName( $st_val->type );
						break;
					case 'poly':
						$st_val->type = ( $st_val->type == 1 ) ? 'Policomponent' : 'Monocomponent';
						break;
					case 'standart':
						$st_val->type = $this->getStName( $st_val->type );
						break;
					case 'pr_type':
						$st_val->type = $this->getPrtypeName( $st_val->type );
						break;
					case 'status':
						$st_val->type = $this->getStatusName( $st_val->type );
						break;
					case 'product':
						$st_val->type = $this->getProductName( $st_val->type );
						break;
					default:
						# code...
						break;
				}
				$section_sum[ $st_val->section ]                += $st_val->value_sum;
				$statistics_sections->$all_st_key->statistics[] = $st_val;
			}


			foreach ( $statistics_sections->$all_st_key->statistics as $st_arr ) {

				$st_arr->percent = 100 * $st_arr->value_sum / $section_sum[ $all_st_val->section ];
				$st_arr->percent = round( $st_arr->percent, 1 );

			}

		}


		$statistics_countries = $this->Statistics_model->fields( [
			'country',
			'count(*) count_all',
			'code'
		] )->join( 'wc_country', 'wc_country.id = wc_statistics.country', 'left' )->group_by( 'country' )->all();
		$countries            = array();
		foreach ( $statistics_countries as $key => $value ) {
			$countries[] = $value->country;
		}
		$countries = implode( ',', $countries );


		$statistics_months = $this->Statistics_model->fields( [
			'month',
			'year'
		] )->group_by( 'year,month' )->order_by( 'year', 'DESC' )->order_by( 'month', 'DESC' )->all();
		foreach ( $statistics_months as $key => $value ) {
			$value->month_name = date( 'F', mktime( 0, 0, 0, $value->month, 10 ) );
		}


		$this->data['statistics_sections']  = $statistics_sections;
		$this->data['statistics_countries'] = $statistics_countries;
		$this->data['options']              = $statistics_months;

		$this->data['title'] = translate( 'title' );
		$this->template->render( 'statistics' );
	}


	public function getAtcName( $id ) {
		$atc_ids    = explode( ',', $id );
		$return_str = '';
		foreach ( $atc_ids as $key => $value ) {
			$data = $this->Atc_code_model->fields( [ 'meaning' ] )->filter( [ 'atc_code' => $value ] )->with_translation()->one();
			if ( strlen( $data->meaning ) > 40 ) {
				$data->meaning = substr( $data->meaning, 0, 40 ) . '..';
			}
			$return_str .= $data->meaning . ' (' . $value . '), ';
		}

		$return_str = rtrim( $return_str, ', ' );

		return $return_str;
	}

	public function getCasNo( $id ) {
		$atc_ids    = explode( ',', $id );
		$return_str = '';
		foreach ( $atc_ids as $key => $value ) {
			$return_str .= get_cas_no( $value ) . ', ';
		}

		$return_str = rtrim( $return_str, ', ' );

		return $return_str;
	}

	public function getHerbalName( $id ) {
		$atc_ids    = explode( ',', $id );
		$return_str = '';
		foreach ( $atc_ids as $key => $value ) {
			$return_str .= get_herbal_name( $value ) . ', ';
		}

		$return_str = rtrim( $return_str, ', ' );

		return $return_str;
	}

	public function getAnimalName( $id ) {
		$atc_ids    = explode( ',', $id );
		$return_str = '';
		foreach ( $atc_ids as $key => $value ) {
			$return_str .= get_animal_name( $value ) . ', ';
		}

		$return_str = rtrim( $return_str, ', ' );

		return $return_str;
	}


	public function getCompanyName( $id ) {
		$data = $this->Company_model->fields( [ 'company_name' ] )->filter( [ 'id' => $id ] )->one();

		return $data->company_name;
	}

	public function getContinentName( $id ) {
		$data = $this->Continent_model->fields( [ 'name' ] )->filter( [ 'code' => $id ] )->with_translation()->one();

		return $data->name;
	}

	public function getCountryName( $id ) {
		$data = $this->Country_model->fields( [ 'name' ] )->filter( [ 'id' => $id ] )->with_translation()->one();
		if ( $data ) {
			return $data->name;
		} else {
			return '';
		}
	}

	public function getStName( $id ) {
		$data = $this->Standart_model->fields( [ 'name' ] )->filter( [ 'id' => $id ] )->with_translation()->one();

		return $data->name;
	}

	public function getPrtypeName( $id ) {
		$data = $this->Product_type_model->fields( [ 'name' ] )->filter( [ 'id' => $id ] )->with_translation()->one();

		return $data->name;
	}

	public function getProductName( $id ) {
		$data = $this->Product_model->fields( [ 'title' ] )->filter( [ 'id' => $id ] )->with_translation()->one();

		return $data->title;
	}

	public function getStatusName( $id ) {
		$data = $this->Group_model->fields( [ 'name' ] )->filter( [ 'id' => $id ] )->one();

		return $data->name;
	}

	public function filter() {

		$code = $this->input->get( 'country' );
		$date = $this->input->get( 'date' );

		$filter1 = [ 'section != "product"' => null ];

		if ( $code != '' ) {
			$country            = $this->Country_model->filter( [ 'code' => $code ] )->fields( [ 'id' ] )->one();
			$country_id         = $country->id;
			$filter1['country'] = $country_id;
		}

		if ( $date != '' ) {
			$date_arr         = explode( '-', $date );
			$month            = $date_arr[0];
			$year             = $date_arr[1];
			$filter1['month'] = $month;
			$filter1['year']  = $year;
		}

		$statistics_sections = $this->Statistics_model->filter( $filter1 )->fields( [ 'section' ] )->group_by( array( 'section' ) )->all();
		$statistics          = array();
		$section_sum         = array();

		if ( $statistics_sections ) {

			foreach ( $statistics_sections as $all_st_key => $all_st_val ) {

				$statistics_sections->$all_st_key->name = '';

				$statistics_sections->$all_st_key->name = translate( $all_st_val->section );


				$filter2 = [ 'section' => $all_st_val->section, 'type is not null' => null, 'type != ""' => null ];

				if ( $date != '' ) {
					$filter2['month'] = $month;
					$filter2['year']  = $year;
				}

				if ( $code != '' ) {
					$filter2['country'] = $country_id;
				}


				$statistics_data                              = $this->Statistics_model->filter( $filter2 )->fields( [
					'section',
					'type',
					'SUM(value) as value_sum',
					'country'
				] )->group_by( array( 'type' ) )->order_by( 'value_sum', 'DESC' )->order_by( 'type', 'ASC' )->all();
				$statistics_sections->$all_st_key->statistics = array();
				$section_sum[ $all_st_val->section ]          = 0;
				foreach ( $statistics_data as $st_val ) {

					switch ( $all_st_val->section ) {
						case 'atc':
							$st_val->type = $this->getAtcName( $st_val->type );
							break;
						case 'cas':
							$st_val->type = $this->getCasNo( $st_val->type );
							break;
						case 'herbal':
							$st_val->type = $this->getHerbalName( $st_val->type );
							break;
						case 'animal':
							$st_val->type = $this->getAnimalName( $st_val->type );
							break;
						case 'company':
							$st_val->type = $this->getCompanyName( $st_val->type );
							break;
						case 'continent':
							$st_val->type = $this->getContinentName( $st_val->type );
							break;
						case 'country':
							$st_val->type = $this->getCountryName( $st_val->type );
							break;
						case 'poly':
							$st_val->type = ( $st_val->type == 1 ) ? 'Policomponent' : 'Monocomponent';
							break;
						case 'standart':
							$st_val->type = $this->getStName( $st_val->type );
							break;
						case 'pr_type':
							$st_val->type = $this->getPrtypeName( $st_val->type );
							break;
						case 'status':
							$st_val->type = $this->getStatusName( $st_val->type );
							break;
						default:
							# code...
							break;
					}
					$section_sum[ $st_val->section ]                += $st_val->value_sum;
					$statistics_sections->$all_st_key->statistics[] = $st_val;
				}


				foreach ( $statistics_sections->$all_st_key->statistics as $st_arr ) {

					$st_arr->percent = 100 * $st_arr->value_sum / $section_sum[ $all_st_val->section ];
					$st_arr->percent = round( $st_arr->percent, 1 );

				}

			}


			$this->data['statistics_sections'] = $statistics_sections;
		}
		$this->data['title'] = translate( 'title' );
		$this->template->render( 'statistics-country' );

	}


}
