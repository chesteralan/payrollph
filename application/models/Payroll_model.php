<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_model Class
 *
 * Manipulates `payroll` table on database

CREATE TABLE `payroll` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `template_id` int(20) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `lock` int(1) DEFAULT '0',
  `print_format` varchar(50) DEFAULT NULL,
  `group_by` varchar(50) NOT NULL DEFAULT 'group',
  `checked_by` int(20) DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin;

ALTER TABLE  `payroll` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `payroll` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `name` varchar(200) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `template_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `month` int(2) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `year` int(4) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `active` int(1) NOT NULL   DEFAULT '1';
ALTER TABLE  `payroll` ADD  `lock` int(1) NULL   DEFAULT '0';
ALTER TABLE  `payroll` ADD  `print_format` varchar(50) NULL   ;
ALTER TABLE  `payroll` ADD  `group_by` varchar(50) NOT NULL   DEFAULT 'group';
ALTER TABLE  `payroll` ADD  `checked_by` int(20) NULL   ;
ALTER TABLE  `payroll` ADD  `approved_by` int(20) NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name;
	protected $template_id;
	protected $month;
	protected $year;
	protected $active;
	protected $lock;
	protected $print_format;
	protected $group_by;
	protected $checked_by;
	protected $approved_by;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll';
		$this->_short_name = 'payroll';
		$this->_fields = array("id","company_id","name","template_id","month","year","active","lock","print_format","group_by","checked_by","approved_by");
		$this->_required = array("company_id","name","template_id","month","year","active","group_by");
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


// ---------------------------- Start Field: template_id -------------------------------------- 

	/** 
	* Sets a value to `template_id` variable
	* @access public
	*/

	public function setTemplateId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('template_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_template_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('template_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `template_id` variable
	* @access public
	*/

	public function getTemplateId() {
		return $this->template_id;
	}

	public function get_template_id_value() {
		return $this->template_id;
	}

	
// ------------------------------ End Field: template_id --------------------------------------


// ---------------------------- Start Field: month -------------------------------------- 

	/** 
	* Sets a value to `month` variable
	* @access public
	*/

	public function setMonth($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('month', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_month_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('month', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `month` variable
	* @access public
	*/

	public function getMonth() {
		return $this->month;
	}

	public function get_month_value() {
		return $this->month;
	}

	
// ------------------------------ End Field: month --------------------------------------


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


// ---------------------------- Start Field: active -------------------------------------- 

	/** 
	* Sets a value to `active` variable
	* @access public
	*/

	public function setActive($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('active', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_active_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('active', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `active` variable
	* @access public
	*/

	public function getActive() {
		return $this->active;
	}

	public function get_active_value() {
		return $this->active;
	}

	
// ------------------------------ End Field: active --------------------------------------


// ---------------------------- Start Field: lock -------------------------------------- 

	/** 
	* Sets a value to `lock` variable
	* @access public
	*/

	public function setLock($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('lock', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_lock_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('lock', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `lock` variable
	* @access public
	*/

	public function getLock() {
		return $this->lock;
	}

	public function get_lock_value() {
		return $this->lock;
	}

	
// ------------------------------ End Field: lock --------------------------------------


// ---------------------------- Start Field: print_format -------------------------------------- 

	/** 
	* Sets a value to `print_format` variable
	* @access public
	*/

	public function setPrintFormat($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('print_format', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_print_format_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('print_format', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `print_format` variable
	* @access public
	*/

	public function getPrintFormat() {
		return $this->print_format;
	}

	public function get_print_format_value() {
		return $this->print_format;
	}

	
// ------------------------------ End Field: print_format --------------------------------------


// ---------------------------- Start Field: group_by -------------------------------------- 

	/** 
	* Sets a value to `group_by` variable
	* @access public
	*/

	public function setGroupBy($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('group_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_group_by_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('group_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `group_by` variable
	* @access public
	*/

	public function getGroupBy() {
		return $this->group_by;
	}

	public function get_group_by_value() {
		return $this->group_by;
	}

	
// ------------------------------ End Field: group_by --------------------------------------


// ---------------------------- Start Field: checked_by -------------------------------------- 

	/** 
	* Sets a value to `checked_by` variable
	* @access public
	*/

	public function setCheckedBy($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('checked_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_checked_by_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('checked_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `checked_by` variable
	* @access public
	*/

	public function getCheckedBy() {
		return $this->checked_by;
	}

	public function get_checked_by_value() {
		return $this->checked_by;
	}

	
// ------------------------------ End Field: checked_by --------------------------------------


// ---------------------------- Start Field: approved_by -------------------------------------- 

	/** 
	* Sets a value to `approved_by` variable
	* @access public
	*/

	public function setApprovedBy($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('approved_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_approved_by_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('approved_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `approved_by` variable
	* @access public
	*/

	public function getApprovedBy() {
		return $this->approved_by;
	}

	public function get_approved_by_value() {
		return $this->approved_by;
	}

	
// ------------------------------ End Field: approved_by --------------------------------------



	
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

			'name' => (object) array(
										'Field'=>'name',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'template_id' => (object) array(
										'Field'=>'template_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'month' => (object) array(
										'Field'=>'month',
										'Type'=>'int(2)',
										'Null'=>'NO',
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

			'active' => (object) array(
										'Field'=>'active',
										'Type'=>'int(1)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'1',
										'Extra'=>''
									),

			'lock' => (object) array(
										'Field'=>'lock',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'print_format' => (object) array(
										'Field'=>'print_format',
										'Type'=>'varchar(50)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'group_by' => (object) array(
										'Field'=>'group_by',
										'Type'=>'varchar(50)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'group',
										'Extra'=>''
									),

			'checked_by' => (object) array(
										'Field'=>'checked_by',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'approved_by' => (object) array(
										'Field'=>'approved_by',
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
			'id' => "ALTER TABLE  `payroll` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `payroll` ADD  `company_id` int(20) NOT NULL   ;",
			'name' => "ALTER TABLE  `payroll` ADD  `name` varchar(200) NOT NULL   ;",
			'template_id' => "ALTER TABLE  `payroll` ADD  `template_id` int(20) NOT NULL   ;",
			'month' => "ALTER TABLE  `payroll` ADD  `month` int(2) NOT NULL   ;",
			'year' => "ALTER TABLE  `payroll` ADD  `year` int(4) NOT NULL   ;",
			'active' => "ALTER TABLE  `payroll` ADD  `active` int(1) NOT NULL   DEFAULT '1';",
			'lock' => "ALTER TABLE  `payroll` ADD  `lock` int(1) NULL   DEFAULT '0';",
			'print_format' => "ALTER TABLE  `payroll` ADD  `print_format` varchar(50) NULL   ;",
			'group_by' => "ALTER TABLE  `payroll` ADD  `group_by` varchar(50) NOT NULL   DEFAULT 'group';",
			'checked_by' => "ALTER TABLE  `payroll` ADD  `checked_by` int(20) NULL   ;",
			'approved_by' => "ALTER TABLE  `payroll` ADD  `approved_by` int(20) NULL   ;",
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
//setTemplateId() - template_id
//setMonth() - month
//setYear() - year
//setActive() - active
//setLock() - lock
//setPrintFormat() - print_format
//setGroupBy() - group_by
//setCheckedBy() - checked_by
//setApprovedBy() - approved_by

--------------------------------------

//set_id() - id
//set_company_id() - company_id
//set_name() - name
//set_template_id() - template_id
//set_month() - month
//set_year() - year
//set_active() - active
//set_lock() - lock
//set_print_format() - print_format
//set_group_by() - group_by
//set_checked_by() - checked_by
//set_approved_by() - approved_by

*/
/* End of file Payroll_model.php */
/* Location: ./application/models/Payroll_model.php */
