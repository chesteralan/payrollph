<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employees');
		$this->template_data->set('current_uri', 'employees');
		$this->template_data->set('navbar_search', true);

		$this->_isCompanyId();
		
		$this->_isAuth('employees', 'employees', 'view');

		$this->load->model('Names_list_model');
		$this->load->model('Employees_model');
		$this->load->model('Employees_groups_model');
		$this->load->model('Employees_positions_model');
		$this->load->model('Employees_areas_model');
		$this->load->model('Terms_list_model');
		$this->load->model('Companies_list_model');
	}

	public function index($start=0) {

		$employees = new $this->Employees_model;
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setTrash(0,true);
		$employees->set_select('*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=employees.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=employees.position_id) as position_name');
		$employees->set_select('(SELECT name FROM employees_areas WHERE id=employees.area_id) as area_name');
		$employees->set_order('lastname', 'ASC');
		$employees->set_start($start);
		$this->template_data->set('employees', $employees->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url( $this->config->item('index_page') . "/employees/index"),
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
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setGroupId($id,true);
		$employees->set_select('*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=employees.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=employees.position_id) as position_name');
		$employees->set_select('(SELECT name FROM employees_areas WHERE id=employees.area_id) as area_name');
		$employees->set_start($start);
		$this->template_data->set('employees', $employees->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url($this->config->item('index_page') . "/employees/group/{$id}"),
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
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setPositionId($id,true);
		$employees->set_select('*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=employees.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=employees.position_id) as position_name');
		$employees->set_select('(SELECT name FROM employees_areas WHERE id=employees.area_id) as area_name');
		$employees->set_start($start);
		$this->template_data->set('employees', $employees->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url($this->config->item('index_page') . "/employees/position/{$id}"),
			'total_rows' => $employees->count_all_results(),
			'per_page' => $employees->get_limit(),
			'ajax'=>true
		)));

		$this->load->view('employees/employees/employees_list', $this->template_data->get_data());
	}

	public function area($id, $start=0) {

		$area = new $this->Employees_areas_model;
		$area->setId($id,true);
		$this->template_data->set('area', $area->get());

		$employees = new $this->Employees_model;
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setAreaId($id,true);
		$employees->set_select('*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=employees.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=employees.position_id) as position_name');
		$employees->set_select('(SELECT name FROM employees_areas WHERE id=employees.area_id) as area_name');
		$employees->set_start($start);
		$this->template_data->set('employees', $employees->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url($this->config->item('index_page') . "/employees/area/{$id}"),
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
					$employee->setAreaId($this->input->post('area_id'));
					$employee->setCompanyId($this->session->userdata('current_company_id'));
					$employee->insert();
				}
				$this->postNext();
			}
		}

		$groups = new $this->Employees_groups_model;
		$groups->setCompanyId($this->session->userdata('current_company_id'),true);
		$groups->set_limit(0);
		$this->template_data->set('groups', $groups->populate());

		$positions = new $this->Employees_positions_model;
		$positions->setCompanyId($this->session->userdata('current_company_id'),true);
		$positions->set_limit(0);
		$positions->set_order('name', 'ASC');
		$this->template_data->set('positions', $positions->populate());

		$areas = new $this->Employees_areas_model;
		$areas->setCompanyId($this->session->userdata('current_company_id'),true);
		$areas->set_limit(0);
		$areas->set_order('name', 'ASC');
		$this->template_data->set('areas', $areas->populate());

		$this->load->view('employees/employees/employees_add', $this->template_data->get_data());

	}

	public function search_name($output='', $start=0) {

		$this->_isAuth('employees', 'employees', 'add');

		$names = new $this->Names_list_model;
		$names->set_start($start);
		$names->set_limit(5);
		$names->set_order('names_list.full_name', 'ASC');
		$names->set_where('(SELECT COUNT(*) FROM `employees` WHERE name_id=names_list.id) = 0');
		$this->template_data->set('names', $names->populate());
		
		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url($this->config->item('index_page') . "/employees/search_name/{$output}"),
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
				$this->form_validation->set_rules('company_id', 'Company', 'trim');
				$this->form_validation->set_rules('group_id', 'Group', 'trim');
				$this->form_validation->set_rules('position_id', 'Position', 'trim');
				$this->form_validation->set_rules('area_id', 'Area', 'trim');
				$this->form_validation->set_rules('date_hired', 'Hired', 'trim');
				$this->form_validation->set_rules('status', 'Status', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$employee->setCompanyId($this->input->post('company_id'),false,true);
					$employee->setGroupId($this->input->post('group_id'),false,true);
					$employee->setPositionId($this->input->post('position_id'),false,true);
					$employee->setAreaId($this->input->post('area_id'),false,true);
					$employee->setHired( date('Y-m-d', strtotime($this->input->post('date_hired'))),false,true);
					$employee->setStatus($this->input->post('status'),false,true);
					$employee->setNotes($this->input->post('notes'),false,true);
					$employee->update();
				}
				$this->postNext();
			}
		}
		$employee_data = $employee->get();
		$this->template_data->set('employee', $employee_data);

		$company_id = ($employee_data->company_id > 0) ? $employee_data->company_id : $this->session->userdata('current_company_id');

		$groups = new $this->Employees_groups_model;
		$groups->setCompanyId($company_id,true);
		$groups->set_limit(0);
		$groups->set_order('name');
		$this->template_data->set('groups', $groups->populate());

		$positions = new $this->Employees_positions_model;
		$positions->setCompanyId($company_id,true);
		$positions->set_limit(0);
		$positions->set_order('name');
		$this->template_data->set('positions', $positions->populate());

		$areas = new $this->Employees_areas_model;
		$areas->setCompanyId($company_id,true);
		$areas->set_limit(0);
		$areas->set_order('name');
		$this->template_data->set('areas', $areas->populate());

		$companies = new $this->Companies_list_model;
		$companies->setTrash(0,true);
		$companies->set_order('name', 'ASC');
		$companies->set_limit(0);
		$this->template_data->set('companies', $companies->populate());

		$terms = new $this->Terms_list_model;
		$terms->set_select("*");
		$terms->set_order('name', 'ASC');
		$terms->set_start(0);
		$terms->setTrash('0',true);
		$terms->setType('employment_status',true);
		$this->template_data->set('employment_status', $terms->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/employees_edit_employment', $this->template_data->get_data());
	}

	public function edit_address($id,$output='') {

		$this->_isAuth('employees', 'employees', 'edit');

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);

		if( $employee->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				if( $this->form_validation->run() ) {
					$employee->setPhoneNumber($this->input->post('phone_number'),false,true);
					$employee->setAddress($this->input->post('address'),false,true);
					$employee->update();
				}
				$this->postNext();
			}
		}

		$this->template_data->set('employee', $employee->get());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/employees_edit_address', $this->template_data->get_data());
	}

	public function delete($id) {
		$this->_isAuth('employees', 'employees', 'delete');

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true,false);
		$employee->setTrash(1,false,true);
		$employee->update();

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
