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
      <div class="navbar-brand"><?php echo (isset($name) && ($name)) ? $name->full_name : 'Reports'; ?></div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php if(isset($name) && ($name)) { ?>
          <li><a href="#ajaxModal"><span class="glyphicon glyphicon-print"></span></a></li>
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
<?php 
$url['reports_13month'] = array('uri' => 'reports_13month', 'title'=>'13th Month Pay', 'access'=>hasAccess('reports', '13month', 'view')); 
?>
<ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $current_page; ?> <span class="caret"></span></a>
<?php if( count($url) > 1 ) { ?>
     <ul class="dropdown-menu">
<?php 
foreach($url as $k=>$v) {
  if(($k==$current_uri)) {
    continue;
  }
  if( $v['access'] ) {
?>
  <li class="<?php echo ($k==$current_uri) ? 'active' : ''; ?>"><a class="body_wrapper" href="<?php echo site_url($v['uri']); ?>"><?php echo $v['title']; ?></a></li>
<?php } } ?>
     </ul>
        </li>
</ul>
<?php } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>