<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_columns_model Class
 *
 * Manipulates `payroll_templates_columns` table on database

CREATE TABLE `payroll_templates_columns` (
  `template_id` int(20) NOT NULL,
  `term_id` int(20) NOT NULL,
  `column_id` varchar(200) NOT NULL,
  KEY `term_id` (`term_id`,`template_id`)
);

 ALTER TABLE  `payroll_templates_columns` ADD  `template_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_templates_columns` ADD  `term_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_templates_columns` ADD  `column_id` varchar(200) NOT NULL   ;


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_templates_columns_model extends MY_Model {

	protected $template_id;
	protected $term_id;
	protected $column_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_templates_columns';
		$this->_short_name = 'payroll_templates_columns';
		$this->_fields = array("template_id","term_id","column_id");
		$this->_required = array("template_id","term_id","column_id");
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


// ---------------------------- Start Field: term_id -------------------------------------- 

	/** 
	* Sets a value to `term_id` variable
	* @access public
	*/

		public function setTermId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('term_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `term_id` variable
	* @access public
	*/

		public function getTermId() {
			return $this->term_id;
		}
	
// ------------------------------ End Field: term_id --------------------------------------


// ---------------------------- Start Field: column_id -------------------------------------- 

	/** 
	* Sets a value to `column_id` variable
	* @access public
	*/

		public function setColumnId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('column_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `column_id` variable
	* @access public
	*/

		public function getColumnId() {
			return $this->column_id;
		}
	
// ------------------------------ End Field: column_id --------------------------------------




}

/* End of file Payroll_templates_columns_model.php */
/* Location: ./application/models/Payroll_templates_columns_model.php */
