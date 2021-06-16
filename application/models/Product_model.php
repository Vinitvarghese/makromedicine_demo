<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Product_model extends Webcoder_Model {
	public $table = 'product';
	public $table_translation = 'product_translation';
	public $table_translation_key = 'product_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

	public function delete_images( $id ) {
		$this->db->delete( 'product_images', [ 'product_id' => $id ] );
	}

	public function delete_image( $id ) {
		return $this->db->delete( 'wc_product_images', [ 'image_id' => $id ] );
	}

	public function insert_image( $data ) {
		$this->db->insert( 'product_images', $data );
	}

	public function get_product_images( $select, $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_product_images' );

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