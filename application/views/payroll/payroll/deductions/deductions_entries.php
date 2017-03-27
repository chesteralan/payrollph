<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a class="btn btn-success btn-xs pull-right" href="<?php echo site_url("payroll_deductions/add/{$payroll_id}/{$name_id}/{$deduction_id}") . '?next=' . uri_string(); ?>">Add Earning</a>
          <h3 class="panel-title"><?php echo $deduction_data->name; ?></h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( isset($output) && ($output=='ajax') ) : ?>
<p class="text-center"><a href="<?php echo site_url("payroll_deductions/add/{$payroll_id}/{$name_id}/{$deduction_id}/ajax") . '?next=' . uri_string(); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Add Entry">Add Entry</a></p>
<?php endif; ?>

<?php if( $deductions ) { ?>

<div class="list-group">

<?php 

foreach($deductions as $deduction) {   ?>

  <a data-target="#ajaxModal" data-title="Edit Entry" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll_deductions/edit/{$deduction->ped_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
  <span class="badge pull-right"><?php echo number_format($deduction->ped_amount,2); ?></span>
    <h4 class="list-group-item-heading"><?php echo $deduction->name; ?> (<?php echo number_format($deduction->max_amount,2); ?>)</h4>
    <p class="list-group-item-text">Entry ID # <?php echo $deduction->entry_id; ?><?php echo ($deduction->dnotes!="") ? ' - '.$deduction->dnotes : ''; ?></p>
  </a>

<?php } ?>

</div>

<?php } else { ?>

<p class="text-center">No Entry Found!</p>

<?php }  ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>

      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>