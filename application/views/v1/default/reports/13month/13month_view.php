<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('reports/reports_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<div class="row">
<div class="col-md-12 col-sm-12">

<?php if( isset($payroll_years) && ( count( $payroll_years ) > 1) ) { ?>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo ($filter_year) ? $filter_year : "Filter by Year"; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <?php foreach($payroll_years as $year) { ?>
      <li><a href="<?php echo site_url("reports_13month/index/{$year->year}"); ?>"><?php echo $year->year; ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
                    <h3 class="panel-title bold"><?php echo $current_page; ?>
                    
                    <span class="badge"><?php echo $filter_year; ?></span>
                   
          </h3>
</div>
</div>

                 
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>

<?php if( $employees ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th class="text-right">Amount</th>
              </tr>
            </thead>
            <tbody>

            <?php foreach($employees as $employee) { ?>
              <tr id="employee-<?php echo $employee->name_id; ?>">
                <td><?php echo $employee->lastname; ?></td>
                <td><?php echo $employee->firstname; ?></td>
                <td><?php echo $employee->middlename; ?></td>
                <td class="text-right"><?php echo number_format($employee->net_salary,2); ?></td>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Employee Found!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>