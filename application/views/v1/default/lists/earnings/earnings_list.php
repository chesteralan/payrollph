<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">

<div class="row">
<div class="col-md-9 col-sm-6">
          <h3 class="panel-title bold"><?php echo $current_page; ?>
                    <?php if( $this->input->get('q') ) { ?>
                    <span class="badge"><?php echo $this->input->get('q'); ?> <a href="<?php echo site_url(uri_string()); ?>"><span class="glyphicon glyphicon-remove"></span></a></span>
                    <?php } ?>
          </h3>
</div>
<div class="col-md-3">
<form method="get" action="<?php echo site_url("lists_earnings"); ?>">
<div class="input-group input-group-sm">
  <input type="text" name="q" class="form-control" placeholder="Search for..." value="<?php echo $this->input->get('q'); ?>">
  <span class="input-group-btn">
    <button class="btn btn-default" type="submit">Search</button>
    
<?php if( hasAccess('lists', 'earnings', 'add') ) { ?>
  <button type="button" class="btn btn-success ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Earning" data-url="<?php echo site_url("lists_earnings/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Earning</button>
<?php } ?>

  </span>
</div><!-- /input-group -->
</form>
</div>
</div>

                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $earnings ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Earning Name</th>
                <th>Notes</th>
                <th>Abbr</th>
                <?php if( hasAccess('lists', 'earnings', 'edit') ) { ?>
                  <th width="180px" class="text-right">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($earnings as $earning) { ?>
              <tr id="employee-group-<?php echo $earning->id; ?>">
                <td><?php echo $earning->name; ?></td>
                <td><?php echo $earning->notes; ?></td>
                <td><?php echo $earning->abbr; ?></td>
              <?php if( hasAccess('lists', 'earnings', 'edit') ) { ?>
                <td class="text-right">
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Earning" data-url="<?php echo site_url("lists_earnings/edit/{$earning->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("lists_earnings/delete/{$earning->id}"); ?>" data-target="#employee-group-<?php echo $earning->id; ?>">Delete</a>

                 <a class="btn btn-success btn-xs body_wrapper" href="<?php echo site_url("lists_earnings/items/{$earning->id}"); ?>">Items</a>

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