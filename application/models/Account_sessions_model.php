<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Account_sessions_model Class
 *
 * Manipulates `account_sessions` table on database

CREATE TABLE `account_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `account_sessions_timestamp` (`timestamp`)
);

 ALTER TABLE  `account_sessions` ADD  `id` varchar(40) NOT NULL   ;
 ALTER TABLE  `account_sessions` ADD  `ip_address` varchar(45) NOT NULL   ;
 ALTER TABLE  `account_sessions` ADD  `timestamp` int(10) unsigned NOT NULL   DEFAULT '0';
 ALTER TABLE  `account_sessions` ADD  `data` blob NOT NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Account_sessions_model extends MY_Model {

	protected $id;
	protected $ip_address;
	protected $timestamp;
	protected $data;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'account_sessions';
		$this->_short_name = 'account_sessions';
		$this->_fields = array("id","ip_address","timestamp","data");
		$this->_required = array("id","ip_address","timestamp","data");
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


// ---------------------------- Start Field: ip_address -------------------------------------- 

	/** 
	* Sets a value to `ip_address` variable
	* @access public
	*/

		public function setIpAddress($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('ip_address', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `ip_address` variable
	* @access public
	*/

		public function getIpAddress() {
			return $this->ip_address;
		}
	
// ------------------------------ End Field: ip_address --------------------------------------


// ---------------------------- Start Field: timestamp -------------------------------------- 

	/** 
	* Sets a value to `timestamp` variable
	* @access public
	*/

		public function setTimestamp($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('timestamp', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `timestamp` variable
	* @access public
	*/

		public function getTimestamp() {
			return $this->timestamp;
		}
	
// ------------------------------ End Field: timestamp --------------------------------------


// ---------------------------- Start Field: data -------------------------------------- 

	/** 
	* Sets a value to `data` variable
	* @access public
	*/

		public function setData($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('data', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `data` variable
	* @access public
	*/

		public function getData() {
			return $this->data;
		}
	
// ------------------------------ End Field: data --------------------------------------



	
	public function get_table_options() {
		return array(
			'id' => (object) array(
										'Field'=>'id',
										'Type'=>'varchar(40)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'ip_address' => (object) array(
										'Field'=>'ip_address',
										'Type'=>'varchar(45)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'timestamp' => (object) array(
										'Field'=>'timestamp',
										'Type'=>'int(10) unsigned',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'0',
										'Extra'=>''
									),

			'data' => (object) array(
										'Field'=>'data',
										'Type'=>'blob',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

}

/* End of file Account_sessions_model.php */
/* Location: ./application/models/Account_sessions_model.php */
