<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_benefits_model Class
 *
 * Manipulates `employees_benefits` table on database

CREATE TABLE `employees_benefits` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `employee_share` decimal(30,5) NOT NULL,
  `employer_share` decimal(30,5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `primary` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`benefit_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `employees_benefits` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `employees_benefits` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_benefits` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_benefits` ADD  `benefit_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_benefits` ADD  `employee_share` decimal(30,5) NOT NULL   ;
ALTER TABLE  `employees_benefits` ADD  `employer_share` decimal(30,5) NOT NULL   ;
ALTER TABLE  `employees_benefits` ADD  `start_date` date NULL   ;
ALTER TABLE  `employees_benefits` ADD  `primary` int(1) NULL   DEFAULT '0';
ALTER TABLE  `employees_benefits` ADD  `trash` int(1) NULL   DEFAULT '1';
ALTER TABLE  `employees_benefits` ADD  `notes` text NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_benefits_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name_id;
	protected $benefit_id;
	protected $employee_share;
	protected $employer_share;
	protected $start_date;
	protected $primary;
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
		$this->_table_name = 'employees_benefits';
		$this->_short_name = 'employees_benefits';
		$this->_fields = array("id","company_id","name_id","benefit_id","employee_share","employer_share","start_date","primary","trash","notes");
		$this->_required = array("company_id","name_id","benefit_id","employee_share","employer_share");
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


// ---------------------------- Start Field: benefit_id -------------------------------------- 

	/** 
	* Sets a value to `benefit_id` variable
	* @access public
	*/

	public function setBenefitId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('benefit_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_benefit_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('benefit_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `benefit_id` variable
	* @access public
	*/

	public function getBenefitId() {
		return $this->benefit_id;
	}

	public function get_benefit_id_value() {
		return $this->benefit_id;
	}

	
// ------------------------------ End Field: benefit_id --------------------------------------


// ---------------------------- Start Field: employee_share -------------------------------------- 

	/** 
	* Sets a value to `employee_share` variable
	* @access public
	*/

	public function setEmployeeShare($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('employee_share', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_employee_share_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('employee_share', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `employee_share` variable
	* @access public
	*/

	public function getEmployeeShare() {
		return $this->employee_share;
	}

	public function get_employee_share_value() {
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

	public function set_employer_share_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('employer_share', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `employer_share` variable
	* @access public
	*/

	public function getEmployerShare() {
		return $this->employer_share;
	}

	public function get_employer_share_value() {
		return $this->employer_share;
	}

	
// ------------------------------ End Field: employer_share --------------------------------------


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

			'benefit_id' => (object) array(
										'Field'=>'benefit_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'employee_share' => (object) array(
										'Field'=>'employee_share',
										'Type'=>'decimal(30,5)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'employer_share' => (object) array(
										'Field'=>'employer_share',
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

			'primary' => (object) array(
										'Field'=>'primary',
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
			'id' => "ALTER TABLE  `employees_benefits` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `employees_benefits` ADD  `company_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `employees_benefits` ADD  `name_id` int(20) NOT NULL   ;",
			'benefit_id' => "ALTER TABLE  `employees_benefits` ADD  `benefit_id` int(20) NOT NULL   ;",
			'employee_share' => "ALTER TABLE  `employees_benefits` ADD  `employee_share` decimal(30,5) NOT NULL   ;",
			'employer_share' => "ALTER TABLE  `employees_benefits` ADD  `employer_share` decimal(30,5) NOT NULL   ;",
			'start_date' => "ALTER TABLE  `employees_benefits` ADD  `start_date` date NULL   ;",
			'primary' => "ALTER TABLE  `employees_benefits` ADD  `primary` int(1) NULL   DEFAULT '0';",
			'trash' => "ALTER TABLE  `employees_benefits` ADD  `trash` int(1) NULL   DEFAULT '1';",
			'notes' => "ALTER TABLE  `employees_benefits` ADD  `notes` text NULL   ;",
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
//setBenefitId() - benefit_id
//setEmployeeShare() - employee_share
//setEmployerShare() - employer_share
//setStartDate() - start_date
//setPrimary() - primary
//setTrash() - trash
//setNotes() - notes

--------------------------------------

//set_id() - id
//set_company_id() - company_id
//set_name_id() - name_id
//set_benefit_id() - benefit_id
//set_employee_share() - employee_share
//set_employer_share() - employer_share
//set_start_date() - start_date
//set_primary() - primary
//set_trash() - trash
//set_notes() - notes

*/
/* End of file Employees_benefits_model.php */
/* Location: ./application/models/Employees_benefits_model.php */
