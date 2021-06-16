<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Follow_model extends Webcoder_Model {
	public $table = 'user_follow';
	public $primary_key = 'id';
	public $protected = [];
	public $relation_tables = [];

	public function __construct() {
		parent::__construct();
	}

	public function check_follow( $where ) {
		return $this->fields( [ 'count(*) as count' ] )->filter( $where )->one()->count;
	}

	public function follow( $data ) {
		return $this->db->insert( $this->table, $data );
	}

	public function unfollow( $where ) {
		return $this->db->delete( $this->table, $where );
	}

}
