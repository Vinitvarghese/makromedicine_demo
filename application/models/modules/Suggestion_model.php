<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Suggestion_model extends Webcoder_Model {
	public $table = 'suggestion';
	public $primary_key = 'id';
	public $protected = [];
	public $relation_tables = [];

	public function __construct() {
		parent::__construct();
	}


}
