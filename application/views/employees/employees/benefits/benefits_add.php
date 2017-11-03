<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Benefit</h3>
        </div>
        <form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>
        
          <div class="form-group">
            <label>Benefit</label>
<?php if( $this->input->get('benefit_id') ) { ?>
<div class="form-control">
  <input type="hidden" name="benefit_id" value="<?php echo $this->input->get('benefit_id'); ?>">
  <?php foreach($benefits as $benefit) { 
    echo ($benefit->id==$this->input->get('benefit_id')) ? $benefit->name . ' - ' . $benefit->notes : '';
  } ?>
</div>
<?php } else { ?>
            <select class="form-control" title="Select a Benefit" name="benefit_id" required>
            <?php 
            $selected = $this->input->get('benefit_id');
            foreach($benefits as $benefit) { ?>
                <option value="<?php echo $benefit->id; ?>"<?php echo ($benefit->id==$selected) ? ' SELECTED' : ''; ?>><?php echo $benefit->name; ?><?php echo ($benefit->notes) ? ' - ' . $benefit->notes : ''; ?></option>
            <?php } ?>
            </select>
<?php } ?>
          </div>  

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Employee Share</label>
            <input name="ee_share" type="text" class="form-control text-center" value="" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Employer Share</label>
            <input name="er_share" type="text" class="form-control text-center" value="" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
              <div class="form-group">
                <label>Start Date</label>
                <input name="start_date" type="text" class="form-control text-center datepicker" value="<?php echo date('m/d/Y'); ?>" required>
              </div>
        </div>
        <div class="col-md-6">

        </div>
      </div>

      <div class="form-group">
    <label>Notes</label>
    <textarea name="notes" class="form-control" rows="3"></textarea>
  </div>


      <div class="row">          
        <div class="col-md-6">
              <div class="form-group">
                <p><label><input name="primary" type="checkbox" value="1" CHECKED> Set as Primary</label></p>
              </div>
        </div>
        <div class="col-md-6">
              <div class="form-group">
              <?php foreach($templates as $template) { ?>
                <p><label>
                  <input name="template_selected[]" type="checkbox" value="<?php echo $template->id; ?>" CHECKED> Generate on: <?php echo $template->name; ?>
                </label></p>
              <?php } ?>
              </div>
        </div>
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