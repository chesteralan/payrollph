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
                  <?php echo $deduction->name; ?> - <?php echo $deduction->notes; ?> Analysis
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>

<?php endif; ?>

<?php 
$total_max_amount = 0;
if( $deductions && $payroll_deductions ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Payroll</th>
                <?php foreach($deductions as $ed) { ?>
                  <th width="10%" class="text-right"><?php 
                  $total_max_amount += $ed->max_amount;
                  echo number_format($ed->max_amount,2);
                  ?></th>
                <?php } ?>
                <th width="10%" class="text-right"><?php echo number_format($total_max_amount,2); ?></th>
              </tr>
            </thead>
            <tbody>
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
              <td class="text-right"><?php echo number_format($ed_total,2); ?></td>
            </tr>
<?php } ?>
            </tbody>
            <tfoot>
              <tr class="success">
                <th>TOTAL</th>
                  <?php 
                  $ped_amount_grand = 0;
                  foreach($deductions as $ed) { ?>
                    <th class="text-right"><?php 
                    $ped_amount_grand += $payroll_total[$ed->id];
                    echo number_format($payroll_total[$ed->id],2); 
                    ?></th>
                  <?php } ?>
                <th class="text-right"><?php echo number_format($ped_amount_grand,2); ?></th>
              </tr>
              <tr>
                <th>BALANCE</th>
                  <?php 
                  foreach($deductions as $ed) { ?>
                    <th class="text-right"><?php 
                    echo number_format(($ed->max_amount - $payroll_total[$ed->id]),2); 
                    ?></th>
                  <?php } ?>
                <th class="text-right"><?php echo number_format(($total_max_amount - $ped_amount_grand),2); ?></th>
              </tr>
            </tfoot>
          </table>

<?php } else { ?>

  <p class="text-center">No Deductions Found!</p>

<?php } ?>

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