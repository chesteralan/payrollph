<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_groups extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employees');
		$this->template_data->set('current_uri', 'employees_groups');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees_groups', 'view');

		$this->load->model('Names_list_model');

	}

	public function index($start=0) {
		
		$this->load->view('employees/groups/groups_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('employees', 'employees_groups', 'view');

		$this->template_data->set('output', $output);
		$this->load->view('employees/groups/groups_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('employees', 'employees_groups', 'view');
		
		$this->template_data->set('output', $output);
		$this->load->view('employees/groups/groups_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'employees_groups', 'view');

		redirect( "employees_groups" );
	}
}
