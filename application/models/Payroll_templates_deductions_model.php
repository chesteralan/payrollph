<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_deductions_model Class
 *
 * Manipulates `payroll_templates_deductions` table on database

CREATE TABLE `payroll_templates_deductions` (
  `template_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `deduction_id` (`template_id`,`deduction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_templates_deductions` ADD  `template_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_templates_deductions` ADD  `deduction_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_templates_deductions` ADD  `order` int(2) NOT NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_templates_deductions_model extends MY_Model {

	protected $template_id;
	protected $deduction_id;
	protected $order;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_templates_deductions';
		$this->_short_name = 'payroll_templates_deductions';
		$this->_fields = array("template_id","deduction_id","order");
		$this->_required = array("template_id","deduction_id","order");
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


// ---------------------------- Start Field: deduction_id -------------------------------------- 

	/** 
	* Sets a value to `deduction_id` variable
	* @access public
	*/

	public function setDeductionId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('deduction_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `deduction_id` variable
	* @access public
	*/

	public function getDeductionId() {
		return $this->deduction_id;
	}
	
// ------------------------------ End Field: deduction_id --------------------------------------


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

			'deduction_id' => (object) array(
										'Field'=>'deduction_id',
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
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'template_id' => "ALTER TABLE  `payroll_templates_deductions` ADD  `template_id` int(20) NOT NULL   ;",
			'deduction_id' => "ALTER TABLE  `payroll_templates_deductions` ADD  `deduction_id` int(20) NOT NULL   ;",
			'order' => "ALTER TABLE  `payroll_templates_deductions` ADD  `order` int(2) NOT NULL   DEFAULT '0';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Payroll_templates_deductions_model.php */
/* Location: ./application/models/Payroll_templates_deductions_model.php */
