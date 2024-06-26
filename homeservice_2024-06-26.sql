# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: homeservice
# Generation Time: 2024-06-26 07:52:04 +0000
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
  `user_id` int(11) NOT NULL,
  `approved` enum('pending','approved','rejected') DEFAULT 'pending',
  `notification_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;

INSERT INTO `bookings` (`id`, `name`, `address`, `service_type`, `cleaning_spec`, `date`, `start_time`, `duration`, `payment_method`, `total`, `user_id`, `approved`, `notification_sent`, `created_at`)
VALUES
	(1,'Adil','pppp','cleaning','wjjs','2024-06-18','12:30:00',5,'cash',325000,0,'approved',1,'2024-06-18 09:36:59'),
	(3,'ppp','dkldk','DishWash','fjdo','2024-06-18','12:45:00',4,'cash',200000,0,'rejected',1,'2024-06-18 09:52:19'),
	(5,'ffff','fff','CarWash','ggg','2024-06-18','14:00:00',2,'cash',200000,0,'rejected',1,'2024-06-18 12:07:19'),
	(6,'ppp','smksmks','GenerakClean','wkkw','2024-06-20','12:00:00',4,'cash',260000,0,'approved',1,'2024-06-18 13:44:25'),
	(7,'wjkwjw','wkwklw','GenerakClean','qjwj','2024-06-18','12:03:00',3,'cash',195000,0,'approved',1,'2024-06-18 13:50:03'),
	(8,'djkdjd','dnjd','GenerakClean','jkjd','2024-06-26','12:30:00',4,'cash',260000,3,'approved',1,'2024-06-26 11:01:06');

/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(64) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;

INSERT INTO `services` (`id`, `name`, `description`, `image`, `price`, `details`)
VALUES
	(1,'General Cleaning','<li>Membersihkan kamar Tidur</li>\n<li>Membersihkan Kamar Mandi atau Toilet</li>\n<li>Mengepel Lantai</li>','assets/vacum.png',65000,'<li>Minimal pemesanan 2 jam</li><li>Meliputi kamar tidur, kamar mandi, ruang tamu, dapur dan teras (untuk hasil maksimal, luas total +/- 45m2)</li><li>Estimasi pengerjaan 20-30 menit setiap ruangan</li><li>Jam operasional mulai pukul 08.00 – 19.00 WIB. Pukul 19.00 WIB adalah last order untuk 2 jam, berakhir pada pukul 21.00 WIB.</li>'),
	(2,'Dish Wash','<li>Cuci Piring</li>\n<li>Membantu Menyusun Rak Piring</li>\n<li>Merapihkan Alat Dapur</li>\n<li>Harga Mulai 50.000/Jam</li>','assets/piring.png',50000,'<li>Minimal pemesanan 2 jam</li><li>Estimasi pengerjaan 20-30 menit</li><li>Tidak diperuntukkan bagi acara besar ataupun pesta</li><li>Jam operasional mulai pukul 08.00 – 19.00 WIB. Pukul 19.00 WIB adalah last order untuk 2 jam, berakhir pada pukul 21.00 WIB.</li>'),
	(3,'Car Wash',' <li>Menghilangkan Jamur & Baret</li>\n<li>Membersihkan Kerak dan Minyak Di Mobil</li>\n<li>Coating Mobil</li>','assets/mobil.png',100000,'<li>Minimal pemesanan 2 jam</li><li>Estimasi pengerjaan 1-2 jam</li><li>Jam operasional mulai pukul 08.00 – 19.00 WIB. Pukul 19.00 WIB adalah last order untuk 2 jam, berakhir pada pukul 21.00 WIB.</li>'),
	(5,'fkljlke','fkejfkejf','assets/Screenshot 2024-06-18 at 13.49.15.png',40000,'fjfjjfjjf');

/*!40000 ALTER TABLE `services` ENABLE KEYS */;
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
  `role` enum('Admin','User') NOT NULL DEFAULT 'User',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `notelp`, `alamat`, `role`)
VALUES
	(1,'Adil Fathi','adlftha3625@djhjsd.com','$2y$10$YPWbl1F7Ye1eUUDB2WxWc.eFDwbjykLJC6ZDB14WktQ9ZCFkAvola',882303,'dskskdlks','Admin'),
	(2,'ppp','djkjdkd@jskj.com','$2y$10$tuYRzUpp/75SBahfL3bWQ.Ivavm107W8X4WcbTq7i73VKSY.RqB2S',983983,'2wkjskw','User'),
	(3,'Ilham','ilham@123.com','$2y$10$Xp1NpMOI/uL3jYDXMxvyTehT0bIcGa2sOTugL8rrGfQLTUtftNrzC',380823,'djoklsj','User');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
