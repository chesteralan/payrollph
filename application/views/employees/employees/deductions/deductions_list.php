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
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Deduction" data-url="<?php echo site_url("employees_deductions/add/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Deduction</button>
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
                <th>Amount</th>
                <th>Start</th>
                <th>Repeat</th>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="105px" class="action_column">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($deductions as $deduction) { ?>
              <tr id="salary-<?php echo $deduction->id; ?>" class="<?php echo ($deduction->active==1) ? 'success' : ''; ?>">
                <td><?php echo $deduction->deduction_name; ?></td>
                <td><?php echo number_format($deduction->amount,2); ?></td>
                <td><?php echo date('F d, Y', strtotime($deduction->start_date)); ?></td>
                <td><span class="glyphicon glyphicon-<?php echo ($deduction->repeat) ? 'ok' : 'remove'; ?>"></span></td>
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>

                <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("employees_deductions/edit/{$deduction->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

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