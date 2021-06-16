<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Cas_list_model extends Webcoder_Model {

	public $table = 'cas_list';
	public $table_translation = 'cas_list_translation';
	public $table_translation_key = 'cas_list_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}