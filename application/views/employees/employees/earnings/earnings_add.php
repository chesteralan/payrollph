<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Earning</h3>
        </div>
        <form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>
          


      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Earning Type</label>
            <select class="form-control" title="Select an Earning" name="earning_id" required>
            <?php foreach($earnings as $earning) { ?>
                <option value="<?php echo $earning->id; ?>"><?php echo $earning->name; ?> - <?php echo $earning->notes; ?></option>
            <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Amount</label>
            <input name="amount" type="text" class="form-control text-center" value="0.00" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
              <div class="form-group">
                <label>Start Date</label>
                <input name="start_date" type="text" class="form-control text-center datepicker" value="<?php echo date('m/d/Y'); ?>" required>
              </div>
        </div>
        <div class="col-md-6">
           <div class="form-group">
            <label>Max Amount</label>
            <input name="max_amount" type="text" class="form-control text-center" value="0.00" required>
          </div>
        </div>
      </div>

      <div class="row">          
        <div class="col-md-6">
                    <div class="form-group">
              <label>Rate per</label>
              <select class="form-control" title="Select a Repeat" name="computed" required>
              <?php 
              $selected = 'month';
              foreach(array('month'=>'Monthly', 'day'=>'Daily', 'hour'=>'Hourly') as $key=>$value) { ?>
                  <option value="<?php echo $key; ?>"<?php echo ($key==$selected) ? ' SELECTED' : ''; ?>><?php echo $value; ?></option>
              <?php } ?>
              </select>
            </div>
         
        </div>
        <div class="col-md-6">
                    <div class="form-group">
              <label>Multiplier</label>
              <select class="form-control" title="Multiplier" name="multiplier" required>
                  <option value="" SELECTED>- - None - -</option>
              <?php 
              foreach(array('employment'=>'Employment (in years)', 'birthday'=>'Birthday (in years)') as $key=>$value) { ?>
                  <option value="<?php echo $key; ?>"<?php echo ($key==$selected) ? ' SELECTED' : ''; ?>><?php echo $value; ?></option>
              <?php } ?>
              </select>
            </div>
         
        </div>
      </div>


    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes" class="form-control" rows="3"></textarea>
    </div>

      <div class="row">          
        <div class="col-md-6">
          <div class="form-group">
            <p><label><input name="active" type="checkbox" value="1" CHECKED> Set Active</label></p>
          </div>
        </div>
        <div class="col-md-6">
              <div class="form-group">
              <?php foreach($templates as $template) { ?>
                <p><label>
                  <input name="template_selected[]" type="checkbox" value="<?php echo $template->id; ?>" CHECKED> Generate on: <?php echo $template->name; ?>
                </label></p>
              <?php } ?>
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