-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 10, 2018 at 07:55 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payrollph`
--

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `username`, `password`, `name`) VALUES
(1, 'alchie', '941533a479a78dd89e3dacb0b38641809ed5bfcd', 'Alchie'),
(2, 'admin', '941533a479a78dd89e3dacb0b38641809ed5bfcd', 'Admin');

--
-- Dumping data for table `user_accounts_restrictions`
--

INSERT INTO `user_accounts_restrictions` (`uid`, `department`, `section`, `view`, `add`, `edit`, `delete`) VALUES
(1, 'system', 'users', 1, 1, 1, 1),
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
(2, 'system', 'companies', 1, 1, 1, 1),
(2, 'system', 'terms', 1, 1, 1, 1),
(2, 'system', 'users', 1, 1, 1, 1),
(2, 'system', 'database', 1, 1, 1, 1),
(2, 'developer_tools', 'themes', 1, 1, 1, 1),
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
(1, 'system', 'companies', 1, 1, 1, 1),
(1, 'system', 'terms', 1, 1, 1, 1),
(1, 'system', 'database', 1, 1, 1, 1),
(1, 'developer_tools', 'themes', 1, 1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
