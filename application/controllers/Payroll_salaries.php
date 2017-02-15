<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_salaries extends MY_Controller {
	
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

		$this->load->model('Employees_model');

	}

	public function index() {
		redirect("payroll");
	}
	
	public function view($id,$output='') {

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$payroll_group = new $this->Payroll_groups_model('pg');
		$payroll_group->setPayrollId($id,true);
		$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
		$payroll_group->set_limit(0);
		$payroll_group->set_order('pg.order', 'DESC');
		$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
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
			$employees->setPayrollId($id,true);
			$employees->set_select('e.*');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);
			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			$employees->set_select("(SELECT COUNT(*) FROM employees_absenses ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absenses");
			
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
		
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/salaries/salaries_view', $this->template_data->get_data());
	}

}
