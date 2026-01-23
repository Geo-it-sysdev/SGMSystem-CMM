-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gradingsystem
CREATE DATABASE IF NOT EXISTS `gradingsystem` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `gradingsystem`;

-- Dumping structure for table gradingsystem.tbl_activities_header
CREATE TABLE IF NOT EXISTS `tbl_activities_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `grade_level` varchar(50) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `quarter` varchar(100) NOT NULL,
  `activity_type` varchar(100) DEFAULT NULL,
  `overall` int(11) DEFAULT NULL,
  `activity_date` date DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_activities_header: ~1 rows (approximately)
REPLACE INTO `tbl_activities_header` (`id`, `user_id`, `grade_level`, `subject`, `quarter`, `activity_type`, `overall`, `activity_date`, `description`, `created_at`, `status`) VALUES
	(1, 25, 'Grade 8', 'English', '1st Quarter', 'Quiz 1', 23, '2026-01-23', 'Written Works', '2026-01-23 09:16:42', 'active');

-- Dumping structure for table gradingsystem.tbl_activities_lines
CREATE TABLE IF NOT EXISTS `tbl_activities_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activities_id_header` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_name` varchar(100) DEFAULT NULL,
  `score` int(55) DEFAULT NULL,
  `section` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_activities_lines: ~8 rows (approximately)
REPLACE INTO `tbl_activities_lines` (`id`, `activities_id_header`, `student_id`, `student_name`, `score`, `section`, `remarks`, `date_created`) VALUES
	(1, 1, 1, 'Naruto Uzumaki', 23, 'Ephesians', NULL, '2026-01-23'),
	(2, 1, 4, 'Kakashi Hatake', 20, 'Ephesians', NULL, '2026-01-23'),
	(3, 1, 6, 'Hinata Hyuga', 21, 'Ephesians', NULL, '2026-01-23'),
	(4, 1, 2, 'Sakura Haruno', 21, 'Psalm', NULL, '2026-01-23'),
	(5, 1, 7, 'Mikasa Ackerman', 22, 'Psalm', NULL, '2026-01-23'),
	(6, 1, 8, 'Asuna Yuuki', 23, 'Psalm', NULL, '2026-01-23'),
	(7, 1, 3, 'Sasuke Uchiha', 19, 'Proverbs', NULL, '2026-01-23'),
	(8, 1, 5, 'Monkey D. Luffy', 20, 'Proverbs', NULL, '2026-01-23');

-- Dumping structure for table gradingsystem.tbl_addresses
CREATE TABLE IF NOT EXISTS `tbl_addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `type` enum('home','boarding','guardian') DEFAULT 'home',
  `street` varchar(255) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_addresses: ~0 rows (approximately)

-- Dumping structure for table gradingsystem.tbl_classrooms
CREATE TABLE IF NOT EXISTS `tbl_classrooms` (
  `rooms_id` int(11) NOT NULL AUTO_INCREMENT,
  `classrooms_name` varchar(100) NOT NULL,
  `grade_level` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`rooms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_classrooms: ~10 rows (approximately)
REPLACE INTO `tbl_classrooms` (`rooms_id`, `classrooms_name`, `grade_level`, `description`) VALUES
	(1, 'Proverbs', 'Grade 8', 'Proverbs – A collection of wise sayings teaching how to live with wisdom, righteousness, and the fear of God.'),
	(2, 'Psalm', 'Grade 8', 'Psalms – A collection of songs and prayers expressing worship, praise, thanksgiving, and trust in God.\r\n'),
	(4, 'Ephesians', 'Grade 8', 'Ephesians – A letter by Paul emphasizing unity in Christ, salvation by grace, and living a life worthy of God’s calling.\r\n'),
	(5, 'Deuteronomy', 'Grade 11', 'Deuteronomy – A book of Moses’ final speeches reminding Israel to obey God’s laws and remain faithful before entering the Promised Land.\r\n'),
	(6, 'Exodus', 'Grade 10', 'Exodus – Tells how God delivered the Israelites from slavery in Egypt and gave them the Ten Commandments through Moses.'),
	(7, 'Leviticus', 'Grade 11', 'Leviticus – Contains God’s laws given to Israel about worship, sacrifices, and living a holy life.'),
	(9, 'Corinthians', 'Grade 11', 'Corinthians – Letters by Apostle Paul to the church in Corinth, teaching about love, unity, faith, and living a righteous Christian life.'),
	(11, 'Simplicity', 'Grade 9', 'sample'),
	(12, 'Phoenix Nest', 'Grade 7', 'Phoenix Nest'),
	(13, 'Mystic Hall', 'Grade 7', 'Mystic Hall');

-- Dumping structure for table gradingsystem.tbl_students
CREATE TABLE IF NOT EXISTS `tbl_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT 'Male',
  `grade_level` varchar(100) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_students: ~18 rows (approximately)
REPLACE INTO `tbl_students` (`id`, `user_id`, `fullname`, `age`, `gender`, `grade_level`, `section`, `created_at`, `status`) VALUES
	(1, '25', 'Naruto Uzumaki', 24, 'Male', 'Grade 8', 'Ephesians', '2026-01-23', 'active'),
	(2, '25', 'Sakura Haruno', 23, 'Female', 'Grade 8', 'Psalm', '2026-01-23', 'active'),
	(3, '25', 'Sasuke Uchiha', 24, 'Male', 'Grade 8', 'Proverbs', '2026-01-23', 'active'),
	(4, '25', 'Kakashi Hatake', 24, 'Male', 'Grade 8', 'Ephesians', '2026-01-23', 'active'),
	(5, '25', 'Monkey D. Luffy', 24, 'Male', 'Grade 8', 'Proverbs', '2026-01-23', 'active'),
	(6, '25', 'Hinata Hyuga', 23, 'Female', 'Grade 8', 'Ephesians', '2026-01-23', 'active'),
	(7, '25', 'Mikasa Ackerman', 24, 'Female', 'Grade 8', 'Psalm', '2026-01-23', 'active'),
	(8, '25', 'Asuna Yuuki', 23, 'Female', 'Grade 8', 'Psalm', '2026-01-23', 'active'),
	(9, '25', 'Hinagiku Katsura', 23, 'Female', 'Grade 9', 'Simplicity', '2026-01-23', 'active'),
	(10, '25', 'Rukia Kuchiki', 24, 'Female', 'Grade 9', 'Simplicity', '2026-01-23', 'active'),
	(11, '25', 'Homura Akemi', 23, 'Female', 'Grade 9', 'Simplicity', '2026-01-23', 'active'),
	(12, '25', 'Izuku Midoriya', 23, 'Male', 'Grade 11', 'Corinthians', '2026-01-23', 'active'),
	(13, '25', 'Shoto Todoroki', 24, 'Male', 'Grade 11', 'Deuteronomy', '2026-01-23', 'active'),
	(14, '25', 'Lucy Heartfilia', 24, 'Female', 'Grade 11', 'Leviticus', '2026-01-23', 'active'),
	(15, '25', 'Gray Fullbuster', 23, 'Male', 'Grade 11', 'Corinthians', '2026-01-23', 'active'),
	(16, '25', 'Lelouch Lamperouge', 23, 'Male', 'Grade 11', 'Deuteronomy', '2026-01-23', 'active'),
	(17, '25', 'Kagome Higurashi', 23, 'Female', 'Grade 11', 'Leviticus', '2026-01-23', 'active'),
	(18, '25', 'Killua Zoldyck', 25, 'Male', 'Grade 9', 'Simplicity', '2026-01-23', 'active');

-- Dumping structure for table gradingsystem.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) DEFAULT NULL,
  `user_name` varchar(55) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `user_type` varchar(55) DEFAULT NULL,
  `grades` varchar(255) DEFAULT NULL,
  `subjects` varchar(255) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_users: ~6 rows (approximately)
REPLACE INTO `tbl_users` (`id`, `full_name`, `user_name`, `password`, `user_type`, `grades`, `subjects`, `status`, `photo`, `date_created`) VALUES
	(25, 'Jamisola, Nikke Joy ', 'nikke', '$2y$10$.DsPAPZKcqs22eMKEztlE.o3TIP1e5NACznGEDjPrti4X/I4lKHrm', 'Teacher', 'Grade 8, Grade 9, Grade 11', 'English, Mathematics, General Mathematics', 'Active', 'assets/images/users/d88b4c33632c4b745c08ce4b4a94068c.png', NULL),
	(32, 'Administrator', 'admin', '$2y$10$0UQ0KEi2dWWNnrHAo8KIOO5QU..e19aA1vTrVx0Mk1ttIgyblfTZO', 'Admin', '', '', 'Active', 'assets/images/users/beff50331226b4a890aabc869b25fbf6.jpg', '2025-10-21'),
	(41, 'Duterte, Rodrego Roa ', 'Duterte', '$2y$10$iW.Li1tUvBB.zTi06ZQzwuaAClMFLkYQoYryOTAk4DPIfag298bFe', 'Teacher', 'Grade 8, Grade 12', 'Filipino, Mathematics, Practical Research 2', 'Active', NULL, '2025-11-14'),
	(43, 'Way Boot', 'wayboot', '$2y$10$GH0/hNHdWzj8AutKiTpwEeGZofSIpzPvNtvdhJQJIhiyOecMn7PTS', 'Registrar', 'Grade 8, Grade 10, Grade 11', 'Empowerment Technologies (E-Tech)', 'Active', NULL, '2025-11-19'),
	(44, 'Principal', 'pal', '$2y$10$DC5oWbOa.2oEilE4HlZSPuWFy8ICM46k18skzSEJSa8rnp9uudqQC', 'Principal', '', '', 'Active', NULL, '2025-11-21'),
	(45, 'kupal teacher', 'kupals', '$2y$10$oPWugO/Fq4/K1A9IOOuZv.kUR/MutYEvt7sbzqTLrCNVYas8HJYP2', 'Teacher', 'Grade 8, Grade 9, Grade 10, Grade 11', 'English, Mathematics', 'Active', NULL, '2026-01-22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
