-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2018 at 09:36 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weblistb_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `current_year` enum('Yes','No','') NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `name`, `description`, `start_date`, `end_date`, `current_year`, `status`, `date_added`, `date_modified`) VALUES
(1, 'AY-2018-2019', 'Academic year -2018-2019', '2018-06-01', '2019-05-31', 'Yes', 'Active', '2018-10-29 08:10:14', '2018-10-29 08:10:14'),
(2, 'AY-2017-2018', 'Academic year - 2017-2018', '2017-06-01', '2018-05-31', 'No', 'Active', '2018-10-29 08:10:14', '2018-10-30 13:09:49'),
(3, 'AY-2019-2020', 'Academic year - 2019-2020', '2019-06-01', '2020-05-31', 'No', 'Active', '2018-10-29 08:10:14', '2018-10-29 08:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Deactive','Suspended','Deleted','') DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `course_id`, `teacher_id`, `name`, `date_added`, `date_modified`) VALUES
(1, 1, 1, 'Section A', '2018-10-26 12:52:35', '2018-10-26 12:52:35'),
(2, 1, 2, 'Section B', '2018-10-26 12:52:35', '2018-10-26 12:55:38'),
(3, 2, 1, 'Section A', '2018-10-26 12:52:35', '2018-10-26 12:55:41'),
(4, 2, 2, 'Section B', '2018-10-26 12:52:35', '2018-10-26 12:52:35'),
(5, 1, 3, 'Section C', '2018-10-26 12:52:35', '2018-10-26 12:55:38'),
(6, 2, 3, 'Section C', '2018-10-26 12:52:35', '2018-10-26 12:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `academic_id`, `name`, `details`, `date_added`, `date_modified`) VALUES
(1, 1, '1st Standard', '1st Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:03'),
(2, 1, '2nd Standard', '2nd Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:06'),
(3, 1, '3rd Standard', '3rd Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:09'),
(4, 1, '4th Standard', '4th Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:11'),
(5, 1, '5th Standard', '5th Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:13'),
(6, 2, '5th Standard', '5th Standard', '2018-10-26 12:48:40', '2018-10-29 10:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('Text','Textarea','File') NOT NULL DEFAULT 'Text',
  `used_for` set('Student','Parent','Teacher','Admin','Course') NOT NULL DEFAULT 'Student',
  `required` enum('True','False','') NOT NULL DEFAULT 'False',
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `name`, `title`, `type`, `used_for`, `required`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Aadhar Number', 'aadhar_number', 'Textarea', 'Student', 'False', 'Active', '2018-10-31 07:11:07', '2018-10-31 10:15:29'),
(2, 'Land line', 'land_line', 'Text', 'Student', 'True', 'Active', '2018-10-31 07:11:07', '2018-10-31 09:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `privacy` enum('All','Teacher','Student','Parent','Admin','Bus Supervisor','Manager','') NOT NULL DEFAULT 'All',
  `event_date` date NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `status` enum('Active','Deactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `details`, `type`, `privacy`, `event_date`, `start_time`, `end_time`, `organizer`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Wednesday missing', 'Some time happe when you deeply involved in worl and you forgot days.', 'Meetings', 'All', '2018-10-25', '3:00PM', '5:00PM', 'Dr.Rajkumar A', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:43:16'),
(2, 'Sports Day', 'We are planning to conduct the Sports day at School/College Staium.', 'Function', 'Teacher', '2018-10-26', '12:00PM', '2:00PM', 'Mr.Sarabrish', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:34:32'),
(3, 'Sports Day', 'We are planning to conduct the Freshers Day on School Auditorium.', 'Announcement', 'Student', '2018-10-31', '2:00PM', '4:00PM', 'Mr.Senthil', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:34:36'),
(4, 'Sports Day1', 'We are planning to conduct the Freshers Day on School Auditorium.', 'Announcement1', 'Admin', '2018-11-21', '2:00PM', '4:00PM', 'Mr.Senthil', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:34:40'),
(5, 'Sports Day2', 'We are planning to conduct the Freshers Day on School Auditorium.', 'Announcement2', 'Bus Supervisor', '2018-11-14', '2:00PM', '4:00PM', 'Mr.Senthil', 'Active', '2018-10-24 13:17:38', '2018-10-25 07:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `title` int(11) NOT NULL,
  `type` enum('Marks','Grades','Marks & Grades','') NOT NULL DEFAULT 'Marks',
  `exam_date` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL DEFAULT 'All',
  `leave_date` date NOT NULL DEFAULT '0000-00-00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `title`, `class`, `leave_date`, `date_added`, `date_modified`) VALUES
(1, 'Dewali', 'All', '2018-10-25', '2018-10-25 09:16:27', '2018-10-25 09:31:05'),
(2, 'Ayutha Pooja', '1,2,3', '2018-10-26', '2018-10-25 09:16:27', '2018-10-25 09:18:29'),
(3, 'Muharam', 'All', '2018-10-27', '2018-10-25 09:16:27', '2018-10-25 09:19:14'),
(4, 'Christmas', 'All', '2018-10-29', '2018-10-25 09:16:27', '2018-10-25 09:19:19'),
(5, 'Dusshera', '1,3,4,5', '2018-10-31', '2018-10-25 09:16:27', '2018-10-25 09:19:47'),
(6, 'Independence Day', 'All', '2018-10-31', '2018-10-25 09:16:27', '2018-10-25 09:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` enum('Active','Deactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `details`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Wednesday missing', 'Some time happe when you deeply involved in worl and you forgot days.', 'Active', '2018-10-24 13:17:38', '2018-10-24 13:17:38'),
(2, 'Sports Day', 'We are planning to conduct the Sports day at School/College Staium.', 'Active', '2018-10-24 13:17:38', '2018-10-24 13:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `relationship` enum('Father','Mother','Sibiling','Others','') NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `office_phone` varchar(20) NOT NULL,
  `education` varchar(100) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `gender` set('Male','Female','Others','') NOT NULL,
  `income` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `role` enum('All','For Details','') NOT NULL DEFAULT 'All',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Deactive','Suspended','Deleted','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `relationship`, `first_name`, `last_name`, `mobile`, `email`, `password`, `office_phone`, `education`, `occupation`, `gender`, `income`, `dob`, `address`, `city_id`, `state_id`, `country_id`, `pincode`, `role`, `created_by`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Father', 'Rajakumar2', 'Anbalagan', '9092310791', 'rjkumar856@gmail.com', '', '', 'BE', 'Software Engineer', '', 'Rs.300000 per Annum', '1990-10-24', 'E-City', 1, 1, 1, '', 'All', 1, 'Active', '2018-10-24 06:27:22', '2018-10-30 07:11:59'),
(2, 'Mother', 'Suresh', 'P', '9092310795', 'rjkumar855@gmail.com', '', '', 'BCS', 'Self Employed', '', 'Rs.100000 per Annum', '1990-10-17', 'BTM Layout', 1, 1, 1, '', 'All', 1, 'Active', '2018-10-24 06:27:22', '2018-10-30 07:05:02'),
(3, 'Mother', 'Lokesh', 'K', '9092310794', 'rjkumar855@gmail.com', '', '', 'Ph.D', 'Teacher', '', 'Rs.400000 per Annum', '1990-10-17', 'BTM Layout', 1, 1, 1, '', 'All', 1, 'Active', '2018-10-24 06:27:22', '2018-11-09 07:37:07'),
(4, 'Father', 'Ashutosh', 'K', '9092310793', 'rjkumar854@gmail.com', '', '', 'Ph.D', 'Teacher', '', 'Rs.400000 per Annum', '1990-10-17', 'BTM Layout', 1, 1, 1, '', 'All', 1, 'Active', '2018-10-24 06:27:22', '2018-11-09 07:37:07'),
(5, 'Father', 'Rajsaku', 'sadsad', '9092310799', 'rjkumar859@gmail.com', '0iM9AVETTpYH2oK9JCc7gZBrmsXPNw29mzcmEYCtd8HMVFkVx249SAT/l5t0B5vSzEOpwmtzyHXKrP5qRk2Kyg==', 'asdwqesadsa', 'BEf', 'Software asdsa  sdaasd', 'Male', 'Rs.1000 month', '2016-02-01', 'sadsad dfdsfdsf', 1, 1, 1, '534336', 'All', 1, 'Active', '2018-11-12 13:03:16', '2018-11-12 13:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL,
  `options` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `options`, `value`, `date_added`, `date_modified`) VALUES
(1, 'application_status', 'Active', '2018-11-13 03:48:37', '2018-11-13 03:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_key` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT '',
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Others','') NOT NULL DEFAULT 'Male',
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-','') NOT NULL DEFAULT '',
  `doj` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `admission_number` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Deactive','Terminated','Transfered','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `roll_number`, `first_name`, `middle_name`, `last_name`, `mobile`, `email`, `password`, `access_key`, `photo`, `dob`, `gender`, `blood_group`, `doj`, `address`, `city_id`, `state_id`, `country_id`, `pincode`, `class_id`, `admission_number`, `created_by`, `status`, `date_added`, `date_modified`) VALUES
(1, 'SCE1', 'Rajakumar3', '', 'Anbalagan', '9092310791', 'rjkumar856@gmail.com', '', '', '', '1990-10-24', 'Male', 'A+', '2018-10-24', 'E-city', 1, 1, 1, '', 1, '1', 1, 'Active', '2018-10-24 06:28:33', '2018-10-26 13:11:07'),
(2, 'SCE2', 'Lokesh', '', 'Kumar Karri', '9092310792', 'rjkumar858@gmail.com', '', '', '', '1990-10-31', 'Male', 'A-', '2018-10-24', 'HSR Layout', 1, 1, 1, '', 2, '2', 1, 'Deactive', '2018-10-24 06:28:33', '2018-10-30 05:33:06'),
(3, 'SCE3', 'Suresh', '', 'K', '9092310793', 'rjkumar857@gmail.com', '', '', '', '1990-10-31', 'Male', 'B+', '2018-10-24', 'HSR Layout', 1, 1, 1, '', 3, '3', 1, 'Active', '2018-10-24 06:28:33', '2018-10-30 05:32:04'),
(4, 'SCE4', 'Raj1', '', 'Anbalagan', '9092310794', 'rjkumar8561@gmail.com', '', '', '', '1990-10-24', 'Female', 'B-', '2018-10-24', 'E-city1', 1, 1, 1, '', 4, '4', 1, 'Terminated', '2018-10-24 06:28:33', '2018-10-30 05:32:09'),
(5, 'SCE5', 'Lokesh2', '', 'K', '9092310795', 'rjkumar8582@gmail.com', '', '', '', '1990-10-31', 'Female', 'O+', '2018-10-24', 'HSR Layout', 1, 1, 1, '', 5, '5', 1, 'Terminated', '2018-10-24 06:28:33', '2018-10-30 05:32:12'),
(6, 'SCE6', 'Suresh2', '', 'K', '9092310796', 'rjkumar8563@gmail.com', '', '', '', '1990-10-31', 'Others', 'O-', '2018-10-24', 'HSR Layout', 1, 1, 1, '', 6, '6', 1, 'Transfered', '2018-10-24 06:28:33', '2018-10-30 05:32:16'),
(7, 'BCS64', 'asdasd', '', 'asdasd', '5645311455', 'ererew@gmail.com', 'bLmNpDEh/V3lCMk4pRuTTomyI9BKynuJubb9XF0Ii8DNC3L/z6luf5lgSttUWHicUoplzTGKw98XMzlbpiACUQ==', 'key_5be6af2b3c609odji5piks', '', '2018-05-08', 'Male', 'A+', '2018-11-09', 'asdsad sadsad', 1, 1, 1, '56656', 1, '7', 0, 'Active', '2018-11-10 10:12:59', '2018-11-10 10:12:59'),
(8, 'asdsad', 'sdsd', 'sadsad', 'sdasdsad', '5645654444', 'sdfsdfsdf@fgdfg.kkj', '+0XYxjvCMzoHTTjLS7+PJrIdkja3pExWxPyetoOyDIcRVQ82SQI+6GeMOkAorTheTcUY963gjEEBxM7cisj94w==', 'key_5be6b29d5a4a3aozc8nzkx', '', '2017-03-14', 'Male', 'A-', '2018-11-09', 'sdfsdf ghgfdfgdf', 1, 1, 1, '564565', 1, '8', 0, 'Active', '2018-11-10 10:27:41', '2018-11-10 10:27:41'),
(9, 'B08CS164', 'Radsad adsadsad', 'asdsad sdd', 'sadsad', '9907632555', 'dsfsdfsd@ffsd.com', 'uRS+Xh7iRJQnOSw2UxZBXhxKtHP29OEf6cmm3xSqlfVAX5a+MnmFpbOA9NiOSshNDNlinIhoHCq9lV/BHwyltw==', 'key_5be927e981ae5hxt2yzgcw', 'b08cs164.jpg', '0000-00-00', 'Male', 'A-', '0000-00-00', 'sadsad dsfsdfsdf', 1, 1, 1, '657542', 4, '9', 0, 'Active', '2018-11-12 07:12:41', '2018-11-12 07:12:41'),
(10, 'bsdfsd2333334', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', 'kZ8u1D4VLMSZm0sFpg0HrcKY9EBe1jP9KpRIxflQwj11LuJQFuZO4h5RTYxj2kqbZHAZ5F3qvHiQTGfr4GQByQ==', 'key_5be92dd00afb4kizyol9qm', 'bsdfsd2333334.jpg', '0000-00-00', 'Male', 'A+', '0000-00-00', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, '10', 0, 'Active', '2018-11-12 07:37:52', '2018-11-12 07:37:52'),
(11, 'bsdfsd2333336', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', 'q/LbWT+F1GQJ1rUvAybT9BuAwkX6xjoYXiGGfoTA+RFU0EX6HhTS9GKqezPcq47iSUiNHYxwOpb+nG+KvPbzug==', 'key_5be92fe2f0015poez2jsty', 'bsdfsd2333336.jpg', '0000-00-00', 'Male', 'A+', '0000-00-00', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, '11', 0, 'Active', '2018-11-12 07:46:42', '2018-11-12 07:46:42'),
(12, 'bsdfsd233388', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', '+vobv3xrY0ZGq5mWTjP0L0+yU14S6tbMQNFMZQvfgO7rV9I2OqfXC09wk7uyCVrWZqcnbSSTIP1KTyLC6ykpkw==', 'key_5be92ffe374d8vzkf5womn', 'bsdfsd233388.jpg', '0000-00-00', 'Male', 'A+', '0000-00-00', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, '12', 0, 'Active', '2018-11-12 07:47:10', '2018-11-12 07:47:10'),
(13, 'bsdfsd23331', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', 'kadX30Ig280ah/cdKlOasxCyoZGS7vvtTzeRDLInAoLTq+QjFuKXhNg/ylAwxRC1ChSK0h6StwCL6oimM7Zarg==', 'key_5be930405dd58uezda70ip', 'bsdfsd23331.jpg', '0000-00-00', 'Male', 'A+', '0000-00-00', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, '13', 0, 'Active', '2018-11-12 07:48:16', '2018-11-12 07:48:16'),
(14, 'bsdfsd23332', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', '/r15M/2AUOZZo6Tr1nxe/y1pwTxaowywchyMaJxo0cIq0Nt8XxlA9Cw4GnOHSh2DnlFvNMgIzpVxMLoc6MAXIw==', 'key_5be9323560d0b4dbkfgipl', 'bsdfsd23332.jpg', '0000-00-00', 'Male', 'A+', '0000-00-00', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, '14', 0, 'Active', '2018-11-12 07:56:37', '2018-11-12 07:56:37'),
(15, 'bsdfsd23333', 'sdafsadsa', 'sadsad', 'sadsadasd', '5676575675', 'dsadsad@dfdf.comn', 'QH+lNPomujF3EY8o52I+WhiXNBg3UMYV/tFB6IOXPdQd0blLNZQibFXWiabol0K4Ozzhfpfwx1TFHxC6/dUkXA==', 'key_5be9347270275z6psb3jcd', 'bsdfsd23333.jpg', '0000-00-00', 'Male', 'A+', '0000-00-00', 'sadsad sdfsdfdsf', 1, 1, 1, '76576', 2, '15', 0, 'Active', '2018-11-12 08:06:10', '2018-11-12 08:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `students_details`
--

CREATE TABLE `students_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `nationality` varchar(40) NOT NULL,
  `language` varchar(255) NOT NULL,
  `religion` varchar(40) NOT NULL,
  `student_category` varchar(40) NOT NULL,
  `is_handicapped` enum('Yes','No','') NOT NULL DEFAULT 'No',
  `handicap_details` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_details`
--

INSERT INTO `students_details` (`id`, `student_id`, `birth_place`, `nationality`, `language`, `religion`, `student_category`, `is_handicapped`, `handicap_details`, `date_added`, `date_modified`) VALUES
(1, 1, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:56'),
(2, 2, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:53'),
(3, 3, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:50'),
(4, 4, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:48'),
(5, 5, 'Salem-TN', 'Indian', 'Tamil,Telugu,English', 'Hindu', '2', 'Yes', 'Nil', '2018-10-31 08:00:44', '2018-11-10 10:28:42'),
(6, 6, 'Salem-TN6', 'Indian6', 'Tamil,Telugu,English6', 'Hindu6', '1', 'Yes', 'Nil6', '2018-10-31 08:00:44', '2018-11-10 10:28:40'),
(7, 7, 'asdd', '', '', 'No', '1', 'No', '', '2018-11-10 10:12:59', '2018-11-10 10:28:37'),
(8, 8, 'sdadsa', 'hhwewer', '33sadsa', 'No', '1', 'No', '', '2018-11-10 10:27:41', '2018-11-10 10:27:41'),
(9, 9, 'SAlem', '', 'Tamil,English', 'No', '1', 'No', '', '2018-11-12 07:12:41', '2018-11-12 07:12:41'),
(10, 10, '', '', '', 'No', '1', 'No', '', '2018-11-12 07:37:52', '2018-11-12 07:37:52'),
(11, 11, '', '', '', 'No', '1', 'No', '', '2018-11-12 07:46:42', '2018-11-12 07:46:42'),
(12, 12, '', '', '', 'No', '1', 'No', '', '2018-11-12 07:47:10', '2018-11-12 07:47:10'),
(13, 13, '', '', '', 'No', '1', 'No', '', '2018-11-12 07:48:16', '2018-11-12 07:48:16'),
(14, 14, '', '', '', 'No', '1', 'No', '', '2018-11-12 07:56:37', '2018-11-12 07:56:37'),
(15, 15, '', '', '', 'No', '1', 'No', '', '2018-11-12 08:06:10', '2018-11-12 08:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `students_previous_qualification`
--

CREATE TABLE `students_previous_qualification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `institue_name` varchar(255) NOT NULL,
  `institue_address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `total_mark` varchar(10) NOT NULL DEFAULT '',
  `reason_for_change` text NOT NULL,
  `date_addedd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_previous_qualification`
--

INSERT INTO `students_previous_qualification` (`id`, `student_id`, `institue_name`, `institue_address`, `course`, `year`, `total_mark`, `reason_for_change`, `date_addedd`, `date_modified`) VALUES
(1, 2, 'MCET', 'Pollachi', 'BE-CSE', '2008-2012', '74%', 'Course completed', '2018-10-30 07:55:41', '2018-10-30 07:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` bigint(20) UNSIGNED NOT NULL,
  `att_date` date NOT NULL DEFAULT '0000-00-00',
  `attendance` enum('Present','Absent','Half Day','') NOT NULL DEFAULT 'Present',
  `reason` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `stu_id`, `att_date`, `attendance`, `reason`, `date_added`, `date_modified`) VALUES
(1, 1, '2018-10-24', 'Present', '', '2018-10-24 10:06:06', '2018-10-24 10:55:33'),
(2, 2, '2018-10-24', 'Absent', '', '2018-10-24 10:06:06', '2018-10-24 10:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `student_category`
--

CREATE TABLE `student_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_category`
--

INSERT INTO `student_category` (`id`, `name`, `status`, `date_added`, `date_modified`) VALUES
(1, 'General', 'Active', '2018-10-31 08:45:58', '2018-10-31 08:45:58'),
(2, 'Free Education', 'Active', '2018-10-31 08:45:58', '2018-10-31 08:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `student_custom_fields`
--

CREATE TABLE `student_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `custom_id` bigint(20) UNSIGNED NOT NULL,
  `value` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_to_class_assignment`
--

CREATE TABLE `student_to_class_assignment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `academic_id` bigint(20) NOT NULL,
  `status` enum('Inprogress','Passed','Failed','Alumini','') NOT NULL DEFAULT 'Inprogress',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_to_class_assignment`
--

INSERT INTO `student_to_class_assignment` (`id`, `student_id`, `class_id`, `academic_id`, `status`, `date_added`, `date_modified`) VALUES
(1, 1, 1, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(2, 2, 6, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-30 13:10:17'),
(3, 3, 2, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(4, 4, 3, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(5, 5, 3, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(6, 6, 4, 1, 'Inprogress', '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(7, 2, 1, 2, 'Inprogress', '2018-10-29 10:53:56', '2018-10-30 13:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_to_parent_assignment`
--

CREATE TABLE `student_to_parent_assignment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_to_parent_assignment`
--

INSERT INTO `student_to_parent_assignment` (`id`, `student_id`, `parent_id`, `date_added`, `date_modified`) VALUES
(1, 1, 1, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(2, 2, 6, '2018-10-29 10:53:56', '2018-10-30 13:10:17'),
(3, 3, 2, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(4, 4, 3, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(5, 5, 3, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(6, 6, 4, '2018-10-29 10:53:56', '2018-10-29 10:53:56'),
(7, 1, 2, '2018-10-29 10:53:56', '2018-11-12 13:04:23'),
(8, 15, 3, '2018-10-29 10:53:56', '2018-11-12 09:54:53'),
(9, 15, 5, '2018-11-12 13:03:16', '2018-11-12 13:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Deactive','Suspended','Deleted','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `first_name`, `last_name`, `mobile`, `email`, `dob`, `doj`, `address`, `city_id`, `state_id`, `country_id`, `created_by`, `status`, `date_added`, `date_modified`) VALUES
(1, 'TEA01', 'Rajakumar', 'Anbalagan', '9092310791', 'rjkumar856@gmail.com', '1990-10-24', '2018-10-24', 'G202 SRK Silicana, E-City', 1, 1, 1, 1, 'Active', '2018-10-24 06:25:31', '2018-10-24 09:18:34'),
(2, 'TEA02', 'Sabarish', 'R', '9092310792', 'rjkumar857@gmail.com', '1990-11-21', '2018-10-24', 'G202 SRK Silicana, E-City1', 1, 1, 1, 1, 'Active', '2018-10-24 06:25:31', '2018-10-24 09:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendance`
--

CREATE TABLE `teacher_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tcr_id` bigint(20) UNSIGNED NOT NULL,
  `att_date` date NOT NULL DEFAULT '0000-00-00',
  `attendance` enum('Present','Absent','Half Day','') NOT NULL DEFAULT 'Present',
  `reason` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_attendance`
--

INSERT INTO `teacher_attendance` (`id`, `tcr_id`, `att_date`, `attendance`, `reason`, `date_added`, `date_modified`) VALUES
(1, 1, '2018-10-24', 'Present', '', '2018-10-24 10:06:06', '2018-10-24 10:55:33'),
(2, 2, '2018-10-25', 'Absent', '', '2018-10-24 10:06:06', '2018-10-24 12:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `ze_city`
--

CREATE TABLE `ze_city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ze_city`
--

INSERT INTO `ze_city` (`id`, `name`, `state_id`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Bangalore', 1, 'Active', '2018-10-31 09:31:21', '2018-10-31 09:31:21'),
(2, 'Chennai', 2, 'Active', '2018-10-31 09:31:21', '2018-10-31 09:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `ze_country`
--

CREATE TABLE `ze_country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ze_country`
--

INSERT INTO `ze_country` (`id`, `name`, `status`, `date_added`, `date_modified`) VALUES
(1, 'India', 'Active', '2018-10-31 09:22:13', '2018-10-31 09:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `ze_state`
--

CREATE TABLE `ze_state` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `status` enum('Active','Inactive','') NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ze_state`
--

INSERT INTO `ze_state` (`id`, `name`, `country_id`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Karnataka', 1, 'Active', '2018-10-31 09:31:59', '2018-10-31 09:31:59'),
(2, 'Tamil Nadu', 1, 'Active', '2018-10-31 09:31:59', '2018-10-31 09:31:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`roll_number`);

--
-- Indexes for table `students_details`
--
ALTER TABLE `students_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_previous_qualification`
--
ALTER TABLE `students_previous_qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stu_id` (`stu_id`);

--
-- Indexes for table `student_category`
--
ALTER TABLE `student_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_custom_fields`
--
ALTER TABLE `student_custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_to_class_assignment`
--
ALTER TABLE `student_to_class_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_to_parent_assignment`
--
ALTER TABLE `student_to_parent_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stu_id` (`tcr_id`);

--
-- Indexes for table `ze_city`
--
ALTER TABLE `ze_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ze_country`
--
ALTER TABLE `ze_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ze_state`
--
ALTER TABLE `ze_state`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students_details`
--
ALTER TABLE `students_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students_previous_qualification`
--
ALTER TABLE `students_previous_qualification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_category`
--
ALTER TABLE `student_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_custom_fields`
--
ALTER TABLE `student_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_to_class_assignment`
--
ALTER TABLE `student_to_class_assignment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_to_parent_assignment`
--
ALTER TABLE `student_to_parent_assignment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ze_city`
--
ALTER TABLE `ze_city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ze_country`
--
ALTER TABLE `ze_country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ze_state`
--
ALTER TABLE `ze_state`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
