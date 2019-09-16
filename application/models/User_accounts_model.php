<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_accounts_model Class
 *
 * Manipulates `user_accounts` table on database

CREATE TABLE `user_accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin;

ALTER TABLE  `user_accounts` ADD  `id` int(10) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `user_accounts` ADD  `username` varchar(200) NOT NULL   UNIQUE KEY;
ALTER TABLE  `user_accounts` ADD  `password` varchar(200) NOT NULL   ;
ALTER TABLE  `user_accounts` ADD  `name` varchar(200) NOT NULL   ;
ALTER TABLE  `user_accounts` ADD  `last_login` datetime NULL   DEFAULT 'CURRENT_TIMESTAMP';


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class User_accounts_model extends MY_Model {

	protected $id;
	protected $username;
	protected $password;
	protected $name;
	protected $last_login;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'user_accounts';
		$this->_short_name = 'user_accounts';
		$this->_fields = array("id","username","password","name","last_login");
		$this->_required = array("username","password","name");
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


// ---------------------------- Start Field: username -------------------------------------- 

	/** 
	* Sets a value to `username` variable
	* @access public
	*/

	public function setUsername($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('username', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_username_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('username', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `username` variable
	* @access public
	*/

	public function getUsername() {
		return $this->username;
	}

	public function get_username_value() {
		return $this->username;
	}

	
// ------------------------------ End Field: username --------------------------------------


// ---------------------------- Start Field: password -------------------------------------- 

	/** 
	* Sets a value to `password` variable
	* @access public
	*/

	public function setPassword($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('password', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_password_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('password', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `password` variable
	* @access public
	*/

	public function getPassword() {
		return $this->password;
	}

	public function get_password_value() {
		return $this->password;
	}

	
// ------------------------------ End Field: password --------------------------------------


// ---------------------------- Start Field: name -------------------------------------- 

	/** 
	* Sets a value to `name` variable
	* @access public
	*/

	public function setName($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_name_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('name', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `name` variable
	* @access public
	*/

	public function getName() {
		return $this->name;
	}

	public function get_name_value() {
		return $this->name;
	}

	
// ------------------------------ End Field: name --------------------------------------


// ---------------------------- Start Field: last_login -------------------------------------- 

	/** 
	* Sets a value to `last_login` variable
	* @access public
	*/

	public function setLastLogin($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('last_login', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_last_login_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('last_login', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `last_login` variable
	* @access public
	*/

	public function getLastLogin() {
		return $this->last_login;
	}

	public function get_last_login_value() {
		return $this->last_login;
	}

	
// ------------------------------ End Field: last_login --------------------------------------



	
	public function get_table_options() {
		return array(
			'id' => (object) array(
										'Field'=>'id',
										'Type'=>'int(10)',
										'Null'=>'NO',
										'Key'=>'PRI',
										'Default'=>'',
										'Extra'=>'auto_increment'
									),

			'username' => (object) array(
										'Field'=>'username',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'UNI',
										'Default'=>'',
										'Extra'=>''
									),

			'password' => (object) array(
										'Field'=>'password',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
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

			'last_login' => (object) array(
										'Field'=>'last_login',
										'Type'=>'datetime',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'CURRENT_TIMESTAMP',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `user_accounts` ADD  `id` int(10) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'username' => "ALTER TABLE  `user_accounts` ADD  `username` varchar(200) NOT NULL   UNIQUE KEY;",
			'password' => "ALTER TABLE  `user_accounts` ADD  `password` varchar(200) NOT NULL   ;",
			'name' => "ALTER TABLE  `user_accounts` ADD  `name` varchar(200) NOT NULL   ;",
			'last_login' => "ALTER TABLE  `user_accounts` ADD  `last_login` datetime NULL   DEFAULT 'CURRENT_TIMESTAMP';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setId() - id
//setUsername() - username
//setPassword() - password
//setName() - name
//setLastLogin() - last_login

--------------------------------------

//set_id() - id
//set_username() - username
//set_password() - password
//set_name() - name
//set_last_login() - last_login

*/
/* End of file User_accounts_model.php */
/* Location: ./application/models/User_accounts_model.php */
