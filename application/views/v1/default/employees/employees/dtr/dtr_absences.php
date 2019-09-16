<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<div class="dropdown pull-right">
  <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <?php echo ($current_leave) ? $current_leave->name : 'All Leave'; ?>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
<?php if( $current_leave ) { ?>
    <li><a class="body_wrapper" href="<?php echo site_url("employees_dtr/absences/{$employee->name_id}"); ?>">Show All</a></li>
<?php } ?>
<?php foreach($leave_benefits as $leave_benefit) { 
if( $current_leave && ($current_leave->id==$leave_benefit->id) ) {
  continue;
}
  ?>
    <li><a class="body_wrapper" href="<?php echo site_url("employees_dtr/absences/{$employee->name_id}/{$leave_benefit->id}"); ?>"><?php echo $leave_benefit->name; ?></a></li>

<?php } ?>
  </ul>
</div>
                  <h3 class="panel-title bold">Absences</h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $absences ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Date</th>
                <th>Leave</th>
                <th class="text-center"># of Hours</th>
                <th class="text-center"># of Days</th>
                <th width="10px" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>

            <?php 
            foreach($absences as $absence) { //print_r($absence); ?>
              <tr>
                <td><?php echo date("M d, Y", strtotime($absence->date_absent)); ?> (<?php echo $absence->payroll_period; ?>)</td>
                <td><?php echo $absence->leave_type_name; ?></td>
                <td class="text-center"><?php echo $absence->hours; ?></td>
                <td class="text-center"><?php echo number_format(($absence->hours / $absence->working_hours),2,".",""); ?></td>
                <td>
                  <a data-title="Leave Benefits" data-target="#ajaxModal" href="#ajaxModal" data-toggle="modal" class="ajax-modal btn btn-xs btn-warning" data-url="<?php echo site_url("employees_dtr/add_leave/{$employee->name_id}/{$absence->date_absent}/ajax") . "?next=" . uri_string(); ?>">Update</a>
                </td>
              </tr>
            <?php } ?>
                
            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Absences Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>