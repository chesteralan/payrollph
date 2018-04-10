<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Column Group</h3>
        </div>
        <form method="post">
        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php 
$column_groups = array(
  array('key'=>'column_group_employees','name' => 'Employees', 'checked' => ((($column_group_employees)&&(isset($column_group_employees->value)))?unserialize($column_group_dtr->value):0)),
  array('key'=>'column_group_dtr','name' => 'Daily Time Record', 'checked' => ((($column_group_dtr)&&(isset($column_group_dtr->value)))?unserialize($column_group_dtr->value):0)),
  array('key'=>'column_group_salaries', 'name' => 'Basic Salary', 'checked' => ((($column_group_salaries)&&(isset($column_group_salaries->value)))?unserialize($column_group_salaries->value):0)),
  array('key'=>'column_group_earnings', 'name' => 'Earnings', 'checked' => ((($column_group_earnings)&&(isset($column_group_earnings->value)))?unserialize($column_group_earnings->value):0)),
  array('key'=>'column_group_benefits', 'name' => 'Benefits', 'checked' => ((($column_group_benefits)&&(isset($column_group_benefits->value)))?unserialize($column_group_benefits->value):0)),
  array('key'=>'column_group_deductions', 'name' => 'Deductions', 'checked' => ((($column_group_deductions)&&(isset($column_group_deductions->value)))?unserialize($column_group_deductions->value):0)),
  array('key'=>'column_group_summary', 'name' => 'Summary', 'checked' => ((($column_group_summary)&&(isset($column_group_summary->value)))?unserialize($column_group_summary->value):0)),
);

$sort = ($sort) ? unserialize($sort->value) : false;

  if( $sort ) {
    $sort2 = array();
    $si = 0;
    foreach($sort as $sk=>$sv) {
        $sort2[$sv] = $si++;
    }  

    $pgs = array();
    $pgi = 99;
    foreach($column_groups as $cg) {
      $cg_key = $cg['key'];
      if( isset($sort2[$cg_key])) {
        $pgs[$sort2[$cg_key]] = $cg;
      } else {
        $pgs[$pgi] = $cg;
        $pgi--;
      }
    }
    ksort($pgs);
    $column_groups = $pgs;
  }

?>
<div class="list-group sortable">
    <?php foreach($column_groups as $cg) { ?>
    <div class="list-group-item">
      <span class="glyphicon glyphicon-sort pull-right"></span>
      <input type="hidden" name="column_group_sort[]" value="<?php echo $cg['key']; ?>">
      <label><input type="checkbox" name="<?php echo $cg['key']; ?>" value="1" <?php echo ($cg['checked']) ? 'CHECKED' : ''; ?>> <?php echo $cg['name']; ?></label>
    </div>
    <?php } ?>
</div>


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