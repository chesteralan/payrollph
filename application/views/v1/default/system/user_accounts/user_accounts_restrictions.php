<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

	<div class="col-md-6 col-md-offset-3">
	    <div class="panel panel-default">
	    	<div class="panel-heading">
	    		<h3 class="panel-title">Restrictions : <strong><?php echo $user->name; ?></strong></h3>
	    	</div>
	    	<form method="post">
	    	<div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  
<?php 
$rest_depts = array();
$rest = array();
foreach($user_restrictions as $ur) {
    $rest[$ur->department][$ur->section]['view'] = $ur->view;
    $rest[$ur->department][$ur->section]['add'] = $ur->add;
    $rest[$ur->department][$ur->section]['edit'] = $ur->edit;
    $rest[$ur->department][$ur->section]['delete'] = $ur->delete;

    if( $ur->view || $ur->add || $ur->edit || $ur->delete ) {
        $rest_depts[$ur->department] = 1;
    }
}
$dept = unserialize(USERACCOUNTS_RESTRICTIONS);

?>
<?php foreach($dept as $id=>$dep) { ?>
  <div class="panel panel-<?php echo (isset($rest_depts[$id])) ? 'success' : 'default'; ?>">
    <div class="panel-heading" role="tab" id="heading-<?php echo $id; ?>">
      <h4 class="panel-title">
        <input type="checkbox" name="" value="" class="pull-right select_all_by_class" data-class="restriction_<?php echo $id; ?>">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $id; ?>" aria-expanded="true" aria-controls="collapseOne">
          <?php echo $dep->title; ?>
        </a>
      </h4>
    </div>
    <div id="collapse-<?php echo $id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo $id; ?>">
      <div class="panel-body">
        <table class="table table-hover">
        	<thead>
        	<tr>
        		<th>Section</th>
        		<th class="text-center" width="5%">View</th>
        		<th class="text-center" width="5%">Add</th>
        		<th class="text-center" width="5%">Edit</th>
        		<th class="text-center" width="5%">Delete</th>
        	</tr>
        	</thead>
        	<tbody>
        	<?php foreach($dep->sections as $sect_id=>$sect_name) { ?>
        	<tr>
        		<td><?php echo $sect_name; ?></td>
        		<td class="text-center"><input <?php echo (isset($rest[$id][$sect_id]['view']) && $rest[$id][$sect_id]['view']) ? 'CHECKED' : ''; ?> type="checkbox" name="r[<?php echo $id; ?>][<?php echo $sect_id; ?>][view]" value="1" class="restriction_<?php echo $id; ?> <?php echo $id; ?>_<?php echo $sect_id; ?>_view"></td>
        		<td class="text-center"><input <?php echo (isset($rest[$id][$sect_id]['add']) && $rest[$id][$sect_id]['add']) ? 'CHECKED' : ''; ?> type="checkbox" name="r[<?php echo $id; ?>][<?php echo $sect_id; ?>][add]" value="1" class="restriction_<?php echo $id; ?> <?php echo $id; ?>_<?php echo $sect_id; ?>_add"></td>
        		<td class="text-center"><input <?php echo (isset($rest[$id][$sect_id]['edit']) && $rest[$id][$sect_id]['edit']) ? 'CHECKED' : ''; ?> type="checkbox" name="r[<?php echo $id; ?>][<?php echo $sect_id; ?>][edit]" value="1" class="restriction_<?php echo $id; ?> <?php echo $id; ?>_<?php echo $sect_id; ?>_edit"></td>
        		<td class="text-center"><input <?php echo (isset($rest[$id][$sect_id]['delete']) && $rest[$id][$sect_id]['delete']) ? 'CHECKED' : ''; ?> type="checkbox" name="r[<?php echo $id; ?>][<?php echo $sect_id; ?>][delete]" value="1" class="restriction_<?php echo $id; ?> <?php echo $id; ?>_<?php echo $sect_id; ?>_delete"></td>
        	</tr>
        	<?php } ?>
        	</tbody>
        </table>
      </div>
    </div>
  </div>
<?php } ?>

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