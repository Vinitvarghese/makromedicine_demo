<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Plants_model extends Webcoder_Model {
	public $table = 'plants';
	public $table_translation = 'plants_translation';
	public $table_translation_key = 'plants_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}
}