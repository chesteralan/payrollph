<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_deductions_model Class
 *
 * Manipulates `payroll_deductions` table on database

CREATE TABLE `payroll_deductions` (
  `payroll_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `deduction_id` (`payroll_id`,`deduction_id`)
);

 ALTER TABLE  `payroll_deductions` ADD  `payroll_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_deductions` ADD  `deduction_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_deductions` ADD  `order` int(2) NOT NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Payroll_deductions_model extends MY_Model {

	protected $payroll_id;
	protected $deduction_id;
	protected $order;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_deductions';
		$this->_short_name = 'payroll_deductions';
		$this->_fields = array("payroll_id","deduction_id","order");
		$this->_required = array("payroll_id","deduction_id","order");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: payroll_id -------------------------------------- 

	/** 
	* Sets a value to `payroll_id` variable
	* @access public
	*/

		public function setPayrollId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `payroll_id` variable
	* @access public
	*/

		public function getPayrollId() {
			return $this->payroll_id;
		}
	
// ------------------------------ End Field: payroll_id --------------------------------------


// ---------------------------- Start Field: deduction_id -------------------------------------- 

	/** 
	* Sets a value to `deduction_id` variable
	* @access public
	*/

		public function setDeductionId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('deduction_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `deduction_id` variable
	* @access public
	*/

		public function getDeductionId() {
			return $this->deduction_id;
		}
	
// ------------------------------ End Field: deduction_id --------------------------------------


// ---------------------------- Start Field: order -------------------------------------- 

	/** 
	* Sets a value to `order` variable
	* @access public
	*/

		public function setOrder($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('order', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `order` variable
	* @access public
	*/

		public function getOrder() {
			return $this->order;
		}
	
// ------------------------------ End Field: order --------------------------------------




}

/* End of file Payroll_deductions_model.php */
/* Location: ./application/models/Payroll_deductions_model.php */
