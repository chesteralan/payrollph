<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_employees_salaries_model Class
 *
 * Manipulates `payroll_employees_salaries` table on database

CREATE TABLE `payroll_employees_salaries` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `salary_id` int(20) NOT NULL,
  `amount` decimal(30,5) DEFAULT '0.00000',
  `notes` text,
  `manner` varchar(50) NOT NULL DEFAULT 'daily',
  `rate_per` varchar(10) DEFAULT 'month',
  `days` int(10) DEFAULT '26',
  `hours` int(10) DEFAULT '8',
  `cola` decimal(10,5) DEFAULT '0.00000',
  `annual_days` int(3) DEFAULT '312',
  `months` int(2) DEFAULT '12',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`),
  KEY `payroll_id` (`payroll_id`)
);

ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `payroll_id` int(20) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `salary_id` int(20) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `amount` decimal(30,5) NULL   DEFAULT '0.00000';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `notes` text NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `manner` varchar(50) NOT NULL   DEFAULT 'daily';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `rate_per` varchar(10) NULL   DEFAULT 'month';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `days` int(10) NULL   DEFAULT '26';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `hours` int(10) NULL   DEFAULT '8';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `cola` decimal(10,5) NULL   DEFAULT '0.00000';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `annual_days` int(3) NULL   DEFAULT '312';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `months` int(2) NULL   DEFAULT '12';


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_employees_salaries_model extends MY_Model {

	protected $id;
	protected $payroll_id;
	protected $name_id;
	protected $salary_id;
	protected $amount;
	protected $notes;
	protected $manner;
	protected $rate_per;
	protected $days;
	protected $hours;
	protected $cola;
	protected $annual_days;
	protected $months;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_employees_salaries';
		$this->_short_name = 'payroll_employees_salaries';
		$this->_fields = array("id","payroll_id","name_id","salary_id","amount","notes","manner","rate_per","days","hours","cola","annual_days","months");
		$this->_required = array("payroll_id","name_id","salary_id","manner");
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


// ---------------------------- Start Field: salary_id -------------------------------------- 

	/** 
	* Sets a value to `salary_id` variable
	* @access public
	*/

	public function setSalaryId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('salary_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `salary_id` variable
	* @access public
	*/

	public function getSalaryId() {
		return $this->salary_id;
	}
	
// ------------------------------ End Field: salary_id --------------------------------------


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


// ---------------------------- Start Field: manner -------------------------------------- 

	/** 
	* Sets a value to `manner` variable
	* @access public
	*/

	public function setManner($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('manner', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `manner` variable
	* @access public
	*/

	public function getManner() {
		return $this->manner;
	}
	
// ------------------------------ End Field: manner --------------------------------------


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


// ---------------------------- Start Field: annual_days -------------------------------------- 

	/** 
	* Sets a value to `annual_days` variable
	* @access public
	*/

	public function setAnnualDays($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('annual_days', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `annual_days` variable
	* @access public
	*/

	public function getAnnualDays() {
		return $this->annual_days;
	}
	
// ------------------------------ End Field: annual_days --------------------------------------


// ---------------------------- Start Field: months -------------------------------------- 

	/** 
	* Sets a value to `months` variable
	* @access public
	*/

	public function setMonths($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('months', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `months` variable
	* @access public
	*/

	public function getMonths() {
		return $this->months;
	}
	
// ------------------------------ End Field: months --------------------------------------



	
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

			'salary_id' => (object) array(
										'Field'=>'salary_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'amount' => (object) array(
										'Field'=>'amount',
										'Type'=>'decimal(30,5)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0.00000',
										'Extra'=>''
									),

			'notes' => (object) array(
										'Field'=>'notes',
										'Type'=>'text',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'manner' => (object) array(
										'Field'=>'manner',
										'Type'=>'varchar(50)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'daily',
										'Extra'=>''
									),

			'rate_per' => (object) array(
										'Field'=>'rate_per',
										'Type'=>'varchar(10)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'month',
										'Extra'=>''
									),

			'days' => (object) array(
										'Field'=>'days',
										'Type'=>'int(10)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'26',
										'Extra'=>''
									),

			'hours' => (object) array(
										'Field'=>'hours',
										'Type'=>'int(10)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'8',
										'Extra'=>''
									),

			'cola' => (object) array(
										'Field'=>'cola',
										'Type'=>'decimal(10,5)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0.00000',
										'Extra'=>''
									),

			'annual_days' => (object) array(
										'Field'=>'annual_days',
										'Type'=>'int(3)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'312',
										'Extra'=>''
									),

			'months' => (object) array(
										'Field'=>'months',
										'Type'=>'int(2)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'12',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'payroll_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `payroll_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `name_id` int(20) NOT NULL   ;",
			'salary_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `salary_id` int(20) NOT NULL   ;",
			'amount' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `amount` decimal(30,5) NULL   DEFAULT '0.00000';",
			'notes' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `notes` text NULL   ;",
			'manner' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `manner` varchar(50) NOT NULL   DEFAULT 'daily';",
			'rate_per' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `rate_per` varchar(10) NULL   DEFAULT 'month';",
			'days' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `days` int(10) NULL   DEFAULT '26';",
			'hours' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `hours` int(10) NULL   DEFAULT '8';",
			'cola' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `cola` decimal(10,5) NULL   DEFAULT '0.00000';",
			'annual_days' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `annual_days` int(3) NULL   DEFAULT '312';",
			'months' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees_salaries` ADD  `months` int(2) NULL   DEFAULT '12';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Payroll_employees_salaries_model.php */
/* Location: ./application/models/Payroll_employees_salaries_model.php */
