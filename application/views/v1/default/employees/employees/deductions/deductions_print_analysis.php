<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
  <body id="payslip" class="analysis">

<div class="page">

<div class="full-border">

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
<h2 class="">Deductions Analysis</h2>
These are active deductions only.
    </td>
  </tr>
</table>

<div class="inner_body">
<?php 
$total_max_amount = 0;
if( $deductions && $payroll_deductions ) { ?>

          <table width="100%" cellpadding="0" cellspacing="0" class="bordered">

              <tr class="bold">
                <td>Payroll</td>
<?php 
$total_amount = 0;
foreach($deductions as $ed) { ?>
                  <td width="10%" class="text-right">
<?php echo $ed->deduction_name; ?><br>
                  <u><?php 
                  $total_max_amount += $ed->max_amount;
                  echo number_format($ed->max_amount,2);
                  ?></u><br>
<?php echo number_format($ed->amount,2); $total_amount+=$ed->amount; ?>
                  </td>
                <?php } ?>
                <?php if( count( $deductions ) > 1 ) { ?>
                  <td width="10%" class="text-right">TOTAL<br>
                  <u><?php echo number_format($total_max_amount,2); ?></u><br><?php echo number_format($total_amount,2); ?>
                  </td>
                <?php } ?>
              </tr>

<?php 
$payroll_total = array();
foreach( $payrolls as $payroll) { 
?>
            <tr>
              <td><?php echo $payroll->payroll_name; ?></td>
              <?php 
$ed_total = 0;
              foreach($deductions as $ed) { 
                if( !isset($payroll_total[$ed->id]) ) {
                  $payroll_total[$ed->id] = 0;
                }
                ?>
                <td class="text-right">
                  <?php 
                  $ped_total = 0;
                  foreach($payroll_deductions as $ped) { 
                    if( ($ped->payroll_id == $payroll->id) && ($ped->entry_id == $ed->id) ) {
                      $ped_total+=$ped->ped_amount;
                      $ed_total+=$ped->ped_amount;
                      $payroll_total[$ed->id]+=$ped->ped_amount;
                    } 
                  } 

                  echo number_format($ped_total,2);
                  ?>
                </td>
              <?php } ?>
              <?php if( count( $deductions ) > 1 ) { ?>
              <td class="text-right"><?php echo number_format($ed_total,2); ?></td>
              <?php } ?>
            </tr>
<?php } ?>
              <tr class="success bold">
                <td>TOTAL</td>
                  <?php 
                  $ped_amount_grand = 0;
                  foreach($deductions as $ed) { ?>
                    <td class="text-right">
                    <?php 
                    
                      $ped_amount_grand += $payroll_total[$ed->id];
                      echo number_format($payroll_total[$ed->id],2); 
                    
                    ?></td>
                  <?php } ?>
                  <?php if( count( $deductions ) > 1 ) { ?>
                <td class="text-right"><?php echo number_format($ped_amount_grand,2); ?></td>
                <?php } ?>
              </tr>
              <tr class="bold">
                <td>BALANCE</td>
                  <?php 
                  foreach($deductions as $ed) { ?>
                    <td class="text-right"><?php 
                    if( $ed->max_amount > 0 ) {
                      echo number_format(($ed->max_amount - $payroll_total[$ed->id]),2); 
                    }
                    ?></td>
                  <?php } ?>
                  <?php if( count( $deductions ) > 1 ) { ?>
                <td class="text-right"><?php echo number_format(($total_max_amount - $ped_amount_grand),2); ?></td>
                <?php } ?>
              </tr>

          </table>

<?php } ?>
</div>
</div>
<br>
<p>Prepared by: 
<span class="allcaps bold"><?php echo $this->session->name; ?></span></p>
</div>

  </body>
</html>