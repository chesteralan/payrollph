<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Benefits_list_model Class
 *
 * Manipulates `benefits_list` table on database

CREATE TABLE `benefits_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `abbr` varchar(100) DEFAULT NULL,
  `notes` text,
  `leave` int(1) DEFAULT '0',
  `ee_account_title` varchar(200) DEFAULT NULL,
  `er_account_title` varchar(200) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `trash` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
);

ALTER TABLE  `benefits_list` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `benefits_list` ADD  `name` varchar(200) NOT NULL   ;
ALTER TABLE  `benefits_list` ADD  `abbr` varchar(100) NULL   ;
ALTER TABLE  `benefits_list` ADD  `notes` text NULL   ;
ALTER TABLE  `benefits_list` ADD  `leave` int(1) NULL   DEFAULT '0';
ALTER TABLE  `benefits_list` ADD  `ee_account_title` varchar(200) NULL   ;
ALTER TABLE  `benefits_list` ADD  `er_account_title` varchar(200) NULL   ;
ALTER TABLE  `benefits_list` ADD  `active` int(1) NOT NULL   DEFAULT '1';
ALTER TABLE  `benefits_list` ADD  `trash` int(1) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Benefits_list_model extends MY_Model {

	protected $id;
	protected $name;
	protected $abbr;
	protected $notes;
	protected $leave;
	protected $ee_account_title;
	protected $er_account_title;
	protected $active;
	protected $trash;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'benefits_list';
		$this->_short_name = 'benefits_list';
		$this->_fields = array("id","name","abbr","notes","leave","ee_account_title","er_account_title","active","trash");
		$this->_required = array("name","active");
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


// ---------------------------- Start Field: name -------------------------------------- 

	/** 
	* Sets a value to `name` variable
	* @access public
	*/

	public function setName($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `name` variable
	* @access public
	*/

	public function getName() {
		return $this->name;
	}
	
// ------------------------------ End Field: name --------------------------------------


// ---------------------------- Start Field: abbr -------------------------------------- 

	/** 
	* Sets a value to `abbr` variable
	* @access public
	*/

	public function setAbbr($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('abbr', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `abbr` variable
	* @access public
	*/

	public function getAbbr() {
		return $this->abbr;
	}
	
// ------------------------------ End Field: abbr --------------------------------------


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


// ---------------------------- Start Field: leave -------------------------------------- 

	/** 
	* Sets a value to `leave` variable
	* @access public
	*/

	public function setLeave($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('leave', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `leave` variable
	* @access public
	*/

	public function getLeave() {
		return $this->leave;
	}
	
// ------------------------------ End Field: leave --------------------------------------


// ---------------------------- Start Field: ee_account_title -------------------------------------- 

	/** 
	* Sets a value to `ee_account_title` variable
	* @access public
	*/

	public function setEeAccountTitle($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('ee_account_title', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `ee_account_title` variable
	* @access public
	*/

	public function getEeAccountTitle() {
		return $this->ee_account_title;
	}
	
// ------------------------------ End Field: ee_account_title --------------------------------------


// ---------------------------- Start Field: er_account_title -------------------------------------- 

	/** 
	* Sets a value to `er_account_title` variable
	* @access public
	*/

	public function setErAccountTitle($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('er_account_title', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `er_account_title` variable
	* @access public
	*/

	public function getErAccountTitle() {
		return $this->er_account_title;
	}
	
// ------------------------------ End Field: er_account_title --------------------------------------


// ---------------------------- Start Field: active -------------------------------------- 

	/** 
	* Sets a value to `active` variable
	* @access public
	*/

	public function setActive($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('active', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `active` variable
	* @access public
	*/

	public function getActive() {
		return $this->active;
	}
	
// ------------------------------ End Field: active --------------------------------------


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

			'name' => (object) array(
										'Field'=>'name',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'abbr' => (object) array(
										'Field'=>'abbr',
										'Type'=>'varchar(100)',
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

			'leave' => (object) array(
										'Field'=>'leave',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									),

			'ee_account_title' => (object) array(
										'Field'=>'ee_account_title',
										'Type'=>'varchar(200)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'er_account_title' => (object) array(
										'Field'=>'er_account_title',
										'Type'=>'varchar(200)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'active' => (object) array(
										'Field'=>'active',
										'Type'=>'int(1)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'1',
										'Extra'=>''
									),

			'trash' => (object) array(
										'Field'=>'trash',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `benefits_list` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'name' => "ALTER TABLE  `benefits_list` ADD  `name` varchar(200) NOT NULL   ;",
			'abbr' => "ALTER TABLE  `benefits_list` ADD  `abbr` varchar(100) NULL   ;",
			'notes' => "ALTER TABLE  `benefits_list` ADD  `notes` text NULL   ;",
			'leave' => "ALTER TABLE  `benefits_list` ADD  `leave` int(1) NULL   DEFAULT '0';",
			'ee_account_title' => "ALTER TABLE  `benefits_list` ADD  `ee_account_title` varchar(200) NULL   ;",
			'er_account_title' => "ALTER TABLE  `benefits_list` ADD  `er_account_title` varchar(200) NULL   ;",
			'active' => "ALTER TABLE  `benefits_list` ADD  `active` int(1) NOT NULL   DEFAULT '1';",
			'trash' => "ALTER TABLE  `benefits_list` ADD  `trash` int(1) NULL   DEFAULT '0';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Benefits_list_model.php */
/* Location: ./application/models/Benefits_list_model.php */
