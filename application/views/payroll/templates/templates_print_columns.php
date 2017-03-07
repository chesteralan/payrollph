<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
function isSelected($group,$column_id,$print_columns) {
    foreach($print_columns as $col) {
        if( ($col->term_id == $group) && ($col->column_id==$column_id) ) {
            return true;
        }
    }
    return false;
}
?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
  <form method="post">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configure Payroll Template</h3>
        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
          
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-0">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-0" aria-expanded="true" aria-controls="collapse-0">
          All Employees
        </a>
      </h4>
    </div>
    <div id="collapse-0" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-0">
      <div class="panel-body">
        <div class="row">
        <?php foreach(array(
          'working_days'=>'Working Days',
          'absences'=>'Absences',
          'days_present'=>'Days Present',
          'rate_per_day'=>'Rate Per Day', 
          'basic_salary'=>'Basic Salary', 
          'cola'=>'COLA', 
          'absences_amount'=>'Absences Amount', 
          'gross_pay'=>'Gross Pay', 
        ) as $col_key=>$col_name) { ?>
            <div class="col-md-4">
              <input type="hidden" name="i[0][columns][]" value="<?php echo $col_key; ?>">
              <label><input <?php echo (isSelected(0, $col_key, $print_columns)) ? 'CHECKED' : ''; ?> type="checkbox" name="i[0][selected][]" value="<?php echo $col_key; ?>"> <?php echo $col_name; ?></label></div>
        <?php } ?>
        </div>

<?php if( $earnings ) { ?>
        <div class="row" style="border-top: 1px solid #DDD; margin-top: 10px; padding-top: 10px;">
        <?php foreach($earnings as $earning) { ?>
            <div class="col-md-4">
              <input type="hidden" name="i[0][columns][]" value="earning_<?php echo $earning->id; ?>">
              <label><input <?php echo (isSelected(0, 'earning_'.$earning->id, $print_columns)) ? 'CHECKED' : ''; ?> type="checkbox" name="i[0][selected][]" value="earning_<?php echo $earning->id; ?>"> <?php echo $earning->name; ?></label></div>
        <?php } ?>
        </div>
<?php } ?>

<?php if( $benefits ) { ?>
        <div class="row" style="border-top: 1px solid #DDD; margin-top: 10px; padding-top: 10px;">
        <?php foreach($benefits as $benefit) { ?>
            <div class="col-md-4">
              <input type="hidden" name="i[0][columns][]" value="benefit_<?php echo $benefit->id; ?>">
            <label><input <?php echo (isSelected(0, 'benefit_'.$benefit->id, $print_columns)) ? 'CHECKED' : ''; ?> type="checkbox" name="i[0][selected][]" value="benefit_<?php echo $benefit->id; ?>"> <?php echo $benefit->name; ?></label></div>
        <?php } ?>
        </div>
<?php } ?>

<?php if( $deductions ) { ?>
        <div class="row" style="border-top: 1px solid #DDD; margin-top: 10px; padding-top: 10px;">
        <?php if( $deductions ) foreach($deductions as $deduction) { ?>
            <div class="col-md-4">
              <input type="hidden" name="i[0][columns][]" value="deduction_<?php echo $deduction->id; ?>">
              <label><input <?php echo (isSelected(0, 'deduction_'.$deduction->id, $print_columns)) ? 'CHECKED' : ''; ?> type="checkbox" name="i[0][selected][]" value="deduction_<?php echo $deduction->id; ?>"> <?php echo $deduction->name; ?></label></div>
        <?php } ?>
        </div>
<?php } ?>

      </div>
    </div>
  </div>

<?php if( $print_groups ) foreach( $print_groups as $grp ) {  ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-<?php echo $grp->id; ?>">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $grp->id; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $grp->id; ?>">
          <?php echo $grp->name; ?>
        </a>
      </h4>
    </div>
    <div id="collapse-<?php echo $grp->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo $grp->id; ?>">
      <div class="panel-body">
        <div class="row">
        <?php foreach(array(
          'working_days'=>'Working Days',
          'absences'=>'Absences',
          'days_present'=>'Days Present',
          'rate_per_day'=>'Rate Per Day', 
          'basic_salary'=>'Basic Salary', 
          'cola'=>'COLA', 
          'absences_amount'=>'Absences Amount', 
          'gross_pay'=>'Gross Pay', 
        ) as $col_key=>$col_name) { ?>
            <div class="col-md-4">
              <input type="hidden" name="i[<?php echo $grp->id; ?>][columns][]" value="<?php echo $col_key; ?>">
              <label><input <?php echo (isSelected($grp->id, $col_key, $print_columns)) ? 'CHECKED' : ''; ?> type="checkbox" name="i[<?php echo $grp->id; ?>][selected][]" value="<?php echo $col_key; ?>"> <?php echo $col_name; ?></label></div>
        <?php } ?>
        </div>
<?php if( $earnings ) { ?>
        <div class="row" style="border-top: 1px solid #DDD; margin-top: 10px; padding-top: 10px;">
        <?php foreach($earnings as $earning) { ?>
            <div class="col-md-4">
              <input type="hidden" name="i[<?php echo $grp->id; ?>][columns][]" value="earning_<?php echo $earning->id; ?>">
              <label><input <?php echo (isSelected($grp->id, 'earning_'.$earning->id, $print_columns)) ? 'CHECKED' : ''; ?> type="checkbox" name="i[<?php echo $grp->id; ?>][selected][]" value="earning_<?php echo $earning->id; ?>"> <?php echo $earning->name; ?></label></div>
        <?php } ?>
        </div>
<?php } ?>
<?php if( $benefits ) { ?>
        <div class="row" style="border-top: 1px solid #DDD; margin-top: 10px; padding-top: 10px;">
        <?php foreach($benefits as $benefit) { ?>
            <div class="col-md-4">
              <input type="hidden" name="i[<?php echo $grp->id; ?>][columns][]" value="benefit_<?php echo $benefit->id; ?>">
            <label><input <?php echo (isSelected($grp->id, 'benefit_'.$benefit->id, $print_columns)) ? 'CHECKED' : ''; ?> type="checkbox" name="i[<?php echo $grp->id; ?>][selected][]" value="benefit_<?php echo $benefit->id; ?>"> <?php echo $benefit->name; ?></label></div>
        <?php } ?>
        </div>
<?php } ?>
<?php if( $deductions ) { ?>
        <div class="row" style="border-top: 1px solid #DDD; margin-top: 10px; padding-top: 10px;">
        <?php foreach($deductions as $deduction) { ?>
            <div class="col-md-4">
              <input type="hidden" name="i[<?php echo $grp->id; ?>][columns][]" value="deduction_<?php echo $deduction->id; ?>">
              <label><input <?php echo (isSelected($grp->id, 'deduction_'.$deduction->id, $print_columns)) ? 'CHECKED' : ''; ?> type="checkbox" name="i[<?php echo $grp->id; ?>][selected][]" value="deduction_<?php echo $deduction->id; ?>"> <?php echo $deduction->name; ?></label></div>
        <?php } ?>
        </div>
<?php } ?>
      </div>
    </div>
  </div>
<?php } ?>

</div>


<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>
        <div class="panel-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <a href="<?php echo site_url($current_uri); ?>" class="btn btn-warning">Back</a>
        </div>
      </div>
      </form>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>