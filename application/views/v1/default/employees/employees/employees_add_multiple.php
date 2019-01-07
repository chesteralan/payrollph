<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Multiple Employees</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( $names ) { ?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <?php foreach($names as $name) { ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?php echo $name->id; ?>">
      <h4 class="panel-title">
        <input type="checkbox" class="pull-right" name="employee[<?php echo $name->id; ?>][add]" > 
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $name->id; ?>" aria-expanded="false" aria-controls="collapse<?php echo $name->id; ?>">
          <?php echo $name->full_name; ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $name->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $name->id; ?>">
      <div class="panel-body">

<?php if ( $groups ) { ?>
          <div class="form-group">
            <label>Group</label>
            <select class="form-control" title="Select a Group" name="employee[<?php echo $name->id; ?>][group_id]">
              <?php foreach($groups as $group) { ?>
                <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
              <?php } ?>
            </select>
          </div>
<?php } ?>
<?php if( $positions ) { ?>
          <div class="form-group">
            <label>Position</label>
            <select class="form-control" title="Select a Position" name="employee[<?php echo $name->id; ?>][position_id]">
              <?php foreach($positions as $position) { ?>
                <option value="<?php echo $position->id; ?>"><?php echo $position->name; ?></option>
              <?php } ?>
            </select>
          </div>
<?php } ?>
<?php if( $areas ) { ?>
          <div class="form-group">
            <label>Area</label>
            <select class="form-control" title="Select an Area" name="employee[<?php echo $name->id; ?>][area_id]">
              <?php foreach($areas as $area) { ?>
                <option value="<?php echo $area->id; ?>"><?php echo $area->name; ?></option>
              <?php } ?>
            </select>
          </div>
<?php } ?>

      </div>
    </div>
  </div>
  <?php } ?>
</div>

   <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>
<?php } else { ?>
  <p class="text-center">No Names Found!</p>
<?php } ?>

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