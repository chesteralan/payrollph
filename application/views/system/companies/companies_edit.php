<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Company</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          <div class="form-group">
            <label>Company Name</label>
            <input name="name" type="text" class="form-control" value="<?php echo $company->name; ?>" REQUIRED>
          </div>

          <div class="form-group">
            <label>Company Address</label>
            <input name="address" type="text" class="form-control" value="<?php echo $company->address; ?>">
          </div>

          <div class="form-group">
            <label>Company Phone</label>
            <input name="phone" type="text" class="form-control" value="<?php echo $company->phone; ?>">
          </div>

          <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="10"><?php echo $company->notes; ?></textarea>
          </div>

            <div class="form-group">
              <label>Theme</label>
              <select name="theme" class="form-control" title="- - Select Class - -">
              <?php 
              foreach(array('default','cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti') as $theme) { ?>
                <option <?php echo ($company->theme==$theme) ? 'SELECTED' : ''; ?>><?php echo $theme; ?></option>
              <?php } ?>
              </select>
            </div>

        <div class="form-group">
            <label><input name="default" type="checkbox" value="1" <?php echo ($company->default==1) ? 'CHECKED' : ''; ?>> Default Company</label>
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