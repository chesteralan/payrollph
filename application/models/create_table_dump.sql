CREATE TABLE `account_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `account_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `account_sessions` 

CREATE TABLE `benefits_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `leave` int(1) DEFAULT '0',
  `ee_account_title` varchar(200) DEFAULT NULL,
  `er_account_title` varchar(200) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `trash` int(1) DEFAULT '0',
  `abbr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin;

-- Table structure for table `benefits_list` 

CREATE TABLE `calendar` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `calendar_date` date NOT NULL,
  `is_holiday` int(1) NOT NULL DEFAULT '0',
  `holiday_type` int(20) NOT NULL DEFAULT '0',
  `premium` int(2) DEFAULT '0',
  `notes` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin;

-- Table structure for table `calendar` 

CREATE TABLE `companies_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `notes` text,
  `default` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin;

-- Table structure for table `companies_list` 

CREATE TABLE `companies_options` (
  `company_id` int(20) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `companies_options` 

CREATE TABLE `deductions_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `account_title` varchar(200) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `trash` int(1) DEFAULT '0',
  `abbr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin;

-- Table structure for table `deductions_list` 

CREATE TABLE `earnings_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `account_title` varchar(200) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `trash` int(1) DEFAULT '0',
  `abbr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin;

-- Table structure for table `earnings_list` 

CREATE TABLE `employees` (
  `name_id` int(20) NOT NULL,
  `company_id` int(20) NOT NULL,
  `group_id` int(20) DEFAULT NULL,
  `position_id` int(20) DEFAULT NULL,
  `area_id` int(20) DEFAULT NULL,
  `hired` date DEFAULT NULL,
  `status` int(20) DEFAULT NULL,
  `notes` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  `employee_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`name_id`),
  KEY `name_id` (`name_id`),
  KEY `group_id` (`group_id`),
  KEY `position_id` (`position_id`),
  KEY `area_id` (`area_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `employees` 

CREATE TABLE `employees_absences` (
  `name_id` int(20) NOT NULL,
  `date_absent` date NOT NULL,
  `hours` int(2) DEFAULT '8',
  `leave_type` int(20) DEFAULT NULL,
  `notes` text,
  `pe_id` int(20) DEFAULT NULL,
  KEY `name_id` (`name_id`,`date_absent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `employees_absences` 

CREATE TABLE `employees_areas` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `trash` int(1) NOT NULL DEFAULT '0',
  `notes` text,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin;

-- Table structure for table `employees_areas` 

CREATE TABLE `employees_attendance` (
  `name_id` int(20) NOT NULL,
  `date_present` date NOT NULL,
  `hours` int(2) DEFAULT '8',
  `notes` text,
  `pe_id` int(20) DEFAULT NULL,
  KEY `name_id` (`name_id`,`date_present`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `employees_attendance` 

CREATE TABLE `employees_benefits` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `employee_share` decimal(30,5) NOT NULL,
  `employer_share` decimal(30,5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `primary` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`benefit_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin;

-- Table structure for table `employees_benefits` 

CREATE TABLE `employees_benefits_templates` (
  `eb_id` int(20) NOT NULL,
  `template_id` int(20) NOT NULL,
  KEY `eb_id` (`eb_id`,`template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `employees_benefits_templates` 

CREATE TABLE `employees_contacts` (
  `name_id` int(20) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `cell_number` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  UNIQUE KEY `name_id` (`name_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `employees_contacts` 

CREATE TABLE `employees_deductions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL,
  `max_amount` decimal(30,5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `computed` varchar(10) DEFAULT '',
  `active` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`deduction_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin;

-- Table structure for table `employees_deductions` 

CREATE TABLE `employees_deductions_templates` (
  `ed_id` int(20) NOT NULL,
  `template_id` int(20) NOT NULL,
  KEY `ed_id` (`ed_id`,`template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `employees_deductions_templates` 

CREATE TABLE `employees_earnings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL,
  `max_amount` decimal(30,5) DEFAULT '0.00000',
  `start_date` date DEFAULT NULL,
  `computed` varchar(10) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '0',
  `notes` text,
  `multiplier` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`earning_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin;

-- Table structure for table `employees_earnings` 

CREATE TABLE `employees_earnings_templates` (
  `ee_id` int(20) NOT NULL,
  `template_id` int(20) NOT NULL,
  KEY `ee_id` (`ee_id`,`template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `employees_earnings_templates` 

CREATE TABLE `employees_groups` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin;

-- Table structure for table `employees_groups` 

CREATE TABLE `employees_leave_benefits` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `days` int(2) DEFAULT '0',
  `year` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`benefit_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin;

-- Table structure for table `employees_leave_benefits` 

CREATE TABLE `employees_positions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin;

-- Table structure for table `employees_positions` 

CREATE TABLE `employees_salaries` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL DEFAULT '0.00000',
  `rate_per` varchar(10) NOT NULL DEFAULT 'month',
  `days` int(10) NOT NULL DEFAULT '26',
  `annual_days` int(3) DEFAULT '312',
  `months` int(2) DEFAULT '12',
  `hours` int(10) NOT NULL DEFAULT '8',
  `cola` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `notes` text,
  `manner` varchar(50) NOT NULL DEFAULT 'daily',
  `primary` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin;

-- Table structure for table `employees_salaries` 

CREATE TABLE `names_info` (
  `name_id` int(20) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`name_id`),
  KEY `name_id` (`name_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `names_info` 

CREATE TABLE `names_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_number` varchar(200) DEFAULT NULL,
  `trash` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `full_name` (`full_name`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin;

-- Table structure for table `names_list` 

CREATE TABLE `names_meta` (
  `meta_id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `meta_key` varchar(200) NOT NULL,
  `meta_value` text,
  PRIMARY KEY (`meta_id`),
  KEY `name_id` (`name_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin;

-- Table structure for table `names_meta` 

CREATE TABLE `payroll` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `template_id` int(20) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `lock` int(1) DEFAULT '0',
  `print_format` varchar(50) DEFAULT NULL,
  `group_by` varchar(50) NOT NULL DEFAULT 'group',
  `checked_by` int(20) DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin;

-- Table structure for table `payroll` 

CREATE TABLE `payroll_benefits` (
  `payroll_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `benefit_id` (`payroll_id`,`benefit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_benefits` 

CREATE TABLE `payroll_deductions` (
  `payroll_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `deduction_id` (`payroll_id`,`deduction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_deductions` 

CREATE TABLE `payroll_earnings` (
  `payroll_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `earning_id` (`payroll_id`,`earning_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_earnings` 

CREATE TABLE `payroll_employees` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  `payslip` varchar(20) DEFAULT 'payslip',
  `template` varchar(20) DEFAULT 'payslip',
  `print_group` int(20) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `status_id` int(20) DEFAULT NULL,
  `group_id` int(20) DEFAULT NULL,
  `position_id` int(20) DEFAULT NULL,
  `area_id` int(20) DEFAULT NULL,
  `manual` int(1) NOT NULL DEFAULT '0',
  `presence` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`payroll_id`,`name_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin;

-- Table structure for table `payroll_employees` 

CREATE TABLE `payroll_employees_benefits` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `pe_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `entry_id` int(20) NOT NULL,
  `employee_share` decimal(30,5) DEFAULT '0.00000',
  `employer_share` decimal(30,5) DEFAULT '0.00000',
  `notes` text,
  `manual` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`),
  KEY `benefit_id` (`benefit_id`),
  KEY `entry_id` (`entry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin;

-- Table structure for table `payroll_employees_benefits` 

CREATE TABLE `payroll_employees_deductions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `pe_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `entry_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL,
  `notes` text,
  `manual` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`payroll_id`,`deduction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin;

-- Table structure for table `payroll_employees_deductions` 

CREATE TABLE `payroll_employees_earnings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `pe_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `entry_id` int(20) NOT NULL,
  `amount` decimal(30,5) NOT NULL,
  `notes` text,
  `manual` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`payroll_id`,`earning_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin;

-- Table structure for table `payroll_employees_earnings` 

CREATE TABLE `payroll_employees_salaries` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `pe_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `salary_id` int(20) NOT NULL,
  `amount` decimal(30,5) DEFAULT '0.00000',
  `notes` text,
  `manner` varchar(50) NOT NULL DEFAULT 'daily',
  `rate_per` varchar(10) DEFAULT 'month',
  `days` int(10) DEFAULT '26',
  `hours` int(10) DEFAULT '8',
  `cola` decimal(10,5) DEFAULT '0.00000',
  `annual_days` int(3) DEFAULT '312',
  `months` int(2) DEFAULT '12',
  `manual` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`),
  KEY `payroll_id` (`payroll_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin;

-- Table structure for table `payroll_employees_salaries` 

CREATE TABLE `payroll_groups` (
  `payroll_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL DEFAULT '0',
  `area_id` int(20) NOT NULL DEFAULT '0',
  `position_id` int(20) NOT NULL DEFAULT '0',
  `status_id` int(20) NOT NULL DEFAULT '0',
  `order` int(2) NOT NULL DEFAULT '0',
  `page` int(2) DEFAULT '1',
  KEY `group_id` (`payroll_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_groups` 

CREATE TABLE `payroll_inclusive_dates` (
  `payroll_id` int(20) NOT NULL,
  `inclusive_date` date NOT NULL,
  KEY `payroll_id` (`payroll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_inclusive_dates` 

CREATE TABLE `payroll_templates` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pages` int(2) DEFAULT '1',
  `checked_by` int(20) DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL,
  `print_format` varchar(50) DEFAULT NULL,
  `group_by` varchar(50) NOT NULL DEFAULT 'group',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `checked_by` (`checked_by`,`approved_by`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin;

-- Table structure for table `payroll_templates` 

CREATE TABLE `payroll_templates_benefits` (
  `template_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `benefit_id` (`template_id`,`benefit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_templates_benefits` 

CREATE TABLE `payroll_templates_columns` (
  `template_id` int(20) NOT NULL,
  `term_id` int(20) NOT NULL,
  `column_id` varchar(200) NOT NULL,
  KEY `term_id` (`term_id`,`template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_templates_columns` 

CREATE TABLE `payroll_templates_deductions` (
  `template_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `deduction_id` (`template_id`,`deduction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_templates_deductions` 

CREATE TABLE `payroll_templates_earnings` (
  `template_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `earning_id` (`template_id`,`earning_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_templates_earnings` 

CREATE TABLE `payroll_templates_employees` (
  `template_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  `template` varchar(20) DEFAULT 'payslip',
  `print_group` int(20) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `status_id` int(20) DEFAULT NULL,
  `group_id` int(20) DEFAULT NULL,
  `position_id` int(20) DEFAULT NULL,
  `area_id` int(20) DEFAULT NULL,
  KEY `name_id` (`template_id`,`name_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_templates_employees` 

CREATE TABLE `payroll_templates_groups` (
  `template_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL DEFAULT '0',
  `area_id` int(20) NOT NULL DEFAULT '0',
  `position_id` int(20) NOT NULL DEFAULT '0',
  `status_id` int(20) NOT NULL DEFAULT '0',
  `order` int(2) NOT NULL DEFAULT '0',
  `page` int(2) DEFAULT '1',
  KEY `template_id` (`template_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `payroll_templates_groups` 

CREATE TABLE `system_audit` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `dept` varchar(200) NOT NULL,
  `sect` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `company_id` int(20) DEFAULT NULL,
  `name_id` int(20) DEFAULT '0',
  `notes` text,
  `date_accessed` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin;

-- Table structure for table `system_audit` 

CREATE TABLE `terms_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `type` varchar(50) DEFAULT NULL,
  `trash` int(1) DEFAULT '0',
  `priority` int(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin;

-- Table structure for table `terms_list` 

CREATE TABLE `user_accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin;

-- Table structure for table `user_accounts` 

CREATE TABLE `user_accounts_companies` (
  `uid` int(20) NOT NULL,
  `company_id` int(20) NOT NULL,
  KEY `uid` (`uid`,`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `user_accounts_companies` 

CREATE TABLE `user_accounts_options` (
  `uid` int(20) NOT NULL,
  `department` varchar(200) NOT NULL,
  `section` varchar(200) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `user_accounts_options` 

CREATE TABLE `user_accounts_restrictions` (
  `uid` int(20) NOT NULL,
  `department` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `view` int(1) NOT NULL DEFAULT '0',
  `add` int(1) NOT NULL DEFAULT '0',
  `edit` int(1) NOT NULL DEFAULT '0',
  `delete` int(1) NOT NULL DEFAULT '0',
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin;

-- Table structure for table `user_accounts_restrictions` 

