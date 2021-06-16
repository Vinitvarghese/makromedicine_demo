<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Companies_model');
        $this->load->helper('extra');
        $this->load->library("phpmailer_library");

    }

    public function index()
    {
        if (isset($_POST['update_permission']) && isset($_POST['id'])){
            $this->updateUserPermission();
            exit;
        }


        $this->data['title'] = translate('index_title');
        $this->data['subtitle'] = translate('index_description');


        $this->data['full_url'] = $this->directory.$this->controller;

        $this->data['permission_list'] =$this->{$this->model}->getPermissions();
        $this->data['roles']=$this->{$this->model}->getPageRoles();
        $this->data['role_and_permission']=$this->{$this->model}->getRoleAndPermission();


        $this->template->render();
    }

    public function updateUserPermission(){
        $id=$_POST['id'];
        $column=$_POST['column'];
        $checked=$_POST['checked'];

        $this->db->set([$column => $checked], FALSE);
        $this->db->where('id', $id);
        $this->db->update('wc_page_role_permission');

        echo json_encode(['success' => true]);
    }




}
