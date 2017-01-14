<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_settings extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Settings');
		$this->template_data->set('current_uri', 'system_settings');

		$this->_isAuth('system', 'settings', 'view');
		
	}

	public function index() {
		$this->load->view('system/settings/settings', $this->template_data->get_data());
	}

}
