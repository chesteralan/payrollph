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

<div class="btn-group" role="group" aria-label="..." style="margin-bottom: 5px;">
  <button class="btn btn-default btn-xs sortable-asc" data-sortable="sortable" type="button"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button> 
  <button class="btn btn-default btn-xs sortable-desc" data-sortable="sortable" type="button"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></button> 
</div>

<ul class="list-group sortable">
  <?php foreach($earnings as $earning) { ?>
  <li class="list-group-item">
  <input type="hidden" name="earning[]" value="<?php echo $earning->id; ?>">
  <span class="glyphicon glyphicon-sort pull-right"></span>
    <h4 class="list-group-item-heading"><label><input type="checkbox" name="selected[]" value="<?php echo $earning->id; ?>" <?php echo ($earning->id==$earning->selected) ? "CHECKED" : ""; ?>> <?php echo $earning->name; ?></label></h4>
    <p class="list-group-item-text"><?php echo $earning->notes; ?></p>
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