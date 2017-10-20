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
<div class="col-md-9">
                  <h3 class="panel-title">
                    <strong><?php echo $current_page; ?></strong>
                    <?php if( isset($group) ) { ?>
                      <span class="badge"><?php echo $group->name; ?> <a href="<?php echo site_url("employees"); ?>"><span class="glyphicon glyphicon-remove"></span></a></span>
                    <?php } ?>
                    <?php if( isset($position) ) { ?>
                    <span class="badge"><?php echo $position->name; ?> <a href="<?php echo site_url("employees"); ?>"><span class="glyphicon glyphicon-remove"></span></a></span>
                    <?php } ?>
                    <?php if( $this->input->get('q') ) { ?>
                    <span class="badge"><?php echo $this->input->get('q'); ?> <a href="<?php echo site_url(uri_string()); ?>"><span class="glyphicon glyphicon-remove"></span></a></span>
                    <?php } ?>
<br><em>(<?php echo $employees_count; ?> name<?php echo ($employees_count>1)?"s":""; ?> found)</em>
                  </h3>
</div>
<div class="col-md-3">
<form method="get" action="<?php echo site_url( uri_string() ); ?>">
<div class="input-group input-group-sm">
  <input type="text" name="q" class="form-control" placeholder="Search for..." value="<?php echo $this->input->get('q'); ?>">
  <span class="input-group-btn">
    <button class="btn btn-default" type="submit">Search</button>
    
<?php if( hasAccess('employees', 'employees', 'add') ) { ?>
  <button type="button" class="btn btn-success ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Employee" data-url="<?php echo site_url("employees/search_name/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>" style="margin-right: 5px" data-hide_footer="1">Add Employee</button>
<?php } ?>

  </span>
</div><!-- /input-group -->
</form>
</div>
</div>

                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $employees ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <?php if( !isset($group) ) { ?>
                  <th>Group</th>
                <?php } ?>
<?php /*
                <?php if( !isset($position) ) { ?>
                  <th>Position</th>
                <?php } ?>
                <?php if( !isset($area) ) { ?>
                  <th>Area</th>
                <?php } ?>
                <th>Status</th>
*/ ?>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="165px">Action</th>
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
<?php /*
                <?php if( !isset($position) ) { ?>
                <td>
                <a class="body_wrapper" href="<?php echo site_url("employees/position/{$employee->position_id}"); ?>">
                <?php echo $employee->position_name; ?>
                  </a>
                </td>
                <?php } ?>
                <?php if( !isset($area) ) { ?>
                <td>
                <a class="body_wrapper" href="<?php echo site_url("employees/area/{$employee->area_id}"); ?>">
                <?php echo $employee->area_name; ?>
                  </a>
                </td>
                <?php } ?>
                <td><?php echo $employee->status_name; ?></td>
*/ ?>
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>


<div class="btn-group">
                  <a class="btn btn-info btn-xs body_wrapper" href="<?php echo site_url("lists_names/profile/{$employee->name_id}"); ?>">Profile</a>
  <button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right">
    <li><a data-title="Personal Information" class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-url="<?php echo site_url("lists_names/update_personal/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>">Personal Information</a></li>

 <li><a data-title="Address and Contact" class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-url="<?php echo site_url("lists_names/update_contacts/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>">Address and Contacts</a></li>

 <li><a data-title="Social Media Accounts" class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-url="<?php echo site_url("lists_names/update_social_media/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>">Social Media Accounts</a></li>

 <li><a data-title="Identification Numbers" class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-url="<?php echo site_url("lists_names/update_ids/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>">Identification Numbers</a></li>

  <li><a data-title="Emergency Contacts" class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-url="<?php echo site_url("lists_names/update_emergency/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>">Emergency Contacts</a></li>

   <li role="separator" class="divider"></li>

   <li><a data-title="Employment Information" class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-url="<?php echo site_url("employees/edit_employment/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>">Employment Information</a></li>

    <li><a class="body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_salaries/view/{$employee->name_id}"); ?>">
Basic Salary</a></li>

  <li><a class="body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_earnings/view/{$employee->name_id}"); ?>">Earnings</a></li>

  <li><a class="body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_benefits/view/{$employee->name_id}");  ?>">Benefits</a></li>
  
   <li><a class="body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_deductions/view/{$employee->name_id}");  ?>">Deductions</a></li>

  <li><a data-title="Leave Benefits" data-target="#ajaxModal" href="#ajaxModal" data-toggle="modal" class="ajax-modal" data-url="<?php echo site_url("employees/edit_leave_benefits/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>">Leave Benefits</a></li>
  
  </ul>
</div>

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