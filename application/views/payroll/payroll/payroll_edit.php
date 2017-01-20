<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Payroll</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>Payroll Name</label>
            <input name="name" type="text" class="form-control" value="<?php echo $payroll->name; ?>">
          </div>

          <div class="form-group">
            <label>Template</label>
            <select class="form-control" title="Select a Template" name="template_id">
              <?php foreach($templates as $template) { ?>
                <option value="<?php echo $template->id; ?>" <?php echo ($template->id==$payroll->template_id) ? "SELECTED":""; ?>><?php echo $template->name; ?></option>
              <?php } ?>
            </select>
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