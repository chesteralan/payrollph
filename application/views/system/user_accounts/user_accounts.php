<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-default">
	    	<div class="panel-heading">
	    		<a href="<?php echo site_url("system_users/add"); ?>" class="btn btn-success btn-xs pull-right">Add User</a>
	    		<h3 class="panel-title">User Accounts</h3>
	    	</div>
	    	<div class="panel-body">
<?php if( $users ) { ?>
	    		<table class="table table-default">
	    			<thead>
	    				<tr>
	    					<th>Full Name</th>
	    					<th>Username</th>
	    					<th width="10px">Action</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    			<?php foreach($users as $user) { ?>
	    				<tr>
	    					<td><?php echo $user->name; ?></td>
	    					<td><?php echo $user->username; ?></td>
	    					<td><a href="<?php echo site_url("system_users/edit/" . $user->id); ?>" class="btn btn-warning btn-xs">Edit</a></td>
	    				</tr>
	    			<?php } ?>
	    			</tbody>
	    		</table>
<?php } else { ?>
	<p class="text-center">No Backup Yet!</p>
<?php }  ?>
	    	</div>
	    </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>