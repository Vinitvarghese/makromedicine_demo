<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Controller extends Webcoder_Controller
{

    public $load_model = FALSE;
    public $site_theme = 'default';

    public function __construct() {
        parent::__construct();
        if ($this->load_model === TRUE) {
            $this->load->model($this->model);
        }

        $this->data['logged_user_id']=0;


        // LOAD GLOBAL MODEL
        $this->load->model('Country_model');
        $this->load->model('Continent_model');
        $this->load->model('Standart_model');
        $this->load->model('Menu_item_model');
        $this->load->model('Product_type_model');
        $this->load->model('Atc_code_model');
        $this->load->model('User_model');
        $this->load->model('Companies_model');
        $this->load->model('Language_model');
        $this->load->model('Group_model');
        $this->load->model('Confirm_account_model');
        $this->load->model('Notify_model');
        $this->load->model('Event_type_model');
        $this->load->model('Messages_model');
        $this->load->model('Medical_classifiction_model');
        $this->load->model('Packing_type_model');
        $this->load->model('Trade_term_model');
        $this->load->helper('extra');

        // SITE AND SEO CONFIGURATION
        $this->data['css']                            = '';
        $this->data['js']                             = '';
        $this->data['title']                          = 'Makromedicine.com | WORLDWIDE PHARMACEUTICAL PORTAL';
        $this->data['description']                    = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
        $this->data['keywords']                       = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor';
        $this->data['current_url']                    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->data['current_img']                    = base_url('uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg');
        $this->data['meta_charset']                   = 'utf-8';
        $this->data['meta_content_type']              = 'text/html;charset=UTF-8';
        $this->data['meta_title']                     = '';
        $this->data['meta_keyword']                   = '';
        $this->data['meta_description']               = '';
        $this->data['meta_robots']                    = 'index, follow';
        $this->data['meta_facebook_app_id']           = '459567871231062';
        $this->data['meta_facebook_url']              = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->data['meta_facebook_type']             = 'website';
        $this->data['meta_facebook_title']            = '';
        $this->data['meta_facebook_description']      = '';
        $this->data['meta_facebook_image']            = '';
        $this->data['meta_facebook_width']            = '470';
        $this->data['meta_facebook_height']           = '246';
        $this->data['meta_facebook_site_name']        = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->data['meta_author']                    = 'Makromedicine';
        $this->data['meta_twitter_card']              = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->data['meta_twitter_site']              = '@'.base_url();
        $this->data['meta_twitter_creator']           = '@'.base_url();
        $this->data['meta_googlebot']                 = 'index, follow, archive, all';
        $this->data['meta_msnbot']                    = 'index,follow';
        $this->data['meta_dmozbot']                   = 'index,follow';
        $this->data['meta_revisit_after']             = '1 days';
        $this->data['meta_copyright']                 = 'copyright';
        $this->data['meta_google_signin_scope']       = 'profile email';
        $this->data['meta_google_signin_client_id']   = '396443107575-7pr8m1j6g1ak1lnj85rhbanhkr86h1mi.apps.googleusercontent.com';//'668154067739-t6vik0h6lfdqlr4pej8fima7aqhu5hci.apps.googleusercontent.com';
        $this->data['meta_viewport']                  = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no';
        $this->data['link_img_src']                   = $this->data['current_img'];
        $this->data['link_canonical']                 = base_url();
        $this->data['link_shortcut_icon']             = base_url('templates/default/assets/img/favicon.ico');

        // SEARCH CONFIGURATION
        $this->data['search_type']      = 5;
        $this->data['event_type_con']   = 0;
        $this->data['keyword']          = '';
        $this->data['event_start']      = '';
        $this->data['event_end']        = '';
        $this->data['pr_type']          = [];
        $this->data['company_id']       = [];
        $this->data['search_continent'] = [];
        $this->data['search_country']   = [];
        $this->data['content_types']    = [];
        $this->data['search_status']    = [];
        $this->data['search_standart']  = [];
        $this->data['atc_classifiction']= [];
        $this->data['event_continent']  = [];
        $this->data['event_country']    = [];


        $this->data['menu_items']       = $this->Menu_item_model->filter(['menu_id'=>1,'parent_id'=>0])->order_by('sort', 'ASC')->fields(['id', 'name', 'slug'])->with_translation()->all();
        $this->data['countrys']         = $this->Country_model->fields(['id', 'name', 'code','continent_id','images'])->with_translation()->all();
        $this->data['continents']       = $this->Continent_model->fields(['id', 'name','code'])->with_translation()->all();
        $this->data['event_types']      = $this->Event_type_model->fields(['id', 'name'])->order_by('name', 'ASC')->with_translation()->all();
        $this->data['product_types']    = $this->Product_type_model->fields(['id', 'name'])->order_by('sort', 'ASC')->with_translation()->all();
        $this->data['medicals']         = $this->Medical_classifiction_model->filter(['status' => '1'])->fields(['id', 'name'])->limit(50, 1)->with_translation()->all();
        $this->data['dossageforms']     = $this->Packing_type_model->filter(['status' => '1'])->fields(['id', 'name'])->limit(50, 1)->with_translation()->all();
        $this->data['standarts']        = $this->Standart_model->fields(['id', 'name'])->with_translation()->all();
 
        $this->data['groups']           = $this->Group_model->fields(['id', 'name'])->filter(['id !='=>1])->all();
        $this->data['languages']        = $this->Language_model->fields(['id', 'slug', 'name'])->order_by('sort', 'ASC')->all();
        $this->data['companies']        = $this->Companies_model->getCompanies();
       $this->data['parent_atc']       = $this->Atc_code_model->fields(['id', 'atc_code', 'id_parent', 'meaning'])->order_by('sort', 'ASC')->filter(['CHAR_LENGTH(atc_code)'=> 1])->with_translation()->all();
        $this->data['all_atc']          = $this->Atc_code_model->fields(['id', 'atc_code', 'id_parent', 'meaning'])->order_by('sort', 'ASC')->filter(['CHAR_LENGTH(atc_code)'=> 3,'CHAR_LENGTH(atc_code) != 2' => NULL, 'id_parent != 0' => NULL])->with_translation()->all();
        $this->data['list_atc']         = [];

        if($this->data['all_atc'])
        foreach($this->data['all_atc'] as $all_atc)
        {
              $this->data['list_atc'][$all_atc->id_parent][] = $all_atc;
        }




        $page_url=$this->uri->segment('3');
        $page_url=($page_url=='pages') ? $this->uri->segment('4') : $page_url;
        $company_data=$this->User_model->getUserData(['c.slug'=>$page_url]);

        $this->load->library("Auth");
        if ($this->auth->is_loggedin()) {

            if(isset($this->auth->get_user()->id))
            {
              $this->data['user'] = [
                  'id'            => $this->auth->get_user()->id,
                  'status'        => $this->auth->get_user()->status,
                  'email'         => $this->auth->get_user()->email,
                  'phone'         => $this->auth->get_user()->phone,
                  'fullname'      => $this->auth->get_user()->fullname,
                  'images'        => $this->auth->get_user()->images,
                  'group_id'  =>  $this->auth->get_user()->user_groups_id,
              ];
              $this->data['get_user_group'] = $this->User_model->get_user_group(['user_id'=>$this->data['user']['id']],'*');
              if($this->data['get_user_group'] != false)
              {
                  foreach ($this->data['get_user_group'] as $key=>$value)
                  {
                      $this->data['user']['group_id'] = $value['group_id'];
                  }
              }
              $this->data['get_groups_name'] = $this->Group_model->fields(['name'])->filter(['id'=>$this->data['user']['group_id']])->one();
              $this->session->set_userdata($this->data['user']);

              $this->data['logged_user_id']          = $this->auth->get_user()->id;
              $this->data['user']          = $this->session->userdata;





              $this->data['UserData'] =$this->User_model->getUserMainData(['u.id'=>$this->data['user']['id']]);






                  //$this->User_model->fields('*')->filter(['id'=>$this->data['user']['id']])->one();
              $this->data['check_notify']  = $this->Notify_model->fields('*')->filter(['user_id'=>$this->data['user']['id'],'status'=>1])->all();
              $this->data['get_notify']  = $this->Notify_model->fields('*')->filter(['user_id'=>$this->data['user']['id']])->order_by('id','desc')->all();
              $this->data['check_msg']  = $this->db->where(['user_id_fk2'=>$this->data['user']['id'],'seen'=>0])->get('wc_user_conversation_reply')->result();
              $this->data['check_msg']  = count($this->data['check_msg']);

              $this->data['user_images'] = '';
              if(empty($this->data['UserData']->images))
              {
                  $this->data['user_images'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
              }
              else
              {
                if(!filter_var($this->data['UserData']->images, FILTER_VALIDATE_URL))
                {
                    $this->data['user_images'] = base_url('uploads/catalog/users/').$this->data['UserData']->images;
                }
                else
                {
                    $this->data['user_images'] = $this->data['UserData']->images;
                }
              }

	            if(empty($this->data['UserData']->company_logo))
	            {
		            $this->data['company_logo'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
	            }
	            else
	            {
		            if(!filter_var($this->data['UserData']->company_logo, FILTER_VALIDATE_URL))
		            {
			            $this->data['company_logo'] = base_url('uploads/catalog/users/').$this->data['UserData']->company_logo;
		            }
		            else
		            {
			            $this->data['company_logo'] = $this->data['UserData']->company_logo;
		            }
	            }

	            if(empty($this->data['UserData']->company_banner))
	            {
		            $this->data['company_banner'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
	            }
	            else
	            {
		            if(!filter_var($this->data['UserData']->company_banner, FILTER_VALIDATE_URL))
		            {
			            $this->data['company_banner'] = base_url('uploads/catalog/users/').$this->data['UserData']->company_banner;
		            }
		            else
		            {
			            $this->data['company_banner'] = $this->data['UserData']->company_banner;
		            }
	            }

	            $user=$this->data['UserData'];
                $user_id=$user->id;






              $this->data['user_page_and_roles']=$this->User_model->getUserCompanyAndRoles($this->data['user']['id']);


              $page_data=$this->User_model->getPageDataByLink($page_url);

              $user_position_id=(isset($this->data['UserData']->position)) ? $this->data['UserData']->position : 0;



              if(!empty($page_data)){
                  $user_page_permission=$this->User_model->getUserPermissionByPage($this->data['UserData']->id, $page_data->id);



                  if (!empty($user_page_permission)){
                      $this->data['user_page_permission']=$user_page_permission;

                      $this->data['UserData']=$this->User_model->getUserData([
                          'u.id' => $user_page_permission->user_id,
                          'c.id' => $user_page_permission->company_id
                      ]);


                      $user_position_id=$this->data['UserData']->position;
                  }else if($this->uri->segment('2')=="companies"){
                      $this->data['UserData'] =$company_data;
                  }
              }





              $this->data['permission_list']= $this->User_model->getUserPermission($user_position_id);



              /*foreach ($this->data['permission_list']  as $k => $v){
                  $v->add=1;
                  $v->edit=1;
                  $v->view=1;
                  $v->delete=1;
                  $v->reply=1;
              }*/



              $this->data['month_list']=['01' => 'January', '02' => 'February', '03' => 'March', '04'=>'April', '05' =>'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
              $this->data['work_experiences'] =[0 => 'Choose', 1 => '1-3 years', 2 => '3-5 years', 3 => '5-7 years', 4 => '7-10 years', 5 => '10+ years'];







                if (isset($this->data['UserData']->company_id)){
                    $company_id=$this->data['UserData']->company_id;


                    $this->data['company_star_rate_count'] = $this->User_model->getCompanyAvgRate($company_id);
                    $this->data['company_rate'] =  $this->User_model->getCompanyRateByUser($company_id, $user_id);


                    $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();
                    
                    
               
                }else{
                    $this->data['company_star_rate_count'] = 0;
                    $this->data['company_rate'] =  0;
                }


                /*echo "<pre>";
                print_r($this->data['permission_list']);
                exit;*/
            }
            else
            {
                $this->auth->logout();
            }
        }else{


            $this->data['UserData'] =$company_data;


            $this->data['company_star_rate_count'] = (!empty($this->data['UserData'])) ? $this->User_model->getCompanyAvgRate($this->data['UserData']->company_id) : 0;
            $this->data['company_rate'] =  0;

        }
        $this->data['is_loggedin'] = $this->auth->is_loggedin();
    }

    public function render($template = false, $layout = false) {
        //Düzəlt
        if (!$layout) {
            $this->data['layout'] = 'templates/default/layout/default.tpl';
        }
        else {
            $this->data['layout'] = 'templates/default/layout/' . $layout . '.tpl';
        }
        //Düzəlt

        if ($template) {
            $template = 'templates/' . $this->site_theme . '/' . $template;
        }

        parent::render($template);
    }

    public function fetch($template = false, $layout = false) {
        //Düzəlt
        if (!$layout) {
            $this->data['layout'] = 'templates/default/layout/default.tpl';
        }
        else {
            $this->data['layout'] = 'templates/default/layout/' . $layout . '.tpl';
        }
        //Düzəlt

        if ($template) {
            $template = 'templates/' . $this->site_theme . '/' . $template;
        }

        $output =  parent::fetch($template);
      return $output;
    }


}
