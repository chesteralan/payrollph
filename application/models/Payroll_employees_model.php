<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_employees_model Class
 *
 * Manipulates `payroll_employees` table on database

CREATE TABLE `payroll_employees` (
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  `template` varchar(20) DEFAULT 'payslip',
  `active` int(1) DEFAULT '1',
  KEY `name_id` (`payroll_id`,`name_id`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Payroll_employees_model extends MY_Model {

	protected $payroll_id;
	protected $name_id;
	protected $order;
	protected $template;
	protected $active;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_employees';
		$this->_short_name = 'payroll_employees';
		$this->_fields = array("payroll_id","name_id","order","template","active");
		$this->_required = array("payroll_id","name_id","order");
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


// ---------------------------- Start Field: order -------------------------------------- 

	/** 
	* Sets a value to `order` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setOrder($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('order', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `order` variable
	* @access public
	* @return String;
	*/

		public function getOrder() {
			return $this->order;
		}
	
// ------------------------------ End Field: order --------------------------------------


// ---------------------------- Start Field: template -------------------------------------- 

	/** 
	* Sets a value to `template` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setTemplate($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('template', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `template` variable
	* @access public
	* @return String;
	*/

		public function getTemplate() {
			return $this->template;
		}
	
// ------------------------------ End Field: template --------------------------------------


// ---------------------------- Start Field: active -------------------------------------- 

	/** 
	* Sets a value to `active` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setActive($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('active', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `active` variable
	* @access public
	* @return String;
	*/

		public function getActive() {
			return $this->active;
		}
	
// ------------------------------ End Field: active --------------------------------------




}

/* End of file Payroll_employees_model.php */
/* Location: ./application/models/Payroll_employees_model.php */
