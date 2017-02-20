<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configure Template Employees</h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<div class="list-group sortable">
  <?php foreach($employees as $employee) { ?>
  <li class="list-group-item">
  <input type="hidden" name="name_id[]" value="<?php echo $employee->name_id; ?>">
  <span class="glyphicon glyphicon-sort pull-right" style="margin-left: 10px;"></span>
    <p class="pull-right"><?php echo $employee->position_name; ?></p>
    <h4 class="list-group-item-heading">
    <label><input type="checkbox" name="selected[]" value="<?php echo $employee->name_id; ?>" <?php echo (($employee->active==1)||is_null($employee->active)) ? "CHECKED" : ""; ?>> <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></label>
    </h4>
    
<div class="row">
  <div class="col-md-6">
    <select class="form-control input-sm" name="payslip_template[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
          <option value="none">No Payslip</option>
          <option value="payslip" <?php echo ($employee->template=='payslip') ? 'SELECTED' : ''; ?>>Payslip</option>
          <option value="cash_voucher" <?php echo ($employee->template=='cash_voucher') ? 'SELECTED' : ''; ?>>Cash Voucher</option>
      </select>
  </div>
  <div class="col-md-6">
      <?php if( $print_groups ) { ?>
            <select class="form-control input-sm" name="print_group[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
              <option value="0">No Print Group</option>
              <?php foreach($print_groups as $grp) { ?>
                <option value="<?php echo $grp->id; ?>" <?php echo ($employee->print_group==$grp->id) ? "SELECTED" : ""; ?>><?php echo $grp->name; ?></option>
              <?php } ?>
            </select>
    <?php } ?>
  </div>
</div>

  </li>
  <?php } ?>
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