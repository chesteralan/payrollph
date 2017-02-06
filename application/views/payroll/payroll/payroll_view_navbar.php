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
      <div class="navbar-brand"><?php echo $payroll->name; ?>
        
        <a target="_blank" class="close" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/payslip") . "?next=" . uri_string(); ?>" style="margin-left:10px"><span class="glyphicon glyphicon-th-large"></span></a>

         <a target="_blank" class="close" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/print") . "?next=" . uri_string(); ?>" style="margin-left:10px"><span class="glyphicon glyphicon-print"></span></a>

        <a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Payroll" data-url="<?php echo site_url("payroll/config/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" style="margin-left:10px" data-hide_footer="1"><span class="glyphicon glyphicon-cog"></span></a>

      </div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      <li><a class="body_wrapper" href="<?php echo site_url('payroll'); ?>"><span class="glyphicon glyphicon-arrow-left"></span></a></li>
<?php 

$url['payroll_salaries'] = array('uri' => 'payroll_salaries/view/' . $payroll->id, 'title'=>'Basic Salary', 'access'=>hasAccess('payroll', 'payroll', 'view'));
$url['payroll_earnings'] = array('uri' => 'payroll_earnings/view/' . $payroll->id, 'title'=>'Earnings', 'access'=>hasAccess('payroll', 'payroll', 'view'));
$url['payroll_benefits'] = array('uri' => 'payroll_benefits/view/' . $payroll->id, 'title'=>'Benefits', 'access'=>hasAccess('payroll', 'payroll', 'view'));
$url['payroll_deductions'] = array('uri' => 'payroll_deductions/view/' . $payroll->id, 'title'=>'Deductions', 'access'=>hasAccess('payroll', 'payroll', 'view'));

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