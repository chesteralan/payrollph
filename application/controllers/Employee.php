<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee');
		$this->template_data->set('current_uri', 'employee');
		$this->template_data->set('navbar_search', true);

		$this->_isCompanyId();
		
		$this->_isAuth('employees', 'employees', 'view');

	}

	public function view($id) {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);

		$this->template_data->set('employee', $employee->get());
		$this->load->view('employees/employee/employee_view', $this->template_data->get_data());
	}
}
