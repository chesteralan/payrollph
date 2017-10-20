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
        <li><a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Payroll" data-url="<?php echo site_url("payroll_templates/config/{$template->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1"><span class="glyphicon glyphicon-cog"></span></a></li>
      </ul>
     <ul class="nav navbar-nav navbar-right">
<?php 
$group_id = (isset($group_id)) ? $group_id : 0;
$column_groups = array(
  array(  'key'=>'column_group_salaries',
          'name' => 'Basic Salary',
          'checked' => (($column_group_salaries)?$column_group_salaries:0),
          'uri' => "payroll_salaries/preview/{$template->id}/{$group_id}",
          'url_key'=> 'payroll_salaries',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_earnings',
          'name' => 'Earnings',
          'checked' => (($column_group_earnings)?$column_group_earnings:0),
          'uri' => "payroll_earnings/preview/{$template->id}/{$group_id}",
          'url_key'=> 'payroll_earnings',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_benefits',
          'name' => 'Benefits',
          'checked' => (($column_group_benefits)?$column_group_benefits:0),
          'uri' => "payroll_benefits/preview/{$template->id}/{$group_id}",
          'url_key'=> 'payroll_benefits',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_deductions',
          'name' => 'Deductions',
          'checked' => (($column_group_deductions)?$column_group_deductions:0),
          'uri' => "payroll_deductions/preview/{$template->id}/{$group_id}",
          'url_key'=> 'payroll_deductions',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_summary',
          'name' => 'Summary',
          'checked' => (($column_group_summary)?$column_group_summary:0),
          'uri' => "payroll_summary/preview/{$template->id}/{$group_id}",
          'url_key'=> 'payroll_summary',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
);

$cg_sort = ($column_group_sort) ? $column_group_sort : false;

  if( $cg_sort ) {
    $cg_sort2 = array();
    $si = 0;
    foreach($cg_sort as $sk=>$sv) {
        $cg_sort2[$sv] = $si++;
    }  

    $pgs = array();
    foreach($column_groups as $cg) {
      $cg_key = $cg['key'];
      $pgs[$cg_sort2[$cg_key]] = $cg;
    }
    ksort($pgs);
    $column_groups = $pgs;
  }
 foreach($column_groups as $cg) { 
  if( $cg['checked'] == 0 ) continue;
  if( !$cg['access'] ) continue;
?>
<li class="<?php echo ($cg['url_key']==$current_uri) ? 'active' : ''; ?>"><a class="body_wrapper" href="<?php echo site_url($cg['uri']); ?>"><?php echo $cg['name']; ?></a></li>
<?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>