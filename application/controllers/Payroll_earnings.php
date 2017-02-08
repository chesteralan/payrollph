<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_earnings extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll');
		$this->template_data->set('current_uri', 'payroll_earnings');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		$this->load->model('Payroll_model');
		$this->load->model('Payroll_templates_model');
		$this->load->model('Payroll_inclusive_dates_model');
		$this->load->model('Payroll_groups_model');
		$this->load->model('Payroll_earnings_model');

		$this->load->model('Payroll_employees_model');
		$this->load->model('Payroll_employees_earnings_model');

		$this->load->model('Earnings_list_model');


	}

	public function index() {
		redirect("payroll");
	}
	

	public function view($id,$output='') {

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$earnings_columns = new $this->Payroll_earnings_model('pe');
		$earnings_columns->setPayrollId($id,true);
		$earnings_columns->set_select('el.*');
		$earnings_columns->set_join('earnings_list el', 'el.id=pe.earning_id');
		$earnings_columns->set_order('pe.order', 'DESC');
		$columns = $earnings_columns->populate();
		$this->template_data->set('earnings_columns', $columns);

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
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_earnings pee WHERE pee.payroll_id=%s AND pee.name_id=pe.name_id AND pee.earning_id=%s) as earnings_%s', $id, $column->id, $column->id));
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
				$earnings->insert();
			}
			redirect("payroll_earnings/view/{$id}");
		}

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$earning_data = new $this->Earnings_list_model;
		$earning_data->setId($earning_id,true);
		$this->template_data->set('earning_data', $earning_data->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/earnings/earnings_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$earnings = new $this->Payroll_employees_earnings_model('pee');
		$earnings->setId($id,true);
		$earning_data = $earnings->get();

		if( $this->input->post() ) {
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$earnings->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$earnings->setNotes($this->input->post('notes'));
				$earnings->update();
			}
			redirect("payroll_earnings/view/{$earning_data->payroll_id}");
		}

		$this->template_data->set('earning', $earnings->get());

		$payroll = new $this->Payroll_model;
		$payroll->setId($earning_data->payroll_id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$earning_list = new $this->Earnings_list_model;
		$earning_list->setId($earning_data->earning_id,true);
		$this->template_data->set('earning_data', $earning_list->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/earnings/earnings_edit', $this->template_data->get_data());
	}

	public function delete($id,$output='') {

		$earnings = new $this->Payroll_employees_earnings_model;
		$earnings->setId($id,true);
		$earning_data = $earnings->get();
		$earnings->delete();
		redirect("payroll_earnings/view/{$earning_data->payroll_id}");

	}

}
