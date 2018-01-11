<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_by_name_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<div class="btn-group pull-right">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo ($this->input->get('filter_by_year')) ? $this->input->get('filter_by_year') : 'Filter by Year'; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
<?php if($this->input->get('filter_by_year')) { ?>
  <li><a href="<?php echo site_url(uri_string()) ?>">Show All</a></li>
<?php } ?>
<?php foreach($years as $year) { 
  if($this->input->get('filter_by_year')==$year->year) {
    continue;
  }
  ?>
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
                <th width="10%" class="text-right">Working Days</th>
                <th width="10%" class="text-right">Absences</th>
                <th width="10%" class="text-right">Days Present</th>
              </tr>
            </thead>
            <tbody>
<?php foreach($payrolls as $payroll) {  ?>
<?php 
$working_hours = ($payroll->hours) ? $payroll->hours : 8;
$days_absent = ($payroll->absences_hours) ? ($payroll->absences_hours / $working_hours) : 0;
?>
  <tr>
        <td>
        <a class="body_wrapper" href="<?php echo site_url("payroll_dtr/view/{$payroll->payroll_id}/0"); ?>">
        <?php echo $payroll->name; ?>
        </a>
        </td>
        <td class="text-right"><?php echo $payroll->working_days; ?></td>
        <td class="text-right"><?php echo $days_absent; ?></td>
        <td class="text-right"><?php echo $payroll->working_days - $days_absent; ?></td>
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