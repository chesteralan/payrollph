<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$payslip_templates = unserialize(PAYROLL_PAYSLIP_TEMPLATES);
?>
<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Payroll Employee</h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach($employees as $employee) { ?>
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?php echo $employee->name_id; ?>">
      <h4 class="panel-title">
        <label><input type="checkbox" name="selected[]" value="<?php echo $employee->name_id; ?>"></label>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $employee->name_id; ?>" aria-expanded="true" aria-controls="collapseOne">
           <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>
        </a>
      </h4>
    </div>
    

  </div>
<?php } ?>
</div>

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