-- Table structure for table `account_sessions` 

CREATE TABLE `account_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `account_sessions_timestamp` (`timestamp`)
);

-- Table structure for table `benefits_list` 

CREATE TABLE `benefits_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `leave` int(1) DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Table structure for table `deductions_list` 

CREATE TABLE `deductions_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Table structure for table `earnings_list` 

CREATE TABLE `earnings_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Table structure for table `employees` 

CREATE TABLE `employees` (
  `name_id` int(20) NOT NULL,
  `group_id` int(20) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `position_id` int(20) DEFAULT NULL,
  `hired` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `notes` text,
  `phone_number` varchar(100) DEFAULT NULL,
  `address` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  KEY `name_id` (`name_id`),
  KEY `group_id` (`group_id`),
  KEY `position_id` (`position_id`)
);

-- Table structure for table `employees_absenses` 

CREATE TABLE `employees_absenses` (
  `name_id` int(20) NOT NULL,
  `date_absent` date NOT NULL,
  `leave_type` int(20) DEFAULT NULL,
  KEY `name_id` (`name_id`,`date_absent`)
);

-- Table structure for table `employees_benefits` 

CREATE TABLE `employees_benefits` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `employee_share` decimal(10,5) NOT NULL,
  `employer_share` decimal(10,5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `primary` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`benefit_id`)
);

-- Table structure for table `employees_deductions` 

CREATE TABLE `employees_deductions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `amount` decimal(10,5) NOT NULL,
  `max_amount` decimal(10,5) DEFAULT '0.00000',
  `start_date` date DEFAULT NULL,
  `computed` varchar(10) DEFAULT '',
  `active` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`deduction_id`)
);

-- Table structure for table `employees_earnings` 

CREATE TABLE `employees_earnings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `amount` decimal(10,5) NOT NULL,
  `max_amount` decimal(10,5) DEFAULT '0.00000',
  `start_date` date DEFAULT NULL,
  `computed` varchar(10) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '0',
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`earning_id`)
);

-- Table structure for table `employees_groups` 

CREATE TABLE `employees_groups` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

-- Table structure for table `employees_positions` 

CREATE TABLE `employees_positions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `trash` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

-- Table structure for table `employees_salaries` 

CREATE TABLE `employees_salaries` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `amount` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `rate_per` varchar(10) NOT NULL DEFAULT 'month',
  `days` int(10) NOT NULL DEFAULT '26',
  `hours` int(10) NOT NULL DEFAULT '8',
  `cola` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `notes` text,
  `primary` int(1) DEFAULT '0',
  `trash` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`)
);

-- Table structure for table `names_list` 

CREATE TABLE `names_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_number` varchar(200) DEFAULT NULL,
  `trash` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `full_name` (`full_name`)
);

-- Table structure for table `payroll` 

CREATE TABLE `payroll` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `template_id` int(20) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
);

-- Table structure for table `payroll_benefits` 

CREATE TABLE `payroll_benefits` (
  `payroll_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `benefit_id` (`payroll_id`,`benefit_id`)
);

-- Table structure for table `payroll_deductions` 

CREATE TABLE `payroll_deductions` (
  `payroll_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `deduction_id` (`payroll_id`,`deduction_id`)
);

-- Table structure for table `payroll_earnings` 

CREATE TABLE `payroll_earnings` (
  `payroll_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `earning_id` (`payroll_id`,`earning_id`)
);

-- Table structure for table `payroll_employees` 

CREATE TABLE `payroll_employees` (
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `name_id` (`payroll_id`,`name_id`)
);

-- Table structure for table `payroll_employees_benefits` 

CREATE TABLE `payroll_employees_benefits` (
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `employee_share` decimal(10,5) DEFAULT '0.00000',
  `employer_share` decimal(10,5) DEFAULT '0.00000',
  `notes` text,
  KEY `name_id` (`name_id`),
  KEY `benefit_id` (`benefit_id`)
);

-- Table structure for table `payroll_employees_deductions` 

CREATE TABLE `payroll_employees_deductions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `entry_id` int(20) NOT NULL,
  `amount` decimal(10,5) NOT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`payroll_id`,`deduction_id`)
);

-- Table structure for table `payroll_employees_earnings` 

CREATE TABLE `payroll_employees_earnings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `entry_id` int(20) NOT NULL,
  `amount` decimal(10,5) NOT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`,`payroll_id`,`earning_id`)
);

-- Table structure for table `payroll_employees_salaries` 

CREATE TABLE `payroll_employees_salaries` (
  `payroll_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `salary_id` int(20) NOT NULL,
  `amount` decimal(10,5) DEFAULT '0.00000',
  `notes` text,
  KEY `name_id` (`name_id`),
  KEY `payroll_id` (`payroll_id`)
);

-- Table structure for table `payroll_groups` 

CREATE TABLE `payroll_groups` (
  `payroll_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `group_id` (`payroll_id`,`group_id`)
);

-- Table structure for table `payroll_inclusive_dates` 

CREATE TABLE `payroll_inclusive_dates` (
  `payroll_id` int(20) NOT NULL,
  `inclusive_date` date NOT NULL,
  KEY `payroll_id` (`payroll_id`)
);

-- Table structure for table `payroll_templates` 

CREATE TABLE `payroll_templates` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `company_address` varchar(200) DEFAULT NULL,
  `company_contacts` varchar(200) DEFAULT NULL,
  `checked_by` int(20) DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `checked_by` (`checked_by`,`approved_by`)
);

-- Table structure for table `payroll_templates_benefits` 

CREATE TABLE `payroll_templates_benefits` (
  `template_id` int(20) NOT NULL,
  `benefit_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `benefit_id` (`template_id`,`benefit_id`)
);

-- Table structure for table `payroll_templates_deductions` 

CREATE TABLE `payroll_templates_deductions` (
  `template_id` int(20) NOT NULL,
  `deduction_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `deduction_id` (`template_id`,`deduction_id`)
);

-- Table structure for table `payroll_templates_earnings` 

CREATE TABLE `payroll_templates_earnings` (
  `template_id` int(20) NOT NULL,
  `earning_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `earning_id` (`template_id`,`earning_id`)
);

-- Table structure for table `payroll_templates_groups` 

CREATE TABLE `payroll_templates_groups` (
  `template_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL,
  `order` int(2) NOT NULL DEFAULT '0',
  KEY `template_id` (`template_id`,`group_id`)
);

-- Table structure for table `user_accounts` 

CREATE TABLE `user_accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`)
);

-- Table structure for table `user_accounts_options` 

CREATE TABLE `user_accounts_options` (
  `uid` int(20) NOT NULL,
  `department` varchar(200) NOT NULL,
  `section` varchar(200) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  KEY `uid` (`uid`)
);

-- Table structure for table `user_accounts_restrictions` 

CREATE TABLE `user_accounts_restrictions` (
  `uid` int(20) NOT NULL,
  `department` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `view` int(1) NOT NULL DEFAULT '0',
  `add` int(1) NOT NULL DEFAULT '0',
  `edit` int(1) NOT NULL DEFAULT '0',
  `delete` int(1) NOT NULL DEFAULT '0',
  KEY `uid` (`uid`)
);

