<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Tags_model extends Webcoder_Model {

	public $table = 'tags';
	public $table_translation = 'tags_translation';
	public $table_translation_key = 'tags_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}