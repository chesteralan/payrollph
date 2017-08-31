<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title bold">
                  <?php echo $current_page; ?> <span class="badge">Trash Bin</span> 
                  <a href="<?php echo site_url("employees_deductions/archived/{$employee->name_id}"); ?><?php echo ($this->input->get('filter')) ? "?filter=" . $this->input->get('filter') : ""; ?>" class="body_wrapper"><span class="glyphicon glyphicon-folder-close"></span></a>

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
 <a class="body_wrapper" href="<?php echo site_url("employees_deductions/archived/{$employee->name_id}"); ?>"><span class="glyphicon glyphicon-remove"></span></a>
<?php } ?>
                </th>
                <th>Max Amount</th>
                <th>Amount</th>
                <th>Balance</th>
                <?php foreach($templates as $temp) { ?>
                  <th class="text-center" width="5%"><?php echo $temp->name; ?></th>
                <?php } ?>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="230px" class="action_column">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($deductions as $deduction) { ?>
              <tr id="salary-<?php echo $deduction->id; ?>" class="<?php echo ($deduction->active==1) ? 'success' : ''; ?>">
                <td><?php echo $deduction->deduction_name; ?> - <?php echo $deduction->deduction_notes; ?>
<?php if( !$this->input->get('filter') ) { ?>
 <a class="body_wrapper" href="<?php echo site_url("employees_deductions/archived/{$deduction->name_id}") . "?filter=" . $deduction->deduction_id; ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
 </td>
                <td><?php echo number_format($deduction->max_amount,2); ?></td>
                <td><?php echo number_format($deduction->amount,2); ?></td>
                <td><?php echo number_format($deduction->balance,2); ?></td>
             
                <?php foreach($templates as $temp) { 
                  $var = 'temp_' . $temp->id;
                  ?>
                  <td class="text-center"><span class="glyphicon glyphicon-<?php echo ($deduction->$var) ? 'ok' : 'remove'; ?>"></span></td>
                <?php } ?>
                
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>

                <a class="btn btn-success btn-xs body_wrapper" href="<?php echo site_url("employees_deductions/restore/{$deduction->id}"); ?>">Restore</a>
<?php if( $deduction->entries <= 0) { ?>
                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_deductions/delete/{$deduction->id}") . "?permanent=1"; ?>" data-target="#salary-<?php echo $deduction->id; ?>">Delete Permanently</a>
<?php } ?>
                </td>
              <?php } ?>
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