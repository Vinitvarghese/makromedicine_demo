<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Faq_model extends Webcoder_Model {

	public $table = 'faq';
	public $table_translation = 'faq_translation';
	public $table_translation_key = 'faq_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}
}