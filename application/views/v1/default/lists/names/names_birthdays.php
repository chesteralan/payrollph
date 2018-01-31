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
<div class="col-md-12">
	<div class="btn-group pull-right">
  <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo ($this->input->get('month')) ? date("F", strtotime($this->input->get('month')."/1/1970")) : 'Filter by Month'; ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
<?php for($i=1;$i<=12;$i++) { ?>
    <li><a href="<?php echo site_url("lists_names/birthdays/{$company_id}"); ?>?month=<?php echo $i; ?>"><?php echo date("F", strtotime($i."/1/1970")); ?></a></li>
<?php } ?>
  </ul>
</div>
	    		<h3 class="panel-title bold">Birthdays
	    		</h3>
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
	    					<th class="text-center">Month</th>
	    					<th class="text-center">Birthday</th>
	    					<th width="10%" class="text-center">Age</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    			<?php foreach($names as $name) { ?>
	    				<tr id="name-<?php echo $name->id; ?>">
	    					<td>
<?php if( $name->is_employed ) { ?>
	<a href="javascript:void(0);" data-url="<?php echo site_url("employees/config/{$name->id}/ajax"); ?>" class="ajax-modal" data-target="#ajaxModal" data-title="Configure Employee" data-toggle="modal">
<?php } ?>
	    					<?php echo $name->full_name; ?>
<?php if( $name->is_employed ) { ?>
	</a>
<?php } ?>
	    					</td>
	    					<td  class="text-center"><a href="<?php echo site_url(uri_string()); ?>?month=<?php echo date('m', strtotime($name->birthday)); ?>"><?php echo date('F', strtotime($name->birthday)); ?></a></td>
	    					<td  class="text-center"><?php echo date('F d, Y', strtotime($name->birthday)); ?></td>
	    					<td  class="text-center"><?php echo $name->age; ?></td>
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