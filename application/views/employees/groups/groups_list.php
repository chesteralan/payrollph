<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('employees', 'employees_groups', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Group" data-url="<?php echo site_url("employees_groups/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Group</button>
<?php } ?>
                  <h3 class="panel-title bold">Employee Groups</h3>
                </div>
                <div class="panel-body text-center">
                Your account have not been granted any access to the system! <br/> Please contact system administrator!
              </div>
              </div>
            </div>
    </div>
</div>

<?php $this->load->view('footer'); ?>