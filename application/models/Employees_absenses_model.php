<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_absenses_model Class
 *
 * Manipulates `employees_absenses` table on database

CREATE TABLE `employees_absenses` (
  `name_id` int(20) NOT NULL,
  `date_absent` date NOT NULL,
  `leave_type` int(20) DEFAULT NULL,
  KEY `name_id` (`name_id`,`date_absent`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Employees_absenses_model extends MY_Model {

	protected $name_id;
	protected $date_absent;
	protected $leave_type;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_absenses';
		$this->_short_name = 'employees_absenses';
		$this->_fields = array("name_id","date_absent","leave_type");
		$this->_required = array("name_id","date_absent");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


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


// ---------------------------- Start Field: date_absent -------------------------------------- 

	/** 
	* Sets a value to `date_absent` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setDateAbsent($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('date_absent', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `date_absent` variable
	* @access public
	* @return String;
	*/

		public function getDateAbsent() {
			return $this->date_absent;
		}
	
// ------------------------------ End Field: date_absent --------------------------------------


// ---------------------------- Start Field: leave_type -------------------------------------- 

	/** 
	* Sets a value to `leave_type` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setLeaveType($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('leave_type', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `leave_type` variable
	* @access public
	* @return String;
	*/

		public function getLeaveType() {
			return $this->leave_type;
		}
	
// ------------------------------ End Field: leave_type --------------------------------------




}

/* End of file Employees_absenses_model.php */
/* Location: ./application/models/Employees_absenses_model.php */
