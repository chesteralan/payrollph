<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Companies_options_model Class
 *
 * Manipulates `companies_options` table on database

CREATE TABLE `companies_options` (
  `company_id` int(20) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  KEY `company_id` (`company_id`)
);

 ALTER TABLE  `companies_options` ADD  `company_id` int(20) NOT NULL   ;
 ALTER TABLE  `companies_options` ADD  `key` varchar(50) NOT NULL   ;
 ALTER TABLE  `companies_options` ADD  `value` text NOT NULL   ;


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Companies_options_model extends MY_Model {

	protected $company_id;
	protected $key;
	protected $value;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'companies_options';
		$this->_short_name = 'companies_options';
		$this->_fields = array("company_id","key","value");
		$this->_required = array("company_id","key","value");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


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


// ---------------------------- Start Field: key -------------------------------------- 

	/** 
	* Sets a value to `key` variable
	* @access public
	*/

		public function setKey($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('key', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `key` variable
	* @access public
	*/

		public function getKey() {
			return $this->key;
		}
	
// ------------------------------ End Field: key --------------------------------------


// ---------------------------- Start Field: value -------------------------------------- 

	/** 
	* Sets a value to `value` variable
	* @access public
	*/

		public function setValue($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('value', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `value` variable
	* @access public
	*/

		public function getValue() {
			return $this->value;
		}
	
// ------------------------------ End Field: value --------------------------------------




}

/* End of file Companies_options_model.php */
/* Location: ./application/models/Companies_options_model.php */
