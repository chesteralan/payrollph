<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_model Class
 *
 * Manipulates `employees` table on database

CREATE TABLE `employees` (
  `name_id` int(20) NOT NULL,
  `company_id` int(20) NOT NULL,
  `group_id` int(20) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `position_id` int(20) DEFAULT NULL,
  `area_id` int(20) DEFAULT NULL,
  `hired` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `notes` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`name_id`),
  KEY `name_id` (`name_id`),
  KEY `group_id` (`group_id`),
  KEY `position_id` (`position_id`),
  KEY `area_id` (`area_id`),
  KEY `company_id` (`company_id`)
);

 ALTER TABLE  `employees` ADD  `name_id` int(20) NOT NULL   PRIMARY KEY;
 ALTER TABLE  `employees` ADD  `company_id` int(20) NOT NULL   ;
 ALTER TABLE  `employees` ADD  `group_id` int(20) NULL   ;
 ALTER TABLE  `employees` ADD  `lastname` varchar(100) NOT NULL   ;
 ALTER TABLE  `employees` ADD  `firstname` varchar(100) NOT NULL   ;
 ALTER TABLE  `employees` ADD  `middlename` varchar(100) NOT NULL   ;
 ALTER TABLE  `employees` ADD  `position_id` int(20) NULL   ;
 ALTER TABLE  `employees` ADD  `area_id` int(20) NULL   ;
 ALTER TABLE  `employees` ADD  `hired` date NULL   ;
 ALTER TABLE  `employees` ADD  `status` varchar(100) NULL   ;
 ALTER TABLE  `employees` ADD  `notes` text NULL   ;
 ALTER TABLE  `employees` ADD  `trash` int(1) NOT NULL   DEFAULT '0';
 ALTER TABLE  `employees` ADD  `birthday` date NULL   ;
 ALTER TABLE  `employees` ADD  `birthplace` varchar(50) NULL   ;
 ALTER TABLE  `employees` ADD  `gender` varchar(50) NULL   ;
 ALTER TABLE  `employees` ADD  `civil_status` varchar(50) NULL   ;


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Employees_model extends MY_Model {

	protected $name_id;
	protected $company_id;
	protected $group_id;
	protected $lastname;
	protected $firstname;
	protected $middlename;
	protected $position_id;
	protected $area_id;
	protected $hired;
	protected $status;
	protected $notes;
	protected $trash;
	protected $birthday;
	protected $birthplace;
	protected $gender;
	protected $civil_status;

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
		$this->_fields = array("name_id","company_id","group_id","lastname","firstname","middlename","position_id","area_id","hired","status","notes","trash","birthday","birthplace","gender","civil_status");
		$this->_required = array("company_id","lastname","firstname","middlename","trash");
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


// ---------------------------- Start Field: company_id -------------------------------------- 

	/** 
	* Sets a value to `company_id` variable
	* @access public
	*/

		public function setCompanyId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	*/

		public function getCompanyId() {
			return $this->company_id;
		}
	
// ------------------------------ End Field: company_id --------------------------------------


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


// ---------------------------- Start Field: lastname -------------------------------------- 

	/** 
	* Sets a value to `lastname` variable
	* @access public
	*/

		public function setLastname($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('lastname', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `lastname` variable
	* @access public
	*/

		public function getLastname() {
			return $this->lastname;
		}
	
// ------------------------------ End Field: lastname --------------------------------------


// ---------------------------- Start Field: firstname -------------------------------------- 

	/** 
	* Sets a value to `firstname` variable
	* @access public
	*/

		public function setFirstname($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('firstname', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `firstname` variable
	* @access public
	*/

		public function getFirstname() {
			return $this->firstname;
		}
	
// ------------------------------ End Field: firstname --------------------------------------


// ---------------------------- Start Field: middlename -------------------------------------- 

	/** 
	* Sets a value to `middlename` variable
	* @access public
	*/

		public function setMiddlename($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('middlename', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `middlename` variable
	* @access public
	*/

		public function getMiddlename() {
			return $this->middlename;
		}
	
// ------------------------------ End Field: middlename --------------------------------------


// ---------------------------- Start Field: position_id -------------------------------------- 

	/** 
	* Sets a value to `position_id` variable
	* @access public
	*/

		public function setPositionId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('position_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `position_id` variable
	* @access public
	*/

		public function getPositionId() {
			return $this->position_id;
		}
	
// ------------------------------ End Field: position_id --------------------------------------


// ---------------------------- Start Field: area_id -------------------------------------- 

	/** 
	* Sets a value to `area_id` variable
	* @access public
	*/

		public function setAreaId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('area_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `area_id` variable
	* @access public
	*/

		public function getAreaId() {
			return $this->area_id;
		}
	
// ------------------------------ End Field: area_id --------------------------------------


// ---------------------------- Start Field: hired -------------------------------------- 

	/** 
	* Sets a value to `hired` variable
	* @access public
	*/

		public function setHired($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('hired', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `hired` variable
	* @access public
	*/

		public function getHired() {
			return $this->hired;
		}
	
// ------------------------------ End Field: hired --------------------------------------


// ---------------------------- Start Field: status -------------------------------------- 

	/** 
	* Sets a value to `status` variable
	* @access public
	*/

		public function setStatus($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('status', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `status` variable
	* @access public
	*/

		public function getStatus() {
			return $this->status;
		}
	
// ------------------------------ End Field: status --------------------------------------


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


// ---------------------------- Start Field: trash -------------------------------------- 

	/** 
	* Sets a value to `trash` variable
	* @access public
	*/

		public function setTrash($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('trash', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `trash` variable
	* @access public
	*/

		public function getTrash() {
			return $this->trash;
		}
	
// ------------------------------ End Field: trash --------------------------------------


// ---------------------------- Start Field: birthday -------------------------------------- 

	/** 
	* Sets a value to `birthday` variable
	* @access public
	*/

		public function setBirthday($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('birthday', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `birthday` variable
	* @access public
	*/

		public function getBirthday() {
			return $this->birthday;
		}
	
// ------------------------------ End Field: birthday --------------------------------------


// ---------------------------- Start Field: birthplace -------------------------------------- 

	/** 
	* Sets a value to `birthplace` variable
	* @access public
	*/

		public function setBirthplace($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('birthplace', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `birthplace` variable
	* @access public
	*/

		public function getBirthplace() {
			return $this->birthplace;
		}
	
// ------------------------------ End Field: birthplace --------------------------------------


// ---------------------------- Start Field: gender -------------------------------------- 

	/** 
	* Sets a value to `gender` variable
	* @access public
	*/

		public function setGender($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('gender', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `gender` variable
	* @access public
	*/

		public function getGender() {
			return $this->gender;
		}
	
// ------------------------------ End Field: gender --------------------------------------


// ---------------------------- Start Field: civil_status -------------------------------------- 

	/** 
	* Sets a value to `civil_status` variable
	* @access public
	*/

		public function setCivilStatus($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('civil_status', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `civil_status` variable
	* @access public
	*/

		public function getCivilStatus() {
			return $this->civil_status;
		}
	
// ------------------------------ End Field: civil_status --------------------------------------




}

/* End of file Employees_model.php */
/* Location: ./application/models/Employees_model.php */
