<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Drug_type_model extends Webcoder_Model {

	public $table = 'drug_type';
	public $table_translation = 'drug_type_translation';
	public $table_translation_key = 'drug_type_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}