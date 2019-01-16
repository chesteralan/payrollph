<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_dtr extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Daily Time Record');
		$this->template_data->set('current_uri', 'payroll_dtr');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		if( !get_company_option($this->session->userdata('current_company_id'), 'column_group_dtr') ) {
			redirect("welcome");
		}

		$this->session->set_userdata('page_session', 'payroll_dtr');

	}

	public function index() {
		redirect("payroll");
	}
	
	public function view($id,$group_id=0,$output='') {

		$this->_column_groups();
		$this->template_data->set('group_id', $group_id);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$this->template_data->set('print_groups', $print_groups->populate());

		$leave = new $this->Benefits_list_model('b');
		$leave->setLeave(1,true);
		$leave->setTrash(0,true);
		$leave->set_select("*");
		$leave_benefits = $leave->populate();
		$this->template_data->set('leave_benefits', $leave_benefits);

		$inclusive_dates = new $this->Payroll_inclusive_dates_model('pid');
		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_select('COUNT(*) as working_days');
		$inclusive_dates->set_select('MIN(pid.inclusive_date) as start_date');
		$inclusive_dates->set_select('MAX(pid.inclusive_date) as end_date');
		$dates_data = $inclusive_dates->get();
		$this->template_data->set('inclusive_dates', $dates_data);

	if( $dates_data->working_days > 0 ) {
			
		switch( $payroll_data->group_by ) {
			case 'position':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setPositionId(intval($group_id),true);
				}

				$payroll_group->set_join('employees_positions eg', 'pg.position_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE position_id=pg.position_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_positions WHERE id=pg.position_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();
				
			break;
			case 'area':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setAreaId(intval($group_id),true);
				}

				$payroll_group->set_join('employees_areas eg', 'pg.area_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE area_id=pg.area_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_areas WHERE id=pg.area_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			break;
			case 'status':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setStatusId(intval($group_id),true);
				}

				$payroll_group->set_join('terms_list eg', 'pg.status_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("pg.status_id > 0");
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE status=pg.status_id) > 0)");
				//$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			break;
			case 'group':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setGroupId(intval($group_id),true);
				}

				$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			default:
			break;
		}


		foreach($payroll_group_data as $key=>$group) {
			$employees = new $this->Payroll_employees_model('pe');
			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}
			$employees->setPayrollId($id,true);
			$employees->set_select('pe.*');
			$employees->set_select('ni.*');
			$employees->set_select('pe.id as pe_id');
			$employees->set_select('pe.presence as pe_presence');
			$employees->set_select('e.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');

			switch( $payroll_data->group_by ) {
				case 'position':
					$employees->set_where('pe.position_id', $group->position_id);
				break;
				case 'area':
					$employees->set_where('pe.area_id', $group->area_id);
				break;
				case 'status':
					$employees->set_where('pe.status_id', $group->status_id);
				break;
				case 'group':
				default:
					$employees->set_where('pe.group_id', $group->group_id);
				break;
			}

			if( $this->session->userdata('employees_filter') ) {
				switch( $this->session->userdata('employees_filter_type') ) {
					case 'position':
						$employees->set_where('pe.position_id', $this->session->userdata('employees_filter')->id);
					break;
					case 'area':
						$employees->set_where('pe.area_id', $this->session->userdata('employees_filter')->id);
					break;
					case 'status':
						$employees->set_where('pe.status_id', $this->session->userdata('employees_filter')->id);
					break;
					case 'group':
						$employees->set_where('pe.group_id', $this->session->userdata('employees_filter')->id);
					break;
				}
			}

			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			//$employees->set_select("(SELECT COUNT(*) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences");

			$employees->set_select("(SELECT COUNT(*) FROM employees_absences ea WHERE ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}' AND ea.pe_id=pe.id) as absences");

			$employees->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');

			//$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences_hours");

			$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}' AND ea.pe_id=pe.id) as absences_hours");

			$employees->set_select("(SELECT COUNT(*) FROM employees_attendance ea2 WHERE ea2.name_id=pe.name_id AND ea2.date_present >= '{$dates_data->start_date}' AND ea2.date_present <= '{$dates_data->end_date}' AND ea2.pe_id=pe.id) as attendance");

			foreach( $leave_benefits as $leave1) {
				$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.leave_type={$leave1->id} AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}' AND ea.pe_id=pe.id) as leave_{$leave1->id}");
			}

			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate(); 
			$payroll_group_data[$key]->employees = $employees_data;
		}

		$this->template_data->set('payroll_groups', $payroll_group_data);

		if( $payroll_data->group_by != 'status' ) {
			$employees_status = new $this->Payroll_employees_model('pe');
			$employees_status->setPayrollId($id,true);
			$employees_status->set_select('e.status');
			$employees_status->set_select('(SELECT t.name FROM terms_list t WHERE t.type="employment_status" AND t.id=e.status) as status_name');
			$employees_status->set_join('employees e', 'e.name_id=pe.name_id');
			$employees_status->set_limit(0);
			$employees_status->set_group_by('e.status');
			$employees_status->set_where('e.status IS NOT NULL');
			$employees_status->set_where('e.status <> 0');
			$employees_status->set_where('e.status <> ""');
			$employees_status->set_order('(SELECT t.name FROM terms_list t WHERE t.type="employment_status" AND t.id=e.status)', 'ASC');
			$this->template_data->set('employees_status', $employees_status->populate());
		}


		if( $payroll_data->group_by != 'group' ) {
			$groups = new $this->Employees_groups_model;
			$groups->setCompanyId($this->session->userdata('current_company_id'),true);
			$groups->set_limit(0);
			$groups->set_order('name', 'ASC');
			$this->template_data->set('employees_groups', $groups->populate());
		}

		if( $payroll_data->group_by != 'area' ) {
			$areas = new $this->Employees_areas_model;
			$areas->setCompanyId($this->session->userdata('current_company_id'),true);
			$areas->set_limit(0);
			$areas->set_order('name', 'ASC');
			$this->template_data->set('employees_areas', $areas->populate());
		}

		if( $payroll_data->group_by != 'position' ) {
			$positions = new $this->Employees_positions_model;
			$positions->setCompanyId($this->session->userdata('current_company_id'),true);
			$positions->set_limit(0);
			$positions->set_order('name', 'ASC');
			$this->template_data->set('employees_positions', $positions->populate());
		}
		
		$this->template_data->set('next_item', $this->_next_payroll($id, $group_id, 'payroll_dtr/view/'));
		$this->template_data->set('previous_item', $this->_previous_payroll($id, $group_id, 'payroll_dtr/view/'));

	} else {

		$this->template_data->set('no_inclusive_dates', true);

	}

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/dtr/dtr_view', $this->template_data->get_data());
	}

public function leave_benefits($id,$group_id=0,$output='') {

		$this->_column_groups();

		$this->template_data->set('current_page', 'Leave Benefits');

		$this->template_data->set('group_id', $group_id);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$leave = new $this->Benefits_list_model('b');
		$leave->setLeave(1,true);
		$leave->setTrash(0,true);
		$leave->set_select("*");
		$leave_benefits = $leave->populate();
		$this->template_data->set('leave_benefits', $leave_benefits);

		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$this->template_data->set('print_groups', $print_groups->populate());

		$inclusive_dates = new $this->Payroll_inclusive_dates_model('pid');
		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_select('COUNT(*) as working_days');
		$inclusive_dates->set_select('MIN(pid.inclusive_date) as start_date');
		$inclusive_dates->set_select('MAX(pid.inclusive_date) as end_date');
		$dates_data = $inclusive_dates->get();
		$this->template_data->set('inclusive_dates', $dates_data);

		if( $dates_data->working_days > 0 ) {
			
		switch( $payroll_data->group_by ) {
			case 'position':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setPositionId(intval($group_id),true);
				}

				$payroll_group->set_join('employees_positions eg', 'pg.position_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE position_id=pg.position_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_positions WHERE id=pg.position_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();
				
			break;
			case 'area':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setAreaId(intval($group_id),true);
				}

				$payroll_group->set_join('employees_areas eg', 'pg.area_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE area_id=pg.area_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_areas WHERE id=pg.area_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			break;
			case 'status':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setStatusId(intval($group_id),true);
				}

				$payroll_group->set_join('terms_list eg', 'pg.status_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("pg.status_id > 0");
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE status=pg.status_id) > 0)");
				//$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			break;
			case 'group':

				$payroll_group = new $this->Payroll_groups_model('pg');
				$payroll_group->setPayrollId($id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setGroupId(intval($group_id),true);
				}

				$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			default:
			break;
		}


		foreach($payroll_group_data as $key=>$group) {
			$employees = new $this->Payroll_employees_model('pe');
			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}
			$employees->setPayrollId($id,true);
			$employees->set_select('pe.*');
			$employees->set_select('ni.*');
			$employees->set_select('pe.id as pe_id');
			$employees->set_select('pe.presence as pe_presence');
			$employees->set_select('e.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');

			switch( $payroll_data->group_by ) {
				case 'position':
					$employees->set_where('pe.position_id', $group->position_id);
				break;
				case 'area':
					$employees->set_where('pe.area_id', $group->area_id);
				break;
				case 'status':
					$employees->set_where('pe.status_id', $group->status_id);
				break;
				case 'group':
				default:
					$employees->set_where('pe.group_id', $group->group_id);
				break;
			}

			if( $this->session->userdata('employees_filter') ) {
				switch( $this->session->userdata('employees_filter_type') ) {
					case 'position':
						$employees->set_where('pe.position_id', $this->session->userdata('employees_filter')->id);
					break;
					case 'area':
						$employees->set_where('pe.area_id', $this->session->userdata('employees_filter')->id);
					break;
					case 'status':
						$employees->set_where('pe.status_id', $this->session->userdata('employees_filter')->id);
					break;
					case 'group':
						$employees->set_where('pe.group_id', $this->session->userdata('employees_filter')->id);
					break;
				}
			}

			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');


			foreach( $leave_benefits as $leave1) {
				$employees->set_select("(SELECT elb.days FROM employees_leave_benefits elb WHERE elb.company_id=e.company_id AND elb.name_id=e.name_id AND elb.benefit_id={$leave1->id} AND elb.year='{$payroll_data->year}') as allowed_leave_{$leave1->id}");
				$employees->set_select("(SELECT SUM(eab.hours/8) FROM employees_absences eab WHERE eab.name_id=e.name_id AND eab.leave_type={$leave1->id} AND YEAR(eab.date_absent)='{$payroll_data->year}') as availed_leave_{$leave1->id}");
			}


			$employees->setActive('1', true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate(); 
			$payroll_group_data[$key]->employees = $employees_data;
		}

		$this->template_data->set('payroll_groups', $payroll_group_data);

		$employees_status = new $this->Payroll_employees_model('pe');
		$employees_status->setPayrollId($id,true);
		$employees_status->set_select('e.status');
		$employees_status->set_select('(SELECT t.name FROM terms_list t WHERE t.type="employment_status" AND t.id=e.status) as status_name');
		$employees_status->set_join('employees e', 'e.name_id=pe.name_id');
		$employees_status->set_limit(0);
		$employees_status->set_group_by('e.status');
		$employees_status->set_where('e.status IS NOT NULL');
		$employees_status->set_where('e.status <> 0');
		$employees_status->set_where('e.status <> ""');
		$employees_status->set_order('(SELECT t.name FROM terms_list t WHERE t.type="employment_status" AND t.id=e.status)', 'ASC');
		$this->template_data->set('employees_status', $employees_status->populate());

		$this->template_data->set('next_item', $this->_next_payroll($id, $group_id, 'payroll_dtr/leave_benefits/'));
		$this->template_data->set('previous_item', $this->_previous_payroll($id, $group_id, 'payroll_dtr/leave_benefits/'));
		
	} else {

		$this->template_data->set('no_inclusive_dates', true);

	}

		$this->template_data->set('output', $output);

		$this->load->view('payroll/payroll/dtr/dtr_leave_benefits', $this->template_data->get_data());
	}

	public function absences($id,$pe_id,$output='') {

		$employee = new $this->Payroll_employees_model('pe');
		$employee->setId($pe_id,true);
		$employee->set_select('pe.*');
		$employee->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=pe.name_id AND es.primary=1 AND es.trash=0) as working_hours');
		$employee_data = $employee->get();

		$name_id = $employee_data->name_id; 

		if( $this->input->post() ) {
			if( $this->input->post('present') ) {
				$inclusive_dates = $this->input->post('inclusive_dates');
				$presents = $this->input->post('present');

				foreach($inclusive_dates as $date=>$status) {
					if( isset($presents[$date]) )  {
						$absence = new $this->Employees_absences_model;
						$absence->setNameId($name_id,true);
						$absence->setDateAbsent($date,true);
						$absence->setPeId($pe_id,true);
						$absence->delete();
					} else {
						// absent
						$absence = new $this->Employees_absences_model;
						$absence->setNameId($name_id,true);
						$absence->setDateAbsent($date,true);
						$absence->setHours($employee_data->working_hours);
						$absence->setPeId($pe_id);
						if( $absence->nonEmpty() ) {
							$absence->update();
						} else {
							$absence->insert();
						}
					}
					
				}
			}
			$this->postNext();
		}

		$this->_column_groups();
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('pe_id', $pe_id);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$inclusive_dates = new $this->Payroll_inclusive_dates_model('pid');
		$inclusive_dates->set_select("pid.*");
		
		$inclusive_dates->set_select("(SELECT COUNT(*) FROM employees_absences ea2 WHERE ea2.name_id='{$name_id}' AND ea2.date_absent=pid.inclusive_date) as absent");

		$inclusive_dates->set_select("(SELECT COUNT(*) FROM employees_absences ea2 WHERE ea2.pe_id='{$pe_id}' AND ea2.date_absent=pid.inclusive_date) as assigned");
		
		$inclusive_dates->set_select("(SELECT bl.name FROM employees_absences ea JOIN benefits_list bl ON ea.leave_type=bl.id WHERE ea.name_id={$name_id} AND pid.inclusive_date=ea.date_absent) as leave_type");

		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_order('inclusive_date','ASC');
		$inclusive_dates->set_limit(0); 
		$this->template_data->set('inclusive_dates', $inclusive_dates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/dtr/dtr_absences', $this->template_data->get_data());
	}

	public function by_name($name_id,$start=0) {

		$this->_column_groups();
		
		$name = new $this->Names_list_model('nl');
		$name->setId($name_id, true);
		$name->set_select("nl.*");
		
		$name->set_join("names_info ni", "ni.name_id=nl.id");
		$name->set_select("ni.*");
		$name->set_select("(SELECT COUNT(*) FROM employees e WHERE e.name_id=nl.id AND e.trash=0) as is_employed");
		$name->set_select("(SELECT e.company_id FROM employees e WHERE e.name_id=nl.id) as company_id");

		$name_data = $name->get();	
		$this->template_data->set('name', $name_data);

		$payrolls = new $this->Payroll_employees_salaries_model('pes');
		$payrolls->set_start($start);
		$payrolls->setNameId($name_id,true);
		$payrolls->set_group_by('pes.payroll_id');
		$payrolls->set_join('payroll p', 'pes.payroll_id=p.id');
		$payrolls->set_select('p.*');
		$payrolls->set_select('pes.*');
		$payrolls->set_order('p.id', 'DESC');
		$payrolls->set_where('p.company_id=' . $this->session->userdata('current_company_id'));

			$absences = new $this->Employees_absences_model('ea');
			$absences->setNameId($name_id,true);
			$absences->set_join('payroll_inclusive_dates pid', 'ea.date_absent=pid.inclusive_date');
			$absences->set_select('SUM(ea.hours)');
			$absences->set_where('ea.name_id=pes.name_id');
			$absences->set_where('pid.payroll_id=pes.payroll_id');
			$payrolls->set_select('('.$absences->get_compiled_select().') as absences_hours');

		$payrolls->set_select('(SELECT COUNT(*) FROM payroll_inclusive_dates WHERE payroll_id=pes.payroll_id) as working_days');

		if( $this->input->get('filter_by_year') ) {
			$payrolls->set_limit(0);
			$payrolls->set_start(0);
			$payrolls->set_where('p.year=' . $this->input->get('filter_by_year'));
		}
		$this->template_data->set('payrolls', $payrolls->populate());

		$years = new $this->Payroll_employees_salaries_model('pes');
		$years->setNameId($name_id,true);
		$years->set_join('payroll p', 'pes.payroll_id=p.id');
		$years->set_select('p.year');
		$years->set_group_by('p.year');
		$years->set_order('p.year', 'DESC');
		$this->template_data->set('years', $years->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 4,
			'base_url' => base_url($this->config->item('index_page') . "/payroll_dtr/by_name/{$name_id}"),
			'total_rows' => $payrolls->count_all_results(),
			'per_page' => $payrolls->get_limit(),
			'ajax'=>true
		)));

		$this->template_data->set('next_name', $this->_next_employee($name_id, 'payroll_dtr/by_name/'));
		$this->template_data->set('previous_name', $this->_previous_employee($name_id, 'payroll_dtr/by_name/'));

		$this->load->view('payroll/payroll/dtr/dtr_by_name', $this->template_data->get_data());
	}

	public function attendance($id,$pe_id,$output='') {

		$employee = new $this->Payroll_employees_model('pe');
		$employee->setId($pe_id,true);
		$employee_data = $employee->get();

		$name_id = $employee_data->name_id;

		$this->_column_groups();
		$this->template_data->set('name_id', $name_id);
		$this->template_data->set('pe_id', $pe_id);

		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$inclusive_dates = new $this->Payroll_inclusive_dates_model('pid');
		$inclusive_dates->set_select("pid.*");
		
		$inclusive_dates->set_select("(SELECT COUNT(*) FROM employees_attendance ea WHERE ea.name_id={$name_id} AND pid.inclusive_date=ea.date_present AND ea.pe_id={$pe_id}) as present");

		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_order('inclusive_date','ASC');
		$inclusive_dates->set_limit(0); 
		$this->template_data->set('inclusive_dates', $inclusive_dates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/dtr/dtr_attendance', $this->template_data->get_data());
	}

}
