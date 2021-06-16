<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Extension extends Admin_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->config('menu_icon');
		$this->load->config('rules');
		$this->load->config('datatype');
		$this->load->config('elements');
	}

	public function index()
	{
		$this->data['title']    = translate('index_title');
		$this->data['subtitle'] = translate('index_description');

		$this->data['buttons'][] = [
			'type'  => 'a',
			'text'  => translate('header_button_create', true),
			'href'  => site_url($this->directory . $this->controller . '/create'),
			'class' => 'btn btn-success btn-labeled heading-btn',
			'id'    => '',
			'icon'  => 'icon-plus-circle2'
		];

		$this->data['buttons'][] = [
			'type'  => 'a',
			'text'  => translate('header_button_delete', true),
			'href'  => site_url($this->directory . $this->controller . '/delete'),
			'class' => 'btn btn-danger btn-labeled heading-btn',
			'id'    => '',
			'icon'  => 'icon-trash'
		];


		// Table Column
		$this->data['fields'] = ['id', 'name', 'slug', 'status', 'multilingual', 'per_page', 'menu_icon', 'menu_sort', 'menu_status'];

		if ($this->data['fields']) {
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
		}
		elseif ($this->session->has_userdata($this->controller . '_fields')) {
			$this->data['fields'] = $this->session->userdata($this->controller . '_fields');
		}
		else {
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
			$filter['name'] = $this->input->get('name');
		}


		$sort = [
			'column' => ($this->input->get('column')) ? $this->input->get('column') : 'created_at',
			'order'  => ($this->input->get('order')) ? $this->input->get('order') : 'DESC'
		];

		$this->data['total_rows'] = $this->{$this->model}->filter($filter)->get_count_rows();
		$segment_array            = $this->uri->segment_array();
		$page                     = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;

		if ($this->input->get('per_page')) {
			$this->data['per_page'] = (int) $this->input->get('per_page');

			${$this->controller . '_per_page'} = (int) $this->input->get('per_page');
			$this->session->set_userdata($this->controller . '_per_page', ${$this->controller . '_per_page'});
		}
		elseif ($this->session->has_userdata($this->controller . '_per_page')) {
			$this->data['per_page'] = $this->session->userdata($this->controller . '_per_page');
		}
		else {
			$this->data['per_page'] = 10;
		}

		$this->data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';



		$total_rows = $this->{$this->model}->where($filter)->count_rows();
		$rows       = $this->{$this->model}->fields($this->data['fields'])->filter($filter)->order_by($sort['column'], $sort['order'])->limit($this->data['per_page'], $page)->all();


		$action_buttons = [
			'edit'   => TRUE,
			'delete' => TRUE
		];


		$custom_rows_data = [
			[
				'column'   => 'name',
				'callback' => 'get_name',
				'params'   => false,
			],
			[
				'column'   => 'status',
				'callback' => 'get_status',
				'params'   => false
			],
			[
				'column'   => 'menu_icon',
				'callback' => 'get_icon',
				'params'   => false
			],
			[
				'column'   => 'menu_status',
				'callback' => 'get_status',
				'params'   => false
			],
			[
				'column'    => 'multilingual',
				'callback'  => 'get_status',
				'params'    => false
			]
		];

		$this->wc_table->set_module(false);
		$this->wc_table->set_columns($columns);
		$this->wc_table->set_rows($rows);
		$this->wc_table->set_custom_rows($custom_rows_data);
		$this->wc_table->set_action($action_buttons);
		$this->data['table'] = $this->wc_table->generate();


		//Pagination
		$config['base_url']           = site_url_multi($this->directory . $this->controller . '/index');
		$config['total_rows']         = $total_rows;
		$config['per_page']           = $this->data['per_page'];
		$config['reuse_query_string'] = TRUE;
		$config['use_page_numbers']   = TRUE;

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();

		$this->data['breadcrumb_links'][] = [
			'text'        => translate('breadcrumb_link_all', true),
			'href'        => site_url($this->directory . $this->controller),
			'icon_class'  => 'icon-database position-left',
			'label_value' => $this->{$this->model}->where()->count_rows(),
			'label_class' => 'label label-primary position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'        => translate('breadcrumb_link_active', true),
			'href'        => site_url($this->directory . $this->controller . '?status=1'),
			'icon_class'  => 'icon-shield-check position-left',
			'label_value' => $this->{$this->model}->where(['status' => 1])->count_rows(),
			'label_class' => 'label label-success position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'        => translate('breadcrumb_link_deactive', true),
			'href'        => site_url($this->directory . $this->controller . '?status=0'),
			'icon_class'  => 'icon-shield-notice position-left',
			'label_value' => $this->{$this->model}->where(['status' => 0])->count_rows(),
			'label_class' => 'label label-warning position-right'
		];

		$this->data['breadcrumb_links'][] = [
			'text'        => translate('breadcrumb_link_trash', true),
			'href'        => site_url($this->directory . $this->controller . '/trash'),
			'icon_class'  => 'icon-trash position-left',
			'label_value' => $this->{$this->model}->only_trashed()->count_rows(),
			'label_class' => 'label label-danger position-right'
		];

		$this->render();
	}

	public function create()
	{
		$this->data['title']    = translate('create_title');
		$this->data['subtitle'] = translate('create_description');

		// GET ALL DATABASE TABLES
		$this->data['all_table'] = $this->{$this->model}->get_table();
		
		$this->load->model('Group_model');
		$this->data['user_groups'] = $this->Group_model->fields(['id', 'name'])->all();
		$this->data['method_list'] = ['index', 'trash', 'show', 'create', 'edit', 'delete', 'restore', 'remove', 'clean'];

		//Get All Callback Method in Custom_model
		$methods = get_class_methods('Custom_model');

		if ($methods) {
			foreach ($methods as $method) {
				if (strpos($method, 'callback_') !== false) {
					$this->data['methods'][] = str_replace('callback_', '', $method);
				}
			}
		}



		// Get All Language
		if ($this->data['languages']) {
			$language_options[0] = translate('please_select');
			foreach ($this->data['languages'] as $language) {
				$language_options[$language['id']] = $language['name'];
			}
		}
		else {
			$language_options = [];
		}

		// Get All Active Module
		$modules = $this->{$this->model}->fields(['id', 'name'])->filter(['status' => 1])->all();

		if ($modules) {
			$module_options[0] = translate('please_select');
			foreach ($modules as $module) {
				$module_options[$module->id] = json_decode($module->name)->index->title->{$this->data['current_lang']};
			}
		}
		else {
			$module_options = [];
		}

		/* General field */
		$this->data['form_field']['general'] = [
			'slug'         => [
				'property'    => 'text',
				'name'        => 'slug',
				'class'       => 'form-control',
				'value'       => set_value('slug'),
				'label'       => translate('form_label_slug'),
				'placeholder' => translate('form_placeholder_slug'),
				'validation'  => ['rules' => 'required']
			],
			'multilingual' => [
				'property'   => 'checkbox',
				'name'       => 'multilingual',
				'id'         => 'multilingual',
				'label'      => translate('form_label_multilingual'),
				'class'      => 'styled',
				'value'      => 1,
				'validation' => ['rules' => '']
			],
			'language_id'  => [
				'property'   => 'dropdown',
				'name'       => 'language_id',
				'id'         => 'language_id',
				'label'      => translate('form_label_language_id'),
				'class'      => 'select-search',
				'options'    => $language_options,
				'selected'   => set_value('language_id'),
				'validation' => ['rules' => '']
			],
			'status'       => [
				'property'   => 'dropdown',
				'name'       => 'status',
				'id'         => 'status',
				'label'      => translate('form_label_status'),
				'class'      => 'select',
				'options'    => [translate('disable', true), translate('enable', true)],
				'selected'   => set_value('status'),
				'validation' => ['rules' => 'required']
			],
			'method'       => [
				'property'   => 'multiselect',
				'name'       => 'method[]',
				'id'         => 'method',
				'label'      => translate('form_label_method'),
				'class'      => 'select select-search',
				'options'    => ['index' => 'Index', 'create' => 'Create', 'trash' => 'Trash', 'show' => 'Show', 'edit' => 'Edit', 'delete' => 'Delete', 'restore' => 'Restore', 'remove' => 'Remove', 'clean' => 'Clean'],
				'selected'   => set_value('method'),
				'validation' => ['rules' => 'required']
			],
			'per_page'     => [
				'property'   => 'dropdown',
				'name'       => 'per_page',
				'id'         => 'per_page',
				'label'      => translate('form_label_per_page'),
				'class'      => 'select',
				'options'    => ['10' => '10', '20' => '20', '50' => '50', '100' => '100', '200' => '200'],
				'selected'   => set_value('per_page'),
				'validation' => ['rules' => 'required']
			],
		];

		/* Menu field */
		$this->data['form_field']['menu'] = [
			'menu_sort'   => [
				'property'    => 'number',
				'name'        => 'menu_sort',
				'class'       => 'form-control',
				'value'       => (set_value('menu_sort')) ? set_value('menu_sort') : 0,
				'label'       => translate('form_label_menu_sort'),
				'placeholder' => translate('form_placeholder_menu_sort'),
				'validation'  => ['rules' => '']
			],
			'menu_status' => [
				'property'   => 'dropdown',
				'name'       => 'menu_status',
				'id'         => 'menu_status',
				'label'      => translate('form_label_menu_status'),
				'class'      => 'bootstrap-select',
				'data-style' => 'btn-default btn-xs',
				'data-width' => '100%',
				'options'    => [translate('disable', true), translate('enable', true)],
				'selected'   => set_value('status'),
				'validation' => ['rules' => 'required']
			],
			'menu_icon'   => [
				'property'   => 'dropdown',
				'name'       => 'menu_icon',
				'id'         => 'menu_icon',
				'label'      => translate('form_label_menu_icon'),
				'class'      => 'form-control select-icons select-search',
				'options'    => $this->config->item('icons'),
				'selected'   => set_value('menu_icon'),
				'validation' => ['rules' => '']
			],
			'menu_parent' => [
				'property'   => 'dropdown',
				'name'       => 'menu_parent',
				'id'         => 'menu_parent',
				'label'      => translate('form_label_menu_parent'),
				'class'      => 'select-search',
				'options'    => $module_options,
				'selected'   => set_value('menu_parent'),
				'validation' => ['rules' => '']
			],
		];

		/* Validation set rules */
		foreach ($this->data['form_field']['general'] as $key => $value) {
			$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
		}

		foreach ($this->data['form_field']['menu'] as $key => $value) {
			$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
		}
		/* End validation set rules */

		$this->data['mysql_data_types'] = $this->config->item('list');
		$this->data['rules']            = $this->config->item('rules');
		$this->data['elements']         = $this->config->item('elements');

		if ($this->input->method() == 'post')
		{

			if ($this->input->post('general'))
			{

				$this->load->dbforge();
				
				foreach ($this->input->post('general') as $general)
				{
					$db_fields_post[] = [
						'name'           => $general['column'],
						'type'           => (isset($general['type'])) ? strtolower($general['type']) : 'int',
						'max_length'     => $general['length'],
						'primary_key'    => (isset($general['primary'])) ? 1 : 0,
						'default'        => (isset($general['default']) && !empty($general['default'])) ? $general['default'] : '',
						'auto_increment' => (isset($general['auto_increment'])) ? 1 : 0,
						'null'           => (isset($general['null'])) ? 1 : 0
					];

					$this->data['fields']['general'][$general['column']] = [
						'show_on_form'  => (isset($general['show_on_form'])) ? 1 : 0,
						'show_on_table' => (isset($general['show_on_table'])) ? 1 : 0,
						'element'       => (isset($general['element'])) ? $general['element'] : '',
						'class'         => (isset($general['class'])) ? $general['class'] : '',
						'table'         => (isset($general['table'])) ? $general['table'] : '',
						'label'         => $general['label'],
						'placeholder'   => $general['placeholder'],
					];
				}


				$this->data['db_fields_general'] = json_decode(json_encode($db_fields_post));
			}

			if ($this->form_validation->run() == TRUE)
			{
				if ($this->input->post('general'))
				{
					foreach ($this->input->post('general') as $general)
					{
						if ($general['column'])
						{
							// Primary key data type INT
							if (isset($general['primary']) && $general['primary'] == 1) {
								$general['type']           = 'INT';
								$general['auto_increment'] = TRUE;
								$general['null']           = FALSE;
								$general['default']        = NULL;
								$this->dbforge->add_key($general['column'], TRUE);
							}
							else {
								if (!isset($general['null'])) {
									$general['null'] = FALSE;
								}

								if (!isset($general['default']) || empty($general['default'])) {
									$general['default'] = FALSE;
								}

								$general['auto_increment'] = FALSE;
							}


							if (in_array($general['type'], ['TEXT', 'DATETIME']))
							{
								$db_fields[$general['column']] = [
									'type'           => $general['type'],
									'auto_increment' => (bool) $general['auto_increment'],
									'null'           => (bool) $general['null'],
									'unique'         => FALSE,
									'unsigned'       => FALSE
								];
							}
							else
							{
								$db_fields[$general['column']] = [
									'type'           => $general['type'],
									'constraint'     => $general['length'],
									'auto_increment' => (bool) $general['auto_increment'],
									'default'        => $general['default'],
									'null'           => (bool) $general['null'],
									'unique'         => FALSE,
									'unsigned'       => FALSE
								];
							}
						}
					}


					// Auto Fields
					$db_fields['created_at'] = [
						'type'           => 'datetime',
						'auto_increment' => FALSE,
						'null'           => FALSE,
						'unique'         => FALSE,
						'unsigned'       => FALSE
					];

					$db_fields['created_by'] = [
						'type'           => 'int',
						'constraint'     => 11,
						'auto_increment' => FALSE,
						'default'        => 0,
						'unique'         => FALSE,
						'unsigned'       => FALSE
					];

					$db_fields['updated_at'] = [
						'type'           => 'datetime',
						'auto_increment' => FALSE,
						'null'           => TRUE,
						'unique'         => FALSE,
						'unsigned'       => FALSE
					];

					$db_fields['updated_by'] = [
						'type'           => 'int',
						'constraint'     => 11,
						'auto_increment' => FALSE,
						'default'        => 0,
						'unique'         => FALSE,
						'unsigned'       => FALSE
					];

					$db_fields['deleted_at'] = [
						'type'           => 'datetime',
						'auto_increment' => FALSE,
						'null'           => TRUE,
						'unique'         => FALSE,
						'unsigned'       => FALSE
					];

					$db_fields['deleted_by'] = [
						'type'           => 'int',
						'constraint'     => 11,
						'auto_increment' => FALSE,
						'default'        => 0,
						'unique'         => FALSE,
						'unsigned'       => FALSE
					];

					//Create Table
					$this->dbforge->add_field($db_fields);
					$attributes = ['ENGINE' => 'InnoDB'];

					if ($this->dbforge->create_table($this->input->post('slug'), TRUE))
					{
						if ($this->input->post('multilingual'))
						{
							if ($this->input->post('translation'))
							{
								$db_fields_translation[$this->input->post('slug') . '_id'] = [
									'type'           => 'int',
									'constraint'     => 11,
									'auto_increment' => FALSE,
									'default'        => 0,
									'unique'         => FALSE,
									'unsigned'       => FALSE
								];

								$db_fields_translation['language_id'] = [
									'type'           => 'int',
									'constraint'     => 11,
									'auto_increment' => FALSE,
									'default'        => 0,
									'unique'         => FALSE,
									'unsigned'       => FALSE
								];

								foreach ($this->input->post('translation') as $translation)
								{
									if (!isset($translation['null']))
									{
										$translation['null'] = FALSE;
									}



									$db_fields_translation[$translation['column']] = [
										'type'           => $translation['type'],
										'constraint'     => (int) $translation['length'],
										'auto_increment' => FALSE,
										'default'        => $translation['default'],
										'null'           => (bool) $translation['null'],
										'unique'         => FALSE,
										'unsigned'       => FALSE
									];
								}

								$this->dbforge->add_field($db_fields_translation);
								$attributes = ['ENGINE' => 'InnoDB'];
								$this->dbforge->create_table($this->input->post('slug') . '_translation', TRUE);
							}
						}

						
						if ($this->input->post('general'))
						{
							foreach ($this->input->post('general') as $general)
							{
								if ($general['column'])
								{								
									
									$rules_array = [];
									if (isset($general['rules']) && !empty($general['rules']))
									{
										foreach ($general['rules'] as $key => $rules)
										{
											$rules_array[] = [
												'rules'          => $rules,
												'rules_parametr' => (isset($general['rules_parametr'][$key])) ? $general['rules_parametr'][$key] : NULL
											];
										}
									}


									$relation = [];
									if (isset($general['connected']) && !empty($general['connected']))
									{
										$relation[] = [
											'table'			=> $general['connected'],
											'key'			=> $general['connected_key'],
											'value'			=> $general['connected_value']
										];
									}

									$form_fields['general'][$general['column']] = [
										'column'         => $general['column'],
										'show_on_table'  => (isset($general['show_on_table'])) ? 1 : 0,
										'table_function' => (isset($general['table_function'])) ? $general['table_function'] : '',
										'show_on_form'   => (isset($general['show_on_form'])) ? 1 : 0,
										'form_function'  => (isset($general['form_function'])) ? $general['form_function'] : '',
										'element'        => (isset($general['element'])) ? $general['element'] : '',
										'class'          => (isset($general['class'])) ? $general['class'] : '',
										'relation'		 => $relation,
										'table'          => (isset($general['table'])) ? $general['table'] : [],
										'label'          => (isset($general['label'])) ? $general['label'] : [],
										'placeholder'    => (isset($general['placeholder'])) ? $general['placeholder'] : [],
										'rules'          => $rules_array
									];

									if (isset($general['search_field']))
									{
										$search_field = $general['column'];
									}
								}
							}
						}

						if ($this->input->post('translation'))
						{
							foreach ($this->input->post('translation') as $translation)
							{
								if ($translation['column'])
								{
									$rules_array = [];
									if (isset($translation['rules']) && !empty($translation['rules']))
									{
										foreach ($translation['rules'] as $key => $rules)
										{
											$rules_array[] = [
												'rules'          => $rules,
												'rules_parametr' => (isset($translation['rules_parametr'][$key])) ? $translation['rules_parametr'][$key] : NULL
											];
										}
									}

									$form_fields['translation'][$translation['column']] = [
										'column'         => $translation['column'],
										'show_on_table'  => (isset($translation['show_on_table'])) ? 1 : 0,
										'table_function' => (isset($translation['table_function'])) ? $translation['table_function'] : '',
										'show_on_form'   => (isset($translation['show_on_form'])) ? 1 : 0,
										'form_function'  => (isset($translation['form_function'])) ? $translation['form_function'] : '',
										'element'        => (isset($translation['element'])) ? $translation['element'] : '',
										'class'          => (isset($translation['class'])) ? $translation['class'] : '',
										'table'          => (isset($translation['table'])) ? $translation['table'] : [],
										'label'          => (isset($translation['label'])) ? $translation['label'] : [],
										'placeholder'    => (isset($translation['placeholder'])) ? $translation['placeholder'] : [],
										'rules'          => $rules_array
									];
								}
							}
						}

						$module_data = [
							'name'             => json_encode($this->input->post('text')),
							'slug'             => strtolower($this->input->post('slug')),
							'methods'          => json_encode($this->input->post('method')),
							'status'           => (int) $this->input->post('status'),
							'multilingual'     => ($this->input->post('multilingual')) ? 1 : 0,
							'search_field'     => $search_field,
							'default_sort'     => json_encode(['column' => 'created_at', 'sort' => 'DESC']),
							'per_page'         => (int) $this->input->post('per_page'),
							'fields'           => json_encode($form_fields),
							'menu_sort'        => (int) $this->input->post('menu_sort'),
							'menu_status'      => (int) $this->input->post('menu_status'),
							'menu_name'        => json_encode($this->input->post('menu_name')),
							'menu_icon'        => $this->input->post('menu_icon'),
							'menu_parent'      => (int) $this->input->post('menu_parent'),
							'language_id'      => (int) $this->input->post('language_id')
						];

						$this->{$this->model}->insert($module_data);
						redirect($this->directory . $this->controller);
					}
					else
					{
						$this->data['message'] = 'Modul üçün məlumat bazası table yaradıla bilmədi';
					}
				}
				else {
					$this->data['message'] = 'Modul üçün ən azı bir sahə yaratmalısınızs';
				}
			}
			else {
				$this->data['message'] = translate('error_warning', true);
			}
		}

		//Buttons
		$this->data['buttons'][] = [
			'type'       => 'button',
			'text'       => translate('form_button_save'),
			'class'      => 'btn btn-primary btn-labeled heading-btn',
			'id'         => 'save',
			'icon'       => 'icon-floppy-disk',
			'additional' => [
				'onclick'    => "if(confirm('".translate('are_you_sure', true)."')){ $('#form-save').submit(); }else{ return false; }",
				'form'       => 'form-save',
				'formaction' => current_url()
			]
		];

		$this->render('form');
	}

	public function edit($id = false)
	{
		if ($id)
		{
			$this->data['title']    = translate('edit_title');
			$this->data['subtitle'] = translate('edit_description');

			// Get module data
			$row                     = $this->{$this->model}->fields()->filter(['id' => $id])->one();
			$this->data['all_table'] = $this->{$this->model}->get_table();

			//Get All Callback Method in Custom_model
			$methods = get_class_methods('Custom_model');

			if ($methods)
			{
				foreach ($methods as $method)
				{
					if (strpos($method, 'callback_') !== false)
					{
						$this->data['methods'][] = str_replace('callback_', '', $method);
					}
				}
			}

			// Get All Language
			if ($this->data['languages'])
			{
				$language_options[0] = translate('please_select');
				foreach ($this->data['languages'] as $language)
				{
					$language_options[$language['id']] = $language['name'];
				}
			}
			else
			{
				$language_options = [];
			}

			// Get All Active Module
			$modules = $this->{$this->model}->fields(['id', 'name'])->filter(['status' => 1])->all();

			if ($modules) {
				$module_options[0] = translate('please_select');
				foreach ($modules as $module)
				{
					if ($module->id != $id)
					{
						$module_options[$module->id] = json_decode($module->name)->index->title->{$this->data['current_lang']};
					}
				}
			}
			else
			{
				$module_options = [];
			}

			$this->load->model('Group_model');
			$this->data['user_groups'] = $this->Group_model->fields(['id', 'name'])->all();
			$this->data['method_list'] = ['index', 'trash', 'show', 'create', 'edit', 'delete', 'restore', 'remove', 'clean'];


			// Module default sort data
			$default_sort = json_decode($row->default_sort);


			$this->data['text']      = json_decode($row->name, TRUE);
			$this->data['menu_name'] = json_decode($row->menu_name, TRUE);
			$this->data['fields']    = json_decode($row->fields, TRUE);

			$db_fields_generals           = $this->db->field_data($row->slug);
			if($db_fields_generals)
			{
				foreach($db_fields_generals as $db_fields_general)
				{
					$sort_options[$row->slug][$db_fields_general->name] = $db_fields_general->name;
				}
			}

			if ($row->multilingual == 1)
			{
				$db_fields_translations           = $this->db->field_data($row->slug . '_translation');
				if($db_fields_translations)
				{
					foreach($db_fields_translations as $db_fields_translation)
					{
						$sort_options[$row->slug . '_translation'][$db_fields_translation->name] = $db_fields_translation->name;
					}
				}
			}



			/* General field */
			$this->data['form_field']['general'] = [
				'slug'         => [
					'property'    => 'text',
					'name'        => 'slug',
					'class'       => 'form-control',
					'value'       => (set_value('slug')) ? set_value('slug') : $row->slug,
					'label'       => translate('form_label_slug'),
					'placeholder' => translate('form_placeholder_slug'),
					'validation'  => ['rules' => 'required|trim']
				],
				'multilingual' => [
					'property'   => 'checkbox',
					'name'       => 'multilingual',
					'id'         => 'multilingual',
					'label'      => translate('form_label_multilingual'),
					'class'      => 'styled',
					'value'      => 1,
					'checked'    => (set_value('multilingual') == 1 || $row->multilingual == 1) ? true : false,
					'validation' => ['rules' => '']
				],
				'language_id'  => [
					'property'   => 'dropdown',
					'name'       => 'language_id',
					'id'         => 'language_id',
					'label'      => translate('form_label_language_id'),
					'class'      => 'select-search',
					'options'    => $language_options,
					'selected'   => (set_value('language_id')) ? set_value('language_id') : $row->language_id,
					'validation' => ['rules' => '']
				],
				'status'       => [
					'property'   => 'dropdown',
					'name'       => 'status',
					'id'         => 'status',
					'label'      => translate('form_label_status'),
					'class'      => 'select',
					'options'    => [translate('disable', true), translate('enable', true)],
					'selected'   => (set_value('status')) ? set_value('status') : $row->status,
					'validation' => ['rules' => 'required']
				],
				'search_field'  => [
					'property'   => 'dropdown',
					'name'       => 'search_field',
					'id'         => 'search_field',
					'label'      => translate('form_label_search'),
					'class'      => 'select-search',
					'options'    => $sort_options,
					'selected'   => (set_value('search_field')) ? set_value('search_field') : $row->search_field,
					'validation' => ['rules' => 'required|trim']
				],
				'sort_column'  => [
					'property'   => 'dropdown',
					'name'       => 'sort_column',
					'id'         => 'sort_column',
					'label'      => translate('form_label_sort_column'),
					'class'      => 'select-search',
					'options'    => $sort_options,
					'selected'   => (set_value('sort_column')) ? set_value('sort_column') : $default_sort->column,
					'validation' => ['rules' => 'required|trim']
				],
				'sort_order'   => [
					'property'   => 'dropdown',
					'name'       => 'sort_order',
					'id'         => 'sort_order',
					'label'      => translate('form_label_sort_order'),
					'class'      => 'select',
					'options'    => ['ASC' => 'ASC', 'DESC' => 'DESC'],
					'selected'   => (set_value('sort_order')) ? set_value('sort_order') : $default_sort->sort,
					'validation' => ['rules' => 'required']
				],
				'per_page'     => [
					'property'   => 'dropdown',
					'name'       => 'per_page',
					'id'         => 'per_page',
					'label'      => translate('form_label_per_page'),
					'class'      => 'select',
					'options'    => ['10' => '10', '20' => '20', '50' => '50', '100' => '100', '200' => '200'],
					'selected'   => (set_value('per_page')) ? set_value('per_page') : $row->per_page,
					'validation' => ['rules' => 'required']
				],
			];


			/* Menu field */
			$this->data['form_field']['menu'] = [
				'menu_sort'   => [
					'property'    => 'number',
					'name'        => 'menu_sort',
					'class'       => 'form-control',
					'value'       => (set_value('menu_sort')) ? set_value('menu_sort') : $row->menu_sort,
					'label'       => translate('form_label_menu_sort'),
					'placeholder' => translate('form_placeholder_menu_sort'),
					'validation'  => ['rules' => '']
				],
				'menu_status' => [
					'property'   => 'dropdown',
					'name'       => 'menu_status',
					'id'         => 'menu_status',
					'label'      => translate('form_label_menu_status'),
					'class'      => 'bootstrap-select',
					'data-style' => 'btn-default btn-xs',
					'data-width' => '100%',
					'options'    => [translate('disable', true), translate('enable', true)],
					'selected'   => (set_value('menu_status')) ? set_value('menu_status') : $row->menu_status,
					'validation' => ['rules' => 'required']
				],
				'menu_icon'   => [
					'property'         => 'dropdown',
					'name'             => 'menu_icon',
					'id'               => 'menu_icon',
					'label'            => translate('form_label_menu_icon'),
					'class'            => 'select-icons select-search',
					'data-placeholder' => 'Select a state...',
					'options'          => $this->config->item('icons'),
					'selected'         => (set_value('menu_icon')) ? set_value('menu_icon') : $row->menu_icon,
					'validation'       => ['rules' => 'required']
				],
				'menu_parent' => [
					'property'   => 'dropdown',
					'name'       => 'menu_parent',
					'id'         => 'menu_parent',
					'label'      => translate('form_label_menu_parent'),
					'class'      => 'select-search',
					'options'    => $module_options,
					'selected'   => set_value('menu_parent'),
					'validation' => ['rules' => 'required']
				],
			];


			/* Validation set rules */
			foreach ($this->data['form_field']['general'] as $key => $value)
			{
				$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
			}


			foreach ($this->data['form_field']['menu'] as $key => $value)
			{
				$this->form_validation->set_rules($value['name'], $value['label'], $value['validation']['rules']);
			}
			/* End validation set rules */


			$this->data['mysql_data_types'] = $this->config->item('list');
			$this->data['rules']            = $this->config->item('rules');
			$this->data['elements']         = $this->config->item('elements');

			/* Database fields general */
			$db_fields_generals           = $this->db->field_data($row->slug);
			$protected_fields_for_general = ['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'];

			foreach ($db_fields_generals as $db_fields_general)
			{
				if (!in_array($db_fields_general->name, $protected_fields_for_general)) {
					$this->data['db_fields_general'][] = $db_fields_general;
				}
			}


			if ($row->multilingual == 1)
			{
				/* Database fields translation */
				$protected_fields_for_translation = [$row->slug . '_id', 'language_id'];
				$db_fields_translations           = $this->db->field_data($row->slug . '_translation');

				foreach ($db_fields_translations as $db_fields_translation)
				{
					if (!in_array($db_fields_translation->name, $protected_fields_for_translation))
					{
						$this->data['db_fields_translation'][] = $db_fields_translation;
					}
				}
			}


			//Buttons
			$this->data['buttons'][] = [
				'type'       => 'button',
				'text'       => translate('form_button_save'),
				'class'      => 'btn btn-primary btn-labeled heading-btn',
				'id'         => 'save',
				'icon'       => 'icon-floppy-disk',
				'additional' => [
					'onclick'    => "if(confirm('".translate('are_you_sure', true)."')){ $('#form-save').submit(); }else{ return false; }",
					'form'       => 'form-save',
					'formaction' => current_url()
				]
			];

			if ($this->input->method() == 'post')
			{
				if ($this->form_validation->run() == TRUE)
				{
					if ($this->input->post('general'))
					{
						foreach ($this->input->post('general') as $general)
						{
							if ($general['column'])
							{	
								$rules_array = [];
								if (isset($general['rules']) && !empty($general['rules']))
								{
									foreach ($general['rules'] as $key => $rules)
									{
										$rules_array[] = [
											'rules'          => $rules,
											'rules_parametr' => (isset($general['rules_parametr'][$key])) ? $general['rules_parametr'][$key] : NULL
										];
									}
								}


								$relation = [];
								if (isset($general['connected']) && !empty($general['connected']))
								{
									$relation[] = [
										'table'			=> $general['connected'],
										'key'			=> $general['connected_key'],
										'value'			=> $general['connected_value']
									];
								}

								$form_fields['general'][$general['column']] = [
									'column'         => $general['column'],
									'show_on_table'  => (isset($general['show_on_table'])) ? 1 : 0,
									'table_function' => (isset($general['table_function'])) ? $general['table_function'] : '',
									'show_on_form'   => (isset($general['show_on_form'])) ? 1 : 0,
									'form_function'  => (isset($general['form_function'])) ? $general['form_function'] : '',
									'element'        => (isset($general['element'])) ? $general['element'] : '',
									'class'          => (isset($general['class'])) ? $general['class'] : '',
									'relation'		 => $relation,
									'table'          => (isset($general['table'])) ? $general['table'] : [],
									'label'          => (isset($general['label'])) ? $general['label'] : [],
									'placeholder'    => (isset($general['placeholder'])) ? $general['placeholder'] : [],
									'rules'          => $rules_array
								];

							}
						}
					}

					if ($this->input->post('translation'))
					{
						foreach ($this->input->post('translation') as $translation)
						{
							if ($translation['column'])
							{
								$rules_array = [];
								if (isset($translation['rules']) && !empty($translation['rules']))
								{
									foreach ($translation['rules'] as $key => $rules)
									{
										$rules_array[] = [
											'rules'          => $rules,
											'rules_parametr' => (isset($translation['rules_parametr'][$key])) ? $translation['rules_parametr'][$key] : NULL
										];
									}
								}

								$form_fields['translation'][$translation['column']] = [
									'column'         => $translation['column'],
									'show_on_table'  => (isset($translation['show_on_table'])) ? 1 : 0,
									'table_function' => (isset($translation['table_function'])) ? $translation['table_function'] : '',
									'show_on_form'   => (isset($translation['show_on_form'])) ? 1 : 0,
									'form_function'  => (isset($translation['form_function'])) ? $translation['form_function'] : '',
									'element'        => (isset($translation['element'])) ? $translation['element'] : '',
									'class'          => (isset($translation['class'])) ? $translation['class'] : '',
									'table'          => (isset($translation['table'])) ? $translation['table'] : [],
									'label'          => (isset($translation['label'])) ? $translation['label'] : [],
									'placeholder'    => (isset($translation['placeholder'])) ? $translation['placeholder'] : [],
									'rules'          => $rules_array
								];
							}
						}
					}

					$extension_data = [
						'name'             => json_encode($this->input->post('text')),
						'slug'             => strtolower($this->input->post('slug')),
						'methods'          => json_encode($this->input->post('method')),
						'status'           => (int) $this->input->post('status'),
						'multilingual'     => ($this->input->post('multilingual')) ? 1 : 0,
						'search_field'     => $this->input->post('search_field'),
						'default_sort'     => json_encode(['column' => $this->input->post('sort_column'), 'sort' => $this->input->post('sort_order')]),
						'per_page'         => (int) $this->input->post('per_page'),
						'fields'           => json_encode($form_fields),
						'menu_sort'        => (int) $this->input->post('menu_sort'),
						'menu_status'      => (int) $this->input->post('menu_status'),
						'menu_name'        => json_encode($this->input->post('menu_name')),
						'menu_icon'        => $this->input->post('menu_icon'),
						'menu_parent'      => (int) $this->input->post('menu_parent'),
						'language_id'      => (int) $this->input->post('language_id')
					];

					$this->{$this->model}->update($extension_data, ['id' => $id]);

					redirect('admin/extension');
				}
			}

			$this->render('form');
		}
		else {
			show_404();
		}
	}

	public function database()
	{
		if ($this->input->method() == 'post')
		{
			$value						= $this->input->post('value');
			$param						= $this->input->post('param');
			$this->data['table_field']	= $this->{$this->model}->table_field($value);
			echo json_encode($this->data['table_field']);
		}
	}

	public function get_params()
	{
		if ($this->input->method() == 'post')
		{
			if ($this->input->post('method'))
			{
				$method			= $this->input->post('method');
				$classMethod	= new ReflectionMethod('Custom_model', 'callback_' . $method);
				$params			= $classMethod->getParameters();
				if ($params)
				{
					$this->data['params'] = [];
					foreach ($params as $param)
					{
						if ($param->name != 'data')
						{
							$this->data['params'][] = $param->name;
						}
					}

					echo json_encode($this->data['params']);
				}
			}
		}
	}

}
