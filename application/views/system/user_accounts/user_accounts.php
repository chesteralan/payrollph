<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-default">
	    	<div class="panel-heading">
<?php if( hasAccess('system', 'users', 'add') ) { ?>
	<button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add User" data-url="<?php echo site_url("system_users/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add User</button>
<?php } ?>
	    		<h3 class="panel-title">User Accounts</h3>
	    	</div>
	    	<div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $users ) { ?>

	    		<table class="table table-default">
	    			<thead>
	    				<tr>
	    					<th>Full Name</th>
	    					<th>Username</th>
	    					<?php if( hasAccess('system', 'users', 'edit') ) { ?>
	    						<th width="145px">Action</th>
	    					<?php } ?>
	    				</tr>
	    			</thead>
	    			<tbody>
	    			<?php foreach($users as $user) { ?>
	    				<tr>
	    					<td><?php echo $user->name; ?></td>
	    					<td><?php echo $user->username; ?></td>
	    				<?php if( hasAccess('system', 'users', 'edit') ) { ?>
	    					<td>

	    					<button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit User : <?php echo $user->name; ?>" data-url="<?php echo site_url("system_users/edit/{$user->id}/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Edit</button>

	    					
	    					<?php if( $this->session->user_id != $user->id) { ?>
	    						<button type="button" class="btn btn-success btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Restrictions : <?php echo $user->name; ?>" data-url="<?php echo site_url("system_users/restrictions/{$user->id}/ajax") . "?next=" . uri_string(); ?>">Restrictions</button>
	    					<?php } ?>
	    					</td>
	    				<?php } ?>
	    				</tr>
	    			<?php } ?>
	    			</tbody>
	    		</table>

	    		<?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>
	<div class="text-center">No User Found!</div>
<?php } ?>

<?php if( ! $inner_page ): ?>

	    	</div>
	    </div>
    </div>
</div>
</div>

<?php endif; ?>

<?php $this->load->view('footer'); ?>