<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_accounts_restrictions_model Class
 *
 * Manipulates `user_accounts_restrictions` table on database

CREATE TABLE `user_accounts_restrictions` (
  `uid` int(20) NOT NULL,
  `department` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `view` int(1) NOT NULL DEFAULT '0',
  `add` int(1) NOT NULL DEFAULT '0',
  `edit` int(1) NOT NULL DEFAULT '0',
  `delete` int(1) NOT NULL DEFAULT '0',
  KEY `uid` (`uid`)
);

 ALTER TABLE  `user_accounts_restrictions` ADD  `uid` int(20) NOT NULL   ;
 ALTER TABLE  `user_accounts_restrictions` ADD  `department` varchar(50) NOT NULL   ;
 ALTER TABLE  `user_accounts_restrictions` ADD  `section` varchar(50) NOT NULL   ;
 ALTER TABLE  `user_accounts_restrictions` ADD  `view` int(1) NOT NULL   DEFAULT '0';
 ALTER TABLE  `user_accounts_restrictions` ADD  `add` int(1) NOT NULL   DEFAULT '0';
 ALTER TABLE  `user_accounts_restrictions` ADD  `edit` int(1) NOT NULL   DEFAULT '0';
 ALTER TABLE  `user_accounts_restrictions` ADD  `delete` int(1) NOT NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class User_accounts_restrictions_model extends MY_Model {

	protected $uid;
	protected $department;
	protected $section;
	protected $view;
	protected $add;
	protected $edit;
	protected $delete;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'user_accounts_restrictions';
		$this->_short_name = 'user_accounts_restrictions';
		$this->_fields = array("uid","department","section","view","add","edit","delete");
		$this->_required = array("uid","department","section","view","add","edit","delete");
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
	
	/** 
	* Get the value of `uid` variable
	* @access public
	*/

		public function getUid() {
			return $this->uid;
		}
	
// ------------------------------ End Field: uid --------------------------------------


// ---------------------------- Start Field: department -------------------------------------- 

	/** 
	* Sets a value to `department` variable
	* @access public
	*/

		public function setDepartment($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('department', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `department` variable
	* @access public
	*/

		public function getDepartment() {
			return $this->department;
		}
	
// ------------------------------ End Field: department --------------------------------------


// ---------------------------- Start Field: section -------------------------------------- 

	/** 
	* Sets a value to `section` variable
	* @access public
	*/

		public function setSection($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('section', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `section` variable
	* @access public
	*/

		public function getSection() {
			return $this->section;
		}
	
// ------------------------------ End Field: section --------------------------------------


// ---------------------------- Start Field: view -------------------------------------- 

	/** 
	* Sets a value to `view` variable
	* @access public
	*/

		public function setView($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('view', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `view` variable
	* @access public
	*/

		public function getView() {
			return $this->view;
		}
	
// ------------------------------ End Field: view --------------------------------------


// ---------------------------- Start Field: add -------------------------------------- 

	/** 
	* Sets a value to `add` variable
	* @access public
	*/

		public function setAdd($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('add', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `add` variable
	* @access public
	*/

		public function getAdd() {
			return $this->add;
		}
	
// ------------------------------ End Field: add --------------------------------------


// ---------------------------- Start Field: edit -------------------------------------- 

	/** 
	* Sets a value to `edit` variable
	* @access public
	*/

		public function setEdit($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('edit', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `edit` variable
	* @access public
	*/

		public function getEdit() {
			return $this->edit;
		}
	
// ------------------------------ End Field: edit --------------------------------------


// ---------------------------- Start Field: delete -------------------------------------- 

	/** 
	* Sets a value to `delete` variable
	* @access public
	*/

		public function setDelete($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('delete', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `delete` variable
	* @access public
	*/

		public function getDelete() {
			return $this->delete;
		}
	
// ------------------------------ End Field: delete --------------------------------------




}

/* End of file User_accounts_restrictions_model.php */
/* Location: ./application/models/User_accounts_restrictions_model.php */
