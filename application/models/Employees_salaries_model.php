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
  `annual_days` int(3) DEFAULT '312',
  `months` int(2) DEFAULT '12',
  `hours` int(10) NOT NULL DEFAULT '8',
  `cola` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `notes` text,
  `manner` varchar(50) NOT NULL DEFAULT 'daily',
  `primary` int(1) DEFAULT '0',
  `date_started` date DEFAULT NULL,
  `trash` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin;

ALTER TABLE  `employees_salaries` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `employees_salaries` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_salaries` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_salaries` ADD  `amount` decimal(30,5) NOT NULL   DEFAULT '0.00000';
ALTER TABLE  `employees_salaries` ADD  `rate_per` varchar(10) NOT NULL   DEFAULT 'month';
ALTER TABLE  `employees_salaries` ADD  `days` int(10) NOT NULL   DEFAULT '26';
ALTER TABLE  `employees_salaries` ADD  `annual_days` int(3) NULL   DEFAULT '312';
ALTER TABLE  `employees_salaries` ADD  `months` int(2) NULL   DEFAULT '12';
ALTER TABLE  `employees_salaries` ADD  `hours` int(10) NOT NULL   DEFAULT '8';
ALTER TABLE  `employees_salaries` ADD  `cola` decimal(10,5) NOT NULL   DEFAULT '0.00000';
ALTER TABLE  `employees_salaries` ADD  `notes` text NULL   ;
ALTER TABLE  `employees_salaries` ADD  `manner` varchar(50) NOT NULL   DEFAULT 'daily';
ALTER TABLE  `employees_salaries` ADD  `primary` int(1) NULL   DEFAULT '0';
ALTER TABLE  `employees_salaries` ADD  `date_started` date NULL   ;
ALTER TABLE  `employees_salaries` ADD  `trash` int(1) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_salaries_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name_id;
	protected $amount;
	protected $rate_per;
	protected $days;
	protected $annual_days;
	protected $months;
	protected $hours;
	protected $cola;
	protected $notes;
	protected $manner;
	protected $primary;
	protected $date_started;
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
		$this->_fields = array("id","company_id","name_id","amount","rate_per","days","annual_days","months","hours","cola","notes","manner","primary","date_started","trash");
		$this->_required = array("company_id","name_id","amount","rate_per","days","hours","cola","manner");
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

	public function set_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `id` variable
	* @access public
	*/

	public function getId() {
		return $this->id;
	}

	public function get_id_value() {
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

	public function set_company_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	*/

	public function getCompanyId() {
		return $this->company_id;
	}

	public function get_company_id_value() {
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

	public function set_name_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `name_id` variable
	* @access public
	*/

	public function getNameId() {
		return $this->name_id;
	}

	public function get_name_id_value() {
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

	public function set_amount_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('amount', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `amount` variable
	* @access public
	*/

	public function getAmount() {
		return $this->amount;
	}

	public function get_amount_value() {
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

	public function set_rate_per_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('rate_per', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `rate_per` variable
	* @access public
	*/

	public function getRatePer() {
		return $this->rate_per;
	}

	public function get_rate_per_value() {
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

	public function set_days_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('days', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `days` variable
	* @access public
	*/

	public function getDays() {
		return $this->days;
	}

	public function get_days_value() {
		return $this->days;
	}

	
// ------------------------------ End Field: days --------------------------------------


// ---------------------------- Start Field: annual_days -------------------------------------- 

	/** 
	* Sets a value to `annual_days` variable
	* @access public
	*/

	public function setAnnualDays($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('annual_days', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_annual_days_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('annual_days', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `annual_days` variable
	* @access public
	*/

	public function getAnnualDays() {
		return $this->annual_days;
	}

	public function get_annual_days_value() {
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

	public function set_months_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('months', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `months` variable
	* @access public
	*/

	public function getMonths() {
		return $this->months;
	}

	public function get_months_value() {
		return $this->months;
	}

	
// ------------------------------ End Field: months --------------------------------------


// ---------------------------- Start Field: hours -------------------------------------- 

	/** 
	* Sets a value to `hours` variable
	* @access public
	*/

	public function setHours($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('hours', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_hours_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('hours', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `hours` variable
	* @access public
	*/

	public function getHours() {
		return $this->hours;
	}

	public function get_hours_value() {
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

	public function set_cola_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('cola', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `cola` variable
	* @access public
	*/

	public function getCola() {
		return $this->cola;
	}

	public function get_cola_value() {
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

	public function set_notes_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('notes', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `notes` variable
	* @access public
	*/

	public function getNotes() {
		return $this->notes;
	}

	public function get_notes_value() {
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

	public function set_manner_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('manner', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `manner` variable
	* @access public
	*/

	public function getManner() {
		return $this->manner;
	}

	public function get_manner_value() {
		return $this->manner;
	}

	
// ------------------------------ End Field: manner --------------------------------------


// ---------------------------- Start Field: primary -------------------------------------- 

	/** 
	* Sets a value to `primary` variable
	* @access public
	*/

	public function setPrimary($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('primary', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_primary_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('primary', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `primary` variable
	* @access public
	*/

	public function getPrimary() {
		return $this->primary;
	}

	public function get_primary_value() {
		return $this->primary;
	}

	
// ------------------------------ End Field: primary --------------------------------------


// ---------------------------- Start Field: date_started -------------------------------------- 

	/** 
	* Sets a value to `date_started` variable
	* @access public
	*/

	public function setDateStarted($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_started', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_date_started_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_started', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `date_started` variable
	* @access public
	*/

	public function getDateStarted() {
		return $this->date_started;
	}

	public function get_date_started_value() {
		return $this->date_started;
	}

	
// ------------------------------ End Field: date_started --------------------------------------


// ---------------------------- Start Field: trash -------------------------------------- 

	/** 
	* Sets a value to `trash` variable
	* @access public
	*/

	public function setTrash($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('trash', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_trash_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('trash', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `trash` variable
	* @access public
	*/

	public function getTrash() {
		return $this->trash;
	}

	public function get_trash_value() {
		return $this->trash;
	}

	
// ------------------------------ End Field: trash --------------------------------------



	
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

			'amount' => (object) array(
										'Field'=>'amount',
										'Type'=>'decimal(30,5)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0.00000',
										'Extra'=>''
									),

			'rate_per' => (object) array(
										'Field'=>'rate_per',
										'Type'=>'varchar(10)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'month',
										'Extra'=>''
									),

			'days' => (object) array(
										'Field'=>'days',
										'Type'=>'int(10)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'26',
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
									),

			'hours' => (object) array(
										'Field'=>'hours',
										'Type'=>'int(10)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'8',
										'Extra'=>''
									),

			'cola' => (object) array(
										'Field'=>'cola',
										'Type'=>'decimal(10,5)',
										'Null'=>'NO',
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

			'primary' => (object) array(
										'Field'=>'primary',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'date_started' => (object) array(
										'Field'=>'date_started',
										'Type'=>'date',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'trash' => (object) array(
										'Field'=>'trash',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `employees_salaries` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `employees_salaries` ADD  `company_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `employees_salaries` ADD  `name_id` int(20) NOT NULL   ;",
			'amount' => "ALTER TABLE  `employees_salaries` ADD  `amount` decimal(30,5) NOT NULL   DEFAULT '0.00000';",
			'rate_per' => "ALTER TABLE  `employees_salaries` ADD  `rate_per` varchar(10) NOT NULL   DEFAULT 'month';",
			'days' => "ALTER TABLE  `employees_salaries` ADD  `days` int(10) NOT NULL   DEFAULT '26';",
			'annual_days' => "ALTER TABLE  `employees_salaries` ADD  `annual_days` int(3) NULL   DEFAULT '312';",
			'months' => "ALTER TABLE  `employees_salaries` ADD  `months` int(2) NULL   DEFAULT '12';",
			'hours' => "ALTER TABLE  `employees_salaries` ADD  `hours` int(10) NOT NULL   DEFAULT '8';",
			'cola' => "ALTER TABLE  `employees_salaries` ADD  `cola` decimal(10,5) NOT NULL   DEFAULT '0.00000';",
			'notes' => "ALTER TABLE  `employees_salaries` ADD  `notes` text NULL   ;",
			'manner' => "ALTER TABLE  `employees_salaries` ADD  `manner` varchar(50) NOT NULL   DEFAULT 'daily';",
			'primary' => "ALTER TABLE  `employees_salaries` ADD  `primary` int(1) NULL   DEFAULT '0';",
			'date_started' => "ALTER TABLE  `employees_salaries` ADD  `date_started` date NULL   ;",
			'trash' => "ALTER TABLE  `employees_salaries` ADD  `trash` int(1) NULL   DEFAULT '0';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setId() - id
//setCompanyId() - company_id
//setNameId() - name_id
//setAmount() - amount
//setRatePer() - rate_per
//setDays() - days
//setAnnualDays() - annual_days
//setMonths() - months
//setHours() - hours
//setCola() - cola
//setNotes() - notes
//setManner() - manner
//setPrimary() - primary
//setDateStarted() - date_started
//setTrash() - trash

--------------------------------------

//set_id() - id
//set_company_id() - company_id
//set_name_id() - name_id
//set_amount() - amount
//set_rate_per() - rate_per
//set_days() - days
//set_annual_days() - annual_days
//set_months() - months
//set_hours() - hours
//set_cola() - cola
//set_notes() - notes
//set_manner() - manner
//set_primary() - primary
//set_date_started() - date_started
//set_trash() - trash

*/
/* End of file Employees_salaries_model.php */
/* Location: ./application/models/Employees_salaries_model.php */
