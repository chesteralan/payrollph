<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_earnings_model Class
 *
 * Manipulates `payroll_templates_earnings` table on database

CREATE TABLE `payroll_templates_earnings` (
  `template_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `earning_id` (`template_id`,`earning_id`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Payroll_templates_earnings_model extends MY_Model {

	protected $template_id;
	protected $earning_id;
	protected $order;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_templates_earnings';
		$this->_short_name = 'payroll_templates_earnings';
		$this->_fields = array("template_id","earning_id","order");
		$this->_required = array("template_id","earning_id","order");
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


// ---------------------------- Start Field: earning_id -------------------------------------- 

	/** 
	* Sets a value to `earning_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setEarningId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('earning_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `earning_id` variable
	* @access public
	* @return String;
	*/

		public function getEarningId() {
			return $this->earning_id;
		}
	
// ------------------------------ End Field: earning_id --------------------------------------


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

/* End of file Payroll_templates_earnings_model.php */
/* Location: ./application/models/Payroll_templates_earnings_model.php */
