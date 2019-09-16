<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('lists/lists_navbar'); ?>

<div class="container">
<div class="row">

	<div class="col-md-6 col-md-offset-3">
	    <div class="panel panel-default">
	    	<div class="panel-heading">
	    		<h3 class="panel-title">Import CSV File</h3>
	    	</div>
<?php echo form_open_multipart('lists_names/import');?>
	    	<div class="panel-body">

<?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>
<div class="row">
<div class="col-md-5">
	<p>Max File Size: <strong>600 KB</strong> (1,500 lines max)</p>
		    	<p><input type="file" name="import_file" /></p>
	    		<p><input class="btn btn-xs btn-info" type="submit" value="Upload & Import" /></p>
</div>
<div class="col-md-7">
	<strong><a href="<?php echo base_url("import/names-import-template.csv"); ?>"><span class="glyphicon glyphicon-download-alt"></span> Download CSV Template</a></strong><br>
	<smalll style="font-size: 11px;"><em>Note: You should not interchange the columns in the template.</em></smalll>
</div>
	
</div>
	    		
<?php if( isset($output) && ($output!='ajax') ) : ?>

	    	</div>
</form>

	    </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>