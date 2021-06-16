<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends Webcoder_Controller {

	public $admin_theme = 'default/';

	public $module_name = 'dashboard';

	public $admin_url;

	public function __construct()
	{
		parent::__construct();

		$this->admin_url = 'admin';
		$this->data['admin_url'] = 'admin';

		$this->load->library('Sidebar');

		$this->load->library('Wc_table');
		$this->load->model('Company_name_model');
		$this->load->model('Confirm_account_model');
		$this->load->model('User_standart_model');
		$this->load->model('Product_model');
		$this->load->model('Suggestion_model');
		$this->data['admin_theme'] = $this->admin_theme;
		$this->data['admin_assets'] = 'templates/admin/'.$this->admin_theme.'assets';
		$this->data['per_page'] = get_setting('per_page');

		$this->data['scripts'] = '';
		//Per Page Options
		
		$per_page_lists = get_setting('per_page_list');

		if ($per_page_lists) {
			foreach ($per_page_lists as $per_page_list) {
				$this->data['per_page_lists'][$per_page_list] = $per_page_list;
			}
		}

		if ($this->controller != 'authentication') {


			if (!$this->auth->is_loggedin_admin() || !$this->auth->is_admin()) {
				redirect($this->admin_url.'/authentication/login');
				exit();
			}
			
			if (!check_permission(false,false,true) && $this->controller!='module') {
				show_error('Your are not permitted');
				exit();
			}
		}


		$this->data['user'] = $this->auth->get_user_admin();

		if($this->uri->segment(1).'/' == $this->directory)
		{
			$this->module_name = $this->uri->segment(2);
		}
		else
		{
			$this->module_name = $this->uri->segment(3);
		}

		//Sidebar Menu
		$this->data['sidebar_menus'] = $this->sidebar->getMenu();

		/* Load Breadcrumb Home Link */
		$this->breadcrumbs->push(translate('breadcrumb_home', true), $this->directory.'dashboard');

		if($this->directory != 'admin' && $this->controller != 'module')
		{
			$this->breadcrumbs->push(translate('index_title'), $this->directory.$this->controller);
		}

		$this->data['breadcrumbs'] = $this->breadcrumbs->show();

		//Default Error Delimiters
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		$this->data['copyright'] 	= sprintf(translate('footer_copyright', true), date('Y'), VERSION);
		$this->data['elapsed_time'] = $this->benchmark->elapsed_time();
		$this->data['memory_usage'] = $this->benchmark->memory_usage();

		$this->theme = get_setting('admin_theme');
		$this->data['admin_theme'] = base_url('templates/'.$this->admin_url.'/'.$this->theme);

		$this->data['get_new_company_name'] = $this->Company_name_model->filter(['status'=>0])->all_front();
		$this->data['get_comfirm_account']  = $this->Confirm_account_model->filter(['status'=>0,'user_id in (select id from wc_users where deleted_at is null)'=>NULL])->all_front();
		$this->data['get_user_standart']    = $this->User_standart_model->filter(['user_id in (select id from wc_users where deleted_at is null)'=>NULL,'user_id <> 1'=>NULL,'status'=>0])->all_front();
		$this->data['get_suggestion']    = $this->Suggestion_model->filter(['status'=>1])->all_front();
		$this->data['get_confirm_product']  = $this->Product_model->filter(['checked'=>0,'user_id in (select id from wc_users where deleted_at is null)'=>NULL])->all_front();
	//	echo '<pre>';var_dump($this->data['get_confirm_product']);echo '</pre>';

		if($this->data['get_new_company_name'] == false){
			$this->data['get_new_company_name'] = 0;
		}else{
			$this->data['get_new_company_name'] = count($this->data['get_new_company_name']);
		}
		if($this->data['get_comfirm_account'] == false){
			$this->data['get_comfirm_account'] = 0;
		}else{
			$this->data['get_comfirm_account'] = count($this->data['get_comfirm_account']);
		}
		if($this->data['get_confirm_product'] == false){
			$this->data['get_confirm_product'] = 0;
		}else{
			$this->data['get_confirm_product'] = count($this->data['get_confirm_product']);
		}
		
		if($this->data['get_user_standart'] == false){
			$this->data['get_user_standart'] = 0;
		}else{
			$this->data['get_user_standart'] = count($this->data['get_user_standart']);
		}


		if($this->data['get_suggestion'] == false){
			$this->data['get_suggestion'] = 0;
		}else{
			$this->data['get_suggestion'] = count($this->data['get_suggestion']);
		}


		//$this->debug($this->data['get_user_standart']);
		//Load Model Per Controller
		$this->load->model($this->model);
	}

	public function render($template = false, $layout = false)
	{
		//Düzəlt
		if(!$layout)
		{
			$this->data['layout'] = 'templates/admin/'.$this->admin_theme.'/layout/default.tpl';
		}
		else
		{
			$this->data['layout'] = 'templates/admin/'.$this->admin_theme.'/layout/'.$layout.'.tpl';
		}
		//Düzəlt

		if($template)
		{
			$template = 'templates/'.$this->directory.$this->admin_theme.$this->controller.'/'.$template;
		}
		else
		{
			$template = 'templates/'.$this->directory.$this->admin_theme.$this->controller.'/'.$this->method;
		}


		parent::render($template);
	}

	public function getMenu($parent = 0)
	{
		$this->db->where('menu_status', 1);
		$this->db->where('menu_parent', $parent);
		$this->db->order_by('menu_sort', 'ASC');
		$menu_query = $this->db->get('modules');

		if($menu_query->num_rows() > 0)
		{
			$sidebar_menus = [];
			foreach($menu_query->result() as $sidebar_menu)
			{
				if(check_permission(false, $sidebar_menu->slug, 'index'))
				{
					$sidebar_menus[] = $this->formatMenu($sidebar_menu);
				}
			}
			return $sidebar_menus;
		}
		return [];
	}

	public function formatMenu($sidebar_menu)
	{
		$menu = [
			'href'		=> site_url_multi('admin/'.$sidebar_menu->slug),
			'icon'		=> $sidebar_menu->menu_icon,
			'name'		=> json_decode($sidebar_menu->menu_name)->{$this->data['current_lang']},
			'active'	=> ($this->module_name == $sidebar_menu->slug) ? 1 : 0,
			'parent'    => $this->getMenu($sidebar_menu->id)
		];

		return $menu;
	}
}
