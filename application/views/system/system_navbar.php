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
      <div class="navbar-brand">System</div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
<?php 
$url['system_companies'] = array('uri' => 'system_companies', 'title'=>'Companies', 'access'=>hasAccess('system', 'companies', 'view'));
$url['system_terms'] = array('uri' => 'system_terms', 'title'=>'Terminologies', 'access'=>hasAccess('system', 'terms', 'view'));
$url['system_users'] = array('uri' => 'system_users', 'title'=>'User Accounts', 'access'=>hasAccess('system', 'users', 'view'));
$url['system_backup'] = array('uri' => 'system_backup', 'title'=>'Database Backup', 'access'=>hasAccess('system', 'backup', 'view'));
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