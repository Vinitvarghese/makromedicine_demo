<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Unit_model extends Webcoder_Model {

	public $table = 'unit';
	public $table_translation = 'unit_translation';
	public $table_translation_key = 'unit_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}