-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2020 at 11:43 AM
-- Server version: 10.3.23-MariaDB
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
-- Database: `jasoumik_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_user_name` varchar(255) DEFAULT NULL,
  `admin_password` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_user_name`, `admin_password`) VALUES
(1, 'info@jasoumik.com', '$2y$12$RzlE5eHARI14gtFKGRF9H.Dya63IHqmJxg70hH2g3iz2C2DrmT0Ma');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_table`
--

CREATE TABLE `attendance_table` (
  `attendance_id` int(11) NOT NULL,
  `stdnt_id` int(11) DEFAULT NULL,
  `attendance_status` enum('Present','Absent') DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance_table`
--

INSERT INTO `attendance_table` (`attendance_id`, `stdnt_id`, `attendance_status`, `attendance_date`, `teacher_id`) VALUES
(1, 1, 'Absent', '2000-06-21', 3),
(2, 2, 'Absent', '2000-06-21', 3),
(3, 3, 'Absent', '2000-06-21', 3),
(4, 4, 'Absent', '2000-06-21', 3),
(5, 1, 'Absent', '2019-12-16', 3),
(6, 2, 'Present', '2019-12-16', 3),
(7, 3, 'Absent', '2019-12-16', 3),
(8, 1, 'Absent', '2020-05-04', 1),
(9, 2, 'Absent', '2020-05-04', 1),
(10, 3, 'Absent', '2020-05-04', 1),
(11, 1, 'Absent', '2020-05-12', 1),
(12, 2, 'Absent', '2020-05-12', 1),
(13, 3, 'Absent', '2020-05-12', 1),
(14, 1, 'Absent', '2020-05-05', 1),
(15, 2, 'Absent', '2020-05-05', 1),
(16, 3, 'Absent', '2020-05-05', 1),
(17, 1, 'Present', '2019-06-11', 1),
(18, 2, 'Present', '2019-06-11', 1),
(19, 3, 'Present', '2019-06-11', 1),
(20, 1, 'Absent', '2020-02-03', 1),
(21, 2, 'Absent', '2020-02-03', 1),
(22, 3, 'Absent', '2020-02-03', 1),
(26, 1, 'Absent', '2019-12-26', 1),
(27, 2, 'Present', '2019-12-26', 1),
(28, 3, 'Absent', '2019-12-26', 1),
(29, 1, 'Present', '2020-04-07', 1),
(30, 2, 'Present', '2020-04-07', 1),
(31, 3, 'Present', '2020-04-07', 1),
(32, 1, 'Absent', '2020-05-07', 1),
(33, 2, 'Absent', '2020-05-07', 1),
(34, 3, 'Absent', '2020-05-07', 1),
(35, 1, 'Absent', '2020-01-05', 1),
(36, 2, 'Absent', '2020-01-05', 1),
(37, 3, 'Absent', '2020-01-05', 1),
(38, 1, 'Absent', '2020-05-03', 1),
(39, 2, 'Absent', '2020-05-03', 1),
(40, 3, 'Absent', '2020-05-03', 1),
(41, 1, 'Absent', '2019-06-04', 1),
(42, 2, 'Absent', '2019-06-04', 1),
(43, 3, 'Absent', '2019-06-04', 1),
(44, 1, 'Absent', '2020-05-12', 3),
(45, 2, 'Present', '2020-05-12', 3),
(46, 3, 'Absent', '2020-05-12', 3),
(47, 1, 'Absent', '2020-06-03', 16),
(48, 2, 'Absent', '2020-06-03', 16),
(49, 3, 'Absent', '2020-06-03', 16),
(50, 6, 'Absent', '2020-06-03', 16),
(51, 1, 'Present', '2020-05-05', 2),
(52, 2, 'Present', '2020-05-05', 2),
(53, 3, 'Absent', '2020-05-05', 2),
(54, 6, 'Present', '2020-05-05', 2),
(55, 1, 'Present', '2020-06-04', 16),
(56, 2, 'Present', '2020-06-04', 16),
(57, 3, 'Present', '2020-06-04', 16),
(58, 6, 'Present', '2020-06-04', 16),
(59, 1, 'Present', '2020-06-23', 16),
(60, 2, 'Absent', '2020-06-23', 16),
(61, 3, 'Present', '2020-06-23', 16),
(62, 6, 'Absent', '2020-06-23', 16);

-- --------------------------------------------------------

--
-- Table structure for table `grade_table`
--

CREATE TABLE `grade_table` (
  `grade_id` int(11) NOT NULL,
  `grade_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade_table`
--

INSERT INTO `grade_table` (`grade_id`, `grade_name`) VALUES
(1, '6-A'),
(2, '6-B'),
(3, '7-A'),
(4, '7-B'),
(5, '8-A'),
(6, '8-B');

-- --------------------------------------------------------

--
-- Table structure for table `reset_pass`
--

CREATE TABLE `reset_pass` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reset_pass`
--

INSERT INTO `reset_pass` (`id`, `code`, `email`) VALUES
(10, '15eda328f82cce', 'jasoumik@gmail.com'),
(11, '15eda4c7ded6aa', 'jastrading2019@gmail.com'),
(12, '15eda556b7aaa0', 'jastrading2019@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `stdnt_id` int(11) NOT NULL,
  `stdnt_name` varchar(150) DEFAULT NULL,
  `roll_number` int(11) DEFAULT NULL,
  `stdnt_dob` date DEFAULT NULL,
  `stdnt_grade_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`stdnt_id`, `stdnt_name`, `roll_number`, `stdnt_dob`, `stdnt_grade_id`) VALUES
(1, 'Jarif Ahmed', 1, '1998-10-03', 1),
(2, 'Jarin Borno', 2, '2000-05-12', 1),
(3, 'shakir', 5, '2000-02-01', 1),
(4, 'shafak', 50, '2010-10-01', 4),
(5, 'minhaz', 30, '2005-10-20', 4),
(6, 'borno', 200, '2019-07-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_table`
--

CREATE TABLE `teacher_table` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(150) DEFAULT NULL,
  `teacher_address` text DEFAULT NULL,
  `teacher_emailid` varchar(100) DEFAULT NULL,
  `teacher_password` varchar(100) DEFAULT NULL,
  `teacher_qf` varchar(100) DEFAULT NULL,
  `teacher_joindate` date DEFAULT NULL,
  `teacher_image` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_grade_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_table`
--

INSERT INTO `teacher_table` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_emailid`, `teacher_password`, `teacher_qf`, `teacher_joindate`, `teacher_image`, `teacher_grade_id`) VALUES
(1, 'Jarif Ahmed Soumik', 'Uttara,Dhaka', 'jasoumikborhan@gmail.com', '$2y$12$RzlE5eHARI14gtFKGRF9H.Dya63IHqmJxg70hH2g3iz2C2DrmT0Ma', 'BSc in CS', '2018-10-20', '5ec68ea5635ad.jpg', 1),
(2, 'Shakila Zannat Bema', 'Dhanmondi,Dhaka', 'shakila@gmail.com', '$2y$12$RzlE5eHARI14gtFKGRF9H.Dya63IHqmJxg70hH2g3iz2C2DrmT0Ma', 'MBA', '2013-01-31', 'bema.jpg', 1),
(3, 'Minhazur Rahman', 'DHaka', 'minhazur@gmail.com', '$2y$10$olWz/t1mC4i/zwRi/3RXYugSy1LbIWyGUBHCNyrKx12iY1If/liKe', 'HSC', '2020-04-04', '5ec446615e256.jpg', 4),
(16, 'Jarif Ahmed Soumik', 'House No#03,Road No#32,Sector#07.Uttara', 'jasoumik@gmail.com', '$2y$10$GOUG7jN1Wy4/O0eFn4i51O8NcwDa9JprL.yBY5BFNKbBAizigJmJO', 'BSc in CS', '2019-10-03', '5eda350510583.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance_table`
--
ALTER TABLE `attendance_table`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `grade_table`
--
ALTER TABLE `grade_table`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `reset_pass`
--
ALTER TABLE `reset_pass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`stdnt_id`);

--
-- Indexes for table `teacher_table`
--
ALTER TABLE `teacher_table`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance_table`
--
ALTER TABLE `attendance_table`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `grade_table`
--
ALTER TABLE `grade_table`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reset_pass`
--
ALTER TABLE `reset_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `stdnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher_table`
--
ALTER TABLE `teacher_table`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
