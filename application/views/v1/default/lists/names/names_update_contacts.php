<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Update Address &amp; Contact Numbers</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>Postal Address</label>
            <input name="data[address]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->address : ''; ?>">
          </div>

       <div class="form-group">
            <label>Email Address</label>
            <input name="data[email]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->email : ''; ?>">
          </div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Phone Number</label>
            <input name="data[phone_number]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->phone_number : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
    
          <div class="form-group">
            <label>Cell Number (Smart)</label>
            <input name="data[cell_smart]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->cell_smart : ""; ?>">
          </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Cell Number (Globe)</label>
            <input name="data[cell_globe]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->cell_globe : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
           <div class="form-group">
            <label>Cell Number (Sun)</label>
            <input name="data[cell_sun]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->cell_sun : ""; ?>">
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