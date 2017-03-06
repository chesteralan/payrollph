<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( $this->session->userdata( 'current_company' ) ) { ?>
<div class="container">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <div class="navbar-brand"><?php echo $this->session->userdata( 'current_company' ); ?></div>
    </div>
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

<?php if( $companies ) { ?>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Companies <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<?php foreach($companies as $company) { ?>
            	<li><a href="<?php echo site_url("welcome/change_company/{$company->id}"); ?>"><?php echo $company->name; ?></a></li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
<?php } ?>

  </div><!-- /.container-fluid -->
</nav>
</div>
<?php } ?>