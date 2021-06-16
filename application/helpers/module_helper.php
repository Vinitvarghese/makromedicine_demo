<?php

if(!function_exists('module_setting'))
{
    function module_setting($module_name)
    {
        $CI =& get_instance();
        
        $CI->db->where('slug', $module_name);
        $query = $CI->db->get('modules');

        if($query->num_rows() === 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }
}