<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Herb_part_model extends Webcoder_Model {

	public $table = 'herb_part';
	public $table_translation = 'herb_part_translation';
	public $table_translation_key = 'herb_part_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}