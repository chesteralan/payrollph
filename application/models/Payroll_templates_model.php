<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_templates_model Class
 *
 * Manipulates `payroll_templates` table on database

CREATE TABLE `payroll_templates` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `company_address` varchar(200) DEFAULT NULL,
  `company_contacts` varchar(200) DEFAULT NULL,
  `checked_by` int(20) DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `checked_by` (`checked_by`,`approved_by`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Payroll_templates_model extends MY_Model {

	protected $id;
	protected $name;
	protected $company_name;
	protected $company_address;
	protected $company_contacts;
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
		$this->_fields = array("id","name","company_name","company_address","company_contacts","checked_by","approved_by","active");
		$this->_required = array("name","active");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: id -------------------------------------- 

	/** 
	* Sets a value to `id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `id` variable
	* @access public
	* @return String;
	*/

		public function getId() {
			return $this->id;
		}
	
// ------------------------------ End Field: id --------------------------------------


// ---------------------------- Start Field: name -------------------------------------- 

	/** 
	* Sets a value to `name` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setName($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `name` variable
	* @access public
	* @return String;
	*/

		public function getName() {
			return $this->name;
		}
	
// ------------------------------ End Field: name --------------------------------------


// ---------------------------- Start Field: company_name -------------------------------------- 

	/** 
	* Sets a value to `company_name` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setCompanyName($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('company_name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `company_name` variable
	* @access public
	* @return String;
	*/

		public function getCompanyName() {
			return $this->company_name;
		}
	
// ------------------------------ End Field: company_name --------------------------------------


// ---------------------------- Start Field: company_address -------------------------------------- 

	/** 
	* Sets a value to `company_address` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setCompanyAddress($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('company_address', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `company_address` variable
	* @access public
	* @return String;
	*/

		public function getCompanyAddress() {
			return $this->company_address;
		}
	
// ------------------------------ End Field: company_address --------------------------------------


// ---------------------------- Start Field: company_contacts -------------------------------------- 

	/** 
	* Sets a value to `company_contacts` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setCompanyContacts($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('company_contacts', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `company_contacts` variable
	* @access public
	* @return String;
	*/

		public function getCompanyContacts() {
			return $this->company_contacts;
		}
	
// ------------------------------ End Field: company_contacts --------------------------------------


// ---------------------------- Start Field: checked_by -------------------------------------- 

	/** 
	* Sets a value to `checked_by` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setCheckedBy($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('checked_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `checked_by` variable
	* @access public
	* @return String;
	*/

		public function getCheckedBy() {
			return $this->checked_by;
		}
	
// ------------------------------ End Field: checked_by --------------------------------------


// ---------------------------- Start Field: approved_by -------------------------------------- 

	/** 
	* Sets a value to `approved_by` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setApprovedBy($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('approved_by', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `approved_by` variable
	* @access public
	* @return String;
	*/

		public function getApprovedBy() {
			return $this->approved_by;
		}
	
// ------------------------------ End Field: approved_by --------------------------------------


// ---------------------------- Start Field: active -------------------------------------- 

	/** 
	* Sets a value to `active` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setActive($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('active', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `active` variable
	* @access public
	* @return String;
	*/

		public function getActive() {
			return $this->active;
		}
	
// ------------------------------ End Field: active --------------------------------------




}

/* End of file Payroll_templates_model.php */
/* Location: ./application/models/Payroll_templates_model.php */
