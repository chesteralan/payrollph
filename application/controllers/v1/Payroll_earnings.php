<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_earnings extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Earnings');
		$this->template_data->set('current_uri', 'payroll_earnings');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		if( !get_company_option($this->session->userdata('current_company_id'), 'column_group_earnings') ) {
			redirect("welcome");
		}

		$this->session->set_userdata('page_session', 'payroll_earnings');
	}

	public function index() {
		redirect("payroll");
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

		$inclusive_dates = new $this->Payroll_inclusive_dates_model;
		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_select('COUNT(*) as working_days');
		$inclusive_dates->set_select('MIN(inclusive_date) as start_date');
		$inclusive_dates->set_select('MAX(inclusive_date) as end_date');
		$dates_data = $inclusive_dates->get();
		$this->template_data->set('inclusive_dates', $dates_data);

	if( $dates_data->working_days > 0 ) {

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
			$payrolls->set_limit(20);
			$this->template_data->set('other_payrolls', $payrolls->populate());
		}

		if($this->input->get('compare')) {
			$compare_payroll = new $this->Payroll_model;
			$compare_payroll->setId($this->input->get('compare'),true);
			$this->template_data->set('compare_payroll', $compare_payroll->get());
		}

		$earnings_columns = new $this->Payroll_earnings_model('pe');
		$earnings_columns->setPayrollId($id,true);
		$earnings_columns->set_select('el.*');
		$earnings_columns->set_join('earnings_list el', 'el.id=pe.earning_id');
		$earnings_columns->set_order('pe.order', 'DESC');
		if( $column_id ) {
			$earnings_columns->set_where('el.id', $column_id);
		}
		$columns = $earnings_columns->populate();
		$this->template_data->set('earnings_columns', $columns);

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
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_earnings pee WHERE pee.payroll_id=%s AND pee.name_id=pe.name_id AND pee.earning_id=%s) as earnings_%s', $id, $column->id, $column->id));

				if( ($column_id) && ($this->input->get('compare'))) {
					$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_earnings pee WHERE pee.payroll_id=%s AND pee.name_id=pe.name_id AND pee.earning_id=%s) as compare_%s', $this->input->get('compare'), $column->id, $column->id));
				}
			}

			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate();
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

		$this->template_data->set('next_item', $this->_next_payroll($id, $group_id, 'payroll_earnings/view/'));
		$this->template_data->set('previous_item', $this->_previous_payroll($id, $group_id, 'payroll_earnings/view/'));

	} else {

		$this->template_data->set('no_inclusive_dates', true);

	}
	
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/earnings/earnings_view', $this->template_data->get_data());
	}

	public function entries($id,$name_id,$earning_id,$output='') {

		$this->template_data->set('payroll_id', $id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('earning_id', $earning_id);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$earning_data = new $this->Earnings_list_model;
		$earning_data->setId($earning_id,true);
		$this->template_data->set('earning_data', $earning_data->get());

		$earnings = new $this->Payroll_employees_earnings_model('pee');
		$earnings->setPayrollId($id,true);
		$earnings->setNameId($name_id,true);
		$earnings->setEarningId($earning_id,true);
		$earnings->set_select('*');
		$earnings->set_select('IF((pee.notes="" OR pee.notes IS NULL), ee.notes, pee.notes) as enotes');
		$earnings->set_select('pee.amount as pee_amount');
		$earnings->set_select('pee.id as pee_id');
		$earnings->set_join('earnings_list el', 'pee.earning_id=el.id');
		$earnings->set_join('employees_earnings ee', 'ee.id=pee.entry_id');
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/earnings/earnings_entries', $this->template_data->get_data());
	}

	public function add($id,$name_id,$earning_id,$output='') {

		$this->template_data->set('payroll_id', $id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('earning_id', $earning_id);

		if( $this->input->post() ) {
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$earnings = new $this->Payroll_employees_earnings_model('pee');
				$earnings->setPayrollId($id,true);
				$earnings->setNameId($name_id,true);
				$earnings->setEarningId($earning_id,true);
				$earnings->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$earnings->setNotes($this->input->post('notes'));
				$earnings->setEntryId( $this->input->post('entry_id') );
				$earnings->insert();
			}
			//redirect("payroll_earnings/view/{$id}");
			$this->postNext();
		}

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$earning_data = new $this->Earnings_list_model;
		$earning_data->setId($earning_id,true);
		$this->template_data->set('earning_data', $earning_data->get());

		$employees_earnings = new $this->Employees_earnings_model('ee');
		$employees_earnings->setEarningId($earning_id,true);
		$employees_earnings->setNameId($name_id,true);
		$employees_earnings->set_select("ee.*");
		$employees_earnings->set_select("(ee.max_amount - (SELECT SUM(pee.amount) FROM payroll_employees_earnings pee WHERE pee.entry_id=ee.id)) as balance");
		$employees_earnings->set_where("ee.active=1");
		//$employees_earnings->set_where("(((ee.max_amount - (SELECT SUM(pee.amount) FROM payroll_employees_earnings pee WHERE pee.entry_id=ee.id)) IS NULL)");
		//$employees_earnings->set_where_or("((ee.max_amount - (SELECT SUM(pee.amount) FROM payroll_employees_earnings pee WHERE pee.entry_id=ee.id)) > 0))");
		$this->template_data->set('employees_earnings', $employees_earnings->populate());

		$this->_column_groups();
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/earnings/earnings_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$earnings = new $this->Payroll_employees_earnings_model('pee');
		$earnings->setId($id,true);
		$earnings->set_select("*");
		
		$earnings->set_select("(SELECT ee.max_amount FROM employees_earnings ee WHERE ee.id=pee.entry_id) as max_amount");
		$earnings->set_select("(SELECT SUM(pee2.amount) FROM payroll_employees_earnings pee2 WHERE pee2.entry_id=pee.entry_id AND pee2.id!=pee.id) as amount_earned");

		$earnings->set_select("((SELECT ee.max_amount FROM employees_earnings ee WHERE ee.id=pee.entry_id) - (SELECT SUM(pee2.amount) FROM payroll_employees_earnings pee2 WHERE pee2.entry_id=pee.entry_id AND pee2.id!=pee.id)) as amount_balance");

		$earning_data = $earnings->get();

		if( $this->input->post() ) {
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {

				$amount = str_replace(",", "", $this->input->post('amount'));
				if( floatval($earning_data->max_amount) > 0 ) {
					$amount = ($amount >= $earning_data->amount_balance) ? $earning_data->amount_balance : $amount;
				}

				$earnings->setAmount( $amount, false, true );
				$earnings->setNotes($this->input->post('notes'), false, true);
				$earnings->setEntryId( $this->input->post('entry_id'), false, true );
				$earnings->update();
			}
			//redirect("payroll_earnings/view/{$earning_data->payroll_id}");
			$this->postNext();
		}

		$this->template_data->set('earning', $earnings->get());

		$payroll = new $this->Payroll_model;
		$payroll->setId($earning_data->payroll_id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$earning_list = new $this->Earnings_list_model;
		$earning_list->setId($earning_data->earning_id,true);
		$this->template_data->set('earning_data', $earning_list->get());

		$employees_earnings = new $this->Employees_earnings_model('ee');
		$employees_earnings->setEarningId($earning_data->earning_id,true);
		$employees_earnings->setNameId($earning_data->name_id,true);
		$employees_earnings->set_select("ee.*");
		$employees_earnings->set_select("(ee.max_amount - (SELECT SUM(pee.amount) FROM payroll_employees_earnings pee WHERE pee.entry_id=ee.id)) as balance");
		$employees_earnings->set_where("ee.active=1");
		//$employees_earnings->set_where("(((ee.max_amount - (SELECT SUM(pee.amount) FROM payroll_employees_earnings pee WHERE pee.entry_id=ee.id)) IS NULL)");
		//$employees_earnings->set_where_or("((ee.max_amount - (SELECT SUM(pee.amount) FROM payroll_employees_earnings pee WHERE pee.entry_id=ee.id)) > 0))");
		$this->template_data->set('employees_earnings', $employees_earnings->populate());

		$this->_column_groups();
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/earnings/earnings_edit', $this->template_data->get_data());
	}

	public function delete($id,$output='') {

		$earnings = new $this->Payroll_employees_earnings_model;
		$earnings->setId($id,true);
		$earning_data = $earnings->get();
		$earnings->delete();

		$this->getNext("payroll_earnings/view/{$earning_data->payroll_id}");
		
	}

	public function item_schedule($id,$earning_id,$output='') {

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
		
		$earning_list = new $this->Earnings_list_model;
		$earning_list->setId($earning_id,true);
		$this->template_data->set('earning_data', $earning_list->get());


		$earnings = new $this->Payroll_employees_earnings_model('pee');
		$earnings->setPayrollId($id,true);
		$earnings->setEarningId($earning_id,true);
		$earnings->set_select("pee.*");
		$earnings->set_select("pee.notes as item_notes");
		$earnings->set_select("(SELECT ee.max_amount FROM employees_earnings ee WHERE ee.id=pee.entry_id) as max_amount");
		$earnings->set_select("(SELECT ee.notes FROM employees_earnings ee WHERE ee.id=pee.entry_id) as ee_notes");

		$earnings->set_select("(SELECT SUM(pee2.amount) FROM payroll_employees_earnings pee2 WHERE pee.name_id=pee2.name_id AND pee.earning_id=pee2.earning_id AND pee2.entry_id=pee.entry_id AND pee2.id!=pee.id) as amount_paid");

		$earnings->set_select("e.*");
		$earnings->set_join("names_info e", 'e.name_id=pee.name_id');

		$earnings->set_order('e.lastname', 'ASC');
		$earnings->set_order('e.firstname', 'ASC');
		$earnings->set_order('e.middlename', 'ASC');

		$earnings->set_join("payroll_employees pe", 'pe.name_id=pee.name_id');
		$earnings->set_where('pe.active', 1);
		$earnings->set_where('pe.payroll_id', $id);
		
		$earnings->set_limit(0);
		$item_data = $earnings->populate(); 
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

			$this->load->view('payroll/payroll/earnings/earnings_item_schedule_print', $this->template_data->get_data());

		} else {

			$this->load->view('payroll/payroll/earnings/earnings_item_schedule', $this->template_data->get_data());
			
		}

	}

	public function reset($id,$earning_id) {

		$earnings = new $this->Payroll_employees_earnings_model;
		$earnings->setPayrollId($id, true);
		$earnings->setEarningId($earning_id,true);
		$earnings->delete();
		
		$this->getNext("payroll_earnings/view/{$id}");

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
			$employees->set_select('e.hired');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);
			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}
/*
			foreach($columns as $column) {
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM employees_earnings ee WHERE ((SELECT COUNT(*) FROM employees_earnings_templates WHERE template_id=%s AND ee_id=ee.id) >= 1) AND ee.name_id=pe.name_id AND ee.earning_id=%s AND ee.trash=0) as earnings_%s', $template_id, $column->id, $column->id, $column->id));
			}
*/
			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate();

			foreach( $employees_data as $edi=>$edata ) {
				
				foreach($columns as $column) {

					$var = 'earnings_'.$column->id.'_data';

					$employee_earnings = new $this->Employees_earnings_model('ee');
					$employee_earnings->setCompanyId($this->session->userdata('current_company_id'),true);
					$employee_earnings->setNameId($edata->name_id,true);
					$employee_earnings->setEarningId($column->id,true);
					$employee_earnings->setTrash(0,true);
					$employee_earnings->setActive(1,true);
					$employee_earnings->setStartDate(date('Y-m-d'),true,false,'<=');
					$employee_earnings->set_where("((SELECT COUNT(*) FROM employees_earnings_templates eet WHERE eet.template_id=".$template_id." AND eet.ee_id=ee.id) > 0)");
					$employee_earnings->set_where('(((ee.max_amount - (SELECT SUM(ee2.amount) FROM payroll_employees_earnings ee2 WHERE ee2.entry_id=ee.id)) > 0)');
					$employee_earnings->set_where_or('(ee.max_amount = 0))');
					$employee_earnings->set_limit(0);
					$edata->$var = $employee_earnings->populate();
				}

				$employees_data[$edi] = $edata;

			}

			$payroll_group_data[$key]->employees = $employees_data;
		}

		

		$this->template_data->set('payroll_groups', $payroll_group_data);

		$this->load->view('payroll/payroll/earnings/earnings_preview', $this->template_data->get_data());
	}

	public function preview_entries($template_id,$name_id,$earning_id,$output='') {

		$this->template_data->set('template_id', $template_id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('earning_id', $earning_id);

		$this->_column_groups();

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_select('*');
		$templates->set_limit(0);
		$this->template_data->set('templates', $templates->populate());

		$template = new $this->Payroll_templates_model;
		$template->setId($template_id,true);
		$template->set_select("*");
		$this->template_data->set('template', $template->get());

		$earning_data = new $this->Earnings_list_model;
		$earning_data->setId($earning_id,true);
		$this->template_data->set('earning_data', $earning_data->get());

		$earnings = new $this->Employees_earnings_model('pee');
		$earnings->setNameId($name_id,true);
		$earnings->setEarningId($earning_id,true);
		$earnings->setTrash(0,true);
		$earnings->setActive(1,true);
		$earnings->set_select('*');
		$earnings->set_select('pee.notes as enotes');
		$earnings->set_select('pee.amount as pee_amount');
		$earnings->set_select('pee.id as pee_id');
		$earnings->set_join('earnings_list el', 'pee.earning_id=el.id');
		$earnings->set_where("((SELECT COUNT(*) FROM employees_earnings_templates eet WHERE eet.template_id=".$template_id." AND eet.ee_id=pee.id) > 0)");
		$earnings->set_where('(((pee.max_amount - (SELECT SUM(pee2.amount) FROM payroll_employees_earnings pee2 WHERE pee2.entry_id=pee.id)) > 0)');
		$earnings->set_where_or('(pee.max_amount = 0))');
		$this->template_data->set('earnings', $earnings->populate());

		$employees = new $this->Employees_model('pe');
		$employees->setNameId($name_id,true);
		$employees->set_select('ni.*');
		$employees->set_select('e.hired');
		$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
		$employees->set_join('employees e', 'e.name_id=pe.name_id');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');
		$this->template_data->set('employee', $employees->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/earnings/earnings_preview_entries', $this->template_data->get_data());
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
			'base_url' => base_url($this->config->item('index_page') . "/payroll_earnings/by_name/{$name_id}"),
			'total_rows' => $payrolls->count_all_results(),
			'per_page' => $payrolls->get_limit(),
			'ajax'=>true
		)));

		$this->template_data->set('next_name', $this->_next_employee($name_id, 'payroll_earnings/by_name/'));
		$this->template_data->set('previous_name', $this->_previous_employee($name_id, 'payroll_earnings/by_name/'));

		$this->load->view('payroll/payroll/dtr/dtr_by_name', $this->template_data->get_data());
	}
	
}
