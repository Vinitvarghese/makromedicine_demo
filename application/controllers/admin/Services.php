<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends Admin_Controller
{

  	public function __construct()
  	{
  		  parent::__construct();
        $this->load->model('Services_model');
        $this->load->model('Country_model');
        $this->load->model('Parent_services_model');
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
              'type' => 'a',
              'text' => translate('header_button_delete', true),
              'href' => site_url($this->directory . $this->controller . '/delete'),
              'class' => 'btn btn-danger btn-labeled heading-btn',
              'id' => '',
              'icon' => 'icon-trash'
          ];

          // Table Column
          $this->data['fields'] = ['id', 'sort', 'status', 'title'];

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
                  'value'       => $this->input->get('info'),
                  'placeholder' => translate('search_placeholder', true),
              ]
          ];
          //Filter
          $filter = [];
          if ($this->input->get('status') != NULL) {
              $filter['status'] = $this->input->get('status');
          }
          if ($this->input->get('name') != NULL) {
              $filter['info'] = $this->input->get('name');
          }
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

          $rows = $this->{$this->model}->fields($this->data['fields'])->filter($filter)->limit($this->data['per_page'], $page)->with_translation()->all();

          $action_buttons = [
              'edit'      => TRUE,
              'delete'    => TRUE,
              'check'     => TRUE
          ];
          $custom_rows_data = [
              [
                  'column' => 'status',
                  'callback' => 'get_status',
                  'params' => ''
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
              'label_value' => $this->{$this->model}->filter(['status' => 1])->get_count_rows(),
              'label_class' => 'label label-success position-right'
          ];

          $this->data['breadcrumb_links'][] = [
              'text' => translate('breadcrumb_link_deactive', true),
              'href' => site_url($this->directory . $this->controller . '?status=0'),
              'icon_class' => 'icon-shield-notice position-left',
              'label_value' => $this->{$this->model}->filter(['status' => 0])->get_count_rows(),
              'label_class' => 'label label-warning position-right'
          ];

          $this->data['breadcrumb_links'][] = [
              'text' => translate('breadcrumb_link_trash', true),
              'href' => site_url($this->directory . $this->controller . '/trash'),
              'icon_class' => 'icon-trash position-left',
              'label_value' => $this->{$this->model}->only_trashed()->get_count_rows(),
              'label_class' => 'label label-danger position-right'
          ];

          $this->render('index');
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

        $this->data['country']  = $this->Country_model->fields(['id', 'name'])->with_translation()->all();

    		$country = [];
    		foreach ($this->data['country'] as $item) {
    			$country[$item->id] = $item->name;
    		}

        $this->data['parent_id'] = $this->Parent_services_model->fields(['id', 'name'])->with_translation()->all();

    		$parent_services = [];
    		foreach ($this->data['parent_id'] as $item) {
    			$parent_services[$item->id] = $item->name;
    		}

    		$this->data['form_field']['general'] = [
          'country'	=> [
    				'property'		  => 'multiselect',
    				'name'			    => 'country[]',
  		    	'id'		       	=> 'country',
  		    	'label'			    =>	translate('form_label_group'),
    				'class' 		    => 'bootstrap-select',
    				'data-style' 	  => 'btn-default btn-xs',
    				'data-width'	  => '100%',
            'data-live-search' 	=> true,
    				'options'		    => $country,
		        'selected'      => set_value('country'),
		        'validation'	  => ['rules' => 'required']
  		    ],
          'parent_id'	=> [
    				'property'		  => 'dropdown',
    				'name'			    => 'parent_id',
  		    	'id'		       	=> 'country',
  		    	'label'			    =>	translate('form_label_parent_id'),
    				'class' 		    => 'bootstrap-select',
    				'data-style' 	  => 'btn-default btn-xs',
    				'data-width'	  => '100%',
            'data-live-search' 	=> true,
    				'options'		    => $parent_services,
		        'selected'      => set_value('country'),
		        'validation'	  => ['rules' => 'required']
  		    ],
    			'status' => [
              'property' 		=> 'dropdown',
              'name' 			  => 'status',
              'id' 			    => 'status',
              'label' 		  => translate('form_label_status'),
              'class' 		  => 'bootstrap-select',
              'options' 		=> [translate('disable', true), translate('enable', true)],
              'selected' 		=> set_value('status'),
              'validation' 	=> ['rules' => 'required']
    			],
    			'product' => [
              'property' 		=> 'dropdown',
              'name' 			  => 'product',
              'id' 			    => 'product',
              'label' 		  => translate('form_label_product'),
              'class' 		  => 'bootstrap-select',
              'options' 		=> [translate('disable', true), translate('enable', true)],
              'selected' 		=> set_value('product'),
              'validation' 	=> ['rules' => 'required']
    			],
          'sort' => [
            'property'		   => 'number',
            'name'           => 'sort',
            'class'			     => 'form-control',
            'value'          => set_value('sort'),
            'label'		       => translate('form_placeholder_sort_label'),
            'placeholder'	   => translate('form_placeholder_sort'),
            'validation'	   => [
                'rules' => 'required'
            ]
          ],
          'slug' => [
            'property'		   => 'text',
            'name'           => 'slug',
            'class'			     => 'form-control',
            'value'          => set_value('slug'),
            'label'		       => translate('form_placeholder_slug_label'),
            'placeholder'	   => translate('form_placeholder_slug'),
            'validation'	   => [
                'rules' => 'required'
            ]
          ],
          'icon' => [
            'property'		   => 'text',
            'name'           => 'icon',
            'class'			     => 'form-control',
            'value'          => set_value('icon'),
            'label'		       => translate('form_placeholder_icon_label'),
            'placeholder'	   => translate('form_placeholder_icon'),
            'validation'	   => [
                'rules' => 'required'
            ]
          ]
    		];
        foreach ($this->data['languages'] as $language)
    		{
    			$this->data['form_field']['translation'][$language['id']] = [
    				'title' => [
    					'property'		   => 'text',
    					'name'           => 'translation['.$language['id'].'][title]',
			        'class'			     => 'form-control',
			        'value'          => set_value('translation['.$language['id'].'][title]'),
			        'label'		       => translate('form_placeholder_title_label'),
			        'placeholder'	   => translate('form_placeholder_title'),
  				    'validation'	   => [
	                'rules' => 'required'
		        	]
    				],
    				'description' => [
    					'property'		 => 'textarea',
    					'name'         => 'translation['.$language['id'].'][description]',
			        'class'			   => 'form-control editor',
			        'value'        => set_value('translation['.$language['id'].'][description]'),
			        'label'			   => translate('form_placeholder_description_label'),
			        'placeholder'	 => translate('form_placeholder_description'),
			        'validation'	 => [
	                'rules' => ''
	             ]
    				]
    			];
    		}

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

        foreach ($this->data['languages'] as $language)
    		{
    			foreach ($this->data['form_field']['translation'][$language['id']] as $key => $value)
    			{
    				$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
    			}
    		}

    		foreach ($this->data['form_field']['general'] as $key => $value)
    		{
    			$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
    		}

        if($this->input->method() == 'post')
        {
            //$this->debug($this->input->post());
          	if ($this->form_validation->run() == TRUE)
            {
                	$general = [
                		'status'	 => (int)$this->input->post('status'),
                    'parent_id'	   => (int)$this->input->post('parent_id'),
                		'sort'	   => (int)$this->input->post('sort'),
                		'product'	   => (int)$this->input->post('product'),
                		'slug'	   => slug($this->input->post('slug'), 'dash', true),
                    'icon'	   => $this->input->post('icon')
                	];

              	 ${$this->controller.'_id'} = $this->{$this->model}->insert($general);

                	foreach ($this->input->post('translation') as $lang_id => $value)
                	{
                  		$translation = [
                    			$this->controller.'_id'		=> ${$this->controller.'_id'},
                    			'language_id'					    => $lang_id,
                    			'title'						        => $value['title'],
                    			'description'				      => $value['description'],
                  		];
                  		$this->{$this->model}->insert_translation($translation);
                	}

                  if($this->input->post('country') != NULL)
                  {
                      $services_country = [];
                      foreach ($this->input->post('country') as $key => $value)
                      {
                          $services_country = [
                            'services_id' => ${$this->controller.'_id'},
                            'country_id'  => $value
                          ];
                          $this->{$this->model}->insert_services_country($services_country);
                      }
                  }

              	  redirect(site_url_multi($this->directory.$this->controller));
            }
            else
            {
            	 $this->data['message'] = $this->data['text']['common']['common_error_warning'];
            }
        }
        $this->render('form');
	   }

  	public function edit($id)
  	{
    		$this->data['title'] 		= translate('edit_title');
    		$this->data['subtitle'] 	= translate('edit_description');
    		$this->breadcrumbs->push(translate('edit_title'), $this->directory.$this->controller.'/edit/'.$id);
    		$row = $this->{$this->model}->filter(['id'=>$id])->one();

        $this->data['country']  = $this->Country_model->fields(['id', 'name'])->with_translation()->all();

        $country = [];
        foreach ($this->data['country'] as $item) {
          $country[$item->id] = $item->name;
        }

        $this->data['parent_id'] = $this->Parent_services_model->fields(['id', 'name'])->with_translation()->all();

    		$parent_services = [];
    		foreach ($this->data['parent_id'] as $item) {
    			$parent_services[$item->id] = $item->name;
    		}

       	$this->data['form_field']['general'] = [
          'country'	=> [
            'property'		      => 'multiselect',
            'name'			        => 'country[]',
            'id'		       	    => 'country',
            'label'			        =>	translate('form_label_group'),
            'class' 		        => 'bootstrap-select',
            'data-style' 	      => 'btn-default btn-xs',
            'data-width'	      => '100%',
            'data-live-search' 	=> true,
            'options'		        => $country,
            'selected'          => set_value('country'),
            'validation'	      => ['rules' => 'required']
          ],
          'parent_id'	=> [
    				'property'		  => 'dropdown',
    				'name'			    => 'parent_id',
  		    	'id'		       	=> 'country',
  		    	'label'			    =>	translate('form_label_parent_id'),
    				'class' 		    => 'bootstrap-select',
    				'data-style' 	  => 'btn-default btn-xs',
    				'data-width'	  => '100%',
            'data-live-search' 	=> true,
    				'options'		    => $parent_services,
		        'selected'      => set_value('parent_id'),
		        'validation'	  => ['rules' => 'required']
  		    ],
          'status' => [
    				'property' 		=> 'dropdown',
    				'name' 			  => 'status',
    				'id' 			    => 'status',
    				'label' 		  => translate('form_label_status'),
    				'class' 		  => 'bootstrap-select',
    				'options' 		=> [translate('disable', true), translate('enable', true)],
    				'selected' 		=> (set_value('status')) ? set_value('status') : $row->status,
    				'validation' 	=> ['rules' => 'required']
    			],
          'product' => [
              'property' 		=> 'dropdown',
              'name' 			  => 'product',
              'id' 			    => 'product',
              'label' 		  => translate('form_label_product'),
              'class' 		  => 'bootstrap-select',
              'options' 		=> [translate('disable', true), translate('enable', true)],
              'selected' 		=> (set_value('product')) ? set_value('product') : $row->product ,
              'validation' 	=> ['rules' => 'required']
    			],
          'sort' => [
            'property'		   => 'number',
            'name'           => 'sort',
            'class'			     => 'form-control',
            'value'          => (set_value('sort')) ? set_value('sort') : $row->sort,
            'label'		       => translate('form_placeholder_sort_label'),
            'placeholder'	   => translate('form_placeholder_sort'),
            'validation'	   => [
                'rules' => 'required'
            ]
          ],
          'slug' => [
            'property'		   => 'text',
            'name'           => 'slug',
            'class'			     => 'form-control',
            'value'          => (set_value('slug')) ? set_value('slug') : $row->slug,
            'label'		       => translate('form_placeholder_slug_label'),
            'placeholder'	   => translate('form_placeholder_slug'),
            'validation'	   => [
                'rules' => 'required'
            ]
          ],
          'icon' => [
            'property'		   => 'text',
            'name'           => 'icon',
            'class'			     => 'form-control',
            'value'          => (set_value('icon')) ? set_value('icon') : $row->icon,
            'label'		       => translate('form_placeholder_icon_label'),
            'placeholder'	   => translate('form_placeholder_icon'),
            'validation'	   => [
                'rules' => 'required'
            ]
          ]
    		];

        foreach ($this->data['form_field']['general'] as $key => $value)
        {
          $this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
        }

        // Set Multilingual Data Column
				$this->data['columns'] = ['title', 'description'];
        //echo "<pre>";
				foreach ($this->data['languages'] as $language)
				{
					$translation_content = $this->{$this->model}->fields($this->data['columns'])->filter([$this->controller.'_id' => $id, 'language_id' => $language['id']])->with_translation()->one();

					$this->data['translation'][$language['id']] = ($translation_content) ? $translation_content : false;
          //print_r($this->data['translation']);
					// Set Translation Form Field
					$this->data['form_field']['translation'][$language['id']] = [
						'title' => [
							'property'		   => 'text',
							'name'           => 'translation['.$language['id'].'][title]',
		          'class'			     => 'form-control',
					    'value'          => (set_value('translation['.$language['id'].']->title')) ? set_value('translation['.$language['id'].']->title') : $this->data['translation'][$language['id']]->title,
              'label'		       => translate('form_placeholder_title_label'),
              'placeholder'	   => translate('form_placeholder_title'),
						  'validation'	   => [
	                'rules' => 'required'
				       ]
						],
						'description' => [
							'property'		 => 'textarea',
							'name'         => 'translation['.$language['id'].'][description]',
			        'class'			   => 'form-control editor',
			        'value'        => (set_value('translation['.$language['id'].']->description')) ? set_value('translation['.$language['id'].']->description') : $this->data['translation'][$language['id']]->description,
              'label'			   => translate('form_placeholder_description_label'),
              'placeholder'	 => translate('form_placeholder_description'),
			        'validation'	 => [
	                'rules' => ''
	            ]
						]
					];

					foreach ($this->data['form_field']['translation'][$language['id']] as $key => $value)
					{
						$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
					}
			}

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

      if($this->input->method() == 'post')
			{
          if($this->form_validation->run() == TRUE)
          {
      	      $general = [
                'status'	 => (int)$this->input->post('status'),
                'parent_id'	   => (int)$this->input->post('parent_id'),
                'sort'	   => (int)$this->input->post('sort'),
                'product'	   => (int)$this->input->post('product'),
                'slug'	   => slug($this->input->post('slug'), 'dash', true),
                'icon'	   => $this->input->post('icon')
            	];

            	$this->{$this->model}->update($general, ['id' => $id]);
            	$this->{$this->model}->delete_translation($id);
            	foreach ($this->input->post('translation') as $lang_id => $value)
            	{
                  $translation = [
                    $this->controller.'_id'		=> $id,
                    'language_id'					    => $lang_id,
                    'title'						        => $value['title'],
                    'description'				      => $value['description'],
                  ];
                  $this->{$this->model}->insert_translation($translation);
            	}

              $this->{$this->model}->delete_country($id);
              if($this->input->post('country') != NULL)
              {
                  $services_country = [];
                  foreach ($this->input->post('country') as $key => $value)
                  {
                      $services_country = [
                        'services_id' => $id,
                        'country_id'  => $value
                      ];
                      $this->{$this->model}->insert_services_country($services_country);
                  }
              }
            	redirect(site_url_multi($this->directory.$this->controller));
          }
          else
  				{
  					$this->data['message'] = translate('error_warning', true);
  					$this->render('form');
  				}
			}
  		$this->render('form');
  	}

    public function check($id=false)
    {
        if($id != false)
        {
            $this->data['check_standart'] = $this->{$this->model}->check_standart($id, ['status'=>1]);
            if($this->data['check_standart'] != false)
            {
              redirect(site_url_multi($this->directory . $this->controller."/?status=0"), 'refresh');
            }
            else
            {
              redirect(site_url_multi($this->directory . $this->controller."/?status=0"), 'refresh');
            }
        }
    }

  	public function delete($id)
  	{
    		$this->{$this->model}->delete($id);
    		echo json_encode(['success' => 1]);
  	}
}
