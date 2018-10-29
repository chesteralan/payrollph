<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php //$this->load->view('employees/employees/employees_view_navbar');  ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Attendance <strong>(<?php echo date('F d, Y', strtotime($date)); ?>)</strong></h3>
        </div>
        <form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>

      <div class="row">
      <div class="col-md-12">
<?php if($attendance) {  ?>
  <div class="alert alert-success"><strong>Marked as present!</strong> <a href="<?php echo site_url(uri_string()) . "?delete=1&next=" . $this->input->get('next'); ?>" class="pull-right btn btn-danger btn-xs">Remove</a></div>
<?php } else { ?>
  <h3><strong>Add Attendance</strong></h3>
<?php } ?>
</div></div>
         <!-- 
           <div class="form-group">
                <p><label><input name="absent" type="checkbox" value="1" <?php echo ($absence) ? 'CHECKED' : 'CHECKED'; ?>> Employee is Absent</label></p>
            </div>
          -->
          <input name="absent" type="hidden" value="1">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Number of Hours</label>
            <input name="hours" type="text" class="form-control text-center" value="<?php echo ($attendance) ? $attendance->hours : ((isset($employee)&&($employee))?$employee->working_hours:8); ?>" required>
          </div>
        </div>
      </div>

    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes" class="form-control" rows="3"><?php echo ($attendance) ? $attendance->notes : ''; ?></textarea>
    </div>

<?php if( $attendance ) { ?>
<?php if( $attendance->pe_id ) { ?>
    <div class="alert alert-warning"><strong>Assigned to Payroll: <?php echo $payroll->name; ?></strong> <a href="<?php echo site_url(uri_string()) . "?remove_assignment=1&next=" . $this->input->get('next'); ?>" class="pull-right btn btn-danger btn-xs">Remove</a></div>
<?php } else { ?>
<a href="<?php echo site_url(uri_string()) . "?assign=1&next=" . $this->input->get('next'); ?>" class="btn btn-default btn-xs">Assign to payroll</a>
<?php } ?>
<?php } ?>
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