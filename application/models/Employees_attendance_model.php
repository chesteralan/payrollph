<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_attendance_model Class
 *
 * Manipulates `employees_attendance` table on database

CREATE TABLE `employees_attendance` (
  `name_id` int(20) NOT NULL,
  `date_present` date NOT NULL,
  `hours` int(2) DEFAULT '8',
  `notes` text,
  `pe_id` int(20) DEFAULT NULL,
  KEY `name_id` (`name_id`,`date_present`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `employees_attendance` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_attendance` ADD  `date_present` date NOT NULL   ;
ALTER TABLE  `employees_attendance` ADD  `hours` int(2) NULL   DEFAULT '8';
ALTER TABLE  `employees_attendance` ADD  `notes` text NULL   ;
ALTER TABLE  `employees_attendance` ADD  `pe_id` int(20) NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_attendance_model extends MY_Model {

	protected $name_id;
	protected $date_present;
	protected $hours;
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
		$this->_table_name = 'employees_attendance';
		$this->_short_name = 'employees_attendance';
		$this->_fields = array("name_id","date_present","hours","notes","pe_id");
		$this->_required = array("name_id","date_present");
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


// ---------------------------- Start Field: date_present -------------------------------------- 

	/** 
	* Sets a value to `date_present` variable
	* @access public
	*/

	public function setDatePresent($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_present', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_date_present_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_present', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `date_present` variable
	* @access public
	*/

	public function getDatePresent() {
		return $this->date_present;
	}

	public function get_date_present_value() {
		return $this->date_present;
	}

	
// ------------------------------ End Field: date_present --------------------------------------


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
			'name_id' => (object) array(
										'Field'=>'name_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'date_present' => (object) array(
										'Field'=>'date_present',
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
			'name_id' => "ALTER TABLE  `employees_attendance` ADD  `name_id` int(20) NOT NULL   ;",
			'date_present' => "ALTER TABLE  `employees_attendance` ADD  `date_present` date NOT NULL   ;",
			'hours' => "ALTER TABLE  `employees_attendance` ADD  `hours` int(2) NULL   DEFAULT '8';",
			'notes' => "ALTER TABLE  `employees_attendance` ADD  `notes` text NULL   ;",
			'pe_id' => "ALTER TABLE  `employees_attendance` ADD  `pe_id` int(20) NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setNameId() - name_id
//setDatePresent() - date_present
//setHours() - hours
//setNotes() - notes
//setPeId() - pe_id

--------------------------------------

//set_name_id() - name_id
//set_date_present() - date_present
//set_hours() - hours
//set_notes() - notes
//set_pe_id() - pe_id

*/
/* End of file Employees_attendance_model.php */
/* Location: ./application/models/Employees_attendance_model.php */
