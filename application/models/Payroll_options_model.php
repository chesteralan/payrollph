<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_options_model Class
 *
 * Manipulates `payroll_options` table on database

CREATE TABLE `payroll_options` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_options` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `payroll_options` ADD  `payroll_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_options` ADD  `key` varchar(50) NOT NULL   ;
ALTER TABLE  `payroll_options` ADD  `value` text NOT NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_options_model extends MY_Model {

	protected $id;
	protected $payroll_id;
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
		$this->_table_name = 'payroll_options';
		$this->_short_name = 'payroll_options';
		$this->_fields = array("id","payroll_id","key","value");
		$this->_required = array("payroll_id","key","value");
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

	public function set_id($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `id` variable
	* @access public
	*/

	public function getId() {
		return $this->id;
	}

	public function get_id() {
		return $this->id;
	}

	
// ------------------------------ End Field: id --------------------------------------


// ---------------------------- Start Field: payroll_id -------------------------------------- 

	/** 
	* Sets a value to `payroll_id` variable
	* @access public
	*/

	public function setPayrollId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_payroll_id($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('payroll_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `payroll_id` variable
	* @access public
	*/

	public function getPayrollId() {
		return $this->payroll_id;
	}

	public function get_payroll_id() {
		return $this->payroll_id;
	}

	
// ------------------------------ End Field: payroll_id --------------------------------------


// ---------------------------- Start Field: key -------------------------------------- 

	/** 
	* Sets a value to `key` variable
	* @access public
	*/

	public function setKey($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('key', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_key($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('key', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `key` variable
	* @access public
	*/

	public function getKey() {
		return $this->key;
	}

	public function get_key() {
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

	public function set_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('value', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `value` variable
	* @access public
	*/

	public function getValue() {
		return $this->value;
	}

	public function get_value() {
		return $this->value;
	}

	
// ------------------------------ End Field: value --------------------------------------



	
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

			'payroll_id' => (object) array(
										'Field'=>'payroll_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'key' => (object) array(
										'Field'=>'key',
										'Type'=>'varchar(50)',
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
			'id' => "ALTER TABLE  `payroll_options` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'payroll_id' => "ALTER TABLE  `payroll_options` ADD  `payroll_id` int(20) NOT NULL   ;",
			'key' => "ALTER TABLE  `payroll_options` ADD  `key` varchar(50) NOT NULL   ;",
			'value' => "ALTER TABLE  `payroll_options` ADD  `value` text NOT NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setId() - id
//setPayrollId() - payroll_id
//setKey() - key
//setValue() - value

--------------------------------------

//set_id() - id
//set_payroll_id() - payroll_id
//set_key() - key
//set_value() - value

*/
/* End of file Payroll_options_model.php */
/* Location: ./application/models/Payroll_options_model.php */
