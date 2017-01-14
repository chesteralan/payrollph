<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Group</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          <div class="form-group">
            <label>Full Name</label>
            <input name="full_name" type="text" class="form-control" value="<?php echo $this->input->post('full_name'); ?>">
          </div>
          <div class="form-group">
            <label>Address</label>
            <input name="address" type="text" class="form-control" value="<?php echo $this->input->post('address'); ?>">
          </div>
          <div class="form-group">
            <label>Contact Number</label>
            <input name="contact_number" type="text" class="form-control" value="<?php echo $this->input->post('contact_number'); ?>">
          </div>

<?php if( isset($output) && ($output!='ajax') ) : ?>

        </div>
        <div class="panel-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="<?php echo site_url("system_names"); ?>" class="btn btn-warning">Back</a>
        </div>
        </form>
      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>