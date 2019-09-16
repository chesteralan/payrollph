<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">

          <a class="btn btn-success btn-xs ajax-modal pull-right" data-toggle="modal" data-target="#ajaxModal" data-title="Add Payroll Period" data-url="<?php echo site_url("system_companies/add_payroll_period/{$company->id}/ajax") . "?next=" . uri_string(); ?>">Add Period</a>

          <h3 class="panel-title">Payroll Period</h3>
        </div>

        <div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php if( $periods ) { ?>

          <table class="table table-default table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th class="text-center">Year</th>
                <th class="text-center">Start</th>
                <th class="text-center">End</th>
                <th class="text-center">Working Hours</th>
                <?php if( hasAccess('system', 'companies', 'edit') ) { ?>
                  <th width="125px" class="text-right">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($periods as $period) { ?>
              <tr id="employee-group-<?php echo $period->id; ?>">
                <td><?php echo $period->name; ?></td>
                <td class="text-center"><?php echo $period->year; ?></td>
                <td class="text-center"><?php echo date("F d, Y", strtotime($period->start)); ?></td>
                <td class="text-center"><?php echo date("F d, Y", strtotime($period->end)); ?></td>
                <td class="text-center"><?php echo $period->working_hours; ?></td>
              <?php if( hasAccess('system', 'terms', 'edit') ) { ?>
                <td class="text-right">
                <button type="button" class="btn btn-warning btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Payroll Period" data-url="<?php echo site_url("system_companies/edit_payroll_period/{$period->id}/ajax") . "?next=" . uri_string(); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("system_companies/delete_payroll_period/{$period->id}"); ?>" data-target="#employee-group-<?php echo $period->id; ?>">Delete</button>
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


<?php if( isset($output) && ($output!='ajax') ) : ?>

        </div>


      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>