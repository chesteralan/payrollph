<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

	<div class="col-md-6 col-md-offset-3">
	    <div class="panel panel-default">
	    	<div class="panel-heading">
	    		<h3 class="panel-title">Companies : <strong><?php echo $user->name; ?></strong></h3>
	    	</div>
	    	<form method="post">
	    	<div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<ul class="list-group">
    <?php foreach($companies as $company) { ?>
      <li class="list-group-item<?php echo ($company->selected) ? ' active' : ''; ?>">
        <input type="hidden" name="company[]" value="<?php echo $company->id; ?>">
        <input type="checkbox" name="company_checked[]" value="<?php echo $company->id; ?>"<?php echo ($company->selected) ? ' CHECKED' : ''; ?>>
        <?php echo $company->name; ?>
      </li>
    <?php } ?>
</ul>

<?php if( isset($output) && ($output!='ajax') ) : ?>

	    	</div>
	    	<div class="panel-footer">
	    		<button type="submit" class="btn btn-success">Submit</button>
	    		<a href="<?php echo site_url("system_users"); ?>" class="btn btn-warning">Back</a>
	    	</div>
	    	</form>
	    </div>
    </div>
</div>
</div>

<?php $this->load->view('footer'); ?>

<?php endif; ?>