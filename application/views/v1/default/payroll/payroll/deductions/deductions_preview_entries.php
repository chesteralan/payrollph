<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a class="btn btn-success btn-xs pull-right" href="<?php echo site_url("employees_deductions/add/{$payroll_id}/{$name_id}/{$deduction_id}") . '?next=' . uri_string(); ?>">Add Entry</a>
          <a style="margin-right:10px" class="btn btn-warning btn-xs pull-right" href="<?php echo site_url("employees_deductions/summary/{$deduction_id}/{$name_id}") . '?next=' . uri_string(); ?>">Summary</a>
          <h3 class="panel-title"><?php echo $deduction_data->name; ?></h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( isset($output) && ($output=='ajax') ) : ?>

<p><a href="<?php echo site_url("employees_deductions/add/{$name_id}/ajax") . "?template_id={$template_id}&deduction_id={$deduction_id}&next=" . $this->input->get('next'); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Add Entry - <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>">Add Entry</a>
</p>

<?php endif; ?>

<?php if( $deductions ) { ?>

<div class="list-group">

<?php 

foreach($deductions as $deduction) { 

$ee_amount = 0;

    switch( $deduction->computed ) {
      case 'hour':
        $eamount = $deduction->amount * $days_present;
      break;
      case 'day':
        $eamount = $deduction->amount * $days_present;
      break;
      case 'month':
      default:
        $eamount = $deduction->amount;
      break;
    }

    if (isset($deduction->multiplier)) {
      switch( $deduction->multiplier ) { 
        case 'employment':
          $end_date = new DateTime(date('Y-m-d'));
          $hired = new DateTime($employee->hired);
          $diff = $hired->diff($end_date);
          $eamount = $eamount * $diff->y;
        break;
        case 'birthday':
          $end_date = new DateTime(date('Y-m-d'));
          $birth_date = new DateTime($employee->birthday);
          $diff = $birth_date->diff($end_date);
          $eamount = $eamount * $diff->y;
        break;
      }
    }

    $ee_amount += $eamount;


  ?>

<a data-target="#ajaxModal" data-title="Edit Entry - <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" class="list-group-item ajax-modal-inner" href="<?php echo site_url("employees_deductions/edit/{$deduction->ped_id}/{$output}") . "?next=" . $this->input->get('next'); ?>">

   <span class="badge pull-right"><?php echo number_format($ee_amount,2); ?></span>
    <h4 class="list-group-item-heading"><?php echo $deduction->name; ?></h4>
    <p class="list-group-item-text"><?php echo $deduction->enotes; ?></p>

</a>


<?php } ?>

</div>

<?php } else { ?>

<p class="text-center">No Entry Found!</p>

<?php }  ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>

      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>