<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_model Class
 *
 * Manipulates `employees` table on database

CREATE TABLE `employees` (
  `name_id` int(20) NOT NULL,
  `group_id` int(20) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `position_id` int(20) DEFAULT NULL,
  `area_id` int(20) DEFAULT NULL,
  `hired` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `notes` text,
  `phone_number` varchar(100) DEFAULT NULL,
  `address` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  KEY `name_id` (`name_id`),
  KEY `group_id` (`group_id`),
  KEY `position_id` (`position_id`),
  KEY `area_id` (`area_id`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Employees_model extends MY_Model {

	protected $name_id;
	protected $group_id;
	protected $lastname;
	protected $firstname;
	protected $middlename;
	protected $position_id;
	protected $area_id;
	protected $hired;
	protected $status;
	protected $notes;
	protected $phone_number;
	protected $address;
	protected $trash;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees';
		$this->_short_name = 'employees';
		$this->_fields = array("name_id","group_id","lastname","firstname","middlename","position_id","area_id","hired","status","notes","phone_number","address","trash");
		$this->_required = array("name_id","lastname","firstname","middlename","trash");
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


// ---------------------------- Start Field: group_id -------------------------------------- 

	/** 
	* Sets a value to `group_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setGroupId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('group_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `group_id` variable
	* @access public
	* @return String;
	*/

		public function getGroupId() {
			return $this->group_id;
		}
	
// ------------------------------ End Field: group_id --------------------------------------


// ---------------------------- Start Field: lastname -------------------------------------- 

	/** 
	* Sets a value to `lastname` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setLastname($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('lastname', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `lastname` variable
	* @access public
	* @return String;
	*/

		public function getLastname() {
			return $this->lastname;
		}
	
// ------------------------------ End Field: lastname --------------------------------------


// ---------------------------- Start Field: firstname -------------------------------------- 

	/** 
	* Sets a value to `firstname` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setFirstname($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('firstname', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `firstname` variable
	* @access public
	* @return String;
	*/

		public function getFirstname() {
			return $this->firstname;
		}
	
// ------------------------------ End Field: firstname --------------------------------------


// ---------------------------- Start Field: middlename -------------------------------------- 

	/** 
	* Sets a value to `middlename` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setMiddlename($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('middlename', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `middlename` variable
	* @access public
	* @return String;
	*/

		public function getMiddlename() {
			return $this->middlename;
		}
	
// ------------------------------ End Field: middlename --------------------------------------


// ---------------------------- Start Field: position_id -------------------------------------- 

	/** 
	* Sets a value to `position_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setPositionId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('position_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `position_id` variable
	* @access public
	* @return String;
	*/

		public function getPositionId() {
			return $this->position_id;
		}
	
// ------------------------------ End Field: position_id --------------------------------------


// ---------------------------- Start Field: area_id -------------------------------------- 

	/** 
	* Sets a value to `area_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setAreaId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('area_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `area_id` variable
	* @access public
	* @return String;
	*/

		public function getAreaId() {
			return $this->area_id;
		}
	
// ------------------------------ End Field: area_id --------------------------------------


// ---------------------------- Start Field: hired -------------------------------------- 

	/** 
	* Sets a value to `hired` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setHired($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('hired', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `hired` variable
	* @access public
	* @return String;
	*/

		public function getHired() {
			return $this->hired;
		}
	
// ------------------------------ End Field: hired --------------------------------------


// ---------------------------- Start Field: status -------------------------------------- 

	/** 
	* Sets a value to `status` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setStatus($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('status', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `status` variable
	* @access public
	* @return String;
	*/

		public function getStatus() {
			return $this->status;
		}
	
// ------------------------------ End Field: status --------------------------------------


// ---------------------------- Start Field: notes -------------------------------------- 

	/** 
	* Sets a value to `notes` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setNotes($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('notes', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `notes` variable
	* @access public
	* @return String;
	*/

		public function getNotes() {
			return $this->notes;
		}
	
// ------------------------------ End Field: notes --------------------------------------


// ---------------------------- Start Field: phone_number -------------------------------------- 

	/** 
	* Sets a value to `phone_number` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setPhoneNumber($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('phone_number', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `phone_number` variable
	* @access public
	* @return String;
	*/

		public function getPhoneNumber() {
			return $this->phone_number;
		}
	
// ------------------------------ End Field: phone_number --------------------------------------


// ---------------------------- Start Field: address -------------------------------------- 

	/** 
	* Sets a value to `address` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setAddress($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('address', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `address` variable
	* @access public
	* @return String;
	*/

		public function getAddress() {
			return $this->address;
		}
	
// ------------------------------ End Field: address --------------------------------------


// ---------------------------- Start Field: trash -------------------------------------- 

	/** 
	* Sets a value to `trash` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setTrash($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('trash', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `trash` variable
	* @access public
	* @return String;
	*/

		public function getTrash() {
			return $this->trash;
		}
	
// ------------------------------ End Field: trash --------------------------------------




}

/* End of file Employees_model.php */
/* Location: ./application/models/Employees_model.php */
