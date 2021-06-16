<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class New_office_model extends Webcoder_Model {

	public $table = 'new_office';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}