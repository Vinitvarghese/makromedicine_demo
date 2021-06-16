<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class News_model extends Webcoder_Model {

	public $table = 'news';
	public $table_translation = 'news_translation';
	public $table_translation_key = 'news_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}