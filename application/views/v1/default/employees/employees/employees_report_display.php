<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$default_columns = array('lastname', 'firstname', 'middlename');
$columns = array(
  'info' => array(
        'title' => 'Personal Information', 
        'items' => array(
          'lastname' => array('name'=>'Last Name','field'=>'lastname', 'align'=>'left'),
          'firstname' => array('name'=>'First Name','field'=>'firstname', 'align'=>'left'),
          'middlename' => array('name'=>'Middle Name','field'=>'middlename', 'align'=>'left'),
          'birthday' => array('name'=>'Birth Day','field'=>'birthday'),
          'birthplace' => array('name'=>'Birth Place','field'=>'birthplace'),
          'age' => array('name'=>'Age','field'=>'age'),
          'civil_status' => array('name'=>'Status','field'=>'civil_status'),
          'gender' => array('name'=>'Gender','field'=>'gender'),
          )),
  'employment' => array(
        'title' => 'Employment Information', 
        'items' => array(
          'emp_id' => array('name'=>'Employee ID','field'=>'employee_id'),
          'emp_hired' => array('name'=>'Date Hired','field'=>'hired'),
          'emp_status' => array('name'=>'Status','field'=>'status_name'),
          'emp_group' => array('name'=>'Group','field'=>'group_name'),
          'emp_position' => array('name'=>'Position','field'=>'position_name'),
          'emp_area' => array('name'=>'Area','field'=>'area_name'),
          )),
  'contacts' => array(
        'title' => 'Address & Contact Numbers', 
        'items' => array(
          'contact_address' => array('name'=>'Postal Address','field'=>'address'),
          'contact_email' => array('name'=>'Email Address','field'=>'email'),
          'contact_phone' => array('name'=>'Phone Number','field'=>'phone_number'),
          'contact_smart' => array('name'=>'Cellphone (Smart)','field'=>'cell_smart'),
          'contact_globe' => array('name'=>'Cellphone (Globe)','field'=>'cell_globe'),
          'contact_sun' => array('name'=>'Cellphone (Sun)','field'=>'cell_sun'),
          )),

  'social_media' => array(
        'title' => 'Social Media Accounts', 
        'items' => array(
          'sm_facebook' => array('name'=>'Facebook ID','field'=>'facebook_id'),
          'sm_twitter' => array('name'=>'Twitter ID','field'=>'twitter_id'),
          'sm_instagram' => array('name'=>'Instagram ID','field'=>'instagram_id'),
          'sm_skype' => array('name'=>'Skype ID','field'=>'skype_id'),
          'sm_yahoo' => array('name'=>'Yahoo ID','field'=>'yahoo_id'),
          'sm_google' => array('name'=>'Google ID','field'=>'google_id'),
          )),

  'idn' => array(
        'title' => 'Identification Numbers', 
        'items' => array(
          'idn_tin' => array('name'=>'Tax Identification Number (TIN)','field'=>'tin'),
          'idn_sss' => array('name'=>'SSS Number','field'=>'sss'),
          'idn_hdmf' => array('name'=>'Pag-ibig (HDMF)','field'=>'hdmf'),
          'idn_phic' => array('name'=>'PhilHealth','field'=>'phic'),
          'idn_driver' => array('name'=>'Driver\'s License','field'=>'drivers_license'),
          'idn_voter' => array('name'=>'Voter\'s Number','field'=>'voters_number'),
          )),

  'emergency' => array(
        'title' => 'Emergency Contacts', 
        'items' => array(
          'emergency_name' => array('name'=>'Name','field'=>'emergency_name'),
          'emergency_address' => array('name'=>'Address','field'=>'emergency_address'),
          'emergency_number' => array('name'=>'Contact Number','field'=>'emergency_contact'),
          'emergency_rel' => array('name'=>'Relationship','field'=>'emergency_relationship'),
          )),

  ) ;

$selected_columns = array_merge($default_columns, (($this->input->get('columns'))?$this->input->get('columns'):array()));
?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<div class="row">
<div class="col-md-12">

                  <h3 class="panel-title">
                    <a class="pull-right" href="<?php echo site_url("employees/report/download") . "?" . http_build_query($this->input->get()); ?>"><span class="fa fa-file-excel-o"></span></a>
                    <a style="margin-right: 10px;" class="ajax-modal pull-right" data-toggle="modal" data-target="#ajaxModal" href="#ajaxModal" data-title="Options" data-url="<?php echo site_url("employees/report/config/ajax") . "?" . http_build_query($this->input->get()); ?>"><span class="glyphicon glyphicon-cog"></span></a>
                    <strong>Employees Report</strong>
                  </h3>
</div>
</div>

                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( isset($employees) && ($employees) ) { ?>

          <table class="table table-default table-hover">
            <thead>
<tr>
<?php foreach($columns as $col_id=>$column) { 
$display_col = 0;
?>
<?php foreach($column['items'] as $fld_id=>$fld) { ?>
<?php 
if( in_array($fld_id, $selected_columns)) { $display_col++; } ?>
<?php } ?>
<?php if( $display_col ) { ?>
    <th class="text-center" colspan="<?php echo $display_col; ?>"><?php echo $column['title']; ?></th>
<?php } ?>
<?php } ?>
 </tr>

 <tr>
<?php foreach($columns as $col_id=>$column) { ?>
<?php foreach($column['items'] as $fld_id=>$fld) { ?>
<?php if( in_array($fld_id, $selected_columns)) { ?>
                <th class="text-<?php echo ((isset($fld['align']))?$fld['align']:'center'); ?>"><?php echo $fld['name']; ?></th>
<?php } ?>
<?php } ?>
<?php } ?>
 </tr>
            </thead>
            <tbody>
<?php foreach($employees as $employee) { ?>
 <tr>
<?php foreach($columns as $col_id=>$column) { ?>
<?php foreach($column['items'] as $fld_id=>$fld) { ?>
<?php if( in_array($fld_id, $selected_columns)) { ?>
                <?php echo '<td class="text-'.((isset($fld['align']))?$fld['align']:'center').'">'.$employee->$fld['field'].'</td>';  ?>
<?php } ?>
<?php } ?>
<?php } ?>
 </tr>
<?php } ?>

            </tbody>
          </table>

<?php } else { ?>

  <div class="text-center">No Employee Selected!
<br><a class="ajax-modal btn btn-warning btn-xs" data-toggle="modal" data-target="#ajaxModal" href="#ajaxModal" data-title="Options" data-url="<?php echo site_url("employees/report/config/ajax") . "?" . http_build_query($this->input->get()); ?>"><span class="glyphicon glyphicon-cog"></span> Update Options</a>
  </div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>