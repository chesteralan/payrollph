<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_templates extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Templates');
		$this->template_data->set('current_uri', 'payroll_templates');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll_templates', 'view');

		$this->load->model('Payroll_templates_model');

	}

	public function index($start=0) {

		$templates = new $this->Payroll_templates_model;
		$templates->set_select('*');
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url("payroll_templates/index"),
			'total_rows' => $templates->count_all_results(),
			'per_page' => $templates->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('payroll/templates/templates_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('payroll', 'payroll_templates', 'add');


			if( $this->input->post() ) {
				$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$template = new $this->Payroll_templates_model;
					$template->setName($this->input->post('name'));
					$template->setActive(1);
					$template->insert();
				}
				$this->postNext();
			}

		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_add', $this->template_data->get_data());

	}

	public function edit($id,$output='') {
		$this->_isAuth('payroll', 'payroll_templates', 'edit');

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);

		if( $template->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('name', 'Template Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$template->setName($this->input->post('name'));
					$template->update();
				}
				$this->postNext();
			}
		}
		$this->template_data->set('template', $template->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/templates/templates_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		$this->_isAuth('payroll', 'payroll_templates', 'delete');

		$template = new $this->Payroll_templates_model;
		$template->setId($id,true);
		$template->delete();

		$this->getNext("payroll_templates");
	}

}
