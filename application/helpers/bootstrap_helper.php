<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('bootstrap_pagination'))
{
    function bootstrap_pagination($config=array(), $url_suffix=NULL)
    {
        $defaults['base_url'] = base_url();
        $defaults['total_rows'] = 10;
        $defaults['per_page'] = 0;
        $defaults['full_tag_open'] = '<div class="pagination btn-group btn-group-sm">';
        $defaults['full_tag_close'] = '</div>';

        $defaults['cur_tag_open'] = '<div class="btn btn-default active"><strong>';
        $defaults['cur_tag_close'] = '</strong></div>';

        $defaults['attributes'] = array('class' => 'btn btn-default');
        
        $new_config = array_merge($defaults, $config);

        if( isset($config['ajax']) && ($config['ajax']===true) ) {
            $new_config['attributes']['class'] .= ' ajaxPage';
        }

        $CI = get_instance();
        $pagination = new $CI->pagination;
        $pagination->initialize($new_config);

        $pagination_html = $pagination->create_links();
        if( $url_suffix ) {
            $pagination_html = str_replace('" class="', $url_suffix . '" class="', $pagination_html);
        }
        return $pagination_html;
    }
}

if ( ! function_exists('bootstrap_alert'))
{
    function bootstrap_alert($message, $type='success')
    {
        $html = '<div class="alert alert-'.$type.' alert-dismissible" role="alert">';
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        $html .= $message.'</div>';
        return $html;
    }
}

// ------------------------------------------------------------------------