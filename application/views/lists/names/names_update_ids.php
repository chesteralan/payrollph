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
            <label>Tax Identification Number (TIN)</label>
            <input name="data[tin]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->tin : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
    
          <div class="form-group">
            <label>SSS Number</label>
            <input name="data[sss]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->sss : ""; ?>">
          </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Pag-ibig (HDMF)</label>
            <input name="data[hdmf]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->hdmf : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
           <div class="form-group">
            <label>PhilHealth</label>
            <input name="data[phic]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->phic : ""; ?>">
          </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">

          <div class="form-group">
            <label>Driver's License</label>
            <input name="data[drivers_license]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->drivers_license : ""; ?>">
          </div>

  </div>
  <div class="col-md-6">
           <div class="form-group">
            <label>Voter's Number</label>
            <input name="data[voters_number]" type="text" class="form-control" value="<?php echo ($meta) ? $meta->voters_number : ""; ?>">
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