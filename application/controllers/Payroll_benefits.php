<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_benefits extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Benefits');
		$this->template_data->set('current_uri', 'payroll_benefits');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		if( !get_company_option($this->session->userdata('current_company_id'), 'column_group_benefits') ) {
			redirect("welcome");
		}

	}

	public function index() {
		redirect("payroll");
	}
	
	private function _next($id, $url='payroll_benefits/view/') {
		$payroll = new $this->Payroll_model('p');
		$payroll->setActive(1, true);
		$payroll->setCompanyId($this->session->userdata('current_company_id'),true);
			$where = new $this->Payroll_model('w');
			$where->setActive(1, true);
			$where->set_select('MIN(w.id)');
			$where->set_where("w.id > " . $id);
			$where->setCompanyId($this->session->userdata('current_company_id'),true);
			$where->set_limit(1);
		$payroll->set_limit(1);
		$payroll->set_select("p.id");
		$payroll->set_select("CONCAT('{$url}',p.id) as url");
		$payroll->set_where('id = ('. $where->get_compiled_select() . ')');
		return $payroll->get();
	}

	private function _previous($id, $url='payroll_benefits/view/') {
		$payroll = new $this->Payroll_model('p');
		$payroll->setActive(1, true);
		$payroll->setCompanyId($this->session->userdata('current_company_id'),true);
			$where = new $this->Payroll_model('w');
			$where->setActive(1, true);
			$where->set_select('MAX(w.id)');
			$where->set_where("w.id < " . $id);
			$where->setCompanyId($this->session->userdata('current_company_id'),true);
			$where->set_limit(1);
		$payroll->set_limit(1);
		$payroll->set_select("p.id");
		$payroll->set_select("CONCAT('{$url}',p.id) as url");
		$payroll->set_where('id = ('. $where->get_compiled_select() . ')');
		return $payroll->get();
	}

	private function _next_name($id, $url='payroll_dtr/by_name/') {
		$names = new $this->Employees_model('nl');
		$names->setCompanyId($this->session->userdata('current_company_id'),true);
		$names->setTrash(0, true);
			$where = new $this->Employees_model('w');
			$where->setCompanyId($this->session->userdata('current_company_id'),true);
			$where->setTrash(0, true);
			$where->set_select('MIN(w.name_id)');
			$where->set_where("w.name_id > " . $id);
			$where->set_limit(1);
		$names->set_limit(1);
		$names->set_select("nl.name_id");
		$names->set_select("CONCAT('{$url}',nl.name_id) as url");
		$names->set_where('nl.name_id = ('. $where->get_compiled_select() . ')');
		return $names->get();
	}

	private function _previous_name($id, $url='payroll_dtr/by_name/') {
		$names = new $this->Employees_model('nl');
		$names->setCompanyId($this->session->userdata('current_company_id'),true);
		$names->setTrash(0, true);
			$where = new $this->Employees_model('w');
			$where->setCompanyId($this->session->userdata('current_company_id'),true);
			$where->setTrash(0, true);
			$where->set_select('MAX(w.name_id)');
			$where->set_where("w.name_id < " . $id);
			$where->set_limit(1);
		$names->set_limit(1);
		$names->set_select("nl.name_id");
		$names->set_select("CONCAT('{$url}',nl.name_id) as url");
		$names->set_where('name_id = ('. $where->get_compiled_select() . ')');
		return $names->get();
	}
	
	private function _column_groups() {
		$this->template_data->set('column_group_dtr', get_company_option($this->session->userdata('current_company_id'), 'column_group_dtr'));
		$this->template_data->set('column_group_salaries', get_company_option($this->session->userdata('current_company_id'), 'column_group_salaries'));
		$this->template_data->set('column_group_earnings', get_company_option($this->session->userdata('current_company_id'), 'column_group_earnings'));
		$this->template_data->set('column_group_benefits', get_company_option($this->session->userdata('current_company_id'), 'column_group_benefits'));
		$this->template_data->set('column_group_deductions', get_company_option($this->session->userdata('current_company_id'), 'column_group_deductions'));
		$this->template_data->set('column_group_summary', get_company_option($this->session->userdata('current_company_id'), 'column_group_summary'));
		$this->template_data->set('column_group_sort', get_company_option($this->session->userdata('current_company_id'), 'column_group_sort'));
	}

	public function view($id,$group_id=0,$column_id=0,$output='') {

		$this->_column_groups();
		$this->template_data->set('group_id', $group_id);
		$this->template_data->set('column_id', $column_id);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		if( $column_id ) {
			$exclude = array($id);
			if($this->input->get('compare')) {
				$exclude[] = $this->input->get('compare');
			}
			$payrolls = new $this->Payroll_model;
			$payrolls->setCompanyId($this->session->userdata('current_company_id'),true);
			$payrolls->set_where_not_in('id', $exclude);
			$payrolls->set_where('((SELECT COUNT(*) FROM payroll_inclusive_dates WHERE payroll_id=payroll.id) > 0)');
			$payrolls->set_where('((SELECT COUNT(*) FROM payroll_employees WHERE payroll_id=payroll.id) > 0)');
			$payrolls->set_order('year', 'DESC');
			$payrolls->set_order('month', 'DESC');
			$this->template_data->set('other_payrolls', $payrolls->populate());
		}

		if($this->input->get('compare')) {
			$compare_payroll = new $this->Payroll_model;
			$compare_payroll->setId($this->input->get('compare'),true);
			$this->template_data->set('compare_payroll', $compare_payroll->get());
		}

		$benefits_columns = new $this->Payroll_benefits_model('pb');
		$benefits_columns->setPayrollId($id,true);
		$benefits_columns->set_select('bl.*');
		$benefits_columns->set_join('benefits_list bl', 'bl.id=pb.benefit_id');
		$benefits_columns->set_order('pb.order', 'DESC');
		if( $column_id ) {
			$benefits_columns->set_where('bl.id', $column_id);
		}
		$columns = $benefits_columns->populate();
		$this->template_data->set('benefits_columns', $columns);

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$this->template_data->set('print_groups', $print_groups->populate());
		
		$payroll_group = new $this->Payroll_groups_model('pg');
		$payroll_group->setPayrollId($id,true);

		if( intval($group_id) > 0 ) {
			$payroll_group->setGroupId(intval($group_id),true);
		}

		$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
		$payroll_group->set_limit(0);
		$payroll_group->set_order('pg.order', 'DESC');
		//$payroll_group->set_select("(SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) as employee_count");
		$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
		$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
		$payroll_group_data =  $payroll_group->populate();
		
		foreach($payroll_group_data as $key=>$group) {
			$employees = new $this->Payroll_employees_model('pe');
			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}
			$employees->setPayrollId($id,true);
			$employees->set_select('ni.*');
			$employees->set_select('e.name_id');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);

			if( $this->session->userdata('employees_status') ) {
				$employees->set_where('e.status', $this->session->userdata('employees_status')->id);
			}

			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');
			
			foreach($columns as $column) {
				$employees->set_select(sprintf('(SELECT SUM(peb.employee_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND peb.benefit_id=%s) as ee_share_%s', $id, $column->id, $column->id));
				$employees->set_select(sprintf('(SELECT SUM(peb.employer_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND peb.benefit_id=%s) as er_share_%s', $id, $column->id, $column->id));
				
				if( ($column_id) && ($this->input->get('compare'))) {
					$employees->set_select(sprintf('(SELECT SUM(peb.employee_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND peb.benefit_id=%s) as ee_compare_%s', $this->input->get('compare'), $column->id, $column->id));
					$employees->set_select(sprintf('(SELECT SUM(peb.employer_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND peb.benefit_id=%s) as er_compare_%s', $this->input->get('compare'), $column->id, $column->id));
				}
			}

			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate();
			$payroll_group_data[$key]->employees = $employees_data;
		}

		$this->template_data->set('payroll_groups', $payroll_group_data);

		$inclusive_dates = new $this->Payroll_inclusive_dates_model;
		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_select('COUNT(*) as working_days');
		$inclusive_dates->set_select('MIN(inclusive_date) as start_date');
		$inclusive_dates->set_select('MAX(inclusive_date) as end_date');
		$this->template_data->set('inclusive_dates', $inclusive_dates->get());
		
		$employees_status = new $this->Payroll_employees_model('pe');
		$employees_status->setPayrollId($id,true);
		$employees_status->set_select('e.status');
		$employees_status->set_select('(SELECT t.name FROM terms_list t WHERE t.type="employment_status" AND t.id=e.status) as status_name');
		$employees_status->set_join('employees e', 'e.name_id=pe.name_id');
		$employees_status->set_limit(0);
		$employees_status->set_group_by('e.status');
		$employees_status->set_where('e.status IS NOT NULL');
		$employees_status->set_where('e.status <> 0');
		$employees_status->set_where('e.status <> ""');
		$employees_status->set_order('(SELECT t.name FROM terms_list t WHERE t.type="employment_status" AND t.id=e.status)', 'ASC');
		$this->template_data->set('employees_status', $employees_status->populate());

		$this->template_data->set('next_item', $this->_next($id));
		$this->template_data->set('previous_item', $this->_previous($id));

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/benefits/benefits_view', $this->template_data->get_data());
	}

	public function entries($id,$name_id,$benefit_id,$benefit_type='ee',$output='') {

		$this->template_data->set('payroll_id', $id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('benefit_id', $benefit_id);
		$this->template_data->set('benefit_type', $benefit_type);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$benefit_data = new $this->Benefits_list_model;
		$benefit_data->setId($benefit_id,true);
		$this->template_data->set('benefit_data', $benefit_data->get());

		$benefits = new $this->Payroll_employees_benefits_model('peb');
		$benefits->setPayrollId($id,true);
		$benefits->setNameId($name_id,true);
		$benefits->setBenefitId($benefit_id,true);
		$benefits->set_select('*');
		$benefits->set_select('IF((peb.notes="" OR peb.notes IS NULL), ed.notes, peb.notes) as dnotes');
		if( $benefit_type=='ee' ) {
			$benefits->set_select('peb.employee_share as peb_amount');
		}
		elseif( $benefit_type=='er' ) {
			$benefits->set_select('peb.employer_share as peb_amount');
		}
		$benefits->set_select('peb.id as peb_id');
		$benefits->set_join('employees_benefits ed', 'ed.id=peb.entry_id');
		$benefits->set_join('benefits_list dl', 'peb.benefit_id=dl.id');
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/benefits/benefits_entries', $this->template_data->get_data());
	}

	public function add($id,$name_id,$benefit_id,$output='') {

		$this->template_data->set('payroll_id', $id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('benefit_id', $benefit_id);

		if( $this->input->post() ) {
			$this->form_validation->set_rules('employee_share', 'Employee Share', 'trim|required');
			$this->form_validation->set_rules('employer_share', 'Employer Share', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$benefits = new $this->Payroll_employees_benefits_model('pee');
				$benefits->setPayrollId($id,true);
				$benefits->setNameId($name_id,true);
				$benefits->setBenefitId($benefit_id,true);
				
				$employee_share = str_replace(",", "", $this->input->post('employee_share'));
				$employer_share = str_replace(",", "", $this->input->post('employer_share'));
				$benefits->setEmployeeShare( $employee_share );
				$benefits->setEmployerShare( $employer_share );
				
				$benefits->setNotes($this->input->post('notes'));
				$benefits->insert();
			}
			redirect("payroll_benefits/view/{$id}");
		}

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$benefit_data = new $this->Benefits_list_model;
		$benefit_data->setId($benefit_id,true);
		$this->template_data->set('benefit_data', $benefit_data->get());

		$this->_column_groups();
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/benefits/benefits_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$benefits = new $this->Payroll_employees_benefits_model('peb');
		$benefits->setId($id,true);
		$benefits->set_select("*");
		$benefit_data = $benefits->get();

		if( $this->input->post() ) {
			$this->form_validation->set_rules('employee_share', 'Employee Share', 'trim|required');
			$this->form_validation->set_rules('employer_share', 'Employer Share', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {

				$employee_share = str_replace(",", "", $this->input->post('employee_share'));
				$employer_share = str_replace(",", "", $this->input->post('employer_share'));
				
				$benefits->setEmployeeShare( $employee_share );
				$benefits->setEmployerShare( $employer_share );
				$benefits->setNotes($this->input->post('notes'));
				$benefits->update();
			}
			redirect("payroll_benefits/view/{$benefit_data->payroll_id}");
		}

		$this->template_data->set('benefit', $benefits->get());

		$payroll = new $this->Payroll_model;
		$payroll->setId($benefit_data->payroll_id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$benefit_list = new $this->Benefits_list_model;
		$benefit_list->setId($benefit_data->benefit_id,true);
		$this->template_data->set('benefit_data', $benefit_list->get());

		$this->_column_groups();
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/benefits/benefits_edit', $this->template_data->get_data());
	}

	public function delete($id,$output='') {

		$benefits = new $this->Payroll_employees_benefits_model;
		$benefits->setId($id,true);
		$benefit_data = $benefits->get();
		$benefits->delete();
		redirect("payroll_benefits/view/{$benefit_data->payroll_id}");

	}

	public function item_schedule($id,$benefit_id,$output='') {

		$this->_column_groups();

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$company = new $this->Companies_list_model;
		$company->setId($this->session->userdata('current_company_id'),true);
		$this->template_data->set('company', $company->get());
		
		$benefits_list = new $this->Benefits_list_model;
		$benefits_list->setId($benefit_id,true);
		$this->template_data->set('benefit_data', $benefits_list->get());

		$benefits = new $this->Payroll_employees_benefits_model('peb');
		$benefits->setPayrollId($id,true);
		$benefits->setBenefitId($benefit_id,true);
		$benefits->set_select("peb.*");
		$benefits->set_select("e.*");
		$benefits->set_join("names_info e", 'e.name_id=peb.name_id');

		$benefits->set_order('e.lastname', 'ASC');
		$benefits->set_order('e.firstname', 'ASC');
		$benefits->set_order('e.middlename', 'ASC');

		$benefits->set_join("payroll_employees pe", 'pe.name_id=peb.name_id');
		$benefits->set_where('pe.active', 1);
		$benefits->set_where('pe.payroll_id', $id);
		
		$benefits->set_limit(0);
		$item_data = $benefits->populate();
		$this->template_data->set('item_data', $item_data);

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$this->template_data->set('print_groups', $print_groups->populate());
		
		$this->template_data->set('output', $output);
		if( $output == 'print') {

			// inclusive dates
			$inclusive_dates = new $this->Payroll_inclusive_dates_model;
			$inclusive_dates->setPayrollId($id,true);
			$inclusive_dates->set_select('COUNT(*) as working_days');
			$inclusive_dates->set_select('MIN(inclusive_date) as start_date');
			$inclusive_dates->set_select('MAX(inclusive_date) as end_date');
			$dates_data = $inclusive_dates->get();
			$this->template_data->set('inclusive_dates', $dates_data);
		
			// template
			$template = new $this->Payroll_templates_model;
			$template->setId( $payroll_data->template_id , true);
			$template->set_join('names_list cnl', 'cnl.id=payroll_templates.checked_by');
			$template->set_join('names_list anl', 'anl.id=payroll_templates.approved_by');
			$template->set_select('payroll_templates.*');
			$template->set_select('cnl.full_name as checked_by_name');
			$template->set_select('anl.full_name as approved_by_name');
			$this->template_data->set('template', $template->get());

			$this->load->view('payroll/payroll/benefits/benefits_item_schedule_print', $this->template_data->get_data());
		} else {
			$this->load->view('payroll/payroll/benefits/benefits_item_schedule', $this->template_data->get_data());
		}

	}

	public function reset($id,$benefit_id) {

		$benefits = new $this->Payroll_employees_benefits_model;
		$benefits->setPayrollId($id, true);
		$benefits->setBenefitId($benefit_id,true);
		$benefits->delete();
		
		if( $this->input->get('next') ) {
			redirect( $this->input->get('next') );
		} else {
			redirect( "payroll_benefits/view/{$id}" );
		}

	}

	public function preview($template_id,$group_id=0) {
		
		$this->_column_groups();
		$this->template_data->set('group_id', $group_id);
		
		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_select('*');
		$templates->set_limit(0);
		$this->template_data->set('templates', $templates->populate());
		
		$template = new $this->Payroll_templates_model;
		$template->setId($template_id,true);
		$template->set_select("*");
		$template->set_select("(SELECT COUNT(*) FROM `payroll_templates_earnings` pe WHERE pe.template_id=payroll_templates.id) as earnings_columns");
		$template->set_select("(SELECT COUNT(*) FROM `payroll_templates_benefits` pb WHERE pb.template_id=payroll_templates.id) as benefits_columns");
		$template->set_select("(SELECT COUNT(*) FROM `payroll_templates_deductions` pd WHERE pd.template_id=payroll_templates.id) as deductions_columns");
		$this->template_data->set('template', $template->get());

		$benefits_columns = new $this->Payroll_templates_benefits_model('pb');
		$benefits_columns->setTemplateId($template_id,true);
		$benefits_columns->set_select('bl.*');
		$benefits_columns->set_join('benefits_list bl', 'bl.id=pb.benefit_id');
		$benefits_columns->set_order('pb.order', 'DESC');
		$columns = $benefits_columns->populate();
		$this->template_data->set('benefits_columns', $columns);

		$payroll_group = new $this->Payroll_templates_groups_model('pg');
		$payroll_group->setTemplateId($template_id,true);
		if( intval($group_id) > 0 ) {
			$payroll_group->setGroupId(intval($group_id),true);
		}
		$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
		$payroll_group->set_limit(0);
		$payroll_group->set_order('pg.order', 'DESC');
		$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
		$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
		$payroll_group_data =  $payroll_group->populate();
		foreach($payroll_group_data as $key=>$group) {
			$employees = new $this->Payroll_templates_employees_model('pe');
			$employees->setTemplateId($template_id,true);
			$employees->set_select('ni.*');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);
			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}

			foreach($columns as $column) {
				$employees->set_select(sprintf('(SELECT SUM(peb.employee_share) FROM employees_benefits peb WHERE ((SELECT COUNT(*) FROM employees_benefits_templates WHERE template_id=%s AND eb_id=peb.id) >= 1) AND peb.name_id=pe.name_id AND peb.benefit_id=%s) as ee_share_%s', $template_id, $column->id, $column->id, $column->id));
				$employees->set_select(sprintf('(SELECT SUM(peb.employer_share) FROM employees_benefits peb WHERE ((SELECT COUNT(*) FROM employees_benefits_templates WHERE template_id=%s AND eb_id=peb.id) >= 1) AND peb.name_id=pe.name_id AND peb.benefit_id=%s) as er_share_%s', $template_id, $column->id, $column->id, $column->id));
			}

			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate();

			foreach( $employees_data as $edi=>$edata ) {
				
				foreach($columns as $column) {

					$var = 'benefits_'.$column->id.'_data';

					$employee_benefits = new $this->Employees_benefits_model('ee');
					$employee_benefits->setCompanyId($this->session->userdata('current_company_id'),true);
					$employee_benefits->setNameId($edata->name_id,true);
					$employee_benefits->setBenefitId($column->id,true);
					$employee_benefits->setTrash(0,true);
					$employee_benefits->setStartDate(date('Y-m-d'),true,false,'<=');
					$employee_benefits->set_where("((SELECT COUNT(*) FROM employees_benefits_templates ebt WHERE ebt.template_id=".$template_id." AND ebt.eb_id=ee.id) > 0)");
					$employee_benefits->set_limit(0);
					$edata->$var = $employee_benefits->populate();

				}

				$employees_data[$edi] = $edata;

			}

			$payroll_group_data[$key]->employees = $employees_data;
		}

		

		$this->template_data->set('payroll_groups', $payroll_group_data);

		$this->load->view('payroll/payroll/benefits/benefits_preview', $this->template_data->get_data());
	}


	public function preview_entries($template_id,$name_id,$benefit_id,$benefit_type='ee',$output='') {

		$this->template_data->set('template_id', $template_id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('benefit_id', $benefit_id);
		$this->template_data->set('benefit_type', $benefit_type);

		$benefit_data = new $this->Benefits_list_model;
		$benefit_data->setId($benefit_id,true);
		$this->template_data->set('benefit_data', $benefit_data->get());

		$employee_benefits = new $this->Employees_benefits_model('ee');
		$employee_benefits->setCompanyId($this->session->userdata('current_company_id'),true);
		$employee_benefits->setNameId($name_id,true);
		$employee_benefits->setBenefitId($benefit_id,true);
		$employee_benefits->setTrash(0,true);
		$employee_benefits->setStartDate(date('Y-m-d'),true,false,'<=');
		$employee_benefits->set_where("((SELECT COUNT(*) FROM employees_benefits_templates ebt WHERE ebt.template_id=".$template_id." AND ebt.eb_id=ee.id) > 0)");
		$employee_benefits->set_limit(0);

		$employee_benefits->set_select("ee.*");

			$benefit_data2 = new $this->Benefits_list_model('b');
			$benefit_data2->setId($benefit_id,true);
			$benefit_data2->set_select('b.name');
		$employee_benefits->set_select("(".$benefit_data2->get_compiled_select().") as name");
		

		$this->template_data->set('benefits', $employee_benefits->populate());

		$employees = new $this->Employees_model('pe');
		$employees->setNameId($name_id,true);
		$employees->set_select('ni.*');
		$employees->set_select('e.hired');
		$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
		$employees->set_join('employees e', 'e.name_id=pe.name_id');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');
		$this->template_data->set('employee', $employees->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/benefits/benefits_preview_entries', $this->template_data->get_data());
	}

	public function by_name($name_id,$start=0) {

		$this->_column_groups();
		
		$name = new $this->Names_list_model('nl');
		$name->setId($name_id, true);
		$name->set_select("nl.*");
		
		$name->set_join("names_info ni", "ni.name_id=nl.id");
		$name->set_select("ni.*");
		$name->set_select("(SELECT COUNT(*) FROM employees e WHERE e.name_id=nl.id AND e.trash=0) as is_employed");
		$name->set_select("(SELECT e.company_id FROM employees e WHERE e.name_id=nl.id) as company_id");

		$name_data = $name->get();	
		$this->template_data->set('name', $name_data);

		$payrolls = new $this->Payroll_employees_salaries_model('pes');
		$payrolls->set_start($start);
		$payrolls->setNameId($name_id,true);
		$payrolls->set_group_by('pes.payroll_id');
		$payrolls->set_join('payroll p', 'pes.payroll_id=p.id');
		$payrolls->set_select('p.*');
		$payrolls->set_select('pes.*');
		$payrolls->set_order('p.id', 'DESC');
		$payrolls->set_where('p.company_id=' . $this->session->userdata('current_company_id'));

			$absences = new $this->Employees_absences_model('ea');
			$absences->setNameId($name_id,true);
			$absences->set_join('payroll_inclusive_dates pid', 'ea.date_absent=pid.inclusive_date');
			$absences->set_select('SUM(ea.hours)');
			$absences->set_where('ea.name_id=pes.name_id');
			$absences->set_where('pid.payroll_id=pes.payroll_id');
			$payrolls->set_select('('.$absences->get_compiled_select().') as absences_hours');

		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_inclusive_dates WHERE payroll_id=pes.payroll_id) as working_days');

		if( $this->input->get('filter_by_year') ) {
			$payrolls->set_limit(0);
			$payrolls->set_start(0);
			$payrolls->set_where('p.year=' . $this->input->get('filter_by_year'));
		}
		$this->template_data->set('payrolls', $payrolls->populate());

		$years = new $this->Payroll_employees_salaries_model('pes');
		$years->setNameId($name_id,true);
		$years->set_join('payroll p', 'pes.payroll_id=p.id');
		$years->set_select('p.year');
		$years->set_group_by('p.year');
		$years->set_order('p.year', 'DESC');
		$this->template_data->set('years', $years->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url($this->config->item('index_page') . "/payroll_benefits/by_name/{$name_id}"),
			'total_rows' => $payrolls->count_all_results(),
			'per_page' => $payrolls->get_limit(),
			'ajax'=>true
		)));


		$this->template_data->set('next_name', $this->_next_name($name_id, 'payroll_benefits/by_name/'));
		$this->template_data->set('previous_name', $this->_previous_name($name_id, 'payroll_benefits/by_name/'));

		$this->load->view('payroll/payroll/dtr/dtr_by_name', $this->template_data->get_data());
	}

}
