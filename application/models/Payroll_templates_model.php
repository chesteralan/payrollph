<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_model Class
 *
 * Manipulates `payroll_templates` table on database

CREATE TABLE `payroll_templates` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pages` int(2) DEFAULT '1',
  `checked_by` int(20) DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL,
  `print_format` varchar(50) DEFAULT NULL,
  `group_by` varchar(50) NOT NULL DEFAULT 'group',
  `active` int(1) NOT NULL DEFAULT '1',
  `payroll_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checked_by` (`checked_by`,`approved_by`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_templates` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `payroll_templates` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_templates` ADD  `name` varchar(200) NOT NULL   ;
ALTER TABLE  `payroll_templates` ADD  `pages` int(2) NULL   DEFAULT '1';
ALTER TABLE  `payroll_templates` ADD  `checked_by` int(20) NULL   ;
ALTER TABLE  `payroll_templates` ADD  `approved_by` int(20) NULL   ;
ALTER TABLE  `payroll_templates` ADD  `print_format` varchar(50) NULL   ;
ALTER TABLE  `payroll_templates` ADD  `group_by` varchar(50) NOT NULL   DEFAULT 'group';
ALTER TABLE  `payroll_templates` ADD  `active` int(1) NOT NULL   DEFAULT '1';
ALTER TABLE  `payroll_templates` ADD  `payroll_id` int(20) NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_templates_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name;
	protected $pages;
	protected $checked_by;
	protected $approved_by;
	protected $print_format;
	protected $group_by;
	protected $active;
	protected $payroll_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_templates';
		$this->_short_name = 'payroll_templates';
		$this->_fields = array("id","company_id","name","pages","checked_by","approved_by","print_format","group_by","active","payroll_id");
		$this->_required = array("company_id","name","group_by","active");
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


// ---------------------------- Start Field: pages -------------------------------------- 

	/** 
	* Sets a value to `pages` variable
	* @access public
	*/

	public function setPages($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('pages', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_pages_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('pages', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `pages` variable
	* @access public
	*/

	public function getPages() {
		return $this->pages;
	}

	public function get_pages_value() {
		return $this->pages;
	}

	
// ------------------------------ End Field: pages --------------------------------------


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


// ---------------------------- Start Field: payroll_id -------------------------------------- 

	/** 
	* Sets a value to `payroll_id` variable
	* @access public
	*/

	public function setPayrollId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_payroll_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `payroll_id` variable
	* @access public
	*/

	public function getPayrollId() {
		return $this->payroll_id;
	}

	public function get_payroll_id_value() {
		return $this->payroll_id;
	}

	
// ------------------------------ End Field: payroll_id --------------------------------------



	
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

			'pages' => (object) array(
										'Field'=>'pages',
										'Type'=>'int(2)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'1',
										'Extra'=>''
									),

			'checked_by' => (object) array(
										'Field'=>'checked_by',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'MUL',
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

			'active' => (object) array(
										'Field'=>'active',
										'Type'=>'int(1)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'1',
										'Extra'=>''
									),

			'payroll_id' => (object) array(
										'Field'=>'payroll_id',
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
			'id' => "ALTER TABLE  `payroll_templates` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `payroll_templates` ADD  `company_id` int(20) NOT NULL   ;",
			'name' => "ALTER TABLE  `payroll_templates` ADD  `name` varchar(200) NOT NULL   ;",
			'pages' => "ALTER TABLE  `payroll_templates` ADD  `pages` int(2) NULL   DEFAULT '1';",
			'checked_by' => "ALTER TABLE  `payroll_templates` ADD  `checked_by` int(20) NULL   ;",
			'approved_by' => "ALTER TABLE  `payroll_templates` ADD  `approved_by` int(20) NULL   ;",
			'print_format' => "ALTER TABLE  `payroll_templates` ADD  `print_format` varchar(50) NULL   ;",
			'group_by' => "ALTER TABLE  `payroll_templates` ADD  `group_by` varchar(50) NOT NULL   DEFAULT 'group';",
			'active' => "ALTER TABLE  `payroll_templates` ADD  `active` int(1) NOT NULL   DEFAULT '1';",
			'payroll_id' => "ALTER TABLE  `payroll_templates` ADD  `payroll_id` int(20) NULL   ;",
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
//setPages() - pages
//setCheckedBy() - checked_by
//setApprovedBy() - approved_by
//setPrintFormat() - print_format
//setGroupBy() - group_by
//setActive() - active
//setPayrollId() - payroll_id

--------------------------------------

//set_id() - id
//set_company_id() - company_id
//set_name() - name
//set_pages() - pages
//set_checked_by() - checked_by
//set_approved_by() - approved_by
//set_print_format() - print_format
//set_group_by() - group_by
//set_active() - active
//set_payroll_id() - payroll_id

*/
/* End of file Payroll_templates_model.php */
/* Location: ./application/models/Payroll_templates_model.php */
