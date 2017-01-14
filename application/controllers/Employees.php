<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employees');
		$this->template_data->set('current_uri', 'employees');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'view');

		$this->load->model('Names_list_model');

	}

	public function index($start=0) {
		
		$this->load->view('employees/employees/employees_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('employees', 'employees', 'view');
		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/employees_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('employees', 'employees', 'view');
		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/employees_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'employees', 'view');

		redirect( "employees" );
	}

}
