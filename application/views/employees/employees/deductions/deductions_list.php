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
                  <?php echo $current_page; ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $deductions ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Deduction Name</th>
                <th>Max Amount</th>
                <th>Amount</th>
                <th>Rate per</th>
                <?php foreach($templates as $temp) { ?>
                  <th class="text-center"><?php echo $temp->name; ?></th>
                <?php } ?>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="185px" class="action_column">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($deductions as $deduction) { ?>
              <tr id="salary-<?php echo $deduction->id; ?>" class="<?php echo ($deduction->active==1) ? 'success' : ''; ?>">
                <td><a class="body_wrapper" href="<?php echo site_url("employees_deductions/summary/{$deduction->deduction_id}/{$deduction->name_id}") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>"><?php echo $deduction->deduction_name; ?> - <?php echo $deduction->deduction_notes; ?></a></td>
                <td><?php echo number_format($deduction->max_amount,2); ?></td>
                <td><?php echo number_format($deduction->amount,2); ?></td>
                <td><?php 
                $computed = array('month'=>'Monthly', 'day'=>'Daily', 'hour'=>'Hourly');
                echo $computed[($deduction->computed) ? $deduction->computed : 'month']; ?></td>
             
                <?php foreach($templates as $temp) { 
                  $var = 'temp_' . $temp->id;
                  ?>
                  <td class="text-center"><span class="glyphicon glyphicon-<?php echo ($deduction->$var) ? 'ok' : 'remove'; ?>"></span></td>
                <?php } ?>
                
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>

                <a class="btn btn-warning btn-xs body_wrapper" href="<?php echo site_url("employees_deductions/entries/{$deduction->id}"); ?>">Entries</a>

                <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("employees_deductions/edit/{$deduction->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_deductions/delete/{$deduction->id}"); ?>" data-target="#salary-<?php echo $deduction->id; ?>">Delete</a>

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