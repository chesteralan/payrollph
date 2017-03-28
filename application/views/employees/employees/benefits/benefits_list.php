<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<?php if( hasAccess('employees', 'employees', 'add') ) { ?>
  <button type="button" class="btn btn-success btn-xs pull-right ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Add Benefit" data-url="<?php echo site_url("employees_benefits/add/{$employee->name_id}/ajax") . "?next=" . ( ( ($this->input->get('next')) && ($this->input->get('next') != 'employees') ) ? $this->input->get('next') : uri_string()); ?>" style="margin-right: 5px">Add Benefit</button>
<?php } ?>
                  <h3 class="panel-title bold">
                  <?php echo $current_page; ?>
                  </h3>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>
<?php if( $benefits ) { ?>

          <table class="table table-default">
            <thead>
              <tr>
                <th>Benefit Name</th>
                <th>Employee Share</th>
                <th>Employer Share</th>
                <th>Start</th>
                <?php foreach($templates as $temp) { ?>
                  <th class="text-center"><?php echo $temp->name; ?></th>
                <?php } ?>
                <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                  <th width="105px" class="action_column">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

            <?php foreach($benefits as $benefit) { ?>
              <tr id="salary-<?php echo $benefit->id; ?>" class="<?php echo ($benefit->primary==1) ? 'success' : ''; ?>">
                <td><?php echo $benefit->benefit_name; ?></td>
                <td><?php echo number_format($benefit->employee_share,2); ?></td>
                <td><?php echo number_format($benefit->employer_share,2); ?></td>
                <td><?php echo date('F d, Y', strtotime($benefit->start_date)); ?></td>

                <?php foreach($templates as $temp) { 
                  $var = 'temp_' . $temp->id;
                  ?>
                  <td class="text-center"><span class="glyphicon glyphicon-<?php echo ($benefit->$var) ? 'ok' : 'remove'; ?>"></span></td>
                <?php } ?>
                
              <?php if( hasAccess('employees', 'employees', 'edit') ) { ?>
                <td>
                <button type="button" class="btn btn-info btn-xs ajax-modal" data-toggle="modal" data-target="#ajaxModal" data-title="Edit Benefit" data-url="<?php echo site_url("employees_benefits/edit/{$benefit->id}/ajax") . "?next=" . (($this->input->get('next')) ? $this->input->get('next') : uri_string()); ?>">Edit</button>

                <a class="btn btn-danger btn-xs confirm_remove" href="<?php echo site_url("employees_benefits/delete/{$benefit->id}"); ?>" data-target="#salary-<?php echo $benefit->id; ?>">Delete</a>

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