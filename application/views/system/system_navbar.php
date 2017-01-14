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
<?php if(isset($navbar_search) && ($navbar_search==true)) { ?>
      <form class="navbar-form navbar-left" role="search" method="get">
        <div class="input-group">
          <input name="q" type="text" class="form-control" placeholder="Search" value="<?php echo $this->input->get('q'); ?>">
            <span class="input-group-btn">
            <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </span>
        </div>
      </form>
<?php } ?>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $current_page; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
<?php 
$url['system_names'] = array('uri' => 'system_names', 'title'=>'Names List', 'access'=>hasAccess('system', 'names', 'view'));
$url['system_users'] = array('uri' => 'system_users', 'title'=>'User Accounts', 'access'=>hasAccess('system', 'users', 'view'));
$url['system_backup'] = array('uri' => 'system_backup', 'title'=>'Database Backup', 'access'=>hasAccess('system', 'backup', 'view'));
foreach($url as $k=>$v) {
  if( $v['access'] ) {
?>
  <li class="<?php echo ($k==$current_uri) ? 'active' : ''; ?>"><a class="body_wrapper" href="<?php echo site_url($v['uri']); ?>"><?php echo $v['title']; ?></a></li>
<?php } } ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>