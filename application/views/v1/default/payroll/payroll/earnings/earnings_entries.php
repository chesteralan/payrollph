<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a class="btn btn-success btn-xs pull-right" href="<?php echo payroll_url("payroll_earnings/add/{$payroll_id}/{$name_id}/{$earning_id}"); ?>">Add Earning</a>
          <h3 class="panel-title"><?php echo $earning_data->name; ?></h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( isset($output) && ($output=='ajax') && (!$payroll->lock) && (!$this->input->get('lock')) ) : ?>

<p><a href="<?php echo payroll_url("payroll_earnings/add/{$payroll_id}/{$name_id}/{$earning_id}/ajax"); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Add Payroll Entry">Add Payroll Entry</a> <em><small> - This will add an item to this current payroll only.</small></em>
</p>

<?php endif; ?>

<?php if( $earnings ) { ?>

<div class="list-group">

<?php 

foreach($earnings as $earning) { ?>
<?php if(($payroll->lock)||($this->input->get('lock'))) { ?>
  <div class="list-group-item">
<?php } else { ?>
   <a data-target="#ajaxModal" data-title="Edit Entry" class="list-group-item ajax-modal-inner" href="<?php echo payroll_url("payroll_earnings/edit/{$earning->pee_id}/{$output}"); ?>">
<?php } ?>
 
  <span class="badge pull-right"><?php echo number_format($earning->pee_amount,2); ?></span>
    <h4 class="list-group-item-heading"><?php echo $earning->name; ?></h4>
    <p class="list-group-item-text"><?php if($earning->entry_id) { ?>Entry ID # <?php echo $earning->entry_id; ?> &middot; <?php } ?><?php echo ($earning->enotes!='') ? $earning->enotes : ''; ?></p>

<?php if(($payroll->lock)||($this->input->get('lock'))) { ?>
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