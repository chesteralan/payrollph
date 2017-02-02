<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_deductions extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Deductions');
		$this->template_data->set('current_uri', 'employees_deductions');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');

		$this->load->model('Employees_positions_model');

	}

	public function index() {
		redirect("employees");
	}

	public function view($id, $start=0) {
		
		$positions = new $this->Employees_positions_model;
		$positions->set_select("*");
		$positions->set_select("(SELECT COUNT(*) FROM `employees` WHERE position_id=employees_positions.id) as employees_count");
		$positions->set_order('id', 'DESC');
		$this->template_data->set('positions', $positions->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url('employees_positions/index/'),
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
					$positions->setName($this->input->post('position_name'));
					$positions->setNotes($this->input->post('notes'));
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
		$positions->setId($id,true);
		$positions->delete();

		$this->getNext("employees_positions");
	}
}
