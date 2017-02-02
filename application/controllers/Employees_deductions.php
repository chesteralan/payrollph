<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_deductions extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Deductions');
		$this->template_data->set('current_uri', 'employees_deductions');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');

		$this->load->model('Employees_model');
		$this->load->model('Employees_deductions_model');
		$this->load->model('Deductions_list_model');

	}

	public function index() {
		redirect("employees");
	}

	public function view($id, $start=0) {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		$deductions = new $this->Employees_deductions_model;
		$deductions->setNameId($id,true);
		$deductions->set_select("*");
		$deductions->set_select("(SELECT name FROM deductions_list WHERE id=employees_deductions.deduction_id) as deduction_name");
		$deductions->setTrash('0',true);
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url('employees_deductions/index/'),
			'total_rows' => $deductions->count_all_results(),
			'per_page' => $deductions->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/employees/deductions/deductions_list', $this->template_data->get_data());
	}

	public function add($id, $output='') {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		if( $this->input->post() ) {
			$this->form_validation->set_rules('deduction_id', 'Earning', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('repeat', 'Repeat', 'trim');
			$this->form_validation->set_rules('active', 'Active', 'trim');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$deductions = new $this->Employees_deductions_model;
				$deductions->setnameId($id);
				$deductions->setDeductionId($this->input->post('deduction_id'));
				$deductions->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$deductions->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ));
				$deductions->setRepeat(($this->input->post('repeat')) ? 1 : 0);
				$deductions->setActive(($this->input->post('active')) ? 1 : 0);
				$deductions->setTrash(0);
				$deductions->setNotes($this->input->post('notes'));
				$deductions->insert();
			}
			$this->postNext();
		}

		$deductions = new $this->Deductions_list_model;
		$deductions->set_order('name', 'ASC');
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/deductions/deductions_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {


		$deductions = new $this->Employees_deductions_model;
		$deductions->setId($id,true);
		$deductions_data = $deductions->get();

		$employee = new $this->Employees_model;
		$employee->setNameId($deductions_data->name_id,true);
		$this->template_data->set('employee', $employee->get());

		if( $deductions->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('deduction_id', 'Earning', 'trim|required');
				$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
				$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
				$this->form_validation->set_rules('repeat', 'Repeat', 'trim');
				$this->form_validation->set_rules('active', 'Active', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$deductions->setDeductionId($this->input->post('deduction_id'),false,true);
					$deductions->setAmount( str_replace(",", "", $this->input->post('amount')) ,false,true);
					$deductions->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ),false,true);
					$deductions->setRepeat((($this->input->post('repeat')) ? 1 : 0),false,true);
					$deductions->setActive((($this->input->post('active')) ? 1 : 0),false,true);
					$deductions->setNotes($this->input->post('notes'),false,true);
					$deductions->update();
				}
				$this->postNext();
			}
		}

		$this->template_data->set('deduction', $deductions->get());
		
		$deductions = new $this->Deductions_list_model;
		$deductions->set_order('name', 'ASC');
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/deductions/deductions_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'employees', 'delete');

		$deductions = new $this->Employees_deductions_model;
		$deductions->setId($id,true,false);
		$deductions->setTrash('1',false,true);
		$deductions->update();

		$salary_data = $deductions->get();

		$this->getNext("employees_deductions/view/{$salary_data->name_id}");
	}
	
}
