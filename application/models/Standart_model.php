<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Standart_model extends Webcoder_Model {

	public $table = 'standart';
	public $table_translation = 'standart_translation';
	public $table_translation_key = 'standart_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}