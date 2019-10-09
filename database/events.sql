-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2019 at 02:41 PM
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
  `event_domain_name` varchar(255) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `event_location_id` int(11) NOT NULL,
  `event_description` text NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_manage_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_domain_name`, `event_type_id`, `event_location_id`, `event_description`, `start_time`, `end_time`, `event_manage_by`, `updated_by`) VALUES
(1, 'Conference Programmes', 'domain1', 1, 1, 'Network operators are the great enabler of the digital economy. Their contribution and statistics are astonishing;\r\n\r\nâ€¢   The mobile industry eco-system has an economic impact of $3.9 trillion\r\nâ€¢   The industry connects Â½ the worldâ€™s population to the Internet\r\nâ€¢   5.1 billion people subscribe to a mobile service\r\n\r\nThe mobile industry has a tremendous impact and therefore responsibility toward individual, national and international security, privacy and society. \r\n \r\nThe opening keynote of MWC19 will see the worldâ€™s leading operators, including for the first time Vodafoneâ€™s new CEO Nick Read,  discuss how they continue to push the boundaries of technological innovation through 5G, AI, IoT, and Big Data. \r\nThey will also discuss the regulatory environment required to ensure operators are able to deploy these technologies, and the strategies, business models and internal systems needed to ensure they deliver on their promise. All within the context of their wider social and environmental responsibilities.								', '2019-10-09 05:16:24', '2019-10-08 05:25:00', 1, 1),
(2, 'Demo Event', 'domain2', 2, 2, 'Demonstration Event', '2019-10-09 06:04:33', '2019-10-10 00:30:00', 1, 1),
(3, 'Active Event', 'domain3', 3, 1, 'this is test', '2019-10-09 05:16:28', '2019-10-10 00:30:00', 2, 1),
(4, 'Past Spark Event', 'domain4', 9, 1, 'demo', '2019-10-09 05:16:30', '2019-10-07 10:20:00', 3, 1),
(5, 'Merathon', 'domain5', 10, 1, 'Merathon Run', '2019-10-09 05:16:32', '2019-10-10 04:30:00', 2, 1);

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
(1, 'Zinger Hotel', 'Fategunj Vaodara', 1),
(2, 'Millennium Hotel', 'Fategunj, Baroda', 1),
(3, 'Sayaji Hall', 'SayajiGunj', 1);

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
  `event_speaker_id` int(11) NOT NULL,
  `event_speaker_role_id` int(11) NOT NULL,
  `show_manage_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_show`
--

INSERT INTO `event_show` (`id`, `show_name`, `show_location_id`, `show_location_slot_id`, `show_description`, `start_time`, `end_time`, `event_id`, `event_speaker_id`, `event_speaker_role_id`, `show_manage_by`, `updated_by`) VALUES
(1, 'Keynote 1: Intelligently Connecting the World', 1, 1, 'Network operators are the great enabler of the digital economy. Their contribution and statistics are astonishing;\r\n\r\n•   The mobile industry eco-system has an economic impact of $3.9 trillion\r\n•   The industry connects ½ the world’s population to the Internet\r\n•   5.1 billion people subscribe to a mobile service\r\n\r\nThe mobile industry has a tremendous impact and therefore responsibility toward individual, national and international security, privacy and society. \r\n \r\nThe opening keynote of MWC19 will see the world’s leading operators, including for the first time Vodafone’s new CEO Nick Read,  discuss how they continue to push the boundaries of technological innovation through 5G, AI, IoT, and Big Data. \r\nThey will also discuss the regulatory environment required to ensure operators are able to deploy these technologies, and the strategies, business models and internal systems needed to ensure they deliver on their promise. All within the context of their wider social and environmental responsibilities.								', '2019-10-09 05:31:18', '2019-10-04 05:30:00', 1, 1, 1, 1, 1),
(2, 'Show 1', 3, 5, 'demo', '0000-00-00 00:00:00', '2019-10-09 23:30:00', 3, 3, 1, 2, 1),
(3, '5am Show', 2, 3, '5am Show', '2019-10-09 19:30:00', '2019-10-09 23:30:00', 5, 1, 1, 2, 1),
(4, '6am Show', 2, 3, '6am Show', '2019-10-10 04:30:00', '2019-10-10 06:30:00', 5, 2, 1, 3, 1);

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
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_has` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exhibitors`
--

INSERT INTO `exhibitors` (`id`, `firstname`, `lastname`, `username`, `password_has`, `updated_at`, `updated_by`) VALUES
(1, 'Dhruv', 'Patel', 'dhruv', '$2y$10$NmnkrZOQV75t/mfo/K2QXu3rVOh2bUfJrMUzdHRfWRpTDDsonDa4O', '2019-10-09 08:01:27', 1),
(2, 'Sajit', 'Nayar', 'sajit', '$2y$10$6yodNlOJXuKDTboE6qQS9eQPQblrGUDdQOhg58u3QgF/MKvxu6CbS', '2019-10-09 07:43:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `hotel_address` varchar(255) NOT NULL,
  `hotel_website` varchar(255) NOT NULL,
  `hotel_detail` text NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `hotel_address`, `hotel_website`, `hotel_detail`, `updated_by`) VALUES
(1, 'Taj', 'Mumbai', 'www.tajhotel.com', 'This is Taj Hotel', 1);

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
(1, 1, 2, 'yes', 'this is test');

-- --------------------------------------------------------

--
-- Table structure for table `is_event_speaker`
--

CREATE TABLE `is_event_speaker` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_speaker_id` int(11) NOT NULL,
  `event_speaker_role_id` int(11) NOT NULL,
  `event_location_id` int(11) NOT NULL,
  `event_location_slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_event_speaker`
--

INSERT INTO `is_event_speaker` (`id`, `event_id`, `event_speaker_id`, `event_speaker_role_id`, `event_location_id`, `event_location_slot_id`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 1, 2, 3, 1, 1),
(3, 1, 3, 2, 1, 1),
(4, 2, 2, 3, 1, 2),
(5, 2, 1, 1, 3, 4),
(6, 2, 3, 3, 2, 3),
(7, 3, 3, 3, 3, 4),
(8, 5, 4, 3, 2, 3);

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
(3, 'date_format', 'd-m-Y'),
(4, 'main_domain', '*.localhost.com');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` int(11) NOT NULL,
  `speaker_name` varchar(255) NOT NULL,
  `speaker_details` text NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`id`, `speaker_name`, `speaker_details`, `updated_by`) VALUES
(1, 'Salim Kureshi', 'Team Leader at Redspark Technologies', 1),
(2, 'Prashant', 'Sr. Team Leader at Redspark Technologies', 1),
(3, 'Nirav', 'Sr. Team Leader at Redspark Technologies', 1),
(4, 'Deval Barot', 'Sr. Web Developer at Redspark Technologies', 1);

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
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `firstname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `updated_by`, `firstname`, `lastname`) VALUES
(1, 'salim', 'uz-u_bv9UkyDKr6dCipX38e8aDCnvmKC', '$2y$13$GV/y7UBJoSLnhLI13a/FXuQA7i1W.wtegLOerbJ/Ocoljs310FBR6', NULL, 'salim@redsparkinfo.co.in', 10, 1569999351, 1570181368, 'gxZfCFqetP4z8MaHo6uYGF3rKxabFsUN_1569999351', 1, 'Salim', 'Kureshi'),
(2, 'deval', '', 'deval123', NULL, 'deval@redsaprkinfo.co.in', 10, 1569999351, 1570019313, NULL, 1, 'Deval', 'Barot'),
(3, 'nirav', '', 'nirav123', NULL, 'nirav@redsparkinfo.co.in', 10, 1570022535, 1570084573, NULL, 1, 'Nirav', 'Patel');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `visitor_name` varchar(255) NOT NULL,
  `visitor_uid` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_domain_name` (`event_domain_name`),
  ADD KEY `event_type_id` (`event_type_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `event_location_id` (`event_location_id`);

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
  ADD KEY `event_speaker_role_id` (`event_speaker_role_id`),
  ADD KEY `show_location_id` (`show_location_id`),
  ADD KEY `show_location_slot_id` (`show_location_slot_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `is_event_exhibitors`
--
ALTER TABLE `is_event_exhibitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `exhibitor_id` (`exhibitor_id`);

--
-- Indexes for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_event_speaker_ibfk_1` (`event_id`),
  ADD KEY `is_event_speaker_ibfk_2` (`event_speaker_id`),
  ADD KEY `is_event_speaker_ibfk_3` (`event_speaker_role_id`),
  ADD KEY `event_location_id` (`event_location_id`),
  ADD KEY `event_location_slot_id` (`event_location_slot_id`);

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
  ADD KEY `updated_by` (`updated_by`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exhibitors`
--
ALTER TABLE `exhibitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `is_event_exhibitors`
--
ALTER TABLE `is_event_exhibitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `speaker_role`
--
ALTER TABLE `speaker_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `events_ibfk_4` FOREIGN KEY (`event_location_id`) REFERENCES `event_location` (`id`);

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
  ADD CONSTRAINT `event_show_ibfk_4` FOREIGN KEY (`event_speaker_role_id`) REFERENCES `speaker_role` (`id`),
  ADD CONSTRAINT `event_show_ibfk_5` FOREIGN KEY (`show_location_id`) REFERENCES `event_location` (`id`),
  ADD CONSTRAINT `event_show_ibfk_6` FOREIGN KEY (`show_location_slot_id`) REFERENCES `event_location_slots` (`id`);

--
-- Constraints for table `event_type`
--
ALTER TABLE `event_type`
  ADD CONSTRAINT `event_type_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `is_event_exhibitors`
--
ALTER TABLE `is_event_exhibitors`
  ADD CONSTRAINT `is_event_exhibitors_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `is_event_exhibitors_ibfk_2` FOREIGN KEY (`exhibitor_id`) REFERENCES `exhibitors` (`id`);

--
-- Constraints for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  ADD CONSTRAINT `is_event_speaker_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_event_speaker_ibfk_2` FOREIGN KEY (`event_speaker_id`) REFERENCES `speakers` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_3` FOREIGN KEY (`event_speaker_role_id`) REFERENCES `speaker_role` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_4` FOREIGN KEY (`event_location_id`) REFERENCES `event_location` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_5` FOREIGN KEY (`event_location_slot_id`) REFERENCES `event_location_slots` (`id`);

--
-- Constraints for table `speakers`
--
ALTER TABLE `speakers`
  ADD CONSTRAINT `speakers_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `speaker_role`
--
ALTER TABLE `speaker_role`
  ADD CONSTRAINT `speaker_role_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
