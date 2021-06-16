<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Legislation_model extends Webcoder_Model {

	public $table = 'legislation';
	public $table_translation = 'legislation_translation';
	public $table_translation_key = 'legislation_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

	public function getLegislationCount() {
		$query = $this->db->query( "SELECT country, COUNT(id) FROM wc_legislation GROUP BY country" );

		return $query->result_array();
	}

}
