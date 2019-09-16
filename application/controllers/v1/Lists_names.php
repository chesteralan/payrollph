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

	private function _searchRedirect($uri='lists_names') {
		if( $this->input->get('q') ) {
			redirect(site_url($uri."?q=" . $this->input->get('q') ));
		}
	}

	public function index($start=0) {
		
		if( $start > 0 ) {
			$this->_searchRedirect();
		}

		$names = new $this->Names_list_model('nl');

		if( $this->input->get('filter') == 'trash' ) {
			$names->setTrash(1, true);
		} else {
			$names->setTrash(0, true);
		}

		if( $this->input->get('q') ) {
			$names->set_where('nl.full_name LIKE "%' . $this->input->get('q') . '%"');
			$names->set_where_or('nl.address LIKE "%' . $this->input->get('q') . '%"');
		}

		$names->set_select("nl.*");
		$names->set_select("(SELECT COUNT(*) FROM employees e WHERE e.name_id=nl.id) as is_employed");
		$names->set_select("(SELECT name FROM companies_list c WHERE c.id=(SELECT e.company_id FROM employees e WHERE e.name_id=nl.id)) as company");

		$names->set_join("names_info ni", 'ni.name_id=nl.id');
		$names->set_select("(TIMESTAMPDIFF(YEAR, ni.birthday, CURDATE())) as age");

		$names->set_order('nl.full_name', 'ASC');
		$names->set_start($start);

		$this->template_data->set('names', $names->populate());
		$this->template_data->set('names_count', $names->count_all_results());

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
				$name->setFullName($this->input->post('full_name'), true);
				$name->setAddress($this->input->post('address'));
				$name->setContactNumber($this->input->post('contact_number'));
				$name->setTrash('0');
				if( ! $name->nonEmpty() ) {
					if( $name->insert() ) {
						$name_id = $name->get_inserted_id();
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'add', $this->session->userdata('current_company_id'), "Name Added: {$this->input->post('full_name')}", $name_id);
					}
					
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
		$name_data = $name->get();

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
					if( $name->update() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'edit', $this->session->userdata('current_company_id'), "Name Edited: {$name_data->full_name}", $id);
					}
				} 
			}
			$this->postNext();
		}

		$name->set_select("names_list.*");

		$this->template_data->set('name', $name->get());
		$this->template_data->set('next_item', $this->_next_name($id, 'lists_names/edit/'));
		$this->template_data->set('previous_item', $this->_previous_name($id, 'lists_names/edit/'));
		
		$this->load->view('lists/names/names_edit', $this->template_data->get_data());
	}

	public function delete($id) {
		
		$this->_isAuth('lists', 'names', 'delete');
		$this->_isAuth('lists', 'names', 'edit');

		$name = new $this->Names_list_model;
		$name->setId($id, true,false);
		$name->setTrash('1',false,true);
		$name_data = $name->get();

		if( $name->update() ) {
			record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'delete', $this->session->userdata('current_company_id'), "Name Deactivated: {$name_data->full_name}", $id);
		}

		redirect( "lists_names" );
	}

	public function deactivate($id) {
		
		$this->_isAuth('lists', 'names', 'delete');
		$this->_isAuth('lists', 'names', 'edit');

		$name = new $this->Names_list_model;
		$name->setId($id, true,false);
		$name->setTrash('1',false,true);

		$name_data = $name->get();

		if( $name->update() ) {
			record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'deactivate', $this->session->userdata('current_company_id'), "Name Deactivated: {$name_data->full_name}", $id);
		}

		redirect( "lists_names" );
	}

	public function restore($id) {
		
		$this->_isAuth('lists', 'names', 'delete');
		$this->_isAuth('lists', 'names', 'edit');

		$name = new $this->Names_list_model;
		$name->setId($id, true,false);
		$name->setTrash('0',false,true);
		$name_data = $name->get();
		
		if( $name->update() ) {
			record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'restore', $this->session->userdata('current_company_id'), "Name Restored: {$name_data->full_name}", $id);
		}

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
		$name->set_select("(SELECT COUNT(*) FROM employees e WHERE e.name_id=nl.id AND e.trash=0) as is_employed");
		$name->set_select("(SELECT e.company_id FROM employees e WHERE e.name_id=nl.id) as company_id");
		$name->set_select("(SELECT name FROM companies_list c WHERE c.id=(SELECT e.company_id FROM employees e WHERE e.name_id=nl.id)) as company");
		$name->set_select("(TIMESTAMPDIFF(YEAR, ni.birthday, CURDATE())) as age");

		foreach(array('address', 'email', 'phone_number', 'cell_smart', 'cell_globe', 'cell_sun') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nl.id');
			$name->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		foreach(array('facebook_id','twitter_id','instagram_id','skype_id','yahoo_id','google_id') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nl.id');
			$name->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		foreach(array('tin','sss','hdmf','phic','drivers_license','voters_number') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nl.id');
			$name->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		foreach(array('emergency_name','emergency_address', 'emergency_relationship', 'emergency_contact') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nl.id');
			$name->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		foreach(array('sgl_number','sgl_expiry','sgl_status') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nl.id');
			$name->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		$name_data = $name->get();	
		$this->template_data->set('name', $name_data);

		if( $name_data->is_employed ) {
			$employee = new $this->Employees_model('e');
			$employee->setNameId($id,true);
			$employee->set_select('*');
			$employee->set_select('(SELECT name FROM employees_groups WHERE id=e.group_id) as group_name');
			$employee->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position_name');
			$employee->set_select('(SELECT name FROM employees_areas WHERE id=e.area_id) as area_name');
			$employee->set_select('(SELECT name FROM terms_list WHERE id=e.status) as status_name');
			$employee->set_select("(TIMESTAMPDIFF(YEAR, e.hired, CURDATE())) as hired_years");
			$employee->set_select("(TIMESTAMPDIFF(YEAR, e.regularized, CURDATE())) as regularized_years");
			$this->template_data->set('employee', $employee->get());
		}

		$this->template_data->set('next_item', $this->_next_name($id, 'lists_names/profile/'));
		$this->template_data->set('previous_item', $this->_previous_name($id, 'lists_names/profile/'));

		if( $output == 'ajax' ) {
			$this->load->view('lists/names/names_profile_ajax', $this->template_data->get_data());
		} else {
			$this->load->view('lists/names/names_profile', $this->template_data->get_data());
		}
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
				$info->setPrefix($this->input->post('prefix'),false,true);
				$info->setSuffix($this->input->post('suffix'),false,true);
				if( $info->nonEmpty() ) {
					if( $info->update() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_personal', $this->session->userdata('current_company_id'), "Personal Info Updated", $id);
					}
				} else {
					$info->setNameId($id,true,true);
					if( $info->insert() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_personal', $this->session->userdata('current_company_id'), "Personal Info Updated", $id);
					}
				}
			}
			$this->postNext("active=personal");
		}

		$this->template_data->set('info', $info->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/names/names_update_personal', $this->template_data->get_data());
	}

	public function update_contacts($id,$output='') {

		$this->_isAuth('lists', 'names', 'edit');

		if( $this->input->post('data') ) {
			foreach($this->input->post('data') as $key=>$value) {
				
				$meta = new $this->Names_meta_model;
				$meta->setNameId($id,true);
				$meta->setMetaKey($key,true);
				if( !empty( $value ) ) {
					if( $meta->nonEmpty() ) {
						$meta->setMetaValue($value,false,true);
						if( $meta->update() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_contacts', $this->session->userdata('current_company_id'), "Contact Info Updated", $id);
						}
					} else {
						$meta->setMetaValue($value);
						if( $meta->insert() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_contacts', $this->session->userdata('current_company_id'), "Contact Info Updated", $id);
						}
					}
				} else {
					if( $meta->delete() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_contacts', $this->session->userdata('current_company_id'), "Contact Info Updated", $id);
					}
				}
			}
			$this->postNext("active=contacts");
		}

		$meta = new $this->Names_meta_model('nc');
		$meta->setNameId($id,true);
		$meta->setMetaKey('address',true);
		$meta->set_select('nc.meta_value as address');

		foreach(array('email', 'phone_number', 'cell_smart', 'cell_globe', 'cell_sun') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nc.name_id');
			$meta->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		$this->template_data->set('meta', $meta->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/names/names_update_contacts', $this->template_data->get_data());
	}

	public function update_social_media($id,$output='') {

		$this->_isAuth('lists', 'names', 'edit');

		if( $this->input->post('data') ) {
			foreach($this->input->post('data') as $key=>$value) {
				
				$meta = new $this->Names_meta_model;
				$meta->setNameId($id,true);
				$meta->setMetaKey($key,true);
				if( !empty( $value ) ) {
					if( $meta->nonEmpty() ) {
						$meta->setMetaValue($value,false,true);
						if( $meta->update() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_social_media', $this->session->userdata('current_company_id'), "Social Media Updated", $id);
						}
					} else {
						$meta->setMetaValue($value);
						if( $meta->insert() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_social_media', $this->session->userdata('current_company_id'), "Social Media Updated", $id);
						}
					}
				} else {
					if( $meta->delete() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_social_media', $this->session->userdata('current_company_id'), "Social Media Updated", $id);
					}
				}
			}
			$this->postNext("active=social_media");
		}

		$meta = new $this->Names_meta_model('nc');
		$meta->setNameId($id,true);
		$meta->setMetaKey('facebook_id',true);
		$meta->set_select('nc.meta_value as facebook_id');

		foreach(array('twitter_id','instagram_id','skype_id','yahoo_id','google_id') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nc.name_id');
			$meta->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		$this->template_data->set('meta', $meta->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/names/names_update_social_media', $this->template_data->get_data());
	}

	public function update_ids($id,$output='') {

		$this->_isAuth('lists', 'names', 'edit');

		if( $this->input->post('data') ) {
			foreach($this->input->post('data') as $key=>$value) {
				
				$meta = new $this->Names_meta_model;
				$meta->setNameId($id,true);
				$meta->setMetaKey($key,true);
				if( !empty( $value ) ) {
					if( $meta->nonEmpty() ) {
						$meta->setMetaValue($value,false,true);
						if( $meta->update() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_ids', $this->session->userdata('current_company_id'), "ID Info Updated", $id);
						}
					} else {
						$meta->setMetaValue($value);
						if( $meta->insert() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_ids', $this->session->userdata('current_company_id'), "ID Info Updated", $id);
						}
					}
				} else {
					if( $meta->delete() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_ids', $this->session->userdata('current_company_id'), "ID Info Updated", $id);
					}
				}
			}
			$this->postNext("active=ids");
		}

		$meta = new $this->Names_meta_model('nc');
		$meta->setNameId($id,true);
		//$meta->setMetaKey('tin',true);
		//$meta->set_select('nc.meta_value as tin');

		foreach(array('tin', 'sss','hdmf','phic','drivers_license','voters_number') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nc.name_id');
			$meta->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		$this->template_data->set('meta', $meta->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/names/names_update_ids', $this->template_data->get_data());
	}

	public function update_emergency($id,$output='') {

		$this->_isAuth('lists', 'names', 'edit');

		if( $this->input->post('data') ) {
			foreach($this->input->post('data') as $key=>$value) {
				
				$meta = new $this->Names_meta_model;
				$meta->setNameId($id,true);
				$meta->setMetaKey($key,true);
				if( !empty( $value ) ) {
					if( $meta->nonEmpty() ) {
						$meta->setMetaValue($value,false,true);
						if( $meta->update() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_emergency', $this->session->userdata('current_company_id'), "Emergency Updated", $id);
						}
					} else {
						$meta->setMetaValue($value);
						if( $meta->insert() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_emergency', $this->session->userdata('current_company_id'), "Emergency Updated", $id);
						}
					}
				} else {
					if( $meta->delete() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_emergency', $this->session->userdata('current_company_id'), "Emergency Updated", $id);
					}
				}
			}
			$this->postNext("active=emergency");
		}

		$meta = new $this->Names_meta_model('nc');
		$meta->setNameId($id,true);
		$meta->setMetaKey('emergency_name',true);
		$meta->set_select('nc.meta_value as emergency_name');

		foreach(array('emergency_address', 'emergency_relationship', 'emergency_contact') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nc.name_id');
			$meta->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		$this->template_data->set('meta', $meta->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/names/names_update_emergency', $this->template_data->get_data());
	}	

	public function update_security_guard_license($id,$output='') {

		$this->_isAuth('lists', 'names', 'edit');

		if( $this->input->post('data') ) {
			foreach($this->input->post('data') as $key=>$value) {
				
				$meta = new $this->Names_meta_model;
				$meta->setNameId($id,true);
				$meta->setMetaKey($key,true);
				if( !empty( $value ) ) {
					if( $meta->nonEmpty() ) {
						$meta->setMetaValue($value,false,true);
						if( $meta->update() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_security_guard_license', $this->session->userdata('current_company_id'), "Security Guard License Updated: {$key}", $id);
						}
					} else {
						$meta->setMetaValue($value);
						if( $meta->insert() ) {
							record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_security_guard_license', $this->session->userdata('current_company_id'), "Security Guard License Added: {$key}", $id);
						}
					}
				} else {
					if( $meta->delete() ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'update_security_guard_license', $this->session->userdata('current_company_id'), "Security Guard License Removed: {$key}", $id);
					}
				}
			}
			$this->postNext("active=security_guard_license");
		}

		$meta = new $this->Names_meta_model('nc');
		$meta->setNameId($id,true);
		$meta->setMetaKey('sgl_number',true);
		$meta->set_select('nc.meta_value as sgl_number');

		foreach(array('sgl_expiry', 'sgl_status') as $k) {
			$data = new $this->Names_meta_model('d');
			$data->setMetaKey($k,true);
			$data->set_select('d.meta_value');
			$data->set_where('d.name_id=nc.name_id');
			$meta->set_select('('.$data->get_compiled_select().') as ' . $k);
		}

		$this->template_data->set('meta', $meta->get());

		$this->template_data->set('output', $output);
		$this->load->view('lists/names/names_update_security_guard_license', $this->template_data->get_data());
	}

	public function birthdays($company_id, $start=0) {
		
		$this->template_data->set('company_id', $company_id);

		if( $start > 0 ) {
			$this->_searchRedirect("lists_names/birthdays/" . $company_id);
		}

		$names = new $this->Names_list_model('nl');
		$names->setTrash(0, true);

		if( $this->input->get('q') ) {
			$names->set_where('nl.full_name LIKE "%' . $this->input->get('q') . '%"');
			$names->set_where_or('nl.address LIKE "%' . $this->input->get('q') . '%"');
		}

		$names->set_select("nl.*");
		$names->set_select("ni.*");
		$names->set_select("(SELECT COUNT(*) FROM employees e WHERE e.name_id=nl.id) as is_employed");

		$names->set_join("names_info ni", 'ni.name_id=nl.id');
		$names->set_join("employees e", 'e.name_id=nl.id');
		$names->set_select("(TIMESTAMPDIFF(YEAR, ni.birthday, CURDATE())) as age");

		$names->set_order('(MONTH(ni.birthday))', 'ASC');
		$names->set_order('(DAY(ni.birthday))', 'ASC');
		$names->set_where('e.company_id=' . $company_id);

		if( $this->input->get('month') ) {
			$names->set_where('((MONTH(ni.birthday))=' . $this->input->get('month') .')');
			$names->set_limit(0);
		} else {
			$names->set_start($start);
		}
		$names->set_start($start);
		$names->setTrash('0',true);

		$this->template_data->set('names', $names->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/lists_names/birthdays/' . $company_id),
			'total_rows' => $names->count_all_results(),
			'per_page' => $names->get_limit(),
			'ajax'=>true,
		)));

		$this->load->view('lists/names/names_birthdays', $this->template_data->get_data());
	}

	private function _report_columns($names, $columns) {
					
					$columns = ($columns) ? $columns : array();
					
					// personal info
					$names->set_select('ni.*');
					if( in_array('age', $columns)) {
						$names->set_select("(TIMESTAMPDIFF(YEAR, ni.birthday, CURDATE())) as age");
					}

					// employment info
					if( in_array('emp_group', $columns)) {
						$names->set_select('(SELECT name FROM employees_groups WHERE id=e.group_id) as group_name');
					}
					if( in_array('emp_position', $columns)) {
						$names->set_select('(SELECT name FROM employees_positions WHERE id=e.position_id) as position_name');
					}
					if( in_array('emp_area', $columns)) {
						$names->set_select('(SELECT name FROM employees_areas WHERE id=e.area_id) as area_name');
					}
					if( in_array('emp_status', $columns)) {
						$names->set_select('(SELECT name FROM terms_list WHERE id=e.status) as status_name');
					}
					if( in_array('emp_company', $columns)) {
						$names->set_select("(SELECT name FROM companies_list c WHERE c.id=(SELECT e.company_id FROM employees e WHERE e.name_id=nl.id)) as company");
					}

					if( in_array('contact_address', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="address") as address');
					}
					if( in_array('contact_email', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="email") as email');
					}
					if( in_array('contact_phone', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="phone_number") as phone_number');
					}
					if( in_array('contact_smart', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="cell_smart") as cell_smart');
					}
					if( in_array('contact_globe', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="cell_globe") as cell_globe');
					}
					if( in_array('contact_sun', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="cell_sun") as cell_sun');
					}

					if( in_array('sm_facebook', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="facebook_id") as facebook_id');
					}
					if( in_array('sm_twitter', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="twitter_id") as twitter_id');
					}
					if( in_array('sm_instagram', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="instagram_id") as instagram_id');
					}
					if( in_array('sm_skype', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="skype_id") as skype_id');
					}
					if( in_array('sm_yahoo', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="yahoo_id") as yahoo_id');
					}
					if( in_array('sm_google', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="google_id") as google_id');
					}

					if( in_array('idn_tin', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="tin") as tin');
					}
					if( in_array('idn_sss', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="sss") as sss');
					}
					if( in_array('idn_hdmf', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="hdmf") as hdmf');
					}
					if( in_array('idn_phic', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="phic") as phic');
					}
					if( in_array('idn_driver', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="drivers_license") as drivers_license');
					}
					if( in_array('idn_voter', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="voters_number") as voters_number');
					}

					if( in_array('emergency_name', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="emergency_name") as emergency_name');
					}
					if( in_array('emergency_address', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="emergency_address") as emergency_address');
					}
					if( in_array('emergency_number', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="emergency_contact") as emergency_contact');
					}
					if( in_array('emergency_rel', $columns)) {
						$names->set_select('(SELECT nm.meta_value FROM  names_meta nm WHERE nm.name_id=e.name_id AND nm.meta_key="emergency_relationship") as emergency_relationship');
					}
					return $names;
	}

	public function report($page='config', $output='') {
	
		$this->template_data->set('page', $page);
		$this->template_data->set('output', $output);

		switch( $page ) {
			case 'display':
				
				$names = new $this->Names_list_model('nl');
				$names->setTrash(0, true);
				$names->set_select("nl.*");
				$names->set_select("nl.id as ni_name_id");
				$names->set_order('nl.full_name', 'ASC');
				$names->set_limit(0);
				$names->set_join("names_info ni", 'ni.name_id=nl.id');
				$names->set_join("employees e", 'e.name_id=nl.id');

				$this->_report_columns($names, $this->input->get('columns'));

				$this->template_data->set('names', $names->populate());
				
				$this->load->view('lists/names/names_report_display', $this->template_data->get_data());
			break;
			case 'download':
				if($this->input->get('employee')) {
					
					$employees->set_select('e.*');

					$this->_employee_columns($employees, $this->input->get('columns'));

					$employees->set_where_in('e.name_id', $this->input->get('employee'));
					$this->template_data->set('employees', $employees->populate());
				}

				$company = new $this->Companies_list_model;
				$company->setId($this->session->userdata('current_company_id'),true);
				$company_data = $company->get();
				$filename = url_title($company_data->name)."-Employees-Report.xls";

				$this->output->set_content_type('application/vnd-ms-excel');
				$this->output->set_header('Content-Disposition: attachment; filename=' . $filename);
				$this->load->view('lists/names/names_report_xls', $this->template_data->get_data());
			break;
			case 'config':
			default:

				if($this->input->post()) {
					redirect( site_url("lists_names/report/display") . "?" . http_build_query($this->input->post()) );
					exit;
				}
/*
				$companies = new $this->Companies_list_model;
				$companies->set_select("*");
				$companies->set_order('name', 'ASC');
				$companies->set_limit(0);
				$companies->setTrash('0',true);
				$this->template_data->set('companies', $companies->populate());
*/
				$this->load->view('lists/names/names_report_config', $this->template_data->get_data());
			break;
		}

	}


	public function import($output="") {

				$config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = 600;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('import_file') )
                {
                        //$error = array('error' => $this->upload->display_errors());

                        $this->template_data->set('output', $output);
						$this->load->view('lists/names/names_import', $this->template_data->get_data());

                }
                else
                {
                        $upload_data = $this->upload->data();

                        record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'import', $this->session->userdata('current_company_id'), "Import CSV File: " . $upload_data['file_name'], "");

                        $this->_process_csv_file( $upload_data['full_path'] );

                        unlink( $upload_data['full_path'] );
                        $this->getNext();
                }

		
	}

	private function _process_csv_file($csv_fullpath) {

					$csv = array_map("str_getcsv", file( $csv_fullpath ));

                        foreach($csv as $index => $line) {

                        	if( $index == 0 ) {
                        		continue;
                        	}

                        	$name_id = false;
                        	if( empty($line[0]) ) {
                        		if( !empty($line[1]) ) {
		                        	$name = new $this->Names_list_model;
									$name->setFullName($line[1], true);
									$name->setAddress($line[2]);
									$name->setContactNumber($line[3]);
									$name->setTrash('0');
									if( $name->nonEmpty() ) {
										$name_data = $name->getResults();
										$name_id = $name_data->id;
									} else {
										if( $name->insert() ) {
											$name_id = $name->get_inserted_id();
											record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'import', $this->session->userdata('current_company_id'), "Name Added: {$line[1]}", $name_id);
										}
										
									}
								}
                        	} else {
                        		$name_id = $line[0];
                        		if( !empty($line[1]) ) {
	                        		$name = new $this->Names_list_model;
									$name->setId($line[0], true, false);
									$name->setFullName($line[1], false, true);
									if( !empty($line[2]) ) {
										$name->setAddress($line[2],false,true);
									}
									if( !empty($line[3]) ) {
										$name->setContactNumber($line[3],false,true);
									}
									if($name->nonEmpty() ) {
										if( $name->update() ) {
											//record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'import', $this->session->userdata('current_company_id'), "Name Updated: {$line[1]}", $name_id);
										}
									}
								}
                        	}

                        	if( $name_id ) {

                        		$info = new $this->Names_info_model;
								$info->setNameId($name_id,true,true);

								if( !empty($line[4]) ) {
									$info->setLastname($line[4],false,true);
								}
								if( !empty($line[5]) ) {
									$info->setFirstname($line[5],false,true);
								}
								if( !empty($line[6]) ) {
									$info->setMiddlename($line[6],false,true);
								}
								if( !empty($line[7]) ) {
									$info->setBirthday( date("Y-m-d", strtotime($line[7])),false,true);
								}
								if( !empty($line[8]) ) {
									$info->setBirthplace($line[8],false,true);
								}
								if( !empty($line[9]) ) {
									$info->setCivilStatus($line[9],false,true);
								}
								if( !empty($line[10]) ) {
									$info->setGender($line[10],false,true);
								}
								if( !empty($line[11]) ) {
									$info->setPrefix($line[11],false,true);
								}
								if( !empty($line[12]) ) {
									$info->setSuffix($line[12],false,true);
								}
								if($info->nonEmpty() ) {
									if( $info->update() ) {
										//record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'import', $this->session->userdata('current_company_id'), "Profile Updated: {$line[1]}", $name_id);
									}
								} else {
									if( $info->insert() ) {
										//record_system_audit($this->session->userdata('user_id'), 'lists', 'names', 'import', $this->session->userdata('current_company_id'), "Profile Added: {$line[1]}", $name_id);
									}
								}

								$array_keys = array(
									2 => 'address',
									13 => 'email',
									14 => 'phone_number',
									15 => 'cell_smart',
									16 => 'cell_globe',
									17 => 'cell_sun',
									18 => 'tin', // ID-TIN
									19 => 'sss', // ID-SSS
									20 => 'phic', //ID-PHIC
									21 => 'hdmf', //ID-HDMF
									22 => 'drivers_license', //ID-Drivers
									23 => 'voters_number', //ID-Voters
									24 => 'emergency_name', // Emergency-Name
									25 => 'emergency_address', // Emergency-Address
									26 => 'emergency_contact', // Emergency-Phone
									27 => 'emergency_relationship', // Emergency-Relationship
									28 => 'facebook_id', // Facebook ID
									29 => 'twitter_id', // Twitter ID
									30 => 'instagram_id', // Instagram ID
									31 => 'skype_id', // Skype ID
									32 => 'yahoo_id', // Yahoo ID
									33 => 'google_id', // Google ID
								);

								foreach($array_keys as $index => $key) {
									if( !empty($line[$index]) ) {
										$this->_save_name_meta($name_id, $key, $line[$index]);
									}
								}
								/*
								if( !empty($line[2]) ) {
									$this->_save_name_meta($name_id, 'address', $line[2]);
								}
                        		if( !empty($line[13]) ) {
                        			$this->_save_name_meta($name_id, 'email', $line[13]);
                        		}
                        		if( !empty($line[14]) ) {
                        			$this->_save_name_meta($name_id, 'phone_number', $line[14]);
                        		}
                        		if( !empty($line[15]) ) {
                        			$this->_save_name_meta($name_id, 'cell_smart', $line[15]);
                        		}
                        		if( !empty($line[16]) ) {
                        			$this->_save_name_meta($name_id, 'cell_globe', $line[16]);
                        		}
                        		if( !empty($line[17]) ) {
                        			$this->_save_name_meta($name_id, 'cell_sun', $line[17]);
                        		}
                        		*/

                        	}
                        	
                        }

	}

	private function _save_name_meta($name_id, $meta_key, $meta_value, $audit=false, $method='',$message='') {
		$meta = new $this->Names_meta_model;
		$meta->setNameId($name_id,true);
		$meta->setMetaKey($meta_key,true);
		if( !empty( $meta_value ) ) {
			if( $meta->nonEmpty() ) {
				$meta->setMetaValue($meta_value,false,true);
				if( $meta->update() ) {
					if( $audit ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', $method, $this->session->userdata('current_company_id'), $message, $name_id);
					}
				}
			} else {
				$meta->setMetaValue($meta_value);
				if( $meta->insert() ) {
					if( $audit ) {
						record_system_audit($this->session->userdata('user_id'), 'lists', 'names', $method, $this->session->userdata('current_company_id'), $message, $name_id);
					}
				}
			}
		} else {
			if( $meta->delete() ) {
				if( $audit ) {
					record_system_audit($this->session->userdata('user_id'), 'lists', 'names', $method, $this->session->userdata('current_company_id'), $message, $name_id);
				}
			}
		}
	}

}
