<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Plans_model extends Webcoder_Model {
	public $table = 'plans';
	public $table_translation = 'plans_translation';
	public $table_translation_key = 'plans_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}


}
