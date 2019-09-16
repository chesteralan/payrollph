INSERT INTO `user_accounts` (`id`, `username`, `password`, `name`) VALUES
(1, 'alchie', '941533a479a78dd89e3dacb0b38641809ed5bfcd', 'Alchie'),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin');

INSERT INTO `user_accounts_restrictions` (`uid`, `department`, `section`, `view`, `add`, `edit`, `delete`) VALUES
(1, 'system', 'users', 1, 1, 1, 1),
(1, 'payroll', 'payroll', 1, 1, 1, 1),
(1, 'payroll', 'templates', 1, 1, 1, 1),
(1, 'employees', 'employees', 1, 1, 1, 1),
(1, 'employees', 'groups', 1, 1, 1, 1),
(1, 'employees', 'positions', 1, 1, 1, 1),
(1, 'employees', 'areas', 1, 1, 1, 1),
(1, 'lists', 'names', 1, 1, 1, 1),
(1, 'lists', 'benefits', 1, 1, 1, 1),
(1, 'lists', 'earnings', 1, 1, 1, 1),
(1, 'lists', 'deductions', 1, 1, 1, 1),
(1, 'system', 'audit', 1, 1, 1, 1),
(1, 'system', 'calendar', 1, 1, 1, 1),
(1, 'system', 'companies', 1, 1, 1, 1),
(1, 'system', 'terms', 1, 1, 1, 1),
(1, 'system', 'database', 1, 1, 1, 1),
(1, 'developer_tools', 'themes', 1, 1, 1, 1),
(1, 'reports', '13month', 1, 1, 1, 1),
(2, 'system', 'users', 1, 1, 1, 1),
(2, 'payroll', 'payroll', 1, 1, 1, 1),
(2, 'payroll', 'templates', 1, 1, 1, 1),
(2, 'employees', 'employees', 1, 1, 1, 1),
(2, 'employees', 'groups', 1, 1, 1, 1),
(2, 'employees', 'positions', 1, 1, 1, 1),
(2, 'employees', 'areas', 1, 1, 1, 1),
(2, 'lists', 'names', 1, 1, 1, 1),
(2, 'lists', 'benefits', 1, 1, 1, 1),
(2, 'lists', 'earnings', 1, 1, 1, 1),
(2, 'lists', 'deductions', 1, 1, 1, 1),
(2, 'system', 'audit', 1, 1, 1, 1),
(2, 'system', 'calendar', 1, 1, 1, 1),
(2, 'system', 'companies', 1, 1, 1, 1),
(2, 'system', 'terms', 1, 1, 1, 1),
(2, 'system', 'database', 1, 1, 1, 1),
(2, 'developer_tools', 'themes', 1, 1, 1, 1),
(2, 'reports', '13month', 1, 1, 1, 1);

INSERT INTO `companies_list` (`id`, `theme`, `name`, `address`, `phone`, `notes`, `default`, `trash`) VALUES (1, 'united', 'Default Company', '{company address}', '{company phone}', 'change the details of this company', 1, 0);

INSERT INTO `user_accounts_companies` (`uid`, `company_id`) VALUES (1, 1);
INSERT INTO `user_accounts_companies` (`uid`, `company_id`) VALUES (2, 1);




INSERT INTO `payroll_templates` (`id`, `company_id`, `name`, `pages`, `checked_by`, `approved_by`, `print_format`, `group_by`, `active`, `payroll_id`) VALUES
(1, 1, 'Default Template', 1, 0, 0, NULL, 'group', 1, NULL);

INSERT INTO `benefits_list` (`id`, `name`, `notes`, `leave`, `ee_account_title`, `er_account_title`, `active`, `trash`, `abbr`) VALUES
(1, 'Default Benefit', '{Change / Delete this}', 0, '', '', 1, 0, '');

INSERT INTO `deductions_list` (`id`, `name`, `notes`, `account_title`, `active`, `trash`, `abbr`) VALUES
(1, 'Default Deduction', '{Change / Delete this}', '', 1, 0, '');

INSERT INTO `earnings_list` (`id`, `name`, `notes`, `account_title`, `active`, `trash`, `abbr`) VALUES
(1, 'Default Earning', '{Change / Delete this}', '', 1, 0, '');

INSERT INTO `employees_areas` (`id`, `company_id`, `trash`, `notes`, `name`) VALUES
(1, 1, 0, '{Change / Delete this}', 'Default Area');

INSERT INTO `employees_groups` (`id`, `company_id`, `name`, `notes`, `trash`) VALUES
(1, 1, 'Default Group', '{Change / Delete this}', 0);

INSERT INTO `employees_positions` (`id`, `company_id`, `name`, `notes`, `trash`) VALUES
(1, 1, 'Default Position', '{Change / Delete this}', 0);