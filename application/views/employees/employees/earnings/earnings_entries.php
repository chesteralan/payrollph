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
                <span class="pull-right bold"><?php echo number_format($entry->max_amount,2); ?></span>
                  <h3 class="panel-title bold">
                  <?php echo $earning->name; ?> - <?php echo $earning->notes; ?> (<?php echo $entry->notes; ?>)
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>

<?php endif; ?>

<?php if( $earnings ) { ?>

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
                <td><?php echo number_format($earning->amount,2);  $total += $earning->amount; ?></td>
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>

                <a class="btn btn-warning btn-xs body_wrapper" data-dismiss="modal" href="<?php echo site_url("payroll_earnings/view/{$earning->payroll_id}") . '?next=' . uri_string(); ?>">Payroll</a>

                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

</div>

<div class="panel-footer">
    <div class="pull-right">
    <p class="text-right"><strong>Total:</strong> <?php echo number_format($total,2); ?></p>
    <p><strong>Balance:</strong> <?php echo number_format($entry->max_amount-$total,2); ?></p>
      
    </div>
    <div class="clearfix"></div>
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