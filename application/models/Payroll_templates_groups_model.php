<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_groups_model Class
 *
 * Manipulates `payroll_templates_groups` table on database

CREATE TABLE `payroll_templates_groups` (
  `template_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  `page` int(2) DEFAULT '1',
  KEY `template_id` (`template_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_templates_groups` ADD  `template_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_templates_groups` ADD  `group_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_templates_groups` ADD  `order` int(2) NOT NULL   DEFAULT '0';
ALTER TABLE  `payroll_templates_groups` ADD  `page` int(2) NULL   DEFAULT '1';


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_templates_groups_model extends MY_Model {

	protected $template_id;
	protected $group_id;
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
		$this->_fields = array("template_id","group_id","order","page");
		$this->_required = array("template_id","group_id","order");
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
	
	/** 
	* Get the value of `template_id` variable
	* @access public
	*/

	public function getTemplateId() {
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
	
	/** 
	* Get the value of `group_id` variable
	* @access public
	*/

	public function getGroupId() {
		return $this->group_id;
	}
	
// ------------------------------ End Field: group_id --------------------------------------


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


// ---------------------------- Start Field: page -------------------------------------- 

	/** 
	* Sets a value to `page` variable
	* @access public
	*/

	public function setPage($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('page', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `page` variable
	* @access public
	*/

	public function getPage() {
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
			'group_id' => "ALTER TABLE  `payroll_templates_groups` ADD  `group_id` int(20) NOT NULL   ;",
			'order' => "ALTER TABLE  `payroll_templates_groups` ADD  `order` int(2) NOT NULL   DEFAULT '0';",
			'page' => "ALTER TABLE  `payroll_templates_groups` ADD  `page` int(2) NULL   DEFAULT '1';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Payroll_templates_groups_model.php */
/* Location: ./application/models/Payroll_templates_groups_model.php */
