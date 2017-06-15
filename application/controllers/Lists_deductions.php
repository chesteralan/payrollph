<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_deductions extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Deductions');
		$this->template_data->set('current_uri', 'lists_deductions');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('lists', 'deductions', 'view');

		$this->load->model('Deductions_list_model');
		$this->load->model('Employees_deductions_model');
		$this->load->model('Payroll_templates_model');

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

	public function items($id, $start=0) {
		
		$earnings = new $this->Deductions_list_model;
		$earnings->setId($id,true);
		$earnings->set_select("*");
		$this->template_data->set('earning', $earnings->get());

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

		foreach($templates_data as $temp) {
			$items->set_select("(SELECT COUNT(*) FROM employees_deductions_templates edt WHERE edt.ed_id=ed.id AND edt.template_id={$temp->id}) as temp_{$temp->id}");
		}

		$this->template_data->set('items', $items->populate());
		
		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/lists_deductions/items/' . $id),
			'total_rows' => $items->count_all_results(),
			'per_page' => $items->get_limit(),
			'ajax'=>true,
		)));

		$this->load->view('lists/deductions/deductions_items', $this->template_data->get_data());
	}

}
