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
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME; ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
    
  </head>
  <body id="payroll_print">
<div class="print-topnav hide-print text-center allcaps">
  <a href="<?php echo site_url("payroll_dtr/view/{$payroll->id}"); ?>">Back</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/payslip"); ?>">Payslip</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/print"); ?>">All</a>
  <?php foreach($print_groups as $pg) { ?>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$pg->id}/print/1"); ?>"><?php echo $pg->name; ?></a>
  <?php } ?>
</div>

<div class="config_box">
<form method="get" action="<?php echo site_url($this->input->get('next')); ?>">
 <table width="100%" cellspacing="0" cellpadding="0" class="table">
  <tr>
  <?php 
$n = 0;
  foreach(array(
          'working_days'=>'Working Days',
          'absences'=>'Absences',
          'days_present'=>'Days Present',
          'rate_per_day'=>'Rate Per Day', 
          'basic_salary'=>'Basic Salary', 
          'cola'=>'COLA', 
          'absences_amount'=>'Absences Amount', 
          'gross_pay'=>'Gross Pay', 
        ) as $col_key=>$col_name) { 

    echo (($n % 3) == 0) ? '</tr><tr>' : '';
    ?>
 
             <td>
              <label><input class="print_column_0" type="checkbox" name="columns[]" value="<?php echo $col_key; ?>" CHECKED> <?php echo $col_name; ?></label>
              </td>
        <?php $n++; } ?>

<?php if( $earnings ) { ?>
        
        <?php foreach($earnings as $earning) { 
 echo (($n % 3) == 0) ? '</tr><tr>' : '';
          ?>
     
             <td>
              <label><input class="print_column_0" type="checkbox" name="columns[]" value="earning_<?php echo $earning->id; ?>" CHECKED> <?php echo $earning->name; ?></label>
              </td>
        <?php $n++; } ?>
       
<?php } ?>

<?php if( $benefits ) { ?>
       <?php foreach($benefits as $benefit) { 
        echo (($n % 3) == 0) ? '</tr><tr>' : '';
         ?>
   
             <td>
              <label><input class="print_column_0" type="checkbox" name="columns[]" value="benefit_<?php echo $benefit->id; ?>" CHECKED> <?php echo $benefit->name; ?></label>
              </td>
        <?php $n++; } ?>
       
<?php } ?>

<?php if( $deductions ) { ?>
       <?php if( $deductions ) 
       foreach($deductions as $deduction) { 
         echo (($n % 3) == 0) ? '</tr><tr>' : '';
         ?>

             <td>
              <label><input class="print_column_0" type="checkbox" name="columns[]" value="deduction_<?php echo $deduction->id; ?>" CHECKED> <?php echo $deduction->name; ?></label>
              </td>
        <?php $n++; } ?>
       
<?php } ?>
</tr>
</table>
<p>
<button type="submit">Submit</button>
</p>
</form>
</div>
  </body>
</html>
