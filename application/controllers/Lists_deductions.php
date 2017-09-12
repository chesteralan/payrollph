<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_deductions extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Deductions');
		$this->template_data->set('current_uri', 'lists_deductions');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('lists', 'deductions', 'view');

	}

	public function index($start=0) {
		
		$deductions = new $this->Deductions_list_model;
		if( $this->input->get('q') ) {
			$deductions->set_where('name LIKE "%' . $this->input->get('q') . '%"');
			$deductions->set_where_or('notes LIKE "%' . $this->input->get('q') . '%"');
		}
		$deductions->set_select("*");
		$deductions->set_order('name', 'ASC');
		$deductions->set_start($start);
		$deductions->setTrash('0',true);
		$this->template_data->set('deductions', $deductions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/lists_deductions/index/'),
			'total_rows' => $deductions->count_all_results(),
			'per_page' => $deductions->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('lists/deductions/deductions_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('lists', 'deductions', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('deduction_name', 'Deduction Name', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$deductions = new $this->Deductions_list_model;
				$deductions->setName($this->input->post('deduction_name'));
				$deductions->setNotes($this->input->post('notes'));
				$deductions->setAccountTitle($this->input->post('account_title'));
				if( $deductions->insert() ) {
					redirect("lists_deductions");
				}
			}
		}

		$this->template_data->set('output', $output);
		$this->load->view('lists/deductions/deductions_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('lists', 'deductions', 'edit');

		$deductions = new $this->Deductions_list_model;
		$deductions->setId($id,true);

		if( $deductions->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('deduction_name', 'Deduction Name', 'trim|required');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$deductions->setName($this->input->post('deduction_name'), false, true);
					$deductions->setNotes($this->input->post('notes'), false, true);
					$deductions->setAccountTitle($this->input->post('account_title'), false, true);
					$deductions->update();
				}
				$this->postNext();
			}
		}

		$deductions->set_select("*");
		$this->template_data->set('deduction', $deductions->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/deductions/deductions_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('lists', 'deductions', 'delete');

		$deductions = new $this->Deductions_list_model;
		$deductions->setId($id,true);
		$deductions->setActive('0',false,true);
		$deductions->setTrash('1',false,true);
		$deductions->update();

		$this->getNext("lists_deductions");
	}

	public function items($id, $name_id=0, $start=0) {
		
		if( $name_id ) {
			$employee = new $this->Employees_model;
			$employee->setNameId($name_id,true);
			$employee->set_select("*");
			$this->template_data->set('employee', $employee->get());
		}

		$deduction = new $this->Deductions_list_model;
		$deduction->setId($id,true);
		$deduction->set_select("*");
		$this->template_data->set('deduction', $deduction->get());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_limit(0);
		$templates_data = $templates->populate();
		$this->template_data->set('templates', $templates_data);

		$items = new $this->Employees_deductions_model('ed');
		$items->setDeductionId($id,true);
		$items->setCompanyId($this->session->userdata('current_company_id'),true);
		$items->setActive(1,true);
		$items->setTrash(0,true);
		$items->set_where('(start_date <="' . date('Y-m-d') .'")');
		$items->set_join('employees e', 'e.name_id=ed.name_id');
		$items->set_select("e.*");
		$items->set_select("ed.*");
		$items->set_start($start);
		$items->set_order('ed.id', 'DESC');

		foreach($templates_data as $temp) {
			$items->set_select("(SELECT COUNT(*) FROM employees_deductions_templates edt WHERE edt.ed_id=ed.id AND edt.template_id={$temp->id}) as temp_{$temp->id}");
		}

		$items->set_select("(SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id) as amount_paid");
		$items->set_select("(ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) as balance");

		if( $this->input->get('group_by') == 'employee' ) {
			$items->set_group_by("ed.name_id");
			$items->set_limit(0);
			//$items->set_where("((ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id))>0)");
			$items->set_select("SUM(ed.max_amount) as max_amount");
			$items->set_select("SUM(ed.amount) as amount");
			$items->set_select("(SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.deduction_id=ed.deduction_id AND ped.name_id=ed.name_id) as amount_paid");
			$items->set_select("(SUM(ed.max_amount) - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) as balance");

			$items->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
			$items->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");

		} else {
			$items->set_select("(ed.max_amount - (SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.entry_id=ed.id)) as balance");
		}

		if( $name_id ) {
			$items->set_where('(e.name_id =' . $name_id .')');
		}

		$this->template_data->set('items', $items->populate());
		
		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 5,
			'base_url' => base_url($this->config->item('index_page') . "/lists_deductions/items/{$id}/{$name_id}"),
			'total_rows' => $items->count_all_results(),
			'per_page' => $items->get_limit(),
			'ajax'=>true,
		)));

		$employees = new $this->Payroll_employees_deductions_model('ped');
		$employees->setDeductionId($id,true);
		$employees->set_join('employees e', 'e.name_id=ped.name_id');
		$employees->set_select("e.*");
		$employees->set_where("e.company_id=" . $this->session->userdata('current_company_id'));
		$employees->set_join('employees_deductions ed', 'ed.id=ped.entry_id');
		$employees->set_where('(ed.start_date <="' . date('Y-m-d') .'")');
		$employees->set_order('e.lastname', 'ASC');
		$employees->set_group_by('e.name_id');
		$employees->set_limit(0);
		$this->template_data->set('employees', $employees->populate());

		$this->load->view('lists/deductions/deductions_items', $this->template_data->get_data());
	}

	public function summary($id) {
		
		$deduction = new $this->Deductions_list_model;
		$deduction->setId($id,true);
		$deduction->set_select("*");
		$this->template_data->set('deduction', $deduction->get());

		$employees_deductions = new $this->Employees_deductions_model('ed');
		$employees_deductions->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees_deductions->setDeductionId($id,true);
		$employees_deductions->set_join("employees e", 'e.name_id=ed.name_id');

		$employees_deductions->set_where("(((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) IS NULL)");
		$employees_deductions->set_where_or("((IF((ed.max_amount>0), (ed.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE ed.name_id=ped.name_id AND ped.entry_id=ed.id)), NULL)) > 0))");
		
		$employees_deductions->setActive(1,true);
		$employees_deductions->setTrash(0,true);
		$employees_deductions->set_limit(0);
		$employees_deductions->set_order('e.lastname', 'ASC');
		$employees_deductions->set_group_by('e.name_id');

		$employees_deductions->set_select("*");
		$employees_deductions->set_select("SUM(ed.max_amount) as max_amount");
		

			// amount 
			$ed_amount = new $this->Employees_deductions_model('eda');
			$ed_amount->setCompanyId($this->session->userdata('current_company_id'),true);
			$ed_amount->setDeductionId($id,true);

			$ed_amount->set_where("(((IF((eda.max_amount>0), (eda.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE eda.name_id=ped.name_id AND ped.entry_id=eda.id)), NULL)) IS NULL)", NULL, 99);
			$ed_amount->set_where_or("((IF((eda.max_amount>0), (eda.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE eda.name_id=ped.name_id AND ped.entry_id=eda.id)), NULL)) > 0))", NULL, 99);
			
			$ed_amount->setActive(1,true);
			$ed_amount->setTrash(0,true);
			$ed_amount->set_where("eda.name_id=ed.name_id");
			$ed_amount->set_select("SUM(eda.amount)");

			$employees_deductions->set_select("(".$ed_amount->get_compiled_select().") as amount");

			// amount paid
			$ed_paid = new $this->Payroll_employees_deductions_model('ped');
			$ed_paid->setDeductionId($id,true);
			$ed_paid->set_select("SUM(ped.amount)");
			$ed_paid->set_join("employees_deductions edp", 'edp.id=ped.entry_id');

			$ed_paid->set_where("ped.name_id=ed.name_id");
			$ed_paid->set_where("(((IF((edp.max_amount>0), (edp.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE edp.name_id=ped.name_id AND ped.entry_id=edp.id)), NULL)) IS NULL)", NULL, 99);
			$ed_paid->set_where_or("((IF((edp.max_amount>0), (edp.max_amount-(SELECT SUM(ped.amount) FROM  payroll_employees_deductions ped WHERE edp.name_id=ped.name_id AND ped.entry_id=edp.id)), NULL)) > 0))", NULL, 99);

			$employees_deductions->set_select("(".$ed_paid->get_compiled_select().") as amount_paid");

			$employees_deductions->set_select("((SUM(ed.max_amount)) - (".$ed_paid->get_compiled_select().")) as balance");


		$employees_deductions_data = $employees_deductions->populate();
		$this->template_data->set('employees_deductions', $employees_deductions_data);

		$this->load->view('lists/deductions/deductions_summary', $this->template_data->get_data());
	}

	public function entries($id, $name_id=0, $start=0) {
		
		if( $name_id ) {
			$employee = new $this->Employees_model;
			$employee->setNameId($name_id,true);
			$employee->set_select("*");
			$this->template_data->set('employee', $employee->get());
		}

		$deduction = new $this->Deductions_list_model;
		$deduction->setId($id,true);
		$deduction->set_select("*");
		$this->template_data->set('deduction', $deduction->get());

		$items = new $this->Payroll_employees_deductions_model('ped');
		$items->set_select("ped.*");
		$items->setDeductionId($id,true);
		$items->set_join('employees e', 'e.name_id=ped.name_id');
		$items->set_select("e.*");
		$items->set_join('employees_deductions ed', 'ed.id=ped.entry_id');
		$items->set_select("ed.max_amount");
		$items->set_where('(ed.start_date <="' . date('Y-m-d') .'")');
		$items->set_where("e.company_id=" . $this->session->userdata('current_company_id'));
		$items->set_join('payroll p', 'p.id=ped.payroll_id');
		$items->set_select("p.name as payroll_name");
		$items->set_start($start);
		$items->set_order('ped.id', 'DESC');
		if( $name_id ) {
			$items->set_where('(ped.name_id =' . $name_id .')');
		}
		$this->template_data->set('items', $items->populate());
		
		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 5,
			'base_url' => base_url($this->config->item('index_page') . "/lists_deductions/entries/{$id}/{$name_id}"),
			'total_rows' => $items->count_all_results(),
			'per_page' => $items->get_limit(),
			'ajax'=>true,
		)));

		$employees = new $this->Payroll_employees_deductions_model('ped');
		$employees->setDeductionId($id,true);
		$employees->set_join('employees e', 'e.name_id=ped.name_id');
		$employees->set_select("e.*");
		$employees->set_where("e.company_id=" . $this->session->userdata('current_company_id'));
		$employees->set_join('employees_deductions ed', 'ed.id=ped.entry_id');
		$employees->set_where('(ed.start_date <="' . date('Y-m-d') .'")');
		$employees->set_order('e.lastname', 'ASC');
		$employees->set_group_by('e.name_id');
		$employees->set_limit(0);
		$this->template_data->set('employees', $employees->populate());

		$this->load->view('lists/deductions/deductions_entries', $this->template_data->get_data());
	}

}
