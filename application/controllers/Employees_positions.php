<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_positions extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Positions');
		$this->template_data->set('current_uri', 'employees_positions');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'positions', 'view');

		$this->load->model('Employees_positions_model');

	}

	public function index($start=0) {
		
		$positions = new $this->Employees_positions_model;
		if( $this->input->get('q') ) {
			$positions->set_where('name LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
		}
		$positions->setCompanyId($this->session->userdata('current_company_id'),true);
		$positions->setTrash(0,true);
		$positions->set_select("*");
		$positions->set_select("(SELECT COUNT(*) FROM `employees` WHERE position_id=employees_positions.id) as employees_count");
		$positions->set_order('name', 'ASC');
		$positions->set_start($start);
		$this->template_data->set('positions', $positions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_positions/index/'),
			'total_rows' => $positions->count_all_results(),
			'per_page' => $positions->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/positions/positions_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('employees', 'positions', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('position_name', 'position Name', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$positions = new $this->Employees_positions_model;
				$positions->setName($this->input->post('position_name'));
				$positions->setNotes($this->input->post('notes'));
				$positions->setCompanyId($this->session->userdata('current_company_id'));
				if( $positions->insert() ) {
					redirect("employees_positions");
				}
			}
		}

		$this->template_data->set('output', $output);
		$this->load->view('employees/positions/positions_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('employees', 'positions', 'edit');

		$positions = new $this->Employees_positions_model;
		$positions->setId($id,true);

		if( $positions->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('position_name', 'position Name', 'trim|required');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$positions->setName($this->input->post('position_name'),false,true);
					$positions->setNotes($this->input->post('notes'),false,true);
					$positions->update();
				}
				$this->postNext();
			}
		}

		$positions->set_select("*");
		$positions->set_select("(SELECT COUNT(*) FROM `employees` WHERE position_id=employees_positions.id) as employees_count");
		$this->template_data->set('position', $positions->get());

		$this->template_data->set('output', $output);
		$this->load->view('employees/positions/positions_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('employees', 'positions', 'delete');

		$positions = new $this->Employees_positions_model;
		$positions->setId($id,true,false);
		$positions->setTrash(1,false,true);
		$positions->update();

		$this->getNext("employees_positions");
	}
}
