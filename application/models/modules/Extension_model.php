<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Extension_model extends Webcoder_Model {

	public $table = 'modules';

	public $primary_key = 'id';

	public $protected = [];

	public function __construct() {
		parent::__construct();
	}

	public function callback_get_name( $data ) {
		if ( ! empty( $data ) ) {
			return json_decode( $data )->index->title->{$this->data['current_lang']};
		}

		return;
	}

	public function callback_get_icon( $data ) {
		if ( ! empty( $data ) ) {
			return "<i class='" . $data . "'></i>";
		}

		return;
	}

	public function get_table() {
		$query = $this->db->query( "SELECT table_name FROM information_schema.tables where table_schema='macromed'" );

		return $query->result_array();
	}

	public function table_field( $table_name ) {
		return $this->db->list_fields( $table_name );
	}
}