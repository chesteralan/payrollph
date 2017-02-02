<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_names extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Names');
		$this->template_data->set('current_uri', 'lists_names');
		$this->template_data->set('navbar_search', true);

		$this->_isAuth('lists', 'names', 'view');

		$this->load->model('Names_list_model');

	}

	private function _searchRedirect() {
		if( $this->input->get('q') ) {
			redirect(site_url("lists_names?q=" . $this->input->get('q') ));
		}
	}

	public function index($start=0) {
		
		if( $start > 0 ) {
			$this->_searchRedirect();
		}

		$names = new $this->Names_list_model;

		if( $this->input->get('q') ) {
			$names->set_where('full_name LIKE "%' . $this->input->get('q') . '%"');
			$names->set_where_or('address LIKE "%' . $this->input->get('q') . '%"');
		}

		$names->set_select("names_list.*");
		$names->set_select("(SELECT COUNT(*) FROM employees WHERE name_id=names_list.id) as is_employed");

		$names->set_order('names_list.full_name', 'ASC');
		$names->set_start($start);

		$this->template_data->set('names', $names->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url('lists_names/index/'),
			'total_rows' => $names->count_all_results(),
			'per_page' => $names->get_limit(),
			'ajax'=>true,
		)));

		$this->load->view('lists/names/names_list', $this->template_data->get_data());
	}

	public function add($output='') {

		$this->_isAuth('lists', 'names', 'add');

		$this->template_data->set('output', $output);
		$name_id = false;
		if( $this->input->post() ) {
			$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|is_unique[names_list.full_name]');
			$this->form_validation->set_rules('address', 'Address', 'trim');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim');
			if( $this->form_validation->run() ) {
				$name = new $this->Names_list_model;
				$name->setFullName($this->input->post('full_name'));
				$name->setAddress($this->input->post('address'));
				$name->setContactNumber($this->input->post('contact_number'));
				if( ! $name->nonEmpty() ) {
					$name->insert();
					$name_id = $name->getId();
				}
			}
			if( $this->input->get('next') ) {
					$url = $this->input->get('next');
					if( $name_id ) {
						$url = str_replace('$new_id', $name_id, $url);
					}
                    
                    if( $name_id ) {
                    	$url = site_url($url) . "?error_code=340&new_name=" . $name_id;
                    } else {
                    	$url = site_url($url) . "?error_code=341";
                    }
                    redirect( $url );
            } else {
            	if( $name_id ) {
            		redirect( "lists_names/edit/" . $name_id );
            	}
            }
		}
		$this->load->view('lists/names/names_add', $this->template_data->get_data());
	}

	public function edit($id,$output='') {

		$this->_isAuth('lists', 'names', 'edit');

		$this->template_data->set('output', $output);

		$name = new $this->Names_list_model;
		$name->setId($id, true);

		if( $this->input->post() ) {
			$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim');
			if( $this->form_validation->run() ) {
				$name->setFullName($this->input->post('full_name'));
				$name->setAddress($this->input->post('address'));
				$name->setContactNumber($this->input->post('contact_number'));
				if( $name->nonEmpty() ) {
					$name->set_exclude('id');
					$name->update();
				} 
			}
			$this->postNext();
		}

		$name->set_select("names_list.*");

		$this->template_data->set('name', $name->get());
		
		$this->load->view('lists/names/names_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('lists', 'names', 'delete');

		$name = new $this->Names_list_model;
		$name->setId($id, true);
		$name->delete();

		redirect( "lists_names" );
	}

}
