<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Salary Entry</h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( $salaries ) { ?>

<div class="list-group">

<?php foreach($salaries as $salary) {  ?>

  <a class="list-group-item" href="<?php echo site_url("employees_salaries/set_primary/{$salary->id}") . "?next=" . $this->input->get('next'); ?>">

  <span class="badge pull-right"><?php echo $salary->manner; ?></span>
    <h4 class="list-group-item-heading"><?php echo number_format($salary->amount,2); ?></h4>
    <p class="list-group-item-text">Rate per <?php echo $salary->rate_per; ?><br><?php echo $salary->notes; ?></p>

    </a>

<?php } ?>

</div>

<?php } else { ?>

<p class="text-center">No Entry Found!</p>

<p class="text-center"><a href="<?php echo site_url("employees_salaries/add/{$name_id}/ajax") . '?next=' . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Add Salary">Add Salary</a></p>
<?php }  ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>
      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>