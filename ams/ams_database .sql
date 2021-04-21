-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2021 at 02:05 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_add_course`
--

CREATE TABLE `admin_add_course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_add_course`
--

INSERT INTO `admin_add_course` (`course_id`, `course_name`) VALUES
(1, 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `admin_add_division`
--

CREATE TABLE `admin_add_division` (
  `division_id` int(11) NOT NULL,
  `division_name` varchar(255) NOT NULL,
  `division_seat` varchar(255) NOT NULL,
  `standard_name` varchar(255) NOT NULL,
  `course_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_add_division`
--

INSERT INTO `admin_add_division` (`division_id`, `division_name`, `division_seat`, `standard_name`, `course_name`) VALUES
(1, 'A', '20', '1st', 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `admin_add_staff`
--

CREATE TABLE `admin_add_staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_email` varchar(255) NOT NULL,
  `staff_mobile` varchar(255) NOT NULL,
  `staff_qualification` varchar(255) NOT NULL,
  `staff_address` varchar(255) NOT NULL,
  `staff_city` varchar(255) NOT NULL,
  `staff_pincode` varchar(255) NOT NULL,
  `staff_gender` varchar(255) NOT NULL,
  `staff_photo` varchar(255) NOT NULL,
  `staff_course_name` varchar(50) NOT NULL,
  `staff_std_name` varchar(255) NOT NULL,
  `staff_username` varchar(255) NOT NULL,
  `staff_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_add_staff`
--

INSERT INTO `admin_add_staff` (`staff_id`, `staff_name`, `staff_email`, `staff_mobile`, `staff_qualification`, `staff_address`, `staff_city`, `staff_pincode`, `staff_gender`, `staff_photo`, `staff_course_name`, `staff_std_name`, `staff_username`, `staff_password`) VALUES
(1, 'hemant', 'hemant1@gmail.com', '1111111111', 'bca', 'sundar', 'ajmer', '305001', 'Male', 'images/staff/b8557b407a.jpg', 'BCA', '1st', 'hemant', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `admin_add_standard`
--

CREATE TABLE `admin_add_standard` (
  `standard_id` int(11) NOT NULL,
  `standard_name` varchar(255) NOT NULL,
  `course_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_add_standard`
--

INSERT INTO `admin_add_standard` (`standard_id`, `standard_name`, `course_name`) VALUES
(1, '1st', 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `bca_1st_a`
--

CREATE TABLE `bca_1st_a` (
  `student_rollno_id` int(11) NOT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `standard_name` varchar(50) DEFAULT NULL,
  `division_name` varchar(50) DEFAULT NULL,
  `student_name` varchar(30) DEFAULT NULL,
  `student_mobile` varchar(30) DEFAULT NULL,
  `student_email` varchar(30) DEFAULT NULL,
  `student_dob` varchar(20) DEFAULT NULL,
  `student_address` varchar(50) DEFAULT NULL,
  `student_city` varchar(50) DEFAULT NULL,
  `student_pincode` varchar(50) DEFAULT NULL,
  `student_gender` varchar(50) DEFAULT NULL,
  `student_photo` varchar(50) DEFAULT NULL,
  `student_username` varchar(50) DEFAULT NULL,
  `student_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bca_1st_a_attendance`
--

CREATE TABLE `bca_1st_a_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_rollno` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `attendance_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff_add_student`
--

CREATE TABLE `staff_add_student` (
  `student_rollno` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `division_name` varchar(20) NOT NULL,
  `standard_name` varchar(30) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_mobile` varchar(100) NOT NULL,
  `student_dob` varchar(100) NOT NULL,
  `student_address` varchar(50) NOT NULL,
  `student_city` varchar(50) NOT NULL,
  `student_pincode` varchar(50) NOT NULL,
  `student_gender` varchar(50) NOT NULL,
  `student_photo` varchar(50) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `student_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_add_course`
--
ALTER TABLE `admin_add_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `admin_add_division`
--
ALTER TABLE `admin_add_division`
  ADD PRIMARY KEY (`division_id`);

--
-- Indexes for table `admin_add_staff`
--
ALTER TABLE `admin_add_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `admin_add_standard`
--
ALTER TABLE `admin_add_standard`
  ADD PRIMARY KEY (`standard_id`);

--
-- Indexes for table `bca_1st_a`
--
ALTER TABLE `bca_1st_a`
  ADD PRIMARY KEY (`student_rollno_id`);

--
-- Indexes for table `bca_1st_a_attendance`
--
ALTER TABLE `bca_1st_a_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `staff_add_student`
--
ALTER TABLE `staff_add_student`
  ADD PRIMARY KEY (`student_rollno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_add_course`
--
ALTER TABLE `admin_add_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_add_division`
--
ALTER TABLE `admin_add_division`
  MODIFY `division_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_add_staff`
--
ALTER TABLE `admin_add_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_add_standard`
--
ALTER TABLE `admin_add_standard`
  MODIFY `standard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bca_1st_a`
--
ALTER TABLE `bca_1st_a`
  MODIFY `student_rollno_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bca_1st_a_attendance`
--
ALTER TABLE `bca_1st_a_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_add_student`
--
ALTER TABLE `staff_add_student`
  MODIFY `student_rollno` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
