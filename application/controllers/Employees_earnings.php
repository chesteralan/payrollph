<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_earnings extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Earnings');
		$this->template_data->set('current_uri', 'employees_earnings');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');
	}

	public function index() {
		redirect("employees");
	}

	public function view($id, $start=0) {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_limit(0);
		$templates_data = $templates->populate();
		$this->template_data->set('templates', $templates_data);

		$earnings = new $this->Employees_earnings_model('ee');
		$earnings->setCompanyId($this->session->userdata('current_company_id'),true);
		$earnings->setNameId($id,true);
		$earnings->set_select("*");
		$earnings->set_select("(SELECT name FROM earnings_list WHERE id=ee.earning_id) as earnings_name");
		$earnings->setTrash('0',true);

		foreach($templates_data as $temp) {
			$earnings->set_select("(SELECT COUNT(*) FROM employees_earnings_templates eet WHERE eet.ee_id=ee.id AND eet.template_id={$temp->id}) as temp_{$temp->id}");
		}

		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_earnings/index/'),
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
			$this->form_validation->set_rules('max_amount', 'Max Amount', 'trim');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$earnings = new $this->Employees_earnings_model;
				$earnings->setNameId($id);
				$earnings->setCompanyId($this->session->userdata('current_company_id'));
				$earnings->setEarningId($this->input->post('earning_id'));
				$earnings->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$earnings->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ));
				$earnings->setComputed($this->input->post('computed'));
				$earnings->setMaxAmount( str_replace(",", "", $this->input->post('max_amount')) );
				$earnings->setActive(($this->input->post('active')) ? 1 : 0);
				$earnings->setTrash(0);
				$earnings->setNotes($this->input->post('notes'));
				if( $earnings->insert() ) {
					if( $this->input->post('template_selected') ) {
						foreach( $this->input->post('template_selected') as $selected_id ) {
							$ee_template = new $this->Employees_earnings_templates_model;
							$ee_template->setEeId($earnings->get_inserted_id(),true);
							$ee_template->setTemplateId($selected_id,true);
							if( ! $ee_template->nonEmpty() ) {
								$ee_template->insert();
							}
						}
					}
				}
			}
			$this->postNext();
		}

		$earnings = new $this->Earnings_list_model;
		$earnings->set_order('name', 'ASC');
		$this->template_data->set('earnings', $earnings->populate());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->set_limit(0);
		$templates->set_select("*");
		$templates->setActive('1',true);
		$this->template_data->set('templates', $templates->populate());

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
				$this->form_validation->set_rules('max_amount', 'Max Amount', 'trim');
				$this->form_validation->set_rules('active', 'Active', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$earnings->setEarningId($this->input->post('earning_id'),false,true);
					$earnings->setAmount( str_replace(",", "", $this->input->post('amount')) ,false,true);
					$earnings->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ),false,true);
					$earnings->setComputed($this->input->post('computed'),false,true);
					$earnings->setMaxAmount( str_replace(",", "", $this->input->post('max_amount')) ,false,true);
					$earnings->setActive((($this->input->post('active')) ? 1 : 0),false,true);
					$earnings->setNotes($this->input->post('notes'),false,true);
					$earnings->update();
				}
				if( $this->input->post('template') ) {
					foreach( $this->input->post('template') as $template ) {
						if( ! in_array($template, $this->input->post('template_selected')) ) {
							$ee_template = new $this->Employees_earnings_templates_model;
							$ee_template->setEeId($id,true);
							$ee_template->setTemplateId($template,true);
							$ee_template->delete();
						}
					}
					foreach( $this->input->post('template_selected') as $selected_id ) {
						$ee_template = new $this->Employees_earnings_templates_model;
						$ee_template->setEeId($id,true);
						$ee_template->setTemplateId($selected_id,true);
						if( ! $ee_template->nonEmpty() ) {
							$ee_template->insert();
						}
					}
				}
				$this->postNext();
			}
		}

		$this->template_data->set('earning', $earnings->get());
		
		$earnings = new $this->Earnings_list_model;
		$earnings->set_order('name', 'ASC');
		$this->template_data->set('earnings', $earnings->populate());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->set_limit(0);
		$templates->set_select("*");
		$templates->set_select("(SELECT COUNT(*) FROM `employees_earnings_templates` WHERE ee_id={$id} AND template_id=payroll_templates.id) as selected");
		$templates->setActive('1',true);
		$this->template_data->set('templates', $templates->populate());

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

	public function entries($id, $output='') {

		$d_entry = new $this->Employees_earnings_model;
		$d_entry->setId($id,true);
		$entry = $d_entry->get();
		$this->template_data->set('entry', $entry);

		$employee = new $this->Employees_model;
		$employee->setNameId($entry->name_id,true);
		$this->template_data->set('employee', $employee->get());

		$earnings = new $this->Earnings_list_model;
		$earnings->setId($entry->earning_id,true);
		$earning_data = $earnings->get();
		$this->template_data->set('earning', $earning_data);

		$employees_earnings = new $this->Payroll_employees_earnings_model('pee');
		$employees_earnings->setNameId($entry->name_id,true);
		$employees_earnings->setEntryId($id,true);
		$employees_earnings->set_select("*");
		$employees_earnings->set_select("p.name as payroll_name");
		$employees_earnings->set_select("pee.id as pee_id");
		$employees_earnings->set_select("pee.amount as pee_amount");
		$employees_earnings->set_join("employees_earnings ed", 'ed.id=pee.entry_id');
		$employees_earnings->set_join("earnings_list dl", 'dl.id=pee.earning_id');
		$employees_earnings->set_join("payroll p", 'p.id=pee.payroll_id');
		$employees_earnings->set_limit(0);
		$this->template_data->set('earnings', $employees_earnings->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_earnings/index/'),
			'total_rows' => $earnings->count_all_results(),
			'per_page' => $earnings->get_limit(),
			'ajax'=>true,
		)));

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/earnings/earnings_entries', $this->template_data->get_data());
	}
	
}
