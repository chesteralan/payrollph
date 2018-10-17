<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('lang_term') ) {
	function lang_term($key, $default='') {
        $CI = get_instance();
        return (($CI->lang->line($key)) ? $CI->lang->line($key) : $default);
	}
}