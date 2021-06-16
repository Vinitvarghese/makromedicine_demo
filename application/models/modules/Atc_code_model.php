<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Atc_code_model extends Webcoder_Model {

	public $table = 'atc_code';
	public $table_translation = 'atc_code_translation';
	public $table_translation_key = 'atc_code_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}