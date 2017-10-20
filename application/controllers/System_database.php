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
		$missing_tables = array();
		foreach($models as $i=>$model) {
			
			$obj = new $this->$model;
			if( !in_array($obj->get_table_name(), $this->db->list_tables())) {
				$missing_tables[] = $obj->get_table_name();
				continue;
			}

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
		$this->template_data->set('missing_tables', $missing_tables);

		$this->load->view('system/database/verify', $this->template_data->get_data());

	}

	public function remove_field($table_name, $field_name) {
		$this->db->query("ALTER TABLE `{$table_name}` DROP `{$field_name}`;");
		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

	public function fix_key($table_name, $field_name, $field_type) {
		$field_type = urldecode( $field_type );
		if( $field_type == 'PRI') {
			$this->db->query("ALTER TABLE `{$table_name}` ADD PRIMARY KEY(`{$field_name}`);");
		}
		elseif( $field_type == 'MUL') {
			$this->db->query("ALTER TABLE `{$table_name}` ADD INDEX(`$field_name`);");
		}
		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

	public function fix_type($table_name, $field_name, $field_type) {
		$field_type = urldecode( $field_type );
		$this->db->query("ALTER TABLE `{$table_name}` CHANGE `{$field_name}` `{$field_name}` {$field_type};");
		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

	public function fix_extra($table_name, $field_name, $field_type, $value) {
		$field_type = urldecode( $field_type );
		if( $value == 'auto_increment') {
			$this->db->query("ALTER TABLE `{$table_name}` CHANGE `{$field_name}` `{$field_name}` {$field_type} NOT NULL AUTO_INCREMENT;");
		}
		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

	public function fix_default($table_name, $field_name, $field_type, $value) {
		$field_type = urldecode( $field_type );
		$this->db->query("ALTER TABLE `{$table_name}` CHANGE `{$field_name}` `{$field_name}` {$field_type} NOT NULL DEFAULT '{$value}';");
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

	public function add_column($table_name, $field_name) {

		$models = array();
		$models['account_sessions'] = 'Account_sessions_model';
		$models['benefits_list'] = 'Benefits_list_model';
		$models['companies_list'] = 'Companies_list_model';
		$models['companies_options'] = 'Companies_options_model';
		$models['deductions_list'] = 'Deductions_list_model';
		$models['earnings_list'] = 'Earnings_list_model';
		$models['employees'] = 'Employees_model';
		$models['employees_absences'] = 'Employees_absences_model';
		$models['employees_areas'] = 'Employees_areas_model';
		$models['employees_benefits'] = 'Employees_benefits_model';
		$models['employees_benefits_templates'] = 'Employees_benefits_templates_model';
		$models['employees_contacts'] = 'Employees_contacts_model';
		$models['employees_deductions'] = 'Employees_deductions_model';
		$models['employees_deductions_templates'] = 'Employees_deductions_templates_model';
		$models['employees_earnings'] = 'Employees_earnings_model';
		$models['employees_earnings_templates'] = 'Employees_earnings_templates_model';
		$models['employees_groups'] = 'Employees_groups_model';
		$models['employees_leave_benefits'] = 'Employees_leave_benefits_model';
		$models['employees_positions'] = 'Employees_positions_model';
		$models['employees_salaries'] = 'Employees_salaries_model';
		$models['names_info'] = 'Names_info_model';
		$models['names_list'] = 'Names_list_model';
		$models['names_meta'] = 'Names_meta_model';
		$models['payroll'] = 'Payroll_model';
		$models['payroll_benefits'] = 'Payroll_benefits_model';
		$models['payroll_deductions'] = 'Payroll_deductions_model';
		$models['payroll_earnings'] = 'Payroll_earnings_model';
		$models['payroll_employees'] = 'Payroll_employees_model';
		$models['payroll_employees_benefits'] = 'Payroll_employees_benefits_model';
		$models['payroll_employees_deductions'] = 'Payroll_employees_deductions_model';
		$models['payroll_employees_earnings'] = 'Payroll_employees_earnings_model';
		$models['payroll_employees_salaries'] = 'Payroll_employees_salaries_model';
		$models['payroll_groups'] = 'Payroll_groups_model';
		$models['payroll_inclusive_dates'] = 'Payroll_inclusive_dates_model';
		$models['payroll_templates'] = 'Payroll_templates_model';
		$models['payroll_templates_benefits'] = 'Payroll_templates_benefits_model';
		$models['payroll_templates_columns'] = 'Payroll_templates_columns_model';
		$models['payroll_templates_deductions'] = 'Payroll_templates_deductions_model';
		$models['payroll_templates_earnings'] = 'Payroll_templates_earnings_model';
		$models['payroll_templates_employees'] = 'Payroll_templates_employees_model';
		$models['payroll_templates_groups'] = 'Payroll_templates_groups_model';
		$models['terms_list'] = 'Terms_list_model';
		$models['user_accounts'] = 'User_accounts_model';
		$models['user_accounts_companies'] = 'User_accounts_companies_model';
		$models['user_accounts_options'] = 'User_accounts_options_model';
		$models['user_accounts_restrictions'] = 'User_accounts_restrictions_model';

		if(isset($models[$table_name])) {
			$model_class = $models[$table_name];
			$table = new $this->$model_class;
			$table->add_table_column($field_name);
		}

		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

	public function add_table($table_name) {
		$this->db->query("CREATE TABLE `{$table_name}` (`temporary_column_remove_this` int(1) NULL);");
		redirect( site_url("system_database/verify") . "?table=" . $table_name );
	}

}
