<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

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
          

<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>Amount</label>
            <input name="amount" type="text" class="form-control text-center" value="">
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Rate per</label>
            <select class="form-control" title="Select a Rate" name="rate_per">
                <option value="month" SELECTED>Month</option>
                <option value="day">Day</option>
                <option value="hour">Hour</option>
            </select>
          </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>Number of Days / Month</label>
            <input name="num_of_days" type="text" class="form-control text-center" value="26">
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Number of Hours / Day</label>
            <input name="num_of_hours" type="text" class="form-control text-center" value="8">
          </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>Number of Months in a Year</label>
            <input name="num_of_months" type="text" class="form-control text-center" value="12">
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Annual Working Days</label>
            <input name="annual_work_days" type="text" class="form-control text-center" value="312">
          </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>COLA</label>
            <input name="cola" type="text" class="form-control text-center" value="0">
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Computation Manner</label>
            <select class="form-control" title="Select Manner" name="manner">
                <option value="daily" selected="selected">Daily</option>
                <option value="hourly">Hourly</option>
                <option value="semi-monthly">Semi-Monthly</option>
                <option value="monthly">Monthly</option>
            </select>
          </div>
    </div>
</div>

<div class="form-group">
    <label>Notes</label>
    <textarea name="notes" class="form-control" rows="5"></textarea>
  </div>

              <div class="form-group">
                <p><label><input name="primary" type="checkbox" value="1" CHECKED> Set Primary</label></p>
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