<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Sidebar
{

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('Admin_menu_model');
		$this->CI->load->model('Extension_model');
		$this->CI->load->model('Suggestion_model');
	}

	public function getMenu($parent = 0)
	{
		
		$menus = $this->CI->Admin_menu_model->filter(['status' => 1, 'parent' => $parent])->order_by('sort', 'ASC')->all();

		if ($menus) {
			$navbar_menu = [];
			foreach ($menus as $menu) {
					$navbar_menu[] = $this->formatMenu($menu);
			}
			return $navbar_menu;
		}
		return [];
	}

	public function formatMenu($menu)
	{

		$name = valid_lang(json_decode($menu->name));

		if($menu->module == 0)
		{
			if($menu->static == 1)
			{
				$menu = [
					'href'		=> site_url_multi(get_setting('admin_url').'/' . $menu->link),
					'icon'		=> $menu->icon,
					'name'		=> $name,
					'active'	=> 0,
					'target'	=> $menu->target,
					'parent'	=> $this->getMenu($menu->id)
				];
				$menu['sug_count'] = 0;
			}
			else
			{
				$link = valid_lang(json_decode($menu->link));

				$menu = [
					'href'		=> $link,
					'icon'		=> $menu->icon,
					'name'		=> $name,
					'active'	=> 0,
					'target'	=> $menu->target,
					'parent'	=> $this->getMenu($menu->id)
				];
				$menu['sug_count'] = 0;
			}
		}
		else
		{
			$module = $this->CI->Extension_model->filter(['id' => $menu->module])->one();
			$menu = [
				'href'		=> site_url_multi(get_setting('admin_url').'/' . $module->slug),
				'icon'		=> $menu->icon,
				'name'		=> $name,
				'active'	=> 0,
				'target'	=> $menu->target,
				'parent'	=> $this->getMenu($menu->id)
			];

			$menu['sug_count'] = 0;


			$sug_count_query = $this->CI->Suggestion_model->filter(['type' => $module->slug])->get_count_rows();
			if($sug_count_query) {

				$sug_count = $sug_count_query;
				if($sug_count>0) $menu['sug_count'] = $sug_count;
			}
			
		}

		


		return $menu;
	}

}