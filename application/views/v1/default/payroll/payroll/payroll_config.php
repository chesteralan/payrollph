<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configure Payroll</h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<div class="list-group">

  <a data-target="#ajaxModal" data-title="Payroll Details" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll/edit/{$payroll->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
<?php if($payroll->lock) { ?>  
  <span class="badge">Locked</span>
<?php } ?>
    <h4 class="list-group-item-heading">Payroll Details</h4>
    <p class="list-group-item-text">Payroll Details</p>
  </a>
<?php if(!$payroll->lock) { ?> 
  <a data-target="#ajaxModal" data-title="Inclusive Dates" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll/inclusive_dates/{$payroll->id}/ajax") . "?next=" . $this->input->get('next'); ?>" >
    <h4 class="list-group-item-heading">Inclusive Dates</h4>
    <p class="list-group-item-text">Inclusive Dates</p>
  </a>
</div>

<?php if( $inclusive_dates ) { ?>
<?php if( $generate ) { ?>
<div class="list-group">
  <a data-target="#ajaxModal" data-title="Generate Payroll" class="list-group-item active" href="<?php echo site_url("payroll/generate/{$payroll->id}/ajax") . "?next=payroll_dtr/view/{$payroll->id}"; ?>">
    <h4 class="list-group-item-heading">Generate Payroll</h4>
    <p class="list-group-item-text">Generate Payroll</p>
  </a>
</div>
<?php } else { ?>

<div class="list-group">

  <a data-target="#ajaxModal"  data-title="Employee Groups" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll/groups/{$payroll->id}/ajax") . "?collapse=1&next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Employee Groups</h4>
    <p class="list-group-item-text">Employee Groups</p>
  </a>

  <a data-target="#ajaxModal" data-title="Earnings" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll/earnings/{$payroll->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Earnings</h4>
    <p class="list-group-item-text">Earnings</p>
  </a>

  <a data-target="#ajaxModal" data-title="Benefits" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll/benefits/{$payroll->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Benefits</h4>
    <p class="list-group-item-text">Benefits</p>
  </a>

  <a data-target="#ajaxModal" data-title="Deductions" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll/deductions/{$payroll->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Deductions</h4>
    <p class="list-group-item-text">Deductions</p>
  </a>

</div>

<div class="list-group">
  <a data-target="#ajaxModal" data-title="Generate Payroll" class="list-group-item active" href="<?php echo site_url("payroll/generate/{$payroll->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Generate Payroll</h4>
    <p class="list-group-item-text">Generate Payroll</p>
  </a>
<?php } ?>
</div>

<?php } ?>
<?php } ?>



<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>

      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>