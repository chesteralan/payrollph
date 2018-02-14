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

	}

	public function index($start=0) {

		$employees = new $this->Employees_model('e');
		if( $this->input->get('q') ) {
			$employees->set_where('(ni.lastname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('ni.firstname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('ni.middlename LIKE "%' . $this->input->get('q') . '%")', NULL, 99);
		}
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setTrash(0,true);
		$employees->set_select('e.*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=e.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position_name');
		$employees->set_select('(SELECT name FROM employees_areas WHERE id=e.area_id) as area_name');
		$employees->set_select('(SELECT name FROM terms_list WHERE id=e.status) as status_name');

		$employees->set_join('names_info ni','ni.name_id=e.name_id');
		$employees->set_select('ni.lastname as lastname');
		$employees->set_select('ni.firstname as firstname');
		$employees->set_select('ni.middlename as middlename');

		$employees->set_order('ni.lastname', 'ASC');
		$employees->set_start($start);

		$this->template_data->set('employees', $employees->populate());
		$this->template_data->set('employees_count', $employees->count_all_results());

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

		$employees = new $this->Employees_model('e');
		if( $this->input->get('q') ) {
			$employees->set_where('(ni.lastname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('ni.firstname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('ni.middlename LIKE "%' . $this->input->get('q') . '%")', NULL, 99);
		}
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setGroupId($id,true);
		$employees->set_select('e.*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=e.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position_name');
		$employees->set_select('(SELECT name FROM employees_areas WHERE id=e.area_id) as area_name');
		$employees->set_select('(SELECT name FROM terms_list WHERE id=e.status) as status_name');
		
		$employees->set_join('names_info ni','ni.name_id=e.name_id');
		$employees->set_select('ni.lastname as lastname');
		$employees->set_select('ni.firstname as firstname');
		$employees->set_select('ni.middlename as middlename');

		$employees->set_order('ni.lastname', 'ASC');

		$employees->set_start($start);
		$this->template_data->set('employees', $employees->populate());
		$this->template_data->set('employees_count', $employees->count_all_results());

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

		$employees = new $this->Employees_model('e');
		if( $this->input->get('q') ) {
			$employees->set_where('(ni.lastname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('ni.firstname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('ni.middlename LIKE "%' . $this->input->get('q') . '%")', NULL, 99);
		}
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setPositionId($id,true);
		$employees->set_select('e.*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=e.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position_name');
		$employees->set_select('(SELECT name FROM employees_areas WHERE id=e.area_id) as area_name');
		$employees->set_select('(SELECT name FROM terms_list WHERE id=e.status) as status_name');
		$employees->set_join('names_info ni','ni.name_id=e.name_id');
		$employees->set_select('ni.lastname as lastname');
		$employees->set_select('ni.firstname as firstname');
		$employees->set_select('ni.middlename as middlename');
		$employees->set_order('ni.lastname', 'ASC');
		$employees->set_start($start);
		$this->template_data->set('employees', $employees->populate());
		$this->template_data->set('employees_count', $employees->count_all_results());

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

		$employees = new $this->Employees_model('e');
		if( $this->input->get('q') ) {
			$employees->set_where('(lastname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('firstname LIKE "%' . $this->input->get('q') . '%"', NULL, 99);
			$employees->set_where_or('middlename LIKE "%' . $this->input->get('q') . '%")', NULL, 99);
		}
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setAreaId($id,true);
		$employees->set_select('e.*');
		$employees->set_select('(SELECT name FROM employees_groups WHERE id=e.group_id) as group_name');
		$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position_name');
		$employees->set_select('(SELECT name FROM employees_areas WHERE id=e.area_id) as area_name');
		$employees->set_select('(SELECT name FROM terms_list WHERE id=e.status) as status_name');
		$employees->set_join('names_info ni','ni.name_id=e.name_id');
		$employees->set_select('ni.lastname as lastname');
		$employees->set_select('ni.firstname as firstname');
		$employees->set_select('ni.middlename as middlename');
		$employees->set_order('ni.lastname', 'ASC');
		$employees->set_start($start);
		$this->template_data->set('employees', $employees->populate());
		$this->template_data->set('employees_count', $employees->count_all_results());

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
		$names->setTrash(0,true);
		$names->set_join('names_info', 'names_info.name_id=names_list.id');
		$this->template_data->set('name', $names->get());

		if( $names->nonEmpty() ) {
			if( $this->input->post('action') == 'add' ) {
				$employee = new $this->Employees_model;
				$employee->setNameId($id);
				$employee->setGroupId($this->input->post('group_id'));
				$employee->setPositionId($this->input->post('position_id'));
				$employee->setAreaId($this->input->post('area_id'));
				$employee->setCompanyId($this->session->userdata('current_company_id'));
				$employee->setTrash(0);
				$employee->insert();
				$this->postNext();
			}
		}


		$groups = new $this->Employees_groups_model;
		$groups->setCompanyId($this->session->userdata('current_company_id'),true);
		$groups->set_limit(0);
		$groups->set_order('name', 'ASC');
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
		$names->setTrash(0,true);
		$names->set_order('names_list.full_name', 'ASC');
		$names->set_where('((SELECT COUNT(*) FROM `employees` WHERE name_id=names_list.id) = 0)');
		$names->set_where('((SELECT COUNT(*) FROM `names_info` WHERE name_id=names_list.id) = 1)');
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
				$this->form_validation->set_rules('middlename', 'Middle Name', 'trim');
				if( $this->form_validation->run() ) {
					$employee->setLastname($this->input->post('lastname'),false,true);
					$employee->setFirstname($this->input->post('firstname'),false,true);
					$employee->setMiddlename($this->input->post('middlename'),false,true);
					$employee->setBirthday( date("Y-m-d", strtotime($this->input->post('birthday'))),false,true);
					$employee->setBirthplace($this->input->post('birthplace'),false,true);
					$employee->setGender($this->input->post('gender'),false,true);
					$employee->setCivilStatus($this->input->post('civil_status'),false,true);
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
					$employee->setEmployeeId($this->input->post('employee_id'),false,true);
					$employee->update();
				}
				$this->postNext("active=employment");
			}
		}
		$employee_data = $employee->get();
		$this->template_data->set('employee', $employee_data);

		$company_id = ($employee_data->company_id > 0) ? $employee_data->company_id : $this->session->userdata('current_company_id');

		$groups = new $this->Employees_groups_model;
		$groups->setCompanyId($company_id,true);
		$groups->set_limit(0);
		$groups->set_order('name', 'ASC');
		$this->template_data->set('groups', $groups->populate());

		$positions = new $this->Employees_positions_model;
		$positions->setCompanyId($company_id,true);
		$positions->set_limit(0);
		$positions->set_order('name', 'ASC');
		$this->template_data->set('positions', $positions->populate());

		$areas = new $this->Employees_areas_model;
		$areas->setCompanyId($company_id,true);
		$areas->set_limit(0);
		$areas->set_order('name', 'ASC');
		$this->template_data->set('areas', $areas->populate());

		$companies = new $this->Companies_list_model;
		$companies->setTrash(0,true);
		$companies->set_order('name', 'ASC');
		$companies->set_limit(0);
		$this->template_data->set('companies', $companies->populate());

		$terms = new $this->Terms_list_model;
		$terms->set_select("*");
		$terms->set_order('priority', 'ASC');
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

		$employee = new $this->Employees_contacts_model;
		$employee->setNameId($id,true);

		
		if( $this->input->post() ) {
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim');
			$this->form_validation->set_rules('cell_number', 'Cellphone Number', 'trim');
			$this->form_validation->set_rules('address', 'Address', 'trim');
			if( $this->form_validation->run() ) {
				$employee->setPhoneNumber($this->input->post('phone_number'),false,true);
				$employee->setCellNumber($this->input->post('cell_number'),false,true);
				$employee->setAddress($this->input->post('address'),false,true);
				if($employee->nonEmpty()) {
					$employee->update();
				} else {
					$employee->setNameId($id,true,true);
					$employee->insert();
				}
			}
			$this->postNext();
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

	public function edit_leave_benefits($id,$selected_year=NULL,$output='') {

		$this->template_data->set('selected_year', $selected_year);

		$employee = new $this->Employees_model;
		$employee->setNameId($id,true);
		$employee_data = $employee->get();
		$this->template_data->set('employee', $employee_data);

		if( $selected_year ) {
			if( $this->input->post('leave') ) {
				foreach($this->input->post('leave') as $benefit_id=>$days) {
					$leave_b = new $this->Employees_leave_benefits_model('elb');
					$leave_b->setCompanyId($employee_data->company_id,true);
					$leave_b->setNameId($employee_data->name_id,true);
					$leave_b->setBenefitId($benefit_id,true);
					$leave_b->setYear($selected_year,true);

					if( $leave_b->nonEmpty() ) {
						$leave_b->setDays($days,false,true);
						$leave_b->update();
					} else {
						$leave_b->setDays($days);
						$leave_b->insert();
					}
				}
				$this->postNext();
			}
			
			$leave = new $this->Benefits_list_model('b');
			$leave->setLeave(1,true);
			$leave->setTrash(0,true);
			$leave->set_select("*");
			$leave->set_select("(SELECT elb.days FROM employees_leave_benefits elb WHERE elb.name_id={$employee_data->name_id} AND elb.company_id={$employee_data->company_id} AND b.id=elb.benefit_id AND elb.year='{$selected_year}' LIMIT 1) as days");
			$this->template_data->set('leaves', $leave->populate());
		}

		$payroll_years = new $this->Payroll_model;
		$payroll_years->setCompanyId($this->session->userdata('current_company_id'),true);
		$payroll_years->set_select('year');
		$payroll_years->set_group_by('year');
		$payroll_years->set_order('year', 'DESC');
		$payroll_years->set_limit(0);
		$this->template_data->set('payroll_years', $payroll_years->populate());

		$this->template_data->set('output', $output);
		$this->load->view('employees/employees/employees_edit_leave_benefits', $this->template_data->get_data());
	}

	private function _employee_columns($employees, $columns) {
					
					$columns = ($columns) ? $columns : array();
					// personal info
					$employees->set_select('ni.*');
					if( in_array('age', $columns)) {
						$employees->set_select("(TIMESTAMPDIFF(YEAR, ni.birthday, CURDATE())) as age");
					}

					// employment info
					if( in_array('emp_group', $columns)) {
						$employees->set_select('(SELECT name FROM employees_groups WHERE id=e.group_id) as group_name');
					}
					if( in_array('emp_position', $columns)) {
						$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position_name');
					}
					if( in_array('emp_area', $columns)) {
						$employees->set_select('(SELECT name FROM employees_areas WHERE id=e.area_id) as area_name');
					}
					if( in_array('emp_status', $columns)) {
						$employees->set_select('(SELECT name FROM terms_list WHERE id=e.status) as status_name');
					}

					if( in_array('contact_address', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="address") as address');
					}
					if( in_array('contact_email', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="email") as email');
					}
					if( in_array('contact_phone', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="phone_number") as phone_number');
					}
					if( in_array('contact_smart', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="cell_smart") as cell_smart');
					}
					if( in_array('contact_globe', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="cell_globe") as cell_globe');
					}
					if( in_array('contact_sun', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="cell_sun") as cell_sun');
					}

					if( in_array('sm_facebook', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="facebook_id") as facebook_id');
					}
					if( in_array('sm_twitter', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="twitter_id") as twitter_id');
					}
					if( in_array('sm_instagram', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="instagram_id") as instagram_id');
					}
					if( in_array('sm_skype', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="skype_id") as skype_id');
					}
					if( in_array('sm_yahoo', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="yahoo_id") as yahoo_id');
					}
					if( in_array('sm_google', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="google_id") as google_id');
					}

					if( in_array('idn_tin', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="tin") as tin');
					}
					if( in_array('idn_sss', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="sss") as sss');
					}
					if( in_array('idn_hdmf', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="hdmf") as hdmf');
					}
					if( in_array('idn_phic', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="phic") as phic');
					}
					if( in_array('idn_driver', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="drivers_license") as drivers_license');
					}
					if( in_array('idn_voter', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="voters_number") as voters_number');
					}

					if( in_array('emergency_name', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="emergency_name") as emergency_name');
					}
					if( in_array('emergency_address', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="emergency_address") as emergency_address');
					}
					if( in_array('emergency_number', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="emergency_contact") as emergency_contact');
					}
					if( in_array('emergency_rel', $columns)) {
						$employees->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="emergency_relationship") as emergency_relationship');
					}
					return $employees;
	}

	public function report($page='config', $output='') {
	
		$this->template_data->set('page', $page);
		$this->template_data->set('output', $output);

		$employees = new $this->Employees_model('e');
		$employees->setCompanyId($this->session->userdata('current_company_id'),true);
		$employees->setTrash(0,true);
		
				$employees->set_join('names_info ni','ni.name_id=e.name_id');
				$employees->set_select('ni.lastname as lastname');
				$employees->set_select('ni.firstname as firstname');
				$employees->set_select('ni.middlename as middlename');

				$employees->set_limit(0);
				$employees->set_order('ni.lastname', 'ASC');
				$employees->set_order('ni.firstname', 'ASC');
				$employees->set_order('ni.middlename', 'ASC');
		switch( $page ) {
			case 'display':
				if($this->input->get('employee')) {
					
					$employees->set_select('e.*');

					$this->_employee_columns($employees, $this->input->get('columns'));

					$employees->set_where_in('e.name_id', $this->input->get('employee'));
					$this->template_data->set('employees', $employees->populate());
				}
				$this->load->view('employees/employees/employees_report_display', $this->template_data->get_data());
			break;
			case 'download':
				if($this->input->get('employee')) {
					
					$employees->set_select('e.*');

					$this->_employee_columns($employees, $this->input->get('columns'));

					$employees->set_where_in('e.name_id', $this->input->get('employee'));
					$this->template_data->set('employees', $employees->populate());
				}

				$company = new $this->Companies_list_model;
				$company->setId($this->session->userdata('current_company_id'),true);
				$company_data = $company->get();
				$filename = url_title($company_data->name)."-Employees-Report.xls";

				$this->output->set_content_type('application/vnd-ms-excel');
				$this->output->set_header('Content-Disposition: attachment; filename=' . $filename);
				$this->load->view('employees/employees/employees_report_xls', $this->template_data->get_data());
			break;
			case 'config':
			default:

				if($this->input->post()) {
					redirect( site_url("employees/report/display") . "?" . http_build_query($this->input->post()) );
					exit;
				}

				$employees->set_select('e.*');
				//$employees->set_select('(SELECT name FROM employees_groups WHERE id=e.group_id) as group_name');
				//$employees->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position_name');
				//$employees->set_select('(SELECT name FROM employees_areas WHERE id=e.area_id) as area_name');
				//$employees->set_select('(SELECT name FROM terms_list WHERE id=e.status) as status_name');

				$employees->set_order('ni.lastname', 'ASC');
				$employees->set_limit(0);
				$this->template_data->set('employees', $employees->populate());
				$this->load->view('employees/employees/employees_report_config', $this->template_data->get_data());
			break;
		}

	}

}
