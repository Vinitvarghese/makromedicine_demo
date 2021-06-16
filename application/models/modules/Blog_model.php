<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Blog_model extends Webcoder_Model {
	public $table = 'blog';
	public $table_translation = 'blog_translation';
	public $table_translation_key = 'blog_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}


}
