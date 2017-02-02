<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if( ! $inner_page ): ?> 
  <?php if( ! $body_wrapper ): ?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : 'COOP'; ?></title>
    <link href="<?php echo base_url('assets/themes/' . ((isset($bootstrap_theme)) ? $bootstrap_theme : 'default' ) . '/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/jqueryui/jquery-ui.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/icons/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/icons/material-icons/material-icons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/icons/dashicons/css/dashicons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/icons/ionicons/css/ionicons.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/icons/octicons/octicons.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/icons/genericons/genericons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/icons/devicons/css/devicons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/bootstrap-select/css/bootstrap-select.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/tag-it/css/jquery.tagit.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom/' . ((isset($bootstrap_theme)) ? $bootstrap_theme : 'default' ) . '.css'); ?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body >

<?php $this->load->view('navbar'); ?>

<div id="bodyWrapper">

<?php endif; // static_nav ?>

<?php 
if( $this->input->get('error_code') ) { 
  $errData = (isset($errorData)) ? $errorData : NULL;
  showError( $this->input->get('error_code'), $errData); 
}
?>

<?php endif; // inner_page ?>