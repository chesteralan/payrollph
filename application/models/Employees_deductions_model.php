<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_deductions_model Class
 *
 * Manipulates `employees_deductions` table on database

CREATE TABLE `employees_deductions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `amount` decimal(10,5) NOT NULL,
  `max_amount` decimal(10,5) DEFAULT '0.00000',
  `start_date` date DEFAULT NULL,
  `computed` varchar(10) DEFAULT '',
  `active` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`deduction_id`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Employees_deductions_model extends MY_Model {

	protected $id;
	protected $name_id;
	protected $deduction_id;
	protected $amount;
	protected $max_amount;
	protected $start_date;
	protected $computed;
	protected $active;
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
		$this->_table_name = 'employees_deductions';
		$this->_short_name = 'employees_deductions';
		$this->_fields = array("id","name_id","deduction_id","amount","max_amount","start_date","computed","active","trash","notes");
		$this->_required = array("name_id","deduction_id","amount");
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


// ---------------------------- Start Field: deduction_id -------------------------------------- 

	/** 
	* Sets a value to `deduction_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setDeductionId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('deduction_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `deduction_id` variable
	* @access public
	* @return String;
	*/

		public function getDeductionId() {
			return $this->deduction_id;
		}
	
// ------------------------------ End Field: deduction_id --------------------------------------


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


// ---------------------------- Start Field: max_amount -------------------------------------- 

	/** 
	* Sets a value to `max_amount` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setMaxAmount($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('max_amount', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `max_amount` variable
	* @access public
	* @return String;
	*/

		public function getMaxAmount() {
			return $this->max_amount;
		}
	
// ------------------------------ End Field: max_amount --------------------------------------


// ---------------------------- Start Field: start_date -------------------------------------- 

	/** 
	* Sets a value to `start_date` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setStartDate($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('start_date', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `start_date` variable
	* @access public
	* @return String;
	*/

		public function getStartDate() {
			return $this->start_date;
		}
	
// ------------------------------ End Field: start_date --------------------------------------


// ---------------------------- Start Field: computed -------------------------------------- 

	/** 
	* Sets a value to `computed` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setComputed($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('computed', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `computed` variable
	* @access public
	* @return String;
	*/

		public function getComputed() {
			return $this->computed;
		}
	
// ------------------------------ End Field: computed --------------------------------------


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




}

/* End of file Employees_deductions_model.php */
/* Location: ./application/models/Employees_deductions_model.php */
