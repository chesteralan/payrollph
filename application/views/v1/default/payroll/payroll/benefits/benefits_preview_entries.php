<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a class="btn btn-success btn-xs pull-right" href="<?php echo site_url("employees_benefits/add/{$name_id}/{$benefit_id}") . '?next=' . uri_string(); ?>">Add Earning</a>
          <h3 class="panel-title"><?php echo $benefit_data->name; ?></h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( isset($output) && ($output=='ajax') ) : ?>

<p><a href="<?php echo site_url("employees_benefits/add/{$name_id}/ajax") . "?template_id={$template_id}&benefit_id={$benefit_id}&next=" . $this->input->get('next'); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Add Entry - <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>">Add Entry</a>
</p>

<?php endif; ?>

<?php if( $benefits ) { ?>

<div class="list-group">

<?php 

foreach($benefits as $benefit) { ?>

  <a data-target="#ajaxModal" data-title="Edit Entry" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees_benefits/edit/{$benefit->id}/ajax") . "?next=" . $this->input->get('next'); ?>">

  <span class="badge pull-right"><?php echo number_format($benefit->employee_share,2); ?></span>
    <h4 class="list-group-item-heading"><?php echo $benefit->name; ?></h4>
    <p class="list-group-item-text">Entry ID # <?php echo $benefit->id; ?><?php echo ($benefit->notes!="") ? ' - '.$benefit->notes : ''; ?></p>

   </a>

<?php } ?>

</div>

<?php } else { ?>

<p class="text-center">No Entry Found!</p>

<?php }  ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>

      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>