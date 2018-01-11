<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

	<div class="col-md-6 col-md-offset-3">
	    <div class="panel panel-default">
	    	<div class="panel-heading">
	    		<h3 class="panel-title">Add User Account</h3>
	    	</div>
	    	<form method="post">
	    	<div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

	    		<div class="form-group">
	    			<label>Full Name</label>
	    			<input name="full_name" type="text" class="form-control" value="<?php echo $this->input->post('full_name'); ?>">
	    		</div>
	    		<div class="form-group">
	    			<label>Username</label>
	    			<input name="username" type="text" class="form-control" value="<?php echo $this->input->post('username'); ?>">
	    		</div>
	    		<div class="form-group">
	    			<label>Password</label>
	    			<input name="password" type="password" class="form-control" value="<?php echo $this->input->post('password'); ?>">
	    		</div>
	    		<div class="form-group">
	    			<label>Repeat Password</label>
	    			<input name="password2" type="password" class="form-control" value="<?php echo $this->input->post('password2'); ?>">
	    		</div>

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