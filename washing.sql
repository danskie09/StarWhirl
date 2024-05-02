-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 04:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `washing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'Test', 'Admin', 'admin123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `contact_number`, `email`, `password`) VALUES
(10, 'James', 'Doe', '09453673833', 'James@Doe', 'jj'),
(12, 'Nier', 'Abringe', '09751212247', 'n@n', 'rr'),
(17, 'Daniel', 'Banaybanay', '09453673833', 'banaybanaydaniel09@gmail.com', 'tryy'),
(35, 'James', 'Arthur', NULL, NULL, NULL),
(36, 'Santa', 'Claus', NULL, NULL, NULL),
(37, 'Jung', 'kook', NULL, NULL, NULL),
(38, 'Go', 'Gi', NULL, NULL, NULL),
(39, 'Taylor', 'Swift', '09453673833', 'taylor@s', 'ty'),
(40, 'Van Kirk', 'lumantas', NULL, NULL, NULL),
(41, 'kokey', 'kikay', NULL, NULL, NULL),
(42, 'kyrie', 'irving', NULL, NULL, NULL),
(43, 'beeen', 'soooo', NULL, NULL, NULL),
(44, 'jose', 'chasn', NULL, NULL, NULL),
(45, 'nier', 'nier', NULL, NULL, NULL),
(46, 'jan', 'jan', NULL, NULL, NULL),
(47, 'jen', 'jen', NULL, NULL, NULL),
(48, 'Lisa', 'Monaaaa', NULL, NULL, NULL),
(49, 'levi', 'ackerman', NULL, NULL, NULL),
(50, 'chema kirada', 'ssss', NULL, NULL, NULL),
(51, 'd', 'das', NULL, NULL, NULL),
(52, 'qsa', 'rrr', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detergents`
--

CREATE TABLE `detergents` (
  `detergent_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `detergent_name` varchar(255) NOT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detergents`
--

INSERT INTO `detergents` (`detergent_id`, `owner_id`, `detergent_name`, `stock_quantity`) VALUES
(18, 1, 'customerOwned', 0),
(19, 1, 'breeze', 664),
(20, 1, 'ariel', 300),
(21, 1, 'champion', 300);

-- --------------------------------------------------------

--
-- Table structure for table `fabric_softeners`
--

CREATE TABLE `fabric_softeners` (
  `fabric_softener_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `fabric_softener_name` varchar(255) NOT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fabric_softeners`
--

INSERT INTO `fabric_softeners` (`fabric_softener_id`, `owner_id`, `fabric_softener_name`, `stock_quantity`) VALUES
(7, 1, 'customerOwned', 0),
(8, 1, 'del', 176),
(9, 1, 'downy', 689);

-- --------------------------------------------------------

--
-- Table structure for table `lpg_inventory`
--

CREATE TABLE `lpg_inventory` (
  `lpg_id` int(11) NOT NULL,
  `lpg_name` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lpg_inventory`
--

INSERT INTO `lpg_inventory` (`lpg_id`, `lpg_name`, `status`, `owner_id`) VALUES
(1, 'LPG 1', 'Replace', 1),
(2, 'LPG 2', 'In use', 1);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_schedule`
--

CREATE TABLE `maintenance_schedule` (
  `schedule_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `maintenance_date` date DEFAULT NULL,
  `end_maintenance_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_schedule`
--

INSERT INTO `maintenance_schedule` (`schedule_id`, `owner_id`, `maintenance_date`, `end_maintenance_date`) VALUES
(7, 1, '2023-12-23', '0000-00-00'),
(8, 1, '2023-12-23', '0000-00-00'),
(9, 1, '2023-12-23', '0000-00-00'),
(10, 1, '2023-12-26', '0000-00-00'),
(11, 1, '2023-12-26', '0000-00-00'),
(12, 1, '2023-12-28', '0000-00-00'),
(13, 1, '2023-12-28', '0000-00-00'),
(14, 1, '2023-12-28', '0000-00-00'),
(15, 1, '2023-12-28', '0000-00-00'),
(16, 1, '2023-12-27', '0000-00-00'),
(17, 1, '2023-12-31', '2024-01-19'),
(18, 1, '2023-12-23', '0000-00-00'),
(19, 1, '2023-12-31', '2024-01-19'),
(20, 1, '2023-12-25', '0000-00-00'),
(21, 1, '2023-12-31', '0000-00-00'),
(27, 1, NULL, '0000-00-00'),
(28, 1, NULL, '2024-01-29'),
(29, 1, '2024-02-06', '0000-00-00'),
(30, 1, NULL, '2024-07-19'),
(31, 1, '2024-01-19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `customer_id`, `transaction_id`, `message`, `status`, `created_at`) VALUES
(151, 12, NULL, 'Schedule Maintenance on Sunday <strong>2023-12-31</strong>,', 'unread', '2023-12-24 00:15:03'),
(154, 12, NULL, 'Schedule Maintenance on Saturday <strong>2023-12-23</strong>,announced on:', 'unread', '2023-12-24 00:16:19'),
(160, 12, NULL, 'Schedule Maintenance on Sunday <strong>2023-12-31</strong>,announced on:', 'unread', '2023-12-24 04:43:15'),
(170, 12, NULL, 'Schedule Maintenance on Monday <strong>2023-12-25</strong>,announced on:', 'unread', '2023-12-25 19:17:50'),
(187, 36, 247, 'Your laundry is finished with tracking number: 8OUDUFWP', 'Unread', '2023-12-27 01:18:33'),
(189, 17, 256, 'Your laundry is finished with tracking number: 4T8G4BTX', 'Unread', '2023-12-28 04:27:35'),
(191, 12, NULL, 'Schedule Maintenance on Sunday <strong>2023-12-31</strong>,announced on:', 'unread', '2023-12-28 04:28:01'),
(192, 17, NULL, 'Schedule Maintenance on Sunday <strong>2023-12-31</strong>,announced on:', 'unread', '2023-12-28 04:28:01'),
(193, 35, NULL, 'Schedule Maintenance on Sunday <strong>2023-12-31</strong>,announced on:', 'unread', '2023-12-28 04:28:01'),
(194, 36, NULL, 'Schedule Maintenance on Sunday <strong>2023-12-31</strong>,announced on:', 'unread', '2023-12-28 04:28:01'),
(195, 37, NULL, 'Schedule Maintenance on Sunday <strong>2023-12-31</strong>,announced on:', 'unread', '2023-12-28 04:28:01'),
(196, 38, NULL, 'Schedule Maintenance on Sunday <strong>2023-12-31</strong>,announced on:', 'unread', '2023-12-28 04:28:01'),
(197, 39, 257, 'Your laundry is finished with tracking number: EHM0AOSQ', 'Unread', '2023-12-28 04:33:55'),
(198, 35, 246, 'Your laundry is finished with tracking number: HJ7A7PFG', 'Unread', '2024-01-06 21:22:35'),
(199, 40, 258, 'Your laundry is finished with tracking number: N7Z5X3S0', 'Unread', '2024-01-06 21:50:49'),
(201, 12, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-24</strong>,announced on:', 'unread', '2024-01-07 03:07:53'),
(202, 17, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-24</strong>,announced on:', 'unread', '2024-01-07 03:07:53'),
(203, 35, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-24</strong>,announced on:', 'unread', '2024-01-07 03:07:53'),
(204, 36, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-24</strong>,announced on:', 'unread', '2024-01-07 03:07:53'),
(205, 37, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-24</strong>,announced on:', 'unread', '2024-01-07 03:07:53'),
(206, 38, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-24</strong>,announced on:', 'unread', '2024-01-07 03:07:53'),
(207, 39, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-24</strong>,announced on:', 'unread', '2024-01-07 03:07:53'),
(208, 40, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-24</strong>,announced on:', 'unread', '2024-01-07 03:07:53'),
(221, 12, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(222, 17, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(223, 35, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(224, 36, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(225, 37, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(226, 38, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(227, 39, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(228, 40, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(229, 41, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(230, 42, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(231, 43, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(232, 44, NULL, 'Schedule Maintenance on Monday <strong>2024-01-22</strong>,announced on:', 'unread', '2024-01-18 09:21:54'),
(234, 12, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(235, 17, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(236, 35, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(237, 36, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(238, 37, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(239, 38, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(240, 39, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(241, 40, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(242, 41, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(243, 42, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(244, 43, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(245, 44, NULL, 'Schedule Maintenance on Saturday <strong>2024-01-27</strong>,announced on:', 'unread', '2024-01-19 07:09:02'),
(249, 12, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(250, 17, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(251, 35, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(252, 36, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(253, 37, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(254, 38, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(255, 39, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(256, 40, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(257, 41, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(258, 42, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(259, 43, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(260, 44, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:13'),
(264, 12, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(265, 17, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(266, 35, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(267, 36, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(268, 37, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(269, 38, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(270, 39, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(271, 40, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(272, 41, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(273, 42, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(274, 43, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(275, 44, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:22:41'),
(279, 12, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(280, 17, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(281, 35, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(282, 36, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(283, 37, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(284, 38, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(285, 39, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(286, 40, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(287, 41, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(288, 42, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(289, 43, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(290, 44, NULL, 'Maintenance ended on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:23:59'),
(294, 12, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(295, 17, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(296, 35, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(297, 36, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(298, 37, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(299, 38, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(300, 39, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(301, 40, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(302, 41, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(303, 42, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(304, 43, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(305, 44, NULL, 'Maintenance ended on<strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-19 07:26:04'),
(309, 12, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(310, 17, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(311, 35, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(312, 36, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(313, 37, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(314, 38, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(315, 39, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(316, 40, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(317, 41, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(318, 42, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(319, 43, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(320, 44, NULL, 'Schedule Maintenance on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:26:24'),
(324, 12, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(325, 17, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(326, 35, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(327, 36, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(328, 37, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(329, 38, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(330, 39, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(331, 40, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(332, 41, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(333, 42, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(334, 43, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(335, 44, NULL, 'Schedule Maintenance on Wednesday <strong>2024-01-31</strong>, announced on:', 'unread', '2024-01-19 07:26:48'),
(339, 12, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(340, 17, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(341, 35, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(342, 36, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(343, 37, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(344, 38, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(345, 39, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(346, 40, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(347, 41, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(348, 42, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(349, 43, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(350, 44, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:28:19'),
(354, 12, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(355, 17, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(356, 35, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(357, 36, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(358, 37, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(359, 38, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(360, 39, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(361, 40, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(362, 41, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(363, 42, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(364, 43, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(365, 44, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:38'),
(369, 12, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(370, 17, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(371, 35, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(372, 36, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(373, 37, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(374, 38, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(375, 39, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(376, 40, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(377, 41, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(378, 42, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(379, 43, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(380, 44, NULL, 'Maintenance ended on<strong>End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:32:47'),
(384, 12, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(385, 17, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(386, 35, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(387, 36, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(388, 37, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(389, 38, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(390, 39, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(391, 40, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(392, 41, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(393, 42, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(394, 43, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(395, 44, NULL, ' Maintenance  Ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:36:51'),
(399, 12, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(400, 17, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(401, 35, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(402, 36, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(403, 37, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(404, 38, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(405, 39, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(406, 40, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(407, 41, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(408, 42, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(409, 43, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(410, 44, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:24'),
(414, 12, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(415, 17, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(416, 35, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(417, 36, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(418, 37, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(419, 38, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(420, 39, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(421, 40, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(422, 41, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(423, 42, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(424, 43, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(425, 44, NULL, ' Maintenance  Ended on Thursday <strong> End Maintenance</strong>, announced on:', 'unread', '2024-01-19 07:37:50'),
(429, 12, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(430, 17, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(431, 35, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(432, 36, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(433, 37, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(434, 38, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(435, 39, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(436, 40, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(437, 41, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(438, 42, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(439, 43, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(440, 44, NULL, 'Maintenance ended on Thursday <strong></strong>, announced on:', 'unread', '2024-01-19 07:42:28'),
(444, 12, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(445, 17, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(446, 35, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(447, 36, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(448, 37, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(449, 38, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(450, 39, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(451, 40, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(452, 41, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(453, 42, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(454, 43, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(455, 44, NULL, 'Maintenance ended on Monday <strong>2024-01-29</strong>, announced on:', 'unread', '2024-01-19 07:43:25'),
(459, 12, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(460, 17, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(461, 35, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(462, 36, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(463, 37, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(464, 38, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(465, 39, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(466, 40, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(467, 41, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(468, 42, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(469, 43, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(470, 44, NULL, 'Schedule Maintenance on Tuesday <strong>2024-02-06</strong>, announced on:', 'unread', '2024-01-19 07:43:45'),
(474, 12, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(475, 17, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(476, 35, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(477, 36, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(478, 37, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(479, 38, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(480, 39, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(481, 40, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(482, 41, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(483, 42, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(484, 43, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(485, 44, NULL, 'Maintenance ended on Friday <strong>2024-07-19</strong>, announced on:', 'unread', '2024-01-19 07:47:23'),
(492, 12, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(493, 17, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(494, 35, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(495, 36, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(496, 37, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(497, 38, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(498, 39, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(499, 40, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(500, 41, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(501, 42, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(502, 43, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(503, 44, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(504, 45, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(505, 46, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(506, 47, NULL, 'Schedule Maintenance on Friday <strong>2024-01-19</strong>, announced on:', 'unread', '2024-01-20 03:39:20'),
(507, 10, 263, 'Your laundry is finished with tracking number: 440P20EH', 'Unread', '2024-01-22 20:31:07'),
(508, 12, 278, 'Your laundry is finished with tracking number: 9YB99YBV', 'Unread', '2024-01-23 23:11:49'),
(509, 10, 285, 'Your laundry is finished with tracking number: LU4T81BB', 'Unread', '2024-01-23 23:14:17'),
(510, 12, 278, 'Your laundry is finished with tracking number: 9YB99YBV', 'Unread', '2024-01-23 23:15:20'),
(511, 12, 278, 'Your laundry is finished with tracking number: 9YB99YBV', 'Unread', '2024-01-23 23:15:35'),
(512, 12, 278, 'Your laundry is finished with tracking number: 9YB99YBV', 'Unread', '2024-01-23 23:16:08'),
(513, 10, 285, 'Your laundry is finished with tracking number: LU4T81BB', 'Unread', '2024-01-23 23:16:41'),
(514, 12, 279, 'Your laundry is finished with tracking number: 1NGV5QGA', 'Unread', '2024-01-23 23:19:12'),
(515, 12, 279, 'Your laundry is finished with tracking number: 1NGV5QGA', 'Unread', '2024-01-23 23:19:27'),
(516, 12, 279, 'Your laundry is finished with tracking number: 1NGV5QGA', 'Unread', '2024-01-23 23:20:21'),
(517, 12, 279, 'Your laundry is finished with tracking number: 1NGV5QGA', 'Unread', '2024-01-23 23:21:34'),
(518, 49, 289, 'Your laundry is finished with tracking number: 27KZJPAZ', 'Unread', '2024-01-24 02:56:31'),
(519, 10, 264, 'Your laundry is finished with tracking number: 3EZJK6F7', 'Unread', '2024-01-24 04:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'Jeanica', 'Belnas', 'jeanica123', 'starwhirl');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `transaction_id`) VALUES
(82, 242),
(83, 243),
(85, 245),
(86, 246),
(87, 247),
(88, 248),
(89, 249),
(90, 250),
(91, 251),
(92, 252),
(93, 253),
(94, 254),
(95, 255),
(96, 256),
(97, 257),
(98, 258),
(99, 259),
(100, 260),
(101, 261),
(102, 262),
(103, 263),
(104, 264),
(105, 265),
(106, 266),
(107, 267),
(108, 268),
(109, 269),
(110, 270),
(111, 271),
(112, 272),
(113, 273),
(114, 274),
(115, 275),
(116, 276),
(117, 277),
(118, 278),
(119, 279),
(120, 280),
(121, 281),
(122, 282),
(123, 283),
(124, 284),
(125, 285),
(126, 286),
(127, 287),
(128, 288),
(129, 289),
(130, 290),
(131, 291),
(132, 292),
(133, 293),
(134, 294),
(135, 294),
(136, 295),
(137, 296),
(138, 297),
(139, 298);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(50) NOT NULL,
  `serviceName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `serviceName`) VALUES
(1, 'Wash'),
(2, 'Wash and Dry'),
(3, 'Drop-Off');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `firstname`, `lastname`, `contact_number`, `address`, `username`, `password`) VALUES
(6, 'Van Kirk', 'Alavaren', '09453673833', 'cangmating', 'van123', 'qq'),
(10, 'Jeanica', 'Belnas', '09786435343', 'bantayan', 'jeanica123', 'jeanica'),
(11, 'admin', 'van', '0978545454554', 'sibulan', 'admin123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `trackings`
--

CREATE TABLE `trackings` (
  `trackingID` int(11) NOT NULL,
  `trackingNumber` varchar(50) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trackings`
--

INSERT INTO `trackings` (`trackingID`, `trackingNumber`, `transaction_id`, `status`) VALUES
(212, '4A09XN3I', 242, 'Finished'),
(213, 'YC9UQF51', 243, 'Finished'),
(215, 'TDS7JK20', 245, 'Finished'),
(216, 'HJ7A7PFG', 246, 'Finished'),
(217, '8OUDUFWP', 247, 'Finished'),
(218, 'SK7DITNM', 248, 'Finished'),
(219, '8EWYC7M7', 249, 'In Progress'),
(220, 'TNMET4YN', 250, 'In Progress'),
(221, 'JZ7OYXX2', 251, 'In Progress'),
(222, 'ZNFBMODC', 252, 'Finished'),
(223, 'S83YC72V', 253, 'In Progress'),
(224, 'EAVQBYVU', 254, 'In Progress'),
(225, '4CPIVVAV', 255, 'In Progress'),
(226, '4T8G4BTX', 256, 'Finished'),
(227, 'EHM0AOSQ', 257, 'Finished'),
(228, 'N7Z5X3S0', 258, 'Finished'),
(229, 'RAVYTCNB', 259, 'In Progress'),
(230, 'KBW8JCUK', 260, 'Finished'),
(231, '22HNX7JN', 261, 'Finished'),
(232, 'TPZCTLH7', 262, 'In Progress'),
(233, '440P20EH', 263, 'Finished'),
(234, '3EZJK6F7', 264, 'Finished'),
(235, 'EWPBRQLC', 265, 'In Progress'),
(236, '0V5ZV6CT', 266, 'In Progress'),
(237, '42HJ582U', 267, 'In Progress'),
(238, 'W3EBV6ZU', 268, 'Finished'),
(239, 'MMKN0KWR', 269, 'In Progress'),
(240, 'AVOURI8I', 270, 'In Progress'),
(241, 'D8KXJM1N', 271, 'In Progress'),
(242, 'M1VEQK05', 272, 'In Progress'),
(243, 'MXOBDIPN', 273, 'In Progress'),
(244, 'RENC8GM4', 274, 'Finished'),
(245, 'CSS75GGH', 275, 'In Progress'),
(246, 'ZA8OPGWY', 276, 'In Progress'),
(247, '7EQIZ3EO', 277, 'In Progress'),
(248, '9YB99YBV', 278, 'Finished'),
(249, '1NGV5QGA', 279, 'Finished'),
(250, 'LBLGPHBJ', 280, 'Finished'),
(251, '1VIS0CE5', 281, 'In Progress'),
(252, 'P0F64RDH', 282, 'In Progress'),
(253, '8A4LU4QA', 283, 'Finished'),
(254, 'CRMTX7TG', 284, 'In Progress'),
(255, 'LU4T81BB', 285, 'Finished'),
(256, 'YVC3ACMM', 286, 'In Progress'),
(257, '25I044Z6', 287, 'In Progress'),
(258, 'LVHR9N51', 288, 'In Progress'),
(259, '27KZJPAZ', 289, 'Finished'),
(260, 'WUFG23M0', 290, 'In Progress'),
(261, '1JMGTKWZ', 291, 'In Progress'),
(262, '1Q6D1PBY', 292, 'In Progress'),
(263, 'BQ4O7L0Y', 293, 'In Progress'),
(264, '1GH80WUC', 294, 'In Progress'),
(265, 'L3S5YLNB', 295, 'In Progress'),
(266, 'PU6ZNU42', 296, 'In Progress'),
(267, '8FOJXQDV', 297, 'In Progress'),
(268, 'RHKGNOBI', 298, 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `timeOfDropOff` datetime DEFAULT NULL,
  `service_id` int(50) NOT NULL,
  `numberOfLoads` int(11) DEFAULT NULL,
  `numberOfClothing` int(11) DEFAULT NULL,
  `totalCost` decimal(10,2) DEFAULT NULL,
  `paymentStatus` varchar(50) NOT NULL,
  `tenderedAmount` decimal(10,2) NOT NULL,
  `changeAmount` decimal(10,2) NOT NULL,
  `detergent_id` int(11) NOT NULL,
  `numberOfDetergent` int(11) NOT NULL,
  `fabric_softener_id` int(11) NOT NULL,
  `numberOfFabricSoft` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `customer_id`, `staff_id`, `timeOfDropOff`, `service_id`, `numberOfLoads`, `numberOfClothing`, `totalCost`, `paymentStatus`, `tenderedAmount`, `changeAmount`, `detergent_id`, `numberOfDetergent`, `fabric_softener_id`, `numberOfFabricSoft`) VALUES
(242, 17, 10, '2023-12-25 11:00:00', 1, 2, 4, 225.00, 'Paid', 500.00, 275.00, 20, 3, 8, 3),
(243, 17, 10, '2023-12-25 11:07:00', 1, 3, 12, 230.00, 'Paid', 500.00, 270.00, 18, 0, 8, 5),
(245, 10, 6, '2023-12-28 11:16:00', 2, 3, 13, 1390.00, 'Paid', 2000.00, 610.00, 18, 0, 8, 100),
(246, 35, 10, '2023-12-25 11:28:00', 2, 2, 15, 300.00, 'Paid', 500.00, 200.00, 18, 0, 8, 4),
(247, 36, 10, '2023-12-28 11:29:00', 3, 2, 12, 320.00, 'Paid', 380.00, 60.00, 18, 0, 7, 0),
(248, 17, 6, '2023-12-25 11:36:00', 1, 3, 6, 180.00, 'Paid', 190.00, 10.00, 18, 0, 7, 0),
(249, 17, 10, '2023-12-25 11:50:00', 3, 2, 11, 320.00, 'Paid', 350.00, 30.00, 18, 0, 7, 0),
(250, 35, 10, '2023-12-25 11:52:00', 1, 4, 4, 240.00, 'Paid', 500.00, 260.00, 18, 0, 7, 0),
(251, 17, 6, '2023-12-25 11:56:00', 1, 2, 6, 120.00, 'Paid', 600.00, 480.00, 18, 0, 7, 0),
(252, 17, 10, '2023-12-26 17:12:00', 2, 1, 2, 160.00, 'Paid', 200.00, 40.00, 18, 0, 8, 3),
(253, 37, 10, '2023-12-26 17:13:00', 2, 2, 4, 400.00, 'Paid', 1000.00, 600.00, 19, 4, 8, 4),
(254, 17, 6, '2023-12-26 17:21:00', 1, 2, 6, 120.00, 'Paid', 200.00, 80.00, 18, 0, 7, 0),
(255, 38, 6, '2023-12-26 17:21:00', 1, 2, 11, 225.00, 'Paid', 300.00, 75.00, 19, 3, 8, 3),
(256, 17, 10, '2023-12-27 20:25:00', 1, 3, 7, 200.00, 'Paid', 300.00, 100.00, 18, 0, 8, 2),
(257, 39, 10, '2023-12-27 20:32:00', 3, 3, 5, 530.00, 'Paid', 600.00, 70.00, 19, 2, 7, 0),
(258, 40, 6, '2023-12-28 19:03:00', 2, 2, 4, 330.00, 'Paid', 400.00, 70.00, 19, 2, 8, 2),
(259, 17, 6, '2023-12-28 19:05:00', 3, 3, 4, 510.00, 'Paid', 600.00, 90.00, 18, 0, 8, 3),
(260, 10, 6, '2024-01-06 13:32:00', 2, 2, 24, 300.00, 'Paid', 350.00, 50.00, 18, 0, 8, 4),
(261, 10, 10, '2024-01-06 14:00:00', 2, 3, 5, 465.00, 'Paid', 500.00, 35.00, 19, 3, 7, 0),
(262, 17, 6, '2024-01-06 16:23:00', 2, 3, 3, 410.00, 'Paid', 500.00, 90.00, 18, 0, 8, 2),
(263, 10, 10, '2024-01-06 19:08:00', 2, 2, 5, 280.00, 'Paid', 3000.00, 2720.00, 18, 0, 8, 2),
(264, 10, 10, '2024-01-06 19:09:00', 1, 2, 3, 150.00, 'Paid', 250.00, 100.00, 18, 0, 9, 2),
(265, 17, 10, '2024-01-06 19:11:00', 2, 2, 4, 280.00, 'Paid', 300.00, 20.00, 18, 0, 8, 2),
(266, 41, 10, '2024-01-06 19:12:00', 1, 2, 10, 140.00, 'Paid', 200.00, 60.00, 18, 0, 8, 2),
(267, 42, 10, '2024-01-06 19:12:00', 2, 2, 10, 280.00, 'Paid', 300.00, 20.00, 18, 0, 8, 2),
(268, 10, 10, '2024-01-06 19:17:00', 3, 4, 6, 640.00, 'Paid', 700.00, 60.00, 18, 0, 7, 0),
(269, 10, 6, '2024-01-06 19:28:00', 1, 3, 10, 180.00, 'Paid', 1000.00, 820.00, 18, 0, 7, 0),
(270, 43, 6, '2024-01-06 19:29:00', 3, 3, 5, 480.00, 'Paid', 600.00, 120.00, 18, 0, 7, 0),
(271, 12, 6, '2024-01-18 16:47:00', 1, 2, 10, 120.00, 'Paid', 200.00, 80.00, 18, 0, 7, 0),
(272, 12, 6, '2024-01-18 16:51:00', 1, 1, 10, 95.00, 'Paid', 100.00, 5.00, 19, 1, 8, 1),
(273, 17, 11, '2024-01-18 17:02:00', 1, 10, 9, 755.00, 'Paid', 0.00, -755.00, 19, 5, 8, 3),
(274, 10, 6, '2024-01-18 17:13:00', 2, 2, 13, 340.00, 'Paid', 500.00, 160.00, 19, 2, 9, 2),
(275, 44, 6, '2024-01-18 17:15:00', 1, 3, 8, 180.00, 'Paid', 200.00, 20.00, 18, 0, 7, 0),
(276, 45, 6, '2024-01-19 16:00:00', 2, 1, 9, 130.00, 'Paid', 200.00, 70.00, 18, 0, 7, 0),
(277, 35, 6, '2024-01-19 05:00:00', 1, 2, 10, 120.00, 'Paid', 500.00, 380.00, 18, 0, 7, 0),
(278, 12, 6, '2024-01-25 20:00:00', 1, 1, 1, 60.00, 'Paid', 0.00, -60.00, 18, 0, 7, 0),
(279, 12, 10, '2024-01-25 02:00:00', 1, 1, 1, 95.00, 'Paid', 0.00, -95.00, 19, 1, 8, 1),
(280, 10, 10, '2024-01-19 05:00:00', 1, 1, 1, 60.00, 'Paid', 100.00, 40.00, 18, 0, 7, 0),
(281, 46, 6, '2024-01-19 16:00:00', 2, 1, 1, 130.00, 'Paid', 200.00, 70.00, 18, 0, 7, 0),
(282, 47, 6, '2024-01-19 16:00:00', 1, 1, 1, 60.00, 'Paid', 100.00, 40.00, 18, 0, 7, 0),
(283, 10, 6, '2024-01-19 17:00:00', 1, 1, 1, 60.00, 'Paid', 100.00, 40.00, 18, 0, 7, 0),
(284, 17, 10, '2024-01-20 19:48:00', 1, 2, 3, 190.00, 'Unpaid', 0.00, -190.00, 19, 2, 8, 2),
(285, 10, 10, '2024-01-23 14:53:00', 1, 2, 3, 170.00, 'Paid', 300.00, 130.00, 19, 2, 7, 0),
(286, 48, 10, '2024-01-23 14:54:00', 2, 3, 3, 410.00, 'Paid', 400.00, -10.00, 18, 0, 8, 2),
(287, 17, 11, '2024-01-25 07:07:00', 3, 2, 8, 340.00, 'Paid', 500.00, 160.00, 18, 0, 8, 2),
(288, 12, 6, '2024-01-23 07:00:00', 1, 1, 17, 160.00, 'Paid', 200.00, 40.00, 20, 4, 7, 0),
(289, 49, 6, '2024-01-23 06:32:00', 3, 2, 3, 320.00, 'Paid', 400.00, 80.00, 18, 0, 7, 0),
(290, 17, 10, '2024-01-23 07:45:00', 1, 2, 6, 120.00, 'Paid', 600.00, 480.00, 18, 0, 7, 0),
(291, 12, 10, '2024-01-23 16:56:00', 1, 22, 23, 1320.00, 'Unpaid', 0.00, -1320.00, 18, 0, 7, 0),
(292, 50, 10, '2024-01-23 04:44:00', 1, 2, 7, 140.00, 'Paid', 3000.00, 2860.00, 18, 0, 8, 2),
(293, 10, 6, '2024-01-23 05:04:00', 3, 2, 4, 320.00, 'Unpaid', 0.00, -320.00, 18, 0, 7, 0),
(294, 12, 6, '2024-01-23 05:06:00', 2, 2, 6, 280.00, 'Unpaid', 0.00, -280.00, 18, 0, 8, 2),
(295, 12, 10, '2024-01-23 05:06:00', 1, 1, 2, 60.00, 'Unpaid', 0.00, -60.00, 18, 0, 7, 0),
(296, 51, 10, '2024-01-23 04:02:00', 1, 2, 2, 200.00, 'Unpaid', 0.00, -200.00, 19, 2, 8, 3),
(297, 10, 11, '2024-01-23 05:02:00', 1, 2, 2, 120.00, 'Unpaid', 0.00, -120.00, 18, 0, 7, 0),
(298, 52, 11, '2024-01-23 23:03:00', 1, 2, 3, 120.00, 'Paid', 200.00, 80.00, 18, 0, 7, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `detergents`
--
ALTER TABLE `detergents`
  ADD PRIMARY KEY (`detergent_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `fabric_softeners`
--
ALTER TABLE `fabric_softeners`
  ADD PRIMARY KEY (`fabric_softener_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `lpg_inventory`
--
ALTER TABLE `lpg_inventory`
  ADD PRIMARY KEY (`lpg_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `maintenance_schedule`
--
ALTER TABLE `maintenance_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `transactionID` (`transaction_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `trackings`
--
ALTER TABLE `trackings`
  ADD PRIMARY KEY (`trackingID`),
  ADD KEY `transactionID` (`transaction_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `customerID` (`customer_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `detergent_id` (`detergent_id`),
  ADD KEY `fabric_softener_id` (`fabric_softener_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `detergents`
--
ALTER TABLE `detergents`
  MODIFY `detergent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fabric_softeners`
--
ALTER TABLE `fabric_softeners`
  MODIFY `fabric_softener_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lpg_inventory`
--
ALTER TABLE `lpg_inventory`
  MODIFY `lpg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maintenance_schedule`
--
ALTER TABLE `maintenance_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=520;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trackings`
--
ALTER TABLE `trackings`
  MODIFY `trackingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detergents`
--
ALTER TABLE `detergents`
  ADD CONSTRAINT `detergents_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fabric_softeners`
--
ALTER TABLE `fabric_softeners`
  ADD CONSTRAINT `fabric_softeners_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lpg_inventory`
--
ALTER TABLE `lpg_inventory`
  ADD CONSTRAINT `lpg_inventory_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`);

--
-- Constraints for table `maintenance_schedule`
--
ALTER TABLE `maintenance_schedule`
  ADD CONSTRAINT `maintenance_schedule_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trackings`
--
ALTER TABLE `trackings`
  ADD CONSTRAINT `trackings_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`detergent_id`) REFERENCES `detergents` (`detergent_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_5` FOREIGN KEY (`fabric_softener_id`) REFERENCES `fabric_softeners` (`fabric_softener_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
