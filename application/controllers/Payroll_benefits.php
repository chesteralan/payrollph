<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_benefits extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Benefits');
		$this->template_data->set('current_uri', 'payroll_benefits');
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
		$this->load->model('Payroll_employees_benefits_model');

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
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$benefits_columns = new $this->Payroll_benefits_model('pb');
		$benefits_columns->setPayrollId($id,true);
		$benefits_columns->set_select('bl.*');
		$benefits_columns->set_join('benefits_list bl', 'bl.id=pb.benefit_id');
		$benefits_columns->set_order('pb.order', 'DESC');
		$columns = $benefits_columns->populate();
		$this->template_data->set('benefits_columns', $columns);

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
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);
			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');
			
			foreach($columns as $column) {
				$employees->set_select(sprintf('(SELECT SUM(eb.employee_share) FROM payroll_employees_benefits peb JOIN employees_benefits eb ON peb.benefit_id=eb.id WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND eb.benefit_id=%s AND eb.primary=1 AND eb.trash=0) as ee_share_%s', $id, $column->id, $column->id));
				$employees->set_select(sprintf('(SELECT SUM(eb.employer_share) FROM payroll_employees_benefits peb JOIN employees_benefits eb ON peb.benefit_id=eb.id WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND eb.benefit_id=%s AND eb.primary=1 AND eb.trash=0) as er_share_%s', $id, $column->id, $column->id));
			}
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
		
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/benefits/benefits_view', $this->template_data->get_data());
	}

}
