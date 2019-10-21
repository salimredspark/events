-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2019 at 02:53 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_banner` text NOT NULL,
  `event_domain_name` varchar(255) NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_manage_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_banner`, `event_domain_name`, `event_location`, `event_description`, `start_time`, `end_time`, `event_manage_by`, `updated_by`) VALUES
(1, 'Event 001', '', 'domain1', 'Millenium Resort, Fategunj, Vadodara, Gujarat', 'Network operators are the great enabler of the digital economy. Their contribution and statistics are astonishing;\r\n\r\nThe mobile industry eco-system has an economic impact of $3.9 trillion\r\nâ€¢   The industry connects Â½ the worldâ€™s population to the Internet\r\nâ€¢   5.1 billion people subscribe to a mobile service\r\n\r\nThe mobile industry has a tremendous impact and therefore responsibility toward individual, national and international security, privacy and society. \r\n \r\nThe opening keynote of MWC19 will see the worldâ€™s leading operators, including for the first time Vodafoneâ€™s new CEO Nick Read,  discuss how they continue to push the boundaries of technological innovation through 5G, AI, IoT, and Big Data. \r\nThey will also discuss the regulatory environment required to ensure operators are able to deploy these technologies, and the strategies, business models and internal systems needed to ensure they deliver on their promise. All within the context of their wider social and environmental responsibilities.								', '2019-10-19 04:30:00', '2019-10-19 08:30:00', 1, 1),
(2, 'Event 002', '', 'domain2', 'ccompanied by English versions from the 1914 translation by H. Rackham', 'Demonstration Event', '2019-10-18 16:30:00', '2019-10-18 18:25:00', 1, 1),
(3, 'Event 003', '', 'domain3', 'Lorem Ipsum is not simply random text. It has roots in a piece of classical', 'this is test', '2019-10-18 15:30:00', '2019-10-18 18:10:00', 2, 1),
(4, 'Event 004', '', 'domain4', 'ccompanied by English versions from the 1914 translation by H. Rackham', 'demo', '2019-10-21 03:35:00', '2019-10-22 08:20:00', 3, 1),
(5, 'Event 005', '', 'domain5', 'Millenium Resort, Fategunj, Vadodara, Gujarat', 'Merathon Run', '2019-10-15 09:42:00', '2019-10-10 04:30:00', 2, 1),
(6, 'Event 006', '', 'domain6', 'Millenium Resort, Fategunj, Vadodara, Gujarat', 'robo', '2019-10-18 07:30:00', '2019-10-18 16:30:00', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_location`
--

CREATE TABLE `event_location` (
  `id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_details` varchar(255) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_location`
--

INSERT INTO `event_location` (`id`, `location_name`, `location_details`, `updated_by`) VALUES
(1, 'Hall 1', 'Fategunj Vaodara', 1),
(2, 'Hall 2', 'Fategunj, Baroda', 1),
(3, 'Hall 3', 'SayajiGunj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_location_slots`
--

CREATE TABLE `event_location_slots` (
  `id` int(11) NOT NULL,
  `event_location_id` int(11) NOT NULL,
  `slot_type` varchar(255) NOT NULL COMMENT 'hotel room or hall',
  `slot_name` varchar(255) NOT NULL,
  `slot_detail` text NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_location_slots`
--

INSERT INTO `event_location_slots` (`id`, `event_location_id`, `slot_type`, `slot_name`, `slot_detail`, `updated_by`) VALUES
(1, 1, 'Hotel Room', 'Section B', 'Zinger Hotel Hall 1 Section B', 1),
(2, 1, 'Hotel Room', 'Room 13', 'Room 13', 1),
(3, 2, 'Hotel Room', 'Room 007', 'Room 007', 1),
(4, 3, 'Hall', 'Hall 1 - Slot 1', 'Hall 1 - Slot 1', 1),
(5, 3, 'Hall', 'Hall 1 - Slot 2', 'Hall 1 - Slot 2', 1),
(6, 3, 'Hall', 'Hall 1 - Slot 3', 'Hall 1 - Slot 3', 1),
(7, 3, 'Hall', 'Hall 1 - Slot 4', 'Hall 1 - Slot 4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_show`
--

CREATE TABLE `event_show` (
  `id` int(11) NOT NULL,
  `show_name` varchar(255) NOT NULL,
  `show_location_id` int(11) NOT NULL,
  `show_location_slot_id` int(11) NOT NULL,
  `show_description` text NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_id` int(11) NOT NULL,
  `event_speaker_id` int(11) DEFAULT NULL,
  `event_moderator_id` int(11) NOT NULL,
  `show_manage_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_show`
--

INSERT INTO `event_show` (`id`, `show_name`, `show_location_id`, `show_location_slot_id`, `show_description`, `start_time`, `end_time`, `event_id`, `event_speaker_id`, `event_moderator_id`, `show_manage_by`, `updated_by`) VALUES
(1, 'Keynote 1: Intelligently Connecting the World', 1, 1, 'Network operators are the great enabler of the digital economy. Their contribution and statistics are astonishing;\r\n\r\n•   The mobile industry eco-system has an economic impact of $3.9 trillion\r\n•   The industry connects ½ the world’s population to the Internet\r\n•   5.1 billion people subscribe to a mobile service\r\n\r\nThe mobile industry has a tremendous impact and therefore responsibility toward individual, national and international security, privacy and society. \r\n \r\nThe opening keynote of MWC19 will see the world’s leading operators, including for the first time Vodafone’s new CEO Nick Read,  discuss how they continue to push the boundaries of technological innovation through 5G, AI, IoT, and Big Data. \r\nThey will also discuss the regulatory environment required to ensure operators are able to deploy these technologies, and the strategies, business models and internal systems needed to ensure they deliver on their promise. All within the context of their wider social and environmental responsibilities.								', '2019-10-12 03:30:00', '2019-10-12 04:30:00', 1, 1, 1, 1, 1),
(2, 'Show 1', 3, 5, 'demo', '0000-00-00 00:00:00', '2019-10-09 23:30:00', 3, 3, 1, 2, 1),
(3, '5am Show', 2, 3, '5am Show', '2019-10-09 19:30:00', '2019-10-09 23:30:00', 5, 1, 1, 2, 1),
(4, '6am Show', 2, 3, '6am Show', '2019-10-10 04:30:00', '2019-10-10 06:30:00', 5, 2, 1, 3, 1),
(5, 'fdfsdf', 2, 3, 'iklkjlkjlkj', '0000-00-00 00:00:00', '2019-10-18 06:20:00', 1, NULL, 1, 3, 1),
(6, 'fdfsdf', 2, 3, 'iklkjlkjlkj', '0000-00-00 00:00:00', '2019-10-18 06:20:00', 1, NULL, 1, 3, 1),
(7, 'fdfsdf', 2, 3, 'iklkjlkjlkj', '0000-00-00 00:00:00', '2019-10-18 06:20:00', 1, NULL, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(250) NOT NULL,
  `color` varchar(50) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`id`, `type_name`, `color`, `updated_by`) VALUES
(1, 'Conference', '#3d85c6', 1),
(2, 'Partner Programmes', '#1c4587', 1),
(3, 'NEXTech Labs', '#7f6000', 1),
(8, 'Glomos', '#3d85c6', 1),
(9, 'Ministerial Programme', '#a64d79', 1),
(10, '4YFN', '#000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exhibitors`
--

CREATE TABLE `exhibitors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL COMMENT 'Male, Female, Other',
  `birthdate` date NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_site_url` varchar(255) NOT NULL,
  `company_address` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exhibitors`
--

INSERT INTO `exhibitors` (`id`, `user_id`, `gender`, `birthdate`, `company_name`, `company_site_url`, `company_address`, `updated_at`, `created_at`, `updated_by`) VALUES
(1, 2, 'Male', '1987-08-30', 'Redspark Technologies', 'http://www.redsparkinfo.coom', 'Fategunj, Vadodara ', '2019-10-14 12:34:51', '2019-10-11 10:53:25', 1),
(2, 3, 'Male', '1978-10-25', 'Spark', 'http://www.spark.coom', 'Alkapuri, Vadodara', '2019-10-14 12:34:56', '2019-10-11 10:53:32', 1),
(3, 4, 'Male', '1978-10-25', 'pk', 'www.pk.com', 'Surat, Gujarat', '2019-10-14 12:35:40', '2019-10-11 04:00:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_category`
--

CREATE TABLE `general_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_detail` text NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_category`
--

INSERT INTO `general_category` (`id`, `category_name`, `category_detail`, `updated_by`) VALUES
(1, 'Pic From', 'Airport, Railway Station, Bus Stand', 1),
(2, 'Hotel', 'All Hotels', 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_vendor`
--

CREATE TABLE `general_vendor` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_website` varchar(255) NOT NULL,
  `vendor_detail` text NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_vendor`
--

INSERT INTO `general_vendor` (`id`, `category_id`, `vendor_name`, `vendor_website`, `vendor_detail`, `updated_by`) VALUES
(1, 2, 'Millennium Restaurant', 'millres.com', 'Address: 1st floor, Above Chatkaaz vadapao, Abbas Tyabji Rd, opp. Methodist (RED )Church, Vadodara, Gujarat 390002\r\nHours: Open ? Closes 10:45PM\r\nPhone: 0265 278 8435', 1),
(2, 2, 'Rangoli Restaurant', '', 'Restaurant offering international and Indian buffets, banqueting and home deliveries.\r\nAddress: Abbas Tyabji Rd, opposite Methodist Church, Jayesh Colony, Fatehgunj, Vadodara, Gujarat 390002\r\nHours: Open ? Closes 11PM\r\n\r\nPhone: 090999 72140', 1),
(3, 1, 'Airport - Tejas Tour And Travels', '', 'Airport - Tejas Tour And Travels', 1);

-- --------------------------------------------------------

--
-- Table structure for table `is_event_exhibitors`
--

CREATE TABLE `is_event_exhibitors` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `exhibitor_id` int(11) NOT NULL,
  `exhibitor_join_status` varchar(20) NOT NULL COMMENT 'yes, no, maybe',
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_event_exhibitors`
--

INSERT INTO `is_event_exhibitors` (`id`, `event_id`, `exhibitor_id`, `exhibitor_join_status`, `comment`) VALUES
(3, 1, 4, 'yes', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `is_event_speaker`
--

CREATE TABLE `is_event_speaker` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `event_speaker_id` int(11) NOT NULL,
  `event_speaker_role_id` int(11) NOT NULL,
  `event_location_id` int(11) NOT NULL,
  `event_location_slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_event_speaker`
--

INSERT INTO `is_event_speaker` (`id`, `event_id`, `show_id`, `event_speaker_id`, `event_speaker_role_id`, `event_location_id`, `event_location_slot_id`) VALUES
(8, 5, 1, 4, 3, 2, 3),
(9, 6, 1, 4, 3, 2, 3),
(12, 1, 7, 1, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1569994453),
('m130524_201442_init', 1569994458),
('m190124_110200_add_verification_token_column_to_user_table', 1569994459);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES
(1, 'google_map_key', 'AIzaSyBmOgbX-bUYFlhagd9LXJbUd2KRXB6FTSg'),
(2, 'time_format', ' h:i A'),
(3, 'date_format', 'd M, Y'),
(4, 'main_domain', '*.localhost.com'),
(5, 'timezone', 'Asia/Kolkata');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` int(11) NOT NULL,
  `speaker_name` varchar(255) NOT NULL,
  `speaker_role_id` int(11) NOT NULL,
  `speaker_details` text NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`id`, `speaker_name`, `speaker_role_id`, `speaker_details`, `updated_by`) VALUES
(1, 'Salim Kureshi', 1, 'Team Leader at Redspark Technologies', 1),
(2, 'Prashant', 2, 'Sr. Team Leader at Redspark Technologies', 1),
(3, 'Nirav', 1, 'Sr. Team Leader at Redspark Technologies', 1),
(4, 'Deval Barot', 1, 'Sr. Web Developer at Redspark Technologies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `speaker_accommodation`
--

CREATE TABLE `speaker_accommodation` (
  `id` int(11) NOT NULL,
  `speaker_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `category_item` varchar(255) NOT NULL,
  `category_item_qty` varchar(255) NOT NULL,
  `manage_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `speaker_accommodation`
--

INSERT INTO `speaker_accommodation` (`id`, `speaker_id`, `event_id`, `category_id`, `vendor_id`, `category_item`, `category_item_qty`, `manage_by`, `updated_by`) VALUES
(1, 1, 1, 1, 1, 'Room', '1', 1, 1),
(2, 1, 1, 2, 1, 'resort item', '5', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `speaker_role`
--

CREATE TABLE `speaker_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `speaker_role`
--

INSERT INTO `speaker_role` (`id`, `role_name`, `updated_by`) VALUES
(1, 'Director General', 1),
(2, 'Chairman & CEO', 1),
(3, 'CEO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `login_type` enum('superadmin','admin','exhibitor','visitor') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `updated_by`, `login_type`) VALUES
(1, 'Salim', 'Kureshi', 'admin', 'uz-u_bv9UkyDKr6dCipX38e8aDCnvmKC', '$2y$10$AZlLCnSFE.qGomIt1PoR/urkl3bKRS2/txY.Eu7A3tCxe5gdu9StO', NULL, 'salim@redsparkinfo.co.in', 10, '2019-10-14 12:34:05', '2019-10-14 12:34:05', 'gxZfCFqetP4z8MaHo6uYGF3rKxabFsUN_1569999351', 1, 'superadmin'),
(2, 'Deval', 'Barot', 'deval', '', '$2y$10$UM3CkMj4vFd0FMPqHZFCnuoUYTlzEl29ZcmEd2qlQQj9bkodw3ho.', NULL, 'deval@redsaprkinfo.co.in', 10, '2019-10-15 05:57:25', '2019-10-15 05:57:25', NULL, 1, 'admin'),
(3, 'Nirav', 'Patel', 'nirav', '', 'nirav123', NULL, 'nirav@redsparkinfo.co.in', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 'admin'),
(4, 'Sandip', 'Solanki', 'sandip', '', '', NULL, 'sandip@redsparkinfo.co.in', 10, '2019-10-15 05:55:32', '2019-10-15 05:55:32', NULL, 4, 'exhibitor'),
(8, 'Salman', 'Khan', 'dasd', '', '$2y$10$ApRZzINT1XIioaTNAPi3.ejLl47dZA7MstIO8pErNU06P/yUTsNr6', NULL, 'dasd', 10, '2019-10-14 10:14:37', '2019-10-14 09:18:41', NULL, 1, 'visitor'),
(9, 'Amir', 'Khan', 'amir', '', '$2y$10$xdFEYoeZAUYp7GqmiHOq.umjAQIEIXgasDReMaGSYssqFpK.hN0By', NULL, 'amir@khan.com', 10, '2019-10-14 11:55:38', '2019-10-14 11:55:38', NULL, 1, 'visitor');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `visitor_uid` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL COMMENT 'Male, Female, Other',
  `birthdate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `user_id`, `visitor_uid`, `gender`, `birthdate`, `created_at`, `updated_at`, `updated_by`) VALUES
(12, 8, 'Arvind', 'Male', '2001-10-11', '2019-10-14 10:13:43', '2019-10-14 09:18:41', 1),
(13, 9, 'Salman', 'Male', '2001-10-10', '2019-10-14 11:55:38', '2019-10-14 11:55:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_domain_name` (`event_domain_name`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `event_location_id` (`event_location`);

--
-- Indexes for table `event_location`
--
ALTER TABLE `event_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `event_location_slots`
--
ALTER TABLE `event_location_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_location_id` (`event_location_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `event_show`
--
ALTER TABLE `event_show`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `event_speaker_id` (`event_speaker_id`),
  ADD KEY `show_location_id` (`show_location_id`),
  ADD KEY `show_location_slot_id` (`show_location_slot_id`),
  ADD KEY `event_moderator_id` (`event_moderator_id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `exhibitors`
--
ALTER TABLE `exhibitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `general_category`
--
ALTER TABLE `general_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `general_vendor`
--
ALTER TABLE `general_vendor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `is_event_exhibitors`
--
ALTER TABLE `is_event_exhibitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `is_event_exhibitors_ibfk_2` (`exhibitor_id`);

--
-- Indexes for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_event_speaker_ibfk_1` (`event_id`),
  ADD KEY `is_event_speaker_ibfk_2` (`event_speaker_id`),
  ADD KEY `is_event_speaker_ibfk_3` (`event_speaker_role_id`),
  ADD KEY `event_location_id` (`event_location_id`),
  ADD KEY `event_location_slot_id` (`event_location_slot_id`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `speaker_role_id` (`speaker_role_id`);

--
-- Indexes for table `speaker_accommodation`
--
ALTER TABLE `speaker_accommodation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `manage_by` (`manage_by`),
  ADD KEY `speaker_id` (`speaker_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `speaker_role`
--
ALTER TABLE `speaker_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event_location`
--
ALTER TABLE `event_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_location_slots`
--
ALTER TABLE `event_location_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_show`
--
ALTER TABLE `event_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exhibitors`
--
ALTER TABLE `exhibitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `general_category`
--
ALTER TABLE `general_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_vendor`
--
ALTER TABLE `general_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `is_event_exhibitors`
--
ALTER TABLE `is_event_exhibitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `speaker_accommodation`
--
ALTER TABLE `speaker_accommodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `speaker_role`
--
ALTER TABLE `speaker_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `event_location`
--
ALTER TABLE `event_location`
  ADD CONSTRAINT `event_location_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `event_location_slots`
--
ALTER TABLE `event_location_slots`
  ADD CONSTRAINT `event_location_slots_ibfk_1` FOREIGN KEY (`event_location_id`) REFERENCES `event_location` (`id`),
  ADD CONSTRAINT `event_location_slots_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `event_show`
--
ALTER TABLE `event_show`
  ADD CONSTRAINT `event_show_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_show_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `event_show_ibfk_3` FOREIGN KEY (`event_speaker_id`) REFERENCES `speakers` (`id`),
  ADD CONSTRAINT `event_show_ibfk_5` FOREIGN KEY (`show_location_id`) REFERENCES `event_location` (`id`),
  ADD CONSTRAINT `event_show_ibfk_6` FOREIGN KEY (`show_location_slot_id`) REFERENCES `event_location_slots` (`id`),
  ADD CONSTRAINT `event_show_ibfk_7` FOREIGN KEY (`event_moderator_id`) REFERENCES `speakers` (`id`);

--
-- Constraints for table `event_type`
--
ALTER TABLE `event_type`
  ADD CONSTRAINT `event_type_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `exhibitors`
--
ALTER TABLE `exhibitors`
  ADD CONSTRAINT `exhibitors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `general_category`
--
ALTER TABLE `general_category`
  ADD CONSTRAINT `general_category_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `general_vendor`
--
ALTER TABLE `general_vendor`
  ADD CONSTRAINT `general_vendor_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `general_category` (`id`),
  ADD CONSTRAINT `general_vendor_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `is_event_exhibitors`
--
ALTER TABLE `is_event_exhibitors`
  ADD CONSTRAINT `is_event_exhibitors_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `is_event_exhibitors_ibfk_2` FOREIGN KEY (`exhibitor_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  ADD CONSTRAINT `is_event_speaker_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_event_speaker_ibfk_2` FOREIGN KEY (`event_speaker_id`) REFERENCES `speakers` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_3` FOREIGN KEY (`event_speaker_role_id`) REFERENCES `speaker_role` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_4` FOREIGN KEY (`event_location_id`) REFERENCES `event_location` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_5` FOREIGN KEY (`event_location_slot_id`) REFERENCES `event_location_slots` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_6` FOREIGN KEY (`show_id`) REFERENCES `event_show` (`id`);

--
-- Constraints for table `speakers`
--
ALTER TABLE `speakers`
  ADD CONSTRAINT `speakers_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `speakers_ibfk_2` FOREIGN KEY (`speaker_role_id`) REFERENCES `speaker_role` (`id`);

--
-- Constraints for table `speaker_accommodation`
--
ALTER TABLE `speaker_accommodation`
  ADD CONSTRAINT `speaker_accommodation_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `speaker_accommodation_ibfk_2` FOREIGN KEY (`manage_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `speaker_accommodation_ibfk_4` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`),
  ADD CONSTRAINT `speaker_accommodation_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `speaker_accommodation_ibfk_6` FOREIGN KEY (`category_id`) REFERENCES `general_category` (`id`),
  ADD CONSTRAINT `speaker_accommodation_ibfk_7` FOREIGN KEY (`vendor_id`) REFERENCES `general_vendor` (`id`);

--
-- Constraints for table `speaker_role`
--
ALTER TABLE `speaker_role`
  ADD CONSTRAINT `speaker_role_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
