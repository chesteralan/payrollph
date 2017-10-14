<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_model Class
 *
 * Manipulates `payroll_templates` table on database

CREATE TABLE `payroll_templates` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pages` int(2) DEFAULT '1',
  `checked_by` int(20) DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `checked_by` (`checked_by`,`approved_by`),
  KEY `company_id` (`company_id`)
);

 ALTER TABLE  `payroll_templates` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
 ALTER TABLE  `payroll_templates` ADD  `company_id` int(20) NOT NULL   ;
 ALTER TABLE  `payroll_templates` ADD  `name` varchar(200) NOT NULL   ;
 ALTER TABLE  `payroll_templates` ADD  `pages` int(2) NULL   DEFAULT '1';
 ALTER TABLE  `payroll_templates` ADD  `checked_by` int(20) NULL   ;
 ALTER TABLE  `payroll_templates` ADD  `approved_by` int(20) NULL   ;
 ALTER TABLE  `payroll_templates` ADD  `active` int(1) NOT NULL   DEFAULT '1';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_templates_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name;
	protected $pages;
	protected $checked_by;
	protected $approved_by;
	protected $active;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_templates';
		$this->_short_name = 'payroll_templates';
		$this->_fields = array("id","company_id","name","pages","checked_by","approved_by","active");
		$this->_required = array("company_id","name","active");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: id -------------------------------------- 

	/** 
	* Sets a value to `id` variable
	* @access public
	*/

		public function setId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `id` variable
	* @access public
	*/

		public function getId() {
			return $this->id;
		}
	
// ------------------------------ End Field: id --------------------------------------


// ---------------------------- Start Field: company_id -------------------------------------- 

	/** 
	* Sets a value to `company_id` variable
	* @access public
	*/

		public function setCompanyId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	*/

		public function getCompanyId() {
			return $this->company_id;
		}
	
// ------------------------------ End Field: company_id --------------------------------------


// ---------------------------- Start Field: name -------------------------------------- 

	/** 
	* Sets a value to `name` variable
	* @access public
	*/

		public function setName($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `name` variable
	* @access public
	*/

		public function getName() {
			return $this->name;
		}
	
// ------------------------------ End Field: name --------------------------------------


// ---------------------------- Start Field: pages -------------------------------------- 

	/** 
	* Sets a value to `pages` variable
	* @access public
	*/

		public function setPages($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('pages', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `pages` variable
	* @access public
	*/

		public function getPages() {
			return $this->pages;
		}
	
// ------------------------------ End Field: pages --------------------------------------


// ---------------------------- Start Field: checked_by -------------------------------------- 

	/** 
	* Sets a value to `checked_by` variable
	* @access public
	*/

		public function setCheckedBy($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('checked_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `checked_by` variable
	* @access public
	*/

		public function getCheckedBy() {
			return $this->checked_by;
		}
	
// ------------------------------ End Field: checked_by --------------------------------------


// ---------------------------- Start Field: approved_by -------------------------------------- 

	/** 
	* Sets a value to `approved_by` variable
	* @access public
	*/

		public function setApprovedBy($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('approved_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `approved_by` variable
	* @access public
	*/

		public function getApprovedBy() {
			return $this->approved_by;
		}
	
// ------------------------------ End Field: approved_by --------------------------------------


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




}

/* End of file Payroll_templates_model.php */
/* Location: ./application/models/Payroll_templates_model.php */
