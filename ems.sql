-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2018 at 05:11 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

DROP TABLE IF EXISTS `equipments`;
CREATE TABLE IF NOT EXISTS `equipments` (
  `e_id` int(10) NOT NULL AUTO_INCREMENT,
  `e_num` int(10) NOT NULL DEFAULT '0',
  `e_name` varchar(30) NOT NULL,
  `des` text NOT NULL,
  `main_id` int(10) NOT NULL,
  `sub_id` int(10) NOT NULL,
  `e_manu` varchar(20) NOT NULL,
  `e_model` varchar(15) NOT NULL,
  `e_code` varchar(13) NOT NULL,
  `qty` int(10) NOT NULL,
  `cogs` int(10) NOT NULL,
  `u_price` int(10) NOT NULL,
  `add_date` timestamp NOT NULL,
  `updated` timestamp NOT NULL,
  PRIMARY KEY (`e_id`),
  KEY `main_id` (`main_id`,`sub_id`),
  KEY `sub_id` (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='EMS-Equipment Table ';

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`e_id`, `e_num`, `e_name`, `des`, `main_id`, `sub_id`, `e_manu`, `e_model`, `e_code`, `qty`, `cogs`, `u_price`, `add_date`, `updated`) VALUES
(1, 1, 'Samsung Quard Core', ' However, sometimes number ', 1, 4, 'Samsung', 'E-Class2018', 'EMS-C9H2V0hz', 60, 1500, 2000, '2018-07-12 10:45:59', '2018-08-10 11:14:07'),
(2, 2, 'Iphone 9 Edge', ' However, sometimes ', 1, 5, 'Apple', 'E2036', 'EMS-kuvpFoso', 22, 1000, 3000, '2018-07-12 10:57:25', '2018-08-10 11:14:07'),
(3, 3, 'Samsung Tablet', ' However, sometimes ', 1, 4, 'Samsung', 'TYIUH-552', 'EMS-UExkQVcg', 23, 8000, 10000, '2018-07-12 11:03:36', '2018-08-10 11:14:07'),
(8, 4, 'AMD Drones', 'use to monitor Air space and', 1, 4, 'AMD.Inc', 'WER6564', 'EMS-CTAJgfTz', 92, 15000, 20000, '2018-07-12 15:04:44', '2018-08-08 00:44:01'),
(9, 5, 'Ligh Tech Radio', ' However, mix', 1, 4, 'Sinsung', 'E-CISUS', 'EMS-Q9jPmUvd', 40, 30000, 35000, '2018-08-04 10:31:39', '2018-08-07 21:46:42'),
(10, 6, 'Electronic Pen', 'use in schools ', 1, 4, 'K-Tech', 'XICUO-22', 'EMS-GwN0ryD3', 45, 2500, 3200, '2018-08-05 22:16:53', '2018-08-10 11:14:07'),
(11, 7, 'Tec Cup', 'use for breakfast ', 4, 4, 'Tiko', '#NHSGD', 'EMS-FvNdacwP', 12, 1000, 1000, '2018-08-05 22:33:06', '2018-08-07 14:29:38'),
(12, 8, 'WIMAX Network', 'use for internet connections', 1, 4, 'Dabiko', 'ERTGH00', 'EMS-bhVgdKWw', 4, 10000, 12000, '2018-08-05 23:05:34', '2018-08-09 02:24:08'),
(17, 9, 'Electrons', 'asasdasdasd', 1, 4, 'Sinsung', 'ERTGH89', 'EMS-xWwxo6uG', 4, 30000, 35000, '2018-08-06 10:46:39', '2018-08-10 11:14:07'),
(18, 10, 'Tec Glasses', 'use for ', 1, 4, 'Dabiko', 'E-CISUS004', 'EMS-2zYHYdiF', 42, 35000, 39000, '2018-08-06 10:49:59', '2018-08-08 00:40:07'),
(19, 11, 'Glass Tables', 'sometimes number fields', 5, 4, 'K-Tech', 'EXZD5562', 'EMS-um3anAgX', 13, 15000, 20000, '2018-08-06 14:20:56', '2018-08-10 11:14:07'),
(20, 12, 'Lion Battery', 'use for LG L4 smart phones', 1, 4, 'Sinsung', 'EXuyui', 'EMS-EugZeK6i', 50, 6500, 8000, '2018-08-09 02:29:48', '2018-08-09 02:32:24'),
(21, 13, '2 TB HDD', 'storage device', 1, 4, 'Batibo', 'UY7878GH', 'EMS-fDiPcNfe', 9, 55000, 60000, '2018-08-09 02:34:27', '2018-08-10 11:14:07'),
(22, 14, 'Wireless Keyboards', 'use for typing. Coding.', 1, 4, 'Dabiko', '#451JHUI', 'EMS-XWlJPLgN', 9, 20000, 25000, '2018-08-09 02:38:13', '2018-08-10 11:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `in_id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `client_info` text NOT NULL,
  `order_info` text NOT NULL,
  `p_method` int(3) NOT NULL,
  `balance` varchar(20) NOT NULL,
  `in_details` longtext NOT NULL,
  `print` enum('0','1') NOT NULL COMMENT '"0" Not available for print and "1" Availabe for print',
  `total` varchar(20) NOT NULL,
  `date_printed` timestamp NOT NULL,
  `updates` timestamp NOT NULL,
  PRIMARY KEY (`in_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='EMS-Invoice Table';

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`in_id`, `users_id`, `client_name`, `client_info`, `order_info`, `p_method`, `balance`, `in_details`, `print`, `total`, `date_printed`, `updates`) VALUES
(1, 1, 'T Courage', '{\"c_name\":\"T Courage\",\"c_address\":\"Moloko\",\"c_number\":\"+74290242\",\"c_email\":\"tech@gmail.com\"}', '{\"order_date\":\"2018-08-07 14:47:29\",\"order_id\":\"#VIT5KK\",\"invoice_number\":\"#0046105970\"}', 2, '0', '[{\"Item_Id\":\"17\",\"Item_name\":\"Electrons\",\"Stocks\":\"8\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\"asasdasdasd\"},{\"Item_Id\":\"11\",\"Item_name\":\"Tec Cup\",\"Stocks\":\"15\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"1000\",\"Total\":\"1000\",\"Description\":\"use for breakfast \"},{\"Item_Id\":\"8\",\"Item_name\":\"AMD Drones\",\"Stocks\":\"99\",\"Quantity\":\"1\",\"Cogs\":\"15000\",\"Unit_Price\":\"20000\",\"Total\":\"20000\",\"Description\":\" However,  or are mixed with text fields in a form, so left-alignment may promote better visual flow.\"},{\"Item_Id\":\"9\",\"Item_name\":\"Ligh Tech Radio\",\"Stocks\":\"48\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\" However, mix\"},{\"Item_Id\":\"11\",\"Item_name\":\"Tec Cup\",\"Stocks\":\"15\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"1000\",\"Total\":\"1000\",\"Description\":\"use for breakfast \"}]', '0', '92000', '2018-08-07 13:47:29', '2018-08-07 13:47:29'),
(2, 1, 'Cedric Mbah', '{\"c_name\":\"Cedric Mbah\",\"c_address\":\"Nkozoa\",\"c_number\":\"6452359\",\"c_email\":\"mbah@gmail.com\"}', '{\"order_date\":\"2018-08-07 14:49:42\",\"order_id\":\"#OZFS3I\",\"invoice_number\":\"#9030782527\"}', 1, '0', '[{\"Item_Id\":\"9\",\"Item_name\":\"Ligh Tech Radio\",\"Stocks\":\"47\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\" However, mix\"},{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"38\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"35\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"35\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"18\",\"Item_name\":\"Tec Glasses\",\"Stocks\":\"47\",\"Quantity\":\"1\",\"Cogs\":\"35000\",\"Unit_Price\":\"39000\",\"Total\":\"39000\",\"Description\":\"use for \"}]', '0', '97000', '2018-08-07 13:49:42', '2018-08-07 13:49:42'),
(3, 1, 'Garba Dickson', '{\"c_name\":\"Garba Dickson\",\"c_address\":\"Kumba\",\"c_number\":\"6452359\",\"c_email\":\"tech@gmail.com\"}', '{\"order_date\":\"2018-08-07 14:50:58\",\"order_id\":\"#OZFS3I\",\"invoice_number\":\"#9030782527\"}', 2, '0', '[{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"33\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"37\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"18\",\"Item_name\":\"Tec Glasses\",\"Stocks\":\"46\",\"Quantity\":\"1\",\"Cogs\":\"35000\",\"Unit_Price\":\"39000\",\"Total\":\"39000\",\"Description\":\"use for \"},{\"Item_Id\":\"12\",\"Item_name\":\"WIMAX Network\",\"Stocks\":\"8\",\"Quantity\":\"1\",\"Cogs\":\"10000\",\"Unit_Price\":\"12000\",\"Total\":\"12000\",\"Description\":\"use for internet connection \"}]', '0', '64000', '2018-08-07 13:50:58', '2018-08-07 13:50:58'),
(4, 1, 'T Courage', '{\"c_name\":\"T Courage\",\"c_address\":\"Kumba\",\"c_number\":\"+74290242\",\"c_email\":\"tech@gmail.com\"}', '{\"order_date\":\"2018-08-07 14:51:50\",\"order_id\":\"#OZFS3I\",\"invoice_number\":\"#9030782527\"}', 3, '100000', '[{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"36\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"36\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"18\",\"Item_name\":\"Tec Glasses\",\"Stocks\":\"45\",\"Quantity\":\"1\",\"Cogs\":\"35000\",\"Unit_Price\":\"39000\",\"Total\":\"39000\",\"Description\":\"use for \"},{\"Item_Id\":\"17\",\"Item_name\":\"Electrons\",\"Stocks\":\"7\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\"asasdasdasd\"},{\"Item_Id\":\"8\",\"Item_name\":\"AMD Drones\",\"Stocks\":\"98\",\"Quantity\":\"1\",\"Cogs\":\"15000\",\"Unit_Price\":\"20000\",\"Total\":\"20000\",\"Description\":\" However,  or are mixed with text fields in a form, so left-alignment may promote better visual flow.\"}]', '0', '100000', '2018-08-07 13:51:50', '2018-08-07 13:51:50'),
(5, 1, 'Sadler B', '{\"c_name\":\"Sadler B\",\"c_address\":\"Nkozoa\",\"c_number\":\"6452359\",\"c_email\":\"tech@gmail.com\"}', '{\"order_date\":\"2018-08-07 15:01:44\",\"order_id\":\"#OZFS3I\",\"invoice_number\":\"#9030782527\"}', 3, '15000', '[{\"Item_Id\":\"17\",\"Item_name\":\"Electrons\",\"Stocks\":\"6\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\"asasdasdasd\"},{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"32\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"32\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"9\",\"Item_name\":\"Ligh Tech Radio\",\"Stocks\":\"46\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\" However, mix\"}]', '0', '90000', '2018-08-07 14:01:44', '2018-08-07 21:44:50'),
(13, 1, 'Bikolo Sadler', '{\"c_name\":\"Bikolo Sadler\",\"c_address\":\"Moloko\",\"c_number\":\"6452359\",\"c_email\":\"tech@gmail.com\"}', '{\"order_date\":\"2018-08-07 15:23:18\",\"order_id\":\"#7454Z6\",\"invoice_number\":\"#5418338396\"}', 3, '35000', '[{\"Item_Id\":\"9\",\"Item_name\":\"Ligh Tech Radio\",\"Stocks\":\"43\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\" However, mix\"}]', '0', '35000', '2018-08-07 14:23:18', '2018-08-07 14:23:18'),
(14, 1, 'Njenji Duran', '{\"c_name\":\"Njenji Duran\",\"c_address\":\"Kribi\",\"c_number\":\"+74290242\",\"c_email\":\"tech@gmail.com\"}', '{\"order_date\":\"2018-08-07 15:27:58\",\"order_id\":\"#T8C4FW\",\"invoice_number\":\"#5338819852\"}', 1, '0', '[{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"32\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"32\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"32\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"8\",\"Item_name\":\"AMD Drones\",\"Stocks\":\"95\",\"Quantity\":\"1\",\"Cogs\":\"15000\",\"Unit_Price\":\"20000\",\"Total\":\"20000\",\"Description\":\" However,  or are mixed with text fields in a form, so left-alignment may promote better visual flow.\"},{\"Item_Id\":\"9\",\"Item_name\":\"Ligh Tech Radio\",\"Stocks\":\"42\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\" However, mix\"}]', '1', '64000', '2018-08-07 14:27:58', '2018-08-07 21:37:09'),
(20, 1, 'Dabi', '{\"c_name\":\"Dabi\",\"c_address\":\"Bastos\",\"c_number\":\"6452359\",\"c_email\":\"dabi@gmail.com\"}', '{\"order_date\":\"2018-08-07 22:46:42\",\"order_id\":\"#249HPY\",\"invoice_number\":\"#0780788459\"}', 1, '0', '[{\"Item_Id\":\"1\",\"Item_name\":\"Samsung Quard Core\",\"Stocks\":\"64\",\"Quantity\":\"1\",\"Cogs\":\"1500\",\"Unit_Price\":\"2000\",\"Total\":\"2000\",\"Description\":\" However, sometimes number \"},{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"26\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"27\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"8\",\"Item_name\":\"AMD Drones\",\"Stocks\":\"94\",\"Quantity\":\"1\",\"Cogs\":\"15000\",\"Unit_Price\":\"20000\",\"Total\":\"20000\",\"Description\":\" However,  or are mixed with text fields in a form, so left-alignment may promote better visual flow.\"},{\"Item_Id\":\"9\",\"Item_name\":\"Ligh Tech Radio\",\"Stocks\":\"41\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\" However, mix\"},{\"Item_Id\":\"10\",\"Item_name\":\"Electronic Pen\",\"Stocks\":\"48\",\"Quantity\":\"1\",\"Cogs\":\"2500\",\"Unit_Price\":\"3200\",\"Total\":\"3200\",\"Description\":\"use in schools \"},{\"Item_Id\":\"12\",\"Item_name\":\"WIMAX Network\",\"Stocks\":\"7\",\"Quantity\":\"1\",\"Cogs\":\"10000\",\"Unit_Price\":\"12000\",\"Total\":\"12000\",\"Description\":\"use for internet connection \"}]', '1', '85200', '2018-08-07 21:46:42', '2018-08-07 21:46:42'),
(21, 1, 'DabiTech', '{\"c_name\":\"DabiTech\",\"c_address\":\"America\",\"c_number\":\"+1446598345\",\"c_email\":\"hahahha@gigmail.com\"}', '{\"order_date\":\"2018-08-08 01:40:07\",\"order_id\":\"#UXYPK2\",\"invoice_number\":\"#7144046943\"}', 1, '0', '[{\"Item_Id\":\"1\",\"Item_name\":\"Samsung Quard Core\",\"Stocks\":\"63\",\"Quantity\":\"1\",\"Cogs\":\"1500\",\"Unit_Price\":\"2000\",\"Total\":\"2000\",\"Description\":\" However, sometimes number \"},{\"Item_Id\":\"8\",\"Item_name\":\"AMD Drones\",\"Stocks\":\"93\",\"Quantity\":\"1\",\"Cogs\":\"15000\",\"Unit_Price\":\"20000\",\"Total\":\"20000\",\"Description\":\" However,  or are mixed with text fields in a form, so left-alignment may promote better visual flow.\"},{\"Item_Id\":\"17\",\"Item_name\":\"Electrons\",\"Stocks\":\"4\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\"asasdasdasd\"},{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"26\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"10\",\"Item_name\":\"Electronic Pen\",\"Stocks\":\"47\",\"Quantity\":\"1\",\"Cogs\":\"2500\",\"Unit_Price\":\"3200\",\"Total\":\"3200\",\"Description\":\"use in schools \"},{\"Item_Id\":\"12\",\"Item_name\":\"WIMAX Network\",\"Stocks\":\"6\",\"Quantity\":\"1\",\"Cogs\":\"10000\",\"Unit_Price\":\"12000\",\"Total\":\"12000\",\"Description\":\"use for internet connection \"},{\"Item_Id\":\"18\",\"Item_name\":\"Tec Glasses\",\"Stocks\":\"43\",\"Quantity\":\"1\",\"Cogs\":\"35000\",\"Unit_Price\":\"39000\",\"Total\":\"39000\",\"Description\":\"use for \"},{\"Item_Id\":\"19\",\"Item_name\":\"Glass Tables\",\"Stocks\":\"16\",\"Quantity\":\"1\",\"Cogs\":\"15000\",\"Unit_Price\":\"20000\",\"Total\":\"20000\",\"Description\":\"sometimes number fields\"},{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"25\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"}]', '0', '144200', '2018-08-08 00:40:07', '2018-08-08 00:40:07'),
(22, 1, 'Varoline N', '{\"c_name\":\"Varoline N\",\"c_address\":\"Boltimore\",\"c_number\":\"+1447589623\",\"c_email\":\"tech@gmail.com\"}', '{\"order_date\":\"2018-08-08 01:45:32\",\"order_id\":\"#PSQ492\",\"invoice_number\":\"#8194765734\"}', 1, '0', '[{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"24\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"25\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"19\",\"Item_name\":\"Glass Tables\",\"Stocks\":\"15\",\"Quantity\":\"1\",\"Cogs\":\"15000\",\"Unit_Price\":\"20000\",\"Total\":\"20000\",\"Description\":\"sometimes number fields\"}]', '1', '33000', '2018-08-09 03:26:15', '2018-08-08 22:02:28'),
(23, 1, 'T Courage', '{\"c_name\":\"T Courage\",\"c_address\":\"Moloko\",\"c_number\":\"6452359\",\"c_email\":\"tech@gmail.com\"}', '{\"order_date\":\"2018-08-08 02:28:47\",\"order_id\":\"#2LTIQL\",\"invoice_number\":\"#2606805193\"}', 3, '2000', '[{\"Item_Id\":\"12\",\"Item_name\":\"WIMAX Network\",\"Stocks\":\"5\",\"Quantity\":\"1\",\"Cogs\":\"10000\",\"Unit_Price\":\"12000\",\"Total\":\"12000\",\"Description\":\"use for internet connection \"}]', '0', '12000', '2018-08-08 01:28:47', '2018-08-08 01:28:47'),
(24, 1, 'T Courage', '{\"c_name\":\"T Courage\",\"c_address\":\"Moloko\",\"c_number\":\"6452359\",\"c_email\":\"mbah@gmail.com\"}', '{\"order_date\":\"2018-08-08 02:30:18\",\"order_id\":\"#CWOE1M\",\"invoice_number\":\"#3891504593\"}', 3, '1500', '[{\"Item_Id\":\"1\",\"Item_name\":\"Samsung Quard Core\",\"Stocks\":\"62\",\"Quantity\":\"1\",\"Cogs\":\"1500\",\"Unit_Price\":\"2000\",\"Total\":\"2000\",\"Description\":\" However, sometimes number \"}]', '0', '2000', '2018-08-08 01:30:18', '2018-08-08 01:30:18'),
(25, 1, 'T Glory', '{\"c_name\":\"T Glory\",\"c_address\":\"Messassi\",\"c_number\":\"+562354665\",\"c_email\":\"dabi@gmail.com\"}', '{\"order_date\":\"2018-08-10 12:14:07\",\"order_id\":\"#17FVZJ\",\"invoice_number\":\"#3747366529\"}', 3, '157200', '[{\"Item_Id\":\"1\",\"Item_name\":\"Samsung Quard Core\",\"Stocks\":\"61\",\"Quantity\":\"1\",\"Cogs\":\"1500\",\"Unit_Price\":\"2000\",\"Total\":\"2000\",\"Description\":\" However, sometimes number \"},{\"Item_Id\":\"2\",\"Item_name\":\"Iphone 9 Edge\",\"Stocks\":\"23\",\"Quantity\":\"1\",\"Cogs\":\"1000\",\"Unit_Price\":\"3000\",\"Total\":\"3000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"3\",\"Item_name\":\"Samsung Tablet\",\"Stocks\":\"24\",\"Quantity\":\"1\",\"Cogs\":\"8000\",\"Unit_Price\":\"10000\",\"Total\":\"10000\",\"Description\":\" However, sometimes \"},{\"Item_Id\":\"10\",\"Item_name\":\"Electronic Pen\",\"Stocks\":\"46\",\"Quantity\":\"1\",\"Cogs\":\"2500\",\"Unit_Price\":\"3200\",\"Total\":\"3200\",\"Description\":\"use in schools \"},{\"Item_Id\":\"21\",\"Item_name\":\"2 TB HDD\",\"Stocks\":\"10\",\"Quantity\":\"1\",\"Cogs\":\"55000\",\"Unit_Price\":\"60000\",\"Total\":\"60000\",\"Description\":\"storage device\"},{\"Item_Id\":\"22\",\"Item_name\":\"Wireless Keyboards\",\"Stocks\":\"10\",\"Quantity\":\"1\",\"Cogs\":\"20000\",\"Unit_Price\":\"25000\",\"Total\":\"25000\",\"Description\":\"use for typing. Coding.\"},{\"Item_Id\":\"17\",\"Item_name\":\"Electrons\",\"Stocks\":\"5\",\"Quantity\":\"1\",\"Cogs\":\"30000\",\"Unit_Price\":\"35000\",\"Total\":\"35000\",\"Description\":\"asasdasdasd\"},{\"Item_Id\":\"19\",\"Item_name\":\"Glass Tables\",\"Stocks\":\"14\",\"Quantity\":\"1\",\"Cogs\":\"15000\",\"Unit_Price\":\"20000\",\"Total\":\"20000\",\"Description\":\"sometimes number fields\"}]', '0', '158200', '2018-08-10 11:14:07', '2018-08-10 11:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

DROP TABLE IF EXISTS `main_category`;
CREATE TABLE IF NOT EXISTS `main_category` (
  `main_id` int(10) NOT NULL AUTO_INCREMENT,
  `main_cat` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL,
  `updated_on` timestamp NOT NULL,
  PRIMARY KEY (`main_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='EMS-Main Categories';

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`main_id`, `main_cat`, `created_on`, `updated_on`) VALUES
(1, 'Tech', '2018-07-11 03:00:25', '2018-07-11 03:00:25'),
(2, 'Unknown', '2018-07-12 16:46:32', '2018-07-12 16:46:32'),
(3, 'Fishing', '2018-07-12 17:00:16', '2018-07-12 17:00:16'),
(4, 'Goods', '2018-07-12 17:00:29', '2018-08-03 18:21:49'),
(5, 'Construction', '2018-08-06 10:19:40', '2018-08-06 14:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `sub`
--

DROP TABLE IF EXISTS `sub`;
CREATE TABLE IF NOT EXISTS `sub` (
  `main_id` int(10) NOT NULL,
  `main_cat` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL,
  `updated_date` timestamp NOT NULL,
  PRIMARY KEY (`main_id`),
  KEY `main_id` (`main_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Sub Categories';

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `sub_id` int(10) NOT NULL AUTO_INCREMENT,
  `sub_cat` varchar(30) NOT NULL,
  `main_id` int(10) NOT NULL,
  `created_date` timestamp NOT NULL,
  `updated_date` timestamp NOT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `main_id` (`main_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='EMS-Sub Categories';

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_id`, `sub_cat`, `main_id`, `created_date`, `updated_date`) VALUES
(1, 'phones', 1, '2018-07-11 03:00:50', '2018-07-11 03:00:50'),
(2, 'lolp', 1, '2018-07-11 03:18:37', '2018-07-11 03:18:37'),
(4, 'None', 2, '2018-07-12 16:46:56', '2018-07-12 16:46:56'),
(5, 'shoes', 4, '2018-07-12 17:00:44', '2018-07-12 17:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(10) NOT NULL AUTO_INCREMENT,
  `names` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `users_status` enum('0','1') NOT NULL COMMENT '"0" for Offline and "1" for Online',
  `created_date` timestamp NOT NULL,
  `updated_date` timestamp NOT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='EMS-Users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `names`, `email`, `password`, `users_status`, `created_date`, `updated_date`) VALUES
(1, 'Administrator', 'emsadmin@gmail.com', '$2y$10$e27xkuRQbhuOpqkiSaNK0.k4X42x7AJDGGUep5IfXWOyGB4zV/iIC', '1', '2018-06-28 23:00:00', '2018-06-28 23:00:00'),
(2, 'Dabiko Blaise', 'dabiko.blaise@gmail.com', '$2y$10$e27xkuRQbhuOpqkiSaNK0.k4X42x7AJDGGUep5IfXWOyGB4zV/iIC', '0', '2018-06-28 23:00:00', '2018-06-28 23:00:00'),
(3, 'Cedric  Mbah', 'mbahcedric@gmail.com', '$2y$10$e27xkuRQbhuOpqkiSaNK0.k4X42x7AJDGGUep5IfXWOyGB4zV/iIC', '0', '2018-06-28 23:00:00', '2018-06-28 23:00:00'),
(4, 'Garba Dickson', 'garba.dickson@gmail.com', '$2y$10$e27xkuRQbhuOpqkiSaNK0.k4X42x7AJDGGUep5IfXWOyGB4zV/iIC', '0', '2018-06-28 23:00:00', '2018-06-28 23:00:00'),
(5, 'Gaspard Baye', 'bayegaspard@gmail.com', '$2y$10$e27xkuRQbhuOpqkiSaNK0.k4X42x7AJDGGUep5IfXWOyGB4zV/iIC', '0', '2018-06-28 23:00:00', '2018-06-28 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

DROP TABLE IF EXISTS `users_logs`;
CREATE TABLE IF NOT EXISTS `users_logs` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `log_status` timestamp NOT NULL,
  `login_time` timestamp NOT NULL,
  `logout_time` timestamp NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COMMENT='EMS-logs';

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`log_id`, `users_id`, `log_status`, `login_time`, `logout_time`) VALUES
(1, 1, '2018-06-29 13:31:39', '2018-06-29 13:31:39', '2018-06-29 13:31:39'),
(2, 1, '2018-06-29 14:09:19', '2018-06-29 14:09:19', '2018-06-29 14:09:19'),
(3, 1, '2018-06-29 14:59:00', '2018-06-29 14:59:00', '2018-06-29 14:59:00'),
(4, 1, '2018-06-29 15:02:22', '2018-06-29 15:02:22', '2018-06-29 15:02:22'),
(5, 1, '2018-06-29 15:04:09', '2018-06-29 15:04:09', '2018-06-29 15:04:09'),
(6, 1, '2018-06-29 15:13:19', '2018-06-29 15:13:19', '2018-06-29 15:13:19'),
(7, 1, '2018-06-29 15:17:10', '2018-06-29 15:17:10', '2018-06-29 15:17:10'),
(8, 1, '2018-06-29 15:23:06', '2018-06-29 15:23:06', '2018-06-29 15:23:06'),
(9, 1, '2018-06-29 15:24:50', '2018-06-29 15:24:50', '2018-06-29 15:24:50'),
(10, 1, '2018-06-29 15:26:58', '2018-06-29 15:26:58', '2018-06-29 15:26:58'),
(11, 1, '2018-06-29 15:40:23', '2018-06-29 15:40:23', '2018-06-29 15:40:23'),
(12, 1, '2018-06-29 15:41:32', '2018-06-29 15:41:32', '2018-06-29 15:41:32'),
(13, 1, '2018-06-29 16:03:14', '2018-06-29 16:03:14', '2018-06-29 16:03:14'),
(14, 1, '2018-06-29 16:27:22', '2018-06-29 16:27:22', '2018-06-29 16:27:22'),
(15, 1, '2018-06-29 16:28:12', '2018-06-29 16:28:12', '2018-06-29 16:28:12'),
(16, 1, '2018-06-29 16:29:59', '2018-06-29 16:29:59', '2018-06-29 16:29:59'),
(17, 1, '2018-06-29 16:34:11', '2018-06-29 16:34:11', '2018-06-29 16:34:11'),
(18, 1, '2018-06-29 16:34:31', '2018-06-29 16:34:31', '2018-06-29 16:34:31'),
(19, 1, '2018-06-29 16:35:31', '2018-06-29 16:35:31', '2018-06-29 16:35:31'),
(20, 1, '2018-06-29 16:36:05', '2018-06-29 16:36:05', '2018-06-29 16:36:05'),
(21, 1, '2018-06-29 16:41:16', '2018-06-29 16:41:16', '2018-06-29 16:41:16'),
(22, 1, '2018-06-29 16:46:13', '2018-06-29 16:46:13', '2018-06-29 16:46:13'),
(23, 1, '2018-06-29 16:50:24', '2018-06-29 16:50:24', '2018-06-29 16:50:24'),
(24, 1, '2018-06-29 16:52:50', '2018-06-29 16:52:50', '2018-06-29 16:52:50'),
(25, 1, '2018-06-29 16:56:05', '2018-06-29 16:56:05', '2018-06-29 16:56:05'),
(26, 1, '2018-06-29 19:04:40', '2018-06-29 19:04:40', '2018-06-29 19:04:40'),
(27, 1, '2018-06-29 22:58:27', '2018-06-29 22:58:27', '2018-06-29 22:58:27'),
(28, 1, '2018-06-30 07:24:58', '2018-06-30 07:24:58', '2018-06-30 07:24:58'),
(29, 1, '2018-06-30 07:25:15', '2018-06-30 07:25:15', '2018-06-30 07:25:15'),
(30, 1, '2018-06-30 07:28:22', '2018-06-30 07:28:22', '2018-06-30 07:28:22'),
(31, 1, '2018-06-30 08:38:25', '2018-06-30 08:38:25', '2018-06-30 08:38:25'),
(32, 1, '2018-06-30 09:40:28', '2018-06-30 09:40:28', '2018-06-30 09:40:28'),
(33, 1, '2018-06-30 14:53:05', '2018-06-30 14:53:05', '2018-06-30 14:53:05'),
(34, 1, '2018-06-30 16:04:27', '2018-06-30 16:04:27', '2018-06-30 16:04:27'),
(35, 1, '2018-06-30 16:43:10', '2018-06-30 16:43:10', '2018-06-30 16:43:10'),
(36, 1, '2018-06-30 21:29:45', '2018-06-30 21:29:45', '2018-06-30 21:29:45'),
(37, 1, '2018-07-01 06:43:16', '2018-07-01 06:43:16', '2018-07-01 06:43:16'),
(38, 1, '2018-07-01 07:22:29', '2018-07-01 07:22:29', '2018-07-01 07:22:29'),
(39, 1, '2018-07-01 15:48:23', '2018-07-01 15:48:23', '2018-07-01 15:48:23'),
(40, 1, '2018-07-01 19:18:37', '2018-07-01 19:18:37', '2018-07-01 19:18:37'),
(41, 1, '2018-07-02 02:13:44', '2018-07-02 02:13:44', '2018-07-02 02:13:44'),
(42, 1, '2018-07-02 03:35:01', '2018-07-02 03:35:01', '2018-07-02 03:35:01'),
(43, 1, '2018-07-02 17:03:29', '2018-07-02 17:03:29', '2018-07-02 17:03:29'),
(44, 1, '2018-07-03 06:47:27', '2018-07-03 06:47:27', '2018-07-03 06:47:27'),
(45, 1, '2018-07-03 19:27:55', '2018-07-03 19:27:55', '2018-07-03 19:27:55'),
(46, 1, '2018-07-03 21:05:30', '2018-07-03 21:05:30', '2018-07-03 21:05:30'),
(47, 1, '2018-07-03 22:17:32', '2018-07-03 22:17:32', '2018-07-03 22:17:32'),
(48, 1, '2018-07-03 23:06:49', '2018-07-03 23:06:49', '2018-07-03 23:06:49'),
(49, 1, '2018-07-04 08:46:50', '2018-07-04 08:46:50', '2018-07-04 08:46:50'),
(50, 1, '2018-07-04 11:59:53', '2018-07-04 11:59:53', '2018-07-04 11:59:53'),
(51, 1, '2018-07-04 16:30:30', '2018-07-04 16:30:30', '2018-07-04 16:30:30'),
(52, 1, '2018-07-04 21:44:00', '2018-07-04 21:44:00', '2018-07-04 21:44:00'),
(53, 1, '2018-07-05 11:21:09', '2018-07-05 11:21:09', '2018-07-05 11:21:09'),
(54, 1, '2018-07-05 14:08:47', '2018-07-05 14:08:47', '2018-07-05 14:08:47'),
(55, 1, '2018-07-05 15:22:35', '2018-07-05 15:22:35', '2018-07-05 15:22:35'),
(56, 1, '2018-07-05 16:25:09', '2018-07-05 16:25:09', '2018-07-05 16:25:09'),
(57, 1, '2018-07-05 20:31:13', '2018-07-05 20:31:13', '2018-07-05 20:31:13'),
(58, 1, '2018-07-05 22:14:15', '2018-07-05 22:14:15', '2018-07-05 22:14:15'),
(59, 1, '2018-07-05 23:17:33', '2018-07-05 23:17:33', '2018-07-05 23:17:33'),
(60, 1, '2018-07-06 12:16:56', '2018-07-06 12:16:56', '2018-07-06 12:16:56'),
(61, 1, '2018-07-06 15:50:29', '2018-07-06 15:50:29', '2018-07-06 15:50:29'),
(62, 1, '2018-07-06 16:42:01', '2018-07-06 16:42:01', '2018-07-06 16:42:01'),
(63, 1, '2018-07-06 19:05:43', '2018-07-06 19:05:43', '2018-07-06 19:05:43'),
(64, 1, '2018-07-06 20:00:13', '2018-07-06 20:00:13', '2018-07-06 20:00:13'),
(65, 1, '2018-07-07 00:34:03', '2018-07-07 00:34:03', '2018-07-07 00:34:03'),
(66, 1, '2018-07-07 16:08:09', '2018-07-07 16:08:09', '2018-07-07 16:08:09'),
(67, 1, '2018-07-07 18:33:22', '2018-07-07 18:33:22', '2018-07-07 18:33:22'),
(68, 1, '2018-07-07 20:56:31', '2018-07-07 20:56:31', '2018-07-07 20:56:31'),
(69, 1, '2018-07-07 21:43:08', '2018-07-07 21:43:08', '2018-07-07 21:43:08'),
(70, 1, '2018-07-08 00:51:47', '2018-07-08 00:51:47', '2018-07-08 00:51:47'),
(71, 1, '2018-07-08 02:08:47', '2018-07-08 02:08:47', '2018-07-08 02:08:47'),
(72, 1, '2018-07-08 02:10:37', '2018-07-08 02:10:37', '2018-07-08 02:10:37'),
(73, 1, '2018-07-08 02:13:36', '2018-07-08 02:13:36', '2018-07-08 02:13:36'),
(74, 1, '2018-07-08 02:15:47', '2018-07-08 02:15:47', '2018-07-08 02:15:47'),
(75, 1, '2018-07-08 02:31:23', '2018-07-08 02:31:23', '2018-07-08 02:31:23'),
(76, 1, '2018-07-08 14:03:09', '2018-07-08 14:03:09', '2018-07-08 14:03:09'),
(77, 1, '2018-07-08 16:17:48', '2018-07-08 16:17:48', '2018-07-08 16:17:48'),
(78, 1, '2018-07-09 21:41:09', '2018-07-09 21:41:09', '2018-07-09 21:41:09'),
(79, 1, '2018-07-10 22:24:54', '2018-07-10 22:24:54', '2018-07-10 22:24:54'),
(80, 1, '2018-07-10 23:37:44', '2018-07-10 23:37:44', '2018-07-10 23:37:44'),
(81, 1, '2018-07-11 22:11:50', '2018-07-11 22:11:50', '2018-07-11 22:11:50'),
(82, 1, '2018-07-11 22:12:01', '2018-07-11 22:12:01', '2018-07-11 22:12:01'),
(83, 1, '2018-07-11 22:12:15', '2018-07-11 22:12:15', '2018-07-11 22:12:15'),
(84, 1, '2018-07-11 22:14:16', '2018-07-11 22:14:16', '2018-07-11 22:14:16'),
(85, 1, '2018-07-11 22:14:25', '2018-07-11 22:14:25', '2018-07-11 22:14:25'),
(86, 1, '2018-07-11 22:16:31', '2018-07-11 22:16:31', '2018-07-11 22:16:31'),
(87, 1, '2018-07-11 22:16:39', '2018-07-11 22:16:39', '2018-07-11 22:16:39'),
(88, 1, '2018-07-11 22:17:33', '2018-07-11 22:17:33', '2018-07-11 22:17:33'),
(89, 1, '2018-07-11 22:18:17', '2018-07-11 22:18:17', '2018-07-11 22:18:17'),
(90, 1, '2018-07-11 22:20:32', '2018-07-11 22:20:32', '2018-07-11 22:20:32'),
(91, 1, '2018-07-13 08:50:58', '2018-07-13 08:50:58', '2018-07-13 08:50:58'),
(92, 1, '2018-07-14 16:34:39', '2018-07-14 16:34:39', '2018-07-14 16:34:39'),
(93, 1, '2018-07-17 02:43:14', '2018-07-17 02:43:14', '2018-07-17 02:43:14'),
(94, 1, '2018-07-19 20:31:35', '2018-07-19 20:31:35', '2018-07-19 20:31:35'),
(95, 1, '2018-07-22 11:02:00', '2018-07-22 11:02:00', '2018-07-22 11:02:00'),
(96, 1, '2018-07-23 21:49:17', '2018-07-23 21:49:17', '2018-07-23 21:49:17'),
(97, 1, '2018-07-25 19:31:32', '2018-07-25 19:31:32', '2018-07-25 19:31:32'),
(98, 1, '2018-07-28 18:46:58', '2018-07-28 18:46:58', '2018-07-28 18:46:58'),
(99, 1, '2018-07-30 07:20:14', '2018-07-30 07:20:14', '2018-07-30 07:20:14'),
(100, 1, '2018-08-01 11:27:14', '2018-08-01 11:27:14', '2018-08-01 11:27:14'),
(101, 1, '2018-08-01 12:59:52', '2018-08-01 12:59:52', '2018-08-01 12:59:52'),
(102, 1, '2018-08-01 19:17:56', '2018-08-01 19:17:56', '2018-08-01 19:17:56'),
(103, 1, '2018-08-02 02:55:50', '2018-08-02 02:55:50', '2018-08-02 02:55:50'),
(104, 1, '2018-08-02 20:46:51', '2018-08-02 20:46:51', '2018-08-02 20:46:51'),
(105, 1, '2018-08-03 02:39:59', '2018-08-03 02:39:59', '2018-08-03 02:39:59'),
(106, 1, '2018-08-04 06:05:39', '2018-08-04 06:05:39', '2018-08-04 06:05:39'),
(107, 1, '2018-08-04 12:49:19', '2018-08-04 12:49:19', '2018-08-04 12:49:19'),
(108, 1, '2018-08-04 16:01:29', '2018-08-04 16:01:29', '2018-08-04 16:01:29'),
(109, 1, '2018-08-04 16:42:20', '2018-08-04 16:42:20', '2018-08-04 16:42:20'),
(110, 1, '2018-08-05 20:23:24', '2018-08-05 20:23:24', '2018-08-05 20:23:24'),
(111, 1, '2018-08-06 01:44:12', '2018-08-06 01:44:12', '2018-08-06 01:44:12'),
(112, 1, '2018-08-06 09:10:45', '2018-08-06 09:10:45', '2018-08-06 09:10:45'),
(113, 1, '2018-08-07 12:11:32', '2018-08-07 12:11:32', '2018-08-07 12:11:32'),
(114, 1, '2018-08-07 20:57:47', '2018-08-07 20:57:47', '2018-08-07 20:57:47'),
(115, 1, '2018-08-08 11:07:43', '2018-08-08 11:07:43', '2018-08-08 11:07:43'),
(116, 1, '2018-08-08 18:52:46', '2018-08-08 18:52:46', '2018-08-08 18:52:46'),
(117, 1, '2018-08-08 18:55:16', '2018-08-08 18:55:16', '2018-08-08 18:55:16'),
(118, 1, '2018-08-08 19:21:36', '2018-08-08 19:21:36', '2018-08-08 19:21:36'),
(119, 1, '2018-08-08 21:39:20', '2018-08-08 21:39:20', '2018-08-08 21:39:20'),
(120, 1, '2018-08-08 22:34:14', '2018-08-08 22:34:14', '2018-08-08 22:34:14'),
(121, 1, '2018-08-09 01:38:21', '2018-08-09 01:38:21', '2018-08-09 01:38:21'),
(122, 1, '2018-08-09 02:02:48', '2018-08-09 02:02:48', '2018-08-09 02:02:48'),
(123, 1, '2018-08-09 09:57:10', '2018-08-09 09:57:10', '2018-08-09 09:57:10'),
(124, 1, '2018-08-10 01:48:23', '2018-08-10 01:48:23', '2018-08-10 01:48:23');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `equipments_ibfk_2` FOREIGN KEY (`main_id`) REFERENCES `main_category` (`main_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `equipments_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `sub_category` (`sub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`main_id`) REFERENCES `main_category` (`main_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD CONSTRAINT `users_logs_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
