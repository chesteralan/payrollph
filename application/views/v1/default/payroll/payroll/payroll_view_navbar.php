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
      <div class="navbar-brand"><?php echo $payroll->name;  ?></div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li><a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Payroll" data-url="<?php echo site_url("payroll/config/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1"><span class="glyphicon glyphicon-cog"></span></a></li>
        
        <?php if( isset($print_groups) && ($print_groups) ) { ?>

     <li><a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Print Payroll" data-url="<?php echo site_url("payroll/print_group/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1"><span class="glyphicon glyphicon-print"></span></a></li>

<?php } else { ?>

<?php if( !isset($no_inclusive_dates) ) { ?>

      <li><a target="_payslip" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/payslip") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-th-large"></span></a></li>

      <li><a target="_print" href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/print") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-print"></span></a></li>

<?php } ?>

<?php } ?>

<?php if( $this->session->userdata('current_employee') ) { 
$current_employee = $this->session->userdata('current_employee');
  ?>
  <li class="active hidden-xs hidden-sm">
    <a href="<?php echo site_url('payroll/clear_current_employee') . "?next=" . urlencode(uri_string()); ?>"><strong><?php echo $current_employee->lastname; ?>, <?php echo $current_employee->firstname; ?> <?php echo substr($current_employee->middlename,0,1)."."; ?></strong> <span class="glyphicon glyphicon-remove"></span></a>
     <ul class="dropdown-menu">
            <li>Cancel</a></li>
        </ul>
  </li>
<?php } else { ?>

<?php if( ( isset($employees_status) && ($employees_status) ) 
  || ( isset($employees_groups) && ($employees_groups) ) 
  || ( isset($employees_areas) && ($employees_areas) ) 
  || ( isset($employees_positions) && ($employees_positions) ) 
)
{
  ?>

    <li class="dropdown">

<?php 
  $filter_text = ($this->session->userdata('employees_filter')) ? $this->session->userdata('employees_filter')->name : 'All Employees';
?>
          <a href="#" class="dropdown-toggle bold" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $filter_text; ?> <span class="caret"></span></a>

          <ul class="dropdown-menu">

<?php if($this->session->userdata('employees_filter')) { ?>
            <li class="<?php echo (!$this->session->userdata('employees_filter')) ? 'active' : ''; ?>"><a href="<?php echo site_url("payroll/clear_filter") . "?uri=" . uri_string(); ?>">All Employees</a></li>
             <li role="separator" class="divider"></li>
<?php } ?>

<?php if( isset($employees_status) && ($employees_status) ) { ?>
           
            <span class="dropdown-header">Employee Status</span>
            <?php foreach($employees_status as $emp_stat) { ?>
                <li class="<?php echo (($this->session->userdata('employees_filter')) && ($this->session->userdata('employees_filter_type')=='status') && ($this->session->userdata('employees_filter')->id == $emp_stat->status)) ? 'active' : ''; ?>"><a href="<?php echo site_url("payroll/filter_status/{$emp_stat->status}") . "?uri=" . uri_string(); ?>"><?php echo $emp_stat->status_name; ?></a></li>
            <?php } ?>
            <?php if( isset($employees_groups) && ($employees_groups) ) { ?>
            <li role="separator" class="divider"></li>
            <?php } ?>
<?php } ?>

<?php if( isset($employees_groups) && ($employees_groups) ) { ?>
            
            <span class="dropdown-header">Employee Groups</span>
            <?php foreach($employees_groups as $emp_grp) { ?>
                <li class="<?php echo (($this->session->userdata('employees_filter')) && ($this->session->userdata('employees_filter_type')=='group') && ($this->session->userdata('employees_filter')->id == $emp_grp->id)) ? 'active' : ''; ?>"><a href="<?php echo site_url("payroll/filter_group/{$emp_grp->id}") . "?uri=" . uri_string(); ?>"><?php echo $emp_grp->name; ?></a></li>
            <?php } ?>
            <?php if( isset($employees_areas) && ($employees_areas) ) { ?>
            <li role="separator" class="divider"></li>
            <?php } ?>
<?php } ?>

<?php if( isset($employees_areas) && ($employees_areas) ) { ?>
            
            <span class="dropdown-header">Employee Areas</span>
            <?php foreach($employees_areas as $emp_area) { ?>
                <li class="<?php echo (($this->session->userdata('employees_filter')) && ($this->session->userdata('employees_filter_type')=='area') && ($this->session->userdata('employees_filter')->id == $emp_area->id)) ? 'active' : ''; ?>"><a href="<?php echo site_url("payroll/filter_area/{$emp_area->id}") . "?uri=" . uri_string(); ?>"><?php echo $emp_area->name; ?></a></li>
            <?php } ?>
            <?php if( isset($employees_positions) && ($employees_positions) ) { ?>
            <li role="separator" class="divider"></li>
            <?php } ?>
<?php } ?>

<?php if( isset($employees_positions) && ($employees_positions) ) { ?>
            
            <span class="dropdown-header">Employee Positions</span>
            <?php foreach($employees_positions as $emp_position) { ?>
                <li class="<?php echo (($this->session->userdata('employees_filter')) && ($this->session->userdata('employees_filter_type')=='position') && ($this->session->userdata('employees_filter')->id == $emp_position->id)) ? 'active' : ''; ?>"><a href="<?php echo site_url("payroll/filter_position/{$emp_position->id}") . "?uri=" . uri_string(); ?>"><?php echo $emp_position->name; ?></a></li>
            <?php } ?>
<?php } ?>

          </ul>
        </li>

<?php } ?>

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

      <ul class="nav navbar-nav navbar-right">
<?php 
$group_id = (isset($group_id)) ? $group_id : 0;
$column_groups = array(
  array(  'key'=>'column_group_employees',
          'name' => 'Employees',
          'checked' => (($column_group_employees)?$column_group_employees:0),
          'uri' => "payroll_employees/view/{$payroll->id}/{$group_id}",
          'url_key'=> 'payroll_employees',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_dtr',
          'name' => 'Daily Time Record',
          'checked' => (($column_group_dtr)?$column_group_dtr:0),
          'uri' => "payroll_dtr/view/{$payroll->id}/{$group_id}",
          'url_key'=> 'payroll_dtr',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_salaries',
          'name' => 'Basic Salary',
          'checked' => (($column_group_salaries)?$column_group_salaries:0),
          'uri' => "payroll_salaries/view/{$payroll->id}/{$group_id}",
          'url_key'=> 'payroll_salaries',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_earnings',
          'name' => 'Earnings',
          'checked' => (($column_group_earnings)?$column_group_earnings:0),
          'uri' => "payroll_earnings/view/{$payroll->id}/{$group_id}",
          'url_key'=> 'payroll_earnings',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_benefits',
          'name' => 'Benefits',
          'checked' => (($column_group_benefits)?$column_group_benefits:0),
          'uri' => "payroll_benefits/view/{$payroll->id}/{$group_id}",
          'url_key'=> 'payroll_benefits',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_deductions',
          'name' => 'Deductions',
          'checked' => (($column_group_deductions)?$column_group_deductions:0),
          'uri' => "payroll_deductions/view/{$payroll->id}/{$group_id}",
          'url_key'=> 'payroll_deductions',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        ),
  array(  'key'=>'column_group_summary',
          'name' => 'Summary',
          'checked' => (($column_group_summary)?$column_group_summary:0),
          'uri' => "payroll_summary/view/{$payroll->id}/{$group_id}",
          'url_key'=> 'payroll_summary',
          'access'=>hasAccess('payroll', 'payroll', 'view'),
        )
);

$cg_sort = ($column_group_sort) ? $column_group_sort : false;
$nav_title = 'Navigation';
  if( $cg_sort ) {
    $cg_sort2 = array();
    $si = 0;
    foreach($cg_sort as $sk=>$sv) {
        $cg_sort2[$sv] = $si++;
    }  

    $pgs = array();
    foreach($column_groups as $cg) {
      $cg_key = $cg['key'];
      if( isset($cg_sort2[$cg_key])) {
        $pgs[$cg_sort2[$cg_key]] = $cg;
      }
    }
    ksort($pgs);
    $column_groups = $pgs;
  }
 foreach($column_groups as $cg) { 
  if( $cg['checked'] == 0 ) continue;
  if( !$cg['access'] ) continue;
  if($cg['url_key']==$current_uri) {
      $nav_title = $cg['name'];
  }
?>
<li class="visible-lg visible-md <?php echo ($cg['url_key']==$current_uri) ? 'active' : ''; ?>"><a class="body_wrapper" href="<?php echo site_url($cg['uri']); ?>"><?php echo $cg['name']; ?></a></li>
<?php } ?>
<li class="dropdown visible-sm visible-xs">
<a href="#" class="dropdown-toggle bold" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $nav_title; ?> <span class="caret"></span></a>
    <ul class="dropdown-menu">
<?php
 foreach($column_groups as $cg) { 
  if( $cg['checked'] == 0 ) continue;
  if( !$cg['access'] ) continue;
?>
<li class="<?php echo ($cg['url_key']==$current_uri) ? 'active' : ''; ?>"><a class="body_wrapper" href="<?php echo site_url($cg['uri']); ?>"><?php echo $cg['name']; ?></a></li>
<?php } ?>
    </ul>
</li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>