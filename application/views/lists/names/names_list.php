<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-default">
	    	<div class="panel-heading">
<?php if( hasAccess('lists', 'names', 'add') ) { ?>
 <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Name" data-url="<?php echo site_url("lists_names/add/ajax") . "?next=" . uri_string(); ?>">Add Name</button>
<?php } ?>
	    		<h3 class="panel-title">Names List</h3>
	    	</div>
	    	<div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $names ) { ?>
	    		<table class="table table-default hidden-xs">
	    			<thead>
	    				<tr>
	    					<th>Full Name</th>
	    					<th>Address</th>
	    					<th>Contact Number</th>
	    					<?php if( hasAccess('lists', 'names', 'edit') ) { ?>
	    					<th width="50px">Action</th>
	    					<?php } ?>
	    				</tr>
	    			</thead>
	    			<tbody>
	    			<?php foreach($names as $name) { ?>
	    				<tr>
	    					<td>
<?php if( $name->is_employed ) { ?>
	<a href="<?php echo site_url("employees/config/{$name->id}"); ?>" class="body_wrapper">
<?php } ?>
	    					<?php echo $name->full_name; ?>
<?php if( $name->is_employed ) { ?>
	</a>
<?php } ?>
	    					</td>
	    					<td><?php echo $name->address; ?></td>
	    					<td><?php echo $name->contact_number; ?></td>
	    					<?php if( hasAccess('lists', 'names', 'edit') ) { ?>
	    					<td>

	    					<button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Name" data-url="<?php echo site_url("lists_names/edit/{$name->id}/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Edit</button>
	    					
	    					</td>
	    					<?php } ?>
	    				</tr>
	    			<?php } ?>
	    			</tbody>
	    		</table>

<ul class="list-group visible-xs">
  <?php foreach($names as $name) { 
if($name->members > 0) {
	$uri = "membership_members/member_data/{$name->id}";
} elseif($name->companies > 0) {
	$uri = "membership_companies/info/{$name->id}";
}
  	?>
      <a href="#<?php echo site_url("lists_names/edit/{$name->id}"); ?>" class="list-group-item ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Name" data-url="<?php echo site_url("lists_names/edit/{$name->id}/ajax") . "?next=" . uri_string(); ?>">
        <h4 class="list-group-item-heading"><?php echo $name->full_name; ?></h4>
      </a>
    <?php } ?>
</ul>

<?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>
	<div class="text-center">No Name Found!</div>
<?php } ?>

<?php if( ! $inner_page ): ?>

	    	</div>
	    </div>
    </div>
</div>
</div>

<?php endif; ?>

<?php $this->load->view('footer'); ?>