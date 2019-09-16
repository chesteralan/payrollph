<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('get_payroll_meta') ) {
    function get_payroll_meta($payroll_id, $key) {
        $CI = get_instance();
        $meta = new $CI->Payroll_meta_model;
        $meta->setPayrollId($payroll_id,true);
        $meta->setMetaKey($key,true);
        $meta->set_select("meta_value");
        $meta_data = $options->get();
        if( $meta_data ) {
            return unserialize($meta_data->value);
        } 
        return false;
    }
}

if( ! function_exists('add_payroll_meta') ) {
    function add_payroll_meta($payroll_id, $key, $value) {
        $CI = get_instance();
        $meta = new $CI->Payroll_meta_model;
        $meta->setPayrollId($payroll_id,true);
        $meta->setMetaKey($key,true);
        $meta->setMetaKey($value,false,true);
        if( $meta->nonEmpty() ) {
        	$meta->update();
        } else {
        	$meta->setMetaKey($value);
        	$meta->insert();
        }
        
    }
}

if( ! function_exists('get_company_option') ) {
    function get_company_option($company_id, $key) {
        $CI = get_instance();
        $option = new $CI->Companies_options_model('co');
        $option->setCompanyId($company_id,true);
        $option->setKey($key,true);
        $option->set_select("co.value");
        $option_data = $options->get();
        if( $option_data ) {
            return unserialize($option_data->value);
        } else {
            return false;
        }
    }
}
