<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit <?php echo lang_term('companies_title_singular', 'Company'); ?></h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          <div class="form-group">
<label class="pull-right"><input name="default" type="checkbox" value="1" <?php echo ($company->default==1) ? 'CHECKED' : ''; ?>> Default <?php echo lang_term('companies_title_singular', 'Company'); ?></label>

            <label><?php echo lang_term('companies_title_singular', 'Company'); ?> Name</label>
            <input name="name" type="text" class="form-control" value="<?php echo $company->name; ?>" REQUIRED>
          </div>
<div class="row">
<div class="col-md-6">
          <div class="form-group">
            <label><?php echo lang_term('companies_title_singular', 'Company'); ?> Address</label>
            <input name="address" type="text" class="form-control" value="<?php echo $company->address; ?>">
          </div>
</div>
<div class="col-md-6">
          <div class="form-group">
            <label><?php echo lang_term('companies_title_singular', 'Company'); ?> Phone</label>
            <input name="phone" type="text" class="form-control" value="<?php echo $company->phone; ?>">
          </div>
</div>
</div>

          <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="2"><?php echo $company->notes; ?></textarea>
          </div>

<div class="row">
<div class="col-md-6">
            <div class="form-group">
              <label>Theme</label>
              <select name="theme" class="form-control" title="- - Select Class - -">
              <?php 
              foreach(array('default','cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti') as $theme) { ?>
                <option <?php echo ($company->theme==$theme) ? 'SELECTED' : ''; ?>><?php echo $theme; ?></option>
              <?php } ?>
              </select>
            </div>
</div>
<div class="col-md-6">
          <div class="form-group">
            <label>Period Start</label>
            <input name="period_start" type="text" class="form-control datepicker" value="<?php echo (isset($company->period_start)) ? unserialize($company->period_start) : date('m/d/Y',strtotime("1/1/" . date('Y'))); ?>">
          </div>
</div>
</div>

<a class="btn btn-xs btn-warning ajax-modal-inner" href="<?php echo site_url("system_companies/edit_settings/{$company->id}/1/{$output}") . "?next=" . $this->input->get('next'); ?>" data-title="More Company Settings">More settings</a>

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