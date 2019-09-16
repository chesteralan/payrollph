<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_absences_model Class
 *
 * Manipulates `employees_absences` table on database

CREATE TABLE `employees_absences` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `date_absent` date NOT NULL,
  `hours` int(2) DEFAULT '8',
  `leave_type` int(20) DEFAULT NULL,
  `notes` text,
  `pe_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`date_absent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `employees_absences` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `employees_absences` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_absences` ADD  `date_absent` date NOT NULL   ;
ALTER TABLE  `employees_absences` ADD  `hours` int(2) NULL   DEFAULT '8';
ALTER TABLE  `employees_absences` ADD  `leave_type` int(20) NULL   ;
ALTER TABLE  `employees_absences` ADD  `notes` text NULL   ;
ALTER TABLE  `employees_absences` ADD  `pe_id` int(20) NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_absences_model extends MY_Model {

	protected $id;
	protected $name_id;
	protected $date_absent;
	protected $hours;
	protected $leave_type;
	protected $notes;
	protected $pe_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_absences';
		$this->_short_name = 'employees_absences';
		$this->_fields = array("id","name_id","date_absent","hours","leave_type","notes","pe_id");
		$this->_required = array("name_id","date_absent");
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


// ---------------------------- Start Field: date_absent -------------------------------------- 

	/** 
	* Sets a value to `date_absent` variable
	* @access public
	*/

	public function setDateAbsent($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_absent', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_date_absent_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_absent', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `date_absent` variable
	* @access public
	*/

	public function getDateAbsent() {
		return $this->date_absent;
	}

	public function get_date_absent_value() {
		return $this->date_absent;
	}

	
// ------------------------------ End Field: date_absent --------------------------------------


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


// ---------------------------- Start Field: leave_type -------------------------------------- 

	/** 
	* Sets a value to `leave_type` variable
	* @access public
	*/

	public function setLeaveType($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('leave_type', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_leave_type_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('leave_type', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `leave_type` variable
	* @access public
	*/

	public function getLeaveType() {
		return $this->leave_type;
	}

	public function get_leave_type_value() {
		return $this->leave_type;
	}

	
// ------------------------------ End Field: leave_type --------------------------------------


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


// ---------------------------- Start Field: pe_id -------------------------------------- 

	/** 
	* Sets a value to `pe_id` variable
	* @access public
	*/

	public function setPeId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('pe_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_pe_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('pe_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `pe_id` variable
	* @access public
	*/

	public function getPeId() {
		return $this->pe_id;
	}

	public function get_pe_id_value() {
		return $this->pe_id;
	}

	
// ------------------------------ End Field: pe_id --------------------------------------



	
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

			'name_id' => (object) array(
										'Field'=>'name_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'date_absent' => (object) array(
										'Field'=>'date_absent',
										'Type'=>'date',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'hours' => (object) array(
										'Field'=>'hours',
										'Type'=>'int(2)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'8',
										'Extra'=>''
									),

			'leave_type' => (object) array(
										'Field'=>'leave_type',
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

			'pe_id' => (object) array(
										'Field'=>'pe_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `employees_absences` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'name_id' => "ALTER TABLE  `employees_absences` ADD  `name_id` int(20) NOT NULL   ;",
			'date_absent' => "ALTER TABLE  `employees_absences` ADD  `date_absent` date NOT NULL   ;",
			'hours' => "ALTER TABLE  `employees_absences` ADD  `hours` int(2) NULL   DEFAULT '8';",
			'leave_type' => "ALTER TABLE  `employees_absences` ADD  `leave_type` int(20) NULL   ;",
			'notes' => "ALTER TABLE  `employees_absences` ADD  `notes` text NULL   ;",
			'pe_id' => "ALTER TABLE  `employees_absences` ADD  `pe_id` int(20) NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setId() - id
//setNameId() - name_id
//setDateAbsent() - date_absent
//setHours() - hours
//setLeaveType() - leave_type
//setNotes() - notes
//setPeId() - pe_id

--------------------------------------

//set_id() - id
//set_name_id() - name_id
//set_date_absent() - date_absent
//set_hours() - hours
//set_leave_type() - leave_type
//set_notes() - notes
//set_pe_id() - pe_id

*/
/* End of file Employees_absences_model.php */
/* Location: ./application/models/Employees_absences_model.php */
