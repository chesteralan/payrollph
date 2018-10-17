<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in system/libraries/ or your
| application/libraries/ directory, with the addition of the
| 'database' library, which is somewhat of a special case.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/
$autoload['libraries'] = array('database', 'form_validation', 'template_data', 'session', 'user_agent', 'pagination');

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|	$autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array('url', 'auth', 'bootstrap', 'error', 'common');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array('payroll');

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array('payrollph');

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/
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
$models[] = 'Employees_attendance_model';
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
$models[] = 'System_audit_model';
$models[] = 'Terms_list_model';
$models[] = 'User_accounts_model';
$models[] = 'User_accounts_companies_model';
$models[] = 'User_accounts_options_model';
$models[] = 'User_accounts_restrictions_model';

$autoload['model'] = $models;
