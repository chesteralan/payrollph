<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configure Payroll Template</h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<ul class="list-group sortable">
  <?php foreach($groups as $group) { ?>
  <li class="list-group-item">
  <input type="hidden" name="group[]" value="<?php echo $group->id; ?>">
  <span class="glyphicon glyphicon-sort pull-right"></span>
    <h4 class="list-group-item-heading"><label><input type="checkbox" name="selected[]" value="<?php echo $group->id; ?>" <?php echo ($group->id==$group->selected) ? "CHECKED" : ""; ?>> <?php echo $group->name; ?></label>
<?php if($group->id==$group->selected) { ?>
<a href="<?php echo site_url("payroll/employees/{$payroll->id}/{$group->id}/ajax") . '?next=' . (($this->input->get('next'))?$this->input->get('next'):uri_string()); ?>" class="ajax-modal-inner"><span class="glyphicon glyphicon-user"></span></a>
<?php } ?>
    </h4>
  
    <p class="list-group-item-text"><?php echo $group->notes; ?></p>
  </li>
  <?php } ?>
</ul>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>

      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>