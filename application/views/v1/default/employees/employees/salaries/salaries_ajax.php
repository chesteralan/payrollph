<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php if( $salaries ) { ?>

<div class="list-group">
  <?php foreach($salaries as $salary) { 

$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
switch( $salary->rate_per ) {
  case 'month':
    $monthly_rate = $salary->amount;
    $daily_rate = ( $salary->amount / $salary->days );
    $hourly_rate = ( $salary->amount / $salary->days / $salary->hours );
  break;
  case 'day':
    $monthly_rate = ( $salary->amount * $salary->days );
    $daily_rate = $salary->amount;
    $hourly_rate = ( $salary->amount / $salary->hours );
  break;
  case 'hour':
    $monthly_rate = ( $salary->amount * $salary->days * $salary->hours );
    $daily_rate = ( $salary->amount * $salary->hours );
    $hourly_rate = $salary->amount;
  break;
}
    ?>
  <a data-target="#ajaxModal" class="ajax-modal-inner list-group-item <?php echo ($salary->primary==1) ? 'active' : ''; ?>" data-title="Edit Basic Salary" href="<?php echo site_url("employees_salaries/edit/{$salary->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>">
    <h4 class="list-group-item-heading">
    <span class="pull-right"><?php echo number_format($monthly_rate,2); ?></span>
    Monthly Rate</h4>
    <p class="list-group-item-text">Daily Rate: <strong><?php echo number_format($daily_rate,2); ?></strong> &middot; Hourly Rate: <strong><?php echo number_format($hourly_rate,2); ?></strong> &middot; COLA: <strong><?php echo number_format($salary->cola,2); ?></strong> &middot; Days: <strong><?php echo $salary->days; ?></strong> &middot; Hours: <strong><?php echo $salary->hours; ?></strong></p>
  </a>
  <?php } ?>

</div>

<?php } else { ?>

<p class="text-center">No Salary Found!</p>

<p class="text-center"><a href="<?php echo site_url("employees_salaries/add/{$name_id}/ajax") . '?next=' . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Add Salary">Add Salary</a></p>

<?php }  ?>