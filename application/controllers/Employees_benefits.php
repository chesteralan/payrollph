<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_benefits extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Benefits');
		$this->template_data->set('current_uri', 'employees_benefits');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');

	}

	public function index() {
		redirect("employees");
	}

	public function view($id, $start=0) {

		$employee = new $this->Employees_model('e');
		$employee->setNameId($id,true);
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$this->template_data->set('employee', $employee->get());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_limit(0);
		$templates_data = $templates->populate();
		$this->template_data->set('templates', $templates_data);

		$benefits = new $this->Employees_benefits_model('eb');
		$benefits->setCompanyId($this->session->userdata('current_company_id'),true);
		$benefits->setNameId($id,true);
		$benefits->set_select("*");
		$benefits->set_select("(SELECT name FROM benefits_list WHERE id=eb.benefit_id) as benefit_name");
		$benefits->setTrash('0',true);

		foreach($templates_data as $temp) {
			$benefits->set_select("(SELECT COUNT(*) FROM employees_benefits_templates ebt WHERE ebt.eb_id=eb.id AND ebt.template_id={$temp->id}) as temp_{$temp->id}");
		}

		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . "/employees_benefits/index/"),
			'total_rows' => $benefits->count_all_results(),
			'per_page' => $benefits->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/employees/benefits/benefits_list', $this->template_data->get_data());
	}

	public function add($id, $output='') {

		$employee = new $this->Employees_model('e');
		$employee->setNameId($id,true);
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$this->template_data->set('employee', $employee->get());

		if( $this->input->post() ) {
			$this->form_validation->set_rules('benefit_id', 'Earning', 'trim|required');
			$this->form_validation->set_rules('ee_share', 'Employee Share', 'trim|required');
			$this->form_validation->set_rules('er_share', 'Employer Share', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('primary', 'Primary', 'trim');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {

				$set_primary = ($this->input->post('primary')) ? true : false;
				if( $set_primary ) {
					$primary_benefit = new $this->Employees_benefits_model;
					$primary_benefit->setCompanyId($this->session->userdata('current_company_id'),true);
					$primary_benefit->setNameId($id,true,false);
					$primary_benefit->setBenefitId($this->input->post('benefit_id'),true,false);
					$primary_benefit->setPrimary(0,false,true);
					$primary_benefit->update();
				}

				$benefits = new $this->Employees_benefits_model;
				$benefits->setNameId($id);
				$benefits->setCompanyId($this->session->userdata('current_company_id'));
				$benefits->setBenefitId($this->input->post('benefit_id'));
				$benefits->setEmployeeShare( str_replace(",", "", $this->input->post('ee_share')) );
				$benefits->setEmployerShare( str_replace(",", "", $this->input->post('er_share')) );
				$benefits->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ));
				$benefits->setPrimary(($this->input->post('primary')) ? 1 : 0);
				$benefits->setTrash(0);
				$benefits->setNotes($this->input->post('notes'));
				if( $benefits->insert() ) {
					if( $this->input->post('template_selected') ) {
						foreach( $this->input->post('template_selected') as $selected_id ) {
							$eb_template = new $this->Employees_benefits_templates_model;
							$eb_template->setEbId($benefits->get_inserted_id(),true);
							$eb_template->setTemplateId($selected_id,true);
							if( ! $eb_template->nonEmpty() ) {
								$eb_template->insert();
							}
						}
					}
				}
			}
			$this->postNext();
		}

		$benefits = new $this->Benefits_list_model;
		$benefits->setLeave('0',true);
		$benefits->set_order('name', 'ASC');

		$this->template_data->set('benefits', $benefits->populate());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->set_limit(0);
		$templates->set_select("*");
		$templates->setActive('1',true);
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/benefits/benefits_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$benefits = new $this->Employees_benefits_model;
		$benefits->setId($id,true);
		$benefits_data = $benefits->get();

		$employee = new $this->Employees_model('e');
		$employee->setNameId($benefits_data->name_id,true);
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$this->template_data->set('employee', $employee->get());

		if( $benefits->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('benefit_id', 'Earning', 'trim|required');
				$this->form_validation->set_rules('ee_share', 'Employee Share', 'trim|required');
				$this->form_validation->set_rules('er_share', 'Employer Share', 'trim|required');
				$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
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
					$benefits->setPrimary((($this->input->post('primary')) ? 1 : 0),false,true);
					$benefits->setNotes($this->input->post('notes'),false,true);
					$benefits->update();
				}

				if( $this->input->post('template') ) {
					foreach( $this->input->post('template') as $template ) {
						if( ! in_array($template, $this->input->post('template_selected')) ) {
							$eb_template = new $this->Employees_benefits_templates_model;
							$eb_template->setEbId($id,true);
							$eb_template->setTemplateId($template,true);
							$eb_template->delete();
						}
					}
					foreach( $this->input->post('template_selected') as $selected_id ) {
						$eb_template = new $this->Employees_benefits_templates_model;
						$eb_template->setEbId($id,true);
						$eb_template->setTemplateId($selected_id,true);
						if( ! $eb_template->nonEmpty() ) {
							$eb_template->insert();
						}
					}
				}
				$this->postNext();
			}
		}

		$this->template_data->set('benefit', $benefits->get());
		
		$benefits = new $this->Benefits_list_model;
		$benefits->setLeave('0',true);
		$benefits->set_order('name', 'ASC');
		$this->template_data->set('benefits', $benefits->populate());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->set_limit(0);
		$templates->set_select("*");
		$templates->set_select("(SELECT COUNT(*) FROM `employees_benefits_templates` WHERE eb_id={$id} AND template_id=payroll_templates.id) as selected");
		$templates->setActive('1',true);
		$this->template_data->set('templates', $templates->populate());

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

	public function entries($id, $output='') {

		$d_entry = new $this->Employees_benefits_model;
		$d_entry->setId($id,true);
		$entry = $d_entry->get();
		$this->template_data->set('entry', $entry);

		$employee = new $this->Employees_model('e');
		$employee->setNameId($entry->name_id,true);
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$this->template_data->set('employee', $employee->get());

		$benefits = new $this->Benefits_list_model;
		$benefits->setId($entry->benefit_id,true);
		$benefit_data = $benefits->get();
		$this->template_data->set('benefit', $benefit_data);

		$employees_benefits = new $this->Payroll_employees_benefits_model('peb');
		$employees_benefits->setNameId($entry->name_id,true);
		$employees_benefits->setEntryId($id,true);
		$employees_benefits->set_select("*");
		$employees_benefits->set_select("p.name as payroll_name");
		$employees_benefits->set_select("peb.id as peb_id");
		$employees_benefits->set_select("peb.employee_share as peb_employee_share");
		$employees_benefits->set_select("peb.employer_share as peb_employer_share");
		$employees_benefits->set_join("employees_benefits ed", 'ed.id=peb.entry_id');
		$employees_benefits->set_join("benefits_list dl", 'dl.id=peb.benefit_id');
		$employees_benefits->set_join("payroll p", 'p.id=peb.payroll_id');
		$employees_benefits->set_limit(0);

			$pe = new $this->Payroll_employees_model('pe');
			$pe->set_select('pe.active');
			$pe->set_where('peb.payroll_id=pe.payroll_id');
			$pe->set_where('pe.name_id=peb.name_id');
			$pe->set_limit(1);
		$employees_benefits->set_where("((".$pe->get_compiled_select().")=1)");
		
		$this->template_data->set('benefits', $employees_benefits->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_benefits/index/'),
			'total_rows' => $benefits->count_all_results(),
			'per_page' => $benefits->get_limit(),
			'ajax'=>true,
		)));

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/benefits/benefits_preview_entries', $this->template_data->get_data());
	}

}
