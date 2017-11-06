<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll/template_preview_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php echo $current_page; ?></strong>
<a class="ajax-modal close" href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Benefits" data-url="<?php echo site_url("payroll_templates/benefits/{$template->id}/ajax") . "?next=" . uri_string(); ?>"><span class="glyphicon glyphicon-cog"></span></a>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $payroll_groups && $benefits_columns ) { ?>

<?php 
$total = array();
if( $benefits_columns ) foreach( $benefits_columns as $column ) { 
  $total[$column->id]['ee'] = 0;
  $total[$column->id]['er'] = 0;
}
?>

<?php foreach($payroll_groups as $payroll_group) { ?>
 
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>
<?php if( !$this->session->userdata('current_employee') ) { ?>
<?php if( intval($group_id) > 0 ) { ?>
<a href="<?php echo site_url("payroll_benefits/view/{$template->id}"); ?>" class="glyphicon glyphicon-arrow-left body_wrapper"></a>
<?php } else { ?>
  <a href="<?php echo site_url("payroll_benefits/view/{$template->id}/{$payroll_group->group_id}"); ?>" class="glyphicon glyphicon-filter body_wrapper"></a>
<?php } ?>
<?php } ?>
                <?php echo $payroll_group->name; ?> 
<?php if( !$this->session->userdata('current_employee') ) { ?>
<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="Sort <?php echo $payroll_group->name; ?>" data-url="<?php echo site_url("payroll_templates/employees/{$template->id}/{$payroll_group->id}/ajax") . "?action=sort&next=" . uri_string(); ?>" class="ajax-modal"><span class="glyphicon glyphicon-sort"></span></a>
<?php } ?>

                </th>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?>-EE</th>
                <th width="10%" class="text-right"><?php echo $column->name; ?>-ER</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
<?php if($payroll_group->employees) { 
              foreach($payroll_group->employees as $employee) { 

              ?>
              <tr>
                <td>
<?php if( !$this->session->userdata('current_employee') ) { ?>
                <a href="<?php echo site_url("payroll/select_employee/{$employee->name_id}") . "?next=" . urlencode(uri_string()); ?>"><span class="glyphicon glyphicon-filter"></span></a>
<?php } ?>
                  <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?> 
<a href="<?php echo site_url("employees_benefits/view/{$employee->name_id}") . "?next=" . uri_string(); ?>" class="body_wrapper pull-right"><span class="glyphicon glyphicon-cog"></span></a>

<a class="ajax-modal" href="#ajaxModal" data-modal_size="large" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo site_url("lists_names/profile/{$employee->name_id}/ajax") . "?output=inner_page"; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>

                </td>

<?php 
$total_benefits_ee = 0;
$total_benefits_er = 0;
if( $benefits_columns ) foreach( $benefits_columns as $column ) { 

                    $var2 = 'benefits_' . $column->id . '_data';
                    $benefits_data = $employee->$var2;
                    $column_name = $column->name;

                     $ee_amount = 0;
                     $er_amount = 0;
                    if( $benefits_data ) {
                   
                    foreach($benefits_data as $benefit2) {
                        $ee_amount += $benefit2->employee_share;
                        $er_amount += $benefit2->employer_share;
                    }

                    $total_benefits_ee += $ee_amount;
                    $total_benefits_er += $er_amount;
                    $total[$column->id]['ee'] += $ee_amount;
                    $total[$column->id]['er'] += $er_amount;

                    $entries_url = site_url("payroll_benefits/preview_entries/{$template->id}/{$employee->name_id}/{$column->id}/ee/ajax") . "?next=" . uri_string();

                  } else {
                    $column_name = "Add " . $column->name;
                    $entries_url = site_url("employees_benefits/add/{$employee->name_id}/ajax") . "?template_id={$template->id}&benefit_id={$column->id}&next=" . uri_string();
                  }
  ?>
                <td class="text-right">
<a href="#ajaxModal" data-toggle="modal" data-target="#ajaxModal" data-title="<?php echo $column_name; ?> - <?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?>" data-url="<?php echo $entries_url; ?>" class="ajax-modal" data-hide_footer="1">
                <?php echo number_format($ee_amount,2); ?>
</a>
                    </td>
                <td class="text-right">
                <?php 
                    echo number_format($er_amount,2); ?>
                    </td>
<?php } ?>

              </tr>
<?php         } 
      } ?>

            </tbody>
          </table>
    <?php } ?>

<?php if( !$this->session->userdata('current_employee') ) { ?>
          <table class="table table-default table-hover" id="Payroll-Group-<?php echo $payroll_group->group_id; ?>">
            <thead>
              <tr class="warning">
                <th>TOTAL</th>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
                <th width="10%" class="text-right"><?php echo $column->name; ?>-EE</th>
                <th width="10%" class="text-right"><?php echo $column->name; ?>-ER</th>
<?php } ?>
              </tr>
            </thead>
            <tbody>
            <tr class="success">
            <td></td>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
                <td width="10%" class="text-right"><strong><?php echo number_format($total[$column->id]['ee'],2);?></strong></td>
                <td width="10%" class="text-right"><strong><?php echo number_format($total[$column->id]['er'],2);?></strong></td>
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