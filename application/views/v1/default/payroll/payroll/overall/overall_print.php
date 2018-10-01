<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
function isColumn($ths, $column_id,$print_columns) {
    if( $ths->input->get('columns') ) {
        if( in_array($column_id, $ths->input->get('columns')) ) {
            return true;
        }
    } else {
      if( $print_columns ) foreach($print_columns as $col) {
          if( ($col->column_id==$column_id) ) {
              return true;
          }
      }
    }
    return false;
}  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME;  ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
<?php if( $print_css ) { ?>
<style>
<!--
<?php echo unserialize($print_css->value); ?>

-->
</style>
<?php } ?>
  </head>
  <body id="payroll_print">

<div class="print-topnav hide-print text-center allcaps">
  <a href="<?php echo site_url("payroll/select_payroll/{$payroll->id}"); ?>">Back</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/payslip") . (($this->input->get('filter'))?'?filter='.$this->input->get('filter'):''); ?>">Payslip</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/{$output}/{$current_page}"); ?>">All</a>
  <?php 
  if( ( isset($print_group_option) ) && ( $print_group_option ) )  {
  $pg_option = unserialize( $print_group_option->value );
  $pg_sort = array();
  if($pg_option) foreach($pg_option as $pgok => $pgov) {
      $pg_sort[$pgov] = $pgok;
  }

  $pgs = array();
   if($print_groups) foreach($print_groups as $pg) {
      $pgs[$pg_sort[$pg->id]] = $pg;
  }
  ksort($pgs);
  foreach($pgs as $pg) { ?>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$pg->id}/{$output}/{$current_page}"); ?>"><?php echo $pg->name; ?></a>
  <?php } ?>
  <?php } ?>
  
  <?php if( (isset($print_group_option)) && ($print_group_option) ) { ?>
   &middot; <a href="<?php echo site_url("payroll_overall/summary/{$payroll->id}"); ?>">Summary</a>
  <?php } ?>

&middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/xls/{$current_page}"); ?>">Export</a>

</div>

<div class="print-topnav topnav2 hide-print text-center allcaps">
  Filter by Employee: <select style="margin-top: 2px;width: 150px;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    
<?php if($this->input->get('filter')||$this->input->get('filter_group')) { ?>
    <option value="<?php echo site_url(uri_string()); ?>">- - Show All - -</option>
<?php } else { ?>
<option value="" disabled="disabled" selected="selected">Select Employee...</option>
<?php } ?>
<?php foreach($payroll_groups as $payroll_group) { ?>
<?php if($payroll_group->employees) { ?>
<?php if( count($payroll_group->employees) > 1) { ?>
<optgroup label="<?php echo $payroll_group->name; ?>">
  <option value="<?php echo site_url(uri_string()); ?>?filter_group=<?php echo $payroll_group->id; ?>" <?php echo ($payroll_group->id==$this->input->get('filter_group')) ? 'selected' : ''; ?>>All <?php echo $payroll_group->name; ?></option>
<?php } ?>
<?php 
        foreach($payroll_group->employees as $employee) { 
          ?>
            <option value="<?php echo site_url(uri_string()); ?>?filter=<?php echo $employee->name_id; ?>" <?php echo ($employee->name_id==$this->input->get('filter')) ? 'selected' : ''; ?>><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1); ?>.</option>
      <?php } ?>
<?php if( count($payroll_group->employees) > 1) { ?>
</optgroup>
<?php } ?>
<?php } ?>
<?php } ?>
  </select>
</div>

<?php if(!$print_group) { ?>
<?php if($template->pages > 1) { ?>
<div class="print-topnav topnav2 hide-print text-center allcaps">

    <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/1"); ?>">Page 1</a>
<?php for($i=2;$i <= $template->pages; $i++) { ?>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/{$output}/{$i}"); ?>">Page <?php echo $i; ?></a>
<?php } ?>
</div>
<?php } ?>
<?php } ?>

<?php
switch( $template->print_format ) {
    case 'clergy_allowance':
      $this->load->view('payroll/payroll/overall/overall_print_clergy_allowance');
    break;
    default:
       $this->load->view('payroll/payroll/overall/overall_print_default');
    break;
}
?>

<div class="signatories">
  <table width="100%"  cellspacing="0" cellpadding="0">
    <tr>
      <td width="33.33%"><p>Prepared By:</p>
       <br>
<span class="allcaps bold"><?php echo $this->session->name; ?></span>
      </td>
      <td width="33.33%" class="text-center"><p>Checked By:</p>
       <br>
<span class="allcaps bold"><?php echo $template->checked_by_name; ?></span>
      </td>
      <td width="33.33%" class="text-right"><p>Approved By:</p>
      <br>
<span class="allcaps bold"><?php echo $template->approved_by_name; ?></span>
      </td>
    </tr>
  </table>
</div>



  </body>
</html>
