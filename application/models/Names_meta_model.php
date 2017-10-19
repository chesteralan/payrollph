<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Names_meta_model Class
 *
 * Manipulates `names_meta` table on database

CREATE TABLE `names_meta` (
  `meta_id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `meta_key` varchar(200) NOT NULL,
  `meta_value` text,
  PRIMARY KEY (`meta_id`),
  KEY `name_id` (`name_id`)
);

ALTER TABLE  `names_meta` ADD  `meta_id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `names_meta` ADD  `name_id` int(20) NOT NULL   ;
ALTER TABLE  `names_meta` ADD  `meta_key` varchar(200) NOT NULL   ;
ALTER TABLE  `names_meta` ADD  `meta_value` text NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Names_meta_model extends MY_Model {

	protected $meta_id;
	protected $name_id;
	protected $meta_key;
	protected $meta_value;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'names_meta';
		$this->_short_name = 'names_meta';
		$this->_fields = array("meta_id","name_id","meta_key","meta_value");
		$this->_required = array("name_id","meta_key");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


// ---------------------------- Start Field: meta_id -------------------------------------- 

	/** 
	* Sets a value to `meta_id` variable
	* @access public
	*/

	public function setMetaId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('meta_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `meta_id` variable
	* @access public
	*/

	public function getMetaId() {
		return $this->meta_id;
	}
	
// ------------------------------ End Field: meta_id --------------------------------------


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


// ---------------------------- Start Field: meta_key -------------------------------------- 

	/** 
	* Sets a value to `meta_key` variable
	* @access public
	*/

	public function setMetaKey($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('meta_key', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `meta_key` variable
	* @access public
	*/

	public function getMetaKey() {
		return $this->meta_key;
	}
	
// ------------------------------ End Field: meta_key --------------------------------------


// ---------------------------- Start Field: meta_value -------------------------------------- 

	/** 
	* Sets a value to `meta_value` variable
	* @access public
	*/

	public function setMetaValue($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('meta_value', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `meta_value` variable
	* @access public
	*/

	public function getMetaValue() {
		return $this->meta_value;
	}
	
// ------------------------------ End Field: meta_value --------------------------------------



	
	public function get_table_options() {
		return array(
			'meta_id' => (object) array(
										'Field'=>'meta_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'PRI',
										'Default'=>'',
										'Extra'=>'auto_increment'
									),

			'name_id' => (object) array(
										'Field'=>'name_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'meta_key' => (object) array(
										'Field'=>'meta_key',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'meta_value' => (object) array(
										'Field'=>'meta_value',
										'Type'=>'text',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'meta_id' => "ALTER TABLE  `names_meta` ADD  `meta_id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'name_id' => "ALTER TABLE  `names_meta` ADD  `name_id` int(20) NOT NULL   ;",
			'meta_key' => "ALTER TABLE  `names_meta` ADD  `meta_key` varchar(200) NOT NULL   ;",
			'meta_value' => "ALTER TABLE  `names_meta` ADD  `meta_value` text NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Names_meta_model.php */
/* Location: ./application/models/Names_meta_model.php */
