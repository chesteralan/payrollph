<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">

<?php if( isset($no_inclusive_dates) ) { ?>
<div class="alert alert-danger" role="alert"><strong>ERROR FOUND!</strong> Inclusive dates not set! <a data-title="Inclusive Dates" class="btn btn-danger btn-xs ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-url="<?php echo site_url("payroll/inclusive_dates/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>" >Fix This</a></div>
<?php } ?>

<?php if( !isset($no_inclusive_dates) ) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  
<?php if( !$column_id ) { ?>
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Benefits" data-url="<?php echo payroll_url("payroll/benefits/{$payroll->id}/ajax"); ?>"><span class="glyphicon glyphicon-cog"></span></a>
<?php } ?>
<?php } else { ?>
  <?php if( $other_payrolls ) { ?>
    <div class="btn-group btn-group-xs pull-right">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo ( isset($compare_payroll) ) ? $compare_payroll->name : "Compare"; ?> <span class="caret"></span>
      </button>
      <ul class="dropdown-menu dropdown-menu-right">
      <?php foreach($other_payrolls as $op) { ?>
        <li><a href="<?php echo site_url(uri_string()) . "?" . querystring_add( 'compare', $op->id); ?>"><?php echo $op->name; ?></a></li>
      <?php } ?>
      </ul>
    </div>
  <?php } ?>
<?php } ?>
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php } ?>

<?php endif; ?>

<?php if( !isset($no_inclusive_dates) ) { ?>
<?php if( $payroll_groups && $benefits_columns ) { ?>

<?php 
$total = array();
$total_benefits = 0;
if( $benefits_columns ) foreach( $benefits_columns as $column ) { 
  $total[$column->id]['ee'] = 0;
  $total[$column->id]['er'] = 0;
}
if( isset($compare_payroll) ) {
  $total['compare']['ee'] = 0;
  $total['compare']['er'] = 0;
  $total['difference']['ee'] = 0;
  $total['difference']['er'] = 0;
}
?>

<?php foreach($payroll_groups as $payroll_group) { ?>
 
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-arrow-left"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$payroll_group->group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></a>
<?php } ?>
<?php } ?>

                <?php echo $payroll_group->name; ?>
<?php if(!$payroll->lock) { ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
 <a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll/employees/{$payroll->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>
<?php } ?>
                </th>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?>-EE
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
</th>
<?php if( isset($compare_payroll) ) { ?>
  <th width="15%" class="text-right"><?php echo $compare_payroll->name; ?>-EE</th>
<?php } ?>
<!--
                <th width="10%" class="text-right"><?php echo $column->name; ?>-ER
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
</th>
<?php if( isset($compare_payroll) ) { ?>
  <th width="15%" class="text-right"><?php echo $compare_payroll->name; ?>-ER</th>
<?php } ?>
-->
<?php } ?>

<?php if( !$column_id ) { ?>
<th width="10%" class="text-right">TOTAL EE</th>
<?php } ?>

<?php if( isset($compare_payroll) ) { ?>
  <th width="15%" class="text-right">Difference</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
<?php if($payroll_group->employees) { ?>
<?php foreach($payroll_group->employees as $employee) {
$total_benefit = 0;
              ?>
              <tr>
                <td>
<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 

<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page&next=" . uri_string(); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

<?php if(!$payroll->lock) { ?>
<a href="<?php echo site_url("employees_benefits/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper pull-right"><span class="glyphicon glyphicon-cog"></span></a>
<?php } ?>
                </td>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
<?php 
                    $ee = 'ee_share_' . $column->id;
                    $total[$column->id]['ee'] += $employee->$ee;
                    $total_benefit += $employee->$ee;
                    $total_benefits += $employee->$ee;
                    

                    $er = 'er_share_' . $column->id;
                    $total[$column->id]['er'] += $employee->$er;
                    

?>

                <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo ($column->abbr!='') ? $column->abbr : $column->name; ?> (EE)" data-url="<?php echo payroll_url("payroll_benefits/entries/{$payroll->id}/{$employee->pe_id}/{$column->id}/ee/ajax"); ?>" data-hide_footer="1">
<?php } ?>
<span data-toggle="tooltip" data-placement="left" title="<?php echo $column->name; ?>-ER: <?php echo number_format($employee->$er,2); ?>">
       <?php echo number_format($employee->$ee,2); ?>
</span>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                    </td>
<?php if( isset($compare_payroll) ) { ?>
<td class="text-right"><?php 
                    $ee2 = 'ee_compare_' . $column->id;
                    $total['compare']['ee'] += $employee->$ee2;
                    echo number_format($employee->$ee2,2); ?></td>
<?php } ?>
<!--
                <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo ($column->abbr!='') ? $column->abbr : $column->name; ?> (ER)" data-url="<?php echo site_url("payroll_benefits/entries/{$payroll->id}/{$employee->name_id}/{$column->id}/er/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">
<?php } ?>
  <?php echo number_format($employee->$er,2); ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                    </td>
<?php if( isset($compare_payroll) ) { ?>
<td class="text-right"><?php 
                    $er2 = 'er_compare_' . $column->id;
                    $total['compare']['er'] += $employee->$er2;
                    echo number_format($employee->$er2,2); ?></td>
<?php } ?> 
-->
<?php } ?>
<?php if( !$column_id ) { ?>
<td class="text-right"><?php echo number_format($total_benefit,2); ?></td>
<?php } ?>
<?php if( isset($compare_payroll) ) { ?>
<td class="text-right"><?php 
$diff_ee = $employee->$ee - $employee->$ee2;
$total['difference']['ee'] += $diff_ee;
echo number_format($diff_ee,2); ?></td>
<?php } ?>
              </tr>
<?php } ?>
<?php } ?>
            </tbody>
          </table>

    <?php } ?>
<?php if( !$this->session->userdata('current_employee') ) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>TOTAL</th>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?>-EE 
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                </th>
<?php if( isset($compare_payroll) ) { ?>
  <th width="15%" class="text-right"><?php echo $compare_payroll->name; ?>-EE</th>
<?php } ?>
<!--
                <th width="10%" class="text-right"><?php echo $column->name; ?>-ER 
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                </th>
<?php if( isset($compare_payroll) ) { ?>
  <th width="15%" class="text-right"><?php echo $compare_payroll->name; ?>-ER</th>
<?php } ?>
-->
<?php } ?>
<?php if( !$column_id ) { ?>
                <th width="10%" class="text-right">TOTAL EE</th>
<?php } ?>
<?php if( isset($compare_payroll) ) { ?>
  <th width="15%" class="text-right">Difference</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
            <td></td>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
                <td width="10%" class="text-right"><a href="<?php echo site_url("payroll_benefits/item_schedule/{$payroll->id}/{$column->id}"); ?>" class="body_wrapper"><strong><?php echo number_format($total[$column->id]['ee'],2);?></strong></a></td>
<?php if( isset($compare_payroll) ) { ?>
<td class="text-right"><strong><?php echo number_format($total['compare']['ee'],2);?></strong></td>
<?php } ?>
<!--
                <td width="10%" class="text-right"><a href="<?php echo site_url("payroll_benefits/item_schedule/{$payroll->id}/{$column->id}"); ?>" class="body_wrapper"><strong><?php echo number_format($total[$column->id]['er'],2);?></strong></a></td>
<?php if( isset($compare_payroll) ) { ?>
<td class="text-right"><strong><?php echo number_format($total['compare']['er'],2);?></strong></td>
<?php } ?>
-->
<?php } ?>
<?php if( !$column_id ) { ?>
<td class="text-right"><?php echo number_format($total_benefits,2); ?></td>
<?php } ?>
<?php if( isset($compare_payroll) ) { ?>
<td class="text-right"><?php echo number_format($total['difference']['ee'],2); ?></td>
<?php } ?>
  </tr>
            </tbody>
            </table>
<?php } ?>
<?php } else { ?>

  <div class="text-center">No Group and/or Benefit Assigned!</div>

<?php } ?>
<?php } ?>

<?php if( ! $inner_page ): ?>
<?php if( !isset($no_inclusive_dates) ) { ?>
              </div>
              </div>
<?php } ?>

            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>