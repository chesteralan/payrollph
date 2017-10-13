<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Print Payroll</h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<ul class="list-group">
 <li class="list-group-item">

      <a class="pull-right" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/denomination"); ?>" style="margin-left:10px"><span class="fa fa-money"></span></a>

            <a class="pull-right" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/payslip"); ?>" style="margin-left:10px"><span class="glyphicon glyphicon-th-large"></span></a>

      <a class="pull-right" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/print"); ?>" style="margin-left:10px"><span class="glyphicon glyphicon-print"></span></a>

    <h4 class="list-group-item-heading">All Employees</h4>
  </li>
  <?php 
$pg_option = (isset($print_group_option) && ($print_group_option)) ? unserialize( $print_group_option->value ) : false;
if( $pg_option ) {

  $pg_sort = array();
  foreach($pg_option as $pgok => $pgov) {
      $pg_sort[$pgov] = $pgok;
  }

  $pgs = array();
  foreach($print_groups as $pg) {
      $pgs[$pg_sort[$pg->id]] = $pg;
  }
  ksort($pgs);
  foreach($pgs as $group) { 
?>
  <li class="list-group-item">

      <a class="pull-right" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$group->id}/denomination"); ?>" style="margin-left:10px"><span class="fa fa-money"></span></a>

            <a class="pull-right" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$group->id}/payslip"); ?>" style="margin-left:10px"><span class="glyphicon glyphicon-th-large"></span></a>

      <a class="pull-right" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$group->id}/print"); ?>" style="margin-left:10px"><span class="glyphicon glyphicon-print"></span></a>


    <h4 class="list-group-item-heading"><?php echo $group->name; ?></h4>
  </li>
  <?php } ?>
  <?php } ?>
</ul>


<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>

      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>