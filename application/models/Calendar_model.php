<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Calendar_model Class
 *
 * Manipulates `calendar` table on database

CREATE TABLE `calendar` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `calendar_date` date NOT NULL,
  `is_holiday` int(1) NOT NULL DEFAULT '0',
  `holiday_type` int(20) NOT NULL DEFAULT '0',
  `premium` int(2) DEFAULT '0',
  `notes` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `calendar` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `calendar` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `calendar` ADD  `calendar_date` date NOT NULL   ;
ALTER TABLE  `calendar` ADD  `is_holiday` int(1) NOT NULL   DEFAULT '0';
ALTER TABLE  `calendar` ADD  `holiday_type` int(20) NOT NULL   DEFAULT '0';
ALTER TABLE  `calendar` ADD  `premium` int(2) NULL   DEFAULT '0';
ALTER TABLE  `calendar` ADD  `notes` varchar(200) NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Calendar_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $calendar_date;
	protected $is_holiday;
	protected $holiday_type;
	protected $premium;
	protected $notes;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'calendar';
		$this->_short_name = 'calendar';
		$this->_fields = array("id","company_id","calendar_date","is_holiday","holiday_type","premium","notes");
		$this->_required = array("company_id","calendar_date","is_holiday","holiday_type");
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


// ---------------------------- Start Field: company_id -------------------------------------- 

	/** 
	* Sets a value to `company_id` variable
	* @access public
	*/

	public function setCompanyId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	*/

	public function getCompanyId() {
		return $this->company_id;
	}
	
// ------------------------------ End Field: company_id --------------------------------------


// ---------------------------- Start Field: calendar_date -------------------------------------- 

	/** 
	* Sets a value to `calendar_date` variable
	* @access public
	*/

	public function setCalendarDate($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('calendar_date', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `calendar_date` variable
	* @access public
	*/

	public function getCalendarDate() {
		return $this->calendar_date;
	}
	
// ------------------------------ End Field: calendar_date --------------------------------------


// ---------------------------- Start Field: is_holiday -------------------------------------- 

	/** 
	* Sets a value to `is_holiday` variable
	* @access public
	*/

	public function setIsHoliday($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('is_holiday', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `is_holiday` variable
	* @access public
	*/

	public function getIsHoliday() {
		return $this->is_holiday;
	}
	
// ------------------------------ End Field: is_holiday --------------------------------------


// ---------------------------- Start Field: holiday_type -------------------------------------- 

	/** 
	* Sets a value to `holiday_type` variable
	* @access public
	*/

	public function setHolidayType($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('holiday_type', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `holiday_type` variable
	* @access public
	*/

	public function getHolidayType() {
		return $this->holiday_type;
	}
	
// ------------------------------ End Field: holiday_type --------------------------------------


// ---------------------------- Start Field: premium -------------------------------------- 

	/** 
	* Sets a value to `premium` variable
	* @access public
	*/

	public function setPremium($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('premium', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `premium` variable
	* @access public
	*/

	public function getPremium() {
		return $this->premium;
	}
	
// ------------------------------ End Field: premium --------------------------------------


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

			'company_id' => (object) array(
										'Field'=>'company_id',
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

			'is_holiday' => (object) array(
										'Field'=>'is_holiday',
										'Type'=>'int(1)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'holiday_type' => (object) array(
										'Field'=>'holiday_type',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'premium' => (object) array(
										'Field'=>'premium',
										'Type'=>'int(2)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'notes' => (object) array(
										'Field'=>'notes',
										'Type'=>'varchar(200)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `calendar` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `calendar` ADD  `company_id` int(20) NOT NULL   ;",
			'calendar_date' => "ALTER TABLE  `calendar` ADD  `calendar_date` date NOT NULL   ;",
			'is_holiday' => "ALTER TABLE  `calendar` ADD  `is_holiday` int(1) NOT NULL   DEFAULT '0';",
			'holiday_type' => "ALTER TABLE  `calendar` ADD  `holiday_type` int(20) NOT NULL   DEFAULT '0';",
			'premium' => "ALTER TABLE  `calendar` ADD  `premium` int(2) NULL   DEFAULT '0';",
			'notes' => "ALTER TABLE  `calendar` ADD  `notes` varchar(200) NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Calendar_model.php */
/* Location: ./application/models/Calendar_model.php */
