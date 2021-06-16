<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('get_user_data')) {
    function get_user_data($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('User_model');
            $user = $CI->User_model->filter(['id' => $id])->one();
            if ($user) {
                return $user;
            }
            return false;
        }
        return false;
    }
}
