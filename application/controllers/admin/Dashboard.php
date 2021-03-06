<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Extension_model');
    }
    
    /**
    * public function index()
    * Runs as default when this controller requested if any other method is not specified in route file.
    * Sets all data which will be displayed on index page of this controller. At final sends data to target template.
    */
    
    public function index()
    {
        $this->data['title']			= translate('index_title');
        $this->data['subtitle']			= translate('index_description');
        
        $modules = $this->Extension_model->filter(['status' => 1])->order_by('menu_sort')->all();

        $data = [];
     
        if ($modules) {

            foreach ($modules as $module) {

                $name = (isset(json_decode($module->name)->index->title->{$this->data['current_lang']})) ? json_decode($module->name)->index->title->{$this->data['current_lang']} : json_decode($module->name)->index->title->{$this->data['default_language']};

                $model = $module->slug.'_model';

                $this->load->model('modules/'.$model);
                $mod = new stdClass();
                $mod->name = $name;
                $mod->icon = $module->icon;
                $mod->link = site_url_multi($this->admin_url.'/'.$module->slug);
                $mod->active_count = $this->{$model}->filter(['status' => 1])->count_rows();
                $mod->deactive_count = $this->{$model}->filter(['status' => 0])->count_rows();

                $data[] = $mod;
            }
        }

        $this->data['modules'] = $data;

        $this->template->render();
    }
}
