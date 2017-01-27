<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll');
		$this->template_data->set('current_uri', 'payroll');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		$this->load->model('Payroll_model');
		$this->load->model('Payroll_templates_model');

	}

	public function index($start=0) {

		$payrolls = new $this->Payroll_model;
		$payrolls->set_select('*');
		$payrolls->set_select('(SELECT name FROM payroll_templates WHERE id=payroll.template_id) as template_name');
		$payrolls->set_start($start);
		$this->template_data->set('payrolls', $payrolls->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url("payroll/index"),
			'total_rows' => $payrolls->count_all_results(),
			'per_page' => $payrolls->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('payroll/payroll/payroll_list', $this->template_data->get_data());
	}

	public function template($id, $start=0) {

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$this->template_data->set('template', $template->get());

		$payrolls = new $this->Payroll_model;
		$payrolls->set_select('*');
		$payrolls->set_select('(SELECT name FROM payroll_templates WHERE id=payroll.template_id) as template_name');
		$payrolls->setTemplateId($id,true);
		$payrolls->set_start($start);
		$this->template_data->set('payrolls', $payrolls->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url("payroll/index"),
			'total_rows' => $payrolls->count_all_results(),
			'per_page' => $payrolls->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('payroll/payroll/payroll_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('payroll', 'payroll', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
			if( $this->form_validation->run() ) {
				$payroll = new $this->Payroll_model;
				$payroll->setName($this->input->post('name'));
				$payroll->setTemplateId($this->input->post('template_id'));
				$payroll->setMonth($this->input->post('month'));
				$payroll->setYear($this->input->post('year'));
				$payroll->setActive(1);
				$payroll->insert();
			}
			$this->postNext();
		}

		$templates = new $this->Payroll_templates_model;
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_add', $this->template_data->get_data());

	}

	public function edit($id,$output='') {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);

		if( $payroll->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$payroll->setName($this->input->post('name'));
					$payroll->setTemplateId($this->input->post('template_id'));
					$payroll->setMonth($this->input->post('month'));
					$payroll->setYear($this->input->post('year'));
					$payroll->update();
				}
				$this->postNext();
			}
		}
		$this->template_data->set('payroll', $payroll->get());

		$templates = new $this->Payroll_templates_model;
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		$this->_isAuth('payroll', 'payroll', 'delete');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->delete();

		$this->getNext("payroll");
	}

	public function config($id,$output='') {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$this->template_data->set('payroll', $payroll->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_config', $this->template_data->get_data());
	}

	public function inclusive_dates($id,$output='') {
		$this->_isAuth('payroll', 'payroll', 'edit');

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$this->template_data->set('payroll', $payroll->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/payroll_calendar', $this->template_data->get_data());
	}
}
