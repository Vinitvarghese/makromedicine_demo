<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tender extends Admin_Controller
{

  	public function __construct()
  	{
  		  parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Notify_model');
        $this->load->helper('extra');
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
              'class' => 'btn btn-danger btn-labeled heading-btn',
              'id' => 'deleteSelectedItems',
          'icon' => 'icon-trash',
          'additional' => [
            'data-href' => site_url($this->directory . $this->module_name . '/delete')
          ]
          ];

          $this->data['buttons'][] = [
              'type' => 'button',
              'text' => 'Activate',
              'class' => 'btn btn-info btn-labeled heading-btn',
              'id' => 'activateItems',
          'icon' => 'icon-check',
          'additional' => [
            'data-href' => site_url($this->directory . $this->module_name . '/activateMulti')
          ]
          ];


          // Table Column
          $this->data['fields'] = ['id','title', 'company_name','email','checked',  'pr_type', 'atc_code', 'packing_type', 'country', 'continent'];

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
              $filter['(title like "%'.$this->input->get('name').'%" or company_name like "%'.$this->input->get('name').'%")'] = NULL;
          }
          if ($this->input->get('checked') != NULL) {
              $filter['wc_tender.checked'] = $this->input->get('checked');
          }
          $sort = [
              'column' => ($this->input->get('column')) ? $this->input->get('column') : 'created_at',
              'order' => ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
          ];
          $this->data['total_rows'] = $this->{$this->model}->fields('wc_tender.*,wc_companies.company_name')
              ->join('wc_users', 'wc_tender.user_id = wc_users.id','left')
              ->join('wc_company_user_rel', 'wc_company_user_rel.user_id = wc_users.id AND delete_at IS NULL','left')
              ->join('wc_companies', 'wc_companies.id = wc_company_user_rel.company_id','left')
              ->filter($filter)->with_translation()->get_count_rows(1);
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

          $filter['wc_tender.user_id in (select id from wc_users where deleted_at is null)']=NULL;
          $filter['wc_tender.deleted_at is null']=NULL;

          $this->data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';
          $total_rows = $this->{$this->model}->fields('wc_tender.*,wc_companies.company_name')
              ->join('wc_users', 'wc_tender.user_id = wc_users.id','left')
              ->join('wc_company_user_rel', 'wc_company_user_rel.user_id = wc_users.id AND delete_at IS NULL','left')
              ->join('wc_companies', 'wc_companies.id = wc_company_user_rel.company_id','left')
              ->where($filter)->with_translation()->get_count_rows(1);
          $rows = $this->{$this->model}->fields('wc_tender.*,wc_tender_translation.title,wc_tender_translation.alias, wc_companies.company_name')
              ->join('wc_users', 'wc_tender.user_id = wc_users.id','left')
              ->join('wc_company_user_rel', 'wc_company_user_rel.user_id = wc_users.id AND delete_at IS NULL','left')
              ->join('wc_companies', 'wc_companies.id = wc_company_user_rel.company_id','left')
              ->filter($filter)->order_by($sort['column'], $sort['order'])->with_translation()->limit($this->data['per_page'], $this->data['per_page']*($page-1))->all();
        

          $array_data = [];

          if($rows){
           
                    foreach ($rows as $value) {

                       $atc_code = json_decode($value->atc_code);
                       $herbal = json_decode($value->herbal);
                       $animals = json_decode($value->animal);
                       $casNumbers = json_decode($value->cas);
                       $content = '';
                       if (count($atc_code) > 0){
                          foreach ($atc_code as $atc){
                                $content.='<b>'.get_atc_code_no($atc->id).'</b>
                                <span>('.$atc->mdoza.' '.get_unit_name($atc->vdoza);
                                if (!is_null($atc->mdoza2) and $atc->mdoza2!='') {
                                $content.='/ '.$atc->mdoza2.' '.get_unit_name($atc->vdoza2);
                                $content.='/';
                                } 
                                $content.=')</span> ';
                            }
                       }
                        
                        if (count($herbal) > 0){
                            foreach ($herbal as $herb){
                                $content.='<b>'.get_herbal_name($herb->id).'</b>
                                <span>('.$herb->mdoza.' '.get_unit_name($herb->vdoza).')</span> ';
                            }
                        }
                        if (count($animals) > 0){
                            foreach ($animals as $animal){
                                $content.='<b>'.get_animal_name($animal->id).'</b>
                                <span>'.$animal->mdoza.' '.get_unit_name($animal->vdoza).'</span> ';
                            }
                        }
                        if (count($casNumbers) > 0){
                            foreach ($casNumbers as $casss){
                                $content.='<b>'.get_cas_name($casss->id).'</b>
                                <span>'.$casss->mdoza.' '.get_unit_name($casss->vdoza).'</span> ';
                            }
                        }

                        $var = json_decode($value->packing_type);
                        $packing_type='';
                        if (count($var) > 0){
                            $f = json_decode(json_encode($var[0]));
                             $packing_type .= '<b>'.get_packing_type_name($f->id).'</b>
                            <span>(';
                            if ($f->mdoza2 !== 0) $packing_type.=$f->mdoza2; 
                            $packing_type.= get_unit_name($f->vdoza2);
                            if($f->mdoza !== 0) $packing_type.= $f->mdoza; 
                            $packing_type.=get_drug_type_code($f->vdoza);
                            $packing_type.=')</span>';
                        }


                        $array_data[] = (object) [
                         'id'      => $value->id,
                          'title'   => '<a target="_blank" href="'.site_url_multi('tender/view/').$value->id.'-'.$value->alias.'">'.$value->title.'</a>',
                         'user_id' => $value->company_name,
                         'email' => get_company_name($value->user_id)->email,
                         'checked'   => $value->checked,
                        
                         'pr_type' => get_product_type_name($value->pr_type),
                         'atc_code' =>$content,
                         'packing_type' => $packing_type,
                         'country' => get_country_name($value->country),
                         'continent' => get_continent_name($value->continent)
                       ];
                    }
          
                    $rows = $array_data;
                  }
          
                    $action_buttons = [
                        'edit'      => TRUE,
                        'delete'    => TRUE
                    ];
                    $custom_rows_data = [
                        [
                            'column' => 'checked',
                            'callback' => 'get_status',
                            'params' => false
                        ]
                    ];
                    $this->wc_table->set_module(false);
                    $this->wc_table->set_columns($columns);
                    if($rows)
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
              'href' => site_url($this->directory . $this->controller . '?checked=1'),
              'icon_class' => 'icon-shield-check position-left',
              'label_value' =>$this->{$this->model}->filter(['checked' => 1])->get_count_rows(),
              'label_class' => 'label label-success position-right'
          ];

          $this->data['breadcrumb_links'][] = [
              'text' => translate('breadcrumb_link_deactive', true),
              'href' => site_url($this->directory . $this->controller . '?checked=0'),
              'icon_class' => 'icon-shield-notice position-left',
              'label_value' => $this->{$this->model}->filter(['checked' => 0,'user_id in (select id from wc_users where deleted_at is null)'=>NULL])->get_count_rows(),
              'label_class' => 'label label-warning position-right'
          ];

          $this->data['breadcrumb_links'][] = [
              'text' => translate('breadcrumb_link_trash', true),
              'href' => site_url($this->directory . $this->controller . '/trash'),
              'icon_class' => 'icon-trash position-left',
              'label_value' => $this->db->where('deleted_at IS NOT NULL',NULL)->from('wc_tender')->count_all_results(),
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

    		// Form Fields
    		$this->data['form_field']['general'] = [];

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
          	$general = [];

            $companies_name = $this->{$this->model}->insert($general);
            // here
	       }
      $this->template->render($this->controller . '/form');
	   }


  	public function edit($id)
  	{
      $user_id_query = $this->db->select('user_id')->where('id',$id)->get('wc_tender');
      $user_id = $user_id_query->result();
      $login = $this->auth->login_cms($user_id[0]->user_id);
     if($login){
           redirect('tender/update/'.$id);
      }
     
  		/*$this->data['title'] 		= translate('edit_title');
  		$this->data['subtitle'] 	= translate('edit_description');
  		$this->breadcrumbs->push(translate('edit_title'), $this->directory.$this->controller.'/edit/'.$id);
  		$row = $this->{$this->model}->filter(['id'=>$id])->one();
  		$this->data['form_field']['general'] = [];

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
    			if ($update == true)
          {

    			}
          else
          {
  				    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
    			}
  		}

  		 $this->template->render($this->controller . '/form');*/
  	}

    public function changeStatus($id=false)
    {
      $id = $this->input->post('id');
       if($id != false)
      {
      $pr = $this->db->where('id', $id)->get('wc_tender')->result();
      if($pr[0]->checked == 1){
         $var = $this->db->set('checked', '0', FALSE)->where('id', $id)->update('wc_tender');
          redirect(site_url_multi($this->directory . $this->controller.'?checked=0'), 'refresh');
      }
      else{

        $var = $this->db->set('checked', '1', FALSE)->where('id', $id)->update('wc_tender');
            if($var){
              $userid = $this->{$this->model}->fields(['user_id','title'])->filter(['id'=>$id])->with_translation()->one();
              $this->data['notify_data']  = [
                'user_id'       => $userid->user_id,
                'send_id'       => 1,
                'status'        => 1,
                'sender'        => 1,
                'type'          => 3,
                'title'         => 'Your tender <b>'.strtoupper($userid->title).'</b> has been confirmed.',
                'description'   => "",
              ];
              //$this->data['send_notify']  = $this->Notify_model->send($this->data['notify_data']);
             redirect(site_url_multi($this->directory . $this->controller.'?checked=0'), 'refresh');
            }  
      
      }
     }
    }

  	public function delete($id=false)
  	{
      if($id){
              $this->{$this->model}->delete($id);
              echo json_encode(['success' => 1]);
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


        public function activateMulti($id=false)
    {
      

      if ($this->input->method() == 'post') {
        $response  = ['success' => false, 'message' => 'Couldn\'t activate selected products'];
        if ($this->input->post('selected')) {
          foreach ($this->input->post('selected') as $id) {
           

              $var = $this->db->set('checked', '1', FALSE)->where('id', $id)->update('wc_tender');
            if($var){
              $userid = $this->{$this->model}->fields(['user_id','title'])->filter(['id'=>$id])->with_translation()->one();
              $this->data['notify_data']  = [
                'user_id'       => $userid->user_id,
                'send_id'       => 1,
                'status'        => 1,
                'sender'        => 1,
                'type'          => 3,
                'title'         => 'Your product <b>'.strtoupper($userid->title).'</b> has been confirmed.',
                'description'   => "",
              ];
              //$this->data['send_notify']  = $this->Notify_model->send($this->data['notify_data']);
           
            }  


          }
          $response = ['success' => true, 'message' => 'Successfully activate selected products'];
         // redirect(site_url_multi($this->directory . $this->controller.'?checked=0'), 'refresh');
        }
        $this->template->json($response);
      }
    
      

    }

}
