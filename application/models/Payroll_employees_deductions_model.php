<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_employees_deductions_model Class
 *
 * Manipulates `payroll_employees_deductions` table on database

CREATE TABLE `payroll_employees_deductions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `entry_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`payroll_id`,`deduction_id`)
);

 ALTER TABLE  `payroll_employees_deductions` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
 ALTER TABLE  `payroll_employees_deductions` ADD  `payroll_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_employees_deductions` ADD  `name_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_employees_deductions` ADD  `deduction_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_employees_deductions` ADD  `entry_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_employees_deductions` ADD  `amount` decimal(30,5) NOT NULL   ;
 ALTER TABLE  `payroll_employees_deductions` ADD  `notes` text NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_employees_deductions_model extends MY_Model {

	protected $id;
	protected $payroll_id;
	protected $name_id;
	protected $deduction_id;
	protected $entry_id;
	protected $amount;
	protected $notes;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_employees_deductions';
		$this->_short_name = 'payroll_employees_deductions';
		$this->_fields = array("id","payroll_id","name_id","deduction_id","entry_id","amount","notes");
		$this->_required = array("payroll_id","name_id","deduction_id","entry_id","amount");
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


// ---------------------------- Start Field: deduction_id -------------------------------------- 

	/** 
	* Sets a value to `deduction_id` variable
	* @access public
	*/

		public function setDeductionId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('deduction_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `deduction_id` variable
	* @access public
	*/

		public function getDeductionId() {
			return $this->deduction_id;
		}
	
// ------------------------------ End Field: deduction_id --------------------------------------


// ---------------------------- Start Field: entry_id -------------------------------------- 

	/** 
	* Sets a value to `entry_id` variable
	* @access public
	*/

		public function setEntryId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('entry_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `entry_id` variable
	* @access public
	*/

		public function getEntryId() {
			return $this->entry_id;
		}
	
// ------------------------------ End Field: entry_id --------------------------------------


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



	
	public function get_table_options() {
		return array(
			'id' => (object) array(
										'Field'=>'id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'PRI',
										'Default'=>'',
										'Extra'=>'auto_increment'
									),

			'payroll_id' => (object) array(
										'Field'=>'payroll_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'name_id' => (object) array(
										'Field'=>'name_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'deduction_id' => (object) array(
										'Field'=>'deduction_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'entry_id' => (object) array(
										'Field'=>'entry_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'amount' => (object) array(
										'Field'=>'amount',
										'Type'=>'decimal(30,5)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'notes' => (object) array(
										'Field'=>'notes',
										'Type'=>'text',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

}

/* End of file Payroll_employees_deductions_model.php */
/* Location: ./application/models/Payroll_employees_deductions_model.php */
