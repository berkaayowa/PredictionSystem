-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.8.3-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sp_platform
DROP DATABASE IF EXISTS `sp_platform`;
CREATE DATABASE IF NOT EXISTS `sp_platform` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sp_platform`;

-- Dumping structure for table sp_platform.about
DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `summary` varchar(300) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.about: ~0 rows (approximately)
DELETE FROM `about`;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` (`id`, `title`, `summary`, `content`, `isDeleted`) VALUES
	(1, 'Green Valley Design', 'Green valley design is recognized as one of the leading suppliers and installers of high quality artificial grass in South Africa. Our main product line is manufactured by the proudly South African company.', 'Green valley design is recognized as one of the leading suppliers and installers of high quality artificial grass in South Africa. Our main product line is manufactured by the proudly South African company.\n\n(as seen on TV), is made from the highest quality yarns specifically for the harsh South African climate. (See product range for more detail on the different grasses).\n\nArtificial Grass SA caters for just about every application you can think of, including but not limited to; Playgrounds, Sports Fields, as well as all Residential and Commercial applications. Apart from artificial grass we also install rubberized play areas and rubberized kiddies cycle tracks. (See photos in the Playgrounds sections).\n\nOur highly qualified and experienced team will ensure a first class installation. No job is too big or too small. Let us transform your area into a luscious beautiful green lawn / sports court, 365 days of the year.', 0);
/*!40000 ALTER TABLE `about` ENABLE KEYS */;

-- Dumping structure for table sp_platform.contact
DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mobileNumber` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `physicalAddress` varchar(300) DEFAULT NULL,
  `facebook` varchar(300) DEFAULT NULL,
  `twitter` varchar(300) DEFAULT NULL,
  `feedback` varchar(500) DEFAULT NULL,
  `map` varchar(1000) DEFAULT NULL,
  `isDeleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.contact: ~0 rows (approximately)
DELETE FROM `contact`;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` (`id`, `mobileNumber`, `email`, `physicalAddress`, `facebook`, `twitter`, `feedback`, `map`, `isDeleted`) VALUES
	(1, '0717253115', 'project@softclicktech.com', '46 parksig villas, corandie, bellville', 'https://www.facebook.com/softclicktechnology/', 'https://twitter.com/SoftclickPty', 'Finished project with expert skills. Communication is quick and reliable. Project finished well before deadline!', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3311.4440199037736!2d18.64419581521115!3d-33.90397008064656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcc508a5a558151%3A0x79fa6ddcf3bb4d87!2sKFC+Bellville!5e0!3m2!1sen!2sza!4v1541535300739" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>', 0);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;

-- Dumping structure for table sp_platform.country
DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `flag` varchar(100) DEFAULT NULL,
  `isDeleted` int(2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.country: ~1 rows (approximately)
DELETE FROM `country`;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id`, `code`, `name`, `flag`, `isDeleted`) VALUES
	(1, 'CD', 'Canada', NULL, 0);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;

-- Dumping structure for table sp_platform.league
DROP TABLE IF EXISTS `league`;
CREATE TABLE IF NOT EXISTS `league` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryId` int(11) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `flag` varchar(200) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` varchar(100) DEFAULT NULL,
  `modifiedBy` varchar(100) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.league: ~0 rows (approximately)
DELETE FROM `league`;
/*!40000 ALTER TABLE `league` DISABLE KEYS */;
INSERT INTO `league` (`id`, `countryId`, `code`, `reference`, `name`, `description`, `flag`, `createdDate`, `modifiedDate`, `createdBy`, `modifiedBy`, `isDeleted`) VALUES
	(1, 1, NULL, NULL, 'Canadian Premier League', 'Canadian Premier League', NULL, NULL, NULL, NULL, NULL, 0);
/*!40000 ALTER TABLE `league` ENABLE KEYS */;

-- Dumping structure for table sp_platform.predictions
DROP TABLE IF EXISTS `predictions`;
CREATE TABLE IF NOT EXISTS `predictions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `predictionContributionId` int(11) DEFAULT NULL,
  `Column 3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.predictions: ~0 rows (approximately)
DELETE FROM `predictions`;
/*!40000 ALTER TABLE `predictions` DISABLE KEYS */;
/*!40000 ALTER TABLE `predictions` ENABLE KEYS */;

-- Dumping structure for table sp_platform.prediction_contribution
DROP TABLE IF EXISTS `prediction_contribution`;
CREATE TABLE IF NOT EXISTS `prediction_contribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `leaguePointsPercentage` decimal(4,2) DEFAULT 0.00,
  `leaguePositionPercentage` decimal(4,2) DEFAULT 0.00,
  `head2headPercentage` decimal(4,2) DEFAULT 0.00,
  `lastMatchPlayedPercentage` decimal(4,2) DEFAULT 0.00,
  `awayHomePercentage` decimal(4,2) DEFAULT 0.00,
  `winDifference` decimal(4,2) DEFAULT 15.70,
  `winDrawDifference` decimal(4,2) DEFAULT 6.90,
  `drawDifference` decimal(4,2) DEFAULT 2.90,
  `numberOfHeadtohead` int(11) DEFAULT 4,
  `numberOfLastMatch` int(11) DEFAULT 4,
  `matchSelectionPercentage` decimal(4,1) NOT NULL DEFAULT 99.0,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `ceatedBy` varchar(50) DEFAULT NULL,
  `modifiedBy` varchar(50) DEFAULT NULL,
  `isDeleted` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.prediction_contribution: ~3 rows (approximately)
DELETE FROM `prediction_contribution`;
/*!40000 ALTER TABLE `prediction_contribution` DISABLE KEYS */;
INSERT INTO `prediction_contribution` (`id`, `userId`, `code`, `name`, `description`, `leaguePointsPercentage`, `leaguePositionPercentage`, `head2headPercentage`, `lastMatchPlayedPercentage`, `awayHomePercentage`, `winDifference`, `winDrawDifference`, `drawDifference`, `numberOfHeadtohead`, `numberOfLastMatch`, `matchSelectionPercentage`, `createdDate`, `modifiedDate`, `ceatedBy`, `modifiedBy`, `isDeleted`) VALUES
	(1, NULL, 'DFT', 'Default', 'Default Predition Template', 40.00, 25.00, 10.00, 13.00, 2.00, 15.70, 6.90, 2.90, 4, 4, 99.0, NULL, NULL, NULL, NULL, 0),
	(2, 21, 'BGL', 'Testign 2', 'Begining Of league', 25.00, 10.00, 65.00, 10.00, 5.00, 15.70, 6.90, 2.90, 4, 4, 99.0, NULL, '2023-08-13 08:08:04', NULL, 'soccerprediction.co.za@gmail.com', 0),
	(3, 21, NULL, 'test', 'Default', 41.00, 26.00, 11.00, 16.00, 3.00, 16.70, 7.90, 3.90, 5, 5, 102.0, '2023-08-13 05:08:19', '2023-08-15 07:08:03', NULL, 'soccerprediction.co.za@gmail.com', 0);
/*!40000 ALTER TABLE `prediction_contribution` ENABLE KEYS */;

-- Dumping structure for table sp_platform.prediction_request
DROP TABLE IF EXISTS `prediction_request`;
CREATE TABLE IF NOT EXISTS `prediction_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `predictionRequestStatusId` int(11) NOT NULL,
  `predictionContributionId` int(11) NOT NULL,
  `requestedDate` date NOT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `fileName` varchar(200) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `views` int(11) DEFAULT 0,
  `notify` int(11) DEFAULT 0,
  `isDeleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.prediction_request: ~4 rows (approximately)
DELETE FROM `prediction_request`;
/*!40000 ALTER TABLE `prediction_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `prediction_request` ENABLE KEYS */;

-- Dumping structure for table sp_platform.prediction_request_status
DROP TABLE IF EXISTS `prediction_request_status`;
CREATE TABLE IF NOT EXISTS `prediction_request_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.prediction_request_status: ~2 rows (approximately)
DELETE FROM `prediction_request_status`;
/*!40000 ALTER TABLE `prediction_request_status` DISABLE KEYS */;
INSERT INTO `prediction_request_status` (`id`, `name`, `code`, `isDeleted`) VALUES
	(1, 'Pending', 'PG', 0),
	(2, 'In Progress', 'INP', 0),
	(3, 'Completed', 'CNP', 0);
/*!40000 ALTER TABLE `prediction_request_status` ENABLE KEYS */;

-- Dumping structure for table sp_platform.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `surname` varchar(100) NOT NULL DEFAULT '',
  `mobileNumber` varchar(20) NOT NULL DEFAULT '',
  `emailAddress` varchar(50) DEFAULT '',
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `isUserVerified` int(11) DEFAULT 0,
  `userRoleId` int(11) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `lastSignIn` datetime DEFAULT NULL,
  `userStatusId` int(11) NOT NULL,
  `isDeleted` int(1) DEFAULT 0,
  `confirmationCode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.user: ~6 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `surname`, `mobileNumber`, `emailAddress`, `username`, `password`, `isUserVerified`, `userRoleId`, `createdDate`, `modifiedDate`, `lastSignIn`, `userStatusId`, `isDeleted`, `confirmationCode`) VALUES
	(21, 'berka', 'ayowa', '', 'soccerprediction.co.za@gmail.com', 'soccerprediction.co.za@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 2, NULL, NULL, '2023-08-15 07:08:43', 2, 0, '5caf07a8f612f063e33c70191d50caae'),
	(22, 'berka', 'ayowa', '', 'ayowaberka@gmail.com', 'ayowaberka@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 1, 2, NULL, NULL, NULL, 1, 0, '54d1fb0eb09c146f4dc9df3da964de56');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table sp_platform.user_role
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idrole_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.user_role: ~2 rows (approximately)
DELETE FROM `user_role`;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`id`, `name`, `code`, `isDeleted`) VALUES
	(1, 'Administrator', 'ADM', 0),
	(2, 'Client', 'CLT', 0);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;

-- Dumping structure for table sp_platform.user_status
DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sp_platform.user_status: ~3 rows (approximately)
DELETE FROM `user_status`;
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` (`id`, `name`, `code`, `isDeleted`) VALUES
	(1, 'Padding for verification ', 'PFC', 0),
	(2, 'Account verified', 'PNC', 0),
	(3, 'Acoount Suspended', 'APD', 0);
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
