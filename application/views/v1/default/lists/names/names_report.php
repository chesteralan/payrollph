<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME; ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
  </head>
  <body id="payroll_print">

<div class="print-topnav hide-print text-center allcaps">
  <a href="<?php echo site_url("lists_names"); ?>">Back</a>
</div>


<div class="header-title">
<h2 class="allcaps"><?php echo ((isset($company)) && ($company->name)) ? $company->name : 'Report'; ?></h2>
<h3><?php echo ((isset($company)) &&($company->address)) ? $company->address : ''; ?></h3>
<h3><?php echo ((isset($company)) &&($company->phone)) ? $company->phone : ''; ?></h3>
</div>

<div class="full-border padding3">
  <h3>NAMES REPORT</h3>
</div>


<table width="100%" cellspacing="0" cellpadding="0" class="table">
            <thead>
              <tr class="warning highlight allcaps">
                <th class="text-left allcaps">Last Name</th>
                <th class="text-left allcaps">First Name</th>
                <th class="text-left allcaps">Middle Name</th>
                <th class="text-left allcaps">Address</th>
                <th class="text-left allcaps">Phone Number</th>
                <th class="text-left allcaps">Smart</th>
                <th class="text-left allcaps">Globe</th>
                <th class="text-left allcaps">Sun</th>
                <th class="text-left allcaps">Company</th>
              </tr>
            </thead>
            <tbody>
<?php foreach($names as $name) { 
if( $name->ni_name_id=='' ) {
  continue;
}
  ?>
              <tr>
                <td><?php echo $name->lastname; ?></td>
                <td><?php echo $name->firstname; ?></td>
                <td><?php echo $name->middlename; ?></td>
                <td><?php echo $name->meta_address; ?></td>
                <td><?php echo $name->meta_phone_number; ?></td>
                <td><?php echo $name->meta_cell_smart; ?></td>
                <td><?php echo $name->meta_cell_globe; ?></td>
                <td><?php echo $name->meta_cell_sun; ?></td>
                <td><?php echo $name->company; ?></td>
              </tr>
<?php } ?>
            </tbody>
</table>



  </body>
</html>
