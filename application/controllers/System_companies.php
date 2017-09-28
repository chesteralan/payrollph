<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_companies extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Companies');
		$this->template_data->set('current_uri', 'system_companies');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('system', 'companies', 'view');

		if( !$this->config->item('multi_company') ) {
			redirect("welcome");
		}

	}

	public function index($start=0) {
		
		$companies = new $this->Companies_list_model;
		$companies->set_select("*");
		$companies->set_order('name', 'ASC');
		$companies->set_start($start);
		$companies->setTrash('0',true);
		$this->template_data->set('companies', $companies->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/system_companies/index/'),
			'total_rows' => $companies->count_all_results(),
			'per_page' => $companies->get_limit(),
			'ajax'=>true,
		)));
		
		$this->load->view('system/companies/companies_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('system', 'companies', 'add');

		if( $this->input->post() ) {
			$this->form_validation->set_rules('name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim');
			$this->form_validation->set_rules('phone', 'phone', 'trim');
			$this->form_validation->set_rules('notes', 'Notes', 'trim');
			if( $this->form_validation->run() ) {
				$companies = new $this->Companies_list_model;
				$companies->setName($this->input->post('name'));
				$companies->setAddress($this->input->post('address'));
				$companies->setPhone($this->input->post('phone'));
				$companies->setNotes($this->input->post('notes'));
				$bootstrap_theme = ( isset($this->session->user_settings['theme']) && $this->session->user_settings['theme'] ) ? $this->session->user_settings['theme'] : 'yeti';
				$companies->setTheme($bootstrap_theme);
				if( $companies->insert() ) {
					redirect("system_companies");
				}
			}
		}

		$this->template_data->set('output', $output);
		$this->load->view('system/companies/companies_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('system', 'companies', 'edit');

		$companies = new $this->Companies_list_model;
		$companies->setId($id,true);

		if( $companies->nonEmpty() ) {
			if( $this->input->post() ) { 
				$this->form_validation->set_rules('name', 'Company Name', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim');
				$this->form_validation->set_rules('phone', 'phone', 'trim');
				$this->form_validation->set_rules('notes', 'Notes', 'trim');
				if( $this->form_validation->run() ) {
					$companies->setName($this->input->post('name'),false,true);
					$companies->setAddress($this->input->post('address'),false,true);
					$companies->setPhone($this->input->post('phone'),false,true);
					$companies->setNotes($this->input->post('notes'),false,true);
					$companies->setTheme($this->input->post('theme'),false,true);
					$companies->setDefault(($this->input->post('default')?1:0),false,true);
					$companies->update();
				}
				if( $this->input->post('default') ) {
					$old_company = new $this->Companies_list_model;
					$old_company->setDefault(0,false,true);
					$old_company->set_where('default = 1');
					$old_company->set_where('id!=' . $id);
					$old_company->update();
				}
				$this->postNext();
			}
		}

		$companies->set_select("*");
		$this->template_data->set('company', $companies->get());

		$this->template_data->set('output', $output);
		$this->load->view('system/companies/companies_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('system', 'companies', 'delete');

		$companies = new $this->Companies_list_model;
		$companies->setId($id,true);
		$companies->setTrash('1',false,true);
		$companies->update();

		$this->getNext("system_companies");
	}

	public function print_css($id,$output='') {

		$this->_isAuth('system', 'companies', 'edit');

		$options = new $this->Companies_options_model;
		$options->setCompanyId($id,true);
		$options->setKey('print_css',true);

		if( $this->input->post('print_css') ) { 
			if( $options->nonEmpty() ) {
				$options->setValue( serialize($this->input->post('print_css')), false,true);
				$options->update();
			} else {
				$options->setValue( serialize($this->input->post('print_css')) );
				$options->insert();
			}
			$this->postNext();
		}

		$options->set_select("value");
		$this->template_data->set('css', $options->get());

		$this->template_data->set('output', $output);
		$this->load->view('system/companies/companies_print_css', $this->template_data->get_data());
	}

	public function print_group($id,$output='') {

		$this->_isAuth('system', 'companies', 'edit');

		$options = new $this->Companies_options_model;
		$options->setCompanyId($id,true);
		$options->setKey('print_group',true);

		if( $this->input->post('print_css') ) { 
			if( $options->nonEmpty() ) {
				$options->setValue( serialize($this->input->post('print_group')), false,true);
				$options->update();
			} else {
				$options->setValue( serialize($this->input->post('print_group')) );
				$options->insert();
			}
			$this->postNext();
		}

		$options->set_select("value");
		$this->template_data->set('print_group', $options->get());

		$this->template_data->set('output', $output);
		$this->load->view('system/companies/companies_print_group', $this->template_data->get_data());
	}

}
