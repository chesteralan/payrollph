
<div class="page">
<div class="payslip_box full-border odd <?php echo (($box_count % 2) == 0) ? 'second-half' : 'first-half'; ?>">
  <div class="header-title">
<h2 class="text-center allcaps"><?php echo ($company->name) ? $company->name : ''; ?></h2>
<h3 class="text-center not-bold"><?php echo ($company->address) ? $company->address : ''; ?></h3>
<h3 class="text-center not-bold"><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
</div>

<div class="full-border padding3">
<h3 class="pull-right">ID # <?php echo $payroll->id; ?></h3>
<h2 class="">PAYSLIP</h2>
<span><?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?></span>

</div>

<h2 class="text-center allcaps employee-name underlined"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></h2>

<div class="inner_body">
<?php 

$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola = 0;
$present_days = $inclusive_dates->working_days - $days_absent;

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
  $cola = ($salary->cola * $present_days);
}

$absences = ($daily_rate * $days_absent);
$basic_salary = ($daily_rate * $inclusive_dates->working_days);
$net_salary = ($daily_rate * $present_days);
$gross_pay = ($basic_salary + $cola);
$net_pay = ($net_salary + $cola);

if( floatval( $gross_pay ) ) {
?>
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0" style="margin-top:10px">
 <tr>
  <td class="text-left">Working Days: <strong><?php  echo $inclusive_dates->working_days; ?></strong></td>

  <td class="text-left">Days Absent:  <strong><?php  echo $days_absent; ?> </strong></td>

  <td class="text-left">Days Present:  <strong><?php  echo $present_days; ?> </strong></td>
</tr>
</table>
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
 <tr>
  <td class="text-left">Rate per day</td>
  <td class="text-right"><?php  echo number_format($daily_rate,2); ?></td>
</tr>
 <tr>
  <td class="text-left">COLA</td>
  <td class="text-right"><?php  echo number_format($cola,2); ?></td>
</tr>
<tr>
  <td class="text-left  bold allcaps">Basic Salary</td>
  <td class="text-right bold"><?php  echo number_format($gross_pay,2); ?></td>
</tr>
 <tr>
 <td class="text-left tab1"><strong>Less:</strong> Absences</td>
                <td class="text-right">(<?php echo number_format($absences,2); ?>)</td>
                </tr>
<tr>
  <td class="text-left  bold allcaps">Net Basic Salary</td>
  <td class="text-right bold"><?php  echo number_format($net_pay,2); ?></td>
</tr>
</table>
<?php } ?>
<?php 
$total_earnings = 0;
if( $earnings_columns ) { ?>
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
 <tr>
   <td colspan="2" class="allcaps bold">Other Earnings</td>
 </tr>
<?php 
foreach( $earnings_columns as $column ) {
?>
<tr>
<td class="text-left tab1"><?php echo $column->notes; ?></td>
                    <td class="text-right"><?php 
                    $var = 'earnings_' . $column->id;
                    $total_earnings += $employee->$var;
                    echo number_format($employee->$var,2); ?></td>
</tr>
<?php } ?>
<tr>
</table>
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
 <tr class="">
<td class="text-left bold allcaps">Gross Pay</td>
      <td class="text-right bold"><?php echo number_format(($total_earnings + $net_pay),2); ?></td>
</tr>
</table>
<?php } ?>
<?php 
 $total_deductions = 0;
if( $benefits_columns || $deductions_columns ) { 
  ?>
<table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
   <tr>
   <td colspan="2" class="allcaps bold">Deductions</td>
 </tr>
<?php if( $benefits_columns ) { ?>
<?php foreach( $benefits_columns as $column ) { ?>
<tr>
<td class="text-left tab1"><?php echo $column->notes; ?></td>
                <td class="text-right"><?php 
                    $ee = 'ee_share_' . $column->id;
                    $total_deductions += $employee->$ee;
                    echo number_format($employee->$ee,2); ?></td>
</tr>
<?php } ?>
<?php } ?>
<?php if( $deductions_columns ) { ?>
<?php 
   foreach( $deductions_columns as $column ) { ?>
<tr>
<td class="text-left tab1"><?php echo $column->notes; ?></td>
                    <td class="text-right"><?php 
                    $var = 'deductions_' . $column->id;
                    $total_deductions += $employee->$var;
                    echo number_format($employee->$var,2); ?></td>
</tr>
<?php } ?>
<?php } ?>
<tr>
<td class="text-left allcaps bold">Total Deductions</td>
                <td class="text-right bold"><?php echo number_format($total_deductions,2); ?></td>
</tr>
</table>
 <?php } ?>

<table width="100%" class="table table-details full-border" cellpadding="0" cellspacing="0">
<tr class="highlight">
<td class="text-left allcaps bold bigger">Net Pay</td>
                <td class="text-right bold bigger"><?php 
                $net_pay = (($total_earnings + $net_pay) - $total_deductions); 
                echo number_format($net_pay,2); 
                 ?></td>
              </tr>
          </table>
</div>
<div class="signatories">
  <table width="100%">
    <tr>
      <td width="50%">Prepared By:
       <br><br><br>
<span class="allcaps bold"><?php echo $this->session->name; ?></span>
      </td>
      <td width="50%" class="text-right">Received By:
      <br><br><br>
<span class="allcaps bold text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></span>
      </td>
    </tr>
  </table>
</div>

</div>

<div class="payslip_box full-border even <?php echo (($box_count % 2) == 0) ? 'second-half' : 'first-half'; ?>">
  <div class="header-title">
<h2 class="text-center allcaps"><?php echo ($company->name) ? $company->name : ''; ?></h2>
<h3 class="text-center not-bold"><?php echo ($company->address) ? $company->address : ''; ?></h3>
<h3 class="text-center not-bold"><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
</div>

<div class="full-border padding3">
<h3 class="pull-right">ID # <?php echo $payroll->id; ?></h3>
<h2 class="">PAYSLIP</h2>
<span><?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?></span>

</div>

<h2 class="text-center allcaps employee-name underlined"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></h2>

<div class="inner_body">
<?php 
$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola = 0;
$present_days = $inclusive_dates->working_days - $days_absent;

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
  $cola = ($salary->cola * $present_days);
}
$absences = ($daily_rate * $days_absent);
$basic_salary = ($daily_rate * $inclusive_dates->working_days);
$net_salary = ($daily_rate * $present_days);
$gross_pay = ($basic_salary + $cola);
$net_pay = ($net_salary + $cola);

if( floatval( $gross_pay ) ) {
?>
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0" style="margin-top:10px">
 <tr>
  <td class="text-left">Working Days: <strong><?php  echo $inclusive_dates->working_days; ?></strong></td>

  <td class="text-left">Days Absent:  <strong><?php  echo $days_absent; ?> </strong></td>

  <td class="text-left">Days Present:  <strong><?php  echo $present_days; ?> </strong></td>
</tr>
</table>
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
 <tr>
  <td class="text-left">Rate per day</td>
  <td class="text-right"><?php  echo number_format($daily_rate,2); ?></td>
</tr>
 <tr>
  <td class="text-left">COLA</td>
  <td class="text-right"><?php  echo number_format($cola,2); ?></td>
</tr>
<tr>
  <td class="text-left  bold allcaps">Basic Salary</td>
  <td class="text-right bold"><?php  echo number_format($gross_pay,2); ?></td>
</tr>
 <tr>
 <td class="text-left tab1"><strong>Less:</strong> Absences</td>
                <td class="text-right">(<?php echo number_format($absences,2); ?>)</td>
                </tr>
<tr>
  <td class="text-left  bold allcaps">Net Basic Salary</td>
  <td class="text-right bold"><?php  echo number_format($net_pay,2); ?></td>
</tr>
</table>
<?php } ?>
<?php 
$total_earnings = 0;
if( $earnings_columns ) { ?>
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
 <tr>
   <td colspan="2" class="allcaps bold">Other Earnings</td>
 </tr>
<?php 
foreach( $earnings_columns as $column ) {
?>
<tr>
<td class="text-left tab1"><?php echo $column->notes; ?></td>
                    <td class="text-right"><?php 
                    $var = 'earnings_' . $column->id;
                    $total_earnings += $employee->$var;
                    echo number_format($employee->$var,2); ?></td>
</tr>
<?php } ?>
<tr>
</table>
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
 <tr class="">
<td class="text-left bold allcaps">Gross Pay</td>
      <td class="text-right bold"><?php echo number_format(($total_earnings + $net_pay),2); ?></td>
</tr>
</table>
<?php } ?>
<?php 
 $total_deductions = 0;
if( $benefits_columns || $deductions_columns ) { 
  ?>
<table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
   <tr>
   <td colspan="2" class="allcaps bold">Deductions</td>
 </tr>

<?php if( $benefits_columns ) { ?>
<?php foreach( $benefits_columns as $column ) { ?>
<tr>
<td class="text-left tab1"><?php echo $column->notes; ?></td>
                <td class="text-right"><?php 
                    $ee = 'ee_share_' . $column->id;
                    $total_deductions += $employee->$ee;
                    echo number_format($employee->$ee,2); ?></td>
</tr>
<?php } ?>
<?php } ?>
<?php if( $deductions_columns ) { ?>
<?php 
   foreach( $deductions_columns as $column ) { ?>
<tr>
<td class="text-left tab1"><?php echo $column->notes; ?></td>
                    <td class="text-right"><?php 
                    $var = 'deductions_' . $column->id;
                    $total_deductions += $employee->$var;
                    echo number_format($employee->$var,2); ?></td>
</tr>
<?php } ?>
<?php } ?>
<tr>
<td class="text-left allcaps bold">Total Deductions</td>
                <td class="text-right bold"><?php echo number_format($total_deductions,2); ?></td>
</tr>
</table>
 <?php } ?>

<table width="100%" class="table table-details full-border" cellpadding="0" cellspacing="0">
<tr class="highlight">
<td class="text-left allcaps bold bigger">Net Pay</td>
                <td class="text-right bold bigger"><?php 
                $net_pay = (($total_earnings + $net_pay) - $total_deductions); 
                echo number_format($net_pay,2); 
                 ?></td>
              </tr>
          </table>
</div>
<div class="signatories">
  <table width="100%">
    <tr>
      <td width="50%">Prepared By:
       <br><br><br>
<span class="allcaps bold"><?php echo $this->session->name; ?></span>
      </td>
      <td width="50%" class="text-right">Received By:
      <br><br><br>
<span class="allcaps bold text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></span>
      </td>
    </tr>
  </table>
</div>

</div>
</div>