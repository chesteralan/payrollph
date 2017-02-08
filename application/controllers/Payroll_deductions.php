<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_deductions extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Deductions');
		$this->template_data->set('current_uri', 'payroll_deductions');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		$this->load->model('Payroll_model');
		$this->load->model('Payroll_templates_model');
		$this->load->model('Payroll_inclusive_dates_model');
		$this->load->model('Payroll_groups_model');
		$this->load->model('Payroll_deductions_model');
		$this->load->model('Payroll_deductions_model');
		$this->load->model('Payroll_benefits_model');
		
		$this->load->model('Payroll_employees_model');
		$this->load->model('Payroll_employees_deductions_model');
		$this->load->model('Deductions_list_model');

		$this->load->model('Payroll_templates_groups_model');
		$this->load->model('Payroll_templates_benefits_model');
		$this->load->model('Payroll_templates_deductions_model');
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

		$deductions_columns = new $this->Payroll_deductions_model('pd');
		$deductions_columns->setPayrollId($id,true);
		$deductions_columns->set_select('dl.*');
		$deductions_columns->set_join('deductions_list dl', 'dl.id=pd.deduction_id');
		$deductions_columns->set_order('pd.order', 'DESC');
		$columns = $deductions_columns->populate();
		$this->template_data->set('deductions_columns', $columns);

		$payroll_group = new $this->Payroll_groups_model('pg');
		$payroll_group->setPayrollId($id,true);
		$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
		$payroll_group->set_limit(0);
		$payroll_group->set_order('pg.order', 'DESC');
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
				$employees->set_select(sprintf('(SELECT SUM(amount) FROM payroll_employees_deductions ped WHERE ped.payroll_id=%s AND ped.name_id=pe.name_id AND ped.deduction_id=%s) as deductions_%s', $id, $column->id, $column->id));
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

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/deductions/deductions_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$deductions = new $this->Payroll_employees_deductions_model('pee');
		$deductions->setId($id,true);
		$deduction_data = $deductions->get();

		if( $this->input->post() ) {
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$deductions->setAmount( str_replace(",", "", $this->input->post('amount')) );
				$deductions->setNotes($this->input->post('notes'));
				$deductions->update();
			}
			redirect("payroll_deductions/view/{$deduction_data->payroll_id}");
		}

		$this->template_data->set('deduction', $deductions->get());

		$payroll = new $this->Payroll_model;
		$payroll->setId($deduction_data->payroll_id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$deduction_list = new $this->Deductions_list_model;
		$deduction_list->setId($deduction_data->deduction_id,true);
		$this->template_data->set('deduction_data', $deduction_list->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/deductions/deductions_edit', $this->template_data->get_data());
	}

	public function delete($id,$output='') {

		$deductions = new $this->Payroll_employees_deductions_model;
		$deductions->setId($id,true);
		$deduction_data = $deductions->get();
		$deductions->delete();
		redirect("payroll_deductions/view/{$deduction_data->payroll_id}");

	}

}
