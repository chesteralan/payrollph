<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll');
		$this->template_data->set('current_uri', 'payroll');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		$this->load->model('Names_list_model');

	}

	public function index($start=0) {
		
		$this->load->view('payroll/payroll/payroll_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('payroll', 'payroll', 'view');
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('payroll', 'payroll', 'view');
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('payroll', 'payroll', 'view');

		redirect( "payroll_templates" );
	}

}
