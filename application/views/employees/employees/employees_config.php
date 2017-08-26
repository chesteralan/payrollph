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
  <a data-target="#ajaxModal" data-title="Personal Information" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_personal/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Personal Information</h4>
    <p class="list-group-item-text">Employee's Personal Information</p>
  </a>

 <a data-target="#ajaxModal" data-title="Address and Contact"  class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_address/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Address and Contact</h4>
    <p class="list-group-item-text">Employee's Addresses and Contact Numbers</p>
  </a>

   <a data-target="#ajaxModal" data-title="Employment Information"  class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_employment/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Employment Information</h4>
    <p class="list-group-item-text">Employee's Employment Records</p>
  </a>
  
</div>
<div class="list-group">

  <a class="list-group-item body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_salaries/view/{$employee->name_id}"); ?>">
    <h4 class="list-group-item-heading">Basic Salary</h4>
    <p class="list-group-item-text">Employee's Monthly Compensation</p>
  </a>

  <a class="list-group-item body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_earnings/view/{$employee->name_id}"); // . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Additional Earnings</h4>
    <p class="list-group-item-text">Other compensation the employee receives</p>
  </a>

  <a class="list-group-item body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_benefits/view/{$employee->name_id}"); // . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Employee Benefits</h4>
    <p class="list-group-item-text">SSS, Pag-ibig, and PhilHealth Benefits</p>
  </a>
  
   <a class="list-group-item body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_deductions/view/{$employee->name_id}"); // . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Employee Deductions</h4>
    <p class="list-group-item-text">Salary Loans, Cash Advances, and other deductions</p>
  </a>

  <a data-target="#ajaxModal" data-title="Leave Benefits" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees/edit_leave_benefits/{$employee->name_id}/ajax") . "?next=" . $this->input->get('next'); ?>">
    <h4 class="list-group-item-heading">Leave Benefits</h4>
    <p class="list-group-item-text">Vacation Leave, Sick Leave, Emergency Leave, Maternity Leave, and etc.</p>
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