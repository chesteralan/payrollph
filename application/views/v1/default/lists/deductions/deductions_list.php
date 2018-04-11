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
<form method="get" action="<?php echo site_url("lists_deductions"); ?>">
<div class="input-group input-group-sm">
  <input type="text" name="q" class="form-control" placeholder="Search for..." value="<?php echo $this->input->get('q'); ?>">
  <span class="input-group-btn">
    <button class="btn btn-default" type="submit">Search</button>
    
<?php if( hasAccess('lists', 'deductions', 'add') ) { ?>
  <button type="button" class="btn btn-success ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Deduction" data-url="<?php echo site_url("lists_deductions/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Deduction</button>
<?php } ?>

  </span>
</div><!-- /input-group -->
</form>
</div>
</div>

                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $deductions ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Deduction Name</th>
                <th>Notes</th>
                <?php if( hasAccess('lists', 'deductions', 'edit') ) { ?>
                  <th width="250px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($deductions as $deduction) { ?>
              <tr id="employee-group-<?php echo $deduction->id; ?>">
                <td><?php echo $deduction->name; ?></td>
                <td><?php echo $deduction->notes; ?></td>
              <?php if( hasAccess('lists', 'deductions', 'edit') ) { ?>
                <td>
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("lists_deductions/edit/{$deduction->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("lists_deductions/delete/{$deduction->id}"); ?>" data-target="#employee-group-<?php echo $deduction->id; ?>">Delete</a>

                <a class="btn btn-success btn-xs body_wrapper" href="<?php echo site_url("lists_deductions/items/{$deduction->id}"); ?>">Items</a>

                <a class="btn btn-info btn-xs body_wrapper" href="<?php echo site_url("lists_deductions/entries/{$deduction->id}"); ?>">Entries</a>
                
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No Deduction Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>