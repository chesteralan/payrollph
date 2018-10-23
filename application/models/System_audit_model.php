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
  `name_id` int(20) DEFAULT '0',
  `notes` text,
  `date_accessed` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin;

ALTER TABLE  `system_audit` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `system_audit` ADD  `user_id` int(20) NOT NULL   ;
ALTER TABLE  `system_audit` ADD  `dept` varchar(200) NOT NULL   ;
ALTER TABLE  `system_audit` ADD  `sect` varchar(200) NOT NULL   ;
ALTER TABLE  `system_audit` ADD  `action` varchar(200) NOT NULL   ;
ALTER TABLE  `system_audit` ADD  `company_id` int(20) NULL   ;
ALTER TABLE  `system_audit` ADD  `name_id` int(20) NULL   DEFAULT '0';
ALTER TABLE  `system_audit` ADD  `notes` text NULL   ;
ALTER TABLE  `system_audit` ADD  `date_accessed` timestamp NULL   DEFAULT 'CURRENT_TIMESTAMP';


 * @package			        Model
 * @version_number	        5.0
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
	protected $name_id;
	protected $notes;
	protected $date_accessed;

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
		$this->_fields = array("id","user_id","dept","sect","action","company_id","name_id","notes","date_accessed");
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
	
	/** 
	* Get the value of `id` variable
	* @access public
	*/

	public function getId() {
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
	
	/** 
	* Get the value of `user_id` variable
	* @access public
	*/

	public function getUserId() {
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
	
	/** 
	* Get the value of `dept` variable
	* @access public
	*/

	public function getDept() {
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
	
	/** 
	* Get the value of `sect` variable
	* @access public
	*/

	public function getSect() {
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
	
	/** 
	* Get the value of `action` variable
	* @access public
	*/

	public function getAction() {
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
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	*/

	public function getCompanyId() {
		return $this->company_id;
	}
	
// ------------------------------ End Field: company_id --------------------------------------


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


// ---------------------------- Start Field: notes -------------------------------------- 

	/** 
	* Sets a value to `notes` variable
	* @access public
	*/

	public function setNotes($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('notes', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `notes` variable
	* @access public
	*/

	public function getNotes() {
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
	
	/** 
	* Get the value of `date_accessed` variable
	* @access public
	*/

	public function getDateAccessed() {
		return $this->date_accessed;
	}
	
// ------------------------------ End Field: date_accessed --------------------------------------



	
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

			'name_id' => (object) array(
										'Field'=>'name_id',
										'Type'=>'int(20)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
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
			'name_id' => "ALTER TABLE  `system_audit` ADD  `name_id` int(20) NULL   DEFAULT '0';",
			'notes' => "ALTER TABLE  `system_audit` ADD  `notes` text NULL   ;",
			'date_accessed' => "ALTER TABLE  `system_audit` ADD  `date_accessed` timestamp NULL   DEFAULT 'CURRENT_TIMESTAMP';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file System_audit_model.php */
/* Location: ./application/models/System_audit_model.php */
