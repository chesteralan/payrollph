<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('payroll', 'payroll', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Payroll" data-url="<?php echo site_url("payroll/add/ajax") . "?next=" . uri_string(); ?>" style="margin-right: 5px">Add Payroll</button>
<?php } ?>
                  <h3 class="panel-title bold">Account Restricted</h3>
                </div>
                <div class="panel-body text-center">
                Your account have not been granted any access to the system! <br/> Please contact system administrator!
              </div>
              </div>
            </div>
    </div>
</div>

<?php $this->load->view('footer'); ?>