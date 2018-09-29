<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
<?php if( !$column_id ) { ?>
<?php if(!$payroll->lock) { ?>
                <a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Deductions" data-url="<?php echo site_url("payroll/deductions/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
<?php } ?>
<?php } else { ?>
  <?php if( $other_payrolls ) { ?>
    <div class="btn-group btn-group-xs pull-right">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo ( isset($compare_payroll) ) ? $compare_payroll->name : "Compare"; ?> <span class="caret"></span>
      </button>
      <ul class="dropdown-menu dropdown-menu-right">
      <?php foreach($other_payrolls as $op) { ?>
        <li><a href="<?php echo site_url(uri_string()) . "?" . querystring_add( 'compare', $op->id); ?>"><?php echo $op->name; ?></a></li>
      <?php } ?>
      </ul>
    </div>
  <?php } ?>
<?php } ?>

                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php } ?>
<?php endif; ?>

<?php if( !isset($no_inclusive_dates) ) { ?>
  
<?php if( $payroll_groups && $deductions_columns ) { ?>

<?php
$total = array();
foreach( $deductions_columns as $column ) { 
  $total[$column->id] = 0;
}
if( isset($compare_payroll) ) {
  $total['compare'] = 0;
}
?>

<?php foreach($payroll_groups as $payroll_group) { ?>
 
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_deductions/view/{$payroll->id}/0/{$column_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_deductions/view/{$payroll->id}/{$payroll_group->group_id}/{$column_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></a>
<?php } ?>
<?php } ?>

                <?php echo $payroll_group->name; ?>
<?php if(!$payroll->lock) { ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
 <a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$payroll->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>
<?php } ?>
                </th>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  ?>
                <th width="7%" class="text-right"><?php echo ($column->abbr!='') ? $column->abbr : $column->name; ?> 
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_deductions/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_deductions/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                </th>
<?php } ?>
<?php if( isset($compare_payroll) ) { ?>
  <th width="20%" class="text-right"><?php echo $compare_payroll->name; ?></th>
  <th width="20%" class="text-right">Difference</th>
<?php } ?>
<?php if( !$column_id ) { ?>
                <th width="7%" class="text-right">Total</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
<?php if($payroll_group->employees) { ?>
<?php foreach($payroll_group->employees as $employee) {
              ?>
              <tr>
                <td>
<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page&next=" . uri_string(); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

<?php if(!$payroll->lock) { ?>
                <a href="<?php echo site_url("employees_deductions/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper pull-right"><span class="glyphicon glyphicon-cog"></span></a>
<?php } ?>
                </td>
                <?php 
                $total_deductions = 0;
                if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
                    <td class="text-right">

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> - <?php echo ($column->abbr!='') ? $column->notes : $column->abbr; ?>" data-url="<?php echo payroll_url("payroll_deductions/entries/{$payroll->id}/{$employee->pe_id}/{$column->id}/ajax"); ?>" data-hide_footer="1">
                    <?php 
                    $var = 'deductions_' . $column->id;
                    $total_deductions += $employee->$var;
                    $total[$column->id] += $employee->$var;

                    echo number_format($employee->$var,2); ?>
</a>

                    </td>
                <?php } ?>
<?php if( isset($compare_payroll) ) { ?>
  <td class="text-right">
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> - <?php echo ($column->notes!='') ? $column->notes : $column->name; ?>" data-url="<?php echo site_url("payroll_deductions/entries/{$compare_payroll->id}/{$employee->name_id}/{$column->id}/ajax") . "?lock=1"; ?>" data-hide_footer="1">
  <?php 
                    $var2 = 'compare_' . $column->id;
                    $total['compare'] += $employee->$var2;
                    echo number_format($employee->$var2,2); ?>
</a>
                    </td>

<td class="text-right"><strong><?php echo number_format(($employee->$var - $employee->$var2),2); ?></strong></td>
<?php } ?>
<?php if( !$column_id ) { ?>
                <td class="text-right"><?php echo number_format($total_deductions,2); ?></td>
<?php } ?>
              </tr>
<?php } ?>
<?php } ?>
            </tbody>
          </table>

    <?php } ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>TOTAL</th>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
                <th width="7%" class="text-right"><?php echo $column->name; ?> 
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_deductions/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_deductions/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                </th>
<?php } ?>
<?php if( isset($compare_payroll) ) { ?>
  <th width="20%" class="text-right"><?php echo $compare_payroll->name; ?></th>
  <th width="20%" class="text-right">Difference</th>
<?php } ?>
<?php if( !$column_id ) { ?>
  <th width="7%" class="text-right">TOTAL</th>
<?php } ?>  
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
<?php if( isset($compare_payroll) ) { ?>
  <td class="text-right"><strong><?php echo number_format($total['compare'],2);?></strong></td>
  <td class="text-right"><strong><?php echo number_format(($total[$column->id] - $total['compare']),2);?></strong></td>
<?php } ?>
<?php if( !$column_id ) { ?>
                <td class="text-right"><strong><?php echo number_format($total_deductions,2); ?></strong></td>
<?php } ?>
  </tr>
            </tbody>
            </table>
<?php } ?>
<?php } else { ?>

  <div class="text-center">No Group and/or Deduction Assigned!</div>

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