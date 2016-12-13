<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-success navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(); ?>">PAYROLL</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
<?php 

$main_menu = array(
  'employees' => array(
      'title' => 'Employees',
      'uri' => 'employees',
      'sub_menus' => array(
          'employees' => array(
            'title' => 'Employees',
            'uri' => 'employees',
          ),
        )
    ),


    'system' => array(
      'title' => 'System',
      'uri' => 'system',
      'sub_menus' => array(
          'system_users' => array(
            'title' => 'User Accounts',
            'uri' => 'system_users',
          ),
          'system_backup' => array(
            'title' => 'Database Backup',
            'uri' => 'system_backup',
          ),
        )
    ),


);

?>
<?php foreach($main_menu as $main=>$menu): ?>
          <li class="dropdown <?php echo ((isset($current_uri))&&($current_uri==in_array($current_uri, array_keys($menu['sub_menus']))))?'active':''; ?>">
              <a href="#<?php echo $menu['uri']; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menu['title']; ?> <span class="caret hidden-xs"></span></a>
                  <ul class="dropdown-menu">
                  <?php foreach($menu['sub_menus'] as $sub=>$sub_menu): ?>
                    <li class="<?php echo ((isset($current_uri))&&($current_uri==$sub))?'active':''; ?>"><a href="<?php echo site_url($sub_menu['uri']); ?>"><?php echo $sub_menu['title']; ?></a></li>
                  <?php endforeach; ?>
                  </ul>
          </li>
<?php endforeach; ?>
          </ul>

          <ul class="nav navbar-nav navbar-right">


            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="visible-xs"><?php echo $this->session->name; ?>
            <span class="caret hidden-xs"></span>
          </span>
          <span class="glyphicon glyphicon-user hidden-xs"></span></a>
          <ul class="dropdown-menu">
            <li><a class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Password" data-url="<?php echo site_url("account/change_password/ajax") . "?next=" . uri_string(); ?>">Change Password</a></li>
            <li><a href="<?php echo site_url('account/logout'); ?>">Logout</a></li>
          </ul>
        </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</div>