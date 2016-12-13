<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-default">
	    	<div class="panel-heading">
	    		<a href="<?php echo site_url("employees/add"); ?>" class="btn btn-success btn-xs pull-right">Add Employee</a>
	    		<h3 class="panel-title">Employee Records</h3>
	    	</div>
	    	<div class="panel-body">
<?php if( $employees ) { ?>
	    		<table class="table table-default">
	    			<thead>
	    				<tr>
	    					<th>Full Name</th>
	    					<th>Username</th>
	    					<th width="10px">Action</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    			<?php foreach($employees as $employee) { ?>
	    				<tr>
	    					<td><?php echo $employee->firstname; ?></td>
	    					<td><?php echo $employee->lastname; ?></td>
	    					<td><a href="<?php echo site_url("employees/edit/" . $employee->id); ?>" class="btn btn-warning btn-xs">Edit</a></td>
	    				</tr>
	    			<?php } ?>
	    			</tbody>
	    		</table>
<?php } else { ?>
	<p class="text-center">No Employees Yet!</p>
<?php }  ?>
	    	</div>
	    </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>