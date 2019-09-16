<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Payroll</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>Payroll Name</label>
            <input name="name" type="text" class="form-control" value="<?php echo $this->input->post('name'); ?>">
          </div>

          <div class="form-group">
            <label>Use Template</label>
            <select class="form-control" title="Select a Template" name="template_id">
              <option value="0" selected="selected">- No Template -</option>
              <?php foreach($templates as $template) { ?>
                <option value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
              <?php } ?>
            </select>
          </div>

<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Month</label>
          <select class="form-control" title="Select a Month" name="month">
            <?php for($i=1;$i<=12;$i++) { ?>
              <option value="<?php echo $i; ?>" <?php echo ($i==date('m')) ? "SELECTED": ""; ?>><?php echo date('F', strtotime("{$i}/1/1970")); ?></option>
            <?php } ?>
          </select>
        </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
          <label>Year</label>
          <select class="form-control" title="Select a Year" name="year">
            <?php foreach($payroll_periods as $period) { ?>
              <option value="<?php echo $period->year; ?>" <?php echo ($period->year==date('Y')) ? "SELECTED": ""; ?>><?php echo $period->year; ?></option>
            <?php } ?>
          </select>
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