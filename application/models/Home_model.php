<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Home_model extends Webcoder_Model {

	public $table = 'users';
	public $primary_key = 'id';
	public $protected = [];
	public $relation_tables = [];

	public function __construct() {
		parent::__construct();
	}

	public function getProductCount() {
		$query = $this->db->query( "SELECT 
            country, COUNT(id) 
            FROM 
            wc_product left join wc_product_translation 
            on wc_product_translation.product_id=wc_product.id 
            where title is not null and checked=1 and deleted_at is null 
            and user_id in(select id from wc_users where checked=1 and status=1 and (isvisible is NULL or isvisible = 0) and deleted_at is null) 
            GROUP BY country
            " );


		return $query->result_array();
	}

	public function select_import( $select = '*' ) {
		$this->db->select( $select );
		$this->db->from( 'wc_article' );
		$this->db->join( 'wc_article_file', 'wc_article_file.id_item = wc_article.id', 'LEFT' );
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	public function get_all_search( $status, $country_id ) {
		$this->db->select( '*' );
		$this->db->from( 'wc_user_interests' );
		$this->db->where( [ 'status REGEXP "(^|,)' . $status . '(,|$)"'                                               => null,
		                    'country REGEXP "(^|,)' . $country_id . '(,|$)"'                                          => null,
		                    'user_id in(select id from wc_users where deleted_at is null and status=1 and checked=1)' => null
		] );
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

	/*public function get_all_search($continent_id,$country_id)
	{
		$this->db->select('wc_user_interests_country.user_id as user_id');
		$this->db->from('wc_user_interests_continent');
		$this->db->join('wc_user_interests_country', 'wc_user_interests_country.user_id = wc_user_interests_continent.user_id', 'LEFT');
		$this->db->where(['wc_user_interests_continent.continent_id'=>$continent_id, 'wc_user_interests_country.country_id' => $country_id]);
		$this->db->group_by('user_id');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return false;
	}*/

	public function group_by_user( $user_id ) {
		$this->db->select( '`user_groups_id`, count(id) as total' );
		$this->db->from( 'wc_users' );
		$this->db->where( [ 'id in(' . $user_id . ')' => null ] );
		$this->db->group_by( 'user_groups_id' );
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result_array();
		}

		return false;
	}

}
