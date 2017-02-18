<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_terms extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Terminologies');
		$this->template_data->set('current_uri', 'system_terms');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('system', 'terms', 'view');

		$this->load->model('Terms_list_model');

	}

	public function index($start=0) {
		
		$terms = new $this->Terms_list_model;
		$terms->set_select("*");
		$terms->set_order('name', 'ASC');
		$terms->set_start($start);
		$terms->setTrash('0',true);
		$this->template_data->set('terms', $terms->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/system_terms/index/'),
			'total_rows' => $terms->count_all_results(),
			'per_page' => $terms->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('system/terms/terms_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('system', 'terms', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('term_name', 'term Name', 'trim|required');
			$this->form_validation->set_rules('term_type', 'term Type', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$terms = new $this->Terms_list_model;
				$terms->setName($this->input->post('term_name'));
				$terms->setType($this->input->post('term_type'));
				$terms->setNotes($this->input->post('notes'));
				if( $terms->insert() ) {
					redirect("system_terms");
				}
			}
		}

		$this->template_data->set('output', $output);
		$this->load->view('system/terms/terms_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('system', 'terms', 'edit');

		$terms = new $this->Terms_list_model;
		$terms->setId($id,true);

		if( $terms->nonEmpty() ) {
			if( $this->input->post() ) { 
				$this->form_validation->set_rules('term_name', 'term Name', 'trim|required');
				$this->form_validation->set_rules('term_type', 'term Type', 'trim|required');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$terms->setName($this->input->post('term_name'), false, true);
					$terms->setType($this->input->post('term_type'), false, true);
					$terms->setNotes($this->input->post('notes'), false, true);
					$terms->update();
				}
				$this->postNext();
			}
		}

		$terms->set_select("*");
		$this->template_data->set('term', $terms->get());

		$this->template_data->set('output', $output);
		$this->load->view('system/terms/terms_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('system', 'terms', 'delete');

		$terms = new $this->Terms_list_model;
		$terms->setId($id,true);
		$terms->setTrash('1',false,true);
		$terms->update();

		$this->getNext("system_terms");
	}
}
