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
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Employee Groups" data-url="<?php echo site_url("payroll/groups/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php endif;  ?>

<div class="list-group">

<?php $n = 1;
foreach( $inclusive_dates as $date ) {  ?>
  <a data-target="#ajaxModal" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees_dtr/add_leave/{$name_id}/{$date->inclusive_date}/ajax") . "?next=" . $this->input->get('next'); ?>" data-title="<?php echo date('F d, Y (l)', strtotime($date->inclusive_date)); ?>">
    <span class="glyphicon glyphicon-<?php echo ($date->absent) ? 'remove' : 'ok'; ?> pull-right" style="color:<?php echo ($date->absent) ? 'red' : 'green'; ?>;"></span>
    <strong><?php echo $n; ?>.</strong> <?php echo date('F d, Y (l)', strtotime($date->inclusive_date)); ?>

    <?php if($date->absent) { ?>
        <span class="badge" style="margin-right:5px"><?php echo ($date->leave_type) ? $date->leave_type : 'No Leave'; ?></span>
    <?php } ?>
  </a>
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