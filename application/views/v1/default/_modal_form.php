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
        <button id="btnModalSave" type="submit" class="btn btn-primary" data-loading-text="Please wait...">Save changes</button>
      </div>
    </div>
</form>
  </div>
</div>
