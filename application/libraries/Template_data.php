<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Template_data {
    
    var $CI;
    private $data = array();

    public function __construct()
    {
       $this->CI =& get_instance();
    }
            
    function set($key, $value=NULL)
    {
        if( is_array($key) ) {
            foreach($key as $k=>$v) {
                $this->data[$k] = $v;
            }
        } else {
            $this->data[$key] = $value;
        }
    }
    
    function get($key)
    {
        return (isset($this->data[$key])) ? $this->data[$key] : null;
    }
    
    function get_data() {
        $this->opengraph();
        return $this->data;
    }

    function prepend($key, $value)
    {
        $current_value = $this->get($key);
        $this->set($key, $value . $current_value );  
    }
    
    function append($key, $value)
    {
        $current_value = $this->get($key);
        $this->set($key, $current_value . $value );        
    }
            
    function opengraph( $var=array() ) {
        $defaults = array(
            'fb:app_id' => $this->get('fb_app_id'),
            'og:title'=> $this->get('title'),
            'og:site_name'=>$this->CI->config->item('website_title'),
            'og:description'=>$this->CI->config->item('website_description'),
            'og:url'=> site_url( trim( uri_string(), "/") ),
            'og:type'=>'article',
            'og:image'=>'',
            'og:image:width'=>'289',
            'og:image:height'=>'102',
        );
        
        $opengraph = array_merge( (array) $defaults, (array) $var );
        $meta = '';
        foreach( $opengraph as $tag=>$value ) {
            if( $value != '' ) {
                $meta .= "\n" . '<meta property="'.$tag.'" content="'.$value.'" />';            
            }
        }
        $this->set('opengraph', $meta );
    }
    
}

/* End of file Global_variables.php */