<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_employees_salaries_model Class
 *
 * Manipulates `payroll_employees_salaries` table on database

CREATE TABLE `payroll_employees_salaries` (
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `salary_id` int(20) NOT NULL,
  `amount` decimal(10,5) DEFAULT '0.00000',
  KEY `name_id` (`name_id`),
  KEY `payroll_id` (`payroll_id`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Payroll_employees_salaries_model extends MY_Model {

	protected $payroll_id;
	protected $name_id;
	protected $salary_id;
	protected $amount;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_employees_salaries';
		$this->_short_name = 'payroll_employees_salaries';
		$this->_fields = array("payroll_id","name_id","salary_id","amount");
		$this->_required = array("payroll_id","name_id","salary_id");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: payroll_id -------------------------------------- 

	/** 
	* Sets a value to `payroll_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setPayrollId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `payroll_id` variable
	* @access public
	* @return String;
	*/

		public function getPayrollId() {
			return $this->payroll_id;
		}
	
// ------------------------------ End Field: payroll_id --------------------------------------


// ---------------------------- Start Field: name_id -------------------------------------- 

	/** 
	* Sets a value to `name_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setNameId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('name_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `name_id` variable
	* @access public
	* @return String;
	*/

		public function getNameId() {
			return $this->name_id;
		}
	
// ------------------------------ End Field: name_id --------------------------------------


// ---------------------------- Start Field: salary_id -------------------------------------- 

	/** 
	* Sets a value to `salary_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setSalaryId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('salary_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `salary_id` variable
	* @access public
	* @return String;
	*/

		public function getSalaryId() {
			return $this->salary_id;
		}
	
// ------------------------------ End Field: salary_id --------------------------------------


// ---------------------------- Start Field: amount -------------------------------------- 

	/** 
	* Sets a value to `amount` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setAmount($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('amount', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `amount` variable
	* @access public
	* @return String;
	*/

		public function getAmount() {
			return $this->amount;
		}
	
// ------------------------------ End Field: amount --------------------------------------




}

/* End of file Payroll_employees_salaries_model.php */
/* Location: ./application/models/Payroll_employees_salaries_model.php */
