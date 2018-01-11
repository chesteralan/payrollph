<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( isset($output) && ($output!='ajax') ) { ?>
<a class="btn btn-success btn-xs ajax-modal pull-right" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Item" data-url="<?php echo site_url("employees_benefits/edit/{$entry->id}/{$output}/ajax") . '?next=' . uri_string(); ?>">Edit Item</a>
<?php } ?>
                  <h3 class="panel-title bold">
                  <?php echo $benefit->name; ?> - <?php echo $benefit->notes; ?> <?php echo ($entry->notes) ? "(".$entry->notes.")" : ""; ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>

<?php endif; ?>

<?php if( $benefits ) { ?>
<?php if( isset($output) && ($output=='ajax') ) { ?>
<center><a class="btn btn-success btn-xs ajax-modal-inner" href="<?php echo site_url("employees_benefits/edit/{$entry->id}/{$output}") . '?next=' . (($this->input->get('next'))? $this->input->get('next'): "employees_benefits/view/{$employee->name_id}"); ?>">Edit Item</a></center>
<?php } ?>
          <table class="table table-default">
            <thead>
              <tr>
                <th>Payroll Name</th>
                <th class="text-right">Employee Share</th>
                <th class="text-right">Employer Share</th>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="50px" class="action_column">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php 
$total_ee = 0;
$total_er = 0;
            foreach($benefits as $benefit) { ?>
              <tr id="benefit-<?php echo $benefit->id; ?>">
                <td><?php echo $benefit->payroll_name; ?></td>
                <td class="text-right"><?php echo number_format($benefit->peb_employee_share,2); $total_ee += $benefit->peb_employee_share; ?></td>
                <td class="text-right"><?php echo number_format($benefit->peb_employer_share,2); $total_er += $benefit->peb_employer_share; ?></td>
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>
                <a class="btn btn-warning btn-xs body_wrapper" data-dismiss="modal" href="<?php echo site_url("payroll_benefits/view/{$benefit->payroll_id}") . '?next=' . uri_string(); ?>">Payroll</a>

                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

</div>

<div class="panel-footer">
<table class="table table-default">
  <tr>
    <td class="bold">Total Employee Share:</td>
    <td class="text-right"><?php echo number_format($total_ee,2); ?></td>
  </tr>
  <tr>
    <td class="bold">Total Employer Share:</td>
    <td class="text-right"><?php echo number_format($total_er,2); ?></td>
  </tr>
</table>
</div>

<?php } else { ?>

  <div class="text-center">No Entries Found!</div>

<?php } ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>

<?php endif; ?>