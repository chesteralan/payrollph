<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
<a class="body_wrapper" href="<?php echo site_url("payroll_dtr/view/{$payroll->id}/{$group_id}"); ?>"><small>Daily Time Record</small></a>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>
 <?php if($payroll_group->employees) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_dtr/leave_benefits/{$payroll->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_dtr/leave_benefits/{$payroll->id}/{$payroll_group->group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
<?php } ?>
                <?php echo $payroll_group->name; ?>
<?php if(!$payroll->lock) { ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
 <a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$payroll->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>
<?php } ?>

                </th>
<?php foreach($leave_benefits as $leave) { ?>
                <th width="10%" class="text-right"><?php echo $leave->name; ?></th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
            
<?php foreach($payroll_group->employees as $employee) { ?>
              <tr>
                <td>

<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>

                <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 
                
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page&next=" . uri_string(); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>


                </td>
<?php foreach($leave_benefits as $leave) { 
$var1 = 'allowed_leave_' . $leave->id;
$var2 = 'availed_leave_' . $leave->id;

$leave_balance = ($employee->$var1 - $employee->$var2);
?>
                <td class="text-right">
<?php if(( $employee->$var1 > 0 )) { ?>
<?php echo number_format($employee->$var1,2); ?> | 
<?php if(($employee->$var2 < $employee->$var1)) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Inclusive Dates" data-url="<?php echo site_url("payroll_dtr/absences/{$payroll->id}/{$employee->name_id}/ajax") . "?next=" . uri_string() . "&leave_id=" . $leave->id; ?>" data-hide_footer="1"><?php echo number_format($employee->$var2,2); ?></a>
<?php } else { ?>
  <?php echo number_format($employee->$var2,2); ?>
<?php } ?> | <?php echo number_format($leave_balance,2); ?>
<?php } ?>
                </td>
<?php } ?>
                
              </tr>
<?php } ?>

            </tbody>
          </table>
<?php } ?>
    <?php } ?>
<?php } else { ?>

  <div class="text-center">No Group Assigned!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>