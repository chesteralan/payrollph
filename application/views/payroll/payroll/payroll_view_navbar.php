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
      <div class="navbar-brand"><?php echo $payroll->name; ?></div>
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