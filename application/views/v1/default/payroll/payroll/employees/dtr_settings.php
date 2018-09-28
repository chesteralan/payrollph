<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Employee DTR Settings</h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
<input name="action" type="hidden" value="post" />
<div class="row">
  <div class="col-md-12">
          <div class="form-group">
            <label>
            <input name="attendance_method" type="checkbox" class="focus" value="1" <?php echo ($employee->presence) ? 'CHECKED' : ''; ?>> <strong>Attendance Method</strong>
            </label> - 
            <small><em>This will remove the absences of the employee.</em></small>
          </div>
  </div>
    <div class="col-md-6">

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