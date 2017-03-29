<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if( ( ! $inner_page ) && ( ! $body_wrapper ) ): ?>

</div> <!-- #bodyWrapper -->

<div class="container hide-print">
	<div class="row">
		<div class="col-md-12">
			<center><small>
      <p><strong><?php echo $this->session->userdata( 'current_company' ); ?></strong><br>
				<a href="http://www.trokis.com/" target="footer_credits">Trokis Philippines</a> 
				&copy; <?php echo date('Y'); ?> 
				<br>Developed by: 
				<a href="http://www.chesteralan.com/" target="footer_credits">Chester Alan Tagudin</a> 
				</p>
			</small></center>
		</div>
	</div> 
</div>

<!-- #blankModal Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
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