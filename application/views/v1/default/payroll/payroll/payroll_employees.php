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

<div class="col-md-5 pull-right">
  <input type="text" class="form-control input-sm filter-list-name" data-list="accordion" placeholder="Filter Name...">
</div>

<div class="btn-group" role="group" aria-label="..." style="margin-bottom: 5px;">
  <button class="btn btn-default btn-xs sortable-asc1 accordion-sort-asc" data-sortable="sortable-employees" type="button"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button> 
  <button class="btn btn-default btn-xs sortable-desc1 accordion-sort-desc" data-sortable="sortable-employees" type="button"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></button> 
</div>
<?php } ?>

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
    
<?php if($this->input->get('action')!='sort') { ?>
<?php if($employee->active==1) { ?>
    <div id="collapse<?php echo $employee->name_id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $employee->name_id; ?>">
      <div class="panel-body">


<div class="row" style="margin-top:10px;">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <select class="form-control input-sm" name="payslip_template[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
<?php foreach( $payslip_templates as $k=>$v) { ?>
          <option value="<?php echo $k; ?>" <?php echo ($employee->template==$k) ? 'SELECTED' : ''; ?>><?php echo $v; ?></option>
<?php } ?>
      </select>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-6">
    <select class="form-control input-sm" name="payslip_template[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
<?php foreach( $payslip_templates as $k=>$v) { ?>
          <option value="<?php echo $k; ?>" <?php echo ($employee->template==$k) ? 'SELECTED' : ''; ?>><?php echo $v; ?></option>
<?php } ?>
      </select>
  </div>
</div>

<div class="row" style="margin-top:10px;">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <select class="form-control input-sm" name="payslip_template[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
<?php foreach( $payslip_templates as $k=>$v) { ?>
          <option value="<?php echo $k; ?>" <?php echo ($employee->template==$k) ? 'SELECTED' : ''; ?>><?php echo $v; ?></option>
<?php } ?>
      </select>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-6">
    <select class="form-control input-sm" name="payslip_template[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
<?php foreach( $payslip_templates as $k=>$v) { ?>
          <option value="<?php echo $k; ?>" <?php echo ($employee->template==$k) ? 'SELECTED' : ''; ?>><?php echo $v; ?></option>
<?php } ?>
      </select>
  </div>
</div>


<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <select class="form-control input-sm" name="payslip_template[<?php echo $employee->name_id; ?>]" data-style="btn-default btn-sm">
<?php foreach( $payslip_templates as $k=>$v) { ?>
          <option value="<?php echo $k; ?>" <?php echo ($employee->template==$k) ? 'SELECTED' : ''; ?>><?php echo $v; ?></option>
<?php } ?>
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

      </div>
    </div>
<?php } ?>
<?php } ?>

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