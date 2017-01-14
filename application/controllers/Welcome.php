<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('User_accounts_model');
		$this->load->model('Names_list_model');
	}

	public function index() {

		$stats = new $this->User_accounts_model('ua');
		$stats->set_select('(SELECT count(*) FROM user_accounts) as users_count');
		$this->template_data->set('stats', $stats->get());
		
		$this->load->view('welcome/welcome', $this->template_data->get_data());
	}

	public function ajax($action='') {
		$results = array();
		switch($action) {
			case 'change_member':

				if( ! $this->_isAuth('membership', 'members', 'view', 'welcome', true) ) {
					break;
				}

				$names = new $this->Names_list_model;

				if( $this->input->get('term') ) {
					$names->set_where('full_name LIKE "%' . $this->input->get('term') . '%"');
				}

				$names->set_select("coop_names.*");

				$names->set_select("(SELECT COUNT(*) FROM members WHERE members.id=coop_names.id) as members");
				$names->set_select("(SELECT COUNT(*) FROM companies WHERE companies.id=coop_names.id) as companies");

				$names->set_where("( ( (SELECT COUNT(*) FROM members WHERE members.id=coop_names.id) > 0 )");
				$names->set_where_or("( (SELECT COUNT(*) FROM companies WHERE companies.id=coop_names.id) > 0 ) )");

				$names->set_order('full_name', 'ASC');
				$names->set_limit(0); 

				foreach($names->populate() as $name) {
					if( $name->members > 0) {
						$uri = ($this->input->get('sub_uri')) ? explode('/', str_replace(base_url(), '', $this->input->get('sub_uri'))) : array("membership_members", "member_data");

						if( isset($uri[0]) && ($uri[0] == 'services_lending') ) {
							switch( $uri[1] ) {
								case 'index':
									$uri[1] = 'overview';
								break;
								case 'payment_apply':
									$uri[1] = 'payments';
								break;
								case 'schedule':
									$uri[1] = 'loans';
								break;
								default:
									$uri[1] = 'overview';
								break;
							} 
						} elseif( isset($uri[0]) && ($uri[0] == 'services_shares') ) {
							switch( $uri[1] ) {
								case 'index':
									$uri[1] = 'overview';
								break;
								default:
									$uri[1] = 'overview';
								break;
							}
						} elseif( isset($uri[0]) && ($uri[0] == 'membership_members') ) {
							
						} else {
							$uri = array("membership_members", "member_data");
						}

						if( !isset($uri[1]) ) {
							$uri[1] = 'index';
						}

						$redirect_uri = "{$uri[0]}/{$uri[1]}/{$name->id}";
						
					}
					if( $name->companies > 0) {
						$redirect_uri = "membership_companies/info/{$name->id}";
					}
					$results[] = array(
						'label' => $name->full_name,
						'id' => $name->id,
						'redirect'=> site_url( $redirect_uri ),
						);
				}
			break;
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode( $results ));
	}

}
