<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Benefits_list_model Class
 *
 * Manipulates `benefits_list` table on database

CREATE TABLE `benefits_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
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
 ALTER TABLE  `benefits_list` ADD  `notes` text NULL   ;
 ALTER TABLE  `benefits_list` ADD  `leave` int(1) NULL   DEFAULT '0';
 ALTER TABLE  `benefits_list` ADD  `ee_account_title` varchar(200) NULL   ;
 ALTER TABLE  `benefits_list` ADD  `er_account_title` varchar(200) NULL   ;
 ALTER TABLE  `benefits_list` ADD  `active` int(1) NOT NULL   DEFAULT '1';
 ALTER TABLE  `benefits_list` ADD  `trash` int(1) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG)
 */
 
class Benefits_list_model extends MY_Model {

	protected $id;
	protected $name;
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
		$this->_fields = array("id","name","notes","leave","ee_account_title","er_account_title","active","trash");
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




}

/* End of file Benefits_list_model.php */
/* Location: ./application/models/Benefits_list_model.php */
