<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_meta_model Class
 *
 * Manipulates `payroll_meta` table on database

CREATE TABLE `payroll_meta` (
  `meta_id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `meta_key` varchar(200) NOT NULL,
  `meta_value` text,
  PRIMARY KEY (`meta_id`),
  KEY `payroll_id` (`payroll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_meta` ADD  `meta_id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `payroll_meta` ADD  `payroll_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_meta` ADD  `meta_key` varchar(200) NOT NULL   ;
ALTER TABLE  `payroll_meta` ADD  `meta_value` text NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_meta_model extends MY_Model {

	protected $meta_id;
	protected $payroll_id;
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
		$this->_table_name = 'payroll_meta';
		$this->_short_name = 'payroll_meta';
		$this->_fields = array("meta_id","payroll_id","meta_key","meta_value");
		$this->_required = array("payroll_id","meta_key");
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

	public function set_meta_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('meta_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `meta_id` variable
	* @access public
	*/

	public function getMetaId() {
		return $this->meta_id;
	}

	public function get_meta_id_value() {
		return $this->meta_id;
	}

	
// ------------------------------ End Field: meta_id --------------------------------------


// ---------------------------- Start Field: payroll_id -------------------------------------- 

	/** 
	* Sets a value to `payroll_id` variable
	* @access public
	*/

	public function setPayrollId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_payroll_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `payroll_id` variable
	* @access public
	*/

	public function getPayrollId() {
		return $this->payroll_id;
	}

	public function get_payroll_id_value() {
		return $this->payroll_id;
	}

	
// ------------------------------ End Field: payroll_id --------------------------------------


// ---------------------------- Start Field: meta_key -------------------------------------- 

	/** 
	* Sets a value to `meta_key` variable
	* @access public
	*/

	public function setMetaKey($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('meta_key', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_meta_key_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('meta_key', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `meta_key` variable
	* @access public
	*/

	public function getMetaKey() {
		return $this->meta_key;
	}

	public function get_meta_key_value() {
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

	public function set_meta_value_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('meta_value', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `meta_value` variable
	* @access public
	*/

	public function getMetaValue() {
		return $this->meta_value;
	}

	public function get_meta_value_value() {
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

			'payroll_id' => (object) array(
										'Field'=>'payroll_id',
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
			'meta_id' => "ALTER TABLE  `payroll_meta` ADD  `meta_id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'payroll_id' => "ALTER TABLE  `payroll_meta` ADD  `payroll_id` int(20) NOT NULL   ;",
			'meta_key' => "ALTER TABLE  `payroll_meta` ADD  `meta_key` varchar(200) NOT NULL   ;",
			'meta_value' => "ALTER TABLE  `payroll_meta` ADD  `meta_value` text NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setMetaId() - meta_id
//setPayrollId() - payroll_id
//setMetaKey() - meta_key
//setMetaValue() - meta_value

--------------------------------------

//set_meta_id() - meta_id
//set_payroll_id() - payroll_id
//set_meta_key() - meta_key
//set_meta_value() - meta_value

*/
/* End of file Payroll_meta_model.php */
/* Location: ./application/models/Payroll_meta_model.php */
