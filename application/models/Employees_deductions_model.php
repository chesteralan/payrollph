<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_deductions_model Class
 *
 * Manipulates `employees_deductions` table on database

CREATE TABLE `employees_deductions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL,
  `max_amount` decimal(30,5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `computed` varchar(10) DEFAULT '',
  `active` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`deduction_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin;

ALTER TABLE  `employees_deductions` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `employees_deductions` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_deductions` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_deductions` ADD  `deduction_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_deductions` ADD  `amount` decimal(30,5) NOT NULL   ;
ALTER TABLE  `employees_deductions` ADD  `max_amount` decimal(30,5) NOT NULL   ;
ALTER TABLE  `employees_deductions` ADD  `start_date` date NULL   ;
ALTER TABLE  `employees_deductions` ADD  `computed` varchar(10) NULL   ;
ALTER TABLE  `employees_deductions` ADD  `active` int(1) NULL   DEFAULT '0';
ALTER TABLE  `employees_deductions` ADD  `trash` int(1) NULL   DEFAULT '1';
ALTER TABLE  `employees_deductions` ADD  `notes` text NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_deductions_model extends MY_Model {

	protected $id;
	protected $company_id;
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
		$this->_fields = array("id","company_id","name_id","deduction_id","amount","max_amount","start_date","computed","active","trash","notes");
		$this->_required = array("company_id","name_id","deduction_id","amount","max_amount");
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


// ---------------------------- Start Field: max_amount -------------------------------------- 

	/** 
	* Sets a value to `max_amount` variable
	* @access public
	*/

	public function setMaxAmount($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('max_amount', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `max_amount` variable
	* @access public
	*/

	public function getMaxAmount() {
		return $this->max_amount;
	}
	
// ------------------------------ End Field: max_amount --------------------------------------


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


// ---------------------------- Start Field: computed -------------------------------------- 

	/** 
	* Sets a value to `computed` variable
	* @access public
	*/

	public function setComputed($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('computed', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `computed` variable
	* @access public
	*/

	public function getComputed() {
		return $this->computed;
	}
	
// ------------------------------ End Field: computed --------------------------------------


// ---------------------------- Start Field: active -------------------------------------- 

	/** 
	* Sets a value to `active` variable
	* @access public
	*/

	public function setActive($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('active', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `active` variable
	* @access public
	*/

	public function getActive() {
		return $this->active;
	}
	
// ------------------------------ End Field: active --------------------------------------


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

			'company_id' => (object) array(
										'Field'=>'company_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
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

			'amount' => (object) array(
										'Field'=>'amount',
										'Type'=>'decimal(30,5)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'max_amount' => (object) array(
										'Field'=>'max_amount',
										'Type'=>'decimal(30,5)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'start_date' => (object) array(
										'Field'=>'start_date',
										'Type'=>'date',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'computed' => (object) array(
										'Field'=>'computed',
										'Type'=>'varchar(10)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'active' => (object) array(
										'Field'=>'active',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'trash' => (object) array(
										'Field'=>'trash',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'1',
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

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `employees_deductions` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `employees_deductions` ADD  `company_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `employees_deductions` ADD  `name_id` int(20) NOT NULL   ;",
			'deduction_id' => "ALTER TABLE  `employees_deductions` ADD  `deduction_id` int(20) NOT NULL   ;",
			'amount' => "ALTER TABLE  `employees_deductions` ADD  `amount` decimal(30,5) NOT NULL   ;",
			'max_amount' => "ALTER TABLE  `employees_deductions` ADD  `max_amount` decimal(30,5) NOT NULL   ;",
			'start_date' => "ALTER TABLE  `employees_deductions` ADD  `start_date` date NULL   ;",
			'computed' => "ALTER TABLE  `employees_deductions` ADD  `computed` varchar(10) NULL   ;",
			'active' => "ALTER TABLE  `employees_deductions` ADD  `active` int(1) NULL   DEFAULT '0';",
			'trash' => "ALTER TABLE  `employees_deductions` ADD  `trash` int(1) NULL   DEFAULT '1';",
			'notes' => "ALTER TABLE  `employees_deductions` ADD  `notes` text NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Employees_deductions_model.php */
/* Location: ./application/models/Employees_deductions_model.php */
