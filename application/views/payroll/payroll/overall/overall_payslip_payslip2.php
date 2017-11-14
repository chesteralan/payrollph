<div class="page">

<?php for($i=0; $i<2; $i++) { ?>

<div class="payslip_box payslip2 odd <?php echo ($i == 1) ? 'second-half' : 'first-half'; ?>">

<table width="100%" cellpadding="0" cellspacing="0" class="bordered">
  <tr>
    <td valign="top" width="65%">
  <div class="header-title">
    <h2 class="text-left allcaps"><?php echo ($company->name) ? $company->name : ''; ?></h2>
    <h3 class="text-left not-bold smaller"><?php echo ($company->address) ? $company->address : ''; ?></h3>
    <h3 class="text-left not-bold smaller"><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
  </div>
    </td>
    <td valign="top" align="right" width="35%">
<h2 class="">PAYSLIP</h2>
<span><?php echo $payroll->name; ?><br>Payroll # <?php echo $payroll->id; ?></span>
<?php /*
<span><?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?><br>Payroll # <?php echo $payroll->id; ?>
</span>
*/ ?>
    </td>
  </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
  <tr>
    <td valign="top" width="50%">
Employee Name: <strong class="allcaps employee-name underlined bold"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></strong>
    </td>
    <td valign="top" align="right" width="50%">
Employee No:
    </td>
  </tr>
</table>


<div class="inner_body">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" width="50%" class="vertical-top padding10">


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
  $cola = ($salary->cola * $present_days);
}

$absences = ($daily_rate * $days_absent);
//$basic_salary = ($daily_rate * $inclusive_dates->working_days);
$basic_salary = ($monthly_rate / 2);
$net_salary = ($daily_rate * $present_days);
$gross_pay = ($basic_salary + $cola);
$net_pay = ( ($gross_pay + $cola) - ($daily_rate * $days_absent) );

// if( floatval( $gross_pay ) ) {
?>

 <table width="100%" class="table table-details bordered" cellpadding="0" cellspacing="0">
<tr>
  <td colspan="2" class="allcaps bold">Earnings</td>
</tr>
 <tr>
  <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rate per day</td>
  <td class="text-right"><?php  echo number_format($daily_rate,2); ?></td>
</tr>
 <tr>
  <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COLA</td>
  <td class="text-right"><?php  echo number_format($cola,2); ?></td>
</tr>
 <tr>
  <td class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Working days</td>
  <td class="text-right"><?php  echo number_format($inclusive_dates->working_days,0); ?></td>
</tr>
<tr>
  <td class="text-left  bold allcaps">Basic Salary</td>
  <td class="text-right bold"><?php  echo number_format($gross_pay,2); ?></td>
</tr>
 <tr>
 <td class="text-left tab1"><strong>Less:</strong> Absences (<?php  echo $days_absent; ?>)</td>
                <td class="text-right">(<?php echo number_format($absences,2); ?>)</td>
                </tr>
<tr>
  <td class="text-left  bold allcaps">Net Basic Salary</td>
  <td class="text-right bold"><?php  echo number_format($net_pay,2); ?></td>
</tr>
</table>
<?php //} ?>
<?php 
$total_earnings = 0;
if( $earnings_columns ) { ?>
 <table width="100%" class="table table-details bordered" cellpadding="0" cellspacing="0">
 <tr>
   <td colspan="2" class="allcaps bold">Other Earnings</td>
 </tr>
<?php 
foreach( $earnings_columns as $column ) {
?>
<tr>
<td class="text-left tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $column->notes; ?></td>
                    <td class="text-right"><?php 
                    $var = 'earnings_' . $column->id;
                    $total_earnings += $employee->$var;
                    echo number_format($employee->$var,2); ?></td>
</tr>
<?php } ?>
<tr>
</table>
 <table width="100%" class="table table-details bordered" cellpadding="0" cellspacing="0">
 <tr class="">
<td class="text-left bold allcaps">Gross Pay</td>
      <td class="text-right bold">&#8369; <?php echo number_format(($total_earnings + $net_pay),2); ?></td>
</tr>
</table>
<?php } ?>

    </td>
    <td valign="top" align="right" width="50%" class="vertical-top padding10">

   

<?php 
 $total_deductions = 0;
if( $benefits_columns || $deductions_columns ) { 
  ?>
<table width="100%" class="table table-details bordered" cellpadding="0" cellspacing="0">
   <tr>
   <td colspan="2" class="allcaps bold">Deductions</td>
 </tr>
<?php if( $benefits_columns ) { ?>
<?php foreach( $benefits_columns as $column ) { ?>
<tr>
<td class="text-left tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $column->notes; ?></td>
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
<td class="text-left tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $column->notes; ?></td>
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
                <td class="text-right bold bigger">&#8369; <?php 
                $net_pay = (($total_earnings + $net_pay) - $total_deductions); 
                echo number_format($net_pay,2); 
                 ?></td>
              </tr>
          </table>

 </td>
  </tr>
</table>

</div>


<div class="signatories">
  <table width="100%">
    <tr>
      <td width="60%" class="vertical-bottom"><p>I acknowledge that I have received the total amount of <strong class="underlined">&#8369; <?php echo number_format($net_pay,2); ?></strong> in full and have no further claims for services rendered.</p>
Date: ____________________
      </td>
      <td width="40%" class="text-left vertical-bottom"><strong>Received By:</strong>
      <br><br><br>
_____________________________________<br><center><span class="allcaps" style="font-size:10px;">signature over printed name</span></center>
      </td>
    </tr>
  </table>
</div>

</div>

<?php } ?>

</div>