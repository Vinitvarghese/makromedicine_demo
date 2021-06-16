<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Events extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'Events_model' );
		$this->load->model( 'Event_type_model' );
		$this->load->helper( 'events' );

		
	}

	public function index() {

		$this->data['search_type']      = 1;
		$this->data['event_type']       = 0;
		$this->data['event_start']      = '';
		$this->data['event_end']        = '';
		$this->data['event_continent']  = [ 'AF', 'AS', 'EU', 'NA', 'OC', 'SA' ];
		$this->data['event_country']    = [];
		$this->data['title']            = translate( 'title' );
		$this->data['papular_events']   = $this->Events_model->fields( [ '*' ] )->filter( [
			'status'               => 1,
			'end_date > CURDATE()' => null
		] )->order_by( 'view', 'ASC' )->with_translation()->all();
		$this->data['papular_events_c'] = $this->Events_model->fields( [ '*' ] )->filter( [
			'status'               => 1,
			'end_date > CURDATE()' => null
		] )->get_count_rows();
		$this->data['last_events']      = $this->Events_model->fields( [
			'id',
			'continent_id',
			'country_id',
			'name',
			'slug',
			'start_date'
		] )->filter( [
			'status'               => 1,
			'end_date > CURDATE()' => null
		] )->with_translation()->order_by( 'start_date', 'ASC' )->all();
		$this->data['last_events_c']    = $this->Events_model->fields( [
			'id',
			'continent_id',
			'country_id',
			'name'
		] )->filter( [ 'status' => 1, 'end_date > CURDATE()' => null ] )->get_count_rows();
		$this->data['end_events']       = $this->Events_model->fields( [
			'id',
			'continent_id',
			'country_id',
			'name',
			'slug',
			'start_date'
		] )->filter( [
			'status'                             => 1,
			'UNIX_TIMESTAMP(end_date)<' . time() => null
		] )->order_by( 'end_date', 'DESC' )->with_translation()->all();
		$this->data['end_events_c']     = $this->Events_model->fields( [
			'id',
			'continent_id',
			'country_id',
			'name'
		] )->filter( [ 'status' => 1, 'end_date < CURDATE()' => null ] )->get_count_rows();

		$this->data['mostview_events']   = $this->Events_model->fields( [ '*' ] )->filter( [
			'status'               => 1,
			'end_date > CURDATE()' => null
		] )->order_by( 'view', 'DESC' )->limit( 10 )->with_translation()->all();
		$this->data['mostview_events_c'] = $this->Events_model->fields( [ '*' ] )->filter( [
			'status'               => 1,
			'end_date > CURDATE()' => null
		] )->limit( 10 )->get_count_rows();


		if ( $this->data['papular_events'] == false && $this->data['last_events'] == false && $this->data['end_events'] == false ) {
			$this->template->render( 'error/404' );
		} else {
			$this->template->render( 'events/events' );
		}
	}

	public function view( $id = null ) {
		if ( $id != null ) {

			$this->data['title']       = translate( 'title' );
			$this->data['events']      = $this->Events_model->filter( [
				'slug like "' . $id . '"' => null,
				'status'                  => 1
			] )->with_translation()->one();
			$time                      = time();
			$this->data['last_events'] = $this->Events_model->fields( [
				'id',
				'continent_id',
				'country_id',
				'name',
				'slug',
				'start_date'
			] )->filter( [
				'status'                              => 1,
				'slug not like "' . $id . '"'         => null,
				'UNIX_TIMESTAMP(start_date)>' . $time => null
			] )->order_by( 'start_date', 'ASC' )->with_translation()->all();
			if ( $this->data['events'] ) {
				$update = $this->Events_model->update_view( $id );
				$this->template->render( 'events/event_single' );
			} else {
				$this->template->render( 'error/404' );
			}
		} else {
			$this->template->render( 'error/404' );
		}
	}

	public static function slugify( $text ) {
		// replace non letter or digits by -
		$text = preg_replace( '~[^\pL\d]+~u', '-', $text );

		// transliterate
		$text = iconv( 'utf-8', 'us-ascii//TRANSLIT', $text );

		// remove unwanted characters
		$text = preg_replace( '~[^-\w]+~', '', $text );

		// trim
		$text = trim( $text, '-' );

		// remove duplicate -
		$text = preg_replace( '~-+~', '-', $text );

		// lowercase
		$text = strtolower( $text );

		if ( empty( $text ) ) {
			return 'n-a';
		}

		return $text;
	}

}
