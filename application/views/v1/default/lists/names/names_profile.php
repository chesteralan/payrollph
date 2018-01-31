<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

function personal_info($name) { 
  $CI = get_instance();
  $birthday = date("m/d/Y", strtotime($name->birthday));
  $gender = ucfirst($name->gender);
  $civil_status = $CI->config->item('civil_status');
  $name_civil_stats = (isset($civil_status[$name->civil_status])) ? $civil_status[$name->civil_status] : '';
return <<<HTML
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Last Name</label>
      <div class="form-control">{$name->lastname}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>First Name</label>
      <div class="form-control">{$name->firstname}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Middle Name</label>
      <div class="form-control">{$name->middlename}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Birthday</label>
      <div class="form-control">{$birthday}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Birthplace</label>
      <div class="form-control">{$name->birthplace}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Age</label>
      <div class="form-control">{$name->age} years old</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Civil Status</label>
      <div class="form-control">{$name_civil_stats}</div>
    </div>
  </div>
    <div class="col-md-4">
    <div class="form-group">
      <label>Gender</label>
      <div class="form-control">{$gender}</div>
    </div>
  </div>
</div>
HTML;
 } 

function address_contacts($name) { 
return <<<HTML
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>Postal Address</label>
      <div class="form-control">{$name->address}</div>
    </div>
    <div class="form-group">
      <label>Email Address</label>
      <div class="form-control">{$name->email}</div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Phone Number</label>
      <div class="form-control">{$name->phone_number}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Cellphone (Smart)</label>
      <div class="form-control">{$name->cell_smart}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Cellphone (Globe)</label>
      <div class="form-control">{$name->cell_globe}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Cellphone (Sun)</label>
      <div class="form-control">{$name->cell_sun}</div>
    </div>
  </div>
</div>
HTML;
}

function social_media($name) { 
return <<<HTML
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Facebook ID</label>
      <div class="form-control">{$name->facebook_id}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Twitter ID</label>
      <div class="form-control">{$name->twitter_id}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Instagram ID</label>
      <div class="form-control">{$name->instagram_id}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Skype ID</label>
      <div class="form-control">{$name->skype_id}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Yahoo ID</label>
      <div class="form-control">{$name->yahoo_id}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Google ID</label>
      <div class="form-control">{$name->google_id}</div>
    </div>
  </div>
</div>

HTML;
}

function ids($name) { 
return <<<HTML
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Tax Identification Number (TIN)</label>
      <div class="form-control">{$name->tin}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>SSS Number</label>
      <div class="form-control">{$name->sss}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Pag-ibig (HDMF)</label>
      <div class="form-control">{$name->hdmf}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>PhilHealth</label>
      <div class="form-control">{$name->phic}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Driver's License</label>
      <div class="form-control">{$name->drivers_license}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Voter's Number</label>
      <div class="form-control">{$name->voters_number}</div>
    </div>
  </div>
</div>

HTML;
}

function emergency($name) { 
return <<<HTML
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Name</label>
      <div class="form-control">{$name->emergency_name}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Address</label>
      <div class="form-control">{$name->emergency_address}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Contact Number</label>
      <div class="form-control">{$name->emergency_contact}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Relationship</label>
      <div class="form-control">{$name->emergency_relationship}</div>
    </div>
  </div>
</div>

HTML;
}

function employment($employee) { 
  $date_hired = date('F d, Y', strtotime($employee->hired));
return <<<HTML
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Employee ID</label>
      <div class="form-control">{$employee->employee_id}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Date Hired</label>
      <div class="form-control">{$date_hired}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Dated Regularized</label>
      <div class="form-control">{$employee->area_name}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Status</label>
      <div class="form-control">{$employee->status_name}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Group</label>
      <div class="form-control">{$employee->group_name}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Position</label>
      <div class="form-control">{$employee->position_name}</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Area</label>
      <div class="form-control">{$employee->area_name}</div>
    </div>
  </div>

</div>
HTML;
}


?>
<?php if( isset($output) && ($output!='ajax') ) : ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>

<?php if( ($name->is_employed) && ($name->company_id==$this->session->userdata('current_company_id')) ) { ?>
<?php $this->load->view('lists/names/employed_navbar'); ?>
<?php } else { ?>
<?php $this->load->view('lists/lists_navbar'); ?>
<?php } ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
<?php endif; ?>
<?php endif; ?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<?php 

$modules = array();


$modules[] = array(
    'title'=>'Personal Information',
    'title_ajax'=>'Personal Information',
    'config_url' => site_url("lists_names/update_personal/{$name->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()),
    'panel_body' => personal_info($name),
    'open' => (($this->input->get('active')==='personal')||(!$this->input->get('active'))),
    );

if( ($name->is_employed) && ($name->company_id==$this->session->userdata('current_company_id')) ) { 
  $modules[] = array(
    'title'=>'Employment Information: <span class="badge">' . $name->company . '</span>',
    'title_ajax'=>'Employment Information',
    'config_url' => site_url("employees/edit_employment/{$name->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()),
    'panel_body' => employment($employee),
    'open' => ($this->input->get('active')==='employment'),
    );
}

$modules[] = array(
    'title'=>'Address &amp; Contact Numbers',
    'title_ajax'=>'Address &amp; Contact Numbers',
    'config_url' => site_url("lists_names/update_contacts/{$name->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()),
    'panel_body' => address_contacts($name),
    'open' => ($this->input->get('active')==='contacts'),
  );
$modules[] = array(
    'title'=>'Social Media Accounts',
    'title_ajax'=>'Social Media Accounts',
    'config_url' => site_url("lists_names/update_social_media/{$name->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()),
    'panel_body' => social_media($name),
    'open' => ($this->input->get('active')==='social_media'),
  );
$modules[] = array(
    'title'=>'Identification Numbers',
    'title_ajax'=>'Identification Numbers',
    'config_url' => site_url("lists_names/update_ids/{$name->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()),
    'panel_body' => ids($name),
    'open' => ($this->input->get('active')==='ids'),
  );
$modules[] = array(
    'title'=>'Emergency Contacts',
    'title_ajax'=>'Emergency Contacts',
    'config_url' => site_url("lists_names/update_emergency/{$name->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()),
    'panel_body' => emergency($name),
    'open' => ($this->input->get('active')==='emergency'),
  );
foreach($modules as $i=>$content) {  ?>
<div class="panel panel-default">
                <div class="panel-heading">
<?php if ( isset($output) && ($output=='ajax') ) {  ?>
                <a class="ajax-modal-inner pull-right" data-title="<?php echo strip_tags($content['title_ajax']); ?>" href="<?php echo $content['config_url']; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
<?php } else { ?>
                <a class="ajax-modal pull-right" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo strip_tags($content['title_ajax']); ?>" data-url="<?php echo $content['config_url']; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
<?php } ?>

                  <h3 class="panel-title bold">
<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                  <?php echo $content['title']; ?>
</a>
                  </h3>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php echo (isset($content['open'])&&($content['open'])) ? "in" : ""; ?>" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                <div class="panel-body">
                    <?php echo $content['panel_body']; ?>
                </div>
                </div>
              </div>
<?php } ?>

</div>

<?php if( isset($output) && ($output!='ajax') ) : ?>
<?php if( ! $inner_page ): ?>

            </div>
    </div>
</div>
<?php endif; ?>




<?php $this->load->view('footer'); ?>
<?php endif; ?>