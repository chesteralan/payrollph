<style>
  <!--
  .payslip_title {
      font-size: 20px;
      margin: 5px 0;
  }
  tr:hover{
    background: #FFF;
  }
  .bordered-all {
    border-top: 1px solid #CCC;
    border-left: 1px solid #CCC;
  }
  .bordered-all td {
    border-bottom: 1px solid #CCC;
    border-right: 1px solid #CCC;
    padding: 3px;
  }
  .hidden-columns {
    margin-top: 10px;
  }
  .hidden-columns td {
    padding: 0;
  }
  .hidden-columns .bordered-all td {
    padding: 3px;
  }
  .hidden-columns .title {
    padding: 2px;
    background: #DDD;
  }
  .payslip_box td {
    font-size: 10px!important;
  }
  .payslip_title {
    font-size: 14px;
  }
  -->
</style>
<div class="page">

<div class="payslip_box payslip2">

<table width="100%" cellpadding="0" cellspacing="0" class="bordered">
  <tr>
    <td valign="top" width="10%">
      
    </td>
    <td valign="top" width="80%">
  <div class="header-title">
    <h2 class="text-center allcaps">MBG Security &amp; Investigation Services, Inc.</h2>
    <h3 class="text-center not-bold smaller">Door 16 2/F Chio Bldg., Dedeng's Place, Ponciano St., Davao City</h3>
    <h3 class="text-center not-bold smaller"><strong>Tel.#</strong> (082) 224-3753 <strong>Website:</strong> www.mbg-security.com</h3>
  </div>
    </td>
    <td valign="top" align="right" width="10%">

    </td>
  </tr>
</table>


    <h2 class="payslip_title text-center">PAYSLIP</h2>



<table width="100%" cellpadding="0" cellspacing="0" class="bordered-all">
  <tr>
    <td width="16%"><strong>NAME</strong></td>
    <td width="30%" class="text-center"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></td>
    <td width="17%"><strong>PERIOD COVERED</strong></td>
    <td width="33%" class="text-center"><?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?></td>
  </tr>
  <tr>
    <td><strong>POSITION</strong></td>
    <td class="text-center"><?php echo $employee->position; ?></td>
    <td><strong>DEPLOYMENT</strong></td>
    <td class="text-center"><?php echo ($company->name) ? $company->name : ''; ?></td>
  </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" class="hidden-columns">
<tr>
  <td width="43%" style="vertical-align: top;">
    <table width="100%" cellpadding="0" cellspacing="0" class="bordered-all">
        <tr>
          <td colspan="2" class="text-center bold title">SALARY</td>
        </tr>
        <tr>
<?php 

$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
$days_benefits = ($employee->leave_benefits) ? ($employee->leave_benefits / $working_hours) : 0;
$days_present = ($employee->attendance_hours) ? ($employee->attendance_hours / $working_hours) : 0;
if( $employee->pe_presence ) {
  $present_days = $employee->attendance;
} else {
  $present_days = $inclusive_dates->working_days - $days_absent;
}
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola_rate = 0;
$absences = 0;
$basic_salary = 0;
$manner = 'daily';
$addon_benefits = 0;

if( $employee->salary ) {
  $salary = $employee->salary;
  $manner = $salary->manner;
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
  $absences = $days_absent * $daily_rate;
 $addon_benefits = $days_benefits * $daily_rate;


if( $employee->pe_presence ) {
    switch( $salary->manner ) {
        case 'hourly':
          $basic_salary = ($hourly_rate * $days_present); 
        break;
        case 'daily':
          $basic_salary = ($daily_rate * $present_days); 
        break;
        case 'semi-monthly':
          $basic_salary = ($daily_rate * $present_days); 
        break;
        default:
        case 'monthly':
          $basic_salary = ($daily_rate * $present_days); 
        break;
    }
  } else {
    switch( $salary->manner ) {
        case 'hourly':
          $basic_salary = ($hourly_rate * $inclusive_dates->working_days * $salary->hours); 
        break;
        case 'daily':
          $basic_salary = ($daily_rate * $inclusive_dates->working_days); 
        break;
        case 'semi-monthly':
          $basic_salary = ($daily_rate * $salary->days) / 2; 
        break;
        default:
        case 'monthly':
          $basic_salary = ($daily_rate * $salary->days); 
        break;
    }
 }
 
}

$cola = ($cola_rate * $present_days);
$net_salary = ($daily_rate * $present_days);
$gross_pay = ($basic_salary + $cola); 
$net_basic_pay = ($gross_pay - $absences); 
$gross_basic_pay = ($net_basic_pay + $addon_benefits); 
$net_pay = $gross_basic_pay;

$payslip_gross_pay = $net_basic_pay;
?>
          <td class="bold allcaps" width="40%">Basic Pay</td>
          <td class="text-right"><?php  echo ($net_basic_pay > 0) ? number_format($net_basic_pay,2) : ""; ?></td>
        </tr>
<?php foreach( $all_earnings as $column ) { 
$var = 'earnings_' . $column->id;
if( (isset($employee->$var)) ) {
  $payslip_gross_pay += $employee->$var;
}
  ?>
        <tr>
          <td class="bold allcaps"><?php echo $column->name; ?></td>
          <td class="text-right"><?php  echo (isset($employee->$var)) ? number_format($employee->$var,2) : ""; ?></td>
        </tr>
<?php } ?>
        <tr>
          <td class="bold allcaps">Total</td>
          <td class="text-right"><?php echo number_format($payslip_gross_pay,2); ?></td>
        </tr>
    </table>
  </td>
  <td width="4%"></td>
  <td width="43%" style="vertical-align: top;">
        <table width="100%" cellpadding="0" cellspacing="0" class="bordered-all">
          <tr>
          <td colspan="2" class="text-center bold title">DEDUCTIONS</td>
        </tr>
<?php 
$payslip_total_deductions = 0;
foreach( $all_benefits as $column ) { 
$ee = 'ee_share_' . $column->id;
if( (isset($employee->$ee)) ) {
  $payslip_total_deductions += $employee->$ee;
}
  ?>
        <tr>
          <td width="40%" class="bold allcaps"><?php echo $column->name; ?></td>
          <td class="text-right"><?php  echo (isset($employee->$var)) ? number_format($employee->$var,2) : ""; ?></td>
        </tr>
<?php } ?>
<?php foreach( $all_deductions as $column ) { 
$var = 'deductions_' . $column->id;
if( (isset($employee->$var)) ) {
  $payslip_total_deductions += $employee->$var;
}
?>
        <tr>
          <td class="bold allcaps"><?php echo $column->name; ?></td>
          <td class="text-right"><?php  echo (isset($employee->$var)) ? number_format($employee->$var,2) : ""; ?></td>
        </tr>
<?php } ?>
          <tr>
            <td class="bold allcaps">Total</td>
            <td class="text-right"><?php echo number_format($payslip_total_deductions,2); ?></td>
          </tr>
        </table>
  </td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" class="hidden-columns" style="margin-bottom: 10px;">
<tr>
  <td width="43%" style="vertical-align: top;">
    <table width="100%" cellpadding="0" cellspacing="0" class="bordered-all">
        <tr>
          <td class="text-left bold" width="40%">GROSS PAY</td>
          <td class="text-right bold"><?php echo number_format($payslip_gross_pay,2); ?></td>
        </tr>
    </table>
    <br>
    <br>
    Certified correct by:<br><br>
    <span class="bold allcaps">Elena P. Migalbin</span>
  </td>
  <td width="4%"></td>
  <td width="43%" class="text-right" style="vertical-align: top;">
    <table width="100%" cellpadding="0" cellspacing="0" class="bordered-all">
          <tr>
          <td class="text-left bold" width="40%">NET PAY</td>
          <td class="text-right bold"><?php echo number_format(($payslip_gross_pay-$payslip_total_deductions),2); ?></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    Payslip #:<?php echo $payroll->id; ?>-<?php echo ($employee->employee_id) ? $employee->employee_id : 0; ?>
  </td>
</tr>
</table>

</div>
</div>