<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Names_info_model Class
 *
 * Manipulates `names_info` table on database

CREATE TABLE `names_info` (
  `name_id` int(20) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`name_id`),
  KEY `name_id` (`name_id`)
);

 ALTER TABLE  `names_info` ADD  `name_id` int(20) NOT NULL   PRIMARY KEY;
 ALTER TABLE  `names_info` ADD  `lastname` varchar(100) NOT NULL   ;
 ALTER TABLE  `names_info` ADD  `firstname` varchar(100) NOT NULL   ;
 ALTER TABLE  `names_info` ADD  `middlename` varchar(100) NULL   ;
 ALTER TABLE  `names_info` ADD  `birthday` date NULL   ;
 ALTER TABLE  `names_info` ADD  `birthplace` varchar(50) NULL   ;
 ALTER TABLE  `names_info` ADD  `gender` varchar(50) NULL   ;
 ALTER TABLE  `names_info` ADD  `civil_status` varchar(50) NULL   ;
 ALTER TABLE  `names_info` ADD  `prefix` varchar(50) NULL   ;
 ALTER TABLE  `names_info` ADD  `suffix` varchar(50) NULL   ;


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Names_info_model extends MY_Model {

	protected $name_id;
	protected $lastname;
	protected $firstname;
	protected $middlename;
	protected $birthday;
	protected $birthplace;
	protected $gender;
	protected $civil_status;
	protected $prefix;
	protected $suffix;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'names_info';
		$this->_short_name = 'names_info';
		$this->_fields = array("name_id","lastname","firstname","middlename","birthday","birthplace","gender","civil_status","prefix","suffix");
		$this->_required = array("lastname","firstname");
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


// ---------------------------- Start Field: prefix -------------------------------------- 

	/** 
	* Sets a value to `prefix` variable
	* @access public
	*/

		public function setPrefix($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('prefix', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `prefix` variable
	* @access public
	*/

		public function getPrefix() {
			return $this->prefix;
		}
	
// ------------------------------ End Field: prefix --------------------------------------


// ---------------------------- Start Field: suffix -------------------------------------- 

	/** 
	* Sets a value to `suffix` variable
	* @access public
	*/

		public function setSuffix($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('suffix', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `suffix` variable
	* @access public
	*/

		public function getSuffix() {
			return $this->suffix;
		}
	
// ------------------------------ End Field: suffix --------------------------------------




}

/* End of file Names_info_model.php */
/* Location: ./application/models/Names_info_model.php */
