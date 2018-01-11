<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">Select Company</div>
          <div class="panel-body">
<?php endif; ?>
<?php if($companies) { ?>

<div class="list-group">
  <?php foreach($companies as $company) { ?>
  <a href="<?php echo site_url("welcome/select_company/{$company->id}"); ?>" class="list-group-item">
    <h4 class="list-group-item-heading"><?php echo $company->name; ?></h4>
    <p class="list-group-item-text"><?php echo $company->address; ?><br/><?php echo $company->phone; ?></p>
  </a>
  <?php } ?>
</div>
<?php } ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>
  
          </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer'); ?>

<?php endif; ?>