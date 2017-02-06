<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add <?php echo $deduction_data->name; ?></h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="row">
  <div class="col-md-6">
          <div class="form-group">
            <label>Amount</label>
            <input name="amount" type="text" class="form-control text-center" value="<?php echo number_format($deduction->amount,2); ?>" required>
          </div>
  </div>
  <div class="col-md-6"></div>
</div> 

  
          <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3"><?php echo $deduction->notes; ?></textarea>
          </div>

<?php if( isset($output) && ($output=='ajax') ) : ?>

<a href="<?php echo site_url("employees_deductions/entries/{$deduction->entry_id}/ajax"); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Related Entries">View Related Entries</a>

<a href="<?php echo site_url("payroll_deductions/delete/{$deduction->id}"); ?>" class="btn btn-danger btn-xs confirm">Delete this entry</a>
<?php endif; ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>
        <div class="panel-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="<?php echo site_url($current_uri); ?>" class="btn btn-warning">Back</a>
        </div>
        </form>
      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>