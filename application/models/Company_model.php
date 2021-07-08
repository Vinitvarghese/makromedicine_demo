<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Company_model extends Webcoder_Model {

	public $table = 'companies';
	public $primary_key = 'id';
	public $protected = [];

	public function __construct() {
		parent::__construct();
	}

    public function getContinentName($country_id){
        $this->db->select('tr.name');
        $this->db->from('wc_country AS con');
        $this->db->where('con.`id`', $country_id);
        $this->db->join('wc_continent AS cont', 'cont.code=con.continent_id', 'inner');
        $this->db->join('wc_continent_translation AS tr', "tr.continent_id=cont.id AND tr.language_id=1",  'inner');
        $query = $this->db->get();
        $data=$query->row();

        return $data->name;

    }

	public function checkCompany($where){
        $this->db->select('id');
        $this->db->from($this->table);

        $this->db->where( $where );
        $query = $this->db->get();

        return ($query->num_rows() == 1) ? $query->row()->id : false;
    }

    public function insert_company( $data ) {
        $this->db->insert($this->table, $data );

        return $this->db->insert_id();
    }

    public function updateCompany($id, $data){
        $this->db->where( 'id', $id );

        $this->db->update($this->table, $data );
    }

    public function insert_company_user_rel( $data ) {
        $this->db->insert('wc_company_user_rel', $data );

        return $this->db->insert_id();
    }

    public function update_company_user_rel( $data, $where ) {
        $this->db->where($where);

        $this->db->update('wc_company_user_rel', $data );
    }

    public function check_company_user_rel( $where ) {

        $this->db->select('id');
        $this->db->from('wc_company_user_rel');

        $this->db->where( $where );
        $query = $this->db->get();

        return ($query->num_rows() == 1) ? false : true;
    }

    public function searchCompanyForApply($company_name, $user_id){
        $this->db->select('c.company_name as label, c.id');
        $this->db->from('wc_companies AS c');
        $this->db->where("c.id NOT IN(select company_id from wc_company_user_rel WHERE user_id='".$user_id."') ");
        $this->db->like('c.company_name', $company_name, 'both');
        $this->db->group_by( 'c.company_name' );
        $this->db->order_by( 'c.company_name' );
        $query = $this->db->get();

        return $query->result_object();
    }

    public function get_standart($where, $select = '*' ) {
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

    public function delete_standart( $array ) {
        $this->db->where( $array );

        $this->db->delete( 'wc_user_standart_image' );

        $st_ids=$this->get_standart([ 'user_id' => $array['user_id']],'*');
        $ids=[];

        if(!empty($st_ids)){
            foreach ($st_ids as $id){
                $ids[]=$id['standart_id'];
            }
        }

        $up_data=[
            'standart' => implode(',', $ids)
        ];

        $company_id=$this->getCompanyIdByUserId([
            'user_id' => $array['user_id']
        ]);

        $this->db->where( 'id', $company_id );
        return $this->db->update( 'wc_companies', $up_data );

    }

    public function getCompanyIdByUserId($where=[]){
        $this->db->select('*');
        $this->db->from("wc_company_user_rel");

        $this->db->where($where);
        $query = $this->db->get();

        return ($query->num_rows() == 1) ? $query->row() : false;
    }

    public function insert_company_name( $data ) {
        $this->db->insert( 'wc_new_company_name', $data );

        return $this->db->insert_id();
    }

    public function save_fcm( $id, $data ) {
        $this->db->where( 'id', $id );

        return $this->db->update( 'wc_companies', $data );
    }
}
