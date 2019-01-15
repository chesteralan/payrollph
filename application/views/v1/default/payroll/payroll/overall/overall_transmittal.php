<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME; ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
    <style type="text/css">
      <!--
tr:hover{
  background: #FFF;
}
      -->
    </style>
  </head>
  <body id="payroll_print">

<div class="print-topnav hide-print text-center allcaps">
  <a href="<?php echo site_url("payroll/select_payroll/{$payroll->id}"); ?>">Back</a>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/print"); ?>">Print</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/payslip"); ?>">Payslip</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/{$output}/{$current_page}"); ?>">All</a>
  <?php if(isset($print_groups)) foreach($print_groups as $pg) { ?>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$pg->id}/{$output}/{$current_page}"); ?>"><?php echo $pg->name; ?></a>
  <?php } ?>
  &middot; <a href="<?php echo site_url("payroll_overall/config/{$payroll->id}") . "?next=" . uri_string(); ?>">Config</a>
</div>

<?php if($template->pages > 1) { ?>
<div class="print-topnav topnav2 hide-print text-center allcaps">
    <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/1"); ?>">Page 1</a>
<?php for($i=2;$i <= $template->pages; $i++) { ?>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/{$i}"); ?>">Page <?php echo $i; ?></a>
<?php } ?>
</div>
<?php } ?>

<h2 class="pull-right">PAYROLL #: <?php echo $payroll->id; ?></h2>
<div class="header-title">
<h2 class="allcaps"><?php echo ($company->name) ? $company->name : ''; ?></h2>
<h3><?php echo ($company->address) ? $company->address : ''; ?></h3>
<h3><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
</div>

<div class="full-border padding3">
  <h3>TRANSMITTAL SHEET</h3>
  For the period covered <?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?>
</div>


<?php if( $payroll_groups ) {  ?>
  <div class="payroll">

<?php foreach($payroll_groups as $payroll_group) { ?>
  <?php if($payroll_group->employees) { ?>
          <table width="100%" cellspacing="0" cellpadding="0" class="table" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning highlight allcaps">
                <th class="text-left allcaps" width=""><?php echo $payroll_group->name; ?></th>
                <th width="" class="text-right allcaps">SIGNATURE</th>

              </tr>

            </thead>
            <tbody>
<?php foreach($payroll_group->employees as $employee) { ?>
            <tr>
              <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></td>
              <td></td>
            </tr>
<?php } ?>

            </tbody>
          </table>
<?php } ?>
<?php } ?>



</div>

<?php } ?>



  </body>
</html>
