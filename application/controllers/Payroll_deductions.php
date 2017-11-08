<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_deductions extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Deductions');
		$this->template_data->set('current_uri', 'payroll_deductions');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		if( !get_company_option($this->session->userdata('current_company_id'), 'column_group_deductions') ) {
			redirect("welcome");
		}
	}

	public function index() {
		redirect("payroll");
	}

	private function _next($id, $url='payroll_deductions/view/') {
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

	private function _previous($id, $url='payroll_deductions/view/') {
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

		$deductions_columns = new $this->Payroll_deductions_model('pd');
		$deductions_columns->setPayrollId($id,true);
		$deductions_columns->set_select('dl.*');
		$deductions_columns->set_join('deductions_list dl', 'dl.id=pd.deduction_id');
		$deductions_columns->set_order('pd.order', 'DESC');
		if( $column_id ) {
			$deductions_columns->set_where('dl.id', $column_id);
		}
		$columns = $deductions_columns->populate();
		$this->template_data->set('deductions_columns', $columns);

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
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_deductions ped WHERE ped.payroll_id=%s AND ped.name_id=pe.name_id AND ped.deduction_id=%s) as deductions_%s', $id, $column->id, $column->id));
				
				if( ($column_id) && ($this->input->get('compare'))) {
					$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_deductions ped WHERE ped.payroll_id=%s AND ped.name_id=pe.name_id AND ped.deduction_id=%s) as compare_%s', $this->input->get('compare'), $column->id, $column->id));
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
		$this->load->view('payroll/payroll/deductions/deductions_view', $this->template_data->get_data());
	}

	public function entries($id,$name_id,$deduction_id,$output='') {

		$this->template_data->set('payroll_id', $id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('deduction_id', $deduction_id);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$deduction_data = new $this->Deductions_list_model;
		$deduction_data->setId($deduction_id,true);
		$this->template_data->set('deduction_data', $deduction_data->get());

		$deductions = new $this->Payroll_employees_deductions_model('ped');
		$deductions->setPayrollId($id,true);
		$deductions->setNameId($name_id,true);
		$deductions->setDeductionId($deduction_id,true);
		$deductions->set_select('*');
		$deductions->set_select('IF((ped.notes="" OR ped.notes IS NULL), ed.notes, ped.notes) as dnotes');
		$deductions->set_select('ped.amount as ped_amount');
		$deductions->set_select('ped.id as ped_id');
		$deductions->set_join('employees_deductions ed', 'ed.id=ped.entry_id');
		$deductions->set_join('deductions_list dl', 'ped.deduction_id=dl.id');
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/deductions/deductions_entries', $this->template_data->get_data());
	}

	public function add($id,$name_id,$deduction_id,$output='') {

		$this->template_data->set('payroll_id', $id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('deduction_id', $deduction_id);

		if( $this->input->post() ) {
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$deductions = new $this->Payroll_employees_deductions_model('pee');
				$deductions->setPayrollId($id,true);
				$deductions->setNameId($name_id,true);
				$deductions->setDeductionId($deduction_id,true);
				$deductions->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$deductions->setEntryId( $this->input->post('entry_id') );
				$deductions->setNotes($this->input->post('notes'));
				$deductions->insert();
			}
			redirect("payroll_deductions/view/{$id}");
		}

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$deduction_data = new $this->Deductions_list_model;
		$deduction_data->setId($deduction_id,true);
		$this->template_data->set('deduction_data', $deduction_data->get());

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$this->template_data->set('print_groups', $print_groups->populate());

		$employees_deductions = new $this->Employees_deductions_model('ed');
		$employees_deductions->setDeductionId($deduction_id,true);
		$employees_deductions->setNameId($name_id,true);
		$employees_deductions->set_select("ed.*");
		$employees_deductions->set_select("(ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) as balance");
		$employees_deductions->set_where("ed.active=1");
		$employees_deductions->set_where("(((ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) IS NULL)");
		$employees_deductions->set_where_or("((ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) > 0))");
		$this->template_data->set('employees_deductions', $employees_deductions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/deductions/deductions_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$deductions = new $this->Payroll_employees_deductions_model('ped');
		$deductions->setId($id,true);
		$deductions->set_select("*");
		$deductions->set_select("(SELECT dl.name FROM deductions_list dl WHERE dl.id=ped.deduction_id) as deduction_name");
		$deductions->set_select("(SELECT ed.max_amount FROM employees_deductions ed WHERE ed.id=ped.entry_id) as max_amount");
		$deductions->set_select("(SELECT SUM(ped2.amount) FROM payroll_employees_deductions ped2 WHERE ped2.entry_id=ped.entry_id AND ped2.id!=ped.id) as amount_earned");
		$deductions->set_select("((SELECT ed.max_amount FROM employees_deductions ed WHERE ed.id=ped.entry_id) - (SELECT SUM(ped2.amount) FROM payroll_employees_deductions ped2 WHERE ped2.entry_id=ped.entry_id AND ped2.id!=ped.id)) as amount_balance");

		$deduction_data = $deductions->get();

		if( $this->input->post() ) {
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {

				$amount = str_replace(",", "", $this->input->post('amount'));
				if( (floatval($deduction_data->max_amount) > 0 ) && (floatval($deduction_data->amount_balance) > 0 ) ) {
					$amount = (floatval($amount) >= floatval($deduction_data->amount_balance)) ? $deduction_data->amount_balance : $amount;
				}
				$deductions->setAmount( $amount, false, true );
				$deductions->setNotes($this->input->post('notes'), false, true);
				$deductions->setEntryId( $this->input->post('entry_id'), false, true );
				$deductions->update();
			}
			//redirect("payroll_deductions/view/{$deduction_data->payroll_id}");
			$this->postNext();
		}

		$this->template_data->set('deduction', $deductions->get());

		$payroll = new $this->Payroll_model;
		$payroll->setId($deduction_data->payroll_id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$deduction_list = new $this->Deductions_list_model;
		$deduction_list->setId($deduction_data->deduction_id,true);
		$this->template_data->set('deduction_data', $deduction_list->get());

		$employees_deductions = new $this->Employees_deductions_model('ed');
		$employees_deductions->setDeductionId($deduction_data->deduction_id,true);
		$employees_deductions->setNameId($deduction_data->name_id,true);
		$employees_deductions->set_select("ed.*");
		$employees_deductions->set_select("(ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) as balance");
		$employees_deductions->set_where("ed.active=1");
		$employees_deductions->set_where("(((ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id AND ped.id != {$id})) IS NULL)");
		$employees_deductions->set_where_or("((ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id AND ped.id != {$id})) > 0))");
		$this->template_data->set('employees_deductions', $employees_deductions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/deductions/deductions_edit', $this->template_data->get_data());
	}

	public function delete($id,$output='') {

		$deductions = new $this->Payroll_employees_deductions_model;
		$deductions->setId($id,true);
		$deduction_data = $deductions->get();
		$deductions->delete();

		if( $this->input->get('next') ) {
			redirect( $this->input->get('next') );
		} else {
			redirect("payroll_deductions/view/{$deduction_data->payroll_id}");
		}

	}

	public function item_schedule($id,$deduction_id,$output='') {

		if( $this->input->post('remove_item') ) {
			$deductions = new $this->Payroll_employees_deductions_model('ped');
			$deductions->set_where_in('id', $this->input->post('remove_item'));
			$deductions->delete();
		}

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

		$deduction_list = new $this->Deductions_list_model;
		$deduction_list->setId($deduction_id,true);
		$this->template_data->set('deduction_data', $deduction_list->get());

		$deductions = new $this->Payroll_employees_deductions_model('ped');
		$deductions->setPayrollId($id,true);
		$deductions->setDeductionId($deduction_id,true);
		$deductions->set_select("ped.*");
		$deductions->set_select("ni.*");
		$deductions->set_join("names_info ni", 'ni.name_id=ped.name_id');

		$deductions->set_order('ni.lastname', 'ASC');
		$deductions->set_order('ni.firstname', 'ASC');
		$deductions->set_order('ni.middlename', 'ASC');

		$deductions->set_join("payroll_employees pe", 'pe.name_id=ped.name_id');
		$deductions->set_where('pe.active', 1);
		$deductions->set_where('pe.payroll_id', $id);
		
		if( !$this->input->get('remove_grouping')) {
			$deductions->set_select("SUM((SELECT ed.max_amount FROM employees_deductions ed WHERE ed.id=ped.entry_id)) as max_amount");	
			$deductions->set_select("SUM((SELECT SUM(ped2.amount) FROM payroll_employees_deductions ped2 WHERE ped.name_id=ped2.name_id AND ped.deduction_id=ped2.deduction_id AND ped2.entry_id=ped.entry_id AND ped2.id!=ped.id)) as amount_paid");
			$deductions->set_select("SUM(ped.amount) as amount");
			$deductions->set_group_by('ped.name_id');
		} else {
			$deductions->set_select("(SELECT ed.max_amount FROM employees_deductions ed WHERE ed.id=ped.entry_id) as max_amount");	
			$deductions->set_select("(SELECT SUM(ped2.amount) FROM payroll_employees_deductions ped2 WHERE ped.name_id=ped2.name_id AND ped.deduction_id=ped2.deduction_id AND ped2.entry_id=ped.entry_id AND ped2.id!=ped.id) as amount_paid");
			$deductions->set_select("ped.amount as amount");
		}
		
		$deductions->set_limit(0);
		$item_data = $deductions->populate(); 
		$this->template_data->set('item_data', $item_data);

if( $this->input->get('equalizer') == '1' ) {
		$items = new $this->Employees_deductions_model('ed');
		$items->setDeductionId($deduction_id,true);
		$items->setCompanyId($this->session->userdata('current_company_id'),true);
		$items->setActive(1,true);
		$items->setTrash(0,true);
		$items->set_where('(start_date <="' . date('Y-m-d') .'")');
		$items->set_join('employees e', 'e.name_id=ed.name_id');
		$items->set_select("e.*");
		$items->set_select("ed.*");
		$items->set_start(0);
		$items->set_order('e.lastname', 'ASC');

		$items->set_select("(SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id) as amount_paid");
		$items->set_select("(ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) as balance");

		$items->set_group_by("ed.name_id");
		$items->set_limit(0);
		$items->set_where("(ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) > 0");
		$items->set_select("SUM(ed.max_amount) as max_amount");
		$items->set_select("SUM(ed.amount) as amount");
		$items->set_select("(SUM(ed.max_amount) - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) as balance");

		$this->template_data->set('equalizer', $items->populate());
}

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
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

			$this->load->view('payroll/payroll/deductions/deductions_item_schedule_print', $this->template_data->get_data());
		} else {
			if( $this->input->get('equalizer') == '1' ) {
				$this->load->view('payroll/payroll/deductions/deductions_item_schedule_equalizer', $this->template_data->get_data());
			} else {
				$this->load->view('payroll/payroll/deductions/deductions_item_schedule', $this->template_data->get_data());
			}
		}

	}

	public function reset($id,$deduction_id) {

		$deductions = new $this->Payroll_employees_deductions_model;
		$deductions->setPayrollId($id, true);
		$deductions->setDeductionId($deduction_id,true);
		$deductions->delete();
		
		if( $this->input->get('next') ) {
			redirect( $this->input->get('next') );
		} else {
			redirect( "payroll_deductions/view/{$id}" );
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
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_where('e.group_id', $group->group_id);
			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}
/*
			foreach($columns as $column) {
				$ed = new $this->Employees_deductions_model('ed');
				$ed->set_select('SUM(ed.amount)');
				$ed->set_where('ed.name_id=pe.name_id');
				$ed->set_where('ed.deduction_id', $column->id);
				$ed->set_where('ed.active=1');
				$ed->set_where('ed.trash=0');
				$ed->set_where('((SELECT COUNT(*) FROM employees_deductions_templates edt WHERE edt.template_id='.$template_id.' AND edt.ed_id=ed.id) > 0)');
				$ed->set_where('((ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) > 0)');
				$employees->set_select('('.$ed->get_compiled_select().') as deductions_' . $column->id);
			}
*/
			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate(); 

			foreach( $employees_data as $edi=>$edata ) {
				
				foreach($columns as $column) {

					$var = 'deductions_'.$column->id.'_data';

					$employee_deductions = new $this->Employees_deductions_model('ed');
					$employee_deductions->setCompanyId($this->session->userdata('current_company_id'),true);
					$employee_deductions->setNameId($edata->name_id,true);
					$employee_deductions->setDeductionId($column->id,true);
					$employee_deductions->setTrash(0,true);
					$employee_deductions->setActive(1,true);
					$employee_deductions->setStartDate(date('Y-m-d'),true,false,'<=');
					$employee_deductions->set_where("((SELECT COUNT(*) FROM employees_deductions_templates eet WHERE eet.template_id=".$template_id." AND eet.ed_id=ed.id) > 0)");
					$employee_deductions->set_where('(((ed.max_amount - (SELECT SUM(ed2.amount) FROM payroll_employees_deductions ed2 WHERE ed2.entry_id=ed.id)) > 0)');
					$employee_deductions->set_where_or('(ed.max_amount = 0))');
					$employee_deductions->set_limit(0);
					$edata->$var = $employee_deductions->populate();
				}

				$employees_data[$edi] = $edata;

			}

			$payroll_group_data[$key]->employees = $employees_data;
		}

		

		$this->template_data->set('payroll_groups', $payroll_group_data);

		$this->load->view('payroll/payroll/deductions/deductions_preview', $this->template_data->get_data());
	}

	public function preview_entries($template_id,$name_id,$deduction_id,$output='') {

		$this->template_data->set('template_id', $template_id);
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('deduction_id', $deduction_id);

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

		$deduction_data = new $this->Deductions_list_model;
		$deduction_data->setId($deduction_id,true);
		$this->template_data->set('deduction_data', $deduction_data->get());

		$deductions = new $this->Employees_deductions_model('ped');
		$deductions->setNameId($name_id,true);
		$deductions->setDeductionId($deduction_id,true);
		$deductions->setTrash(0,true);
		$deductions->setActive(1,true);
		$deductions->set_select('*');
		$deductions->set_select('ped.notes as enotes');
		$deductions->set_select('ped.amount as ped_amount');
		$deductions->set_select('ped.id as ped_id');
		$deductions->set_join('deductions_list dl', 'ped.deduction_id=dl.id');
		$deductions->set_where("((SELECT COUNT(*) FROM employees_deductions_templates edt WHERE edt.template_id=".$template_id." AND edt.ed_id=ped.id) > 0)");
		$deductions->set_where('(((ped.max_amount - (SELECT SUM(ped2.amount) FROM payroll_employees_deductions ped2 WHERE ped2.entry_id=ped.id)) > 0)');
		$deductions->set_where_or('(ped.max_amount = 0))');
		$this->template_data->set('deductions', $deductions->populate());

		$employees = new $this->Employees_model('pe');
		$employees->setNameId($name_id,true);
		$employees->set_select('ni.*');
		$employees->set_select('e.hired');
		$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
		$employees->set_join('employees e', 'e.name_id=pe.name_id');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');
		$this->template_data->set('employee', $employees->get());
		
		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/deductions/deductions_preview_entries', $this->template_data->get_data());
	}

}
