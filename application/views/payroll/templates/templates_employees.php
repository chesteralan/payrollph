<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configure Payroll Employees</h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<ul class="list-group sortable">
  <?php foreach($employees as $employee) { ?>
  <li class="list-group-item">
  <input type="hidden" name="name_id[]" value="<?php echo $employee->name_id; ?>">
  <span class="glyphicon glyphicon-sort pull-right"></span>
    <h4 class="list-group-item-heading"><label><input type="checkbox" name="selected[]" value="<?php echo $employee->name_id; ?>" <?php echo ($employee->active==1) ? "CHECKED" : ""; ?>> <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></label></h4>
    <p class="list-group-item-text"><?php echo $employee->position_name; ?></p>
  </li>
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