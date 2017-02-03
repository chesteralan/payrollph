<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add Employee</h3>
        </div>
        <form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>
<?php endif; ?>
          
         <div class="form-group">
            <label>Benefit</label>
            <select class="form-control" title="Select a Benefit" name="benefit_id" required>
            <?php foreach($benefits as $bene) { ?>
                <option value="<?php echo $bene->id; ?>"<?php echo ($benefit->benefit_id==$bene->id) ? ' SELECTED' : ''; ?>><?php echo $bene->name; ?></option>
            <?php } ?>
            </select>
          </div>  

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Employee Share</label>
            <input name="ee_share" type="text" class="form-control text-center" value="<?php echo number_format($benefit->employee_share,2); ?>" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Employer Share</label>
            <input name="er_share" type="text" class="form-control text-center" value="<?php echo number_format($benefit->employer_share,2); ?>" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
              <div class="form-group">
                <label>Start Date</label>
                <input name="start_date" type="text" class="form-control text-center datepicker" value="<?php echo date('m/d/Y', strtotime($benefit->start_date)); ?>" required>
              </div>
        </div>
        <div class="col-md-6">

        </div>
      </div>

<div class="form-group">
    <label>Notes</label>
    <textarea name="notes" class="form-control" rows="5"><?php echo $benefit->notes; ?></textarea>
  </div>

              <div class="form-group">
                <p><label><input name="primary" type="checkbox" value="1"<?php echo ($benefit->primary) ? ' CHECKED' : ''; ?>> Set as Primary</label></p>
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