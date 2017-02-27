<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_overall extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Basic Salary');
		$this->template_data->set('current_uri', 'payroll_salaries');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		$this->load->model('Payroll_model');
		$this->load->model('Payroll_templates_model');
		$this->load->model('Payroll_inclusive_dates_model');
		$this->load->model('Payroll_groups_model');
		$this->load->model('Payroll_earnings_model');
		$this->load->model('Payroll_deductions_model');
		$this->load->model('Payroll_benefits_model');

		$this->load->model('Payroll_employees_model');
		$this->load->model('Payroll_employees_salaries_model');

		$this->load->model('Payroll_templates_groups_model');
		$this->load->model('Payroll_templates_benefits_model');
		$this->load->model('Payroll_templates_earnings_model');
		$this->load->model('Payroll_templates_deductions_model');
		$this->load->model('Payroll_templates_columns_model');

		$this->load->model('Employees_model');
		$this->load->model('Terms_list_model');

	}

	public function index() {
		redirect("payroll");
	}
	
	public function view($id, $print_group=0, $output='print') {

		$this->template_data->set('print_group', $print_group);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

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

		// earnings
		$earnings_columns = new $this->Payroll_earnings_model('pe');
		$earnings_columns->setPayrollId($id,true);
		$earnings_columns->set_select('el.*');
		$earnings_columns->set_join('earnings_list el', 'el.id=pe.earning_id');
		$earnings_columns->set_order('pe.order', 'DESC');
		$columns_earnings = $earnings_columns->populate();
		$this->template_data->set('earnings_columns', $columns_earnings);

		// benefits
		$benefits_columns = new $this->Payroll_benefits_model('pb');
		$benefits_columns->setPayrollId($id,true);
		$benefits_columns->set_select('bl.*');
		$benefits_columns->set_join('benefits_list bl', 'bl.id=pb.benefit_id');
		$benefits_columns->set_order('pb.order', 'DESC');
		$columns_benefits = $benefits_columns->populate();
		$this->template_data->set('benefits_columns', $columns_benefits);

		// deductions
		$deductions_columns = new $this->Payroll_deductions_model('pd');
		$deductions_columns->setPayrollId($id,true);
		$deductions_columns->set_select('dl.*');
		$deductions_columns->set_join('deductions_list dl', 'dl.id=pd.deduction_id');
		$deductions_columns->set_order('pd.order', 'DESC');
		$columns_deductions = $deductions_columns->populate();
		$this->template_data->set('deductions_columns', $columns_deductions);

		$payroll_group = new $this->Payroll_groups_model('pg');
		$payroll_group->setPayrollId($id,true);
		$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
		$payroll_group->set_limit(0);
		$payroll_group->set_order('pg.order', 'DESC');
		//$payroll_group->set_select("(SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) as employee_count");
		$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
		$payroll_group_data =  $payroll_group->populate();
		foreach($payroll_group_data as $key=>$group) {
			$employees = new $this->Payroll_employees_model('pe');
			$employees->setPayrollId($id,true);
			$employees->set_select('e.*');
			$employees->set_select('pe.template as payslip_template');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);
			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			$employees->set_select("(SELECT COUNT(*) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences");

			$employees->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');

			$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences_hours");

			foreach($columns_earnings as $column) {
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_earnings pee WHERE pee.payroll_id=%s AND pee.name_id=pe.name_id AND pee.earning_id=%s) as earnings_%s', $id, $column->id, $column->id));
			}

			foreach($columns_benefits as $column) {
				$employees->set_select(sprintf('(SELECT SUM(peb.employee_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND peb.benefit_id=%s) as ee_share_%s', $id, $column->id, $column->id));
				$employees->set_select(sprintf('(SELECT SUM(peb.employer_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND peb.benefit_id=%s) as er_share_%s', $id, $column->id, $column->id));

			}

			foreach($columns_deductions as $column) {
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_deductions ped WHERE ped.payroll_id=%s AND ped.name_id=pe.name_id AND ped.deduction_id=%s) as deductions_%s', $id, $column->id, $column->id));
			}

			$employees->setActive('1', true);
			if( $print_group > 0 ) {
				$employees->setPrintGroup($print_group, true);
			}
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);

			$employees_data = $employees->populate();

			foreach( $employees_data as $eKey => $employee) {
				$salary = new $this->Payroll_employees_salaries_model('pes');
				$salary->setPayrollId($id,true);
				$salary->setNameId($employee->name_id,true);
				$salary->set_join('employees_salaries es', 'es.id=pes.salary_id');
				$salary->set_select('*, pes.amount as override');
				$employees_data[$eKey]->salary = $salary->get();
			}

			$payroll_group_data[$key]->employees = $employees_data;
		}
		$this->template_data->set('payroll_groups', $payroll_group_data);
		
		$print_columns = false;
		if( $print_group > 0) {
			$tcol = new $this->Payroll_templates_columns_model;
			$tcol->setTemplateId($payroll_data->template_id,true);
			$tcol->setTermId($print_group,true);
			$tcol->set_limit(0);
			$print_columns = $tcol->populate();
		}
		
		$this->template_data->set('print_columns', $print_columns);

		switch($output) {
			case 'payslip':
				$this->load->view('payroll/payroll/overall/overall_payslip', $this->template_data->get_data());
			break;
			default:
				$this->load->view('payroll/payroll/overall/overall_print', $this->template_data->get_data());
			break;
		}
	}

}
