<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Companies_list_model Class
 *
 * Manipulates `companies_list` table on database

CREATE TABLE `companies_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `notes` text,
  `default` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin;

ALTER TABLE  `companies_list` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `companies_list` ADD  `theme` varchar(50) NULL   ;
ALTER TABLE  `companies_list` ADD  `name` varchar(200) NOT NULL   ;
ALTER TABLE  `companies_list` ADD  `address` varchar(200) NULL   ;
ALTER TABLE  `companies_list` ADD  `phone` varchar(200) NULL   ;
ALTER TABLE  `companies_list` ADD  `notes` text NULL   ;
ALTER TABLE  `companies_list` ADD  `default` int(1) NULL   DEFAULT '0';
ALTER TABLE  `companies_list` ADD  `trash` int(1) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Companies_list_model extends MY_Model {

	protected $id;
	protected $theme;
	protected $name;
	protected $address;
	protected $phone;
	protected $notes;
	protected $default;
	protected $trash;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'companies_list';
		$this->_short_name = 'companies_list';
		$this->_fields = array("id","theme","name","address","phone","notes","default","trash");
		$this->_required = array("name");
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


// ---------------------------- Start Field: theme -------------------------------------- 

	/** 
	* Sets a value to `theme` variable
	* @access public
	*/

	public function setTheme($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('theme', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `theme` variable
	* @access public
	*/

	public function getTheme() {
		return $this->theme;
	}
	
// ------------------------------ End Field: theme --------------------------------------


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


// ---------------------------- Start Field: phone -------------------------------------- 

	/** 
	* Sets a value to `phone` variable
	* @access public
	*/

	public function setPhone($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('phone', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `phone` variable
	* @access public
	*/

	public function getPhone() {
		return $this->phone;
	}
	
// ------------------------------ End Field: phone --------------------------------------


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


// ---------------------------- Start Field: default -------------------------------------- 

	/** 
	* Sets a value to `default` variable
	* @access public
	*/

	public function setDefault($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('default', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `default` variable
	* @access public
	*/

	public function getDefault() {
		return $this->default;
	}
	
// ------------------------------ End Field: default --------------------------------------


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

			'theme' => (object) array(
										'Field'=>'theme',
										'Type'=>'varchar(50)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'name' => (object) array(
										'Field'=>'name',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
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
									),

			'phone' => (object) array(
										'Field'=>'phone',
										'Type'=>'varchar(200)',
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

			'default' => (object) array(
										'Field'=>'default',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
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
			'id' => "ALTER TABLE  `companies_list` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'theme' => "ALTER TABLE  `companies_list` ADD  `theme` varchar(50) NULL   ;",
			'name' => "ALTER TABLE  `companies_list` ADD  `name` varchar(200) NOT NULL   ;",
			'address' => "ALTER TABLE  `companies_list` ADD  `address` varchar(200) NULL   ;",
			'phone' => "ALTER TABLE  `companies_list` ADD  `phone` varchar(200) NULL   ;",
			'notes' => "ALTER TABLE  `companies_list` ADD  `notes` text NULL   ;",
			'default' => "ALTER TABLE  `companies_list` ADD  `default` int(1) NULL   DEFAULT '0';",
			'trash' => "ALTER TABLE  `companies_list` ADD  `trash` int(1) NULL   DEFAULT '0';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Companies_list_model.php */
/* Location: ./application/models/Companies_list_model.php */
