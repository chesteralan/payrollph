<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

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

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label>First name</label>
			<input name="firstname" type="text" class="form-control" value="<?php echo $this->input->post('firstname'); ?>">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label>Middle name</label>
			<input name="middlename" type="text" class="form-control" value="<?php echo $this->input->post('middlename'); ?>">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label>Last name</label>
			<input name="lastname" type="text" class="form-control" value="<?php echo $this->input->post('lastname'); ?>">
		</div>
	</div>
</div>

<div class="form-group">
			<label>Address</label>
			<input name="address" type="text" class="form-control" value="<?php echo $this->input->post('address'); ?>">
		</div>

		<div class="form-group">
			<label>Phone Number</label>
			<input name="phonenumber" type="text" class="form-control" value="<?php echo $this->input->post('phonenumber'); ?>">
		</div>
	    		
	    		
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