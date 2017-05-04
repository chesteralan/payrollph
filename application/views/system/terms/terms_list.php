<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('system', 'terms', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Term" data-url="<?php echo site_url("system_terms/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Term</button>
<?php } ?>
                  <h3 class="panel-title bold"><?php echo $current_page; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $terms ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Term Name</th>
                <th>Type</th>
                <?php if( hasAccess('system', 'terms', 'edit') ) { ?>
                  <th width="125px">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($terms as $term) { ?>
              <tr id="employee-group-<?php echo $term->id; ?>">
                <td><?php echo $term->name; ?></td>
                <td><?php 
                $term_types = unserialize( TERM_TYPES );
                echo $term_types[$term->type]; 
                ?></td>
              <?php if( hasAccess('system', 'terms', 'edit') ) { ?>
                <td>
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Group" data-url="<?php echo site_url("system_terms/edit/{$term->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("system_terms/delete/{$term->id}"); ?>" data-target="#employee-group-<?php echo $term->id; ?>">Delete</button>
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