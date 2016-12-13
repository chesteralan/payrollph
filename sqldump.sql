-- Table structure for table `account_sessions` 

CREATE TABLE `account_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `account_sessions_timestamp` (`timestamp`)
);

-- Table structure for table `accounting_bankrecon` 

CREATE TABLE `accounting_bankrecon` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `chart_id` int(20) NOT NULL,
  `date_end` date NOT NULL,
  `balance_end` decimal(20,5) DEFAULT NULL,
  `memo` text NOT NULL,
  PRIMARY KEY (`id`)
);

-- Table structure for table `accounting_bankrecon_items` 

CREATE TABLE `accounting_bankrecon_items` (
  `entry_id` int(20) NOT NULL,
  `recon_id` int(20) NOT NULL,
  KEY `entry_id` (`entry_id`)
);

-- Table structure for table `accounting_charts` 

CREATE TABLE `accounting_charts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `number` int(7) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `parent` int(20) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `reconcile` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
);

-- Table structure for table `accounting_checks` 

CREATE TABLE `accounting_checks` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `chart_id` int(20) NOT NULL,
  `check_number` varchar(50) NOT NULL,
  `check_date` date NOT NULL,
  `name_id` int(20) NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `memo` text,
  `lines` int(2) NOT NULL DEFAULT '10',
  `trn_id` int(20) DEFAULT NULL,
  `cancelled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

-- Table structure for table `accounting_checks_items` 

CREATE TABLE `accounting_checks_items` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `check_id` int(20) NOT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `chart_id` int(20) NOT NULL,
  `name_id` int(20) DEFAULT NULL,
  `class_id` int(20) DEFAULT NULL,
  `amount` decimal(20,5) NOT NULL,
  `memo` text,
  `entry_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entry_id` (`entry_id`)
);

-- Table structure for table `accounting_deposits` 

CREATE TABLE `accounting_deposits` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `bank_id` int(20) NOT NULL,
  `date_deposited` date NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `memo` text NOT NULL,
  `trn_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Table structure for table `accounting_deposits_items` 

CREATE TABLE `accounting_deposits_items` (
  `entry_id` int(20) NOT NULL,
  `deposit_id` int(20) NOT NULL,
  UNIQUE KEY `entry_id_2` (`entry_id`),
  KEY `entry_id` (`entry_id`)
);

-- Table structure for table `accounting_entries` 

CREATE TABLE `accounting_entries` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `trn_id` int(20) NOT NULL,
  `chart_id` int(20) NOT NULL,
  `debit` decimal(20,5) DEFAULT '0.00000',
  `credit` decimal(20,5) DEFAULT '0.00000',
  `class` int(20) DEFAULT NULL,
  `name_id` int(20) DEFAULT NULL,
  `memo` varchar(200) DEFAULT NULL,
  `item_number` int(10) NOT NULL DEFAULT '0',
  `item_id` int(20) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name_id` (`name_id`)
);

-- Table structure for table `accounting_receipts` 

CREATE TABLE `accounting_receipts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_id` int(20) NOT NULL,
  `receipt_number` int(20) NOT NULL,
  `receipt_date` date NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `memo` text,
  `trn_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `receipt_number` (`receipt_number`)
);

-- Table structure for table `accounting_receipts_items` 

CREATE TABLE `accounting_receipts_items` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `receipt_id` int(20) NOT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `item_id` int(20) NOT NULL,
  `name_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `memo` text,
  `entry_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entry_id` (`entry_id`)
);

-- Table structure for table `accounting_transactions` 

CREATE TABLE `accounting_transactions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `dept` varchar(50) NOT NULL,
  `sect` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `memo` text,
  `number` varchar(100) DEFAULT NULL,
  `lines` int(99) DEFAULT NULL,
  `name_id` int(20) DEFAULT NULL,
  `amount` decimal(20,5) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Table structure for table `companies` 

CREATE TABLE `companies` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  KEY `id` (`id`)
);

-- Table structure for table `companies_members` 

CREATE TABLE `companies_members` (
  `company_id` int(20) NOT NULL,
  `member_id` int(20) NOT NULL,
  KEY `company_id` (`company_id`,`member_id`),
  KEY `member_id` (`member_id`)
);

-- Table structure for table `coop_lists` 

CREATE TABLE `coop_lists` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `dept` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `parent` int(20) NOT NULL,
  `value` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Table structure for table `coop_lists_options` 

CREATE TABLE `coop_lists_options` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `list_id` int(20) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `list_id` (`list_id`)
);

-- Table structure for table `coop_names` 

CREATE TABLE `coop_names` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_number` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `full_name` (`full_name`)
);

-- Table structure for table `coop_settings` 

CREATE TABLE `coop_settings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
);

-- Table structure for table `lending_invoices` 

CREATE TABLE `lending_invoices` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `loan_id` int(20) NOT NULL,
  `due_date` date NOT NULL,
  `principal_due` decimal(20,5) NOT NULL,
  `interest_due` decimal(20,5) NOT NULL,
  `number` int(2) DEFAULT NULL,
  `trn_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Table structure for table `lending_loans` 

CREATE TABLE `lending_loans` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `entry_id` int(20) DEFAULT NULL,
  `member_id` int(20) NOT NULL,
  `check_number` varchar(10) NOT NULL,
  `loan_date` date NOT NULL,
  `principal` decimal(20,5) NOT NULL,
  `payment_start` date NOT NULL,
  `interest_rate` float(10,5) NOT NULL DEFAULT '3.00000',
  `months` int(2) NOT NULL DEFAULT '1',
  `skip_days` int(2) NOT NULL DEFAULT '15',
  `interest_type` varchar(50) NOT NULL DEFAULT 'fixed',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `trn_id` int(20) DEFAULT NULL,
  `bank_id` int(20) DEFAULT NULL,
  `memo` text,
  `inactive` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
);

-- Table structure for table `lending_payment_applied` 

CREATE TABLE `lending_payment_applied` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `payment_id` int(20) NOT NULL,
  `invoice_id` int(20) NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Table structure for table `lending_payments` 

CREATE TABLE `lending_payments` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `entry_id` int(20) DEFAULT NULL,
  `member_id` int(20) NOT NULL,
  `receipt_number` int(20) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `trn_id` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entry_id` (`entry_id`)
);

-- Table structure for table `members` 

CREATE TABLE `members` (
  `id` int(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `active` int(20) NOT NULL DEFAULT '1',
  `gender` varchar(10) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace` varchar(50) DEFAULT NULL,
  `lastmod_by` int(20) DEFAULT NULL,
  `added_by` int(20) DEFAULT NULL,
  `phone_mobile` varchar(100) DEFAULT NULL,
  `phone_home` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  UNIQUE KEY `email` (`email`),
  KEY `id` (`id`),
  CONSTRAINT `coop_names_member_id` FOREIGN KEY (`id`) REFERENCES `coop_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for table `members_address` 

CREATE TABLE `members_address` (
  `mid` int(20) NOT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `building` varchar(100) DEFAULT NULL,
  `lot_block` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `subdivision` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  KEY `id` (`mid`),
  KEY `mid` (`mid`),
  CONSTRAINT `names_address_mid` FOREIGN KEY (`mid`) REFERENCES `coop_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for table `reports_saved` 

CREATE TABLE `reports_saved` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `filters` text NOT NULL,
  PRIMARY KEY (`id`)
);

-- Table structure for table `shares_capital` 

CREATE TABLE `shares_capital` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `entry_id` int(20) DEFAULT NULL,
  `member_id` int(20) NOT NULL,
  `receipt_number` int(20) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `trn_id` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `receipt_number` (`receipt_number`),
  UNIQUE KEY `entry_id` (`entry_id`)
);

-- Table structure for table `shares_dividend` 

CREATE TABLE `shares_dividend` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `res_number` int(20) NOT NULL,
  `res_date` date NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `trn_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `res_number` (`res_number`)
);

-- Table structure for table `shares_dividend_item` 

CREATE TABLE `shares_dividend_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dividend_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Table structure for table `shares_withdrawal` 

CREATE TABLE `shares_withdrawal` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `member_id` int(20) NOT NULL,
  `bank_id` int(20) NOT NULL,
  `check_number` varchar(100) NOT NULL,
  `check_date` date NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `memo` text,
  `trn_id` int(20) NOT NULL,
  `entry_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `check_number` (`check_number`),
  UNIQUE KEY `entry_id` (`entry_id`)
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

