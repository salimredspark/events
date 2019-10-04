-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2019 at 02:35 PM
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
  `event_location` text NOT NULL,
  `event_description` blob NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_manage_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_domain_name`, `event_type_id`, `event_location`, `event_description`, `start_time`, `end_time`, `event_manage_by`, `updated_by`) VALUES
(1, 'Conference Programmes', 'domain1', 1, 'Industry 4.0 Hall 4 - Auditorium 1', 0x4e6574776f726b206f70657261746f7273206172652074686520677265617420656e61626c6572206f6620746865206469676974616c2065636f6e6f6d792e20546865697220636f6e747269627574696f6e20616e64207374617469737469637320617265206173746f6e697368696e673b0d0a0d0ae280a2202020546865206d6f62696c6520696e6475737472792065636f2d73797374656d2068617320616e2065636f6e6f6d696320696d70616374206f662024332e39207472696c6c696f6e0d0ae280a220202054686520696e64757374727920636f6e6e6563747320c2bd2074686520776f726c64e280997320706f70756c6174696f6e20746f2074686520496e7465726e65740d0ae280a2202020352e312062696c6c696f6e2070656f706c652073756273637269626520746f2061206d6f62696c6520736572766963650d0a0d0a546865206d6f62696c6520696e647573747279206861732061207472656d656e646f757320696d7061637420616e64207468657265666f726520726573706f6e736962696c69747920746f7761726420696e646976696475616c2c206e6174696f6e616c20616e6420696e7465726e6174696f6e616c2073656375726974792c207072697661637920616e6420736f63696574792e200d0a200d0a546865206f70656e696e67206b65796e6f7465206f66204d574331392077696c6c207365652074686520776f726c64e2809973206c656164696e67206f70657261746f72732c20696e636c7564696e6720666f72207468652066697273742074696d6520566f6461666f6e65e2809973206e65772043454f204e69636b20526561642c20206469736375737320686f77207468657920636f6e74696e756520746f20707573682074686520626f756e646172696573206f6620746563686e6f6c6f676963616c20696e6e6f766174696f6e207468726f7567682035472c2041492c20496f542c20616e642042696720446174612e200d0a546865792077696c6c20616c736f20646973637573732074686520726567756c61746f727920656e7669726f6e6d656e7420726571756972656420746f20656e73757265206f70657261746f7273206172652061626c6520746f206465706c6f7920746865736520746563686e6f6c6f676965732c20616e642074686520737472617465676965732c20627573696e657373206d6f64656c7320616e6420696e7465726e616c2073797374656d73206e656564656420746f20656e7375726520746865792064656c69766572206f6e2074686569722070726f6d6973652e20416c6c2077697468696e2074686520636f6e74657874206f6620746865697220776964657220736f6369616c20616e6420656e7669726f6e6d656e74616c20726573706f6e736962696c69746965732e0909090909090909, '2019-10-04 09:35:28', '2019-10-04 21:45:00', 1, 1),
(2, 'Demo Event', 'domain2', 2, 'Millenium Resort, Fategunj, Vadodara, Gujarat', 0x44656d6f6e7374726174696f6e204576656e74, '2019-10-03 21:35:30', '2019-10-05 01:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_show`
--

CREATE TABLE `event_show` (
  `id` int(11) NOT NULL,
  `show_name` varchar(255) NOT NULL,
  `show_location` varchar(255) NOT NULL,
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

INSERT INTO `event_show` (`id`, `show_name`, `show_location`, `show_description`, `start_time`, `end_time`, `event_id`, `event_speaker_id`, `event_speaker_role_id`, `show_manage_by`, `updated_by`) VALUES
(1, 'Keynote 1: Intelligently Connecting the World', 'Hall 4 - Auditorium 1', 'Network operators are the great enabler of the digital economy. Their contribution and statistics are astonishing;\r\n\r\n•   The mobile industry eco-system has an economic impact of $3.9 trillion\r\n•   The industry connects ½ the world’s population to the Internet\r\n•   5.1 billion people subscribe to a mobile service\r\n\r\nThe mobile industry has a tremendous impact and therefore responsibility toward individual, national and international security, privacy and society. \r\n \r\nThe opening keynote of MWC19 will see the world’s leading operators, including for the first time Vodafone’s new CEO Nick Read,  discuss how they continue to push the boundaries of technological innovation through 5G, AI, IoT, and Big Data. \r\nThey will also discuss the regulatory environment required to ensure operators are able to deploy these technologies, and the strategies, business models and internal systems needed to ensure they deliver on their promise. All within the context of their wider social and environmental responsibilities.								', '2019-10-03 21:21:06', '2019-10-04 05:30:00', 1, 1, 1, 1, 1);

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
-- Table structure for table `is_event_speaker`
--

CREATE TABLE `is_event_speaker` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_speaker_id` int(11) NOT NULL,
  `event_speaker_role_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `hotel_room_number` varchar(150) NOT NULL,
  `hotel_book_by` int(11) NOT NULL,
  `hotel_patner` varchar(255) NOT NULL,
  `speaker_travel_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_event_speaker`
--

INSERT INTO `is_event_speaker` (`id`, `event_id`, `event_speaker_id`, `event_speaker_role_id`, `hotel_id`, `hotel_room_number`, `hotel_book_by`, `hotel_patner`, `speaker_travel_by`) VALUES
(1, 1, 1, 1, 1, '125', 1, 'cleartrip.com', 'Flight'),
(2, 1, 2, 3, 1, '', 1, '', ''),
(3, 1, 3, 2, 1, '', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `location_details` text NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 'date_format', 'd m, Y'),
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
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `event_show`
--
ALTER TABLE `event_show`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `event_speaker_id` (`event_speaker_id`),
  ADD KEY `event_speaker_role_id` (`event_speaker_role_id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_event_speaker_ibfk_1` (`event_id`),
  ADD KEY `is_event_speaker_ibfk_2` (`event_speaker_id`),
  ADD KEY `is_event_speaker_ibfk_3` (`event_speaker_role_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `hotel_book_by` (`hotel_book_by`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_show`
--
ALTER TABLE `event_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `event_show`
--
ALTER TABLE `event_show`
  ADD CONSTRAINT `event_show_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_show_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `event_show_ibfk_3` FOREIGN KEY (`event_speaker_id`) REFERENCES `speakers` (`id`),
  ADD CONSTRAINT `event_show_ibfk_4` FOREIGN KEY (`event_speaker_role_id`) REFERENCES `speaker_role` (`id`);

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
-- Constraints for table `is_event_speaker`
--
ALTER TABLE `is_event_speaker`
  ADD CONSTRAINT `is_event_speaker_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_event_speaker_ibfk_2` FOREIGN KEY (`event_speaker_id`) REFERENCES `speakers` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_3` FOREIGN KEY (`event_speaker_role_id`) REFERENCES `speaker_role` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_4` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `is_event_speaker_ibfk_5` FOREIGN KEY (`hotel_book_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

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
