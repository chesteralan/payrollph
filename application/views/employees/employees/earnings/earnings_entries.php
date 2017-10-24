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
                  <h3 class="panel-title bold">
                  <?php echo $earning->name; ?> - <?php echo $earning->notes; ?> (<?php echo $entry->notes; ?>)
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>

<?php endif; ?>

<?php if( $earnings ) { ?>

<center><a class="btn btn-success btn-xs ajax-modal-inner" href="<?php echo site_url("employees_earnings/edit/{$entry->id}/{$output}") . '?next=' . ( ($this->input->get('next')) ? $this->input->get('next') : uri_string() ); ?>">Edit Item</a></center>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Payroll</th>
                <th>Amount</th>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="50px" class="action_column">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php 
$total = 0;
            foreach($earnings as $earning) { ?>
              <tr id="earning-<?php echo $earning->id; ?>">
                <td><?php echo $earning->payroll_name; ?></td>
                <td><?php echo number_format($earning->pee_amount,2);  $total += $earning->pee_amount; ?></td>
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>
                <a class="btn btn-warning btn-xs body_wrapper" data-dismiss="modal" href="<?php echo site_url("payroll_earnings/view/{$earning->payroll_id}") . '?next=' . ( ($this->input->get('next')) ? $this->input->get('next') : uri_string() ); ?>">Payroll</a>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

</div>

<div class="panel-footer">
<table class="table table-default">
<?php if( $entry->max_amount > 0) { ?>
  <tr>
    <td class="bold">Total Amount:</td>
    <td class="text-right"><?php echo number_format($entry->max_amount,2); ?></td>
  </tr>
<?php } ?>
  <tr>
    <td class="bold">Total Amount Earned:</td>
    <td class="text-right"><?php echo number_format($total,2); ?></td>
  </tr>
<?php if( $entry->max_amount > 0) { ?>
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