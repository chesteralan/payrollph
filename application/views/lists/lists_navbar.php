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
      <div class="navbar-brand"><?php echo (isset($name) && ($name)) ? $name->full_name : 'Lists'; ?></div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<?php if(isset($name) && ($name)) { ?>
      <ul class="nav navbar-nav">
        <li><a href="#ajaxModal"><span class="glyphicon glyphicon-print"></span></a></li>
      </ul>
<?php } ?>
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
<?php 
$url['lists_names'] = array('uri' => 'lists_names', 'title'=>'Names', 'access'=>hasAccess('lists', 'names', 'view'));
$url['lists_earnings'] = array('uri' => 'lists_earnings', 'title'=>'Earnings', 'access'=>hasAccess('lists', 'earnings', 'view'));
$url['lists_benefits'] = array('uri' => 'lists_benefits', 'title'=>'Benefits', 'access'=>hasAccess('lists', 'benefits', 'view'));
$url['lists_deductions'] = array('uri' => 'lists_deductions', 'title'=>'Deductions', 'access'=>hasAccess('lists', 'deductions', 'view'));
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