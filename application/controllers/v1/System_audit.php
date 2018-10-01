<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_audit extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Audit Trail');
		$this->template_data->set('current_uri', 'system_audit');
		$this->template_data->set('navbar_search', false);

		$this->_isAuth('system', 'audit', 'view');

	}

	public function index($start=0) {

		$audit = new $this->System_audit_model('s');
		$audit->set_select('s.*');
		$audit->set_select('ua.name as user_name');
		$audit->set_join('user_accounts ua', 'ua.id=s.user_id');
		$audit->set_order('s.date_accessed', 'DESC');
		$audit->set_start($start);
		$this->template_data->set('audits', $audit->populate());

		$this->template_data->set('pagination', bootstrap_pagination(array(
			'base_url' => base_url($this->config->item('index_page') . '/system_audit/index/'),
			'total_rows' => $audit->count_all_results(),
			'per_page' => $audit->get_limit(),
			'ajax'=>true,
		)));

		$this->load->view('system/audit/audit_list', $this->template_data->get_data());
	}

}
