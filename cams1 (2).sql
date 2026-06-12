-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2026 at 06:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cams1`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('present','absent','late') DEFAULT 'present',
  `period` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `subject_id`, `faculty_id`, `date`, `status`, `period`) VALUES
(1, 1, 1, 1, '2026-03-25', 'present', 1),
(2, 16, 1, 1, '2026-03-25', 'absent', 1),
(3, 10, 1, 1, '2026-03-25', 'absent', 1),
(4, 25, 1, 1, '2026-03-25', 'present', 1),
(5, 2, 1, 1, '2026-03-25', 'present', 1),
(6, 17, 1, 1, '2026-03-25', 'present', 1),
(7, 3, 1, 1, '2026-03-25', 'present', 1),
(8, 18, 1, 1, '2026-03-25', 'present', 1),
(9, 4, 1, 1, '2026-03-25', 'present', 1),
(10, 19, 1, 1, '2026-03-25', 'present', 1),
(11, 5, 1, 1, '2026-03-25', 'present', 1),
(12, 20, 1, 1, '2026-03-25', 'present', 1),
(13, 6, 1, 1, '2026-03-25', 'present', 1),
(14, 21, 1, 1, '2026-03-25', 'present', 1),
(15, 7, 1, 1, '2026-03-25', 'present', 1),
(16, 22, 1, 1, '2026-03-25', 'present', 1),
(17, 8, 1, 1, '2026-03-25', 'present', 1),
(18, 23, 1, 1, '2026-03-25', 'present', 1),
(19, 9, 1, 1, '2026-03-25', 'present', 1),
(20, 24, 1, 1, '2026-03-25', 'present', 1),
(21, 1, 1, 1, '2026-03-25', 'present', 3),
(22, 16, 1, 1, '2026-03-25', 'present', 3),
(23, 10, 1, 1, '2026-03-25', 'present', 3),
(24, 25, 1, 1, '2026-03-25', 'present', 3),
(25, 2, 1, 1, '2026-03-25', 'present', 3),
(26, 17, 1, 1, '2026-03-25', 'present', 3),
(27, 3, 1, 1, '2026-03-25', 'present', 3),
(28, 18, 1, 1, '2026-03-25', 'present', 3),
(29, 4, 1, 1, '2026-03-25', 'present', 3),
(30, 19, 1, 1, '2026-03-25', 'present', 3),
(31, 5, 1, 1, '2026-03-25', 'present', 3),
(32, 20, 1, 1, '2026-03-25', 'present', 3),
(33, 6, 1, 1, '2026-03-25', 'present', 3),
(34, 21, 1, 1, '2026-03-25', 'present', 3),
(35, 7, 1, 1, '2026-03-25', 'present', 3),
(36, 22, 1, 1, '2026-03-25', 'present', 3),
(37, 8, 1, 1, '2026-03-25', 'present', 3),
(38, 23, 1, 1, '2026-03-25', 'present', 3),
(39, 9, 1, 1, '2026-03-25', 'present', 3),
(40, 24, 1, 1, '2026-03-25', 'present', 3),
(41, 1, 1, 1, '2026-03-25', 'absent', 4),
(42, 16, 1, 1, '2026-03-25', 'present', 4),
(43, 10, 1, 1, '2026-03-25', 'present', 4),
(44, 25, 1, 1, '2026-03-25', 'present', 4),
(45, 2, 1, 1, '2026-03-25', 'present', 4),
(46, 17, 1, 1, '2026-03-25', 'present', 4),
(47, 3, 1, 1, '2026-03-25', 'present', 4),
(48, 18, 1, 1, '2026-03-25', 'present', 4),
(49, 4, 1, 1, '2026-03-25', 'present', 4),
(50, 19, 1, 1, '2026-03-25', 'present', 4),
(51, 5, 1, 1, '2026-03-25', 'present', 4),
(52, 20, 1, 1, '2026-03-25', 'present', 4),
(53, 6, 1, 1, '2026-03-25', 'present', 4),
(54, 21, 1, 1, '2026-03-25', 'present', 4),
(55, 7, 1, 1, '2026-03-25', 'present', 4),
(56, 22, 1, 1, '2026-03-25', 'present', 4),
(57, 8, 1, 1, '2026-03-25', 'present', 4),
(58, 23, 1, 1, '2026-03-25', 'present', 4),
(59, 9, 1, 1, '2026-03-25', 'present', 4),
(60, 24, 1, 1, '2026-03-25', 'present', 4),
(61, 1, 1, 1, '2026-03-25', 'absent', 6),
(62, 16, 1, 1, '2026-03-25', 'present', 6),
(63, 10, 1, 1, '2026-03-25', 'present', 6),
(64, 25, 1, 1, '2026-03-25', 'present', 6),
(65, 2, 1, 1, '2026-03-25', 'present', 6),
(66, 17, 1, 1, '2026-03-25', 'present', 6),
(67, 3, 1, 1, '2026-03-25', 'present', 6),
(68, 18, 1, 1, '2026-03-25', 'present', 6),
(69, 4, 1, 1, '2026-03-25', 'present', 6),
(70, 19, 1, 1, '2026-03-25', 'present', 6),
(71, 5, 1, 1, '2026-03-25', 'present', 6),
(72, 20, 1, 1, '2026-03-25', 'present', 6),
(73, 6, 1, 1, '2026-03-25', 'present', 6),
(74, 21, 1, 1, '2026-03-25', 'present', 6),
(75, 7, 1, 1, '2026-03-25', 'present', 6),
(76, 22, 1, 1, '2026-03-25', 'present', 6),
(77, 8, 1, 1, '2026-03-25', 'present', 6),
(78, 23, 1, 1, '2026-03-25', 'present', 6),
(79, 9, 1, 1, '2026-03-25', 'present', 6),
(80, 24, 1, 1, '2026-03-25', 'present', 6),
(81, 104, 1, 1, '2026-03-25', 'present', 2),
(82, 1, 1, 1, '2026-03-25', 'present', 2),
(83, 16, 1, 1, '2026-03-25', 'present', 2),
(84, 10, 1, 1, '2026-03-25', 'present', 2),
(85, 25, 1, 1, '2026-03-25', 'present', 2),
(86, 2, 1, 1, '2026-03-25', 'present', 2),
(87, 17, 1, 1, '2026-03-25', 'present', 2),
(88, 3, 1, 1, '2026-03-25', 'present', 2),
(89, 18, 1, 1, '2026-03-25', 'present', 2),
(90, 4, 1, 1, '2026-03-25', 'present', 2),
(91, 19, 1, 1, '2026-03-25', 'present', 2),
(92, 5, 1, 1, '2026-03-25', 'present', 2),
(93, 20, 1, 1, '2026-03-25', 'present', 2),
(94, 6, 1, 1, '2026-03-25', 'present', 2),
(95, 21, 1, 1, '2026-03-25', 'present', 2),
(96, 7, 1, 1, '2026-03-25', 'present', 2),
(97, 22, 1, 1, '2026-03-25', 'present', 2),
(98, 8, 1, 1, '2026-03-25', 'present', 2),
(99, 23, 1, 1, '2026-03-25', 'present', 2),
(100, 9, 1, 1, '2026-03-25', 'present', 2),
(101, 24, 1, 1, '2026-03-25', 'present', 2),
(102, 104, 1, 1, '2026-03-25', 'present', 3),
(103, 104, 1, 1, '2026-03-25', 'present', 4),
(104, 104, 1, 1, '2026-03-25', 'present', 5),
(105, 1, 1, 1, '2026-03-25', 'present', 5),
(106, 16, 1, 1, '2026-03-25', 'present', 5),
(107, 10, 1, 1, '2026-03-25', 'present', 5),
(108, 25, 1, 1, '2026-03-25', 'present', 5),
(109, 2, 1, 1, '2026-03-25', 'present', 5),
(110, 17, 1, 1, '2026-03-25', 'present', 5),
(111, 3, 1, 1, '2026-03-25', 'present', 5),
(112, 18, 1, 1, '2026-03-25', 'present', 5),
(113, 4, 1, 1, '2026-03-25', 'present', 5),
(114, 19, 1, 1, '2026-03-25', 'present', 5),
(115, 5, 1, 1, '2026-03-25', 'present', 5),
(116, 20, 1, 1, '2026-03-25', 'present', 5),
(117, 6, 1, 1, '2026-03-25', 'present', 5),
(118, 21, 1, 1, '2026-03-25', 'present', 5),
(119, 7, 1, 1, '2026-03-25', 'present', 5),
(120, 22, 1, 1, '2026-03-25', 'present', 5),
(121, 8, 1, 1, '2026-03-25', 'present', 5),
(122, 23, 1, 1, '2026-03-25', 'present', 5),
(123, 9, 1, 1, '2026-03-25', 'present', 5),
(124, 24, 1, 1, '2026-03-25', 'present', 5);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_alerts`
--

CREATE TABLE `attendance_alerts` (
  `alert_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `attendance_percentage` decimal(5,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Sent',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_summary`
--

CREATE TABLE `attendance_summary` (
  `summary_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `total_classes` int(11) DEFAULT 0,
  `attended_classes` int(11) DEFAULT 0,
  `attendance_percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `condonation_requests`
--

CREATE TABLE `condonation_requests` (
  `request_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `attendance_percentage` decimal(5,2) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `document` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condonation_requests`
--

INSERT INTO `condonation_requests` (`request_id`, `student_id`, `subject_id`, `attendance_percentage`, `reason`, `status`, `request_date`, `document`, `type`) VALUES
(1, 1, NULL, 50.00, 'sdfgh', 'Rejected', '2026-03-25 09:00:30', '1774429230_6204159175261097984.jpg', 'Medical');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `database_backups`
--

CREATE TABLE `database_backups` (
  `backup_id` int(11) NOT NULL,
  `backup_name` varchar(255) DEFAULT NULL,
  `backup_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'COMPUTER ENGINEERING'),
(2, 'CIVIL ENGINEERING'),
(3, 'MECHANICAL ENGINEERING');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `user_id`, `name`, `email`, `department_id`, `designation`, `phone`, `photo`) VALUES
(1, 2, 'Faculty', 'faculty@gptc.com', NULL, NULL, NULL, NULL),
(2, 5, 'CT Faculty 1', 'ct_fac1@gptc.com', 1, NULL, NULL, NULL),
(3, 6, 'CT Faculty 2', 'ct_fac2@gptc.com', 1, NULL, NULL, NULL),
(4, 7, 'Civil Faculty 1', 'ce_fac1@gptc.com', 2, NULL, NULL, NULL),
(5, 8, 'Civil Faculty 2', 'ce_fac2@gptc.com', 2, NULL, NULL, NULL),
(6, 9, 'Mech Faculty 1', 'me_fac1@gptc.com', 3, NULL, NULL, NULL),
(7, 10, 'Mech Faculty 2', 'me_fac2@gptc.com', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_subjects`
--

CREATE TABLE `faculty_subjects` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_subjects`
--

INSERT INTO `faculty_subjects` (`id`, `faculty_id`, `subject_id`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `fee_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('Paid','Pending') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `hod_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `leave_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('read','unread') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `title`, `message`, `status`, `created_at`, `user_role`) VALUES
(1, NULL, 'semester going to end', 'attention all students', 'unread', '2026-03-25 06:57:03', ''),
(2, NULL, 'asdfasdf', 'asdasdfa', 'unread', '2026-03-25 08:52:33', ''),
(3, NULL, 'dfhj', 'fghm', 'unread', '2026-03-25 09:35:05', ''),
(7, NULL, 'jg', 'jkig', 'unread', '2026-05-12 14:06:31', ''),
(8, NULL, 'dtf', 'jg', 'unread', '2026-05-12 14:06:36', '');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parent_id`, `user_id`, `student_id`, `name`, `email`, `relationship`) VALUES
(1, 21, 1, 'CT_S1_Student1 Parent', 'parent_ct_1@gptc.com', NULL),
(2, 22, 2, 'CT_S1_Student2 Parent', 'parent_ct_2@gptc.com', NULL),
(3, 23, 3, 'CT_S1_Student3 Parent', 'parent_ct_3@gptc.com', NULL),
(4, 24, 4, 'CT_S1_Student4 Parent', 'parent_ct_4@gptc.com', NULL),
(5, 25, 5, 'CT_S1_Student5 Parent', 'parent_ct_5@gptc.com', NULL),
(6, 26, 6, 'CT_S1_Student6 Parent', 'parent_ct_6@gptc.com', NULL),
(7, 27, 7, 'CT_S1_Student7 Parent', 'parent_ct_7@gptc.com', NULL),
(8, 28, 8, 'CT_S1_Student8 Parent', 'parent_ct_8@gptc.com', NULL),
(9, 29, 9, 'CT_S1_Student9 Parent', 'parent_ct_9@gptc.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registration_requests`
--

CREATE TABLE `registration_requests` (
  `request_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `security_q1` varchar(255) DEFAULT NULL,
  `security_a1` varchar(255) DEFAULT NULL,
  `security_q2` varchar(255) DEFAULT NULL,
  `security_a2` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_requests`
--

INSERT INTO `registration_requests` (`request_id`, `name`, `email`, `password`, `role`, `security_q1`, `security_a1`, `security_q2`, `security_a2`, `status`, `created_at`) VALUES
(1, 'Aswin Sreenivas', 'sreeachoosarjoos-5@okhdfcbank', '112112', 'student', 'Mother name', 'nithya', 'Best friend', 'sreenivas', 'Approved', '2026-03-24 16:27:07'),
(2, 'Aswin Sreenivas', 'aswin.sreenivas005@gmail.com', '112112', 'student', 'Mother name', 'nithya', 'City', 'kozhikode', 'Approved', '2026-03-24 16:43:21'),
(3, 'Aswin Sreenivas', 'aswin.sreenivas005@gmail.com', '112112', 'student', 'Mother name', 'nithya', 'City', 'mananthavady', 'Approved', '2026-03-25 09:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `internal_marks` int(11) DEFAULT NULL,
  `external_marks` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `admission_no` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `name`, `email`, `phone`, `department_id`, `course_id`, `semester`, `admission_no`, `photo`, `address`) VALUES
(1, 11, 'CT_S1_Student1', 'ct_s1_1@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(2, 12, 'CT_S1_Student2', 'ct_s1_2@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(3, 13, 'CT_S1_Student3', 'ct_s1_3@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(4, 14, 'CT_S1_Student4', 'ct_s1_4@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(5, 15, 'CT_S1_Student5', 'ct_s1_5@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(6, 16, 'CT_S1_Student6', 'ct_s1_6@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(7, 17, 'CT_S1_Student7', 'ct_s1_7@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(8, 18, 'CT_S1_Student8', 'ct_s1_8@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(9, 19, 'CT_S1_Student9', 'ct_s1_9@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(10, 20, 'CT_S1_Student10', 'ct_s1_10@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(16, 11, 'CT_S1_Student1', 'ct_s1_1@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(17, 12, 'CT_S1_Student2', 'ct_s1_2@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(18, 13, 'CT_S1_Student3', 'ct_s1_3@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(19, 14, 'CT_S1_Student4', 'ct_s1_4@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(20, 15, 'CT_S1_Student5', 'ct_s1_5@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(21, 16, 'CT_S1_Student6', 'ct_s1_6@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(22, 17, 'CT_S1_Student7', 'ct_s1_7@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(23, 18, 'CT_S1_Student8', 'ct_s1_8@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(24, 19, 'CT_S1_Student9', 'ct_s1_9@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(25, 20, 'CT_S1_Student10', 'ct_s1_10@gptc.com', NULL, 1, NULL, 1, NULL, NULL, NULL),
(31, 31, 'CT_S2_Student1', 'ct_s2_1@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(32, 32, 'CT_S2_Student2', 'ct_s2_2@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(33, 33, 'CT_S2_Student3', 'ct_s2_3@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(34, 34, 'CT_S2_Student4', 'ct_s2_4@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(35, 35, 'CT_S2_Student5', 'ct_s2_5@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(36, 36, 'CT_S2_Student6', 'ct_s2_6@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(37, 37, 'CT_S2_Student7', 'ct_s2_7@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(38, 38, 'CT_S2_Student8', 'ct_s2_8@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(39, 39, 'CT_S2_Student9', 'ct_s2_9@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(40, 40, 'CT_S2_Student10', 'ct_s2_10@gptc.com', NULL, 1, NULL, 2, NULL, NULL, NULL),
(46, 41, 'CT_S3_Student1', 'ct_s3_1@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(47, 42, 'CT_S3_Student2', 'ct_s3_2@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(48, 43, 'CT_S3_Student3', 'ct_s3_3@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(49, 44, 'CT_S3_Student4', 'ct_s3_4@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(50, 45, 'CT_S3_Student5', 'ct_s3_5@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(51, 46, 'CT_S3_Student6', 'ct_s3_6@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(52, 47, 'CT_S3_Student7', 'ct_s3_7@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(53, 48, 'CT_S3_Student8', 'ct_s3_8@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(54, 49, 'CT_S3_Student9', 'ct_s3_9@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(55, 50, 'CT_S3_Student10', 'ct_s3_10@gptc.com', NULL, 1, NULL, 3, NULL, NULL, NULL),
(61, 51, 'CT_S4_Student1', 'ct_s4_1@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(62, 52, 'CT_S4_Student2', 'ct_s4_2@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(63, 53, 'CT_S4_Student3', 'ct_s4_3@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(64, 54, 'CT_S4_Student4', 'ct_s4_4@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(65, 55, 'CT_S4_Student5', 'ct_s4_5@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(66, 56, 'CT_S4_Student6', 'ct_s4_6@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(67, 57, 'CT_S4_Student7', 'ct_s4_7@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(68, 58, 'CT_S4_Student8', 'ct_s4_8@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(69, 59, 'CT_S4_Student9', 'ct_s4_9@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(70, 60, 'CT_S4_Student10', 'ct_s4_10@gptc.com', NULL, 1, NULL, 4, NULL, NULL, NULL),
(76, 61, 'CT_S5_Student1', 'ct_s5_1@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(77, 62, 'CT_S5_Student2', 'ct_s5_2@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(78, 63, 'CT_S5_Student3', 'ct_s5_3@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(79, 64, 'CT_S5_Student4', 'ct_s5_4@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(80, 65, 'CT_S5_Student5', 'ct_s5_5@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(81, 66, 'CT_S5_Student6', 'ct_s5_6@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(82, 67, 'CT_S5_Student7', 'ct_s5_7@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(83, 68, 'CT_S5_Student8', 'ct_s5_8@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(84, 69, 'CT_S5_Student9', 'ct_s5_9@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(85, 70, 'CT_S5_Student10', 'ct_s5_10@gptc.com', NULL, 1, NULL, 5, NULL, NULL, NULL),
(91, 71, 'CT_S6_Student1', 'ct_s6_1@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(92, 72, 'CT_S6_Student2', 'ct_s6_2@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(93, 73, 'CT_S6_Student3', 'ct_s6_3@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(94, 74, 'CT_S6_Student4', 'ct_s6_4@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(95, 75, 'CT_S6_Student5', 'ct_s6_5@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(96, 76, 'CT_S6_Student6', 'ct_s6_6@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(97, 77, 'CT_S6_Student7', 'ct_s6_7@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(98, 78, 'CT_S6_Student8', 'ct_s6_8@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(99, 79, 'CT_S6_Student9', 'ct_s6_9@gptc.com', NULL, 1, NULL, 6, NULL, NULL, NULL),
(107, NULL, 'aswin', 'aswin.sreenivas005@gmail.com', NULL, 1, NULL, 2, '1002', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_name`, `department_id`, `semester`) VALUES
(1, NULL, 'Mathematics I', 1, 1),
(2, NULL, 'Physics', 1, 1),
(3, NULL, 'Basic Electronics', 1, 1),
(4, NULL, 'Engineering Graphics', 1, 1),
(5, NULL, 'Mathematics II', 1, 2),
(6, NULL, 'Chemistry', 1, 2),
(7, NULL, 'Programming in C', 1, 2),
(8, NULL, 'Digital Electronics', 1, 2),
(9, NULL, 'Data Structures', 1, 3),
(10, NULL, 'Computer Organization', 1, 3),
(11, NULL, 'Operating Systems', 1, 3),
(12, NULL, 'DBMS', 1, 3),
(13, NULL, 'Java Programming', 1, 4),
(14, NULL, 'Computer Networks', 1, 4),
(15, NULL, 'Software Engineering', 1, 4),
(16, NULL, 'Microprocessors', 1, 4),
(17, NULL, 'Web Development', 1, 5),
(18, NULL, 'Python Programming', 1, 5),
(19, NULL, 'Cloud Computing', 1, 5),
(20, NULL, 'Cyber Security', 1, 5),
(21, NULL, 'Machine Learning', 1, 6),
(22, NULL, 'Artificial Intelligence', 1, 6),
(23, NULL, 'Project Work', 1, 6),
(24, NULL, 'Industrial Training', 1, 6),
(25, NULL, 'Mathematics I', 2, 1),
(26, NULL, 'Physics', 2, 1),
(27, NULL, 'Engineering Mechanics', 2, 1),
(28, NULL, 'Basic Civil Engineering', 2, 1),
(29, NULL, 'Mathematics II', 2, 2),
(30, NULL, 'Chemistry', 2, 2),
(31, NULL, 'Surveying I', 2, 2),
(32, NULL, 'Building Materials', 2, 2),
(33, NULL, 'Structural Mechanics', 2, 3),
(34, NULL, 'Surveying II', 2, 3),
(35, NULL, 'Fluid Mechanics', 2, 3),
(36, NULL, 'Concrete Technology', 2, 3),
(37, NULL, 'Geotechnical Engineering', 2, 4),
(38, NULL, 'Environmental Engineering', 2, 4),
(39, NULL, 'Transportation Engineering', 2, 4),
(40, NULL, 'Hydrology', 2, 4),
(41, NULL, 'Design of Structures', 2, 5),
(42, NULL, 'Construction Management', 2, 5),
(43, NULL, 'Irrigation Engineering', 2, 5),
(44, NULL, 'Advanced Surveying', 2, 5),
(45, NULL, 'Project Work', 2, 6),
(46, NULL, 'Industrial Training', 2, 6),
(47, NULL, 'Quantity Surveying', 2, 6),
(48, NULL, 'Urban Planning', 2, 6),
(49, NULL, 'Mathematics I', 3, 1),
(50, NULL, 'Physics', 3, 1),
(51, NULL, 'Engineering Mechanics', 3, 1),
(52, NULL, 'Workshop Practice', 3, 1),
(53, NULL, 'Mathematics II', 3, 2),
(54, NULL, 'Chemistry', 3, 2),
(55, NULL, 'Thermodynamics', 3, 2),
(56, NULL, 'Engineering Drawing', 3, 2),
(57, NULL, 'Fluid Mechanics', 3, 3),
(58, NULL, 'Strength of Materials', 3, 3),
(59, NULL, 'Manufacturing Process', 3, 3),
(60, NULL, 'Machine Drawing', 3, 3),
(61, NULL, 'Heat Transfer', 3, 4),
(62, NULL, 'Dynamics of Machines', 3, 4),
(63, NULL, 'Metrology', 3, 4),
(64, NULL, 'Industrial Engineering', 3, 4),
(65, NULL, 'Automobile Engineering', 3, 5),
(66, NULL, 'Refrigeration & AC', 3, 5),
(67, NULL, 'CNC Technology', 3, 5),
(68, NULL, 'Robotics', 3, 5),
(69, NULL, 'Project Work', 3, 6),
(70, NULL, 'Industrial Training', 3, 6),
(71, NULL, 'Maintenance Engineering', 3, 6),
(72, NULL, 'Energy Engineering', 3, 6),
(73, '12112', 'as', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `system_name` varchar(100) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `min_attendance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timetable_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `period` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','faculty','student','parent','hod','guest') DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`, `department_id`) VALUES
(1, 'Admin', 'admin@gptc.com', '1234', 'admin', 'active', '2026-03-22 23:23:21', NULL),
(2, 'Faculty', 'faculty@gptc.com', '1234', 'faculty', 'active', '2026-03-22 23:23:21', NULL),
(3, 'Student', 'student@gptc.com', '1234', 'student', 'active', '2026-03-22 23:23:21', NULL),
(4, 'Parent', 'parent@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:23:21', NULL),
(5, 'CT Faculty 1', 'ct_fac1@gptc.com', '1234', 'faculty', 'active', '2026-03-22 23:31:24', NULL),
(6, 'CT Faculty 2', 'ct_fac2@gptc.com', '1234', 'faculty', 'active', '2026-03-22 23:31:24', NULL),
(7, 'Civil Faculty 1', 'ce_fac1@gptc.com', '1234', 'faculty', 'active', '2026-03-22 23:31:24', NULL),
(8, 'Civil Faculty 2', 'ce_fac2@gptc.com', '1234', 'faculty', 'active', '2026-03-22 23:31:24', NULL),
(9, 'Mech Faculty 1', 'me_fac1@gptc.com', '1234', 'faculty', 'active', '2026-03-22 23:31:24', NULL),
(10, 'Mech Faculty 2', 'me_fac2@gptc.com', '1234', 'faculty', 'active', '2026-03-22 23:31:24', NULL),
(11, 'CT_S1_Student1', 'ct_s1_1@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(12, 'CT_S1_Student2', 'ct_s1_2@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(13, 'CT_S1_Student3', 'ct_s1_3@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(14, 'CT_S1_Student4', 'ct_s1_4@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(15, 'CT_S1_Student5', 'ct_s1_5@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(16, 'CT_S1_Student6', 'ct_s1_6@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(17, 'CT_S1_Student7', 'ct_s1_7@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(18, 'CT_S1_Student8', 'ct_s1_8@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(19, 'CT_S1_Student9', 'ct_s1_9@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(20, 'CT_S1_Student10', 'ct_s1_10@gptc.com', '1234', 'student', 'active', '2026-03-22 23:39:14', NULL),
(21, 'CT_S1_Student1 Parent', 'parent_ct_1@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(22, 'CT_S1_Student2 Parent', 'parent_ct_2@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(23, 'CT_S1_Student3 Parent', 'parent_ct_3@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(24, 'CT_S1_Student4 Parent', 'parent_ct_4@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(25, 'CT_S1_Student5 Parent', 'parent_ct_5@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(26, 'CT_S1_Student6 Parent', 'parent_ct_6@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(27, 'CT_S1_Student7 Parent', 'parent_ct_7@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(28, 'CT_S1_Student8 Parent', 'parent_ct_8@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(29, 'CT_S1_Student9 Parent', 'parent_ct_9@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(30, 'CT_S1_Student10 Parent', 'parent_ct_10@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:40:15', NULL),
(31, 'CT_S2_Student1', 'ct_s2_1@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(32, 'CT_S2_Student2', 'ct_s2_2@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(33, 'CT_S2_Student3', 'ct_s2_3@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(34, 'CT_S2_Student4', 'ct_s2_4@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(35, 'CT_S2_Student5', 'ct_s2_5@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(36, 'CT_S2_Student6', 'ct_s2_6@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(37, 'CT_S2_Student7', 'ct_s2_7@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(38, 'CT_S2_Student8', 'ct_s2_8@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(39, 'CT_S2_Student9', 'ct_s2_9@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(40, 'CT_S2_Student10', 'ct_s2_10@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(41, 'CT_S3_Student1', 'ct_s3_1@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(42, 'CT_S3_Student2', 'ct_s3_2@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(43, 'CT_S3_Student3', 'ct_s3_3@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(44, 'CT_S3_Student4', 'ct_s3_4@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(45, 'CT_S3_Student5', 'ct_s3_5@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(46, 'CT_S3_Student6', 'ct_s3_6@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(47, 'CT_S3_Student7', 'ct_s3_7@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(48, 'CT_S3_Student8', 'ct_s3_8@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(49, 'CT_S3_Student9', 'ct_s3_9@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(50, 'CT_S3_Student10', 'ct_s3_10@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(51, 'CT_S4_Student1', 'ct_s4_1@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(52, 'CT_S4_Student2', 'ct_s4_2@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(53, 'CT_S4_Student3', 'ct_s4_3@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(54, 'CT_S4_Student4', 'ct_s4_4@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(55, 'CT_S4_Student5', 'ct_s4_5@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(56, 'CT_S4_Student6', 'ct_s4_6@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(57, 'CT_S4_Student7', 'ct_s4_7@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(58, 'CT_S4_Student8', 'ct_s4_8@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(59, 'CT_S4_Student9', 'ct_s4_9@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(60, 'CT_S4_Student10', 'ct_s4_10@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(61, 'CT_S5_Student1', 'ct_s5_1@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(62, 'CT_S5_Student2', 'ct_s5_2@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(63, 'CT_S5_Student3', 'ct_s5_3@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(64, 'CT_S5_Student4', 'ct_s5_4@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(65, 'CT_S5_Student5', 'ct_s5_5@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(66, 'CT_S5_Student6', 'ct_s5_6@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(67, 'CT_S5_Student7', 'ct_s5_7@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(68, 'CT_S5_Student8', 'ct_s5_8@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(69, 'CT_S5_Student9', 'ct_s5_9@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(70, 'CT_S5_Student10', 'ct_s5_10@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(71, 'CT_S6_Student1', 'ct_s6_1@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(72, 'CT_S6_Student2', 'ct_s6_2@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(73, 'CT_S6_Student3', 'ct_s6_3@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(74, 'CT_S6_Student4', 'ct_s6_4@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(75, 'CT_S6_Student5', 'ct_s6_5@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(76, 'CT_S6_Student6', 'ct_s6_6@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(77, 'CT_S6_Student7', 'ct_s6_7@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(78, 'CT_S6_Student8', 'ct_s6_8@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(79, 'CT_S6_Student9', 'ct_s6_9@gptc.com', '1234', 'student', 'active', '2026-03-22 23:44:15', NULL),
(82, 'CT_S1_Student1 Parent', 'parent_ct_11@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(83, 'CT_S1_Student2 Parent', 'parent_ct_12@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(84, 'CT_S1_Student3 Parent', 'parent_ct_13@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(85, 'CT_S1_Student4 Parent', 'parent_ct_14@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(86, 'CT_S1_Student5 Parent', 'parent_ct_15@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(87, 'CT_S1_Student6 Parent', 'parent_ct_16@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(88, 'CT_S1_Student7 Parent', 'parent_ct_17@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(89, 'CT_S1_Student8 Parent', 'parent_ct_18@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(90, 'CT_S1_Student9 Parent', 'parent_ct_19@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(91, 'CT_S1_Student10 Parent', 'parent_ct_110@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(92, 'CT_S1_Student1 Parent', 'parent_ct_116@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(93, 'CT_S1_Student2 Parent', 'parent_ct_117@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(94, 'CT_S1_Student3 Parent', 'parent_ct_118@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(95, 'CT_S1_Student4 Parent', 'parent_ct_119@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(96, 'CT_S1_Student5 Parent', 'parent_ct_120@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(97, 'CT_S1_Student6 Parent', 'parent_ct_121@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(98, 'CT_S1_Student7 Parent', 'parent_ct_122@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(99, 'CT_S1_Student8 Parent', 'parent_ct_123@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(100, 'CT_S1_Student9 Parent', 'parent_ct_124@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(101, 'CT_S1_Student10 Parent', 'parent_ct_125@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(102, 'CT_S2_Student1 Parent', 'parent_ct_131@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(103, 'CT_S2_Student2 Parent', 'parent_ct_132@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(104, 'CT_S2_Student3 Parent', 'parent_ct_133@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(105, 'CT_S2_Student4 Parent', 'parent_ct_134@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(106, 'CT_S2_Student5 Parent', 'parent_ct_135@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(107, 'CT_S2_Student6 Parent', 'parent_ct_136@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(108, 'CT_S2_Student7 Parent', 'parent_ct_137@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(109, 'CT_S2_Student8 Parent', 'parent_ct_138@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(110, 'CT_S2_Student9 Parent', 'parent_ct_139@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(111, 'CT_S2_Student10 Parent', 'parent_ct_140@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(112, 'CT_S3_Student1 Parent', 'parent_ct_146@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(113, 'CT_S3_Student2 Parent', 'parent_ct_147@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(114, 'CT_S3_Student3 Parent', 'parent_ct_148@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(115, 'CT_S3_Student4 Parent', 'parent_ct_149@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(116, 'CT_S3_Student5 Parent', 'parent_ct_150@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(117, 'CT_S3_Student6 Parent', 'parent_ct_151@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(118, 'CT_S3_Student7 Parent', 'parent_ct_152@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(119, 'CT_S3_Student8 Parent', 'parent_ct_153@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(120, 'CT_S3_Student9 Parent', 'parent_ct_154@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(121, 'CT_S3_Student10 Parent', 'parent_ct_155@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(122, 'CT_S4_Student1 Parent', 'parent_ct_161@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(123, 'CT_S4_Student2 Parent', 'parent_ct_162@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(124, 'CT_S4_Student3 Parent', 'parent_ct_163@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(125, 'CT_S4_Student4 Parent', 'parent_ct_164@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(126, 'CT_S4_Student5 Parent', 'parent_ct_165@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(127, 'CT_S4_Student6 Parent', 'parent_ct_166@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(128, 'CT_S4_Student7 Parent', 'parent_ct_167@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(129, 'CT_S4_Student8 Parent', 'parent_ct_168@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(130, 'CT_S4_Student9 Parent', 'parent_ct_169@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(131, 'CT_S4_Student10 Parent', 'parent_ct_170@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(132, 'CT_S5_Student1 Parent', 'parent_ct_176@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(133, 'CT_S5_Student2 Parent', 'parent_ct_177@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(134, 'CT_S5_Student3 Parent', 'parent_ct_178@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(135, 'CT_S5_Student4 Parent', 'parent_ct_179@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(136, 'CT_S5_Student5 Parent', 'parent_ct_180@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(137, 'CT_S5_Student6 Parent', 'parent_ct_181@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(138, 'CT_S5_Student7 Parent', 'parent_ct_182@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(139, 'CT_S5_Student8 Parent', 'parent_ct_183@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(140, 'CT_S5_Student9 Parent', 'parent_ct_184@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(141, 'CT_S5_Student10 Parent', 'parent_ct_185@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(142, 'CT_S6_Student1 Parent', 'parent_ct_191@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(143, 'CT_S6_Student2 Parent', 'parent_ct_192@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(144, 'CT_S6_Student3 Parent', 'parent_ct_193@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(145, 'CT_S6_Student4 Parent', 'parent_ct_194@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(146, 'CT_S6_Student5 Parent', 'parent_ct_195@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(147, 'CT_S6_Student6 Parent', 'parent_ct_196@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(148, 'CT_S6_Student7 Parent', 'parent_ct_197@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(149, 'CT_S6_Student8 Parent', 'parent_ct_198@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(150, 'CT_S6_Student9 Parent', 'parent_ct_199@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(151, 'CT_S6_Student10 Parent', 'parent_ct_1100@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:01', NULL),
(209, 'CT_S1_Student1 Parent', 'parent_ct1_1@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(210, 'CT_S1_Student2 Parent', 'parent_ct1_2@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(211, 'CT_S1_Student3 Parent', 'parent_ct1_3@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(212, 'CT_S1_Student4 Parent', 'parent_ct1_4@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(213, 'CT_S1_Student5 Parent', 'parent_ct1_5@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(214, 'CT_S1_Student6 Parent', 'parent_ct1_6@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(215, 'CT_S1_Student7 Parent', 'parent_ct1_7@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(216, 'CT_S1_Student8 Parent', 'parent_ct1_8@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(217, 'CT_S1_Student9 Parent', 'parent_ct1_9@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(218, 'CT_S1_Student10 Parent', 'parent_ct1_10@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(219, 'CT_S1_Student1 Parent', 'parent_ct1_16@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(220, 'CT_S1_Student2 Parent', 'parent_ct1_17@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(221, 'CT_S1_Student3 Parent', 'parent_ct1_18@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(222, 'CT_S1_Student4 Parent', 'parent_ct1_19@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(223, 'CT_S1_Student5 Parent', 'parent_ct1_20@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(224, 'CT_S1_Student6 Parent', 'parent_ct1_21@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(225, 'CT_S1_Student7 Parent', 'parent_ct1_22@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(226, 'CT_S1_Student8 Parent', 'parent_ct1_23@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(227, 'CT_S1_Student9 Parent', 'parent_ct1_24@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(228, 'CT_S1_Student10 Parent', 'parent_ct1_25@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(229, 'CT_S2_Student1 Parent', 'parent_ct1_31@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(230, 'CT_S2_Student2 Parent', 'parent_ct1_32@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(231, 'CT_S2_Student3 Parent', 'parent_ct1_33@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(232, 'CT_S2_Student4 Parent', 'parent_ct1_34@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(233, 'CT_S2_Student5 Parent', 'parent_ct1_35@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(234, 'CT_S2_Student6 Parent', 'parent_ct1_36@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(235, 'CT_S2_Student7 Parent', 'parent_ct1_37@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(236, 'CT_S2_Student8 Parent', 'parent_ct1_38@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(237, 'CT_S2_Student9 Parent', 'parent_ct1_39@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(238, 'CT_S2_Student10 Parent', 'parent_ct1_40@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(239, 'CT_S3_Student1 Parent', 'parent_ct1_46@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(240, 'CT_S3_Student2 Parent', 'parent_ct1_47@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(241, 'CT_S3_Student3 Parent', 'parent_ct1_48@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(242, 'CT_S3_Student4 Parent', 'parent_ct1_49@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(243, 'CT_S3_Student5 Parent', 'parent_ct1_50@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(244, 'CT_S3_Student6 Parent', 'parent_ct1_51@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(245, 'CT_S3_Student7 Parent', 'parent_ct1_52@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(246, 'CT_S3_Student8 Parent', 'parent_ct1_53@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(247, 'CT_S3_Student9 Parent', 'parent_ct1_54@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(248, 'CT_S3_Student10 Parent', 'parent_ct1_55@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(249, 'CT_S4_Student1 Parent', 'parent_ct1_61@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(250, 'CT_S4_Student2 Parent', 'parent_ct1_62@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(251, 'CT_S4_Student3 Parent', 'parent_ct1_63@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(252, 'CT_S4_Student4 Parent', 'parent_ct1_64@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(253, 'CT_S4_Student5 Parent', 'parent_ct1_65@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(254, 'CT_S4_Student6 Parent', 'parent_ct1_66@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(255, 'CT_S4_Student7 Parent', 'parent_ct1_67@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(256, 'CT_S4_Student8 Parent', 'parent_ct1_68@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(257, 'CT_S4_Student9 Parent', 'parent_ct1_69@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(258, 'CT_S4_Student10 Parent', 'parent_ct1_70@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(259, 'CT_S5_Student1 Parent', 'parent_ct1_76@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(260, 'CT_S5_Student2 Parent', 'parent_ct1_77@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(261, 'CT_S5_Student3 Parent', 'parent_ct1_78@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(262, 'CT_S5_Student4 Parent', 'parent_ct1_79@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(263, 'CT_S5_Student5 Parent', 'parent_ct1_80@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(264, 'CT_S5_Student6 Parent', 'parent_ct1_81@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(265, 'CT_S5_Student7 Parent', 'parent_ct1_82@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(266, 'CT_S5_Student8 Parent', 'parent_ct1_83@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(267, 'CT_S5_Student9 Parent', 'parent_ct1_84@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(268, 'CT_S5_Student10 Parent', 'parent_ct1_85@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(269, 'CT_S6_Student1 Parent', 'parent_ct1_91@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(270, 'CT_S6_Student2 Parent', 'parent_ct1_92@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(271, 'CT_S6_Student3 Parent', 'parent_ct1_93@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(272, 'CT_S6_Student4 Parent', 'parent_ct1_94@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(273, 'CT_S6_Student5 Parent', 'parent_ct1_95@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(274, 'CT_S6_Student6 Parent', 'parent_ct1_96@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(275, 'CT_S6_Student7 Parent', 'parent_ct1_97@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(276, 'CT_S6_Student8 Parent', 'parent_ct1_98@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(277, 'CT_S6_Student9 Parent', 'parent_ct1_99@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(278, 'CT_S6_Student10 Parent', 'parent_ct1_100@gptc.com', '1234', 'parent', 'active', '2026-03-22 23:49:33', NULL),
(283, 'CSE HOD', 'hod@gptc.com', '1234', 'hod', 'active', '2026-05-12 12:45:40', 1),
(287, 'aswin', 'aswin.sreenivas005@gmail.com', 'aswin@2006', 'student', 'active', '2026-05-12 13:31:33', NULL),
(289, 'df', 'dfrastykhtgrefdg@wefdgh', 'df', '', 'active', '2026-05-12 13:35:20', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `unique_attendance` (`student_id`,`subject_id`,`date`,`period`);

--
-- Indexes for table `attendance_alerts`
--
ALTER TABLE `attendance_alerts`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `attendance_summary`
--
ALTER TABLE `attendance_summary`
  ADD PRIMARY KEY (`summary_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `condonation_requests`
--
ALTER TABLE `condonation_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `database_backups`
--
ALTER TABLE `database_backups`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `faculty_subjects`
--
ALTER TABLE `faculty_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `hod`
--
ALTER TABLE `hod`
  ADD PRIMARY KEY (`hod_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `registration_requests`
--
ALTER TABLE `registration_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `attendance_alerts`
--
ALTER TABLE `attendance_alerts`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_summary`
--
ALTER TABLE `attendance_summary`
  MODIFY `summary_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `condonation_requests`
--
ALTER TABLE `condonation_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `database_backups`
--
ALTER TABLE `database_backups`
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty_subjects`
--
ALTER TABLE `faculty_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hod`
--
ALTER TABLE `hod`
  MODIFY `hod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `registration_requests`
--
ALTER TABLE `registration_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
