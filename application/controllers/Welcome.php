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
		
		if( $this->config->item('multi_company') ) {
			$companies = new $this->User_accounts_companies_model('uc');
			$companies->setUid($this->session->userdata('user_id'),true);
			$companies->set_join('companies_list cl', 'uc.company_id=cl.id');
			$companies->set_select('cl.*');
			$companies->set_where('cl.id !=' . $this->session->userdata( 'current_company_id') );
			$this->template_data->set('companies', $companies->populate());
		}

		$birthdays = new $this->Names_info_model('ni');
		$birthdays->set_where('(MONTH(ni.birthday)=MONTH(CURDATE()))');
		$birthdays->set_where('e.company_id', $this->session->userdata( 'current_company_id'));
		$birthdays->set_join('employees e', 'e.name_id=ni.name_id');
		$birthdays->set_order('(DAY(ni.birthday))', 'ASC');
		$birthdays->set_select("ni.*");
		$birthdays->set_select("(TIMESTAMPDIFF(YEAR, ni.birthday, CURDATE())) as age");
		$this->template_data->set('birthdays', $birthdays->populate());

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
				$this->session->set_userdata('current_payroll', false );
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

	public function change_password($output='')
	{

		$this->template_data->set('page_title', 'Change Password');

		if( count($this->input->post()) > 0 ) {
			$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
			$this->form_validation->set_rules('repeat_password', 'Repeat Password', 'trim|required|matches[new_password]');
			if( $this->form_validation->run() != FALSE) {
				$account = new $this->User_accounts_model;
				$account->setId($this->session->user_id,true);
				$account->setPassword(sha1($this->input->post('new_password'))); 
				$account->set_where('password LIKE', sha1($this->input->post('current_password')));
				if( $account->nonEmpty() ) {
					$account->set_exclude( array('id', 'username', 'name') );
					$account->update();
					//redirect(site_url('account/change_password') . "?success=true");
				} else {
					//redirect(site_url('account/change_password') . "?error=true");
				}
			}
			$this->postNext(NULL, $output);
		}

		$this->template_data->set( 'output', $output );
		$this->load->view('account/change_password', $this->template_data->get_data());
	}

	public function settings($output='')
	{

		$this->template_data->set('page_title', 'Account Settings');

		$user_account = new $this->User_accounts_model;
		$user_account->setId($this->session->user_id,true,false);

		if( $this->input->post() ) {

			if( $this->input->post('full_name') ) {
				$user_account->setName($this->input->post('full_name'),false,true);
				$user_account->update();
				$this->session->set_userdata( 'name', $this->input->post('full_name') );
			}

			if( $this->input->post('setting') ) {
				if( $this->input->post('setting') ) foreach($this->input->post('setting') as $key=>$value) {
					$option = new $this->User_accounts_options_model;
					$option->setUid($this->session->user_id,true,false);
					$option->setKey($key,true,false);
					$option->setDepartment('my',true,false);
					$option->setSection('settings',true,false);
					$option->setValue($value);
					if( $option->nonEmpty() ) {
						$option->update();
					} else {
						$option->insert();
					}

					if( $key == 'theme') {
						$user_settings = $this->session->user_settings;
						$user_settings['theme'] = $value;
						$this->session->set_userdata( 'user_settings', $user_settings );
					}
				}
				$this->postNext(NULL, $output);
			}
		}

		$this->template_data->set( 'user_account', $user_account->get() );

		$options = new $this->User_accounts_options_model;
		$options->setUid($this->session->user_id,true,false);
		$options->setDepartment('my',true,false);
		$options->setSection('settings',true,false);
		$options->setKey('theme',true,false);
		$this->template_data->set( 'user_theme', $options->get() );

		$this->template_data->set( 'output', $output );
		$this->load->view('account/settings', $this->template_data->get_data());
	}

}
