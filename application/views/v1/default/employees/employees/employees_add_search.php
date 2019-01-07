<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Employee</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( $names ) { ?>

<div class="form-group">
  <div class="input-group">
      <input type="text" class="form-control autocomplete-search_ajax_<?php echo ($output=='ajax') ? 'inner' : 'redirect'; ?>" data-source="<?php echo site_url("employees/search_name/autocomplete"); ?>" placeholder="Search name...">
      <span class="input-group-btn">
        <a class="btn btn-success" href="<?php echo site_url("employees/add_multiple"); ?>?next=<?php echo $current_uri; ?>">Add Multiple</a>
      </span>
  </div>
</div>

 <div class="list-group">
    <?php foreach($names as $name) { ?>
      <a href="<?php echo site_url("employees/add/{$name->id}/{$output}") . '?next=' . $this->input->get('next'); ?>" class="list-group-item ajax-modal-inner" data-title="Add Employee: <?php echo $name->full_name; ?>">
      <strong class="pull-right"><?php echo $name->contact_number; ?></strong>
      <?php echo $name->full_name; ?>
      <p class="small"><?php echo $name->address; ?></p>
      </a>
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