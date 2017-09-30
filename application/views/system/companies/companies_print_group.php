<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Print Group</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( $print_groups ) { 
  $selected = unserialize($option->value); 
  $sort = unserialize($sort->value); 
  $si = 0;
  foreach($sort as $sk=>$sv) {
      $sort[$sk] = $si++;
  }  

  $pgs = array();
  foreach($print_groups as $pg) {
    $pgs[$sort[$pg->id]] = $pg;
  }
  ksort($pgs);
?>
<div class="list-group sortable">
    <?php 
$i = 0;
    foreach($pgs as $pg) { ?>
    <div class="list-group-item">
<input type="hidden" name="print_group_sort[<?php echo $pg->id; ?>]" value="1">
      <label><input type="checkbox" name="print_group[]" value="<?php echo $pg->id; ?>"<?php echo (in_array($pg->id, $selected)) ? ' CHECKED' : ''; ?>> <?php echo $pg->name; ?></label></div>
    <?php } ?>
</div>
<?php } ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

        </div>
        <div class="panel-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="<?php echo site_url($current_uri); ?>" class="btn btn-warning">Back</a>
        </div>
        </form>
      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>