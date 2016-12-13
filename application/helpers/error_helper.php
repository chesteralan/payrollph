<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('showError') ) {
	function showError($code) {
		$error = array(
            // lending
            '998' => array(
                'type' => 'danger',
                'msg' =>'<strong>Error!</strong>',
                ),
             '999' => array(
                'type' => 'success',
                'msg' =>'<strong>Success!</strong>',
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