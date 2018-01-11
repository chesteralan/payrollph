<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<a href="<?php echo site_url("employees_salaries/view/{$employee->name_id}"); ?>" class="btn btn-warning btn-xs pull-right body_wrapper">Back</a>

                  <h3 class="panel-title bold">
                  <?php echo $current_page; ?> - Trash Bin
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $salaries ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Monthly Rate</th>
                <th>COLA</th>
                <th>Days / Month</th>
                <th>Hours / Day</th>
                <th>Daily Rate</th>
                <th>Hourly Rate</th>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="200px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($salaries as $salary) { 
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
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
              ?>
              <tr id="salary-<?php echo $salary->id; ?>" class="<?php echo ($salary->primary==1) ? 'success' : ''; ?>">
                <td><?php echo number_format($monthly_rate,2); ?></td>
                <td><?php echo number_format($salary->cola,2); ?></td>
                <td><?php echo $salary->days; ?></td>
                <td><?php echo $salary->hours; ?></td>
                <td><?php echo number_format($daily_rate,2); ?></td>
                <td><?php echo number_format($hourly_rate,2); ?></td>
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>

                <a class="btn btn-info btn-xs confirm_remove" href="<?php echo site_url("employees_salaries/restore/{$salary->id}"); ?>" data-target="#salary-<?php echo $salary->id; ?>">Restore</a>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_salaries/delete/{$salary->id}"); ?>" data-target="#salary-<?php echo $salary->id; ?>">Delete Permanently</a>

                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Basic Salary Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>