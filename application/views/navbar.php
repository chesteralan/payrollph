<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-success navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavBarCollapse" aria-expanded="false" aria-controls="navbar" id="mainNavBarToggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="navbar-brand" href="<?php echo site_url(); ?>">Payroll PH</span>
        </div>
        <div id="mainNavBarCollapse" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

          <li class="dropdown">
              <a href="<?php echo site_url("welcome");; ?>" class="body_wrapper">Home</a>
          </li>
<?php 

$main_menu = array(
  'payroll' => array(
      'title' => 'Payroll',
      'uri' => 'payroll',
      'permission' => 'payroll',
      'sub_menus' => array(
          'payroll_payroll' => array(
            'title' => 'Payroll',
            'uri' => 'payroll',
            'permission' => 'payroll',
          ),
          'payroll_templates' => array(
            'title' => 'Templates',
            'uri' => 'payroll_templates',
            'permission' => 'payroll_templates',
          ),
        )
    ),

  'employees' => array(
      'title' => 'Employees',
      'uri' => 'employees',
      'permission' => 'employees',
      'sub_menus' => array(
          'employees_employees' => array(
            'title' => 'Employees',
            'uri' => 'employees',
            'permission' => 'employees',
          ),
          'employees_groups' => array(
            'title' => 'Groups',
            'uri' => 'employees_groups',
            'permission' => 'employees_groups',
          ),
        )
    ),

  'system' => array(
      'title' => 'System',
      'uri' => 'system',
      'permission' => 'system',
      'sub_menus' => array(
          'system_names' => array(
            'title' => 'Names List',
            'uri' => 'system_names',
            'permission' => 'names',
          ),
          'system_users' => array(
            'title' => 'User Accounts',
            'uri' => 'system_users',
            'permission' => 'users',
          ),
          'system_backup' => array(
            'title' => 'Database Backup',
            'uri' => 'system_backup',
            'permission' => 'backup',
          ),
        )
    ),
);

foreach($main_menu as $main=>$menu): 
  if( ! isset( $menu['permission'] ) ) {
    continue;
  }
  if( ! isset( $this->session->menu_module[$menu['permission']] ) ) {
    continue;
  }
?>
          <li class="dropdown">
              <a href="#<?php echo $menu['uri']; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menu['title']; ?> <span class="caret hidden-xs"></span></a>
                  <ul class="dropdown-menu">
                  <?php foreach($menu['sub_menus'] as $sub=>$sub_menu): 
                    if( ! isset( $sub_menu['permission'] ) ) {
                      continue;
                    }
                    if( ($sub_menu['permission']) && (! in_array($sub_menu['permission'], $this->session->menu_module[$menu['permission']] ) ) ) {
                      continue;
                    }
                  ?>
                    <?php if( isset($sub_menu['header']) && ($sub_menu['header']) ) { ?>
                        <?php if( isset($sub_menu['separator']) && ($sub_menu['separator']) ) { ?>
                          <li role="separator" class="divider"></li>
                        <?php } ?>
                        <?php if( isset($sub_menu['title']) && ($sub_menu['title'] != '') ) { ?>
                          <span class="dropdown-header"><?php echo $sub_menu['title']; ?></span>
                        <?php } ?>
                    <?php } else { ?>
                    <li><a class="body_wrapper" href="<?php echo site_url($sub_menu['uri']); ?>"><?php echo $sub_menu['title']; ?></a></li>
                    <?php } ?>
                  <?php endforeach; ?>
                  </ul>
          </li>
<?php endforeach; ?>

          </ul>

          <ul class="nav navbar-nav navbar-right">
<?php if( hasAccess('employees', 'employees', 'view') ) { ?>
<?php if( count( $this->session->menu_module ) > 0 ) { ?>
          <li class="hidden-xs hidden-sm">
                  <div class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input name="q" type="text" class="form-control autocomplete-member_change" data-source="<?php echo site_url("welcome/ajax/change_member"); ?>" data-current_sub_uri="<?php echo uri_string(); ?>" placeholder="Search Employees">
        </div>

      </div>
          </li>
<?php } ?>
<?php } ?>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="visible-xs"><?php echo $this->session->name; ?>
            <span class="caret hidden-xs"></span>
          </span>
          <span class="glyphicon glyphicon-user hidden-xs"></span></a>
          <ul class="dropdown-menu">
            <span class="dropdown-header"><?php echo $this->session->name; ?></span>
            <li><a class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Password" data-url="<?php echo site_url("account/change_password/ajax") . "?next=" . uri_string(); ?>">Change Password</a></li>
            <li><a href="<?php echo site_url('account/logout') . "?next=" . urlencode( uri_string() ); ?>">Logout</a></li>
          </ul>
        </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</div>