<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Group_model');
        $this->load->helper('extra');
        $this->load->library("phpmailer_library");

    }

    public function index()
  {
        $this->data['title'] = translate('index_title');
        $this->data['subtitle'] = translate('index_description');

        $this->data['buttons'][] = [
            'type' => 'a',
            'text' => translate('header_button_create', true),
            'href' => site_url($this->directory . $this->controller . '/create'),
            'class' => 'btn btn-success btn-labeled heading-btn',
            'id' => '',
            'icon' => 'icon-plus-circle2'
        ];

        $this->data['buttons'][] = [
            'type' => 'button',
            'text' => translate('header_button_delete', true),
            'href' => site_url($this->directory . $this->controller . '/delete'),
            'class' => 'btn btn-danger btn-labeled heading-btn',
             'id' => 'deleteSelectedItems',
          'icon' => 'icon-trash',
          'additional' => [
            'data-href' => site_url($this->directory . $this->module_name . '/delete')
        ]
        ];


        // Table Column
        $this->data['fields'] = ['wc_users.id', 'wc_users.fullname',  'wc_users.email','wc_users.country_id', 'wc_users.last_activity', 'wc_users.isvisible','wc_users.process', 'wc_users.verification_code'/*,'count(wc_product.id) pr_count'*/];



        if($this->data['fields'])
        {
            foreach ($this->data['fields'] as $field) {
                $this->data['columns'][$field] = [
                    'table' => [
                        $this->data['current_lang'] => translate('table_head_' . str_replace('wc_users.','',$field))
                    ]
                ];
                
            }
        }

     
                //Show Fields

        if ($this->input->get('fields')) {
            $this->data['fields'] = $this->input->get('fields');
            $this->session->set_userdata($this->controller . '_fields', $this->input->get('fields'));
        } elseif ($this->session->has_userdata($this->controller . '_fields')) {
            $this->data['fields'] = $this->session->userdata($this->controller . '_fields');
        } else {
            $this->data['fields'] = array_keys($this->data['columns']);
        }
        foreach ($this->data['fields'] as $field) {
            $columns[$field] = $this->data['columns'][$field];
        }



        $columns['pr_count'] = [
                    'table' => [
                        $this->data['current_lang'] => 'Products'
                    ]
                    ]; 
      

        $this->data['search_field'] = [
            'name' => [
                'property' => 'search',
                'type' => 'search',
                'name' => 'name',
                'class' => 'form-control',
                'value' => $this->input->get('name'),
                'placeholder' => translate('search_placeholder', true),
            ]
        ];

        //Filter
        $filter = [];
        if ($this->input->get('banned') != NULL) {
            $filter['banned'] = $this->input->get('banned');
        }
        if ($this->input->get('status') != NULL) {
            $filter['status'] = $this->input->get('status');
        }
        if ($this->input->get('name') != NULL) {
            $filter['( fullname like "%'.$this->input->get('name').'%" or email like "%'.$this->input->get('name').'%")'] = NULL;
        }


        $sort = [
            'column' => ($this->input->get('column') && $this->input->get('column')!='pr_count') ? $this->input->get('column') : 'id',
            'order' => ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
        ];


        $this->data['total_rows'] = $this->{$this->model}->filter($filter)->get_count_rows();
        $segment_array = $this->uri->segment_array();
        $page = (ctype_digit(end($segment_array))) ? end($segment_array) : 0;

        if ($this->input->get('per_page')) {
            $this->data['per_page'] = (int) $this->input->get('per_page');

            ${$this->controller . '_per_page'} = (int) $this->input->get('per_page');
            $this->session->set_userdata($this->controller . '_per_page', ${$this->controller . '_per_page'});
        } elseif ($this->session->has_userdata($this->controller . '_per_page')) {
            $this->data['per_page'] = $this->session->userdata($this->controller . '_per_page');
        } else {
            $this->data['per_page'] = 10;
        }

        $this->data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';


       
        $total_rows = $this->{$this->model}->where($filter)->count_rows();
        $pg = $page-1;
        if($pg <0 )$pg=0;
       // $filter['(wc_product.user_id is null or wc_product.user_id is not null)']=null;
       // $filter['(wc_product.deleted_at is null)']=null;
       // $rows = $this->{$this->model}->fields($this->data['fields'])->join('wc_product', 'wc_product.user_id = wc_users.id','left')->filter($filter)->order_by($sort['column'], $sort['order'])->group_by('wc_users.id')->limit($this->data['per_page'], $this->data['per_page']*($pg))->all();
        $rows = $this->{$this->model}->fields($this->data['fields'])->filter($filter)->order_by($sort['column'], $sort['order'])->limit($this->data['per_page'], $this->data['per_page']*($pg))->all();
        if($rows)
    foreach ($rows as $key => $value) {
        $rows->$key->pr_count = 0;
        $pr_count_a = $this->db->where(['deleted_at'=>NULL,'user_id'=>$value->id])->from('wc_product')->count_all_results();
        $pr_count_d = $this->db->where(['deleted_at'=>NULL,'user_id'=>$value->id,'checked'=>0])->from('wc_product')->count_all_results();
        $pr_count_d = ($pr_count_d>0)? '<span style="color:red">'.$pr_count_d.'</span>' : $pr_count_d;
        if(is_numeric($pr_count_a)) $rows->$key->pr_count = $pr_count_a.'/'.$pr_count_d;

        $country_name = $this->db->where(['country_id'=>$value->country_id])->from('wc_country_translation')->get()->result();
        if($country_name && !empty($country_name))
        $value->country_id = $country_name[0]->name;

        if($value->process == '1') $value->process = '<select class="selectpicker changeProcess" data-id="'.$value->id.'">
        <option value="0" data-content="<span class=\'label label-default\'>No action</span>" >No action</option>
        <option value="1" data-content="<span class=\'label label-warning\'>Mail sent</span>" selected>Mail sent</option>
        <option value="2" data-content="<span class=\'label label-success\'>Pass Changed</span>" >Pass Changed</option>
        <option value="3" data-content="<span class=\'label label-info\'>User Register</span>" >User Register</option>
        </select>';
        else if($value->process == '2') $value->process = '<select class="selectpicker changeProcess" data-id="'.$value->id.'">
        <option value="0" data-content="<span class=\'label label-default\'>No action</span>" >No action</option>
        <option value="1" data-content="<span class=\'label label-warning\'>Mail sent</span>">Mail sent</option>
        <option value="2" data-content="<span class=\'label label-success\'>Pass Changed</span>" selected >Pass Changed</option>
        <option value="3" data-content="<span class=\'label label-info\'>User Register</span>" >User Register</option>
        </select>';
        else if($value->process == '3') $value->process = '<select class="selectpicker changeProcess" data-id="'.$value->id.'">
        <option value="0" data-content="<span class=\'label label-default\'>No action</span>" >No action</option>
        <option value="1" data-content="<span class=\'label label-warning\'>Mail sent</span>" >Mail sent</option>
        <option value="2" data-content="<span class=\'label label-success\'>Pass Changed</span>" >Pass Changed</option>
        <option value="3" data-content="<span class=\'label label-info\'>User Register</span>" selected>User Register</option>
        </select>';
        else $value->process = '<select class="selectpicker changeProcess" data-id="'.$value->id.'">
        <option value="0" data-content="<span class=\'label label-default\'>No action</span>" selected>No action</option>
        <option value="1" data-content="<span class=\'label label-warning\'>Mail sent</span>" >Mail sent</option>
        <option value="2" data-content="<span class=\'label label-success\'>Pass Changed</span>" >Pass Changed</option>
        <option value="3" data-content="<span class=\'label label-info\'>User Register</span>" >User Register</option>
        </select>';

        $value->verification_code = '<a href="'.base_url('authentication/password/').$value->verification_code.'"  class="btn btn-copy-link btn-default" data-id="'.$value->id.'" title="Copy Password Reset Url">Copy Url</a>';
    }
    else $rows=array();

    if  ($this->input->get('column') && $this->input->get('column')=='pr_count'){
        $rows_array = (array) $rows;

        usort($rows_array, function($a, $b) {
                return $a->pr_count - $b->pr_count;
            });

       if($this->input->get('order') && $this->input->get('order') == 'DESC')
          $rows_array = array_reverse($rows_array);

        $rows = (object) $rows_array;
    }

      //  print_r($this->db->last_query());   

        $action_buttons = [
            'edit'      => TRUE,
            'delete'    => TRUE,
            'sender'    => TRUE,
            'login_cms'    => TRUE
        ];


        $custom_rows_data = [
        [
                  'column' => 'isvisible',
                  'callback' => 'get_status',
                  'params' => false
              ]
        ];

        $this->wc_table->set_module(false);
        $this->wc_table->set_columns($columns);
        $this->wc_table->set_rows($rows);
        $this->wc_table->set_custom_rows($custom_rows_data);
        $this->wc_table->set_action($action_buttons);
        $this->data['table'] = $this->wc_table->generate();




        //Pagination
        $config['base_url'] = site_url_multi($this->directory . $this->controller . '/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->data['per_page'];
        $config['reuse_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['breadcrumb_links'][] = [
            'text' => translate('breadcrumb_link_all', true),
            'href' => site_url($this->directory . $this->controller),
            'icon_class' => 'icon-database position-left',
            'label_value' => $this->{$this->model}->get_count_rows(),
            'label_class' => 'label label-primary position-right'
        ];

        $this->data['breadcrumb_links'][] = [
            'text' => translate('breadcrumb_link_active', true),
            'href' => site_url($this->directory . $this->controller . '?status=1'),
            'icon_class' => 'icon-shield-check position-left',
            'label_value' => $this->{$this->model}->filter(['status' => 1, 'checked'=>1])->get_count_rows(),
            'label_class' => 'label label-success position-right'
        ];

        $this->data['breadcrumb_links'][] = [
            'text' => translate('breadcrumb_link_deactive', true),
            'href' => site_url($this->directory . $this->controller . '?status=0'),
            'icon_class' => 'icon-shield-notice position-left',
            'label_value' => $this->{$this->model}->filter(['status!=1 or checked!=1'=>NULL])->get_count_rows(),
            'label_class' => 'label label-warning position-right'
        ];

     
        $this->data['breadcrumb_links'][] = [
            'text' => translate('breadcrumb_link_trash', true),
            'href' => site_url($this->directory . $this->controller . '/trash'),
            'icon_class' => 'icon-trash position-left',
            'label_value' => $this->{$this->model}->filter(['deleted_at is NOT NULL'=>NULL])->get_count_rows(true),
            'label_class' => 'label label-danger position-right'
        ];

        $this->template->render();
  }

  public function login_cms($user_id){
  $login = $this->auth->login_cms($user_id);
    if($login){
         redirect('profile', 'refresh');
    }
  }

    public function create()
    {
        $this->data['title']    =   translate('create_title');
        $this->data['subtitle'] =   translate('create_description');

        $groups = $this->Group_model->get_rows('id,name',[]);
        $group = [];
        foreach ($groups as $item) {
            $group[''] =    translate('form_please_select');
            $group[$item['id']] = $item['name'];
        }

        $this->data['form_field']['general'] = [
               /*'company_name'      => [
                'property'      => 'text',
                'id'            => 'company_name',
                'name'          => 'company_name',
                'class'         => 'form-control',
                'value'         => set_value('company_name'),
                'label'         =>  'Company Name',
                'placeholder'   =>  'Company Name',
                'validation'    => ['rules' => '']
            ],*/
            'fullname'      => [
                'property'      => 'text',
                'id'            => 'fullname',
                'name'          => 'fullname',
                'class'         => 'form-control',
                'value'         => set_value('fullname'),
                'label'         => 'Full Name',
                'placeholder'   => 'Full Name',
                'validation'    => ['rules' => 'required']
            ],
            'email'     => [
                'property'      => 'text',
                'type'          => 'email',
                'id'            => 'email',
                'name'          => 'email',
                'class'         => 'form-control',
                'value'         => set_value('email'),
                'label'         =>  translate('form_label_email'),
                'placeholder'   =>  translate('form_placeholder_email'),
                'validation'    => ['rules' => 'required|valid_email']
            ],
            'group_id'  => [
                'property'      => 'dropdown',
                'name'          => 'group_id',
                'id'            => 'group_id',
                'label'         =>  translate('form_label_group'),
                'class'         => 'bootstrap-select',
                'data-style'    => 'btn-default btn-xs',
                'data-width'    => '100%',
                'options'       => $group,
                'selected'      => set_value('group_id'),
                'validation'    => ['rules' => 'required']
            ],
           
            'password'      => [
                'property'      => 'text',
                'type'          => 'password',
                'id'            => 'password',
                'name'          => 'password',
                'class'         => 'form-control',
                'value'         => set_value('password'),
                'label'         =>  translate('form_label_password'),
                'placeholder'   =>  translate('form_placeholder_password'),
                'validation'    => ['rules' => 'required']
            ]
        ];

        foreach ($this->data['form_field']['general'] as $key => $value)
        {
            $this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
        }

        $this->data['buttons'][] = [
            'type'      => 'button',
            'text'      => translate('form_button_save',true),
            'class'     => 'btn btn-primary btn-labeled heading-btn',
            'id'        => 'save',
            'icon'      => 'icon-floppy-disk',
            'additional' => [
                'onclick'   => "confirm('Are you sure?') ? $('#form-save').submit() : false;",
                'form'      => 'form-save',
                'formaction'=> current_url()
            ]
        ];

        $this->breadcrumbs->push(translate('create_title'), $this->directory.$this->controller.'/create');

        if($this->input->method() == 'post')
        {
            if ($this->form_validation->run() == TRUE)
            {
                $general = [
                    'company_name'  => $this->input->post('company_name'),
                    'fullname'  => $this->input->post('fullname'),
                    'email'     => $this->input->post('email'),
                    'password'  => $this->input->post('password'),
                    'group_id'  => $this->input->post('group_id')
                ];

                $usname = uniqid();

                $user_id = $this->auth->create_user($general['email'],$general['password'],$usname,$general['firstname'],$general['lastname'],$general['group_id']);
                if($user_id){
                    redirect(site_url_multi($this->directory.$this->controller));
                }
            }
            else
            {
                $this->data['message'] = translate('error_warning',true);
            }
        }

        $this->template->render($this->controller . '/form');
    }

    public function edit($id)
    {
        if($id && ctype_digit($id))
        {
            $this->data['general'] = $this->{$this->model}->filter(['id'=>$id])->one();
            if($this->data['general'])
            {
                //Set title & description
                $this->data['title']    =   translate('edit_title');
                $this->data['subtitle'] =   translate('edit_description');

                // Set General Form Field
                $groups = $this->Group_model->get_rows('id,name',[]);
                $group = [];
                foreach ($groups as $item) {
                    $group[''] =    translate('form_please_select');
                    $group[$item['id']] = $item['name'];
                }

                // selected group
                $user_group = $this->{$this->model}->get_user_group(['user_id'=>$id],'*');
                if($user_group){
                    $user_group = $user_group[0]['group_id'];
                }
                $this->data['form_field']['general'] = [
                      /*'company_name'      => [
                'property'      => 'text',
                'id'            => 'company_name',
                'name'          => 'company_name',
                'class'         => 'form-control',
                'value'         => (set_value('company_name')) ? set_value('company_name') : $this->data['general']->company_name,
                'label'         =>  'Company Name',
                'placeholder'   =>  'Company Name',
                'validation'    => ['rules' => '']
            ],*/
                    'fullname'      => [
                        'property'      => 'text',
                        'id'            => 'fullname',
                        'name'          => 'firstname',
                        'class'         => 'form-control',
                        'value'         => (set_value('fullname')) ? set_value('fullname') : $this->data['general']->fullname,
                        'label'         =>  translate('form_label_firstname'),
                        'placeholder'   =>  translate('form_placeholder_firstname'),
                        'validation'    => ['rules' => 'required']
                    ],
                    'email'     => [
                        'property'      => 'text',
                        'type'          => 'email',
                        'id'            => 'email',
                        'name'          => 'email',
                        'class'         => 'form-control',
                        'value'         => (set_value('email')) ? set_value('email') : $this->data['general']->email,
                        'label'         =>  translate('form_label_email'),
                        'placeholder'   =>  translate('form_placeholder_email'),
                        'validation'    => ['rules' => 'required|valid_email']
                    ],
                    'group_id'  => [
                        'property'      => 'dropdown',
                        'name'          => 'group_id',
                        'id'            => 'group_id',
                        'label'         =>  translate('form_label_group'),
                        'class'         => 'bootstrap-select',
                        'data-style'    => 'btn-default btn-xs',
                        'data-width'    => '100%',
                        'options'       => $group,
                        'selected'      => (set_value('group_id')) ? set_value('group_id') : $user_group,
                        'validation'    => ['rules' => 'required']
                    ],
                  
                        'status' => [
              'property'        => 'dropdown',
              'name'              => 'status',
              'id'              => 'status',
              'label'         => 'STATUS',
              'class'         => 'select2 select-search bootstrap-select',
              'options'         => [translate('disable', true), translate('enable', true)],
              'selected'        => (set_value('status')) ? set_value('status') : $this->data['general']->status,
              'validation'  => ['rules' => 'required']
                ],

                        'isvisible' => [
              'property'        => 'dropdown',
              'name'              => 'isvisible',
              'id'              => 'isvisible',
              'label'         => 'Hidden',
              'class'         => 'select2 select-search bootstrap-select',
              'options'         => [translate('disable', true), translate('enable', true)],
              'selected'        => (set_value('isvisible')) ? set_value('isvisible') : $this->data['general']->isvisible,
              'validation'  => ['rules'=>'']
                ],
                    'password'      => [
                        'property'      => 'text',
                        'type'          => 'password',
                        'id'            => 'password',
                        'name'          => 'password',
                        'class'         => 'form-control',
                        'value'         => set_value('password'),
                        'label'         =>  translate('form_label_password'),
                        'placeholder'   =>  translate('form_placeholder_password'),
                        'validation'    => ['rules' => '']
                    ]
                ];

                // Set Form Validation General Form Field
                foreach ($this->data['form_field']['general'] as $key => $value)
                {
                    $this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
                }


                $this->data['buttons'][] = [
                    'type'      => 'button',
                    'text'      => translate('form_button_save',true),
                    'class'     => 'btn btn-primary btn-labeled heading-btn',
                    'id'        => 'save',
                    'icon'      => 'icon-floppy-disk',
                    'additional' => [
                        'onclick'   => "confirm('Are you sure?') ? $('#form-save').submit() : false;",
                        'form'      => 'form-save',
                        'formaction'=> current_url()
                    ]
                ];

                $this->breadcrumbs->push(translate('edit_title'), $this->directory.$this->controller.'/edit');

                if($this->input->method() == 'post' && $this->form_validation->run() == TRUE)
                {
                    $general = [
                        'firstname'  => $this->input->post('firstname'),
                        'email'     => $this->input->post('email'),
                        'password'  => $this->input->post('password'),
                        'group_id'  => $this->input->post('group_id'),
                        'status'  => $this->input->post('status'),
                        'isvisible'  => $this->input->post('isvisible')
                    ];
                    $usname = uniqid();
                    $response = $this->auth->update_user($id, $general['email'],$general['password'],$usname,$general['firstname'],$general['group_id'],$general['status'],$general['isvisible']);
                   // echo 'fucking status '.$general['status'];
                   redirect(site_url_multi($this->directory.$this->controller));
                }
                else
                {
                    $this->data['message'] = translate('error_warning',true);
                     $this->template->render($this->controller . '/form');
                }
            }
            else
            {
                show_404();
            }
        }
        else
        {
            show_404();
        }

    }


    public function sender($id = false)
    {

    $mail = $this->phpmailer_library->load();
           
    //Server settings
    //$mail->SMTPDebug = 2;                                     
    $mail->isSMTP();                                         
    $mail->Host       = 'smtp.yandex.com';         
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'support@makromedicine.com'; 
    $mail->Password   = '72880105m';   
    $mail->SMTPSecure = 'tls';     
    $mail->SMTPOptions = array (
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true)
        );                             
    $mail->Port = 587;   

    $this->data['user_other_data']=array();

        if($id && ctype_digit($id))
        {

            $this->data['person_info']    = json_decode($this->auth->get_user_var('person',$id));
            $this->data['company_info']   = json_decode($this->auth->get_user_var('company',$id));
            if(!is_array($this->data['person_info'])) $this->data['person_info']=array();
            if(!is_array($this->data['company_info'])) $this->data['company_info']=array();
            $user_other_data = array_merge( $this->data['person_info'],  $this->data['company_info']);
            
            foreach ($user_other_data as $key => $value) {
                $this->data['user_other_data'][]=$value->email;
            }
            $this->data['user_other_data']=array_unique($this->data['user_other_data']);            
            //print_r($this->data['person_info']);

            $this->data['general'] = $this->{$this->model}->filter(['id'=>$id])->one();
            if($this->data['general'])
            {
                $this->data['title']    =   translate('send_title');
                $this->data['subtitle'] =   translate('send_description');

                $groups = $this->Group_model->get_rows('id,name',[]);
                $group = [];
                foreach ($groups as $item) {
                    $group[''] =    translate('form_please_select');
                    $group[$item['id']] = $item['name'];
                }

                $user_group = $this->{$this->model}->get_user_group(['user_id'=>$id],'*');
                if($user_group){
                    $user_group = $user_group[0]['group_id'];
                }

              $message = $this->emailTemplate();

              $message = str_replace('%companyname',get_company_name($id)->company_name, $message);


                $this->data['form_field']['general'] = [
                    'email'     => [
                            'property'          => 'text',
                            'type'                  => 'email',
                            'id'                => 'email',
                            'name'          => 'email',
                    'class'                 => 'form-control',
                    'value'         => (set_value('email')) ? set_value('email') : $this->data['general']->email,
                        'label'                 =>  translate('form_label_email'),
                    'placeholder'       =>  translate('form_placeholder_email'),
                    'validation'        => ['rules' => 'required']
                    ],
                        'newemail'      => [
                            'property'      => 'text',
                            'type'              => 'email',
                            'id'            => 'email',
                            'name'        => 'newemail',
                    'class'             => 'form-control',
                    'value'       =>  set_value('newemail'),
                        'label'             =>  translate('form_label_newemail'),
                    'placeholder'   =>  translate('form_placeholder_newemail'),
                    'validation'    => ['rules' => 'required']
                    ],
                        'description'       => [
                            'property'      => 'textarea',
                            'type'              => 'text',
                            'id'            => 'description',
                            'name'        => 'description',
                    'class'             => 'form-control editor',
                    'value'       =>  $message,
                        'label'             =>  translate('form_label_description'),
                    'placeholder'   =>  translate('form_placeholder_description'),
                    'validation'    => ['rules' => '']
                    ]
                ];
                foreach ($this->data['form_field']['general'] as $key => $value)
                {
                    $this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
                }
                $this->data['buttons'][] = [
                    'type'      => 'button',
                    'text'      => translate('form_button_save',true),
                    'class'     => 'btn btn-primary btn-labeled heading-btn',
                    'id'        => 'save',
                    'icon'      => 'icon-floppy-disk',
                    'additional' => [
                        'onclick'   => "confirm('Are you sure?') ? $('#form-save').submit() : false;",
                        'form'      => 'form-save',
                        'formaction'=> current_url()
                    ]
                ];
                $this->breadcrumbs->push(translate('edit_title'), $this->directory.$this->controller.'/edit');

                $sentemail = $this->db->where('user_id',$id)->order_by('id','DESC')->get('wc_emailsender');
                foreach($sentemail->result() as $sentemail_data){
                    if($sentemail_data){
                        $this->data['oldemail'] = $sentemail_data->email;
                        break;
                    }
                }

                if($this->input->method() == 'post' && $this->form_validation->run() == TRUE)
                {
            $response = $this->User_model->save_fcm($id , ['email'=>$this->input->post('newemail')]);

                        if($response){
                            $general = [
                                'user_id'           => $id,
                                'email'         => $this->input->post('email'),
                                'newemail'    => $this->input->post('newemail'),
                                'description'   => $this->input->post('description')
                            ];
                            $emailsend = $this->User_model->insert_send_email_to_database($general);
                            if($emailsend)
                            {
                                $this->data['verification_code'] = $this->auth->generate_verification_code($this->input->post('newemail'));
                              
                              //  $message = $this->input->post('description');
                                $vhref = base_url('authentication/password/').$this->data['verification_code'];

                              //  $message = str_replace('%newemail',$this->input->post('newemail'), $message);
                                
                                $message = str_replace('%vhref',$vhref, $message);

                          
                            //Recipients
                            $mail->setFrom('support@makromedicine.com');
                            $mail->addAddress($this->input->post('newemail'));     
                            $mail->addReplyTo('support@makromedicine.com');
                           
                            // Content
                            $mail->CharSet = 'UTF-8';                           
                            $mail->Subject = 'Registration approval';
                            $mail->Body    = $message;
                            $mail->isHTML(true);
                            $mail->send();


                            $this->db->set('process',1)->where('id',$id)->update('wc_users');
                            $this->mail_change($id);

                          redirect(site_url_multi($this->directory.$this->controller));
                            }
                            else
                            {
                                redirect(site_url_multi($this->directory.$this->controller));
                            }
                        }
            else{
                            redirect(site_url_multi($this->directory.$this->controller));
                        }
                }
                else
                {
                    $this->data['message'] = translate('error_warning',true);
                    $this->template->render($this->controller . '/send');
                }
            }
            else
            {
                show_404();
            }
        }
        else
        {
            $this->data['title']    =   translate('send_title');
            $this->data['subtitle'] =   translate('send_description');
            $this->data['companies']  = $this->User_model->filter(['user_groups_id IN(2,3,4)' => NULL, 'status'=>1])->fields(['id', 'company_name','email'])->all();
            $companies = [];
            foreach ($this->data['companies'] as $item) {
                $companies[''] =    translate('form_please_select');
                $companies[$item->id] = $item->company_name;
            }

             $message = $this->emailTemplate();

            

            $this->data['form_field']['general'] = [
                    'user_id'   => [
                        'property'              => 'dropdown',
                        'name'                      => 'user_id',
                        'id'                        => 'user_id',
                        'label'                     =>  translate('form_label_company'),
                        'class'                     => 'bootstrap-select',
                        'data-live-search'  => true,
                        'data-style'            => 'btn-default btn-xs',
                        'data-width'            => '100%',
                        'options'                   => $companies,
                        'selected'              => set_value('user_id'),
                        'validation'            => ['rules' => 'required']
                    ],
                    'email'     => [
                        'property'          => 'text',
                        'type'                  => 'email',
                        'id'                => 'email',
                        'name'          => 'email',
                        'class'                 => 'form-control',
                        'value'         => (set_value('email')) ? set_value('email') : '',
                        'label'                 =>  translate('form_label_email'),
                        'placeholder'       =>  translate('form_placeholder_email'),
                        'validation'        => ['rules' => 'required']
                    ],
                    'newemail'      => [
                        'property'      => 'text',
                        'type'              => 'email',
                        'id'            => 'email',
                        'name'        => 'newemail',
                        'class'             => 'form-control',
                        'value'       =>  set_value('newemail'),
                        'label'             =>  translate('form_label_newemail'),
                        'placeholder'   =>  translate('form_placeholder_newemail'),
                        'validation'    => ['rules' => 'required']
                    ],
                    'description'       => [
                        'property'      => 'textarea',
                        'type'              => 'text',
                        'id'            => 'description',
                        'name'        => 'description',
                        'class'             => 'form-control editor',
                        'value'       =>  $message,
                        'label'             =>  translate('form_label_description'),
                        'placeholder'   =>  translate('form_placeholder_description'),
                        'validation'    => ['rules' => '']
                    ]
            ];
            foreach ($this->data['form_field']['general'] as $key => $value)
            {
                $this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
            }
            $this->data['buttons'][] = [
                'type'      => 'button',
                'text'      => translate('form_button_send',true),
                'class'     => 'btn btn-primary btn-labeled heading-btn',
                'id'        => 'save',
                'icon'      => 'icon-floppy-disk',
                'additional' => [
                    'onclick'   => "confirm('Are you sure?') ? $('#form-save').submit() : false;",
                    'form'      => 'form-save',
                    'formaction'=> current_url()
                ]
            ];
            $this->breadcrumbs->push(translate('edit_title'), $this->directory.$this->controller.'/edit');
            if($this->input->method() == 'post' && $this->form_validation->run() == TRUE)
            {
                    $user_id = (int) $this->input->post('user_id');
                    $response = $this->User_model->save_fcm($user_id, ['email'=>$this->input->post('newemail')]);

                    if($response){
                            $general = [
                                'user_id'           => $this->input->post('user_id'),
                                'email'         => $this->input->post('email'),
                                'newemail'    => $this->input->post('newemail'),
                                'description'   => $this->input->post('description')
                            ];
                            $emailsend = $this->User_model->insert_send_email_to_database($general);
                            if($emailsend)
                            {
                                $this->data['verification_code'] = $this->auth->generate_verification_code($this->input->post('newemail'));
                              
                            // $message = $this->input->post('description');
                                $vhref = base_url('authentication/password/').$this->data['verification_code'];

                                $compname = get_company_name($this->input->post('user_id'))->company_name;

                               ///$message = str_replace('%newemail',$this->input->post('newemail'), $message);
                            $message = str_replace('%vhref',$vhref, $message);
                            $message = str_replace('%companyname',get_company_name($this->input->post('user_id'))->company_name, $message);

                               

                           $mail->setFrom('support@makromedicine.com');
                            $mail->addAddress($this->input->post('newemail'));     
                            $mail->addReplyTo('support@makromedicine.com');
                           
                            // Content
                            $mail->CharSet = 'UTF-8';                    
                            $mail->Subject = 'Registration approval';
                            $mail->Body    = $message;
                            $mail->isHTML(true);  
                            $mail->send();

                             $this->db->set('process',1)->where('id',$this->input->post('user_id'))->update('wc_users');
                               $this->mail_change($this->input->post('user_id'));

                          //echo $this->email->print_debugger();die();

                                redirect(site_url_multi($this->directory.$this->controller));
                        }
                        else
                        {
                            redirect(site_url_multi($this->directory.$this->controller));
                        }
                    }
                    else{
                        redirect(site_url_multi($this->directory.$this->controller));
                    }
            }
            else
            {
                $this->data['message'] = translate('error_warning',true);
                 $this->template->render($this->controller . '/send');
            }
        }
    }



    public function get_email()
    {
            if ($this->input->method() == 'post')
            {
                    $this->data['value'] = $this->input->post('value');
                    if($this->data['value'])
                    {
                        echo get_company_name($this->data['value'])->email;
                    }
                    else
                    {
                        echo 'false';
                    }
            }
    }
    public function delete($id=false)
    {
        if($id){
        
                 $this->db->where('user_id', $id);
                $this->db->from('wc_product');
               $count = $this->db->count_all_results();
               if($count == 0){
                   $this->{$this->model}->delete($id);
                   echo json_encode(['success' => 1]);
               }
               else{
                 echo json_encode(['error' => 1]);
               }
           }
           else{
            

      if ($this->input->method() == 'post') {
        $response  = ['success' => false, 'message' => translate('couldnt_delete_message',true)];
        if ($this->input->post('selected')) {
          foreach ($this->input->post('selected') as $id) {
            $this->{$this->model}->delete($id);
           // $this->insert_log($id,$this->model,'delete2');
          }
          $response = ['success' => true, 'message' => translate('successfully_delete_message',true)];
        }
        $this->template->json($response);
      }
    
      
           }
    }
    public function block($id)
    {

    }
    public function unblock($id)
    {

    }


       public function changeStatus($id=false)
    {
      $id = $this->input->post('id');
       if($id != false)
      {
      $pr = $this->db->where('id', $id)->get('wc_users')->result();
      if($pr[0]->isvisible == 1){
         $var = $this->db->set('isvisible', '0', FALSE)->where('id', $id)->update('wc_users');
          redirect(site_url_multi($this->directory . $this->controller), 'refresh');
      }
      else{

        $var = $this->db->set('isvisible', '1', FALSE)->where('id', $id)->update('wc_users');
         
      
      }
     }
    }

    public function emailTemplate(){
        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width" name="viewport"/>
<!--[if !mso]><!-->
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<!--<![endif]-->
<title></title>
<!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"/>
<!--<![endif]-->
<style type="text/css">
        body{margin:0;padding:0}table,td,tr{vertical-align:top;border-collapse:collapse}*{line-height:inherit}a[x-apple-data-detectors=true]{color:inherit!important;text-decoration:none!important}.ie-browser table{table-layout:fixed}[owa] .img-container div,[owa] .img-container button{display:block!important}[owa] .fullwidth button{width:100%!important}[owa] .block-grid .col{display:table-cell;float:none!important;vertical-align:top}.ie-browser .block-grid,.ie-browser .num12,[owa] .num12,[owa] .block-grid{width:650px!important}.ie-browser .mixed-two-up .num4,[owa] .mixed-two-up .num4{width:216px!important}.ie-browser .mixed-two-up .num8,[owa] .mixed-two-up .num8{width:432px!important}.ie-browser .block-grid.two-up .col,[owa] .block-grid.two-up .col{width:324px!important}.ie-browser .block-grid.three-up .col,[owa] .block-grid.three-up .col{width:324px!important}.ie-browser .block-grid.four-up .col [owa] .block-grid.four-up .col{width:162px!important}.ie-browser .block-grid.five-up .col [owa] .block-grid.five-up .col{width:130px!important}.ie-browser .block-grid.six-up .col,[owa] .block-grid.six-up .col{width:108px!important}.ie-browser .block-grid.seven-up .col,[owa] .block-grid.seven-up .col{width:92px!important}.ie-browser .block-grid.eight-up .col,[owa] .block-grid.eight-up .col{width:81px!important}.ie-browser .block-grid.nine-up .col,[owa] .block-grid.nine-up .col{width:72px!important}.ie-browser .block-grid.ten-up .col,[owa] .block-grid.ten-up .col{width:60px!important}.ie-browser .block-grid.eleven-up .col,[owa] .block-grid.eleven-up .col{width:54px!important}.ie-browser .block-grid.twelve-up .col,[owa] .block-grid.twelve-up .col{width:50px!important}
    </style>
<style id="media-query" type="text/css">
       @media only screen and (min-width:670px){.block-grid{width:650px!important}.block-grid .col{vertical-align:top}.block-grid .col.num12{width:650px!important}.block-grid.mixed-two-up .col.num3{width:162px!important}.block-grid.mixed-two-up .col.num4{width:216px!important}.block-grid.mixed-two-up .col.num8{width:432px!important}.block-grid.mixed-two-up .col.num9{width:486px!important}.block-grid.two-up .col{width:325px!important}.block-grid.three-up .col{width:216px!important}.block-grid.four-up .col{width:162px!important}.block-grid.five-up .col{width:130px!important}.block-grid.six-up .col{width:108px!important}.block-grid.seven-up .col{width:92px!important}.block-grid.eight-up .col{width:81px!important}.block-grid.nine-up .col{width:72px!important}.block-grid.ten-up .col{width:65px!important}.block-grid.eleven-up .col{width:59px!important}.block-grid.twelve-up .col{width:54px!important}}@media (max-width:670px){.block-grid,.col{min-width:320px!important;max-width:100%!important;display:block!important}.block-grid{width:100%!important}.col{width:100%!important}.col>div{margin:0 auto}img.fullwidth,img.fullwidthOnMobile{max-width:100%!important}.no-stack .col{min-width:0!important;display:table-cell!important}.no-stack.two-up .col{width:50%!important}.no-stack .col.num4{width:33%!important}.no-stack .col.num8{width:66%!important}.no-stack .col.num4{width:33%!important}.no-stack .col.num3{width:25%!important}.no-stack .col.num6{width:50%!important}.no-stack .col.num9{width:75%!important}.video-block{max-width:none!important}.mobile_hide{min-height:0px;max-height:0px;max-width:0px;display:none;overflow:hidden;font-size:0px}.desktop_hide{display:block!important;max-height:none!important}}
    </style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: transparent;">
<style id="media-query-bodytag" type="text/css">
@media (max-width: 670px) {
  .block-grid {
    min-width: 320px!important;
    max-width: 100%!important;
    width: 100%!important;
    display: block!important;
  }
  .col {
    min-width: 320px!important;
    max-width: 100%!important;
    width: 100%!important;
    display: block!important;
  }
  .col > div {
    margin: 0 auto;
  }
  img.fullwidth {
    max-width: 100%!important;
    height: auto!important;
  }
  img.fullwidthOnMobile {
    max-width: 100%!important;
    height: auto!important;
  }
  .no-stack .col {
    min-width: 0!important;
    display: table-cell!important;
  }
  .no-stack.two-up .col {
    width: 50%!important;
  }
  .no-stack.mixed-two-up .col.num4 {
    width: 33%!important;
  }
  .no-stack.mixed-two-up .col.num8 {
    width: 66%!important;
  }
  .no-stack.three-up .col.num4 {
    width: 33%!important
  }
  .no-stack.four-up .col.num3 {
    width: 25%!important
  }
}
</style>
<!--[if IE]><div class="ie-browser"><![endif]-->
<table bgcolor="transparent" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: transparent; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:transparent"><![endif]-->
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:transparent;width:650px; border-top: 2px solid #D4E9F9; border-left: 2px solid #D4E9F9; border-bottom: 0px solid #D4E9F9; border-right: 2px solid #D4E9F9;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:2px solid #D4E9F9; border-left:2px solid #D4E9F9; border-bottom:0px solid #D4E9F9; border-right:2px solid #D4E9F9; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div align="center" class="img-container center fixedwidth" style="padding-right: 25px;padding-left: 25px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 25px;padding-left: 25px;" align="center"><![endif]-->
<div style="font-size:1px;line-height:40px"> </div><a href="https://makromedicine.com/en/" target="_blank"> <img align="center" alt="Image" border="0" class="center fixedwidth" src="https://makromedicine.com/templates/default/assets/img/logo/logo-makromedicine.png" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; height: auto; float: none; border: none; width: 100%; max-width: 325px; display: block;" title="Image" width="325"/></a>
<div style="font-size:1px;line-height:25px"> </div>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #D6E7F0;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#D6E7F0;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:#D6E7F0"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:#D6E7F0;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
<div style="color:#052d3d;font-family:\'Lato\', Tahoma, Verdana, Segoe, sans-serif;line-height:150%;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-family: \'Lato\', Tahoma, Verdana, Segoe, sans-serif; font-size: 12px; line-height: 18px; color: #052d3d;">
<p style="font-size: 12px; line-height: 18px; margin: 0;"> </p>
<p style="font-size: 12px; line-height: 33px; text-align: center; margin: 0;"><span style="font-size: 22px;"><strong><span style="line-height: 33px; font-size: 22px;">Dear %companyname Company!</span></strong></span></p>
<p style="font-size: 12px; line-height: 33px; text-align: center; margin: 0;"><span style="font-size: 22px;">We are glad to introduce to you new pharmaceutical platform <a href="https://www.makromedicine.com" rel="noopener" style="text-decoration: underline; color: #2190E3;" target="_blank">https://www.makromedicine.com</a>. </span><br/><span style="font-size: 22px; line-height: 33px;">You can get more information about the platform from this video.</span></p>
<p style="font-size: 12px; line-height: 18px; text-align: center; margin: 0;"> </p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #D6E7F0;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#D6E7F0;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:#D6E7F0"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:#D6E7F0;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if (mso)|(IE)]><table width="650" align="center" cellpadding="0" cellspacing="0" role="presentation"><tr><td><![endif]-->
<div align="center" class="video-block" style="max-width:650px;min-width:320px;padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;">
<!--[if !vml]><!--><a class="video-preview" href="https://www.youtube.com/watch?v=6sT604EHm0o" style="background-color:#5b5f66;background-image:radial-gradient(circle at center, #5b5f66, #1d1f21);display:block;text-decoration:none;" target="_blank">
<table background="https://img.youtube.com/vi/6sT604EHm0o/maxresdefault.jpg" border="0" cellpadding="0" cellspacing="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://img.youtube.com/vi/6sT604EHm0o/maxresdefault.jpg); background-size: cover; min-height: 320px; width:650px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top" width="25%"></td>
<td align="center" style="word-break: break-word; vertical-align: middle; border-collapse: collapse;" valign="middle" width="50%">
<div class="play-button_outer" style="display:inline-block;vertical-align:middle;background-color:#FFFFFF;border:3px solid #FFFFFF;height:59px;width:59px;border-radius:100%;">
<div style="padding:14.75px 22.69230769230769px;">
<div class="play-button_inner" style="border-style:solid;border-width:15px 0 15px 20px;display:block;font-size:0;height:0;width:0;border-color:transparent transparent transparent #000000;"> </div>
</div>
</div>
</td>
<td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top" width="25%"></td>
</tr>
</tbody>
</table>
</a>
<!--<![endif]-->
<!--[if vml]>
<v:group xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" coordsize="650,366" coordorigin="0,0" href="https://www.youtube.com/watch?v=6sT604EHm0o" style="width:650px;height:366px;">
<v:rect fill="t" stroked="f" style="position:absolute;width:650;height:366;">
<v:fill src="https://img.youtube.com/vi/6sT604EHm0o/maxresdefault.jpg" type="frame"/>
</v:rect>
<v:oval fill="t" strokecolor="#FFFFFF" strokeweight="3px" style="position:absolute;left:296;top:154;width:59;height:59">
<v:fill color="#FFFFFF" opacity="100%" />
</v:oval>
<v:shape coordsize="24,32" path="m,l,32,24,16,xe" fillcolor="#000000" stroked="f" style="position:absolute;left:317;top:168;width:21;height:30;" />
</v:group>
<![endif]-->
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #D6E7F0;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#D6E7F0;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:#D6E7F0"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:#D6E7F0;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:25px; padding-bottom:0px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:25px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 0px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
<div style="color:#052d3d;font-family:\'Lato\', Tahoma, Verdana, Segoe, sans-serif;line-height:150%;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="line-height: 18px; font-size: 12px; font-family: \'Lato\', Tahoma, Verdana, Segoe, sans-serif; color: #052d3d;">
<p style="line-height: 33px; font-size: 12px; text-align: center; margin: 0;"><span style="font-size: 22px;">We already posted some information about your company and several products on our website. You can register by clicking <a href="%vhref" rel="noopener" style="text-decoration: underline; color: #2190E3;" target="_blank">here</a> and edit this information as well as add any number of your products. Please notice that it is <span style="color: #3366ff; font-size: 22px; line-height: 33px;">FREE OF CHARGE</span>. </span></p>
<p style="line-height: 33px; font-size: 12px; text-align: center; margin: 0;"><br/><span style="font-size: 22px;">In case if you do not want to post your information please let us know and we will delete your account. </span></p>
<p style="line-height: 18px; font-size: 12px; text-align: left; margin: 0;"> </p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:#FFFFFF;width:650px; border-top: 2px solid #D6E7F0; border-left: 2px solid #D6E7F0; border-bottom: 2px solid #D6E7F0; border-right: 2px solid #D6E7F0;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:10px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:2px solid #D6E7F0; border-left:2px solid #D6E7F0; border-bottom:2px solid #D6E7F0; border-right:2px solid #D6E7F0; padding-top:0px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
<div style="color:#555555;font-family:\'Lato\', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; font-family: \'Lato\', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
<p style="font-size: 14px; line-height: 16px; text-align: left; margin: 0;"> </p>
<p style="font-size: 14px; line-height: 16px; text-align: left; margin: 0;"><em>Sincerely yours, </em><br/><em><strong>MAKROMEDICINE TEAM </strong></em></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
<div style="color:#555555;font-family:\'Lato\', Tahoma, Verdana, Segoe, sans-serif;line-height:150%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-size: 12px; line-height: 18px; font-family: \'Lato\', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
<p style="font-size: 12px; line-height: 18px; text-align: center; margin: 0;">Email: <a href="mailto:info@makromedicine.com" style="text-decoration: none; color: #0068A5;" title="info@makromedicine.com">info@makromedicine.com</a></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
</td>
</tr>
</tbody>
</table>
<!--[if (IE)]></div><![endif]-->
</body>
</html>';
    }



    public function mail_change($usid){
        if(is_numeric($usid)){
            $this->load->library('Auth');
            $this->load->model('User_model');
            $users1 = $this->User_model->fields(['id','email'])->filter(['id'=>$usid])->all();
            foreach ($users1 as $key => $value) {

            $person_info   = json_decode($this->auth->get_user_var('person',$value->id));
            $contact_info   = json_decode($this->auth->get_user_var('company',$value->id));

           if(!empty($person_info) && strpos($value->email, 'yopmail') ===false && ((isset($person_info[0]->email) && !empty($person_info[0]->email)  && strpos($person_info[0]->email, 'yopmail') !==false) || (isset($contact_info[0]->email) && !empty($contact_info[0]->email)  && strpos($contact_info[0]->email, 'yopmail') !==false))){
                  // echo $value->email.' -> '.$person_info[0]->email.'->'.$contact_info[0]->email.'<br>';
                    if (strpos($person_info[0]->email, 'yopmail') !==false){
                    $person_info[0]->email = $value->email;
                    $data = array(
                       
                        'value'=>json_encode($person_info)
                    );
                   // print_r($data);
                    $this->db->update('wc_user_variables', $data, array( 'user_id' =>$value->id,'data_key'=>'person'));
                   
                   }
                   if (strpos($contact_info[0]->email, 'yopmail') !==false){
                    $contact_info[0]->email = $value->email;
                   $data = array(
                        'value'=>json_encode($contact_info)
                    );
              //     print_r($data);
                    $this->db->update('wc_user_variables', $data, array( 'user_id' =>$value->id,'data_key'=>'company'));
                   }
               }
            }
        }
              

         
    }


    
}
