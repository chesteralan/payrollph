<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_overtime_model Class
 *
 * Manipulates `employees_overtime` table on database

CREATE TABLE `employees_overtime` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `date_overtime` date NOT NULL,
  `minutes` int(4) DEFAULT '0',
  `notes` text,
  `pe_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin;

ALTER TABLE  `employees_overtime` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `employees_overtime` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_overtime` ADD  `date_overtime` date NOT NULL   ;
ALTER TABLE  `employees_overtime` ADD  `minutes` int(4) NULL   DEFAULT '0';
ALTER TABLE  `employees_overtime` ADD  `notes` text NULL   ;
ALTER TABLE  `employees_overtime` ADD  `pe_id` int(20) NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_overtime_model extends MY_Model {

	protected $id;
	protected $name_id;
	protected $date_overtime;
	protected $minutes;
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
		$this->_table_name = 'employees_overtime';
		$this->_short_name = 'employees_overtime';
		$this->_fields = array("id","name_id","date_overtime","minutes","notes","pe_id");
		$this->_required = array("name_id","date_overtime");
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


// ---------------------------- Start Field: date_overtime -------------------------------------- 

	/** 
	* Sets a value to `date_overtime` variable
	* @access public
	*/

	public function setDateOvertime($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_overtime', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_date_overtime_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_overtime', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `date_overtime` variable
	* @access public
	*/

	public function getDateOvertime() {
		return $this->date_overtime;
	}

	public function get_date_overtime_value() {
		return $this->date_overtime;
	}

	
// ------------------------------ End Field: date_overtime --------------------------------------


// ---------------------------- Start Field: minutes -------------------------------------- 

	/** 
	* Sets a value to `minutes` variable
	* @access public
	*/

	public function setMinutes($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('minutes', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_minutes_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('minutes', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `minutes` variable
	* @access public
	*/

	public function getMinutes() {
		return $this->minutes;
	}

	public function get_minutes_value() {
		return $this->minutes;
	}

	
// ------------------------------ End Field: minutes --------------------------------------


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
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'date_overtime' => (object) array(
										'Field'=>'date_overtime',
										'Type'=>'date',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'minutes' => (object) array(
										'Field'=>'minutes',
										'Type'=>'int(4)',
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
			'id' => "ALTER TABLE  `employees_overtime` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'name_id' => "ALTER TABLE  `employees_overtime` ADD  `name_id` int(20) NOT NULL   ;",
			'date_overtime' => "ALTER TABLE  `employees_overtime` ADD  `date_overtime` date NOT NULL   ;",
			'minutes' => "ALTER TABLE  `employees_overtime` ADD  `minutes` int(4) NULL   DEFAULT '0';",
			'notes' => "ALTER TABLE  `employees_overtime` ADD  `notes` text NULL   ;",
			'pe_id' => "ALTER TABLE  `employees_overtime` ADD  `pe_id` int(20) NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setId() - id
//setNameId() - name_id
//setDateOvertime() - date_overtime
//setMinutes() - minutes
//setNotes() - notes
//setPeId() - pe_id

--------------------------------------

//set_id() - id
//set_name_id() - name_id
//set_date_overtime() - date_overtime
//set_minutes() - minutes
//set_notes() - notes
//set_pe_id() - pe_id

*/
/* End of file Employees_overtime_model.php */
/* Location: ./application/models/Employees_overtime_model.php */
