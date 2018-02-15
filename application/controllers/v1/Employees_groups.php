<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_groups extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Groups');
		$this->template_data->set('current_uri', 'employees_groups');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');

	}

	public function index($start=0) {
		
		$groups = new $this->Employees_groups_model;
		if( $this->input->get('q') ) {
			$groups->set_where('name LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
		}
		$groups->setCompanyId($this->session->userdata('current_company_id'),true);
		$groups->setTrash(0,true);
		$groups->set_select("*");
		$groups->set_select("(SELECT COUNT(*) FROM `employees` WHERE group_id=employees_groups.id) as employees_count");
		$groups->set_order('name', 'ASC');
		$groups->set_start($start);
		$this->template_data->set('groups', $groups->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_groups/index/'),
			'total_rows' => $groups->count_all_results(),
			'per_page' => $groups->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/groups/groups_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('employees', 'groups', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$groups = new $this->Employees_groups_model;
				$groups->setName($this->input->post('group_name'));
				$groups->setNotes($this->input->post('notes'));
				$groups->setCompanyId($this->session->userdata('current_company_id'));
				if( $groups->insert() ) {
					redirect("employees_groups");
				}
			}
		}

		$this->template_data->set('output', $output);
		$this->load->view('employees/groups/groups_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('employees', 'groups', 'edit');

		$groups = new $this->Employees_groups_model;
		$groups->setId($id,true);

		if( $groups->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$groups->setName($this->input->post('group_name'),false,true);
					$groups->setNotes($this->input->post('notes'),false,true);
					$groups->update();
				}
				$this->postNext();
			}
		}

		$groups->set_select("*");
		$groups->set_select("(SELECT COUNT(*) FROM `employees` WHERE group_id=employees_groups.id) as employees_count");
		$this->template_data->set('group', $groups->get());

		$this->template_data->set('output', $output);
		$this->load->view('employees/groups/groups_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'groups', 'delete');

		$groups = new $this->Employees_groups_model;
		$groups->setId($id,true,false);
		$groups->setTrash(1,false,true);
		$groups->update();

		$this->getNext("employees_groups");
	}
}
