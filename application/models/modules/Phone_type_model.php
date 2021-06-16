<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Phone_type_model extends Webcoder_Model {

	public $table = 'phone_type';
	public $table_translation = 'phone_type_translation';
	public $table_translation_key = 'phone_type_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}