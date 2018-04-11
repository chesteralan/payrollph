<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Change Status: <strong><?php echo $name->lastname; ?>, <?php echo $name->firstname; ?></strong></h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
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

          <div class="form-group">
            <label>Payslip Template</label>
            <select class="form-control" title="Select a Status" name="payslip">
              <?php foreach($payslip_templates as $k=>$v) { ?>
                <option value="<?php echo $k; ?>" <?php echo ($employee->template==$k) ? "SELECTED" : ""; ?>><?php echo $v; ?></option>
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