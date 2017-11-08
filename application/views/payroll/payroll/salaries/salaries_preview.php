<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/template_preview_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php 
$total_basic_salary = 0; 
$total_absences = 0;
$total_gross_pay = 0; 
?>

<?php if( $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>
   <?php if($payroll_group->employees) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_salaries/preview/{$template->id}"); ?>" class="glyphicon glyphicon-arrow-left body_wrapper"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_salaries/preview/{$template->id}/{$payroll_group->group_id}"); ?>" class="glyphicon glyphicon-filter body_wrapper"></a>
<?php } ?>
                <?php echo $payroll_group->name; ?>

<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll_templates/employees/{$template->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
</th>

                <th width="10%" class="text-right">Rate per day</th>
                <th width="10%" class="text-right">Basic Salary</th>
                <th width="10%" class="text-right">COLA</th>
                <th width="10%" class="text-right">Gross Pay</th>
              </tr>
            </thead>
            <tbody>
            
<?php if($payroll_group->employees) { 
              foreach($payroll_group->employees as $employee) {
$working_hours = 8;
$days_absent = 0;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
if( $employee->salary ) {
  $salary = $employee->salary;
  switch( $salary->rate_per ) {
    case 'month':
      $monthly_rate = $salary->amount;
      $daily_rate = ( $salary->amount / $salary->days );
      $hourly_rate = ( $salary->amount / $salary->days / $salary->hours );
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
}
$cola_rate = (isset($salary)) ? $salary->cola : 0;
$present_days = (isset($salary)) ? ceil($salary->days / 2) : 0;
$basic_salary = ($daily_rate * $present_days); 
$total_basic_salary += $basic_salary;
$cola = ($cola_rate * $present_days);
$employee_gross_pay = ($basic_salary + $cola);
$total_gross_pay += $employee_gross_pay; 
              ?>
              <tr>
                <td>
                  
<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>

                  <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> (<?php echo $employee->position; ?>)
                <a href="<?php echo site_url("employees_salaries/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper pull-right"><span class="glyphicon glyphicon-cog"></span></a>

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page"; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

                </td>


                <td class="text-right"><?php echo number_format($daily_rate,2); ?></td>
                <td class="text-right"><?php echo number_format($basic_salary,2); ?></td>
                <td class="text-right"><?php echo number_format($cola,2); ?></td>
                <td class="text-right"><?php echo number_format($employee_gross_pay,2); ?></td>
              </tr>
<?php         } 
      } ?>

            </tbody>
          </table>

    <?php } ?>
    <?php } ?>

    <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>TOTAL</th>
                <th width="10%" class="text-right"></th>
                <th width="10%" class="text-right">Basic Salary</th>
                <th width="10%" class="text-right">COLA</th>
                <th width="10%" class="text-right">Gross Pay</th>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
                <td></td>
                <td class="text-right"></td>
                <td class="text-right"><strong><?php echo number_format($total_basic_salary,2); ?></strong></td>
                <td class="text-right"></td>
                <td class="text-right"><strong><?php echo number_format($total_gross_pay,2); ?></strong></td>
  </tr>
            </tbody>
            </table>

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