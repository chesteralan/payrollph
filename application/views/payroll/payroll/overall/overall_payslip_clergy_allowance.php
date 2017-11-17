<div class="page">

<div class="payslip_box payslip2 odd">

<table width="100%" cellpadding="0" cellspacing="0" class="bordered">
  <tr>
    <td valign="top" width="65%">
  <div class="header-title">
    <h2 class="text-left allcaps">Archdiocese of Davao<?php //echo ($company->name) ? $company->name : ''; ?></h2>
    <h3 class="text-left not-bold smaller"><?php echo ($company->address) ? $company->address : ''; ?></h3>
    <h3 class="text-left not-bold smaller"><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
  </div>
    </td>
    <td valign="top" align="right" width="35%">
<h2 class="">CLERGY ALLOWANCE</h2>
<span><?php echo $payroll->name; ?><br>Allowance # <?php echo $payroll->id; ?></span>
<?php /*
<span><?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?><br>Payroll # <?php echo $payroll->id; ?>
</span>
*/ ?>
    </td>
  </tr>
</table>
<?php 
      $end_date = new DateTime($inclusive_dates->end_date);
      $hired = new DateTime($employee->hired);
      $hired_diff = $hired->diff($end_date);

      $birth_date = new DateTime($employee->birthday);
      $birth_date_diff = $birth_date->diff($end_date);
?>
<table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
  <tr>
    <td valign="top" width="50%">
Name: <strong class="allcaps employee-name underlined bold"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></strong><br>
Birthday: <strong class="allcaps employee-name underlined bold"><?php echo date('F d, Y', strtotime($employee->birthday)); ?> (<?php echo $birth_date_diff->y; ?> years old)</strong><br>
    </td>
    <td valign="top" align="right" width="50%">
<?php if( $employee->employee_id ) { ?>
Clergy ID #: <strong class="allcaps employee-name underlined bold"><?php echo $employee->employee_id; ?></strong><br>
<?php } ?>
Ordination: <strong class="allcaps employee-name underlined bold"><?php echo date('F d, Y', strtotime($employee->hired)); ?> (<?php echo $hired_diff->y; ?> years)</strong><br>
    </td>
  </tr>
</table>


<div class="inner_body">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" width="50%" class="vertical-top padding10">

<?php 
$total_earnings = 0;
if( $earnings_columns ) { ?>
 <table width="100%" class="table table-details bordered" cellpadding="0" cellspacing="0">
 <tr>
   <td colspan="2" class="allcaps bold">Earnings</td>
 </tr>
<?php 
foreach( $earnings_columns as $column ) {
  $var = 'earnings_' . $column->id;
  $total_earnings += $employee->$var;
  if( $employee->$var > 0 ) {
?>
<tr>
<td class="text-left tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $column->notes; ?></td>
                    <td class="text-right"><?php echo number_format($employee->$var,2); ?></td>
</tr>
<?php } } ?>
<tr>
</table>
 <table width="100%" class="table table-details bordered" cellpadding="0" cellspacing="0">
 <tr class="">
<td class="text-left bold allcaps">Total Earnings</td>
      <td class="text-right bold">&#8369; <?php echo number_format($total_earnings,2); ?></td>
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
<?php foreach( $benefits_columns as $column ) { 
    $ee = 'ee_share_' . $column->id;
    $total_deductions += $employee->$ee;
if( $employee->$ee > 0) {
  ?>
<tr>
<td class="text-left tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $column->notes; ?></td>
                <td class="text-right"><?php echo number_format($employee->$ee,2); ?></td>
</tr>
<?php } } ?>
<?php } ?>
<?php if( $deductions_columns ) { ?>
<?php 
   foreach( $deductions_columns as $column ) { 
$var = 'deductions_' . $column->id;
$total_deductions += $employee->$var;
if( $employee->$var ) {
?>
<tr>
<td class="text-left tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $column->notes; ?></td>
                    <td class="text-right"><?php echo number_format($employee->$var,2); ?></td>
</tr>
<?php } } ?>
<?php } ?>
<tr>
<td class="text-left allcaps bold">Total Deductions</td>
                <td class="text-right bold"><?php echo number_format($total_deductions,2); ?></td>
</tr>
</table>
 <?php } ?>



 </td>
  </tr>
</table>

<table width="100%" class="table table-details full-border" cellpadding="0" cellspacing="0">
<tr class="highlight">
<td class="text-left allcaps bold bigger">Net Pay</td>
                <td class="text-right bold bigger">&#8369; <?php 
                $net_pay = ($total_earnings - $total_deductions); 
                echo number_format($net_pay,2); 
                 ?></td>
              </tr>
          </table>

</div>



</div>


</div>