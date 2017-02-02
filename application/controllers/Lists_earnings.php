<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_earnings extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Earnings');
		$this->template_data->set('current_uri', 'lists_earnings');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('lists', 'earnings', 'view');

		$this->load->model('Earnings_list_model');

	}

	public function index($start=0) {
		
		$earnings = new $this->Earnings_list_model;
		$earnings->set_select("*");
		$earnings->set_order('name', 'ASC');
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url('lists_earnings/index/'),
			'total_rows' => $earnings->count_all_results(),
			'per_page' => $earnings->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('lists/earnings/earnings_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('lists', 'earnings', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('earning_name', 'Earning Name', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$earnings = new $this->Earnings_list_model;
				$earnings->setName($this->input->post('earning_name'));
				$earnings->setNotes($this->input->post('notes'));
				if( $earnings->insert() ) {
					redirect("lists_earnings");
				}
			}
		}

		$this->template_data->set('output', $output);
		$this->load->view('lists/earnings/earnings_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('lists', 'earnings', 'edit');

		$earnings = new $this->Earnings_list_model;
		$earnings->setId($id,true);

		if( $earnings->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('earning_name', 'Earning Name', 'trim|required');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$earnings->setName($this->input->post('earning_name'));
					$earnings->setNotes($this->input->post('notes'));
					$earnings->update();
				}
				$this->postNext();
			}
		}

		$earnings->set_select("*");
		$this->template_data->set('earning', $earnings->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/earnings/earnings_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('lists', 'earnings', 'delete');

		$earnings = new $this->Earnings_list_model;
		$earnings->setId($id,true);
		$earnings->setActive('0',false,true);
		$earnings->update();

		$this->getNext("lists_earnings");
	}
}
