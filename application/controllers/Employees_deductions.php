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

		$this->load->model('Payroll_employees_deductions_model');

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
		$deductions->set_select("(SELECT notes FROM deductions_list WHERE id=employees_deductions.deduction_id) as deduction_notes");
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
			$this->form_validation->set_rules('active', 'Active', 'trim');
			$this->form_validation->set_rules('computed', 'Rate per', 'trim');
			$this->form_validation->set_rules('max_amount', 'Max Amount', 'trim');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$deductions = new $this->Employees_deductions_model;
				$deductions->setnameId($id);
				$deductions->setDeductionId($this->input->post('deduction_id'));
				$deductions->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$deductions->setMaxAmount( str_replace(",", "", $this->input->post('max_amount')) );
				$deductions->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ));
				$deductions->setActive(($this->input->post('active')) ? 1 : 0);
				$deductions->setTrash(0);
				$deductions->setNotes($this->input->post('notes'));
				$deductions->setComputed($this->input->post('computed'));
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
				$this->form_validation->set_rules('active', 'Active', 'trim');
				$this->form_validation->set_rules('max_amount', 'Max Amount', 'trim');
				$this->form_validation->set_rules('computed', 'Rate per', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$deductions->setDeductionId($this->input->post('deduction_id'),false,true);
					$deductions->setAmount( str_replace(",", "", $this->input->post('amount')) ,false,true);
					$deductions->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ),false,true);
					$deductions->setActive((($this->input->post('active')) ? 1 : 0),false,true);
					$deductions->setMaxAmount( str_replace(",", "", $this->input->post('max_amount')) ,false,true);
					$deductions->setNotes($this->input->post('notes'),false,true);
					$deductions->setComputed($this->input->post('computed'),false,true);
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

	public function entries($id, $output='') {

		$d_entry = new $this->Employees_deductions_model;
		$d_entry->setId($id,true);
		$entry = $d_entry->get();
		$this->template_data->set('entry', $entry);

		$employee = new $this->Employees_model;
		$employee->setNameId($entry->name_id,true);
		$this->template_data->set('employee', $employee->get());

		$deductions = new $this->Deductions_list_model;
		$deductions->setId($entry->deduction_id,true);
		$deduction_data = $deductions->get();
		$this->template_data->set('deduction', $deduction_data);

		$employees_deductions = new $this->Payroll_employees_deductions_model('ped');
		$employees_deductions->setNameId($entry->name_id,true);
		$employees_deductions->setEntryId($id,true);
		$employees_deductions->set_select("*");
		$employees_deductions->set_select("p.name as payroll_name");
		$employees_deductions->set_select("ped.id as ped_id");
		$employees_deductions->set_join("employees_deductions ed", 'ed.id=ped.entry_id');
		$employees_deductions->set_join("deductions_list dl", 'dl.id=ped.deduction_id');
		$employees_deductions->set_join("payroll p", 'p.id=ped.payroll_id');
		$employees_deductions->set_limit(0);
		$this->template_data->set('deductions', $employees_deductions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url('employees_deductions/index/'),
			'total_rows' => $deductions->count_all_results(),
			'per_page' => $deductions->get_limit(),
			'ajax'=>true,
		)));

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/deductions/deductions_entries', $this->template_data->get_data());
	}
	
}
