<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('employees', 'employees', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Deduction" data-url="<?php echo site_url("employees_deductions/add/{$employee->name_id}/ajax") . "?next=" . ( ( ($this->input->get('next')) && ($this->input->get('next') != 'employees') ) ? $this->input->get('next') : uri_string()); ?>" style="margin-right: 5px">Add Deduction</button>
<?php } ?>
                  <h3 class="panel-title bold">
                  <?php echo $current_page; ?> <span class="badge">Active</span> <a href="<?php echo site_url("employees_deductions/archived/{$employee->name_id}"); ?><?php echo ($this->input->get('filter')) ? "?filter=" . $this->input->get('filter') : ""; ?>" class="body_wrapper"><span class="glyphicon glyphicon-folder-close"></span></a>

<a class="body_wrapper" title="Deductions Analysis" href="<?php echo site_url("employees_deductions/analyze/{$employee->name_id}"); ?>"><span class="glyphicon glyphicon-signal"></span></a>

                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $deductions ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Deduction Name 
                <?php if( $this->input->get('filter') ) { ?>
 <a class="body_wrapper" href="<?php echo site_url("employees_deductions/view/{$employee->name_id}"); ?>"><span class="glyphicon glyphicon-remove"></span></a>
<?php } ?>
 </th>
                <th>Date</th>
                <th>Max Amount</th>
                <th>Amount</th>
                <th>Balance</th>
                <?php foreach($templates as $temp) { ?>
                  <th class="text-center" width="5%"><?php echo $temp->name; ?></th>
                <?php } ?>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="125px" class="action_column">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php 
$total_max_amount = 0;
$total_amount = 0;
$total_balance = 0;
            foreach($deductions as $deduction) { ?>
              <tr id="salary-<?php echo $deduction->id; ?>" class="<?php echo ($deduction->active==1) ? 'success' : ''; ?>">
                <td><?php echo $deduction->deduction_name; ?> - <?php echo $deduction->deduction_notes; ?>
<?php if( !$this->input->get('filter') ) { ?>
 <a class="body_wrapper" href="<?php echo site_url("employees_deductions/view/{$deduction->name_id}") . "?filter=" . $deduction->deduction_id; ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>

 <a class="body_wrapper" href="<?php echo site_url("employees_deductions/analyze/{$deduction->name_id}/{$deduction->deduction_id}"); ?>"><span class="glyphicon glyphicon-signal"></span></a>
                </td>
                <td><?php echo date("F d, Y", strtotime($deduction->start_date)); ?></td>
                <td><?php echo number_format($deduction->max_amount,2); $total_max_amount+=$deduction->max_amount; ?></td>
                <td><?php echo number_format($deduction->amount,2); $total_amount+=$deduction->amount; ?></td>
                <td><?php if ($deduction->balance) { 
                    echo number_format($deduction->balance,2);
                    $total_balance+=$deduction->balance;
                  } else { 
                    echo number_format($deduction->max_amount,2);
                    $total_balance+=$deduction->max_amount;
                  } ?></td>
             
                <?php foreach($templates as $temp) { 
                  $var = 'temp_' . $temp->id;
                  ?>
                  <td class="text-center"><span class="glyphicon glyphicon-<?php echo ($deduction->$var) ? 'ok' : 'remove'; ?>"></span></td>
                <?php } ?>
                
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>

                <a class="btn btn-warning btn-xs body_wrapper" href="<?php echo site_url("employees_deductions/entries/{$deduction->id}"); ?>">Entries</a>

                <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("employees_deductions/edit/{$deduction->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>">Edit</button>
<?php /*
                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_deductions/delete/{$deduction->id}"); ?>" data-target="#salary-<?php echo $deduction->id; ?>">Delete</a>
*/ ?>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>
<?php if( $this->input->get('filter') ) { ?>
  <tr class="warning">
      <td><strong>TOTAL</strong></td>
      <td><strong><?php echo number_format($total_max_amount,2); ?></strong></td>
      <td><strong><?php echo number_format($total_amount,2); ?></strong></td>
      <td><strong><?php echo number_format($total_balance,2); ?></strong></td>
      <td></td>
      <td></td>
      <td></td>
  </tr>
<?php } ?>
            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Deduction Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>