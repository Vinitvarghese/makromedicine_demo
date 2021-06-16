<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Trade_term_model extends Webcoder_Model {

	public $table = 'trade_term';
	public $table_translation = 'trade_term_translation';
	public $table_translation_key = 'trade_term_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

}