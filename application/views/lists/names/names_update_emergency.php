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
            <label>Name</label>
            <input name="data[emergency_name]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->emergency_name : ''; ?>">
          </div>

       <div class="form-group">
            <label>Address</label>
            <input name="data[emergency_address]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->emergency_address : ''; ?>">
          </div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Contact</label>
            <input name="data[emergency_contact]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->emergency_contact : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
    
          <div class="form-group">
            <label>Relationship</label>
            <input name="data[emergency_relationship]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->emergency_relationship : ""; ?>">
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