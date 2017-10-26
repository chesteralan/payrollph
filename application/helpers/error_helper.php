<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('showError') ) {
	function showError($code, $errorData=NULL) {
		$error = array(
            // lending
            '101' => array(
                'type' => 'success',
                'msg' =>'<strong>Employee Filter!</strong> Successfully Filtered!',
                ),
            '102' => array(
                'type' => 'success',
                'msg' =>'<strong>Employee Filter!</strong> Removed Successfully!',
                ),
            '106' => array(
                'type' => 'danger',
                'msg' =>'<strong>No Column Group Selected!</strong> Please contact admin to add column group!',
            ),
            '106' => array(
                'type' => 'danger',
                'msg' =>'<strong>No Column Group Selected!</strong> Please contact admin to add column group!',
            ),
                
        );

        if( isset($error[$code]) ) {
            $type = (isset($error[$code]['type'])) ? $error[$code]['type'] : 'default';
echo <<<ERR
<div class="container">
<div class="alert alert-{$type} alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {$error[$code]['msg']}
</div>
</div>
ERR;
        }
	}
}