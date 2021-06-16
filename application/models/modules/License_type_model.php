<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class License_type_model extends Webcoder_Model {

	public $table = 'license_type';
	public $table_translation = 'license_type_translation';
	public $table_translation_key = 'license_type_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}