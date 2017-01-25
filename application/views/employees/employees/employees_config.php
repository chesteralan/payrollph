<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configure Employee</h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<div class="list-group">
  <a data-target="#ajaxModal" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_personal/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Personal Information</h4>
    <p class="list-group-item-text">Employee's Personal Information</p>
  </a>

   <a data-target="#ajaxModal" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_employment/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Employment Information</h4>
    <p class="list-group-item-text">Employee's Employment Records</p>
  </a>

 <a data-target="#ajaxModal" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_personal/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Address and Contact</h4>
    <p class="list-group-item-text">Employee's Addresses and Contact Numbers</p>
  </a>

  <a data-target="#ajaxModal" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_compensation/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Salaries and Wages</h4>
    <p class="list-group-item-text">Monthly Compensation</p>
  </a>

  <a data-target="#ajaxModal" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_benefits/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Fringe Benefits</h4>
    <p class="list-group-item-text">SSS, Pag-ibig, and PhilHealth Benefits</p>
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