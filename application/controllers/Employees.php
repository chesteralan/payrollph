<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('page_title', 'PAYROLL - Employees');
		$this->template_data->set('current_page', 'Employees');
		$this->template_data->set('current_uri', 'employees');

		$this->load->model('Employees_model');
	}

	public function index() {
		$employees = new $this->Employees_model;
		$this->template_data->set('employees', $employees->populate());
		$this->load->view('employees/employees/employees', $this->template_data->get_data());
	}

	public function add() {
		if( $this->input->post() ) {
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('middlename', 'Middle Name', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim');
			
			if( $this->form_validation->run() ) {
				$employee = new $this->Employees_model;
				$employee->setFirstname($this->input->post('firstname'));
				$employee->setMiddlename($this->input->post('middlename'));
				$employee->setLastname($this->input->post('lastname'));
				$employee->setAddress($this->input->post('address'));
				$employee->setPhoneNumber($this->input->post('phone_number'));
				if($employee->insert()) {
					redirect(site_url("employees") . "?success=true" );
				}
			}
		}
		$this->load->view('employees/employees/employees_add', $this->template_data->get_data());
	}

	public function edit($id) {
		$user = new $this->User_accounts_model;
		$user->setId($id, true);

		if( $this->input->post() ) {
			$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			if( $this->input->post('password') ) {
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|matches[password]');
			}
			if( $this->form_validation->run() ) {
				$user->setName($this->input->post('full_name'), false, true);
				$user->setUsername($this->input->post('username'), false, true);
				if( $this->input->post('password') ) {
					$user->setPassword(sha1($this->input->post('password')), false, true);
				} 
				if( $user->nonEmpty() ) {
					$user->set_exclude('id');
					$user->update();
				} 
			}
		}
		$this->template_data->set('user', $user->get());
		$this->load->view('employees/employees/employees_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		if($this->session->user_id != $id) {
			$user = new $this->User_accounts_model;
			$user->setId($id, true);
			$user->delete();
			redirect(site_url("employees") . "?success=true" );
		}
		redirect(site_url("employees") . "?error=true" );
	}

}
