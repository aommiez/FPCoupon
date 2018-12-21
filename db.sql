-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.9-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table coupon.coupon
CREATE TABLE IF NOT EXISTS `coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `pers_PersonID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cp_waveitem` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp_coupon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp_billtotal` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pers_idcard` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MemberCardNo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pers_PhoneNumber` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EmailAddress` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Addr_Address1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Addr_Address2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Addr_Address3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Addr_Address4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Addr_Address5` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addr_subdistrict` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addr_district` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addr_province` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Addr_PostCode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bod` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pers_status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `children_under` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `cardtype` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coupon_create_time` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table coupon.coupon: 6 rows
/*!40000 ALTER TABLE `coupon` DISABLE KEYS */;
INSERT IGNORE INTO `coupon` (`coupon_id`, `pers_PersonID`, `cp_waveitem`, `cp_coupon`, `cp_billtotal`, `pers_idcard`, `MemberCardNo`, `FirstName`, `LastName`, `Pers_PhoneNumber`, `Mobile`, `EmailAddress`, `Addr_Address1`, `Addr_Address2`, `Addr_Address3`, `Addr_Address4`, `Addr_Address5`, `addr_subdistrict`, `addr_district`, `addr_province`, `Addr_PostCode`, `gender`, `bod`, `pers_status`, `children_under`, `cardtype`, `coupon_create_time`) VALUES
	(1, '2930', '11259', '0', '2500.000000', '             ', '0000701000000000060', 'สายัณท์', 'สุขใจ', NULL, '0817477690', '', '70/166', '', '', '', '', 'ลำลูกกา', 'บึงคำพร้อย', 'ปทุมธานี', '12150', NULL, NULL, 'N', 'N', 'P', '2018-11-10 21:50:15'),
	(2, '182712', '11259', NULL, '.000000', '3350300563991', '', 'สุภาภรณ์', 'กองศรีมา', '0811716221', '0811716221', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'P', '2018-11-10 21:50:15'),
	(3, '130358', '11259', '23', '17900.000000', '3140600058003', '0000000000000000007', 'Google', 'Doc', '0633950009', '0892037288', 'a@a.com', '1', '2', '3', '4', '', '97', '13', '1', '10250', '', '2018-11-09', '', 'N', 'P', '2018-11-10 21:50:15'),
	(4, '181475', '11259', '5', '5000.000000', '1101401970688', '', 'นวลพรรณ', 'งามกิจวณิชย์', NULL, NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'cupong', '2018-11-10 21:50:15'),
	(5, '182714', '11259', '10', '19500.000000', '3350300563991', '', 'สุภาภรณ์', 'กองศรีมา', NULL, '000966557', '', '', 'เคหะร่มเกล้า 29', '', 'คลองสองต้นนุ่น', '', 'ลาดกระบัง', 'กรุงเทพมหานคร', NULL, NULL, NULL, NULL, 'N', 'N', 'cupong', '2018-11-10 21:50:15'),
	(6, '190905', '11259', '10', '16901.000000', '             ', '', 'google', 'app', '0633950009', '0633950009', '', '12/29', '', 'อินทรามาระ 4', 'สุทธิสารวินัจฉัย', '', 'สามเสนใน', 'พญาไท', 'กรุงเทพมหานคร', '10400', NULL, NULL, 'N', 'N', 'cupong', '2018-11-10 21:50:15');
/*!40000 ALTER TABLE `coupon` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
