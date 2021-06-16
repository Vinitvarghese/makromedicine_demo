<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Services_model extends Webcoder_Model {
	public $table = 'services';
	public $table_translation = 'services_translation';
	public $table_translation_key = 'services_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

	public function get_services_country( $select, $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_services_country' );
		$this->db->where( $where );
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function insert_services_country( $data ) {
		return $this->db->insert( 'wc_services_country', $data );
	}

	public function delete_country( $id ) {
		$this->db->where( 'services_id', $id );

		return $this->db->delete( 'wc_services_country' );
	}
}
