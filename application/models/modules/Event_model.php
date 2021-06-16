<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Event_model extends Webcoder_Model {

	public $table = 'event';
	public $table_translation = 'event_translation';
	public $table_translation_key = 'event_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}


}