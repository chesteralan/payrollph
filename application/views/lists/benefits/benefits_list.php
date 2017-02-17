<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('lists', 'benefits', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Benefit" data-url="<?php echo site_url("lists_benefits/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Benefit</button>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo $current_page; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $benefits ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Benefit Name</th>
                <th>Notes</th>
                <th>EE Account Title</th>
                <th>ER Account Title</th>
                <th>Leave</th>
                <?php if( hasAccess('lists', 'benefits', 'edit') ) { ?>
                  <th width="105px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($benefits as $benefit) { ?>
              <tr id="employee-benefit-<?php echo $benefit->id; ?>">
                <td><?php echo $benefit->name; ?></td>
                <td><?php echo $benefit->notes; ?></td>
                <td><?php echo $benefit->ee_account_title; ?></td>
                <td><?php echo $benefit->er_account_title; ?></td>
                <td><span class="glyphicon glyphicon-<?php echo ($benefit->leave) ? 'ok' : 'remove'; ?>"></span></td>
              <?php if( hasAccess('lists', 'benefits', 'edit') ) { ?>
                <td>
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Benefit" data-url="<?php echo site_url("lists_benefits/edit/{$benefit->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("lists_benefits/delete/{$benefit->id}"); ?>" data-target="#employee-benefit-<?php echo $benefit->id; ?>">Delete</a>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Benefit Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>