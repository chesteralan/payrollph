<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employees');
		$this->template_data->set('current_uri', 'employees');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'view');

		$this->load->model('Names_list_model');
		$this->load->model('Employees_model');
		$this->load->model('Employees_groups_model');
		$this->load->model('Employees_positions_model');
	}

	public function index($start=0) {

		$employees = new $this->Employees_model;
		$employees->set_select('*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=employees.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=employees.position_id) as position_name');
		$this->template_data->set('employees', $employees->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url("employees/index"),
			'total_rows' => $employees->count_all_results(),
			'per_page' => $employees->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('employees/employees/employees_list', $this->template_data->get_data());
	}

	public function group($id, $start=0) {

		$groups = new $this->Employees_groups_model;
		$groups->setId($id,true);
		$this->template_data->set('group', $groups->get());

		$employees = new $this->Employees_model;
		$employees->setGroupId($id,true);
		$employees->set_select('*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=employees.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=employees.position_id) as position_name');
		$this->template_data->set('employees', $employees->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url("employees/group/{$id}"),
			'total_rows' => $employees->count_all_results(),
			'per_page' => $employees->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('employees/employees/employees_list', $this->template_data->get_data());
	}

	public function position($id, $start=0) {

		$position = new $this->Employees_positions_model;
		$position->setId($id,true);
		$this->template_data->set('position', $position->get());

		$employees = new $this->Employees_model;
		$employees->setPositionId($id,true);
		$employees->set_select('*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=employees.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=employees.position_id) as position_name');
		$this->template_data->set('employees', $employees->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url("employees/group/{$id}"),
			'total_rows' => $employees->count_all_results(),
			'per_page' => $employees->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('employees/employees/employees_list', $this->template_data->get_data());
	}

	public function add($id, $output='') {
		$this->_isAuth('employees', 'employees', 'add');

		$this->template_data->set('output', $output);

		$names = new $this->Names_list_model;
		$names->setId($id, true);
		$this->template_data->set('name', $names->get());

		if( $names->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
				$this->form_validation->set_rules('middlename', 'Middle Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$employee = new $this->Employees_model;
					$employee->setNameId($id);
					$employee->setLastname($this->input->post('lastname'));
					$employee->setFirstname($this->input->post('firstname'));
					$employee->setMiddlename($this->input->post('middlename'));
					$employee->setGroupId($this->input->post('group_id'));
					$employee->setPositionId($this->input->post('position_id'));
					$employee->insert();
				}
				$this->postNext();
			}
		}

		$groups = new $this->Employees_groups_model;
		$groups->set_limit(0);
		$this->template_data->set('groups', $groups->populate());

		$positions = new $this->Employees_positions_model;
		$positions->set_limit(0);
		$this->template_data->set('positions', $positions->populate());

		$this->load->view('employees/employees/employees_add', $this->template_data->get_data());

	}

	public function search_name($output='', $start=0) {

		$this->_isAuth('employees', 'employees', 'add');

		$names = new $this->Names_list_model;
		$names->set_start($start);
		$names->set_limit(5);
		$names->set_where('(SELECT COUNT(*) FROM `employees` WHERE name_id=names_list.id) = 0');
		$this->template_data->set('names', $names->populate());
		
		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url("employees/search_name/{$output}"),
			'total_rows' => $names->count_all_results(),
			'per_page' => $names->get_limit(),
			'attributes' => array(
				'class' => 'btn btn-default ajax-modal-inner',
				'data-hide_footer' => 1
				)
		), '?next=' . $this->input->get('next') ));
		
		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/employees_add_search', $this->template_data->get_data());
		
	}

	public function edit_personal($id,$output='') {
		$this->_isAuth('employees', 'employees', 'edit');

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);

		if( $employee->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
				$this->form_validation->set_rules('middlename', 'Middle Name', 'trim|required');
				if( $this->form_validation->run() ) {
					$employee->setLastname($this->input->post('lastname'),false,true);
					$employee->setFirstname($this->input->post('firstname'),false,true);
					$employee->setMiddlename($this->input->post('middlename'),false,true);
					$employee->update();
				}
				$this->postNext();
			}
		}

		$this->template_data->set('employee', $employee->get());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/employees_edit_personal', $this->template_data->get_data());
	}

	public function edit_employment($id,$output='') {
		$this->_isAuth('employees', 'employees', 'edit');

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true,false);

		if( $employee->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('group_id', 'Group', 'trim');
				$this->form_validation->set_rules('position_id', 'Position', 'trim');
				$this->form_validation->set_rules('date_hired', 'Hired', 'trim');
				$this->form_validation->set_rules('status', 'Status', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$employee->setGroupId($this->input->post('group_id'),false,true);
					$employee->setPositionId($this->input->post('position_id'),false,true);
					$employee->setHired( date('Y-m-d', strtotime($this->input->post('date_hired'))),false,true);
					$employee->setStatus($this->input->post('status'),false,true);
					$employee->setNotes($this->input->post('notes'),false,true);
					$employee->update();
				}
				$this->postNext();
			}
		}

		$this->template_data->set('employee', $employee->get());

		$groups = new $this->Employees_groups_model;
		$groups->set_limit(0);
		$this->template_data->set('groups', $groups->populate());

		$positions = new $this->Employees_positions_model;
		$positions->set_limit(0);
		$this->template_data->set('positions', $positions->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/employees_edit_employment', $this->template_data->get_data());
	}

	public function delete($id) {
		$this->_isAuth('employees', 'employees', 'delete');

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$employee->delete();

		$this->getNext("employees");
	}

	public function config($id, $output='') {

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$this->template_data->set('employee', $employee->get());
		
		$this->template_data->set('output', $output);

		$this->load->view('employees/employees/employees_config', $this->template_data->get_data());

	}

}
