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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME;  ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
<?php if( $print_css ) { ?>
<style>
<!--
<?php echo unserialize($print_css->value); ?>

-->
</style>
<?php } ?>
  </head>
  <body id="payroll_print">

<div class="print-topnav hide-print text-center allcaps">
  <a href="<?php echo site_url("payroll/select_payroll/{$payroll->id}"); ?>">Back</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/payslip"); ?>">Payslip</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/{$output}/{$current_page}"); ?>">All</a>
  <?php 
  if( ( isset($print_group_option) ) && ( $print_group_option ) )  {
  $pg_option = unserialize( $print_group_option->value );
  $pg_sort = array();
  if($pg_option) foreach($pg_option as $pgok => $pgov) {
      $pg_sort[$pgov] = $pgok;
  }

  $pgs = array();
   if($print_groups) foreach($print_groups as $pg) {
      $pgs[$pg_sort[$pg->id]] = $pg;
  }
  ksort($pgs);
  foreach($pgs as $pg) { ?>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$pg->id}/{$output}/{$current_page}"); ?>"><?php echo $pg->name; ?></a>
  <?php } ?>
  <?php } ?>
  
  <?php if( (isset($print_group_option)) && ($print_group_option) ) { ?>
   &middot; <a href="<?php echo site_url("payroll_overall/summary/{$payroll->id}"); ?>">Summary</a>
  <?php } ?>

  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/xls/{$current_page}"); ?>">Export</a>

</div>
<?php if(!$print_group) { ?>
<?php if($template->pages > 1) { ?>
<div class="print-topnav topnav2 hide-print text-center allcaps">

    <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/1"); ?>">Page 1</a>
<?php for($i=2;$i <= $template->pages; $i++) { ?>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/{$i}"); ?>">Page <?php echo $i; ?></a>
<?php } ?>

</div>
<?php } ?>
<?php } ?>

<h2 class="pull-right">PAYROLL ID: <?php echo $payroll->id; ?></h2>
<div class="header-title">
<h2 class="allcaps">Archdiocese of Davao<?php //echo ($company->name) ? $company->name : ''; ?></h2>
<h3><?php echo ($company->address) ? $company->address : ''; ?></h3>
<h3><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
</div>

<div class="full-border padding3">
  <h3>CLERGY ALLOWANCE</h3>
  <?php echo $payroll->name; ?>
  <?php //echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?><?php //echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?>
</div>


<?php if( $payroll_groups ) {  

$total_net_pay = 0;
$pc_count = (count($print_columns)) ? count($print_columns) : 1;
$column_width = ceil(71 / $pc_count);
  ?>
  <div class="payroll">
<?php foreach($payroll_groups as $payroll_group) { ?>
  <?php if($payroll_group->employees) { ?>
          <table width="100%" cellspacing="0" cellpadding="0" class="table" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning highlight allcaps">
                <th class="text-left allcaps" width="<?php echo ($pc_count==1) ? '64' : '15'; ?>%"><?php echo $payroll_group->name; ?></th>
<?php if( $column_group_salaries ) { ?>
<?php if( isColumn($this, 'working_days', $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right">Working Days</th>
<?php } ?>
<?php if( isColumn($this, 'absences', $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right">Absences</th>
<?php } ?>
<?php if( isColumn($this, 'rate_per_day', $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right">Rate per day</th>
<?php } ?>
<?php if( isColumn($this, 'basic_salary', $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right">Basic Salary</th>
<?php } ?>
<?php if( isColumn($this, 'cola', $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right">COLA</th>
<?php } ?>
<?php if( isColumn($this, 'absences_amount', $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right">Absences</th>
<?php } ?>
<?php if( isColumn($this, 'gross_pay', $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right">Gross Pay</th>
<?php } ?>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
<?php if( isColumn($this, 'earning_'.$column->id, $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_salaries || $column_group_earnings) { ?>
                <th width="<?php echo ($pc_count==1) ? '12' : '7'; ?>%" class="text-right allcaps">Total Earnings</th>
<?php } ?>
<?php if( $column_group_benefits ) { ?>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
<?php if( isColumn($this, 'benefit_'.$column->id, $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right"><?php echo $column->name; ?>-EE</th>
                <th width="<?php echo $column_width; ?>%" class="text-right"><?php echo $column->name; ?>-ER</th>
<?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
<?php if( isColumn($this, 'deduction_'.$column->id, $print_columns) ) { ?>
                <th width="<?php echo $column_width; ?>%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
<?php } ?>
<?php } ?>
 <?php if( $column_group_benefits||$column_group_deductions ) { ?>
                <th width="<?php echo ($pc_count==1) ? '12' : '7'; ?>%" class="text-right allcaps">Total Deductions</th>
<?php } ?>
                <th width="<?php echo ($pc_count==1) ? '12' : '5'; ?>%" class="text-right allcaps">Balance</th>

                <th width="<?php echo ($pc_count==1) ? '12' : '5'; ?>%" class="text-right allcaps">Payment</th>
              </tr>
            </thead>
            <tbody>
            
<?php 

$group_basic_salary = 0;
$group_absences = 0;
$group_gross_pay = 0;
$group_total_earnings = 0;
$group_total_deductions = 0;
$group_net_pay = 0;
$group_net_pay_balance = 0;
$group_earnings = array();
$group_benefits = array();
$group_deductions = array();

foreach($payroll_group->employees as $employee) {

$total_deductions = 0;
$total_earnings = 0;
$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
$present_days = $inclusive_dates->working_days - $days_absent;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola_rate = 0;
$cola = 0;
$absences = 0;

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

$total_absences += $absences;
$cola = ($cola_rate * $present_days);
$absences = ($daily_rate * $days_absent);
$gross_pay = (($basic_salary + $cola) - $absences); 
$group_basic_salary += $basic_salary;
$group_absences += $absences;
$group_gross_pay += $gross_pay;
?>
              <tr>
                <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? substr($employee->middlename,0,1)."." : ""; ?> <!--(<?php echo $employee->position; ?>)-->
                </td>
<?php if( $column_group_salaries ) { ?>
<?php if( isColumn($this, 'working_days', $print_columns) ) { ?>
                <td class="text-right"><?php echo $inclusive_dates->working_days; ?></td>
<?php } ?>
<?php if( isColumn($this, 'absences', $print_columns) ) { ?>
                <td class="text-right"><?php echo $days_absent; ?></td>
<?php } ?>
<?php if( isColumn($this, 'rate_per_day', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($daily_rate,2); ?></td>
<?php } ?>
<?php 
if( isColumn($this, 'basic_salary', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($basic_salary,2); ?></td>
<?php } ?>
<?php 
if( isColumn($this, 'cola', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($cola,2); ?></td>
<?php } ?>
<?php 
if( isColumn($this, 'absences_amount', $print_columns) ) { ?>
                <td class="text-right">(<?php echo number_format($absences,2); ?>)</td>
<?php } ?>
<?php 
if( isColumn($this, 'gross_pay', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($gross_pay,2); ?></td>
<?php } ?>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
      <?php 
      $var = 'earnings_' . $column->id;
      if( !isset($group_earnings[$var]) ) {
          $group_earnings[$var] = 0;
      }
      $group_earnings[$var] += $employee->$var;
      $total_earnings += $employee->$var;
      if( isColumn($this, 'earning_' . $column->id, $print_columns) ) { ?>
                    <td class="text-right"><?php echo number_format($employee->$var,2); ?></td>
                <?php } ?>
    <?php } ?>
<?php } ?>
<?php if( $column_group_salaries || $column_group_earnings) { ?>
      <td class="text-right bold"><?php 
$total_gross_earnings = ($total_earnings + $gross_pay);
$group_total_earnings += $total_gross_earnings;
      echo number_format($total_gross_earnings,2); ?></td>
<?php } ?>

<?php if( $column_group_benefits ) { ?>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { 
  $ee = 'ee_share_' . $column->id;
  if( !isset($group_benefits[$ee]) ) {
      		$group_benefits[$ee] = 0;
  }
  $group_benefits[$ee] += $employee->$ee;

  $er = 'er_share_' . $column->id;
  if( !isset($group_benefits[$er]) ) {
      		$group_benefits[$er] = 0;
  }

  $group_benefits[$er] += $employee->$er;
  $total_deductions += $employee->$ee;
  if( isColumn($this, 'benefit_' . $column->id, $print_columns) ) {
?>
                <td class="text-right"><?php echo number_format($employee->$ee,2); ?></td>
                <td class="text-right"><?php echo number_format($employee->$er,2); ?></td>
<?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  $var = 'deductions_' . $column->id;
  if( !isset($group_deductions[$var]) ) {
      $group_deductions[$var] = 0;
   }
   $group_deductions[$var] += $employee->$var;
  $total_deductions += $employee->$var;
  if( isColumn($this, 'deduction_' . $column->id, $print_columns) ) {
  ?>
                    <td class="text-right"><?php echo number_format($employee->$var,2); ?></td>
                <?php } ?>
 <?php } ?>
 <?php } ?>
 <?php 
$net_pay = (($total_earnings + $gross_pay) - $total_deductions); 
$net_pay_balance = $net_pay;
if( $net_pay < 0 ) {
    $net_pay = 0;
}
$total_net_pay += $net_pay;
$group_net_pay += $net_pay;
$group_total_deductions += $total_deductions;
?>
 <?php if( $column_group_benefits||$column_group_deductions ) { ?>
                <td class="text-right bold"><?php echo number_format($total_deductions,2); ?></td>
<?php } ?>
                
                <td class="text-right bold bigger"><?php echo number_format($net_pay_balance,2); ?></td>

                <td class="text-right bold bigger"><?php echo number_format($net_pay,2); ?></td>

              </tr>
<?php } ?>

<!-- start total -->
   <tr class="highlight total">
                <td class="allcaps">
                Group Total
                </td>
<?php if( $column_group_salaries ) { ?>
<?php if( isColumn($this, 'working_days', $print_columns) ) { ?>
                <td class="text-right"></td>
<?php } ?>
<?php if( isColumn($this, 'absences', $print_columns) ) { ?>
                <td class="text-right"></td>
<?php } ?>
<?php if( isColumn($this, 'rate_per_day', $print_columns) ) { ?>
                <td class="text-right"></td>
<?php } ?>
<?php 
if( isColumn($this, 'basic_salary', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($group_basic_salary,2); ?></td>
<?php } ?>
<?php 
if( isColumn($this, 'cola', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($cola,2); ?></td>
<?php } ?>
<?php 
if( isColumn($this, 'absences_amount', $print_columns) ) { ?>
                <td class="text-right">(<?php echo number_format($group_absences,2); ?>)</td>
<?php } ?>
<?php 
if( isColumn($this, 'gross_pay', $print_columns) ) { ?>
                <td class="text-right"><?php echo number_format($group_gross_pay,2); ?></td>
<?php } ?>
<?php } ?>

<?php if( $column_group_earnings ) { ?>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
  <?php if( isColumn($this, 'earning_' . $column->id, $print_columns) ) {
$var = 'earnings_' . $column->id;
   ?>
                      <td class="text-right"><?php echo number_format($group_earnings[$var],2); ?></td>
  <?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_salaries || $column_group_earnings) { ?>
      <td class="text-right bold"><?php echo number_format($group_total_earnings,2); ?></td>
<?php } ?>
<?php if( $column_group_benefits ) { ?>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
  <?php  if( isColumn($this, 'benefit_' . $column->id, $print_columns) ) { 
$ee = 'ee_share_' . $column->id;
$er = 'er_share_' . $column->id;
  	?>
                  <td class="text-right"><?php echo number_format($group_benefits[$ee],2); ?></td>
                  <td class="text-right"><?php echo number_format($group_benefits[$er],2); ?></td>
  <?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  if( isColumn($this, 'deduction_' . $column->id, $print_columns) ) {
  	$var = 'deductions_' . $column->id;
  ?>
                    <td class="text-right"><?php echo number_format($group_deductions[$var],2); ?></td>
                <?php } ?>
 <?php } ?>
 <?php } ?>
 <?php if( $column_group_benefits||$column_group_deductions ) { ?>
                <td class="text-right bold"><?php echo number_format($group_total_deductions,2); ?></td>
<?php } ?>                

                <td class="text-right bold bigger"></td>

                <td class="text-right bold bigger"><?php echo number_format($group_net_pay,2); ?></td>

              </tr>
<!-- end total -->

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
