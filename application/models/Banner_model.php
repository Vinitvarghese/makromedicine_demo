<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Banner_model extends Webcoder_Model {
	public $table = 'banner';
	public $table_translation = 'banner_translation';
	public $table_translation_key = 'banner_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}
