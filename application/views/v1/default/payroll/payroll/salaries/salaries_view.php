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
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
<?php if(!$payroll->lock) { ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Employee Groups" data-url="<?php echo site_url("payroll/groups/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
<?php } ?>
<?php } ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php } ?>

<?php endif; ?>

<?php if( !isset($no_inclusive_dates) ) { ?>

<?php 
$total_basic_salary = 0; 
$total_absences = 0;
$total_net_pay = 0; 
$total_overtime = 0; 
$total_leave_benefits = 0; 
$total_gross_pay = 0; 
?>

<?php if( $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>
 
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>

<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_salaries/view/{$payroll->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></span></a>
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

  <a href="<?php echo site_url("payroll_salaries/view/{$payroll->id}/{$filter_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
<?php } ?>

                <?php echo $payroll_group->name; ?>

<?php if(!$payroll->lock) { ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$payroll->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>
                </th>
<?php } ?>

                <th width="10%" class="text-right">Rate per day</th>
                <th width="10%" class="text-right">Basic Salary</th>
                <th width="10%" class="text-right">COLA</th>
                <th width="10%" class="text-right">Absences</th>
                <th width="10%" class="text-right">Net Salary</th>
                <th width="10%" class="text-right">Overtime</th>
                <!--<th width="10%" class="text-right">Leave Benefits</th>-->
                <th width="10%" class="text-right">Gross Salary</th>
              </tr>
            </thead>
            <tbody>
<?php if($payroll_group->employees) { ?>
<?php foreach($payroll_group->employees as $employee) { 

$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
$days_benefits = ($employee->leave_benefits) ? ($employee->leave_benefits / $working_hours) : 0;
$days_present = ($employee->attendance_hours) ? ($employee->attendance_hours / $working_hours) : 0;
$days_overtime = ($employee->overtime) ? (($employee->overtime / 60) / $working_hours) : 0;

if( $employee->pe_presence ) {
  $present_days = $employee->attendance;
} else {
  $present_days = ($inclusive_dates->working_days - $days_absent) + $days_overtime;
}
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola_rate = 0;
$absences = 0;
$basic_salary = 0;
$addon_benefits = 0;
$overtime = 0;

if( $employee->salary ) {
  $salary = $employee->salary;
  switch( $salary->rate_per ) {
    case 'month':
      $monthly_rate = $salary->amount;
      $daily_rate = ( ($salary->amount * $salary->months) / $salary->annual_days );
      $hourly_rate = ( (($salary->amount * $salary->months) / $salary->annual_days) / $salary->hours );
    break;
    case 'day':
      $monthly_rate = ( $salary->amount * $salary->days );
      $daily_rate = $salary->amount;
      $hourly_rate = ( $salary->amount / $salary->hours );
    break;
    case 'hour':
      $monthly_rate = ( $salary->amount * $salary->days * $salary->hours );
      $daily_rate = ( $salary->amount * $salary->hours );
      $hourly_rate = $salary->amount;
    break;
  }
  $cola_rate = (isset($salary)) ? $salary->cola : 0;
  $absences = $days_absent * $daily_rate;
  $overtime = $days_overtime * $daily_rate;
  //$addon_benefits = $days_benefits * $daily_rate;

  if( $employee->pe_presence ) {
    switch( $salary->manner ) {
        case 'hourly':
          $basic_salary = ($hourly_rate * $days_present); 
        break;
        case 'daily':
          $basic_salary = ($daily_rate * $present_days); 
        break;
        case 'semi-monthly':
          $basic_salary = ($daily_rate * $present_days); 
        break;
        default:
        case 'monthly':
          $basic_salary = ($daily_rate * $present_days); 
        break;
    }
  } else {
    switch( $salary->manner ) {
        case 'hourly':
          $basic_salary = ($hourly_rate * $inclusive_dates->working_days * $salary->hours); 
        break;
        case 'daily':
          $basic_salary = ($daily_rate * $inclusive_dates->working_days); 
        break;
        case 'semi-monthly':
          $basic_salary = ($daily_rate * $salary->days) / 2; 
        break;
        default:
        case 'monthly':
          $basic_salary = ($daily_rate * $salary->days); 
        break;
    }
  }
}

$total_absences += $absences;
$total_leave_benefits += $addon_benefits;

$total_basic_salary += $basic_salary;
$cola = ($cola_rate * $present_days);
$employee_net_pay = (($basic_salary + $cola) - $absences);
$total_net_pay += $employee_net_pay; 
$total_overtime += $overtime; 
$employee_gross_pay = $employee_net_pay + $addon_benefits + $overtime;
$total_gross_pay += $employee_gross_pay; 

?>
              <tr class="<?php echo ($employee->manual)?'info':''; ?>">
                <td>
<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page"; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

<?php if(!$payroll->lock) { ?>
<?php if(!$employee->manual) { ?>

                <a href="<?php echo site_url("employees_salaries/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper pull-right"><span class="glyphicon glyphicon-cog"></span></a>

<?php } ?>
<?php } ?>
                </td>


                <td class="text-right"><?php echo number_format($daily_rate,2); ?></td>
                <td class="text-right">
<?php if(!$payroll->lock) { ?>
                <a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Basic Salary" data-url="<?php echo site_url("payroll_salaries/".(($employee->salary)?'entry':'add_entry')."/{$payroll->id}/{$employee->pe_id}/ajax") . "?next=" . uri_string(); ?>">
<?php } ?>
                <?php echo number_format($basic_salary,2); ?>
<?php if(!$payroll->lock) { ?>
                </a>
<?php } ?>

                </td>
                <td class="text-right"><?php echo number_format($cola,2); ?></td>
                <td class="text-right">(<?php echo number_format($absences,2); ?>)</td>
                <td class="text-right"><?php echo number_format($employee_net_pay,2); ?></td>
                <td class="text-right"><?php echo number_format($overtime,2); ?></td>
                <!--<td class="text-right"><?php echo number_format($addon_benefits,2); ?></td>-->
                <td class="text-right"><?php echo number_format($employee_gross_pay,2); ?></td>
              </tr>
<?php } ?>
<?php } ?>
            </tbody>
          </table>

    <?php } ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
    <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>TOTAL</th>
                <th width="10%" class="text-right"></th>
                <th width="10%" class="text-right">Basic Salary</th>
                <th width="10%" class="text-right">COLA</th>
                <th width="10%" class="text-right">Absences</th>
                <th width="10%" class="text-right">Net Salary</th>
                <th width="10%" class="text-right">Overtime</th>
                <!--<th width="10%" class="text-right">Leave Benefits</th>-->
                <th width="10%" class="text-right">Gross Salary</th>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
                <td></td>
                <td class="text-right"></td>
                <td class="text-right"><strong><?php echo number_format($total_basic_salary,2); ?></strong></td>
                <td class="text-right"></td>
                <td class="text-right"><strong>(<?php echo number_format($total_absences,2); ?>)</strong></td>
                <td class="text-right"><strong><?php echo number_format($total_net_pay,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_overtime,2); ?></strong></td>
                <!--<td class="text-right"><strong><?php echo number_format($total_leave_benefits,2); ?></strong></td>-->
                <td class="text-right"><strong><?php echo number_format($total_gross_pay,2); ?></strong></td>
  </tr>
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