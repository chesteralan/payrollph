<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center><small>
				<p><a href="http://www.trokis.com/" target="footer_credits">Trokis Philippines</a> 
				&copy; 2016 
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
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <form method="post" action="" id="ajaxModalForm">
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
      </form>
    </div>
  </div>
</div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jqueryui/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/numeral.min.js'); ?>"></script>
    
    <script src="<?php echo base_url('assets/js/bootstrap-select/js/bootstrap-select.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/tag-it/js/tag-it.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
  </body>
</html>
