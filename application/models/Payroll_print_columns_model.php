<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_print_columns_model Class
 *
 * Manipulates `payroll_print_columns` table on database

CREATE TABLE `payroll_print_columns` (
  `payroll_id` int(20) NOT NULL,
  `term_id` int(20) NOT NULL,
  `column_id` varchar(200) NOT NULL,
  KEY `term_id` (`term_id`,`payroll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

ALTER TABLE  `payroll_print_columns` ADD  `payroll_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_print_columns` ADD  `term_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_print_columns` ADD  `column_id` varchar(200) NOT NULL   ;


 * @package			        Model
 * @version_number	        6.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.5.0
 */
 
class Payroll_print_columns_model extends MY_Model {

	protected $payroll_id;
	protected $term_id;
	protected $column_id;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_print_columns';
		$this->_short_name = 'payroll_print_columns';
		$this->_fields = array("payroll_id","term_id","column_id");
		$this->_required = array("payroll_id","term_id","column_id");
		parent::__construct($short_name, $db_config);
	}

	// --------------------------------------------------------------------


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


// ---------------------------- Start Field: term_id -------------------------------------- 

	/** 
	* Sets a value to `term_id` variable
	* @access public
	*/

	public function setTermId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('term_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_term_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('term_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `term_id` variable
	* @access public
	*/

	public function getTermId() {
		return $this->term_id;
	}

	public function get_term_id_value() {
		return $this->term_id;
	}

	
// ------------------------------ End Field: term_id --------------------------------------


// ---------------------------- Start Field: column_id -------------------------------------- 

	/** 
	* Sets a value to `column_id` variable
	* @access public
	*/

	public function setColumnId($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('column_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}

	public function set_column_id_value($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('column_id', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `column_id` variable
	* @access public
	*/

	public function getColumnId() {
		return $this->column_id;
	}

	public function get_column_id_value() {
		return $this->column_id;
	}

	
// ------------------------------ End Field: column_id --------------------------------------



	
	public function get_table_options() {
		return array(
			'payroll_id' => (object) array(
										'Field'=>'payroll_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									),

			'term_id' => (object) array(
										'Field'=>'term_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'column_id' => (object) array(
										'Field'=>'column_id',
										'Type'=>'varchar(200)',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'payroll_id' => "ALTER TABLE  `payroll_print_columns` ADD  `payroll_id` int(20) NOT NULL   ;",
			'term_id' => "ALTER TABLE  `payroll_print_columns` ADD  `term_id` int(20) NOT NULL   ;",
			'column_id' => "ALTER TABLE  `payroll_print_columns` ADD  `column_id` varchar(200) NOT NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->_db->query( $column[$field_name] );
		}
	}

}
/*
//setPayrollId() - payroll_id
//setTermId() - term_id
//setColumnId() - column_id

--------------------------------------

//set_payroll_id() - payroll_id
//set_term_id() - term_id
//set_column_id() - column_id

*/
/* End of file Payroll_print_columns_model.php */
/* Location: ./application/models/Payroll_print_columns_model.php */
