<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index() {

		//$stats = new $this->User_accounts_model('ua');
		//$stats->set_select('(SELECT count(*) FROM user_accounts) as users_count');
		//$this->template_data->set('stats', $stats->get());

		$companies = new $this->User_accounts_companies_model('uc');
		$companies->setUid($this->session->userdata('user_id'),true);
		$companies->set_join('companies_list cl', 'uc.company_id=cl.id');
		$companies->set_select('cl.*');
		$companies->set_where('cl.id !=' . $this->session->userdata( 'current_company_id') );
		$this->template_data->set('companies', $companies->populate());

		$this->load->view('welcome/welcome', $this->template_data->get_data());
	}

	public function select_company($id=NULL,$output='') {

		$companies = new $this->User_accounts_companies_model('uc');
		$companies->setUid($this->session->userdata('user_id'),true);
		$companies->set_join('companies_list cl', 'uc.company_id=cl.id');
		$companies->set_select('cl.*');
		if($id) {
			$companies->set_where('cl.id', $id);
			if( $companies->nonEmpty() ) {
				$company =  $companies->getResults();
				$this->session->set_userdata( 'current_company', $company->name );
				$this->session->set_userdata( 'current_company_id', $company->id );
				$this->session->set_userdata( 'current_company_theme', $company->theme );
				$this->session->set_userdata('employees_status', false);
				redirect(site_url('welcome'));
			} else {
				redirect(site_url('welcome/select_company'));
			}
		}
		$companies->set_where('cl.id !=' . $this->session->userdata( 'current_company_id') );
		$this->template_data->set('companies', $companies->populate());

		$this->template_data->set( 'output', $output );
		$this->load->view('welcome/select_company', $this->template_data->get_data());
	}

	public function change_company($company_id) {
		$default_company = new $this->Companies_list_model;
		$default_company->setId($company_id,true);
		if( $default_company->nonEmpty() ) {
				$company = $default_company->getResults();
				$this->session->set_userdata( 'current_company', $company->name );
				$this->session->set_userdata( 'current_company_id', $company->id );
				$this->session->set_userdata( 'current_company_theme', $company->theme );
				$this->session->set_userdata('employees_status', false);
		}
		redirect("welcome");
	}

	public function change_current_theme($theme) {
		$this->session->set_userdata( 'current_company_theme', $theme );
		redirect( $this->input->get('uri') );
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

				$ctrl = 'employee';
				if( strpos($this->input->get('uri_string'), 'employees_earnings') ) {
					$ctrl = 'employees_earnings';
				}
				elseif( strpos($this->input->get('uri_string'), 'employees_benefits') ) {
					$ctrl = 'employees_benefits';
				}
				elseif( strpos($this->input->get('uri_string'), 'employees_deductions') ) {
					$ctrl = 'employees_deductions';
				}
				elseif( strpos($this->input->get('uri_string'), 'employees_salaries') ) {
					$ctrl = 'employees_salaries';
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
