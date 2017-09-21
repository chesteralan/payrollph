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

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Facebook ID</label>
            <input name="data[facebook_id]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->facebook_id : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
    
          <div class="form-group">
            <label>Twitter ID</label>
            <input name="data[twitter_id]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->twitter_id : ""; ?>">
          </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Instagram ID</label>
            <input name="data[instagram_id]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->instagram_id : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
           <div class="form-group">
            <label>Skype ID</label>
            <input name="data[skype_id]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->skype_id : ""; ?>">
          </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Yahoo ID</label>
            <input name="data[yahoo_id]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->yahoo_id : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
           <div class="form-group">
            <label>Google ID</label>
            <input name="data[google_id]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->google_id : ""; ?>">
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