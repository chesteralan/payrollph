<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_benefits extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Benefits');
		$this->template_data->set('current_uri', 'lists_benefits');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('lists', 'benefits', 'view');

	}

	public function index($start=0) {
		
		$benefits = new $this->Benefits_list_model;
		if( $this->input->get('q') ) {
			$benefits->set_where('name LIKE "%' . $this->input->get('q') . '%"');
			$benefits->set_where_or('notes LIKE "%' . $this->input->get('q') . '%"');
		}
		$benefits->set_select("*");
		$benefits->set_order('leave', 'ASC');
		$benefits->set_order('name', 'ASC');
		$benefits->set_start($start);
		$benefits->setTrash('0',true);
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
				$benefits->setEeAccountTitle($this->input->post('ee_account_title'));
				$benefits->setErAccountTitle($this->input->post('er_account_title'));
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
					$benefits->setEeAccountTitle($this->input->post('ee_account_title'),false,true);
					$benefits->setErAccountTitle($this->input->post('er_account_title'),false,true);
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
		$benefits->setTrash('1',false,true);
		$benefits->update();

		$this->getNext("lists_benefits");
	}

	public function items($id, $start=0) {
		
		$earnings = new $this->Benefits_list_model;
		$earnings->setId($id,true);
		$earnings->set_select("*");
		$this->template_data->set('earning', $earnings->get());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_limit(0);
		$templates_data = $templates->populate();
		$this->template_data->set('templates', $templates_data);

		$items = new $this->Employees_benefits_model('eb');
		$items->setBenefitId($id,true);
		$items->setCompanyId($this->session->userdata('current_company_id'),true);
		$items->setTrash(0,true);
		$items->set_where('(start_date <="' . date('Y-m-d') .'")');
		$items->set_join('employees e', 'e.name_id=eb.name_id');
		$items->set_join('names_info ni', 'ni.name_id=eb.name_id');
		$items->set_select("e.*");
		$items->set_select("ni.*");
		$items->set_select("eb.*");
		$items->set_start($start);

		foreach($templates_data as $temp) {
			$items->set_select("(SELECT COUNT(*) FROM employees_benefits_templates ebt WHERE ebt.eb_id=eb.id AND ebt.template_id={$temp->id}) as temp_{$temp->id}");
		}
		$this->template_data->set('items', $items->populate());
		
		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/lists_benefits/items/' . $id),
			'total_rows' => $items->count_all_results(),
			'per_page' => $items->get_limit(),
			'ajax'=>true,
		)));

		$this->load->view('lists/benefits/benefits_items', $this->template_data->get_data());
	}

}
