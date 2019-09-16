<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title bold">Leave Benefits</h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $periods ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Payroll Period</th>
                <th>Year</th>
<?php if($leave_benefits) foreach($leave_benefits as $leave) {  ?>
                <th class="text-center"><?php echo $leave->name; ?></th>
<?php } ?>
                <th width="10px" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>

            <?php 
            foreach($periods as $period) { ?>
              <tr>
                <td><?php echo $period->name; ?></td>
                <td><?php echo $period->year; ?></td>
<?php if($leave_benefits) foreach($leave_benefits as $leave) {  
$var = 'period_' . $leave->id;
$var2 = 'absences_' . $leave->id;
  ?>
                <td class="text-center"><?php echo number_format($period->$var,2,".",""); ?> | 
                  <a class="body_wrapper" data-dismiss="modal" href="<?php echo site_url("employees_dtr/absences/{$employee->name_id}/{$leave->id}"); ?>"><?php echo number_format($period->$var2,2,".",""); ?></a>
                  | <?php echo number_format(($period->$var-$period->$var2),2,".",""); ?></td>
<?php } ?>
<td>
                  <a data-title="Leave Benefits" data-target="#ajaxModal" href="#ajaxModal" data-toggle="modal" class="ajax-modal btn btn-xs btn-warning" data-url="<?php echo site_url("employees/edit_leave_benefits/{$employee->name_id}/{$period->year}/ajax") . "?next=" . uri_string(); ?>">Update Leave</a>
                </td>
              </tr>
            <?php } ?>
                
            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Payroll Period Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>