<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_employees_benefits_model Class
 *
 * Manipulates `payroll_employees_benefits` table on database

CREATE TABLE `payroll_employees_benefits` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `entry_id` int(20) NOT NULL,
  `employee_share` decimal(30,5) DEFAULT '0.00000',
  `employer_share` decimal(30,5) DEFAULT '0.00000',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`),
  KEY `benefit_id` (`benefit_id`),
  KEY `entry_id` (`entry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_employees_benefits` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `payroll_employees_benefits` ADD  `payroll_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_benefits` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_benefits` ADD  `benefit_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_benefits` ADD  `entry_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_employees_benefits` ADD  `employee_share` decimal(30,5) NULL   DEFAULT '0.00000';
ALTER TABLE  `payroll_employees_benefits` ADD  `employer_share` decimal(30,5) NULL   DEFAULT '0.00000';
ALTER TABLE  `payroll_employees_benefits` ADD  `notes` text NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_employees_benefits_model extends MY_Model {

	protected $id;
	protected $payroll_id;
	protected $name_id;
	protected $benefit_id;
	protected $entry_id;
	protected $employee_share;
	protected $employer_share;
	protected $notes;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_employees_benefits';
		$this->_short_name = 'payroll_employees_benefits';
		$this->_fields = array("id","payroll_id","name_id","benefit_id","entry_id","employee_share","employer_share","notes");
		$this->_required = array("payroll_id","name_id","benefit_id","entry_id");
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

			'benefit_id' => (object) array(
										'Field'=>'benefit_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'entry_id' => (object) array(
										'Field'=>'entry_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'employee_share' => (object) array(
										'Field'=>'employee_share',
										'Type'=>'decimal(30,5)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0.00000',
										'Extra'=>''
									),

			'employer_share' => (object) array(
										'Field'=>'employer_share',
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
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `payroll_employees_benefits` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'payroll_id' => "ALTER TABLE  `payroll_employees_benefits` ADD  `payroll_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `payroll_employees_benefits` ADD  `name_id` int(20) NOT NULL   ;",
			'benefit_id' => "ALTER TABLE  `payroll_employees_benefits` ADD  `benefit_id` int(20) NOT NULL   ;",
			'entry_id' => "ALTER TABLE  `payroll_employees_benefits` ADD  `entry_id` int(20) NOT NULL   ;",
			'employee_share' => "ALTER TABLE  `payroll_employees_benefits` ADD  `employee_share` decimal(30,5) NULL   DEFAULT '0.00000';",
			'employer_share' => "ALTER TABLE  `payroll_employees_benefits` ADD  `employer_share` decimal(30,5) NULL   DEFAULT '0.00000';",
			'notes' => "ALTER TABLE  `payroll_employees_benefits` ADD  `notes` text NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Payroll_employees_benefits_model.php */
/* Location: ./application/models/Payroll_employees_benefits_model.php */
