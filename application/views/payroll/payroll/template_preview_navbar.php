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
      <div class="navbar-brand"><?php echo $template->name;  ?></div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php foreach($templates as $temp) { ?>
              <li><a href="<?php echo site_url("{$current_uri}/preview/{$temp->id}"); ?>"><?php echo $temp->name; ?></a></li>
            <?php } ?>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a class="body_wrapper" href="<?php echo site_url('payroll_templates'); ?>"><span class="glyphicon glyphicon-arrow-left"></span></a></li>
<?php 

$group_id = (isset($group_id)) ? $group_id : 0;

$url['payroll_salaries'] = array('uri' => "payroll_salaries/preview/{$template->id}/{$group_id}", 'title'=>'Basic Salary', 'access'=>hasAccess('payroll', 'payroll', 'view'));
if( (isset($template->earnings_columns)) && ( $template->earnings_columns > 0 ) ) {
  $url['payroll_earnings'] = array('uri' => "payroll_earnings/preview/{$template->id}/{$group_id}", 'title'=>'Earnings', 'access'=>hasAccess('payroll', 'payroll', 'view'));
}
if( (isset($template->benefits_columns)) && ( $template->benefits_columns > 0 ) ) {
  $url['payroll_benefits'] = array('uri' => "payroll_benefits/preview/{$template->id}/{$group_id}", 'title'=>'Benefits', 'access'=>hasAccess('payroll', 'payroll', 'view'));
}
if( (isset($template->deductions_columns)) && ( $template->deductions_columns > 0 ) ) {
  $url['payroll_deductions'] = array('uri' => "payroll_deductions/preview/{$template->id}/{$group_id}", 'title'=>'Deductions', 'access'=>hasAccess('payroll', 'payroll', 'view'));
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