<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit <?php echo $deduction_data->name; ?></h3>
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
  <div class="col-md-6">
          <div class="form-group">
            <label>Connect to</label>
            <select name="entry_id" class="form-control">
                <option value="0">- - No Connection - -</option>
                <?php foreach($employees_deductions as $entry) { ?>
                    <option value="<?php echo $entry->id; ?>" <?php echo ($deduction->entry_id==$entry->id) ? 'SELECTED' : ''; ?>><?php echo $deduction_data->name; ?> (Max: <?php echo number_format($entry->max_amount,2); ?> - Bal: <?php echo number_format($entry->balance,2); ?>)</option>
                <?php } ?>
            </select>
          </div>
  </div>
</div> 

  
          <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3"><?php echo $deduction->notes; ?></textarea>
          </div>

<?php if( isset($output) && ($output=='ajax') ) : ?>
<?php if( $deduction->entry_id ) { ?>
<?php if( !$this->input->get('edit_only') ) { ?>
<a href="<?php echo site_url("employees_deductions/entries/{$deduction->entry_id}/ajax") . (($this->input->get('next')) ? '?next=' . $this->input->get('next') : "payroll_deductions/view/{$deduction->payroll_id}"); ?>" class="btn btn-success btn-xs ajax-modal-inner" data-title="Related Entries" data-hide_footer="1">View Related Entries</a>
<?php } ?>
<?php } ?>
<a href="<?php echo site_url("payroll_deductions/delete/{$deduction->id}") . (($this->input->get('next')) ? '?next=' . $this->input->get('next') : "payroll_deductions/view/{$deduction->payroll_id}"); ?>" class="btn btn-danger btn-xs confirm">Delete this entry</a>
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