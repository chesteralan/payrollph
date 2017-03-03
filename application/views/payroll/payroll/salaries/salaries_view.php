<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
<!--<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Employee Groups" data-url="<?php echo site_url("payroll/groups/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>-->
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php $total_salaries = 0; ?>

<?php if( $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>
 
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_salaries/view/{$payroll->id}"); ?>" class="glyphicon glyphicon-arrow-left body_wrapper"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_salaries/view/{$payroll->id}/{$payroll_group->group_id}"); ?>" class="glyphicon glyphicon-filter body_wrapper"></a>
<?php } ?>
                <?php echo $payroll_group->name; ?></th>
<!--
                <th width="10%" class="text-right">Working Days</th>
                <th width="10%" class="text-right">Absences</th>
-->
                <th width="10%" class="text-right">Days Present</th>
                <th width="10%" class="text-right">Rate per day</th>
                <th width="10%" class="text-right">Basic Salary</th>
                <th width="10%" class="text-right">COLA</th>
                <th width="10%" class="text-right">Gross Pay</th>
              </tr>
            </thead>
            <tbody>
            
<?php if($payroll_group->employees) { 
              foreach($payroll_group->employees as $employee) {
$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
if( $employee->salary ) {
  $salary = $employee->salary;
  switch( $salary->rate_per ) {
    case 'month':
      $monthly_rate = $salary->amount;
      $daily_rate = ( $salary->amount / $salary->days );
      $hourly_rate = ( $salary->amount / $salary->days / $salary->hours );
    break;
    case 'day':
      $monthly_rate = ( $salary->amount * $salary->days );
      $daily_rate = $salary->amount;
      $hourly_rate = ( $salary->amount / $salary->hours );
    break;
    case 'hour':
      $monthly_rate = ( $salary->amount * $salary->days * $salary->hours );
      $daily_rate = ( $salary->amount * $salary->hours );
      $hourly_rate = $salary->amount;
    break;
  }
}
$present_days = $inclusive_dates->working_days - $days_absent;
$basic_salary = ($daily_rate * $present_days); 
$cola = ($salary->cola * $present_days);
$employee_gross_pay = ($basic_salary + $cola);
$total_salaries += $employee_gross_pay; 
              ?>
              <tr>
                <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> (<?php echo $employee->position; ?>)
                <a href="<?php echo site_url("employees_salaries/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper"><span class="glyphicon glyphicon-cog"></span></a>
                </td>
<!--
                <td class="text-right"><?php echo $inclusive_dates->working_days; ?></td>
                <td class="text-right">
                <?php echo $days_absent; ?>
                </td>
-->
                <td class="text-right"><?php echo $present_days; ?></td>
                <td class="text-right"><?php echo number_format($daily_rate,2); ?></td>
                <td class="text-right"><?php echo number_format($basic_salary,2); ?></td>
                <td class="text-right"><?php echo number_format($cola,2); ?></td>
                <td class="text-right"><?php echo number_format($employee_gross_pay,2); ?></td>
              </tr>
<?php         } 
      } ?>

            </tbody>
          </table>

    <?php } ?>

    <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>TOTAL</th>
                <th width="10%" class="text-right"></th>
                <th width="10%" class="text-right"></th>
                <th width="10%" class="text-right"></th>
                <th width="10%" class="text-right"></th>
                <th width="10%" class="text-right">Total Gross Pay</th>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
                <td></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"><strong><?php echo number_format($total_salaries,2); ?></strong></td>
  </tr>
            </tbody>
            </table>

<?php } else { ?>

  <div class="text-center">No Group Assigned!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>