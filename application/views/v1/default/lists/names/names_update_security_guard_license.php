<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Update Emergency Contacts</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>License Number</label>
            <input name="data[sgl_number]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->sgl_number : ''; ?>">
          </div>

       <div class="form-group">
            <label>License Expiry</label>
            <input name="data[sgl_expiry]" type="text" class="form-control datepicker" value="<?php echo ($meta) ? $meta->sgl_expiry : date('m/d/Y'); ?>">
          </div>


       <div class="form-group">
            <label>Status</label>
            <input name="data[sgl_status]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->sgl_status : ''; ?>">
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