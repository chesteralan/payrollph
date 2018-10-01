<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Login_Controller {

	public function index()
	{
		redirect("account/login");
	}

	protected function _isLoggedIn($uri='welcome') {
		if( isset($this->session->loggedIn) && $this->session->loggedIn ) {
        	redirect($uri);
        }
	}

	protected function _isNotLoggedIn($uri='account/login') {
		if( ! $this->session->loggedIn || ! isset($this->session->loggedIn) ) {
            $this->session->sess_destroy();
            redirect($uri);
       }
	}

	public function postNext($query_string=null, $output='') {
            if( $this->input->post() ) {
                    if( $this->input->get('next') ) {
                            $url = site_url($this->input->get('next'));
                            if( $query_string ) {
                                    $url .= "?" . $query_string;
                            }
                            redirect( $url );
                    } else {
                    	if($output=='ajax') {
                    		redirect( "/" );
                    	}
                    }
            }
    }

	public function login($output='')
	{

		$this->_isLoggedIn();
		
		$login_output = array(
			'loggedIn' => false
			);


		if( count($this->input->post()) > 0 ) {
			//echo sha1($this->input->post('password')); exit;
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if( $this->form_validation->run() != FALSE) {
				$this->load->model('User_accounts_model');
				$account = new $this->User_accounts_model;
				$account->setUsername($this->input->post('username'),true);
				$account->setPassword(sha1($this->input->post('password')),true); 
				if( $account->nonEmpty() ) {
					$results = $account->getResults();

					record_system_audit($results->id, 'account', 'users', 'login');
					$account->setLastLogin(date('Y-m-d H:i:s'),false,true);
					$account->update();

					$this->session->set_userdata( 'loggedIn', true );
					$this->session->set_userdata( 'user_id', $results->id );
					$this->session->set_userdata( 'username', $results->username );
					$this->session->set_userdata( 'name', $results->name );

					$this->load->model('User_accounts_restrictions_model');
					$ua_rest = new $this->User_accounts_restrictions_model;
					$ua_rest->setUid($results->id, true);
					$ua_rest->set_limit(0);

					$session_auth = array();
					$menu_module = array();
					foreach($ua_rest->populate() as $ur) {
					    $session_auth[$ur->department][$ur->section]['view'] = $ur->view;
					    $session_auth[$ur->department][$ur->section]['add'] = $ur->add;
					    $session_auth[$ur->department][$ur->section]['edit'] = $ur->edit;
					    $session_auth[$ur->department][$ur->section]['delete'] = $ur->delete;
					    if( $ur->view ) {
					    	$menu_module[$ur->department][] = $ur->section;
					    }
					}
					$this->session->set_userdata( 'session_auth', $session_auth );
					$this->session->set_userdata( 'menu_module', $menu_module );

					$this->load->model('User_accounts_options_model');
					$options = new $this->User_accounts_options_model;
					$options->setUid($results->id, true);
					$options->setDepartment('my',true,false);
					$options->setSection('settings',true,false);

					$user_settings = array();
					foreach( $options->populate() as $setting ) {
						$user_settings[$setting->key] = $setting->value;
					}
					$this->session->set_userdata( 'user_settings', $user_settings );

					$this->load->model('User_accounts_companies_model');
					$companies = new $this->User_accounts_companies_model('uc');
					$companies->setUid($this->session->userdata('user_id'),true);
					$companies->set_join('companies_list cl', 'uc.company_id=cl.id');
					$companies->set_select('cl.*');
					if( $companies->nonEmpty() ) {
						$company =  $companies->getResults();
						$this->session->set_userdata( 'current_company', $company->name );
						$this->session->set_userdata( 'current_company_id', $company->id );
						$this->session->set_userdata( 'current_company_theme', $company->theme );
						if( $this->input->get('next') ) {
							redirect($this->input->get('next'));
						} else {
							redirect(site_url('welcome'));
						}
					}

					if( $output == 'ajax') {

						$login_output = array(
							'loggedIn' => true, 
							'user_id' => $results->id,
							'username' => $results->username,
							'name' => $results->name,
							'next_url' => site_url( $this->input->get('next') ),
							);

					} else {
							redirect(site_url('welcome/select_company') . "?next=" . $this->input->get('next'));
					}
					
				}
			}
		}

		if( $output == 'ajax') {
			echo json_encode( $login_output );
		} else {
			$this->load->view('account/login', $this->template_data->get_data());
		}
	}

	public function logout() {
		record_system_audit($this->session->userdata('user_id'), 'account', 'users', 'logout');
		$this->session->sess_destroy();
		redirect( site_url("account/login") . "?next=" . $this->input->get('next') );
	}

}
