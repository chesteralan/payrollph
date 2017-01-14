<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('showError') ) {
	function showError($code, $errorData=NULL) {
		$error = array(
            // lending
            '101' => array(
                'type' => 'danger',
                'msg' =>'<strong>Settings Error!</strong> Please set configurations correctly!',
                ),
             '102' => array(
                'type' => 'danger',
                'msg' =>'<strong>Settings Error!</strong> Please set configurations correctly!',
                ),
             '103' => array(
                'type' => 'danger',
                'msg' =>'<strong>Unable to delete!</strong> There should be no applied payment to delete loan!',
                ),
             '104' => array(
                'type' => 'danger',
                'msg' =>'<strong>Unable to add payment!</strong> Duplicate receipt number...',
                ),
             '105' => array(
                'type' => 'danger',
                'msg' =>'<strong>Unable to update payment!</strong> Payment already deposited!',
                ),
              // share capital
              '201' => array(
                'type' => 'danger',
                'msg' =>'<strong>Settings Error!</strong> Please set a class name!',
                ),
              '202' => array(
                'type' => 'danger',
                'msg' =>'<strong>Settings Error!</strong> Please set configurations correctly!',
                ),
              '203' => array(
                'type' => 'danger',
                'msg' =>'<strong>Settings Error!</strong> Please set members capital account!',
                ),
              '204' => array(
                'type' => 'danger',
                'msg' =>'<strong>Unable to add capital!</strong> Duplicate receipt number...',
                ),
              '205' => array(
                'type' => 'danger',
                'msg' =>'<strong>Capital Deposited!</strong> Delete deposit first!',
                ),
              '206' => array(
                'type' => 'danger',
                'msg' =>'<strong>Unable to withdraw capital!</strong> Duplicate check number...',
                ),
              '207' => array(
                'type' => 'danger',
                'msg' =>'<strong>Settings Error!</strong> Please set configurations correctly!',
                ),
              // Accounting 
              '301' => array(
                'type' => 'danger',
                'msg' =>'<strong>Receipt Deposit!</strong> Delete deposit first!',
                ),
              '330' => array(
                'type' => 'danger',
                'msg' =>'<strong>Erroneous Transaction!</strong> Transaction and its corresponding entries were deleted!',
                ),
               '331' => array(
                'type' => 'danger',
                'msg' =>'<strong>No Transaction Found!</strong> Entries were deleted!',
                ),
               '340' => array(
                'type' => 'success',
                'msg' =>'<strong>Name Created!</strong> Successfully added new name on the list!',
                ),
               '341' => array(
                'type' => 'danger',
                'msg' =>'<strong>Error!</strong> Unable to add new name on the list! Name must be unique!',
                ),
              '401' => array(
                'type' => 'danger',
                'msg' =>'<strong>Deposit Error!</strong> Error depositing the receipts!',
                ),
              '402' => array(
                'type' => 'danger',
                'msg' =>'<strong>Delete Deposit Error!</strong> Deposit is cleared, delete bank reconciliation first to perform this action!',
                ),

              '501' => array(
                'type' => 'danger',
                'msg' =>'<strong>Delete Error!</strong> Cannot delete member!',
                ),
               '601' => array(
                'type' => 'danger',
                'msg' =>'<strong>Delete Error!</strong> Cannot delete this reconciliation without deleting the new ones!',
                ),
               '602' => array(
                'type' => 'success',
                'msg' =>'<strong>Successfully Reset Recon!</strong>',
                ),
               '603' => array(
                'type' => 'danger',
                'msg' =>'<strong>Error Resetting Recon!</strong>',
                ),
               '604' => array(
                'type' => 'danger',
                'msg' =>'<strong>Add Recon Error!</strong> Check data submitted!',
                ),
                '701' => array(
                'type' => 'success',
                'msg' =>'<strong>Transaction Error!</strong> Deleted Successfully!',
                ),

                '999' => array(
                'type' => 'danger',
                'msg' =>'<strong>Access Restriction!</strong> You are not allowed to view the page!',
                ),
                
        );

        if( isset($error[$code]) ) {
            $type = (isset($error[$code]['type'])) ? $error[$code]['type'] : 'default';
echo <<<ERR
<div class="container">
<div class="alert alert-{$type} alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {$error[$code]['msg']}
</div>
</div>
ERR;
        }
	}
}