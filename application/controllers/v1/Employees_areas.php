<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_areas extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee Areas');
		$this->template_data->set('current_uri', 'employees_areas');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'areas', 'view');

	}

	public function index($start=0) {
		
		$areas = new $this->Employees_areas_model;
		if( $this->input->get('q') ) {
			$areas->set_where('name LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
		}
		
		if( $this->input->get('filter') == 'trash' ) {
			$areas->setTrash(1, true);
		} else {
			$areas->setTrash(0, true);
		}

		$areas->setCompanyId($this->session->userdata('current_company_id'),true);
		
		$areas->set_select("*");
		$areas->set_select("(SELECT COUNT(*) FROM `employees` WHERE area_id=employees_areas.id) as employees_count");
		$areas->set_order('name', 'ASC');
		$areas->set_start($start);
		$this->template_data->set('areas', $areas->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/employees_areas/index/'),
			'total_rows' => $areas->count_all_results(),
			'per_page' => $areas->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('employees/areas/areas_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('employees', 'areas', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('area_name', 'Area Name', 'trim|required');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$areas = new $this->Employees_areas_model;
				$areas->setName($this->input->post('area_name'));
				$areas->setNotes($this->input->post('notes'));
				$areas->setCompanyId($this->session->userdata('current_company_id'));
				if( $areas->insert() ) {
					record_system_audit($this->session->userdata('user_id'), 'employees', 'areas', 'add', $this->session->userdata('current_company_id'), "Employee Area Added : {$this->input->post('area_name')}");
				}
				$this->getNext("employees_areas");
			}
		}

		$this->template_data->set('output', $output);
		$this->load->view('employees/areas/areas_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('employees', 'areas', 'edit');

		$areas = new $this->Employees_areas_model;
		$areas->setId($id,true);
		$area_data = $areas->get();

		if( $areas->nonEmpty() ) {
			if( $this->input->post() ) {
				$this->form_validation->set_rules('area_name', 'Area Name', 'trim|required');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$areas->setName($this->input->post('area_name'),false,true);
					$areas->setNotes($this->input->post('notes'),false,true);
					if( $areas->update() ) {
						record_system_audit($this->session->userdata('user_id'), 'employees', 'areas', 'edit', $this->session->userdata('current_company_id'), "Employee Area Edited : {$area_data->name}");
					}
				}
				$this->postNext();
			}
		}

		$areas->set_select("*");
		$areas->set_select("(SELECT COUNT(*) FROM `employees` WHERE area_id=employees_areas.id) as employees_count");
		$this->template_data->set('area', $areas->get());

		$this->template_data->set('output', $output);
		$this->load->view('employees/areas/areas_edit', $this->template_data->get_data());
	}

	public function deactivate($id) {
		
		$this->_isAuth('employees', 'areas', 'delete');

		$areas = new $this->Employees_areas_model;
		$areas->setId($id,true,false);
		$areas->setTrash(1,false,true);
		$area_data = $areas->get();

		if( $areas->update() ) {
			record_system_audit($this->session->userdata('user_id'), 'employees', 'areas', 'delete', $this->session->userdata('current_company_id'), "Employee Area Deleted : {$area_data->name}");
		}

		$this->getNext("employees_areas");
	}


	public function restore($id) {
		
		$this->_isAuth('employees', 'areas', 'delete');

		$areas = new $this->Employees_areas_model;
		$areas->setId($id,true,false);
		$areas->setTrash(0,false,true);
		$area_data = $areas->get();

		if( $areas->update() ) {
			record_system_audit($this->session->userdata('user_id'), 'employees', 'areas', 'delete', $this->session->userdata('current_company_id'), "Employee Area Restored : {$area_data->name}");
		}

		$this->getNext("employees_areas");
	}

}
