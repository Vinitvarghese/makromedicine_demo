<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Notify_model extends Webcoder_Model {
	public $table = 'user_notify';
	public $primary_key = 'id';
	public $protected = [];
	public $relation_tables = [];

	public function __construct() {
		parent::__construct();
	}

	public function send( $data ) {
		return $this->db->insert( $this->table, $data );
	}

	public function check_notify( $where ) {
		return $this->fields( [ 'count(*) as count' ] )->filter( $where )->one()->count;
	}

	public function delete_notify( $where ) {
		return $this->db->delete( $this->table, $where );
	}

	public function check_notify_data( $where ) {
		return $this->fields( '*' )->filter( $where )->all();
	}

	public function update_notify( $data, $where ) {
		$this->db->where( $where );

		return $this->db->update( $this->table, $data );
	}

}
