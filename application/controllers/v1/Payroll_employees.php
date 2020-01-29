<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_employees extends PAYROLL_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Payroll Employees');
		$this->template_data->set('current_uri', 'payroll_employees');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('payroll', 'payroll', 'view');

		if( !get_company_option($this->session->userdata('current_company_id'), 'column_group_employees') ) {
			redirect("welcome");
		}

		$this->session->set_userdata('page_session', 'payroll_employees');
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
	
		$inclusive_dates = new $this->Payroll_inclusive_dates_model;
		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_select('COUNT(*) as working_days');
		$inclusive_dates->set_select('MIN(inclusive_date) as start_date');
		$inclusive_dates->set_select('MAX(inclusive_date) as end_date');
		$dates_data = $inclusive_dates->get();
		$this->template_data->set('inclusive_dates', $dates_data);

		if( $dates_data->working_days > 0 ) {

			$print_groups = new $this->Terms_list_model;
			$print_groups->set_select("*");
			$print_groups->set_order('priority', 'ASC');
			$print_groups->set_order('name', 'ASC');
			$print_groups->set_limit(0);
			$print_groups->setTrash('0',true);
			$print_groups->setType('print_group',true);
			$this->template_data->set('print_groups', $print_groups->populate());
			
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
					//$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE position_id=pg.position_id) > 0)");
					$payroll_group->set_where("((SELECT COUNT(*) FROM payroll_employees WHERE payroll_id={$id} AND position_id=eg.id) > 0)");
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
					//$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE area_id=pg.area_id) > 0)");
					$payroll_group->set_where("((SELECT COUNT(*) FROM payroll_employees WHERE payroll_id={$id} AND area_id=eg.id) > 0)");
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
					//$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE status=pg.status_id) > 0)");
					$payroll_group->set_where("((SELECT COUNT(*) FROM payroll_employees WHERE payroll_id={$id} AND status_id=eg.id) > 0)");
					//$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
					$payroll_group_data =  $payroll_group->populate();

				break;
				case 'group':
				default:
					$payroll_group = new $this->Payroll_groups_model('pg');
					$payroll_group->setPayrollId($id,true);
					
					if( intval($group_id) > 0 ) {
						$payroll_group->setGroupId(intval($group_id),true);
					}

					$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
					$payroll_group->set_limit(0);
					$payroll_group->set_order('pg.order', 'DESC');
					//$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
					$payroll_group->set_where("((SELECT COUNT(*) FROM payroll_employees WHERE payroll_id={$id} AND group_id=eg.id) > 0)");
					$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
					$payroll_group_data =  $payroll_group->populate();

				//print_r( $payroll_group );
				break;
			}


			foreach($payroll_group_data as $key=>$group) {
				
				$employees = new $this->Payroll_employees_model('pe');
				if( $this->session->userdata('current_employee') ) {
					$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
				}
				$employees->setPayrollId($id,true);
				$employees->set_select('pe.*');
				$employees->set_select('pe.id as pe_id');
				$employees->set_select('ni.*');
				$employees->set_select('e.name_id');
				$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
				$employees->set_join('employees e', 'e.name_id=pe.name_id');

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

				$employees->set_select('(SELECT tl.name FROM terms_list tl WHERE tl.type="print_group" AND tl.id=pe.print_group) as print_group_name');

				$employees->set_select('(SELECT tl.name FROM terms_list tl WHERE tl.type="employment_status" AND tl.id=pe.status_id) as status_name');

				$employees->set_select('(SELECT eg.name FROM employees_groups eg WHERE eg.company_id='.$this->session->userdata('current_company_id').' AND eg.id=pe.group_id) as group_name');

				$employees->set_select('(SELECT ep.name FROM employees_positions ep WHERE ep.id=pe.position_id) as position_name');

				$employees->set_select('(SELECT ea.name FROM employees_areas ea WHERE ea.company_id='.$this->session->userdata('current_company_id').' AND ea.id=pe.area_id) as area_name');

				//$employees->set_select("(SELECT COUNT(*) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences");

				//$employees->set_select('(SELECT es.hours FROM employees_salaries es WHERE es.name_id=e.name_id AND es.primary=1 AND es.trash=0) as working_hours');

				//$employees->set_select("(SELECT SUM(ea.hours) FROM employees_absences ea WHERE ea.leave_type=0 AND ea.name_id=pe.name_id AND ea.date_absent >= '{$dates_data->start_date}' AND ea.date_absent <= '{$dates_data->end_date}') as absences_hours");
				
				// gross earnings
				//$employees->set_select("(SELECT SUM(pee.amount) FROM payroll_employees_earnings pee WHERE pee.payroll_id=pe.payroll_id AND pee.name_id=pe.name_id) as gross_earnings");

				// gross benefits
				//$employees->set_select("(SELECT SUM(peb.employee_share) FROM payroll_employees_benefits peb WHERE peb.payroll_id=pe.payroll_id AND peb.name_id=pe.name_id) as gross_benefits");

				// gross deductions
				//$employees->set_select("(SELECT SUM(ped.amount) FROM payroll_employees_deductions ped WHERE ped.payroll_id=pe.payroll_id AND ped.name_id=pe.name_id) as gross_deductions");

				$employees->setActive(1, true);
				$employees->set_order('pe.order', 'ASC');
				$employees->set_limit(0);
				$employees_data = $employees->populate();
				foreach( $employees_data as $eKey => $employee) {
					$salary = new $this->Payroll_employees_salaries_model('pes');
					$salary->setPayrollId($id,true);
					$salary->setNameId($employee->name_id,true);
					//$salary->set_join('employees_salaries es', 'es.id=pes.salary_id');
					//$salary->set_select('*, pes.amount as override');
					//$salary->set_where('es.trash', 0);
					$employees_data[$eKey]->salary = $salary->get();
				} 

				$payroll_group_data[$key]->employees = $employees_data;
			}
			$this->template_data->set('payroll_groups', $payroll_group_data);
			
			$this->_employee_filters($payroll_data);

			$employees2 = new $this->Payroll_employees_model('pe');
			$employees2->setPayrollId($id,true);
			$employees2->set_select('COUNT(*) as total');
			$employees2->setActive(1, true);
			
			switch( $payroll_data->group_by ) {
				case 'position':
					$employees2->set_where('(pe.position_id', 0, 98);
					$employees2->set_where_or('pe.position_id IS NULL)', NULL, 99);
				break;
				case 'area':
					$employees2->set_where('(pe.area_id', 0, 98);
					$employees2->set_where_or('pe.area_id IS NULL)', NULL, 99);
				break;
				case 'status':
					$employees2->set_where('(pe.status_id', 0, 98);
					$employees2->set_where_or('pe.status_id IS NULL)', NULL, 99);
				break;
				case 'group':
				default:
					$employees2->set_where('(pe.group_id', 0, 98);
					$employees2->set_where_or('pe.group_id IS NULL)', NULL, 99);
				break;
			}

			$this->template_data->set('uncategorized_employees', $employees2->get());

			$this->template_data->set('next_item', $this->_next_payroll($id, $group_id, 'payroll_employees/view/'));
			$this->template_data->set('previous_item', $this->_previous_payroll($id, $group_id, 'payroll_employees/view/'));

		} else {

			$this->template_data->set('no_inclusive_dates', true);

		}

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/employees_view', $this->template_data->get_data());
	}


	public function uncategorized($id,$output='') {


		$payroll = new $this->Payroll_model;
		$payroll->setId($id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get(); 
		$this->template_data->set('payroll', $payroll_data);

			$employees2 = new $this->Payroll_employees_model('pe');
			$employees2->setPayrollId($id,true);
			$employees2->setActive(1, true);
			$employees2->set_select('COUNT(*) as total');

			switch( $payroll_data->group_by ) {
				case 'position':
					$employees2->set_where('pe.position_id', 0);
					$employees2->set_where_or('pe.position_id IS NULL');
				break;
				case 'area':
					$employees2->set_where('pe.area_id', 0);
					$employees2->set_where_or('pe.area_id IS NULL');
				break;
				case 'status':
					$employees2->set_where('pe.status_id', 0);
					$employees2->set_where_or('pe.status_id IS NULL');
				break;
				case 'group':
				default:
					$employees2->set_where('pe.group_id', 0);
					$employees2->set_where_or('pe.group_id IS NULL');
				break;
			}

			$employees2_data = $employees2->get();
			if( $employees2_data->total == 0 ) {
				redirect("payroll_employees/view/{$id}/0");
			}
	
		$this->_column_groups();

		$inclusive_dates = new $this->Payroll_inclusive_dates_model;
		$inclusive_dates->setPayrollId($id,true);
		$inclusive_dates->set_select('COUNT(*) as working_days');
		$inclusive_dates->set_select('MIN(inclusive_date) as start_date');
		$inclusive_dates->set_select('MAX(inclusive_date) as end_date');
		$dates_data = $inclusive_dates->get();
		$this->template_data->set('inclusive_dates', $dates_data);

		if( $dates_data->working_days > 0 ) {		

			$employees = new $this->Payroll_employees_model('pe');
			$employees->setPayrollId($id,true);
			$employees->set_select('pe.*');
			$employees->set_select('pe.id as pe_id');
			$employees->set_select('ni.*');
			$employees->set_select('e.name_id');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');

			switch( $payroll_data->group_by ) {
				case 'position':
					$employees->set_where('(pe.position_id', 0, 100);
					$employees->set_where_or('pe.position_id IS NULL)', NULL, 101);
				break;
				case 'area':
					$employees->set_where('(pe.area_id', 0, 100);
					$employees->set_where_or('pe.area_id IS NULL)', NULL, 101);
				break;
				case 'status':
					$employees->set_where('(pe.status_id', 0, 100);
					$employees->set_where_or('pe.status_id IS NULL)', NULL, 101);
				break;
				case 'group':
				default:
					$employees->set_where('(pe.group_id', 0, 100);
					$employees->set_where_or('pe.group_id IS NULL)', NULL, 101);
				break;
			}

				$employees->set_select('(SELECT tl.name FROM terms_list tl WHERE tl.type="print_group" AND tl.id=pe.print_group) as print_group_name');

				$employees->set_select('(SELECT tl.name FROM terms_list tl WHERE tl.type="employment_status" AND tl.id=pe.status_id) as status_name');

				$employees->set_select('(SELECT eg.name FROM employees_groups eg WHERE eg.company_id='.$this->session->userdata('current_company_id').' AND eg.id=pe.group_id) as group_name');

				$employees->set_select('(SELECT ep.name FROM employees_positions ep WHERE ep.id=pe.position_id) as position_name');

				$employees->set_select('(SELECT ea.name FROM employees_areas ea WHERE ea.company_id='.$this->session->userdata('current_company_id').' AND ea.id=pe.area_id) as area_name');

				if( $this->input->get('show') == 'inactive' ) {
					$employees->setActive(0, true);
				} else {
					$employees->setActive(1, true);
				}
				$employees->set_order('pe.order', 'ASC');
				$employees->set_limit(0);

			$this->template_data->set('uncategorized_employees', $employees->populate());

			$this->_employee_filters($payroll_data);

			$this->template_data->set('next_item', $this->_next_payroll($id, 0, 'payroll_employees/uncategorized/'));
			$this->template_data->set('previous_item', $this->_previous_payroll($id, 0, 'payroll_employees/uncategorized/'));

		} else {

			$this->template_data->set('no_inclusive_dates', true);

		}

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/employees_uncategorized', $this->template_data->get_data());
	}

	public function activate($payroll_id, $pe_id, $output='') {
		$employees = new $this->Payroll_employees_model('pe');
		$employees->setPayrollId($payroll_id,true);
		$employees->setId($pe_id,true);
		$employees->setActive(1,false,true);
		$employees->update();
		redirect( $this->input->get('next') );
	}

	public function deactivate($payroll_id, $pe_id, $output='') {
		$employees = new $this->Payroll_employees_model('pe');
		$employees->setPayrollId($payroll_id,true);
		$employees->setId($pe_id,true);
		$employees->setActive(0,false,true);
		$employees->update();
		redirect( $this->input->get('next') );
	}

	public function change_status($payroll_id, $pe_id, $output='') {

		$this->_column_groups();
		$payroll = new $this->Payroll_model;
		$payroll->setId($payroll_id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$employee = new $this->Payroll_employees_model();
		$employee->setId($pe_id,true);
		$employee_data = $employee->get(); 

		$names = new $this->Names_list_model;
		$names->setId($employee_data->name_id, true);
		$names->setTrash(0,true);
		$names->set_join('names_info', 'names_info.name_id=names_list.id');
		$this->template_data->set('name', $names->get());

		$terms = new $this->Terms_list_model;
		$terms->set_select("*");
		$terms->set_order('priority', 'ASC');
		$terms->set_order('name', 'ASC');
		$terms->set_start(0);
		$terms->setTrash('0',true);
		$terms->setType('employment_status',true);
		$this->template_data->set('employment_status', $terms->populate());
		
		if( $this->input->post('status') ) {
			$employee->setStatusId($this->input->post('status'),false,true);
			$employee->update();
			redirect( $this->input->get('next') );
		}

		$employee->set_select('*');
		$this->template_data->set('employee', $employee->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/change_status', $this->template_data->get_data());
	}

	public function change_group($payroll_id, $pe_id, $output='') {

		$this->_column_groups();
		$payroll = new $this->Payroll_model;
		$payroll->setId($payroll_id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$employee = new $this->Payroll_employees_model();
		$employee->setId($pe_id,true);
		$employee_data = $employee->get();

		$names = new $this->Names_list_model;
		$names->setId($employee_data->name_id, true);
		$names->setTrash(0,true);
		$names->set_join('names_info', 'names_info.name_id=names_list.id');
		$this->template_data->set('name', $names->get());

		$groups = new $this->Employees_groups_model;
		$groups->setCompanyId($this->session->userdata('current_company_id'),true);
		$groups->setTrash('0',true);
		$groups->set_limit(0);
		$groups->set_order('name', 'ASC');
		$this->template_data->set('groups', $groups->populate());
	

		if( $this->input->post('group_id') ) {
			$employee->setGroupId($this->input->post('group_id'),false,true);
			$employee->update();
			redirect( $this->input->get('next') );
		}

		$employee->set_select('*');
		$this->template_data->set('employee', $employee->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/change_group', $this->template_data->get_data());
	}

	public function change_position($payroll_id, $pe_id, $output='') {

		$this->_column_groups();
		$payroll = new $this->Payroll_model;
		$payroll->setId($payroll_id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$employee = new $this->Payroll_employees_model();
		$employee->setId($pe_id,true);
		$employee_data = $employee->get();

		$names = new $this->Names_list_model;
		$names->setId($employee_data->name_id, true);
		$names->setTrash(0,true);
		$names->set_join('names_info', 'names_info.name_id=names_list.id');
		$this->template_data->set('name', $names->get());

		$positions = new $this->Employees_positions_model;
		$positions->setCompanyId($this->session->userdata('current_company_id'),true);
		$positions->set_limit(0);
		$positions->set_order('name', 'ASC');
		$this->template_data->set('positions', $positions->populate());
		

		if( $this->input->post('position_id') ) {
			$employee->setPositionId($this->input->post('position_id'),false,true);
			$employee->update();
			redirect( $this->input->get('next') );
		}

		$employee->set_select('*');
		$this->template_data->set('employee', $employee->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/change_position', $this->template_data->get_data());
	}

	public function change_area($payroll_id, $pe_id, $output='') {

		$this->_column_groups();
		$payroll = new $this->Payroll_model;
		$payroll->setId($payroll_id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$employee = new $this->Payroll_employees_model();
		$employee->setId($pe_id,true);
		$employee_data = $employee->get();

		$names = new $this->Names_list_model;
		$names->setId($employee_data->name_id, true);
		$names->setTrash(0,true);
		$names->set_join('names_info', 'names_info.name_id=names_list.id');
		$this->template_data->set('name', $names->get());

		$areas = new $this->Employees_areas_model;
		$areas->setCompanyId($this->session->userdata('current_company_id'),true);
		$areas->set_limit(0);
		$areas->set_order('name', 'ASC');
		$this->template_data->set('areas', $areas->populate());
	

		if( $this->input->post('area_id') ) {
			$employee->setAreaId($this->input->post('area_id'),false,true);
			$employee->update();
			redirect( $this->input->get('next') );
		}

		$employee->set_select('*');
		$this->template_data->set('employee', $employee->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/change_area', $this->template_data->get_data());
	}

	public function change_payslip($payroll_id, $pe_id, $output='') {

		$employee = new $this->Payroll_employees_model();
		$employee->setId($pe_id,true);
		$employee_data = $employee->get();

		if( $this->input->post() ) { 
			if( $this->input->post('payslip') ) {
				$employee->setTemplate($this->input->post('payslip'),false,true);
			} else {
				$employee->setTemplate('',false,true);
			}
			$employee->update();

			if( $this->input->post('update_template') ) {
				$template = new $this->Payroll_templates_employees_model();
				$template->setTemplateId($this->input->post('update_template'),true);
				$template->setNameId($employee_data->name_id,true);
				$template->setTemplate($this->input->post('payslip'),false,true);
				$template->update();
			}

			$this->getNext();
		}

		$this->_column_groups();
		$payroll = new $this->Payroll_model;
		$payroll->setId($payroll_id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll->set_select("(SELECT pt.name FROM `payroll_templates` pt WHERE pt.id=payroll.template_id) as template_name");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$names = new $this->Names_list_model;
		$names->setId($employee_data->name_id, true);
		$names->setTrash(0,true);
		$names->set_join('names_info', 'names_info.name_id=names_list.id');
		$this->template_data->set('name', $names->get());

		$terms = new $this->Terms_list_model;
		$terms->set_select("*");
		$terms->set_order('priority', 'ASC');
		$terms->set_order('name', 'ASC');
		$terms->set_start(0);
		$terms->setTrash('0',true);
		$terms->setType('employment_status',true);
		$this->template_data->set('employment_status', $terms->populate());
	

		$employee->set_select('*');
		$this->template_data->set('employee', $employee->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/change_payslip', $this->template_data->get_data());
	}

	public function change_print_group($payroll_id, $pe_id, $output='') {

		$this->_column_groups();
		$payroll = new $this->Payroll_model;
		$payroll->setId($payroll_id,true);
		$payroll->set_select("*");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_earnings` pe WHERE pe.payroll_id=payroll.id) as earnings_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_benefits` pb WHERE pb.payroll_id=payroll.id) as benefits_columns");
		$payroll->set_select("(SELECT COUNT(*) FROM `payroll_deductions` pd WHERE pd.payroll_id=payroll.id) as deductions_columns");
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$employee = new $this->Payroll_employees_model();
		$employee->setId($pe_id,true);
		$employee_data = $employee->get();

		$names = new $this->Names_list_model;
		$names->setId($employee_data->name_id, true);
		$names->setTrash(0,true);
		$names->set_join('names_info', 'names_info.name_id=names_list.id');
		$this->template_data->set('name', $names->get());

		$terms = new $this->Terms_list_model;
		$terms->set_select("*");
		$terms->set_order('priority', 'ASC');
		$terms->set_order('name', 'ASC');
		$terms->set_start(0);
		$terms->setTrash('0',true);
		$terms->setType('print_group',true);
		$this->template_data->set('print_groups', $terms->populate());
		
		if( $this->input->post('print_group') ) {
			$employee->setPrintGroup($this->input->post('print_group'),false,true);
			$employee->update();
			redirect( $this->input->get('next') );
		}

		$employee->set_select('*');
		$this->template_data->set('employee', $employee->get());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/change_print_group', $this->template_data->get_data());
	}

	public function preview($template_id,$group_id=0,$output='') {

		$this->_column_groups();
		$this->template_data->set('group_id', $group_id);
	
		$template = new $this->Payroll_templates_model;
		$template->setId($template_id,true);
		$template->set_select("*");
		$template->set_select("(SELECT COUNT(*) FROM `payroll_templates_earnings` pe WHERE pe.template_id=payroll_templates.id) as earnings_columns");
		$template->set_select("(SELECT COUNT(*) FROM `payroll_templates_benefits` pb WHERE pb.template_id=payroll_templates.id) as benefits_columns");
		$template->set_select("(SELECT COUNT(*) FROM `payroll_templates_deductions` pd WHERE pd.template_id=payroll_templates.id) as deductions_columns");
		$template_data = $template->get();
		$this->template_data->set('template', $template_data);
	
		switch( $template_data->group_by ) {
			case 'position':

				$payroll_group = new $this->Payroll_templates_groups_model('pg');
				$payroll_group->setTemplateId($template_id,true);
				
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

				$payroll_group = new $this->Payroll_templates_groups_model('pg');
				$payroll_group->setTemplateId($template_id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setAreaId(intval($group_id),true);
				}

				$payroll_group->set_join('employees_areas ea', 'pg.area_id=ea.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees e WHERE e.area_id=pg.area_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_areas WHERE id=pg.area_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();

			break;
			case 'status':

				$payroll_group = new $this->Payroll_templates_groups_model('pg');
				$payroll_group->setTemplateId($template_id,true);
				
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
			default:
				$payroll_group = new $this->Payroll_templates_groups_model('pg');
				$payroll_group->setTemplateId($template_id,true);
				
				if( intval($group_id) > 0 ) {
					$payroll_group->setGroupId(intval($group_id),true);
				}

				$payroll_group->set_join('employees_groups eg', 'pg.group_id=eg.id');
				$payroll_group->set_limit(0);
				$payroll_group->set_order('pg.order', 'DESC');
				$payroll_group->set_where("((SELECT COUNT(*) FROM employees WHERE group_id=pg.group_id) > 0)");
				$payroll_group->set_where("((SELECT company_id FROM employees_groups WHERE id=pg.group_id) = {$this->session->userdata('current_company_id')})");
				$payroll_group_data =  $payroll_group->populate();


			break;
		}

		foreach($payroll_group_data as $key=>$group) { 

			$employees = new $this->Payroll_templates_employees_model('pe');
			$employees->setTemplateId($template_id,true);
			$employees->set_select('ni.*');
			$employees->set_select('e.hired');
			$employees->set_join('names_info ni', 'ni.name_id=pe.name_id');
			$employees->set_join('employees e', 'e.name_id=pe.name_id');

			switch( $template_data->group_by ) {
				case 'position':
					$employees->set_where('e.position_id', $group->position_id);
				break;
				case 'area':
					$employees->set_where('e.area_id', $group->area_id);
				break;
				case 'status':
					$employees->set_where('e.status', $group->status_id);
				break;
				case 'group':
				default:
					$employees->set_where('e.group_id', $group->group_id);
				break;
			}

			$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position');

			if( $this->session->userdata('current_employee') ) {
				$employees->setNameId($this->session->userdata('current_employee')->name_id,true);
			}

			if( $this->session->userdata('employees_status') ) {
				$employees->set_where('e.status', $this->session->userdata('employees_status')->id);
			}

			$employees->set_select('(SELECT tl.name FROM terms_list tl WHERE tl.type="print_group" AND tl.id=pe.print_group) as print_group_name');

			$employees->set_select('(SELECT tl.name FROM terms_list tl WHERE tl.type="employment_status" AND tl.id=e.status) as status_name');

			$employees->set_select('(SELECT eg.name FROM employees_groups eg WHERE eg.company_id='.$this->session->userdata('current_company_id').' AND eg.id=e.group_id) as group_name');

			$employees->set_select('(SELECT ep.name FROM employees_positions ep WHERE ep.id=e.position_id) as position_name');

			$employees->set_select('(SELECT ea.name FROM employees_areas ea WHERE ea.company_id='.$this->session->userdata('current_company_id').' AND ea.id=e.area_id) as area_name');
			
			$employees->set_select("pe.template");
			$employees->setActive(1, true);
			$employees->set_order('pe.order', 'ASC');
			$employees->set_limit(0);
			$employees_data = $employees->populate();

			$payroll_group_data[$key]->employees = $employees_data;
		}

		$this->template_data->set('payroll_groups', $payroll_group_data);
		
		$employees_status = new $this->Payroll_templates_employees_model('pe');
		$employees_status->setTemplateId($template_id,true);
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
		
		$print_groups = new $this->Terms_list_model;
		$print_groups->set_select("*");
		$print_groups->set_order('priority', 'ASC');
		$print_groups->set_order('name', 'ASC');
		$print_groups->set_limit(0);
		$print_groups->setTrash('0',true);
		$print_groups->setType('print_group',true);
		$this->template_data->set('print_groups', $print_groups->populate());

		$templates = new $this->Payroll_templates_model;
		$templates->setCompanyId($this->session->userdata('current_company_id'),true);
		$templates->setActive('1', true);
		$templates->set_select('*');
		$templates->set_limit(0);
		$this->template_data->set('templates', $templates->populate());

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/employees_preview', $this->template_data->get_data());
	}

	public function dtr_settings($payroll_id, $pe_id, $output='') {

		$this->_column_groups();

		$payroll = new $this->Payroll_model;
		$payroll->setId($payroll_id,true);
		$payroll_data = $payroll->get();
		$this->template_data->set('payroll', $payroll_data);

		$employee = new $this->Payroll_employees_model();
		$employee->setId($pe_id, true);
		$employee_data = $employee->get();

		if( $this->input->post() ) {
			$employee->setPresence( (($this->input->post('attendance_method')) ? 1 : 0), false, true );
			$employee->update();
			redirect( $this->input->get('next') );
		}
		$this->template_data->set('employee', $employee_data);

		$this->template_data->set('output', $output);
		$this->load->view('payroll/payroll/employees/dtr_settings', $this->template_data->get_data());
	}

}
