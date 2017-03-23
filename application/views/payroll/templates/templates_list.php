<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( ! $inner_page ): ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('payroll', 'templates', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Template" data-url="<?php echo site_url("payroll_templates/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Template</button>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo $current_page; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">

<?php endif; ?>

<?php if( $templates ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Template Name</th>
                <th>Payroll</th>
                <?php if( hasAccess('payroll', 'templates', 'edit') ) { ?>
                  <th width="200px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php foreach($templates as $template) { ?>
              <tr id="template-<?php echo $template->id; ?>">
                <td><?php echo $template->name; ?></td>
                <td><a class="body_wrapper" href="<?php echo site_url("payroll/template/{$template->id}"); ?>"><?php echo $template->payroll_count; ?></a></td>
              <?php if( hasAccess('payroll', 'templates', 'edit') ) { ?>
                <td>

                <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Configure Template" data-url="<?php echo site_url("payroll_templates/config/{$template->id}/ajax") . "?next=" . uri_string(); ?>" data-hide_footer="1">Config</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("payroll_templates/delete/{$template->id}"); ?>" data-target="#template-<?php echo $template->id; ?>">Delete</a>

                <a class="btn btn-warning btn-xs body_wrapper" href="<?php echo site_url("payroll_salaries/preview/{$template->id}"); ?>" data-target="#template-<?php echo $template->id; ?>">Preview</a>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Template Found!</div>

<?php } ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>