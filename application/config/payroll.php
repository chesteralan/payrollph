<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['multi_company'] = true;

$config['system_name'] = 'Payroll PH';

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