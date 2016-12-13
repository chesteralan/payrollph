<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                
                if( ! $this->session->loggedIn || ! isset($this->session->loggedIn) ) {
                	$this->session->sess_destroy();
                	redirect('account/login');
                }

                $this->template_data->set('session_auth', $this->session->session_auth);
                $this->template_data->set('page_title', 'PAYROLL');
                $this->template_data->set('output', '');
        }

        public function _isAuth($module, $action='view', $uri=false) {
        	
                $auth = false;

                if( isset( $this->session->session_auth ) ) {
                	if( isset($this->session->session_auth->$module) ) {
                		if( isset($this->session->session_auth->$module->$action) ) {
                			$auth = (bool) $this->session->session_auth->$module->$action;
                		}
                	} 
                }

        	if( $auth ) {
                        
                        return $auth;

                } else {
                        
                        if( $uri == '') {

                                $uri = 'welcome';

                        }
        		redirect( $uri, 'refresh' );
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
}