<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_benefits_model Class
 *
 * Manipulates `employees_benefits` table on database

CREATE TABLE `employees_benefits` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `employee_share` decimal(30,5) NOT NULL,
  `employer_share` decimal(30,5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `primary` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`benefit_id`),
  KEY `company_id` (`company_id`)
);

 ALTER TABLE  `employees_benefits` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
 ALTER TABLE  `employees_benefits` ADD  `company_id` int(20) NOT NULL   ;
 ALTER TABLE  `employees_benefits` ADD  `name_id` int(20) NOT NULL   ;
 ALTER TABLE  `employees_benefits` ADD  `benefit_id` int(20) NOT NULL   ;
 ALTER TABLE  `employees_benefits` ADD  `employee_share` decimal(30,5) NOT NULL   ;
 ALTER TABLE  `employees_benefits` ADD  `employer_share` decimal(30,5) NOT NULL   ;
 ALTER TABLE  `employees_benefits` ADD  `start_date` date NULL   ;
 ALTER TABLE  `employees_benefits` ADD  `primary` int(1) NULL   DEFAULT '0';
 ALTER TABLE  `employees_benefits` ADD  `trash` int(1) NULL   DEFAULT '1';
 ALTER TABLE  `employees_benefits` ADD  `notes` text NULL   ;


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Employees_benefits_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name_id;
	protected $benefit_id;
	protected $employee_share;
	protected $employer_share;
	protected $start_date;
	protected $primary;
	protected $trash;
	protected $notes;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_benefits';
		$this->_short_name = 'employees_benefits';
		$this->_fields = array("id","company_id","name_id","benefit_id","employee_share","employer_share","start_date","primary","trash","notes");
		$this->_required = array("company_id","name_id","benefit_id","employee_share","employer_share");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: id -------------------------------------- 

	/** 
	* Sets a value to `id` variable
	* @access public
	*/

		public function setId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `id` variable
	* @access public
	*/

		public function getId() {
			return $this->id;
		}
	
// ------------------------------ End Field: id --------------------------------------


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


// ---------------------------- Start Field: employee_share -------------------------------------- 

	/** 
	* Sets a value to `employee_share` variable
	* @access public
	*/

		public function setEmployeeShare($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('employee_share', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `employee_share` variable
	* @access public
	*/

		public function getEmployeeShare() {
			return $this->employee_share;
		}
	
// ------------------------------ End Field: employee_share --------------------------------------


// ---------------------------- Start Field: employer_share -------------------------------------- 

	/** 
	* Sets a value to `employer_share` variable
	* @access public
	*/

		public function setEmployerShare($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('employer_share', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `employer_share` variable
	* @access public
	*/

		public function getEmployerShare() {
			return $this->employer_share;
		}
	
// ------------------------------ End Field: employer_share --------------------------------------


// ---------------------------- Start Field: start_date -------------------------------------- 

	/** 
	* Sets a value to `start_date` variable
	* @access public
	*/

		public function setStartDate($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('start_date', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `start_date` variable
	* @access public
	*/

		public function getStartDate() {
			return $this->start_date;
		}
	
// ------------------------------ End Field: start_date --------------------------------------


// ---------------------------- Start Field: primary -------------------------------------- 

	/** 
	* Sets a value to `primary` variable
	* @access public
	*/

		public function setPrimary($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('primary', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `primary` variable
	* @access public
	*/

		public function getPrimary() {
			return $this->primary;
		}
	
// ------------------------------ End Field: primary --------------------------------------


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

/* End of file Employees_benefits_model.php */
/* Location: ./application/models/Employees_benefits_model.php */
