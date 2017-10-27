<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/template_preview_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Earnings" data-url="<?php echo site_url("payroll_templates/earnings/{$template->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payroll_groups && $earnings_columns ) { ?>
  
<?php
$total = array();
foreach( $earnings_columns as $column ) { 
  $total[$column->id] = 0;
}
?>

  <?php foreach($payroll_groups as $payroll_group) { ?>
 
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_earnings/preview/{$template->id}"); ?>" class="glyphicon glyphicon-arrow-left body_wrapper"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_earnings/preview/{$template->id}/{$payroll_group->group_id}"); ?>" class="glyphicon glyphicon-filter body_wrapper"></a>
<?php } ?>
<?php } ?>
                <?php echo $payroll_group->name; ?> 
<?php if( !$this->session->userdata('current_employee') ) { ?>
<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll_templates/employees/{$template->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>

                </th>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
                <th width="10%" class="text-right">Total</th>
              </tr>
            </thead>
            <tbody>
            
<?php if($payroll_group->employees) {
  
              foreach($payroll_group->employees as $employee) { 
              ?>
              <tr>
                <td>

<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                  <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 
              <a href="<?php echo site_url("employees_earnings/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper pull-right"><span class="glyphicon glyphicon-cog"></span></a>

<a class="ajax-modal" href="#ajaxModal" data-modal_size="large" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page"; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

</td>
                <?php 
$total_earnings = 0;

                if( $earnings_columns ) foreach( $earnings_columns as $column ) { 

                    $var2 = 'earnings_' . $column->id . '_data';
                    $earnings_data = $employee->$var2;
                    $column_name = $column->name;

                     $ee_amount = 0;
                    if( $earnings_data ) {
                   
                    foreach($earnings_data as $earning2) {
                        switch( $earning2->computed ) {
                          case 'hour':
                            $eamount = $earning2->amount * $days_present;
                          break;
                          case 'day':
                            $eamount = $earning2->amount * $days_present;
                          break;
                          case 'month':
                          default:
                            $eamount = $earning2->amount;
                          break;
                        }

                        switch( $earning2->multiplier ) { 
                          case 'employment':
                            $end_date = new DateTime(date('Y-m-d'));
                            $hired = new DateTime($employee->hired);
                            $diff = $hired->diff($end_date);
                            $eamount = $eamount * $diff->y;
                          break;
                          case 'birthday':
                            $end_date = new DateTime(date('Y-m-d'));
                            $birth_date = new DateTime($employee->birthday);
                            $diff = $birth_date->diff($end_date);
                            $eamount = $eamount * $diff->y;
                          break;
                        }

                        $ee_amount += $eamount;
                    }

                    $total_earnings += $ee_amount;
                    $total[$column->id] += $ee_amount;

                    $entries_url = site_url("payroll_earnings/preview_entries/{$template->id}/{$employee->name_id}/{$column->id}/ajax") . "?next=" . uri_string();
                  } else {
                    $column_name = "Add " . $column->name;
                    $entries_url = site_url("employees_earnings/add/{$employee->name_id}/ajax") . "?template_id={$template->id}&earning_id={$column->id}&next=" . uri_string();
                  }
                 ?>
                    <td class="text-right"><a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $column_name; ?> - <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo $entries_url; ?>" class="ajax-modal">
                    <?php echo number_format($ee_amount,2); ?></a>

                    </td>
                <?php } ?>
                <td class="text-right"><?php echo number_format($total_earnings,2); ?></td>
              </tr>
<?php         } 
      } ?>

            </tbody>
          </table>

    <?php } ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
    <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>TOTAL</th>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
  <th width="10%" class="text-right">TOTAL</th>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
            <td></td>
<?php 
$total_earnings = 0;
if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                <td class="text-right">
                  <strong><?php 
$total_earnings += $total[$column->id];
                  echo number_format($total[$column->id],2);?></strong>

                </td>
<?php } ?>
                <td class="text-right"><strong><?php echo number_format($total_earnings,2); ?></strong></td>
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