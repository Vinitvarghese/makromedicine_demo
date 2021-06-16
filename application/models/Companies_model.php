<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Companies_model extends Webcoder_Model {

    public $table = 'companies';
    public $primary_key = 'id';
    public $protected = [];
    public $rules = [];


    public function __construct() {
        parent::__construct();
    }

    public function index(){

    }

    public function getPageRoles(){
        $this->db->select("id, name");
        $this->db->from('wc_page_roles');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getCompanies(){

        $this->db->select("
            c.id, c.company_name, c.company_address, c.establishment_date, c.country_id,
            c.status,
            con.name AS `country_name`, 
            GROUP_CONCAT(u.fullname) AS `users`,
            GROUP_CONCAT(rel.role_id) AS `role_ids`,
            GROUP_CONCAT(rel.id) AS `role_main_id`,
            rel.approved
        ");
        $this->db->from('wc_companies AS c');
        $this->db->where('c.`deleted_at`', NULL);
        $this->db->join('wc_company_user_rel AS rel', 'rel.company_id=c.id', 'inner');
        $this->db->join('wc_users AS u', 'u.id=rel.user_id', 'inner');
        $this->db->join('wc_country_translation AS con', 'con.country_id=c.country_id AND con.language_id=1', 'left');
        $this->db->group_by("c.id");
        $this->db->order_by("c.status", "ASC");
        $this->db->order_by("c.id", "DESC");
        $query = $this->db->get();
        return $query->result_object();


    }

}
