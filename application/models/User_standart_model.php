<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class User_standart_model extends Webcoder_Model {

	public $table = 'user_standart_image';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

	public function check_standart( $id, $data ) {
		$this->db->where( 'id', $id );

		return $this->db->update( $this->table, $data );
	}

}
