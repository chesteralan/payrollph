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

<?php if($payroll->lock=='1') { ?>

  <a href="<?php echo site_url("payroll/unlock/{$payroll->id}") . "?next=" . $this->input->get('next') ; ?>" class="btn btn-xs btn-success confirm">Unlock Payroll</a>

<?php } else { ?>
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

<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Month</label>
          <select class="form-control" title="Select a Month" name="month">
            <?php for($i=1;$i<=12;$i++) { ?>
              <option value="<?php echo $i; ?>" <?php echo ($i==$payroll->month) ? "SELECTED" : ""; ?>><?php echo date('F', strtotime("{$i}/1/1970")); ?></option>
            <?php } ?>
          </select>
        </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
          <label>Year</label>
          <select class="form-control" title="Select a Year" name="year">
            <?php for($i=date('Y');$i>=2017;$i--) { ?>
              <option value="<?php echo $i; ?>" <?php echo ($i==$payroll->year) ? "SELECTED" : ""; ?>><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </div>    
  </div>
</div>

       <div class="row">
          <div class="col-md-6">
                  <div class="form-group">
                    <label>Checked By</label>
                    <input id="checked_by_name_id" name="checked_by" type="hidden" value="<?php echo $payroll->checked_by; ?>">
                    <input name="" class="form-control autocomplete-name_select autocomplete-name_select-name-input-<?php echo time(); ?>" data-source="<?php echo site_url("payroll_templates/ajax/search_name"); ?>" data-name_id="checked_by_name_id" type="text" style="display: none;">
                    <div class="form-control autocomplete-name_select-name-display-<?php echo time(); ?>"><a class="badge" id="changeName" href="#changeName" data-id="<?php echo $payroll->checked_by; ?>" data-name_id="checked_by_name_id" data-timestamp="<?php echo time(); ?>"><?php echo ($payroll->checked_by_name) ? $payroll->checked_by_name : 'not assigned'; ?></a></div>
                  </div>
          </div>
          <div class="col-md-6">
                  <div class="form-group">
                    <label>Approved by</label>
                    <input id="approved_by_name_id" name="approved_by" type="hidden" value="<?php echo $payroll->approved_by; ?>">
                    <input name="" class="form-control autocomplete-name_select autocomplete-name_select-name-input-<?php echo time(); ?>-2" data-source="<?php echo site_url("payroll_templates/ajax/search_name"); ?>" data-name_id="approved_by_name_id" type="text" style="display: none;">
                    <div class="form-control autocomplete-name_select-name-display-<?php echo time(); ?>-2"><a class="badge" id="changeName" href="#changeName" data-id="<?php echo $payroll->approved_by; ?>" data-name_id="approved_by_name_id" data-timestamp="<?php echo time(); ?>-2"><?php echo ($payroll->approved_by_name) ? $payroll->approved_by_name : 'not assigned'; ?></a></div>
                  </div>
          </div>
        </div>

      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>Group By</label>
                <select name="group_by" class="form-control">
                    <option value="group" <?php echo ($payroll->group_by=='group') ? 'SELECTED' : ''; ?>>Group (Default)</option>
                    <option value="area" <?php echo ($payroll->group_by=='area') ? 'SELECTED' : ''; ?>>Area</option>
                    <option value="position" <?php echo ($payroll->group_by=='position') ? 'SELECTED' : ''; ?>>Position</option>
                    <option value="status" <?php echo ($payroll->group_by=='status') ? 'SELECTED' : ''; ?>>Status</option>
                </select>
              </div>
          </div>
<?php if(unserialize(PAYROLL_PRINT_FORMATS)) { ?>
          <div class="col-md-6">

              <div class="form-group">
                <label>Print Format</label>
                <select name="print_format" class="form-control">
                    <option value="">Default</option>
              <?php foreach(unserialize(PAYROLL_PRINT_FORMATS) as $key=>$value) { ?>
                  <option value="<?php echo $key; ?>"<?php echo ($key==$payroll->print_format) ? ' SELECTED' : ''; ?>><?php echo $value; ?></option>
              <?php } ?>
                </select>
              </div>
          </div>
<?php } ?>
        </div>
        
  <a href="<?php echo site_url("payroll/lock/{$payroll->id}") . "?next=" . $this->input->get('next') ; ?>" class="btn btn-xs btn-danger confirm">Lock Payroll</a>
<?php } ?>

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