<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Set Working Days</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="list-group">
  <label class="list-group-item"><input type="checkbox" name="work_on_sun" value="1" class="pull-right" <?php echo (unserialize($company->work_on_sun)==1) ? 'CHECKED' : ''; ?> />Sunday</label>
  <label class="list-group-item"><input type="checkbox" name="work_on_mon" value="1" class="pull-right" <?php echo (unserialize($company->work_on_mon)==1) ? 'CHECKED' : ''; ?> />Monday</label>
  <label class="list-group-item"><input type="checkbox" name="work_on_tue" value="1" class="pull-right" <?php echo (unserialize($company->work_on_tue)==1) ? 'CHECKED' : ''; ?> />Tuesday</label>
  <label class="list-group-item"><input type="checkbox" name="work_on_wed" value="1" class="pull-right" <?php echo (unserialize($company->work_on_wed)==1) ? 'CHECKED' : ''; ?> />Wednesday</label>
  <label class="list-group-item"><input type="checkbox" name="work_on_thu" value="1" class="pull-right" <?php echo (unserialize($company->work_on_thu)==1) ? 'CHECKED' : ''; ?> />Thursday</label>
  <label class="list-group-item"><input type="checkbox" name="work_on_fri" value="1" class="pull-right" <?php echo (unserialize($company->work_on_fri)==1) ? 'CHECKED' : ''; ?> />Friday</label>
  <label class="list-group-item"><input type="checkbox" name="work_on_sat" value="1" class="pull-right" <?php echo (unserialize($company->work_on_sat)==1) ? 'CHECKED' : ''; ?> />Saturday</label>
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