<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Packing_type_model extends Webcoder_Model {

	public $table = 'packing_type';
	public $table_translation = 'packing_type_translation';
	public $table_translation_key = 'packing_type_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}