<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <nav class="navbar navbar-default">
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
      </ul>

      <ul class="nav navbar-nav navbar-right">
      <li><a class="body_wrapper" href="<?php echo site_url('payroll'); ?>"><span class="glyphicon glyphicon-arrow-left"></span></a></li>
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