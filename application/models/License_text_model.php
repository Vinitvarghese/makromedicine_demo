<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class License_text_model extends Webcoder_Model {

	public $table = 'license_text';
	public $table_translation = 'license_text_translation';
	public $table_translation_key = 'license_text_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}