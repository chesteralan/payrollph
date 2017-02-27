<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
function isColumn($column_id,$print_columns) {
    if( $print_columns ) foreach($print_columns as $col) {
        if( ($col->column_id==$column_id) ) {
            return true;
        }
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME; ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
    
  </head>
  <body id="payroll_print">

<h2 class="pull-right">PAYROLL ID: <?php echo $payroll->id; ?></h2>
<div class="header-title">
<h2 class="allcaps"><?php echo ($template->company_name) ? $template->company_name : ''; ?></h2>
<h3><?php echo ($template->company_name) ? $template->company_address : ''; ?></h3>
<h3><?php echo ($template->company_name) ? $template->company_contacts : ''; ?></h3>
</div>

<div class="full-border padding3">
  <h3>PAYROLL SHEET</h3>
  For the period covered <?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?>
</div>


<?php if( $payroll_groups ) {  

$total_net_pay = 0;

  ?>
  <div class="payroll">
  <?php foreach($payroll_groups as $payroll_group) { ?>
 
 <?php if($payroll_group->employees) { ?>
          <table cellspacing="0" cellpadding="0" class="table" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning highlight allcaps">
                <th class="text-left allcaps" width="15%"><?php echo $payroll_group->name; ?></th>
<?php if( isColumn('working_days', $print_columns) ) { ?>
                <th width="5%" class="text-right">Working Days</th>
<?php } ?>
<?php if( isColumn('absences', $print_columns) ) { ?>
                <th width="5%" class="text-right">Absences</th>
<?php } ?>
<?php if( isColumn('days_present', $print_columns) ) { ?>
                <th width="5%" class="text-right">Days Present</th>
<?php } ?>
<?php if( isColumn('rate_per_day', $print_columns) ) { ?>
                <th width="5%" class="text-right">Rate per day</th>
<?php } ?>
<?php if( isColumn('basic_salary', $print_columns) ) { ?>
                <th width="5%" class="text-right">Basic Salary</th>
<?php } ?>
<?php if( isColumn('cola', $print_columns) ) { ?>
                <th width="5%" class="text-right">COLA</th>
<?php } ?>
<?php if( isColumn('gross_pay', $print_columns) ) { ?>
                <th width="5%" class="text-right">Gross Pay</th>
<?php } ?>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
<?php if( isColumn('earning_'.$column->id, $print_columns) ) { ?>
                <th width="5%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
<?php } ?>
                <th width="7%" class="text-right allcaps">Total Earnings</th>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
<?php if( isColumn('benefit_'.$column->id, $print_columns) ) { ?>
                <th width="5%" class="text-right"><?php echo $column->name; ?>-EE</th>
                <th width="5%" class="text-right"><?php echo $column->name; ?>-ER</th>
<?php } ?>
<?php } ?>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
<?php if( isColumn('deduction_'.$column->id, $print_columns) ) { ?>
                <th width="5%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
<?php } ?>
                <th width="7%" class="text-right allcaps">Total Deductions</th>
                <th width="5%" class="text-right allcaps">Net Pay</th>
              </tr>
            </thead>
            <tbody>
            
<?php 
foreach($payroll_group->employees as $employee) {

$total_deductions = 0;
$total_earnings = 0;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours /$employee->working_hours) : 0;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola = 0;
$gross_pay = 0;
if( $employee->salary ) {
  $salary = $employee->salary;
  $cola = $salary->cola;
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


              ?>
              <tr>
                <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> <!--(<?php echo $employee->position; ?>)-->
                </td>
<?php if( isColumn('working_days', $print_columns) ) { ?>
                <td class="text-right"><?php echo $inclusive_dates->working_days; ?></td>
<?php } ?>
<?php if( isColumn('absences', $print_columns) ) { ?>
                <td class="text-right"><?php echo $days_absent; ?></td>
<?php } ?>
<?php 
$present_days = $inclusive_dates->working_days - $days_absent;
if( isColumn('days_present', $print_columns) ) { ?>
                <td class="text-right"><?php echo $present_days; ?></td>
<?php } ?>
<?php if( isColumn('rate_per_day', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($daily_rate,2); ?></td>
<?php } ?>
<?php 
$basic_salary = ($daily_rate * $present_days);
if( isColumn('basic_salary', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($basic_salary,2); ?></td>
<?php } ?>
<?php 
$cola = ($cola * $present_days);
if( isColumn('cola', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($cola,2); ?></td>
<?php } ?>
<?php 
$gross_pay = ($basic_salary + $cola); 
if( isColumn('gross_pay', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($gross_pay,2); ?></td>
<?php } ?>

<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
      <?php 
      $var = 'earnings_' . $column->id;
      $total_earnings += $employee->$var;
      if( isColumn('earning_' . $column->id, $print_columns) ) { ?>
                    <td class="text-right"><?php echo number_format($employee->$var,2); ?></td>
                <?php } ?>
    <?php } ?>
      <td class="text-right bold"><?php echo number_format(($total_earnings + $gross_pay),2); ?></td>

<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { 
  $ee = 'ee_share_' . $column->id;
  $er = 'er_share_' . $column->id;
  $total_deductions += $employee->$ee;
  if( isColumn('benefit_' . $column->id, $print_columns) ) {
?>
                <td class="text-right"><?php echo number_format($employee->$ee,2); ?></td>
                <td class="text-right"><?php echo number_format($employee->$er,2); ?></td>
<?php } ?>
<?php } ?>

<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  $var = 'deductions_' . $column->id;
  $total_deductions += $employee->$var;
  $net_pay = (($total_earnings + $gross_pay) - $total_deductions); 
  $total_net_pay += $net_pay;
  if( isColumn('deduction_' . $column->id, $print_columns) ) {
  ?>
                    <td class="text-right"><?php echo number_format($employee->$var,2); ?></td>
                <?php } ?>
 <?php } ?>
                <td class="text-right bold"><?php echo number_format($total_deductions,2); ?></td>
                <td class="text-right bold bigger"><?php echo number_format($net_pay,2); 
                 ?></td>

              </tr>
<?php } ?>

            </tbody>
          </table>
<?php } ?>
    <?php } ?>

<table width="100%" class="total_net_pay full-border" cellspacing="0" cellpadding="0">
  <tr>
    <td class="bold allcaps">Total Net Pay</td>
    <td class="bold  allcaps text-right"><?php echo number_format($total_net_pay,2); ?></td>
  </tr>
</table>
</div>

<div class="signatories">
  <table width="100%"  cellspacing="0" cellpadding="0">
    <tr>
      <td width="33.33%"><p>Prepared By:</p>
       <br>
<span class="allcaps bold"><?php echo $this->session->name; ?></span>
      </td>
      <td width="33.33%" class="text-center"><p>Checked By:</p>
       <br>
<span class="allcaps bold"><?php echo $template->checked_by_name; ?></span>
      </td>
      <td width="33.33%" class="text-right"><p>Approved By:</p>
      <br>
<span class="allcaps bold"><?php echo $template->approved_by_name; ?></span>
      </td>
    </tr>
  </table>
</div>
<?php } ?>



  </body>
</html>
