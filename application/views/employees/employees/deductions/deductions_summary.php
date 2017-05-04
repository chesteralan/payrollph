<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title bold">
                  <?php echo $deduction->name; ?> - <?php echo $deduction->notes; ?> Summary
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>

<?php endif; ?>


          <table class="table table-default">
            <tbody>
            <?php if( $employees_deductions->total_max_amount > 0) { ?>
              <tr id="deduction-<?php echo $deduction->id; ?>">
                <td>Total Amount to be deducted</td>
                <td class="text-right"><?php echo number_format($employees_deductions->total_max_amount,2); ?></td>
              </tr>
            <?php } ?>
            <?php if( $payroll_deductions->total_amount ) { ?>
              <tr id="deduction-<?php echo $deduction->id; ?>">
                <td>Amount already deducted to payroll</td>
                <td class="text-right"><?php echo number_format($payroll_deductions->total_amount,2); ?></td>
              </tr>
            <?php } ?>
            <?php if( $employees_deductions->total_max_amount > 0) { ?>
              <tr id="deduction-<?php echo $deduction->id; ?>" class="bold">
                <td>Balance</td>
                <td class="text-right"><?php echo number_format(($employees_deductions->total_max_amount-$payroll_deductions->total_amount),2); ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

</div>


<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>

<?php endif; ?>