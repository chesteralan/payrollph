<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('employees', 'areas', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Area" data-url="<?php echo site_url("employees_areas/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Area</button>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo $current_page; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $areas ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Area Name</th>
                <th>Employees</th>
                <?php if( hasAccess('employees', 'areas', 'edit') ) { ?>
                  <th width="105px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($areas as $area) { ?>
              <tr id="employee-group-<?php echo $area->id; ?>">
                <td><?php echo $area->name; ?></td>
                <td><a href="<?php echo site_url("employees/area/{$area->id}"); ?>" class="body_wrapper"><?php echo $area->employees_count; ?></a></td>
              <?php if( hasAccess('employees', 'areas', 'edit') ) { ?>
                <td>
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Area" data-url="<?php echo site_url("employees_areas/edit/{$area->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_areas/delete/{$area->id}"); ?>" data-target="#employee-group-<?php echo $area->id; ?>">Delete</button>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No area Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>