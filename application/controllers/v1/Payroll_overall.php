<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_overall extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Basic Salary');
		$this->template_data->set('current_uri', 'payroll_salaries');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

	}

	public function index() {
		redirect("payroll");
	}
	
	private function _print($id, $print_group=0, $output='print', $current_page=1) {

		$this->template_data->set('print_group', $print_group);
		$this->template_data->set('output', $output);
		$this->template_data->set('current_page', $current_page);

		$company = new $this->Companies_list_model;
		$company->setId($this->session->userdata('current_company_id'),true);
		$this->template_data->set('company', $company->get());

		$company_options = new $this->Companies_options_model;
		$company_options->setCompanyId($this->session->userdata('current_company_id'),true);
		$company_options->setKey('print_css',true);
		$this->template_data->set('print_css', $company_options->get());

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$template = new $this->Payroll_templates_model;
		$template->setId($payroll_data->template_id,true);
		$this->template_data->set('template', $template->get());
		
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
		$earnings_columns->set_limit(0);
		$columns_earnings = $earnings_columns->populate();
		$this->template_data->set('earnings_columns', $columns_earnings);

		// benefits
		$benefits_columns = new $this->Payroll_benefits_model('pb');
		$benefits_columns->setPayrollId($id,true);
		$benefits_columns->set_select('bl.*');
		$benefits_columns->set_join('benefits_list bl', 'bl.id=pb.benefit_id');
		$benefits_columns->set_order('pb.order', 'DESC');
		$benefits_columns->set_limit(0);
		$columns_benefits = $benefits_columns->populate();
		$this->template_data->set('benefits_columns', $columns_benefits);

		// deductions
		$deductions_columns = new $this->Payroll_deductions_model('pd');
		$deductions_columns->setPayrollId($id,true);
		$deductions_columns->set_select('dl.*');
		$deductions_columns->set_join('deductions_list dl', 'dl.id=pd.deduction_id');
		$deductions_columns->set_order('pd.order', 'DESC');
		$deductions_columns->set_limit(0);
		$columns_deductions = $deductions_columns->populate();
		$this->template_data->set('deductions_columns', $columns_deductions);

		$leave = new $this->Benefits_list_model('b');
		$leave->setLeave(1,true);
		$leave->setTrash(0,true);
		$leave->set_select("*");
		$leave_benefits = $leave->populate();
		$this->template_data->set('leave_benefits', $leave_benefits);

		switch( $payroll_data->group_by ) {
			case 'position':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				$payroll_group->set_join('employees_positions eg', 'pg.position_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE position_id=pg.position_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_positions WHERE id=pg.position_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();
				
			break;
			case 'area':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				$payroll_group->set_join('employees_areas eg', 'pg.area_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE area_id=pg.area_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_areas WHERE id=pg.area_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			break;
			case 'status':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				$payroll_group->set_join('terms_list eg', 'pg.status_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("pg.status_id > 0");
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE status=pg.status_id) > 0)");
				//$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			break;
			case 'group':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			default:
			break;
		}

		foreach($payroll_group_data as $key=>$group) {

			$employees = new $this->Payroll_employees_model('pe');
			$employees->setPayrollId($id,true);
			$employees->set_select('ni.*');
			$employees->set_select('e.*');
			$employees->set_select('ni.name_id');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_select('pe.template as payslip_template');
			$employees->set_select('pe.print_group');
			$employees->set_select('pe.id as pe_id');
			$employees->set_select('pe.presence as pe_presence');
			$employees->set_select('pe.manual as pe_manual');
			$employees->set_select('e.employee_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');

			switch ($output) {
				case 'payslip':
					$employees->set_group_by('e.name_id');
					break;
				
			}

			switch( $payroll_data->group_by ) {
				case 'position':
					$employees->set_where('pe.position_id', $group->position_id);
				break;
				case 'area':
					$employees->set_where('pe.area_id', $group->area_id);
				break;
				case 'status':
					$employees->set_where('pe.status_id', $group->status_id);
				break;
				case 'group':
				default:
					$employees->set_where('pe.group_id', $group->group_id);
				break;
			}
			
			if( $this->input->get('filter') ) {
				$employees->set_where('ni.name_id', $this->input->get('filter'));
			}

			$employees->set_select('(SELECT name FROM employees_positions WHERE id=pe.position_id) as position');

			$employees->set_select("(SELECT COUNT(*) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences");

			$employees->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');

			$employees->set_select("(SELECT COUNT(*) FROM employees_attendance ea2 WHERE ea2.name_id=pe.name_id AND ea2.date_present >= '{$dates_data->start_date}' AND ea2.date_present <= '{$dates_data->end_date}') as attendance");

			$employees->set_select("(SELECT SUM(ea2.hours) FROM employees_attendance ea2 WHERE ea2.name_id=pe.name_id AND ea2.date_present >= '{$dates_data->start_date}' AND ea2.date_present <= '{$dates_data->end_date}') as attendance_hours");
			
			//$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences_hours");
			$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences_hours");
			$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.leave_type>0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as leave_benefits");

			foreach($columns_earnings as $column) {
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_earnings pee WHERE pee.payroll_id=%s AND pee.name_id=pe.name_id AND pee.earning_id=%s  AND pee.manual=pe.manual) as earnings_%s', $id, $column->id, $column->id));
			}

			foreach($columns_benefits as $column) {
				$employees->set_select(sprintf('(SELECT SUM(peb.employee_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND peb.benefit_id=%s AND peb.manual=pe.manual) as ee_share_%s', $id, $column->id, $column->id));
				$employees->set_select(sprintf('(SELECT SUM(peb.employer_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=%s AND peb.name_id=pe.name_id AND peb.benefit_id=%s AND peb.manual=pe.manual) as er_share_%s', $id, $column->id, $column->id));

			}

			foreach($columns_deductions as $column) {
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_deductions ped WHERE ped.payroll_id=%s AND ped.name_id=pe.name_id AND ped.deduction_id=%s AND ped.manual=pe.manual) as deductions_%s', $id, $column->id, $column->id));
			}

			if( $output == 'payslip') {
				$employees->set_select("(SELECT COUNT(elb2.days) FROM employees_leave_benefits elb2 WHERE elb2.company_id=e.company_id AND elb2.name_id=e.name_id AND elb2.year='{$payroll_data->year}') as has_leave");

				foreach( $leave_benefits as $leave1) {
					$employees->set_select("(SELECT elb.days FROM employees_leave_benefits elb WHERE elb.company_id=e.company_id AND elb.name_id=e.name_id AND elb.benefit_id={$leave1->id} AND elb.year='{$payroll_data->year}') as allowed_leave_{$leave1->id}");
					$employees->set_select("(SELECT SUM(eab.hours/8) FROM employees_absences eab WHERE eab.name_id=e.name_id AND eab.leave_type={$leave1->id} AND YEAR(eab.date_absent)='{$payroll_data->year}') as availed_leave_{$leave1->id}");
				}
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
				$salary->setPeId($employee->pe_id,true);
				//$salary->set_join('employees_salaries es', 'es.id=pes.salary_id');
				//$salary->set_select('*, pes.amount as override');
				//$salary->set_where('es.trash', 0);
				$employees_data[$eKey]->salary = $salary->get();
			}

			$payroll_group_data[$key]->employees = $employees_data;
		} 
		$this->template_data->set('payroll_groups', $payroll_group_data);
				
		$tcol = new $this->Payroll_templates_columns_model;
		$tcol->setTemplateId($payroll_data->template_id,true);
		$tcol->setTermId($print_group,true);
		$tcol->set_limit(0);
		$print_columns = $tcol->populate();
		$this->template_data->set('print_columns', $print_columns);

		$options = new $this->Companies_options_model;
		$options->setCompanyId($this->session->userdata('current_company_id'),true);
		$options->setKey('print_group',true);
		$options_data = $options->get();

		if( $options_data ) {
			$this->template_data->set('print_group_option', $options_data);

			$print_groups = new $this->Terms_list_model;
			$print_groups->setTrash('0',true);
			$print_groups->setType('print_group',true);
			$print_groups->set_select("*");
			$print_groups->set_order('priority', 'ASC');
			$print_groups->set_order('name', 'ASC');
			$print_groups->set_limit(0);
			$print_groups->set_where_in('id', unserialize($options_data->value));
			$this->template_data->set('print_groups', $print_groups->populate());
		}

		$all_earnings = new $this->Earnings_list_model('e');
		$all_earnings->set_order('e.name', 'ASC');
		$all_earnings->set_limit(0);
		$this->template_data->set('all_earnings', $all_earnings->populate());

		$all_benefits = new $this->Benefits_list_model('b');
		$all_benefits->setLeave('0', true);
		$all_benefits->set_order('b.name', 'ASC');
		$all_benefits->set_limit(0);
		$this->template_data->set('all_benefits', $all_benefits->populate());

		$all_deductions = new $this->Deductions_list_model('d');
		$all_deductions->set_order('d.name', 'ASC');
		$all_deductions->set_limit(0);
		$this->template_data->set('all_deductions', $all_deductions->populate());

		$this->_column_groups();

	}

	public function view($id, $print_group=0, $output='print', $current_page=1) {

		$this->template_data->set('print_group', $print_group);
		$this->template_data->set('output', $output);
		$this->template_data->set('current_page', $current_page);

		$this->_print($id, $print_group, $output, $current_page);

		$page_title = $this->template_data->get('page_title');
		$payroll = $this->template_data->get('payroll');

			switch($output) {
				case 'transmittal':
					$this->template_data->set('page_title',  $page_title . ' - ' . $payroll->name . ' - Transmittal' );
					$this->load->view('payroll/payroll/overall/overall_transmittal', $this->template_data->get_data());
				break;
				case 'journal':
					$this->template_data->set('page_title',  $page_title . ' - ' . $payroll->name . ' - Payslip' );
					$this->load->view('payroll/payroll/overall/overall_journal', $this->template_data->get_data());
				break;
				case 'payslip':
					$this->template_data->set('page_title',  $page_title . ' - ' . $payroll->name . ' - Payslip' );
					$this->load->view('payroll/payroll/overall/overall_payslip', $this->template_data->get_data());
				break;
				case 'payslip_long':
					$this->template_data->set('page_title',  $page_title . ' - ' . $payroll->name . ' - Payslip Long' );
					$this->template_data->set('paper_size', 'long');
					$this->load->view('payroll/payroll/overall/overall_payslip', $this->template_data->get_data());
				break;
				case 'denomination':
					$this->template_data->set('page_title',  $page_title . ' - ' . $payroll->name . ' - Denomination' );
					$this->load->view('payroll/payroll/overall/overall_denomination', $this->template_data->get_data());
				break;
				case 'xls':

					$company = $this->template_data->get('company');
					$filename = url_title($company->name)."-".$id.'.xls';
					
					if($print_group > 0) {
						$term = new $this->Terms_list_model('t');
						$term->setId($print_group,true);
						$term_data = $term->get();
						$this->template_data->set('print_group_term', $term_data);

						$filename = url_title($company->name)."-".$id."-".$term_data->name.'.xls';
					}
					
					$this->output->set_content_type('application/vnd-ms-excel');
					$this->output->set_header('Content-Disposition: attachment; filename='.$filename);
					$this->load->view('payroll/payroll/overall/overall_xls', $this->template_data->get_data());
				break;
				default:
					$this->template_data->set('page_title',  $page_title . ' - ' . $payroll->name . ' - Payroll Summary' );
					$this->load->view('payroll/payroll/overall/overall_print', $this->template_data->get_data());
				break;
			}
	}

	public function summary($id) {
		$this->_print($id);
		$this->load->view('payroll/payroll/overall/overall_summary', $this->template_data->get_data());
	}

	public function config($id) {

		$company = new $this->Companies_list_model;
		$company->setId($this->session->userdata('current_company_id'),true);
		$this->template_data->set('company', $company->get());

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
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

		$earnings = new $this->Earnings_list_model('el');
		$earnings->set_select('el.*');
		$earnings->set_select("(SELECT pte.earning_id FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id ) as selected");
		$earnings->set_select("(SELECT pte.order FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id) as sort");
		$earnings->set_order("(SELECT pte.order FROM payroll_templates_earnings pte WHERE pte.template_id = {$id} AND pte.earning_id = el.id)", 'DESC');
		$earnings->set_limit(0);
		$this->template_data->set('earnings', $earnings->populate());

		$benefits = new $this->Benefits_list_model('bl');
		$benefits->set_select('bl.*');
		$benefits->set_select("(SELECT ptb.benefit_id FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id ) as selected");
		$benefits->set_select("(SELECT ptb.order FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id) as sort");
		$benefits->set_order("(SELECT ptb.order FROM payroll_templates_benefits ptb WHERE ptb.template_id = {$id} AND ptb.benefit_id = bl.id)", 'DESC');
		$benefits->setLeave(0,true);
		$benefits->set_limit(0);
		$this->template_data->set('benefits', $benefits->populate());

		$deductions = new $this->Deductions_list_model('dl');
		$deductions->set_select('dl.*');
		$deductions->set_select("(SELECT ptd.deduction_id FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id ) as selected");
		$deductions->set_select("(SELECT ptd.order FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id) as sort");
		$deductions->set_order("(SELECT ptd.order FROM payroll_templates_deductions ptd WHERE ptd.template_id = {$id} AND ptd.deduction_id = dl.id)", 'DESC');
		$deductions->set_limit(0);
		$this->template_data->set('deductions', $deductions->populate());

		$this->load->view('payroll/payroll/overall/overall_config', $this->template_data->get_data());
	}

}
