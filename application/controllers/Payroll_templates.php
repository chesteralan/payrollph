<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_templates extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll');
		$this->template_data->set('current_uri', 'payroll_templates');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll_templates', 'view');

		$this->load->model('Names_list_model');

	}

	public function index($start=0) {
		
		$this->load->view('payroll/templates/templates_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('payroll', 'payroll_templates', 'view');
		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('payroll', 'payroll_templates', 'view');
		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('payroll', 'payroll_templates', 'view');

		redirect( "payroll_templates" );
	}

}
