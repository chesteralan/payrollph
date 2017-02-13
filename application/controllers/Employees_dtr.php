<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_dtr extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee DTR');
		$this->template_data->set('current_uri', 'employees_dtr');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'positions', 'view');

		$this->load->model('Employees_positions_model');
		$this->load->model('Employees_absenses_model');
		$this->load->model('Employees_model');
		$this->load->model('Benefits_list_model');

	}

	public function add_leave($name_id, $date, $output='') {

		$absense = new $this->Employees_absenses_model;
		$absense->setNameId($name_id,true);
		$absense->setDateAbsent($date,true);
		if( $this->input->post() ) {
			if( $this->input->post('absent') ) {
				$this->form_validation->set_rules('absent', 'Absent', 'trim');
				$this->form_validation->set_rules('leave_type', 'Leave Type', 'trim');
				if( $this->form_validation->run() ) {
					$absense->setLeaveType($this->input->post('leave_type'));
					if( $absense->nonEmpty() ) {
						$absense->update();
					} else {
						$absense->insert();
					}
				}
			} else {

				if( $absense->nonEmpty() ) {
					$absense->delete();
				}
			}
			$this->postNext();
		}
		$this->template_data->set('absense', $absense->get());
		
		$this->template_data->set('date', $date);
		
		$employee = new $this->Employees_model;
		$employee->setNameId($name_id,true);
		$this->template_data->set('employee', $employee->get());

		$benefits = new $this->Benefits_list_model;
		$benefits->setLeave(1,true);
		$this->template_data->set('leaves', $benefits->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/dtr/dtr_add_leave', $this->template_data->get_data());
	}
}
