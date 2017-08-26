<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add <?php echo $earning_data->name; ?></h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="row">
  <div class="col-md-6">
          <div class="form-group">
            <label>Amount</label>
            <input name="amount" type="text" class="form-control text-center" value="<?php echo number_format($earning->amount,2); ?>" required>
          </div>
  </div>
      <div class="col-md-6">
          <div class="form-group">
            <label>Connect to</label>
            <select name="entry_id" class="form-control">
                <option value="0">- - No Connection - -</option>
                <?php foreach($employees_earnings as $entry) { ?>
                    <option value="<?php echo $entry->id; ?>" <?php echo ($earning->entry_id==$entry->id) ? 'SELECTED' : ''; ?>><?php echo $earning_data->name; ?> (Amount: <?php echo number_format($entry->amount,2); ?>)</option>
                <?php } ?>
            </select>
          </div>
  </div>
</div> 

  

          <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3"><?php echo $earning->notes; ?></textarea>
          </div>

<?php if( isset($output) && ($output=='ajax') ) : ?>
<?php if( $earning->entry_id ) { ?>
<a href="<?php echo site_url("employees_earnings/entries/{$earning->entry_id}/ajax") . (($this->input->get('next')) ? "?next=" . $this->input->get('next') : ""); ?>" data-dismiss="modal" class="btn btn-success btn-xs ajax-modal-inner" data-title="Related Entries" data-hide_footer="1">View Related Entries</a>
<?php } ?>
<a href="<?php echo site_url("payroll_earnings/delete/{$earning->id}") . (($this->input->get('next')) ? "?next=" . $this->input->get('next') : ""); ?>" class="btn btn-danger btn-xs confirm">Delete this entry</a>

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