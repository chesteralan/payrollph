<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_salaries extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Basic Salary');
		$this->template_data->set('current_uri', 'employees_salaries');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');

		$this->load->model('Employees_model');
		$this->load->model('Employees_salaries_model');

	}

	public function index() {
		redirect("employees");
	}

	public function view($id, $start=0) {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		$salaries = new $this->Employees_salaries_model;
		$salaries->setNameId($id,true);
		$salaries->set_select("*");
		$salaries->setTrash('0',true);
		$this->template_data->set('salaries', $salaries->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url('employees_positions/index/'),
			'total_rows' => $salaries->count_all_results(),
			'per_page' => $salaries->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/employees/salaries/salaries_list', $this->template_data->get_data());
	}

	public function add($id, $output='') {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		if( $this->input->post() ) {
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('rate_per', 'Rate per', 'trim|required');
			$this->form_validation->set_rules('num_of_days', 'Number of Days / Month', 'trim|required');
			$this->form_validation->set_rules('num_of_hours', 'Number of Hours / Day', 'trim|required');
			$this->form_validation->set_rules('cola', 'COLA', 'trim');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$salaries = new $this->Employees_salaries_model;
				$salaries->setNameId($id);
				$salaries->setAmount($this->input->post('amount'));
				$salaries->setRatePer($this->input->post('rate_per'));
				$salaries->setDays($this->input->post('num_of_days'));
				$salaries->setHours($this->input->post('num_of_hours'));
				$salaries->setCola($this->input->post('cola'));
				$salaries->setNotes($this->input->post('notes'));
				$salaries->insert();
			}
			$this->postNext();
		}

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/salaries/salaries_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {


		$salaries = new $this->Employees_salaries_model;
		$salaries->setId($id,true);
		$salary_data = $salaries->get();

		$employee = new $this->Employees_model;
		$employee->setNameId($salary_data->name_id,true);
		$this->template_data->set('employee', $employee->get());

		if( $salaries->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
				$this->form_validation->set_rules('rate_per', 'Rate per', 'trim|required');
				$this->form_validation->set_rules('num_of_days', 'Number of Days / Month', 'trim|required');
				$this->form_validation->set_rules('num_of_hours', 'Number of Hours / Day', 'trim|required');
				$this->form_validation->set_rules('cola', 'COLA', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$salaries->setAmount($this->input->post('amount'),false,true);
					$salaries->setRatePer($this->input->post('rate_per'),false,true);
					$salaries->setDays($this->input->post('num_of_days'),false,true);
					$salaries->setHours($this->input->post('num_of_hours'),false,true);
					$salaries->setCola($this->input->post('cola'),false,true);
					$salaries->setNotes($this->input->post('notes'),false,true);
					$salaries->update();
				}
				$this->postNext();
			}
		}

		$this->template_data->set('salary', $salaries->get());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/salaries/salaries_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'positions', 'delete');

		$salaries = new $this->Employees_salaries_model;
		$salaries->setId($id,true,false);
		$salaries->setTrash('1',false,true);
		$salaries->update();

		$salary_data = $salaries->get();

		$this->getNext("employees_salaries/view/{$salary_data->name_id}");
	}

	public function set_primary($id) {
		
		$this->_isAuth('employees', 'positions', 'delete');

		$new_primary = new $this->Employees_salaries_model;
		$new_primary->setId($id,true,false);
		$salary = $new_primary->get();

		$current_primary = new $this->Employees_salaries_model;
		$current_primary->setNameId($salary->name_id,true,false);
		$current_primary->setPrimary('0',false,true);
		$current_primary->update();

		$new_primary->setPrimary('1',false,true);
		$new_primary->update();

		$this->getNext();
	}
}
