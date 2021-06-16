<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class CompanyPage_model extends Webcoder_Model {

	public $table = 'company_pages';
	public $primary_key = 'id';
	public $protected = [];

	public $relation_tables = [
		[
			'name'   => 'user_variables',
			'column' => 'user_id'
		]
	];

	public function __construct() {
		parent::__construct();
	}

	public function get_user_group( $select = '*', $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_user_to_group' );

		$this->db->where( $where );
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function insert_user_to_group( $data ) {
		$this->db->insert( 'wc_user_to_group', $data );
	}

	public function insert_company_name( $data ) {
		$this->db->insert( 'wc_new_company_name', $data );

		return $this->db->insert_id();
	}

	public function insert_certificate( $data ) {
		$this->db->insert( 'wc_confirm_account', $data );

		return $this->db->insert_id();
	}

	public function save_fcm( $id, $data ) {
		$this->db->where( 'id', $id );

		return $this->db->update( 'wc_company_pages', $data );
	}

	public function update_group( $id, $data ) {
		$this->db->where( 'user_id', $id );

		return $this->db->update( 'wc_user_to_group', $data );
	}

	public function deleteStandart( $user_id ) {
		$this->db->where( 'user_id', $user_id );

		return $this->db->delete( 'wc_user_standart_image' );
	}

	public function delete_interests( $user_id ) {
		$this->db->where( 'user_id', $user_id );

		return $this->db->delete( 'wc_user_interests' );
	}

	public function delete_interest( $id ) {
		$this->db->where( 'id', $id );

		return $this->db->delete( 'wc_user_interests' );
	}

	public function delete_any( $table, $where ) {
		$this->db->where( $where );

		return $this->db->delete( $table );
	}

	public function insert_any( $table, $data ) {
		return $this->db->insert( $table, $data );
	}

	public function select_any( $select = '*', $table, $where, $order = false ) {
		$this->db->select( $select );

		$this->db->from( $table );

		$this->db->where( $where );

		if ( $order != false ) {
			$this->db->order_by( $order, "ASC" );
		}

		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function delete_ntf( $user_id ) {
		$this->db->where( 'user_id', $user_id );

		return $this->db->delete( 'wc_user_settings' );
	}

	public function delete_standart( $array ) {
		$this->db->where( $array );

		return $this->db->delete( 'wc_user_standart_image' );
	}

	public function insertStandart( $data ) {
		return $this->db->insert( 'wc_user_standart_image', $data );
	}

	public function get_standart( $select = '*', $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_user_standart_image' );
		$this->db->join( 'wc_standart_translation', 'wc_standart_translation.standart_id=wc_user_standart_image.standart_id' );

		$this->db->where( $where );
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function getLastUser() {
		$this->db->select( [ '*' ] );
		$this->db->from( 'wc_site_user' );

		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}


	public function get_your_interests( $select, $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_user_interests' );

		$this->db->where( $where );
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function account_settings( $select, $where ) {
		$this->db->select( $select );
		$this->db->from( 'wc_user_settings' );

		$this->db->where( $where );
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}


	public function insert_user( $data ) {
		$this->db->insert( 'wc_company_pages', $data );

		return $this->db->insert_id();
	}

	public function insert_interests( $data ) {
		$this->db->insert( 'wc_user_interests', $data );

		return $this->db->insert_id();
	}

	public function insert_ntf_settings( $data ) {
		$this->db->insert( 'wc_user_settings', $data );

		return $this->db->insert_id();
	}

	public function insert_send_email_to_database( $data = [] ) {
		$this->db->insert( 'wc_emailsender', $data );

		return $this->db->insert_id();
	}

}
