<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Employee Address</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>Phone Number</label>
            <input name="phone_number" type="text" class="form-control" value="<?php echo ($employee) ? $employee->phone_number : ""; ?>">
          </div>

          <div class="form-group">
            <label>Cell Number</label>
            <input name="cell_number" type="text" class="form-control" value="<?php echo ($employee) ? $employee->cell_number : ""; ?>">
          </div>

          <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control" rows="5"><?php echo ($employee) ? $employee->address : ""; ?></textarea>
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