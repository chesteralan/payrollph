<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php endif;  ?>

<div class="list-group">

<?php $n = 1;
foreach( $inclusive_dates as $date ) {  ?>
<?php if( $payroll->lock ) { ?>
  <div class="list-group-item">
<?php } else { ?>
  <a data-target="#ajaxModal" class="list-group-item ajax-modal-inner <?php echo ($date->assigned) ? 'active' : ''; ?>" href="<?php echo site_url("employees_dtr/add_leave/{$pe_id}/{$date->inclusive_date}/{$output}") . "?next=" . $this->input->get('next') . "&leave_id=" . $this->input->get('leave_id'); ?>" data-title="<?php echo date('F d, Y (l)', strtotime($date->inclusive_date)); ?>">
<?php } ?>
    <span class="glyphicon glyphicon-<?php echo ($date->absent) ? 'remove' : 'ok'; ?> pull-right" style="color:<?php echo ($date->absent) ? 'red' : 'green'; ?>;"></span>
    <strong><?php echo $n; ?>.</strong> <?php echo date('F d, Y (l)', strtotime($date->inclusive_date)); ?>

    <?php if($date->absent) { ?>
        <span class="badge" style="margin-right:5px"><?php echo ($date->leave_type) ? $date->leave_type : 'No Leave'; ?></span>
    <?php } ?>
<?php if( $payroll->lock ) { ?>
  </div>
<?php } else { ?>
  </a>
<?php } ?>

<?php $n++; 
} ?>

</div>

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