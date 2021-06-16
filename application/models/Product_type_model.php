<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Product_type_model extends Webcoder_Model {
	public $table = 'product_type';
	public $table_translation = 'product_type_translation';
	public $table_translation_key = 'product_type_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}