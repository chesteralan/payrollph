<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>

<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-default">
	    	<div class="panel-heading">

<div class="row">
<div class="col-md-9">

	    		<h3 class="panel-title">
 <strong><?php echo $current_page; ?></strong>
                    <?php if( $this->input->get('q') ) { ?>
                    <span class="badge"><?php echo $this->input->get('q'); ?> <a href="<?php echo site_url(uri_string()); ?>"><span class="glyphicon glyphicon-remove"></span></a></span>
                    <?php } ?>
<a href="<?php echo site_url("lists_names"); ?>?filter=trash"><span class="glyphicon glyphicon-trash"></span></a>
<a href="<?php echo site_url("lists_names/report"); ?>" class=""><span class="glyphicon glyphicon-print"></span></a>
                    <br><small><em>(<?php echo $names_count; ?> name<?php echo ($names_count>1)?"s":""; ?> found)</em></small>
	    		</h3>
</div>
<div class="col-md-3">

<form method="get" action="<?php echo site_url("lists_names"); ?>">
<div class="input-group input-group-sm">
  <input type="text" name="q" class="form-control" placeholder="Search for..." value="<?php echo $this->input->get('q'); ?>">
  <span class="input-group-btn">
    <button class="btn btn-default" type="submit">Search</button>
    
<?php if( hasAccess('lists', 'names', 'add') ) { ?>
 <a type="button" class="btn btn-success ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Name" data-url="<?php echo site_url("lists_names/add/ajax") . "?next=" . uri_string(); ?>">Add Name</a>
<?php } ?>
  </span>
</div><!-- /input-group -->
</form>
</div>
</div>
	    	</div>
	    	<div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>
<?php if( $names ) { ?>
	    		<table class="table table-default hidden-xs table-hover">
	    			<thead>
	    				<tr>
	    					<th>Full Name</th>
	    					<th class="text-center">Company</th>
	    					<th width="10%" class="text-center">Age</th>
	    					<?php if( hasAccess('lists', 'names', 'edit') ) { ?>
	    					<th width="175px">Action</th>
	    					<?php } ?>
	    				</tr>
	    			</thead>
	    			<tbody>
	    			<?php foreach($names as $name) { ?>
	    				<tr id="name-<?php echo $name->id; ?>">
	    					<td>
<?php if( $name->is_employed ) { ?>
	<a href="javascript:void(0);" data-url="<?php echo site_url("employees/config/{$name->id}/ajax") . "?next=" . uri_string(); ?>" class="ajax-modal" data-hide_footer="1" data-target="#ajaxModal" data-title="Configure Employee" data-toggle="modal">
<?php } ?>
	    					<?php echo $name->full_name; ?>
<?php if( $name->is_employed ) { ?>
	</a>
<?php } ?>
	    					</td>
	    					<td  class="text-center"><?php echo $name->company; ?></td>
	    					<td  class="text-center"><?php echo $name->age; ?></td>
	    					<?php if( hasAccess('lists', 'names', 'edit') ) { ?>
	    					<td>
<?php if( $name->trash == 0) { ?>

							

  <a class="btn btn-info btn-xs body_wrapper" href="<?php echo site_url("lists_names/profile/{$name->id}"); ?>">Profile</a>
 

	    					<button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Name" data-url="<?php echo site_url("lists_names/edit/{$name->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

	    					<a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("lists_names/delete/{$name->id}"); ?>" data-target="#name-<?php echo $name->id; ?>">Trash</a>
<?php } else { ?>
							<a class="btn btn-success btn-xs confirm" href="<?php echo site_url("lists_names/restore/{$name->id}"); ?>">Restore</a>
<?php } ?>
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