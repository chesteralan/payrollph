<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Term</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          <div class="form-group">
            <label>Term Name</label>
            <input name="term_name" type="text" class="form-control" value="<?php echo $this->input->post('term_name'); ?>" REQUIRED>
          </div>

<div class="row">
  <div class="col-md-6">
          <div class="form-group">
            <label>Term Type</label>
            <select class="form-control" title="Select a Type" name="term_type" REQUIRED>
                <?php foreach( unserialize( TERM_TYPES ) as $key=>$type) { ?>
                  <option value="<?php echo $key; ?>" <?php echo ($key==$this->input->get('filter')) ? 'SELECTED' : ''; ?>><?php echo $type; ?></option>
                <?php } ?>
            </select>
          </div>
  </div>
  <div class="col-md-6">
          <div class="form-group">
            <label>Priority</label>
            <select class="form-control" title="Select a Priority" name="priority">
                <option value="0" selected="selected">0</option>
                <?php for($i=1;$i<=99;$i++) { ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
          </div>
  </div>
</div>

          <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="5"><?php echo $this->input->post('notes'); ?></textarea>
          </div>

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