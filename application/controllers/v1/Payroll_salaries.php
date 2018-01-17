<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_salaries extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Basic Salary');
		$this->template_data->set('current_uri', 'payroll_salaries');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');
		
		if( !get_company_option($this->session->userdata('current_company_id'), 'column_group_salaries') ) {
			redirect("welcome");
		}

		$this->session->set_userdata('page_session', 'payroll_salaries');
		
	}

	public function index() {
		redirect("payroll");
	}

	private function _next($id, $url='payroll_salaries/view/') {
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

	private function _previous($id, $url='payroll_salaries/view/') {
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

	public function view($id,$group_id=0,$output='') {

		$this->_column_groups();
		
		$this->template_data->set('group_id', $group_id);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

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
		$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
		$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
		$payroll_group_data =  $payroll_group->populate();

		$inclusive_dates = new $this->Payroll_inclusive_dates_model;
		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_select('COUNT(*) as working_days');
		$inclusive_dates->set_select('MIN(inclusive_date) as start_date');
		$inclusive_dates->set_select('MAX(inclusive_date) as end_date');
		$dates_data = $inclusive_dates->get();
		$this->template_data->set('inclusive_dates', $dates_data);

		foreach($payroll_group_data as $key=>$group) {
			$employees = new $this->Payroll_employees_model('pe');
			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}
			$employees->setPayrollId($id,true);
			$employees->set_select('ni.*');
			$employees->set_select('e.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);

			if( $this->session->userdata('employees_status') ) {
				$employees->set_where('e.status', $this->session->userdata('employees_status')->id);
			}

			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			$employees->set_select("(SELECT COUNT(*) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences");

			$employees->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');

			$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences_hours");
			
			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate();
			foreach( $employees_data as $eKey => $employee) {
				$salary = new $this->Payroll_employees_salaries_model('pes');
				$salary->setPayrollId($id,true);
				$salary->setNameId($employee->name_id,true);
				//$salary->set_join('employees_salaries es', 'es.id=pes.salary_id');
				//$salary->set_select('*, pes.amount as override');
				//$salary->set_where('es.trash', 0);
				$employees_data[$eKey]->salary = $salary->get();
			}
			$payroll_group_data[$key]->employees = $employees_data;
		}
		$this->template_data->set('payroll_groups', $payroll_group_data);
		
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
		$this->load->view('payroll/payroll/salaries/salaries_view', $this->template_data->get_data());
	}

	public function entry($id,$name_id,$output='') {

		$this->template_data->set('payroll_id', $id);
		$this->template_data->set('name_id', $name_id);

		$salary = new $this->Payroll_employees_salaries_model('pee');
		$salary->setPayrollId($id,true);
		$salary->setNameId($name_id,true);

		if( $this->input->post() ) {
				$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
				$this->form_validation->set_rules('rate_per', 'Rate per', 'trim|required');
				$this->form_validation->set_rules('num_of_days', 'Number of Days / Month', 'trim|required');
				$this->form_validation->set_rules('num_of_hours', 'Number of Hours / Day', 'trim|required');
				$this->form_validation->set_rules('cola', 'COLA', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {

					$salary->setAmount( str_replace(",", "", $this->input->post('amount')),false,true);
					$salary->setRatePer($this->input->post('rate_per'),false,true);
					$salary->setAnnualDays($this->input->post('annual_work_days'),false,true);
					$salary->setMonths($this->input->post('num_of_months'),false,true);
					$salary->setDays($this->input->post('num_of_days'),false,true);
					$salary->setHours($this->input->post('num_of_hours'),false,true);
					$salary->setCola($this->input->post('cola'),false,true);
					$salary->setNotes($this->input->post('notes'),false,true);
					$salary->update();
					
				}
				$this->postNext();
			}

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$salary->set_select('*');
		$this->template_data->set('salary', $salary->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/salaries/salaries_entry', $this->template_data->get_data());
	}

	public function delete_entry($payroll_id, $entry_id) {
		
		$salary = new $this->Payroll_employees_salaries_model;
		$salary->setId($entry_id,true);
		$salary->delete();

		$this->getNext("payroll_salaries/view/{$payroll_id}/0");
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
			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}
			$employees->setTemplateId($template_id,true);
			$employees->set_select('ni.*');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);
			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');			
			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate();
			foreach( $employees_data as $eKey => $employee) {
				$salary = new $this->Employees_salaries_model('es');
				$salary->setNameId($employee->name_id,true);
				$salary->set_where('es.trash', 0);
				$employees_data[$eKey]->salary = $salary->get();
			}
			$payroll_group_data[$key]->employees = $employees_data;
		}

		

		$this->template_data->set('payroll_groups', $payroll_group_data);

		$this->load->view('payroll/payroll/salaries/salaries_preview', $this->template_data->get_data());
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
			'base_url' => base_url($this->config->item('index_page') . "/payroll_salaries/by_name/{$name_id}"),
			'total_rows' => $payrolls->count_all_results(),
			'per_page' => $payrolls->get_limit(),
			'ajax'=>true
		)));

		$this->template_data->set('next_name', $this->_next_name($name_id, 'payroll_salaries/by_name/'));
		$this->template_data->set('previous_name', $this->_previous_name($name_id, 'payroll_salaries/by_name/'));

		$this->load->view('payroll/payroll/salaries/salaries_by_name', $this->template_data->get_data());
	}

}
