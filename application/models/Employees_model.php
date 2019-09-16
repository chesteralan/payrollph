<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_model Class
 *
 * Manipulates `employees` table on database

CREATE TABLE `employees` (
  `name_id` int(20) NOT NULL,
  `company_id` int(20) NOT NULL,
  `group_id` int(20) DEFAULT NULL,
  `position_id` int(20) DEFAULT NULL,
  `area_id` int(20) DEFAULT NULL,
  `hired` date DEFAULT NULL,
  `regularized` date DEFAULT NULL,
  `status` int(20) DEFAULT NULL,
  `notes` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  `employee_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`name_id`),
  KEY `name_id` (`name_id`),
  KEY `group_id` (`group_id`),
  KEY `position_id` (`position_id`),
  KEY `area_id` (`area_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `employees` ADD  `name_id` int(20) NOT NULL   PRIMARY KEY;
ALTER TABLE  `employees` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `employees` ADD  `group_id` int(20) NULL   ;
ALTER TABLE  `employees` ADD  `position_id` int(20) NULL   ;
ALTER TABLE  `employees` ADD  `area_id` int(20) NULL   ;
ALTER TABLE  `employees` ADD  `hired` date NULL   ;
ALTER TABLE  `employees` ADD  `regularized` date NULL   ;
ALTER TABLE  `employees` ADD  `status` int(20) NULL   ;
ALTER TABLE  `employees` ADD  `notes` text NULL   ;
ALTER TABLE  `employees` ADD  `trash` int(1) NOT NULL   DEFAULT '0';
ALTER TABLE  `employees` ADD  `employee_id` varchar(20) NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_model extends MY_Model {

	protected $name_id;
	protected $company_id;
	protected $group_id;
	protected $position_id;
	protected $area_id;
	protected $hired;
	protected $regularized;
	protected $status;
	protected $notes;
	protected $trash;
	protected $employee_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees';
		$this->_short_name = 'employees';
		$this->_fields = array("name_id","company_id","group_id","position_id","area_id","hired","regularized","status","notes","trash","employee_id");
		$this->_required = array("company_id","trash");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


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


// ---------------------------- Start Field: group_id -------------------------------------- 

	/** 
	* Sets a value to `group_id` variable
	* @access public
	*/

	public function setGroupId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('group_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_group_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('group_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `group_id` variable
	* @access public
	*/

	public function getGroupId() {
		return $this->group_id;
	}

	public function get_group_id_value() {
		return $this->group_id;
	}

	
// ------------------------------ End Field: group_id --------------------------------------


// ---------------------------- Start Field: position_id -------------------------------------- 

	/** 
	* Sets a value to `position_id` variable
	* @access public
	*/

	public function setPositionId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('position_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_position_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('position_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `position_id` variable
	* @access public
	*/

	public function getPositionId() {
		return $this->position_id;
	}

	public function get_position_id_value() {
		return $this->position_id;
	}

	
// ------------------------------ End Field: position_id --------------------------------------


// ---------------------------- Start Field: area_id -------------------------------------- 

	/** 
	* Sets a value to `area_id` variable
	* @access public
	*/

	public function setAreaId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('area_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_area_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('area_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `area_id` variable
	* @access public
	*/

	public function getAreaId() {
		return $this->area_id;
	}

	public function get_area_id_value() {
		return $this->area_id;
	}

	
// ------------------------------ End Field: area_id --------------------------------------


// ---------------------------- Start Field: hired -------------------------------------- 

	/** 
	* Sets a value to `hired` variable
	* @access public
	*/

	public function setHired($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('hired', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_hired_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('hired', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `hired` variable
	* @access public
	*/

	public function getHired() {
		return $this->hired;
	}

	public function get_hired_value() {
		return $this->hired;
	}

	
// ------------------------------ End Field: hired --------------------------------------


// ---------------------------- Start Field: regularized -------------------------------------- 

	/** 
	* Sets a value to `regularized` variable
	* @access public
	*/

	public function setRegularized($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('regularized', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_regularized_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('regularized', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `regularized` variable
	* @access public
	*/

	public function getRegularized() {
		return $this->regularized;
	}

	public function get_regularized_value() {
		return $this->regularized;
	}

	
// ------------------------------ End Field: regularized --------------------------------------


// ---------------------------- Start Field: status -------------------------------------- 

	/** 
	* Sets a value to `status` variable
	* @access public
	*/

	public function setStatus($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('status', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_status_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('status', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `status` variable
	* @access public
	*/

	public function getStatus() {
		return $this->status;
	}

	public function get_status_value() {
		return $this->status;
	}

	
// ------------------------------ End Field: status --------------------------------------


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


// ---------------------------- Start Field: employee_id -------------------------------------- 

	/** 
	* Sets a value to `employee_id` variable
	* @access public
	*/

	public function setEmployeeId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('employee_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_employee_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('employee_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `employee_id` variable
	* @access public
	*/

	public function getEmployeeId() {
		return $this->employee_id;
	}

	public function get_employee_id_value() {
		return $this->employee_id;
	}

	
// ------------------------------ End Field: employee_id --------------------------------------



	
	public function get_table_options() {
		return array(
			'name_id' => (object) array(
										'Field'=>'name_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'PRI',
										'Default'=>'',
										'Extra'=>''
									),

			'company_id' => (object) array(
										'Field'=>'company_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'group_id' => (object) array(
										'Field'=>'group_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'position_id' => (object) array(
										'Field'=>'position_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'area_id' => (object) array(
										'Field'=>'area_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'hired' => (object) array(
										'Field'=>'hired',
										'Type'=>'date',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'regularized' => (object) array(
										'Field'=>'regularized',
										'Type'=>'date',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'status' => (object) array(
										'Field'=>'status',
										'Type'=>'int(20)',
										'Null'=>'YES',
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

			'trash' => (object) array(
										'Field'=>'trash',
										'Type'=>'int(1)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'employee_id' => (object) array(
										'Field'=>'employee_id',
										'Type'=>'varchar(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'name_id' => "ALTER TABLE  `employees` ADD  `name_id` int(20) NOT NULL   PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `employees` ADD  `company_id` int(20) NOT NULL   ;",
			'group_id' => "ALTER TABLE  `employees` ADD  `group_id` int(20) NULL   ;",
			'position_id' => "ALTER TABLE  `employees` ADD  `position_id` int(20) NULL   ;",
			'area_id' => "ALTER TABLE  `employees` ADD  `area_id` int(20) NULL   ;",
			'hired' => "ALTER TABLE  `employees` ADD  `hired` date NULL   ;",
			'regularized' => "ALTER TABLE  `employees` ADD  `regularized` date NULL   ;",
			'status' => "ALTER TABLE  `employees` ADD  `status` int(20) NULL   ;",
			'notes' => "ALTER TABLE  `employees` ADD  `notes` text NULL   ;",
			'trash' => "ALTER TABLE  `employees` ADD  `trash` int(1) NOT NULL   DEFAULT '0';",
			'employee_id' => "ALTER TABLE  `employees` ADD  `employee_id` varchar(20) NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setNameId() - name_id
//setCompanyId() - company_id
//setGroupId() - group_id
//setPositionId() - position_id
//setAreaId() - area_id
//setHired() - hired
//setRegularized() - regularized
//setStatus() - status
//setNotes() - notes
//setTrash() - trash
//setEmployeeId() - employee_id

--------------------------------------

//set_name_id() - name_id
//set_company_id() - company_id
//set_group_id() - group_id
//set_position_id() - position_id
//set_area_id() - area_id
//set_hired() - hired
//set_regularized() - regularized
//set_status() - status
//set_notes() - notes
//set_trash() - trash
//set_employee_id() - employee_id

*/
/* End of file Employees_model.php */
/* Location: ./application/models/Employees_model.php */
