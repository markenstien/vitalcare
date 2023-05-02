-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 10:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `th_patientrecord`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(10) NOT NULL,
  `block_house_number` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `block_house_number`, `street`, `city`, `barangay`, `zip`, `created_at`) VALUES
(1, '2c119 abc', 'street-test', 'Quezon City', 'brgy-test', '1800', '2021-12-24 07:16:36'),
(2, '2c119 abc', 'street-test', 'Quezon City', 'brgy-test', '1800', '2021-12-24 07:17:06'),
(3, '2c119 abc', 'DONBOSCO', 'Quezon City', 'brgy-test', '1800', '2021-12-24 07:19:19'),
(4, '3', 'Agno Extension', 'Quezon City', 'Tatalon', '1113', '2022-01-05 04:35:06'),
(5, '123', 'Sample', 'Sample', 'Sample', '12312', '2022-01-05 04:48:03'),
(6, '3', 'Agno Extension', 'Quezon City', 'Tatalon', '1113', '2022-01-07 14:27:59'),
(7, '123', 'Sample', 'Sample', 'Sample', '12312', '2022-01-07 14:34:24'),
(8, '123 ', 'Agno ', 'QC', 'Tatalon', '1231', '2022-01-08 17:01:38'),
(9, '2c119 Laffayete', 'Building C', 'Paranque', 'Donbosco', '117', '2022-01-09 15:18:09'),
(10, '34', 'zamora', 'qc', 'paltok', '1105', '2022-01-10 03:28:39'),
(11, '66', 'Gomez', 'QC', 'Paltok', '1105', '2022-01-10 03:33:38'),
(12, '06', 'Agno Ext ', 'QC', 'Tatalon', '1113', '2022-01-11 01:03:51'),
(13, '08', 'Agno Ext', 'QC', 'Tatalon ', '1113', '2022-01-11 01:06:26'),
(14, '8', 'Agno Ext', 'QC', 'Tatalon', '1113', '2022-01-11 01:28:00'),
(15, '8', ' Agno ', 'QC', 'Tatalon', '1113', '2022-01-11 02:34:52'),
(16, '44', 'Narra', 'Qeuzon City', 'Tatalon', '1113', '2022-01-11 08:46:59'),
(17, '8', 'Agno Ext', 'QC', 'Tatalon', '1113', '2022-01-12 07:37:19'),
(18, '34', 'zamora', 'qc', 'paltok', '1105', '2022-01-12 07:37:40'),
(19, '34', 'zamora', 'qc', 'paltok', '1105', '2022-01-12 07:37:51'),
(20, '34', 'zamora', 'qc', 'paltok', '1105', '2022-01-12 07:38:03'),
(21, '34', 'zamora', 'qc', 'paltok', '1105', '2022-01-12 07:39:16'),
(22, '10', 'AGNO', 'QC', 'Tatalon', '1113', '2022-01-12 07:42:55'),
(23, '10', 'AGNO', 'QC', 'Tatalon', '1113', '2022-01-13 01:32:36'),
(24, '10', 'AGNO', 'QC', 'Tatalon', '1113', '2022-01-13 01:32:47'),
(25, '10', 'AGNO', 'QC', 'Tatalon', '1113', '2022-01-13 01:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int(10) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `type` enum('online','walk-in') DEFAULT NULL,
  `status` enum('pending','arrived','cancelled','scheduled') DEFAULT NULL,
  `date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `guest_name` varchar(100) DEFAULT NULL,
  `guest_email` varchar(100) DEFAULT NULL,
  `guest_phone` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `reference`, `type`, `status`, `date`, `end_time`, `start_time`, `user_id`, `remark`, `guest_name`, `guest_email`, `guest_phone`, `created_at`) VALUES
(1, 'APT-6DD7D3A', 'walk-in', 'arrived', '2022-01-10', NULL, '10:00:00', 0, '', 'Renato Anzano', 'anzano66@gmail.com', '09217296722', '2022-01-12 02:43:58'),
(2, 'APT-706C6A7', 'online', 'pending', '2022-01-12', NULL, '10:46:43', 29, '', 'Renato Anza', 'anzano66@gmail.com', '09217296722', '2022-01-12 02:46:48'),
(3, 'APT-201DE7D', 'online', 'pending', '2022-01-14', NULL, '02:20:12', 29, '', 'Renato Anza', 'anzano66@gmail.com', '09217296722', '2022-01-12 06:20:20'),
(4, 'APT-9CA6442', 'online', 'pending', '2022-01-12', NULL, '02:39:16', 24, '', 'Jhonny Mcfly', 'gonzalesmarkangeloph@gmail.com', '09063387451', '2022-01-12 06:39:23'),
(5, 'APT-5A644E1', 'online', 'pending', '2022-01-13', NULL, '02:21:57', 29, '', 'Renato Anza', 'anzano66@gmail.com', '09217296722', '2022-01-12 06:40:21'),
(6, 'APT-FBFC33D', 'online', 'scheduled', '2022-01-13', NULL, '02:49:49', 29, '', 'Renato Anza', 'anzano66@gmail.com', '09217296722', '2022-01-12 06:49:53'),
(7, 'APT-11E9C98', 'online', 'pending', '2022-01-12', NULL, '03:06:08', 29, '', 'Renato Anza', 'anzano66@gmail.com', '09217296722', '2022-01-12 07:06:12'),
(8, 'APT-A7020C8', 'online', 'arrived', '2022-01-12', NULL, '03:35:41', 29, '', 'Renato Anza', 'anzano66@gmail.com', '09217296722', '2022-01-12 07:35:44'),
(9, 'APT-6B6F768', 'walk-in', 'arrived', '2022-01-12', NULL, '21:45:00', 0, '', 'Renato Anzano', 'ranzano66@gmail.com', '09195214036', '2022-01-12 07:44:32'),
(10, 'APT-85145B3', 'online', 'scheduled', '2022-01-12', NULL, '13:47:55', 29, '', 'Renato Anza', 'anzano66@gmail.com', '09217296722', '2022-01-12 07:46:07'),
(11, 'APT-9102F54', 'online', 'pending', '2022-01-20', NULL, '09:26:28', 26, '', 'Jhonny romero', 'javerei_ramos@yahoo.com', '09287287598', '2022-01-12 10:27:04'),
(12, 'APT-71104D5', 'online', 'scheduled', '2023-03-25', NULL, '12:59:19', 29, '', 'Renato Anza', 'anzano66@gmail.com', '09217296722', '2022-01-12 16:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `id` int(10) NOT NULL,
  `label` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `search_key` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `global_key` varchar(100) DEFAULT NULL,
  `global_id` int(10) DEFAULT NULL,
  `path` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `full_path` text DEFAULT NULL,
  `full_url` text DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `label`, `filename`, `file_type`, `display_name`, `search_key`, `description`, `global_key`, `global_id`, `path`, `url`, `full_path`, `full_url`, `is_visible`, `created_by`, `created_at`) VALUES
(13, 'sample', '12_C7F61E89CD8E601.PNG', 'png', 'Sample Result.png', NULL, 'sample', 'PATIENT_SESSION', 14, '/home/arthsobx/vitalcare.sbs/public/uploads', 'https://vitalcare.sbs//public/uploads', '/home/arthsobx/vitalcare.sbs/public/uploads/12_C7F61E89CD8E601.PNG', 'https://vitalcare.sbs//public/uploads/12_C7F61E89CD8E601.PNG', NULL, NULL, '2021-12-20 19:25:48'),
(14, 'asdas', '01_48E877385BF72D7.DOCX', 'docx', 'pagbasa-at-pagsusuri ramos finals 5.docx', NULL, 'asdasd', 'PATIENT_SESSION', 2, '/home/arthsobx/vitalcare.sbs/public/uploads', 'https://vitalcare.sbs//public/uploads', '/home/arthsobx/vitalcare.sbs/public/uploads/01_48E877385BF72D7.DOCX', 'https://vitalcare.sbs//public/uploads/01_48E877385BF72D7.DOCX', NULL, NULL, '2022-01-07 14:36:54'),
(15, '1', '01_239AEEF17D9F74B.DOCX', 'docx', 'boarder2.docx', NULL, '3', 'PATIENT_SESSION', 5, '/home/arthsobx/vitalcare.sbs/public/uploads', 'https://vitalcare.sbs//public/uploads', '/home/arthsobx/vitalcare.sbs/public/uploads/01_239AEEF17D9F74B.DOCX', 'https://vitalcare.sbs//public/uploads/01_239AEEF17D9F74B.DOCX', NULL, NULL, '2022-01-10 03:42:28'),
(16, '2', '01_CCFD6FFC34C13A4.DOCX', 'docx', 'boarder2.docx', NULL, '22', 'PATIENT_SESSION', 6, '/home/arthsobx/vitalcare.sbs/public/uploads', 'https://vitalcare.sbs//public/uploads', '/home/arthsobx/vitalcare.sbs/public/uploads/01_CCFD6FFC34C13A4.DOCX', 'https://vitalcare.sbs//public/uploads/01_CCFD6FFC34C13A4.DOCX', NULL, NULL, '2022-01-10 03:49:36'),
(17, 'result', '01_D86AE8A6B4B697C.PNG', 'png', 'Sample Result.png', NULL, 'Sample Desc', 'PATIENT_SESSION', 7, '/home/arthsobx/vitalcare.sbs/public/uploads', 'https://vitalcare.sbs//public/uploads', '/home/arthsobx/vitalcare.sbs/public/uploads/01_D86AE8A6B4B697C.PNG', 'https://vitalcare.sbs//public/uploads/01_D86AE8A6B4B697C.PNG', NULL, NULL, '2022-01-11 01:52:35'),
(18, 'Sample', '01_DEAA9F0DE3820C2.PNG', 'png', 'Sample Result.png', NULL, 'SAMPLE', 'PATIENT_SESSION', 9, '/home/arthsobx/vitalcare.sbs/public/uploads', 'https://vitalcare.sbs//public/uploads', '/home/arthsobx/vitalcare.sbs/public/uploads/01_DEAA9F0DE3820C2.PNG', 'https://vitalcare.sbs//public/uploads/01_DEAA9F0DE3820C2.PNG', NULL, NULL, '2022-01-11 02:48:57'),
(19, 'sample', '01_7D7204397616218.PNG', 'png', 'Sample_Result.png', NULL, 'sample', 'PATIENT_SESSION', 10, '/home/arthsobx/vitalcare.sbs/public/uploads', 'https://vitalcare.sbs//public/uploads', '/home/arthsobx/vitalcare.sbs/public/uploads/01_7D7204397616218.PNG', 'https://vitalcare.sbs//public/uploads/01_7D7204397616218.PNG', NULL, NULL, '2022-01-11 08:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `id` int(10) NOT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('paid','unpaid') DEFAULT NULL,
  `payment_method` enum('online','cash','na') DEFAULT NULL,
  `bill_to_name` varchar(50) DEFAULT NULL,
  `bill_to_email` varchar(50) DEFAULT NULL,
  `bill_to_phone` varchar(50) DEFAULT NULL,
  `appointment_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `reference`, `user_id`, `total_amount`, `payment_status`, `payment_method`, `bill_to_name`, `bill_to_email`, `bill_to_phone`, `appointment_id`, `created_at`, `created_by`) VALUES
(1, 'BILL-E902AAF', 0, '290.00', 'paid', 'cash', 'Renato Anzano', 'anzano66@gmail.com', '09217296722', 1, '2022-01-12 02:44:41', NULL),
(2, 'BILL-4881DEE', 29, '290.00', 'unpaid', 'na', 'Renato Anza', 'anzano66@gmail.com', '09217296722', 2, '2022-01-12 02:46:54', NULL),
(3, 'BILL-D725F6C', 29, '290.00', 'unpaid', 'na', 'Renato Anza', 'anzano66@gmail.com', '09217296722', 3, '2022-01-12 06:20:25', NULL),
(4, 'BILL-1D5CE7E', 24, '290.00', 'unpaid', 'na', 'Jhonny Mcfly', 'gonzalesmarkangeloph@gmail.com', '09063387451', 4, '2022-01-12 06:39:28', NULL),
(5, 'BILL-9AB1C2D', 29, '290.00', 'unpaid', 'na', 'Renato Anza', 'anzano66@gmail.com', '09217296722', 5, '2022-01-12 06:40:26', NULL),
(6, 'BILL-F60654E', 29, '290.00', 'paid', 'online', 'Renato Anza', 'anzano66@gmail.com', '09217296722', 6, '2022-01-12 06:51:09', NULL),
(7, 'BILL-A691728', 29, '2000.00', 'unpaid', 'na', 'Renato Anza', 'anzano66@gmail.com', '09217296722', 7, '2022-01-12 07:06:16', NULL),
(8, 'BILL-7C05EF9', 29, '2000.00', 'paid', 'cash', 'Renato Anza', 'anzano66@gmail.com', '09217296722', 8, '2022-01-12 07:39:40', NULL),
(9, 'BILL-AEB06B7', 0, '4370.00', 'unpaid', 'na', 'Renato Anzano', 'ranzano66@gmail.com', '09195214036', 9, '2022-01-12 07:44:32', NULL),
(10, 'BILL-BBD88A6', 29, '2000.00', 'paid', 'online', 'Renato Anza', 'anzano66@gmail.com', '09217296722', 10, '2022-01-12 07:47:29', NULL),
(11, 'BILL-8CBCAA4', 26, '290.00', 'unpaid', 'na', 'Jhonny romero', 'javerei_ramos@yahoo.com', '09287287598', 11, '2022-01-12 10:27:10', NULL),
(12, 'BILL-294EFB1', 29, '640.00', 'paid', 'online', 'Renato Anza', 'anzano66@gmail.com', '09217296722', 12, '2022-01-12 17:01:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

DROP TABLE IF EXISTS `bill_items`;
CREATE TABLE `bill_items` (
  `id` int(10) NOT NULL,
  `bill_id` int(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`id`, `bill_id`, `name`, `description`, `price`, `created_at`) VALUES
(1, 1, 'Package X', 'SamplE Package X', '300.00', '2022-01-12 02:43:58'),
(2, 2, 'Package X', 'SamplE Package X', '300.00', '2022-01-12 02:46:54'),
(3, 3, 'Package X', 'SamplE Package X', '300.00', '2022-01-12 06:20:25'),
(4, 4, 'Package X', 'SamplE Package X', '300.00', '2022-01-12 06:39:28'),
(5, 5, 'Package X', 'SamplE Package X', '300.00', '2022-01-12 06:40:26'),
(6, 6, 'Package X', 'SamplE Package X', '300.00', '2022-01-12 06:49:58'),
(7, 7, 'CA 125', 'Sample Description', '2000.00', '2022-01-12 07:06:16'),
(8, 8, 'CA 125', 'Sample Description', '2000.00', '2022-01-12 07:35:48'),
(9, 9, 'Chloride', 'Description of Chloride', '370.00', '2022-01-12 07:44:32'),
(10, 9, 'CA 125', 'Sample Description', '2000.00', '2022-01-12 07:44:32'),
(11, 9, 'CA 125', 'Sample Description', '2000.00', '2022-01-12 07:44:32'),
(12, 10, 'CA 125', 'Sample Description', '2000.00', '2022-01-12 07:46:12'),
(13, 11, 'Package X', 'SamplE Package X', '300.00', '2022-01-12 10:27:10'),
(14, 12, 'Amylase', 'Sample Description', '640.00', '2022-01-12 16:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  `cat_key` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors` (
  `id` int(10) NOT NULL,
  `license_number` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `license_number`, `user_id`) VALUES
(1, '988715781', '25'),
(3, '9828715781', '25'),
(4, '9887157811', '25'),
(5, '12341231', '32'),
(6, '123412312', '32');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_specializations`
--

DROP TABLE IF EXISTS `doctors_specializations`;
CREATE TABLE `doctors_specializations` (
  `id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `specialty_id` int(10) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `method` enum('online','cash') DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `org` varchar(100) DEFAULT NULL,
  `external_reference` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `acc_name` varchar(100) DEFAULT NULL,
  `bill_id` int(10) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `reference`, `amount`, `method`, `notes`, `org`, `external_reference`, `acc_no`, `acc_name`, `bill_id`, `created_by`, `created_at`) VALUES
(1, 'PMT-21B57A8', '290.00', 'cash', 'payment by cash', NULL, NULL, NULL, 'Renato Anzano', 1, 4, '2022-01-12 02:44:41'),
(2, 'PMT-661A572', '290.00', 'online', NULL, 'PAYPAL', '6B119904M06875347', NULL, 'Renato Anza', 6, NULL, '2022-01-12 06:51:09'),
(3, 'PMT-C229373', '2000.00', 'cash', 'payment by cash', NULL, NULL, NULL, 'Renato Anza', 8, 4, '2022-01-12 07:39:40'),
(4, 'PMT-7F91F64', '2000.00', 'online', NULL, 'PAYPAL', '9X096095007516459', NULL, 'Renato Anza', 10, NULL, '2022-01-12 07:47:29'),
(5, 'PMT-14B2B03', '640.00', 'online', NULL, 'PAYPAL', '01J193167G1468127', NULL, 'Renato Anza', 12, NULL, '2022-01-12 17:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_setting`
--

DROP TABLE IF EXISTS `schedule_setting`;
CREATE TABLE `schedule_setting` (
  `id` int(10) NOT NULL,
  `day` varchar(100) DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `max_visitor_count` int(10) DEFAULT NULL,
  `is_shop_closed` tinyint(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_setting`
--

INSERT INTO `schedule_setting` (`id`, `day`, `opening_time`, `closing_time`, `max_visitor_count`, `is_shop_closed`, `updated_at`) VALUES
(1, 'monday', '10:00:00', '19:00:00', 10, 0, '2021-12-06 07:17:55'),
(2, 'tuesday', '10:00:00', '18:00:00', 10, 0, '2022-01-12 02:05:57'),
(3, 'wednesday', '08:00:00', '18:00:00', 10, 0, '2022-01-12 02:06:02'),
(4, 'thursday', '10:00:00', '18:00:00', 10, 0, '2022-01-12 16:59:07'),
(5, 'friday', '10:00:00', '18:00:00', 20, 0, '2022-01-12 02:05:57'),
(6, 'saturday', '10:00:00', '18:00:00', 100, 0, '2021-12-05 22:19:15'),
(7, 'sunday', '10:00:00', '18:00:00', 100, 0, '2021-12-05 22:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `service` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('available','not-available') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT 1,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `code`, `price`, `status`, `description`, `category_id`, `is_visible`, `created_by`, `created_at`) VALUES
(14, 'ALP', 'ALPMBI', '320.00', '', 'Description of ALP', 22, 1, NULL, '2021-11-26 06:21:51'),
(32, 'Chloride', 'CHLOLDN', '370.00', '', 'Description of Chloride', 15, 1, NULL, '2021-11-26 06:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `service_bundles`
--

DROP TABLE IF EXISTS `service_bundles`;
CREATE TABLE `service_bundles` (
  `id` int(10) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `price_custom` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('available','unavailable') DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT 1,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_bundle_items`
--

DROP TABLE IF EXISTS `service_bundle_items`;
CREATE TABLE `service_bundle_items` (
  `id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `bundle_id` int(10) NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_bundle_items`
--

INSERT INTO `service_bundle_items` (`id`, `service_id`, `bundle_id`, `created_by`, `created_at`) VALUES
(1, 1, 1, NULL, '2021-11-26 08:09:42'),
(2, 5, 1, NULL, '2021-11-26 08:09:44'),
(3, 3, 1, NULL, '2021-11-26 08:09:47'),
(21, 81, 11, NULL, '2022-01-11 01:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `service_cart`
--

DROP TABLE IF EXISTS `service_cart`;
CREATE TABLE `service_cart` (
  `id` int(10) NOT NULL,
  `session_token` varchar(50) DEFAULT NULL,
  `service_id` int(10) NOT NULL,
  `type` enum('service','bundle') DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_cart`
--

INSERT INTO `service_cart` (`id`, `session_token`, `service_id`, `type`, `user_id`, `created_at`) VALUES
(15, '598683e367835feb11b6', 14, 'bundle', 26, '2022-01-12 10:36:41'),
(19, '00d95e90edf57e9a8461', 14, 'bundle', 4, '2022-01-13 05:19:15'),
(20, '00d95e90edf57e9a8461', 14, '', 4, '2023-03-27 20:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `guest_name` varchar(100) DEFAULT NULL,
  `guest_phone` varchar(100) DEFAULT NULL,
  `guest_email` varchar(100) DEFAULT NULL,
  `guest_address` varchar(100) DEFAULT NULL,
  `guest_gender` enum('male','female') DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `doctor_recommendations` text DEFAULT NULL,
  `appointment_id` int(10) DEFAULT NULL COMMENT 'nullable',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `doctor_id`, `guest_name`, `guest_phone`, `guest_email`, `guest_address`, `guest_gender`, `user_id`, `date_created`, `time_created`, `remarks`, `doctor_recommendations`, `appointment_id`, `created_at`) VALUES
(1, 25, 'Renato Anzano', '09217296722', 'anzano66@gmail.com', 'Tatalon', NULL, 0, '2022-01-12', NULL, NULL, NULL, 1, '2022-01-12 02:45:19'),
(2, 25, 'Renato Anzano', '09217296722', 'anzano66@gmail.com', 'Tatalon', NULL, 0, '2022-01-12', NULL, NULL, NULL, 1, '2022-01-12 02:46:09'),
(3, 25, 'Renato Anza', '09217296722', 'anzano66@gmail.com', 'Tatalon', 'male', 29, '2022-01-12', NULL, NULL, NULL, 8, '2022-01-12 07:38:39'),
(4, 25, 'Renato Anza', '09217296722', 'anzano66@gmail.com', 'Tatalon', 'male', 29, '2022-01-12', NULL, NULL, NULL, 8, '2022-01-12 07:39:56'),
(5, 32, 'Renato Anzano', '09195214036', 'ranzano66@gmail.com', 'Tatalon', 'male', 0, '2022-01-12', NULL, NULL, NULL, 9, '2022-01-12 07:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE `specialties` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_notifications`
--

DROP TABLE IF EXISTS `system_notifications`;
CREATE TABLE `system_notifications` (
  `id` int(10) NOT NULL,
  `message` text DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `heading` varchar(100) DEFAULT NULL,
  `subtext` varchar(100) DEFAULT NULL,
  `href` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_notifications`
--

INSERT INTO `system_notifications` (`id`, `message`, `icon`, `color`, `heading`, `subtext`, `href`, `created_at`, `updated_at`) VALUES
(1, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/1?', '2022-01-12 02:43:58', '2022-01-12 02:43:58'),
(2, 'Guest submitted a payment of 290.00', '', '', '', '', '/PaymentController/show/1?', '2022-01-12 02:44:41', '2022-01-12 02:44:41'),
(3, ' \'DRA/DR. \'.doctor started a session with Renato Anzano', '', '', '', '', '/SessionController/show/1?', '2022-01-12 02:45:24', '2022-01-12 02:45:24'),
(4, ' \'DRA/DR. \'.doctor started a session with Renato Anzano', '', '', '', '', '/SessionController/show/2?', '2022-01-12 02:46:14', '2022-01-12 02:46:14'),
(5, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/2?', '2022-01-12 02:46:48', '2022-01-12 02:46:48'),
(6, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/2?', '2022-01-12 02:46:54', '2022-01-12 02:46:54'),
(7, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/3?', '2022-01-12 06:20:20', '2022-01-12 06:20:20'),
(8, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/3?', '2022-01-12 06:20:25', '2022-01-12 06:20:25'),
(9, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/4?', '2022-01-12 06:39:23', '2022-01-12 06:39:23'),
(10, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/4?', '2022-01-12 06:39:28', '2022-01-12 06:39:28'),
(11, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/5?', '2022-01-12 06:40:21', '2022-01-12 06:40:21'),
(12, 'Appointment to vitalcare is submitted .# appointment reference', '', '', '', '', '/AppointmentController/show/5?', '2022-01-12 06:40:26', '2022-01-12 06:40:26'),
(13, 'Appointment to vitalcare is submitted .#APT-FBFC33D appointment reference', '', '', '', '', '/AppointmentController/show/6?', '2022-01-12 06:49:53', '2022-01-12 06:49:53'),
(14, 'Appointment to vitalcare is submitted .#APT-FBFC33D appointment reference', '', '', '', '', '/AppointmentController/show/6?', '2022-01-12 06:49:58', '2022-01-12 06:49:58'),
(15, 'You have paid your balance 290 via online.#PMT-661A572 Payment reference', '', '', '', '', '/PaymentController/show/2?', '2022-01-12 06:51:09', '2022-01-12 06:51:09'),
(16, 'Guest submitted a payment of 290', '', '', '', '', '/PaymentController/show/2?', '2022-01-12 06:51:09', '2022-01-12 06:51:09'),
(17, 'Appointment to vitalcare is submitted .#APT-11E9C98 appointment reference', '', '', '', '', '/AppointmentController/show/7?', '2022-01-12 07:06:12', '2022-01-12 07:06:12'),
(18, 'Appointment to vitalcare is submitted .#APT-11E9C98 appointment reference', '', '', '', '', '/AppointmentController/show/7?', '2022-01-12 07:06:16', '2022-01-12 07:06:16'),
(19, 'Appointment to vitalcare is submitted .#APT-A7020C8 appointment reference', '', '', '', '', '/AppointmentController/show/8?', '2022-01-12 07:35:44', '2022-01-12 07:35:44'),
(20, 'Appointment to vitalcare is submitted .#APT-A7020C8 appointment reference', '', '', '', '', '/AppointmentController/show/8?', '2022-01-12 07:35:48', '2022-01-12 07:35:48'),
(21, 'DRA/DR.  . started a session with you', '', '', '', '', '/SessionController/show/3?', '2022-01-12 07:38:39', '2022-01-12 07:38:39'),
(22, ' \'DRA/DR. \'.doctor started a session with Renato Anza', '', '', '', '', '/SessionController/show/3?', '2022-01-12 07:38:44', '2022-01-12 07:38:44'),
(23, 'You have paid your balance 2000.00 via cash.#PMT-C229373 Payment reference', '', '', '', '', '/PaymentController/show/3?', '2022-01-12 07:39:40', '2022-01-12 07:39:40'),
(24, 'Guest submitted a payment of 2000.00', '', '', '', '', '/PaymentController/show/3?', '2022-01-12 07:39:40', '2022-01-12 07:39:40'),
(25, 'DRA/DR.  . started a session with you', '', '', '', '', '/SessionController/show/4?', '2022-01-12 07:39:56', '2022-01-12 07:39:56'),
(26, ' \'DRA/DR. \'.doctor started a session with Renato Anza', '', '', '', '', '/SessionController/show/4?', '2022-01-12 07:40:01', '2022-01-12 07:40:01'),
(27, 'Appointment to vitalcare is submitted .#APT-6B6F768 appointment reference', '', '', '', '', '/AppointmentController/show/9?', '2022-01-12 07:44:32', '2022-01-12 07:44:32'),
(28, 'Appointment to vitalcare is submitted .#APT-85145B3 appointment reference', '', '', '', '', '/AppointmentController/show/10?', '2022-01-12 07:46:07', '2022-01-12 07:46:07'),
(29, 'Appointment to vitalcare is submitted .#APT-85145B3 appointment reference', '', '', '', '', '/AppointmentController/show/10?', '2022-01-12 07:46:12', '2022-01-12 07:46:12'),
(30, 'You have paid your balance 2000 via online.#PMT-7F91F64 Payment reference', '', '', '', '', '/PaymentController/show/4?', '2022-01-12 07:47:29', '2022-01-12 07:47:29'),
(31, 'Guest submitted a payment of 2000', '', '', '', '', '/PaymentController/show/4?', '2022-01-12 07:47:29', '2022-01-12 07:47:29'),
(32, ' \'DRA/DR. \'.Doctor started a session with Renato Anzano', '', '', '', '', '/SessionController/show/5?', '2022-01-12 07:47:52', '2022-01-12 07:47:52'),
(33, 'Appointment to vitalcare is submitted .#APT-9102F54 appointment reference', '', '', '', '', '/AppointmentController/show/11?', '2022-01-12 10:27:04', '2022-01-12 10:27:04'),
(34, 'Appointment to vitalcare is submitted .#APT-9102F54 appointment reference', '', '', '', '', '/AppointmentController/show/11?', '2022-01-12 10:27:10', '2022-01-12 10:27:10'),
(35, 'admin Created a new bundle Sample package#SAMPL2713', '', '', '', '', '', '2022-01-12 10:34:04', '2022-01-12 10:34:04'),
(36, 'Appointment to vitalcare is submitted .#APT-71104D5 appointment reference', '', '', '', '', '/AppointmentController/show/12?', '2022-01-12 16:59:25', '2022-01-12 16:59:25'),
(37, 'Appointment to vitalcare is submitted .#APT-71104D5 appointment reference', '', '', '', '', '/AppointmentController/show/12?', '2022-01-12 16:59:29', '2022-01-12 16:59:29'),
(38, 'You have paid your balance 640 via online.#PMT-14B2B03 Payment reference', '', '', '', '', '/PaymentController/show/5?', '2022-01-12 17:01:37', '2022-01-12 17:01:37'),
(39, 'Guest submitted a payment of 640', '', '', '', '', '/PaymentController/show/5?', '2022-01-12 17:01:37', '2022-01-12 17:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `system_notification_recipients`
--

DROP TABLE IF EXISTS `system_notification_recipients`;
CREATE TABLE `system_notification_recipients` (
  `id` int(10) NOT NULL,
  `notification_id` int(10) DEFAULT NULL,
  `recipient_id` int(10) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_notification_recipients`
--

INSERT INTO `system_notification_recipients` (`id`, `notification_id`, `recipient_id`, `is_read`, `updated_at`) VALUES
(1, 1, 4, 0, '2022-01-12 02:43:58'),
(2, 1, 25, 0, '2022-01-12 02:43:58'),
(3, 2, 4, 0, '2022-01-12 02:44:41'),
(4, 2, 25, 0, '2022-01-12 02:44:41'),
(5, 3, 4, 0, '2022-01-12 02:45:24'),
(6, 3, 25, 0, '2022-01-12 02:45:24'),
(7, 4, 4, 0, '2022-01-12 02:46:14'),
(8, 4, 25, 0, '2022-01-12 02:46:14'),
(9, 5, 29, 0, '2022-01-12 02:46:48'),
(10, 6, 4, 0, '2022-01-12 02:46:54'),
(11, 6, 25, 0, '2022-01-12 02:46:54'),
(12, 7, 29, 0, '2022-01-12 06:20:20'),
(13, 8, 4, 0, '2022-01-12 06:20:25'),
(14, 8, 25, 0, '2022-01-12 06:20:25'),
(15, 9, 24, 0, '2022-01-12 06:39:23'),
(16, 10, 4, 0, '2022-01-12 06:39:28'),
(17, 10, 25, 0, '2022-01-12 06:39:28'),
(18, 11, 29, 0, '2022-01-12 06:40:21'),
(19, 12, 4, 0, '2022-01-12 06:40:26'),
(20, 12, 25, 0, '2022-01-12 06:40:26'),
(21, 13, 29, 0, '2022-01-12 06:49:53'),
(22, 14, 4, 0, '2022-01-12 06:49:58'),
(23, 14, 25, 0, '2022-01-12 06:49:58'),
(24, 15, 29, 0, '2022-01-12 06:51:09'),
(25, 16, 4, 0, '2022-01-12 06:51:09'),
(26, 16, 25, 0, '2022-01-12 06:51:09'),
(27, 17, 29, 0, '2022-01-12 07:06:12'),
(28, 18, 4, 0, '2022-01-12 07:06:16'),
(29, 18, 25, 0, '2022-01-12 07:06:16'),
(30, 19, 29, 0, '2022-01-12 07:35:44'),
(31, 20, 4, 0, '2022-01-12 07:35:48'),
(32, 20, 25, 0, '2022-01-12 07:35:48'),
(33, 21, 29, 0, '2022-01-12 07:38:39'),
(34, 22, 4, 0, '2022-01-12 07:38:44'),
(35, 22, 25, 0, '2022-01-12 07:38:44'),
(36, 23, 29, 0, '2022-01-12 07:39:40'),
(37, 24, 4, 0, '2022-01-12 07:39:40'),
(38, 24, 25, 0, '2022-01-12 07:39:40'),
(39, 25, 29, 0, '2022-01-12 07:39:56'),
(40, 26, 4, 0, '2022-01-12 07:40:01'),
(41, 26, 25, 0, '2022-01-12 07:40:01'),
(42, 27, 4, 0, '2022-01-12 07:44:32'),
(43, 27, 25, 0, '2022-01-12 07:44:32'),
(44, 27, 32, 0, '2022-01-12 07:44:32'),
(45, 28, 29, 0, '2022-01-12 07:46:07'),
(46, 29, 4, 0, '2022-01-12 07:46:12'),
(47, 29, 25, 0, '2022-01-12 07:46:12'),
(48, 29, 32, 0, '2022-01-12 07:46:12'),
(49, 30, 29, 0, '2022-01-12 07:47:29'),
(50, 31, 4, 0, '2022-01-12 07:47:29'),
(51, 31, 25, 0, '2022-01-12 07:47:29'),
(52, 31, 32, 0, '2022-01-12 07:47:29'),
(53, 32, 4, 0, '2022-01-12 07:47:52'),
(54, 32, 25, 0, '2022-01-12 07:47:52'),
(55, 32, 32, 0, '2022-01-12 07:47:52'),
(56, 33, 26, 0, '2022-01-12 10:27:04'),
(57, 34, 4, 0, '2022-01-12 10:27:10'),
(58, 34, 25, 0, '2022-01-12 10:27:10'),
(59, 34, 32, 0, '2022-01-12 10:27:10'),
(60, 35, 4, 0, '2022-01-12 10:34:04'),
(61, 35, 25, 0, '2022-01-12 10:34:04'),
(62, 35, 32, 0, '2022-01-12 10:34:04'),
(63, 36, 29, 0, '2022-01-12 16:59:25'),
(64, 37, 4, 0, '2022-01-12 16:59:29'),
(65, 37, 25, 0, '2022-01-12 16:59:29'),
(66, 37, 32, 0, '2022-01-12 16:59:29'),
(67, 38, 29, 0, '2022-01-12 17:01:37'),
(68, 39, 4, 0, '2022-01-12 17:01:37'),
(69, 39, 25, 0, '2022-01-12 17:01:37'),
(70, 39, 32, 0, '2022-01-12 17:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user_code` varchar(25) NOT NULL,
  `user_type` enum('admin','patient','doctor') DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(150) NOT NULL,
  `profile` text DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_verified` tinyint(1) DEFAULT 0,
  `address_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_code`, `user_type`, `first_name`, `middle_name`, `last_name`, `birthdate`, `gender`, `address`, `phone_number`, `email`, `username`, `password`, `profile`, `created_by`, `created_at`, `updated_at`, `is_verified`, `address_id`) VALUES
(4, 'ADMN589C3', 'admin', 'admin', 'admin', 'admin', '2021-12-07', 'Male', 'sample address', '154568897879', 'admin@gmail.com', 'admin', 'admin', NULL, NULL, '2021-12-02 08:58:11', '2021-12-24 08:53:38', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_specializations`
--
ALTER TABLE `doctors_specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_setting`
--
ALTER TABLE `schedule_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bundles`
--
ALTER TABLE `service_bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bundle_items`
--
ALTER TABLE `service_bundle_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_cart`
--
ALTER TABLE `service_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_notifications`
--
ALTER TABLE `system_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_notification_recipients`
--
ALTER TABLE `system_notification_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_code` (`user_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctors_specializations`
--
ALTER TABLE `doctors_specializations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule_setting`
--
ALTER TABLE `schedule_setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `service_bundles`
--
ALTER TABLE `service_bundles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service_bundle_items`
--
ALTER TABLE `service_bundle_items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `service_cart`
--
ALTER TABLE `service_cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_notifications`
--
ALTER TABLE `system_notifications`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `system_notification_recipients`
--
ALTER TABLE `system_notification_recipients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
