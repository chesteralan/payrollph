<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('hasAccess') ) {
	function hasAccess($module,$action) {
		$CI = get_instance();
		$auth = false;
    	if( isset($CI->session->session_auth->$module) ) {
    		if( isset($CI->session->session_auth->$module->$action) ) {
    			$auth = (bool) $CI->session->session_auth->$module->$action;
    		}
    	} 
    	return $auth;
	}
}