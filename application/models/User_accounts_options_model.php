<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_accounts_options_model Class
 *
 * Manipulates `user_accounts_options` table on database

CREATE TABLE `user_accounts_options` (
  `uid` int(20) NOT NULL,
  `department` varchar(200) NOT NULL,
  `section` varchar(200) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  KEY `uid` (`uid`)
);

ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `uid` int(20) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `department` varchar(200) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `section` varchar(200) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `key` varchar(200) NOT NULL   ;
ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `value` text NOT NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class User_accounts_options_model extends MY_Model {

	protected $uid;
	protected $department;
	protected $section;
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
		$this->_table_name = 'user_accounts_options';
		$this->_short_name = 'user_accounts_options';
		$this->_fields = array("uid","department","section","key","value");
		$this->_required = array("uid","department","section","key","value");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: uid -------------------------------------- 

	/** 
	* Sets a value to `uid` variable
	* @access public
	*/

	public function setUid($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('uid', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `uid` variable
	* @access public
	*/

	public function getUid() {
		return $this->uid;
	}
	
// ------------------------------ End Field: uid --------------------------------------


// ---------------------------- Start Field: department -------------------------------------- 

	/** 
	* Sets a value to `department` variable
	* @access public
	*/

	public function setDepartment($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('department', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `department` variable
	* @access public
	*/

	public function getDepartment() {
		return $this->department;
	}
	
// ------------------------------ End Field: department --------------------------------------


// ---------------------------- Start Field: section -------------------------------------- 

	/** 
	* Sets a value to `section` variable
	* @access public
	*/

	public function setSection($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('section', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `section` variable
	* @access public
	*/

	public function getSection() {
		return $this->section;
	}
	
// ------------------------------ End Field: section --------------------------------------


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



	
	public function get_table_options() {
		return array(
			'uid' => (object) array(
										'Field'=>'uid',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'department' => (object) array(
										'Field'=>'department',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'section' => (object) array(
										'Field'=>'section',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'key' => (object) array(
										'Field'=>'key',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'value' => (object) array(
										'Field'=>'value',
										'Type'=>'text',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'uid' => "ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `uid` int(20) NOT NULL   ;",
			'department' => "ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `department` varchar(200) NOT NULL   ;",
			'section' => "ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `section` varchar(200) NOT NULL   ;",
			'key' => "ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `key` varchar(200) NOT NULL   ;",
			'value' => "ALTER TABLE  `{$this->_db->database}`.`user_accounts_options` ADD  `value` text NOT NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file User_accounts_options_model.php */
/* Location: ./application/models/User_accounts_options_model.php */
