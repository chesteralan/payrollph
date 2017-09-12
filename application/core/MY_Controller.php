<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Controller extends CI_Controller {
    public function __construct()
        {
            parent::__construct();

            if( (USER_AGENT_CHECK) && ((!$this->input->get_request_header('User-Agent')) || ( $this->input->get_request_header('User-Agent') != USER_AGENT_CHECK ) )) {
                    show_404();
            }

            $this->template_data->set('page_title', 'Payroll PH');

            $this->template_data->set('inner_page', false);
            if( $this->input->post('output') == 'inner_page') {
                $this->template_data->set('inner_page', true);
            }

            $this->template_data->set('body_wrapper', false);
            if( $this->input->post('output') == 'body_wrapper') {
                $this->template_data->set('body_wrapper', true);
            }

            // default,cerulean,cosmo,cyborg,darkly,flatly,journal,lumen,paper,readable,sandstone,simplex,slate,spacelab,superhero,united,yeti
            $bootstrap_theme = ( isset($this->session->user_settings['theme']) && $this->session->user_settings['theme'] ) ? $this->session->user_settings['theme'] : 'yeti';
            $bootstrap_theme = ($this->session->userdata( 'current_company_theme' )) ? $this->session->userdata( 'current_company_theme' ) : $bootstrap_theme;
            
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
                $this->template_data->set('page_title', APP_NAME);
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
                $bootstrap_theme = ( isset($this->session->user_settings['theme']) && $this->session->user_settings['theme'] ) ? $this->session->user_settings['theme'] : 'yeti';
                $bootstrap_theme = ($this->session->userdata( 'current_company_theme' )) ? $this->session->userdata( 'current_company_theme' ) : $bootstrap_theme;
                $this->template_data->set('bootstrap_theme', $bootstrap_theme);

                $this->_load_models();
                
                $this->config->load('payroll');

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
                            $url = site_url($this->input->get('next'));
                            if( $query_string ) {
                                    $url .= "?" . $query_string;
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
                    $url = site_url($this->input->get('next'));
                    redirect( $url );
            } else {
                redirect( $else );
            }
        }

        protected function _load_models() {
            $this->load->model('Account_sessions_model');
            $this->load->model('Benefits_list_model');
            $this->load->model('Companies_list_model');
            $this->load->model('Deductions_list_model');
            $this->load->model('Earnings_list_model');
            $this->load->model('Employees_absences_model');
            $this->load->model('Employees_absenses_model');
            $this->load->model('Employees_areas_model');
            $this->load->model('Employees_benefits_model');
            $this->load->model('Employees_benefits_templates_model');
            $this->load->model('Employees_contacts_model');
            $this->load->model('Employees_deductions_model');
            $this->load->model('Employees_deductions_templates_model');
            $this->load->model('Employees_earnings_model');
            $this->load->model('Employees_earnings_templates_model');
            $this->load->model('Employees_groups_model');
            $this->load->model('Employees_leave_benefits_model');
            $this->load->model('Employees_model');
            $this->load->model('Employees_positions_model');
            $this->load->model('Employees_salaries_model');
            $this->load->model('Names_list_model');
            $this->load->model('Payroll_benefits_model');
            $this->load->model('Payroll_deductions_model');
            $this->load->model('Payroll_earnings_model');
            $this->load->model('Payroll_employees_benefits_model');
            $this->load->model('Payroll_employees_deductions_model');
            $this->load->model('Payroll_employees_earnings_model');
            $this->load->model('Payroll_employees_model');
            $this->load->model('Payroll_employees_salaries_model');
            $this->load->model('Payroll_groups_model');
            $this->load->model('Payroll_inclusive_dates_model');
            $this->load->model('Payroll_model');
            $this->load->model('Payroll_templates_benefits_model');
            $this->load->model('Payroll_templates_columns_model');
            $this->load->model('Payroll_templates_deductions_model');
            $this->load->model('Payroll_templates_earnings_model');
            $this->load->model('Payroll_templates_employees_model');
            $this->load->model('Payroll_templates_groups_model');
            $this->load->model('Payroll_templates_model');
            $this->load->model('Terms_list_model');
            $this->load->model('User_accounts_companies_model');
            $this->load->model('User_accounts_model');
            $this->load->model('User_accounts_options_model');
            $this->load->model('User_accounts_restrictions_model');
        }
}