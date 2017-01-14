<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Names_list_model Class
 *
 * Manipulates `names_list` table on database

CREATE TABLE `names_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_number` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `full_name` (`full_name`)
);

 * @package			        Model
 * @version_number	        3.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Names_list_model extends MY_Model {

	protected $id;
	protected $full_name;
	protected $address;
	protected $contact_number;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'names_list';
		$this->_short_name = 'names_list';
		$this->_fields = array("id","full_name","address","contact_number");
		$this->_required = array("full_name");
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


// ---------------------------- Start Field: full_name -------------------------------------- 

	/** 
	* Sets a value to `full_name` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setFullName($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('full_name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `full_name` variable
	* @access public
	* @return String;
	*/

		public function getFullName() {
			return $this->full_name;
		}
	
// ------------------------------ End Field: full_name --------------------------------------


// ---------------------------- Start Field: address -------------------------------------- 

	/** 
	* Sets a value to `address` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setAddress($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('address', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `address` variable
	* @access public
	* @return String;
	*/

		public function getAddress() {
			return $this->address;
		}
	
// ------------------------------ End Field: address --------------------------------------


// ---------------------------- Start Field: contact_number -------------------------------------- 

	/** 
	* Sets a value to `contact_number` variable
	* @access public
	* @param  String
	* @return $this;
	*/

		public function setContactNumber($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('contact_number', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `contact_number` variable
	* @access public
	* @return String;
	*/

		public function getContactNumber() {
			return $this->contact_number;
		}
	
// ------------------------------ End Field: contact_number --------------------------------------




}

/* End of file Names_list_model.php */
/* Location: ./application/models/Names_list_model.php */
