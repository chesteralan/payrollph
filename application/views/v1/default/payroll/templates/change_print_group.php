<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/template_preview_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Change Status: <strong><?php echo $name->lastname; ?>, <?php echo $name->firstname; ?></strong></h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

          <div class="form-group">
            <label>Print Group</label>
      <?php if( $print_groups ) { ?>
            <select class="form-control input-sm" name="print_group" data-style="btn-default btn-sm">
              <option value="none">No Print Group</option>
              <?php foreach($print_groups as $grp) { ?>
                <option value="<?php echo $grp->id; ?>" <?php echo ($employee->print_group==$grp->id) ? "SELECTED" : ""; ?>><?php echo $grp->name; ?></option>
              <?php } ?>
            </select>
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