-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 25, 2024 at 05:44 AM
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
(20, 14, 16, '2024-07-23 08:15:10'),
(21, 18, 16, '2024-07-25 01:56:37'),
(22, 17, 18, '2024-07-25 02:07:50'),
(24, 14, 14, '2024-07-25 02:29:37'),
(25, 14, 14, '2024-07-25 02:29:43'),
(26, 14, 14, '2024-07-25 02:29:49'),
(27, 14, 14, '2024-07-25 02:29:55'),
(28, 14, 14, '2024-07-25 02:30:02'),
(29, 14, 14, '2024-07-25 02:30:19'),
(30, 14, 14, '2024-07-25 02:30:41'),
(33, 14, 14, '2024-07-25 02:39:17'),
(34, 19, 15, '2024-07-25 03:50:31'),
(35, 14, 19, '2024-07-25 05:22:43');

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
(63, 14, 15, 'Lisa give me tickets', '2024-07-23 06:03:09'),
(66, 17, 16, 'ill give you tickets', '2024-07-23 06:04:02'),
(69, 20, 14, 'haloo lisa', '2024-07-23 08:15:10'),
(70, 21, 18, 'Hello', '2024-07-25 01:56:37'),
(71, 22, 17, 'Hello jisoo', '2024-07-25 02:07:50'),
(72, 4, 14, 'testing', '2024-07-25 02:27:33'),
(73, 4, 14, 'testt', '2024-07-25 02:27:39'),
(74, 4, 14, 'im listening to baby monster', '2024-07-25 02:27:50'),
(75, 4, 14, 'i hope the delete works', '2024-07-25 02:28:02'),
(76, 4, 14, 'goodluck sa work todayy', '2024-07-25 02:28:21'),
(77, 4, 14, 'are you feeling better?', '2024-07-25 02:28:34'),
(79, 4, 14, 'yay i guess its working?', '2024-07-25 02:29:06'),
(81, 24, 14, 'asdasdasd', '2024-07-25 02:29:37'),
(82, 25, 14, 'heyy', '2024-07-25 02:29:43'),
(83, 26, 14, 'dddd', '2024-07-25 02:29:49'),
(84, 27, 14, 'hehehe', '2024-07-25 02:29:55'),
(85, 28, 14, ':))', '2024-07-25 02:30:02'),
(86, 29, 14, 'i hope this will work', '2024-07-25 02:30:19'),
(87, 30, 14, 'try try', '2024-07-25 02:30:41'),
(90, 33, 14, 'heyy', '2024-07-25 02:39:17'),
(91, 34, 19, 'Hi horeb', '2024-07-25 03:50:31'),
(92, 34, 19, 'Can you play basketball with me?', '2024-07-25 03:50:42'),
(93, 35, 14, 'hello mingyu', '2024-07-25 05:22:43');

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
(14, 'Lourdes Kyle', 'lourdes@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', 'Female', '2000-11-11', 'I dance to relieve stress', '2024-07-25 05:12:30', 'uploads/ariana.jpg', '2024-07-25 02:53:48'),
(15, 'Horeb Barz', 'horeb@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', 'Male', '2000-11-18', 'Making arts', '2024-07-25 03:13:57', 'uploads/images.png', '2024-07-18 10:51:13'),
(16, 'Lalisa Manobal', 'lalisa@email.com', 'fe3e8bd25bab9db5daae009a17474acbcbc8c4a5', 'Female', '1997-07-09', 'I am a rockstar. I am a member of blackpink', '2024-07-25 03:13:48', 'uploads/lisa.png', '2024-07-22 10:51:20'),
(17, 'Rose Park', 'rose@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', 'Female', '1998-02-02', NULL, '2024-07-25 05:44:23', 'uploads/default.jpg', '2024-07-23 10:51:27'),
(18, 'Jisoo Kim', 'jisoo@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', 'Female', '1997-07-09', 'My hobby is gardening', '2024-07-25 02:50:41', 'uploads/default.jpg', '2024-07-25 01:35:15'),
(19, 'Mingyu Kim', 'mingyu@email.com', '33fd5b2556e5024c64ffad8ddfaa6f114a14e5c9', 'Male', '1997-07-09', 'I like to sing.', '2024-07-25 05:42:28', 'uploads/images.png', '2024-07-25 05:03:25');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
