-- --------------------------------------------------------
-- Host:                         ***REMOVED***
-- Server version:               ***REMOVED***
-- Server OS:                    ***REMOVED***
-- HeidiSQL Version:             ***REMOVED***
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ***REMOVED***
CREATE DATABASE IF NOT EXISTS `***REMOVED***` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `***REMOVED***`;

-- Dumping structure for table ***REMOVED***.Accounts
CREATE TABLE IF NOT EXISTS `Accounts` (
  `USER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table ***REMOVED***.Passwords
CREATE TABLE IF NOT EXISTS `Passwords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(10) unsigned NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`USER_ID`),
  CONSTRAINT `Passwords_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `Accounts` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
