<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<div class="row">
<div class="col-md-9 col-sm-6">
                    <h3 class="panel-title bold"><?php echo $current_page; ?>
                    <?php if( $this->input->get('q') ) { ?>
                    <span class="badge"><?php echo $this->input->get('q'); ?> <a href="<?php echo site_url(uri_string()); ?>"><span class="glyphicon glyphicon-remove"></span></a></span>
                    <?php } ?>
          </h3>
</div>
<div class="col-md-3">
<form method="get" action="<?php echo site_url(uri_string()); ?>">
<div class="input-group input-group-sm">
  <input type="text" name="q" class="form-control" placeholder="Search for..." value="<?php echo $this->input->get('q'); ?>">
  <span class="input-group-btn">
    <button class="btn btn-default" type="submit">Search</button>
    
<?php if( hasAccess('employees', 'positions', 'add') ) { ?>
  <button type="button" class="btn btn-success ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Position" data-url="<?php echo site_url("employees_positions/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Position</button>
<?php } ?>

  </span>
</div><!-- /input-group -->
</form>
</div>
</div>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $positions ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Position Name</th>
                <th>Employees</th>
                <?php if( hasAccess('employees', 'positions', 'edit') ) { ?>
                  <th width="125px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($positions as $position) { ?>
              <tr id="employee-group-<?php echo $position->id; ?>">
                <td><?php echo $position->name; ?></td>
                <td><a href="<?php echo site_url("employees/position/{$position->id}"); ?>" class="body_wrapper"><?php echo $position->employees_count; ?></a></td>
              <?php if( hasAccess('employees', 'positions', 'edit') ) { ?>
                <td>
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Group" data-url="<?php echo site_url("employees_positions/edit/{$position->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>
<?php if( $position->employees_count==0 ) { ?>
                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_positions/delete/{$position->id}"); ?>" data-target="#employee-group-<?php echo $position->id; ?>">Delete</a>
<?php } ?>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Position Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>