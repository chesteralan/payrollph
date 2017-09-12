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
  <a href="<?php echo site_url("payroll_dtr/view/{$payroll->id}"); ?>">Back</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/payslip"); ?>">Payslip</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/{$output}/{$current_page}"); ?>">All</a>
  <?php foreach($print_groups as $pg) { ?>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$pg->id}/{$output}/{$current_page}"); ?>"><?php echo $pg->name; ?></a>
  <?php } ?>
  &middot; <a href="<?php echo site_url("payroll_overall/config/{$payroll->id}") . "?next=" . uri_string(); ?>">Config</a>
</div>
<div class="print-topnav topnav2 hide-print text-center allcaps">

    <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/1"); ?>">Page 1</a>
<?php for($i=2;$i <= $template->pages; $i++) { ?>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/{$i}"); ?>">Page <?php echo $i; ?></a>
<?php } ?>
</div>

<h2 class="pull-right">PAYROLL ID: <?php echo $payroll->id; ?></h2>
<div class="header-title">
<h2 class="allcaps"><?php echo ($company->name) ? $company->name : ''; ?></h2>
<h3><?php echo ($company->address) ? $company->address : ''; ?></h3>
<h3><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
</div>

<div class="full-border padding3">
  <h3>DENOMINATION SHEET</h3>
  For the period covered <?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?>
</div>


<?php if( $payroll_groups ) {  

$total_net_pay = 0;
$pc_count = (count($print_columns)) ? count($print_columns) : 1;
$column_width = ceil(71 / $pc_count);
  ?>
  <div class="payroll">
<?php 

$d1000 = 0;
$d500 = 0;
$d100 = 0;
$d50 = 0;
$d20 = 0;
$d10 = 0;
$d5 = 0;
$d1 = 0;
$d025 = 0;
$d010 = 0;
$d005 = 0;
$d001 = 0;

?>
<?php foreach($payroll_groups as $payroll_group) { 
if( $payroll_group->page != $current_page ) {
  //continue;
}
  ?>
  <?php if($payroll_group->employees) { ?>
          <table width="100%" cellspacing="0" cellpadding="0" class="table" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning highlight allcaps">
                <th class="text-left allcaps" width="<?php echo ($pc_count==1) ? '64' : '15'; ?>%"><?php echo $payroll_group->name; ?></th>
                <th width="<?php echo ($pc_count==1) ? '12' : '5'; ?>%" class="text-right allcaps">Net Pay</th>

<th class="text-right">1000.00</th>
<th class="text-right">500.00</th>
<th class="text-right">100.00</th>
<th class="text-right">50.00</th>
<th class="text-right">20.00</th>
<th class="text-right">10.00</th>
<th class="text-right">5.00</th>
<th class="text-right">1.00</th>
<th class="text-right">0.25</th>
<th class="text-right">0.10</th>
<th class="text-right">0.05</th>
<th class="text-right">0.01</th>
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
$group_earnings = array();
$group_benefits = array();
$group_deductions = array();

foreach($payroll_group->employees as $employee) {

$total_deductions = 0;
$total_earnings = 0;
$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
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

$present_days = $inclusive_dates->working_days - $days_absent;
//$basic_salary = ($daily_rate * $inclusive_dates->working_days);
$basic_salary = ($monthly_rate / 2);
$cola = ($cola * $present_days);
$absences = ($daily_rate * $days_absent);
$gross_pay = (($basic_salary + $cola) - $absences); 

$group_basic_salary += $basic_salary;
$group_absences += $absences;
$group_gross_pay += $gross_pay;
?>
              <tr>
                <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>
                </td>

<?php 

if( $earnings_columns ) foreach( $earnings_columns as $column ) { 
      $var = 'earnings_' . $column->id;
      if( !isset($group_earnings[$var]) ) {
      		$group_earnings[$var] = 0;
      }
      $group_earnings[$var] += $employee->$var;
      $total_earnings += $employee->$var;
 } 

$total_gross_earnings = ($total_earnings + $gross_pay);
$group_total_earnings += $total_gross_earnings;

if( $benefits_columns ) foreach( $benefits_columns as $column ) { 
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
  $group_total_deductions += $total_deductions;

 } 

 if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  $var = 'deductions_' . $column->id;
  if( !isset($group_deductions[$var]) ) {
      $group_deductions[$var] = 0;
   }
   $group_deductions[$var] += $employee->$var;
  $total_deductions += $employee->$var;
 }

$net_pay = (($total_earnings + $gross_pay) - $total_deductions); 
$total_net_pay += $net_pay;
$group_net_pay += $net_pay;
?>
                <td class="text-right bold bigger"><?php echo number_format($net_pay,2); ?></td>
<?php 
  $one_thousand = denomination($net_pay, 1000);
    $less = ($one_thousand * 1000);
  $five_hundred = denomination($net_pay, 500, $less);
    $less += ($five_hundred * 500);
  $one_hundred = denomination($net_pay, 100, $less);
    $less += ($one_hundred * 100);
  $fifty = denomination($net_pay, 50, $less);
    $less += ($fifty * 50);
  $twenty = denomination($net_pay, 20, $less);
    $less += ($twenty * 20);
  $ten = denomination($net_pay, 10, $less);
    $less += ($ten * 10);
  $five = denomination($net_pay, 5, $less);
    $less += ($five * 5);
  $one = denomination($net_pay, 1, $less);
    $less += ($one * 1);
  $cent25 = denomination($net_pay, 0.25, $less);
    $less += ($cent25 * 0.25);
  $cent10 = denomination($net_pay, 0.10, $less);
    $less += ($cent10 * 0.10);
  $cent5 = denomination($net_pay, 0.05, $less);
 $less += ($cent5 * 0.05);
  $cent1 = denomination($net_pay, 0.01, $less);

  $d1000 += $one_thousand;
$d500 += $five_hundred;
$d100 += $one_hundred;
$d50 += $fifty;
$d20 += $twenty;
$d10 += $ten;
$d5 += $five;
$d1 += $one;
$d025 += $cent25;
$d010 += $cent10;
$d005 += $cent5;
$d001 += $cent1;

?>
<td class="text-right"><?php echo $one_thousand; ?></td>
<td class="text-right"><?php echo $five_hundred; ?></td>
<td class="text-right"><?php echo $one_hundred; ?></td>
<td class="text-right"><?php echo $fifty; ?></td>
<td class="text-right"><?php echo $twenty; ?></td>
<td class="text-right"><?php echo $ten; ?></td>
<td class="text-right"><?php echo $five; ?></td>
<td class="text-right"><?php echo $one; ?></td>
<td class="text-right"><?php echo $cent25; ?></td>
<td class="text-right"><?php echo $cent10; ?></td>
<td class="text-right"><?php echo $cent5; ?></td>
<td class="text-right"><?php echo $cent1; ?></td>
              </tr>
<?php } ?>

            </tbody>
          </table>
<?php } ?>
    <?php } ?>

<table width="100%" class="total_net_pay full-border table" cellspacing="0" cellpadding="0">
<thead>
<tr>
                <th class="allcaps text-left">
Summary
                </th>
                <th class="text-right" width="5%">

                </th>
  <th class="text-right">1000.00</th>
<th class="text-right">500.00</th>
<th class="text-right">100.00</th>
<th class="text-right">50.00</th>
<th class="text-right">20.00</th>
<th class="text-right">10.00</th>
<th class="text-right">5.00</th>
<th class="text-right">1.00</th>
<th class="text-right">0.25</th>
<th class="text-right">0.10</th>
<th class="text-right">0.05</th>
<th class="text-right">0.01</th>
</tr>
</thead>
<tbody>
       <tr class="highlight total">
<td class="allcaps text-left" width="15%">Total Denominations</td>
<td class="text-right" width="5%"><?php echo number_format($total_net_pay,2); ?></td>
<td class="text-right"><?php echo $d1000; ?></td>
<td class="text-right"><?php echo $d500; ?></td>
<td class="text-right"><?php echo $d100; ?></td>
<td class="text-right"><?php echo $d50; ?></td>
<td class="text-right"><?php echo $d20; ?></td>
<td class="text-right"><?php echo $d10; ?></td>
<td class="text-right"><?php echo $d5; ?></td>
<td class="text-right"><?php echo $d1; ?></td>
<td class="text-right"><?php echo $d025; ?></td>
<td class="text-right"><?php echo $d010; ?></td>
<td class="text-right"><?php echo $d005; ?></td>
<td class="text-right"><?php echo $d001; ?></td>
              </tr>
 <tr class="">
<td class="allcaps text-left" width="15%">Amount</td>
<td class="text-right" width="5%"></td>
<td class="text-right"><?php echo number_format((1000 * $d1000),2); ?></td>
<td class="text-right"><?php echo number_format((500 * $d500),2); ?></td>
<td class="text-right"><?php echo number_format((100 * $d100),2); ?></td>
<td class="text-right"><?php echo number_format((50 * $d50),2); ?></td>
<td class="text-right"><?php echo number_format((20 * $d20),2); ?></td>
<td class="text-right"><?php echo number_format((10 * $d10),2); ?></td>
<td class="text-right"><?php echo number_format((5 * $d5),2); ?></td>
<td class="text-right"><?php echo number_format((1 * $d1),2); ?></td>
<td class="text-right"><?php echo number_format((0.25 * $d025),2); ?></td>
<td class="text-right"><?php echo number_format((0.10 * $d010),2); ?></td>
<td class="text-right"><?php echo number_format((0.05 * $d005),2); ?></td>
<td class="text-right"><?php echo number_format((0.01 * $d001),2); ?></td>
              </tr>
</tbody>
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
