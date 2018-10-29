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
          <span class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo APP_NAME; ?></span>
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
    );

    $main_menu['employees'] = array(
      'title' => 'Employees',
      'uri' => 'employees',
      'permission' => 'employees',
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
            'permission' => array('lists','names'),
          ),

          'sep1' => array(
            'header' => true,
            'title' => 'Employees',
            'separator'=>true,
          ),

          'employees_groups' => array(
            'title' => 'Groups',
            'uri' => 'employees_groups',
            'permission' => array('employees','groups'),
          ),
          'employees_positions' => array(
            'title' => 'Positions',
            'uri' => 'employees_positions',
            'permission' => array('employees','positions'),
          ),

          'employees_areas' => array(
            'title' => 'Areas',
            'uri' => 'employees_areas',
            'permission' => array('employees','areas'),
          ),

          'sep2' => array(
            'header' => true,
            'title' => 'Payroll',
            'separator'=>true,
          ),

          'payroll_templates' => array(
            'title' => 'Templates',
            'uri' => 'payroll_templates',
            'permission' => array('payroll','templates'),
          ),

          'lists_earnings' => array(
            'title' => 'Earnings',
            'uri' => 'lists_earnings',
            'permission' => array('lists','earnings'),
          ),
          'lists_benefits' => array(
            'title' => 'Benefits',
            'uri' => 'lists_benefits',
            'permission' => array('lists','benefits'),
          ),
          'lists_deductions' => array(
            'title' => 'Deductions',
            'uri' => 'lists_deductions',
            'permission' => array('lists','deductions'),
          ),

        )
    );

 $main_menu['reports'] = array(
      'title' => 'Reports',
      'uri' => 'reports',
      'permission' => 'reports',
      'sub_menus' => array(
          'lists_names' => array(
            'title' => '13th Month Pay',
            'uri' => 'reports_13month',
            'permission' => array('reports','13month'),
          ),
      )
    );


if( $this->config->item('multi_company') ) {
    $system_submenus['system_companies'] = array(
            'title' => lang_term('companies_title_plural', 'Companies'),
            'uri' => 'system_companies',
            'permission' => array('system', 'companies'),
          );
}
    $system_submenus['system_terms'] = array(
            'title' => 'Terminologies',
            'uri' => 'system_terms',
            'permission' => array('system', 'terms'),
          );

    $system_submenus['system_calendar'] = array(
            'title' => 'Calendar',
            'uri' => 'system_calendar',
            'permission' => array('system', 'calendar'),
          );

    $system_submenus['system_users'] = array(
            'title' => 'User Accounts',
            'uri' => 'system_users',
            'permission' => array('system', 'users'),
          );

    $system_submenus['system_audit'] = array(
            'title' => 'Audit Trail',
            'uri' => 'system_audit',
            'permission' => array('system', 'audit'),
          );

    $system_submenus['system_database'] = array(
            'title' => 'Database',
            'uri' => 'system_database',
            'permission' => array('system', 'database'),
        );

    $main_menu['system'] = array(
      'title' => 'Administration',
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
            <?php if( isset( $menu['sub_menus'] ) ) { ?>
              <a href="#<?php echo $menu['uri']; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menu['title']; ?> <span class="caret hidden-xs"></span></a>
                  <ul class="dropdown-menu">
                  <?php foreach($menu['sub_menus'] as $sub=>$sub_menu): ?>
                    <?php if( isset($sub_menu['header']) && ($sub_menu['header']) ) { ?>
                        <?php if( isset($sub_menu['separator']) && ($sub_menu['separator']) ) { ?>
                          <li role="separator" class="divider"></li>
                        <?php } ?>
                        <?php if( isset($sub_menu['title']) && ($sub_menu['title'] != '') ) { ?>
                          <span class="dropdown-header"><?php echo $sub_menu['title']; ?></span>
                        <?php } ?>
                    <?php } else { 

                    if( ! isset( $sub_menu['permission'] ) ) {
                      continue;
                    }

                    if( ($sub_menu['permission']) && (! in_array($sub_menu['permission'][1], $this->session->menu_module[$sub_menu['permission'][0]] ) ) ) {
                      continue;
                    }

                      ?>
                      <li><a class="body_wrapper" href="<?php echo site_url($sub_menu['uri']); ?>"><?php echo $sub_menu['title']; ?></a></li>
                    <?php } ?>
                  <?php endforeach; ?>
                  </ul>
            <?php } else { ?>
            <a class="body_wrapper" href="<?php echo site_url($menu['uri']); ?>"><?php echo $menu['title']; ?></a>
            <?php } ?>
          </li>
<?php endforeach; ?>

          </ul>

          <ul class="nav navbar-nav navbar-right">
<!--<li class="">
  <a href=""><span class="glyphicon glyphicon-tasks"><span class="badge nav-badge">6</span></span></a>
</li>-->
<?php if( hasAccess('developer_tools', 'themes', 'view') ) { ?>
   <li class="hidden-xs dropdown">
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
          <li class="active hidden-xs">
              <a href="<?php echo site_url( 'payroll/page_session/' . $current_payroll->id); ?>"><strong><?php echo $current_payroll->name; ?></strong></a>
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