<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title bold"><?php echo $current_page; ?> Summary: <?php echo $deduction->name; ?> <small><?php echo $deduction->notes; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $employees_deductions ) {  ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Employee Name</th>
                <th class="text-right">Whole Amount</th>
                <th class="text-right">Monthly Deduction</th>
                <th class="text-right">Amount Paid</th>
                <th class="text-right">Balance</th>
              </tr>
            </thead>
            <tbody>
<?php 
$max_amount_total = 0;
$amount_total = 0;
$amount_paid_total = 0;
$balance_total = 0;
       foreach($employees_deductions as $item) { ?>
              <tr id="employee-group-<?php echo $item->id; ?>">
                <td>

                <a href="<?php echo site_url("employees_deductions/view/{$item->name_id}"); ?>" target="deductions"><?php echo $item->lastname; ?>, <?php echo $item->firstname; ?> <?php echo substr($item->middlename,0,1); ?>.</a>

</td>

                <td class="text-right"><?php echo number_format($item->max_amount,2); $max_amount_total+=$item->max_amount; ?></td>
                <td class="text-right"><?php echo number_format($item->amount,2); $amount_total+=$item->amount; ?></td>
                <td class="text-right"><?php echo number_format($item->amount_paid,2); $amount_paid_total+=$item->amount_paid; ?></td>
                <td class="text-right"><?php echo number_format($item->balance,2); $balance_total+=$item->balance; ?></td>


              </tr>
            <?php } ?>


<tr class="success">
                <td class="bold">Total</td>
                <td class="text-right bold"><?php echo number_format($max_amount_total,2); ?></td>
                <td class="text-right bold"><?php echo number_format($amount_total,2); ?></td>
                <td class="text-right bold"><?php echo number_format($amount_paid_total,2); ?></td>
                <td class="text-right bold"><?php echo number_format($balance_total,2); ?></td>
              </tr>

            </tbody>
          </table>


<?php } else { ?>

  <div class="text-center">No Deductions Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>