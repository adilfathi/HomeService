# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: homeservice
# Generation Time: 2024-06-18 07:01:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bookings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `cleaning_spec` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `approved` enum('pending','approved','rejected') DEFAULT 'pending',
  `notification_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;

INSERT INTO `bookings` (`id`, `name`, `address`, `service_type`, `cleaning_spec`, `date`, `start_time`, `duration`, `payment_method`, `total`, `approved`, `notification_sent`, `created_at`)
VALUES
	(1,'Adil','pppp','cleaning','wjjs','2024-06-18','12:30:00',5,'cash',325000,'approved',1,'2024-06-18 09:36:59'),
	(3,'ppp','dkldk','DishWash','fjdo','2024-06-18','12:45:00',4,'cash',200000,'rejected',1,'2024-06-18 09:52:19'),
	(5,'ffff','fff','CarWash','ggg','2024-06-18','14:00:00',2,'cash',200000,'rejected',1,'2024-06-18 12:07:19'),
	(6,'ppp','smksmks','GenerakClean','wkkw','2024-06-20','12:00:00',4,'cash',260000,'approved',1,'2024-06-18 13:44:25'),
	(7,'wjkwjw','wkwklw','GenerakClean','qjwj','2024-06-18','12:03:00',3,'cash',195000,'pending',0,'2024-06-18 13:50:03');

/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `notelp` int(64) DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `notelp`, `alamat`)
VALUES
	(1,'Adil Fathi','adlftha3625@djhjsd.com','$2y$10$YPWbl1F7Ye1eUUDB2WxWc.eFDwbjykLJC6ZDB14WktQ9ZCFkAvola',882303,'dskskdlks'),
	(2,'ppp','djkjdkd@jskj.com','$2y$10$tuYRzUpp/75SBahfL3bWQ.Ivavm107W8X4WcbTq7i73VKSY.RqB2S',983983,'2wkjskw');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
