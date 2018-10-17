<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 $audit_types = unserialize( TERM_TYPES );
?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title bold"><?php echo $current_page; ?></h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $audits ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>User</th>
                <th>Notes</th>
                <th>Company</th>
                <th>Name</th>
                <th class="text-right">Date & Time</th>
              </tr>
            </thead>
            <tbody>

            <?php foreach($audits as $audit) { ?>
              <tr>
                <td><?php echo $audit->user_name; ?></td>
                <td><?php echo $audit->notes; ?></td>
                <td><?php echo $audit->company_name; ?></td>
                <td><?php echo $audit->full_name; ?></td>
                <td class="text-right"><?php echo $audit->date_accessed; ?></td>
              </tr>
            <?php } ?>

            </tbody>
          </table>

          <?php echo ($pagination!='') ? '<center>' . $pagination . '</center>' : ''; ?>

<?php } else { ?>

  <div class="text-center">No audit Found!</div>

<?php } ?>
<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>