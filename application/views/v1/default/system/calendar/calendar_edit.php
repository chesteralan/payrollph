<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Date Settings</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>


          <div class="form-group">
            <label><input name="is_holiday" type="checkbox" value="1" <?php echo (($current_date) && ('1'==$current_date->is_holiday)) ? 'CHECKED' : ''; ?>> Mark as Holiday</label>
          </div>


<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label>Holiday Type</label>
            <select name="holiday_type" type="text" class="form-control">
              <option value="0">- - Select Type - -</option>
<?php foreach($holidays as $holiday) { ?>
  <option value="<?php echo $holiday->id; ?>" <?php echo (($current_date) && ($holiday->id==$current_date->holiday_type)) ? 'SELECTED' : ''; ?>><?php echo $holiday->name; ?></option>
<?php } ?>
            </select>
          </div>
    </div>
    <div class="col-md-6">
          <div class="form-group">
            <label>Premium</label>
            <input name="holiday_premium" type="text" class="form-control text-right" value="<?php echo ($current_date) ? $current_date->premium : ''; ?>">
          </div>
    </div>
</div>

          <div class="form-group">
            <label>Notes</label>
            <input name="holiday_notes" type="text" class="form-control" value="<?php echo ($current_date) ? $current_date->notes : ''; ?>">
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