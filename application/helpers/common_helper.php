<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('is_view_exists') ) {
	function is_view_exists($view_file) {
    	 return file_exists(VIEWPATH . $view_file . '.php');
	}
}