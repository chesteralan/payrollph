<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('lists', 'earnings', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Earning" data-url="<?php echo site_url("lists_earnings/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Earning</button>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo $current_page; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $earnings ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Earning Name</th>
                <th>Notes</th>
                <?php if( hasAccess('lists', 'earnings', 'edit') ) { ?>
                  <th width="105px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($earnings as $earning) { ?>
              <tr id="employee-group-<?php echo $earning->id; ?>">
                <td><?php echo $earning->name; ?></td>
                <td><?php echo $earning->notes; ?></td>
              <?php if( hasAccess('lists', 'earnings', 'edit') ) { ?>
                <td>
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Earning" data-url="<?php echo site_url("lists_earnings/edit/{$earning->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("lists_earnings/delete/{$earning->id}"); ?>" data-target="#employee-group-<?php echo $earning->id; ?>">Delete</a>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Earning Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>