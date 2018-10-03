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

                    <a href="<?php echo site_url(uri_string()); ?>?filter=trash"><span class="glyphicon glyphicon-trash"></span></a>

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
    
<?php if( hasAccess('employees', 'groups', 'add') ) { ?>
  <button type="button" class="btn btn-success ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Group" data-url="<?php echo site_url("employees_groups/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Group</button>
<?php } ?>

  </span>
</div><!-- /input-group -->
</form>
</div>
</div>

                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $groups ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Group Name</th>
                <th>Employees</th>
                <?php if( hasAccess('employees', 'groups', 'edit') ) { ?>
                  <th width="145px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($groups as $group) { ?>
              <tr id="employee-group-<?php echo $group->id; ?>">
                <td><?php echo $group->name; ?></td>
                <td><a href="<?php echo site_url("employees/group/{$group->id}"); ?>" class="body_wrapper"><?php echo $group->employees_count; ?></a></td>
              <?php if( hasAccess('employees', 'groups', 'edit') ) { ?>
                <td>
<?php if( $group->trash==0 ) { ?>
                <a class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Group" data-url="<?php echo site_url("employees_groups/edit/{$group->id}/ajax") . "?next=" . uri_string(); ?>">Edit</a>
                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_groups/deactivate/{$group->id}"); ?>" data-target="#employee-group-<?php echo $group->id; ?>">Deactivate</a>
<?php } else { ?>
  <a class="btn btn-success btn-xs confirm" href="<?php echo site_url("employees_groups/restore/{$group->id}"); ?>" data-target="#employee-group-<?php echo $group->id; ?>">Restore</a>
<?php } ?>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Group Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>