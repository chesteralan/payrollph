<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employees_contacts_model Class
 *
 * Manipulates `employees_contacts` table on database

CREATE TABLE `employees_contacts` (
  `name_id` int(20) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `cell_number` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  UNIQUE KEY `name_id` (`name_id`)
);

ALTER TABLE  `{$this->_db->database}`.`employees_contacts` ADD  `name_id` int(20) NOT NULL   PRIMARY KEY;
ALTER TABLE  `{$this->_db->database}`.`employees_contacts` ADD  `phone_number` varchar(50) NULL   ;
ALTER TABLE  `{$this->_db->database}`.`employees_contacts` ADD  `cell_number` varchar(50) NULL   ;
ALTER TABLE  `{$this->_db->database}`.`employees_contacts` ADD  `address` varchar(200) NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Employees_contacts_model extends MY_Model {

	protected $name_id;
	protected $phone_number;
	protected $cell_number;
	protected $address;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'employees_contacts';
		$this->_short_name = 'employees_contacts';
		$this->_fields = array("name_id","phone_number","cell_number","address");
		$this->_required = array("");
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


// ---------------------------- Start Field: phone_number -------------------------------------- 

	/** 
	* Sets a value to `phone_number` variable
	* @access public
	*/

	public function setPhoneNumber($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('phone_number', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `phone_number` variable
	* @access public
	*/

	public function getPhoneNumber() {
		return $this->phone_number;
	}
	
// ------------------------------ End Field: phone_number --------------------------------------


// ---------------------------- Start Field: cell_number -------------------------------------- 

	/** 
	* Sets a value to `cell_number` variable
	* @access public
	*/

	public function setCellNumber($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('cell_number', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `cell_number` variable
	* @access public
	*/

	public function getCellNumber() {
		return $this->cell_number;
	}
	
// ------------------------------ End Field: cell_number --------------------------------------


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



	
	public function get_table_options() {
		return array(
			'name_id' => (object) array(
										'Field'=>'name_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'PRI',
										'Default'=>'',
										'Extra'=>''
									),

			'phone_number' => (object) array(
										'Field'=>'phone_number',
										'Type'=>'varchar(50)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'cell_number' => (object) array(
										'Field'=>'cell_number',
										'Type'=>'varchar(50)',
										'Null'=>'YES',
										'Key'=>'',
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
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'name_id' => "ALTER TABLE  `{$this->_db->database}`.`employees_contacts` ADD  `name_id` int(20) NOT NULL   PRIMARY KEY;",
			'phone_number' => "ALTER TABLE  `{$this->_db->database}`.`employees_contacts` ADD  `phone_number` varchar(50) NULL   ;",
			'cell_number' => "ALTER TABLE  `{$this->_db->database}`.`employees_contacts` ADD  `cell_number` varchar(50) NULL   ;",
			'address' => "ALTER TABLE  `{$this->_db->database}`.`employees_contacts` ADD  `address` varchar(200) NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Employees_contacts_model.php */
/* Location: ./application/models/Employees_contacts_model.php */
