<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_groups_model Class
 *
 * Manipulates `payroll_templates_groups` table on database

CREATE TABLE `payroll_templates_groups` (
  `template_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL DEFAULT '0',
  `area_id` int(20) NOT NULL DEFAULT '0',
  `position_id` int(20) NOT NULL DEFAULT '0',
  `status_id` int(20) NOT NULL DEFAULT '0',
  `order` int(2) NOT NULL DEFAULT '0',
  `page` int(2) DEFAULT '1',
  KEY `template_id` (`template_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_templates_groups` ADD  `template_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_templates_groups` ADD  `group_id` int(20) NOT NULL   DEFAULT '0';
ALTER TABLE  `payroll_templates_groups` ADD  `area_id` int(20) NOT NULL   DEFAULT '0';
ALTER TABLE  `payroll_templates_groups` ADD  `position_id` int(20) NOT NULL   DEFAULT '0';
ALTER TABLE  `payroll_templates_groups` ADD  `status_id` int(20) NOT NULL   DEFAULT '0';
ALTER TABLE  `payroll_templates_groups` ADD  `order` int(2) NOT NULL   DEFAULT '0';
ALTER TABLE  `payroll_templates_groups` ADD  `page` int(2) NULL   DEFAULT '1';


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_templates_groups_model extends MY_Model {

	protected $template_id;
	protected $group_id;
	protected $area_id;
	protected $position_id;
	protected $status_id;
	protected $order;
	protected $page;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_templates_groups';
		$this->_short_name = 'payroll_templates_groups';
		$this->_fields = array("template_id","group_id","area_id","position_id","status_id","order","page");
		$this->_required = array("template_id","group_id","area_id","position_id","status_id","order");
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


// ---------------------------- Start Field: page -------------------------------------- 

	/** 
	* Sets a value to `page` variable
	* @access public
	*/

	public function setPage($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('page', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_page_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('page', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `page` variable
	* @access public
	*/

	public function getPage() {
		return $this->page;
	}

	public function get_page_value() {
		return $this->page;
	}

	
// ------------------------------ End Field: page --------------------------------------



	
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

			'group_id' => (object) array(
										'Field'=>'group_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'area_id' => (object) array(
										'Field'=>'area_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'position_id' => (object) array(
										'Field'=>'position_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'status_id' => (object) array(
										'Field'=>'status_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
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

			'page' => (object) array(
										'Field'=>'page',
										'Type'=>'int(2)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'1',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'template_id' => "ALTER TABLE  `payroll_templates_groups` ADD  `template_id` int(20) NOT NULL   ;",
			'group_id' => "ALTER TABLE  `payroll_templates_groups` ADD  `group_id` int(20) NOT NULL   DEFAULT '0';",
			'area_id' => "ALTER TABLE  `payroll_templates_groups` ADD  `area_id` int(20) NOT NULL   DEFAULT '0';",
			'position_id' => "ALTER TABLE  `payroll_templates_groups` ADD  `position_id` int(20) NOT NULL   DEFAULT '0';",
			'status_id' => "ALTER TABLE  `payroll_templates_groups` ADD  `status_id` int(20) NOT NULL   DEFAULT '0';",
			'order' => "ALTER TABLE  `payroll_templates_groups` ADD  `order` int(2) NOT NULL   DEFAULT '0';",
			'page' => "ALTER TABLE  `payroll_templates_groups` ADD  `page` int(2) NULL   DEFAULT '1';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setTemplateId() - template_id
//setGroupId() - group_id
//setAreaId() - area_id
//setPositionId() - position_id
//setStatusId() - status_id
//setOrder() - order
//setPage() - page

--------------------------------------

//set_template_id() - template_id
//set_group_id() - group_id
//set_area_id() - area_id
//set_position_id() - position_id
//set_status_id() - status_id
//set_order() - order
//set_page() - page

*/
/* End of file Payroll_templates_groups_model.php */
/* Location: ./application/models/Payroll_templates_groups_model.php */
