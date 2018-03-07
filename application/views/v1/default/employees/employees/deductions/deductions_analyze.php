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
<a href="<?php echo site_url("employees_deductions/view/{$employee->name_id}"); ?>" class="btn btn-warning btn-xs pull-right body_wrapper"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                  <h3 class="panel-title bold">
<?php if( isset($deduction) ) { ?>
  <?php echo $deduction->name; ?> - <?php echo $deduction->notes; ?>
<?php } else { ?>
  Deductions
<?php } ?>
                  Analysis
<?php 
  $print_url = site_url("employees_deductions/print_analysis/{$employee->name_id}"); 
  if( isset($deduction) ) {
    $print_url = site_url("employees_deductions/print_analysis/{$employee->name_id}/{$deduction->id}"); 
  }
?>
<a target="_print" title="Deductions Analysis" href="<?php echo $print_url; ?>"><span class="glyphicon glyphicon-print"></span></a>

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
                <th width="1px"></th>
                <th>Payroll</th>
<?php 
$total_amount = 0;
foreach($deductions as $ed) { ?>
                  <th width="10%" class="text-right">
<?php echo $ed->deduction_name; ?><br>
                  <u><a href="#ajaxModal" class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("employees_deductions/edit/{$ed->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>"><?php 
                  $total_max_amount += $ed->max_amount;
                  echo number_format($ed->max_amount,2);
                  ?></a></u><br>
<?php echo number_format($ed->amount,2); $total_amount+=$ed->amount; ?>
                  </th>
                <?php } ?>
                <?php if( count( $deductions ) > 1 ) { ?>
                  <th width="10%" class="text-right">TOTAL<br>
                  <u><?php echo number_format($total_max_amount,2); ?></u><br><?php echo number_format($total_amount,2); ?>
                  </th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
<?php 
$payroll_total = array();
$excluded = explode("|", $this->input->get('exclude'));
foreach( $payrolls as $payroll) { 
  if( in_array($payroll->id, $excluded) ) {
      continue;
  }
?>
            <tr>
              <td><a href="<?php echo site_url(uri_string()) . "?exclude=" . implode("|", array_merge($excluded,array($payroll->id))); ?>"><span class="glyphicon glyphicon-remove" style="color: red;"></span></a></td>
              <td><a title="Deductions Analysis" href="<?php echo site_url('payroll/select_payroll/' . $payroll->id); ?>"><?php echo $payroll->payroll_name; ?></a></td>
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
                  $have_entries = false;
                  foreach($payroll_deductions as $ped) { 
                    if( ($ped->payroll_id == $payroll->id) && ($ped->entry_id == $ed->id) ) { 
                      $ped_total+=$ped->ped_amount;
                      $ed_total+=$ped->ped_amount;
                      $have_entries = true;
                      $payroll_total[$ed->id]+=$ped->ped_amount;
                    } 
                  } 
                  ?>
                  <?php if( $have_entries ) { ?>
                  <a href="#ajaxModal" class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("payroll_deductions/entries/{$payroll->id}/{$ed->name_id}/{$ed->deduction_id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>">
                  <?php } ?>
                  <?php echo number_format($ped_total,2); ?>
                  <?php if( $have_entries ) { ?>
                  </a>
                  <?php } ?>
                </td>
              <?php } ?>
              <?php if( count( $deductions ) > 1 ) { ?>
              <td class="text-right"><?php echo number_format($ed_total,2); ?></td>
              <?php } ?>
            </tr>
<?php } ?>
            </tbody>
<?php if( $payroll_total ) { ?>
            <tfoot>
              <tr class="success">
                <th></th>
                <th>TOTAL</th>
                  <?php 
                  $ped_amount_grand = 0;
                  foreach($deductions as $ed) { ?>
                    <th class="text-right">
                    <?php 
                    
                      $ped_amount_grand += $payroll_total[$ed->id];
                      echo number_format($payroll_total[$ed->id],2); 
                    
                    ?></th>
                  <?php } ?>
                  <?php if( count( $deductions ) > 1 ) { ?>
                <th class="text-right"><?php echo number_format($ped_amount_grand,2); ?></th>
                <?php } ?>
              </tr>
              <tr>
                <th></th>
                <th>BALANCE</th>
                  <?php 
                  foreach($deductions as $ed) { ?>
                    <th class="text-right"><?php 
                    if( $ed->max_amount > 0 ) {
                      echo number_format(($ed->max_amount - $payroll_total[$ed->id]),2); 
                    }
                    ?></th>
                  <?php } ?>
                  <?php if( count( $deductions ) > 1 ) { ?>
                <th class="text-right"><?php echo number_format(($total_max_amount - $ped_amount_grand),2); ?></th>
                <?php } ?>
              </tr>
            </tfoot>
<?php } ?>
          </table>

<?php
if( $excluded ) { foreach( $payrolls as $payroll) { 
  if( ! in_array($payroll->id, $excluded) ) {
      continue;
  } 
 ?>
 <a href="<?php echo site_url(uri_string()) . "?exclude=" . implode("|", array_diff($excluded,array($payroll->id))); ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-ok"></span> <?php  echo $payroll->payroll_name; ?></a>
<?php } } ?>

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