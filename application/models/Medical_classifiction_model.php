<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Medical_classifiction_model extends Webcoder_Model {

	public $table = 'medical_classifiction';
	public $table_translation = 'medical_classifiction_translation';
	public $table_translation_key = 'medical_classifiction_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}