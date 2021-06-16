<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Page_model extends Webcoder_Model {

	public $table = 'page';
	public $table_translation = 'page_translation';
	public $table_translation_key = 'page_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}