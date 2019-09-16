<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Employement Record</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="row">

  <div class="col-md-6">
          <div class="form-group">
            <label>Employee ID</label>
            <input name="employee_id" type="text" class="form-control" value="<?php echo $employee->employee_id; ?>">
          </div>
  </div>

    <?php if( $groups ) { ?>
  <div class="col-md-6">
          <div class="form-group">
            <label>Group</label>
            <select class="form-control" title="Select a Group" name="group_id">
              <?php if($groups) foreach($groups as $group) { ?>
                <option value="<?php echo $group->id; ?>" <?php echo ($employee->group_id==$group->id) ? "SELECTED" : ""; ?>><?php echo $group->name; ?></option>
              <?php } ?>
            </select>
          </div>
  </div>
        <?php } ?>
    <?php if( $positions ) { ?>
  <div class="col-md-6">
          <div class="form-group">
            <label>Position</label>
            <select class="form-control" title="Select a Position" name="position_id">
              <?php if($positions) foreach($positions as $position) { ?>
                <option value="<?php echo $position->id; ?>" <?php echo ($employee->position_id==$position->id) ? "SELECTED" : ""; ?>><?php echo $position->name; ?></option>
              <?php } ?>
            </select>
          </div>
  </div>
    <?php } ?>

     <?php if( $areas ) { ?>
  <div class="col-md-6">
          <div class="form-group">
            <label>Area</label>
            <select class="form-control" title="Select a Area" name="area_id">
              <?php if($areas) foreach($areas as $area) { ?>
                <option value="<?php echo $area->id; ?>" <?php echo ($employee->area_id==$area->id) ? "SELECTED" : ""; ?>><?php echo $area->name; ?></option>
              <?php } ?>
            </select>
          </div>
  </div>
          <?php } ?>

  <div class="col-md-6">
          <div class="form-group">
            <label>Date Hired</label>
            <input name="date_hired" type="text" class="form-control datepicker" value="<?php echo ($employee->hired) ? date('m/d/Y', strtotime($employee->hired)) : date('m/d/Y'); ?>">
          </div>
  </div>

  <div class="col-md-6">
          <div class="form-group">
            <label>Date Regularized</label>
            <input name="date_regularized" type="text" class="form-control datepicker" value="<?php echo ($employee->regularized) ? date('m/d/Y', strtotime($employee->regularized)) : date('m/d/Y'); ?>">
          </div>
  </div>

<?php if( $employment_status ) { ?>
  <div class="col-md-6">
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" title="Select a Status" name="status">
              <?php foreach($employment_status as $status) { ?>
                <option value="<?php echo $status->id; ?>" <?php echo ($employee->status==$status->id) ? "SELECTED" : ""; ?>><?php echo $status->name; ?></option>
              <?php } ?>
            </select>
          </div>
          </div>
<?php } ?>

</div>
          <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control"><?php echo $employee->notes; ?></textarea>
          </div>

          <div class="form-group">
            <label>Assigned <?php echo lang_term('companies_title_singular', 'Company'); ?></label>
            <select class="form-control" title="Select a Company" name="company_id">
              <?php if($companies) foreach($companies as $company) { ?>
                <option value="<?php echo $company->id; ?>" <?php echo ($employee->company_id==$company->id) ? "SELECTED" : ""; ?>><?php echo $company->name; ?></option>
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