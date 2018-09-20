<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">

<?php if( isset($no_inclusive_dates) ) { ?>
<div class="alert alert-danger" role="alert"><strong>ERROR FOUND!</strong> Inclusive dates not set! <a data-title="Inclusive Dates" class="btn btn-danger btn-xs ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-url="<?php echo site_url("payroll/inclusive_dates/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" >Fix This</a></div>
<?php } ?>
<?php if( !isset($no_inclusive_dates) ) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong> (<?php echo date( 'F d,Y', strtotime( $inclusive_dates->start_date ) ); ?> - <?php echo date( 'F d,Y', strtotime( $inclusive_dates->end_date ) ); ?>)
<a class="body_wrapper" href="<?php echo site_url("payroll_dtr/leave_benefits/{$payroll->id}/{$group_id}"); ?>"><small>Leave Benefits</small></a>
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Inclusive Dates" data-url="<?php echo site_url("payroll/inclusive_dates/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-calendar"></span></a>
<?php } ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php } ?>
<?php endif; ?>

<?php if( !isset($no_inclusive_dates) ) { ?>
<?php if( isset($payroll_groups) && $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>

          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_dtr/view/{$payroll->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></a>
<?php } else { ?>
  <?php 
  switch ($payroll->group_by) {
    case 'position':
      $filter_id = $payroll_group->position_id;
      break;
    case 'area':
      $filter_id = $payroll_group->area_id;
      break;
    case 'status':
      $filter_id = $payroll_group->status_id;
      break;
    case 'group':
    default:
      $filter_id = $payroll_group->group_id;
      break;
  }
  ?>
  <a href="<?php echo site_url("payroll_dtr/view/{$payroll->id}/{$filter_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
<?php } ?>
                <?php echo $payroll_group->name; ?>

<?php if(!$payroll->lock) { ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$payroll->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>
<?php } ?>

                </th>
                <th width="10%" class="text-right">Working Days</th>
                <th width="10%" class="text-right">Absences</th>
<?php foreach($leave_benefits as $leave) { ?>
                <th width="10%" class="text-right"><?php echo $leave->name; ?></th>
<?php } ?>
                <th width="10%" class="text-right">Days Present</th>
              </tr>
            </thead>
            <tbody>
 <?php if($payroll_group->employees) { ?>
<?php foreach($payroll_group->employees as $employee) {
$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
              ?>
              <tr>
                <td>

<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>

                <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 
                
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page&next=" . uri_string(); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

<?php if(!$payroll->lock) { ?>
                <a class="ajax-modal pull-right" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Employee Salary" data-url="<?php echo site_url("employees_salaries/ajax/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
<?php } ?>
                </td>


                <td class="text-right"><?php echo $inclusive_dates->working_days; ?></td>
                <td class="text-right">

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Inclusive Dates" data-url="<?php echo site_url("payroll_dtr/absences/{$payroll->id}/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">
                <?php echo $days_absent; ?>
</a>
                </td>

<?php foreach($leave_benefits as $leave) { 
$var1 = 'leave_' . $leave->id;

$leave_in_days = ($employee->$var1) ? ($employee->$var1 / $working_hours) : 0;

?>
                <td class="text-right">
<?php echo $leave_in_days; ?>
                </td>
<?php } ?>

                <td class="text-right"><?php $present_days = $inclusive_dates->working_days - $days_absent; echo $present_days; ?></td>
              </tr>
<?php } ?>
<?php } ?>
            </tbody>
          </table>

    <?php } ?>
<?php } else { ?>

  <div class="text-center">No Group Assigned!</div>

<?php } ?>
<?php } ?>
<?php if( ! $inner_page ): ?>

<?php if( !isset($no_inclusive_dates) ) { ?>
              </div>
              </div>
<?php } ?>
 
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>