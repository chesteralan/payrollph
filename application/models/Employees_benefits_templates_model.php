<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_benefits_templates_model Class
 *
 * Manipulates `employees_benefits_templates` table on database

CREATE TABLE `employees_benefits_templates` (
  `eb_id` int(20) NOT NULL,
  `template_id` int(20) NOT NULL,
  KEY `eb_id` (`eb_id`,`template_id`)
);

ALTER TABLE  `employees_benefits_templates` ADD  `eb_id` int(20) NOT NULL   ;
ALTER TABLE  `employees_benefits_templates` ADD  `template_id` int(20) NOT NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Employees_benefits_templates_model extends MY_Model {

	protected $eb_id;
	protected $template_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_benefits_templates';
		$this->_short_name = 'employees_benefits_templates';
		$this->_fields = array("eb_id","template_id");
		$this->_required = array("eb_id","template_id");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: eb_id -------------------------------------- 

	/** 
	* Sets a value to `eb_id` variable
	* @access public
	*/

	public function setEbId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('eb_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `eb_id` variable
	* @access public
	*/

	public function getEbId() {
		return $this->eb_id;
	}
	
// ------------------------------ End Field: eb_id --------------------------------------


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



	
	public function get_table_options() {
		return array(
			'eb_id' => (object) array(
										'Field'=>'eb_id',
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
			'eb_id' => "ALTER TABLE  `employees_benefits_templates` ADD  `eb_id` int(20) NOT NULL   ;",
			'template_id' => "ALTER TABLE  `employees_benefits_templates` ADD  `template_id` int(20) NOT NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Employees_benefits_templates_model.php */
/* Location: ./application/models/Employees_benefits_templates_model.php */
