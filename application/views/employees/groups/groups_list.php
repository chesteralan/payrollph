<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('employees', 'groups', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Group" data-url="<?php echo site_url("employees_groups/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Group</button>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo $current_page; ?></h3>
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
                  <th width="125px">Action</th>
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
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Group" data-url="<?php echo site_url("employees_groups/edit/{$group->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_groups/delete/{$group->id}"); ?>" data-target="#employee-group-<?php echo $group->id; ?>">Delete</button>
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