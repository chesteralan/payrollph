<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/template_preview_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                <a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Deductions" data-url="<?php echo site_url("payroll_templates/deductions/{$template->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
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
<a href="<?php echo site_url("payroll_deductions/preview/{$template->id}"); ?>" class="glyphicon glyphicon-arrow-left body_wrapper"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_deductions/preview/{$template->id}/{$payroll_group->group_id}"); ?>" class="glyphicon glyphicon-filter body_wrapper"></a>
<?php } ?>
<?php } ?>
                <?php echo $payroll_group->name; ?> 
                
<?php if( !$this->session->userdata('current_employee') ) { ?>
<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll_templates/employees/{$template->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>


                </th>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  ?>
                <th width="7%" class="text-right">
<?php echo ($column->abbr) ? $column->abbr : $column->name; ?> <a class="ajax-modal" data-toggle="modal" href="#ajaxModal" data-title="Edit <?php echo $column->name; ?>" data-url="<?php echo site_url("lists_deductions/edit/{$column->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                </th>
<?php } ?>
                <th width="7%" class="text-right">Total</th>
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
                <a href="<?php echo site_url("employees_deductions/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper pull-right"><span class="glyphicon glyphicon-cog"></span></a>


<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page"; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

                </td>
<?php /*
                $total_deductions = 0;
                if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
                    <td class="text-right">
                    <?php 
print_r($employee);
                    $var = 'deductions_' . $column->id;
                    $total_deductions += $employee->$var;
                    $total[$column->id] += $employee->$var;

  $entries_url = site_url("payroll_deductions/preview_entries/{$template->id}/{$employee->name_id}/{$column->id}/ajax") . "?next=" . uri_string();
  //$entries_url = site_url("employees_deductions/add/{$employee->name_id}/ajax") . "?template_id={$template->id}&benefit_id={$column->id}&next=" . uri_string();

                    ?>
<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $column->name; ?> - <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo $entries_url; ?>" class="ajax-modal" data-hide_footer="1">
                    <?php echo number_format($employee->$var,2); ?>
</a></td>

<?php } */ ?>

                <?php 
$total_deductions = 0;

                if( $deductions_columns ) foreach( $deductions_columns as $column ) { 

                    $var2 = 'deductions_' . $column->id . '_data';
                    $deductions_data = $employee->$var2;
                    $column_name = $column->name;
                    $hide_footer = 0;
                    $ee_amount = 0;

                    if( $deductions_data ) {
                   
                    foreach($deductions_data as $deductions2) {
                        switch( $deductions2->computed ) {
                          case 'hour':
                            $eamount = $deductions2->amount * $days_present;
                          break;
                          case 'day':
                            $eamount = $deductions2->amount * $days_present;
                          break;
                          case 'month':
                          default:
                            $eamount = $deductions2->amount;
                          break;
                        }
/*
                        switch( $deductions2->multiplier ) { 
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
*/
                        $ee_amount += $eamount;
                    }

                    $total_deductions += $ee_amount;
                    $total[$column->id] += $ee_amount;

                    $entries_url = site_url("payroll_deductions/preview_entries/{$template->id}/{$employee->name_id}/{$column->id}/ajax") . "?next=" . uri_string();
                    $hide_footer = 1;
                  } else {
                    $column_name = "Add " . $column->name;
                    $entries_url = site_url("employees_deductions/add/{$employee->name_id}/ajax") . "?template_id={$template->id}&deduction_id={$column->id}&next=" . uri_string();
                  }
                 ?>
                    <td class="text-right"><a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $column_name; ?> - <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo $entries_url; ?>" class="ajax-modal" <?php echo ($hide_footer) ? 'data-hide_footer="1"' : ''; ?>>
                    <?php echo number_format($ee_amount,2); ?></a>

                    </td>
                <?php } ?>
                <td class="text-right">
                  <?php echo number_format($total_deductions,2); ?>
                  </td>
              </tr>
<?php         } 

      } ?>

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
                <th width="7%" class="text-right"><?php echo ($column->abbr) ? $column->abbr : $column->name; ?>
                  
<a class="ajax-modal" data-toggle="modal" href="#ajaxModal" data-title="Edit <?php echo $column->name; ?>" data-url="<?php echo site_url("lists_deductions/edit/{$column->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                </th>
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

                  <strong><?php 
$total_deductions += $total[$column->id];
                  echo number_format($total[$column->id],2);?></strong>

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