<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

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
<?php endif; ?>
          
          <div class="form-group">
            <span><strong>Full Name:</strong> <?php echo $name->full_name; ?></span>
          </div>

          <div class="form-group">
            <label>Last Name</label>
            <input name="lastname" type="text" class="form-control" value="<?php echo $this->input->post('lastname'); ?>">
          </div>

          <div class="form-group">
            <label>First Name</label>
            <input name="firstname" type="text" class="form-control" value="<?php echo $this->input->post('firstname'); ?>">
          </div>

          <div class="form-group">
            <label>Middle Name</label>
            <input name="middlename" type="text" class="form-control" value="<?php echo $this->input->post('middlename'); ?>">
          </div>

          <div class="form-group">
            <label>Group</label>
            <select class="form-control" title="Select a Group" name="group_id">
              <?php foreach($groups as $group) { ?>
                <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label>Position</label>
            <select class="form-control" title="Select a Position" name="position_id">
              <?php foreach($positions as $position) { ?>
                <option value="<?php echo $position->id; ?>"><?php echo $position->name; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label>Area</label>
            <select class="form-control" title="Select an Area" name="area_id">
              <?php foreach($areas as $area) { ?>
                <option value="<?php echo $area->id; ?>"><?php echo $area->name; ?></option>
              <?php } ?>
            </select>
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