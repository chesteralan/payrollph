<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_deductions extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Deductions');
		$this->template_data->set('current_uri', 'employees_deductions');
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

		$deductions = new $this->Employees_deductions_model('ed');
		$deductions->setCompanyId($this->session->userdata('current_company_id'),true);
		$deductions->setNameId($id,true);
		$deductions->set_select("ed.*");
		$deductions->set_select("(SELECT name FROM deductions_list WHERE id=ed.deduction_id) as deduction_name");
		$deductions->set_select("(SELECT notes FROM deductions_list WHERE id=ed.deduction_id) as deduction_notes");
		$deductions->setTrash('0',true);
		$deductions->setActive('1', true);

		if( $this->input->get('filter') ) {
			$deductions->setDeductionId($this->input->get('filter'),true);
		}

		foreach($templates_data as $temp) {
			$deductions->set_select("(SELECT COUNT(*) FROM employees_deductions_templates edt WHERE edt.ed_id=ed.id AND edt.template_id={$temp->id}) as temp_{$temp->id}");
		}

		$deductions->set_select("(IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) as balance");
		
		$deductions->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");


		//print_r( $deductions->populate() );
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_deductions/view/' . $id),
			'total_rows' => $deductions->count_all_results(),
			'per_page' => $deductions->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/employees/deductions/deductions_list', $this->template_data->get_data());
	}

	public function archived($id, $start=0) {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_limit(0);
		$templates_data = $templates->populate();
		$this->template_data->set('templates', $templates_data);

		$deductions = new $this->Employees_deductions_model('ed');
		$deductions->setCompanyId($this->session->userdata('current_company_id'),true);
		$deductions->setNameId($id,true);
		$deductions->set_select("ed.*");
		$deductions->set_select("(SELECT name FROM deductions_list WHERE id=ed.deduction_id) as deduction_name");
		$deductions->set_select("(SELECT notes FROM deductions_list WHERE id=ed.deduction_id) as deduction_notes");
		$deductions->setTrash('0',true);

		if( $this->input->get('filter') ) {
			$deductions->setDeductionId($this->input->get('filter'),true);
		}

		foreach($templates_data as $temp) {
			$deductions->set_select("(SELECT COUNT(*) FROM employees_deductions_templates edt WHERE edt.ed_id=ed.id AND edt.template_id={$temp->id}) as temp_{$temp->id}");
		}

		$deductions->set_select("(IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) as balance");

		$deductions->set_where("((ed.active=0)");
		$deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) = 0))");

		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_deductions/archived/' . $id),
			'total_rows' => $deductions->count_all_results(),
			'per_page' => $deductions->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/employees/deductions/deductions_archived', $this->template_data->get_data());
	}

	public function trash($id, $start=0) {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_limit(0);
		$templates_data = $templates->populate();
		$this->template_data->set('templates', $templates_data);

		$deductions = new $this->Employees_deductions_model('ed');
		$deductions->setCompanyId($this->session->userdata('current_company_id'),true);
		$deductions->setNameId($id,true);
		$deductions->set_select("ed.*");
		$deductions->set_select("(SELECT name FROM deductions_list WHERE id=ed.deduction_id) as deduction_name");
		$deductions->set_select("(SELECT notes FROM deductions_list WHERE id=ed.deduction_id) as deduction_notes");
		$deductions->setTrash(1,true);
		//$deductions->setActive('1', true);

		if( $this->input->get('filter') ) {
			$deductions->setDeductionId($this->input->get('filter'),true);
		}

		foreach($templates_data as $temp) {
			$deductions->set_select("(SELECT COUNT(*) FROM employees_deductions_templates edt WHERE edt.ed_id=ed.id AND edt.template_id={$temp->id}) as temp_{$temp->id}");
		}

		$deductions->set_select("(IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) as balance");
		
		//$deductions->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		//$deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");

		$deductions->set_select("(SELECT COUNT(*) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id) as entries");

		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_deductions/trash/' . $id),
			'total_rows' => $deductions->count_all_results(),
			'per_page' => $deductions->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/employees/deductions/deductions_trash', $this->template_data->get_data());
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
				$deductions->setCompanyId($this->session->userdata('current_company_id'));
				$deductions->setnameId($id);
				$deductions->setDeductionId($this->input->post('deduction_id'));
				$deductions->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$deductions->setMaxAmount( str_replace(",", "", $this->input->post('max_amount')) );
				$deductions->setStartDate( date('Y-m-d', strtotime($this->input->post('start_date')) ));
				$deductions->setActive(($this->input->post('active')) ? 1 : 0);
				$deductions->setTrash(0);
				$deductions->setNotes($this->input->post('notes'));
				$deductions->setComputed($this->input->post('computed'));
				if( $deductions->insert() ) {
					if( $this->input->post('template_selected') ) {
						foreach( $this->input->post('template_selected') as $selected_id ) {
							$ed_template = new $this->Employees_deductions_templates_model;
							$ed_template->setEdId($deductions->get_inserted_id(),true);
							$ed_template->setTemplateId($selected_id,true);
							if( ! $ed_template->nonEmpty() ) {
								$ed_template->insert();
							}
						}
					}
				}
			}
			$this->postNext();
		}

		$deductions = new $this->Deductions_list_model;
		$deductions->set_order('name', 'ASC');
		$this->template_data->set('deductions', $deductions->populate());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->set_limit(0);
		$templates->set_select("*");
		$templates->setActive('1',true);
		$this->template_data->set('templates', $templates->populate());

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
				if( $this->input->post('template') ) {
					foreach( $this->input->post('template') as $template ) {
						if( ! in_array($template, $this->input->post('template_selected')) ) {
							$ed_template = new $this->Employees_deductions_templates_model;
							$ed_template->setEdId($id,true);
							$ed_template->setTemplateId($template,true);
							$ed_template->delete();
						}
					}
					foreach( $this->input->post('template_selected') as $selected_id ) {
						$ed_template = new $this->Employees_deductions_templates_model;
						$ed_template->setEdId($id,true);
						$ed_template->setTemplateId($selected_id,true);
						if( ! $ed_template->nonEmpty() ) {
							$ed_template->insert();
						}
					}
				}
				$this->postNext();
			}
		}

		$this->template_data->set('deduction', $deductions->get());
		
		$deductions = new $this->Deductions_list_model;
		$deductions->set_order('name', 'ASC');
		$this->template_data->set('deductions', $deductions->populate());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->set_limit(0);
		$templates->set_select("*");
		$templates->set_select("(SELECT COUNT(*) FROM `employees_deductions_templates` WHERE ed_id={$id} AND template_id=payroll_templates.id) as selected");
		$templates->setActive('1',true);
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/deductions/deductions_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'employees', 'delete');

		$deductions = new $this->Employees_deductions_model;
		$deductions->setId($id,true,false);
		$deductions->set_select("(SELECT COUNT(*) FROM payroll_employees_deductions ped WHERE ped.entry_id={$id}) as entries");
		$salary_data = $deductions->get();

		if( $this->input->get('permanent') == '1') {
			if( $salary_data->entries <= 0 ) {
				$deductions->delete();
			}
		} else {
			$deductions->setActive('0',true,false);
			$deductions->setTrash('1',false,true);
			$deductions->update();
		}


		$this->getNext("employees_deductions/view/{$salary_data->name_id}");
	}

	public function restore($id) {
		
		$this->_isAuth('employees', 'employees', 'edit');

		$deductions = new $this->Employees_deductions_model;
		$deductions->setId($id,true,false);
		$deductions->setTrash('0',false,true);
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
		$employees_deductions->set_select("ped.amount as ped_amount");
		$employees_deductions->set_join("employees_deductions ed", 'ed.id=ped.entry_id');
		$employees_deductions->set_join("deductions_list dl", 'dl.id=ped.deduction_id');
		$employees_deductions->set_join("payroll p", 'p.id=ped.payroll_id');
		$employees_deductions->set_limit(0);
		
		if( $this->input->get('exempt') ) {
			$employees_deductions->set_where('ped.id !=' . $this->input->get('exempt'));
		}

		$this->template_data->set('deductions', $employees_deductions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_deductions/index/'),
			'total_rows' => $deductions->count_all_results(),
			'per_page' => $deductions->get_limit(),
			'ajax'=>true,
		)));

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/deductions/deductions_entries', $this->template_data->get_data());
	}

	public function summary($deduction_id, $name_id, $output='') {


		$employee = new $this->Employees_model;
		$employee->setNameId($name_id,true);
		$this->template_data->set('employee', $employee->get());

		$deductions = new $this->Deductions_list_model;
		$deductions->setId($deduction_id,true);
		$deduction_data = $deductions->get();
		$this->template_data->set('deduction', $deduction_data);

		$employees_deductions = new $this->Employees_deductions_model('ed');
		$employees_deductions->setNameId($name_id,true);
		$employees_deductions->setDeductionId($deduction_id,true);
		$employees_deductions->set_select("SUM(ed.max_amount) as total_max_amount");

		$employees_deductions->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$employees_deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");

		$employees_deductions_data = $employees_deductions->get();
		$this->template_data->set('employees_deductions', $employees_deductions_data);

		$payroll_deductions = new $this->Payroll_employees_deductions_model('ped');
		$payroll_deductions->setNameId($name_id,true);
		$payroll_deductions->setDeductionId($deduction_id,true);
		$payroll_deductions->set_select("SUM(ped.amount) as total_amount");
		$payroll_deductions->set_where("ped.entry_id != 0");

		$this->template_data->set('payroll_deductions', $payroll_deductions->get());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/deductions/deductions_summary', $this->template_data->get_data());
	}

	public function analyze($name_id, $deduction_id=NULL, $output='') {


		$employee = new $this->Employees_model;
		$employee->setNameId($name_id,true);
		$this->template_data->set('employee', $employee->get());

		if( $deduction_id ) {
			$deductions = new $this->Deductions_list_model;
			$deductions->setId($deduction_id,true);
			$deduction_data = $deductions->get();
			$this->template_data->set('deduction', $deduction_data);
		}

		$deductions = new $this->Employees_deductions_model('ed');
		$deductions->setCompanyId($this->session->userdata('current_company_id'),true);
		$deductions->setNameId($name_id,true);
		$deductions->set_select("ed.*");
		$deductions->set_select("(SELECT name FROM deductions_list WHERE id=ed.deduction_id) as deduction_name");
		$deductions->set_select("(SELECT notes FROM deductions_list WHERE id=ed.deduction_id) as deduction_notes");
		$deductions->setTrash('0',true);
		$deductions->setActive('1', true);
		
		if( $deduction_id ) {
			$deductions->setDeductionId($deduction_id, true);
		}

		$deductions->set_select("(IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) as balance");
		
		$deductions->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");

		$this->template_data->set('deductions', $deductions->populate());

		$payrolls = new $this->Payroll_employees_deductions_model('ped');
		$payrolls->setNameId($name_id,true);
		if( $deduction_id ) {
			$payrolls->setDeductionId($deduction_id,true);
		}
		$payrolls->set_select("*");
		$payrolls->set_select("p.name as payroll_name");
		$payrolls->set_select("ped.id as ped_id");
		$payrolls->set_select("ped.amount as ped_amount");
		$payrolls->set_join("employees_deductions ed", 'ed.id=ped.entry_id');
		$payrolls->set_join("payroll p", 'p.id=ped.payroll_id');
		$payrolls->set_limit(0);

		$payrolls->set_where("ped.entry_id != 0");
		$payrolls->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$payrolls->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");
		$payrolls->set_group_by('p.id');
		$payrolls_data = $payrolls->populate();
		$this->template_data->set('payrolls', $payrolls_data);

		$payroll_deductions = new $this->Payroll_employees_deductions_model('ped');
		$payroll_deductions->setNameId($name_id,true);
		if( $deduction_id ) {
			$payroll_deductions->setDeductionId($deduction_id,true);
		}
		$payroll_deductions->set_select("*");
		$payroll_deductions->set_select("ped.id as ped_id");
		$payroll_deductions->set_select("ped.amount as ped_amount");
		$payroll_deductions->set_join("employees_deductions ed", 'ed.id=ped.entry_id');
		$payroll_deductions->set_limit(0);

		$payroll_deductions->set_where("ped.entry_id != 0");
		$payroll_deductions->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$payroll_deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");

		$this->template_data->set('payroll_deductions', $payroll_deductions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/deductions/deductions_analyze', $this->template_data->get_data());
	}

	public function print_analysis($name_id, $deduction_id=NULL, $output='') {

		$company = new $this->Companies_list_model;
		$company->setId($this->session->userdata('current_company_id'),true);
		$this->template_data->set('company', $company->get());

		$employee = new $this->Employees_model;
		$employee->setNameId($name_id,true);
		$this->template_data->set('employee', $employee->get());

		if( $deduction_id ) {
			$deductions = new $this->Deductions_list_model;
			$deductions->setId($deduction_id,true);
			$deduction_data = $deductions->get();
			$this->template_data->set('deduction', $deduction_data);
		}

		$deductions = new $this->Employees_deductions_model('ed');
		$deductions->setCompanyId($this->session->userdata('current_company_id'),true);
		$deductions->setNameId($name_id,true);
		$deductions->set_select("ed.*");
		$deductions->set_select("(SELECT name FROM deductions_list WHERE id=ed.deduction_id) as deduction_name");
		$deductions->set_select("(SELECT notes FROM deductions_list WHERE id=ed.deduction_id) as deduction_notes");
		$deductions->setTrash('0',true);
		$deductions->setActive('1', true);
		
		if( $deduction_id ) {
			$deductions->setDeductionId($deduction_id, true);
		}

		$deductions->set_select("(IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) as balance");
		
		$deductions->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");

		$this->template_data->set('deductions', $deductions->populate());

		$payrolls = new $this->Payroll_employees_deductions_model('ped');
		$payrolls->setNameId($name_id,true);
		if( $deduction_id ) {
			$payrolls->setDeductionId($deduction_id,true);
		}
		$payrolls->set_select("*");
		$payrolls->set_select("p.name as payroll_name");
		$payrolls->set_select("ped.id as ped_id");
		$payrolls->set_select("ped.amount as ped_amount");
		$payrolls->set_join("employees_deductions ed", 'ed.id=ped.entry_id');
		$payrolls->set_join("payroll p", 'p.id=ped.payroll_id');
		$payrolls->set_limit(0);

		$payrolls->set_where("ped.entry_id != 0");
		$payrolls->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$payrolls->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");
		$payrolls->set_group_by('p.id');
		$payrolls_data = $payrolls->populate();
		$this->template_data->set('payrolls', $payrolls_data);

		$payroll_deductions = new $this->Payroll_employees_deductions_model('ped');
		$payroll_deductions->setNameId($name_id,true);
		if( $deduction_id ) {
			$payroll_deductions->setDeductionId($deduction_id,true);
		}
		$payroll_deductions->set_select("*");
		$payroll_deductions->set_select("ped.id as ped_id");
		$payroll_deductions->set_select("ped.amount as ped_amount");
		$payroll_deductions->set_join("employees_deductions ed", 'ed.id=ped.entry_id');
		$payroll_deductions->set_limit(0);

		$payroll_deductions->set_where("ped.entry_id != 0");
		$payroll_deductions->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$payroll_deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");

		$this->template_data->set('payroll_deductions', $payroll_deductions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/deductions/deductions_print_analysis', $this->template_data->get_data());
	}
	
}
