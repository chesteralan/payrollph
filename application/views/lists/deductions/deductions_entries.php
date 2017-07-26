<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo (isset($employee)&&($employee)) ? $employee->lastname . ", " . $employee->firstname : 'Filter by Employee'; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
     <li><a href="<?php echo site_url("lists_deductions/entries/{$deduction->id}/0"); ?>">- - Show All - -</a></li>
  <?php foreach( $employees as $emp ) { ?>
    <li class="<?php echo (isset($employee)&&($employee)&&($emp->name_id==$employee->name_id)) ? 'active' : ''; ?>"><a href="<?php echo site_url("lists_deductions/entries/{$deduction->id}/{$emp->name_id}"); ?>"><?php echo $emp->lastname . ", " . $emp->firstname; ?></a></li>
  <?php } ?>
  </ul>
</div>
                  <h3 class="panel-title bold"><?php echo $current_page; ?>: <?php echo $deduction->name; ?> <small><?php echo $deduction->notes; ?></small></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $items ) {  ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Employee Name</th>
                <th>Payroll</th>
                <th class="text-right">Whole Amount</th>
                <th class="text-right">Amount</th>
                <th width="130px" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
<?php 
$max_amount_total = 0;
$amount_total = 0;
$amount_paid_total = 0;
$balance_total = 0;
       foreach($items as $item) { ?>
              <tr id="employee-group-<?php echo $item->id; ?>">
                <td>
                <?php echo $item->lastname; ?>, <?php echo $item->firstname; ?>
</td>

<td><?php echo $item->payroll_name; ?></td>
<td class="text-right"><?php echo number_format($item->max_amount,2); ?></td>
                <td class="text-right"><?php echo number_format($item->amount,2); $amount_total+=$item->amount; ?></td>

                <td class="text-right">
                  <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("payroll_deductions/edit/{$item->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                </td>

              </tr>
            <?php } ?>
            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Earning Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>