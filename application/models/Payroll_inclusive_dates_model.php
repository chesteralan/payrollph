<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Payroll_inclusive_dates_model Class
 *
 * Manipulates `payroll_inclusive_dates` table on database

CREATE TABLE `payroll_inclusive_dates` (
  `payroll_id` int(20) NOT NULL,
  `inclusive_date` date NOT NULL,
  KEY `payroll_id` (`payroll_id`)
);

ALTER TABLE  `payroll_inclusive_dates` ADD  `payroll_id` int(20) NOT NULL   ;
ALTER TABLE  `payroll_inclusive_dates` ADD  `inclusive_date` date NOT NULL   ;


 * @package			        Model
 * @version_number	        5.0
 * @project			        Trokis Philippines
 * @project_link	        http://www.trokis.com
 * @author			        Chester Alan Tagudin
 * @author_link		        http://www.chesteralan.com
 * @generator		        CodeIgniter Model Generator (CMG) v3.2.10
 */
 
class Payroll_inclusive_dates_model extends MY_Model {

	protected $payroll_id;
	protected $inclusive_date;

	// --------------------------------------------------------------------

	/**
	* Construct 
	* @access public
	* @param  String
	* @return Boolean;
	*/

	function __construct($short_name=NULL, $db_config=NULL) {
		$this->_table_name = 'payroll_inclusive_dates';
		$this->_short_name = 'payroll_inclusive_dates';
		$this->_fields = array("payroll_id","inclusive_date");
		$this->_required = array("payroll_id","inclusive_date");
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
	
	/** 
	* Get the value of `payroll_id` variable
	* @access public
	*/

	public function getPayrollId() {
		return $this->payroll_id;
	}
	
// ------------------------------ End Field: payroll_id --------------------------------------


// ---------------------------- Start Field: inclusive_date -------------------------------------- 

	/** 
	* Sets a value to `inclusive_date` variable
	* @access public
	*/

	public function setInclusiveDate($value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
		return $this->_set_field('inclusive_date', $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
	}
	
	/** 
	* Get the value of `inclusive_date` variable
	* @access public
	*/

	public function getInclusiveDate() {
		return $this->inclusive_date;
	}
	
// ------------------------------ End Field: inclusive_date --------------------------------------



	
	public function get_table_options() {
		return array(
			'payroll_id' => (object) array(
										'Field'=>'payroll_id',
										'Type'=>'int(20)',
										'Null'=>'NO',
										'Key'=>'MUL',
										'Default'=>'',
										'Extra'=>''
									),

			'inclusive_date' => (object) array(
										'Field'=>'inclusive_date',
										'Type'=>'date',
										'Null'=>'NO',
										'Key'=>'',
										'Default'=>'',
										'Extra'=>''
									)
		);
	}

	public function add_table_column($field_name) {
		$column = array(
			'payroll_id' => "ALTER TABLE  `payroll_inclusive_dates` ADD  `payroll_id` int(20) NOT NULL   ;",
			'inclusive_date' => "ALTER TABLE  `payroll_inclusive_dates` ADD  `inclusive_date` date NOT NULL   ;",
		);

		if( isset( $column[$field_name] ) ) {
			$this->db->query( $column[$field_name] );
		}
	}

}

/* End of file Payroll_inclusive_dates_model.php */
/* Location: ./application/models/Payroll_inclusive_dates_model.php */
