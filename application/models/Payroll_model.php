<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_model Class
 *
 * Manipulates `payroll` table on database

CREATE TABLE `payroll` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `template_id` int(20) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `lock` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `company_id` (`company_id`)
);

ALTER TABLE  `payroll` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE  `payroll` ADD  `company_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `name` varchar(200) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `template_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `month` int(2) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `year` int(4) NOT NULL   ;
ALTER TABLE  `payroll` ADD  `active` int(1) NOT NULL   DEFAULT '1';
ALTER TABLE  `payroll` ADD  `lock` int(1) NULL   DEFAULT '0';


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_model extends MY_Model {

	protected $id;
	protected $company_id;
	protected $name;
	protected $template_id;
	protected $month;
	protected $year;
	protected $active;
	protected $lock;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll';
		$this->_short_name = 'payroll';
		$this->_fields = array("id","company_id","name","template_id","month","year","active","lock");
		$this->_required = array("company_id","name","template_id","month","year","active");
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


// ---------------------------- Start Field: company_id -------------------------------------- 

	/** 
	* Sets a value to `company_id` variable
	* @access public
	*/

	public function setCompanyId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('company_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `company_id` variable
	* @access public
	*/

	public function getCompanyId() {
		return $this->company_id;
	}
	
// ------------------------------ End Field: company_id --------------------------------------


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


// ---------------------------- Start Field: template_id -------------------------------------- 

	/** 
	* Sets a value to `template_id` variable
	* @access public
	*/

	public function setTemplateId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('template_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `template_id` variable
	* @access public
	*/

	public function getTemplateId() {
		return $this->template_id;
	}
	
// ------------------------------ End Field: template_id --------------------------------------


// ---------------------------- Start Field: month -------------------------------------- 

	/** 
	* Sets a value to `month` variable
	* @access public
	*/

	public function setMonth($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('month', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `month` variable
	* @access public
	*/

	public function getMonth() {
		return $this->month;
	}
	
// ------------------------------ End Field: month --------------------------------------


// ---------------------------- Start Field: year -------------------------------------- 

	/** 
	* Sets a value to `year` variable
	* @access public
	*/

	public function setYear($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('year', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `year` variable
	* @access public
	*/

	public function getYear() {
		return $this->year;
	}
	
// ------------------------------ End Field: year --------------------------------------


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


// ---------------------------- Start Field: lock -------------------------------------- 

	/** 
	* Sets a value to `lock` variable
	* @access public
	*/

	public function setLock($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('lock', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `lock` variable
	* @access public
	*/

	public function getLock() {
		return $this->lock;
	}
	
// ------------------------------ End Field: lock --------------------------------------



	
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

			'company_id' => (object) array(
										'Field'=>'company_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
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

			'template_id' => (object) array(
										'Field'=>'template_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'month' => (object) array(
										'Field'=>'month',
										'Type'=>'int(2)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'year' => (object) array(
										'Field'=>'year',
										'Type'=>'int(4)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'active' => (object) array(
										'Field'=>'active',
										'Type'=>'int(1)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'1',
										'Extra'=>''
									),

			'lock' => (object) array(
										'Field'=>'lock',
										'Type'=>'int(1)',
										'Null'=>'YES',
										'Key'=>'',
										'Default'=>'0',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'id' => "ALTER TABLE  `payroll` ADD  `id` int(20) NOT NULL  AUTO_INCREMENT PRIMARY KEY;",
			'company_id' => "ALTER TABLE  `payroll` ADD  `company_id` int(20) NOT NULL   ;",
			'name' => "ALTER TABLE  `payroll` ADD  `name` varchar(200) NOT NULL   ;",
			'template_id' => "ALTER TABLE  `payroll` ADD  `template_id` int(20) NOT NULL   ;",
			'month' => "ALTER TABLE  `payroll` ADD  `month` int(2) NOT NULL   ;",
			'year' => "ALTER TABLE  `payroll` ADD  `year` int(4) NOT NULL   ;",
			'active' => "ALTER TABLE  `payroll` ADD  `active` int(1) NOT NULL   DEFAULT '1';",
			'lock' => "ALTER TABLE  `payroll` ADD  `lock` int(1) NULL   DEFAULT '0';",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Payroll_model.php */
/* Location: ./application/models/Payroll_model.php */
