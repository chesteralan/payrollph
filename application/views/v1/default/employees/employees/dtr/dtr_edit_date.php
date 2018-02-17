<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Leave / Absence <strong>(<?php echo date('F d, Y', strtotime($date)); ?>)</strong></h3>
        </div>
        <form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>
          
           <div class="form-group">
                <p><label><input name="absent" type="checkbox" value="1" <?php echo ($absence) ? 'CHECKED' : ''; ?>> Employee is Absent</label></p>
            </div>

      <div class="row">
      <div class="col-md-6">
          <div class="form-group">
            <label>Leave Type</label>

            <select class="form-control" name="leave_type">
                <option value="" <?php echo (($absence) && ($absence->leave_type==0)) ? 'SELECTED' : ''; ?>>Absence without Leave</option>
                <?php foreach($leave_benefits as $leave) { 
$leave_balance = ($leave->days - $leave->availed) + ($absence->hours / $employee->working_hours);
                  ?>
                  <?php if( $leave->days ) { ?>
                    <?php if($leave_balance > 0) { ?>
                      <option value="<?php echo $leave->id; ?>" <?php echo (($absence) && ($absence->leave_type==$leave->id)) ? 'SELECTED' : ''; ?>><?php echo $leave->name; ?> (<?php echo number_format($leave->availed,2); ?> / <?php echo number_format($leave->days,2); ?>)</option>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
            </select>

          </div>
      </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Number of Hours</label>
            <input name="hours" type="text" class="form-control text-center" value="<?php echo ($absence) ? $absence->hours : $employee->working_hours; ?>" required>
          </div>
        </div>
      </div>

    <div class="form-group">
      <label>Notes / Reason</label>
      <textarea name="notes" class="form-control" rows="3"><?php echo ($absence) ? $absence->notes : ''; ?></textarea>
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