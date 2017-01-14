<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('hasAccess') ) {
	function hasAccess($dept, $sect=NULL, $action='view') {
		$CI = get_instance();
		$auth = false;
    	if( isset( $CI->session->session_auth ) ) {
            if( isset($CI->session->session_auth[$dept] ) ) {
                if( isset($CI->session->session_auth[$dept][$sect]) ) {
                    if( isset($CI->session->session_auth[$dept][$sect][$action]) ) {
                        $auth = (bool) $CI->session->session_auth[$dept][$sect][$action];
                    }
                }
            } 
        }
    	return $auth;
	}
}