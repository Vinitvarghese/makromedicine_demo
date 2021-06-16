<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('short_title'))
{
    function short_title($title, $after = '...', $length) {
        $mytitle = explode(' ', $title, $length);
        if (count($mytitle) >= $length)
        {
            array_pop($mytitle);
            $mytitle = implode(" ",$mytitle).$after;
        }
        else
        {
            $mytitle = implode(" ",$mytitle);
        }
        return $mytitle;
    }
}
