<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Equipment_type_model extends Webcoder_Model {

	public $table = 'equipment_type';
	public $table_translation = 'equipment_type_translation';
	public $table_translation_key = 'equipment_type_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}