<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Template</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>Template Name</label>
            <input name="name" type="text" class="form-control" value="<?php echo $this->input->post('name'); ?>">
          </div>

        <div class="row">
          <div class="col-md-6">
                  <div class="form-group">
                    <label>Checked By</label>
                    <input id="checked_by_name_id" name="checked_by" type="hidden" value="">
                    <input class="form-control autocomplete-name_select ui-autocomplete-input" data-source="<?php echo site_url("payroll_templates/ajax/search_name"); ?>" data-name_id="checked_by_name_id" type="text" autocomplete="off">
                  </div>
          </div>
          <div class="col-md-6">
                  <div class="form-group">
                    <label>Approved by</label>
                    <input id="approved_by_name_id" name="approved_by" type="hidden" value="">
                    <input class="form-control autocomplete-name_select ui-autocomplete-input" data-source="<?php echo site_url("payroll_templates/ajax/search_name"); ?>" data-name_id="approved_by_name_id" type="text" autocomplete="off">
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