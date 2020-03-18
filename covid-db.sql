-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2020 at 01:22 AM
-- Server version: 5.6.45
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamioss_covid`
--

-- --------------------------------------------------------

--
-- Table structure for table `19_access_keys`
--

CREATE TABLE `19_access_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_access_keys`
--

INSERT INTO `19_access_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'kswo8cwwc0gks8gc4o4cckgwgsc0og088gwgks880c8o84kog4080k8gksow84cs', 1, 0, 0, NULL, 1584455081),
(2, 2, 'c0s44ogssg8s8wswcs80g8ccso8cgg880w4884cowg088kkkgkw8g4840w4c8ckc', 1, 0, 0, NULL, 1584455671),
(3, 1, '84o44g8scw4sowgws0koskskcowgc4sk4wg4gsg808s4wkwos0ks84co88g0go8s', 1, 0, 0, NULL, 1584504305),
(4, 96, 'wo4s8ggkwkws0o0480oss8ckoww8888kkskwsow8kc0sw4cgko80kc0k80g0gkwc', 1, 0, 0, NULL, 1584504431);

-- --------------------------------------------------------

--
-- Table structure for table `19_access_limits`
--

CREATE TABLE `19_access_limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_access_limits`
--

INSERT INTO `19_access_limits` (`id`, `uri`, `count`, `hour_started`, `api_key`) VALUES
(1, 'api-key:kswo8cwwc0gks8gc4o4cckgwgsc0og088gwgks880c8o84kog4080k8gksow84cs', 3, 1584455109, 'kswo8cwwc0gks8gc4o4cckgwgsc0og088gwgks880c8o84kog4080k8gksow84cs'),
(2, 'api-key:c0s44ogssg8s8wswcs80g8ccso8cgg880w4884cowg088kkkgkw8g4840w4c8ckc', 4, 1584455682, 'c0s44ogssg8s8wswcs80g8ccso8cgg880w4884cowg088kkkgkw8g4840w4c8ckc'),
(3, 'api-key:84o44g8scw4sowgws0koskskcowgc4sk4wg4gsg808s4wkwos0ks84co88g0go8s', 1, 1584504315, '84o44g8scw4sowgws0koskskcowgc4sk4wg4gsg808s4wkwos0ks84co88g0go8s'),
(4, 'api-key:wo4s8ggkwkws0o0480oss8ckoww8888kkskwsow8kc0sw4cgko80kc0k80g0gkwc', 7, 1584504432, 'wo4s8ggkwkws0o0480oss8ckoww8888kkskwsow8kc0sw4cgko80kc0k80g0gkwc');

-- --------------------------------------------------------

--
-- Table structure for table `19_chcs`
--

CREATE TABLE `19_chcs` (
  `chc_id` int(11) NOT NULL,
  `phc_id` int(11) NOT NULL,
  `panchayat_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `chc_name` text NOT NULL,
  `chc_name_mal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_chcs`
--

INSERT INTO `19_chcs` (`chc_id`, `phc_id`, `panchayat_id`, `district_id`, `chc_name`, `chc_name_mal`) VALUES
(1, 0, 1, 1, 'chc1', ''),
(2, 0, 2, 1, 'chc2', ''),
(3, 0, 4, 2, 'chc2', '');

-- --------------------------------------------------------

--
-- Table structure for table `19_custom_info`
--

CREATE TABLE `19_custom_info` (
  `id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `field_name` text NOT NULL,
  `field_name_mal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `19_custom_info_options`
--

CREATE TABLE `19_custom_info_options` (
  `custom_option_id` int(11) NOT NULL,
  `custom_info_id` int(11) NOT NULL,
  `custom_option` mediumtext NOT NULL,
  `custom_option_mal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `19_districts`
--

CREATE TABLE `19_districts` (
  `district_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_name` varchar(200) NOT NULL,
  `district_name_mal` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_districts`
--

INSERT INTO `19_districts` (`district_id`, `state_id`, `district_name`, `district_name_mal`) VALUES
(1, 1, 'kozhikode', ''),
(2, 1, 'Wynad', ''),
(3, 1, 'Kannur', ''),
(4, 2, 'Selam', ''),
(5, 2, 'trichi\r\n\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `19_level_user_type`
--

CREATE TABLE `19_level_user_type` (
  `level_type_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level_id` int(11) NOT NULL,
  `menu_permitted` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_level_user_type`
--

INSERT INTO `19_level_user_type` (`level_type_id`, `name`, `level_id`, `menu_permitted`) VALUES
(1, 'user', 0, '[\"1\",\"2\",\"3\",\"4\"]'),
(2, 'RRT', 4, ''),
(3, 'DC', 1, ''),
(4, 'PHC', 3, '[\"1\",\"2\",\"3\",\"4\"]');

-- --------------------------------------------------------

--
-- Table structure for table `19_login`
--

CREATE TABLE `19_login` (
  `login_id` bigint(20) NOT NULL,
  `mobile_no` varchar(13) NOT NULL COMMENT 'level users username',
  `password` varchar(300) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'yes',
  `last_login` datetime DEFAULT NULL,
  `level_user_type` int(11) NOT NULL DEFAULT '0',
  `registered_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_login`
--

INSERT INTO `19_login` (`login_id`, `mobile_no`, `password`, `status`, `last_login`, `level_user_type`, `registered_by`) VALUES
(1, 'rrtlogin1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', '2020-03-18 04:25:49', 4, 0),
(2, 'rrt2', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', '2020-03-17 14:34:31', 4, 0),
(3, 'rrt3', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', '2020-03-17 16:00:19', 4, 0),
(4, 'rrt4', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(5, 'rrt5', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(6, 'rrt6', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(7, 'rrt7', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(8, 'rrt8', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(9, 'rrt9', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(10, 'rrt10', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(11, 'rrt11', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(12, 'rrt12', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(13, 'rrt13', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(14, '7543566734', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 3),
(15, 'rrt16', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(16, 'rrt17', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(17, 'rrt18', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(18, 'rrt19', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(19, 'rrt20', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(20, 'rrt21', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(21, 'rrt22', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(22, 'rrt23', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(23, 'rrt24', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(24, 'rrt25', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(25, 'rrt15', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(26, 'rrt15', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(27, 'rrt15', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(28, 'rrt15', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(29, 'rrt26', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(30, 'rrt15', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(31, 'rrt26', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(32, 'rrt27', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(33, 'rrt28', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(34, 'rrt29', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(35, 'rrt30', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(36, 'rrt31', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(37, 'rrt32', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(38, 'rrt33', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(39, 'rrt34', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(40, 'rrt35', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(41, 'rrt36', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(42, 'rrt37', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(43, 'rrt38', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(44, 'rrt39', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(45, 'rrt40', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(46, 'rrt41', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(47, 'rrt42', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(48, 'rrt43', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(49, 'rrt44', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(50, 'rrt45', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(51, 'rrt46', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(52, 'rrt47', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(53, 'rrt48', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(54, 'rrt49', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(55, 'rrt50', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(56, 'rrt51', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(57, 'rrt52', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(58, 'rrt53', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(59, 'rrt54', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(60, 'rrt55', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(61, 'rrt56', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(62, 'rrt57', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(63, 'rrt58', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(64, 'rrt59', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(65, 'rrt60', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(66, 'rrt61', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(67, 'rrt62', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(68, 'rrt63', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(69, 'rrt64', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(70, 'rrt65', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(71, 'rrt66', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(72, 'rrt67', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(73, 'rrt68', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(74, 'rrt69', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(75, 'rrt70', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(76, 'rrt71', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(77, 'rrt72', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(78, 'rrt73', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(79, 'rrt74', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(80, 'rrt75', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(81, 'rrt76', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(82, 'rrt77', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(83, 'rrt78', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(84, 'rrt79', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(85, 'rrt80', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 0),
(86, '9835467344', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 2),
(87, '9884027038', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 4, 1),
(88, '9844027037', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 2),
(89, '9884027036', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 2),
(90, '9941017037', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 2),
(91, '7263254323', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 1),
(92, '1234567891', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 1),
(93, '1234567892', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 1),
(94, '1323456789', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 1),
(95, '9834735463', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 1),
(96, '9846379456', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yes', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `19_menu`
--

CREATE TABLE `19_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `parent_id` varchar(2) NOT NULL,
  `link` varchar(150) NOT NULL,
  `target` varchar(10) DEFAULT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'yes',
  `menu_order` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_menu`
--

INSERT INTO `19_menu` (`menu_id`, `menu_name`, `parent_id`, `link`, `target`, `status`, `menu_order`) VALUES
(1, 'Home', '#', 'home/index', 'none', 'yes', 1),
(2, 'Register', '#', 'register/index', 'none', 'yes', 2),
(3, 'Logout', '#', 'login/logout', 'none', 'yes', 10),
(4, 'Report', '#', '', 'none', 'yes', 4),
(5, 'User Report', '4', 'report/user_report', NULL, 'yes', 1),
(6, 'Approve Symptoms', '#', 'approve/approve_symptoms', 'none', 'yes', 1),
(7, 'List Users', '#', 'home/registered_users', 'none', 'yes', 1),
(8, 'User Reprt', '#', 'excel/create_excel_user_data', 'none', 'yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `19_panchayat`
--

CREATE TABLE `19_panchayat` (
  `panchayat_id` int(8) NOT NULL,
  `district_id` int(2) NOT NULL,
  `panchayat_name` varchar(200) NOT NULL,
  `panchayat_name_mal` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_panchayat`
--

INSERT INTO `19_panchayat` (`panchayat_id`, `district_id`, `panchayat_name`, `panchayat_name_mal`) VALUES
(1, 1, 'Azhiyur', 'Azhiyur'),
(2, 1, 'Chorode', 'Chorode'),
(3, 1, 'Eramala', 'Eramala'),
(4, 1, 'Cheruvannur', 'Cheruvannur'),
(5, 1, 'Narikkuni', 'Narikkuni'),
(6, 1, 'Meladi', 'Narikkuni'),
(7, 1, 'Cherupa', 'Cherupa'),
(8, 1, 'Thiruvallur', 'Cheruvadi'),
(9, 1, 'Orkkatteri', 'Cheruvadi'),
(10, 1, 'Thiruvangoor', 'Cheruvadi'),
(11, 1, 'Ulliyeri', 'Cheruvadi'),
(12, 1, 'Valayam', 'Olavanna'),
(13, 1, 'Thiruvallur', 'Cheruvadi'),
(14, 1, 'Orkkatteri', 'Cheruvadi'),
(15, 1, 'Thiruvangoor', 'Cheruvadi'),
(16, 1, 'Ulliyeri', 'Cheruvadi'),
(17, 1, 'Valayam', 'Olavanna'),
(18, 1, 'Perambra', 'Perambra'),
(19, 1, 'Balussery', 'Balussery');

-- --------------------------------------------------------

--
-- Table structure for table `19_phcs`
--

CREATE TABLE `19_phcs` (
  `phc_id` int(11) NOT NULL,
  `panchayat_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `phc_name` text NOT NULL,
  `phc_name_mal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_phcs`
--

INSERT INTO `19_phcs` (`phc_id`, `panchayat_id`, `district_id`, `phc_name`, `phc_name_mal`) VALUES
(1, 4, 1, 'CHC Cheruvannur', 'CHC Cheruvannur');

-- --------------------------------------------------------

--
-- Table structure for table `19_questionnaire`
--

CREATE TABLE `19_questionnaire` (
  `id` int(11) NOT NULL,
  `cat_id` int(3) NOT NULL,
  `type` varchar(25) NOT NULL,
  `field_name` text NOT NULL,
  `field_name_mal` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_questionnaire`
--

INSERT INTO `19_questionnaire` (`id`, `cat_id`, `type`, `field_name`, `field_name_mal`, `status`) VALUES
(1, 1, 'text', 'Country of Visit/ Arrival', 'നിങ്ങൾ വിദേശയാത്ര നടത്തിയോ?', 1),
(2, 2, 'date', 'Date of arrival from affected country', 'യാത്രയ്ക്കുള്ള കാരണം?', 1),
(3, 1, 'date', 'Date of receipt of information that positive case', 'ബാധകമെങ്കിൽ എന്തെങ്കിലും തിരഞ്ഞെടുക്കുക', 1),
(4, 1, 'text', 'No. of children under 5 years at their home with contact history to person under isolation', '', 1),
(5, 1, 'text', 'No. of children 5-10 years at their home with contact history to person under isolation', '', 1),
(6, 1, 'text', 'No. of children 10-17 years at their home with contact history to person under isolation', '', 1),
(7, 1, 'radio', 'At home to not', '', 1),
(8, 1, 'radio', 'Sample taken or not', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `19_questionnaire_options`
--

CREATE TABLE `19_questionnaire_options` (
  `custom_option_id` int(11) NOT NULL,
  `custom_info_id` int(11) NOT NULL,
  `custom_option` mediumtext NOT NULL,
  `custom_option_mal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_questionnaire_options`
--

INSERT INTO `19_questionnaire_options` (`custom_option_id`, `custom_info_id`, `custom_option`, `custom_option_mal`) VALUES
(1, 1, 'yes', 'അതെ'),
(2, 1, 'no', 'ഇല്ല'),
(3, 3, 'cough', ''),
(4, 3, 'cold', ''),
(5, 7, 'yes', ''),
(6, 7, 'no', ''),
(7, 8, 'yes', ''),
(8, 8, 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `19_question_answers`
--

CREATE TABLE `19_question_answers` (
  `id` int(22) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `done_by` bigint(20) DEFAULT NULL,
  `question_1` text NOT NULL,
  `question_2` text CHARACTER SET latin1 NOT NULL,
  `question_3` varchar(200) CHARACTER SET latin1 NOT NULL,
  `question_4` text NOT NULL,
  `question_5` text NOT NULL,
  `question_6` text NOT NULL,
  `question_7` text NOT NULL,
  `question_8` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `19_question_category`
--

CREATE TABLE `19_question_category` (
  `id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `19_question_category`
--

INSERT INTO `19_question_category` (`id`, `category`) VALUES
(1, 'HR'),
(2, 'LR');

-- --------------------------------------------------------

--
-- Table structure for table `19_request_aid`
--

CREATE TABLE `19_request_aid` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL DEFAULT 'requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `19_states`
--

CREATE TABLE `19_states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_states`
--

INSERT INTO `19_states` (`state_id`, `state_name`) VALUES
(1, 'Kerala'),
(2, 'Tamilnaadu\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `19_symptoms`
--

CREATE TABLE `19_symptoms` (
  `id` int(3) NOT NULL,
  `symptom` text NOT NULL,
  `symptom_mal` text NOT NULL,
  `img_link` varchar(200) DEFAULT NULL,
  `score` int(3) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_symptoms`
--

INSERT INTO `19_symptoms` (`id`, `symptom`, `symptom_mal`, `img_link`, `score`, `status`) VALUES
(1, 'Fever', 'പനി', NULL, 0, 1),
(2, 'Cough', 'ചുമ', NULL, 0, 1),
(3, 'Running Nose', 'മൂക്കൊലിപ്പ്', NULL, 0, 1),
(4, 'Sore Throat', 'തൊണ്ടവേദന', NULL, 0, 1),
(5, 'Breathing Difficulty', 'ശ്വാസ തടസ്സം', NULL, 0, 1),
(6, 'Nausea / Vomiting / Diarrhoea', 'ഓക്കാനം / ഛർദ്ദി / വയറിളക്കം', NULL, 0, 1),
(7, 'Chronic Renal Failure/ CAD / Heart Failure', 'വൃക്ക സംബന്ധമായ രോഗം / CAD / ഹൃദയസ്തംഭനം', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `19_symptoms_updation_history`
--

CREATE TABLE `19_symptoms_updation_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `approval_l3` int(11) NOT NULL DEFAULT '0',
  `approval_l2` int(11) NOT NULL DEFAULT '0',
  `symptom_1` int(11) NOT NULL,
  `symptom_2` int(11) NOT NULL,
  `symptom_3` int(11) NOT NULL,
  `symptom_4` int(11) NOT NULL,
  `symptom_5` int(11) NOT NULL,
  `symptom_6` int(11) NOT NULL,
  `symptom_7` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `19_symptoms_updation_history`
--

INSERT INTO `19_symptoms_updation_history` (`id`, `user_id`, `date`, `approval_l3`, `approval_l2`, `symptom_1`, `symptom_2`, `symptom_3`, `symptom_4`, `symptom_5`, `symptom_6`, `symptom_7`) VALUES
(1, 3, '2020-03-17 14:14:25', 1, 1, 0, 0, 0, 0, 0, 0, 0),
(2, 4, '2020-03-17 14:24:59', 1, 1, 1, 0, 1, 0, 1, 0, 0),
(3, 4, '2020-03-17 14:26:05', 1, 1, 1, 0, 1, 0, 1, 0, 0),
(4, 5, '2020-03-17 14:33:00', 1, 1, 0, 1, 1, 1, 1, 0, 0),
(5, 11, '2020-03-17 15:42:59', 0, 0, 1, 0, 1, 0, 1, 0, 1),
(6, 11, '2020-03-17 15:49:42', 0, 0, 1, 0, 1, 0, 1, 1, 1),
(7, 12, '2020-03-18 04:07:41', 0, 0, 1, 0, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `19_symptom_approval_history`
--

CREATE TABLE `19_symptom_approval_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `sym_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `19_triage_history`
--

CREATE TABLE `19_triage_history` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `done_by` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `19_users`
--

CREATE TABLE `19_users` (
  `id` bigint(20) NOT NULL,
  `refer_login_id` int(11) NOT NULL DEFAULT '0',
  `login_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(2) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `panchayat_id` int(11) NOT NULL,
  `chc_id` int(11) NOT NULL DEFAULT '0',
  `village_id` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `contact_1` varchar(16) DEFAULT NULL,
  `contact_2` varchar(16) DEFAULT NULL,
  `contact_3` varchar(16) DEFAULT NULL,
  `health_status` varchar(2) NOT NULL DEFAULT 'P',
  `approve_3` int(3) NOT NULL DEFAULT '0',
  `approve_2` int(3) NOT NULL DEFAULT '0',
  `registered_by` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `vulnerability_status` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_users`
--

INSERT INTO `19_users` (`id`, `refer_login_id`, `login_id`, `name`, `gender`, `age`, `state_id`, `district_id`, `panchayat_id`, `chc_id`, `village_id`, `address`, `contact_1`, `contact_2`, `contact_3`, `health_status`, `approve_3`, `approve_2`, `registered_by`, `added_by`, `vulnerability_status`, `date_added`) VALUES
(4, 88, 88, 'Abhijith', 'male', 34, 1, 1, 1, 1, 0, 'test', '', '', '', 'P', 0, 0, 2, 2, '', '2020-03-17 14:24:34'),
(5, 89, 89, 'Abhijith', 'male', 34, 1, 1, 1, 1, 0, 'iiiii', '', '', '', 'P', 0, 0, 2, 2, '', '2020-03-17 14:28:33'),
(6, 90, 90, 'Bijil', 'male', 34, 1, 1, 1, 2, 0, 'test2', '', '', '', 'P', 0, 0, 2, 2, '', '2020-03-17 14:29:59'),
(7, 91, 91, 'Abhijith', 'male', 34, 1, 1, 1, 0, 0, 'test', '', '', '', 'P', 0, 0, 1, 1, '', '2020-03-17 14:43:05'),
(8, 92, 92, 'test1', 'male', 34, 1, 1, 1, 1, 0, 'test1', '', '', '', 'P', 0, 0, 1, 1, '', '2020-03-17 15:19:36'),
(9, 93, 93, 'test2', 'female', 25, 1, 1, 1, 1, 0, 'TEST', '', '', '', 'P', 0, 0, 1, 1, '', '2020-03-17 15:21:54'),
(10, 94, 94, 'TEST3', 'male', 63, 1, 1, 1, 1, 0, 'TGETS', '', '', '', 'P', 0, 0, 1, 1, '', '2020-03-17 15:22:34'),
(11, 95, 95, 'Abhitest', 'male', 45, 1, 1, 1, 1, 0, 'TEST3', '', '', '', 'P', 0, 0, 1, 1, '', '2020-03-17 15:40:19'),
(12, 96, 96, 'anjana', 'female', 26, 1, 1, 11, 1, 0, 'tsyysysy', '1231231231', '', '', 'P', 0, 0, 1, 1, '', '2020-03-18 04:07:11'),
(13, 0, 91, 'asdfgd', 'male', 22, 1, 1, 1, 1, 0, 'asdsad', '', '', '', 'P', 0, 0, 1, 1, 'no', '2020-03-18 05:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `19_user_custom_info`
--

CREATE TABLE `19_user_custom_info` (
  `user_id` bigint(20) NOT NULL,
  `sample_1` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `19_verification_history`
--

CREATE TABLE `19_verification_history` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `verified_by` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `19_villages`
--

CREATE TABLE `19_villages` (
  `village_id` int(13) NOT NULL,
  `panchayat_id` int(11) NOT NULL,
  `village_name` varchar(200) NOT NULL,
  `village_name_mal` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_villages`
--

INSERT INTO `19_villages` (`village_id`, `panchayat_id`, `village_name`, `village_name_mal`) VALUES
(1, 1, 'village1', ''),
(2, 1, 'village2', ''),
(3, 2, 'village21', ''),
(4, 2, 'village22', ''),
(5, 3, 'village31', ''),
(6, 3, 'village32', '');

-- --------------------------------------------------------

--
-- Table structure for table `19_vulnerability`
--

CREATE TABLE `19_vulnerability` (
  `id` int(3) NOT NULL,
  `name` text NOT NULL,
  `name_mal` text NOT NULL,
  `img_link` varchar(200) DEFAULT NULL,
  `score` int(3) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_vulnerability`
--

INSERT INTO `19_vulnerability` (`id`, `name`, `name_mal`, `img_link`, `score`, `status`) VALUES
(1, 'Cancer', 'കാൻസർ', NULL, 0, 1),
(2, 'HIV/AIDS', 'എച്ച്.ഐ.വി', NULL, 0, 1),
(3, 'Others', 'മറ്റുള്ളവ', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `19_vulnerability_updation_history`
--

CREATE TABLE `19_vulnerability_updation_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vulnerability_1` int(11) NOT NULL DEFAULT '0',
  `vulnerability_2` int(11) NOT NULL DEFAULT '0',
  `vulnerability_3` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `19_vulnerability_updation_history`
--

INSERT INTO `19_vulnerability_updation_history` (`id`, `user_id`, `vulnerability_1`, `vulnerability_2`, `vulnerability_3`, `date`) VALUES
(1, 91, 0, 0, 0, '2020-03-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `19_access_keys`
--
ALTER TABLE `19_access_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_access_limits`
--
ALTER TABLE `19_access_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_chcs`
--
ALTER TABLE `19_chcs`
  ADD PRIMARY KEY (`chc_id`);

--
-- Indexes for table `19_custom_info`
--
ALTER TABLE `19_custom_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_custom_info_options`
--
ALTER TABLE `19_custom_info_options`
  ADD PRIMARY KEY (`custom_option_id`);

--
-- Indexes for table `19_districts`
--
ALTER TABLE `19_districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `19_level_user_type`
--
ALTER TABLE `19_level_user_type`
  ADD PRIMARY KEY (`level_type_id`);

--
-- Indexes for table `19_login`
--
ALTER TABLE `19_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `19_menu`
--
ALTER TABLE `19_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `19_panchayat`
--
ALTER TABLE `19_panchayat`
  ADD PRIMARY KEY (`panchayat_id`);

--
-- Indexes for table `19_phcs`
--
ALTER TABLE `19_phcs`
  ADD PRIMARY KEY (`phc_id`);

--
-- Indexes for table `19_questionnaire`
--
ALTER TABLE `19_questionnaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_questionnaire_options`
--
ALTER TABLE `19_questionnaire_options`
  ADD PRIMARY KEY (`custom_option_id`);

--
-- Indexes for table `19_question_answers`
--
ALTER TABLE `19_question_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_question_category`
--
ALTER TABLE `19_question_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_request_aid`
--
ALTER TABLE `19_request_aid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_states`
--
ALTER TABLE `19_states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `19_symptoms`
--
ALTER TABLE `19_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_symptoms_updation_history`
--
ALTER TABLE `19_symptoms_updation_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_symptom_approval_history`
--
ALTER TABLE `19_symptom_approval_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_users`
--
ALTER TABLE `19_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_verification_history`
--
ALTER TABLE `19_verification_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_villages`
--
ALTER TABLE `19_villages`
  ADD PRIMARY KEY (`village_id`);

--
-- Indexes for table `19_vulnerability`
--
ALTER TABLE `19_vulnerability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `19_vulnerability_updation_history`
--
ALTER TABLE `19_vulnerability_updation_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `19_access_keys`
--
ALTER TABLE `19_access_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `19_access_limits`
--
ALTER TABLE `19_access_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `19_chcs`
--
ALTER TABLE `19_chcs`
  MODIFY `chc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `19_custom_info`
--
ALTER TABLE `19_custom_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `19_custom_info_options`
--
ALTER TABLE `19_custom_info_options`
  MODIFY `custom_option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `19_districts`
--
ALTER TABLE `19_districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `19_level_user_type`
--
ALTER TABLE `19_level_user_type`
  MODIFY `level_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `19_login`
--
ALTER TABLE `19_login`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `19_menu`
--
ALTER TABLE `19_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `19_panchayat`
--
ALTER TABLE `19_panchayat`
  MODIFY `panchayat_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `19_phcs`
--
ALTER TABLE `19_phcs`
  MODIFY `phc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `19_questionnaire`
--
ALTER TABLE `19_questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `19_questionnaire_options`
--
ALTER TABLE `19_questionnaire_options`
  MODIFY `custom_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `19_question_answers`
--
ALTER TABLE `19_question_answers`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `19_question_category`
--
ALTER TABLE `19_question_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `19_request_aid`
--
ALTER TABLE `19_request_aid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `19_states`
--
ALTER TABLE `19_states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `19_symptoms`
--
ALTER TABLE `19_symptoms`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `19_symptoms_updation_history`
--
ALTER TABLE `19_symptoms_updation_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `19_symptom_approval_history`
--
ALTER TABLE `19_symptom_approval_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `19_users`
--
ALTER TABLE `19_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `19_verification_history`
--
ALTER TABLE `19_verification_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `19_villages`
--
ALTER TABLE `19_villages`
  MODIFY `village_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `19_vulnerability`
--
ALTER TABLE `19_vulnerability`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `19_vulnerability_updation_history`
--
ALTER TABLE `19_vulnerability_updation_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
