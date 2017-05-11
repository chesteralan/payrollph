<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_salaries_model Class
 *
 * Manipulates `employees_salaries` table on database

CREATE TABLE `employees_salaries` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL DEFAULT '0.00000',
  `rate_per` varchar(10) NOT NULL DEFAULT 'month',
  `days` int(10) NOT NULL DEFAULT '26',
  `hours` int(10) NOT NULL DEFAULT '8',
  `cola` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `notes` text,
  `primary` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`),
  KEY `company_id` (`company_id`)
);

 ALTER TABLE  `employees_salaries` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
 ALTER TABLE  `employees_salaries` ADD  `company_id` int(20) NOT NULL   ;
 ALTER TABLE  `employees_salaries` ADD  `name_id` int(20) NOT NULL   ;
 ALTER TABLE  `employees_salaries` ADD  `amount` decimal(30,5) NOT NULL   DEFAULT '0.00000';
 ALTER TABLE  `employees_salaries` ADD  `rate_per` varchar(10) NOT NULL   DEFAULT 'month';
 ALTER TABLE  `employees_salaries` ADD  `days` int(10) NOT NULL   DEFAULT '26';
 ALTER TABLE  `employees_salaries` ADD  `hours` int(10) NOT NULL   DEFAULT '8';
 ALTER TABLE  `employees_salaries` ADD  `cola` decimal(10,5) NOT NULL   DEFAULT '0.00000';
 ALTER TABLE  `employees_salaries` ADD  `notes` text NULL   ;
 ALTER TABLE  `employees_salaries` ADD  `primary` int(1) NULL   DEFAULT '0';
 ALTER TABLE  `employees_salaries` ADD  `trash` int(1) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Employees_salaries_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name_id;
	protected $amount;
	protected $rate_per;
	protected $days;
	protected $hours;
	protected $cola;
	protected $notes;
	protected $primary;
	protected $trash;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_salaries';
		$this->_short_name = 'employees_salaries';
		$this->_fields = array("id","company_id","name_id","amount","rate_per","days","hours","cola","notes","primary","trash");
		$this->_required = array("company_id","name_id","amount","rate_per","days","hours","cola");
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


// ---------------------------- Start Field: amount -------------------------------------- 

	/** 
	* Sets a value to `amount` variable
	* @access public
	*/

		public function setAmount($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('amount', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `amount` variable
	* @access public
	*/

		public function getAmount() {
			return $this->amount;
		}
	
// ------------------------------ End Field: amount --------------------------------------


// ---------------------------- Start Field: rate_per -------------------------------------- 

	/** 
	* Sets a value to `rate_per` variable
	* @access public
	*/

		public function setRatePer($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('rate_per', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `rate_per` variable
	* @access public
	*/

		public function getRatePer() {
			return $this->rate_per;
		}
	
// ------------------------------ End Field: rate_per --------------------------------------


// ---------------------------- Start Field: days -------------------------------------- 

	/** 
	* Sets a value to `days` variable
	* @access public
	*/

		public function setDays($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('days', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `days` variable
	* @access public
	*/

		public function getDays() {
			return $this->days;
		}
	
// ------------------------------ End Field: days --------------------------------------


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


// ---------------------------- Start Field: cola -------------------------------------- 

	/** 
	* Sets a value to `cola` variable
	* @access public
	*/

		public function setCola($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('cola', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `cola` variable
	* @access public
	*/

		public function getCola() {
			return $this->cola;
		}
	
// ------------------------------ End Field: cola --------------------------------------


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




}

/* End of file Employees_salaries_model.php */
/* Location: ./application/models/Employees_salaries_model.php */
