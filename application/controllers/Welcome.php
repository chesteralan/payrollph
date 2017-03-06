<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('User_accounts_model');
		$this->load->model('Employees_model');
		$this->load->model('Companies_list_model');
	}

	public function index() {

		$stats = new $this->User_accounts_model('ua');
		$stats->set_select('(SELECT count(*) FROM user_accounts) as users_count');
		$this->template_data->set('stats', $stats->get());

		$companies = new $this->Companies_list_model;
		$companies->setTrash(0,true);
		$companies->set_order('name', 'ASC');
		$companies->set_limit(0);
		$companies->set_where('id !=' . $this->session->userdata( 'current_company_id') );
		$this->template_data->set('companies', $companies->populate());

		$this->load->view('welcome/welcome', $this->template_data->get_data());
	}

	public function change_company($company_id) {
		$default_company = new $this->Companies_list_model;
		$default_company->setId($company_id,true);
		if( $default_company->nonEmpty() ) {
				$company = $default_company->getResults();
				$this->session->set_userdata( 'current_company', $company->name );
				$this->session->set_userdata( 'current_company_id', $company->id );
		}
		redirect("welcome");
	}

	public function ajax($action='') {
		$results = array();
		switch($action) {
			case 'search_employee':

				if( ! $this->_isAuth('employees', 'employees', 'view', 'welcome', true) ) {
					break;
				}

				$employees = new $this->Employees_model;

				if( $this->input->get('term') ) {
					$employees->set_where('lastname LIKE "%' . $this->input->get('term') . '%"');
					$employees->set_where_or('firstname LIKE "%' . $this->input->get('term') . '%"');
					$employees->set_where_or('middlename LIKE "%' . $this->input->get('term') . '%"');
				}

				$employees->set_order('lastname', 'ASC');
				$employees->set_order('firstname', 'ASC');
				$employees->set_order('middlename', 'ASC');
				$employees->set_limit(0); 

				$ctrl = 'employees_salaries';
				if( strpos($this->input->get('uri_string'), 'employees_earnings') ) {
					$ctrl = 'employees_earnings';
				}
				elseif( strpos($this->input->get('uri_string'), 'employees_benefits') ) {
					$ctrl = 'employees_benefits';
				}
				elseif( strpos($this->input->get('uri_string'), 'employees_deductions') ) {
					$ctrl = 'employees_deductions';
				}
				foreach($employees->populate() as $employee) {
					$results[] = array(
						'label' => $employee->lastname . ", " . $employee->firstname. " " . substr($employee->middlename,0,1).".",
						'id' => $employee->name_id,
						'redirect'=> site_url( $ctrl . '/view/' . $employee->name_id ),
						);
				}
			break;
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode( $results ));
	}

}
