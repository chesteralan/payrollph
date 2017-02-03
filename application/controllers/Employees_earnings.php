<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_earnings extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Earnings');
		$this->template_data->set('current_uri', 'employees_earnings');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');

		$this->load->model('Employees_model');
		$this->load->model('Employees_earnings_model');
		$this->load->model('Earnings_list_model');

	}

	public function index() {
		redirect("employees");
	}

	public function view($id, $start=0) {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		$earnings = new $this->Employees_earnings_model;
		$earnings->setNameId($id,true);
		$earnings->set_select("*");
		$earnings->set_select("(SELECT name FROM earnings_list WHERE id=employees_earnings.earning_id) as earnings_name");
		$earnings->setTrash('0',true);
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url('employees_earnings/index/'),
			'total_rows' => $earnings->count_all_results(),
			'per_page' => $earnings->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/employees/earnings/earnings_list', $this->template_data->get_data());
	}

	public function add($id, $output='') {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		if( $this->input->post() ) {
			$this->form_validation->set_rules('earning_id', 'Earning', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('computed', 'Repeat', 'trim');
			$this->form_validation->set_rules('active', 'Active', 'trim');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$earnings = new $this->Employees_earnings_model;
				$earnings->setNameId($id);
				$earnings->setEarningId($this->input->post('earning_id'));
				$earnings->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$earnings->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ));
				$earnings->setComputed($this->input->post('computed'));
				$earnings->setActive(($this->input->post('active')) ? 1 : 0);
				$earnings->setTrash(0);
				$earnings->setNotes($this->input->post('notes'));
				$earnings->insert();
			}
			$this->postNext();
		}

		$earnings = new $this->Earnings_list_model;
		$earnings->set_order('name', 'ASC');
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/earnings/earnings_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {


		$earnings = new $this->Employees_earnings_model;
		$earnings->setId($id,true);
		$earnings_data = $earnings->get();

		$employee = new $this->Employees_model;
		$employee->setNameId($earnings_data->name_id,true);
		$this->template_data->set('employee', $employee->get());

		if( $earnings->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('earning_id', 'Earning', 'trim|required');
				$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
				$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
				$this->form_validation->set_rules('computed', 'Repeat', 'trim');
				$this->form_validation->set_rules('active', 'Active', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$earnings->setEarningId($this->input->post('earning_id'),false,true);
					$earnings->setAmount( str_replace(",", "", $this->input->post('amount')) ,false,true);
					$earnings->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ),false,true);
					$earnings->setComputed($this->input->post('computed'),false,true);
					$earnings->setActive((($this->input->post('active')) ? 1 : 0),false,true);
					$earnings->setNotes($this->input->post('notes'),false,true);
					$earnings->update();
				}
				$this->postNext();
			}
		}

		$this->template_data->set('earning', $earnings->get());
		
		$earnings = new $this->Earnings_list_model;
		$earnings->set_order('name', 'ASC');
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/earnings/earnings_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'employees', 'delete');

		$earnings = new $this->Employees_earnings_model;
		$earnings->setId($id,true,false);
		$earnings->setTrash('1',false,true);
		$earnings->update();

		$salary_data = $earnings->get();

		$this->getNext("employees_earnings/view/{$salary_data->name_id}");
	}

	public function set_primary($id) {
		
		$this->_isAuth('employees', 'positions', 'delete');

		$new_primary = new $this->Employees_earnings_model;
		$new_primary->setId($id,true,false);
		$salary = $new_primary->get();

		$current_primary = new $this->Employees_earnings_model;
		$current_primary->setNameId($salary->name_id,true,false);
		$current_primary->setPrimary('0',false,true);
		$current_primary->update();

		$new_primary->setPrimary('1',false,true);
		$new_primary->update();

		$this->getNext();
	}
	
}
