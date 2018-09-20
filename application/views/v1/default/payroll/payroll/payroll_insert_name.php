<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$payslip_templates = array(
  'none' => 'No Payslip',
  'payslip' => 'Payslip (1/4)',
  'payslip2' => 'Payslip (1/2)',
  'payslip3' => 'Payslip (1/2) v2',
  'cash_voucher' => 'Cash Voucher',
  'clergy_allowance' => 'Clergy Allowance',
);

?>
<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Insert Name</h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

       <div class="row">
          <div class="col-md-12">
                  <div class="form-group">
                    <input id="insert_name_id" name="name_id" type="hidden" value="">
                    <input name="" class="form-control autocomplete-name_select autocomplete-name_select-name-input-<?php echo time(); ?>" data-source="<?php echo site_url("payroll_templates/ajax/search_name"); ?>" data-name_id="insert_name_id" type="text">
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