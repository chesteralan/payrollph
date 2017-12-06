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
      <div class="navbar-brand">
<?php if(( $name->lastname != '' ) && ( $name->firstname != '' )) { ?>
      <?php echo $name->lastname; ?>, <?php echo $name->firstname; ?> <?php echo ($name->middlename) ? strtoupper(substr($name->middlename,0,1))."." : ""; ?>
<?php } else { ?>
    <?php echo $name->full_name; ?>
<?php } ?>        
      </div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     

      <ul class="nav navbar-nav navbar-right">
<?php 
$group_id = (isset($group_id)) ? $group_id : 0;
$column_groups = array(
  array(  'key'=>'column_group_dtr',
          'name' => 'Daily Time Record',
          'checked' => (($column_group_dtr)?$column_group_dtr:0),
          'uri' => "payroll_dtr/by_name/{$name->id}",
          'url_key'=> 'payroll_dtr',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_salaries',
          'name' => 'Basic Salary',
          'checked' => (($column_group_salaries)?$column_group_salaries:0),
          'uri' => "payroll_salaries/by_name/{$name->id}",
          'url_key'=> 'payroll_salaries',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_earnings',
          'name' => 'Earnings',
          'checked' => (($column_group_earnings)?$column_group_earnings:0),
          'uri' => "payroll_earnings/by_name/{$name->id}",
          'url_key'=> 'payroll_earnings',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_benefits',
          'name' => 'Benefits',
          'checked' => (($column_group_benefits)?$column_group_benefits:0),
          'uri' => "payroll_benefits/by_name/{$name->id}",
          'url_key'=> 'payroll_benefits',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_deductions',
          'name' => 'Deductions',
          'checked' => (($column_group_deductions)?$column_group_deductions:0),
          'uri' => "payroll_deductions/by_name/{$name->id}",
          'url_key'=> 'payroll_deductions',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_summary',
          'name' => 'Summary',
          'checked' => (($column_group_summary)?$column_group_summary:0),
          'uri' => "payroll_summary/by_name/{$name->id}",
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