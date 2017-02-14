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

	}

	public function index($start=0) {
		
		$deductions = new $this->Deductions_list_model;
		$deductions->set_select("*");
		$deductions->set_order('name', 'ASC');
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
					$deductions->setName($this->input->post('deduction_name'));
					$deductions->setNotes($this->input->post('notes'));
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
		$deductions->update();

		$this->getNext("lists_deductions");
	}
}
