<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Herb_form_model extends Webcoder_Model {

	public $table = 'herb_form';
	public $table_translation = 'herb_form_translation';
	public $table_translation_key = 'herb_form_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}

	public function callback_get_continent( $data ) {
		$this->{$this->model}->filter( [ 'id' => $data ] )->one();
	}

}