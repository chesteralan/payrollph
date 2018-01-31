<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">

<div class="btn-group pull-right" role="group" aria-label="..." style="margin-bottom: 5px;">
  <button class="btn btn-default btn-xs sortable-asc1 accordion-sort-asc" data-sortable="sortable-employees" type="button"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button> 
  <button class="btn btn-default btn-xs sortable-desc1 accordion-sort-desc" data-sortable="sortable-employees" type="button"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></button> 
</div>

          <h3 class="panel-title">
<?php if($this->input->get('action')!='sort') { ?>
  Configure Payroll Employees
<?php } else { ?>
  Sort Payroll Employees
<?php } ?>
          </h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( isset($output) && ($output=='ajax') ) { ?>
<div class="btn-group" role="group" aria-label="..." style="margin-bottom: 5px;">
  <button class="btn btn-default btn-xs sortable-asc1 accordion-sort-asc" data-sortable="sortable-employees" type="button"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button> 
  <button class="btn btn-default btn-xs sortable-desc1 accordion-sort-desc" data-sortable="sortable-employees" type="button"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></button> 
</div>
<?php } ?>

<?php /*
<div class="list-group sortable sortable-employees">
  <?php foreach($employees as $employee) { ?>
  <li class="list-group-item">
  <input type="hidden" name="name_id[]" value="<?php echo $employee->name_id; ?>">
  <span class="glyphicon glyphicon-sort pull-right" style="margin-left: 10px;"></span>
    <p class="pull-right"><?php echo $employee->position_name; ?></p>
    <h4 class="list-group-item-heading">
    <label><input type="checkbox" name="selected[]" value="<?php echo $employee->name_id; ?>" <?php echo ($employee->active==1) ? "CHECKED" : ""; ?>> <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></label>
    </h4>
<?php if($this->input->get('action')!='sort') { ?>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <select class="form-control input-sm" name="payslip_template[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
          <option value="none">No Payslip</option>
          <option value="payslip" <?php echo ($employee->template=='payslip') ? 'SELECTED' : ''; ?>>Payslip (1/4)</option>
          <option value="payslip2" <?php echo ($employee->template=='payslip2') ? 'SELECTED' : ''; ?>>Payslip (1/2)</option>
          <option value="cash_voucher" <?php echo ($employee->template=='cash_voucher') ? 'SELECTED' : ''; ?>>Cash Voucher</option>
          <option value="clergy_allowance" <?php echo ($employee->template=='clergy_allowance') ? 'SELECTED' : ''; ?>>Clergy Allowance</option>
      </select>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-6">
      <?php if( $print_groups ) { ?>
            <select class="form-control input-sm" name="print_group[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
              <option value="none">No Print Group</option>
              <?php foreach($print_groups as $grp) { ?>
                <option value="<?php echo $grp->id; ?>" <?php echo ($employee->print_group==$grp->id) ? "SELECTED" : ""; ?>><?php echo $grp->name; ?></option>
              <?php } ?>
            </select>
    <?php } ?>
  </div>
</div>
<?php } ?>
  </li>
  <?php } ?>
</div>
*/ ?>


<div class="panel-group sortable sortable-employees" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach($employees as $employee) { ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?php echo $employee->name_id; ?>">
      <h4 class="panel-title">
        <label><input type="checkbox" name="selected[]" value="<?php echo $employee->name_id; ?>" <?php echo ($employee->active==1) ? "CHECKED" : ""; ?>></label>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $employee->name_id; ?>" aria-expanded="true" aria-controls="collapseOne">
          <input type="hidden" name="name_id[]" value="<?php echo $employee->name_id; ?>">
          <span class="glyphicon glyphicon-sort pull-right" style="margin-left: 10px;"></span>
           <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $employee->name_id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $employee->name_id; ?>">
      <div class="panel-body">


<?php if($this->input->get('action')!='sort') { ?>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <select class="form-control input-sm" name="payslip_template[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
          <option value="none">No Payslip</option>
          <option value="payslip" <?php echo ($employee->template=='payslip') ? 'SELECTED' : ''; ?>>Payslip (1/4)</option>
          <option value="payslip2" <?php echo ($employee->template=='payslip2') ? 'SELECTED' : ''; ?>>Payslip (1/2)</option>
          <option value="payslip3" <?php echo ($employee->template=='payslip3') ? 'SELECTED' : ''; ?>>Payslip (1/2) v2</option>
          <option value="cash_voucher" <?php echo ($employee->template=='cash_voucher') ? 'SELECTED' : ''; ?>>Cash Voucher</option>
          <option value="clergy_allowance" <?php echo ($employee->template=='clergy_allowance') ? 'SELECTED' : ''; ?>>Clergy Allowance</option>
      </select>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-6">
      <?php if( $print_groups ) { ?>
            <select class="form-control input-sm" name="print_group[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
              <option value="none">No Print Group</option>
              <?php foreach($print_groups as $grp) { ?>
                <option value="<?php echo $grp->id; ?>" <?php echo ($employee->print_group==$grp->id) ? "SELECTED" : ""; ?>><?php echo $grp->name; ?></option>
              <?php } ?>
            </select>
    <?php } ?>
  </div>
</div>
<?php } ?>

      </div>
    </div>
  </div>
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