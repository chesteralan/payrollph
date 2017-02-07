<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Template</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>Template Name</label>
            <input name="name" type="text" class="form-control" value="<?php echo $template->name; ?>">
          </div>

          <div class="form-group">
            <label>Company Name</label>
            <input name="company_name" type="text" class="form-control" value="<?php echo $template->company_name; ?>">
          </div>

          <div class="form-group">
            <label>Company Address</label>
            <input name="company_address" type="text" class="form-control" value="<?php echo $template->company_address; ?>">
          </div>

          <div class="form-group">
            <label>Company Contacts</label>
            <input name="company_contacts" type="text" class="form-control" value="<?php echo $template->company_contacts; ?>">
          </div>

        <div class="row">
          <div class="col-md-6">
                  <div class="form-group">
                    <label>Checked By</label>
                    <input id="checked_by_name_id" name="checked_by" type="hidden" value="<?php echo $template->checked_by; ?>">
                    <input name="" class="form-control autocomplete-name_select autocomplete-name_select-name-input-<?php echo time(); ?>" data-source="<?php echo site_url("payroll_templates/ajax/search_name"); ?>" data-name_id="checked_by_name_id" type="text" style="display: none;">
                    <div class="form-control autocomplete-name_select-name-display-<?php echo time(); ?>"><a class="badge" id="changeName" href="#changeName" data-id="<?php echo $template->checked_by; ?>" data-name_id="checked_by_name_id" data-timestamp="<?php echo time(); ?>"><?php echo ($template->checked_by_name) ? $template->checked_by_name : 'not assigned'; ?></a></div>
                  </div>
          </div>
          <div class="col-md-6">
                  <div class="form-group">
                    <label>Approved by</label>
                    <input id="approved_by_name_id" name="approved_by" type="hidden" value="<?php echo $template->approved_by; ?>">
                    <input name="" class="form-control autocomplete-name_select autocomplete-name_select-name-input-<?php echo time(); ?>-2" data-source="<?php echo site_url("payroll_templates/ajax/search_name"); ?>" data-name_id="approved_by_name_id" type="text" style="display: none;">
                    <div class="form-control autocomplete-name_select-name-display-<?php echo time(); ?>-2"><a class="badge" id="changeName" href="#changeName" data-id="<?php echo $template->approved_by; ?>" data-name_id="approved_by_name_id" data-timestamp="<?php echo time(); ?>-2"><?php echo ($template->approved_by_name) ? $template->approved_by_name : 'not assigned'; ?></a></div>
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