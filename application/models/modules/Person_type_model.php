<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Person_type_model extends Webcoder_Model {

	public $table = 'person_type';
	public $table_translation = 'person_type_translation';
	public $table_translation_key = 'person_type_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}