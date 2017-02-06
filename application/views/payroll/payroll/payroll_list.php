<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('payroll', 'payroll', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Payroll" data-url="<?php echo site_url("payroll/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Payroll</button>
<?php } ?>
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
                    <?php if(isset($template)) { ?>
                      : <?php echo $template->name; ?>
                    <?php } ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payrolls ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Payroll Description</th>
                <th>Month</th>
                <th>Year</th>
                <?php if(!isset($template)) { ?>
                <th>Template</th>
                <?php } ?>

                <?php if( hasAccess('payroll', 'payroll', 'edit') ) { ?>
                  <th width="105px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php foreach($payrolls as $payroll) { ?>
              <tr id="Payroll-<?php echo $payroll->id; ?>">
                <td><?php echo $payroll->name; ?></td>
                <td><?php echo date('F', strtotime($payroll->month."/1/1970")); ?></td>
                <td><?php echo $payroll->year; ?></td>
                <?php if(!isset($template)) { ?>
                <td>
                <a class="body_wrapper" href="<?php echo site_url("payroll/template/{$payroll->template_id}"); ?>">
                <?php echo $payroll->template_name; ?>
                  </a>
                </td>
                <?php } ?>
              <?php if( hasAccess('payroll', 'payroll', 'edit') ) { ?>
                <td>
<?php if( $payroll->groups_count > 0 ) { ?>

      <a class="btn btn-success btn-xs body_wrapper" href="<?php echo site_url("payroll_salaries/view/{$payroll->id}"); ?>">View</a>

<?php } else { ?>

                  <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Payroll" data-url="<?php echo site_url("payroll/config/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">Config</button>

<?php } ?>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("payroll/delete/{$payroll->id}"); ?>" data-target="#Payroll-<?php echo $payroll->id; ?>">Delete</a>
                
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Payroll Found!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>