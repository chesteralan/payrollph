<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_employees_earnings_model Class
 *
 * Manipulates `payroll_employees_earnings` table on database

CREATE TABLE `payroll_employees_earnings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `pe_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `entry_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL,
  `notes` text,
  `manual` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`payroll_id`,`earning_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_employees_earnings` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `payroll_employees_earnings` ADD  `payroll_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_earnings` ADD  `pe_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_earnings` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_earnings` ADD  `earning_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_earnings` ADD  `entry_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_earnings` ADD  `amount` decimal(30,5) NOT NULL   ;
ALTER TABLE  `payroll_employees_earnings` ADD  `notes` text NULL   ;
ALTER TABLE  `payroll_employees_earnings` ADD  `manual` int(1) NOT NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_employees_earnings_model extends MY_Model {

	protected $id;
	protected $payroll_id;
	protected $pe_id;
	protected $name_id;
	protected $earning_id;
	protected $entry_id;
	protected $amount;
	protected $notes;
	protected $manual;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_employees_earnings';
		$this->_short_name = 'payroll_employees_earnings';
		$this->_fields = array("id","payroll_id","pe_id","name_id","earning_id","entry_id","amount","notes","manual");
		$this->_required = array("payroll_id","pe_id","name_id","earning_id","entry_id","amount","manual");
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


// ---------------------------- Start Field: pe_id -------------------------------------- 

	/** 
	* Sets a value to `pe_id` variable
	* @access public
	*/

	public function setPeId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('pe_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `pe_id` variable
	* @access public
	*/

	public function getPeId() {
		return $this->pe_id;
	}
	
// ------------------------------ End Field: pe_id --------------------------------------


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


// ---------------------------- Start Field: earning_id -------------------------------------- 

	/** 
	* Sets a value to `earning_id` variable
	* @access public
	*/

	public function setEarningId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('earning_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `earning_id` variable
	* @access public
	*/

	public function getEarningId() {
		return $this->earning_id;
	}
	
// ------------------------------ End Field: earning_id --------------------------------------


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


// ---------------------------- Start Field: manual -------------------------------------- 

	/** 
	* Sets a value to `manual` variable
	* @access public
	*/

	public function setManual($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('manual', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `manual` variable
	* @access public
	*/

	public function getManual() {
		return $this->manual;
	}
	
// ------------------------------ End Field: manual --------------------------------------



	
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

			'pe_id' => (object) array(
										'Field'=>'pe_id',
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

			'earning_id' => (object) array(
										'Field'=>'earning_id',
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
									),

			'manual' => (object) array(
										'Field'=>'manual',
										'Type'=>'int(1)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `payroll_employees_earnings` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'payroll_id' => "ALTER TABLE  `payroll_employees_earnings` ADD  `payroll_id` int(20) NOT NULL   ;",
			'pe_id' => "ALTER TABLE  `payroll_employees_earnings` ADD  `pe_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `payroll_employees_earnings` ADD  `name_id` int(20) NOT NULL   ;",
			'earning_id' => "ALTER TABLE  `payroll_employees_earnings` ADD  `earning_id` int(20) NOT NULL   ;",
			'entry_id' => "ALTER TABLE  `payroll_employees_earnings` ADD  `entry_id` int(20) NOT NULL   ;",
			'amount' => "ALTER TABLE  `payroll_employees_earnings` ADD  `amount` decimal(30,5) NOT NULL   ;",
			'notes' => "ALTER TABLE  `payroll_employees_earnings` ADD  `notes` text NULL   ;",
			'manual' => "ALTER TABLE  `payroll_employees_earnings` ADD  `manual` int(1) NOT NULL   DEFAULT '0';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Payroll_employees_earnings_model.php */
/* Location: ./application/models/Payroll_employees_earnings_model.php */
