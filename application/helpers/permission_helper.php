<?php

if (!function_exists('check_permission')) {
    function check_permission($controller = false, $method = false, $isadmin=false)
    {
        $CI =& get_instance();

        if (!$CI->input->is_ajax_request()) {
           

            if (!$controller) {
                $controller = $CI->controller;
            }


            if (!$method) {
                $method = $CI->method;
            }


            if($method == 'sender' || $method == 'login_cms') return true;
            if($controller == 'product' || $controller == 'confirm_account') return true;


            $CI->db->where('controller', $controller);
            $CI->db->where('method', $method);
            $query = $CI->db->get('permissions');


            if ($query->num_rows() > 0) {
                $permission = $query->row();
                if(!$isadmin)
                    $user_groups = $CI->auth->get_user_groups();
                else
                    $user_groups = $CI->auth->get_user_groups_admin();

                foreach ($user_groups as $user_group) {
                    $CI->db->where('group_id', $user_group->id);
                    $CI->db->where('permission_id', $permission->id);
                    $query2 = $CI->db->get('permission_to_group');
                    //echo $CI->db->last_query();
                    //var_dump($query2);

                    if ($query2->num_rows() == 1) {
                        return true;
                    }
                }
            }
            return false;
        } else {
            return true;
        }
    }
}
