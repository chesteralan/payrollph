<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_employees_model Class
 *
 * Manipulates `payroll_templates_employees` table on database

CREATE TABLE `payroll_templates_employees` (
  `template_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  `template` varchar(20) DEFAULT 'payslip',
  `print_group` int(20) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `status_id` int(20) DEFAULT NULL,
  `group_id` int(20) DEFAULT NULL,
  `position_id` int(20) DEFAULT NULL,
  `area_id` int(20) DEFAULT NULL,
  KEY `name_id` (`template_id`,`name_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_templates_employees` ADD  `template_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_templates_employees` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_templates_employees` ADD  `order` int(2) NOT NULL   DEFAULT '0';
ALTER TABLE  `payroll_templates_employees` ADD  `template` varchar(20) NULL   DEFAULT 'payslip';
ALTER TABLE  `payroll_templates_employees` ADD  `print_group` int(20) NULL   ;
ALTER TABLE  `payroll_templates_employees` ADD  `active` int(1) NULL   DEFAULT '1';
ALTER TABLE  `payroll_templates_employees` ADD  `status_id` int(20) NULL   ;
ALTER TABLE  `payroll_templates_employees` ADD  `group_id` int(20) NULL   ;
ALTER TABLE  `payroll_templates_employees` ADD  `position_id` int(20) NULL   ;
ALTER TABLE  `payroll_templates_employees` ADD  `area_id` int(20) NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_templates_employees_model extends MY_Model {

	protected $template_id;
	protected $name_id;
	protected $order;
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
		$this->_table_name = 'payroll_templates_employees';
		$this->_short_name = 'payroll_templates_employees';
		$this->_fields = array("template_id","name_id","order","template","print_group","active","status_id","group_id","position_id","area_id");
		$this->_required = array("template_id","name_id","order");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


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


// ---------------------------- Start Field: order -------------------------------------- 

	/** 
	* Sets a value to `order` variable
	* @access public
	*/

	public function setOrder($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('order', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_order_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('order', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `order` variable
	* @access public
	*/

	public function getOrder() {
		return $this->order;
	}

	public function get_order_value() {
		return $this->order;
	}

	
// ------------------------------ End Field: order --------------------------------------


// ---------------------------- Start Field: template -------------------------------------- 

	/** 
	* Sets a value to `template` variable
	* @access public
	*/

	public function setTemplate($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('template', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_template_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('template', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `template` variable
	* @access public
	*/

	public function getTemplate() {
		return $this->template;
	}

	public function get_template_value() {
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

	public function set_print_group_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('print_group', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `print_group` variable
	* @access public
	*/

	public function getPrintGroup() {
		return $this->print_group;
	}

	public function get_print_group_value() {
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


// ---------------------------- Start Field: status_id -------------------------------------- 

	/** 
	* Sets a value to `status_id` variable
	* @access public
	*/

	public function setStatusId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('status_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_status_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('status_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `status_id` variable
	* @access public
	*/

	public function getStatusId() {
		return $this->status_id;
	}

	public function get_status_id_value() {
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



	
	public function get_table_options() {
		return array(
			'template_id' => (object) array(
										'Field'=>'template_id',
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
			'template_id' => "ALTER TABLE  `payroll_templates_employees` ADD  `template_id` int(20) NOT NULL   ;",
			'name_id' => "ALTER TABLE  `payroll_templates_employees` ADD  `name_id` int(20) NOT NULL   ;",
			'order' => "ALTER TABLE  `payroll_templates_employees` ADD  `order` int(2) NOT NULL   DEFAULT '0';",
			'template' => "ALTER TABLE  `payroll_templates_employees` ADD  `template` varchar(20) NULL   DEFAULT 'payslip';",
			'print_group' => "ALTER TABLE  `payroll_templates_employees` ADD  `print_group` int(20) NULL   ;",
			'active' => "ALTER TABLE  `payroll_templates_employees` ADD  `active` int(1) NULL   DEFAULT '1';",
			'status_id' => "ALTER TABLE  `payroll_templates_employees` ADD  `status_id` int(20) NULL   ;",
			'group_id' => "ALTER TABLE  `payroll_templates_employees` ADD  `group_id` int(20) NULL   ;",
			'position_id' => "ALTER TABLE  `payroll_templates_employees` ADD  `position_id` int(20) NULL   ;",
			'area_id' => "ALTER TABLE  `payroll_templates_employees` ADD  `area_id` int(20) NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setTemplateId() - template_id
//setNameId() - name_id
//setOrder() - order
//setTemplate() - template
//setPrintGroup() - print_group
//setActive() - active
//setStatusId() - status_id
//setGroupId() - group_id
//setPositionId() - position_id
//setAreaId() - area_id

--------------------------------------

//set_template_id() - template_id
//set_name_id() - name_id
//set_order() - order
//set_template() - template
//set_print_group() - print_group
//set_active() - active
//set_status_id() - status_id
//set_group_id() - group_id
//set_position_id() - position_id
//set_area_id() - area_id

*/
/* End of file Payroll_templates_employees_model.php */
/* Location: ./application/models/Payroll_templates_employees_model.php */
