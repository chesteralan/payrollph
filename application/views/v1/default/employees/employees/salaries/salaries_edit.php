<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Salary</h3>
        </div>
        <form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>
          

<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>Amount</label>
            <input name="amount" type="text" class="form-control text-center" value="<?php echo number_format($salary->amount,2,".",""); ?>">
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Rate per</label>
            <select class="form-control" title="Select a Rate" name="rate_per">
                <option value="month" <?php echo ($salary->rate_per=='month') ? 'SELECTED' : ''; ?>>Month</option>
                <option value="day" <?php echo ($salary->rate_per=='day') ? 'SELECTED' : ''; ?>>Day</option>
                <option value="hour" <?php echo ($salary->rate_per=='hour') ? 'SELECTED' : ''; ?>>Hour</option>
            </select>
          </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>Number of Days / Month</label>
            <input name="num_of_days" type="text" class="form-control text-center" value="<?php echo $salary->days; ?>">
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Number of Hours / Day</label>
            <input name="num_of_hours" type="text" class="form-control text-center" value="<?php echo $salary->hours; ?>">
          </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>Number of Months in a Year</label>
            <input name="num_of_months" type="text" class="form-control text-center" value="<?php echo $salary->months; ?>">
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Annual Working Days</label>
            <input name="annual_work_days" type="text" class="form-control text-center" value="<?php echo $salary->annual_days; ?>">
          </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>COLA</label>
            <input name="cola" type="text" class="form-control text-center" value="<?php echo number_format($salary->cola,2,".",""); ?>">
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Computation Manner</label>
            <select class="form-control" title="Select Manner" name="manner">
                <option value="daily" <?php echo ($salary->manner=='daily') ? 'SELECTED' : ''; ?>>Daily</option>
                <option value="hourly" <?php echo ($salary->manner=='hourly') ? 'SELECTED' : ''; ?>>Hourly</option>
                <option value="semi-monthly" <?php echo ($salary->manner=='semi-monthly') ? 'SELECTED' : ''; ?>>Semi-Monthly</option>
                <option value="monthly" <?php echo ($salary->manner=='monthly') ? 'SELECTED' : ''; ?>>Monthly</option>
            </select>
          </div>
    </div>
</div>

<div class="form-group">
    <label>Notes</label>
    <textarea name="notes" class="form-control" rows="2"><?php echo $salary->notes; ?></textarea>
  </div>

              <div class="form-group">
                <p><label><input name="primary" type="checkbox" value="1"<?php echo ($salary->primary) ? ' CHECKED' : ''; ?>> Set Primary</label></p>
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