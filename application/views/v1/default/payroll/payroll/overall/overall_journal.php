<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
function isColumn($ths, $column_id,$print_columns) {
    if( $ths->input->get('columns') ) {
        if( in_array($column_id, $ths->input->get('columns')) ) {
            return true;
        }
    } else {
      if( $print_columns ) foreach($print_columns as $col) {
          if( ($col->column_id==$column_id) ) {
              return true;
          }
      }
    }
    return false;
}  

function denomination($amount, $d, $less=0) {
    $amount = $amount - $less;
    $amount_arr = explode(".", number_format($amount,2, ".", ""));
    $pennies = (100 * $amount_arr[0]) + $amount_arr[1];
    return floor($pennies / ($d * 100));
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME; ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
    
  </head>
  <body id="payroll_print">

<div class="print-topnav hide-print text-center allcaps">
  <a href="<?php echo site_url("payroll/select_payroll/{$payroll->id}"); ?>">Back</a>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/print"); ?>">Print</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/payslip"); ?>">Payslip</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/{$output}/{$current_page}"); ?>">All</a>
  <?php if(isset($print_groups)) foreach($print_groups as $pg) { ?>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$pg->id}/{$output}/{$current_page}"); ?>"><?php echo $pg->name; ?></a>
  <?php } ?>
  &middot; <a href="<?php echo site_url("payroll_overall/config/{$payroll->id}") . "?next=" . uri_string(); ?>">Config</a>
</div>

<?php if( ($template) && ($template->pages > 1)) { ?>
<div class="print-topnav topnav2 hide-print text-center allcaps">
    <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/1"); ?>">Page 1</a>
<?php for($i=2;$i <= $template->pages; $i++) { ?>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/{$i}"); ?>">Page <?php echo $i; ?></a>
<?php } ?>
</div>
<?php } ?>

<h2 class="pull-right">PAYROLL #: <?php echo $payroll->id; ?></h2>
<div class="header-title">
<h2 class="allcaps"><?php echo ($company->name) ? $company->name : ''; ?></h2>
<h3><?php echo ($company->address) ? $company->address : ''; ?></h3>
<h3><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
</div>

<div class="full-border padding3">
  <h3>JOURNAL VOUCHER</h3>
  For the period covered <?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?>
</div>


<?php if( $payroll_groups ) {  

$total_net_pay = 0;
$pc_count = (count($print_columns)) ? count($print_columns) : 1;
$column_width = ceil(71 / $pc_count);
  ?>
  <div class="payroll">
<table width="100%" cellspacing="0" cellpadding="0" class="table">
  <thead>
    <tr>
      <th class="text-left" width="50%">Account Title</th>
      <th class="text-right" width="15%">Debit</th>
      <th class="text-right" width="15%">Credit</th>
      <th class="text-right" width="20%">Name</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($payroll_groups as $payroll_group) { 
if( $payroll_group->page != $current_page ) {
  //continue;
}
?>

<?php if($payroll_group->employees) { ?>
<?php 

$group_basic_salary = 0;
$group_absences = 0;
$group_net_salary = 0;
$group_leave_benefits = 0;
$group_gross_pay = 0;
$group_total_earnings = 0;
$group_total_deductions = 0;
$group_net_pay = 0;
$group_earnings = array();
$group_benefits = array();
$group_deductions = array();

foreach($payroll_group->employees as $employee) {

$total_deductions = 0;
$total_earnings = 0;
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
$net_salary = 0;
$addon_benefits = 0;

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
$net_pay = (($basic_salary + $cola) - $absences); 
$gross_pay = $net_pay + $addon_benefits;
$group_basic_salary += $basic_salary;
$group_net_salary += $net_pay;
$group_leave_benefits += $addon_benefits;
$group_absences += $absences;
$group_gross_pay += $gross_pay;

if($net_pay) {
?>
<tr>
                <td>Salaries and Wages - Expense - <?php echo $payroll_group->name; ?></td>
                <td class="text-right"><?php echo number_format($net_pay,2); ?></td>
                <td class="text-right"></td>
                <td class="text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? substr($employee->middlename,0,1)."." : ""; ?></td>
</tr>
<?php } ?>



<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
      <?php 
      $var = 'earnings_' . $column->id; 
if($employee->$var) {
 ?>
 <tr>
                 <td><?php echo ($column->account_title) ? $column->account_title : $column->name; ?></td>
                    <td class="text-right"><?php echo number_format($employee->$var,2); ?></td>
                <td class="text-right"></td>
              <td class="text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? substr($employee->middlename,0,1)."." : ""; ?></td>
</tr>
    <?php } ?>
    <?php } ?>


<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { 
  $ee = 'ee_share_' . $column->id;
  $er = 'er_share_' . $column->id; 
 if($employee->$ee) {
?>
 <tr>
                 <td><?php echo ($column->ee_account_title) ? $column->ee_account_title : $column->name; ?></td>
                <td class="text-right"></td>
                    <td class="text-right"><?php echo number_format($employee->$ee,2); ?></td>
              <td class="text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? substr($employee->middlename,0,1)."." : ""; ?></td>
</tr>
<?php } ?>
<?php if($employee->$er) { ?>
 <tr>
                 <td><?php echo ($column->ee_account_title) ? $column->ee_account_title : $column->name; ?></td>
                <td class="text-right"></td>
                    <td class="text-right"><?php echo number_format($employee->$er,2); ?></td>
              <td class="text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? substr($employee->middlename,0,1)."." : ""; ?></td>
</tr>
 <tr>
                 <td><?php echo ($column->er_account_title) ? $column->er_account_title : $column->name; ?></td>
                    <td class="text-right"><?php echo number_format($employee->$er,2); ?></td>
                <td class="text-right"></td>
              <td class="text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? substr($employee->middlename,0,1)."." : ""; ?></td>
</tr>
<?php } ?>
<?php } ?>


<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  $var = 'deductions_' . $column->id; 
  ?>
  <?php if($employee->$var) { ?>
 <tr>
                 <td><?php echo ($column->account_title) ? $column->account_title : $column->name; ?></td>
                <td class="text-right"></td>
                    <td class="text-right"><?php echo number_format($employee->$var,2); ?></td>
              <td class="text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? substr($employee->middlename,0,1)."." : ""; ?></td>
</tr>
 <?php } ?>
 <?php } ?>

<?php } ?>
<?php } ?>
<?php } ?>
</tbody>
</table>
<?php } ?>

</div>

  </body>
</html>