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

      <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? strtoupper(substr($employee->middlename,0,1))."." : ""; ?></div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

         <ul class="nav navbar-nav">
        
        <li><a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Payroll" data-url="<?php echo site_url("employees/config/{$employee->name_id}/ajax") . "?next=" . uri_string(); ?>" style="margin-left:10px" data-hide_footer="1"><span class="glyphicon glyphicon-cog"></span></a></li>

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


<li class=""><a class="body_wrapper" href="<?php echo site_url("payroll_dtr/by_name/{$employee->name_id}"); ?>"><span class="fa fa-list-alt"></span></a></li>

<?php 

$url['employees_profile'] = array('uri' => 'lists_names/profile/' . $employee->name_id, 'title'=>'Employee Profile', 'access'=>hasAccess('lists', 'names', 'view'));
$url['employees_dtr'] = array('uri' => 'employees_dtr/view/' . $employee->name_id, 'title'=>'Daily Time Record', 'access'=>hasAccess('employees', 'employees', 'view'));
$url['employees_salaries'] = array('uri' => 'employees_salaries/view/' . $employee->name_id, 'title'=>'Basic Salary', 'access'=>hasAccess('employees', 'employees', 'view'));
$url['employees_earnings'] = array('uri' => 'employees_earnings/view/' . $employee->name_id, 'title'=>'Earnings', 'access'=>hasAccess('employees', 'employees', 'view'));
$url['employees_benefits'] = array('uri' => 'employees_benefits/view/' . $employee->name_id, 'title'=>'Benefits', 'access'=>hasAccess('employees', 'employees', 'view'));
$url['employees_deductions'] = array('uri' => 'employees_deductions/view/' . $employee->name_id, 'title'=>'Deductions', 'access'=>hasAccess('employees', 'employees', 'view'));

foreach($url as $k=>$v) {
  if( $v['access'] ) {
?>
  <li class="<?php echo ($k==$current_uri) ? 'active' : ''; ?>"><a class="body_wrapper" href="<?php echo site_url($v['uri']) . (($this->input->get('next')) ? '?next=' . $this->input->get('next') : ''); ?>"><?php echo $v['title']; ?></a></li>
<?php } } ?>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>