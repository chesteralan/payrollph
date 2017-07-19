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
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="btn-group" role="group" aria-label="..." style="margin-bottom: 5px;">
  <button class="btn btn-default btn-xs sortable-asc" data-sortable="sortable" type="button"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button> 
  <button class="btn btn-default btn-xs sortable-desc" data-sortable="sortable" type="button"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></button> 
</div>

<ul class="list-group sortable">
  <?php foreach($groups as $group) { ?>
  <li class="list-group-item">
  <input type="hidden" name="group[]" value="<?php echo $group->id; ?>">
  <span class="glyphicon glyphicon-sort pull-right"></span>
    <h4 class="list-group-item-heading"><label><input type="checkbox" name="selected[]" value="<?php echo $group->id; ?>" <?php echo ($group->id==$group->selected) ? "CHECKED" : ""; ?>> <?php echo $group->name; ?></label>
<?php if($group->id==$group->selected) { ?>
<a href="<?php echo site_url("payroll_templates/employees/{$template->id}/{$group->id}/ajax") . '?next=' . (($this->input->get('next'))?$this->input->get('next'):uri_string()); ?>" class="ajax-modal-inner"><span class="glyphicon glyphicon-user"></span></a>
<?php } ?>
    </h4>
    <div class="row">
      <div class="col-md-10">
          <p class="list-group-item-text"><?php echo $group->notes; ?></p>
      </div>
      <div class="col-md-2">
        <select class="form-control input-sm" name="page[<?php echo $group->id; ?>]" data-style="btn-default btn-sm">
        <?php 
        $page_selected = (isset($group->page)) ? $group->page : 1;
        for($i=1;$i < ($template->pages + 1); $i++) { ?>
            <option <?php echo ($page_selected==$i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
        <?php } ?>
        </select>
      </div>
    </div>
  </li>
  <?php } ?>
</ul>

<?php if( isset($output) && ($output!='ajax') ) : ?>
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
<?php $this->load->view('footer'); ?>
<?php endif; ?>