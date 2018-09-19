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

<div class="row">
<div class="col-md-12">
<div class="btn-group btn-group-xs btn-group-justified" style="margin-bottom: 10px;">
  <?php foreach(array(
    'group'=>'Group',
    'position'=>'Position',
    'area'=>'Area',
    'status'=>'Status',
) as $key=>$value) { ?>
    <a href="<?php echo site_url("payroll/groups/{$payroll->id}") . "?switch=" . $key; ?><?php echo ($this->input->get('next')) ? '&next=' . $this->input->get('next') : ''; ?>" class="btn btn-<?php echo ($key==$payroll->group_by) ? 'success': 'default'; ?>"><?php echo $value; ?></a>
  <?php } ?>
</div>
</div>
</div>

<div class="col-md-5 pull-right">
	<input type="text" class="form-control input-sm filter-list-name" data-list="accordion" placeholder="Filter Name...">
</div>

<div class="btn-group" role="group" aria-label="..." style="margin-bottom: 5px;">
  <button class="btn btn-default btn-xs accordion-sort-asc" data-sortable="sortable" type="button"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button> 
  <button class="btn btn-default btn-xs accordion-sort-desc" data-sortable="sortable" type="button"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></button> 
</div>

<?php /*
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
      <div class="row">
      <div class="col-md-10">
          <p class="list-group-item-text"><?php echo $group->notes; ?></p>
      </div>
      <div class="col-md-2">
        <select class="form-control input-sm" name="page[<?php echo $group->id; ?>]" data-style="btn-default btn-sm">
        <?php 
        $page_selected = (isset($group->page)) ? $group->page : 1;
        for($i=1;$i < ($payroll->pages + 1); $i++) { ?>
            <option <?php echo ($page_selected==$i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
        <?php } ?>
        </select>
      </div>
    </div>
  </li>
  <?php } ?>
</ul>
*/ ?>

<div class="panel-group sortable sortable-employees" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach($groups as $group) { ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?php echo $group->id; ?>">
      <h4 class="panel-title">
        <label><input type="checkbox" name="selected[]" value="<?php echo $group->id; ?>" <?php echo ($group->id==$group->selected) ? "CHECKED" : ""; ?>></label>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $group->id; ?>" aria-expanded="true" aria-controls="collapseOne">
          <input type="hidden" name="group[]" value="<?php echo $group->id; ?>">
          <span class="glyphicon glyphicon-sort pull-right" style="margin-left: 10px;"></span>
           <?php echo $group->name; ?>
        </a>

        <a href="<?php echo site_url("payroll/employees/{$payroll->id}/{$group->id}/" . $output) . '?next=' . (($this->input->get('next'))?$this->input->get('next'):uri_string()); ?>" class="ajax-modal-inner pull-right"><span class="glyphicon glyphicon-user"></span></a>

      </h4>
    </div>
<?php /*
<?php if( $this->input->get('collapse') ) { ?>
<?php if($group->id==$group->selected) { ?>
    <div id="collapse<?php echo $group->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $group->id; ?>">
      <div class="panel-body">
<a href="<?php echo site_url("payroll/employees/{$payroll->id}/{$group->id}/ajax") . '?next=' . (($this->input->get('next'))?$this->input->get('next'):uri_string()); ?>" class="ajax-modal-inner"><span class="glyphicon glyphicon-user"></span></a>
<?php echo $group->notes; ?>
      </div>
    </div>
<?php } ?>
<?php } ?>

*/ ?>

  </div>
<?php } ?>
</div>


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