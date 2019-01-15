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

<!-- #blankModal Modal -->
<div class="modal fade" id="ajaxModal">
  <div class="modal-dialog">
<form method="post" action="" id="ajaxModalForm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center"><span class="title"></span></h4>
      </div>
      <div class="modal-body">
        <p class="loader text-center">
        	<img src="<?php echo base_url("assets/images/loader4.gif"); ?>">
        </p>
        <div class="output"></div>
      </div>
       <div class="modal-footer" style="display: none;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
</form>
  </div>
</div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jqueryui/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/numeral.min.js'); ?>"></script>
    
    <script src="<?php echo base_url('assets/js/bootstrap-select/js/bootstrap-select.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/tag-it/js/tag-it.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/nprogress/nprogress.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/payroll.js'); ?>"></script>
  </body>
</html>

<?php endif; // inner_page ?>