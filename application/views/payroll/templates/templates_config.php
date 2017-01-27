<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configure Payroll Template</h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<div class="list-group">
  <a data-target="#ajaxModal" data-title="Template Details" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll_templates/edit/{$template->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Template Details</h4>
    <p class="list-group-item-text">Template Name</p>
  </a>

  <a data-target="#ajaxModal"  data-title="Employee Groups" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll_templates/groups/{$template->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Employee Groups</h4>
    <p class="list-group-item-text">Employee Groups</p>
  </a>

  <a data-target="#ajaxModal" data-title="Benefits" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll_templates/benefits/{$template->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Benefits</h4>
    <p class="list-group-item-text">Benefits</p>
  </a>

  <a data-target="#ajaxModal" data-title="Earnings" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll_templates/earnings/{$template->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Earnings</h4>
    <p class="list-group-item-text">Earnings</p>
  </a>

  <a data-target="#ajaxModal" data-title="Deductions" class="list-group-item ajax-modal-inner" href="<?php echo site_url("payroll_templates/deductions/{$template->id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Deductions</h4>
    <p class="list-group-item-text">Deductions</p>
  </a>

</div>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>

      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>