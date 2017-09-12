<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/payroll_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
<?php if( !$column_id ) { ?>
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Benefits" data-url="<?php echo site_url("payroll/benefits/{$payroll->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
<?php } ?>
<?php } ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payroll_groups && $benefits_columns ) { ?>

<?php 
$total = array();
$total_benefits = 0;
if( $benefits_columns ) foreach( $benefits_columns as $column ) { 
  $total[$column->id]['ee'] = 0;
  $total[$column->id]['er'] = 0;
}
?>

<?php foreach($payroll_groups as $payroll_group) { ?>
 <?php if($payroll_group->employees) { ?>
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
                <th width="10%" class="text-right"><?php echo $column->name; ?>-ER
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
</th>
<?php } ?>

<?php if( !$column_id ) { ?>
<th width="10%" class="text-right">TOTAL EE</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
<?php 
              foreach($payroll_group->employees as $employee) {
$total_benefit = 0;
              ?>
              <tr>
                <td><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> (<?php echo $employee->position; ?>)
<?php if(!$payroll->lock) { ?>
<a href="<?php echo site_url("employees_benefits/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper"><span class="glyphicon glyphicon-cog"></span></a>
<?php } ?>
                </td>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
                <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo ($column->notes!='') ? $column->notes : $column->name; ?> (EE)" data-url="<?php echo site_url("payroll_benefits/entries/{$payroll->id}/{$employee->name_id}/{$column->id}/ee/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">
<?php } ?>
                <?php 
                    $ee = 'ee_share_' . $column->id;
                    $total[$column->id]['ee'] += $employee->$ee;
                    $total_benefit += $employee->$ee;
                    $total_benefits += $employee->$ee;
                    echo number_format($employee->$ee,2); ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                    </td>
                <td class="text-right">
<?php if(!$payroll->lock) { ?>
<a class="ajax-modal" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo ($column->notes!='') ? $column->notes : $column->name; ?> (ER)" data-url="<?php echo site_url("payroll_benefits/entries/{$payroll->id}/{$employee->name_id}/{$column->id}/er/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">
<?php } ?>
                <?php 
                    $er = 'er_share_' . $column->id;
                    $total[$column->id]['er'] += $employee->$er;
                    echo number_format($employee->$er,2); ?>
<?php if(!$payroll->lock) { ?>
</a>
<?php } ?>
                    </td>
<?php } ?>

<?php if( !$column_id ) { ?>
<td class="text-right"><?php echo number_format($total_benefit,2); ?></td>
<?php } ?>
              </tr>
<?php } ?>

            </tbody>
          </table>
<?php } ?>
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
                <th width="10%" class="text-right"><?php echo $column->name; ?>-ER 
<?php if( intval($column_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-remove"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_benefits/view/{$payroll->id}/{$group_id}/{$column->id}"); ?>" class="body_wrapper"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                </th>
<?php } ?>

<?php if( !$column_id ) { ?>
                <th width="10%" class="text-right">TOTAL EE</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
            <td></td>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
                <td width="10%" class="text-right"><a href="<?php echo site_url("payroll_benefits/item_schedule/{$payroll->id}/{$column->id}"); ?>" class="body_wrapper"><strong><?php echo number_format($total[$column->id]['ee'],2);?></strong></a></td>
                <td width="10%" class="text-right"><a href="<?php echo site_url("payroll_benefits/item_schedule/{$payroll->id}/{$column->id}"); ?>" class="body_wrapper"><strong><?php echo number_format($total[$column->id]['er'],2);?></strong></a></td>
<?php } ?>
<?php if( !$column_id ) { ?>
<td class="text-right"><?php echo number_format($total_benefits,2); ?></td>
<?php } ?>
  </tr>
            </tbody>
            </table>
<?php } ?>
<?php } else { ?>

  <div class="text-center">No Group and/or Benefit Assigned!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>