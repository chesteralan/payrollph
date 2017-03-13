<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

                <a class="pull-right close" href="<?php echo site_url("payroll_benefits/item_schedule/{$payroll->id}/{$benefit_data->id}/print"); ?>" target="_blank"><span class="glyphicon glyphicon-print"></span></a>

                  <h3 class="panel-title"><strong><?php echo $benefit_data->name; ?> - <?php echo $benefit_data->notes; ?></strong>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $item_data ) {  ?>

          <table class="table table-default table-hover" id="Payroll-Group">
            <thead>
              <tr class="warning">
                <th>Employee Name</th>
                <th width="20%" class="text-right">Employee Share</th>
                <th width="20%" class="text-right">Employer Share</th>
                <th width="20%" class="text-right">Total Payable</th>
              </tr>
            </thead>
            <tbody>
            
<?php 
$total_ee_share = 0;
$total_er_share = 0;
$total_payment = 0;
foreach($item_data as $item) { 
$total_ee_share += $item->employee_share;
$total_er_share += $item->employer_share;
$total_payment += $item->employee_share + $item->employer_share;
              ?>
              <tr>
                <td><?php echo $item->lastname; ?>, <?php echo $item->firstname; ?> <?php echo substr($item->middlename,0,1)."."; ?>
                <a href="<?php echo site_url("employees_benefits/view/{$item->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper"><span class="glyphicon glyphicon-cog"></span></a>
                </td>
                <td class="text-right"><?php echo number_format($item->employee_share,2); ?></td>
                <td class="text-right"><?php echo number_format($item->employer_share,2); ?></td>
                <td class="text-right"><?php echo number_format(($item->employee_share + $item->employer_share),2); ?></td>
              </tr>
<?php } ?>

              <tr class="success">
                <td><strong>Total</strong></td>
                <td class="text-right"><strong><?php echo number_format($total_ee_share,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_er_share,2); ?></strong></td>
                <td class="text-right"><strong><?php echo number_format($total_payment,2); ?></strong></td>
              </tr>
            </tbody>
          </table>


<?php } else { ?>

    <div class="text-center">No Item Found!</div>

<?php }  ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>