<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('site_url')) {
    function site_url($uri = '')
    {
        $CI =& get_instance();
        return $CI->config->site_url($uri);
    }
}

if (!function_exists('base_url')) {
    function base_url($uri = '')
    {
        $CI =& get_instance();
        return $CI->config->base_url($uri);
    }
}

if (!function_exists('current_url')) {
    function current_url()
    {
        $CI =& get_instance();
        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
    }
}

if (!function_exists('uri_string')) {
    function uri_string()
    {
        $CI =& get_instance();
        return $CI->uri->uri_string();
    }
}

if (!function_exists('index_page')) {
    function index_page()
    {
        $CI =& get_instance();
        return $CI->config->item('index_page');
    }
}

if (!function_exists('anchor')) {
    function anchor($uri = '', $title = '', $attributes = '')
    {
        $title = (string) $title;
        $site_url = site_url($uri);
        if ($title === '') {
            $title = $site_url;
        }
        if ($attributes !== '') {
            $attributes = ' '.$attributes;
        }
        return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
    }
}

if (!function_exists('redirect')) {
    function redirect($uri = '', $method = 'location', $http_response_code = 302)
    {
        if (!preg_match('#^https?://#i', $uri)) {
            $uri = site_url($uri);
        }

        switch($method) {
            case 'refresh'    : header("Refresh:0;url=".$uri);
                break;
            default            : header("Location: ".$uri, TRUE, $http_response_code);
                break;
        }
        exit;
    }
}
