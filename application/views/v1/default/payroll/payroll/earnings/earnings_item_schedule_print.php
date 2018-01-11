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
  <body id="payroll_print" class="item_schedule">

<h2 class="pull-right">PAYROLL ID: <?php echo $payroll->id; ?></h2>
<div class="header-title">
<h2 class="allcaps"><?php echo ($company->name) ? $company->name : ''; ?></h2>
<h3><?php echo ($company->address) ? $company->address : ''; ?></h3>
<h3><?php echo ($company->phone) ? $company->phone : ''; ?></h3>
</div>

<div class="full-border padding3">
  <h3><?php echo $earning_data->name; ?> - <?php echo $earning_data->notes; ?></h3>
  For the period covered <?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?>
</div>

<?php if( $item_data ) {  ?>
  <div class="payroll">
  
         <table width="100%"  cellspacing="0" cellpadding="0" class="table">
            <thead>
              <tr class="warning">
                <th class="text-left">Employee Name</th>
                <th width="20%" class="text-right">Total Payables</th>
                <th width="20%" class="text-right">Amount Paid</th>
                <th width="20%" class="text-right">Balance</th>
                <th width="20%" class="text-right">Current Payment</th>
              </tr>
            </thead>
            <tbody>
            
<?php 
$total_max_amount = 0;
$total_paid = 0;
$total_balance = 0;
$total_payment = 0;
foreach($item_data as $item) {

$total_max_amount += $item->max_amount;
$total_paid += $item->amount_paid;
$total_balance += $item->max_amount - $item->amount_paid;
$total_payment += $item->amount;
              ?>
              <tr>
                <td><?php echo $item->lastname; ?>, <?php echo $item->firstname; ?> <?php echo substr($item->middlename,0,1)."."; ?>
                <a href="<?php echo site_url("employees_earnings/view/{$item->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper"><span class="glyphicon glyphicon-cog"></span></a>
                </td>
                <td class="text-right"><?php echo number_format($item->max_amount,2); ?></td>
                <td class="text-right"><?php echo number_format($item->amount_paid,2); ?></td>
                <td class="text-right"><?php echo number_format(($item->max_amount - $item->amount_paid),2); ?></td>
                <td class="text-right"><?php echo number_format($item->amount,2); ?></td>
              </tr>
<?php } ?>

              <tr class="success">
                <td><strong>Total</strong></td>
                <td class="text-right"><strong><?php echo number_format($total_max_amount,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_paid,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_balance,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_payment,2); ?></strong></td>
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
            <td width="33.33%" class="text-right"><p>Prepared By:</p>
       <br>
        <span class="allcaps bold"><?php echo $template->checked_by_name; ?></span>
      </td>
    </tr>
  </table>
</div>
<?php } ?>



  </body>
</html>
