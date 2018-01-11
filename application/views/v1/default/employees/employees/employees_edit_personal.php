<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Employee Personal</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>Last Name</label>
            <input name="lastname" type="text" class="form-control" value="<?php echo $employee->lastname; ?>">
          </div>

          <div class="form-group">
            <label>First Name</label>
            <input name="firstname" type="text" class="form-control" value="<?php echo $employee->firstname; ?>">
          </div>

          <div class="form-group">
            <label>Middle Name</label>
            <input name="middlename" type="text" class="form-control" value="<?php echo $employee->middlename; ?>">
          </div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Birthday</label>
            <input name="birthday" type="text" class="form-control datepicker" value="<?php echo date("m/d/Y", strtotime($employee->birthday)); ?>">
          </div>

  </div>
  <div class="col-md-6">
    
          <div class="form-group">
            <label>Birthplace</label>
            <input name="birthplace" type="text" class="form-control" value="<?php echo $employee->birthplace; ?>">
          </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="male" <?php echo ($employee->gender=='male') ? "SELECTED" : ""; ?>>Male</option>
                <option value="female" <?php echo ($employee->gender=='female') ? "SELECTED" : ""; ?>>Female</option>
            </select>
          </div>

  </div>
  <div class="col-md-6">
    
          <div class="form-group">
            <label>Civil Status</label>
            <select name="civil_status" class="form-control">
<?php $civil_status = $this->config->item('civil_status'); ?>
<?php foreach($civil_status as $key=>$status) { ?>
                <option value="<?php echo $key; ?>" <?php echo ($employee->civil_status==$key) ? "SELECTED" : ""; ?>><?php echo $status; ?></option>
<?php } ?>
            </select>
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