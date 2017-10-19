<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Verify Tables </h3>

        </div>
        <div class="panel-body" id="ajaxBodyInnerPage">
<?php
	function differ1($table_options, $table_columns) {
		if($table_columns) {
			foreach($table_columns as $tc) {
				if( isset($table_options[$tc->Field]) ) {
					foreach($tc as $k=>$v) {
						if( $v != $table_options[$tc->Field]->$k ) {
							return true;
						}
					}
				}
			}
		}
		return false;
	} 
?>
<?php if( $models ) { ?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<?php foreach($models as $model) { ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $model->table_name; ?>" aria-expanded="true" aria-controls="collapseOne">

        <span class="pull-right">
        <?php echo ( differ1($model->table_options, $model->table_columns) ) ? "<span class='glyphicon glyphicon-remove' style='color:red'></span>" : "<span class='glyphicon glyphicon-ok' style='color:green'></span>"; ?>
        </span>

          <?php echo $model->table_name; ?>
        </a>
      </h4>
    </div>
    <div id="<?php echo $model->table_name; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
		      		<?php if( $model->table_columns ) foreach($model->table_columns as $tc) { ?>
						<table class="table table-striped table-hover">
				      		<tbody>
				      		<?php 
				      		foreach($tc as $k=>$v) { 
$uri = false;
if( $k == 'Field' ) {
	$field_name = $v;
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
			$uri = "system_database/fix_default/{$model->table_name}/{$field_name}/{$tov_encode}";
			break;
		case 'Extra':
			$uri = "system_database/fix_extra/{$model->table_name}/{$field_name}/{$tov_encode}";
			break;
	}
}
				      			?>
				      			<tr>
				      				<td><strong><?php echo $k; ?></strong></td>
				      				<td class="text-right" width="30%"><?php echo $v; ?></td>
				      				<td class="text-right" width="30%">
<?php if( $uri ) { ?>
<a href="<?php echo site_url($uri); ?>">
<?php } ?>
				      				<?php echo $tov; ?>
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

      </div>
    </div>
  </div>
<?php } ?>

</div>

<?php } else { ?>
<p class="text-center">No Models Found!</p>
<?php } ?>
        </div>
      </div>
    </div>
</div>
</div>

<?php $this->load->view('footer'); ?>