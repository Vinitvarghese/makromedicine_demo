<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Confirm_account_model extends Webcoder_Model {

	public $table = 'confirm_account';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

	public function comfirm_account_update( $id, $data ) {
		$this->db->where( 'id', $id );

		return $this->db->update( 'wc_confirm_account', $data );
	}
}
