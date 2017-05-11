<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_earnings_model Class
 *
 * Manipulates `payroll_earnings` table on database

CREATE TABLE `payroll_earnings` (
  `payroll_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `earning_id` (`payroll_id`,`earning_id`)
);

 ALTER TABLE  `payroll_earnings` ADD  `payroll_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_earnings` ADD  `earning_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_earnings` ADD  `order` int(2) NOT NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Payroll_earnings_model extends MY_Model {

	protected $payroll_id;
	protected $earning_id;
	protected $order;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_earnings';
		$this->_short_name = 'payroll_earnings';
		$this->_fields = array("payroll_id","earning_id","order");
		$this->_required = array("payroll_id","earning_id","order");
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


// ---------------------------- Start Field: earning_id -------------------------------------- 

	/** 
	* Sets a value to `earning_id` variable
	* @access public
	*/

		public function setEarningId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('earning_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `earning_id` variable
	* @access public
	*/

		public function getEarningId() {
			return $this->earning_id;
		}
	
// ------------------------------ End Field: earning_id --------------------------------------


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

/* End of file Payroll_earnings_model.php */
/* Location: ./application/models/Payroll_earnings_model.php */
