<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

function personal_info($employee) { 
return <<<HTML
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Last Name</label>
      <div class="form-control">{$employee->lastname}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>First Name</label>
      <div class="form-control">{$employee->firstname}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Middle Name</label>
      <div class="form-control">{$employee->middlename}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Birthday</label>
      <div class="form-control"></div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Birthplace</label>
      <div class="form-control"></div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Gender</label>
      <div class="form-control"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Civil Status</label>
      <div class="form-control"></div>
    </div>
  </div>
</div>
HTML;
 } ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
<?php endif; ?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<?php foreach(array(
  array(
    'title'=>'Personal Information',
    'config_url' => site_url("employee/edit_personal/{$employee->name_id}/ajax") . "?next=" . uri_string(),
    'panel_body' => personal_info($employee),
    'open' => true,
    ),
  array(
    'title'=>'Address &amp; Contact Numbers',
    'config_url' => site_url("employee/edit_contacts/{$employee->name_id}/ajax") . "?next=" . uri_string(),
    'panel_body' => '',
  ),
  array(
    'title'=>'Social Media Accounts',
    'config_url' => site_url("employee/edit_socialmedia/{$employee->name_id}/ajax") . "?next=" . uri_string(),
    'panel_body' => '',
  ),
  array(
    'title'=>'Identification Numbers',
    'config_url' => site_url("employee/edit_idnumbers/{$employee->name_id}/ajax") . "?next=" . uri_string(),
    'panel_body' => '',
  ),
  array(
    'title'=>'Emergency Contacts',
    'config_url' => site_url("employee/edit_emergency/{$employee->name_id}/ajax") . "?next=" . uri_string(),
    'panel_body' => '',
  ),
) as $i=>$content) { ?>
<div class="panel panel-default">
                <div class="panel-heading">
                <a class="ajax-modal pull-right" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $content['title']; ?>" data-url="<?php echo $content['config_url']; ?>"><span class="glyphicon glyphicon-cog"></span></a>
                  <h3 class="panel-title bold">
<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                  <?php echo $content['title']; ?>
</a>
                  </h3>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php echo (isset($content['open'])) ? "in" : ""; ?>" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                <div class="panel-body">
                    <?php echo $content['panel_body']; ?>
                </div>
                </div>
              </div>
<?php } ?>

</div>
<?php if( ! $inner_page ): ?>

            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>