<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Country_model extends Webcoder_Model {

	public $table = 'country';
	public $table_translation = 'country_translation';
	public $table_translation_key = 'country_id';
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