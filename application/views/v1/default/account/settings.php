<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) :  ?>

<?php $this->load->view('header'); ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">Account Settings</div>
          <div class="panel-body">

            <form method="post">

<?php endif; ?>
              <div class="form-group">
              <label>Full Name</label>
              <input type="text" class="form-control" name="full_name" value="<?php echo $this->session->name; ?>">
              </div>
              <div class="form-group">
                <label>Theme</label>
                <select name="setting[theme]" class="form-control" title="- - Select Class - -">
                <?php 
                foreach(array('_company_theme_','default','cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti') as $theme) { ?>
                  <option <?php echo (($user_theme) && ($user_theme->value==$theme)) ? 'SELECTED' : ''; ?>><?php echo $theme; ?></option>
                <?php } ?>
                </select>
              </div>
              
<?php if( isset($output) && ($output!='ajax') ) : ?>

             </div>
          <div class="panel-footer">
              
                <input type="submit" class="btn btn-success" value="Submit">
              
          </div>
          </form>
        </div>
    </div>
</div>

<?php $this->load->view('footer'); ?>

<?php endif; ?>