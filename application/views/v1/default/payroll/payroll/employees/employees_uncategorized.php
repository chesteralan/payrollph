<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$payslip_templates = unserialize(PAYROLL_PAYSLIP_TEMPLATES);
?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">


<?php if( isset($no_inclusive_dates) ) { ?>
<div class="alert alert-danger" role="alert"><strong>ERROR FOUND!</strong> Inclusive dates not set! <a data-title="Inclusive Dates" class="btn btn-danger btn-xs ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-url="<?php echo site_url("payroll/inclusive_dates/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" >Fix This</a></div>
<?php } ?>

<?php if( !isset($no_inclusive_dates) ) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">

                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
<span class="badge">Grouped by
<?php 
switch($payroll->group_by) {
  case 'position':
    echo 'Position';
  break;
  case 'area':
    echo 'Area';
  break;
  case 'status':
    echo 'Status';
  break;
  case 'group':
    echo 'Group';
  break;
}
?>
</span>
<span class="badge" style="background-color: red">Uncategorized</span>

                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php } ?>
<?php endif; ?>

<?php if( !isset($no_inclusive_dates) ) { ?>

<?php if( count($uncategorized_employees) ) { ?>

          <table class="table table-default table-hover" id="Payroll-Group-">
            <thead>
              <tr class="warning">
                    <th width="28%">Name</th>
                    <th width="12%" class="text-right">Status</th>
                <th width="12%" class="text-right">Group</th>
                <th width="12%" class="text-right">Position</th>
                <th width="12%" class="text-right">Area</th>
                <th width="12%" class="text-right">Payslip</th>
                <th width="12%" class="text-right">Print Group</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($uncategorized_employees as $employee) { //print_r($employee); ?>
                <tr class="<?php echo ($employee->active) ? '' : 'danger'; ?>">
                    <td>
<?php if(!$payroll->lock) { ?>
  <a class="confirm" href="<?php echo site_url("payroll_employees/deactivate/{$payroll->id}/{$employee->id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-remove"></span></a>
<?php } ?>

                      <?php echo $employee->prefix; ?> <?php echo $employee->firstname; ?> <?php echo ($employee->middlename!='') ? substr($employee->middlename, 0,2) . '.' : ''; ?> <?php echo $employee->lastname; ?></td>

                <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Status" data-url="<?php echo site_url("payroll_employees/change_status/{$payroll->id}/{$employee->pe_id}/ajax") . "?next=" .uri_string(); ?>">
<?php } ?>
                <?php echo ($employee->status_name) ? $employee->status_name : '- - - - -'; ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                </td>

               <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Group" data-url="<?php echo site_url("payroll_employees/change_group/{$payroll->id}/{$employee->pe_id}/ajax") . "?next=" .uri_string(); ?>">
<?php } ?>
                <?php echo ($employee->group_name) ? $employee->group_name : '- - - - -'; ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                </td>
                <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Position" data-url="<?php echo site_url("payroll_employees/change_position/{$payroll->id}/{$employee->pe_id}/ajax") . "?next=" .uri_string(); ?>">
<?php } ?>
                <?php echo ($employee->position_name) ? $employee->position_name : '- - - - -'; ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                </td>
                <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Area" data-url="<?php echo site_url("payroll_employees/change_area/{$payroll->id}/{$employee->pe_id}/ajax") . "?next=" .uri_string(); ?>">
<?php } ?>
                <?php echo ($employee->area_name) ? $employee->area_name : '- - - - -'; ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                </td>
                <td class="text-right">
<?php if(!$payroll->lock) { ?>                
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Payslip" data-url="<?php echo site_url("payroll_employees/change_payslip/{$payroll->id}/{$employee->pe_id}/ajax") . "?next=" .uri_string(); ?>">
<?php } ?>
                <?php echo (($employee->template) && (isset($payslip_templates[$employee->template]))) ? $payslip_templates[$employee->template] : '- - - - -'; ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                </td>
                <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Print Group" data-url="<?php echo site_url("payroll_employees/change_print_group/{$payroll->id}/{$employee->pe_id}/ajax") . "?next=" .uri_string(); ?>">
<?php } ?>
                <?php echo ($employee->print_group_name) ? $employee->print_group_name : '- - - - -'; ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
<?php } ?>
<?php } ?>

<?php if( ! $inner_page ): ?>
<?php if( !isset($no_inclusive_dates) ) { ?>
              </div>
              </div>

<?php } ?>

            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>