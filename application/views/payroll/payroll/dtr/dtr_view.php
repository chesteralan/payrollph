<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong> (<?php echo date( 'F d,Y', strtotime( $inclusive_dates->start_date ) ); ?> - <?php echo date( 'F d,Y', strtotime( $inclusive_dates->end_date ) ); ?>)
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Employee Groups" data-url="<?php echo site_url("payroll/groups/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>
 
          <table class="table table-default" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th><?php echo $payroll_group->name; ?></th>
                <th width="10%" class="text-right">Working Days</th>
                <th width="10%" class="text-right">Absenses</th>
                <th width="10%" class="text-right">Days Present</th>
              </tr>
            </thead>
            <tbody>
            
<?php if($payroll_group->employees) {
              foreach($payroll_group->employees as $employee) {
                $days_absent = ($employee->absenses_hours) ? ($employee->absenses_hours /$employee->working_hours) : 0;
              ?>
              <tr>
                <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> (<?php echo $employee->position; ?>)
                <a href="<?php echo site_url("employees_salaries/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper"><span class="glyphicon glyphicon-cog"></span></a>
                </td>
                <td class="text-right"><?php echo $inclusive_dates->working_days; ?></td>
                <td class="text-right">
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Employee Attendance" data-url="<?php echo site_url("payroll_dtr/absenses/{$payroll->id}/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">
                <?php echo number_format($days_absent,2,".",""); ?>
</a>
                </td>
                <td class="text-right"><?php $present_days = $inclusive_dates->working_days - $days_absent; echo $present_days; ?></td>
              </tr>
<?php         
  } 
      } ?>

            </tbody>
          </table>

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