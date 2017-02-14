<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_benefits extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Benefits');
		$this->template_data->set('current_uri', 'lists_benefits');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('lists', 'benefits', 'view');

		$this->load->model('Benefits_list_model');

	}

	public function index($start=0) {
		
		$benefits = new $this->Benefits_list_model;
		$benefits->set_select("*");
		$benefits->set_order('leave', 'ASC');
		$benefits->set_order('name', 'ASC');
		$this->template_data->set('benefits', $benefits->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/lists_benefits/index/'),
			'total_rows' => $benefits->count_all_results(),
			'per_page' => $benefits->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('lists/benefits/benefits_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('lists', 'benefits', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('benefit_name', 'Benefit Name', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$benefits = new $this->Benefits_list_model;
				$benefits->setName($this->input->post('benefit_name'));
				$benefits->setNotes($this->input->post('notes'));
				$benefits->setLeave( ($this->input->post('leave')) ? 1 : 0 );
				if( $benefits->insert() ) {
					redirect("lists_benefits");
				}
			}
		}

		$this->template_data->set('output', $output);
		$this->load->view('lists/benefits/benefits_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('lists', 'benefits', 'edit');

		$benefits = new $this->Benefits_list_model;
		$benefits->setId($id,true,false);

		if( $benefits->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('benefit_name', 'Benefit Name', 'trim|required');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$benefits->setName($this->input->post('benefit_name'),false,true);
					$benefits->setNotes($this->input->post('notes'),false,true);
					$benefits->setLeave( (($this->input->post('leave')) ? 1 : 0),false,true);
					$benefits->update();
				}
				$this->postNext();
			}
		}

		$benefits->set_select("*");
		$this->template_data->set('benefit', $benefits->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/benefits/benefits_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('lists', 'benefits', 'delete');

		$benefits = new $this->Benefits_list_model;
		$benefits->setId($id,true,false);
		$benefits->setActive('0',false,true);
		$benefits->update();

		$this->getNext("lists_benefits");
	}
}
