<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Update Overtime <strong>(<?php echo date('F d, Y', strtotime($date)); ?>)</strong></h3>
        </div>
        <form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>

     
          <div class="form-group">
            <label>Number of Minutes</label>
            <input name="minutes" type="text" class="form-control text-center" value="<?php echo ($overtime) ? $overtime->minutes : 0; ?>" required>
          </div>
        
    <div class="form-group">
      <label>Notes / Reason</label>
      <textarea name="notes" class="form-control" rows="2"><?php echo ($overtime) ? $overtime->notes : ''; ?></textarea>
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