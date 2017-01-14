<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_users extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'User Accounts');
		$this->template_data->set('current_uri', 'system_users');

		$this->_isAuth('system', 'users', 'view');
		
		$this->load->model('User_accounts_model');
		$this->load->model('User_accounts_restrictions_model');
	}

	public function index($start=0) {
		$users = new $this->User_accounts_model;
		$users->set_start($start);
		$this->template_data->set('users', $users->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'uri_segment' => 3,
			'base_url' => base_url("system_users/index"),
			'total_rows' => $users->count_all_results(),
			'per_page' => $users->get_limit(),
			"ajax" => true,
		)));

		$this->load->view('system/user_accounts/user_accounts', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('system', 'users', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user_accounts.username]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|matches[password]');
			if( $this->form_validation->run() ) {
				$user = new $this->User_accounts_model;
				$user->setName($this->input->post('full_name'));
				$user->setUsername($this->input->post('username'),true);
				$user->setPassword(sha1($this->input->post('password')));
				if( ! $user->nonEmpty() ) {
					$user->insert();
					redirect(site_url("system_users") . "?success=true" );
				} else {
					redirect(site_url("system_users/add") . "?error=true" );
				}
			}
		}

		$this->template_data->set('output', $output);

		$this->load->view('system/user_accounts/user_accounts_add', $this->template_data->get_data());
	}

	public function edit($id, $output='') {

		$this->_isAuth('system', 'users', 'edit');

		$user = new $this->User_accounts_model;
		$user->setId($id, true);

		if( $this->input->post() ) {
			$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			if( $this->input->post('password') ) {
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|matches[password]');
			}
			if( $this->form_validation->run() ) {
				$user->setName($this->input->post('full_name'), false, true);
				$user->setUsername($this->input->post('username'), false, true);
				if( $this->input->post('password') ) {
					$user->setPassword(sha1($this->input->post('password')), false, true);
				} 
				if( $user->nonEmpty() ) {
					$user->set_exclude('id');
					$user->update();
				} 
			}

			if( $this->input->get('next') ) {
				redirect( $this->input->get('next') . "?success=true" );
			} else {
				redirect( site_url("system_users") . "?success=true" );
			}
		}
		$this->template_data->set('user', $user->get());

		$this->template_data->set('output', $output);

		$this->load->view('system/user_accounts/user_accounts_edit', $this->template_data->get_data());
	}

	public function delete($id) {

		$this->_isAuth('system', 'users', 'delete');

		if($this->session->user_id != $id) {
			$user = new $this->User_accounts_model;
			$user->setId($id, true);
			$user->delete();
			redirect(site_url("system_users") . "?success=true" );
		}
		redirect(site_url("system_users") . "?error=true" );
	}

	public function restrictions($id, $output='') {

		$this->_isAuth('system', 'users', 'edit');
		
		if( $this->session->user_id == $id) {
			redirect( site_url("system_users") );
		}

		$user = new $this->User_accounts_model;
		$user->setId($id, true);
		$user_data = $user->get();
		$this->template_data->set('user', $user_data);

		if( $this->input->post() && ($user_data) ) {
			
			$rest = $this->input->post('r');
			$dept = unserialize(USERACCOUNTS_RESTRICTIONS);

			foreach($dept as $id=>$dep) {
				foreach($dep->sections as $sect_id=>$sect_name) {

					$ua_rest = new $this->User_accounts_restrictions_model;
					$ua_rest->setUid($user_data->id, true);
					$ua_rest->setDepartment($id, true);
					$ua_rest->setSection($sect_id, true);
					$ua_rest->setView( (isset($rest[$id][$sect_id]['view'])) ? 1 : 0 );
					$ua_rest->setAdd( (isset($rest[$id][$sect_id]['add'])) ? 1 : 0 );
					$ua_rest->setEdit( (isset($rest[$id][$sect_id]['edit'])) ? 1 : 0 );
					$ua_rest->setDelete( (isset($rest[$id][$sect_id]['delete'])) ? 1 : 0 );

					if( $ua_rest->nonEmpty() ) {
						$ua_rest->update();
					} else {
						$ua_rest->insert();
					}

				}
			}

			if( $this->input->get('next') ) {
				redirect( $this->input->get('next') . "?success=true" );
			} else {
				redirect( site_url("system_users") . "?success=true" );
			}
		}

		$ua_rest = new $this->User_accounts_restrictions_model;
		$ua_rest->setUid($user_data->id, true);
		$ua_rest->set_limit(0);
		$this->template_data->set('user_restrictions', $ua_rest->populate());

		$this->template_data->set('output', $output);

		$this->load->view('system/user_accounts/user_accounts_restrictions', $this->template_data->get_data());
	}

}
