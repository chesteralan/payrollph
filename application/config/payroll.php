<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['multi_company'] = true;

defined('APP_VERSION') OR define('APP_VERSION', '1.2.3' );
defined('APP_NAME') OR define('APP_NAME', 'SMB Payroll' );
$config['system_name'] = 'SMB Payroll';

$config['online_payroll'] = false;

$config['civil_status'] = array(
	'single' => 'Single',
	'married' => 'Married',
	'widower' => 'Widow / Widower',
);

$config['profile_modules'] = array(
	'personal_info' => true,
	'employment_info' => true,
	'address_contacts' => true,
	'social_media_accounts' => true,
	'identification_numbers' => true,
	'emergency_contacts' => true,
	'security_guard_license' => true,
);

// USERACCOUNTS_RESTRICTIONS
$dept = array(

	'payroll' => (object) array(
		'title' => 'Payroll',
		'sections' => array(
				'payroll' => 'Payroll',
				'templates' => 'Payroll Templates',
			),
	), 

	'employees' => (object) array(
		'title' => 'Employees',
		'sections' => array(
				'employees' => 'Employees',
				'calendar' => 'Employee Calendar',
				'groups' => 'Employee Groups',
				'positions' => 'Employee Positions',
				'areas' => 'Employee Areas',
			),
	), 

	'lists' =>  (object) array(
		'title' => 'Lists',
		'sections' => array(
				'names' => 'Name List',
				'benefits' => 'Benefits List',
				'earnings' => 'Earnings List',
				'deductions' => 'Deductions List'
			),
	),

	'reports' =>  (object) array(
		'title' => 'Reports',
		'sections' => array(
				'13month' => '13th Month Pay',
			),
	),

	'system' =>  (object) array(
		'title' => 'System',
		'sections' => array(
				'companies' => 'Companies',
				'terms' => 'Terminologies',
				'calendar' => 'Calendar',
				'users' => 'User Accounts',
				'audit' => 'System Audit',
				'database' => 'Database',
			),
	),

	'developer_tools' =>  (object) array(
		'title' => 'Developer Tools',
		'sections' => array(
				'themes' => 'Themes',
			),
	),
 
);

defined('USERACCOUNTS_RESTRICTIONS') OR define('USERACCOUNTS_RESTRICTIONS', serialize( $dept ) );

defined('USER_AGENT_CHECK') OR define('USER_AGENT_CHECK', false );

// working days
defined('WORK_ON_SUN')      OR define('WORK_ON_SUN', true); 
defined('WORK_ON_MON')      OR define('WORK_ON_MON', true); 
defined('WORK_ON_TUE')      OR define('WORK_ON_TUE', true); 
defined('WORK_ON_WED')      OR define('WORK_ON_WED', true); 
defined('WORK_ON_THU')      OR define('WORK_ON_THU', true); 
defined('WORK_ON_FRI')      OR define('WORK_ON_FRI', true); 
defined('WORK_ON_SAT')      OR define('WORK_ON_SAT', true); 

defined('TERM_TYPES')      OR define('TERM_TYPES', serialize( array(
	'employment_status' => 'Employment Status',
	'print_group' => 'Print Group',
	'holiday' => 'Holiday',
) )); 

defined('EARNING_MULTIPLIERS')      OR define('EARNING_MULTIPLIERS', serialize( array(
	'employment'=>'Employment (in years)', 
	'birthday'=>'Birthday (in years)',
	'inclusive_days'=>'Inclusive Days / Working Days',
	'sundays'=>'Sundays',
	'mondays'=>'Mondays',
	'tuesdays'=>'Tuesdays',
	'wednesdays'=>'Wednesdays',
	'thursdays'=>'Thursdays',
	'fridays'=>'Fridays',
	'saturdays'=>'Saturdays',
) ));

defined('PAYROLL_PRINT_FORMATS')      OR define('PAYROLL_PRINT_FORMATS', serialize( array(
	//'clergy_allowance'=>'Clergy Allowance', 
	//'mbg_security'=>'MBG Security', 
) ));

defined('PAYROLL_PAYSLIP_TEMPLATES')      OR define('PAYROLL_PAYSLIP_TEMPLATES', serialize( array(
	  'payslip' => 'Payslip (1/4)',
	  'payslip2' => 'Payslip (1/2)',
	  'payslip3' => 'Payslip (1/2) v2',
	  //'cash_voucher' => 'Cash Voucher',
	  //'clergy_allowance' => 'Clergy Allowance',
	  'mbg' => 'Payslip (1/2) MBG',
) ));

// working days
defined('DENOMINATION_1000')      OR define('DENOMINATION_1000', true); 
defined('DENOMINATION_500')      OR define('DENOMINATION_500', true); 
defined('DENOMINATION_200')      OR define('DENOMINATION_200', true); 
defined('DENOMINATION_100')      OR define('DENOMINATION_100', true); 
defined('DENOMINATION_50')      OR define('DENOMINATION_50', true); 
defined('DENOMINATION_20')      OR define('DENOMINATION_20', true); 
defined('DENOMINATION_10')      OR define('DENOMINATION_10', true); 
defined('DENOMINATION_5')      OR define('DENOMINATION_5', true); 
defined('DENOMINATION_1')      OR define('DENOMINATION_1', true); 
defined('DENOMINATION_25c')      OR define('DENOMINATION_25c', true); 
defined('DENOMINATION_10c')      OR define('DENOMINATION_10c', true); 
defined('DENOMINATION_5c')      OR define('DENOMINATION_5c', true); 
defined('DENOMINATION_1c')      OR define('DENOMINATION_1c', true); 