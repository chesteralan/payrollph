<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_by_name_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<?php if( ($years) && (count($years)>1) ) { ?>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo ($this->input->get('filter_by_year')) ? $this->input->get('filter_by_year') : 'Filter by Year'; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
<?php if($this->input->get('filter_by_year')) { ?>
  <li><a href="<?php echo site_url(uri_string()) . (($this->input->get('filter'))?'?filter=' . $this->input->get('filter'):''); ?>">Show All</a></li>
<?php } ?>
<?php foreach($years as $year) { 
  if($this->input->get('filter_by_year')==$year->year) {
    continue;
  }
  ?>
    <li><a href="<?php echo site_url(uri_string()) . "?filter_by_year=" . $year->year . (($this->input->get('filter'))?'&filter=' . $this->input->get('filter'):''); ?>"><?php echo $year->year; ?></a></li>
<?php } ?>
  </ul>
</div>
<?php } ?>

<?php if( ($earnings) && (count($earnings)>1) ) { ?>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo (isset($earning)) ? $earning->name : 'Filter by Earning'; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
<?php if($this->input->get('filter')) { ?>
  <li><a href="<?php echo site_url(uri_string()) . (($this->input->get('filter_by_year'))?'?filter_by_year=' . $this->input->get('filter_by_year'):'') ?>">Show All</a></li>
<?php } ?>
<?php foreach($earnings as $earn) { 
if( isset($earning) && ($earn->id==$earning->id) ) {
    continue;
}
  ?>
    <li><a href="<?php echo site_url(uri_string()) . "?filter=" . $earn->id . (($this->input->get('filter_by_year'))?'&filter_by_year=' . $this->input->get('filter_by_year'):''); ?>"><?php echo $earn->name; ?></a></li>
<?php } ?>
  </ul>
</div>
<?php } ?>

                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong> <?php echo (isset($earning)) ? "<span class='badge'>{$earning->name}</span>" : ''; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payrolls ) { ?>

 <table class="table table-default table-hover">
            <thead>
              <tr class="warning">
                <th>Payroll</th>
                <th width="10%" class="text-right">Total Earnings</th>
              </tr>
            </thead>
            <tbody>
<?php foreach($payrolls as $payroll) {  ?>
  <tr>
        <td>
        <a class="body_wrapper" href="<?php echo site_url("payroll_dtr/view/{$payroll->payroll_id}/0"); ?>">
        <?php echo $payroll->name; ?>
        </a>
        </td>
        <td class="text-right"><?php echo number_format($payroll->total_earnings,2); ?></td>
  </tr>
<?php } ?>
            </tbody>
            </table>

            <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Payroll Found!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>