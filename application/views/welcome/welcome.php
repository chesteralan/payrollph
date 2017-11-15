<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php if( count( $this->session->menu_module ) > 0 ) { ?>

<?php $this->load->view('welcome/welcome_navbar'); ?>

<div class="container" id="homepage">

<?php if( $this->session->userdata( 'current_company' ) ) { ?>

<div class="row">
    		<div class="col-md-6">

    			<div class="panel panel-default">
    				<div class="panel-heading">
    					<h3 class="panel-title bold">Shortcuts</h3>
    				</div>
    				<div class="panel-body">
<div class="list-group list-group-icons">
<?php if( isset( $this->session->menu_module['payroll'] ) ) { ?>
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
						
<?php } ?>
<?php if( isset( $this->session->menu_module['employees'] ) ) { ?>
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
                            <span class="fa fa-user-md" aria-hidden="true"></span>
                            Positions
                          </a>
                        <?php } ?>

                        <?php if( in_array('areas', $this->session->menu_module['employees'] ) ) { ?>
                          <a href="<?php echo site_url('employees_areas'); ?>" class="list-group-item body_wrapper">
                            <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                            Area
                          </a>
                        <?php } ?>
<?php } ?>
<?php if( isset( $this->session->menu_module['lists'] ) ) { 

if(
    ( in_array('names', $this->session->menu_module['lists'] ) ) 
    || (  in_array('benefits', $this->session->menu_module['lists'] ) ) 
    || (  in_array('earnings', $this->session->menu_module['lists'] ) ) 
    || (  in_array('deductions', $this->session->menu_module['lists'] ) ) 
) {
    ?>

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

<?php } ?>
<?php } ?>

<?php if( isset( $this->session->menu_module['system'] ) ) { 

if(
    ( in_array('users', $this->session->menu_module['system'] ) ) 
    || (  in_array('backup', $this->session->menu_module['system'] ) ) 
) {
    ?>

                        <?php if( in_array('users', $this->session->menu_module['system'] ) ) { ?>
                          <a href="<?php echo site_url('system_users'); ?>" class="list-group-item body_wrapper">
                            <span class="dashicons dashicons-admin-network" aria-hidden="true"></span> Users
                          </a>
                        <?php } ?>
                        <?php if( in_array('backup', $this->session->menu_module['system'] ) ) { ?>
                          <a href="<?php echo site_url('system_database'); ?>" class="list-group-item body_wrapper">
                            <span class="fa fa-database" aria-hidden="true"></span> Database
                          </a>
                        <?php } ?>

<?php } ?>
<?php } ?>

</div>
					</div>
    			</div>

    		</div>

    		<div class="col-md-6">
<?php if( $birthdays ) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="<?php echo site_url("lists_names/birthdays/" . $this->session->userdata( 'current_company_id' ) ); ?>" class="pull-right btn btn-success btn-xs">Show All</a>
                        <h3 class="panel-title">Birthdays of the Month: <strong><?php echo date('F'); ?></strong></h3>
                    </div>
                    <div class="panel-body">
                        
                        <ul class="list-group">
                          <?php foreach( $birthdays as $celeb ) { ?>
                          <li class="list-group-item">
                            <span class="badge"><?php echo date('F d, Y', strtotime($celeb->birthday)); ?></span>
                            <?php echo $celeb->firstname; ?> <?php echo $celeb->middlename; ?> <?php echo $celeb->lastname; ?> (<?php echo $celeb->age; ?> years old)
                          </li>
                          <?php } ?>
                        </ul>
                        
                    </div>
                </div>
<?php } ?>

<?php if( $services ) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="<?php echo site_url("employees/hired/" . $this->session->userdata( 'current_company_id' ) ); ?>" class="pull-right btn btn-success btn-xs">Show All</a>
                        <h3 class="panel-title">Employment Anniversary: <strong><?php echo date('F'); ?></strong></h3>
                    </div>
                    <div class="panel-body">
                        
                        <ul class="list-group">
                          <?php foreach( $services as $celeb ) { ?>
                          <li class="list-group-item">
                            <span class="badge"><?php echo date('F d, Y', strtotime($celeb->hired)); ?></span>
                            <?php echo $celeb->firstname; ?> <?php echo $celeb->middlename; ?> <?php echo $celeb->lastname; ?> (<?php echo $celeb->age; ?> years old)
                          </li>
                          <?php } ?>
                        </ul>
                        
                    </div>
                </div>
<?php } ?>

        </div>
</div>

<?php } ?>

    </div>    	
    </div>

<?php } else { ?>

<div class="container">
<div class="row">
    		<div class="col-md-6 col-md-offset-3">
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