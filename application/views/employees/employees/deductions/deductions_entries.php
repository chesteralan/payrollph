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
<?php if( isset($output) && ($output!='ajax') ) { ?>
<a class="btn btn-success btn-xs ajax-modal pull-right" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Item" data-url="<?php echo site_url("employees_deductions/edit/{$entry->id}/{$output}/ajax") . '?next=' . uri_string(); ?>">Edit Item</a>
<?php } ?>
                  <h3 class="panel-title bold">
                  <?php echo $deduction->name; ?> - <?php echo $deduction->notes; ?> <?php echo ($entry->notes) ? "(".$entry->notes.")" : ""; ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>

<?php endif; ?>

<?php if( $deductions ) { ?>
<?php if( isset($output) && ($output=='ajax') ) { ?>

<center><a class="btn btn-success btn-xs ajax-modal-inner" href="<?php echo site_url("employees_deductions/edit/{$entry->id}/{$output}") . '?next=' . (($this->input->get('next'))?$this->input->get('next'):"employees_deductions/view/{$employee->name_id}"); ?>">Edit Item</a></center>

<?php } ?>
          <table class="table table-default">
            <thead>
              <tr>
                <th>Payroll Name</th>
                <th class="text-right">Amount</th>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
<?php if( !$this->input->get('no_action') ) { ?>
                  <th width="50px" class="action_column">Action</th>
<?php } ?>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php 
$total = 0;
            foreach($deductions as $deduction) { ?>
              <tr id="deduction-<?php echo $deduction->id; ?>">
                <td><?php echo $deduction->payroll_name; ?></td>
                <td class="text-right">
                <a class="ajax-modal-inner" href="<?php echo site_url("payroll_deductions/edit/{$deduction->ped_id}/{$output}") . '?next=' . (($this->input->get('next'))?$this->input->get('next'):"employees_deductions/view/{$employee->name_id}"); ?>">
                <?php echo number_format($deduction->ped_amount,2); $total += $deduction->ped_amount; ?>
                </a>
                </td>
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
<?php if( !$this->input->get('no_action') ) { ?>
                <td>
                <a class="btn btn-warning btn-xs body_wrapper" data-dismiss="modal" href="<?php echo site_url("payroll_deductions/view/{$deduction->payroll_id}") . '?next=' . uri_string(); ?>">Payroll</a>

                </td>
<?php } ?>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

</div>

<div class="panel-footer">
<table class="table table-default">
<?php if( $entry->max_amount > 0 ) { ?>
  <tr>
    <td class="bold">Total Amount:</td>
    <td class="text-right"><?php echo number_format($entry->max_amount,2); ?></td>
  </tr>
<?php } ?>
  <tr>
    <td class="bold">Total Amount Deducted:</td>
    <td class="text-right"><?php echo number_format($total,2); ?></td>
  </tr>
<?php if( $entry->max_amount > 0 ) { ?>
  <tr>
    <td class="bold">Balance:</td>
    <td class="text-right bold"><?php echo number_format($entry->max_amount-$total,2); ?></td>
  </tr>
<?php } ?>
</table>
</div>

<?php } else { ?>

  <div class="text-center">No Entries Found!</div>

<?php } ?>

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