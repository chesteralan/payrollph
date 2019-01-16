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
<form method="post">
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php endif;  ?>

<div class="list-group">

<?php /* $n = 1;
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
} */ ?>

<?php $n = 1;
foreach( $inclusive_dates as $date ) {  ?>

  <div class="list-group-item">

    <span class="pull-right" style="color:<?php echo ($date->absent) ? 'red' : 'green'; ?>;">
      <input type="hidden" name="inclusive_dates[<?php echo $date->inclusive_date; ?>]" value="<?php echo ($date->absent) ? '0' : '1'; ?>">

      <input type="checkbox" name="present[<?php echo $date->inclusive_date; ?>]" <?php echo ($date->absent) ? '' : 'checked'; ?> data-toggle="toggle" data-on="Present" data-off="Absent" data-style="quick" data-size="mini" class="btn_toggle">

    </span>
    <strong><?php echo $n; ?>.</strong> <?php echo date('F d, Y (l)', strtotime($date->inclusive_date)); ?> 

<a data-target="#ajaxModal" class="ajax-modal-inner <?php echo ($date->assigned) ? 'active' : ''; ?>" href="<?php echo site_url("employees_dtr/add_leave/{$pe_id}/{$date->inclusive_date}/{$output}") . "?next=" . $this->input->get('next') . "&leave_id=" . $this->input->get('leave_id'); ?>" data-title="<?php echo date('F d, Y (l)', strtotime($date->inclusive_date)); ?>">
  <span class="glyphicon glyphicon-pencil"></span>
</a>

        <?php if($date->absent) { ?>
        <span class="badge" style="margin-right:5px"><?php echo ($date->leave_type) ? $date->leave_type : 'No Leave'; ?></span>
    <?php } ?>

  </div>

<?php $n++; 
} ?>
</div>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php if( ! $inner_page ): ?>
              </div>
                      <div class="panel-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="<?php echo site_url($current_uri); ?>" class="btn btn-warning">Back</a>
        </div>
        </form>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>

<?php endif; ?>