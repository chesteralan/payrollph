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
  `trash` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `full_name` (`full_name`)
);

 ALTER TABLE  `names_list` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
 ALTER TABLE  `names_list` ADD  `full_name` varchar(200) NOT NULL   UNIQUE KEY;
 ALTER TABLE  `names_list` ADD  `address` varchar(200) NULL   ;
 ALTER TABLE  `names_list` ADD  `contact_number` varchar(200) NULL   ;
 ALTER TABLE  `names_list` ADD  `trash` int(1) NOT NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Names_list_model extends MY_Model {

	protected $id;
	protected $full_name;
	protected $address;
	protected $contact_number;
	protected $trash;

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
		$this->_fields = array("id","full_name","address","contact_number","trash");
		$this->_required = array("full_name","trash");
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


// ---------------------------- Start Field: full_name -------------------------------------- 

	/** 
	* Sets a value to `full_name` variable
	* @access public
	*/

		public function setFullName($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('full_name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `full_name` variable
	* @access public
	*/

		public function getFullName() {
			return $this->full_name;
		}
	
// ------------------------------ End Field: full_name --------------------------------------


// ---------------------------- Start Field: address -------------------------------------- 

	/** 
	* Sets a value to `address` variable
	* @access public
	*/

		public function setAddress($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('address', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `address` variable
	* @access public
	*/

		public function getAddress() {
			return $this->address;
		}
	
// ------------------------------ End Field: address --------------------------------------


// ---------------------------- Start Field: contact_number -------------------------------------- 

	/** 
	* Sets a value to `contact_number` variable
	* @access public
	*/

		public function setContactNumber($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('contact_number', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `contact_number` variable
	* @access public
	*/

		public function getContactNumber() {
			return $this->contact_number;
		}
	
// ------------------------------ End Field: contact_number --------------------------------------


// ---------------------------- Start Field: trash -------------------------------------- 

	/** 
	* Sets a value to `trash` variable
	* @access public
	*/

		public function setTrash($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('trash', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `trash` variable
	* @access public
	*/

		public function getTrash() {
			return $this->trash;
		}
	
// ------------------------------ End Field: trash --------------------------------------



	
	public function get_table_options() {
		return array(
			'id' => (object) array(
										'Field'=>'id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'PRI',
										'Default'=>'',
										'Extra'=>'auto_increment'
									),

			'full_name' => (object) array(
										'Field'=>'full_name',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'UNI',
										'Default'=>'',
										'Extra'=>''
									),

			'address' => (object) array(
										'Field'=>'address',
										'Type'=>'varchar(200)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'contact_number' => (object) array(
										'Field'=>'contact_number',
										'Type'=>'varchar(200)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'trash' => (object) array(
										'Field'=>'trash',
										'Type'=>'int(1)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									)
		);
	}

}

/* End of file Names_list_model.php */
/* Location: ./application/models/Names_list_model.php */
