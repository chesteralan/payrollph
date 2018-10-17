<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_earnings extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Earnings');
		$this->template_data->set('current_uri', 'lists_earnings');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('lists', 'earnings', 'view');

	}

	public function index($start=0) {
		
		$earnings = new $this->Earnings_list_model;

		if( $this->input->get('q') ) {
			$earnings->set_where('name LIKE "%' . $this->input->get('q') . '%"');
			$earnings->set_where_or('notes LIKE "%' . $this->input->get('q') . '%"');
		}

		$earnings->set_select("*");
		$earnings->set_order('name', 'ASC');
		$earnings->set_start($start);
		$earnings->setTrash('0',true);
		$this->template_data->set('earnings', $earnings->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/lists_earnings/index/'),
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
				$earnings->setAccountTitle($this->input->post('account_title'));
				$earnings->setAbbr($this->input->post('abbr'));
				if( $earnings->insert() ) {
					
					record_system_audit($this->session->userdata('user_id'), 'lists', 'earnings', 'add', $this->session->userdata('current_company_id'), "Earning Added: {$this->input->post('earning_name')}");

					$this->getNext("lists_earnings");
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
					$earnings->setName($this->input->post('earning_name'), false, true);
					$earnings->setNotes($this->input->post('notes'), false, true);
					$earnings->setAccountTitle($this->input->post('account_title'), false, true);
					$earnings->setAbbr($this->input->post('abbr'), false, true);
					if( $earnings->update() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'earnings', 'edit', $this->session->userdata('current_company_id'), "Earning Edited: {$this->input->post('earning_name')}");
					}
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
		$earnings->setTrash('1',false,true);
		if( $earnings->update() ) {
			record_system_audit($this->session->userdata('user_id'), 'lists', 'earnings', 'delete', $this->session->userdata('current_company_id'), "Earning Deleted!");
		}

		$this->getNext("lists_earnings");
	}

	public function items($id, $start=0) {
		
		$earnings = new $this->Earnings_list_model;
		$earnings->setId($id,true);
		$earnings->set_select("*");
		$this->template_data->set('earning', $earnings->get());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_limit(0);
		$templates_data = $templates->populate();
		$this->template_data->set('templates', $templates_data);

		$items = new $this->Employees_earnings_model('ee');
		$items->setEarningId($id,true);
		$items->setCompanyId($this->session->userdata('current_company_id'),true);
		$items->setActive(1,true);
		$items->setTrash(0,true);
		$items->set_where('(start_date <="' . date('Y-m-d') .'")');
		$items->set_join('names_info e', 'e.name_id=ee.name_id');
		$items->set_select("e.*");
		$items->set_select("ee.*");
		$items->set_start($start);
		
		foreach($templates_data as $temp) {
			$items->set_select("(SELECT COUNT(*) FROM employees_earnings_templates eet WHERE eet.ee_id=ee.id AND eet.template_id={$temp->id}) as temp_{$temp->id}");
		}

		$this->template_data->set('items', $items->populate());
		
		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/lists_earnings/items/' . $id),
			'total_rows' => $items->count_all_results(),
			'per_page' => $items->get_limit(),
			'ajax'=>true,
		)));

		$this->load->view('lists/earnings/earnings_items', $this->template_data->get_data());
	}

}
