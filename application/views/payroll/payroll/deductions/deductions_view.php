<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                <a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Deductions" data-url="<?php echo site_url("payroll/deductions/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payroll_groups && $deductions_columns ) { ?>

<?php
$total = array();
foreach( $deductions_columns as $column ) { 
  $total[$column->id] = 0;
}
?>

<?php foreach($payroll_groups as $payroll_group) { ?>
 <?php if($payroll_group->employees) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_deductions/view/{$payroll->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_deductions/view/{$payroll->id}/{$payroll_group->group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></a>
<?php } ?>
<?php } ?>

                <?php echo $payroll_group->name; ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$payroll->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>
                </th>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  ?>
                <th width="7%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
                <th width="7%" class="text-right">Total</th>
              </tr>
            </thead>
            <tbody>
            
<?php 
              foreach($payroll_group->employees as $employee) {
              ?>
              <tr>
                <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> (<?php echo $employee->position; ?>)
                <a href="<?php echo site_url("employees_deductions/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper"><span class="glyphicon glyphicon-cog"></span></a>
                </td>
                <?php 
                $total_deductions = 0;
                if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
                    <td class="text-right">
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> - <?php echo ($column->notes!='') ? $column->notes : $column->name; ?>" data-url="<?php echo site_url("payroll_deductions/entries/{$payroll->id}/{$employee->name_id}/{$column->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">
                    <?php 
                    $var = 'deductions_' . $column->id;
                    $total_deductions += $employee->$var;
                    $total[$column->id] += $employee->$var;

                    echo number_format($employee->$var,2); ?>
</a>
                    </td>
                <?php } ?>
                <td class="text-right"><?php echo number_format($total_deductions,2); ?></td>
              </tr>
<?php } ?>

            </tbody>
          </table>
<?php } ?>
    <?php } ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>TOTAL</th>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
                <th width="7%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
  <th width="7%" class="text-right">TOTAL</th>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
            <td></td>
<?php 
$total_deductions = 0;
if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
                <td class="text-right">
                <a href="<?php echo site_url("payroll_deductions/item_schedule/{$payroll->id}/{$column->id}") . "?next=" . uri_string(); ?>" class="body_wrapper">
                  <strong><?php 
$total_deductions += $total[$column->id];
                  echo number_format($total[$column->id],2);?></strong>
                  </a>
                </td>
<?php } ?>
                <td class="text-right"><strong><?php echo number_format($total_deductions,2); ?></strong></td>
  </tr>
            </tbody>
            </table>
<?php } ?>
<?php } else { ?>

  <div class="text-center">No Group and/or Deduction Assigned!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>