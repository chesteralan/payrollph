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
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Payroll" data-url="<?php echo site_url("payroll/config/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1"><span class="glyphicon glyphicon-cog"></span></a>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payroll_groups ) { ?>
  
  <?php foreach($payroll_groups as $payroll_group) { ?>
 
          <table class="table table-default" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th><?php echo $payroll_group->name; ?></th>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?></th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
            
<?php if($payroll_group->employees) { 
              foreach($payroll_group->employees as $employee) { 
              ?>
              <tr>
                <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> (<?php echo $employee->position; ?>)</td>

                <?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
                    <td class="text-right"><?php 
                    $var = 'earnings_' . $column->id;
                    echo number_format($employee->$var,2); ?></td>
                <?php } ?>
              </tr>
<?php         } 
      } ?>

            </tbody>
          </table>

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