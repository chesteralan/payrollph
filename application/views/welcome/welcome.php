<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<div class="container" id="homepage">
<div class="row">

	<?php foreach($concerts as $concert) { ?>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="<?php echo site_url('tickets/index/' .  $concert->id); ?>" class="pull-right"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
					<h3 class="panel-title">
					<?php echo $concert->name; ?>
					</h3>
				</div>
				<div class="panel-body text-center stat-font"><?php echo number_format($concert->total_income,2); ?></div>
			</div>
		</div>
	<?php } ?>

</div>
</div>
<?php $this->load->view('footer'); ?>