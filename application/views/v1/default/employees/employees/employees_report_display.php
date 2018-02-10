<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$columns = array(
  'info' => array(
        'title' => 'Personal Information', 
        'items' => array(
          'lastname' => array('name'=>'Last Name','field'=>'lastname'),
          'firstname' => array('name'=>'First Name','field'=>'firstname'),
          'middlename' => array('name'=>'Middle Name','field'=>'middlename'),
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
/*
  'social_media' => array(
        'title' => 'Social Media Accounts', 
        'items' => array(
          'sm_facebook' => array('name'=>'Facebook ID','field'=>''),
          'sm_twitter' => array('name'=>'Twitter ID','field'=>''),
          'sm_instagram' => array('name'=>'Instagram ID','field'=>''),
          'sm_skype' => array('name'=>'Skype ID','field'=>''),
          'sm_yahoo' => array('name'=>'Yahoo ID','field'=>''),
          'sm_google' => array('name'=>'Google ID','field'=>''),
          )),
  'idn' => array(
        'title' => 'Identification Numbers', 
        'items' => array(
          'idn_tin' => array('name'=>'Tax Identification Number (TIN)','field'=>''),
          'idn_sss' => array('name'=>'SSS Number','field'=>''),
          'idn_hdmf' => array('name'=>'Pag-ibig (HDMF)','field'=>''),
          'idn_phic' => array('name'=>'PhilHealth','field'=>''),
          'idn_driver' => array('name'=>'Driver\'s License','field'=>''),
          'idn_voter' => array('name'=>'Voter\'s Number','field'=>''),
          )),
  'emergency' => array(
        'title' => 'Emergency Contacts', 
        'items' => array(
          'emergency_name' => array('name'=>'Name','field'=>''),
          'emergency_address' => array('name'=>'Address','field'=>''),
          'emergency_number' => array('name'=>'Contact Number','field'=>''),
          'emergency_rel' => array('name'=>'Relationship','field'=>''),
          )),
*/
  ) ;
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
<?php foreach($columns as $col_id=>$column) { ?>
                <th class="text-center" colspan="<?php echo count($column['items']); ?>"><?php echo $column['title']; ?></th>
<?php } ?>
 </tr>

 <tr>
<?php foreach($columns as $col_id=>$column) { ?>
<?php foreach($column['items'] as $fld_id=>$fld) { ?>
                <th class="text-center"><?php echo $fld['name']; ?></th>
             
<?php } ?>
<?php } ?>
 </tr>
            </thead>
            <tbody>
<?php foreach($employees as $employee) { ?>
 <tr>
<?php foreach($columns as $col_id=>$column) { ?>
<?php foreach($column['items'] as $fld_id=>$fld) { ?>
                <?php echo '<td>'.$employee->$fld['field'].'</td>';  ?>
<?php } ?>
<?php } ?>
 </tr>
<?php } ?>

            </tbody>
          </table>

<?php } else { ?>

  <div class="text-center">No Employee Selected!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>