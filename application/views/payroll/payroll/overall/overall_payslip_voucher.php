<?php 

$days_absent = $employee->absences;
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

$basic_salary = ($daily_rate * $present_days);
$gross_pay = ($basic_salary + $cola);

?>
<div class="page">
<div class="payslip_box cash_voucher full-border odd <?php echo (($box_count % 2) == 0) ? 'second-half' : 'first-half'; ?>">
  <div class="header-title">

<h2 class="text-center allcaps"><?php echo ($template->company_name) ? $template->company_name : ''; ?></h2>
<h3 class="text-center not-bold"><?php echo ($template->company_name) ? $template->company_address : ''; ?></h3>
<h3 class="text-center not-bold"><?php echo ($template->company_name) ? $template->company_contacts : ''; ?></h3>

</div>

<div class="full-border padding3">
<h3 class="pull-right">ID # <?php echo $payroll->id; ?></h3>
<h2 class="">CASH VOUCHER</h2>
<span><?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?></span>

</div>

<h2 class="text-center allcaps employee-name underlined" style="margin-bottom: 20px;"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></h2>

<div class="inner_body">
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
      <tr class="highlight">
        <td class="text-center allcaps bold">Particulars</td>
        <td class="text-center allcaps bold border-left">Amount</td>
      </tr>
      <tr>
        <td class="padding5">
<?php 
$total_earnings = 0;
if( $earnings_columns ) { ?>
<table width="100%">
<?php 
foreach( $earnings_columns as $column ) {
  $var = 'earnings_' . $column->id;
  $total_earnings += $employee->$var;
  if( floatval($employee->$var) > 0 ) {
?>
<tr>
<td class="text-left"><?php echo $column->notes; ?></td>
                    <td class="text-right"><?php 
                    echo number_format($employee->$var,2); ?></td>
</tr>
<?php } ?>
<?php } ?>
<tr class="highlight">
<td class="text-left allcaps bold">Total Earnings</td>
<td class="text-right bold"><?php echo number_format($total_earnings,2); ?></td>
</tr>
</table>
<?php } ?>
<?php 
$total_deductions = 0;
if( $deductions_columns ) { ?>
<table width="100%">
<?php 
foreach( $deductions_columns as $column ) {
  $var = 'deductions_' . $column->id;
  $total_deductions += $employee->$var;
  if( floatval($employee->$var) > 0 ) {
?>
<tr>
<td class="text-left"><?php echo $column->notes; ?></td>
                    <td class="text-right"><?php 
                    echo number_format($employee->$var,2); ?></td>
</tr>
<?php } ?>
<?php } ?>
<tr class="highlight">
<td class="text-left allcaps bold">Total Deductions</td>
<td class="text-right bold"><?php echo number_format($total_deductions,2); ?></td>
</tr>
</table>
<?php } ?>
          
     
        </td>
        <td class="padding5 border-left text-center bold bigger"><?php echo number_format(($total_earnings-$total_deductions),2); ?></td>
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
</div>


