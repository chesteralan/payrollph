<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME; ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
<?php if( $print_css ) { ?>
<style>
<!--
<?php echo unserialize($print_css->value); ?>

-->
</style>
<?php } ?>
  </head>
  <body id="payslip" class="<?php echo (isset($paper_size)) ? $paper_size : ''; ?>">

<div class="print-topnav hide-print text-center allcaps">
  <a href="<?php echo site_url("payroll/select_payroll/{$payroll->id}"); ?>">Back</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}"); ?>">Print</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/payslip"); ?>">All</a>
    <?php 
  if( ( isset($print_group_option) ) && ( $print_group_option ) )  {
  $pg_option = unserialize( $print_group_option->value );
  $pg_sort = array();
  if($pg_option) foreach($pg_option as $pgok => $pgov) {
      $pg_sort[$pgov] = $pgok;
  }

  $pgs = array();
   if($print_groups) foreach($print_groups as $pg) {
      $pgs[$pg_sort[$pg->id]] = $pg;
  }
  ksort($pgs);
  foreach($pgs as $pg) { ?>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$pg->id}/payslip"); ?>"><?php echo $pg->name; ?></a>
  <?php } ?>
  <?php } ?>
  <?php if( $print_group_option ) { ?>
   &middot; <a href="<?php echo site_url("payroll_overall/summary/{$payroll->id}"); ?>">Summary</a>
  <?php } ?>
</div>

<?php if( (isset($payroll_groups)) && ($payroll_groups ) ) { 

$box_count = 0;
  ?>
<?php foreach($payroll_groups as $payroll_group) { ?>
<?php if($payroll_group->employees) { 
        foreach($payroll_group->employees as $employee) { 
            $box_count++;
            $template_data = array(
                'box_count' => $box_count,
                'employee' => $employee,
            );
    if( $employee->payslip_template == 'payslip') {

        $this->load->view('payroll/payroll/overall/overall_payslip_payslip', $template_data);

    } elseif( $employee->payslip_template == 'payslip2') {

        $this->load->view('payroll/payroll/overall/overall_payslip_payslip2', $template_data); 

    } elseif( $employee->payslip_template == 'cash_voucher') {

        $this->load->view('payroll/payroll/overall/overall_payslip_voucher', $template_data); 

    }
} ?>
<?php } ?>
<?php } ?>
<?php } ?>


  </body>
</html>
