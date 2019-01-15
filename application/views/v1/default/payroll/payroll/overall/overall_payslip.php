<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME; ?></title>
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet">
<?php if( $print_css ) { ?>
<style>
<!--
<?php echo unserialize($print_css->value); ?>

-->
</style>
<?php } ?>
  </head>
  <body id="payslip" class="<?php echo (isset($paper_size)) ? $paper_size : ''; ?>">

<div class="print-topnav hide-print text-center allcaps">
  <a href="<?php echo site_url("payroll/select_payroll/{$payroll->id}"); ?>">Back</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}") . (($this->input->get('filter'))?'?filter='.$this->input->get('filter'):''); ?>">Print</a>
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$print_group}/denomination") . (($this->input->get('filter'))?'?filter='.$this->input->get('filter'):''); ?>">Denomination</a>
  &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/0/payslip"); ?>">All</a>

    &middot; <a href="<?php echo site_url("payroll_overall/config/{$payroll->id}") . "?next=" . uri_string(); ?>">Config</a>
    
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
    &middot; <a href="<?php echo site_url("payroll_overall/view/{$payroll->id}/{$pg->id}/payslip"); ?>"><?php echo $pg->name; ?></a>
  <?php } ?>
  <?php } ?>
  <?php if( (isset($print_group_option)) && ($print_group_option) ) { ?>
   &middot; <a href="<?php echo site_url("payroll_overall/summary/{$payroll->id}"); ?>">Summary</a>
  <?php } ?>
</div>



<?php if( (isset($payroll_groups)) && ($payroll_groups ) ) { 

$box_count = 0;

  ?>

<div class="print-topnav topnav2 hide-print text-center allcaps">
  Filter by Employee: <select style="margin-top: 2px;width: 150px;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    
<?php if($this->input->get('filter')||$this->input->get('filter_group')) { ?>
    <option value="<?php echo site_url(uri_string()); ?>">- - Show All - -</option>
<?php } else { ?>
<option value="" disabled="disabled" selected="selected">Select Employee...</option>
<?php } ?>
<?php foreach($payroll_groups as $payroll_group) { ?>
<?php if($payroll_group->employees) { ?>
<optgroup label="<?php echo $payroll_group->name; ?>">
<?php if( count($payroll_group->employees) > 1) { ?>
  <option value="<?php echo site_url(uri_string()); ?>?filter_group=<?php echo $payroll_group->id; ?>" <?php echo ($payroll_group->id==$this->input->get('filter_group')) ? 'selected' : ''; ?>>All <?php echo $payroll_group->name; ?></option>
<?php } ?>
<?php 
        foreach($payroll_group->employees as $employee) { 
          if( $employee->payslip_template == 'none' ) {
              continue;
          }
          ?>
            <option value="<?php echo site_url(uri_string()); ?>?filter=<?php echo $employee->name_id; ?>" <?php echo ($employee->name_id==$this->input->get('filter')) ? 'selected' : ''; ?>><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1); ?>.</option>
      <?php } ?>
</optgroup>
<?php } ?>
<?php } ?>
  </select>
<?php if( $this->input->get('filter') ) { ?>
    <select style="margin-top: 2px;width: 100px;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
          <option value="<?php echo site_url(uri_string()); ?>?filter=<?php echo $this->input->get('filter'); ?>&payslip_template=none">No Payslip</option>
<?php 
foreach(unserialize(PAYROLL_PAYSLIP_TEMPLATES) as $pId => $pName) { 

$selected = '';
if( $this->input->get('payslip_template') ) {
  if($this->input->get('payslip_template')==$pId) {
    $selected = 'SELECTED';
  }
} else {
  if($employee->payslip_template==$pId) {
    $selected = 'SELECTED';
  }
}
?>
          <option value="<?php echo site_url(uri_string()); ?>?filter=<?php echo $this->input->get('filter'); ?>&payslip_template=<?php echo $pId; ?>" <?php echo $selected; ?>><?php echo $pName; ?></option>
<?php } ?>
      </select>
<?php } ?>
</div>

<?php foreach($payroll_groups as $payroll_group) { ?>
<?php 
if( $this->input->get('filter_group') ) {
  if( $payroll_group->id != $this->input->get('filter_group') ) {
      continue;
  }
}
?>
<?php if($payroll_group->employees) { 
        foreach($payroll_group->employees as $employee) { 

      if( $this->input->get('filter') ) {
        if( $employee->name_id != $this->input->get('filter') ) {
            continue;
        }
      }
            $box_count++;
            $template_data = array(
                'box_count' => $box_count,
                'employee' => $employee,
            );

$payslip_template = $employee->payslip_template;
if( $this->input->get('payslip_template') ) {
  $payslip_template = $this->input->get('payslip_template');
}

$payslip_templates = unserialize(PAYROLL_PAYSLIP_TEMPLATES);

$payslip_template = (isset($payslip_templates[$payslip_template])) ? $payslip_template : 'payslip';
/*
        switch ( $payslip_template ) {
          case 'payslip':
            $this->load->view('payroll/payroll/overall/overall_payslip_payslip', $template_data);
            break;
          case 'payslip2':
            $this->load->view('payroll/payroll/overall/overall_payslip_payslip2', $template_data);
            break;
          case 'payslip3':
            $this->load->view('payroll/payroll/overall/overall_payslip_payslip3', $template_data);
            break;
          case 'cash_voucher':
            $this->load->view('payroll/payroll/overall/overall_payslip_voucher', $template_data);
            break;
          case 'clergy_allowance':
            $this->load->view('payroll/payroll/overall/overall_payslip_clergy_allowance', $template_data);
            break;
          default:
            //$this->load->view('payroll/payroll/overall/overall_payslip_payslip', $template_data);
            break;
        }
*/
        $this->load->view('payroll/payroll/overall/overall_payslip_' . $payslip_template, $template_data);

} ?>
<?php } ?>
<?php } ?>
<?php } ?>


  </body>
</html>
