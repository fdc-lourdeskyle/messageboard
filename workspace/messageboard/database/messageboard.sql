-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 25, 2024 at 01:36 AM
-- Server version: 5.6.51
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messageboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `sender_id`, `receiver_id`, `created_at`) VALUES
(4, 14, 15, '2024-07-19 05:16:22'),
(6, 16, 14, '2024-07-19 09:35:05'),
(14, 15, 16, '2024-07-23 06:03:09'),
(17, 16, 15, '2024-07-23 06:04:02'),
(19, 14, 15, '2024-07-23 06:04:50'),
(20, 14, 16, '2024-07-23 08:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `message`, `created_at`) VALUES
(3, 4, 14, 'Hello horeb', '2024-07-19 05:16:22'),
(6, 4, 15, 'Hi lourdes, how are you doing?', '2024-07-19 07:03:45'),
(8, 4, 14, 'im doing fine , how about you?', '2024-07-19 07:18:53'),
(10, 4, 15, 'thats good :) , im also doing fine', '2024-07-19 07:45:06'),
(12, 6, 16, 'hi lourdes :)', '2024-07-19 09:35:05'),
(13, 6, 14, 'hi lisaaa, im going to your concert soon!', '2024-07-19 09:35:59'),
(63, 14, 15, 'Lisa give me tickers', '2024-07-23 06:03:09'),
(66, 17, 16, 'ill give you tickers', '2024-07-23 06:04:02'),
(68, 19, 14, 'Im sick today :(', '2024-07-23 06:04:50'),
(69, 20, 14, 'haloo lisa', '2024-07-23 08:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hobby` text,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `photo` varchar(32) DEFAULT 'uploads/default.jpg',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `birthdate`, `hobby`, `last_login_time`, `photo`, `created_at`) VALUES
(14, 'lourdes', 'lourdes@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', 'Female', '2000-11-11', 'I dance to relieve stress', '2024-07-23 09:58:40', 'uploads/female.png', '0000-00-00 00:00:00'),
(15, 'horeb', 'horeb@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', 'Male', '2000-11-18', 'Making arts', '2024-07-23 06:02:45', 'uploads/images.png', '0000-00-00 00:00:00'),
(16, 'Lisa', 'lalisa@email.com', 'fe3e8bd25bab9db5daae009a17474acbcbc8c4a5', 'Female', '1997-07-09', 'I am a rockstar. I am a member of blackpink', '2024-07-23 06:03:39', 'uploads/lisa.png', '0000-00-00 00:00:00'),
(17, 'Rose Park', 'rose@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', NULL, NULL, NULL, '2024-07-25 01:17:44', 'uploads/default.jpg', '0000-00-00 00:00:00'),
(18, 'Jisoo Kim', 'jisoo@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', 'Female', '1997-07-09', 'My hobby is gardening', '2024-07-25 01:35:15', 'uploads/default.jpg', '2024-07-25 01:35:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_ibfk_1` (`sender_id`),
  ADD KEY `conversations_ibfk_2` (`receiver_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ibfk_1` (`conversation_id`),
  ADD KEY `messages_ibfk_2` (`sender_id`);

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
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
