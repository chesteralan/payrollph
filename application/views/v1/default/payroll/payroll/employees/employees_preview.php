<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$payslip_templates = array(
  'none' => 'No Payslip',
  'payslip' => 'Payslip (1/4)',
  'payslip2' => 'Payslip (1/2)',
  'payslip3' => 'Payslip (1/2) v2',
  'cash_voucher' => 'Cash Voucher',
  'clergy_allowance' => 'Clergy Allowance',
);
?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/template_preview_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Employee Groups" data-url="<?php echo site_url("payroll_templates/groups/{$template->id}/ajax") . "?next=" . uri_string(); ?>"><span class="fa fa-users"></span></a>

                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>
 <?php if($payroll_group->employees) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_employees/preview/{$template->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></span></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_employees/preview/{$template->id}/{$payroll_group->group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
<?php } ?>
                <?php echo $payroll_group->name; ?>

<?php if( !$this->session->userdata('current_employee') ) { ?>
 <a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$template->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>

                </th>

                <th width="12%" class="text-right">Status</th>
                <th width="12%" class="text-right">Group</th>
                <th width="12%" class="text-right">Position</th>
                <th width="12%" class="text-right">Area</th>
                <th width="12%" class="text-right">Payslip</th>
                <th width="12%" class="text-right">Print Group</th>
              </tr>
            </thead>
            <tbody>
            
<?php foreach($payroll_group->employees as $employee) { 


              ?>
              <tr>
                <td>

                <a class="confirm" href="<?php echo site_url("payroll_employees/deactivate/{$template->id}/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-remove"></span></a>

                <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 
                
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page"; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>


                </td>

                <td class="text-right">

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Status" data-url="<?php echo site_url("payroll_templates/change_status/{$template->id}/{$employee->name_id}/ajax") . "?next=" .uri_string(); ?>">

                <?php echo ($employee->status_name) ? $employee->status_name : '- - - - -'; ?>

</a>

                </td>
                <td class="text-right">

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Group" data-url="<?php echo site_url("payroll_templates/change_group/{$template->id}/{$employee->name_id}/ajax") . "?next=" .uri_string(); ?>">

                <?php echo ($employee->group_name) ? $employee->group_name : '- - - - -'; ?>

</a>

                </td>
                <td class="text-right">

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Position" data-url="<?php echo site_url("payroll_templates/change_position/{$template->id}/{$employee->name_id}/ajax") . "?next=" .uri_string(); ?>">

                <?php echo ($employee->position_name) ? $employee->position_name : '- - - - -'; ?>

</a>

                </td>
                <td class="text-right">

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Area" data-url="<?php echo site_url("payroll_templates/change_area/{$template->id}/{$employee->name_id}/ajax") . "?next=" .uri_string(); ?>">

                <?php echo ($employee->area_name) ? $employee->area_name : '- - - - -'; ?>

</a>

                </td>
                <td class="text-right">
               
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Template" data-url="<?php echo site_url("payroll_templates/change_payslip/{$template->id}/{$employee->name_id}/ajax") . "?next=" .uri_string(); ?>">

                <?php echo ($employee->template) ? $payslip_templates[$employee->template] : '- - - - -'; ?>

</a>

                </td>
                <td class="text-right">

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Print Group" data-url="<?php echo site_url("payroll_templates/change_print_group/{$template->id}/{$employee->name_id}/ajax") . "?next=" .uri_string(); ?>">

                <?php echo ($employee->print_group_name) ? $employee->print_group_name : '- - - - -'; ?>

</a>

                </td>
              </tr>
<?php } ?>

            </tbody>
          </table>
<?php } ?>
    <?php } ?>


<?php } else { ?>

  <div class="text-center">No Group Assigned!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>