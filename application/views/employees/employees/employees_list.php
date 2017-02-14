<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('employees', 'employees', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Employee" data-url="<?php echo site_url("employees/search_name/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>" style="margin-right: 5px" data-hide_footer="1">Add Employee</button>
<?php } ?>
                  <h3 class="panel-title bold">
                  <?php echo $current_page; ?>
                    <?php if( isset($group) ) { ?>
                      : <?php echo $group->name; ?>
                    <?php } ?>
                    <?php if( isset($position) ) { ?>
                      : <?php echo $position->name; ?>
                    <?php } ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $employees ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <?php if( !isset($group) ) { ?>
                  <th>Group</th>
                <?php } ?>
                <?php if( !isset($position) ) { ?>
                  <th>Position</th>
                <?php } ?>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="125px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($employees as $employee) { ?>
              <tr id="employee-<?php echo $employee->name_id; ?>">
                <td><?php echo $employee->lastname; ?></td>
                <td><?php echo $employee->firstname; ?></td>
                <td><?php echo $employee->middlename; ?></td>
                <?php if( !isset($group) ) { ?>
                <td>
                <a class="body_wrapper" href="<?php echo site_url("employees/group/{$employee->group_id}"); ?>">
                <?php echo $employee->group_name; ?>
                  </a>
                </td>
                <?php } ?>
                  <?php if( !isset($position) ) { ?>
                <td>
                <a class="body_wrapper" href="<?php echo site_url("employees/position/{$employee->position_id}"); ?>">
                <?php echo $employee->position_name; ?>
                  </a>
                </td>
                <?php } ?>
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>

                <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Employee" data-url="<?php echo site_url("employees/config/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">Config</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees/delete/{$employee->name_id}"); ?>" data-target="#employee-<?php echo $employee->name_id; ?>">Delete</a>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Employee Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>