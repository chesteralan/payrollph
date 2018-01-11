<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">Change Password</div>
          <div class="panel-body">
<?php if($this->input->get('success')) { echo bootstrap_alert("Password Successfully Updated!"); } ?>
<?php if($this->input->get('error')) { echo bootstrap_alert("Unable to change password!", 'danger'); } ?>
            <form method="post">

<?php endif; ?>

              <div class="form-group">
                <label>Current Password</label>
                <input type="password" class="form-control" placeholder="Current Password" name="current_password" required="required">
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" placeholder="New Password" name="new_password" required="required">
              </div>
              <div class="form-group">
                <label>Repeat Password</label>
                <input type="password" class="form-control" placeholder="Repeat Password" name="repeat_password" required="required">
              </div>

<?php if( isset($output) && ($output!='ajax') ) : ?>

              <div class="form-group">
                <input type="submit" class="btn btn-success" value="Submit">
              </div>
            </form>
          </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer'); ?>

<?php endif; ?>