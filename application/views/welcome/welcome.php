<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( count( $this->session->menu_module ) > 0 ) { ?>

<?php $this->load->view('welcome/welcome_navbar'); ?>

<div class="container" id="homepage">

<?php if( $this->session->userdata( 'current_company' ) ) { ?>

<div class="row">
<?php if( isset( $this->session->menu_module['payroll'] ) ) { ?>
    		<div class="col-md-6">
    			<div class="panel panel-default">
    				<div class="panel-heading">
    					<h3 class="panel-title bold">Payroll</h3>
    				</div>
    				<div class="panel-body">
    					<div class="list-group list-group-icons">
    					<?php if( in_array('payroll', $this->session->menu_module['payroll'] ) ) { ?>
						  <a href="<?php echo site_url('payroll'); ?>" class="list-group-item body_wrapper">
						    <span class="fa fa-list-alt" aria-hidden="true"></span>
						    Payroll
						  </a>
						<?php } ?>
						<?php if( in_array('templates', $this->session->menu_module['payroll'] ) ) { ?>
						  <a href="<?php echo site_url('payroll_templates'); ?>" class="list-group-item body_wrapper">
						    <span class="dashicons dashicons-format-aside" aria-hidden="true"></span>
						    Templates
						  </a>
						<?php } ?>
						</div>
					</div>
    			</div>
    		</div>
<?php } ?>
<?php if( isset( $this->session->menu_module['employees'] ) ) { ?>
    		<div class="col-md-6">
    			<div class="panel panel-default">
    				<div class="panel-heading">
    					<h3 class="panel-title bold">Employees</h3>
    				</div>
    				<div class="panel-body">
    					<div class="list-group list-group-icons">
    					<?php if( in_array('employees', $this->session->menu_module['employees'] ) ) { ?>
						  <a href="<?php echo site_url('employees'); ?>" class="list-group-item body_wrapper">
						    <span class="fa fa-user" aria-hidden="true"></span>
						    Employees
						  </a>
						<?php } ?>
                        <?php if( in_array('groups', $this->session->menu_module['employees'] ) ) { ?>
                          <a href="<?php echo site_url('employees_groups'); ?>" class="list-group-item body_wrapper">
                            <span class="fa fa-users" aria-hidden="true"></span>
                            Groups
                          </a>
                        <?php } ?>

                        <?php if( in_array('positions', $this->session->menu_module['employees'] ) ) { ?>
                          <a href="<?php echo site_url('employees_positions'); ?>" class="list-group-item body_wrapper">
                            <span class="fa fa-users" aria-hidden="true"></span>
                            Positions
                          </a>
                        <?php } ?>
						</div>
					</div>
    			</div>
    		</div>
<?php } ?>
</div>

<?php } ?>

    <div class="row">

<?php if( isset( $this->session->menu_module['lists'] ) ) { 

if(
	( in_array('names', $this->session->menu_module['lists'] ) ) 
    || (  in_array('benefits', $this->session->menu_module['lists'] ) ) 
    || (  in_array('earnings', $this->session->menu_module['lists'] ) ) 
	|| (  in_array('deductions', $this->session->menu_module['lists'] ) ) 
) {
	?>
    		<div class="col-md-6">
    			<div class="panel panel-default">
    				<div class="panel-heading">
    					<h3 class="panel-title bold">Lists</h3>
    				</div>
    				<div class="panel-body">
    					<div class="list-group list-group-icons">
						<?php if( in_array('names', $this->session->menu_module['lists'] ) ) { ?>
						  <a href="<?php echo site_url('lists_names'); ?>" class="list-group-item body_wrapper">
						    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Names
						  </a>
						<?php } ?>
						<?php if( in_array('benefits', $this->session->menu_module['lists'] ) ) { ?>
						  <a href="<?php echo site_url('lists_earnings'); ?>" class="list-group-item body_wrapper">
						    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Earnings
						  </a>
						<?php } ?>
                        <?php if( in_array('earnings', $this->session->menu_module['lists'] ) ) { ?>
                          <a href="<?php echo site_url('lists_benefits'); ?>" class="list-group-item body_wrapper">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Benefits
                          </a>
                        <?php } ?>
                        <?php if( in_array('deductions', $this->session->menu_module['lists'] ) ) { ?>
                          <a href="<?php echo site_url('lists_deductions'); ?>" class="list-group-item body_wrapper">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Deductions
                          </a>
                        <?php } ?>
						</div>
					</div>
    			</div>
    		</div>
<?php } ?>
<?php } ?>

<?php if( isset( $this->session->menu_module['system'] ) ) { 

if(
    ( in_array('users', $this->session->menu_module['system'] ) ) 
    || (  in_array('backup', $this->session->menu_module['system'] ) ) 
) {
    ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title bold">System</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group list-group-icons">
                        <?php if( in_array('users', $this->session->menu_module['system'] ) ) { ?>
                          <a href="<?php echo site_url('system_users'); ?>" class="list-group-item body_wrapper">
                            <span class="badge"><?php echo $stats->users_count; ?></span>
                            <span class="dashicons dashicons-admin-network" aria-hidden="true"></span> Users
                          </a>
                        <?php } ?>
                        <?php if( in_array('backup', $this->session->menu_module['system'] ) ) { ?>
                          <a href="<?php echo site_url('system_backup'); ?>" class="list-group-item body_wrapper">
                            <span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> Backup
                          </a>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
<?php } ?>
<?php } ?>

    </div>    	
    </div>

<?php } else { ?>

<div class="container">
<div class="row">
    		<div class="col-md-4 col-md-offset-4">
    			<div class="panel panel-danger">
    				<div class="panel-heading">
    					<h3 class="panel-title bold">Account Restricted</h3>
    				</div>
    				<div class="panel-body text-center">
    				Your account have not been granted any access to the system! <br/> Please contact system administrator!
					</div>
    			</div>
    		</div>
</div>
</div>
<?php } ?>

<?php $this->load->view('footer'); ?>