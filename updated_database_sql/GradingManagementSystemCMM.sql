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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_activities_header: ~14 rows (approximately)
REPLACE INTO `tbl_activities_header` (`id`, `user_id`, `grade_level`, `subject`, `quarter`, `activity_type`, `overall`, `activity_date`, `description`, `created_at`, `status`) VALUES
	(1, 25, 'Grade 8', 'English', '1st Quarter', 'Quiz 1', 23, '2026-01-23', 'Written Works', '2026-01-23 09:16:42', 'active'),
	(2, 25, 'Grade 8', 'English', '1st Quarter', 'Performance Task 1', 50, '2026-01-27', 'Performance Task', '2026-01-27 06:53:39', 'active'),
	(3, 25, 'Grade 8', 'English', '1st Quarter', 'Project 1', 50, '2026-01-27', 'Performance Task', '2026-01-27 06:58:06', 'active'),
	(4, 25, 'Grade 8', 'English', '1st Quarter', 'Quiz 2', 30, '2026-01-27', 'Quarterly Assessment', '2026-01-27 07:00:24', 'active'),
	(5, 25, 'Grade 8', 'English', '1st Quarter', 'Exam 1', 25, '2026-01-27', 'Written Works', '2026-01-27 07:03:31', 'active'),
	(6, 25, 'Grade 9', 'English', '1st Quarter', 'Activity Sheets 1', 30, '2026-01-27', 'Written Works', '2026-01-27 09:12:16', 'active'),
	(8, 45, 'Grade 8', 'English', '1st Quarter', 'Activity Sheets 1', 12, '2026-01-27', 'Written Works', '2026-01-27 09:25:31', 'active'),
	(9, 25, 'Grade 8', 'English', '1st Quarter', 'Activity Sheets 2', 30, '2026-01-28', 'Written Works', '2026-01-28 06:15:11', 'active'),
	(10, 41, 'Grade 8', 'Mathematics', '1st Quarter', 'Performance Task 1', 30, '2026-01-28', 'Performance Task', '2026-01-28 06:49:03', 'active'),
	(11, 25, 'Grade 8', 'Mathematics', '1st Quarter', 'Activity Sheets 1', 23, '2026-01-28', 'Written Works', '2026-01-28 07:16:32', 'active'),
	(12, 25, 'Grade 9', 'Mathematics', '1st Quarter', 'Assignment 1', 25, '2026-01-28', 'Written Works', '2026-01-28 08:22:57', 'active'),
	(13, 25, 'Grade 9', 'English', '1st Quarter', 'Quiz 1', 30, '2026-01-28', 'Quarterly Assessment', '2026-01-28 08:23:24', 'active'),
	(14, 25, 'Grade 8', 'English', '2nd Quarter', 'Quiz 1', 50, '2026-01-28', 'Performance Task', '2026-01-28 08:31:55', 'active'),
	(15, 25, 'Grade 11', 'General Mathematics', '1st Quarter', 'Performance Task 1', 50, '2026-01-29', 'Performance Task', '2026-01-29 00:22:44', 'active');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_activities_lines: ~27 rows (approximately)
REPLACE INTO `tbl_activities_lines` (`id`, `activities_id_header`, `student_id`, `student_name`, `score`, `section`, `remarks`, `date_created`) VALUES
	(1, 1, 1, 'Naruto Uzumaki', 20, 'Ephesians', '86.96% - Passed', '2026-01-28'),
	(2, 1, 4, 'Kakashi Hatake', 22, 'Ephesians', '95.65% - Passed', '2026-01-28'),
	(3, 1, 6, 'Hinata Hyuga', 18, 'Ephesians', '78.26% - Passed', '2026-01-28'),
	(4, 1, 19, 'Geovanne, Berro Daganato', 21, 'Ephesians', '91.30% - Passed', '2026-01-28'),
	(5, 1, 20, 'moscov', 23, 'Ephesians', '100.00% - Passed', '2026-01-28'),
	(6, 1, 3, 'Sasuke Uchiha', 23, 'Proverbs', '100.00% - Passed', '2026-01-28'),
	(7, 1, 5, 'Monkey D. Luffy', 23, 'Proverbs', '100.00% - Passed', '2026-01-28'),
	(8, 1, 2, 'Sakura Haruno', 23, 'Psalm', '100.00% - Passed', '2026-01-28'),
	(9, 1, 7, 'Mikasa Ackerman', 22, 'Psalm', '95.65% - Passed', '2026-01-28'),
	(10, 1, 8, 'Asuna Yuuki', 21, 'Psalm', '91.30% - Passed', '2026-01-28'),
	(11, 2, 1, 'Naruto Uzumaki', 42, 'Ephesians', '84.00% - Passed', '2026-01-28'),
	(12, 2, 4, 'Kakashi Hatake', 47, 'Ephesians', '94.00% - Passed', '2026-01-28'),
	(13, 2, 6, 'Hinata Hyuga', 41, 'Ephesians', '82.00% - Passed', '2026-01-28'),
	(14, 2, 19, 'Geovanne, Berro Daganato', 45, 'Ephesians', '90.00% - Passed', '2026-01-28'),
	(15, 2, 20, 'moscov', 43, 'Ephesians', '86.00% - Passed', '2026-01-28'),
	(16, 2, 3, 'Sasuke Uchiha', 43, 'Proverbs', '86.00% - Passed', '2026-01-28'),
	(17, 2, 5, 'Monkey D. Luffy', 48, 'Proverbs', '96.00% - Passed', '2026-01-28'),
	(18, 2, 2, 'Sakura Haruno', 46, 'Psalm', '92.00% - Passed', '2026-01-28'),
	(19, 2, 7, 'Mikasa Ackerman', 45, 'Psalm', '90.00% - Passed', '2026-01-28'),
	(20, 2, 8, 'Asuna Yuuki', 43, 'Psalm', '86.00% - Passed', '2026-01-28'),
	(21, 3, 1, 'Naruto Uzumaki', 46, 'Ephesians', '92.00% - Passed', '2026-01-28'),
	(22, 3, 4, 'Kakashi Hatake', 43, 'Ephesians', '86.00% - Passed', '2026-01-28'),
	(23, 3, 6, 'Hinata Hyuga', 47, 'Ephesians', '94.00% - Passed', '2026-01-28'),
	(24, 3, 19, 'Geovanne, Berro Daganato', 45, 'Ephesians', '90.00% - Passed', '2026-01-28'),
	(25, 3, 20, 'moscov', 44, 'Ephesians', '88.00% - Passed', '2026-01-28'),
	(26, 3, 3, 'Sasuke Uchiha', 46, 'Proverbs', '92.00% - Passed', '2026-01-28'),
	(27, 3, 5, 'Monkey D. Luffy', 45, 'Proverbs', '90.00% - Passed', '2026-01-28'),
	(28, 3, 2, 'Sakura Haruno', 48, 'Psalm', '96.00% - Passed', '2026-01-28'),
	(29, 3, 7, 'Mikasa Ackerman', 50, 'Psalm', '100.00% - Passed', '2026-01-28'),
	(30, 3, 8, 'Asuna Yuuki', 49, 'Psalm', '98.00% - Passed', '2026-01-28');

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

-- Dumping structure for table gradingsystem.tbl_chat_messages
CREATE TABLE IF NOT EXISTS `tbl_chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `status` enum('sent','read') DEFAULT 'sent',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_chat_messages: ~4 rows (approximately)
REPLACE INTO `tbl_chat_messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `status`) VALUES
	(1, 32, 0, 'Good Morning ^_^', '2026-01-29 07:05:11', 'sent'),
	(2, 25, 0, 'Good morning, How are you? What about our next meeting?', '2026-01-29 07:06:15', 'sent'),
	(3, 32, 0, 'Yeah everything is fine. Our next meeting tomorrow at 10.00 AM', '2026-01-29 07:07:30', 'sent'),
	(4, 32, 0, 'Hey, I\'m going to meet a friend of mine at the department store. I have to buy some presents for my parents ????.', '2026-01-29 07:08:13', 'sent'),
	(5, 41, 0, 'I like beautiful women. I really like them. And I don’t hide it.', '2026-01-29 07:19:07', 'sent'),
	(6, 41, 0, 'I don’t give a f** about what they say. I answer only to the Filipino people.', '2026-01-29 07:19:34', 'sent');

-- Dumping structure for table gradingsystem.tbl_classrooms
CREATE TABLE IF NOT EXISTS `tbl_classrooms` (
  `rooms_id` int(11) NOT NULL AUTO_INCREMENT,
  `classrooms_name` varchar(100) NOT NULL,
  `grade_level` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`rooms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_classrooms: ~9 rows (approximately)
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

-- Dumping structure for table gradingsystem.tbl_ssg_members
CREATE TABLE IF NOT EXISTS `tbl_ssg_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table gradingsystem.tbl_ssg_members: ~11 rows (approximately)
REPLACE INTO `tbl_ssg_members` (`id`, `student_id`, `student_name`, `profession`, `created_at`, `status`) VALUES
	(6, 1, 'Naruto Uzumaki', 'Vice President', '2026-01-29 04:02:16', 'active'),
	(7, 6, 'Hinata Hyuga', 'Secretary', '2026-01-29 04:03:23', 'active'),
	(8, 4, 'Kakashi Hatake', 'Treasurer', '2026-01-29 04:03:36', 'active'),
	(9, 7, 'Mikasa Ackerman', 'President', '2026-01-29 04:03:54', 'active'),
	(10, 5, 'Monkey D. Luffy', 'Auditor', '2026-01-29 04:04:53', 'active'),
	(11, 3, 'Sasuke Uchiha', 'PIO', '2026-01-29 05:11:55', 'active'),
	(12, 9, 'Hinagiku Katsura', 'Sgt. at Arms', '2026-01-29 05:12:20', 'active'),
	(13, 0, 'Killua Zoldyck', 'Sgt. at Arms', '2026-01-29 05:12:42', 'active'),
	(14, 12, 'Izuku Midoriya', 'Sgt. at Arms', '2026-01-29 05:13:02', 'active'),
	(15, 0, 'Shoto Todoroki', 'Sgt. at Arms', '2026-01-29 05:14:26', 'active'),
	(16, 17, 'Kagome Higurashi', 'Sgt. at Arms', '2026-01-29 05:17:47', 'active');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_students: ~19 rows (approximately)
REPLACE INTO `tbl_students` (`id`, `user_id`, `fullname`, `age`, `gender`, `grade_level`, `section`, `created_at`, `status`) VALUES
	(1, '32', 'Naruto Uzumaki', 24, 'Male', 'Grade 8', 'Ephesians', '2026-01-23', 'active'),
	(2, '32', 'Sakura Haruno', 23, 'Female', 'Grade 8', 'Psalm', '2026-01-23', 'active'),
	(3, '32', 'Sasuke Uchiha', 24, 'Male', 'Grade 8', 'Proverbs', '2026-01-23', 'active'),
	(4, '32', 'Kakashi Hatake', 24, 'Male', 'Grade 8', 'Ephesians', '2026-01-23', 'active'),
	(5, '32', 'Monkey D. Luffy', 24, 'Male', 'Grade 8', 'Proverbs', '2026-01-23', 'active'),
	(6, '32', 'Hinata Hyuga', 23, 'Female', 'Grade 8', 'Ephesians', '2026-01-23', 'active'),
	(7, '32', 'Mikasa Ackerman', 24, 'Female', 'Grade 8', 'Psalm', '2026-01-23', 'active'),
	(8, '32', 'Asuna Yuuki', 23, 'Female', 'Grade 8', 'Psalm', '2026-01-23', 'active'),
	(9, '32', 'Hinagiku Katsura', 23, 'Female', 'Grade 9', 'Simplicity', '2026-01-23', 'active'),
	(10, '32', 'Rukia Kuchiki', 24, 'Female', 'Grade 9', 'Simplicity', '2026-01-23', 'active'),
	(11, '32', 'Homura Akemi', 23, 'Female', 'Grade 9', 'Simplicity', '2026-01-23', 'active'),
	(12, '32', 'Izuku Midoriya', 23, 'Male', 'Grade 11', 'Corinthians', '2026-01-23', 'active'),
	(13, '32', 'Shoto Todoroki', 24, 'Male', 'Grade 11', 'Deuteronomy', '2026-01-23', 'active'),
	(14, '32', 'Lucy Heartfilia', 24, 'Female', 'Grade 11', 'Leviticus', '2026-01-23', 'active'),
	(15, '32', 'Gray Fullbuster', 23, 'Male', 'Grade 11', 'Corinthians', '2026-01-23', 'active'),
	(16, '32', 'Lelouch Lamperouge', 23, 'Male', 'Grade 11', 'Deuteronomy', '2026-01-23', 'active'),
	(17, '32', 'Kagome Higurashi', 23, 'Female', 'Grade 11', 'Leviticus', '2026-01-23', 'active'),
	(18, '32', 'Killua Zoldyck', 25, 'Male', 'Grade 9', 'Simplicity', '2026-01-23', 'active'),
	(19, '32', 'Geovanne, Berro Daganato', 12, 'Male', 'Grade 8', 'Ephesians', '2026-01-28', 'active'),
	(20, '32', 'moscov', 23, 'Male', 'Grade 8', 'Ephesians', '2026-01-27', 'active');

-- Dumping structure for table gradingsystem.tbl_tag_students
CREATE TABLE IF NOT EXISTS `tbl_tag_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_tag_students: ~27 rows (approximately)
REPLACE INTO `tbl_tag_students` (`id`, `student_id`, `user_id`, `status`) VALUES
	(1, 1, 25, 'active'),
	(2, 4, 25, 'active'),
	(3, 6, 25, 'active'),
	(4, 19, 25, 'active'),
	(5, 20, 25, 'active'),
	(6, 3, 25, 'active'),
	(7, 5, 25, 'active'),
	(8, 2, 25, 'active'),
	(9, 7, 25, 'active'),
	(10, 8, 25, 'active'),
	(11, 9, 25, 'active'),
	(12, 10, 25, 'active'),
	(13, 11, 25, 'active'),
	(14, 18, 25, 'active'),
	(15, 12, 25, 'active'),
	(16, 15, 25, 'active'),
	(17, 14, 25, 'active'),
	(18, 17, 25, 'active'),
	(19, 13, 25, 'active'),
	(20, 16, 25, 'active'),
	(21, 1, 41, 'active'),
	(22, 4, 41, 'active'),
	(23, 6, 41, 'active'),
	(24, 19, 41, 'active'),
	(25, 20, 41, 'active'),
	(26, 3, 41, 'active'),
	(27, 5, 41, 'active'),
	(28, 8, 41, 'active'),
	(29, 7, 41, 'active'),
	(30, 2, 41, 'active');

-- Dumping structure for table gradingsystem.tbl_upcoming_events
CREATE TABLE IF NOT EXISTS `tbl_upcoming_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `event_date` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table gradingsystem.tbl_upcoming_events: ~5 rows (approximately)
REPLACE INTO `tbl_upcoming_events` (`id`, `user_id`, `event_date`, `description`, `created_at`) VALUES
	(2, 25, '2026-01-29 07:30:00', '1st Day Midterm Exam', '2026-01-29 02:22:47'),
	(3, 25, '2026-01-30 08:00:00', '2nd Day Midterm Exam', '2026-01-29 02:28:07'),
	(4, 25, '2026-02-14 07:30:00', 'Valentine’s Day!', '2026-01-29 02:36:25'),
	(5, 25, '2026-05-01 08:00:00', 'Feista sa amoa hehe', '2026-01-29 02:42:54'),
	(6, 25, '2026-02-01 00:00:00', 'Chinese New Year in 2026', '2026-01-29 05:25:20'),
	(7, 25, '2026-01-31 06:00:00', 'Ting Relax hehe', '2026-01-29 06:24:03'),
	(8, 25, '2026-01-01 00:00:00', 'New Year', '2026-01-29 06:41:13');

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
	(25, 'Jamisola, Nikke Joy ', 'nikke', '$2y$10$.DsPAPZKcqs22eMKEztlE.o3TIP1e5NACznGEDjPrti4X/I4lKHrm', 'Teacher', 'Grade 8, Grade 9, Grade 11', 'English, Mathematics, General Mathematics', 'Active', 'assets/images/users/777f4df02475eaf861c7f064f1122cb2.png', NULL),
	(32, 'Administrator', 'admin', '$2y$10$0UQ0KEi2dWWNnrHAo8KIOO5QU..e19aA1vTrVx0Mk1ttIgyblfTZO', 'Admin', '', '', 'Active', 'assets/images/users/beff50331226b4a890aabc869b25fbf6.jpg', '2025-10-21'),
	(41, 'Duterte, Rodrego Roa ', 'Duterte', '$2y$10$iW.Li1tUvBB.zTi06ZQzwuaAClMFLkYQoYryOTAk4DPIfag298bFe', 'Teacher', 'Grade 8, Grade 12', 'Filipino, Mathematics, Practical Research 2', 'Active', 'assets/images/users/5d2ebe800c63ff9aeb11edf5b698da27.jpg', '2025-11-14'),
	(43, 'Way Boot', 'wayboot', '$2y$10$GH0/hNHdWzj8AutKiTpwEeGZofSIpzPvNtvdhJQJIhiyOecMn7PTS', 'Registrar', 'Grade 8, Grade 10, Grade 11', 'Empowerment Technologies (E-Tech)', 'Active', NULL, '2025-11-19'),
	(44, 'Principal', 'pal', '$2y$10$DC5oWbOa.2oEilE4HlZSPuWFy8ICM46k18skzSEJSa8rnp9uudqQC', 'Principal', '', '', 'Active', NULL, '2025-11-21'),
	(45, 'kupal teacher', 'kupals', '$2y$10$oPWugO/Fq4/K1A9IOOuZv.kUR/MutYEvt7sbzqTLrCNVYas8HJYP2', 'Teacher', 'Grade 8, Grade 9, Grade 10, Grade 11', 'English, Mathematics', 'Active', NULL, '2026-01-22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
