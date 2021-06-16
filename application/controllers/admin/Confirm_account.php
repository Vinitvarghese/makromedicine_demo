<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirm_account extends Admin_Controller
{

  	public function __construct()
  	{
  		  parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Notify_model');
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
              'type' => 'a',
              'text' => translate('header_button_delete', true),
              'href' => site_url($this->directory . $this->controller . '/delete'),
              'class' => 'btn btn-danger btn-labeled heading-btn',
              'id' => '',
              'icon' => 'icon-trash'
          ];

          // Table Column
          $this->data['fields'] = ['id', 'user_id','email','status','image'];

          if($this->data['fields'])
          {
              foreach ($this->data['fields'] as $field) {
                  $this->data['columns'][$field] = [
                      'table' => [
                          $this->data['current_lang'] => translate('table_head_' . $field)
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
          $this->data['search_field'] = [
              'name' => [
                  'property'    => 'search',
                  'type'        => 'search',
                  'name'        => 'name',
                  'class'       => 'form-control',
                  'value'       => $this->input->get('name'),
                  'placeholder' => translate('search_placeholder', true),
              ]
          ];
          //Filter
          $filter = [];
          if ($this->input->get('status') != NULL) {
              $filter['status'] = $this->input->get('status');
          }
          if ($this->input->get('name') != NULL) {
              $filter['user_id in (select id from wc_users where company_name like 
              \'%'.$this->input->get('name').'%\' or email like 
              \'%'.$this->input->get('name').'%\' )'] = NULL;
          }
          $filter['user_id in (select id from wc_users where deleted_at is null)']=NULL;
          $sort = [
              'column' => ($this->input->get('column')) ? $this->input->get('column') : 'created_at',
              'order' => ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
          ];
          $this->data['total_rows'] = $this->{$this->model}->filter($filter)->get_count_rows();
          $segment_array = $this->uri->segment_array();
          $page = (ctype_digit(end($segment_array))) ? (int)end($segment_array) : 1;
          if ($this->input->get('per_page'))
          {
             $this->data['per_page'] = (int) $this->input->get('per_page');

              ${$this->controller . '_per_page'} = (int) $this->input->get('per_page');
              $this->session->set_userdata($this->controller . '_per_page', ${$this->controller . '_per_page'});
          }
          elseif ($this->session->has_userdata($this->controller . '_per_page'))
          {
             $this->data['per_page'] = $this->session->userdata($this->controller . '_per_page');
          }
          else
          {
             $this->data['per_page'] = 10;
          }
          $this->data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';
          $total_rows = $this->{$this->model}->where($filter)->count_rows();
          $rows = $this->{$this->model}->fields($this->data['fields'])->filter($filter)->order_by($sort['column'], $sort['order'])->limit($this->data['per_page'], ($page-1)*$this->data['per_page'])->all();

        $array_data = [];

        if(!$rows) $rows = array();
          foreach ($rows as $value) {
              $array_data[] = (object) [
               'id' => $value->id,
               'user_id' => get_company_name($value->user_id)->company_name,
               'email' => get_company_name($value->user_id)->email,
               'status'=>$value->status,
                'image'=>'<a href="/uploads/catalog/certifcate/'.str_replace(' ','_',$value->image).'" target="_blank">'.$value->image.'</a>'
             ];
          }

          $rows = $array_data;

          $action_buttons = [
              'edit'      => TRUE,
              'delete'    => TRUE,
              'check'     => TRUE
          ];
          $custom_rows_data = [
              [
                  'column' => 'status',
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
              'label_value' => $this->{$this->model}->filter(['status' => 1,'user_id in (select id from wc_users where deleted_at is null)'=>NULL])->get_count_rows(),
              'label_class' => 'label label-success position-right'
          ];

          $this->data['breadcrumb_links'][] = [
              'text' => translate('breadcrumb_link_deactive', true),
              'href' => site_url($this->directory . $this->controller . '?status=0'),
              'icon_class' => 'icon-shield-notice position-left',
              'label_value' => $this->{$this->model}->filter(['status' => 0,'user_id in (select id from wc_users where deleted_at is null)'=>NULL])->get_count_rows(),
              'label_class' => 'label label-warning position-right'
          ];

          $this->data['breadcrumb_links'][] = [
              'text' => translate('breadcrumb_link_trash', true),
              'href' => site_url($this->directory . $this->controller . '/trash'),
              'icon_class' => 'icon-trash position-left',
              'label_value' => $this->{$this->model}->filter(['deleted_at is not null'=>NULL])->get_count_rows(),
              'label_class' => 'label label-danger position-right'
          ];

            $this->template->render();
      }

  	public function create()
  	{
    		$this->data['title'] 		= translate('create_title');
    		$this->data['subtitle'] 	= translate('create_description');

    		$this->data['buttons'][] = [
    			'type'	=> 'a',
    			'text'	=> translate('header_button_go_back'),
    			'href'	=> site_url($this->directory.$this->controller.'/create'),
    			'class'	=> 'btn btn-primary btn-labeled heading-btn',
    			'id'	  => '',
    			'icon'	=> 'icon-arrow-left8'
    		];

    		$this->breadcrumbs->push(translate('create_title'), $this->directory.$this->controller.'/create');

        $this->data['companies']  = $this->User_model->filter(['user_groups_id IN(2,3,4)' => NULL, 'status'=>1])->fields(['id', 'company_name'])->all();

    		$companies = [];
    		foreach ($this->data['companies'] as $item) {
    			$companies[''] =	translate('form_please_select');
    			$companies[$item->id] = $item->company_name;
    		}

    		// Form Fields
    		$this->data['form_field']['general'] = [
    			'info' => [
              'property' 		  => 'textarea',
              'id' 			      => 'info',
              'name'          => 'info',
              'class'			    => 'form-control',
              'value'         => set_value('info'),
              'label'			    => translate('form_placeholder_info'),
              'placeholder'	  => translate('form_placeholder_info')
    			],
          'image'		=> [
    				'property'			  => 'image',
    				'id'       			  => 'input-image',
    				'name'          	=> 'image',
		        'value'         	=> set_value('image'),
		        'src'        		  => set_value('image') ? $this->Model_tool_image->resize(set_value('image'), 200, 200) : $this->Model_tool_image->resize('catalog/nophoto.png', 200, 200),
  			    'label'				    => translate('form_label_image'),
		        'placeholder'		  => $this->Model_tool_image->resize('catalog/nophoto.png', 200, 200),
		        'validation'		=> [
	                'rules' => ''
	        	]
    			],
    			'sort' => [
              'property' 		  => 'text',
              'id' 			      => 'sort',
              'name'          => 'sort',
              'class'			    => 'form-control',
              'value'         => (set_value('sort')) ? set_value('sort') : 0,
              'label' 		    => translate('form_placeholder_sort'),
              'placeholder'	  => translate('form_placeholder_sort')
    			],
          'user_id'	=> [
    				'property'		  => 'dropdown',
    				'name'			    => 'user_id',
  		    	'id'		       	=> 'user_id',
  		    	'label'			    =>	translate('form_label_group'),
    				'class' 		    => 'bootstrap-select',
    				'data-style' 	  => 'btn-default btn-xs',
    				'data-width'	  => '100%',
    				'options'		    => $companies,
		        'selected'      => set_value('user_id'),
		        'validation'	  => ['rules' => 'required']
  		    ],
    			'status' => [
              'property' 		=> 'dropdown',
              'name' 			  => 'status',
              'id' 			    => 'status',
              'label' 		  => translate('form_label_status'),
              'class' 		  => 'select2 select-search',
              'options' 		=> [translate('disable', true), translate('enable', true)],
              'selected' 		=> set_value('status'),
              'validation' 	=> ['rules' => 'required']
    			]
    		];

    		// Form Select Options
    		$this->data['options'] = [
    			'status'	=> [translate('disable'), translate('enable')]
    		];

        $this->data['buttons'][] = [
    			'type'		=> 'button',
    			'text'		=> translate('form_button_save',true),
    			'class'		=> 'btn btn-primary btn-labeled heading-btn',
    			'id'		=> 'save',
    			'icon'		=> 'icon-floppy-disk',
    			'additional' => [
    				'onclick'	=> "confirm('Are you sure?') ? $('#form-save').submit() : false;",
    				'form' 		=> 'form-save',
    				'formaction'=> current_url()
    			]
    		];

        if($this->input->method() == 'post')
    		{
          	$general = [
          		'user_id'	  => $this->input->post('user_id'),
          		'info'	    => $this->input->post('info'),
          		'images'	  => $this->input->post('image'),
          		'status'	  => $this->input->post('status'),
          		'sort'	    => $this->input->post('sort')
          	];

            $companies_name = $this->{$this->model}->insert($general);
            if($companies_name){
              if($this->input->post('status') == 1){
                $data = ['company_name' => $this->input->post('name')];
                $this->User_model->save_fcm($this->input->post('user_id'),$data);
              }
          		redirect(site_url_multi($this->directory.$this->controller));
          	}
	       }
      $this->template->render($this->controller . '/form');
	   }


  	public function edit($id)
  	{
  		$this->data['title'] 		= translate('edit_title');
  		$this->data['subtitle'] 	= translate('edit_description');
  		$this->breadcrumbs->push(translate('edit_title'), $this->directory.$this->controller.'/edit/'.$id);
  		$row = $this->{$this->model}->filter(['id'=>$id])->one();
      $this->data['companies']  = $this->User_model->filter(['user_groups_id IN(2, 3, 4)' => NULL])->fields(['id', 'company_name'])->all();

      $companies = [];
      foreach ($this->data['companies'] as $item) {
        $companies[0] =	translate('form_please_select');
        $companies[$item->id] = $item->company_name;
      }

  		$this->data['form_field']['general'] = [
  			'info' => [
  				'property' 		  => 'textarea',
  				'id' 			      => 'info',
  				'name' 			    => 'info',
  				'id' 			      => 'info',
  				'class' 	 	    => 'form-control',
  				'value' 		    => (set_value('info')) ? set_value('info') : $row->info,
  				'label' 		    => translate('form_placeholder_info'),
  				'placeholder' 	=> translate('form_placeholder_info')
  			],
        'image'		=> [
						'property'			 => 'image',
						'id'       			 => 'input-image',
						'name'           => 'image',
		        'value'          => (set_value('image')) ? set_value('image') : $row->image,
		        'src'        		 => (set_value('image')) ? set_value('image') : $this->Model_tool_image->resize("catalog/certifcate/".$row->image, 200, 200),
				    'label'				   => translate('form_label_image'),
		        'placeholder'		 => '/uploads/nophoto.png',
		        'validation'		 => [
	                'rules' => '',
	                'errors' => []
	        	]
					],
  			'sort' => [
    				'property' 		  => 'text',
    				'id' 			      => 'sort',
    				'name' 			    => 'sort',
    				'id' 			      => 'sort',
    				'class' 		    => 'form-control',
    				'value' 		    => (set_value('sort')) ? set_value('sort') : $row->sort,
    				'label' 		    => translate('form_placeholder_sort'),
    				'placeholder' 	=> translate('form_placeholder_sort')
  			],
        'user_id'	=> [
          'property'		  => 'dropdown',
          'name'			    => 'user_id',
          'id'		       	=> 'user_id',
          'label'			    =>	translate('form_label_group'),
          'class' 		    => 'bootstrap-select',
          'data-style' 	  => 'btn-default btn-xs',
          'data-width'	  => '100%',
          'options'		    => $companies,
          'selected'      => (set_value('user_id')) ? set_value('user_id') : $row->user_id,
          'validation'	  => ['rules' => 'required']
        ],
  			'status' => [
    				'property' 		=> 'dropdown',
    				'name' 			  => 'status',
    				'id' 			    => 'status',
    				'label' 		  => translate('form_label_status'),
    				'class' 		  => 'select2 select-search',
    				'options' 		=> [translate('disable', true), translate('enable', true)],
    				'selected' 		=> (set_value('status')) ? set_value('status') : $row->status,
    				'validation' 	=> ['rules' => 'required']
  			]
  		];

  		// Form Buttons
  		$this->data['buttons'][] = [
    			'type' => 'button',
    			'text' => translate('form_button_save',true),
    			'class' => 'btn btn-primary btn-labeled heading-btn',
    			'id' => 'save',
    			'icon' => 'icon-floppy-disk',
    			'additional' => [
      				'onclick' => "confirm('Are you sure?') ? $('#form-save').submit() : false;",
      				'form' => 'form-save',
      				'formaction' => current_url()
    			]
  		];

  		// Form Select Options
  		$this->data['options'] = [
  			'status'	=> [
    				translate('common_disable',true),
    				translate('common_enable',true)
  			]
  		];

  		if ($this->input->method() == 'post') {
    			$language_data = [];
    			foreach ($this->input->post() as $key => $language) {
      				if (is_array($language)) {
    					     $language_data[$key] = json_encode($language);
      				} else {
    					     $language_data[$key] = $language;
      				}
    			}

  			  $update = $this->{$this->model}->update($language_data, ['id' => $id]);
    			if ($update == true) {
              if($this->input->post('status') == 1){
                $data = ['status' => 1];

                $update_company_name = $this->User_model->save_fcm($this->input->post('user_id'),$data);

             //   $var = $this->{$this->model}->delete($id);
                if($var){
                  $this->session->set_flashdata('message', translate('form_success_edit'));
                  redirect(site_url_multi($this->directory . $this->controller), 'refresh');
                }

              }
      				$this->session->set_flashdata('message', translate('form_success_edit'));
      				redirect(site_url_multi($this->directory . $this->controller), 'refresh');
    			} else {
  				    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
    			}
  		}

  		$this->template->render($this->controller . '/form');
  	}

    public function changeStatus($id=false)
    {
      $id = $this->input->post('id');
      if($id != false)
      {
        $data = ['status' => 1];
        $this->data['get_user'] = $this->{$this->model}->filter(['id'=>$id])->one();
        $update_company_name = $this->User_model->save_fcm($this->data['get_user']->user_id,$data);
        if($update_company_name)
        {

          /* Send notification */

           $userid = $this->data['get_user']->user_id;

              $this->data['notify_data']  = [
                'user_id'       => $userid,
                'company_id'       => $this->data['get_user']->company_id,
                'send_id'       => 1,
                'status'        => 1,
                'sender'        => 1,
                'type'          => 4,
                'title'         => 'Your account has been confirmed.',
                'description'   => "",
              ];
              //$this->data['send_notify']  = $this->Notify_model->send($this->data['notify_data']);

                  /* Send mail */

              $user_info = $this->User_model->getUserData(['u.id'=>$userid]); //$this->User_model->filter(['id'=>$userid])->fields(['company_name','email'])->one();

              $setting_user = $this->User_model->account_settings('ntf_comp_email,ntf_comp_sms',array('user_id' => $userid));
              

              if($setting_user[0]['ntf_comp_email'] == 1){
                   $mail = $this->phpmailer_library->load();
           
                  //Server settings
                 // $mail->SMTPDebug = 2;                                     
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
                  $mail->Port       =587;   


                  $message  = "<h4>Hi ".$user_info->company_name."</h4>";
                  $message .= 'Your account has been successfully confirmed.<br>';
                  
                  //Recipients
                  $mail->setFrom('support@makromedicine.com');
                  $mail->addAddress($user_info->email);     
                  $mail->addReplyTo('support@makromedicine.com');
                 
                  // Content
                  $mail->isHTML(true);                                 
                  $mail->Subject = 'Account Confirmation';
                  $mail->Body    = $message;
                
                  $mail->send();


              }

              if($setting_user[0]['ntf_comp_sms'] == 1){

              }


          $comfirm_account_update = $this->{$this->model}->comfirm_account_update($id,$data);
          if($comfirm_account_update)
          {
            $var = $this->db->set('status',1)->where('id',$id)->update('wc_confirm_account');
            if($var){ 
              redirect(site_url_multi($this->directory . $this->controller.'?status=0'), 'refresh');
            }
          }
        }
      }
    }

  	public function delete($id)
  	{
    		$this->{$this->model}->delete($id);
    		echo json_encode(['success' => 1]);
  	}
}
