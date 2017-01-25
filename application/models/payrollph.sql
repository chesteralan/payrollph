-- Table structure for table `account_sessions` 

CREATE TABLE `account_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `account_sessions_timestamp` (`timestamp`)
);

-- Table structure for table `employees` 

CREATE TABLE `employees` (
  `name_id` int(20) NOT NULL,
  `group_id` int(20) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `position_id` int(20) NOT NULL,
  `hired` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `notes` text,
  KEY `name_id` (`name_id`),
  KEY `group_id` (`group_id`),
  KEY `position_id` (`position_id`)
);

-- Table structure for table `employees_groups` 

CREATE TABLE `employees_groups` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Table structure for table `employees_positions` 

CREATE TABLE `employees_positions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `notes` text,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Table structure for table `names_list` 

CREATE TABLE `names_list` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_number` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `full_name` (`full_name`)
);

-- Table structure for table `payroll` 

CREATE TABLE `payroll` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `template_id` int(20) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
);

-- Table structure for table `payroll_templates` 

CREATE TABLE `payroll_templates` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
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

