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

	private function _next($id, $url='lists_names/edit/') {
		$names = new $this->Names_list_model('nl');
		$names->setTrash(0, true);
			$where = new $this->Names_list_model('w');
			$where->set_select('MIN(w.id)');
			$where->set_where("w.id > " . $id);
			$where->set_limit(1);
		$names->set_limit(1);
		$names->set_select("nl.id");
		$names->set_select("CONCAT('{$url}',nl.id) as url");
		$names->set_where('id = ('. $where->get_compiled_select() . ')');
		return $names->get();
	}

	private function _previous($id, $url='lists_names/edit/') {
		$names = new $this->Names_list_model('nl');
		$names->setTrash(0, true);
			$where = new $this->Names_list_model('w');
			$where->set_select('MAX(w.id)');
			$where->set_where("w.id < " . $id);
			$where->set_limit(1);
		$names->set_limit(1);
		$names->set_select("nl.id");
		$names->set_select("CONCAT('{$url}',nl.id) as url");
		$names->set_where('id = ('. $where->get_compiled_select() . ')');
		return $names->get();
	}

	public function index($start=0) {
		
		if( $start > 0 ) {
			$this->_searchRedirect();
		}

		$names = new $this->Names_list_model('nl');
		$names->setTrash(0, true);

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
		$this->template_data->set('next_item', $this->_next($id));
		$this->template_data->set('previous_item', $this->_previous($id));
		
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
			$this->template_data->set('employee', $employee->get());
		}

		$this->template_data->set('next_item', $this->_next($id, 'lists_names/profile/'));
		$this->template_data->set('previous_item', $this->_previous($id, 'lists_names/profile/'));

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
				$info->setPrefix($this->input->post('prefix'),false,true);
				$info->setSuffix($this->input->post('suffix'),false,true);
				if( $info->nonEmpty() ) {
					$info->update();
				} else {
					$info->setNameId($id,true,true);
					$info->insert();
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
						$meta->update();
					} else {
						$meta->setMetaValue($value);
						$meta->insert();
					}
				} else {
					$meta->delete();
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
						$meta->update();
					} else {
						$meta->setMetaValue($value);
						$meta->insert();
					}
				} else {
					$meta->delete();
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
						$meta->update();
					} else {
						$meta->setMetaValue($value);
						$meta->insert();
					}
				} else {
					$meta->delete();
				}
			}
			$this->postNext("active=ids");
		}

		$meta = new $this->Names_meta_model('nc');
		$meta->setNameId($id,true);
		$meta->setMetaKey('tin',true);
		$meta->set_select('nc.meta_value as tin');

		foreach(array('sss','hdmf','phic','drivers_license','voters_number') as $k) {
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
						$meta->update();
					} else {
						$meta->setMetaValue($value);
						$meta->insert();
					}
				} else {
					$meta->delete();
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

}
