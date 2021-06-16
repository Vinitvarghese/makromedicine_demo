<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Company_model extends Webcoder_Model {

	public $table = 'company';
	public $primary_key = 'id';
	public $protected = [];

	public function __construct() {
		parent::__construct();
	}
}