<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('is_view_exists') ) {
	function is_view_exists($view_file) {
    	 return file_exists(VIEWPATH . $view_file . '.php');
	}
}

if( ! function_exists('querystring_add') ) {
	function querystring_add($key,$value) {
    	 $q = array();
    	 $CI = get_instance();
    	 foreach($CI->input->get() as $k=>$v) {
    	 	if( is_array( $v ) ) {
    	 		foreach($v as $c=>$v2) {
    	 			$q[$k.$c] = urlencode($k . "[]") . "=" . $v2;
    	 		}
    	 	} else {
    	 		if( $key==$k) {
    	 			$q[$k] = $k . "=" . $value;
    	 		} else {
    	 			$q[$k] = $k . "=" . $v;
    	 		}
    	 	}
    	 }
    	 $q[$key] = $key . "=" . $value;
    	 return implode("&amp;", $q);
	}
}

if( ! function_exists('get_company_option') ) {
    function get_company_option($company_id, $key) {
        $CI = get_instance();
        $options = new $CI->Companies_options_model;
        $options->setCompanyId($company_id,true);
        $options->setKey($key,true);
        $options->set_select("value");
        $option_data = $options->get();
        if( $option_data ) {
            return unserialize($option_data->value);
        } 
        return false;
    }
}

if( ! function_exists('payroll_url') ) {
    function payroll_url($uri, $next=true, $next_query=true) {
        $CI = get_instance();
        $url = site_url($uri) . "?";
        if( $next ) {
            if( $CI->input->get('next') ) {
                $url .= 'next=' . $CI->input->get('next') . "&";
            } else {
                $url .= 'next=' . uri_string() . "&";
            }
        }
        if( $next_query ) {
            if( $CI->input->get('next_query') ) {
                $url .= 'next_query=' . urlencode($CI->input->get('next_query'));
            } else {
                $url .= 'next_query=' . urlencode( serialize( $CI->input->get() ) );
            }
        }
        return $url;
    }
}

if( ! function_exists('record_system_audit') ) {
    function record_system_audit($user_id, $dept, $sect, $action, $company_id=0, $notes='', $name_id=0) {
        $CI = get_instance();
        $audit = new $CI->System_audit_model();
        $audit->setUserId($user_id);
        $audit->setDept($dept);
        $audit->setSect($sect);
        $audit->setAction($action);
        $audit->setCompanyId($company_id);
        $audit->setNameId($name_id);
        $audit->setNotes($notes);
        $audit->insert();
    }
}