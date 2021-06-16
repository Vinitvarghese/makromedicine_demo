<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Tender_model extends Webcoder_Model {
	public $table = 'tender';
	public $table_translation = 'tender_translation';
	public $table_translation_key = 'tender_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

	public function delete_images( $id ) {
		$this->db->delete( 'tender_images', [ 'product_id' => $id ] );
	}

	public function delete_image( $id ) {
		return $this->db->delete( 'wc_tender_images', [ 'image_id' => $id ] );
	}

	public function insert_image( $data ) {
		$this->db->insert( 'tender_images', $data );
	}

	public function get_product_images( $select, $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_tender_images' );

		$this->db->where( $where );
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function insert_relation( $table_name, $data ) {
		$this->db->insert( $table_name, $data );
	}

	public function delete_translation( $id ) {
		$this->db->where( $this->table_translation_key, $id );
		$this->db->delete( $this->table_translation );

		return $this;
	}

	public function delete_pr( $id ) {
		$this->db->where( 'id', $id );
		$this->db->delete( $this->table );

		return $this;
	}
}