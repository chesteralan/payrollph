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
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Company" data-url="<?php echo site_url("system_companies/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Company</button>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo $current_page; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $companies ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Company Name</th>
                <th>Address</th>
                <th>Phone</th>
                <?php if( hasAccess('system', 'companies', 'edit') ) { ?>
                  <th width="200px">Action</th>
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
                <td>
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Company" data-url="<?php echo site_url("system_companies/edit/{$company->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <button type="button" class="btn btn-primary btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Print CSS" data-url="<?php echo site_url("system_companies/print_css/{$company->id}/ajax") . "?next=" . uri_string(); ?>">Print CSS</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("system_companies/delete/{$company->id}"); ?>" data-target="#employee-group-<?php echo $company->id; ?>">Delete</button>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No term Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>