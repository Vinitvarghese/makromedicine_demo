<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Animal_part_model extends Webcoder_Model {

	public $table = 'animal_part';
	public $table_translation = 'animal_part_translation';
	public $table_translation_key = 'animal_part_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}