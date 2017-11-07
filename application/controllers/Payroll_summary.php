<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_summary extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Summary');
		$this->template_data->set('current_uri', 'payroll_summary');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		if( !get_company_option($this->session->userdata('current_company_id'), 'column_group_summary') ) {
			redirect("welcome");
		}
	}

	public function index() {
		redirect("payroll");
	}

	private function _next($id, $url='payroll_summary/view/') {
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

	private function _previous($id, $url='payroll_summary/view/') {
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
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);

			if( $this->session->userdata('employees_status') ) {
				$employees->set_where('e.status', $this->session->userdata('employees_status')->id);
			}

			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			$employees->set_select("(SELECT COUNT(*) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences");

			$employees->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');

			$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences_hours");
			
			// gross earnings
			$employees->set_select("(SELECT SUM(pee.amount) FROM payroll_employees_earnings pee WHERE pee.payroll_id=pe.payroll_id AND pee.name_id=pe.name_id) as gross_earnings");

			// gross benefits
			$employees->set_select("(SELECT SUM(peb.employee_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=pe.payroll_id AND peb.name_id=pe.name_id) as gross_benefits");

			// gross deductions
			$employees->set_select("(SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.payroll_id=pe.payroll_id AND ped.name_id=pe.name_id) as gross_deductions");

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
		$this->load->view('payroll/payroll/summary/summary_view', $this->template_data->get_data());
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


		$earnings_columns = new $this->Payroll_templates_earnings_model('pe');
		$earnings_columns->setTemplateId($template_id,true);
		$earnings_columns->set_select('el.*');
		$earnings_columns->set_join('earnings_list el', 'el.id=pe.earning_id');
		$earnings_columns->set_order('pe.order', 'DESC');
		$columns = $earnings_columns->populate();
		$this->template_data->set('earnings_columns', $columns);

		$benefits_columns = new $this->Payroll_templates_benefits_model('pb');
		$benefits_columns->setTemplateId($template_id,true);
		$benefits_columns->set_select('bl.*');
		$benefits_columns->set_join('benefits_list bl', 'bl.id=pb.benefit_id');
		$benefits_columns->set_order('pb.order', 'DESC');
		$columns = $benefits_columns->populate();
		$this->template_data->set('benefits_columns', $columns);

		$deductions_columns = new $this->Payroll_templates_deductions_model('pd');
		$deductions_columns->setTemplateId($template_id,true);
		$deductions_columns->set_select('dl.*');
		$deductions_columns->set_join('deductions_list dl', 'dl.id=pd.deduction_id');
		$deductions_columns->set_order('pd.order', 'DESC');
		$columns = $deductions_columns->populate();
		$this->template_data->set('deductions_columns', $columns);
		
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
			$employees->set_select('e.name_id');
			$employees->set_select('e.hired');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);
			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}
			if( $this->session->userdata('employees_status') ) {
				$employees->set_where('e.status', $this->session->userdata('employees_status')->id);
			}

			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');
			
			// gross benefits
			$employees->set_select(sprintf('(SELECT SUM(peb.employee_share) FROM employees_benefits peb WHERE ((SELECT COUNT(*) FROM employees_benefits_templates WHERE template_id=%s AND eb_id=peb.id) >= 1) AND peb.name_id=pe.name_id AND peb.trash=0) as gross_benefits', $template_id));
			
			// gross earnings
			$employees->set_select(sprintf('(SELECT SUM(amount) FROM employees_earnings ee WHERE ((SELECT COUNT(*) FROM employees_earnings_templates WHERE template_id=%s AND ee_id=ee.id) >= 1) AND ee.name_id=pe.name_id AND ee.active=1 AND ee.trash=0) as gross_earnings', $template_id));

			// gross deductions
			$employees->set_select(sprintf('(SELECT SUM(ed.amount) FROM employees_deductions ed WHERE ((SELECT COUNT(*) FROM employees_deductions_templates WHERE template_id=%s AND ed_id=ed.id) >= 1) AND ed.name_id=pe.name_id AND ed.active=1 AND ed.trash=0 AND ((ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) > 0) ) as gross_deductions', $template_id));

			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate();
			foreach( $employees_data as $eKey => $employee) {
				$salary = new $this->Employees_salaries_model('es');
				$salary->setNameId($employee->name_id,true);
				$employees_data[$eKey]->salary = $salary->get();

				$employee_earnings = new $this->Employees_earnings_model('ee');
				$employee_earnings->setCompanyId($this->session->userdata('current_company_id'),true);
				$employee_earnings->setNameId($employee->name_id,true);
				$employee_earnings->setStartDate(date('Y-m-d'),true,false,'<=');
				$employee_earnings->set_where('((SELECT COUNT(*) FROM employees_earnings_templates eet WHERE eet.template_id='.$template_id.' AND eet.ee_id=ee.id)>0)');
				$employee_earnings->set_limit(0);
				$employees_data[$eKey]->earnings_data = $employee_earnings->populate();
			} 

			$payroll_group_data[$key]->employees = $employees_data;
		}
		$this->template_data->set('payroll_groups', $payroll_group_data);
		
		$employees_status = new $this->Payroll_templates_employees_model('pe');
		$employees_status->setTemplateId($template_id,true);
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
		
		$this->load->view('payroll/payroll/summary/summary_preview', $this->template_data->get_data());
	}

}
