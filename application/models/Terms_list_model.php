<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Terms_list_model Class
 *
 * Manipulates `terms_list` table on database

CREATE TABLE `terms_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `type` varchar(50) DEFAULT NULL,
  `trash` int(1) DEFAULT '0',
  `priority` int(3) DEFAULT '0',
  PRIMARY KEY (`id`)
);

 ALTER TABLE  `terms_list` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
 ALTER TABLE  `terms_list` ADD  `name` varchar(200) NOT NULL   ;
 ALTER TABLE  `terms_list` ADD  `notes` text NULL   ;
 ALTER TABLE  `terms_list` ADD  `type` varchar(50) NULL   ;
 ALTER TABLE  `terms_list` ADD  `trash` int(1) NULL   DEFAULT '0';
 ALTER TABLE  `terms_list` ADD  `priority` int(3) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        4.0.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Terms_list_model extends MY_Model {

	protected $id;
	protected $name;
	protected $notes;
	protected $type;
	protected $trash;
	protected $priority;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'terms_list';
		$this->_short_name = 'terms_list';
		$this->_fields = array("id","name","notes","type","trash","priority");
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


// ---------------------------- Start Field: type -------------------------------------- 

	/** 
	* Sets a value to `type` variable
	* @access public
	*/

		public function setType($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('type', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `type` variable
	* @access public
	*/

		public function getType() {
			return $this->type;
		}
	
// ------------------------------ End Field: type --------------------------------------


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


// ---------------------------- Start Field: priority -------------------------------------- 

	/** 
	* Sets a value to `priority` variable
	* @access public
	*/

		public function setPriority($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
			return $this->_set_field('priority', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
		}
	
	/** 
	* Get the value of `priority` variable
	* @access public
	*/

		public function getPriority() {
			return $this->priority;
		}
	
// ------------------------------ End Field: priority --------------------------------------




}

/* End of file Terms_list_model.php */
/* Location: ./application/models/Terms_list_model.php */
