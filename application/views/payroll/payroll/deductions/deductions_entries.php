<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a class="btn btn-success btn-xs pull-right" href="<?php echo site_url("payroll_deductions/add/{$payroll_id}/{$name_id}/{$deduction_id}") . '?next=' . uri_string(); ?>">Add Entry</a>
          <a style="margin-right:10px" class="btn btn-warning btn-xs pull-right" href="<?php echo site_url("employees_deductions/summary/{$deduction_id}/{$name_id}") . '?next=' . uri_string(); ?>">Summary</a>
          <h3 class="panel-title"><?php echo $deduction_data->name; ?></h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( isset($output) && ($output=='ajax') ) : ?>
<?php if(!$payroll->lock) { ?>
<p><a href="<?php echo site_url("payroll_deductions/add/{$payroll_id}/{$name_id}/{$deduction_id}/ajax") . '?next=' . uri_string(); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Add Entry - <?php echo $deduction_data->name; ?>">Add Payroll Entry</a> <em><small> - This will add an item to this current payroll only.</small></em>
</p>
<?php } ?>
<p>
<a href="<?php echo site_url("employees_deductions/summary/{$deduction_id}/{$name_id}/ajax") . '?next=' . uri_string(); ?>" class="btn btn-warning btn-xs ajax-modal-inner" data-title="Summary - <?php echo $deduction_data->name; ?>" data-hide_footer="1">Summary</a>
</p>
<?php endif; ?>

<?php if( $deductions ) { ?>

<div class="list-group">

<?php 

foreach($deductions as $deduction) {   ?>

<?php if($payroll->lock) { ?>
  <div class="list-group-item">
<?php } else { ?>
  <a data-target="#ajaxModal" data-title="Edit Entry" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll_deductions/edit/{$deduction->ped_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
<?php } ?>

  <span class="badge pull-right"><?php echo number_format($deduction->ped_amount,2); ?></span>
    <h4 class="list-group-item-heading"><?php echo $deduction->name; ?> <?php echo ($deduction->max_amount > 0) ? "(".number_format($deduction->max_amount,2).")" : ''; ?></h4>
    <p class="list-group-item-text"><?php if( $deduction->entry_id ) { ?>Entry ID # <?php echo $deduction->entry_id; ?> &middot; <?php } ?><?php echo ($deduction->dnotes!="") ? $deduction->dnotes : ''; ?></p>

<?php if($payroll->lock) { ?>
  </div>
<?php } else { ?>
    </a>
<?php } ?>

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