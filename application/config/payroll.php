<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['multi_company'] = true;

defined('APP_NAME') OR define('APP_NAME', 'SMB Payroll' );
$config['system_name'] = 'SMB Payroll';

$config['online_payroll'] = true;

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
defined('WORK_ON_SUN')      OR define('WORK_ON_SUN', false); 
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
) ));