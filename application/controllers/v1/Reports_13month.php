<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_13month extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', '13th Month Pay');
		$this->template_data->set('current_uri', 'reports_13month');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('reports', '13month', 'view');

	}

	public function index($filter_year=0, $start=0) {

		if( $filter_year == 0 ) {
			$filter_year = date('Y');
		}

		$this->template_data->set('filter_year', $filter_year);

		$employees = new $this->Payroll_employees_model('e');
		if( $this->input->get('q') ) {
			$employees->set_where('(ni.lastname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('ni.firstname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('ni.middlename LIKE "%' . $this->input->get('q') . '%")', NULL, 99);
		}

		//$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		
		$employees->set_select('e.*');
		$employees->set_join('names_info ni','ni.name_id=e.name_id');
		$employees->set_select('ni.lastname as lastname');
		$employees->set_select('ni.firstname as firstname');
		$employees->set_select('ni.middlename as middlename');

		$employees->set_order('ni.lastname', 'ASC');
		$employees->set_start($start);

		$employees->set_join("payroll_employees_salaries pes", 'pes.pe_id=e.id');
		//$employees->set_select('pes.*');
		$employees->set_select('((pes.amount * pes.months) / pes.annual_days) as daily_rate');

		$employees->set_select('(SELECT COUNT(*) FROM employees_absences ea WHERE ea.pe_id=e.id AND ea.leave_type=0) as absenses');

		$employees->set_select('(SELECT COUNT(*) FROM payroll_inclusive_dates pid WHERE e.payroll_id=pid.payroll_id) as working_days');
		
		$employees->set_select('((SELECT COUNT(*) FROM payroll_inclusive_dates pid WHERE e.payroll_id=pid.payroll_id) * ((pes.amount * pes.months) / pes.annual_days)) as gross_salary');

		$employees->set_select('((SELECT COUNT(*) FROM employees_absences ea WHERE ea.pe_id=e.id AND ea.leave_type=0) * ((pes.amount * pes.months) / pes.annual_days)) as absenses_amt');

		$employees->set_select('(((SELECT COUNT(*) FROM payroll_inclusive_dates pid WHERE e.payroll_id=pid.payroll_id) * ((pes.amount * pes.months) / pes.annual_days)) - ((SELECT COUNT(*) FROM employees_absences ea WHERE ea.pe_id=e.id AND ea.leave_type=0) * ((pes.amount * pes.months) / pes.annual_days))) as net_salary');

		$employees->set_select('(SUM(((SELECT COUNT(*) FROM payroll_inclusive_dates pid WHERE e.payroll_id=pid.payroll_id) * ((pes.amount * pes.months) / pes.annual_days)) - ((SELECT COUNT(*) FROM employees_absences ea WHERE ea.pe_id=e.id AND ea.leave_type=0) * ((pes.amount * pes.months) / pes.annual_days))) / pes.months) as net_salary');

		$employees->set_group_by('e.name_id');

		$employees_data = $employees->populate();

		$this->template_data->set('employees', $employees_data);
		$this->template_data->set('employees_count', $employees->count_all_results());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url( $this->config->item('index_page') . "/reports_13month/index/{$filter_year}"),
			'total_rows' => $employees->count_all_results(),
			'per_page' => $employees->get_limit(),
			'ajax'=>true
		)));

		$payroll_years = new $this->Payroll_model;
		$payroll_years->setCompanyId($this->session->userdata('current_company_id'),true);
		$payroll_years->set_select('year');
		$payroll_years->set_group_by('year');
		$payroll_years->set_order('year', 'DESC');
		$payroll_years->set_limit(0);
		$this->template_data->set('payroll_years', $payroll_years->populate());



		$this->load->view('reports/13month/13month_view', $this->template_data->get_data());
	}

}
