<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Permissions_model extends Webcoder_Model {

    public $table = 'companies';
    public $primary_key = 'id';
    public $protected = [];
    public $rules = [];


    public function __construct() {
        parent::__construct();
    }

    public function index(){

    }

    public function getPermissions(){
        $this->db->select("id, name");
        $this->db->from('wc_page_permission');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getPageRoles(){
        $this->db->select("id, name");
        $this->db->from('wc_page_roles');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getRoleAndPermission(){

        $this->db->select("*");
        $this->db->from('wc_page_role_permission');
        $query = $this->db->get();
        $data=$query->result_object();
        $array=[];

        foreach ($data as $k => $v){
            $array[$v->permission_id][$v->role_id]=[
                'id' => $v->id,
                'add' => $v->add,
                'edit' => $v->edit,
                'view' => $v->view,
                'delete' => $v->delete,
            ];
        }

        return $array;
    }

}
