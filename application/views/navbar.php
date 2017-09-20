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

$main_menu = array();

if( $this->session->userdata( 'current_company' ) ) {  

  $main_menu['payroll'] = array(
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
            'permission' => 'templates',
          ),
        )
    );

    $main_menu['employees'] = array(
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
            'permission' => 'groups',
          ),
          'employees_positions' => array(
            'title' => 'Positions',
            'uri' => 'employees_positions',
            'permission' => 'positions',
          ),
          'employees_areas' => array(
            'title' => 'Areas',
            'uri' => 'employees_areas',
            'permission' => 'areas',
          ),
        )
    );

}

    $main_menu['lists'] = array(
      'title' => 'Lists',
      'uri' => 'lists',
      'permission' => 'lists',
      'sub_menus' => array(
          'lists_names' => array(
            'title' => 'Names',
            'uri' => 'lists_names',
            'permission' => 'names',
          ),
          'lists_earnings' => array(
            'title' => 'Earnings',
            'uri' => 'lists_earnings',
            'permission' => 'earnings',
          ),
          'lists_benefits' => array(
            'title' => 'Benefits',
            'uri' => 'lists_benefits',
            'permission' => 'benefits',
          ),
          'lists_deductions' => array(
            'title' => 'Deductions',
            'uri' => 'lists_deductions',
            'permission' => 'deductions',
          ),
        )
    );

if( $this->config->item('multi_company') ) {
    $system_submenus['system_companies'] = array(
            'title' => 'Companies',
            'uri' => 'system_companies',
            'permission' => 'companies',
          );
}
    $system_submenus['system_terms'] = array(
            'title' => 'Terminologies',
            'uri' => 'system_terms',
            'permission' => 'terms',
          );

    $system_submenus['system_users'] = array(
            'title' => 'User Accounts',
            'uri' => 'system_users',
            'permission' => 'users',
          );
    $system_submenus['system_backup'] = array(
            'title' => 'Database Backup',
            'uri' => 'system_backup',
            'permission' => 'backup',
        );

    $main_menu['system'] = array(
      'title' => 'System',
      'uri' => 'system',
      'permission' => 'system',
      'sub_menus' => $system_submenus,
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

<?php if( hasAccess('developer_tools', 'themes', 'view') ) { ?>
   <li class="hidden-xs hidden-sm dropdown">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong><?php echo $this->session->userdata('current_company_theme' ); ?></strong> <span class="caret hidden-xs"></span></a>
   <ul class="dropdown-menu">
   <?php foreach(array('default','cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti') as $theme) { ?>
            <li class="<?php echo ($this->session->userdata('current_company_theme')==$theme)?'active':''; ?>"><a href="<?php echo site_url('welcome/change_current_theme/' .  $theme) . "?uri=" . uri_string(); ?>"><?php echo $theme; ?></a></li>
    <?php } ?>
    </ul>
  </li>
<?php } ?>
<?php if( $this->session->userdata('current_payroll') ) { 
$current_payroll = $this->session->userdata('current_payroll');
  ?>
          <li class="active hidden-xs hidden-sm dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong><?php echo $current_payroll->name; ?></strong> <span class="caret hidden-xs"></span></a>

            <ul class="dropdown-menu">
            <li><a class="body_wrapper" href="<?php echo site_url('payroll_dtr/view/' . $current_payroll->id); ?>">Daily Time Record</a></li>
            <li><a class="body_wrapper" href="<?php echo site_url('payroll_salaries/view/' . $current_payroll->id); ?>">Basic Salary</a></li>
            <li><a class="body_wrapper" href="<?php echo site_url('payroll_earnings/view/' . $current_payroll->id); ?>">Earnings</a></li>
            <li><a class="body_wrapper" href="<?php echo site_url('payroll_benefits/view/' . $current_payroll->id); ?>">Benefits</a></li>
            <li><a class="body_wrapper" href="<?php echo site_url('payroll_deductions/view/' . $current_payroll->id); ?>">Deductions</a></li>
            <li><a class="body_wrapper" href="<?php echo site_url('payroll_summary/view/' . $current_payroll->id); ?>">Summary</a></li>
          </ul>

          </li>
<?php } ?>

<?php if( hasAccess('employees', 'employees', 'view') ) { ?>
<?php if( count( $this->session->menu_module ) > 0 ) { ?>
          <li class="hidden-xs hidden-sm">
                  <form class="navbar-form navbar-right" role="search" action="<?php echo site_url("employees"); ?>">
        <div class="form-group">
          <input name="q" type="text" class="form-control autocomplete-search_employee" data-source="<?php echo site_url("welcome/ajax/search_employee"); ?>" placeholder="Search Employees">
        </div>

      </form>
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
            <li><a href="#ajaxModal" class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Account Settings" data-url="<?php echo site_url("welcome/settings/ajax") . "?next=" . uri_string(); ?>">Account Settings</a></li>
            <li><a href="#ajaxModal" class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Change Password" data-url="<?php echo site_url("welcome/change_password/ajax") . "?next=" . uri_string(); ?>">Change Password</a></li>
            <li><a href="<?php echo site_url('account/logout') . "?next=" . urlencode( uri_string() ); ?>">Logout</a></li>
          </ul>
        </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</div>