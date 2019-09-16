<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('system', 'companies', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add <?php echo lang_term('companies_title_singular', 'Company'); ?>" data-url="<?php echo site_url("system_companies/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add <?php echo lang_term('companies_title_singular', 'Company'); ?></button>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo lang_term('companies_title_plural', 'Companies'); ?> <a href="<?php echo site_url("system_companies"); ?>?filter=trash"><span class="glyphicon glyphicon-trash"></span></a></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $companies ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th><?php echo lang_term('companies_title_singular', 'Company'); ?> Name</th>
                <th>Address</th>
                <th>Phone</th>
                <?php if( hasAccess('system', 'companies', 'edit') ) { ?>
                  <th width="170px" class="text-right">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($companies as $company) { ?>
              <tr id="employee-group-<?php echo $company->id; ?>" class="<?php echo ($company->default==1) ? 'success' : ''; ?>">
                <td><?php echo $company->name; ?></td>
                <td><?php echo $company->address; ?></td>
                <td><?php echo $company->phone; ?></td>
              <?php if( hasAccess('system', 'companies', 'edit') ) { ?>
                <td class="text-right">
<?php if( $this->input->get('filter') == 'trash') { ?>

  <a class="btn btn-success btn-xs confirm" href="<?php echo site_url("system_companies/restore/{$company->id}"); ?>" data-target="#employee-group-<?php echo $company->id; ?>">Restore</a>

<?php } else { ?>
<div class="btn-group">
  <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit <?php echo lang_term('companies_title_singular', 'Company'); ?>" data-url="<?php echo site_url("system_companies/edit/{$company->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>
  <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right">
    <li><a class="body_wrapper" href="<?php echo site_url("system_companies/payroll_period/{$company->id}") . "?next=" . uri_string(); ?>">Payroll Period</a></li>
    <li><a href="#" class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Payroll Columns" data-url="<?php echo site_url("system_companies/column_group/{$company->id}/ajax") . "?next=" . uri_string(); ?>">Payroll Columns</a></li>
    <li><a href="#" class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Print Group" data-url="<?php echo site_url("system_companies/print_group/{$company->id}/ajax") . "?next=" . uri_string(); ?>">Print Group</a></li>
    <li><a href="#" class="ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Print CSS" data-url="<?php echo site_url("system_companies/print_css/{$company->id}/ajax") . "?next=" . uri_string(); ?>">Print CSS</a></li>
  </ul>
</div>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("system_companies/deactivate/{$company->id}"); ?>" data-target="#employee-group-<?php echo $company->id; ?>">Deactivate</a>

                </td>

              <?php } ?>

              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Companies Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>