<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Payroll Period</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="row">
<div class="col-md-6">
            <div class="form-group">
            <label>Period Name</label>
            <input name="period_name" type="text" class="form-control text-center" value="">
          </div>

</div>
<div class="col-md-6">
            <div class="form-group">
            <label>Year</label>
            <input name="period_year" type="text" class="form-control text-center" REQUIRED value="<?php echo date("Y"); ?>">
          </div>

</div>
<div class="col-md-6">

          <div class="form-group">
            <label>Period Start</label>
            <input name="period_start" type="text" class="form-control datepicker text-center" autocomplete="off" value="<?php echo date("01/01/Y"); ?>">
          </div>
</div>
<div class="col-md-6">
          <div class="form-group">
            <label>Period End</label>
            <input name="period_end" type="text" class="form-control datepicker text-center" autocomplete="off" value="<?php echo date("12/31/Y"); ?>">
          </div>
</div>
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