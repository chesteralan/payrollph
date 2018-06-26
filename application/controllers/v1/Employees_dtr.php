<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_dtr extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Employee DTR');
		$this->template_data->set('current_uri', 'employees_dtr');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('employees', 'employees', 'edit');

	}

	public function index() {
		redirect("employees");
	}

	public function view($id, $start=0) {

		$employee = new $this->Employees_model('e');
		$employee->setNameId($id,true);
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$this->template_data->set('employee', $employee->get());

		$current_month = ($this->input->get('month')) ? $this->input->get('month') : date('m');
		$current_year = ($this->input->get('year')) ? $this->input->get('year') : date('Y');
		$this->template_data->set('current_month', $current_month);
		$this->template_data->set('current_year', $current_year);

		$absences = new $this->Employees_absences_model('a');
		$absences->set_where('MONTH(date_absent)', $current_month);
		$absences->set_where('YEAR(date_absent)', $current_year);
		$absences->setNameId($id,true);
		$absences->set_select('a.*');
		$absences->set_select('b.name as leave_name');
		$absences->set_join('benefits_list b', 'b.id=a.leave_type');
		$absences->set_limit(0);
		$this->template_data->set('absences', $absences->populate());

		$this->template_data->set('next_item', $this->_next_name($id, 'employees_dtr/view/'));
		$this->template_data->set('previous_item', $this->_previous_name($id, 'employees_dtr/view/'));

		$this->load->view('employees/employees/dtr/dtr_calendar', $this->template_data->get_data());
	}
	
	public function edit_date($name_id, $date, $output='') {

		$employee = new $this->Employees_model('e');
		$employee->setNameId($name_id,true);
		$employee->set_select('e.*');
		$employee->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$employee_data = $employee->get();
		$this->template_data->set('employee', $employee_data );

		$absence = new $this->Employees_absences_model;
		$absence->setNameId($name_id,true);
		$absence->setDateAbsent($date,true);
		if( $this->input->post() ) {
			if( $this->input->post('absent') ) {
				$this->form_validation->set_rules('absent', 'Absent', 'trim');
				$this->form_validation->set_rules('hours', 'Number of Hours', 'trim');
				$this->form_validation->set_rules('leave_type', 'Leave Type', 'trim');
				if( $this->form_validation->run() ) {
					$absence->setLeaveType($this->input->post('leave_type'));
					$hours = ($this->input->post('hours')) ? intval($this->input->post('hours')) : $employee_data->working_hours;
					$hours = ($hours > $employee_data->working_hours) ? $employee_data->working_hours : $hours;
					$absence->setHours($hours);
					$absence->setNotes($this->input->post('notes'));
					if( $absence->nonEmpty() ) {
						$absence->update();
					} else {
						$absence->insert();
					}
				}
			} else {

				if( $absence->nonEmpty() ) {
					$absence->delete();
				}
			}
			$this->postNext();
		}
		$this->template_data->set('absence', $absence->get());
		
		$this->template_data->set('date', $date);
		
		$selected_year = date('Y', strtotime($date));

		$leave_benefits = new $this->Benefits_list_model('b');
		$leave_benefits->setLeave(1,true);
		$leave_benefits->setTrash(0,true);
		$leave_benefits->set_select("*");
		$leave_benefits->set_select("(SELECT elb.days FROM employees_leave_benefits elb WHERE elb.name_id={$employee_data->name_id} AND elb.company_id={$employee_data->company_id} AND b.id=elb.benefit_id AND elb.year='{$selected_year}' LIMIT 1) as days");
		$leave_benefits->set_select("(SELECT SUM(eab.hours/8) FROM employees_absences eab WHERE eab.name_id={$employee_data->name_id} AND eab.leave_type=b.id AND YEAR(eab.date_absent)='{$selected_year}') as availed");
		$this->template_data->set('leave_benefits', $leave_benefits->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/dtr/dtr_edit_date', $this->template_data->get_data());
	}

	public function add_leave($name_id, $date, $output='') {

		$employee = new $this->Employees_model('e');
		$employee->setNameId($name_id,true);
		$employee->set_select('e.*');
		$employee->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$employee_data = $employee->get();
		$this->template_data->set('employee', $employee_data );

		$absence = new $this->Employees_absences_model;
		$absence->setNameId($name_id,true);
		$absence->setDateAbsent($date,true);

		if( $this->input->get('delete') ) {
			$absence->delete();
			$this->getNext();
		}
		if( $this->input->post() ) {
			if( $this->input->post('absent') ) {
				$this->form_validation->set_rules('absent', 'Absent', 'trim');
				$this->form_validation->set_rules('hours', 'Number of Hours', 'trim');
				$this->form_validation->set_rules('leave_type', 'Leave Type', 'trim');
				if( $this->form_validation->run() ) {
					$absence->setLeaveType($this->input->post('leave_type'));
					$hours = ($this->input->post('hours')) ? intval($this->input->post('hours')) : $employee_data->working_hours;
					$hours = ($hours > $employee_data->working_hours) ? $employee_data->working_hours : $hours;
					$absence->setHours($hours);
					$absence->setNotes($this->input->post('notes'));
					if( $absence->nonEmpty() ) {
						$absence->update();
					} else {
						$absence->insert();
					}
				}
			} else {

				if( $absence->nonEmpty() ) {
					$absence->delete();
				}
			}
			$this->postNext();
		}
		$this->template_data->set('absence', $absence->get());
		
		$this->template_data->set('date', $date);
		
		$selected_year = date('Y', strtotime($date));

		if( $this->input->get('leave_id') ) {
			$current_leave = new $this->Benefits_list_model('b');
			$current_leave->setId($this->input->get('leave_id'),true);
			$current_leave->set_select("*");
			$current_leave->set_select("(SELECT elb.days FROM employees_leave_benefits elb WHERE elb.name_id={$employee_data->name_id} AND elb.company_id={$employee_data->company_id} AND b.id=elb.benefit_id AND elb.year='{$selected_year}' LIMIT 1) as days");
			$current_leave->set_select("(SELECT SUM(eab.hours/8) FROM employees_absences eab WHERE eab.name_id={$employee_data->name_id} AND eab.leave_type=b.id AND YEAR(eab.date_absent)='{$selected_year}') as availed");
			$this->template_data->set('current_leave', $current_leave->get());
		} else {
			$leave_benefits = new $this->Benefits_list_model('b');
			$leave_benefits->setLeave(1,true);
			$leave_benefits->setTrash(0,true);
			$leave_benefits->set_select("*");
			$leave_benefits->set_select("(SELECT elb.days FROM employees_leave_benefits elb WHERE elb.name_id={$employee_data->name_id} AND elb.company_id={$employee_data->company_id} AND b.id=elb.benefit_id AND elb.year='{$selected_year}' LIMIT 1) as days");
			$leave_benefits->set_select("(SELECT SUM(eab.hours/8) FROM employees_absences eab WHERE eab.name_id={$employee_data->name_id} AND eab.leave_type=b.id AND YEAR(eab.date_absent)='{$selected_year}') as availed");
			$this->template_data->set('leave_benefits', $leave_benefits->populate());
		}

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/dtr/dtr_add_leave', $this->template_data->get_data());
	}
}
