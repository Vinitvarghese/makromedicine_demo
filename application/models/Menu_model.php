<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Menu_model extends Webcoder_Model {

	public $table = 'menu';
	public $table_translation = 'menu_translation';
	public $table_translation_key = 'menu_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}
}