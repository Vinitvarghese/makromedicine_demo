<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Continent_model extends Webcoder_Model {

	public $table = 'continent';
	public $table_translation = 'continent_translation';
	public $table_translation_key = 'continent_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}
}