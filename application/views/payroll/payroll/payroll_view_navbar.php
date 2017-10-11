<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <nav class="navbar navbar-default stickynav1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand"><?php echo $payroll->name;  ?></div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li><a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Payroll" data-url="<?php echo site_url("payroll/config/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1"><span class="glyphicon glyphicon-cog"></span></a></li>
        
        <?php if( isset($print_groups) && ($print_groups) ) { ?>

     <li><a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Print Payroll" data-url="<?php echo site_url("payroll/print_group/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1"><span class="glyphicon glyphicon-print"></span></a></li>

<?php } else { ?>

      <li><a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/payslip") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-th-large"></span></a></li>

      <li><a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/print") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-print"></span></a></li>

<?php } ?>

<?php if( $this->session->userdata('current_employee') ) { 
$current_employee = $this->session->userdata('current_employee');
  ?>
  <li class="active hidden-xs hidden-sm dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong><?php echo $current_employee->lastname; ?>, <?php echo $current_employee->firstname; ?> <?php echo substr($current_employee->middlename,0,1)."."; ?></strong> <span class="caret hidden-xs"></span></a>
     <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('payroll_dtr/clear_current_employee') . "?next=" . urlencode(uri_string()); ?>">Cancel</a></li>
        </ul>
  </li>
<?php } else { ?>
<?php if( isset($employees_status) && ($employees_status) ) { ?>
    <li class="dropdown">
          <a href="#" class="dropdown-toggle bold" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ($this->session->userdata('employees_status')) ? $this->session->userdata('employees_status')->name : 'All Employees'; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php echo (!$this->session->userdata('employees_status')) ? 'active' : ''; ?>"><a href="<?php echo site_url("payroll/change_status/0") . "?uri=" . uri_string(); ?>">All Employees</a></li>
            <?php foreach($employees_status as $emp_stat) { ?>
                <li class="<?php echo (($this->session->userdata('employees_status')) && ($this->session->userdata('employees_status')->id == $emp_stat->status)) ? 'active' : ''; ?>"><a href="<?php echo site_url("payroll/change_status/{$emp_stat->status}") . "?uri=" . uri_string(); ?>"><?php echo $emp_stat->status_name; ?></a></li>
            <?php } ?>
          </ul>
        </li>
<?php } ?>
<?php } ?>

<?php if(isset($previous_item) && ($previous_item)) { ?>
<li>
    <a href="<?php echo site_url($previous_item->url); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></span></a>
</li>
<?php } ?>
<?php if(isset($next_item) && ($next_item)) { ?>
<li>
    <a href="<?php echo site_url($next_item->url); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-right"></span></a>
</li>
<?php } ?>

      </ul>

      <ul class="nav navbar-nav navbar-right">

<?php 

$group_id = (isset($group_id)) ? $group_id : 0;

$url['payroll_dtr'] = array('uri' => "payroll_dtr/view/{$payroll->id}/{$group_id}", 'title'=>'Daily Time Record', 'access'=>hasAccess('payroll', 'payroll', 'view'));
$url['payroll_salaries'] = array('uri' => "payroll_salaries/view/{$payroll->id}/{$group_id}", 'title'=>'Basic Salary', 'access'=>hasAccess('payroll', 'payroll', 'view'));
if( (isset($payroll->earnings_columns)) && ( $payroll->earnings_columns > 0 ) ) {
  $url['payroll_earnings'] = array('uri' => "payroll_earnings/view/{$payroll->id}/{$group_id}", 'title'=>'Earnings', 'access'=>hasAccess('payroll', 'payroll', 'view'));
}
if( (isset($payroll->benefits_columns)) && ( $payroll->benefits_columns > 0 ) ) {
  $url['payroll_benefits'] = array('uri' => "payroll_benefits/view/{$payroll->id}/{$group_id}", 'title'=>'Benefits', 'access'=>hasAccess('payroll', 'payroll', 'view'));
}
if( (isset($payroll->deductions_columns)) && ( $payroll->deductions_columns > 0 ) ) {
  $url['payroll_deductions'] = array('uri' => "payroll_deductions/view/{$payroll->id}/{$group_id}", 'title'=>'Deductions', 'access'=>hasAccess('payroll', 'payroll', 'view'));
}
$url['payroll_summary'] = array('uri' => "payroll_summary/view/{$payroll->id}/{$group_id}", 'title'=>'Summary', 'access'=>hasAccess('payroll', 'payroll', 'view'));

foreach($url as $k=>$v) {
  if( $v['access'] ) {
?>
  <li class="<?php echo ($k==$current_uri) ? 'active' : ''; ?>"><a class="body_wrapper" href="<?php echo site_url($v['uri']); ?>"><?php echo $v['title']; ?></a></li>
<?php } } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>