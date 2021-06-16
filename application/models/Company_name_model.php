<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Company_name_model extends Webcoder_Model {

	public $table = 'new_company_name';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}
}
