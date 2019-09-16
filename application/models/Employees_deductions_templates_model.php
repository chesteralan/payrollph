<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_deductions_templates_model Class
 *
 * Manipulates `employees_deductions_templates` table on database

CREATE TABLE `employees_deductions_templates` (
  `ed_id` int(20) NOT NULL,
  `template_id` int(20) NOT NULL,
  KEY `ed_id` (`ed_id`,`template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `employees_deductions_templates` ADD  `ed_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_deductions_templates` ADD  `template_id` int(20) NOT NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Employees_deductions_templates_model extends MY_Model {

	protected $ed_id;
	protected $template_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_deductions_templates';
		$this->_short_name = 'employees_deductions_templates';
		$this->_fields = array("ed_id","template_id");
		$this->_required = array("ed_id","template_id");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: ed_id -------------------------------------- 

	/** 
	* Sets a value to `ed_id` variable
	* @access public
	*/

	public function setEdId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('ed_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_ed_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('ed_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `ed_id` variable
	* @access public
	*/

	public function getEdId() {
		return $this->ed_id;
	}

	public function get_ed_id_value() {
		return $this->ed_id;
	}

	
// ------------------------------ End Field: ed_id --------------------------------------


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



	
	public function get_table_options() {
		return array(
			'ed_id' => (object) array(
										'Field'=>'ed_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'template_id' => (object) array(
										'Field'=>'template_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'ed_id' => "ALTER TABLE  `employees_deductions_templates` ADD  `ed_id` int(20) NOT NULL   ;",
			'template_id' => "ALTER TABLE  `employees_deductions_templates` ADD  `template_id` int(20) NOT NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setEdId() - ed_id
//setTemplateId() - template_id

--------------------------------------

//set_ed_id() - ed_id
//set_template_id() - template_id

*/
/* End of file Employees_deductions_templates_model.php */
/* Location: ./application/models/Employees_deductions_templates_model.php */
