<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Plant_type_model extends Webcoder_Model {

	public $table = 'plant_type';
	public $table_translation = 'plant_type_translation';
	public $table_translation_key = 'plant_type_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}