<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_accounts_companies_model Class
 *
 * Manipulates `user_accounts_companies` table on database

CREATE TABLE `user_accounts_companies` (
  `uid` int(20) NOT NULL,
  `company_id` int(20) NOT NULL,
  KEY `uid` (`uid`,`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `user_accounts_companies` ADD  `uid` int(20) NOT NULL   ;
ALTER TABLE  `user_accounts_companies` ADD  `company_id` int(20) NOT NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class User_accounts_companies_model extends MY_Model {

	protected $uid;
	protected $company_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'user_accounts_companies';
		$this->_short_name = 'user_accounts_companies';
		$this->_fields = array("uid","company_id");
		$this->_required = array("uid","company_id");
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

	public function set_uid_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('uid', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `uid` variable
	* @access public
	*/

	public function getUid() {
		return $this->uid;
	}

	public function get_uid_value() {
		return $this->uid;
	}

	
// ------------------------------ End Field: uid --------------------------------------


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

			'company_id' => (object) array(
										'Field'=>'company_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'uid' => "ALTER TABLE  `user_accounts_companies` ADD  `uid` int(20) NOT NULL   ;",
			'company_id' => "ALTER TABLE  `user_accounts_companies` ADD  `company_id` int(20) NOT NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setUid() - uid
//setCompanyId() - company_id

--------------------------------------

//set_uid() - uid
//set_company_id() - company_id

*/
/* End of file User_accounts_companies_model.php */
/* Location: ./application/models/User_accounts_companies_model.php */
