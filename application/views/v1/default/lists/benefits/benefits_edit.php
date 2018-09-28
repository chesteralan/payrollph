<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Benefit</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          <div class="form-group">
            <label>Benefit Name</label>
            <input name="benefit_name" type="text" class="form-control" value="<?php echo $benefit->name; ?>">
          </div>

          <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control"><?php echo $benefit->notes; ?></textarea>
          </div>

          <div class="form-group">
            <label><input name="leave" type="checkbox" value="1" <?php echo ($benefit->leave) ? 'CHECKED' : ''; ?>> Leave Benefit</label>
          </div>

          <div class="form-group">
            <label>Employee Share Account Title (Accounting)</label>
            <input name="ee_account_title" type="text" class="form-control" value="<?php echo $benefit->ee_account_title; ?>">
          </div>

          <div class="form-group">
            <label>Employer Share Account Title (Accounting)</label>
            <input name="er_account_title" type="text" class="form-control" value="<?php echo $benefit->er_account_title; ?>">
          </div>

          <div class="form-group">
            <label>Abbreviation</label>
            <input name="abbr" type="text" class="form-control" value="<?php echo $benefit->abbr; ?>">
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