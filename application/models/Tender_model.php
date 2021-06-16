<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Tender_model extends Webcoder_Model {
	public $table = 'tender';
	public $table_translation = 'tender_translation';
	public $table_translation_key = 'tender_id';
	public $primary_key = 'id';
	public $protected = [];
	public $rules = [];

	public function __construct() {
		parent::__construct();
	}


	public function with_user() {
		$this->db->join( 'users', 'users.id = tender.user_id', 'left' );

		return $this;
	}

	/*public function with_trade_terms()
	{
		$this->db->join('users', 'users.id = tender.user_id', 'left');
		$this->db->join('delivery_method', 'delivery_method.id = product.trade_id', 'left');
		return $this;
	}*/

	public function with_trade_terms() {
		$this->db->join( 'trade_term_translation', 'trade_term_translation.trade_term_id = tender.trade_term', 'left' );

		return $this;
	}

	public function with_group() {
		$this->db->join( 'groups', 'users.user_groups_id = groups.id', 'left' );

		return $this;
	}

	public function with_animal() {
		$this->db->join( 'product_animal', 'product_animal.product_id = tender.id', 'left' );
		$this->db->join( 'animal', 'animal.id = product_animal.animal_id', 'left' );
		$this->db->join( 'animal_translation', 'animal.id = animal_translation.animal_id', 'left' );

		return $this;
	}

	public function with_herbal() {
		$this->db->join( 'product_herbal', 'product_herbal.product_id = tender.id', 'left' );
		$this->db->join( 'plants', 'plants.id = product_herbal.herbal_id', 'left' );
		$this->db->join( 'plants_translation', 'plants.id = plants_translation.plants_id', 'left' );

		return $this;
	}

	public function with_chemical() {
		$this->db->join( 'product_chemical', 'product_chemical.product_id = tender.id', 'left' );
		$this->db->join( 'atc_code', 'atc_code.id = product_chemical.chemical_id', 'left' );
		$this->db->join( 'atc_code_translation', 'atc_code.id = atc_code_translation.atc_code_id', 'left' );

		return $this;
	}

	public function with_cas() {
		$this->db->join( 'product_cas', 'product_cas.product_id = tender.id', 'left' );
		$this->db->join( 'cas_list', 'cas_list.id = product_cas.cas_id', 'left' );
		$this->db->join( 'cas_list_translation', 'cas_list.id = cas_list_translation.cas_list_id', 'left' );

		return $this;
	}


	public function with_packing_type() {
		$this->db->join( 'product_packing_type', 'product_packing_type.product_id = tender.id', 'left' );
		$this->db->join( 'packing_type', 'packing_type.id = product_packing_type.packing_type_id', 'left' );
		$this->db->join( 'packing_type_translation', 'packing_type.id = packing_type_translation.packing_type_id', 'left' );

		return $this;
	}

	public function with_product_type() {
		$this->db->join( 'product_type_translation', 'product_type_translation.product_type_id = tender.pr_type', 'left' );

		return $this;
	}

	public function with_translation( $language_id = false ) {
		$this->db->join( 'tender_translation', 'tender.id = tender_translation.tender_id', 'left' );

		return $this;

	}


	public function order_by( $column = false, $order = false ) {
		if ( ! $column ) {
			$column = $this->primary_key;
		}

		if ( ! $order ) {
			$order = 'ASC';
		}

		$this->db->order_by( $column, $order );

		return $this;
	}

	public function get_product_id( $packing_type_id ) {
		$this->db->select( 'product_id' );
		$this->db->from( 'wc_product_packing_type' );
		$this->db->where( [ 'packing_type_id IN(' . $packing_type_id . ')' => null ] );
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function get_all_search( $country_id ) {
		$this->db->select( 'wc_user_interests_country.user_id as user_id' );
		$this->db->from( 'wc_user_interests_continent' );
		$this->db->join( 'wc_user_interests_country', 'wc_user_interests_country.user_id = wc_user_interests_continent.user_id', 'LEFT' );
		$this->db->where( [ 'wc_user_interests_country.country_id' => $country_id ] );
		$this->db->group_by( 'user_id' );
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}


	public function searcing() {
		$rows = $this->db->get( 'wc_searching' );

		if ( $rows->num_rows() > 0 ) {
			if ( $this->as_array ) {
				return $rows->result_array();
			}

			return $rows->result();
		}

		return false;
	}



	/*public function delete_images($id)
	{
		$this->db->delete('tender_images', ['product_id' => $id]);
	}

	public function delete_image($id)
	{
		return $this->db->delete('wc_tender_images', ['image_id' => $id]);
	}

	public function insert_image($data)
	{
		$this->db->insert('tender_images', $data);
	}*/

	/*public function get_product_images($select,$where)
	{
		$this->db->select($select);
		$this->db->from('wc_tender_images');

		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
	}*/

	public function insert_relation( $table_name, $data ) {
		$this->db->insert( $table_name, $data );
	}

	public function delete_translation( $id ) {
		$this->db->where( $this->table_translation_key, $id );
		$this->db->delete( $this->table_translation );

		return $this;
	}

	public function delete_pr( $id ) {
		$this->db->where( 'id', $id );
		$this->db->delete( $this->table );

		return $this;
	}
}