<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php $this->load->view('system/system_navbar'); ?>

<div class="container">
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">

<?php if( hasAccess('system', 'backup', 'add') ) { ?>
        <!-- Split button -->
<div class="btn-group pull-right">
  <a href="<?php echo base_url("create_backup.php"); ?>?type=php_multiple" class="btn btn-xs btn-success">Multiple (PHP Backup)</a>
  <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="<?php echo base_url("create_backup.php"); ?>?type=php_single">Single (PHP Backup)</a></li>
    <li><a href="<?php echo base_url("create_backup.php"); ?>?type=win_mysqldump_multiple">Multiple (Windows Backup)</a></li>
    <li><a href="<?php echo base_url("create_backup.php"); ?>?type=win_mysqldump_single">Single (Windows Backup)</a></li>
    <li><a href="<?php echo base_url("create_backup.php"); ?>?type=linux_mysqldump_multiple">Multiple (Linux Backup)</a></li>
    <li><a href="<?php echo base_url("create_backup.php"); ?>?type=linux_mysqldump_single">Single (Linux Backup)</a></li>
  </ul>
</div>
<?php } ?>
          <h3 class="panel-title">Backups 
<a href="<?php echo site_url("system_database/verify"); ?>" class="body_wrapper"><span class="fa fa-database"></span></a>
          </h3>

        </div>
        <div class="panel-body" id="ajaxBodyInnerPage">
<?php if( $backup_files ) { ?>
				<table class="table table-default table-hover table-condensed">
					<thead>
						<tr>
							<th>Backup File</th>
							<th>Filesize</th>
							<th width="170px" class="text-right">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					foreach($backup_files as $file ) { ?>
						<tr id="file_<?php echo url_title($file, "_", true); ?>">
							<td><?php echo $file; ?></td>
							<td><?php echo filesize("backups/" . $file); ?></td>
							<td class="text-right">
								<a href="<?php echo site_url('system_backup/download/' . $file ); ?>" class="btn btn-success btn-xs">Download</a>
								<?php if( hasAccess('system', 'database', 'delete') ) { ?>
								<a href="<?php echo site_url('system_database/delete/' . $file ); ?>" class="btn btn-danger btn-xs confirm_remove" data-target="#file_<?php echo url_title($file, "_", true); ?>">Delete</a>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
<?php } else { ?>
<p class="text-center">No Backup Files Found!</p>
<?php } ?>

        </div>
      </div>
    </div>
</div>
</div>

<?php $this->load->view('footer'); ?>