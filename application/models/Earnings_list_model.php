<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Earnings_list_model Class
 *
 * Manipulates `earnings_list` table on database

CREATE TABLE `earnings_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `account_title` varchar(200) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `trash` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
);

 ALTER TABLE  `earnings_list` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
 ALTER TABLE  `earnings_list` ADD  `name` varchar(200) NOT NULL   ;
 ALTER TABLE  `earnings_list` ADD  `notes` text NULL   ;
 ALTER TABLE  `earnings_list` ADD  `account_title` varchar(200) NULL   ;
 ALTER TABLE  `earnings_list` ADD  `active` int(1) NOT NULL   DEFAULT '1';
 ALTER TABLE  `earnings_list` ADD  `trash` int(1) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Earnings_list_model extends MY_Model {

	protected $id;
	protected $name;
	protected $notes;
	protected $account_title;
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
		$this->_table_name = 'earnings_list';
		$this->_short_name = 'earnings_list';
		$this->_fields = array("id","name","notes","account_title","active","trash");
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


// ---------------------------- Start Field: account_title -------------------------------------- 

	/** 
	* Sets a value to `account_title` variable
	* @access public
	*/

		public function setAccountTitle($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('account_title', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `account_title` variable
	* @access public
	*/

		public function getAccountTitle() {
			return $this->account_title;
		}
	
// ------------------------------ End Field: account_title --------------------------------------


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




}

/* End of file Earnings_list_model.php */
/* Location: ./application/models/Earnings_list_model.php */
