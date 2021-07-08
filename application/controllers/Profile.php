<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends Site_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->data['is_loggedin']) {
            $this->load->library('Auth');
            $this->load->model('Tags_model');
            $this->load->model('User_model');
            $this->load->model('Company_model');
            $this->load->model('Group_model');
            $this->load->model('Country_model');
            $this->load->model('Standart_model');
            $this->load->model('Phone_type_model');
            $this->load->model('Person_type_model');
            $this->load->model('Product_type_model');
            $this->load->model('Follow_model');
            $this->load->helper('extra');
            $this->load->library("phpmailer_library");




            if (isset($this->data['UserData']->product_type) && !empty($this->data['UserData']->product_type) && $this->data['UserData']->product_type != null) {
                $this->data['selected_product_type']       = json_decode($this->data['UserData']->product_type);
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
            } else {
                $this->data['selected_product_type'][0]    = '';
                $this->data['selected_product_type_names'] = '';
            }


            if (isset($this->data['UserData']->standart) && !empty($this->data['UserData']->standart) && $this->data['UserData']->standart != null) {
                $this->data['selected_standart'] = explode(',', $this->data['UserData']->standart);
            } else {
                $this->data['selected_standart'][0] = '';
            }

            $cert = $this->db->select('image')->where('user_id', $this->data['UserData']->id)->get('wc_confirm_account')->result();
            if (is_array($cert) && isset($cert[0]->image)) {
                $this->data['UserData']->certificate = $cert[0]->image;
            }


            $this->data['get_standart'] = $this->User_model->get_standart(['user_id' => $this->data['user']['id']],'wc_standart_translation.name st_name ,wc_user_standart_image.*');


            $this->data['get_user_group'] = $this->User_model->get_user_group( ['user_id' => $this->data['user']['id']],'*');
            if ($this->data['get_user_group'] != false) {
                foreach ($this->data['get_user_group'] as $key => $value) {
                    $this->data['user']['group_id'] = $value['group_id'];
                }
            }
            $this->data['UserGroup'] = $this->Group_model->fields([
                'id',
                'name'
            ])->filter(['id' => $this->data['user']['group_id']])->one();

            /* TAGS */
            if (isset($this->data['UserData']->tags) && !empty($this->data['UserData']->tags)) {
                $this->data['tags'] = $this->data['UserData']->tags;
            } else {
                $this->data['tags'] = '';
            }
            $this->data['general_tags']       = $this->Tags_model->fields([
                'id',
                'name'
            ])->with_translation()->all();
            $this->data['general_tags_inner'] = [];
            if ($this->data['general_tags'] != false) {
                foreach ($this->data['general_tags'] as $tags) {
                    $this->data['general_tags_inner'][] = [
                        'value' => $tags->id,
                        'name'  => $tags->name
                    ];
                }
            }


            $this->data['tag_maps']       = json_encode($this->data['general_tags_inner'], true);
            $this->data['person_info']    = json_decode($this->auth->get_user_var('person'));
            $this->data['company_info']   = json_decode($this->auth->get_user_var('company'));
            $this->data['user_following'] = $this->Follow_model->fields(['count(*) as count'])->filter(['follower_id' => $this->data['user']['id']])->one()->count;
            $this->data['user_followers'] = $this->Follow_model->fields(['count(*) as count'])->filter(['followed_user' => $this->data['user']['id']])->one()->count;
            // $this->data['UserData']->country_code = get_country_code($this->data['UserData']->country_id);


        } else {
            redirect(site_url_multi('/'), 'refresh');
        }
    }

    public function index()
    {
        $this->data['new_page'] = 1;
        $this->data['title']       = translate('title');
        $this->data['active_menu'] = 1;
        $this->template->render('profile/profile');
    }

    public function get_page_notification()
    {
        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('page_id', 'ID', 'trim|required');
            $this->form_validation->set_rules('notif_type', 'User', 'required');

            if ($this->form_validation->run()) {
                $page_id = $this->input->post('page_id');
                $notif_type = $this->input->post('notif_type');
                $user_id = $this->data['user']['id'];

                $this->db->select('id, data as date, title, description');
                $this->db->from('wc_user_notify');
                $this->db->where(['company_id' => $page_id, 'status' => $notif_type]);
                $query = $this->db->get();
                $object = $query->result_object();

                if (!empty($object)) {
                    foreach ($object as $k => $v) {
                        $date = date_create($v->date);

                        $v->date = date_format($date, "d.m.Y");
                    }
                }

                $response = [
                    'data' => $object,
                    'type'    => 'success',
                    'message' => ''
                ];
            } else {
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }

            echo json_encode($response);
        }
    }

    public function settings()
    {

        if ($this->input->method() == 'post' && isset($_POST['remove_company'])) {

            $this->form_validation->set_rules('removed_company_id', 'ID', 'trim|required');
            $this->form_validation->set_rules('remove_company', 'User', 'required');

            if ($this->form_validation->run()) {
                $removed_company_id = $this->input->post('removed_company_id');
                $comment = $this->input->post('comment');
                $complain_ids = $this->input->post('complain_ids');
                $user_id = $this->data['user']['id'];

                $this->db->where([
                    'company_id' => $removed_company_id,
                    'user_id' => $user_id
                ]);
                $this->db->update('wc_company_user_rel', ['delete_at' => date('Y-m-d H:i:s')]);


                $this->db->insert('wc_complain_profile_and_company', [
                    'type' => 2,
                    'company_id' => $removed_company_id,
                    'user_id' => $user_id,
                    'reason_ids' => (!empty($complain_ids)) ? json_encode($complain_ids) : null,
                    'comment' => $comment,
                ]);

                $response = [
                    'type'    => 'success',
                    'message' => 'Your are removed company'
                ];
            } else {
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }

            echo json_encode($response);
        } else {


            $this->data['new_page'] = 1;
            $this->data['active_menu']  = 2;
            $this->data['settings']  = 1;
            $this->data['title']        = translate('title');
            $this->data['countrys']     = $this->Country_model->fields([
                'id',
                'name',
                'code'
            ])->with_translation()->all();
            $this->data['product_type'] = $this->Product_type_model->fields(['id', 'name'])->with_translation()->all();
            $this->data['standarts']    = $this->Standart_model->fields(['id', 'name'])->with_translation()->all();
            $this->data['phone_type']   = $this->Phone_type_model->fields(['id', 'name'])->with_translation()->all();
            $this->data['person_type']  = $this->Person_type_model->fields(['id', 'name'])->with_translation()->all();
            /* $check_group_type = ($this->uri->segment('4') == 'interests') ? 2 : 1;
            $this->data['groups']           = $this->Group_model->fields(['id', 'name'])->filter(['type' => $check_group_type])->all();
             */
            $this->data['get_standart'] = $this->User_model->get_standart(['user_id' => $this->data['user']['id']],'wc_standart_translation.name st_name ,wc_user_standart_image.*');



            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $ip = $_SERVER["REMOTE_ADDR"];
            }

            $ip = "31.171.74.27";
            $user_id= $this->data['user']['id'];

            $ipdat = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));


            $this->data['title'] = translate('title_settings');
            $this->data['countryCode'] = $ipdat->geoplugin_countryCode;

            $this->data['work_history'] = $this->User_model->getUserData(['u.id' => $user_id, 'c.id!=' => '0'], true);

            $this->data['complain_reasons'] = $this->User_model->getComplainReasons(2);

            $this->data['confirm_data'] = $this->User_model->getAccountConfirmationData($user_id);


            $this->template->render('profile/settings');
        }
    }


    public function save()
    {

        if ($this->input->method() == 'post') {




            if (isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'])) {


                $directory               = DIR_IMAGE . 'catalog/standart';
                $config                  = array();
                $config['upload_path']   = $directory;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                $config['overwrite']     = false;



                $this->load->library('upload');

                $files = $_FILES;
                $total = count($files['userfile']['name']);

                foreach ($files['userfile']['name'] as $i => $value) {
                    $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];

                    $config['file_name'] = $_FILES['userfile']['name'];

                    $this->upload->initialize($config);



                    if (!$this->upload->do_upload('userfile')) {
                        $json['error'] = $this->upload->display_errors();
                        print_r($this->upload->display_errors());
                    } else {
                        $this->User_model->insertStandart([
                            'user_id'     => $this->data['user']['id'],
                            'standart_id' => $i,
                            'name'        => $this->upload->data()['file_name']
                        ]);
                    }
                }
            }

            if (isset($_FILES['company_logo']) && !empty($_FILES['company_logo']['name'])) {
                $file_name = $_FILES['company_logo']['name'];
                $directory               = DIR_IMAGE . 'catalog/users';
                $config                  = array();
                $config['upload_path']   = $directory;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite']     = false;
                $config['file_name']     = $file_name;

                $this->load->library('upload');
                $this->upload->initialize($config);

                $upload_data = $this->upload->data();


                if (!$this->upload->do_upload('company_logo')) {
                    $json['error'] = $this->upload->display_errors();
                } else {
                    $this->data['company_logo'] = $upload_data['file_name'];
                }
            } else {
                $this->data['company_logo'] = null;
            }


            if (isset($_FILES['company_banner']) && !empty($_FILES['company_banner']['name'])) {
                $file_name = time() . '-' . $_FILES['company_banner']['name'];
                $directory               = DIR_IMAGE . 'catalog/users';
                $config                  = array();
                $config['upload_path']   = $directory;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite']     = false;
                $config['file_name']     = $file_name;

                $this->load->library('upload');
                $this->upload->initialize($config);

                $upload_data = $this->upload->data();

                if (!$this->upload->do_upload('company_banner')) {
                    $json['error'] = $this->upload->display_errors();
                } else {
                    $this->data['company_banner'] = $upload_data['file_name'];
                }
            } else {
                $this->data['company_banner'] = null;
            }

            $this->data['user_groups_id']     = $this->input->post('group_id');
            $this->data['status']             = $this->input->post('status');
            $this->data['establishment_date'] = $this->input->post('establishment_date');
            $this->data['birth_day']          = $this->input->post('birth_day');
            $this->data['tags']               = $this->input->post('tags');
            $this->data['company_info']       = $this->input->post('company_info');
            $this->data['standart']           = $this->input->post('standart');
            $this->data['email']              = $this->input->post('email');
            $this->data['product_type']       = $this->input->post('product_type');
            $this->data['country_id']         = $this->input->post('country_id');
            /* $this->data['address']            = $this->input->post( 'address' );
            $this->data['website']            = $this->input->post( 'website' );
            $this->data['facebook']           = $this->input->post( 'facebook' );
            $this->data['youtube']            = $this->input->post( 'youtube' );
            $this->data['twitter']            = $this->input->post( 'twitter' );
            $this->data['linkedin']           = $this->input->post( 'linkedin' ); */
            $this->data['lat']                = $this->input->post('lat');
            $this->data['lng']                = $this->input->post('lng');

            if (is_null($this->data['standart'])) {
                $this->data['standart'] = array();
            }
            $standart_images     = $this->User_model->get_standart(['user_id' => $this->data['user']['id']],'wc_standart_translation.name st_name ,wc_user_standart_image.*');
            $standart_images_ids = array();
            if ($standart_images) {
                foreach ($standart_images as $key => $value) {
                    $standart_images_ids[] = $value['standart_id'];
                }
            }

            $this->User_model->deleteStandart2($this->data['user']['id'], $this->data['standart']);


            /*if ( isset( $this->data['standart'] ) && $this->data['standart'] !== false ) {
                foreach ( $this->data['standart'] as $key => $value ) {
                    if ( ! in_array( $value, $standart_images_ids ) ) {
                        unset( $this->data['standart'][ $key ] );
                    }
                }
            }*/

            $page_status = $this->checkCompanyExistenceAndOwnerShip($this->data['user']['id'], $this->input->post('company_name'));

            //UPDATE USER GROUP

            if ($page_status == 1) {
                $this->data['page_created'] = 1;
                $this->data['group_id'] = $this->input->post('group_id');
            } elseif ($page_status == 2) {
                $this->data['group_id'] = 6;
                $this->data['page_created'] = 2;
            } elseif ($page_status == 3) {
                $this->data['group_id'] = $this->input->post('group_id');
                $this->data['page_created'] = 1;
            } else {
                $this->data['group_id'] = 6;
                $this->data['page_created'] = 0;
            }

            $update_group = $this->User_model->update_group($this->data['user']['id'], ['group_id' => $this->data['group_id']]);

            if ($update_group) {
                if (isset($this->data['tags'][0])) {
                    $tags = $this->data['tags'][0];
                } else {
                    $tags = '';
                }
                $standarts = implode(',', $this->data['standart']);

                $array = array(
                    'user_groups_id' => $this->data['group_id'],
                    'country_id'     => $this->data['country_id'],
                    // 'brith_day'      => $this->data['brith_day'],
                    'product_type'   => json_encode($this->data['product_type']),
                    /* 'adress'         => $this->data['address'],
                    'website'        => $this->data['website'], */
                    /* 'facebook'       => $this->data['facebook'],
                    'twitter'        => $this->data['twitter'],
                    'youtube'        => $this->data['youtube'],
                    'linkedin'       => $this->data['linkedin'], */
                    'lat'            => $this->data['lat'],
                    'lng'            => $this->data['lng'],
                );

                $company_array = [
                    'tags'           => $tags,
                    'standart'       => $standarts,
                ];

                if ($this->input->post('facebook') != null) {
                    $this->data['facebook'] = $this->input->post('facebook');
                    $array['facebook']      = $this->data['facebook'];
                }

                if ($this->input->post('twitter') != null) {
                    $this->data['twitter'] = $this->input->post('twitter');
                    $array['twitter']      = $this->data['twitter'];
                }

                if ($this->input->post('youtube') != null) {
                    $this->data['youtube'] = $this->input->post('youtube');
                    $array['youtube']      = $this->data['youtube'];
                }

                if ($this->input->post('linkedin') != null) {
                    $this->data['linkedin'] = $this->input->post('linkedin');
                    $array['linkedin']      = $this->data['linkedin'];
                }

                if ($this->input->post('address') != null) {
                    $this->data['address'] = $this->input->post('address');
                    $array['adress']      = $this->data['address'];
                }

                $array['display_email']      = $this->input->post('display_email');
                $array['display_phone']      = $this->input->post('display_phone');
                $array['display_dob']      = $this->input->post('display_dob');

                if ($this->input->post('company_address') != null) {
                    $this->data['company_address'] = $this->input->post('company_address');
                    $company_array['company_address']      = $this->data['company_address'];
                }

                if ($this->input->post('website') != null) {
                    $this->data['website'] = $this->input->post('website');
                    $company_array['website']      = $this->data['website'];
                }

                if ($this->input->post('company_facebook') != null) {
                    $this->data['company_facebook'] = $this->input->post('company_facebook');
                    $company_array['company_facebook']      = $this->data['company_facebook'];
                }

                if ($this->input->post('company_youtube') != null) {
                    $this->data['company_youtube'] = $this->input->post('company_youtube');
                    $company_array['company_youtube']      = $this->data['company_youtube'];
                }

                if ($this->input->post('company_twitter') != null) {
                    $this->data['company_twitter'] = $this->input->post('company_twitter');
                    $company_array['company_twitter']      = $this->data['company_twitter'];
                }

                if ($this->input->post('company_linkedin') != null) {
                    $this->data['company_linkedin'] = $this->input->post('company_linkedin');
                    $company_array['company_linkedin']      = $this->data['company_linkedin'];
                }

                if ($this->input->post('company_lat') != null) {
                    $this->data['company_lat'] = $this->input->post('company_lat');
                    $company_array['company_lat']      = $this->data['company_lat'];
                }

                if ($this->input->post('company_lng') != null) {
                    $this->data['company_lng'] = $this->input->post('company_lng');
                    $company_array['company_lng']      = $this->data['company_lng'];
                }

                if ($this->input->post('fullname') != null) {
                    $this->data['fullname'] = $this->input->post('fullname');
                    $array['fullname']      = $this->data['fullname'];
                    $array['slug_user']          = generateSeoURL($this->data['fullname']);
                }

                if ($this->input->post('phone') != null) {
                    $this->data['phone'] = $this->input->post('phone');
                    $array['phone']      = $this->data['phone'];
                }

                if ($this->input->post('country_code') != null) {
                    $this->data['country_code'] = $this->input->post('country_code');
                    $array['country_code']      = $this->data['country_code'];
                }



                if ($this->input->post('company_name') != null) {
                    $this->data['company_name'] = $this->input->post('company_name');
                    $company_array['company_name']      = $this->data['company_name'];
                    //if($this->data['group_id'] != 6) {
                    $company_array['slug'] = generateSeoURL($this->data['company_name']);
                    //}
                }

                if ($this->input->post('company_info') != null) {
                    $this->data['company_info'] = $this->input->post('company_info');
                    $company_array['company_info']      = $this->data['company_info'];
                }

                if ($this->input->post('personal_info') != null) {
                    $this->data['personal_info'] = $this->input->post('personal_info');
                    $array['personal_info']      = $this->data['personal_info'];
                }

                if ($this->input->post('establishment_date') != null) {
                    $this->data['establishment_date'] = $this->input->post('establishment_date');
                    $company_array['establishment_date']      = $this->data['establishment_date'];
                }

                if (!empty($this->input->post('b_day')) && !empty($this->input->post('b_month')) && !empty($this->input->post('b_year'))) {
                    $this->data['brith_day'] = $this->input->post('b_day') . '-' . $this->input->post('b_month') . '-' . $this->input->post('b_year');

                    $array['brith_day']      = $this->data['brith_day'];
                } else {
                    $array['brith_day'] = null;
                }

                if (!is_null($this->data['company_logo'])) {
                    $company_array['company_logo'] = $this->data['company_logo'];
                }

                if (!is_null($this->data['company_banner'])) {
                    $company_array['company_banner'] = $this->data['company_banner'];
                }

                if ($this->input->post('industry_id') != null) {
                    $company_array['industry_id'] = $this->input->post('industry_id');
                }

                



                if (!empty($this->input->post('company_name'))) {

                    $page_created = 1;

                    $company_id = $this->Company_model->checkCompany([
                        'company_name' => $company_array['company_name']
                    ]);

                    if ($this->input->post('apply_company') != 0) {
                        $company_id = $this->input->post('apply_company');
                    }

                    if (!$company_id) {
                        $company_id = $this->Company_model->insert_company($company_array);

                        $role_data = [
                            'company_id' => $company_id,
                            'user_id' => $this->data['user']['id'],
                            'role_id' => 1,
                            'position_id' => 0,
                            'approved' => 1
                        ];

                        if ($this->Company_model->check_company_user_rel($role_data)) {
                            $this->Company_model->insert_company_user_rel($role_data);
                        }


                        $array['page_id'] = $company_id;
                    } else if ($this->input->post('apply_company') != 0) {

                        $role_data = [
                            'company_id' => $company_id,
                            'user_id' => $this->data['user']['id'],
                            'role_id' => 4,
                            'position_id' => $this->input->post('position'),
                            'approved' => 0
                        ];

                        if ($this->Company_model->check_company_user_rel($role_data)) {
                            $this->Company_model->insert_company_user_rel($role_data);
                        }

                        $page_created = 2;
                    } else if ($this->input->post('apply_company') == 0) {

                        unset($company_array['company_name'], $company_array['slug']);


                        $this->Company_model->updateCompany($company_id, $company_array);
                    }

                    $this->data['page_created'] = $page_created;
                    $array['page_created']      = $page_created;
                }

                $array['work_experience'] = $this->input->post('work_experience');

                $updata_user = $this->User_model->save_fcm($this->data['user']['id'], $array);


                if ($this->data['page_created'] == 2) {

                    $company_name = $this->input->post('company_name');

                    $to_id = $this->Company_model->getCompanyIdByUserId([
                        'company_id' => $company_id,
                        'role_id' => 1
                    ])->user_id;

                    if (!empty($to_id)) {
                        $this->data['notify_data'] = [
                            'user_id'     => $to_id,
                            'company_id' => $company_id,
                            'send_id'     => $this->data['user']['id'],
                            'status'      => 1,
                            'sender'      => 1,
                            'type'        => 1,
                            'title'       => $_SESSION['fullname'] . " apply " . $company_name,
                            'description' => "",
                        ];
                        //$this->data['send_notify'] = $this->Notify_model->send($this->data['notify_data']);
                    }
                }

                if ($updata_user) {

                    if ($this->data['page_created'] == 2) {
                        // Get Approval from owner.
                    }

                    $this->auth->remove_all_var();


                    if (isset($_POST['company']) && !empty($_POST['company'])) {

                        $list = $_POST['company'];
                        $employers = [];
                        $company_name = $this->input->post('company_name');

                        foreach ($list['fullname'] as $k => $v) {
                            if (
                                !empty($v) && !empty($list['person_type'][$k]) && !empty($list['email'][$k])
                            ) {
                                $employers[] = [
                                    'fullname' => $v,
                                    'position_id' => $list['person_type'][$k],
                                    'position_name' => $this->User_model->getPersonType($list['person_type'][$k]),
                                    'email' => $list['email'][$k],
                                    'code' => (isset($list['code'][$k])) ? $list['code'][$k] : '+994',
                                    'phone' => (isset($list['phone'][$k])) ? $list['phone'][$k] : '',
                                    'phone_type' => (isset($list['phone_type'][$k])) ? $list['phone_type'][$k] : '',
                                    'ext' => (isset($list['ext'][$k])) ? $list['ext'][$k] : '',
                                    'company_name' => $company_name,
                                    'company_id' => $company_id,
                                    'company_url' => $this->data['UserData']->slug
                                ];
                            }
                        }

                        

                        if (!empty($employers)) {
                            foreach ($employers as $k => $v) {
                                $check_info = $this->User_model->checkUser($v['email'], $v);


                                if ($check_info['first_apply']) {

                                    $this->data['notify_data'] = [
                                        'user_id'     => $check_info['user_id'],
                                        'company_id' => $v['company_id'],
                                        'send_id'     => $this->data['user']['id'],
                                        'status'      => 1,
                                        'sender'      => 1,
                                        'type'        => 1,
                                        'title'       => $_SESSION['fullname'] . " added you to " . $company_name . " as " . $v['position_name'],
                                        'description' => "",
                                    ];
                                    //$this->data['send_notify'] = $this->Notify_model->send($this->data['notify_data']);
                                }

                                if ($check_info['change_position']) {
                                    $this->data['notify_data'] = [
                                        'user_id'     => $check_info['user_id'],
                                        'company_id' => $v['company_id'],
                                        'send_id'     => $this->data['user']['id'],
                                        'status'      => 1,
                                        'sender'      => 1,
                                        'type'        => 1,
                                        'title'       => $_SESSION['fullname'] . " changed position at " . $company_name . " as " . $v['position_name'],
                                        'description' => "",
                                    ];
                                    //$this->data['send_notify'] = $this->Notify_model->send($this->data['notify_data']);
                                }
                            }
                        }
                    }
                }


                /* work places */
                if ($this->input->post('show_place_work') != null) {
                    $show_place_work = $this->input->post('show_place_work');
                    $industry_ids = $this->input->post('industry_ids');
                    $appllied_company = $this->input->post('appllied_company');
                    $company_names = $this->input->post('company_names');
                    $country_ids = $this->input->post('country_ids');
                    $positions = $this->input->post('positions');

                    $from_days = $this->input->post('from_days');
                    $from_month = $this->input->post('from_month');
                    $from_years = $this->input->post('from_years');

                    $until_now = $this->input->post('until_now');

                    $to_days = $this->input->post('to_days');
                    $to_month = $this->input->post('to_month');
                    $to_years = $this->input->post('to_years');

                    foreach ($show_place_work as $k => $v) {
                        $start_date = $from_years[$k] . '-' . $from_month[$k] . '-' . $from_days[$k];
                        $end_date = ($until_now[$k] == "1") ? "0000-00-00" : $to_years[$k] . '-' . $to_month[$k] . '-' . $to_days[$k];


                        if (
                            empty($company_names[$k]) || empty($country_ids[$k]) || empty($positions[$k])  ||
                            empty($from_years[$k]) || empty($from_month[$k]) || empty($from_days[$k])
                        ) {
                            continue;
                        }



                        $company_id = $this->Company_model->checkCompany([
                            'company_name' => $company_names[$k]
                        ]);



                        if ($appllied_company[$k] != 0) {
                            $company_id = $appllied_company[$k];
                        }


                        if (!$company_id) {
                            $company_array = [
                                'industry_id' => $industry_ids[$k],
                                'country_id' => $country_ids[$k],
                                'company_name' => $company_names[$k],
                                'slug' => generateSeoURL($company_names[$k]),
                            ];


                            $company_id = $this->Company_model->insert_company($company_array);
                        } else {

                            $this->Company_model->updateCompany($company_id, [
                                'country_id' => $country_ids[$k],
                                'industry_id' => $industry_ids[$k],
                            ]);
                        }



                        $role_data = [
                            'company_id' => $company_id,
                            'user_id' => $this->data['user']['id']
                        ];

                        $insert_role = [
                            'company_id' => $company_id,
                            'user_id' => $this->data['user']['id'],
                            'role_id' => 4,
                            'position_id' => $positions[$k],
                            'approved' => 1,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'display_company' => $show_place_work[$k],
                            'delete_at' => null
                        ];

                        if ($this->Company_model->check_company_user_rel($role_data)) {
                            $this->Company_model->insert_company_user_rel($insert_role);
                        } else {
                            $this->Company_model->update_company_user_rel($insert_role, [
                                'company_id' => $company_id,
                                'user_id' => $this->data['user']['id']
                            ]);
                        }
                    }
                }

                if (isset($json) && !empty($json)) {
                    echo "<pre>";
                    print_r($json);
                }
            }
        }
    }

    public function deleteUserFromCompany()
    {
        $this->User_model->deleteUserFromCompany($_POST['company_id'], $_POST['email']);

        echo json_encode(['ok' => true]);
    }

    public function companyInformation()
    {
        if ($this->input->method() == 'post') {
            $array = [];
            if ($this->input->post('establishment_date') != null) {
                $this->data['establishment_date'] = $this->input->post('establishment_date');
                $array['establishment_date']      = $this->data['establishment_date'];
            }
            if ($this->input->post('company_info') != null) {
                $this->data['company_info'] = $this->input->post('company_info');
                $array['company_info']      = $this->data['company_info'];
            }
            if ($this->input->post('company_name') != null) {
                $this->data['company_name'] = $this->input->post('company_name');
                $array['company_name']      = $this->data['company_name'];
                $array['slug']              = generateSeoURL($this->data['company_name']);
            }

            if ($this->input->post('company_name') != null) {
                $this->data['company_name'] = $this->input->post('company_name');
                $array['company_name']      = $this->data['company_name'];
                $array['slug']              = generateSeoURL($this->data['company_name']);
            }

            if ($this->input->post('tags') != null) {
                $this->data['tags'] = $this->input->post('tags');
                $array['tags']      = $this->data['tags'];
            }

            if ($this->input->post('company_info') != null) {
                $this->data['company_info'] = $this->input->post('company_info');
                $array['company_info']      = $this->data['company_info'];
            }

            if ($this->input->post('standart') != null) {
                $this->data['standart'] = $this->input->post('standart');
                $array['standart']      = $this->data['standart'];
            }

            if ($this->input->post('product_type') != null) {
                $this->data['product_type'] = $this->input->post('product_type');
                $array['product_type']      = $this->data['product_type'];
            }

            if ($this->input->post('country_id') != null) {
                $this->data['country_id'] = $this->input->post('country_id');
                $array['country_id']      = $this->data['country_id'];
            }

            if ($this->input->post('company_address') != null) {
                $this->data['company_address'] = $this->input->post('company_address');
                $array['company_address']      = $this->data['company_address'];
            }

            if ($this->input->post('website') != null) {
                $this->data['website'] = $this->input->post('website');
                $array['website']      = $this->data['website'];
            }

            if ($this->input->post('company_facebook') != null) {
                $this->data['company_facebook'] = $this->input->post('company_facebook');
                $array['company_facebook']      = $this->data['company_facebook'];
            }

            if ($this->input->post('company_youtube') != null) {
                $this->data['company_youtube'] = $this->input->post('company_youtube');
                $array['company_youtube']      = $this->data['company_youtube'];
            }

            if ($this->input->post('company_twitter') != null) {
                $this->data['company_twitter'] = $this->input->post('company_twitter');
                $array['company_twitter']      = $this->data['company_twitter'];
            }

            if ($this->input->post('company_linkedin') != null) {
                $this->data['company_linkedin'] = $this->input->post('company_linkedin');
                $array['company_linkedin']      = $this->data['company_linkedin'];
            }

            if ($this->input->post('company_lat') != null) {
                $this->data['company_lat'] = $this->input->post('company_lat');
                $array['company_lat']      = $this->data['company_lat'];
            }

            if ($this->input->post('company_lng') != null) {
                $this->data['company_lng'] = $this->input->post('company_lng');
                $array['company_lng']      = $this->data['company_lng'];
            }

            if ($this->input->post('page_created') != null) {
                $this->data['page_created'] = 1;
                $array['page_created']      = 1;
            }

            $comp_name = $this->data['company_name'];
            if ($comp_name !== null && $comp_name != '' && $this->auth->user_exist_by_company($comp_name)) {
                redirect(site_url_multi('profile/settings?same_comp'), 'refresh');

                return false;
            }

            $updata_user = $this->User_model->save_fcm($this->data['user']['id'], $array);
            if ($updata_user) {

                if ($this->input->post('page_item') != null && $this->input->post('page_item') == "page") {
                    redirect(site_url_multi('profile/create-page/'), 'refresh');
                } else {
                    redirect(site_url_multi('profile/settings/'), 'refresh');
                }
            }
        }
    }

    public function deleteimg()
    {
        if ($this->input->method() == 'post') {

            $this->data['standart_id'] = $this->input->post('value');
            $this->data['user_id']     = $this->input->post('user_id');

            $delete_standart           = $this->Company_model->delete_standart([
                'standart_id' => $this->data['standart_id'],
                'user_id'     => $this->data['user_id']
            ]);
            if ($delete_standart) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function userphotos()
    {
        if ($this->input->method() == 'post') {
            if (count($_FILES['userphotos']) > 0) {
                $directory               = DIR_IMAGE . 'catalog/users';
                $config                  = array();
                $config['upload_path']   = $directory;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite']     = false;

                $this->load->library('upload');

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('userphotos')) {
                    echo 'false';
                } else {
                    $this->db->set(['images' => $this->upload->data()['file_name']]);
                    $this->db->where('id', $this->data['user']['id']);
                    $this->db->update('wc_users');
                    echo $this->upload->data()['file_name'];
                }
            }
        }
    }

    public function notifications()
    {
        $this->data['new_page'] = 1;
        $this->data['active_menu'] = 3;
        $this->data['sub_menu'] = 1;

        $this->data['title']       = translate('title_account');

        if ($this->input->method() == 'post') {
            $ntf_comp_email = $this->input->post('ntf_comp_email');
            $ntf_comp_sms   = $this->input->post('ntf_comp_sms');
            $ntf_cert_email = $this->input->post('ntf_cert_email');
            $ntf_cert_sms   = $this->input->post('ntf_cert_sms');
            $ntf_pass_email = $this->input->post('ntf_pass_email');
            $ntf_pass_sms   = $this->input->post('ntf_pass_sms');

            $delete_ntf = $this->User_model->delete_ntf($this->data['user']['id']);

            $array = [
                'user_id'        => $this->data['user']['id'],
                'ntf_comp_email' => $ntf_comp_email,
                'ntf_comp_sms'   => $ntf_comp_sms,
                'ntf_cert_email' => $ntf_cert_email,
                'ntf_cert_sms'   => $ntf_cert_sms,
                'ntf_pass_email' => $ntf_pass_email,
                'ntf_pass_sms'   => $ntf_pass_sms
            ];

            $insert_ntf_settings = $this->User_model->insert_ntf_settings($array);
            if ($insert_ntf_settings) {
                redirect(site_url_multi('profile/notifications'), 'location');
            } else {
                redirect(site_url_multi('profile/notifications'), 'location');
            }
        }
        $this->data['account_settings'] = (!empty($this->User_model->account_settings(['*'], ['user_id' => $this->data['user']['id']]))) ? $this->User_model->account_settings(['*'], ['user_id' => $this->data['user']['id']])[0] : [];

        $this->template->render('profile/notifications');
    }

    public function account_confirmation()
    {
        $this->data['new_page'] = 1;
        $this->data['active_menu'] = 3;
        $this->data['sub_menu'] = 5;
        $user_id= $this->data['user']['id'];

        $this->data['title']       = translate('title_account');

        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('surname', 'Surname', 'trim|required');

            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $surname   = $this->input->post('surname');
                $file_list = [];

                if (isset($_FILES['files']) && !empty($_FILES['files']['name'])) {
                    $directory               = DIR_IMAGE . 'account_confirmation';
                    $config                  = array();
                    $config['upload_path']   = $directory;
                    $config['allowed_types'] = 'gif|jpg|png|pdf';
                    $config['overwrite']     = false;
                    $this->load->library('upload');
                    $files = $_FILES;


                    unset($_FILES);

                    foreach ($files['files']['name'] as $i => $value) {
                        $_FILES['files']['name']     = $files['files']['name'][$i];
                        $_FILES['files']['type']     = $files['files']['type'][$i];
                        $_FILES['files']['tmp_name'] = $files['files']['tmp_name'][$i];
                        $_FILES['files']['error']    = $files['files']['error'][$i];
                        $_FILES['files']['size']     = $files['files']['size'][$i];
                        $this->upload->initialize($config);




                        if (!$this->upload->do_upload('files')) {
                            $json['error'] = $this->upload->display_errors();
                        } else {
                            $file_list[] = $directory . '/' . $this->upload->data()['file_name'];
                        }
                    }


                    $insert_data = [
                        'user_id' => $user_id,
                        'name' => $name,
                        'surname' => $surname,
                        'files' => json_encode($file_list),
                        'created_at'  => date('Y-m-d H:i:s'),
                    ];

                    $this->db->insert('wc_confirm_profile', $insert_data);

                    $response = [
                        'type'    => 'success',
                        'message' => 'Your data was sent for account approval.'
                    ];
                } else {
                    $response = [
                        'type'    => 'danger',
                        'message' => 'Please, upload your documentation for verification.'
                    ];
                }
            } else {
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }


            $this->data['message'] = $response;
            redirect( site_url_multi( 'profile/account_confirmation' ));

        }else{
            

            $this->data['confirm_data']= $this->User_model->getAccountConfirmationData($user_id);

        }


        $this->template->render('profile/account_confirmation');
    }

    public function blocked_users()
    {
        if ($this->input->method() == 'post' && isset($_POST['unblock_user'])) {

            $this->form_validation->set_rules('id', 'ID', 'trim|required');
            $this->form_validation->set_rules('unblock_user', 'User', 'required');

            if ($this->form_validation->run()) {
                $id = $this->input->post('id');

                $this->db->delete('wc_block_profile_and_company', [
                    'id' => $id,
                    'user_id' => $this->data['user']['id']
                ]);

                $response = [
                    'type'    => 'success',
                    'message' => 'Your are removed user from blocked user list'
                ];
            } else {
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }

            echo json_encode($response);
        } else if ($this->input->method() == 'post' && isset($_POST['block_user_or_company'])) {

            $this->form_validation->set_rules('id', 'ID', 'trim|required');
            $this->form_validation->set_rules('block_user_or_company', '', 'required');
            $this->form_validation->set_rules('block_type', '', 'required');

            if ($this->form_validation->run()) {
                $id = $this->input->post('id');
                $block_type = $this->input->post('block_type');

                $column_name = ($block_type == 'company') ? 'company_id' : 'profile_id';
                $user_id = $this->data['user']['id'];

                $this->db->select('id');
                $this->db->from('wc_block_profile_and_company');
                $this->db->where(['user_id' => $user_id, $column_name => $id]);
                $query = $this->db->get();

                if ($query->num_rows() == 0) {
                    $this->db->insert('wc_block_profile_and_company', [
                        $column_name => $id,
                        'user_id' => $user_id
                    ]);
                }

                $response = [
                    'type'    => 'success',
                    'message' => 'Blocked successfully!'
                ];
            } else {
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }

            echo json_encode($response);
        } else if ($this->input->method() == 'post' && isset($_POST['complain_user_or_company'])) {

            $this->form_validation->set_rules('complain_id', 'ID', 'trim|required');
            $this->form_validation->set_rules('complain_user_or_company', '', 'required');
            $this->form_validation->set_rules('complain_type', '', 'required');

            if ($this->form_validation->run()) {
                $id = $this->input->post('complain_id');
                $complain_type = $this->input->post('complain_type');
                $comment = $this->input->post('comment');
                $complain_ids = $this->input->post('complain_ids');

                $user_id = $this->data['user']['id'];

                $column_name = ($complain_type == 'company') ? 'company_id' : 'profile_id';


                $this->db->insert('wc_complain_profile_and_company', [
                    $column_name => $id,
                    'user_id' => $user_id,
                    'reason_ids' => (!empty($complain_ids)) ? json_encode($complain_ids) : null,
                    'comment' => $comment,
                ]);


                $response = [
                    'type'    => 'success',
                    'message' => 'Reported successfully!'
                ];
            } else {
                $response = [
                    'type'    => 'danger',
                    'message' => 'Please, fill all required inputs'
                ];
            }

            echo json_encode($response);
        } else {
            $this->data['new_page'] = 1;
            $this->data['active_menu'] = 3;
            $this->data['sub_menu'] = 2;

            $this->data['title']       = translate('title_account');

            $user_id = $this->data['user']['id'];

            $check_type = ((isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] == 2) || isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 2) ? 2 : 1;

            $check_search = (isset($_POST['search_user']) && !empty($_POST['search_user'])) ? $_POST['search_user'] : "";
            $blocked_users = ($check_type == 2) ? $this->User_model->getBlockedCompanies($user_id, $check_search) : $this->User_model->getBlockedUsers($user_id, $check_search);

            if ($check_search) {
                echo json_encode(['data' => $blocked_users]);
                exit;
            }

            $this->data['blocked_users'] = $blocked_users;

            $this->data['check_type'] = $check_type;

            $this->template->render('profile/blocked_users');
        }
    }

    public function interests()
    {
        $this->data['active_menu'] = 4;
        $this->data['title']       = translate('title_interest');

        $user = $this->data['UserData'];


        if ($this->input->method() == 'post') {
            $continent    = $this->input->post('continent');
            $country      = $this->input->post('country');
            $product_type = $this->input->post('product_type');
            $status       = $this->input->post('status');
            $standart     = $this->input->post('standart');

            //$this->debug($this->input->post());

            $continent_key = [];
            if (!empty($continent)) {
                foreach ($continent as $key => $value) {
                    $continent_key[$key] = $value;
                }
            }

            $country_key = [];
            if (!empty($country)) {
                foreach ($country as $key => $value) {
                    $country_key[$key] = $value;
                }
            }

            $product_type_key = [];
            if (!empty($product_type)) {
                foreach ($product_type as $key => $value) {
                    $product_type_key[$key] = $value;
                }
            }

            $status_key = [];
            if (!empty($status)) {
                foreach ($status as $key => $value) {
                    $status_key[$key] = $value;
                }
            }

            $standart_key = [];
            if (!empty($standart)) {
                foreach ($standart as $key => $value) {
                    $standart_key[$key] = $value;
                }
            }

            if (!empty($continent_key)) {

                $delete_interests = $this->User_model->delete_interests($user->id, $user->company_id);
                $this->User_model->delete_any('wc_user_interests_continent', ['user_id' => $user->id, 'company_id' => $user->company_id]);
                $this->User_model->delete_any('wc_user_interests_country', ['user_id' => $user->id, 'company_id' => $user->company_id]);
                $this->User_model->delete_any('wc_user_interests_product_type', ['user_id' => $user->id, 'company_id' => $user->company_id]);
                $this->User_model->delete_any('wc_user_interests_status', ['user_id' => $user->id, 'company_id' => $user->company_id]);
                $this->User_model->delete_any('wc_user_interests_standart', ['user_id' => $user->id, 'company_id' => $user->company_id]);
                foreach ($continent_key as $key => $value) {
                    /* $continent_text */
                    if (isset($value)) {
                        $continent_text = implode(",", $value);
                        foreach ($value as $konti) {
                            $konti_data = [
                                'user_id'      => $user->id,
                                'company_id'      => $user->company_id,
                                'continent_id' => $konti
                            ];
                            $this->User_model->insert_any('wc_user_interests_continent', $konti_data);
                        }
                    } else {
                        $continent_text = '';
                    }

                    /* $country_text */
                    if (isset($country_key[$key])) {
                        $country_text = implode(",", $country_key[$key]);
                        foreach ($country_key[$key] as $countries) {
                            $countries_data = [
                                'user_id'      => $user->id,
                                'company_id'      => $user->company_id,
                                'country_id' => $countries
                            ];
                            $this->User_model->insert_any('wc_user_interests_country', $countries_data);
                        }
                    } else {
                        $country_text = '';
                    }

                    /* $product_type_text */
                    if (isset($product_type_key[$key])) {
                        $product_type_text = implode(",", $product_type_key[$key]);
                        foreach ($product_type_key[$key] as $product_typies) {
                            $product_typies_data = [
                                'user_id'      => $user->id,
                                'company_id'      => $user->company_id,
                                'product_type_id' => $product_typies
                            ];
                            $this->User_model->insert_any('wc_user_interests_product_type', $product_typies_data);
                        }
                    } else {
                        $product_type_text = '';
                    }

                    /* $status_text */
                    /*if ( isset( $status_key[ $key ] ) ) {
                        $status_text = implode( ",", $status_key[ $key ] );
                        foreach ( $status_key[ $key ] as $stat ) {
                            $stat_data = [
                                'user_id'  => $this->data['user']['id'],
                                'group_id' => $stat
                            ];
                            $this->User_model->insert_any( 'wc_user_interests_status', $stat_data );
                        }
                    } else {
                        $status_text = '';
                    }*/

                    /* $standart_key */
                    if (isset($standart_key[$key])) {
                        $standart_text = implode(",", $standart_key[$key]);
                        foreach ($standart_key[$key] as $stand) {
                            $stand_data = [
                                'user_id'      => $user->id,
                                'company_id'      => $user->company_id,
                                'standart_id' => $stand
                            ];
                            $this->User_model->insert_any('wc_user_interests_standart', $stand_data);
                        }
                    } else {
                        $standart_text = '';
                    }
                    $data             = [
                        'user_id'      => $user->id,
                        'company_id'      => $user->company_id,
                        'continent'    => $continent_text,
                        'country'      => $country_text,
                        'product_type' => $product_type_text,
                        'status'       => $status_text,
                        'standart'     => $standart_text
                    ];
                    $insert_interests = $this->User_model->insert_interests($data);
                }
            }
        }
        $this->data['get_your_interests'] = $this->User_model->get_your_interests(['*'], ['user_id' => $user->id, 'company_id' => $user->company_id]);
        //$this->debug($this->data['get_your_interests']);
        $this->template->render('profile/interests');
    }

    public function products()
    {
        $this->data['title'] = translate('title');
        redirect(site_url_multi('/product'), 'location');
    }

    public function tenders()
    {
        $this->data['title'] = translate('title');
        redirect(site_url_multi('/tender'), 'location');
    }

    public function changeCompanyName()
    {
        if ($this->input->method() == 'post') {

            /* $user = $this->data['UserData'];
             $user_id=$user->id;
             $company_id=$user->company_id;*/

            $user_id = $this->data['user']['id'];
            $new_company_name = $this->input->post('new_company_name');
            $company_id = $this->input->post('company_id');

            $general = [
                'user_id' => $user_id,
                'company_id' => $company_id,
                'name'    => $new_company_name,
                'status'  => 0,
                'sort'    => 1
            ];

            $comp_name = $this->input->post('new_company_name');
            if ($comp_name !== null && $comp_name != '' && $this->auth->user_exist_by_company($comp_name)) {
                echo "same";

                return false;
            }

            $companies_name = $this->Company_model->insert_company_name($general);
            if ($companies_name) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    public function changePassword()
    {
        $response = [];
        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
            $this->form_validation->set_rules('new_password', 'New password', 'trim|required');
            $this->form_validation->set_rules('re_password', 'Re new password', 'trim|required');

            if ($this->form_validation->run()) {
                $this->data['current_password'] = $this->input->post('current_password');
                $this->data['new_password'] = $this->input->post('new_password');
                $this->data['re_password'] = $this->input->post('re_password');
                $userDataFetched = $this->auth->get_user_password($this->data['user']['id']);

                $passwordHash = $this->auth->hash_password($this->data['current_password'], $this->data['user']['id']);
                $currentPasswordIsCorrect = $this->auth->verify_password($this->data['current_password'], $userDataFetched->pass);

                if ($currentPasswordIsCorrect) {
                    if ($this->data['new_password'] == $this->data['re_password']) {
                        $this->data['get_user'] = $this->auth->get_user($this->data['user']['id']);
                        if ($this->data['get_user']) {
                            $updata_user = $this->auth->update_user($this->data['user']['id'], $this->data['get_user']->email, $this->data['new_password']);
                            if ($updata_user) {
                                $response = [
                                    'type' => 'success',
                                    'message' => 'You password is changed !'
                                ];


                                $setting_user = $this->User_model->account_settings('ntf_comp_email,ntf_comp_sms', array('user_id' => $this->data['user']['id']));


                                if ($setting_user[0]['ntf_comp_email'] == 1) {

                                    $mail = $this->phpmailer_library->load();
                                    //Server settings
                                    // $mail->SMTPDebug = 2;
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.yandex.com';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'support@makromedicine.com';
                                    $mail->Password = '72880105m';
                                    $mail->SMTPSecure = 'tls';
                                    $mail->SMTPOptions = array(
                                        'ssl' => array(
                                            'verify_peer' => false,
                                            'verify_peer_name' => false,
                                            'allow_self_signed' => true
                                        )
                                    );
                                    $mail->Port = 587;


                                    $message = "<h4>Hi " . $this->data['get_user']->company_name . "</h4>";
                                    $message .= 'Your password has been changed on ' . date('m/d/Y h:i:s a', time()) . '.<br>';


                                    $mail->setFrom('support@makromedicine.com', 'Makromedicine');
                                    $mail->addAddress($this->data['get_user']->email);
                                    $mail->addReplyTo('support@makromedicine.com');

                                    // Content
                                    $mail->isHTML(true);
                                    $mail->Subject = 'Password Change';
                                    $mail->Body = $message;

                                    $mail->send();
                                }

                                if ($setting_user[0]['ntf_comp_sms'] == 1) {
                                }
                            } else {
                                $response = [
                                    'type' => 'danger',
                                    'message' => 'System error please try again !'
                                ];
                            }
                        }
                    } else {
                        $response = [
                            'type' => 'danger',
                            'message' => 'Passwords do not match'
                        ];
                    }
                } else {
                    $response = [
                        'type'    => 'danger',
                        'message' => 'Current Password is wrong'
                    ];
                }
            } else {
                $response = [
                    'type'    => 'danger',
                    'message' => validation_errors()
                ];
            }
        } else {
            $response = [
                'type'    => 'danger',
                'message' => 'System error please try again !'
            ];
        }
        echo json_encode($response);
    }

    public function comfirmAccount()
    {
        $response = [];
        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('company_id', 'company_id', 'trim|required');
            $this->form_validation->set_rules('info', 'Info', 'trim|required');

            $user = $this->data['UserData'];



            $user_id = $user->id;

            if ($this->form_validation->run()) {
                $info = $this->input->post('info');
                $company_id = $this->input->post('company_id');

                if (!empty($_FILES['certifcate']['name'])) {
                    $directory               = DIR_IMAGE . 'catalog/certifcate';
                    $config                  = array();
                    $config['upload_path']   = $directory;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
                    $config['overwrite']     = false;

                    $this->load->library('upload');

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('certifcate')) {
                        $response = [
                            'type'    => 'danger',
                            'message' => $this->upload->display_errors()
                        ];
                    } else {
                        $general = [
                            'user_id' => $user_id,
                            'company_id' => $company_id,
                            'info'    => $info,
                            'image'   => $this->upload->data()['file_name'],
                            'status'  => 0,
                            'sort'    => 1
                        ];


                        $this->User_model->delete_certificate($user_id, $company_id);
                        $insert_certificate = $this->User_model->insert_certificate($general);
                        if ($insert_certificate) {
                            $response = [
                                'type'    => 'success',
                                'message' => 'Your information has been sent successfully. We will send your information but after checking'
                            ];
                        } else {
                            $response = [
                                'type'    => 'danger',
                                'message' => validation_errors()
                            ];
                        }
                    }
                } else {
                    $response = [
                        'type'    => 'danger',
                        'message' => 'Please select cerifcate'
                    ];
                }
            } else {
                $response = [
                    'type'    => 'danger',
                    'message' => validation_errors()
                ];
            }
        } else {
            $response = [
                'type'    => 'danger',
                'message' => 'System error please try again !'
            ];
        }
        echo json_encode($response);
    }

    public function importer()
    {
        die();
        $this->data['users'] = $this->User_model->getLastUser();
        echo '<pre>';
        foreach ($this->data['users'] as $key => $value) {
            if ($value['type'] == 1) {
                $type = 2;
            } else if ($value['type'] == 2) {
                $type = 3;
            } else if ($value['type'] == 3) {
                $type = 4;
            } else if ($value['type'] == 4) {
                $type = 5;
            } else if ($value['type'] == 5) {
                $type = 6;
            }

            $array       = array(
                'id'                 => $value['id'],
                'user_groups_id'     => $type,
                'fullname'           => $value['name'] . "" . $value['lastname'],
                'email'              => $value['email'],
                'pass'               => '$2y$10$0T6bYhs/PgzeTFl79EEHk.iPgXKsM3zXTSVOFUPZXt5KAR3m4NUbS',
                'phone'              => $value['phone'],
                'username'           => $value['login'],
                'country_id'         => $value['country'],
                'product_type'       => json_encode(explode(',', $value['atc'])),
                'company_name'       => $value['work'],
                'company_info'       => $value['company_info'],
                'tags'               => $value['tags'],
                'adress'             => $value['address'],
                'website'            => $value['web'],
                'standart'           => json_encode(explode(',', $value['standart'])),
                'facebook'           => $value['fb'],
                'twitter'            => $value['tw'],
                'youtube'            => $value['yt'],
                'linkedin'           => $value['lk'],
                'lat'                => $value['lat'],
                'lng'                => $value['log'],
                'establishment_date' => $value['birthday'],
                'banned'             => 0,
                'status'             => $value['checked']
            );
            $insert_user = $this->User_model->insert_user($array);

            /*
             * Manufacturer 1
             * Distributor  2
             * Agent        3
             * Manager      4
             * User         5
             */

            if ($insert_user) {
                $sxf = array(
                    'user_id'  => $insert_user,
                    'group_id' => $type
                );

                $INSERT_GROUP = $this->User_model->insert_user_to_group($sxf);
            }
        }

        //$this->debug($this->data['users']);
    }

    public function country()
    {
        if ($this->input->method() == 'post') {
            $continent_id = $this->input->post('continent_id');
            $this->debug($this->input->post());
        }
    }

    public function delete_interest()
    {
        if ($this->input->method() == 'post') {
            $id  = $this->input->post('id');
            $del = $this->User_model->delete_interest($id);
            die(json_encode($del));
        }
    }

    public function checkCompanyExistenceAndOwnerShip($user_id, $company_name)
    {
        // Check Existence
        $data = $this->data['UserData'];
        if ($data) {
            if ($data->id == $user_id) {
                // echo "Page owner";
                return 1;
            } else {
                // echo "Not page Owner";
                return 2;
            }
        } else {
            // echo "create page";
            return 3;
        }
    }
}
