<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Names_contacts_model Class
 *
 * Manipulates `names_contacts` table on database

CREATE TABLE `names_contacts` (
  `name_id` int(20) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`name_id`),
  KEY `name_id` (`name_id`)
);

 ALTER TABLE  `names_contacts` ADD  `name_id` int(20) NOT NULL   PRIMARY KEY;
 ALTER TABLE  `names_contacts` ADD  `key` varchar(100) NOT NULL   ;
 ALTER TABLE  `names_contacts` ADD  `value` text NULL   ;


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Names_contacts_model extends MY_Model {

	protected $name_id;
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
		$this->_table_name = 'names_contacts';
		$this->_short_name = 'names_contacts';
		$this->_fields = array("name_id","key","value");
		$this->_required = array("key");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: name_id -------------------------------------- 

	/** 
	* Sets a value to `name_id` variable
	* @access public
	*/

		public function setNameId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('name_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `name_id` variable
	* @access public
	*/

		public function getNameId() {
			return $this->name_id;
		}
	
// ------------------------------ End Field: name_id --------------------------------------


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

/* End of file Names_contacts_model.php */
/* Location: ./application/models/Names_contacts_model.php */
