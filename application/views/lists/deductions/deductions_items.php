<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title bold"><?php echo $current_page; ?>: <?php echo $earning->name; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $items ) {  ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Deduction Name</th>
                <th>Notes</th>
                <th class="text-right">Whole Amount</th>
                <th class="text-right">Amount</th>
                <?php foreach($templates as $temp) { ?>
                  <th class="text-center"><?php echo $temp->name; ?></th>
                <?php } ?>
                <th width="130px" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>

            <?php foreach($items as $item) { ?>
              <tr id="employee-group-<?php echo $item->id; ?>">
                <td><a href="<?php echo site_url("employees_deductions/view/{$item->name_id}"); ?>" class="body_wrapper">
                <?php echo $item->lastname; ?>, <?php echo $item->firstname; ?></a></td>
                <td><?php echo $item->notes; ?></td>
                <td class="text-right"><?php echo number_format($item->max_amount,2); ?></td>
                <td class="text-right"><?php echo number_format($item->amount,2); ?></td>
                <?php foreach($templates as $temp) { 
                  $var = 'temp_' . $temp->id;
                  ?>
                  <td class="text-center"><span class="glyphicon glyphicon-<?php echo ($item->$var) ? 'ok' : 'remove'; ?>"></span></td>
                <?php } ?>
                <td class="text-right">
                  <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Deduction" data-url="<?php echo site_url("employees_deductions/edit/{$item->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                  <button type="button" class="btn btn-success btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Deduction Entries" data-url="<?php echo site_url("employees_deductions/entries/{$item->id}/ajax") . "?next=" . uri_string(); ?>">Entries</button>

                </td>
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