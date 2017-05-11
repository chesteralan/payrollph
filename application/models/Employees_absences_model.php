<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_absences_model Class
 *
 * Manipulates `employees_absences` table on database

CREATE TABLE `employees_absences` (
  `name_id` int(20) NOT NULL,
  `date_absent` date NOT NULL,
  `hours` int(2) DEFAULT '8',
  `leave_type` int(20) DEFAULT NULL,
  `notes` text,
  KEY `name_id` (`name_id`,`date_absent`)
);

 ALTER TABLE  `employees_absences` ADD  `name_id` int(20) NOT NULL   ;
 ALTER TABLE  `employees_absences` ADD  `date_absent` date NOT NULL   ;
 ALTER TABLE  `employees_absences` ADD  `hours` int(2) NULL   DEFAULT '8';
 ALTER TABLE  `employees_absences` ADD  `leave_type` int(20) NULL   ;
 ALTER TABLE  `employees_absences` ADD  `notes` text NULL   ;


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Employees_absences_model extends MY_Model {

	protected $name_id;
	protected $date_absent;
	protected $hours;
	protected $leave_type;
	protected $notes;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_absences';
		$this->_short_name = 'employees_absences';
		$this->_fields = array("name_id","date_absent","hours","leave_type","notes");
		$this->_required = array("name_id","date_absent");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: name_id -------------------------------------- 

	/** 
	* Sets a value to `name_id` variable
	* @access public
	*/

		public function setNameId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('name_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `name_id` variable
	* @access public
	*/

		public function getNameId() {
			return $this->name_id;
		}
	
// ------------------------------ End Field: name_id --------------------------------------


// ---------------------------- Start Field: date_absent -------------------------------------- 

	/** 
	* Sets a value to `date_absent` variable
	* @access public
	*/

		public function setDateAbsent($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('date_absent', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `date_absent` variable
	* @access public
	*/

		public function getDateAbsent() {
			return $this->date_absent;
		}
	
// ------------------------------ End Field: date_absent --------------------------------------


// ---------------------------- Start Field: hours -------------------------------------- 

	/** 
	* Sets a value to `hours` variable
	* @access public
	*/

		public function setHours($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('hours', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `hours` variable
	* @access public
	*/

		public function getHours() {
			return $this->hours;
		}
	
// ------------------------------ End Field: hours --------------------------------------


// ---------------------------- Start Field: leave_type -------------------------------------- 

	/** 
	* Sets a value to `leave_type` variable
	* @access public
	*/

		public function setLeaveType($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('leave_type', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `leave_type` variable
	* @access public
	*/

		public function getLeaveType() {
			return $this->leave_type;
		}
	
// ------------------------------ End Field: leave_type --------------------------------------


// ---------------------------- Start Field: notes -------------------------------------- 

	/** 
	* Sets a value to `notes` variable
	* @access public
	*/

		public function setNotes($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('notes', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `notes` variable
	* @access public
	*/

		public function getNotes() {
			return $this->notes;
		}
	
// ------------------------------ End Field: notes --------------------------------------




}

/* End of file Employees_absences_model.php */
/* Location: ./application/models/Employees_absences_model.php */
