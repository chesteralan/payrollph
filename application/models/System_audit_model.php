<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * System_audit_model Class
 *
 * Manipulates `system_audit` table on database

CREATE TABLE `system_audit` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `dept` varchar(200) NOT NULL,
  `sect` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `company_id` int(20) DEFAULT NULL,
  `notes` text,
  `date_accessed` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name_id` int(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin;

ALTER TABLE  `system_audit` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `system_audit` ADD  `user_id` int(20) NOT NULL   ;
ALTER TABLE  `system_audit` ADD  `dept` varchar(200) NOT NULL   ;
ALTER TABLE  `system_audit` ADD  `sect` varchar(200) NOT NULL   ;
ALTER TABLE  `system_audit` ADD  `action` varchar(200) NOT NULL   ;
ALTER TABLE  `system_audit` ADD  `company_id` int(20) NULL   ;
ALTER TABLE  `system_audit` ADD  `notes` text NULL   ;
ALTER TABLE  `system_audit` ADD  `date_accessed` timestamp NULL   DEFAULT 'CURRENT_TIMESTAMP';
ALTER TABLE  `system_audit` ADD  `name_id` int(20) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class System_audit_model extends MY_Model {

	protected $id;
	protected $user_id;
	protected $dept;
	protected $sect;
	protected $action;
	protected $company_id;
	protected $notes;
	protected $date_accessed;
	protected $name_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'system_audit';
		$this->_short_name = 'system_audit';
		$this->_fields = array("id","user_id","dept","sect","action","company_id","notes","date_accessed","name_id");
		$this->_required = array("user_id","dept","sect","action");
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

	public function set_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `id` variable
	* @access public
	*/

	public function getId() {
		return $this->id;
	}

	public function get_id_value() {
		return $this->id;
	}

	
// ------------------------------ End Field: id --------------------------------------


// ---------------------------- Start Field: user_id -------------------------------------- 

	/** 
	* Sets a value to `user_id` variable
	* @access public
	*/

	public function setUserId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('user_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_user_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('user_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `user_id` variable
	* @access public
	*/

	public function getUserId() {
		return $this->user_id;
	}

	public function get_user_id_value() {
		return $this->user_id;
	}

	
// ------------------------------ End Field: user_id --------------------------------------


// ---------------------------- Start Field: dept -------------------------------------- 

	/** 
	* Sets a value to `dept` variable
	* @access public
	*/

	public function setDept($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('dept', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_dept_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('dept', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `dept` variable
	* @access public
	*/

	public function getDept() {
		return $this->dept;
	}

	public function get_dept_value() {
		return $this->dept;
	}

	
// ------------------------------ End Field: dept --------------------------------------


// ---------------------------- Start Field: sect -------------------------------------- 

	/** 
	* Sets a value to `sect` variable
	* @access public
	*/

	public function setSect($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('sect', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_sect_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('sect', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `sect` variable
	* @access public
	*/

	public function getSect() {
		return $this->sect;
	}

	public function get_sect_value() {
		return $this->sect;
	}

	
// ------------------------------ End Field: sect --------------------------------------


// ---------------------------- Start Field: action -------------------------------------- 

	/** 
	* Sets a value to `action` variable
	* @access public
	*/

	public function setAction($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('action', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_action_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('action', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `action` variable
	* @access public
	*/

	public function getAction() {
		return $this->action;
	}

	public function get_action_value() {
		return $this->action;
	}

	
// ------------------------------ End Field: action --------------------------------------


// ---------------------------- Start Field: company_id -------------------------------------- 

	/** 
	* Sets a value to `company_id` variable
	* @access public
	*/

	public function setCompanyId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_company_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	*/

	public function getCompanyId() {
		return $this->company_id;
	}

	public function get_company_id_value() {
		return $this->company_id;
	}

	
// ------------------------------ End Field: company_id --------------------------------------


// ---------------------------- Start Field: notes -------------------------------------- 

	/** 
	* Sets a value to `notes` variable
	* @access public
	*/

	public function setNotes($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('notes', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_notes_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('notes', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `notes` variable
	* @access public
	*/

	public function getNotes() {
		return $this->notes;
	}

	public function get_notes_value() {
		return $this->notes;
	}

	
// ------------------------------ End Field: notes --------------------------------------


// ---------------------------- Start Field: date_accessed -------------------------------------- 

	/** 
	* Sets a value to `date_accessed` variable
	* @access public
	*/

	public function setDateAccessed($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_accessed', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_date_accessed_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('date_accessed', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `date_accessed` variable
	* @access public
	*/

	public function getDateAccessed() {
		return $this->date_accessed;
	}

	public function get_date_accessed_value() {
		return $this->date_accessed;
	}

	
// ------------------------------ End Field: date_accessed --------------------------------------


// ---------------------------- Start Field: name_id -------------------------------------- 

	/** 
	* Sets a value to `name_id` variable
	* @access public
	*/

	public function setNameId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_name_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `name_id` variable
	* @access public
	*/

	public function getNameId() {
		return $this->name_id;
	}

	public function get_name_id_value() {
		return $this->name_id;
	}

	
// ------------------------------ End Field: name_id --------------------------------------



	
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

			'user_id' => (object) array(
										'Field'=>'user_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'dept' => (object) array(
										'Field'=>'dept',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'sect' => (object) array(
										'Field'=>'sect',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'action' => (object) array(
										'Field'=>'action',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'company_id' => (object) array(
										'Field'=>'company_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'notes' => (object) array(
										'Field'=>'notes',
										'Type'=>'text',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'date_accessed' => (object) array(
										'Field'=>'date_accessed',
										'Type'=>'timestamp',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'CURRENT_TIMESTAMP',
										'Extra'=>''
									),

			'name_id' => (object) array(
										'Field'=>'name_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `system_audit` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'user_id' => "ALTER TABLE  `system_audit` ADD  `user_id` int(20) NOT NULL   ;",
			'dept' => "ALTER TABLE  `system_audit` ADD  `dept` varchar(200) NOT NULL   ;",
			'sect' => "ALTER TABLE  `system_audit` ADD  `sect` varchar(200) NOT NULL   ;",
			'action' => "ALTER TABLE  `system_audit` ADD  `action` varchar(200) NOT NULL   ;",
			'company_id' => "ALTER TABLE  `system_audit` ADD  `company_id` int(20) NULL   ;",
			'notes' => "ALTER TABLE  `system_audit` ADD  `notes` text NULL   ;",
			'date_accessed' => "ALTER TABLE  `system_audit` ADD  `date_accessed` timestamp NULL   DEFAULT 'CURRENT_TIMESTAMP';",
			'name_id' => "ALTER TABLE  `system_audit` ADD  `name_id` int(20) NULL   DEFAULT '0';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setId() - id
//setUserId() - user_id
//setDept() - dept
//setSect() - sect
//setAction() - action
//setCompanyId() - company_id
//setNotes() - notes
//setDateAccessed() - date_accessed
//setNameId() - name_id

--------------------------------------

//set_id() - id
//set_user_id() - user_id
//set_dept() - dept
//set_sect() - sect
//set_action() - action
//set_company_id() - company_id
//set_notes() - notes
//set_date_accessed() - date_accessed
//set_name_id() - name_id

*/
/* End of file System_audit_model.php */
/* Location: ./application/models/System_audit_model.php */
