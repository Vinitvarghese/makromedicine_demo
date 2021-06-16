<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_event_type_name'))
{
    function get_event_type_name($id = false)
    {
        $CI = & get_instance();
        if ($id)
        {
            $CI->load->model('Event_type_model');
            $event_type = $CI->Event_type_model->filter(['id' => $id])->with_translation()->one();
            if ($event_type)
            {
                return $event_type->name;
            }
            return false;
        }
        return false;
    }

}
if (!function_exists('get_event_continent'))
{
    function get_event_continent($id = false)
    {
        $CI = & get_instance();
        if ($id)
        {
            $CI->load->model('Continent_model');
            $continent_name = $CI->Continent_model->filter(['id' => $id])->with_translation()->one();
            if ($continent_name)
            {
                return $continent_name->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_continent_id'))
{
    function get_continent_id($code = false)
    {
        $CI = & get_instance();
        if ($code)
        {
            $CI->load->model('Continent_model');
            $continent_name = $CI->Continent_model->filter(['code' => $code])->with_translation()->one();
            if ($continent_name)
            {
                return $continent_name->id;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_event_country'))
{
    function get_event_country($id = false)
    {
        $CI = & get_instance();
        if ($id)
        {
            $CI->load->model('Country_model');
            $country_name = $CI->Country_model->filter(['id' => $id])->with_translation()->one();
            if ($country_name)
            {
                return $country_name->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_event_currency'))
{
    function get_event_currency($id = false)
    {
        $CI = & get_instance();
        if ($id)
        {
            $CI->load->model('Currency_model');
            $currency_name = $CI->Currency_model->filter(['id' => $id])->with_translation()->one();
            if ($currency_name)
            {
                return $currency_name->symbol;
            }
            return false;
        }
        return false;
    }
}
