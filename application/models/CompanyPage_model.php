<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class CompanyPage_model extends Webcoder_Model {

	public $table = 'company_pages';
	public $primary_key = 'id';
	public $protected = [];

	// Data tables
	var $column_order = array( null, 'company_name' );
	var $column_search = array( 'company_name' );
	var $table_order = array( 'id' => 'asc' );

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
		// die($this->db->last_query());
        // print_r($query); die();
		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function get_company_details() {
		$this->_get_query();
		$this->_searchWhereQuery();
		$this->db->where_not_in('user_groups_id', [1, 6]);
		if ( isset( $_POST['length'] ) && $_POST['length'] < 1 ) {
			$_POST['length'] = '10';
		} else {
			$_POST['length'] = $_POST['length'];
		}

		if ( isset( $_POST['start'] ) && $_POST['start'] > 1 ) {
			$_POST['start'] = $_POST['start'];
		}
		$this->db->limit( $_POST['length'], $_POST['start'] );
		$query = $this->db->get();

		/*$str = $this->db->last_query();
		echo "<pre>";
		print_r($str);
		exit;*/

		return $query->result();
	}

	private function _searchWhereQuery() {
		foreach ( $_POST['search'] as $search_column => $search_value ) {
			if ( $search_column !== 'value' && $search_column !== 'regex' ) {
				if ( $search_column !== 'product_type' && $search_column !== 'standart' ) {
					if ( is_array( $search_value ) && !empty($search_value) ) {
						$this->db->where_in( $search_column, $search_value );
					} else if (trim($search_value, " \t\n\r\0") !== '') {
						$this->db->where( $search_column, $search_value );
					}
				} else {
					if ( is_array( $search_value ) && !empty($search_value) ) {
						foreach ($search_value as $single_search_value) {
							$this->db->like( $search_column, $single_search_value );
						}
					} else if (trim($search_value, " \t\n\r\0") !== '') {
						$this->db->like( $search_column, $search_value );
					}
				}
			}
		}
	}

	private function _get_query() {
		$this->db->from( $this->table );
		$i = 0;
		foreach ( $this->column_search as $user ) // loop column
		{
			if ( isset( $_POST['search']['value'] ) && ! empty( $_POST['search']['value'] ) ) {
				$_POST['search']['value'] = $_POST['search']['value'];
			} else {
				$_POST['search']['value'] = '';
			}
			if ( $_POST['search']['value'] ) // if datatable send POST for search
			{
				if ( $i === 0 ) // first loop
				{
					$this->db->group_start();
					$this->db->like( $user, $_POST['search']['value'] );
				} else {
					$this->db->or_like( $user, $_POST['search']['value'] );
				}

				if ( count( $this->column_search ) - 1 == $i ) //last loop
				{
					$this->db->group_end();
				} //close bracket
			}
			$i ++;
		}

		if ( isset( $_POST['order'] ) ) // here order processing
		{
			$this->db->order_by( $this->column_order[ $_POST['order']['0']['column'] ], $_POST['order']['0']['dir'] );
		} else if ( isset( $this->order ) ) {
			$order = $this->order;
			$this->db->order_by( key( $order ), $order[ key( $order ) ] );
		}
	}

	function get_company_details_count_filtered() {
		$this->_get_query();
		$this->_searchWhereQuery();
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function get_company_details_count_all() {
		$this->db->from( $this->table );

		return $this->db->count_all_results();
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

	public function delete_certificate( $del_id ) {
		$this->db->delete( 'wc_confirm_account', array( 'user_id' => $del_id ) );

		return true;
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

			$return_data = $query->result_array();
			foreach ( $return_data as $key => $value ) {
				$return_data[ $key ]['isPdf'] = ( strpos( $value['name'], 'pdf' ) !== false ) ? true : false;
			}

			return $return_data;
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
