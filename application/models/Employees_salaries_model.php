<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_salaries_model Class
 *
 * Manipulates `employees_salaries` table on database

CREATE TABLE `employees_salaries` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `company_id` int(20) NOT NULL,
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

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Employees_salaries_model extends MY_Model {

	protected $id;
	protected $name_id;
	protected $company_id;
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
		$this->_fields = array("id","name_id","company_id","amount","rate_per","days","hours","cola","notes","primary","trash");
		$this->_required = array("name_id","company_id","amount","rate_per","days","hours","cola");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: id -------------------------------------- 

	/** 
	* Sets a value to `id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `id` variable
	* @access public
	* @return String;
	*/

		public function getId() {
			return $this->id;
		}
	
// ------------------------------ End Field: id --------------------------------------


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


// ---------------------------- Start Field: company_id -------------------------------------- 

	/** 
	* Sets a value to `company_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setCompanyId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	* @return String;
	*/

		public function getCompanyId() {
			return $this->company_id;
		}
	
// ------------------------------ End Field: company_id --------------------------------------


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


// ---------------------------- Start Field: rate_per -------------------------------------- 

	/** 
	* Sets a value to `rate_per` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setRatePer($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('rate_per', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `rate_per` variable
	* @access public
	* @return String;
	*/

		public function getRatePer() {
			return $this->rate_per;
		}
	
// ------------------------------ End Field: rate_per --------------------------------------


// ---------------------------- Start Field: days -------------------------------------- 

	/** 
	* Sets a value to `days` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setDays($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('days', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `days` variable
	* @access public
	* @return String;
	*/

		public function getDays() {
			return $this->days;
		}
	
// ------------------------------ End Field: days --------------------------------------


// ---------------------------- Start Field: hours -------------------------------------- 

	/** 
	* Sets a value to `hours` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setHours($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('hours', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `hours` variable
	* @access public
	* @return String;
	*/

		public function getHours() {
			return $this->hours;
		}
	
// ------------------------------ End Field: hours --------------------------------------


// ---------------------------- Start Field: cola -------------------------------------- 

	/** 
	* Sets a value to `cola` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setCola($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('cola', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `cola` variable
	* @access public
	* @return String;
	*/

		public function getCola() {
			return $this->cola;
		}
	
// ------------------------------ End Field: cola --------------------------------------


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


// ---------------------------- Start Field: primary -------------------------------------- 

	/** 
	* Sets a value to `primary` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setPrimary($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('primary', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `primary` variable
	* @access public
	* @return String;
	*/

		public function getPrimary() {
			return $this->primary;
		}
	
// ------------------------------ End Field: primary --------------------------------------


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

/* End of file Employees_salaries_model.php */
/* Location: ./application/models/Employees_salaries_model.php */
