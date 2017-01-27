<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_groups_model Class
 *
 * Manipulates `payroll_templates_groups` table on database

CREATE TABLE `payroll_templates_groups` (
  `template_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `template_id` (`template_id`,`group_id`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Payroll_templates_groups_model extends MY_Model {

	protected $template_id;
	protected $group_id;
	protected $order;

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
		$this->_fields = array("template_id","group_id","order");
		$this->_required = array("template_id","group_id","order");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: template_id -------------------------------------- 

	/** 
	* Sets a value to `template_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setTemplateId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('template_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `template_id` variable
	* @access public
	* @return String;
	*/

		public function getTemplateId() {
			return $this->template_id;
		}
	
// ------------------------------ End Field: template_id --------------------------------------


// ---------------------------- Start Field: group_id -------------------------------------- 

	/** 
	* Sets a value to `group_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setGroupId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('group_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `group_id` variable
	* @access public
	* @return String;
	*/

		public function getGroupId() {
			return $this->group_id;
		}
	
// ------------------------------ End Field: group_id --------------------------------------


// ---------------------------- Start Field: order -------------------------------------- 

	/** 
	* Sets a value to `order` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setOrder($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('order', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `order` variable
	* @access public
	* @return String;
	*/

		public function getOrder() {
			return $this->order;
		}
	
// ------------------------------ End Field: order --------------------------------------




}

/* End of file Payroll_templates_groups_model.php */
/* Location: ./application/models/Payroll_templates_groups_model.php */
