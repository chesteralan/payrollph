<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_database extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->template_data->set('current_page', 'Database');
		$this->template_data->set('current_uri', 'system_database');

		$this->_isAuth('system', 'database', 'view');

	}

	public function index() {

		$dir    = 'backups';
		$files = array_diff(scandir($dir), array('..', '.', '.htaccess', 'index.html'));
		arsort($files);
		$this->template_data->set('backup_files', $files);

		$this->load->view('system/database/backup', $this->template_data->get_data());
	}

	public function download($file)
	{
		$file_dir = "backups/" . $file;
		if (file_exists($file_dir)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($file_dir).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file_dir));
		    readfile($file_dir);
		    exit;
		}
		redirect("system_database");
	}

	public function delete($file)
	{
		$this->_isAuth('system', 'database', 'delete');
		$file_dir = "backups/" . $file;
		if (file_exists($file_dir)) {
			unlink($file_dir);
		}
		redirect("system_database");
	}

	public function verify() {

		$models = array();
		$models[] = 'Account_sessions_model';
		$models[] = 'Benefits_list_model';
		$models[] = 'Companies_list_model';
		$models[] = 'Companies_options_model';
		$models[] = 'Deductions_list_model';
		$models[] = 'Earnings_list_model';
		$models[] = 'Employees_model';
		$models[] = 'Employees_absences_model';
		$models[] = 'Employees_areas_model';
		$models[] = 'Employees_benefits_model';
		$models[] = 'Employees_benefits_templates_model';
		$models[] = 'Employees_contacts_model';
		$models[] = 'Employees_deductions_model';
		$models[] = 'Employees_deductions_templates_model';
		$models[] = 'Employees_earnings_model';
		$models[] = 'Employees_earnings_templates_model';
		$models[] = 'Employees_groups_model';
		$models[] = 'Employees_leave_benefits_model';
		$models[] = 'Employees_positions_model';
		$models[] = 'Employees_salaries_model';
		$models[] = 'Names_info_model';
		$models[] = 'Names_list_model';
		$models[] = 'Names_meta_model';
		$models[] = 'Payroll_model';
		$models[] = 'Payroll_benefits_model';
		$models[] = 'Payroll_deductions_model';
		$models[] = 'Payroll_earnings_model';
		$models[] = 'Payroll_employees_model';
		$models[] = 'Payroll_employees_benefits_model';
		$models[] = 'Payroll_employees_deductions_model';
		$models[] = 'Payroll_employees_earnings_model';
		$models[] = 'Payroll_employees_salaries_model';
		$models[] = 'Payroll_groups_model';
		$models[] = 'Payroll_inclusive_dates_model';
		$models[] = 'Payroll_templates_model';
		$models[] = 'Payroll_templates_benefits_model';
		$models[] = 'Payroll_templates_columns_model';
		$models[] = 'Payroll_templates_deductions_model';
		$models[] = 'Payroll_templates_earnings_model';
		$models[] = 'Payroll_templates_employees_model';
		$models[] = 'Payroll_templates_groups_model';
		$models[] = 'Terms_list_model';
		$models[] = 'User_accounts_model';
		$models[] = 'User_accounts_companies_model';
		$models[] = 'User_accounts_options_model';
		$models[] = 'User_accounts_restrictions_model';

		$models_obj = array();
		foreach($models as $i=>$model) {
			$obj = new $this->$model;
			$table_columns = $this->db->query('SHOW COLUMNS FROM '. $obj->get_table_name());
			$models_obj[$i] = (object) array(
				'model_name' => $model,
				'table_name'=> $obj->get_table_name(),
				'fields' => $obj->get_table_fields(),
				'table_options' => $obj->get_table_options(),
				'table_columns' => ((isset($table_columns)) && ($table_columns)) ? $table_columns->result() : false,
			);
		}

		$this->template_data->set('models', $models_obj);

		$this->load->view('system/database/verify', $this->template_data->get_data());

	}

	public function remove_field($table_name, $field_name) {
		$this->db->query("ALTER TABLE `{$table_name}` DROP `{$field_name}`;");
		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

	public function fix_type($table_name, $field_name, $field_type) {
		$field_type = urldecode( $field_type );
		$this->db->query("ALTER TABLE `{$table_name}` CHANGE `{$field_name}` `{$field_name}` {$field_type};");
		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

	public function fix_null($table_name, $field_name, $field_type, $value) {
		$new_value = 'NOT NULL';
		if( $value == 'YES' ) {
			$new_value = 'NULL';
		}
		$field_type = urldecode( $field_type );
		$this->db->query("ALTER TABLE `{$table_name}` CHANGE `{$field_name}` `{$field_name}` {$field_type} {$new_value};");

		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

}
