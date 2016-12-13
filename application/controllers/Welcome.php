<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('User_accounts_model');
	}

	public function index() {
		
		$this->load->view('welcome/welcome', $this->template_data->get_data());

	}


}
