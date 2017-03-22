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
  <?php foreach($benefits as $benefit) { ?>
  <li class="list-group-item">
  <input type="hidden" name="benefit[]" value="<?php echo $benefit->id; ?>">
  <span class="glyphicon glyphicon-sort pull-right"></span>
  <?php if($benefit->id==$benefit->selected) { ?>
  <a class="pull-right" href="<?php echo site_url("payroll_benefits/reset/{$payroll_id}/{$benefit->id}") . "?next=" . $this->input->get('next'); ?>" style="margin-right:5px;"><span class="glyphicon glyphicon-refresh"></span></a>
  <?php } ?>
    <h4 class="list-group-item-heading"><label><input type="checkbox" name="selected[]" value="<?php echo $benefit->id; ?>" <?php echo ($benefit->id==$benefit->selected) ? "CHECKED" : ""; ?>> <?php echo $benefit->name; ?></label></h4>
    <p class="list-group-item-text"><?php echo $benefit->notes; ?></p>
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