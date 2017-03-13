<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

                <a class="pull-right close" href="<?php echo site_url("payroll_deductions/item_schedule/{$payroll->id}/{$deduction_data->id}/print"); ?>" target="_blank"><span class="glyphicon glyphicon-print"></span></a>

                  <h3 class="panel-title"><strong><?php echo $deduction_data->name; ?> - <?php echo $deduction_data->notes; ?></strong>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $item_data ) {  ?>

          <table class="table table-default table-hover" id="Payroll-Group">
            <thead>
              <tr class="warning">
                <th>Employee Name</th>
                <th width="13%" class="text-right">Total Payables</th>
                <th width="13%" class="text-right">Amount Paid</th>
                <th width="13%" class="text-right">Balance</th>
                <th width="13%" class="text-right">Current Deductions</th>
                <th width="13%" class="text-right">Total Amount Paid</th>
              </tr>
            </thead>
            <tbody>
            
<?php 
$total_max_amount = 0;
$total_paid = 0;
$total_balance = 0;
$total_payment = 0;
$total_amount_payment = 0;
foreach($item_data as $item) {

$total_max_amount += $item->max_amount;
$total_paid += $item->amount_paid;
$item_balance = ($item->max_amount > 0) ? ($item->max_amount - $item->amount_paid) : 0;
$total_balance += $item_balance;
$total_payment += $item->amount;
$total_amount_payment += $item->amount_paid+$item->amount;
              ?>
              <tr>
                <td><?php echo $item->lastname; ?>, <?php echo $item->firstname; ?> <?php echo substr($item->middlename,0,1)."."; ?>
                <a href="<?php echo site_url("employees_deductions/view/{$item->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper"><span class="glyphicon glyphicon-cog"></span></a>
                </td>
                <td class="text-right"><?php echo number_format($item->max_amount,2); ?></td>
                <td class="text-right"><?php echo number_format($item->amount_paid,2); ?></td>
                <td class="text-right"><?php echo number_format($item_balance,2); ?></td>
                <td class="text-right"><?php echo number_format($item->amount,2); ?></td>
                <td class="text-right"><?php echo number_format(($item->amount_paid+$item->amount),2); ?></td>
              </tr>
<?php } ?>

              <tr class="success">
                <td><strong>Total</strong></td>
                <td class="text-right"><strong><?php echo number_format($total_max_amount,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_paid,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_balance,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_payment,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_amount_payment,2); ?></strong></td>
              </tr>
            </tbody>
          </table>


<?php } else { ?>

    <div class="text-center">No Item Found!</div>

<?php }  ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>