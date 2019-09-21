<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
<?php if( $this->input->get('show') != 'all' ) { ?>
        <a href="<?php echo site_url(uri_string()) . "?show=all"; ?>" class="btn btn-success btn-xs pull-right confirm">Show All Tables</a>
<?php } else { ?>
	<a href="<?php echo site_url(uri_string()); ?>" class="btn btn-danger btn-xs pull-right confirm">Verify Tables</a>
<?php } ?>
          <h3 class="panel-title">Verify Tables </h3>

        </div>
        <div class="panel-body" id="ajaxBodyInnerPage">
<?php
	function differ1($table_options, $table_columns) {
		$current_columns = array();
		$only_columns = array();
		$error = false;
		if($table_options) {
			foreach($table_options as $to) {
				if( !in_array($to->Field, $only_columns)) {
					$only_columns[] = $to->Field;
				}
			}
		}
		if($table_columns) {
			foreach($table_columns as $tc) {
				if( isset($table_options[$tc->Field]) ) {
					foreach($tc as $k=>$v) {
						if( $v != $table_options[$tc->Field]->$k ) {
							$error = true;
						} else {
							if( !in_array($tc->Field, $current_columns)) {
								$current_columns[] = $tc->Field;
							}
						}
					}
				} else {
					$error = true;
				}
			}

		}
		if($table_options) {
			foreach($table_options as $to) {
				if( !in_array($to->Field, $current_columns)) {
					$error = true;
				}
			}
		}
		return $error;
	} 
?>
<?php if( $models ) { 

$model_n = 0;
$is_all_verified = true;
if( count($missing_tables) > 0 ) {
	$is_all_verified = false;
}
foreach($models as $model) { 

$differ = differ1($model->table_options, $model->table_columns);
if( !$differ ) {
	if( $this->input->get('show') != 'all' ) {
		continue;
	}
} else {
	$is_all_verified = false;
}

$model_n++;
?>
<?php if($model_n==1) { ?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php } ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $model->table_name; ?>" aria-expanded="true" aria-controls="collapseOne">

        <span class="pull-right">
        <?php echo ( $differ ) ? "<span class='glyphicon glyphicon-remove' style='color:red'></span>" : "<span class='glyphicon glyphicon-ok' style='color:green'></span>"; ?>
        </span>

          <?php echo $model->table_name; ?>
        </a>
      </h4>
    </div>
    <div id="<?php echo $model->table_name; ?>" class="panel-collapse collapse <?php echo ($model->table_name==$this->input->get('table')) ? 'in' : ''; ?>" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
		      		<?php $current_columns = array(); ?>
		      		<?php if( $model->table_columns ) foreach($model->table_columns as $tc) { 

		      			?>
				      		<?php 
$echo_table = true;
				      		foreach($tc as $k=>$v) { 

$uri = false;
if( $k == 'Field' ) {
	$field_name = $v;
	if( !in_array($v, $current_columns)) {
		$current_columns[] = $v;
	}
}
if( $k == 'Type' ) {
	$field_type = urlencode($v);
}
$tov = (isset($model->table_options[$field_name])) ? $model->table_options[$field_name]->$k : "";

$tov_encode = urlencode( $tov );
if( $v != $tov) {
	switch($k) {
		case 'Field':
			$uri = "system_database/remove_field/{$model->table_name}/{$field_name}";
			break;
		case 'Type':
			$uri = "system_database/fix_type/{$model->table_name}/{$field_name}/{$tov_encode}";
			break;
		case 'Null':
			$uri = "system_database/fix_null/{$model->table_name}/{$field_name}/{$field_type}/{$tov_encode}";
			break;
		case 'Key':
			$uri = "system_database/fix_key/{$model->table_name}/{$field_name}/{$tov_encode}";
			break;
		case 'Default':
			$uri = "system_database/fix_default/{$model->table_name}/{$field_name}/{$field_type}/{$tov_encode}";
			break;
		case 'Extra':
			$uri = "system_database/fix_extra/{$model->table_name}/{$field_name}/{$field_type}/{$tov_encode}";
			break;
	}
} else {
	if( $this->input->get('show') != 'all' ) {
		continue;
	}
}

				      			?>
<?php if( $echo_table ) { 
$echo_table = false;
	?>
						<table class="table table-striped table-hover">
				      		<tbody>
<?php } ?>
				      			<tr>
				      				<td><strong><?php echo $k; ?></strong></td>
				      				<td class="text-right" width="30%"><?php echo $v; ?></td>
				      				<td class="text-right" width="30%">
<?php if( $uri ) { ?>
<a class="confirm" href="<?php echo site_url($uri); ?>">
<?php } ?>
				      				<?php echo ($tov!='') ? $tov : "--blank--"; ?>
<?php if( $uri ) { ?>
</a>
<?php } ?>

<?php if( (!in_array($field_name, $model->fields)) && ($k == 'Field')) { ?>
<a class="confirm" href="<?php echo site_url($uri); ?>">remove column</a>
<?php } ?>
				      				</td>
				      			</tr>
				      		<?php } ?>
				      		</tbody>
						</table>
		      		<?php } ?>
<?php if( $differ ) { ?>
<?php 
$not_in_current_columns = 0;
if( $model->table_options ) foreach($model->table_options as $to) { 
 if(!in_array($to->Field, $current_columns))  { 
 	$not_in_current_columns++;
 }
}
if( $not_in_current_columns > 0 ) {
?>
<div class="well">
<div class="list-group">
<?php if( $model->table_options ) foreach($model->table_options as $to) { ?>
		      		<?php if(!in_array($to->Field, $current_columns))  { ?>
		      		<div class="list-group-item">
		      		<a href="<?php echo site_url("system_database/add_column/{$model->table_name}/{$to->Field}"); ?>" class="btn btn-danger btn-xs pull-right confirm">Resolve</a>
		      		<?php echo $to->Field; ?> 		      			
		      		</div>
					<?php } ?>
<?php } ?>
</div>
</div>
<?php } ?>
<?php } ?>

      </div>
    </div>
  </div>
<?php } ?>


<?php if( $missing_tables ) foreach($missing_tables as $table=>$fields) { ?>
	  <div class="panel panel-danger">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="pull-right confirm" href="<?php echo site_url("system_database/add_table/{$table}" ); ?>"><span class="glyphicon glyphicon-plus"></span></a>
        <?php echo $table; ?>
      </h4>
    </div>
   </div>

<?php if($model_n==1) { ?>
</div>
<?php } ?>


<?php } ?>
<?php if( ( $is_all_verified ) && ( $this->input->get('show') != 'all' )) { ?>
<div class="well text-center">
	All is good...
</div>
<?php } ?>

<?php } else { ?>
<p class="text-center">No Models Found!</p>
<?php } ?>
        </div>
      </div>
    </div>
</div>
</div>

<?php $this->load->view('footer'); ?>