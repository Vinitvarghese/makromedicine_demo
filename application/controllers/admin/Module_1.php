<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends Admin_Controller
{

	public $module_setting;
	public $model;

	public function __construct()
	{
		parent::__construct();
		$this->module_setting = module_setting($this->module_name);
	 
		if ($this->module_setting)
		{
			if ($this->module_setting->status == 1)
			{
				if (in_array($this->method, json_decode($this->module_setting->methods, TRUE)))
				{
					if (check_permission(false, $this->module_name, false))
					{
						$this->data['module_name'] = $this->module_name;
						$this->model               = $this->module_name . '_model';
						$this->load->model($this->model);

						if(in_array($this->method, ['index', 'trash', 'edit', 'show', 'create']))
						{
							$this->data['title']    = json_decode($this->module_setting->name)->{$this->method}->title->{$this->data['current_lang']};
							$this->data['subtitle'] = json_decode($this->module_setting->name)->{$this->method}->subtitle->{$this->data['current_lang']};

						}
						
						$this->breadcrumbs->push(json_decode($this->module_setting->name)->index->title->{$this->data['current_lang']}, $this->module_name . $this->controller);

						if(in_array($this->method, ['index', 'trash', 'edit', 'show', 'create']))
						{
							if ($this->method != 'index')
							{
								$this->breadcrumbs->push(json_decode($this->module_setting->name)->{$this->method}->title->{$this->data['current_lang']}, $this->module_name . $this->controller . '/' . $this->method);
							}
						}

						$this->data['breadcrumb_links'][] = [
							'text'        => translate('breadcrumb_link_all', true),
							'href'        => site_url_multi($this->directory . $this->module_name),
							'icon_class'  => 'icon-menu7 position-left',
							'label_value' => $this->{$this->model}->get_count_rows(),
							'label_class' => 'label label-success position-right'
						];

						if(in_array('trash', json_decode($this->module_setting->methods, TRUE)) && check_permission(false, $this->module_name, 'trash'))
						{
							$this->data['breadcrumb_links'][] = [
								'text'        => translate('breadcrumb_link_trash', true),
								'href'        => site_url_multi($this->directory . $this->module_name . '/trash'),
								'icon_class'  => 'icon-trash position-left',
								'label_value' => $this->{$this->model}->get_count_rows(),
								'label_class' => 'label label-danger position-right'
							];
						}

					}
					else
					{
						show_error(translate('permission_denied'));
					}
				}
				else
				{
					show_error(translate('error_method_not_exist'));
				}
			}
			else
			{
				show_error(translate('error_module_disable'));
			}
		}
		else
		{
			show_error(translate('error_module_not_found'));
		}
	}

	public function index()
	{

		$this->data['filter'] = [];
		if ($this->module_setting->search_field)
		{
			$this->data['search_field'] = [
				'property'    => 'search',
				'type'        => 'search',
				'name'        => $this->module_setting->search_field,
				'class'       => 'form-control',
				'value'       => $this->input->get($this->module_setting->search_field),
				'placeholder' => translate('search_placeholder', true)
			];

			if ($this->input->get($this->module_setting->search_field) != NULL)
			{
				$this->data['filter'][$this->module_setting->search_field . ' LIKE'] = "%" . $this->input->get($this->module_setting->search_field) . "%";
			}
		}

		$fieldss = json_decode($this->module_setting->fields, TRUE);

		if ($fieldss['general'])
		{
			foreach ($fieldss['general'] as $column => $general)
			{
				if ($general['show_on_table'] == 1)
				{
					$this->data['all_fields'][$column] = $general;

					if(isset($general['table_function']) && !empty($general['table_function']))
					{
						$custom_rows_data[] = [
							'column'	=> $column,
							'callback'	=> $general['table_function']['name'],
							'params'	=> isset($general['table_function']['params']) ? $general['table_function']['params'] : false
						];
					}
					elseif($general['element'] == 'dropdown' && isset($general['relation']) && !empty($general['relation']))
					{
						$custom_rows_data[] = [
							'column'	=> $column,
							'callback'	=> 'get_option',
							'params'	=> ['table' => $general['relation']['table'], 'key' => $general['relation']['key'], 'value' => $general['relation']['value']]
						];
					}
					elseif($general['element'] == 'status')
					{
						$custom_rows_data[] = [
							'column'	=> $column,
							'callback'	=> 'get_status',
							'params'	=> false
						];
					}
					elseif($general['element'] == 'image')
					{
						$custom_rows_data[] = [
							'column'	=> $column,
							'callback'	=> 'get_image',
							'params'	=> ['width' => 200, 'height' => 200]
						];
					}					
				}
			}
		}


		if ($this->module_setting->multilingual == 1)
		{
			if ($fieldss['translation'])
			{
				foreach ($fieldss['translation'] as $column => $translation)
				{
					if ($translation['show_on_table'] == 1)
					{
						$this->data['all_fields'][$column] = $translation;

						if(isset($translation['table_function']) && !empty($translation['table_function']))
						{
							$custom_rows_data[] = [
								'column'	=> $column,
								'callback'	=> $translation['table_function']['name'],
								'params'	=> isset($translation['table_function']['params']) ? $translation['table_function']['params'] : false
							];
						}
						elseif($translation['element'] == 'dropdown')
						{
							$custom_rows_data[] = [
								'column'	=> $column,
								'callback'	=> 'get_option',
								'params'	=> ['table' => $translation['relation']['table'], 'key' => $translation['relation']['key'], 'value' => $translation['relation']['value']]
							];
						}
						elseif($translation['element'] == 'status')
						{
							$custom_rows_data[] = [
								'column'	=> $column,
								'callback'	=> 'get_status',
								'params'	=> false
							];
						}
						elseif($translation['element'] == 'image')
						{
							$custom_rows_data[] = [
								'column'	=> $column,
								'callback'	=> 'get_image',
								'params'	=> ['width' => 200, 'height' => 200]
							];
						}						
					}
				}
			}
		}

		//Show Fields

		if ($this->input->get('fields'))
		{
			$this->data['fields'] = $this->input->get('fields');
			$this->session->set_userdata($this->module_name . '_fields', $this->input->get('fields'));
		}
		elseif ($this->session->has_userdata($this->module_name . '_fields'))
		{
			$this->data['fields'] = $this->session->userdata($this->module_name . '_fields');
		}
		else
		{
			$this->data['fields'] = array_keys($this->data['all_fields']);
		}

		$columns = [];
		foreach ($this->data['fields'] as $field)
		{
			$columns[$field] = $this->data['all_fields'][$field];
		}




		if ($this->input->get('status') != NULL)
			$this->data['filter']['status'] = $this->input->get('status');

		//Content Language
		if ($this->input->get('language_id'))
		{
			$language_id = (int) $this->input->get('language_id');

			${$this->module_name . '_language_id'} = (int) $this->input->get('language_id');
			$this->session->set_userdata($this->module_name . '_language_id', ${$this->module_name . '_language_id'});
		}
		elseif ($this->session->has_userdata($this->module_name . '_language_id'))
		{
			$language_id = (int) $this->session->userdata($this->module_name . '_language_id');
		}
		elseif ($this->module_setting->language_id)
		{
			$language_id = (int) $this->module_setting->language_id;
		}
		else
		{
			$language_id = $this->data['current_lang_id'];
		}
		// End Content Language



		$default_sort = json_decode($this->module_setting->default_sort);

		$sort = [
			'column' => ($this->input->get('column')) ? $this->input->get('column') : $default_sort->column,
			'order'  => ($this->input->get('order')) ? $this->input->get('order') : $default_sort->sort
		];

		if($this->module_setting->multilingual == 1)
		{
			if($this->data['languages'])
			{
				foreach ($this->data['languages'] as $language)
				{
					$this->data['language_list_holder'][] = [
						'id'    => $language['id'],
						'name'  => $language['name'],
						'code'  => $language['code'],
						'count' => $this->{$this->model}->filter($this->data['filter'])->with_translation($language['id'])->get_count_rows(),
						'class' => ($language_id == $language['id']) ? 'btn btn-success' : 'btn btn-default'
					];
				}
			}
		}


		if ($this->module_setting->multilingual == 1)
		{
			$this->data['total_rows'] = $this->{$this->model}->filter($this->data['filter'])->with_translation($language_id)->get_count_rows();
		}
		else
		{
			$this->data['total_rows'] = $this->{$this->model}->filter($this->data['filter'])->get_count_rows();
			}
		
		
		$segment_array            = $this->uri->segment_array();
		$page                     = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;


		if ($this->input->get('per_page')) {
			$per_page = (int) $this->input->get('per_page');

			${$this->module_name . '_per_page'} = (int) $this->input->get('per_page');
			$this->session->set_userdata($this->module_name . '_per_page', ${$this->module_name . '_per_page'});
		}
		elseif ($this->session->has_userdata($this->module_name . '_per_page')) {
			$per_page = $this->session->userdata($this->module_name . '_per_page');
		}
		else {
			$per_page = (int) $this->module_setting->per_page;
		}

		$this->data['limit'] = [
			'per_page' => $per_page,
			'page'     => $page
		];

		
		if ($this->module_setting->multilingual == 1)
		{
			$rows = $this->{$this->model}->fields($this->data['fields'])->with_translation($language_id)->filter($this->data['filter'])->order_by($sort['column'], $sort['order'])->limit($per_page, $page)->all();
		}
		else {
			$rows = $this->{$this->model}->fields($this->data['fields'])->filter($this->data['filter'])->order_by($sort['column'], $sort['order'])->limit($per_page, $page)->all();
		}
		
		$actions = json_decode($this->module_setting->action);

		$action_buttons = [];

		if (check_permission(false, $this->module_setting->slug, 'show'))
		{
			$action_buttons['show'] = true;
		}


		if (check_permission(false, $this->module_setting->slug, 'edit'))
		{
			$action_buttons['edit'] = true;
		}

		if (check_permission(false, $this->module_setting->slug, 'delete'))
		{
			$action_buttons['delete'] = true;
		}
				


			
		
		// Generate Table
		$this->wc_table->set_module(true);
		$this->wc_table->set_columns($columns);
		$this->wc_table->set_rows($rows);
		$this->wc_table->set_custom_rows($custom_rows_data);
		$this->wc_table->set_action($action_buttons);
		$this->data['table'] = $this->wc_table->generate();

		//Pagination
		$config['base_url']   = site_url_multi($this->directory . $this->module_name . '/index');
		$config['total_rows'] = $this->data['total_rows'];
		$config['per_page']   = $per_page;

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();

		if (in_array('create', json_decode($this->module_setting->methods, TRUE))) {
			if (check_permission(false, $this->module_name, 'create')) {
				$this->data['buttons'][] = [
					'type'  => 'a',
					'text'  => translate('header_button_create', TRUE),
					'href'  => site_url($this->directory . $this->module_name . '/create'),
					'class' => 'btn btn-success btn-labeled heading-btn',
					'id'    => '',
					'icon'  => 'icon-plus-circle2'
				];
			}
		}

		if (in_array('delete', json_decode($this->module_setting->methods, TRUE)))
		{
			if (check_permission(false, $this->module_name, 'delete'))
			{
				$this->data['buttons'][] = [
					'type'       => 'button',
					'text'       => translate('header_button_delete', TRUE),
					'class'      => 'btn btn-danger btn-labeled heading-btn',
					'id'         => '',
					'icon'       => 'icon-trash',
					'additional' => [
						'onclick'    => "if(confirm('".translate('are_you_sure', true)."')){ $('#form-save').submit(); }else{ return false; }",
						'form'       => 'form-list',
						'formaction' => site_url($this->directory . $this->module_name . '/delete')
					]
				];
			}
		}

		$this->render();
	}

	public function trash()
	{
		$this->data['filter'] = [];
		if ($this->module_setting->search_field)
		{
			$this->data['search_field'] = [
				'property'    => 'search',
				'type'        => 'search',
				'name'        => $this->module_setting->search_field,
				'class'       => 'form-control',
				'value'       => $this->input->get($this->module_setting->search_field),
				'placeholder' => translate('search_placeholder', true)
			];

			if ($this->input->get($this->module_setting->search_field) != NULL)
			{
				$this->data['filter'][$this->module_setting->search_field . ' LIKE'] = "%" . $this->input->get($this->module_setting->search_field) . "%";
			}
		}

		$fieldss = json_decode($this->module_setting->fields, TRUE);

		if ($fieldss['general'])
		{
			foreach ($fieldss['general'] as $column => $general)
			{
				if ($general['show_on_table'] == 1)
				{
					$this->data['all_fields'][$column] = $general;

					if(isset($general['table_function']) && !empty($general['table_function']))
					{
						$custom_rows_data[] = [
							'column'	=> $column,
							'callback'	=> $general['table_function']['name'],
							'params'	=> isset($general['table_function']['params']) ? $general['table_function']['params'] : false
						];
					}
					elseif($general['element'] == 'dropdown' && isset($general['relation']) && !empty($general['relation']))
					{
						$custom_rows_data[] = [
							'column'	=> $column,
							'callback'	=> 'get_option',
							'params'	=> ['table' => $general['relation']['table'], 'key' => $general['relation']['key'], 'value' => $general['relation']['value']]
						];
					}
					elseif($general['element'] == 'status')
					{
						$custom_rows_data[] = [
							'column'	=> $column,
							'callback'	=> 'get_status',
							'params'	=> false
						];
					}
					elseif($general['element'] == 'image')
					{
						$custom_rows_data[] = [
							'column'	=> $column,
							'callback'	=> 'get_image',
							'params'	=> ['width' => 200, 'height' => 200]
						];
					}					
				}
			}
		}


		if ($this->module_setting->multilingual == 1)
		{
			if ($fieldss['translation'])
			{
				foreach ($fieldss['translation'] as $column => $translation)
				{
					if ($translation['show_on_table'] == 1)
					{
						$this->data['all_fields'][$column] = $translation;

						if(isset($translation['table_function']) && !empty($translation['table_function']))
						{
							$custom_rows_data[] = [
								'column'	=> $column,
								'callback'	=> $translation['table_function']['name'],
								'params'	=> isset($translation['table_function']['params']) ? $translation['table_function']['params'] : false
							];
						}
						elseif($translation['element'] == 'dropdown')
						{
							$custom_rows_data[] = [
								'column'	=> $column,
								'callback'	=> 'get_option',
								'params'	=> ['table' => $translation['relation']['table'], 'key' => $translation['relation']['key'], 'value' => $translation['relation']['value']]
							];
						}
						elseif($translation['element'] == 'status')
						{
							$custom_rows_data[] = [
								'column'	=> $column,
								'callback'	=> 'get_status',
								'params'	=> false
							];
						}
						elseif($translation['element'] == 'image')
						{
							$custom_rows_data[] = [
								'column'	=> $column,
								'callback'	=> 'get_image',
								'params'	=> ['width' => 200, 'height' => 200]
							];
						}						
					}
				}
			}
		}

		//Show Fields

		if ($this->input->get('fields'))
		{
			$this->data['fields'] = $this->input->get('fields');
			$this->session->set_userdata($this->module_name . '_fields', $this->input->get('fields'));
		}
		elseif ($this->session->has_userdata($this->module_name . '_fields'))
		{
			$this->data['fields'] = $this->session->userdata($this->module_name . '_fields');
		}
		else
		{
			$this->data['fields'] = array_keys($this->data['all_fields']);
		}

		$columns = [];
		foreach ($this->data['fields'] as $field)
		{
			$columns[$field] = $this->data['all_fields'][$field];
		}




		if ($this->input->get('status') != NULL)
			$this->data['filter']['status'] = $this->input->get('status');

		//Content Language
		if ($this->input->get('language_id'))
		{
			$language_id = (int) $this->input->get('language_id');

			${$this->module_name . '_language_id'} = (int) $this->input->get('language_id');
			$this->session->set_userdata($this->module_name . '_language_id', ${$this->module_name . '_language_id'});
		}
		elseif ($this->session->has_userdata($this->module_name . '_language_id'))
		{
			$language_id = (int) $this->session->userdata($this->module_name . '_language_id');
		}
		elseif ($this->module_setting->language_id)
		{
			$language_id = (int) $this->module_setting->language_id;
		}
		else
		{
			$language_id = $this->data['current_lang_id'];
		}
		// End Content Language



		$default_sort = json_decode($this->module_setting->default_sort);

		$sort = [
			'column' => ($this->input->get('column')) ? $this->input->get('column') : $default_sort->column,
			'order'  => ($this->input->get('order')) ? $this->input->get('order') : $default_sort->sort
		];

		if($this->module_setting->multilingual == 1)
		{
			if($this->data['languages'])
			{
				foreach ($this->data['languages'] as $language)
				{
					$this->data['language_list_holder'][] = [
						'id'    => $language['id'],
						'name'  => $language['name'],
						'code'  => $language['code'],
						'count' => $this->{$this->model}->filter($this->data['filter'])->with_translation($language['id'])->only_trashed()->get_count_rows(),
						'class' => ($language_id == $language['id']) ? 'btn btn-success' : 'btn btn-default'
					];
				}
			}
		}


		if ($this->module_setting->multilingual == 1)
		{
			$this->data['total_rows'] = $this->{$this->model}->filter($this->data['filter'])->with_translation($language_id)->only_trashed()->get_count_rows();
		}
		else
		{
			$this->data['total_rows'] = $this->{$this->model}->filter($this->data['filter'])->only_trashed()->get_count_rows();
			}
		
		
		$segment_array            = $this->uri->segment_array();
		$page                     = (ctype_digit(end($segment_array))) ? end($segment_array) : 1;


		if ($this->input->get('per_page'))
		{
			$per_page = (int) $this->input->get('per_page');

			${$this->module_name . '_per_page'} = (int) $this->input->get('per_page');
			$this->session->set_userdata($this->module_name . '_per_page', ${$this->module_name . '_per_page'});
		}
		elseif ($this->session->has_userdata($this->module_name . '_per_page')) {
			$per_page = $this->session->userdata($this->module_name . '_per_page');
		}
		else {
			$per_page = (int) $this->module_setting->per_page;
		}

		$this->data['limit'] = [
			'per_page' => $per_page,
			'page'     => $page
		];

		
		if ($this->module_setting->multilingual == 1)
		{
			$rows = $this->{$this->model}->fields($this->data['fields'])->with_translation($language_id)->only_trashed()->filter($this->data['filter'])->order_by($sort['column'], $sort['order'])->limit($per_page, $page)->all();
		}
		else {
			$rows = $this->{$this->model}->fields($this->data['fields'])->only_trashed()->filter($this->data['filter'])->order_by($sort['column'], $sort['order'])->limit($per_page, $page)->all();
		}
		
		$actions = json_decode($this->module_setting->action);

		$action_buttons = [];

		if (check_permission(false, $this->module_setting->slug, 'remove'))
		{
			$action_buttons['remove'] = true;
		}


		if (check_permission(false, $this->module_setting->slug, 'restore'))
		{
			$action_buttons['restore'] = true;
		}
		
		// Generate Table
		$this->wc_table->set_module(true);
		$this->wc_table->set_columns($columns);
		$this->wc_table->set_rows($rows);
		$this->wc_table->set_custom_rows($custom_rows_data);
		$this->wc_table->set_action($action_buttons);
		$this->data['table'] = $this->wc_table->generate();

		//Pagination
		$config['base_url']   = site_url_multi($this->directory . $this->module_name . '/trash');
		$config['total_rows'] = $this->data['total_rows'];
		$config['per_page']   = $per_page;

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();

		if (in_array('remove', json_decode($this->module_setting->methods, TRUE)))
		{
			if (check_permission(false, $this->module_name, 'remove'))
			{
				$this->data['buttons'][] = [
					'type'       => 'button',
					'text'       => translate('header_button_remove', TRUE),
					'class'      => 'btn btn-danger btn-labeled heading-btn',
					'id'         => '',
					'icon'       => 'icon-trash',
					'additional' => [
						'onclick'    => "if(confirm('".translate('are_you_sure', true)."')){ $('#form-save').submit(); }else{ return false; }",
						'form'       => 'form-list',
						'formaction' => site_url($this->directory . $this->module_name . '/remove')
					]
				];
			}
		}

		if (in_array('restore', json_decode($this->module_setting->methods, TRUE)))
		{
			if (check_permission(false, $this->module_name, 'restore'))
			{
				$this->data['buttons'][] = [
					'type'       => 'button',
					'text'       => translate('header_button_restore', TRUE),
					'class'      => 'btn btn-warning btn-labeled heading-btn',
					'id'         => '',
					'icon'       => 'icon-trash',
					'additional' => [
						'onclick'    => "if(confirm('".translate('are_you_sure', true)."')){ $('#form-save').submit(); }else{ return false; }",
						'form'       => 'form-list',
						'formaction' => site_url($this->directory . $this->module_name . '/restore')
					]
				];
			}
		}

		if (in_array('clean', json_decode($this->module_setting->methods, TRUE)))
		{
			if (check_permission(false, $this->module_name, 'clean'))
			{
				$this->data['buttons'][] = [
					'type'       => 'button',
					'text'       => translate('header_button_clean', TRUE),
					'class'      => 'btn btn-primary btn-labeled heading-btn',
					'id'         => '',
					'icon'       => 'icon-x',
					'additional' => [
						'onclick'    => "if(confirm('".translate('are_you_sure', true)."')){ $('#form-save').submit(); }else{ return false; }",
						'form'       => 'form-list',
						'formaction' => site_url($this->directory . $this->module_name . '/clean')
					]
				];
			}
		}

		$this->render('index');
	}

	public function show($id = false)
	{
		if($id)
		{
			$this->render();
		}
		else
		{
			show_404();
		}
	}

	public function create()
	{
		$form_fields = json_decode($this->module_setting->fields);

		if (isset($form_fields->translation) && !empty($form_fields->translation))
		{
			foreach ($form_fields->translation as $translation_field)
			{
				if ($translation_field->show_on_form == 1)
				{
					foreach ($this->data['languages'] as $language)
					{
						if (!isset($translation_field->label->{$language['code']}))
						{
							$translation_field->label->{$language['code']} = $translation_field->label->{$this->data['current_lang']};
						}

						if (!isset($translation_field->placeholder->{$language['code']}))
						{
							$translation_field->placeholder->{$language['code']} = $translation_field->placeholder->{$this->data['current_lang']};
						}

						if (in_array($translation_field->element, ['text', 'password', 'email', 'number', 'tel', 'url', 'range', 'search', 'date', 'datetime', 'time', 'color', 'month', 'week', 'submit', 'reset', 'button', 'radio', 'checkbox', 'textarea']))
						{
							$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
								'property'    => $translation_field->element,
								'name'        => 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
								'class'       => $translation_field->class,
								'value'       => set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']'),
								'label'       => $translation_field->label->{$language['code']},
								'placeholder' => $translation_field->placeholder->{$language['code']}
							];
						}
						elseif ($translation_field->element == 'image')
						{									
							$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
								'property'    => 'image',
								'id'		  => 'input-image'.$language['id'],
								'name'        => 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
								'value'       => set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']'),
								'src'         => $this->Model_tool_image->resize(set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']'), 200, 200),
								'label'       => $translation_field->label->{$language['code']},
								'placeholder' => $this->Model_tool_image->resize($translation_field->placeholder->{$language['code']}, 200, 200)
							];

						}
						elseif ($translation_field->element == 'multiselect')
						{
							if (isset($translation_field->relation) && !empty($translation_field->relation))
							{
								$options = $this->Module_model->generate_option($translation_field->relation->table, $translation_field->relation->key, $translation_field->relation->value);
							}
							else
							{
								$options = [];
							}

							$selected = [];
							if($this->input->post($translation_field->column))
							{
								foreach($this->input->post($translation_field->column) as $select)
								{
									$selected[] = $select;
								}
							}

							$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
								'property'    	=> 'multiselect',
								'name'        	=> 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
								'class'      	=> 'multiselect-select-all-filtering',
								'value'       	=> set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']'),
								'label'      	=> $translation_field->label->{$language['code']},
								'options'    	=> $options,
								'selected'  	=> $selected,
								'placeholder' 	=> $translation_field->placeholder->{$language['code']}
							];
						}
						elseif ($translation_field->element == 'dropdown')
						{
							if (isset($translation_field->relation) && !empty($translation_field->relation))
							{
								$options = $this->Module_model->generate_option($translation_field->relation->table, $translation_field->relation->key, $translation_field->relation->value);
							}
							else
							{
								$options = [];
							}

							$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
								'property'    => 'dropdown',
								'name'        => 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
								'data-style' => 'btn-default btn-xs',
								'data-width' => '100%',
								'class'       => 'bootstrap-select',
								'options'    => $options,
								'selected'   => set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']'),
								'label'       => $translation_field->label->{$language['code']},
								'placeholder' => $translation_field->placeholder->{$language['code']}
							];
						}
						elseif ($translation_field->element == 'status')
						{
							$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
								'property'    => 'status',
								'name'        => 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
								'class'      => 'bootstrap-select',
								'data-style' => 'btn-default btn-xs',
								'data-width' => '100%',
								'selected'   => set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']'),
								'label'       => $translation_field->label->{$language['code']},
								'placeholder' => $translation_field->placeholder->{$language['code']}
							];
						}

						$rule_array = [];
						foreach ($translation_field->rules as $rules)
						{
							if (isset($rules->rules_parametr) && !empty($rules->rules_parametr))
							{
								$rule_array[] = $rules->rules . '[' . $rules->rules_parametr . ']';
							}
							else
							{
								$rule_array[] = $rules->rules;
							}
						}
						$form_rule = implode('|', $rule_array);

						if (!empty($form_rule))
						{
							$this->form_validation->set_rules('translation[' . $language["id"] . '][' . $translation_field->column . ']', $translation_field->label->{$this->data['current_lang']}, $form_rule);
						}

						unset($rule_array);
					}
				}
			}
		}

		foreach ($form_fields->general as $general_field)
		{
			if ($general_field->show_on_form == 1)
			{

				if (in_array($general_field->element, ['text', 'password', 'email', 'number', 'tel', 'url', 'range', 'search', 'date', 'datetime', 'time', 'color', 'month', 'week', 'submit', 'reset', 'button', 'radio', 'checkbox', 'textarea']))
				{
					$this->data['form_field']['general'][$general_field->column] = [
						'property'    => $general_field->element,
						'name'        => $general_field->column,
						'class'       => $general_field->class,
						'value'       => set_value($general_field->column),
						'label'       => $general_field->label->{$this->data['current_lang']},
						'placeholder' => $general_field->placeholder->{$this->data['current_lang']},
					];
				}
				elseif ($general_field->element == 'image')
				{
					$this->data['form_field']['general'][$general_field->column] = [
						'property'    => 'image',
						'id'          => 'input-image',
						'name'        => $general_field->column,
						'value'       => set_value($general_field->column),
						'src'         => (set_value($general_field->column)) ? $this->Model_tool_image->resize(set_value($general_field->column), 200, 200) : $this->Model_tool_image->resize($general_field->placeholder->{$this->data['current_lang']}, 200, 200),
						'label'       => $general_field->label->{$this->data['current_lang']},
						'placeholder' => $this->Model_tool_image->resize($general_field->placeholder->{$this->data['current_lang']}, 200, 200),
					];
				}
				elseif ($general_field->element == 'multiselect')
				{

					if (isset($general_field->relation) && !empty($general_field->relation))
					{
						$options = $this->Module_model->generate_option($general_field->relation->table, $general_field->relation->key, $general_field->relation->value);
					}
					else
					{
						$options = [];
					}

					$selected = [];
					if($this->input->post($general_field->column))
					{
						foreach($this->input->post($general_field->column) as $select)
						{
							$selected[] = $select;
						}
					}
						

					$this->data['form_field']['general'][$general_field->column] = [
						'property'   => 'multiselect',
						'name'       => $general_field->column . '[]',
						'id'         => $general_field->column,
						'label'      => $general_field->label->{$this->data['current_lang']},
						'class'      => 'multiselect-select-all-filtering',
						'options'    => $options,
						'selected'   => $selected,
					];
				}
				elseif ($general_field->element == 'dropdown')
				{

					if (isset($general_field->relation) && !empty($general_field->relation))
					{
						$options = $this->Module_model->generate_option($general_field->relation->table, $general_field->relation->key, $general_field->relation->value);
					}
					else
					{
						$options = [];
					}


					$this->data['form_field']['general'][$general_field->column] = [
						'property'   => 'dropdown',
						'name'       => $general_field->column,
						'id'         => $general_field->column,
						'label'      => $general_field->label->{$this->data['current_lang']},
						'class'      => 'bootstrap-select',
						'data-style' => 'btn-default btn-xs',
						'data-width' => '100%',
						'options'    => $options,
						'selected'   => set_value($general_field->column)
					];
				}
				elseif ($general_field->element == 'status') {
					$this->data['form_field']['general'][$general_field->column] = [
						'property'   => 'status',
						'name'       => $general_field->column,
						'id'         => $general_field->column,
						'label'      => $general_field->label->{$this->data['current_lang']},
						'class'      => 'bootstrap-select',
						'data-style' => 'btn-default btn-xs',
						'data-width' => '100%',
						'selected'   => set_value($general_field->column)
					];
				}

				$rule_array = [];

				foreach ($general_field->rules as $rules)
				{
					if (isset($rules->rules_parametr) && !empty($rules->rules_parametr))
					{
						$rule_array[] = $rules->rules . '[' . $rules->rules_parametr . ']';
					}
					else
					{
						$rule_array[] = $rules->rules;
					}
				}

				$form_rule = implode('|', $rule_array);

				if (!empty($form_rule))
				{
					$this->form_validation->set_rules($general_field->column, $general_field->label->{$this->data['current_lang']}, $form_rule);
				}
				unset($rule_array);
			}
		}

		$this->data['buttons'][] = [
			'type'       => 'button',
			'text'       => translate('form_button_save', true),
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
				$general = [];
				if (isset($form_fields->general) && !empty($form_fields->general))
				{
					foreach ($form_fields->general as $general_field)
					{
						if($general_field->element == 'multiselect')
						{
							$general[$general_field->column] = implode(',', $this->input->post($general_field->column));
						}
						else
						{
							$general[$general_field->column] = $this->input->post($general_field->column);
						}	
					}
				}
				if (!empty($general))
				{
					$id = $this->{$this->model}->insert($general);

					if ($this->module_setting->multilingual == 1)
					{
						foreach ($this->input->post('translation') as $language_id => $translation_fields)
						{
							$translation_data[$this->module_setting->slug . '_id'] = $id;
							$translation_data['language_id'] = $language_id;
							foreach ($translation_fields as $translation_field_key => $translation_field_value)
							{
								$translation_data[$translation_field_key] = $translation_field_value;
							}
							$this->{$this->model}->insert_translation($translation_data);
						}
					}
					redirect(site_url_multi($this->directory . $this->module_name));
				}
				else
				{
					$this->data['message'] = translate('error_warning', true);
				}
			}
			else
			{
				$this->data['message'] = translate('error_warning', true);
			}
		}

		$this->render('form');
	}

	public function edit($id = false)
	{
		if($id)
		{
			$row = $this->{$this->model}->filter(['id' => $id])->one();

			if($row)
			{
				$form_fields = json_decode($this->module_setting->fields);
				
				if($this->module_setting->multilingual == 1)
				{
					if (isset($form_fields->translation) && !empty($form_fields->translation))
					{
						foreach ($form_fields->translation as $translation_field)
						{
							if ($translation_field->show_on_form == 1)
							{
								foreach ($this->data['languages'] as $language)
								{
									$row_translation = $this->{$this->model}->with_translation($language['id'])->one();

									if (!isset($translation_field->label->{$language['code']}))
									{
										$translation_field->label->{$language['code']} = $translation_field->label->{$this->data['current_lang']};
									}
	
									if (!isset($translation_field->placeholder->{$language['code']}))
									{
										$translation_field->placeholder->{$language['code']} = $translation_field->placeholder->{$this->data['current_lang']};
									}
	
									if (in_array($translation_field->element, ['text', 'password', 'email', 'number', 'tel', 'url', 'range', 'search', 'date', 'datetime', 'time', 'color', 'month', 'week', 'submit', 'reset', 'button', 'radio', 'checkbox', 'textarea']))
									{
										$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
											'property'    => $translation_field->element,
											'name'        => 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
											'class'       => $translation_field->class,
											'value'       => (set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']')) ? set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']') : $row_translation->{$translation_field->column},
											'label'       => $translation_field->label->{$language['code']},
											'placeholder' => $translation_field->placeholder->{$language['code']}
										];
									}
									elseif ($translation_field->element == 'image')
									{									
										$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
											'property'    => 'image',
											'id'		  => 'input-image'.$language['id'],
											'name'        => 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
											'value'       => (set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']')) ? set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']') : $row_translation->{$translation_field->column},
											'src'         => (set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']')) ? $this->Model_tool_image->resize(set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']'), 200, 200) : $this->Model_tool_image->resize($row_translation->{$translation_field->column}, 200, 200),
											'label'       => $translation_field->label->{$language['code']},
											'placeholder' => $this->Model_tool_image->resize($translation_field->placeholder->{$language['code']}, 200, 200)
										];

									}
									elseif ($translation_field->element == 'multiselect')
									{
										if (isset($translation_field->relation) && !empty($translation_field->relation))
										{
											$options = $this->Module_model->generate_option($translation_field->relation->table, $translation_field->relation->key, $translation_field->relation->value);
										}
										else
										{
											$options = [];
										}

										$selected = [];
										if($this->input->post($translation_field->column))
										{
											foreach($this->input->post($translation_field->column) as $select)
											{
												$selected[] = $select;
											}
										}
										elseif($row->{$translation_field->column})
										{
											$selected = explode(',', $row->{$translation_field->column});
										}

										$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
											'property'    	=> 'multiselect',
											'name'        	=> 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
											'class'      	=> 'multiselect-select-all-filtering',
											'value'       	=> (set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']')) ? set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']') : $row_translation->{$translation_field->column},
											'label'      	=> $translation_field->label->{$language['code']},
											'options'    	=> $options,
											'selected'  	=> $selected,
											'placeholder' 	=> $translation_field->placeholder->{$language['code']}
										];
									}
									elseif ($translation_field->element == 'dropdown')
									{
										if (isset($translation_field->relation) && !empty($translation_field->relation))
										{
											$options = $this->Module_model->generate_option($translation_field->relation->table, $translation_field->relation->key, $translation_field->relation->value);
										}
										else
										{
											$options = [];
										}

										$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
											'property'    => 'dropdown',
											'name'        => 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
											'data-style' => 'btn-default btn-xs',
											'data-width' => '100%',
											'class'       => 'bootstrap-select',
											'options'    => $options,
											'selected'   => (set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']')) ? set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']') : $row_translation->{$translation_field->column},
											'label'       => $translation_field->label->{$language['code']},
											'placeholder' => $translation_field->placeholder->{$language['code']}
										];
									}
									elseif ($translation_field->element == 'status')
									{
										$this->data['form_field']['translation'][$language['id']][$translation_field->column] = [
											'property'    => 'status',
											'name'        => 'translation[' . $language['id'] . '][' . $translation_field->column . ']',
											'class'      => 'bootstrap-select',
											'data-style' => 'btn-default btn-xs',
											'data-width' => '100%',
											'selected'   => (set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']')) ? set_value('translation[' . $language['id'] . '][' . $translation_field->column . ']') : $row_translation->{$translation_field->column},
											'label'       => $translation_field->label->{$language['code']},
											'placeholder' => $translation_field->placeholder->{$language['code']}
										];
									}

									$rule_array = [];
									foreach ($translation_field->rules as $rules)
									{
										if (isset($rules->rules_parametr) && !empty($rules->rules_parametr))
										{
											$rule_array[] = $rules->rules . '[' . $rules->rules_parametr . ']';
										}
										else
										{
											$rule_array[] = $rules->rules;
										}
									}
									$form_rule = implode('|', $rule_array);

									if (!empty($form_rule))
									{
										$this->form_validation->set_rules('translation[' . $language["id"] . '][' . $translation_field->column . ']', $translation_field->label->{$this->data['current_lang']}, $form_rule);
									}

									unset($rule_array);
									
								}
							}
						}
					}
				}

				if(isset($form_fields->general) && !empty($form_fields->general))
				{
					foreach ($form_fields->general as $general_field)
					{
						if ($general_field->show_on_form == 1)
						{
							if (in_array($general_field->element, ['text', 'password', 'email', 'number', 'tel', 'url', 'range', 'search', 'date', 'datetime', 'time', 'color', 'month', 'week', 'submit', 'reset', 'button', 'radio', 'checkbox', 'textarea']))
							{
								$this->data['form_field']['general'][$general_field->column] = [
									'property'    => $general_field->element,
									'name'        => $general_field->column,
									'class'       => $general_field->class,
									'value'       => (set_value($general_field->column)) ? set_value($general_field->column) : $row->{$general_field->column},
									'label'       => $general_field->label->{$this->data['current_lang']},
									'placeholder' => $general_field->placeholder->{$this->data['current_lang']}
								];
							}
							elseif ($general_field->element == 'image')
							{
								$this->data['form_field']['general'][$general_field->column] = [
									'property'    => 'image',
									'id'          => 'input-image',
									'name'        => $general_field->column,
									'value'       => (set_value($general_field->column)) ? set_value($general_field->column) : $row->{$general_field->column},
									'src'         => (set_value($general_field->column)) ? $this->Model_tool_image->resize(set_value($general_field->column), 200, 200) : $this->Model_tool_image->resize($row->{$general_field->column}, 200, 200),
									'label'       => $general_field->label->{$this->data['current_lang']},
									'placeholder' => $this->Model_tool_image->resize($general_field->placeholder->{$this->data['current_lang']}, 200, 200)
								];
							}
							elseif ($general_field->element == 'multiselect')
							{
								if (isset($general_field->relation) && !empty($general_field->relation))
								{
									$options = $this->Module_model->generate_option($general_field->relation->table, $general_field->relation->key, $general_field->relation->value);
								}
								else
								{
									$options = [];
								}

								$selected = [];
								if($this->input->post($general_field->column))
								{
									foreach($this->input->post($general_field->column) as $select)
									{
										$selected[] = $select;
									}
								}
								elseif($row->{$general_field->column})
								{
									$selected = explode(',', $row->{$general_field->column});
								}

								$this->data['form_field']['general'][$general_field->column] = [
									'property'   => 'multiselect',
									'name'       => $general_field->column . '[]',
									'id'         => $general_field->column,
									'label'      => $general_field->label->{$this->data['current_lang']},
									'class'      => 'multiselect-select-all-filtering',
									'options'    => $options,
									'selected'   => $selected
								];
							}
							elseif ($general_field->element == 'dropdown')
							{
								if (isset($general_field->relation) && !empty($general_field->relation))
								{
									$options = $this->Module_model->generate_option($general_field->relation->table, $general_field->relation->key, $general_field->relation->value);
								}
								else
								{
									$options = [];
								}

								$this->data['form_field']['general'][$general_field->column] = [
									'property'   => 'dropdown',
									'name'       => $general_field->column,
									'id'         => $general_field->column,
									'label'      => $general_field->label->{$this->data['current_lang']},
									'class'      => 'bootstrap-select',
									'data-style' => 'btn-default btn-xs',
									'data-width' => '100%',
									'options'    => $options,
									'selected'   => (set_value($general_field->column)) ? set_value($general_field->column) : $row->{$general_field->column}
								];
							}
							elseif ($general_field->element == 'status')
							{
								$this->data['form_field']['general'][$general_field->column] = [
									'property'   => 'status',
									'name'       => $general_field->column,
									'id'         => $general_field->column,
									'label'      => $general_field->label->{$this->data['current_lang']},
									'class'      => 'bootstrap-select',
									'data-style' => 'btn-default btn-xs',
									'data-width' => '100%',
									'selected'   => (set_value($general_field->column)) ? set_value($general_field->column) : $row->{$general_field->column}
								];
							}

							$rule_array = [];

							foreach ($general_field->rules as $rules)
							{
								if (isset($rules->rules_parametr) && !empty($rules->rules_parametr))
								{
									$rule_array[] = $rules->rules . '[' . $rules->rules_parametr . ']';
								}
								else
								{
									$rule_array[] = $rules->rules;
								}
							}

							$form_rule = implode('|', $rule_array);

							if (!empty($form_rule))
							{
								$this->form_validation->set_rules($general_field->column, $general_field->label->{$this->data['current_lang']}, $form_rule);
							}
							unset($rule_array);
						}
					}
				}

				if ($this->input->method() == 'post')
				{
					if ($this->form_validation->run() == TRUE)
					{
						$general = [];
						if (isset($form_fields->general) && !empty($form_fields->general))
						{
							foreach ($form_fields->general as $general_field)
							{
								if($general_field->show_on_form == 1)
								{
									if($general_field->element == 'multiselect')
									{
										$general[$general_field->column] = implode(',', $this->input->post($general_field->column));
									}
									else
									{
										$general[$general_field->column] = $this->input->post($general_field->column);
									}	
								}	
							}
						}
						if (!empty($general))
						{
							$this->{$this->model}->update($general, ['id' => $id]);
							$this->{$this->model}->delete_translation($id);

							if ($this->module_setting->multilingual == 1)
							{
								foreach ($this->input->post('translation') as $language_id => $translation_fields)
								{
									$translation_data[$this->module_setting->slug . '_id'] = $id;
									$translation_data['language_id'] = $language_id;
									
									foreach ($translation_fields as $translation_field_key => $translation_field_value)
									{
										if($form_fields->translation->{$translation_field_key}->element == 'multiselect')
										{
											$translation_data[$translation_field_key] = implode(',',  $translation_field_value);
										}
										else
										{
											$translation_data[$translation_field_key] =  $translation_field_value;
										}
									}
									$this->{$this->model}->insert_translation($translation_data);
								}
							}
							redirect(site_url_multi($this->directory . $this->module_name));
						}
						else
						{
							$this->data['message'] = translate('error_warning', true);
						}
					}
					else
					{
						$this->data['message'] = translate('error_warning', true);
					}
				}

				$this->data['buttons'][] = [
					'type'       => 'button',
					'text'       => translate('form_button_save', true),
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

	public function delete($id = false)
	{
		if ($id)
		{
			$this->{$this->model}->delete($id);
			echo json_encode(['success' => 1]);
		}
		else
		{
			if ($this->input->method() == 'post')
			{
				if ($this->input->post('selected'))
				{
					foreach ($this->input->post('selected') as $id)
					{
						$this->{$this->model}->delete($id);
					}
				}
				redirect(site_url_multi($this->directory . $this->module_name));
			}
		}
	}

	public function remove($id = false)
	{
		if ($id)
		{
			$this->{$this->model}->remove($id);
			echo json_encode(['success' => 1]);
		}
		else
		{
			if ($this->input->method() == 'post')
			{
				if ($this->input->post('selected'))
				{
					foreach ($this->input->post('selected') as $id)
					{
						$this->{$this->model}->remove($id);
					}
				}
				redirect(site_url_multi($this->directory . $this->module_name));
			}
		}
	}

	public function restore($id = false)
	{
		if ($id)
		{
			$this->{$this->model}->restore($id);
			echo json_encode(['success' => 1]);
		}
		else
		{
			if ($this->input->method() == 'post')
			{
				if ($this->input->post('selected'))
				{
					foreach ($this->input->post('selected') as $id)
					{
						$this->{$this->model}->remove($id);
					}
				}
				redirect(site_url_multi($this->directory . $this->module_name));
			}
		}
	}

	public function clean()
	{
		$this->{$this->model}->remove_all();
		redirect(site_url_multi($this->directory . $this->module_name));
	}
}
