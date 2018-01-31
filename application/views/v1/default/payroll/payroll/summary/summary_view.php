<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php 
$total_basic_salary = 0; 
$total_absences = 0;
$total_gross_salary = 0; 
$total_earnings = 0; 
$total_gross_pay = 0; 
$total_benefits = 0; 
$total_deductions = 0; 
?>

<?php if( $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>
 <?php if($payroll_group->employees) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_summary/view/{$payroll->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></span></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_summary/view/{$payroll->id}/{$payroll_group->group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
<?php } ?>
                <?php echo $payroll_group->name; ?>
<?php if(!$payroll->lock) { ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
 <a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$payroll->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>
<?php } ?>
                </th>
<?php if( $column_group_salaries ) { ?>
                <th width="10%" class="text-right">Gross Salary</th>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( (isset($payroll->earnings_columns)) && ( $payroll->earnings_columns > 0 ) ) { ?>
                <th width="10%" class="text-right">Earnings</th>
<?php } ?>
<?php } ?>
<?php if( $column_group_salaries||$column_group_earnings ) { ?>
                <th width="10%" class="text-right">Gross Pay</th>
<?php } ?>
<?php if( $column_group_benefits ) { ?>
<?php if( (isset($payroll->benefits_columns)) && ( $payroll->benefits_columns > 0 ) ) { ?>
                <th width="10%" class="text-right">Benefits</th>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( (isset($payroll->deductions_columns)) && ( $payroll->deductions_columns > 0 ) ) { ?>
                <th width="10%" class="text-right">Deductions</th>
<?php } ?>
<?php } ?>
                <th width="10%" class="text-right">Net Pay</th>
              </tr>
            </thead>
            <tbody>
            
<?php 
              foreach($payroll_group->employees as $employee) { 
$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola_rate = 0;
if( $employee->salary ) {
  $salary = $employee->salary;
  switch( $salary->rate_per ) {
    case 'month':
      $monthly_rate = $salary->amount;
      $daily_rate = ( ($salary->amount * $salary->months) / $salary->annual_days );
      $hourly_rate = ( (($salary->amount * $salary->months) / $salary->annual_days) / $salary->hours );
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
  $cola_rate = (isset($salary)) ? $salary->cola : 0;
}

$present_days = $inclusive_dates->working_days - $days_absent;
$absences = $days_absent * $daily_rate;
$total_absences += $absences;
$basic_salary = ($daily_rate * $inclusive_dates->working_days); 
//$basic_salary = ($monthly_rate / 2); 
$total_basic_salary += $basic_salary;
$cola = ($cola_rate * $present_days);
$employee_gross_pay = (($basic_salary + $cola) - $absences);
$total_gross_salary += $employee_gross_pay; 
$total_earnings += $employee->gross_earnings;
$total_benefits += $employee->gross_benefits;
$total_deductions += $employee->gross_deductions;
              ?>
              <tr>
                <td>
<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> <!--(<?php echo $employee->position; ?>)-->
                
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page"; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>


                </td>

<?php if( $column_group_salaries ) { ?>
                <td class="text-right"><?php echo number_format($employee_gross_pay,2); ?></td>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( (isset($payroll->earnings_columns)) && ( $payroll->earnings_columns > 0 ) ) { ?>
                <td class="text-right"><?php echo number_format($employee->gross_earnings,2); ?></td>
<?php } ?>
<?php } ?>
<?php if( $column_group_salaries||$column_group_earnings ) { ?>
                <td class="text-right bold"><?php echo number_format(($employee_gross_pay+$employee->gross_earnings),2); ?></td>
<?php } ?>
<?php if( $column_group_benefits ) { ?>
<?php if( (isset($payroll->benefits_columns)) && ( $payroll->benefits_columns > 0 ) ) { ?>
                <td class="text-right"><?php echo number_format($employee->gross_benefits,2); ?></td>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( (isset($payroll->deductions_columns)) && ( $payroll->deductions_columns > 0 ) ) { ?>
                <td class="text-right"><?php echo number_format($employee->gross_deductions,2); ?></td>
<?php } ?>
<?php } ?>
                <td class="text-right bold"><?php echo number_format((($employee_gross_pay+$employee->gross_earnings)-($employee->gross_benefits+$employee->gross_deductions)),2); ?></td>
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
<?php if( $column_group_salaries ) { ?>
                                <th width="10%" class="text-right">Gross Salary</th>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( (isset($payroll->earnings_columns)) && ( $payroll->earnings_columns > 0 ) ) { ?>
                <th width="10%" class="text-right">Earnings</th>
<?php } ?>
<?php } ?>
<?php if( $column_group_salaries||$column_group_earnings ) { ?>
                <th width="10%" class="text-right">Gross Pay</th>
<?php } ?>
<?php if( $column_group_benefits ) { ?>
<?php if( (isset($payroll->benefits_columns)) && ( $payroll->benefits_columns > 0 ) ) { ?>
                <th width="10%" class="text-right">Benefits</th>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( (isset($payroll->deductions_columns)) && ( $payroll->deductions_columns > 0 ) ) { ?>
                <th width="10%" class="text-right">Deductions</th>
<?php } ?>
<?php } ?>
                <th width="10%" class="text-right">Net Pay</th>
              </tr>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
                <td></td>
<?php if( $column_group_salaries ) { ?>
                <td class="text-right"><strong><?php echo number_format($total_gross_salary,2); ?></strong></td>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( (isset($payroll->earnings_columns)) && ( $payroll->earnings_columns > 0 ) ) { ?>
                <td class="text-right"><strong><?php echo number_format($total_earnings,2); ?></strong></td>
<?php } ?>
<?php } ?>
<?php if( $column_group_salaries||$column_group_earnings ) { ?>
                <td class="text-right"><strong><?php echo number_format(($total_gross_salary+$total_earnings),2); ?></strong></td>
<?php } ?>
                
<?php if( $column_group_benefits ) { ?>
<?php if( (isset($payroll->benefits_columns)) && ( $payroll->benefits_columns > 0 ) ) { ?>
                <td class="text-right"><strong><?php echo number_format($total_benefits,2); ?></strong></td>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( (isset($payroll->deductions_columns)) && ( $payroll->deductions_columns > 0 ) ) { ?>
                <td class="text-right"><strong><?php echo number_format($total_deductions,2); ?></strong></td>
<?php } ?>
<?php } ?>
                <td class="text-right"><strong><?php echo number_format(($total_gross_salary+$total_earnings)-($total_benefits+$total_deductions),2); ?></strong></td>
  </tr>
            </tbody>
            </table>
<?php } ?>
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