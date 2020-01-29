<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configure Employee</h3>
        </div>
<form method="get" action="<?php echo site_url("lists_names/report/display"); ?>">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<input type="hidden" name="print" value="report" />
<!--
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOptions">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOptions" aria-expanded="false" aria-controls="collapseOptions">
          Options
        </a>
      </h4>
    </div>
    <div id="collapseOptions" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOptions">
      <div class="panel-body">
      </div>
    </div>
  </div>
-->
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Columns
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">


<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">

<?php 
$default_checked = array('name_id','lastname', 'firstname', 'middlename');
$columns = array(
  'info' => array(
        'title' => 'Personal Information', 
        'items' => array(
          'name_id' => 'Name ID',
          'lastname' => 'Last Name',
          'firstname' => 'First Name',
          'middlename' => 'Middle Name',
          'birthday' => 'Birth Day',
          'birthplace' => 'Birth Place',
          'age' => 'Age',
          'civil_status' => 'Status',
          'gender' => 'Gender',
          )),
  'employment' => array(
        'title' => 'Employment Information', 
        'items' => array(
          'emp_id' => 'Employee ID',
          'emp_hired' => 'Date Hired',
          'emp_status' => 'Status',
          'emp_group' => 'Group',
          'emp_position' => 'Position',
          'emp_area' => 'Area',
          )),
  'contacts' => array(
        'title' => 'Address & Contact Numbers', 
        'items' => array(
          'contact_address' => 'Postal Address',
          'contact_email' => 'Email Address',
          'contact_phone' => 'Phone Number',
          'contact_smart' => 'Cellphone (Smart)',
          'contact_globe' => 'Cellphone (Globe)',
          'contact_sun' => 'Cellphone (Sun)',
          )),
  'social_media' => array(
        'title' => 'Social Media Accounts', 
        'items' => array(
          'sm_facebook' => 'Facebook ID',
          'sm_twitter' => 'Twitter ID',
          'sm_instagram' => 'Instagram ID',
          'sm_skype' => 'Skype ID',
          'sm_yahoo' => 'Yahoo ID',
          'sm_google' => 'Google ID',
          )),
  'idn' => array(
        'title' => 'Identification Numbers', 
        'items' => array(
          'idn_tin' => 'Tax Identification Number (TIN)',
          'idn_sss' => 'SSS Number',
          'idn_hdmf' => 'Pag-ibig (HDMF)',
          'idn_phic' => 'PhilHealth',
          'idn_driver' => 'Driver\'s License',
          'idn_voter' => 'Voter\'s Number',
          )),
  'emergency' => array(
        'title' => 'Emergency Contacts', 
        'items' => array(
          'emergency_name' => 'Name',
          'emergency_address' => 'Address',
          'emergency_number' => 'Contact Number',
          'emergency_rel' => 'Relationship',
        )),
  );
  $selected_columns = array_merge($default_checked, (($this->input->get('columns'))? $this->input->get('columns') : array()) );
  $selected_employees = ($this->input->get('employee')) ? $this->input->get('employee') : array();
  
foreach($columns as $accordion2_id=>$accordion2) { ?>

    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <input type="checkbox" data-class="<?php echo $accordion2_id; ?>-checkbox" class="pull-right select_all_by_class">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse_<?php echo $accordion2_id; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $accordion2_id; ?>">
          <?php echo $accordion2['title']; ?>
        </a>
      </h4>
    </div>
    <div id="collapse_<?php echo $accordion2_id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
<div class="list-group">
        <?php foreach($accordion2['items'] as $cid=>$cname) { ?>
          <label class="list-group-item">
            <input class="<?php echo $accordion2_id; ?>-checkbox" type="checkbox" name="columns[]" value="<?php echo $cid; ?>" <?php echo (in_array($cid, $selected_columns)) ? 'CHECKED' : ''; ?> <?php echo (in_array($cid, $default_checked)) ? 'DISABLED' : ''; ?>>
            <?php echo $cname; ?>
          </label>
        <?php } ?>
      </div>

      </div>
    </div>
  </div>

<?php } ?>

  </div>

      </div>
    </div>
  </div>



</div>

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