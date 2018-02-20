<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Controller extends CI_Controller {
    public function __construct()
        {
            parent::__construct();

            if( (USER_AGENT_CHECK) && ((!$this->input->get_request_header('User-Agent')) || ( $this->input->get_request_header('User-Agent') != USER_AGENT_CHECK ) )) {
                    show_404();
            }

            $this->template_data->set('page_title', $this->config->item('system_name'));

            $this->template_data->set('inner_page', false);
            if( $this->input->post('output') == 'inner_page') {
                $this->template_data->set('inner_page', true);
            }
            if( $this->input->get('output') == 'inner_page') {
                $this->template_data->set('inner_page', true);
            }

            $this->template_data->set('body_wrapper', false);
            if( $this->input->post('output') == 'body_wrapper') {
                $this->template_data->set('body_wrapper', true);
            }
            if( $this->input->get('output') == 'body_wrapper') {
                $this->template_data->set('body_wrapper', true);
            }

            // default,cerulean,cosmo,cyborg,darkly,flatly,journal,lumen,paper,readable,sandstone,simplex,slate,spacelab,superhero,united,yeti
            $themes = array('default','cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti');
            $bootstrap_theme = $themes[array_rand($themes)];
            
            $this->template_data->set('bootstrap_theme', $bootstrap_theme);

    }
}

class MY_Controller extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                if( (USER_AGENT_CHECK) && ((!$this->input->get_request_header('User-Agent')) || ( $this->input->get_request_header('User-Agent') != USER_AGENT_CHECK ) )) {
                        show_404();
                }

                if( ! $this->session->loggedIn || ! isset($this->session->loggedIn) ) {
                	$this->session->sess_destroy();
                	redirect( site_url( 'account/login' ) . "?next=" . urlencode( uri_string()) );
                }

                $this->template_data->set('session_auth', $this->session->session_auth);
                $this->template_data->set('page_title',  APP_NAME . " - " . $this->session->userdata( 'current_company' ));
                $this->template_data->set('output', '');

                $this->template_data->set('inner_page', false);
                if( $this->input->post('output') == 'inner_page') {
                    $this->template_data->set('inner_page', true);
                }

                $this->template_data->set('body_wrapper', false);
                if( $this->input->post('output') == 'body_wrapper') {
                    $this->template_data->set('body_wrapper', true);
                }

                // default,cerulean,cosmo,cyborg,darkly,flatly,journal,lumen,paper,readable,sandstone,simplex,slate,spacelab,superhero,united,yeti
                $bootstrap_theme = ($this->session->userdata( 'current_company_theme' )) ? $this->session->userdata( 'current_company_theme' ) : 'yeti';
                $bootstrap_theme = ( isset($this->session->user_settings['theme']) && ($this->session->user_settings['theme'] != '_company_theme_') ) ? $this->session->user_settings['theme'] : $bootstrap_theme;
                
                $this->template_data->set('bootstrap_theme', $bootstrap_theme);

        }

        public function _isCompanyId() {
            if( ! $this->session->userdata('current_company_id') ) {
                show_404();
            }
        }

        public function _isAuth($dept, $sect=NULL, $action='view', $uri=false, $return=false) {
        	
            $auth = false;
            if( isset( $this->session->session_auth ) ) {
            	if( isset($this->session->session_auth[$dept] ) ) {
                    if( isset($this->session->session_auth[$dept][$sect]) ) {
                		if( isset($this->session->session_auth[$dept][$sect][$action]) ) {
                			$auth = (bool) $this->session->session_auth[$dept][$sect][$action];
                		}
                    }
            	} 
            }

        	if( !$auth && !$return ) {
                        if( $uri == '') {
                                if ( $this->session->referrer_uri != '' )
                                {
                                    $uri = $this->session->referrer_uri;
                                } else {
                                    $uri = 'welcome';
                                }
                                if( uri_string() == $uri ) {
                                    $uri = 'welcome';
                                }
                        }

        		  redirect( site_url( $uri ) . "?error_code=999" );

        	}

            if( $auth ) {
                $this->session->set_userdata( 'referrer_uri', uri_string() );
            }

            if( $return ) {
                $this->session->set_userdata( 'referrer_uri', uri_string() );
                return $auth;
            }

        }

        public function postNext($query_string=null, $output='') {
            if( $this->input->post() ) {
                    if( $this->input->get('next') ) {
                            $url = site_url($this->input->get('next')) . "?";
                            $next_query = unserialize( urldecode($this->input->get('next_query')) );
                            if( $next_query ) {
                                $url .= "&" . http_build_query($next_query);
                            }
                            if( $query_string ) {
                                    $url .= "&" . $query_string;
                            }

                            redirect( $url );
                    } else {
                        if($output=='ajax') {
                                redirect( "/" );
                        }
                    }
            }
        }

        public function getNext($else='') {
            if( $this->input->get('next') ) {
                    $url = site_url($this->input->get('next')) . "?";
                    $next_query = unserialize( urldecode($this->input->get('next_query')) );
                    if( $next_query ) {
                        $url .= "&" . http_build_query($next_query);
                    }
                    if( $query_string ) {
                            $url .= "&" . $query_string;
                    }
                    redirect( $url );
            } else {
                redirect( $else );
            }
        }

        protected function _next_name($id, $url='lists_names/edit/') {
            $names = new $this->Names_list_model('nl');
            $names->setTrash(0, true);
                $where = new $this->Names_list_model('w');
                $where->setTrash(0, true);
                $where->set_select('MIN(w.id)');
                $where->set_where("w.id > " . $id);
                $where->set_limit(1);
            $names->set_limit(1);
            $names->set_select("nl.id");
            $names->set_select("CONCAT('{$url}',nl.id) as url");
            $names->set_where('id = ('. $where->get_compiled_select() . ')');
            return $names->get();
        }

        protected function _previous_name($id, $url='lists_names/edit/') {
            $names = new $this->Names_list_model('nl');
            $names->setTrash(0, true);
                $where = new $this->Names_list_model('w');
                $where->setTrash(0, true);
                $where->set_select('MAX(w.id)');
                $where->set_where("w.id < " . $id);
                $where->set_limit(1);
            $names->set_limit(1);
            $names->set_select("nl.id");
            $names->set_select("CONCAT('{$url}',nl.id) as url");
            $names->set_where('id = ('. $where->get_compiled_select() . ')');
            return $names->get();
        }

        protected function _next_employee($id, $url='payroll_dtr/by_name/') {
            $names = new $this->Employees_model('nl');
            $names->setCompanyId($this->session->userdata('current_company_id'),true);
            $names->setTrash(0, true);
                $where = new $this->Employees_model('w');
                $where->setCompanyId($this->session->userdata('current_company_id'),true);
                $where->setTrash(0, true);
                $where->set_select('MIN(w.name_id)');
                $where->set_where("w.name_id > " . $id);
                $where->set_limit(1);
            $names->set_limit(1);
            $names->set_select("nl.name_id");
            $names->set_select("CONCAT('{$url}',nl.name_id) as url");
            $names->set_where('nl.name_id = ('. $where->get_compiled_select() . ')');
            return $names->get();
        }

        protected function _previous_employee($id, $url='payroll_dtr/by_name/') {
            $names = new $this->Employees_model('nl');
            $names->setCompanyId($this->session->userdata('current_company_id'),true);
            $names->setTrash(0, true);
                $where = new $this->Employees_model('w');
                $where->setCompanyId($this->session->userdata('current_company_id'),true);
                $where->setTrash(0, true);
                $where->set_select('MAX(w.name_id)');
                $where->set_where("w.name_id < " . $id);
                $where->set_limit(1);
            $names->set_limit(1);
            $names->set_select("nl.name_id");
            $names->set_select("CONCAT('{$url}',nl.name_id) as url");
            $names->set_where('name_id = ('. $where->get_compiled_select() . ')');
            return $names->get();
        }

        protected function _next_payroll($id, $group_id=0, $url='payroll_dtr/view/') {
            $payroll = new $this->Payroll_model('p');
            $payroll->setActive(1, true);
            $payroll->setCompanyId($this->session->userdata('current_company_id'),true);
                $where = new $this->Payroll_model('w');
                $where->setActive(1, true);
                $where->set_select('MIN(w.id)');
                $where->set_where("w.id > " . $id);
                $where->setCompanyId($this->session->userdata('current_company_id'),true);
                $where->set_limit(1);
            $payroll->set_limit(1);
            $payroll->set_select("p.id");
            $payroll->set_select("CONCAT('{$url}',p.id,'/',{$group_id}) as url");
            $payroll->set_where('id = ('. $where->get_compiled_select() . ')');
            return $payroll->get();
        }

        protected function _previous_payroll($id, $group_id=0, $url='payroll_dtr/view/') {
            $payroll = new $this->Payroll_model('p');
            $payroll->setActive(1, true);
            $payroll->setCompanyId($this->session->userdata('current_company_id'),true);
                $where = new $this->Payroll_model('w');
                $where->setActive(1, true);
                $where->set_select('MAX(w.id)');
                $where->set_where("w.id < " . $id);
                $where->setCompanyId($this->session->userdata('current_company_id'),true);
                $where->set_limit(1);
            $payroll->set_limit(1);
            $payroll->set_select("p.id");
            $payroll->set_select("CONCAT('{$url}',p.id,'/',{$group_id}) as url");
            $payroll->set_where('id = ('. $where->get_compiled_select() . ')');
            return $payroll->get();
        }

        protected function _column_groups() {
            $this->template_data->set('column_group_dtr', get_company_option($this->session->userdata('current_company_id'), 'column_group_dtr'));
            $this->template_data->set('column_group_salaries', get_company_option($this->session->userdata('current_company_id'), 'column_group_salaries'));
            $this->template_data->set('column_group_earnings', get_company_option($this->session->userdata('current_company_id'), 'column_group_earnings'));
            $this->template_data->set('column_group_benefits', get_company_option($this->session->userdata('current_company_id'), 'column_group_benefits'));
            $this->template_data->set('column_group_deductions', get_company_option($this->session->userdata('current_company_id'), 'column_group_deductions'));
            $this->template_data->set('column_group_summary', get_company_option($this->session->userdata('current_company_id'), 'column_group_summary'));
            $this->template_data->set('column_group_sort', get_company_option($this->session->userdata('current_company_id'), 'column_group_sort'));
        }
    
}