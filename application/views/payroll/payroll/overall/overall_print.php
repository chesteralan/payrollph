<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

switch( $template->print_format ) {
    case 'clergy_allowance':
      $this->load->view('payroll/payroll/overall/overall_print_clergy_allowance');
    break;
    default:
       $this->load->view('payroll/payroll/overall/overall_print_default');
    break;
}
