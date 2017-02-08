<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                
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
                $this->template_data->set('bootstrap_theme', $bootstrap_theme);

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
}