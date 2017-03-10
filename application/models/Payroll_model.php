<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_model Class
 *
 * Manipulates `payroll` table on database

CREATE TABLE `payroll` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `template_id` int(20) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Payroll_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name;
	protected $template_id;
	protected $month;
	protected $year;
	protected $active;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll';
		$this->_short_name = 'payroll';
		$this->_fields = array("id","company_id","name","template_id","month","year","active");
		$this->_required = array("company_id","name","template_id","month","year","active");
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


// ---------------------------- Start Field: company_id -------------------------------------- 

	/** 
	* Sets a value to `company_id` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setCompanyId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	* @return String;
	*/

		public function getCompanyId() {
			return $this->company_id;
		}
	
// ------------------------------ End Field: company_id --------------------------------------


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


// ---------------------------- Start Field: month -------------------------------------- 

	/** 
	* Sets a value to `month` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setMonth($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('month', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `month` variable
	* @access public
	* @return String;
	*/

		public function getMonth() {
			return $this->month;
		}
	
// ------------------------------ End Field: month --------------------------------------


// ---------------------------- Start Field: year -------------------------------------- 

	/** 
	* Sets a value to `year` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setYear($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('year', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `year` variable
	* @access public
	* @return String;
	*/

		public function getYear() {
			return $this->year;
		}
	
// ------------------------------ End Field: year --------------------------------------


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

/* End of file Payroll_model.php */
/* Location: ./application/models/Payroll_model.php */
