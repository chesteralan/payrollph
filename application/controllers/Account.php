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

		//echo sha1("test"); exit;

		if( count($this->input->post()) > 0 ) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if( $this->form_validation->run() != FALSE) {
				$this->load->model('User_accounts_model');
				$account = new $this->User_accounts_model;
				$account->setUsername($this->input->post('username'),true);
				$account->setPassword(sha1($this->input->post('password')),true); 
				if( $account->nonEmpty() ) {
					$results = $account->getResults();
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

					$this->load->model('Companies_list_model');
					$default_company = new $this->Companies_list_model;
					$default_company->setDefault(1,true);
					if( $default_company->nonEmpty() ) {
							$company = $default_company->getResults();
							$this->session->set_userdata( 'current_company', $company->name );
							$this->session->set_userdata( 'current_company_id', $company->id );
							$this->session->set_userdata( 'current_company_theme', $company->theme );
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

						if( $this->input->get('next') ) {
							redirect($this->input->get('next'));
						} else {
							redirect('welcome');
						}

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

	public function change_password($output='')
	{

		$this->_isNotLoggedIn();

		$this->template_data->set('page_title', 'COOP - Change Password');

		if( count($this->input->post()) > 0 ) {
			$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
			$this->form_validation->set_rules('repeat_password', 'Repeat Password', 'trim|required|matches[new_password]');
			if( $this->form_validation->run() != FALSE) {
				$this->load->model('User_accounts_model');
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

	public function logout() {
		$this->session->sess_destroy();
		redirect( site_url("account/login") . "?next=" . $this->input->get('next') );
	}

	public function settings($output='')
	{

		$this->_isNotLoggedIn();

		$this->template_data->set('page_title', 'Account Settings');

		$this->load->model('User_accounts_options_model');
		$this->load->model('User_accounts_model');

		if( $this->input->post() ) {

			if( $this->input->post('full_name') ) {
				$user_account = new $this->User_accounts_model;
				$user_account->setId($this->session->user_id,true,false);
				$user_account->setName($this->input->post('full_name'),false,true);
				$user_account->update();
				$this->session->set_userdata( 'name', $this->input->post('full_name') );
			}

			if( $this->input->post('setting') ) {
				if( $this->input->post('setting') )foreach($this->input->post('setting') as $key=>$value) {
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

		$options = new $this->User_accounts_options_model;
		$options->setUid($this->session->user_id,true,false);
		$options->setDepartment('my',true,false);
		$options->setSection('settings',true,false);
		$this->template_data->set( 'settings', $options->populate() );

		$this->template_data->set( 'output', $output );
		$this->load->view('account/settings', $this->template_data->get_data());
	}

}
