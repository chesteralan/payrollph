<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Leave / Absense <strong>(<?php echo date('F d, Y', strtotime($date)); ?>)</strong></h3>
        </div>
        <form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>
          
           <div class="form-group">
                <p><label><input name="absent" type="checkbox" value="1" <?php echo ($absense) ? 'CHECKED' : ''; ?>> Employee is Absent</label></p>
            </div>

          <div class="form-group">
            <label>Leave Type</label>
            <select class="form-control" title="Leave Type" name="leave_type">
                <option value="" <?php echo (($absense) && ($absense->leave_type==0)) ? 'SELECTED' : ''; ?>>Absense without Leave</option>
                <?php foreach($leaves as $leave) { ?>
                  <option value="<?php echo $leave->id; ?>" <?php echo (($absense) && ($absense->leave_type==$leave->id)) ? 'SELECTED' : ''; ?>><?php echo $leave->name; ?></option>
                <?php } ?>
            </select>
          </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Number of Hours</label>
            <input name="hours" type="text" class="form-control text-center" value="<?php echo ($absense) ? $absense->hours : $employee->working_hours; ?>" required>
          </div>
        </div>
        <div class="col-md-6"></div>
      </div>

    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes" class="form-control" rows="3"><?php echo ($absense) ? $absense->notes : ''; ?></textarea>
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