<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_groups_model Class
 *
 * Manipulates `payroll_groups` table on database

CREATE TABLE `payroll_groups` (
  `payroll_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  `page` int(2) DEFAULT '1',
  KEY `group_id` (`payroll_id`,`group_id`)
);

 ALTER TABLE  `payroll_groups` ADD  `payroll_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_groups` ADD  `group_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_groups` ADD  `order` int(2) NOT NULL   DEFAULT '0';
 ALTER TABLE  `payroll_groups` ADD  `page` int(2) NULL   DEFAULT '1';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_groups_model extends MY_Model {

	protected $payroll_id;
	protected $group_id;
	protected $order;
	protected $page;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_groups';
		$this->_short_name = 'payroll_groups';
		$this->_fields = array("payroll_id","group_id","order","page");
		$this->_required = array("payroll_id","group_id","order");
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


// ---------------------------- Start Field: group_id -------------------------------------- 

	/** 
	* Sets a value to `group_id` variable
	* @access public
	*/

		public function setGroupId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('group_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `group_id` variable
	* @access public
	*/

		public function getGroupId() {
			return $this->group_id;
		}
	
// ------------------------------ End Field: group_id --------------------------------------


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


// ---------------------------- Start Field: page -------------------------------------- 

	/** 
	* Sets a value to `page` variable
	* @access public
	*/

		public function setPage($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('page', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `page` variable
	* @access public
	*/

		public function getPage() {
			return $this->page;
		}
	
// ------------------------------ End Field: page --------------------------------------




}

/* End of file Payroll_groups_model.php */
/* Location: ./application/models/Payroll_groups_model.php */
