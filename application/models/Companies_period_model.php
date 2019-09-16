<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Companies_period_model Class
 *
 * Manipulates `companies_period` table on database

CREATE TABLE `companies_period` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `working_hours` int(2) NOT NULL DEFAULT '8',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin;

ALTER TABLE  `companies_period` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `companies_period` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `companies_period` ADD  `name` varchar(100) NULL   ;
ALTER TABLE  `companies_period` ADD  `year` int(4) NOT NULL   ;
ALTER TABLE  `companies_period` ADD  `start` date NOT NULL   ;
ALTER TABLE  `companies_period` ADD  `end` date NOT NULL   ;
ALTER TABLE  `companies_period` ADD  `working_hours` int(2) NOT NULL   DEFAULT '8';


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Companies_period_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name;
	protected $year;
	protected $start;
	protected $end;
	protected $working_hours;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'companies_period';
		$this->_short_name = 'companies_period';
		$this->_fields = array("id","company_id","name","year","start","end","working_hours");
		$this->_required = array("company_id","year","start","end","working_hours");
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


// ---------------------------- Start Field: name -------------------------------------- 

	/** 
	* Sets a value to `name` variable
	* @access public
	*/

	public function setName($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_name_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `name` variable
	* @access public
	*/

	public function getName() {
		return $this->name;
	}

	public function get_name_value() {
		return $this->name;
	}

	
// ------------------------------ End Field: name --------------------------------------


// ---------------------------- Start Field: year -------------------------------------- 

	/** 
	* Sets a value to `year` variable
	* @access public
	*/

	public function setYear($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('year', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_year_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('year', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `year` variable
	* @access public
	*/

	public function getYear() {
		return $this->year;
	}

	public function get_year_value() {
		return $this->year;
	}

	
// ------------------------------ End Field: year --------------------------------------


// ---------------------------- Start Field: start -------------------------------------- 

	/** 
	* Sets a value to `start` variable
	* @access public
	*/

	public function setStart($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('start', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_start_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('start', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `start` variable
	* @access public
	*/

	public function getStart() {
		return $this->start;
	}

	public function get_start_value() {
		return $this->start;
	}

	
// ------------------------------ End Field: start --------------------------------------


// ---------------------------- Start Field: end -------------------------------------- 

	/** 
	* Sets a value to `end` variable
	* @access public
	*/

	public function setEnd($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('end', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_end_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('end', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `end` variable
	* @access public
	*/

	public function getEnd() {
		return $this->end;
	}

	public function get_end_value() {
		return $this->end;
	}

	
// ------------------------------ End Field: end --------------------------------------


// ---------------------------- Start Field: working_hours -------------------------------------- 

	/** 
	* Sets a value to `working_hours` variable
	* @access public
	*/

	public function setWorkingHours($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('working_hours', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_working_hours_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('working_hours', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `working_hours` variable
	* @access public
	*/

	public function getWorkingHours() {
		return $this->working_hours;
	}

	public function get_working_hours_value() {
		return $this->working_hours;
	}

	
// ------------------------------ End Field: working_hours --------------------------------------



	
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
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'name' => (object) array(
										'Field'=>'name',
										'Type'=>'varchar(100)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'year' => (object) array(
										'Field'=>'year',
										'Type'=>'int(4)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'start' => (object) array(
										'Field'=>'start',
										'Type'=>'date',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'end' => (object) array(
										'Field'=>'end',
										'Type'=>'date',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'working_hours' => (object) array(
										'Field'=>'working_hours',
										'Type'=>'int(2)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'8',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `companies_period` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `companies_period` ADD  `company_id` int(20) NOT NULL   ;",
			'name' => "ALTER TABLE  `companies_period` ADD  `name` varchar(100) NULL   ;",
			'year' => "ALTER TABLE  `companies_period` ADD  `year` int(4) NOT NULL   ;",
			'start' => "ALTER TABLE  `companies_period` ADD  `start` date NOT NULL   ;",
			'end' => "ALTER TABLE  `companies_period` ADD  `end` date NOT NULL   ;",
			'working_hours' => "ALTER TABLE  `companies_period` ADD  `working_hours` int(2) NOT NULL   DEFAULT '8';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setId() - id
//setCompanyId() - company_id
//setName() - name
//setYear() - year
//setStart() - start
//setEnd() - end
//setWorkingHours() - working_hours

--------------------------------------

//set_id() - id
//set_company_id() - company_id
//set_name() - name
//set_year() - year
//set_start() - start
//set_end() - end
//set_working_hours() - working_hours

*/
/* End of file Companies_period_model.php */
/* Location: ./application/models/Companies_period_model.php */
