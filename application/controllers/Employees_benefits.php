<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_benefits extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Benefits');
		$this->template_data->set('current_uri', 'employees_benefits');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');

		$this->load->model('Employees_model');
		$this->load->model('Employees_benefits_model');
		$this->load->model('Benefits_list_model');

	}

	public function index() {
		redirect("employees");
	}

public function view($id, $start=0) {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		$benefits = new $this->Employees_benefits_model;
		$benefits->setNameId($id,true);
		$benefits->set_select("*");
		$benefits->set_select("(SELECT name FROM benefits_list WHERE id=employees_benefits.benefit_id) as benefit_name");
		$benefits->setTrash('0',true);
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url('employees_benefits/index/'),
			'total_rows' => $benefits->count_all_results(),
			'per_page' => $benefits->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/employees/benefits/benefits_list', $this->template_data->get_data());
	}

	public function add($id, $output='') {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		if( $this->input->post() ) {
			$this->form_validation->set_rules('benefit_id', 'Earning', 'trim|required');
			$this->form_validation->set_rules('ee_share', 'Employee Share', 'trim|required');
			$this->form_validation->set_rules('er_share', 'Employer Share', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('repeat', 'Repeat', 'trim');
			$this->form_validation->set_rules('primary', 'Primary', 'trim');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$benefits = new $this->Employees_benefits_model;
				$benefits->setNameId($id);
				$benefits->setBenefitId($this->input->post('benefit_id'));
				$benefits->setEmployeeShare( str_replace(",", "", $this->input->post('ee_share')) );
				$benefits->setEmployerShare( str_replace(",", "", $this->input->post('er_share')) );
				$benefits->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ));
				$benefits->setRepeat(($this->input->post('repeat')) ? 1 : 0);
				$benefits->setPrimary(($this->input->post('primary')) ? 1 : 0);
				$benefits->setTrash(0);
				$benefits->setNotes($this->input->post('notes'));
				$benefits->insert();
			}
			$this->postNext();
		}

		$benefits = new $this->Benefits_list_model;
		$benefits->set_order('name', 'ASC');
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/benefits/benefits_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$benefits = new $this->Employees_benefits_model;
		$benefits->setId($id,true);
		$benefits_data = $benefits->get();

		$employee = new $this->Employees_model;
		$employee->setNameId($benefits_data->name_id,true);
		$this->template_data->set('employee', $employee->get());

		if( $benefits->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('benefit_id', 'Earning', 'trim|required');
				$this->form_validation->set_rules('ee_share', 'Employee Share', 'trim|required');
				$this->form_validation->set_rules('er_share', 'Employer Share', 'trim|required');
				$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
				$this->form_validation->set_rules('repeat', 'Repeat', 'trim');
				$this->form_validation->set_rules('primary', 'Primary', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {

					$set_primary = ($this->input->post('primary')) ? true : false;
					if( $set_primary ) {
						$primary_benefit = new $this->Employees_benefits_model;
						$primary_benefit->setNameId($benefits_data->name_id,true,false);
						$primary_benefit->setBenefitId($benefits_data->benefit_id,true,false);
						$primary_benefit->setPrimary(0,false,true);
						$primary_benefit->update();
					}

					$benefits->setBenefitId($this->input->post('benefit_id'),false,true);
					$benefits->setEmployeeShare( str_replace(",", "", $this->input->post('ee_share')) ,false,true);
					$benefits->setEmployerShare( str_replace(",", "", $this->input->post('er_share')) ,false,true);
					$benefits->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ),false,true);
					$benefits->setRepeat((($this->input->post('repeat')) ? 1 : 0),false,true);
					$benefits->setPrimary((($this->input->post('primary')) ? 1 : 0),false,true);
					$benefits->setNotes($this->input->post('notes'),false,true);
					$benefits->update();
				}
				$this->postNext();
			}
		}

		$this->template_data->set('benefit', $benefits->get());
		
		$benefits = new $this->Benefits_list_model;
		$benefits->set_order('name', 'ASC');
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/benefits/benefits_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'employees', 'delete');

		$benefits = new $this->Employees_benefits_model;
		$benefits->setId($id,true,false);
		$benefits->setTrash('1',false,true);
		$benefits->update();

		$salary_data = $benefits->get();

		$this->getNext("employees_benefits/view/{$salary_data->name_id}");
	}
}
