<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if( ( ! $inner_page ) && ( ! $body_wrapper ) ): ?>

</div> <!-- #bodyWrapper -->

<div class="container hide-print">
	<div class="row">
		<div class="col-md-6">
			<small>

<?php if( $this->config->item('multi_company') ) { ?>
Current <?php echo lang_term('companies_title_singular', 'Company'); ?>: <strong>
<a class="ajax-modal" href="#ajaxModal" data-hide_footer="1" data-toggle="modal" data-target="#ajaxModal" data-title="Switch Company" data-url="<?php echo site_url("welcome/select_company/0/ajax") . "?next=" . uri_string(); ?>">
      <?php echo $this->session->userdata( 'current_company' ); ?></a></strong>
<?php } ?>
				<p><a href="http://www.smbpayroll.com/" target="footer_credits"><?php echo APP_NAME; ?> v<?php echo APP_VERSION; ?></a> 
				&copy; <?php echo date('Y'); ?> </p>
				
				
			</small>
		</div>
    <div class="col-md-6 text-right">
<small>
Developed by: 
        <a href="http://www.chesteralan.com/" target="footer_credits">Chester Alan Tagudin</a>
        <p><strong>M:</strong> <?php echo $this->benchmark->memory_usage();?> <strong>T:</strong> <?php echo $this->benchmark->elapsed_time();?> <strong>IP:</strong> <?php echo $this->input->ip_address(); ?></p>
</small>
    </div> 
	</div> 
</div>

<?php $this->load->view('_modal_form'); ?>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jqueryui/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/numeral.min.js'); ?>"></script>
    
    <script src="<?php echo base_url('assets/libs/bootstrap-select/js/bootstrap-select.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap-toggle/js/bootstrap-toggle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/tag-it/js/tag-it.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/nprogress/nprogress.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/payroll.js'); ?>"></script>


  </body>
</html>

<?php endif; // inner_page ?>