<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_names extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Names');
		$this->template_data->set('current_uri', 'lists_names');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('lists', 'names', 'view');

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
		$names->setTrash(0, true);

		if( $this->input->get('q') ) {
			$names->set_where('full_name LIKE "%' . $this->input->get('q') . '%"');
			$names->set_where_or('address LIKE "%' . $this->input->get('q') . '%"');
		}

		$names->set_select("names_list.*");
		$names->set_select("(SELECT COUNT(*) FROM employees WHERE name_id=names_list.id) as is_employed");

		$names->set_order('names_list.full_name', 'ASC');
		$names->set_start($start);
		$names->setTrash('0',true);

		$this->template_data->set('names', $names->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/lists_names/index/'),
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
		$name->setId($id, true,false);
		$name->setTrash('1',false,true);
		$name->update();

		redirect( "lists_names" );
	}

	public function profile($id,$output='') {

		$this->_isAuth('lists', 'names', 'edit');

		$this->template_data->set('output', $output);

		$name = new $this->Names_list_model('nl');
		$name->setId($id, true);
		$name->set_select("nl.*");
		
		$name->set_join("names_info ni", "ni.name_id=nl.id");
		$name->set_select("ni.*");

			$contact = new $this->Names_contacts_model('nc');
			$contact->set_select('nc.value');
			$contact->setKey('phone_number', true);
			$contact->set_limit(1);
			$contact->set_where("nc.name_id=nl.id");
			$name->set_select("(".$contact->get_compiled_select().") as phone_number");

			$contact = new $this->Names_contacts_model('nc');
			$contact->set_select('nc.value');
			$contact->setKey('cell_smart', true);
			$contact->set_limit(1);
			$contact->set_where("nc.name_id=nl.id");
			$name->set_select("(".$contact->get_compiled_select().") as cell_smart");

			$contact = new $this->Names_contacts_model('nc');
			$contact->set_select('nc.value');
			$contact->setKey('cell_globe', true);
			$contact->set_limit(1);
			$contact->set_where("nc.name_id=nl.id");
			$name->set_select("(".$contact->get_compiled_select().") as cell_globe");

			$contact = new $this->Names_contacts_model('nc');
			$contact->set_select('nc.value');
			$contact->setKey('cell_sun', true);
			$contact->set_limit(1);
			$contact->set_where("nc.name_id=nl.id");
			$name->set_select("(".$contact->get_compiled_select().") as cell_sun");

			$contact = new $this->Names_contacts_model('nc');
			$contact->set_select('nc.value');
			$contact->setKey('address', true);
			$contact->set_limit(1);
			$contact->set_where("nc.name_id=nl.id");
			$name->set_select("(".$contact->get_compiled_select().") as address");

		$this->template_data->set('name', $name->get());

		$this->load->view('lists/names/names_profile', $this->template_data->get_data());
	}

	public function update_personal($id,$output='') {

		$this->_isAuth('lists', 'names', 'edit');

		$info = new $this->Names_info_model;
		$info->setNameId($id,true);

		if( $this->input->post() ) {
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('middlename', 'Middle Name', 'trim');
			if( $this->form_validation->run() ) {
				$info->setLastname($this->input->post('lastname'),false,true);
				$info->setFirstname($this->input->post('firstname'),false,true);
				$info->setMiddlename($this->input->post('middlename'),false,true);
				$info->setBirthday( date("Y-m-d", strtotime($this->input->post('birthday'))),false,true);
				$info->setBirthplace($this->input->post('birthplace'),false,true);
				$info->setGender($this->input->post('gender'),false,true);
				$info->setCivilStatus($this->input->post('civil_status'),false,true);
				if( $info->nonEmpty() ) {
					$info->update();
				} else {
					$info->setNameId($id,true,true);
					$info->insert();
				}
			}
			$this->postNext();
		}

		$this->template_data->set('info', $info->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/names/names_update_personal', $this->template_data->get_data());
	}

}
