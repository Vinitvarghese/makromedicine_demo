<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Parent_services_model extends Webcoder_Model {

	public $table = 'parent_services';
	public $table_translation = 'parent_services_translation';
	public $table_translation_key = 'parent_services_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}
