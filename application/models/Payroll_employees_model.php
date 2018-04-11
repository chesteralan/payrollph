<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_employees_model Class
 *
 * Manipulates `payroll_employees` table on database

CREATE TABLE `payroll_employees` (
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  `payslip` varchar(20) DEFAULT 'payslip',
  `template` varchar(20) DEFAULT 'payslip',
  `print_group` int(20) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `status_id` int(20) DEFAULT NULL,
  `group_id` int(20) DEFAULT NULL,
  `position_id` int(20) DEFAULT NULL,
  `area_id` int(20) DEFAULT NULL,
  KEY `name_id` (`payroll_id`,`name_id`)
);

ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `payroll_id` int(20) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `order` int(2) NOT NULL   DEFAULT '0';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `payslip` varchar(20) NULL   DEFAULT 'payslip';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `template` varchar(20) NULL   DEFAULT 'payslip';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `print_group` int(20) NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `active` int(1) NULL   DEFAULT '1';
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `status_id` int(20) NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `group_id` int(20) NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `position_id` int(20) NULL   ;
ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `area_id` int(20) NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_employees_model extends MY_Model {

	protected $payroll_id;
	protected $name_id;
	protected $order;
	protected $payslip;
	protected $template;
	protected $print_group;
	protected $active;
	protected $status_id;
	protected $group_id;
	protected $position_id;
	protected $area_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_employees';
		$this->_short_name = 'payroll_employees';
		$this->_fields = array("payroll_id","name_id","order","payslip","template","print_group","active","status_id","group_id","position_id","area_id");
		$this->_required = array("payroll_id","name_id","order");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: payroll_id -------------------------------------- 

	/** 
	* Sets a value to `payroll_id` variable
	* @access public
	*/

	public function setPayrollId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `payroll_id` variable
	* @access public
	*/

	public function getPayrollId() {
		return $this->payroll_id;
	}
	
// ------------------------------ End Field: payroll_id --------------------------------------


// ---------------------------- Start Field: name_id -------------------------------------- 

	/** 
	* Sets a value to `name_id` variable
	* @access public
	*/

	public function setNameId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `name_id` variable
	* @access public
	*/

	public function getNameId() {
		return $this->name_id;
	}
	
// ------------------------------ End Field: name_id --------------------------------------


// ---------------------------- Start Field: order -------------------------------------- 

	/** 
	* Sets a value to `order` variable
	* @access public
	*/

	public function setOrder($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('order', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `order` variable
	* @access public
	*/

	public function getOrder() {
		return $this->order;
	}
	
// ------------------------------ End Field: order --------------------------------------


// ---------------------------- Start Field: payslip -------------------------------------- 

	/** 
	* Sets a value to `payslip` variable
	* @access public
	*/

	public function setPayslip($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('payslip', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `payslip` variable
	* @access public
	*/

	public function getPayslip() {
		return $this->payslip;
	}
	
// ------------------------------ End Field: payslip --------------------------------------


// ---------------------------- Start Field: template -------------------------------------- 

	/** 
	* Sets a value to `template` variable
	* @access public
	*/

	public function setTemplate($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('template', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `template` variable
	* @access public
	*/

	public function getTemplate() {
		return $this->template;
	}
	
// ------------------------------ End Field: template --------------------------------------


// ---------------------------- Start Field: print_group -------------------------------------- 

	/** 
	* Sets a value to `print_group` variable
	* @access public
	*/

	public function setPrintGroup($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('print_group', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `print_group` variable
	* @access public
	*/

	public function getPrintGroup() {
		return $this->print_group;
	}
	
// ------------------------------ End Field: print_group --------------------------------------


// ---------------------------- Start Field: active -------------------------------------- 

	/** 
	* Sets a value to `active` variable
	* @access public
	*/

	public function setActive($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('active', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `active` variable
	* @access public
	*/

	public function getActive() {
		return $this->active;
	}
	
// ------------------------------ End Field: active --------------------------------------


// ---------------------------- Start Field: status_id -------------------------------------- 

	/** 
	* Sets a value to `status_id` variable
	* @access public
	*/

	public function setStatusId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('status_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `status_id` variable
	* @access public
	*/

	public function getStatusId() {
		return $this->status_id;
	}
	
// ------------------------------ End Field: status_id --------------------------------------


// ---------------------------- Start Field: group_id -------------------------------------- 

	/** 
	* Sets a value to `group_id` variable
	* @access public
	*/

	public function setGroupId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('group_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `group_id` variable
	* @access public
	*/

	public function getGroupId() {
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
	
	/** 
	* Get the value of `position_id` variable
	* @access public
	*/

	public function getPositionId() {
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
	
	/** 
	* Get the value of `area_id` variable
	* @access public
	*/

	public function getAreaId() {
		return $this->area_id;
	}
	
// ------------------------------ End Field: area_id --------------------------------------



	
	public function get_table_options() {
		return array(
			'payroll_id' => (object) array(
										'Field'=>'payroll_id',
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
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'order' => (object) array(
										'Field'=>'order',
										'Type'=>'int(2)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'payslip' => (object) array(
										'Field'=>'payslip',
										'Type'=>'varchar(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'payslip',
										'Extra'=>''
									),

			'template' => (object) array(
										'Field'=>'template',
										'Type'=>'varchar(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'payslip',
										'Extra'=>''
									),

			'print_group' => (object) array(
										'Field'=>'print_group',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'active' => (object) array(
										'Field'=>'active',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'1',
										'Extra'=>''
									),

			'status_id' => (object) array(
										'Field'=>'status_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'group_id' => (object) array(
										'Field'=>'group_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'position_id' => (object) array(
										'Field'=>'position_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'area_id' => (object) array(
										'Field'=>'area_id',
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
			'payroll_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `payroll_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `name_id` int(20) NOT NULL   ;",
			'order' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `order` int(2) NOT NULL   DEFAULT '0';",
			'payslip' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `payslip` varchar(20) NULL   DEFAULT 'payslip';",
			'template' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `template` varchar(20) NULL   DEFAULT 'payslip';",
			'print_group' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `print_group` int(20) NULL   ;",
			'active' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `active` int(1) NULL   DEFAULT '1';",
			'status_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `status_id` int(20) NULL   ;",
			'group_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `group_id` int(20) NULL   ;",
			'position_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `position_id` int(20) NULL   ;",
			'area_id' => "ALTER TABLE  `{$this->_db->database}`.`payroll_employees` ADD  `area_id` int(20) NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Payroll_employees_model.php */
/* Location: ./application/models/Payroll_employees_model.php */
