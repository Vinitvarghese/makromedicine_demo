<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Company extends Site_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( 'User_model' );
        $this->load->model( 'Companies_model' );
        $this->load->model( 'Product_model' );
        $this->load->model( 'Person_type_model' );
        $this->load->model( 'Product_type_model' );
        $this->load->library( 'Auth' );
        $this->load->model( 'Tags_model' );
        $this->load->model( 'Country_model' );
        $this->load->model( 'Standart_model' );
        $this->load->model( 'Phone_type_model' );
        $this->load->model( 'Follow_model' );
        $this->load->model( 'Group_model' );
        $this->load->model( 'Unit_model' );
        $this->load->model( 'Purity_unit_model' );
        $this->load->helper( 'extra' );

        if ($this->auth->is_loggedin()){

            if(isset($this->auth->get_user()->id)){
                $this->data['user_following'] = $this->Follow_model->fields( [ 'count(*) as count' ] )->filter( [ 'follower_id' => $this->auth->get_user()->id ] )->one()->count;
                $this->data['user_followers'] = $this->Follow_model->fields( [ 'count(*) as count' ] )->filter( [ 'followed_user' => $this->auth->get_user()->id] )->one()->count;
            }


        }
    }

    public function index( $slug = null ) {
        if ( $slug !== null && $slug!='give_rating' && $slug!='add_new_person_type') {
            $this->data['company'] =  $this->data['UserData'];

            // print_r($this->data['company']);die();

            $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $this->data['company']->id );

            if (!empty($group)) {
                $group_id                          = $group[0]['group_id'];
                $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

                if(isset($group_name->name)) {
                    $this->data['company']->group_name = $group_name->name;
                }


            }else {
                $this->data['company']->group_name = '';
            }

            if ( $this->data['company'] ) {



                $this->data['company_images'] = '';

                if ( empty( $this->data['company']->images ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
                } else {
                    if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                        $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                    } else {
                        $this->data['company_images'] = $this->data['company']->images;
                    }
                }


                $segment_array            = $this->uri->segment_array();
                $page                     = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
                $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
                $this->data['limit']      = [ 'per_page' => 10, 'page' => $page ];

                if ( $this->data['is_loggedin'] == false ) {
                    $this->data['check_follow'] = 0;
                } else {
                    $this->data['check_follow'] = $this->Follow_model->check_follow( [
                        'follower_id' => $this->data['user']['id'],
                        'followed_company' => $this->data['company']->id
                    ] );
                }

                //$this->data['products']       = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();

                //Pagination
                $config['full_tag_open']      = '<ul class="pagination">';
                $config['full_tag_close']     = '</ul>';
                $config['first_link']         = '&laquo;';
                $config['first_tag_open']     = '<li class="page-item">';
                $config['first_tag_close']    = '</li>';
                $config['last_link']          = '&raquo;';
                $config['last_tag_open']      = '<li class="page-item">';
                $config['last_tag_close']     = '</li>';
                $config['next_link']          = '&rarr;';
                $config['next_tag_open']      = '<li class="page-item">';
                $config['next_tag_close']     = '</li>';
                $config['prev_link']          = '&larr;';
                $config['prev_tag_open']      = '<li class="page-item">';
                $config['prev_tag_close']     = '</li>';
                $config['cur_tag_open']       = '<li class="page-item"><a href="">';
                $config['cur_tag_close']      = '</a></li>';
                $config['num_tag_open']       = '<li class="page-item">';
                $config['num_tag_close']      = '</li>';
                $config['anchor_class']       = 'follow_link';
                $config['reuse_query_string'] = true;
                $config['use_page_numbers']   = true;
                $config['base_url']           = site_url_multi( 'company/' . $this->data['company']->slug );
                $config['total_rows']         = $this->data['total_rows'];
                $config['per_page']           = $this->data['limit']['per_page'];
                $this->pagination->initialize( $config );
                $this->data['pagination'] = $this->pagination->create_links();

                $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


                /* INSERT STATISTICS */

                $country_id = $this->data['ip_country']->id;
                $ip         = $_SERVER['REMOTE_ADDR'];

                $query_st = $this->db->get_where( 'wc_ip_filter', [
                    'section' => 'company',
                    'ip'      => $ip,
                    'type'    => $this->data['company']->id
                ] );

                if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                    $data = array(
                        'section' => 'company',
                        'type'    => $this->data['company']->id,
                        'country' => $country_id,
                        'month'   => date( 'm' ),
                        'year'    => date( 'Y' )
                    );

                    $query = $this->db->get_where( 'wc_statistics', $data );

                    if ( $query && $query->num_rows() > 0 ) {
                        $res = $query->result()[0];
                        $this->db->set( 'value', 'value+1', false );
                        $this->db->where( 'id', $res->id );
                        $this->db->update( 'wc_statistics' );
                    } else {
                        $data['value'] = 1;
                        $this->db->insert( 'wc_statistics', $data );
                    }

                    $this->db->insert( 'wc_ip_filter', [
                        'section'  => 'company',
                        'ip'       => $ip,
                        'type'     => $this->data['company']->id,
                        'add_date' => time()
                    ] );

                }


                $query_st = $this->db->get_where( 'wc_ip_filter', [
                    'section' => 'country',
                    'ip'      => $ip,
                    'type'    => $this->data['company']->id
                ] );

                if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                    $data = array(
                        'section' => 'country',
                        'type'    => $this->data['company']->country_id,
                        'country' => $country_id,
                        'month'   => date( 'm' ),
                        'year'    => date( 'Y' )
                    );

                    $query = $this->db->get_where( 'wc_statistics', $data );

                    if ( $query && $query->num_rows() > 0 ) {

                        $res = $query->result()[0];
                        $this->db->set( 'value', 'value+1', false );
                        $this->db->where( 'id', $res->id );
                        $this->db->update( 'wc_statistics' );
                    } else {

                        $data['value'] = 1;
                        $this->db->insert( 'wc_statistics', $data );
                    }

                    $this->db->insert( 'wc_ip_filter', [
                        'section'  => 'country',
                        'ip'       => $ip,
                        'type'     => $this->data['company']->id,
                        'add_date' => time()
                    ] );

                }

                /*new*/
                $this->data['person_type']  = $this->Person_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();

                




                /* * * */

                $this->template->render( 'company/company' );
            } else {
                $this->template->render( 'error/404' );
            }
        }else if($slug=='give_rating'){

            $this->form_validation->set_rules('profile_id', 'Profile ID', 'required|trim|numeric');
            $this->form_validation->set_rules('user_id', 'User ID', 'required|trim|numeric');
            $this->form_validation->set_rules('rate', 'Rate', 'required|trim|numeric');
            $this->form_validation->set_rules('action', 'Action', 'required|trim|numeric');

            if ($this->form_validation->run()){
                $profile_id=$this->input->post('profile_id');
                $user_id=$this->input->post('user_id');
                $rate=$this->input->post('rate');
                $action=$this->input->post('action');

                if ($action==0) {

                    $this->db->where('profile_id', $profile_id);
                    $this->db->where('user_id', $user_id);
                    $this->db->delete('wc_ratings');

                }else{
                    $this->db->select('id');
                    $this->db->where('profile_id', $profile_id);
                    $this->db->where('user_id', $user_id);
                    $query=$this->db->get('wc_ratings');

                    if ($query->num_rows() > 0){

                        $update_data=[
                            'rate' => $rate,
                            'update_at'  => date('Y-m-d H:i:s'),
                        ];

                        $this->db->where('profile_id', $profile_id);
                        $this->db->where('user_id', $user_id);
                        $this->db->update('wc_ratings', $update_data);

                    }else{
                        $insert_data=[
                            'profile_id' => $profile_id,
                            'user_id' => $user_id,
                            'rate' => $rate,
                            'create_at'  => date('Y-m-d H:i:s'),
                        ];

                        $this->db->insert('wc_ratings', $insert_data);


                    }
                }

            }



        }else if($slug=='add_new_person_type'){

            $this->form_validation->set_rules('new_type', 'New Person Type', 'required|trim');

            if ($this->form_validation->run()){
                $new_type=$this->input->post('new_type');


                $this->db->select('person_type_id');
                $this->db->where('name', $new_type);
                $query=$this->db->get('wc_person_type_translation');
                $data=$query->row();

                if ($query->num_rows() > 0){

                    $new_type_id=$data->person_type_id;

                }else{
                    $this->db->select_max('sort');
                    $query=$this->db->get('wc_person_type');
                    $data=$query->row();


                    $insert_data=[
                        'status' => 1,
                        'sort' => $data->sort + 1,
                        'created_at'  => date('Y-m-d H:i:s'),
                    ];

                    $this->db->insert('wc_person_type', $insert_data);

                    $new_type_id=$this->db->insert_id();


                    $insert_data2=[
                        'person_type_id' => $new_type_id,
                        'language_id' => 1,
                        'name'  => $new_type,
                    ];

                    $this->db->insert('wc_person_type_translation', $insert_data2);


                }

                echo json_encode(['id' => $new_type_id]);
            }

        } else {
            $this->template->render( 'error/404' );
        }
    }

    public function product( $slug = null, $page = 1 ) {
        if ( $slug !== null ) {

            $user = $this->data['UserData'];


            $this->data['title']   = translate( 'title' );
            $this->data['company'] = $this->data['UserData'];

            if ( $this->data['company'] ) {
                $this->data['company_images'] = '';
                if ( empty( $this->data['company']->images ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
                } else {
                    if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                        $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                    } else {
                        $this->data['company_images'] = $this->data['company']->images;
                    }
                }
                $this->data['limit']      = [ 'per_page' => 100, 'page' => $page ];
                $this->data['products']   = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();
                $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
                //Pagination
                $config['full_tag_open']      = '<ul class="pagination">';
                $config['full_tag_close']     = '</ul>';
                $config['first_link']         = '&laquo;';
                $config['first_tag_open']     = '<li class="page-item">';
                $config['first_tag_close']    = '</li>';
                $config['last_link']          = '&raquo;';
                $config['last_tag_open']      = '<li class="page-item">';
                $config['last_tag_close']     = '</li>';
                $config['next_link']          = '&rarr;';
                $config['next_tag_open']      = '<li class="page-item">';
                $config['next_tag_close']     = '</li>';
                $config['prev_link']          = '&larr;';
                $config['prev_tag_open']      = '<li class="page-item">';
                $config['prev_tag_close']     = '</li>';
                $config['cur_tag_open']       = '<li class="page-item"><a href="">';
                $config['cur_tag_close']      = '</a></li>';
                $config['num_tag_open']       = '<li class="page-item">';
                $config['num_tag_close']      = '</li>';
                $config['anchor_class']       = 'follow_link';
                $config['reuse_query_string'] = true;
                $config['use_page_numbers']   = true;
                $config['base_url']           = site_url_multi( 'company/product/' . $slug );
                $config['total_rows']         = $this->data['total_rows'];
                $config['per_page']           = $this->data['limit']['per_page'];
                $this->pagination->initialize( $config );
                $this->data['pagination'] = $this->pagination->create_links();
                $this->data['title']      = $this->data['company']->company_name . ' | Makromedicine.com';

               


                $this->template->render( 'company/product' );
            } else {
                $this->template->render( 'error/404' );
            }
        } else {
            $this->template->render( 'error/404' );
        }
    }

    public function getCompanyPages($slug = null) {
        $this->data['new_page'] = 1;
        if($slug && !is_null($slug)) {
            $this->template->render( 'company/company-page' );
        } else {
            $this->template->render( 'company/company-page-list' );
        }
    }

    public function publicUserProfile($slug) {
        $this->data['new_page'] = 1;

        $this->data['complain_reasons']=$this->User_model->getComplainReasons();


        $user=$this->User_model->getUserData(['u.slug_user'=>$slug]);


        if($user) {


            $this->data['publicprofile'] = $user;
            $this->data['title']       = translate( 'title' );
            $this->data['active_menu'] = 2;

            
            



            $this->template->render( 'company/public-user-profile' );
        } else {
            $this->template->render( 'error/404' );
        }
    }

    public function publicCompanyProfile($slug) {

        if ($slug!=NULL && $slug!='give_rating'){

            $this->data['complain_reasons']=$this->User_model->getComplainReasons();


            $this->data['new_page'] = 1;




            $this->data['company'] = $this->data['UserData'];


            $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $this->data['company']->id );

            if (!empty($group)) {
                $group_id                          = $group[0]['group_id'];
                $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

                if(isset($group_name->name)) {
                    $this->data['company']->group_name = $group_name->name;
                }


            }else {
                $this->data['company']->group_name = '';
            }

            if ( $this->data['company'] ) {
                $this->data['company_images'] = '';

                if ( empty( $this->data['company']->images ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
                } else {
                    if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                        $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                    } else {
                        $this->data['company_images'] = $this->data['company']->images;
                    }
                }
                $segment_array            = $this->uri->segment_array();
                $page                     = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
                $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
                $this->data['limit']      = [ 'per_page' => 10, 'page' => $page ];

                if ( $this->data['is_loggedin'] == false ) {
                    $this->data['check_follow'] = 0;
                } else {
                    $this->data['check_follow'] = $this->Follow_model->check_follow( [
                        'follower_id' => $this->data['user']['id'],
                        'followed_company' => $this->data['company']->id
                    ] );
                }

                $this->data['products']       = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();

                //Pagination
                $config['full_tag_open']      = '<ul class="pagination">';
                $config['full_tag_close']     = '</ul>';
                $config['first_link']         = '&laquo;';
                $config['first_tag_open']     = '<li class="page-item">';
                $config['first_tag_close']    = '</li>';
                $config['last_link']          = '&raquo;';
                $config['last_tag_open']      = '<li class="page-item">';
                $config['last_tag_close']     = '</li>';
                $config['next_link']          = '&rarr;';
                $config['next_tag_open']      = '<li class="page-item">';
                $config['next_tag_close']     = '</li>';
                $config['prev_link']          = '&larr;';
                $config['prev_tag_open']      = '<li class="page-item">';
                $config['prev_tag_close']     = '</li>';
                $config['cur_tag_open']       = '<li class="page-item"><a href="">';
                $config['cur_tag_close']      = '</a></li>';
                $config['num_tag_open']       = '<li class="page-item">';
                $config['num_tag_close']      = '</li>';
                $config['anchor_class']       = 'follow_link';
                $config['reuse_query_string'] = true;
                $config['use_page_numbers']   = true;
                $config['base_url']           = site_url_multi( 'company/' . $this->data['company']->slug );
                $config['total_rows']         = $this->data['total_rows'];
                $config['per_page']           = $this->data['limit']['per_page'];
                $this->pagination->initialize( $config );
                $this->data['pagination'] = $this->pagination->create_links();

                $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


                /* INSERT STATISTICS */

                $country_id = $this->data['ip_country']->id;
                $ip         = $_SERVER['REMOTE_ADDR'];

                $query_st = $this->db->get_where( 'wc_ip_filter', [
                    'section' => 'company',
                    'ip'      => $ip,
                    'type'    => $this->data['company']->id
                ] );

                if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                    $data = array(
                        'section' => 'company',
                        'type'    => $this->data['company']->id,
                        'country' => $country_id,
                        'month'   => date( 'm' ),
                        'year'    => date( 'Y' )
                    );

                    $query = $this->db->get_where( 'wc_statistics', $data );

                    if ( $query && $query->num_rows() > 0 ) {
                        $res = $query->result()[0];
                        $this->db->set( 'value', 'value+1', false );
                        $this->db->where( 'id', $res->id );
                        $this->db->update( 'wc_statistics' );
                    } else {
                        $data['value'] = 1;
                        $this->db->insert( 'wc_statistics', $data );
                    }

                    $this->db->insert( 'wc_ip_filter', [
                        'section'  => 'company',
                        'ip'       => $ip,
                        'type'     => $this->data['company']->id,
                        'add_date' => time()
                    ] );

                }


                $query_st = $this->db->get_where( 'wc_ip_filter', [
                    'section' => 'country',
                    'ip'      => $ip,
                    'type'    => $this->data['company']->id
                ] );

                if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                    $data = array(
                        'section' => 'country',
                        'type'    => $this->data['company']->country_id,
                        'country' => $country_id,
                        'month'   => date( 'm' ),
                        'year'    => date( 'Y' )
                    );

                    $query = $this->db->get_where( 'wc_statistics', $data );

                    if ( $query && $query->num_rows() > 0 ) {

                        $res = $query->result()[0];
                        $this->db->set( 'value', 'value+1', false );
                        $this->db->where( 'id', $res->id );
                        $this->db->update( 'wc_statistics' );
                    } else {

                        $data['value'] = 1;
                        $this->db->insert( 'wc_statistics', $data );
                    }

                    $this->db->insert( 'wc_ip_filter', [
                        'section'  => 'country',
                        'ip'       => $ip,
                        'type'     => $this->data['company']->id,
                        'add_date' => time()
                    ] );

                }
            }



            $user = $this->data['UserData'];


            if($user) {
                if(empty($user->company_logo))
                {
                    $this->data['company_logo'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
                }
                else
                {
                    if(!filter_var($user->company_logo, FILTER_VALIDATE_URL))
                    {
                        $this->data['company_logo'] = base_url('uploads/catalog/users/').$user->company_logo;
                    }
                    else
                    {
                        $this->data['company_logo'] = $user->company_logo;
                    }
                }

                if(empty($user->company_banner))
                {
                    $this->data['company_banner'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
                }
                else
                {
                    if(!filter_var($user->company_banner, FILTER_VALIDATE_URL))
                    {
                        $this->data['company_banner'] = base_url('uploads/catalog/users/').$user->company_banner;
                    }
                    else
                    {
                        $this->data['company_banner'] = $user->company_banner;
                    }
                }


                $this->data['company_info']   = $this->User_model->getCompanyPeople($user->company_id);
                $this->data['get_product_status'] =  $this->User_model->getProductStatus($user->company_id);
                




                if ( isset( $user->tags ) && ! empty( $user->tags ) ) {
                    $this->data['tags'] = $user->tags;
                } else {
                    $this->data['tags'] = '';
                }
                $this->data['get_standart'] = $this->User_model->get_standart( 'wc_standart_translation.name st_name ,wc_user_standart_image.*', [ 'user_id' => $user->id ] );
                if ( isset( $user->product_type ) && ! empty( $user->product_type ) && $user->product_type != null ) {
                    $this->data['selected_product_type']       = json_decode( $user->product_type );

                    $this->data['selected_product_type_names'] = array();
                    if ( ! empty( $this->data['selected_product_type'] ) && is_array( $this->data['selected_product_type'] ) ) {
                        foreach ( $this->data['selected_product_type'] as $key => $value ) {
                            $name = $this->Product_type_model->fields( [ 'name' ] )->filter( [ 'id' => $value ] )->with_translation()->one();
                            if ( $name && $name->name != '' ) {
                                $this->data['selected_product_type_names'][] = $name->name;
                            }
                        }
                    }
                    $this->data['selected_product_type_names'] = implode( ', ', $this->data['selected_product_type_names'] );
                } else {
                    $this->data['selected_product_type'][0]    = '';
                    $this->data['selected_product_type_names'] = '';
                }

                $user=$this->data['UserData'];
                $user_id=$user->id;
                $company_id=$user->company_id;

                $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();

                $this->data['user'] = $user;
                $this->data['title']       = translate( 'title' );
                $this->data['active_menu'] = 1;
                $this->data['phone_type']   = $this->Phone_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();
                $this->data['person_type']  = $this->Person_type_model->fields( [ 'id', 'name' ] )->with_translation()->all();





                $this->template->render( 'company/public-company-profile' );
            } else {
                $this->template->render( 'error/404' );
            }

        } else {
            $this->template->render( 'error/404' );
        }


    }

    public function publicAllUserProfile() {

        $this->data['new_page'] = 1;
        $users = $this->User_model->getUserData( [ 'u.slug_user !=' => 0], true ); //$position = $this->User_model->filter(['slug_user != "0"' => NULL])->all();
        $this->data['users'] = $users;
        $this->template->render( 'company/public-users' );
    }

    public function publicAllCompanyProfile() {
        $this->data['new_page'] = 1;
        $companies = $position = $this->User_model->filter(['page_created ' => 1])->all();
        $this->data['companies'] = $companies;
        $this->template->render( 'company/public-companies' );
    }

    public function publicNews( $slug ) {

        $this->data['new_page'] = 1;




        $this->data['company'] = $this->data['UserData'];;

        $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $this->data['company']->id );

        if (!empty($group)) {
            $group_id                          = $group[0]['group_id'];
            $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

            if(isset($group_name->name)) {
                $this->data['company']->group_name = $group_name->name;
            }


        }else {
            $this->data['company']->group_name = '';
        }

        if ( $this->data['company'] ) {
            $this->data['company_images'] = '';

            if ( empty( $this->data['company']->images ) ) {
                $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                } else {
                    $this->data['company_images'] = $this->data['company']->images;
                }
            }
            $segment_array            = $this->uri->segment_array();
            $page                     = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
            $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
            $this->data['limit']      = [ 'per_page' => 10, 'page' => $page ];

            if ( $this->data['is_loggedin'] == false ) {
                $this->data['check_follow'] = 0;
            } else {
                $this->data['check_follow'] = $this->Follow_model->check_follow( [
                    'follower_id' => $this->data['user']['id'],
                    'followed_company' => $this->data['company']->id
                ] );
            }

            $this->data['products']       = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();

            //Pagination
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            $config['first_link']         = '&laquo;';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = '&raquo;';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = '&rarr;';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = '&larr;';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a href="">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['anchor_class']       = 'follow_link';
            $config['reuse_query_string'] = true;
            $config['use_page_numbers']   = true;

            $config['base_url']           = site_url_multi( 'company/' . $this->data['company']->slug );
            $config['total_rows']         = $this->data['total_rows'];
            $config['per_page']           = $this->data['limit']['per_page'];
            $this->pagination->initialize( $config );
            $this->data['pagination'] = $this->pagination->create_links();

            $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


            /* INSERT STATISTICS */

            $country_id = $this->data['ip_country']->id;
            $ip         = $_SERVER['REMOTE_ADDR'];

            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'company',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                $data = array(
                    'section' => 'company',
                    'type'    => $this->data['company']->id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {
                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {
                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'company',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }


            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'country',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                $data = array(
                    'section' => 'country',
                    'type'    => $this->data['company']->country_id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {

                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {

                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'country',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }
        }


        $user = $this->data['UserData'];
        if ( $user ) {
            if(empty($user->company_logo))
            {
                $this->data['company_logo'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_logo, FILTER_VALIDATE_URL))
                {
                    $this->data['company_logo'] = base_url('uploads/catalog/users/').$user->company_logo;
                }
                else
                {
                    $this->data['company_logo'] = $user->company_logo;
                }
            }

            if(empty($user->company_banner))
            {
                $this->data['company_banner'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_banner, FILTER_VALIDATE_URL))
                {
                    $this->data['company_banner'] = base_url('uploads/catalog/users/').$user->company_banner;
                }
                else
                {
                    $this->data['company_banner'] = $user->company_banner;
                }
            }


            $this->data['title']       = translate( 'title' );
            $this->data['active_menu'] = 2;

            $page =  $this->input->get('page');
            if(!isset($page)) {
                $page = 1;
            }

            $limit = 4;
            $offset = ($page - 1)*$limit;

            $this->data['total_news'] = $this->db->select( '*' )->from( 'wc_company_news' )->where( [ 'user_id' => $user->id, 'company_id' => $user->company_id] )->count_all_results();
            $this->data['num_pages'] = ceil($this->data['total_news']/$limit);
            $this->data['curr_page'] = $page;
            $this->data['prev_page'] = $page-1;
            $this->data['next_page'] = $page+1;

            $this->db->select( '*' );
            $this->db->from( 'wc_company_news' )->where( [ 'user_id' => $user->id, 'company_id' => $user->company_id ] )->limit($limit, $offset)->order_by('id', 'DESC');
            $query = $this->db->get();

            $user=$this->data['UserData'];
            $user_id=$user->id;
            $company_id=$user->company_id;

            $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();

            $this->data['user'] = $user;
            $this->data['slug'] = $slug;
            $this->data['news'] = $query->result_array();


            

            $this->template->render( 'company/public-company-news' );
        }
    }

    public function publicViewNews($slug, $news_id) {
        $this->data['new_page'] = 1;


        $this->data['company'] = $this->data['UserData'];

        $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $this->data['company']->id );

        if (!empty($group)) {
            $group_id                          = $group[0]['group_id'];
            $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

            if(isset($group_name->name)) {
                $this->data['company']->group_name = $group_name->name;
            }


        }else {
            $this->data['company']->group_name = '';
        }




        if ( $this->data['company'] ) {
            $this->data['company_images'] = '';

            if ( empty( $this->data['company']->images ) ) {
                $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                } else {
                    $this->data['company_images'] = $this->data['company']->images;
                }
            }
            $segment_array            = $this->uri->segment_array();
            $page                     = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
            $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
            $this->data['limit']      = [ 'per_page' => 10, 'page' => $page ];

            if ( $this->data['is_loggedin'] == false ) {
                $this->data['check_follow'] = 0;
            } else {
                $this->data['check_follow'] = $this->Follow_model->check_follow( [
                    'follower_id' => $this->data['user']['id'],
                    'followed_company' => $this->data['company']->id
                ] );
            }

            $this->data['products']       = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();

            //Pagination
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            $config['first_link']         = '&laquo;';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = '&raquo;';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = '&rarr;';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = '&larr;';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a href="">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['anchor_class']       = 'follow_link';
            $config['reuse_query_string'] = true;
            $config['use_page_numbers']   = true;
            $config['base_url']           = site_url_multi( 'company/' . $this->data['company']->slug );
            $config['total_rows']         = $this->data['total_rows'];
            $config['per_page']           = $this->data['limit']['per_page'];
            $this->pagination->initialize( $config );
            $this->data['pagination'] = $this->pagination->create_links();

            $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


            /* INSERT STATISTICS */

            $country_id = $this->data['ip_country']->id;
            $ip         = $_SERVER['REMOTE_ADDR'];

            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'company',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                $data = array(
                    'section' => 'company',
                    'type'    => $this->data['company']->id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {
                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {
                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'company',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }


            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'country',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                $data = array(
                    'section' => 'country',
                    'type'    => $this->data['company']->country_id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {

                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {

                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'country',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }
        }


        $user = $this->data['UserData'];
        if ( $user ) {
            if(empty($user->company_logo))
            {
                $this->data['company_logo'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_logo, FILTER_VALIDATE_URL))
                {
                    $this->data['company_logo'] = base_url('uploads/catalog/users/').$user->company_logo;
                }
                else
                {
                    $this->data['company_logo'] = $user->company_logo;
                }
            }

            if(empty($user->company_banner))
            {
                $this->data['company_banner'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_banner, FILTER_VALIDATE_URL))
                {
                    $this->data['company_banner'] = base_url('uploads/catalog/users/').$user->company_banner;
                }
                else
                {
                    $this->data['company_banner'] = $user->company_banner;
                }
            }



            $this->db->select( '*' );
            $this->db->from( 'wc_company_news' )->where( [ 'user_id' => $user->id, 'id' => $news_id ] );
            $query = $this->db->get();
            $news = $query->result_array();

            $user=$this->data['UserData'];
            $user_id=$user->id;
            $company_id=$user->company_id;

            $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();

            if(count($news) > 0) {

                if (isset($_SESSION['id']) && $_SESSION['id']!=$user->id){
                    $this->db->set('view', 'view+1', FALSE);
                    $this->db->where('id', $news_id);
                    $this->db->update('wc_company_news');
                }

                $this->data['news'] = $news[0];
                $this->data['user'] = $user;
                $this->data['title']       = translate( 'title' );
                $this->data['active_menu'] = 2;


                $this->db->select( '*' );
                $this->db->from( 'wc_company_news' )->where( [ 'user_id' => $user->id, 'id!=' => $news_id ] )->order_by('id', 'DESC');
                $query = $this->db->get();

                $this->data['slug'] = $slug;
                $this->data['other_news']=$query->result_array();

                

                $this->template->render( 'company/public-company-view-news' );




            } else {
                echo "Oops ! Wrong news.";
            }

        } else {
            echo "Oops ! Wrong news.";
        }
    }

    public function publicInterests($slug) {
        $this->data['new_page'] = 1;


        $this->data['company'] = $this->data['UserData'];

        $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $this->data['company']->id );

        if (!empty($group)) {
            $group_id                          = $group[0]['group_id'];
            $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

            if(isset($group_name->name)) {
                $this->data['company']->group_name = $group_name->name;
            }


        }else {
            $this->data['company']->group_name = '';
        }

        if ( $this->data['company'] ) {
            $this->data['company_images'] = '';

            if ( empty( $this->data['company']->images ) ) {
                $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                } else {
                    $this->data['company_images'] = $this->data['company']->images;
                }
            }
            $segment_array            = $this->uri->segment_array();
            $page                     = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
            $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
            $this->data['limit']      = [ 'per_page' => 10, 'page' => $page ];

            if ( $this->data['is_loggedin'] == false ) {
                $this->data['check_follow'] = 0;
            } else {
                $this->data['check_follow'] = $this->Follow_model->check_follow( [
                    'follower_id' => $this->data['user']['id'],
                    'followed_company' => $this->data['company']->id
                ] );
            }

            $this->data['products']       = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();

            //Pagination
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            $config['first_link']         = '&laquo;';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = '&raquo;';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = '&rarr;';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = '&larr;';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a href="">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['anchor_class']       = 'follow_link';
            $config['reuse_query_string'] = true;
            $config['use_page_numbers']   = true;
            $config['base_url']           = site_url_multi( 'company/' . $this->data['company']->slug );
            $config['total_rows']         = $this->data['total_rows'];
            $config['per_page']           = $this->data['limit']['per_page'];
            $this->pagination->initialize( $config );
            $this->data['pagination'] = $this->pagination->create_links();

            $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


            /* INSERT STATISTICS */

            $country_id = $this->data['ip_country']->id;
            $ip         = $_SERVER['REMOTE_ADDR'];

            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'company',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                $data = array(
                    'section' => 'company',
                    'type'    => $this->data['company']->id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {
                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {
                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'company',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }


            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'country',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                $data = array(
                    'section' => 'country',
                    'type'    => $this->data['company']->country_id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {

                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {

                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'country',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }
        }



        $user = $this->data['UserData'];
        if ( $user ) {
            if ( empty( $user->company_logo ) ) {
                $this->data['company_logo'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $user->company_logo, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_logo'] = base_url( 'uploads/catalog/users/' ) . $user->company_logo;
                } else {
                    $this->data['company_logo'] = $user->company_logo;
                }
            }

            if ( empty( $user->company_banner ) ) {
                $this->data['company_banner'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $user->company_banner, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_banner'] = base_url( 'uploads/catalog/users/' ) . $user->company_banner;
                } else {
                    $this->data['company_banner'] = $user->company_banner;
                }
            }


            $this->data['title']       = translate( 'title' );
            $this->data['active_menu'] = 3;
            $this->data['interests'] = $this->User_model->get_your_interests( [ '*' ], [ 'user_id' => $user->id, 'company_id' => $user->company_id ] );

            $user=$this->data['UserData'];
            $user_id=$user->id;
            $company_id=$user->company_id;

            $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();
            $this->data['user'] = $user;
            $this->data['slug'] = $slug;

            

            $this->template->render( 'company/public-company-interests' );
        }
    }


    public function publicPeople($slug) {
        $this->data['new_page'] = 1;


        $this->data['company'] =$this->data['UserData'];



        $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $this->data['company']->id );

        if (!empty($group)) {
            $group_id                          = $group[0]['group_id'];
            $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

            if(isset($group_name->name)) {
                $this->data['company']->group_name = $group_name->name;
            }


        }else {
            $this->data['company']->group_name = '';
        }




        if ( $this->data['company'] ) {
            $this->data['company_images'] = '';

            if ( empty( $this->data['company']->images ) ) {
                $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                } else {
                    $this->data['company_images'] = $this->data['company']->images;
                }
            }
            $segment_array            = $this->uri->segment_array();
            $page                     = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
            $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
            $this->data['limit']      = [ 'per_page' => 10, 'page' => $page ];

            if ( $this->data['is_loggedin'] == false ) {
                $this->data['check_follow'] = 0;
            } else {
                $this->data['check_follow'] = $this->Follow_model->check_follow( [
                    'follower_id' => $this->data['user']['id'],
                    'followed_company' => $this->data['company']->id
                ] );
            }

            $this->data['products']       = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();

            //Pagination
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            $config['first_link']         = '&laquo;';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = '&raquo;';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = '&rarr;';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = '&larr;';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a href="">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['anchor_class']       = 'follow_link';
            $config['reuse_query_string'] = true;
            $config['use_page_numbers']   = true;
            $config['base_url']           = site_url_multi( 'company/' . $this->data['company']->slug );
            $config['total_rows']         = $this->data['total_rows'];
            $config['per_page']           = $this->data['limit']['per_page'];
            $this->pagination->initialize( $config );
            $this->data['pagination'] = $this->pagination->create_links();

            $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


            /* INSERT STATISTICS */

            $country_id = $this->data['ip_country']->id;
            $ip         = $_SERVER['REMOTE_ADDR'];

            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'company',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                $data = array(
                    'section' => 'company',
                    'type'    => $this->data['company']->id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {
                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {
                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'company',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }


            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'country',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                $data = array(
                    'section' => 'country',
                    'type'    => $this->data['company']->country_id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {

                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {

                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'country',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }
        }

        $user = $this->data['UserData'];
        if ( $user ) {
            $user_id=$user->id;
            $company_id=$user->company_id;

            $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();
            $user_full = $user;
            if ( empty( $user->company_logo ) ) {
                $this->data['company_logo'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $user->company_logo, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_logo'] = base_url( 'uploads/catalog/users/' ) . $user->company_logo;
                } else {
                    $this->data['company_logo'] = $user->company_logo;
                }
            }

            if ( empty( $user->company_banner ) ) {
                $this->data['company_banner'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $user->company_banner, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_banner'] = base_url( 'uploads/catalog/users/' ) . $user->company_banner;
                } else {
                    $this->data['company_banner'] = $user->company_banner;
                }
            }


            $this->data['title']       = translate( 'title' );
            $this->data['active_menu'] = 7;

            /**/
            $current_user = $this->session->userdata['id'];
            $user = $this->data['UserData'];
            $page_user_id = $user->id;

            $company_id=$user->company_id;
            $admin_data=$this->User_model->getUserData( [ 'c.id' => $company_id] );



            $image = '';
            if ( empty( $admin_data->images ) ) {
                $image = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $admin_data->images, FILTER_VALIDATE_URL ) ) {
                    $image = base_url( 'uploads/catalog/users/' ) . $user->images;
                } else {
                    $image = $admin_data->images;
                }
            }

            $this->data['owner'] = array(
                'id'       => $admin_data->id,
                'name'     => $admin_data->fullname,
                'position' => "Admin",
                'photo'    => $image
            );



            /**/
            $approved=$this->User_model->getApliedUsers($company_id, $page_user_id, 1);

            $approved_users = [];
            if ( !empty($approved) ) {
                foreach ( $approved as $approved_user ) {



                    $image = '';
                    if ( empty( $approved_user['images'] ) ) {
                        $image = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
                    } else {
                        if ( ! filter_var( $approved_user['images'], FILTER_VALIDATE_URL ) ) {
                            $image = base_url( 'uploads/catalog/users/' ) . $approved_user['images'];
                        } else {
                            $image = $approved_user['images'];
                        }
                    }

                    $user = [
                        'id'       => $approved_user['id'],
                        'rel_main_id'       => $approved_user['rel_main_id'],
                        'name'     => $approved_user['fullname'],
                        'position' => $approved_user['position_name'],
                        'photo'    => $image,
                        'user_page_role_id'    => $approved_user['position'],
                    ];
                    array_push( $approved_users, $user );
                }
            }
            $this->data['approved_users'] = $approved_users;


            $approval_waiting= $this->User_model->getApliedUsers($company_id, $page_user_id, 0);

            $approval_waiting_users = [];
            if ( !empty($approval_waiting)) {
                foreach ( $approval_waiting as $waiting_user ) {



                    $image = '';
                    if ( empty( $waiting_user['images'] ) ) {
                        $image = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
                    } else {
                        if ( ! filter_var( $waiting_user['images'], FILTER_VALIDATE_URL ) ) {
                            $image = base_url( 'uploads/catalog/users/' ) . $waiting_user['images'];
                        } else {
                            $image = $waiting_user['images'];
                        }
                    }

                    $user = [
                        'id'       => $waiting_user['id'],
                        'rel_main_id'       => $waiting_user['rel_main_id'],
                        'name'     => $waiting_user['fullname'],
                        'position' => $waiting_user['position_name'],
                        'photo'    => $image,
                        'user_page_role_id'    => $waiting_user['position'],
                    ];
                    array_push( $approval_waiting_users, $user );
                }
            }

            if ( $page_user_id == $current_user ) {
                $this->data['approval_waiting_users'] = $approval_waiting_users;
            } else {
                $this->data['approval_waiting_users'] = [];
            }

            $this->data['user'] = $user_full;
            $this->data['slug'] = $slug;

            

            $this->template->render( 'company/public-company-people' );
        }

    }

    public function publicProduct($slug, $page = 1) {

        $user = $this->data['UserData'];


        $this->data['company'] = $user ;

        $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $user->id );

        if (!empty($group)) {
            $group_id                          = $group[0]['group_id'];
            $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

            if(isset($group_name->name)) {
                $this->data['company']->group_name = $group_name->name;
            }


        }else {
            $this->data['company']->group_name = '';
        }

        if ( $this->data['company'] ) {
            $this->data['company_images'] = '';

            if ( empty( $this->data['company']->images ) ) {
                $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                } else {
                    $this->data['company_images'] = $this->data['company']->images;
                }
            }

            $this->data['limit'] = ['per_page' => 10, 'page' => $page];

            $limit = $this->data['limit']['per_page'];
            $offset = $this->data['limit']['per_page'] * ($this->data['limit']['page'] - 1);

            $query=(isset($_GET['query']) && !empty($_GET['query'])) ? trim($_GET['query']) : '';
            $filter_array= ['user_id' => $user->id, 'company_id' => $user->company_id, 'checked' => 1];

            if (!empty($query)) {
                $filter_array['title'] = $query;
            }
            
            
            $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter($filter_array)->with_translation()->one()->count;
            

            if ( $this->data['is_loggedin'] == false ) {
                $this->data['check_follow'] = 0;
            } else {
                $this->data['check_follow'] = $this->Follow_model->check_follow( [
                    'follower_id' => $user->id,
                    'followed_company' => $user->id,
                ] );
            }

            $this->data['products']       = $this->Product_model->filter($filter_array)->limit($limit, $offset)->order_by('id', 'DESC')->with_translation()->all();

            

            //Pagination
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            $config['first_link']         = '&laquo;';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = '&raquo;';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = '&rarr;';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = '&larr;';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a href="">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['anchor_class']       = 'follow_link';
            $config['reuse_query_string'] = true;
            $config['use_page_numbers']   = true;
            $config['base_url']           = site_url_multi('companies/'. $this->data['company']->slug.'/products');
            $config['total_rows']         = $this->data['total_rows'];
            $config['per_page']           = $this->data['limit']['per_page'];
            $this->pagination->initialize( $config );
            $this->data['pagination'] = $this->pagination->create_links();

            $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


            /* INSERT STATISTICS */

            $country_id = $this->data['ip_country']->id;
            $ip         = $_SERVER['REMOTE_ADDR'];

            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'company',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                $data = array(
                    'section' => 'company',
                    'type'    => $this->data['company']->id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {
                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {
                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'company',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }


            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'country',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                $data = array(
                    'section' => 'country',
                    'type'    => $this->data['company']->country_id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {

                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {

                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'country',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }
        }



        if($user) {
            if(empty($user->company_logo))
            {
                $this->data['company_logo'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_logo, FILTER_VALIDATE_URL))
                {
                    $this->data['company_logo'] = base_url('uploads/catalog/users/').$user->company_logo;
                }
                else
                {
                    $this->data['company_logo'] = $user->company_logo;
                }
            }

            if(empty($user->company_banner))
            {
                $this->data['company_banner'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_banner, FILTER_VALIDATE_URL))
                {
                    $this->data['company_banner'] = base_url('uploads/catalog/users/').$user->company_banner;
                }
                else
                {
                    $this->data['company_banner'] = $user->company_banner;
                }
            }
            $this->data['user']     = $user;
            $this->data['new_page'] = 1;



            if ( $slug !== null ) {
                $this->data['title']       = translate( 'title' );
                $this->data['active_menu'] = 4;
                $this->data['company']     = $user;
                $user=$this->data['UserData'];
                $user_id=$user->id;
                $company_id=$user->company_id;

                $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();

                if ( $this->data['company'] ) {
                    $this->load->model( 'Product_model' );
                    $this->data['company_images'] = '';
                    if ( empty( $this->data['company']->images ) ) {
                        $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
                    } else {
                        if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                            $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                        } else {
                            $this->data['company_images'] = $this->data['company']->images;
                        }
                    }

                   
                    $this->data['title']      = $this->data['company']->company_name . ' | Makromedicine.com';


                    $this->template->render( 'company/public-company-products' );
                } else {
                    $this->template->render( 'error/404' );
                }
            } else {
                $this->template->render( 'error/404' );
            }
        }
    }

    public function publicViewProduct($slug, $news_id) {
        $this->data['active_menu'] = 4;

        $this->data['company'] = $this->data['UserData'];

        $user = $this->data['UserData'];


        $this->data['user'] = [
            'id'            => $user->id,
            'status'        => $user->status,
            'email'         => $user->email,
            'phone'         => $user->phone,
            'fullname'      => $user->fullname,
            'images'        => $user->images,
            'group_id'  =>  $user->user_groups_id,
        ];

        $this->data['product_id'] = $news_id;
        $this->data['product']    = $this->Product_model->fields( '*' )->filter( [ 'id' => $this->data['product_id'] ] )->with_translation( $this->data['current_lang_id'] )->one();
        $this->data['title']      = ( $this->data['product'] && ! is_null( $this->data['product']->title ) && $this->data['product']->title != '' ) ? $this->data['product']->title . ' | Makromedicine.com' : translate( 'title_view' );
        if ( $this->data['product'] ) {
            $this->db->where('product_id', $this->data['product']->id);
            $product_query = $this->db->get('product_images');
            $this->data['product_images'] = [];
            if ($product_query->num_rows()) {
                $resultsx = $product_query->result();
                foreach ($resultsx as $resultx) {
                    $this->data['product_images'][] = [
                        'image_id' => $resultx->image_id,
                        'image' => $resultx->images
                    ];
                }
            }
            $this->data['company'] = $user;
            $this->data['company_images'] = '';
            if (empty($this->data['company']->images)) {
                $this->data['company_images'] = base_url('uploads/catalog/users/') . "avatar-placeholder.png";
            } else {
                if (!filter_var($this->data['company']->images, FILTER_VALIDATE_URL)) {
                    $this->data['company_images'] = base_url('uploads/catalog/users/') . $this->data['company']->images;
                } else {
                    $this->data['company_images'] = $this->data['company']->images;
                }
            }
            /* INSERT STATISTICS */
            $country_id = $this->data['ip_country']->id;
            $ip = $_SERVER['REMOTE_ADDR'];

            $atc_codes_str = '';
            $atc_code_pr = json_decode($this->data['product']->atc_code);
            if (count($atc_code_pr) > 0) {
                foreach ($atc_code_pr as $k => $val) {
                    $atc_codes_str .= get_atc_code_name($val->id) . ',';
                }
            }
            $atc_codes_str = rtrim($atc_codes_str, ',');
            if ($atc_codes_str != '') {
                $query_st = $this->db->get_where('wc_ip_filter', [
                    'section' => 'atc',
                    'ip' => $ip,
                    'type' => $atc_codes_str
                ]);
                if (!$query_st || $query_st->num_rows() == 0) {


                    $data = array(
                        'section' => 'atc',
                        'type' => $atc_codes_str,
                        'country' => $country_id,
                        'month' => date('m'),
                        'year' => date('Y')
                    );
                    $query = $this->db->get_where('wc_statistics', $data);
                    if ($query && $query->num_rows() > 0) {
                        if (isset($_GET['test11'])) {
                            echo 'increase';
                        }
                        $res = $query->result()[0];
                        $this->db->set('value', 'value+1', false);
                        $this->db->where('id', $res->id);
                        $this->db->update('wc_statistics');
                    } else {
                        if (isset($_GET['test11'])) {
                            echo 'insert';
                        }
                        $data['value'] = 1;
                        $this->db->insert('wc_statistics', $data);
                    }
                    $this->db->insert('wc_ip_filter', [
                        'section' => 'atc',
                        'ip' => $ip,
                        'type' => $this->data['product_id'],
                        'add_date' => time()
                    ]);

                }
            }
            $query_st = $this->db->get_where('wc_ip_filter', [
                'section' => 'product',
                'ip' => $ip,
                'type' => $this->data['product_id']
            ]);

            if (!$query_st || $query_st->num_rows() == 0) {
                $data = array(
                    'section' => 'product',
                    'type' => $this->data['product_id'],
                    'country' => $country_id,
                    'month' => date('m'),
                    'year' => date('Y')
                );
                $query = $this->db->get_where('wc_statistics', $data);
                if ($query && $query->num_rows() > 0) {
                    $res = $query->result()[0];
                    $this->db->set('value', 'value+1', false);
                    $this->db->where('id', $res->id);
                    $this->db->update('wc_statistics');
                } else {
                    $data['value'] = 1;
                    $this->db->insert('wc_statistics', $data);
                }
                $this->db->insert('wc_ip_filter', [
                    'section' => 'product',
                    'ip' => $ip,
                    'type' => $this->data['product_id'],
                    'add_date' => time()
                ]);
            }

            $query_st = $this->db->get_where('wc_ip_filter', [
                'section' => 'country',
                'ip' => $ip,
                'type' => $this->data['product']->country
            ]);
            if (!$query_st || $query_st->num_rows() == 0) {
                $data = array(
                    'section' => 'country',
                    'type' => $this->data['product']->country,
                    'country' => $country_id,
                    'month' => date('m'),
                    'year' => date('Y')
                );
                $query = $this->db->get_where('wc_statistics', $data);
                if ($query && $query->num_rows() > 0) {
                    if (isset($_GET['test11'])) {
                        echo 'increase country';
                    }
                    $res = $query->result()[0];
                    $this->db->set('value', 'value+1', false);
                    $this->db->where('id', $res->id);
                    $this->db->update('wc_statistics');
                } else {
                    if (isset($_GET['test11'])) {
                        echo 'insert country';
                    }
                    $data['value'] = 1;
                    $this->db->insert('wc_statistics', $data);
                }
                $this->db->insert('wc_ip_filter', [
                    'section' => 'country',
                    'ip' => $ip,
                    'type' => $this->data['product_id'],
                    'add_date' => time()
                ]);
            }
            $atc_codes_str = '';
            $atc_code_pr = json_decode($this->data['product']->cas);
            if (count($atc_code_pr) > 0) {
                foreach ($atc_code_pr as $k => $val) {
                    $atc_codes_str .= $val->id . ',';
                }
            }
            $atc_codes_str = rtrim($atc_codes_str, ',');
            if ($atc_codes_str != '') {

                $query_st = $this->db->get_where('wc_ip_filter', [
                    'section' => 'cas',
                    'ip' => $ip,
                    'type' => $atc_codes_str
                ]);
                if (!$query_st || $query_st->num_rows() == 0) {

                    $data = array(
                        'section' => 'cas',
                        'type' => $atc_codes_str,
                        'country' => $country_id,
                        'month' => date('m'),
                        'year' => date('Y')
                    );
                    $query = $this->db->get_where('wc_statistics', $data);
                    if ($query && $query->num_rows() > 0) {
                        if (isset($_GET['test11'])) {
                            echo 'increase country';
                        }
                        $res = $query->result()[0];
                        $this->db->set('value', 'value+1', false);
                        $this->db->where('id', $res->id);
                        $this->db->update('wc_statistics');
                    } else {
                        if (isset($_GET['test11'])) {
                            echo 'insert country';
                        }
                        $data['value'] = 1;
                        $this->db->insert('wc_statistics', $data);
                    }

                    $this->db->insert('wc_ip_filter', [
                        'section' => 'cas',
                        'ip' => $ip,
                        'type' => $this->data['product_id'],
                        'add_date' => time()
                    ]);
                }
            }
            $atc_codes_str = '';
            $atc_code_pr = json_decode($this->data['product']->herbal);
            if (count($atc_code_pr) > 0) {
                foreach ($atc_code_pr as $k => $val) {
                    $atc_codes_str .= $val->id . ',';
                }
            }
            $atc_codes_str = rtrim($atc_codes_str, ',');
            if ($atc_codes_str != '') {
                $query_st = $this->db->get_where('wc_ip_filter', [
                    'section' => 'herbal',
                    'ip' => $ip,
                    'type' => $atc_codes_str
                ]);
                if (!$query_st || $query_st->num_rows() == 0) {

                    $data = array(
                        'section' => 'herbal',
                        'type' => $atc_codes_str,
                        'country' => $country_id,
                        'month' => date('m'),
                        'year' => date('Y')
                    );
                    $query = $this->db->get_where('wc_statistics', $data);
                    if ($query && $query->num_rows() > 0) {
                        if (isset($_GET['test12'])) {
                            echo 'inc';
                        }
                        $res = $query->result()[0];
                        $this->db->set('value', 'value+1', false);
                        $this->db->where('id', $res->id);
                        $this->db->update('wc_statistics');
                    } else {
                        if (isset($_GET['test12'])) {
                            echo 'insert';
                        }
                        $data['value'] = 1;
                        $this->db->insert('wc_statistics', $data);
                    }

                    $this->db->insert('wc_ip_filter', [
                        'section' => 'herbal',
                        'ip' => $ip,
                        'type' => $this->data['product_id'],
                        'add_date' => time()
                    ]);
                }
            }
            $atc_codes_str = '';
            $atc_code_pr = json_decode($this->data['product']->animal);
            if (count($atc_code_pr) > 0) {
                foreach ($atc_code_pr as $k => $val) {
                    $atc_codes_str .= $val->id . ',';
                }
            }
            $atc_codes_str = rtrim($atc_codes_str, ',');
            if ($atc_codes_str != '') {
                $query_st = $this->db->get_where('wc_ip_filter', [
                    'section' => 'animal',
                    'ip' => $ip,
                    'type' => $atc_codes_str
                ]);
                if (!$query_st || $query_st->num_rows() == 0) {

                    $data = array(
                        'section' => 'animal',
                        'type' => $atc_codes_str,
                        'country' => $country_id,
                        'month' => date('m'),
                        'year' => date('Y')
                    );
                    $query = $this->db->get_where('wc_statistics', $data);
                    if ($query && $query->num_rows() > 0) {

                        $res = $query->result()[0];
                        $this->db->set('value', 'value+1', false);
                        $this->db->where('id', $res->id);
                        $this->db->update('wc_statistics');
                    } else {

                        $data['value'] = 1;
                        $this->db->insert('wc_statistics', $data);
                    }
                    $this->db->insert('wc_ip_filter', [
                        'section' => 'animal',
                        'ip' => $ip,
                        'type' => $this->data['product_id'],
                        'add_date' => time()
                    ]);
                }
            }


            $this->data['user_following'] = $this->Follow_model->fields(['count(*) as count'])->filter(['follower_id' => $this->data['product']->user_id])->one()->count;
            $this->data['user_followers'] = $this->Follow_model->fields(['count(*) as count'])->filter(['followed_user' => $this->data['product']->user_id])->one()->count;
            $this->data['active_menu'] = 4;
            if ($this->data['is_loggedin'] == false) {
                $this->data['check_follow'] = 0;
            } else {
                $this->data['check_follow'] = $this->Follow_model->check_follow([
                    'follower_id' => $this->data['product']->user_id,
                    'followed_user' => $this->data['product']->user_id
                ]);
            }


            $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id' => $user->id, 'company_id' => $user->company_id])->one();


            $this->data['selected_product_type'] = json_decode($user->product_type);


            $this->data['selected_product_type_names'] = array();
            if (!empty($this->data['selected_product_type']) && is_array($this->data['selected_product_type'])) {
                foreach ($this->data['selected_product_type'] as $key => $value) {
                    $name = $this->Product_type_model->fields(['name'])->filter(['id' => $value])->with_translation()->one();


                    if ($name && $name->name != '') {
                        $this->data['selected_product_type_names'][] = $name->name;
                    }
                }
            }
            $this->data['selected_product_type_names'] = implode(', ', $this->data['selected_product_type_names']);

            $this->data['get_standart'] = $this->User_model->get_standart('wc_standart_translation.name st_name ,wc_user_standart_image.*', ['user_id' => $user->id]);

            $this->data['unit'] = $this->Unit_model->fields([
                'id',
                'name',
                'short_name'
            ])->with_translation()->all();

            $this->data['puritys'] = $this->Purity_unit_model->fields([
                'id',
                'name',
                'code'
            ])->with_translation()->all();

            $this->template->render( 'company/public-company-view-product' );

        }else{
            echo "Oops ! Wrong product.";
        }


    }

    public function publicTenders( $slug ) {
        $this->data['new_page'] = 1;


        $this->data['company'] = $this->data['UserData'];

        $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $this->data['company']->id );

        if (!empty($group)) {
            $group_id                          = $group[0]['group_id'];
            $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

            if(isset($group_name->name)) {
                $this->data['company']->group_name = $group_name->name;
            }


        }else {
            $this->data['company']->group_name = '';
        }

        if ( $this->data['company'] ) {
            $this->data['company_images'] = '';

            if ( empty( $this->data['company']->images ) ) {
                $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                } else {
                    $this->data['company_images'] = $this->data['company']->images;
                }
            }
            $segment_array            = $this->uri->segment_array();
            $page                     = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
            $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
            $this->data['limit']      = [ 'per_page' => 10, 'page' => $page ];

            if ( $this->data['is_loggedin'] == false ) {
                $this->data['check_follow'] = 0;
            } else {
                $this->data['check_follow'] = $this->Follow_model->check_follow( [
                    'follower_id' => $this->data['user']['id'],
                    'followed_company' => $this->data['company']->id
                ] );
            }

            $this->data['products']       = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();

            //Pagination
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            $config['first_link']         = '&laquo;';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = '&raquo;';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = '&rarr;';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = '&larr;';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a href="">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['anchor_class']       = 'follow_link';
            $config['reuse_query_string'] = true;
            $config['use_page_numbers']   = true;
            $config['base_url']           = site_url_multi( 'company/' . $this->data['company']->slug );
            $config['total_rows']         = $this->data['total_rows'];
            $config['per_page']           = $this->data['limit']['per_page'];
            $this->pagination->initialize( $config );
            $this->data['pagination'] = $this->pagination->create_links();

            $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


            /* INSERT STATISTICS */

            $country_id = $this->data['ip_country']->id;
            $ip         = $_SERVER['REMOTE_ADDR'];

            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'company',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                $data = array(
                    'section' => 'company',
                    'type'    => $this->data['company']->id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {
                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {
                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'company',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }


            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'country',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                $data = array(
                    'section' => 'country',
                    'type'    => $this->data['company']->country_id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {

                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {

                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'country',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }
        }


        $user = $this->data['UserData'];
        if ( $user ) {
            if(empty($user->company_logo))
            {
                $this->data['company_logo'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_logo, FILTER_VALIDATE_URL))
                {
                    $this->data['company_logo'] = base_url('uploads/catalog/users/').$user->company_logo;
                }
                else
                {
                    $this->data['company_logo'] = $user->company_logo;
                }
            }

            if(empty($user->company_banner))
            {
                $this->data['company_banner'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_banner, FILTER_VALIDATE_URL))
                {
                    $this->data['company_banner'] = base_url('uploads/catalog/users/').$user->company_banner;
                }
                else
                {
                    $this->data['company_banner'] = $user->company_banner;
                }
            }


            $this->data['title']       = translate( 'title' );
            $this->data['active_menu'] = 5;

            $user=$this->data['UserData'];
            $user_id=$user->id;
            $company_id=$user->company_id;

            $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();
            $this->data['user'] = $user;
            $this->data['slug'] = $slug;

            /* get rating status */
            $company_rate=0;

            if (isset($_SESSION['id'])){
                $this->db->select('rate');
                $this->db->where('profile_id', $this->data['company']->id);
                $this->db->where('user_id', $_SESSION['id']);
                $query=$this->db->get('wc_ratings');

                $company_rate=($query->row()) ? $query->row()->rate : 0;
            }

            $this->db->select('id');
            $this->db->where('profile_id', $this->data['company']->id);
            $query2=$this->db->get('wc_ratings');
            $company_rate_total=($query2->num_rows()) ? $query2->num_rows() : 0;



            $this->data['company_rate'] = $company_rate;
            $this->data['company_rate_total'] = $company_rate_total;

            $normal_star='<svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>';


            $this->db->select('rate');
            $this->db->select('COUNT(`id`) AS `rate_count`');
            $this->db->where('profile_id', $this->data['company']->id);
            $this->db->group_by('rate');
            $this->db->order_by('rate_count', 'DESC');
            $query3=$this->db->get('wc_ratings', 1);
            $data3=$query3->row();

            $this->data['company_star_rate'] = ($query3->num_rows()) ? $data3->rate : 0;
            $this->data['company_star_rate_count'] = ($query3->num_rows()) ? $data3->rate_count : 0;


            $this->data['normal_star']=$normal_star;

            $this->template->render( 'company/public-company-tenders' );
        }
    }

    public function publicChats( $slug ) {
        $this->data['new_page'] = 1;


        $this->data['company'] = $this->data['UserData'];

        $group                             = $this->User_model->get_user_group( '*', 'user_id = ' . $this->data['company']->id );

        if (!empty($group)) {
            $group_id                          = $group[0]['group_id'];
            $group_name                        = $this->Group_model->filter( [ 'id' => $group_id ] )->fields( [ 'name' ] )->one();

            if(isset($group_name->name)) {
                $this->data['company']->group_name = $group_name->name;
            }


        }else {
            $this->data['company']->group_name = '';
        }

        if ( $this->data['company'] ) {
            $this->data['company_images'] = '';

            if ( empty( $this->data['company']->images ) ) {
                $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . "avatar-placeholder.png";
            } else {
                if ( ! filter_var( $this->data['company']->images, FILTER_VALIDATE_URL ) ) {
                    $this->data['company_images'] = base_url( 'uploads/catalog/users/' ) . $this->data['company']->images;
                } else {
                    $this->data['company_images'] = $this->data['company']->images;
                }
            }
            $segment_array            = $this->uri->segment_array();
            $page                     = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
            $this->data['total_rows'] = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->one()->count;
            $this->data['limit']      = [ 'per_page' => 10, 'page' => $page ];

            if ( $this->data['is_loggedin'] == false ) {
                $this->data['check_follow'] = 0;
            } else {
                $this->data['check_follow'] = $this->Follow_model->check_follow( [
                    'follower_id' => $this->data['user']['id'],
                    'followed_company' => $this->data['company']->id
                ] );
            }

            $this->data['products']       = $this->Product_model->filter( [ 'user_id' => $this->data['company']->id ] )->with_translation()->all();

            //Pagination
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            $config['first_link']         = '&laquo;';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = '&raquo;';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = '&rarr;';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = '&larr;';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a href="">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['anchor_class']       = 'follow_link';
            $config['reuse_query_string'] = true;
            $config['use_page_numbers']   = true;
            $config['base_url']           = site_url_multi( 'company/' . $this->data['company']->slug );
            $config['total_rows']         = $this->data['total_rows'];
            $config['per_page']           = $this->data['limit']['per_page'];
            $this->pagination->initialize( $config );
            $this->data['pagination'] = $this->pagination->create_links();

            $this->data['title'] = $this->data['company']->company_name . ' | Makromedicine.com';


            /* INSERT STATISTICS */

            $country_id = $this->data['ip_country']->id;
            $ip         = $_SERVER['REMOTE_ADDR'];

            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'company',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->id ) ) {

                $data = array(
                    'section' => 'company',
                    'type'    => $this->data['company']->id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {
                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {
                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'company',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }


            $query_st = $this->db->get_where( 'wc_ip_filter', [
                'section' => 'country',
                'ip'      => $ip,
                'type'    => $this->data['company']->id
            ] );

            if ( ( ! $query_st || $query_st->num_rows() == 0 ) && ! is_null( $this->data['company']->country_id ) ) {

                $data = array(
                    'section' => 'country',
                    'type'    => $this->data['company']->country_id,
                    'country' => $country_id,
                    'month'   => date( 'm' ),
                    'year'    => date( 'Y' )
                );

                $query = $this->db->get_where( 'wc_statistics', $data );

                if ( $query && $query->num_rows() > 0 ) {

                    $res = $query->result()[0];
                    $this->db->set( 'value', 'value+1', false );
                    $this->db->where( 'id', $res->id );
                    $this->db->update( 'wc_statistics' );
                } else {

                    $data['value'] = 1;
                    $this->db->insert( 'wc_statistics', $data );
                }

                $this->db->insert( 'wc_ip_filter', [
                    'section'  => 'country',
                    'ip'       => $ip,
                    'type'     => $this->data['company']->id,
                    'add_date' => time()
                ] );

            }
        }


        $user = $this->data['UserData'];
        if ( $user ) {
            if(empty($user->company_logo))
            {
                $this->data['company_logo'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_logo, FILTER_VALIDATE_URL))
                {
                    $this->data['company_logo'] = base_url('uploads/catalog/users/').$user->company_logo;
                }
                else
                {
                    $this->data['company_logo'] = $user->company_logo;
                }
            }

            if(empty($user->company_banner))
            {
                $this->data['company_banner'] = base_url('uploads/catalog/users/')."avatar-placeholder.png";
            }
            else
            {
                if(!filter_var($user->company_banner, FILTER_VALIDATE_URL))
                {
                    $this->data['company_banner'] = base_url('uploads/catalog/users/').$user->company_banner;
                }
                else
                {
                    $this->data['company_banner'] = $user->company_banner;
                }
            }


            $this->data['title']       = translate( 'title' );
            $this->data['active_menu'] = 6;

            $user=$this->data['UserData'];
            $user_id=$user->id;
            $company_id=$user->company_id;

            $this->data['get_confirm_status'] = $this->Confirm_account_model->fields('*')->filter(['user_id'=>$user_id, 'company_id' => $company_id])->one();
            $this->data['user'] = $user;
            $this->data['slug'] = $slug;

            

            $this->template->render( 'company/public-company-chats' );
        }
    }
}
