<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_timesheets_model Class
 *
 * Manipulates `employees_timesheets` table on database

CREATE TABLE `employees_timesheets` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `calendar_date` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `employees_timesheets` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `employees_timesheets` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_timesheets` ADD  `calendar_date` date NOT NULL   ;
ALTER TABLE  `employees_timesheets` ADD  `time_in` time NULL   ;
ALTER TABLE  `employees_timesheets` ADD  `time_out` time NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_timesheets_model extends MY_Model {

	protected $id;
	protected $name_id;
	protected $calendar_date;
	protected $time_in;
	protected $time_out;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_timesheets';
		$this->_short_name = 'employees_timesheets';
		$this->_fields = array("id","name_id","calendar_date","time_in","time_out");
		$this->_required = array("name_id","calendar_date");
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


// ---------------------------- Start Field: calendar_date -------------------------------------- 

	/** 
	* Sets a value to `calendar_date` variable
	* @access public
	*/

	public function setCalendarDate($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('calendar_date', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_calendar_date_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('calendar_date', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `calendar_date` variable
	* @access public
	*/

	public function getCalendarDate() {
		return $this->calendar_date;
	}

	public function get_calendar_date_value() {
		return $this->calendar_date;
	}

	
// ------------------------------ End Field: calendar_date --------------------------------------


// ---------------------------- Start Field: time_in -------------------------------------- 

	/** 
	* Sets a value to `time_in` variable
	* @access public
	*/

	public function setTimeIn($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('time_in', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_time_in_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('time_in', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `time_in` variable
	* @access public
	*/

	public function getTimeIn() {
		return $this->time_in;
	}

	public function get_time_in_value() {
		return $this->time_in;
	}

	
// ------------------------------ End Field: time_in --------------------------------------


// ---------------------------- Start Field: time_out -------------------------------------- 

	/** 
	* Sets a value to `time_out` variable
	* @access public
	*/

	public function setTimeOut($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('time_out', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_time_out_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('time_out', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `time_out` variable
	* @access public
	*/

	public function getTimeOut() {
		return $this->time_out;
	}

	public function get_time_out_value() {
		return $this->time_out;
	}

	
// ------------------------------ End Field: time_out --------------------------------------



	
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
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'calendar_date' => (object) array(
										'Field'=>'calendar_date',
										'Type'=>'date',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'time_in' => (object) array(
										'Field'=>'time_in',
										'Type'=>'time',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'time_out' => (object) array(
										'Field'=>'time_out',
										'Type'=>'time',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `employees_timesheets` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'name_id' => "ALTER TABLE  `employees_timesheets` ADD  `name_id` int(20) NOT NULL   ;",
			'calendar_date' => "ALTER TABLE  `employees_timesheets` ADD  `calendar_date` date NOT NULL   ;",
			'time_in' => "ALTER TABLE  `employees_timesheets` ADD  `time_in` time NULL   ;",
			'time_out' => "ALTER TABLE  `employees_timesheets` ADD  `time_out` time NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setId() - id
//setNameId() - name_id
//setCalendarDate() - calendar_date
//setTimeIn() - time_in
//setTimeOut() - time_out

--------------------------------------

//set_id() - id
//set_name_id() - name_id
//set_calendar_date() - calendar_date
//set_time_in() - time_in
//set_time_out() - time_out

*/
/* End of file Employees_timesheets_model.php */
/* Location: ./application/models/Employees_timesheets_model.php */
