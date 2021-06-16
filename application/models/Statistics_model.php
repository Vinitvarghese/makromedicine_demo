<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Statistics_model extends Webcoder_Model {

	public $table = 'statistics';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}