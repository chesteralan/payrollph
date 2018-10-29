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

	public function view($id, $current_month=0, $current_year=0) {

		$this->template_data->set('name_id', $id);

		$employee = new $this->Employees_model('e');
		$employee->setNameId($id,true);
		$employee->set_select('e.*');
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$employee_data = $employee->get();
		$this->template_data->set('employee', $employee_data);

		$name_id = $employee_data->name_id;

		$current_month = ($current_month) ? $current_month : date('m');
		$current_year = ($current_year) ? $current_year : date('Y');
		$this->template_data->set('current_month', $current_month);
		$this->template_data->set('current_year', $current_year);

		$previous_month = date('m', strtotime('-1 month', strtotime($current_year.'-'.$current_month.'-01')));
		$previous_year = date('Y', strtotime('-1 month', strtotime($current_year.'-'.$current_month.'-01')));
		$this->template_data->set('previous_month', $previous_month);
		$this->template_data->set('previous_year', $previous_year);

		$next_month = date('m', strtotime('+1 month', strtotime($current_year.'-'.$current_month.'-01')));
		$next_year = date('Y', strtotime('+1 month', strtotime($current_year.'-'.$current_month.'-01')));
		$this->template_data->set('next_month', $next_month);
		$this->template_data->set('next_year', $next_year);

		$absences = new $this->Employees_absences_model('a');
		$absences->set_where('MONTH(date_absent)', $current_month);
		$absences->set_where('YEAR(date_absent)', $current_year);
		$absences->setNameId($name_id,true);
		$absences->set_select('a.*');
		$absences->set_select('b.name as leave_name');
		$absences->set_join('benefits_list b', 'b.id=a.leave_type');
		$absences->set_limit(0);
		$this->template_data->set('absences', $absences->populate());

		$attendance = new $this->Employees_attendance_model('a');
		$attendance->set_where('MONTH(date_present)', $current_month);
		$attendance->set_where('YEAR(date_present)', $current_year);
		$attendance->setNameId($name_id,true);
		$attendance->set_select('a.*');
		$attendance->set_limit(0);
		$this->template_data->set('attendance', $attendance->populate());

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

	public function add_attendance($pe_id, $date, $output='') {

		$employee = new $this->Payroll_employees_model('pe');
		$employee->setId($pe_id,true);
		$employee_data = $employee->get();

		$name_id = $employee_data->name_id;

		$this->template_data->set('date', $date );
		$this->template_data->set('pe_id', $pe_id );

		$payroll = new $this->Payroll_model;
		$payroll->setId($employee_data->payroll_id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$employee = new $this->Employees_model('e');
		$employee->setNameId($name_id,true);
		$employee->set_select('e.*');
		$employee->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$employee_data = $employee->get();
		$this->template_data->set('employee', $employee_data );

		$attendance = new $this->Employees_attendance_model;
		$attendance->setNameId($name_id,true);
		$attendance->setDatePresent($date,true);

		if( $this->input->get('delete') ) {
			$attendance->delete();
			$this->getNext();
		}

		if( $this->input->get('assign') ) {
			$attendance->setPeId($pe_id,false,true);
			$attendance->update();
			$this->getNext();
		}

		if( $this->input->get('remove_assignment') ) {
			$attendance->setPeId('0',false,true);
			$attendance->update();
			$this->getNext();
		}

		if( $this->input->post() ) {
					$attendance->setHours($this->input->post('hours'));
					$attendance->setNotes($this->input->post('notes'));
					if( $this->input->get('auto_assign') ) {
						$attendance->setPeId($pe_id);
					}
					if( $attendance->nonEmpty() ) {
						$attendance->update();
					} else {
						$attendance->insert();
					}
					$this->postNext();
		}

		$this->template_data->set('attendance', $attendance->get());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/dtr/dtr_add_attendance', $this->template_data->get_data());
	}

	public function add_leave($pe_id, $date, $output='') {

		$employee = new $this->Payroll_employees_model('pe');
		$employee->setId($pe_id,true);
		$employee->set_select("pe.*");
		$employee->set_select("e.name_id as e_name_id");
		$employee->set_join('employees e', 'e.name_id=pe.name_id');
		$pemployee_data = $employee->get();

		$name_id = $pemployee_data->name_id;

		$employee = new $this->Employees_model('e');
		$employee->setNameId($name_id,true);
		$employee->set_select('e.*');
		$employee->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');
		$employee->set_select('ni.*');
		$employee->set_select('e.name_id');
		$employee->set_join('names_info ni', 'ni.name_id=e.name_id');
		$employee_data = $employee->get();
		$this->template_data->set('employee', $employee_data );

		$this->template_data->set('date', $date );
		$this->template_data->set('pe_id', $pe_id );
		$this->template_data->set('name_id', $name_id );

		$payroll = new $this->Payroll_model;
		$payroll->setId($pemployee_data->payroll_id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$absence = new $this->Employees_absences_model;
		$absence->setNameId($name_id,true);
		$absence->setDateAbsent($date,true);

		if( $this->input->get('delete') ) {
			$absence->delete();
			$this->getNext();
		}

		if( $this->input->get('assign') ) {
			$absence->setPeId($pe_id,false,true);
			$absence->update();
			$this->getNext();
		}

		if( $this->input->get('remove_assignment') ) {
			$absence->setPeId('0',false,true);
			$absence->update();
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
					$absence->setPeId($pe_id);
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

			if( $employee_data ) {
				$leave_benefits->set_select("(SELECT elb.days FROM employees_leave_benefits elb WHERE elb.name_id={$employee_data->name_id} AND elb.company_id={$employee_data->company_id} AND b.id=elb.benefit_id AND elb.year='{$selected_year}' LIMIT 1) as days");
			
			
				$leave_benefits->set_select("(SELECT SUM(eab.hours/8) FROM employees_absences eab WHERE eab.name_id={$employee_data->name_id} AND eab.leave_type=b.id AND YEAR(eab.date_absent)='{$selected_year}') as availed");
			}
			
			$this->template_data->set('leave_benefits', $leave_benefits->populate());
		}

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/dtr/dtr_add_leave', $this->template_data->get_data());
	}
}
