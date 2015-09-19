-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: fsi.afxcreates.com
-- Generation Time: Aug 29, 2015 at 12:43 PM
-- Server version: 5.1.56
-- PHP Version: 5.6.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fsi_production`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `action` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `allow` tinyint(1) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `deleted_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_type_id`, `user_id`, `priority`, `action`, `allow`, `deleted`, `deleted_date`) VALUES
(1, 1, NULL, 1, '.', 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_category_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `other` text,
  `vertical_img` varchar(255) DEFAULT NULL,
  `bg_img` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_category_id`, `name`, `description`, `other`, `vertical_img`, `bg_img`, `active`, `created`, `modified`) VALUES
(1, 1, 'Super Walmart', 'Design - Build - Install / 85,500 Sq. Ft. / Olympia, WA / 2016', 'Microsoft Bldg. 12345 / Redmond, WA / 2017\r\nThe Ivory Tower / Seattle, WA / 2015', 'in_prog_vert.jpg', 'in_prog_bg.jpg', 1, '2015-07-23 18:13:17', '2015-07-23 19:20:35'),
(2, 2, 'Cabella''s', 'Design - Build - Install / 7,500 Sq. Ft. / Lacey, WA / 2013', 'Microsoft Bldg. 12345 / Redmond, WA / 2011\r\nThe Ivory Tower / Seattle, WA / 2012', 'cabelas_vert.jpg', 'cabelas_bg.jpg', 1, '2015-07-23 18:13:44', '2015-07-23 19:20:54'),
(3, 3, 'Shorewood High School', 'Design - Build - Install / 25,500 Sq. Ft. / Shoreline, WA / 2011', 'Awesome Elemtary School / Redmond, WA / 2011\r\nSuper Awesome Middle School / Seattle, WA / 2012', 'shorewood_vert.jpg', 'shorewood_bg.jpg', 1, '2015-07-23 18:18:43', '2015-07-23 19:21:57'),
(4, 4, 'Belmont Apartments', 'Design - Build - Install / 25,500 Sq. Ft. / Seattle, WA / 2011', 'Awesome Building Upgrade / Port Townsend, WA / 2011\r\nSuper Awesome Building Upgrade / Battle Creek, WA / 2012', 'belmont_vert.jpg', 'belmont_bg.jpg', 1, '2015-07-23 18:19:34', '2015-07-23 19:22:18'),
(5, 5, 'Avalon Bay Apartments', 'Design - Build - Install / 25,500 Sq. Ft. / Seattle, WA / 2011', 'Awesome Multi-Unit Project / Port Townsend, WA / 2011\r\nSuper Awesome BMulti-Unit Project / Battle Creek, WA / 2012', 'avalon_vert.jpg', 'avalon_bg.jpg', 1, '2015-07-23 18:20:29', '2015-07-23 19:22:29'),
(6, 6, 'Valuable Protection', 'New Construction - Retrofit / Any Sq. Ft. / All of Washington', 'Ready to protect your home?\r\nCall us today for an estimate 253-826-0099', 'residential_vert.jpg', 'residential_bg.jpg', 1, '2015-07-23 18:21:48', '2015-07-23 19:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE IF NOT EXISTS `project_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`id`, `name`, `slug`, `icon`, `sort`, `created`, `modified`) VALUES
(1, 'In Progress', 'in-progress', 'in_prog_icon.png', 1, '2015-07-23 10:48:40', '2015-07-23 17:49:06'),
(2, 'Commercial', 'commercial', 'comm_icon.png', 2, '2015-07-23 10:49:15', '2015-07-23 10:49:15'),
(3, 'Education', 'education', 'edu_icon.png', 3, '2015-07-23 10:49:18', '2015-07-23 10:49:18'),
(4, 'Remediation', 'remediation', 'rem_icon.png', 4, '2015-07-23 10:49:20', '2015-07-23 10:49:20'),
(5, 'Multi-Unit', 'multi-unit', 'multi_icon.png', 5, '2015-07-23 10:49:22', '2015-07-23 10:49:22'),
(6, 'Residential', 'residential', 'res_icon.png', 6, '2015-07-23 10:49:24', '2015-07-23 10:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `file_info` text,
  `active` tinyint(1) DEFAULT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `creator_id` int(11) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `name`, `description`, `location`, `file_info`, `active`, `client_id`, `creator_id`, `created`, `modified`) VALUES
(18, 'ytytytytyty', 'dsaffadf fdsfadf dssff', NULL, 'mc_fsi_web_db_sow.pdf', NULL, 0, 17, '2015-08-23 21:48:26', '2015-08-24 22:31:01'),
(19, 'some report', 'inspection performed blah blah ipsum lorem roboticus', NULL, 'Aono-NOLTA2012-C1L-C5-9229.pdf', NULL, 0, 17, '2015-08-23 21:53:36', '2015-08-24 22:29:31'),
(23, 'test', 'blah blah', NULL, 'Tensors_TM2002211716.pdf', NULL, 0, 17, '2015-08-24 02:58:15', '2015-08-24 22:14:03'),
(24, 'file bizcard test', 'file test', NULL, '4up bizcards.pdf', NULL, 0, 26, '2015-08-24 04:25:35', '2015-08-24 04:25:35'),
(25, 'jdlksajfs', 'kljsfdf jsdlkfjds', NULL, 'Generic.pdf', NULL, 22, 17, '2015-08-24 17:47:46', '2015-08-24 17:47:46'),
(28, 'test', 'generic report', NULL, 'Generic.pdf', NULL, 22, 17, '2015-08-25 00:25:56', '2015-08-25 00:25:56'),
(29, 'anarchy', 'ameobas rule', NULL, '2015-06-amoeba-inspired-outperforms-conventional-optimization-methods-1.pdf', NULL, 58, 17, '2015-08-25 21:54:41', '2015-08-25 21:54:41'),
(30, 'customer test report', 'sprinklers spray', '212 Main St, Seattle, WA 98511', '2015-06-amoeba-inspired-outperforms-conventional-optimization-methods.pdf', NULL, 30, 17, '2015-08-25 22:40:41', '2015-08-25 22:40:41'),
(31, 'cussie', 'blah blah blah', '888 main st, olympia, wa 98502', 'mc_fsi_web_db_sow.pdf', NULL, 30, 17, '2015-08-26 00:51:35', '2015-08-26 00:51:35'),
(32, 'cussie', 'blah blah blah', '888 main st, olympia, wa 98502', 'mc_fsi_web_db_sow.pdf', NULL, 30, 17, '2015-08-26 00:53:40', '2015-08-26 00:53:40'),
(33, 'obtuse synchrony', 'inspection performed blah blah ipsum lorem roboticus', '333 Main St, Tacoma, WA 98666', 'mc_fsi_web_db_sow.pdf', NULL, 22, 17, '2015-08-26 16:42:29', '2015-08-26 16:42:29'),
(34, 'jc''s report', 'some report for a location for joel', '111 Main St, Tacoma, WA 98555', 'mc_fsi_web_db_sow.pdf', NULL, 65, 17, '2015-08-27 17:06:28', '2015-08-27 17:06:28'),
(35, 'a hikr report', 'ameobas rule', '43 12th Ave East, Port Angeles, WA 98362', '2015-06-amoeba-inspired-outperforms-conventional-optimization-methods-1.pdf', NULL, 64, 17, '2015-08-28 18:23:33', '2015-08-28 18:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `state` char(2) CHARACTER SET latin1 NOT NULL,
  `name` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state`, `name`) VALUES
('AK', 'Alaska'),
('AL', 'Alabama'),
('AR', 'Arkansas'),
('AZ', 'Arizona'),
('CA', 'California'),
('CO', 'Colorado'),
('CT', 'Connecticut'),
('DC', 'District of Columbia'),
('DE', 'Deleware'),
('FL', 'Florida'),
('GA', 'Georgia'),
('HI', 'Hawaii'),
('IA', 'Iowa'),
('ID', 'Idaho'),
('IL', 'Illinois'),
('IN', 'Indiana'),
('KS', 'Kansas'),
('KY', 'Kentucky'),
('LA', 'Louisiana'),
('MA', 'Massachusetts'),
('MD', 'Maryland'),
('ME', 'Maine'),
('MI', 'Michigan'),
('MN', 'Minnesota'),
('MO', 'Missouri'),
('MS', 'Mississippi'),
('MT', 'Montana'),
('NC', 'North Carolina'),
('ND', 'North Dakota'),
('NE', 'Nebraska'),
('NH', 'New Hampshire'),
('NJ', 'New Jersey'),
('NM', 'New Mexico'),
('NV', 'Nevada'),
('NY', 'New York'),
('OH', 'Ohio'),
('OK', 'Oklahoma'),
('OR', 'Oregon'),
('PA', 'Pennsylvania'),
('RI', 'Rhode Island'),
('SC', 'South Carolina'),
('SD', 'South Dakota'),
('TN', 'Tennessee'),
('TX', 'Texas'),
('UT', 'Utah'),
('VA', 'Virgina'),
('VT', 'Vermont'),
('WA', 'Washington'),
('WI', 'Wisconsin'),
('WV', 'West Virginia'),
('WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `user_status_id` int(11) NOT NULL,
  `first` varchar(255) DEFAULT NULL,
  `last` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `avatar` varchar(255) DEFAULT '',
  `pwd_reset_code` varchar(255) DEFAULT '',
  `pwd_reset_redirect` varchar(255) DEFAULT '',
  `last_login` datetime DEFAULT NULL,
  `total_logins` int(11) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` varchar(255) DEFAULT '',
  `deleted` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `hasher` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `user_status_id`, `first`, `last`, `email`, `password`, `avatar`, `pwd_reset_code`, `pwd_reset_redirect`, `last_login`, `total_logins`, `created`, `modified`, `modified_by`, `deleted`, `active`, `hasher`) VALUES
(4, 2, 1, 'Scott', 'Dahl', 'scottyd@afxcreates.com', '$2y$10$Tymog6UTC3gjpBA3cLdZF.HetKKBtvVY5dvkOhd1kLJv0CEfsPfsC', '', '', '', NULL, 0, '2015-07-12 04:46:21', '2015-07-12 04:46:21', '', NULL, 0, ''),
(17, 2, 1, 'michael', 'mccarron', 'm.j.h.mccarron@gmail.com', '$2y$10$se8Thh1wVlwVyXFQmAq5r.qzLq1G4tGxVXuiWvm9yAav6dmjPodSq', '', '', '', NULL, 0, '2015-08-22 19:52:37', '2015-08-27 21:07:45', '', NULL, 1, ''),
(22, 4, 1, 'generic', 'customer', 'customer@permissions.com', '$2y$10$UY9voCR/9/NAymdkyb5MTep4jxY4xr3Sl3/jF96eSdx04gCN9zt..', '', '', '', NULL, 0, '2015-08-23 15:58:11', '2015-08-23 15:58:11', '', NULL, 1, ''),
(23, 3, 1, 'joe ', 'worker', 'employee@fsi.com', '$2y$10$UCCFTmbUJF4TnX0fhKkhdOipDuDvufsLtX5QdSZ/BX9.3hV8A1SQq', '', '', '', NULL, 0, '2015-08-23 16:09:02', '2015-08-23 16:09:02', '', NULL, 1, ''),
(30, 4, 1, 'customer ', 'test', 'customer2@customer.com', '$2y$10$SBnSjEhUY1bRlNR8Bgqh5OvhX4QVkTgrKiSbXO65HXdKNxcDWViBS', '', '', '', NULL, 0, '2015-08-25 15:51:55', '2015-08-25 15:51:55', '', NULL, 1, ''),
(61, 3, 1, 'jane', 'worker', 'jane@worker.com', '$2y$10$fa8tiNYmnz86Ge4jf2YjU.GwhWeGXKJ1cWNpZGBweX7vt9C6hfzWW', '', '', '', NULL, 0, '2015-08-26 00:45:22', '2015-08-26 00:45:22', '', NULL, 1, ''),
(63, 2, 1, 'system', 'administrator', 'systemadmin@fsi.com', '$2y$10$6IgS0Iy6tmic1vtWbHWFVuozZe9ju.KhtPnYGnqeqawC7JhVOPAvu', '', '', '', NULL, 0, '2015-08-27 00:32:52', '2015-08-27 00:32:52', '', NULL, 1, ''),
(64, 4, 1, 'a', 'hiker', 'anarchist.hiker@gmail.com', '$2y$10$c3C8jn383AxDMNQnoOJsCeEQ46cAeuAjWuVFncsCBr.Y/Au3Eubn.', '', '', '', NULL, 0, '2015-08-27 16:12:14', '2015-08-27 21:00:26', '', NULL, 1, ''),
(65, 4, 1, 'Joel', 'Chrisman', 'joelc@afxfirm.com', '$2y$10$d8vyzvknaWzZzD6h/Tupce2Z6oUXAFAkR6dWAoUcXP.dpeJ911YOC', '', '', '', NULL, 0, '2015-08-27 17:03:48', '2015-08-27 17:03:48', '', NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE IF NOT EXISTS `user_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `deleted_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `name`, `deleted`, `deleted_date`) VALUES
(1, 'Active', 0, '0000-00-00 00:00:00'),
(2, 'Deleted', 0, '0000-00-00 00:00:00'),
(3, 'Blacklisted', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `deleted_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `deleted`, `deleted_date`) VALUES
(1, 'Developer', 0, '0000-00-00 00:00:00'),
(2, 'Administrator', 0, '0000-00-00 00:00:00'),
(3, 'Employee', 0, '0000-00-00 00:00:00'),
(4, 'Customer', 0, '0000-00-00 00:00:00'),
(5, 'Offline User', 0, '0000-00-00 00:00:00');
