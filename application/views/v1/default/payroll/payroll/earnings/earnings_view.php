<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  
<?php if( !$column_id ) { ?>
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Earnings" data-url="<?php echo site_url("payroll/earnings/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
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

<?php endif; ?>

<?php if( $payroll_groups && $earnings_columns ) { ?>
  
<?php
$total = array();
foreach( $earnings_columns as $column ) { 
  $total[$column->id] = 0;
}
if( isset($compare_payroll) ) {
  $total['compare'] = 0;
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
<a href="<?php echo site_url("payroll_earnings/view/{$payroll->id}/0/{$column_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_earnings/view/{$payroll->id}/{$payroll_group->group_id}/{$column_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></a>
<?php } ?>
<?php } ?>

                <?php echo $payroll_group->name; ?>
<?php if(!$payroll->lock) { ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
 <a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$payroll->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>
<?php } ?>
                </th>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?> 
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_earnings/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_earnings/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                </th>
<?php } ?>
<?php if( isset($compare_payroll) ) { ?>
  <th width="20%" class="text-right"><?php echo $compare_payroll->name; ?></th>
<?php } ?>
<?php if( !$column_id ) { ?>
                <th width="10%" class="text-right">Total</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
            
<?php 
  
              foreach($payroll_group->employees as $employee) { 
              ?>
              <tr>
                <td>
<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page&next=" . uri_string(); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

<?php if(!$payroll->lock) { ?>
              <a href="<?php echo site_url("employees_earnings/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper pull-right"><span class="glyphicon glyphicon-cog"></span></a>
<?php }  ?>
</td>
                <?php 
$total_earnings = 0;
                if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                    <td class="text-right">

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo ($column->notes!='') ? $column->notes : $column->name; ?>" data-url="<?php echo payroll_url("payroll_earnings/entries/{$payroll->id}/{$employee->name_id}/{$column->id}/ajax"); ?>" data-hide_footer="1">

                    <?php 
                    $var = 'earnings_' . $column->id;
                    $total_earnings += $employee->$var;
                    $total[$column->id] += $employee->$var;
                    echo number_format($employee->$var,2); 
                    ?>

</a>
                    </td>
                <?php } ?>
<?php if( isset($compare_payroll) ) { ?>
  <td class="text-right">
    <?php 
                    $var2 = 'compare_' . $column_id;
                    $total['compare'] += $employee->$var2;
                    echo number_format($employee->$var2,2); 
                    ?>
  </td>
<?php } ?>
<?php if( !$column_id ) { ?>
                <td class="text-right"><?php echo number_format($total_earnings,2); ?></td>
<?php } ?>
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
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?> 
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_earnings/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_earnings/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                </th>
<?php } ?>
<?php if( isset($compare_payroll) ) { ?>
  <th width="20%" class="text-right"><?php echo $compare_payroll->name; ?></th>
<?php } ?>
<?php if( !$column_id ) { ?>
  <th width="10%" class="text-right">TOTAL</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
            <td></td>
<?php 
$total_earnings = 0;
if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                <td class="text-right">
                <a href="<?php echo site_url("payroll_earnings/item_schedule/{$payroll->id}/{$column->id}"); ?>" class="body_wrapper">
                  <strong><?php 
$total_earnings += $total[$column->id];
                  echo number_format($total[$column->id],2);?></strong>
                  </a>
                </td>
<?php } ?>
<?php if( isset($compare_payroll) ) { ?>
  <td class="text-right"><?php echo number_format($total['compare'],2);?></td>
<?php } ?>
<?php if( !$column_id ) { ?>
                <td class="text-right"><strong><?php echo number_format($total_earnings,2); ?></strong></td>
<?php } ?>
  </tr>
            </tbody>
            </table>
<?php } ?>
<?php } else { ?>
  <div class="text-center">No Group and/or Earnings Assigned!</div>
<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>