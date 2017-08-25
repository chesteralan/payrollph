<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<div class="btn-group pull-right" style="margin-left: 5px;">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo (isset($employee)&&($employee)) ? $employee->lastname . ", " . $employee->firstname : 'Filter by Employee'; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
     <li><a class="body_wrapper" href="<?php echo site_url("lists_deductions/items/{$deduction->id}/0"); ?>">- - Show All - -</a></li>
  <?php foreach( $employees as $emp ) { ?>
    <li class="<?php echo (isset($employee)&&($employee)&&($emp->name_id==$employee->name_id)) ? 'active' : ''; ?>"><a class="body_wrapper" href="<?php echo site_url("lists_deductions/items/{$deduction->id}/{$emp->name_id}"); ?>"><?php echo $emp->lastname . ", " . $emp->firstname; ?></a></li>
  <?php } ?>
  </ul>
</div>

<?php if( !isset($employee) ) { ?>
<?php if($this->input->get('group_by') == 'employee') { ?>
                <a href="<?php echo site_url( uri_string() ); ?>" class="pull-right" title="Remove Grouping"><span class="glyphicon glyphicon-resize-full"></span></a>
<?php } else { ?>
                <a href="<?php echo site_url( uri_string() ); ?>?group_by=employee" class="pull-right" title="Group by Employee"><span class="glyphicon glyphicon-resize-small"></span></a>
<?php } ?>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo $current_page; ?>:  <?php echo $deduction->name; ?> <small><?php echo $deduction->notes; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $items ) {  ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Deduction Name</th>
<?php if(!$this->input->get('group_by')) { ?>
                <th>Notes</th>
<?php } ?>
                <th class="text-right">Whole Amount</th>
                <th class="text-right">Amount</th>
                <th class="text-right">Amount Paid</th>
                <th class="text-right">Balance</th>
<?php if(!$this->input->get('group_by')) { ?>
                <?php foreach($templates as $temp) { ?>
                  <th class="text-center"><?php echo $temp->name; ?></th>
                <?php } ?>
                <th width="130px" class="text-right">Action</th>
<?php } else { ?>
                <th class="text-right">before deduction</th>
<?php } ?>
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
<?php if(!$this->input->get('group_by')) { ?>
                <a href="<?php echo site_url("employees_deductions/view/{$item->name_id}"); ?>" class="body_wrapper">
<?php } ?>
                <?php echo $item->lastname; ?>, <?php echo $item->firstname; ?>
<?php if(!$this->input->get('group_by')) { ?>
                </a>
<?php } ?>
</td>
<?php if(!$this->input->get('group_by')) { ?>
                <td><?php echo $item->notes; ?></td>
<?php } ?>
                <td class="text-right"><?php echo number_format($item->max_amount,2); $max_amount_total+=$item->max_amount; ?></td>
                <td class="text-right"><?php echo number_format($item->amount,2); $amount_total+=$item->amount; ?></td>
                <td class="text-right"><?php echo number_format($item->amount_paid,2); $amount_paid_total+=$item->amount_paid; ?></td>
                <td class="text-right"><?php echo number_format($item->balance,2); $balance_total+=$item->balance; ?></td>
<?php if(!$this->input->get('group_by')) { ?>
                <?php foreach($templates as $temp) { 
                  $var = 'temp_' . $temp->id;
                  ?>
                  <td class="text-center"><span class="glyphicon glyphicon-<?php echo ($item->$var) ? 'ok' : 'remove'; ?>"></span></td>
                <?php } ?>
                <td class="text-right">
                  <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("employees_deductions/edit/{$item->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                  <button type="button" class="btn btn-success btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Deduction Entries" data-url="<?php echo site_url("employees_deductions/entries/{$item->id}/ajax") . "?next=" . uri_string(); ?>">Entries</button>

                </td>
<?php } else { ?>
                <th class="text-right"><?php echo number_format(($item->balance + $item->amount),2); ?></th>
<?php } ?>
              </tr>
            <?php } ?>

<?php if($this->input->get('group_by')) { ?>
<tr class="success">
                <td <?php if(!$this->input->get('group_by')) { ?>colspan="2"<?php } ?> class="bold">Total</td>
                <td class="text-right bold"><?php echo number_format($max_amount_total,2); ?></td>
                <td class="text-right bold"><?php echo number_format($amount_total,2); ?></td>
                <td class="text-right bold"><?php echo number_format($amount_paid_total,2); ?></td>
                <td class="text-right bold"><?php echo number_format($balance_total,2); ?></td>
                <td class="text-right bold"><?php echo number_format(($balance_total+$amount_total),2); ?></td>
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