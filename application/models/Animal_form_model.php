<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Animal_form_model extends Webcoder_Model {

	public $table = 'animal_form';
	public $table_translation = 'animal_form_translation';
	public $table_translation_key = 'animal_form_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}