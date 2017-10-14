<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_benefits_model Class
 *
 * Manipulates `payroll_benefits` table on database

CREATE TABLE `payroll_benefits` (
  `payroll_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `benefit_id` (`payroll_id`,`benefit_id`)
);

 ALTER TABLE  `payroll_benefits` ADD  `payroll_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_benefits` ADD  `benefit_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_benefits` ADD  `order` int(2) NOT NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_benefits_model extends MY_Model {

	protected $payroll_id;
	protected $benefit_id;
	protected $order;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_benefits';
		$this->_short_name = 'payroll_benefits';
		$this->_fields = array("payroll_id","benefit_id","order");
		$this->_required = array("payroll_id","benefit_id","order");
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


// ---------------------------- Start Field: benefit_id -------------------------------------- 

	/** 
	* Sets a value to `benefit_id` variable
	* @access public
	*/

		public function setBenefitId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('benefit_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `benefit_id` variable
	* @access public
	*/

		public function getBenefitId() {
			return $this->benefit_id;
		}
	
// ------------------------------ End Field: benefit_id --------------------------------------


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

/* End of file Payroll_benefits_model.php */
/* Location: ./application/models/Payroll_benefits_model.php */
