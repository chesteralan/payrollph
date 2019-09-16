<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_earnings_model Class
 *
 * Manipulates `employees_earnings` table on database

CREATE TABLE `employees_earnings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL,
  `max_amount` decimal(30,5) DEFAULT '0.00000',
  `start_date` date DEFAULT NULL,
  `computed` varchar(10) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '0',
  `notes` text,
  `multiplier` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`earning_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `employees_earnings` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `employees_earnings` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_earnings` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_earnings` ADD  `earning_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_earnings` ADD  `amount` decimal(30,5) NOT NULL   ;
ALTER TABLE  `employees_earnings` ADD  `max_amount` decimal(30,5) NULL   DEFAULT '0.00000';
ALTER TABLE  `employees_earnings` ADD  `start_date` date NULL   ;
ALTER TABLE  `employees_earnings` ADD  `computed` varchar(10) NULL   ;
ALTER TABLE  `employees_earnings` ADD  `active` int(1) NULL   DEFAULT '0';
ALTER TABLE  `employees_earnings` ADD  `trash` int(1) NULL   DEFAULT '0';
ALTER TABLE  `employees_earnings` ADD  `notes` text NULL   ;
ALTER TABLE  `employees_earnings` ADD  `multiplier` varchar(50) NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_earnings_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name_id;
	protected $earning_id;
	protected $amount;
	protected $max_amount;
	protected $start_date;
	protected $computed;
	protected $active;
	protected $trash;
	protected $notes;
	protected $multiplier;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_earnings';
		$this->_short_name = 'employees_earnings';
		$this->_fields = array("id","company_id","name_id","earning_id","amount","max_amount","start_date","computed","active","trash","notes","multiplier");
		$this->_required = array("company_id","name_id","earning_id","amount");
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


// ---------------------------- Start Field: earning_id -------------------------------------- 

	/** 
	* Sets a value to `earning_id` variable
	* @access public
	*/

	public function setEarningId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('earning_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_earning_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('earning_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `earning_id` variable
	* @access public
	*/

	public function getEarningId() {
		return $this->earning_id;
	}

	public function get_earning_id_value() {
		return $this->earning_id;
	}

	
// ------------------------------ End Field: earning_id --------------------------------------


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


// ---------------------------- Start Field: max_amount -------------------------------------- 

	/** 
	* Sets a value to `max_amount` variable
	* @access public
	*/

	public function setMaxAmount($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('max_amount', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_max_amount_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('max_amount', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `max_amount` variable
	* @access public
	*/

	public function getMaxAmount() {
		return $this->max_amount;
	}

	public function get_max_amount_value() {
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

	public function set_start_date_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('start_date', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `start_date` variable
	* @access public
	*/

	public function getStartDate() {
		return $this->start_date;
	}

	public function get_start_date_value() {
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

	public function set_computed_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('computed', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `computed` variable
	* @access public
	*/

	public function getComputed() {
		return $this->computed;
	}

	public function get_computed_value() {
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

	public function set_active_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('active', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `active` variable
	* @access public
	*/

	public function getActive() {
		return $this->active;
	}

	public function get_active_value() {
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


// ---------------------------- Start Field: multiplier -------------------------------------- 

	/** 
	* Sets a value to `multiplier` variable
	* @access public
	*/

	public function setMultiplier($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('multiplier', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_multiplier_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('multiplier', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `multiplier` variable
	* @access public
	*/

	public function getMultiplier() {
		return $this->multiplier;
	}

	public function get_multiplier_value() {
		return $this->multiplier;
	}

	
// ------------------------------ End Field: multiplier --------------------------------------



	
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

			'earning_id' => (object) array(
										'Field'=>'earning_id',
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
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0.00000',
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
										'Default'=>'0',
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

			'multiplier' => (object) array(
										'Field'=>'multiplier',
										'Type'=>'varchar(50)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `employees_earnings` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `employees_earnings` ADD  `company_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `employees_earnings` ADD  `name_id` int(20) NOT NULL   ;",
			'earning_id' => "ALTER TABLE  `employees_earnings` ADD  `earning_id` int(20) NOT NULL   ;",
			'amount' => "ALTER TABLE  `employees_earnings` ADD  `amount` decimal(30,5) NOT NULL   ;",
			'max_amount' => "ALTER TABLE  `employees_earnings` ADD  `max_amount` decimal(30,5) NULL   DEFAULT '0.00000';",
			'start_date' => "ALTER TABLE  `employees_earnings` ADD  `start_date` date NULL   ;",
			'computed' => "ALTER TABLE  `employees_earnings` ADD  `computed` varchar(10) NULL   ;",
			'active' => "ALTER TABLE  `employees_earnings` ADD  `active` int(1) NULL   DEFAULT '0';",
			'trash' => "ALTER TABLE  `employees_earnings` ADD  `trash` int(1) NULL   DEFAULT '0';",
			'notes' => "ALTER TABLE  `employees_earnings` ADD  `notes` text NULL   ;",
			'multiplier' => "ALTER TABLE  `employees_earnings` ADD  `multiplier` varchar(50) NULL   ;",
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
//setEarningId() - earning_id
//setAmount() - amount
//setMaxAmount() - max_amount
//setStartDate() - start_date
//setComputed() - computed
//setActive() - active
//setTrash() - trash
//setNotes() - notes
//setMultiplier() - multiplier

--------------------------------------

//set_id() - id
//set_company_id() - company_id
//set_name_id() - name_id
//set_earning_id() - earning_id
//set_amount() - amount
//set_max_amount() - max_amount
//set_start_date() - start_date
//set_computed() - computed
//set_active() - active
//set_trash() - trash
//set_notes() - notes
//set_multiplier() - multiplier

*/
/* End of file Employees_earnings_model.php */
/* Location: ./application/models/Employees_earnings_model.php */
