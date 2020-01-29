<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$payslip_templates = unserialize(PAYROLL_PAYSLIP_TEMPLATES);
?>
<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Employee</h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; //print_r($employees); ?>

                  <div class="form-group">
                    <input id="add_employee_id" name="employee_id" type="hidden" value="">
                    <input name="" class="form-control autocomplete-name_select autocomplete-name_select-name-input-<?php echo time(); ?>" data-source="<?php echo site_url("payroll/ajax/search_payroll_employee/{$payroll_id}"); ?>" data-name_id="add_employee_id" type="text">
                  </div>

<ul class="list-group">

<?php foreach($employees as $employee) { ?>
  <a href="<?php echo site_url("payroll/add_employee2/{$payroll_id}") . "?next=" . $this->input->get('next') . "&employee_id=" . $employee->name_id; ?>" class="list-group-item"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo $employee->middlename; ?>
    <span class="badge pull-right"><?php echo $employee->group_by_value; ?></span>
  </a>
<?php } ?>

</ul>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>
        <div class="panel-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="<?php echo site_url($current_uri); ?>" class="btn btn-warning">Back</a>
        </div>
        </form>
      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>