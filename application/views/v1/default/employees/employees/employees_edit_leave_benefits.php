<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Leave Benefits <?php echo ( $selected_year ) ? $selected_year : ''; ?></h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>

<?php if( $selected_year ) { ?>

<?php foreach($leaves as $leave) { ?>
          <div class="form-group">
            <label><?php echo $leave->name; ?></label>
            <input name="leave[<?php echo $leave->id; ?>]" type="text" class="form-control text-right" value="<?php echo ($leave->days) ? $leave->days : 0; ?>">
            <small class="help-block"><?php echo $leave->notes; ?></small>
          </div>
<?php } ?>

<?php } else { ?>

<?php if($payroll_periods) { ?>
<div class="btn-group">
  <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Select a Year <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <?php foreach($payroll_periods as $period) { ?>
      <li><a class="ajax-modal-inner" href="<?php echo site_url("employees/edit_leave_benefits/{$employee->name_id}/{$period->year}/ajax") . '?next=' . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>" data-title="Leave Benefits <?php echo $period->year; ?>"><?php echo $period->year; ?></a></li>
    <?php } ?>
  </ul>
</div>
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