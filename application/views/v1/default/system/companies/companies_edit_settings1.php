<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit <?php echo lang_term('companies_title_singular', 'Company'); ?> Settings</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="row">
<div class="col-md-12">
          <div class="form-group">
            <label>Working Days</label><br>
            <label><input name="work_on_sun" type="checkbox" value="1" <?php echo (unserialize($company->work_on_sun)==1) ? 'CHECKED' : ''; ?>>Sunday</label>
            <label><input name="work_on_mon" type="checkbox" value="1" <?php echo (unserialize($company->work_on_mon)==1) ? 'CHECKED' : ''; ?>>Monday</label>
            <label><input name="work_on_tue" type="checkbox" value="1" <?php echo (unserialize($company->work_on_tue)==1) ? 'CHECKED' : ''; ?>>Tuesday</label>
            <label><input name="work_on_wed" type="checkbox" value="1" <?php echo (unserialize($company->work_on_wed)==1) ? 'CHECKED' : ''; ?>>Wednesday</label>
            <label><input name="work_on_thu" type="checkbox" value="1" <?php echo (unserialize($company->work_on_thu)==1) ? 'CHECKED' : ''; ?>>Thursday</label>
            <label><input name="work_on_fri" type="checkbox" value="1" <?php echo (unserialize($company->work_on_fri)==1) ? 'CHECKED' : ''; ?>>Friday</label>
            <label><input name="work_on_sat" type="checkbox" value="1" <?php echo (unserialize($company->work_on_sat)==1) ? 'CHECKED' : ''; ?>>Saturday</label>
          </div>
</div>
<div class="col-md-6">

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