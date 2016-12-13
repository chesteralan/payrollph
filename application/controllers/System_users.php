<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_users extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('page_title', 'PAYROLL - User Accounts');
		$this->template_data->set('current_page', 'User Accounts');
		$this->template_data->set('current_uri', 'system_users');

		$this->load->model('User_accounts_model');
	}

	public function index() {
		$users = new $this->User_accounts_model;
		$this->template_data->set('users', $users->populate());
		$this->load->view('system/user_accounts/user_accounts', $this->template_data->get_data());
	}

	public function add() {
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
		$this->load->view('system/user_accounts/user_accounts_add', $this->template_data->get_data());
	}

	public function edit($id) {
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
		}
		$this->template_data->set('user', $user->get());
		$this->load->view('system/user_accounts/user_accounts_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		if($this->session->user_id != $id) {
			$user = new $this->User_accounts_model;
			$user->setId($id, true);
			$user->delete();
			redirect(site_url("system_users") . "?success=true" );
		}
		redirect(site_url("system_users") . "?error=true" );
	}

}
