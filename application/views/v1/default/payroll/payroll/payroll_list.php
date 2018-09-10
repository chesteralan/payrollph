<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('payroll', 'payroll', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Payroll" data-url="<?php echo site_url("payroll/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Create Payroll</button>
<?php } ?>
                 <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
                    <?php if(isset($template)) { ?>
                      : <?php echo $template->name; ?>
                    <?php } ?>

<?php if( isset($payroll_years) && ( count( $payroll_years ) > 0) ) { ?>
<div class="btn-group">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo ($filter_year) ? $filter_year : "Filter by Year"; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
      <li><a href="<?php echo site_url("payroll/index/0/{$filter_month}/{$filter_template}"); ?>">Show All</a></li>
    <?php foreach($payroll_years as $year) { ?>
      <li><a href="<?php echo site_url("payroll/index/{$year->year}/{$filter_month}/{$filter_template}"); ?>"><?php echo $year->year; ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
<?php if( isset($payroll_years) && ( count( $payroll_months ) > 1) ) { ?>
<div class="btn-group">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo ($filter_month) ? date('F', strtotime($filter_month."/1/1990")) : "Filter by Month"; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
      <li><a href="<?php echo site_url("payroll/index/{$filter_year}/0/{$filter_template}"); ?>">Show All</a></li>
    <?php foreach($payroll_months as $month) { ?>
      <li><a href="<?php echo site_url("payroll/index/{$filter_year}/{$month->month}/{$filter_template}"); ?>"><?php echo date('F', strtotime($month->month."/1/1990")); ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } ?>



<?php if( isset($payroll_years) && ( count( $payroll_templates ) > 1) ) { ?>
<div class="btn-group">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo ($filter_template) ? $current_template->name : "Filter by Template"; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
      <li><a href="<?php echo site_url("payroll/index/{$filter_year}/{$filter_month}/0"); ?>">Show All</a></li>
    <?php foreach($payroll_templates as $template) { ?>
      <li><a href="<?php echo site_url("payroll/index/{$filter_year}/{$filter_month}/{$template->template_id}"); ?>"><?php echo $template->template_name; ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } ?>

</h3>

                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif;  ?>

<?php if( $payrolls ) { ?>

          <table class="table table-striped">
            <thead>
              <tr>
                <th width="1%"></th>
                <th width="1%">ID</th>
                <th>Payroll Description</th>
                <th>Month</th>
                <th>Year</th>
                <th>Template</th>
                <th>Working Days</th>
                <?php if( hasAccess('payroll', 'payroll', 'edit') ) { ?>
                  <th width="175px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php foreach($payrolls as $payroll) {  ?>
              <tr id="Payroll-<?php echo $payroll->id; ?>">
                <td>
<a href="<?php echo site_url("payroll/edit/{$payroll->id}"); ?>?lock=update&next=<?php echo uri_string(); ?>" class="confirm">
                  <?php if($payroll->lock) { ?>
                  <span class="fa fa-lock" style="color: red;"></span>
                  <?php } else { ?>
                  <span class="fa fa-unlock" style="color: green;"></span>
                  <?php } ?>
</a>
                </td>
                <td><?php echo $payroll->id; ?></td>
                <td><?php echo $payroll->name; ?></td>
                <td><?php echo date('F', strtotime($payroll->month."/1/1970")); ?></td>
                <td><?php echo $payroll->year; ?></td>
                <td><a class="body_wrapper" href="<?php echo site_url("payroll/index/{$filter_year}/{$filter_month}/{$payroll->template_id}"); ?>">
                <?php echo $payroll->template_name; ?></a>
                </td>
                <td><?php echo $payroll->working_days; ?></td>
              <?php if( hasAccess('payroll', 'payroll', 'edit') ) { ?>
                <td>
<?php if(( $payroll->employees_count > 0 ) && ( $payroll->working_days > 0 )) { ?>

      

<div class="btn-group">
  <a class="btn btn-success btn-xs" href="<?php echo site_url("payroll/select_payroll/{$payroll->id}"); ?>">View</a>
  <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right">
    <li><a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/print"); ?>">Print</a></li>
    <li><a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/payslip"); ?>">Payslip</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/xls"); ?>">Export</a></li>
  </ul>
</div>

<?php } else { ?>

                  <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Payroll" data-url="<?php echo site_url("payroll/config/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">Config</button>
<?php } ?>

<?php if($payroll->lock==0) { ?>
                <a class="btn btn-warning btn-xs confirm_remove" href="<?php echo site_url("payroll/archive/{$payroll->id}"); ?>" data-target="#Payroll-<?php echo $payroll->id; ?>">Deactivate</a>
<?php } ?>
                
                </td>
              <?php } ?>
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