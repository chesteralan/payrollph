<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_by_name_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<!-- Single button -->
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Filter by Year <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
   <li><a href="<?php echo site_url(uri_string()) ?>">Show All</a></li>
<?php foreach($years as $year) {  ?>
    <li><a href="<?php echo site_url(uri_string()) . "?filter_by_year=" . $year->year; ?>"><?php echo $year->year; ?></a></li>
<?php } ?>
  </ul>
</div>

                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payrolls ) { ?>

 <table class="table table-default table-hover">
            <thead>
              <tr class="warning">
                <th>Payroll</th>
                <th width="10%" class="text-right">Rate per day</th>
                <th width="10%" class="text-right">Basic Salary</th>
                <th width="10%" class="text-right">COLA</th>
                <th width="10%" class="text-right">Absences</th>
                <th width="10%" class="text-right">Gross Salary</th>
              </tr>
            </thead>
            <tbody>
<?php foreach($payrolls as $payroll) {  ?>
<?php 
$working_hours = ($payroll->hours) ? $payroll->hours : 8;
$days_absent = ($payroll->absences_hours) ? ($payroll->absences_hours / $working_hours) : 0;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola_rate = 0;

  switch( $payroll->rate_per ) {
    case 'month':
      $monthly_rate = $payroll->amount;
      $daily_rate = ( ($payroll->amount * $payroll->months) / $payroll->annual_days );
      $hourly_rate = ( (($payroll->amount * $payroll->months) / $payroll->annual_days) / $payroll->hours );
    break;
    case 'day':
      $monthly_rate = ( $payroll->amount * $payroll->days );
      $daily_rate = $payroll->amount;
      $hourly_rate = ( $payroll->amount / $payroll->hours );
    break;
    case 'hour':
      $monthly_rate = ( $payroll->amount * $payroll->days * $payroll->hours );
      $daily_rate = ( $payroll->amount * $payroll->hours );
      $hourly_rate = $payroll->amount;
    break;
  }
  $cola_rate = (isset($payroll)) ? $payroll->cola : 0;
$present_days = $payroll->working_days - $days_absent;
$absences = $days_absent * $daily_rate;
$basic_salary = ($monthly_rate / 2); 
$cola = ($cola_rate * $present_days);
$employee_gross_pay = (($basic_salary + $cola) - $absences);
?>
  <tr>
        <td>
        <a class="body_wrapper" href="<?php echo site_url("payroll_salaries/view/{$payroll->payroll_id}/0"); ?>">
        <?php echo $payroll->name; ?>
        </a>
        </td>
        <td class="text-right"><?php echo number_format($daily_rate,2); ?></td>
                <td class="text-right"><?php echo number_format($basic_salary,2); ?></td>
                <td class="text-right"><?php echo number_format($cola,2); ?></td>
                <td class="text-right">(<?php echo number_format($absences,2); ?>)</td>
                <td class="text-right"><?php echo number_format($employee_gross_pay,2); ?></td>
  </tr>
<?php } ?>
            </tbody>
            </table>

            <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Payroll Found!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>