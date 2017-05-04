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
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Earning" data-url="<?php echo site_url("employees_earnings/add/{$employee->name_id}/ajax") . "?next=" . ( ( ($this->input->get('next')) && ($this->input->get('next') != 'employees') ) ? $this->input->get('next') : uri_string()); ?>" style="margin-right: 5px">Add Earning</button>
<?php } ?>
                  <h3 class="panel-title bold">
                  <?php echo $current_page; ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $earnings ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Earnings Name</th>
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

            <?php foreach($earnings as $earning) { ?>
              <tr id="salary-<?php echo $earning->id; ?>" class="<?php echo ($earning->active==1) ? 'success' : ''; ?>">
                <td><?php echo $earning->earnings_name; ?></td>
                <td><?php echo number_format($earning->max_amount,2); ?></td>
                <td><?php echo number_format($earning->amount,2); ?></td>
                <td><?php 
$computed = array('month'=>'Monthly', 'day'=>'Daily', 'hour'=>'Hourly');
                echo $computed[$earning->computed]; ?></td>
                
                <?php foreach($templates as $temp) { 
                  $var = 'temp_' . $temp->id;
                  ?>
                  <td class="text-center"><span class="glyphicon glyphicon-<?php echo ($earning->$var) ? 'ok' : 'remove'; ?>"></span></td>
                <?php } ?>

              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>

                <a class="btn btn-warning btn-xs body_wrapper" href="<?php echo site_url("employees_earnings/entries/{$earning->id}"); ?>">Entries</a>

                <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Earning" data-url="<?php echo site_url("employees_earnings/edit/{$earning->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_earnings/delete/{$earning->id}"); ?>" data-target="#salary-<?php echo $earning->id; ?>">Delete</a>

                </td>
              <?php } ?>
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