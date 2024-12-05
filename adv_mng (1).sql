-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2024 at 03:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adv_mng`
--

-- --------------------------------------------------------

--
-- Table structure for table `adv-nr`
--

CREATE TABLE `adv-nr` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `user_img_src` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adv-nr`
--

INSERT INTO `adv-nr` (`id`, `name`, `uname`, `pwd`, `user_img_src`) VALUES
(1, 'Naimish Rathod', 'n', 'n', 'user-dp/Nathan Nugent.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `all-adv`
--

CREATE TABLE `all-adv` (
  `id` int(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `edu` varchar(50) NOT NULL,
  `exp` varchar(50) NOT NULL,
  `work` varchar(50) NOT NULL,
  `available` varchar(50) NOT NULL,
  `user_img_src` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all-adv`
--

INSERT INTO `all-adv` (`id`, `pwd`, `name`, `edu`, `exp`, `work`, `available`, `user_img_src`) VALUES
(1, 'v', 'Mr. Vishal solanki', 'L.L.B L.L.M', '10', 'property', '8-8', 'user-dp/Untitled.png'),
(2, 'n', 'Mr. Naimish rathod', 'L.L.B', '5', 'criminal', '8-8', 'user-dp/Steve Collins.jpg'),
(3, 'qm', 'atul kumar', 'L.L.B', '1', 'Civil Cases', '9-7', 'user-dp/Paddy Breathnach (1).jpeg'),
(4, 'qwe', 'ram shah', 'L.L.B', '2', 'crime', '9-7', 'user-dp/Stephen-Rennicks Headshot-full.jpeg\r\n'),
(5, '1234', 'satish shah', 'LLB', '12', 'criminal', '8-8', 'user-dp/9c72dab3-3415-427e-a8a5-18f8bf43f3bf.jpg'),
(6, 'a', 'jenil bhai', 'LLM', '14', 'criminal', '7-8', 'user-dp/fastnet-film-festival-Google-Search.png'),
(110, 'AMSND@2323s', 'sdsa', 'dsds', '1', 'fgd', '05:16 PM To 05:18 PM', 'user-dp/ bgg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `entry` timestamp NOT NULL DEFAULT current_timestamp(),
  `quit` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `name`, `entry`, `quit`) VALUES
(1, 'Mr. Vishal solanki', '2024-11-21 11:25:10', '2024-11-21 11:25:22'),
(1, 'Mr. Vishal solanki', '2024-11-22 08:53:30', '0000-00-00 00:00:00'),
(2, 'Mr. Naimish rathod', '2024-11-22 09:05:15', '2024-11-22 09:07:54'),
(1, 'Mr. Vishal solanki', '2024-11-23 09:34:35', '0000-00-00 00:00:00'),
(1, 'Mr. Vishal solanki', '2024-11-26 09:43:13', '0000-00-00 00:00:00'),
(1, 'Mr. Vishal solanki', '2024-11-27 09:01:54', '0000-00-00 00:00:00'),
(2, 'Mr. Naimish rathod', '2024-11-27 09:02:03', '0000-00-00 00:00:00'),
(1, 'Mr. Vishal solanki', '2024-12-02 12:55:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE `temp_user` (
  `id` int(11) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `edu` varchar(50) NOT NULL,
  `exp` varchar(30) NOT NULL,
  `work` varchar(30) NOT NULL,
  `available` varchar(30) NOT NULL,
  `user_img_src` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_user`
--

INSERT INTO `temp_user` (`id`, `pwd`, `name`, `edu`, `exp`, `work`, `available`, `user_img_src`, `status`) VALUES
(5, '1234', 'satish shah', 'LLB', '12', 'criminal', '8-8', 'user-dp/9c72dab3-3415-427e-a8a5-18f8bf43f3bf.jpg', 'approved'),
(6, 'a', 'jenil bhai', 'LLM', '14', 'criminal', '7-8', 'user-dp/fastnet-film-festival-Google-Search.png', 'approved'),
(84, 'ANSDiadjaasDaD#$34324', 'naimish', 'a', '1', 'qw', '04:35 PM To 10:31 PM', 'user-dp/ bgg.jpg', 'approved'),
(110, 'AMSND@2323s', 'sdsa', 'dsds', '1', 'fgd', '05:16 PM To 05:18 PM', 'user-dp/ bgg.jpg', 'approved'),
(111, 'AMSND@2323s', 'asdsd', 'dsds', '1', 'fgd', '05:16 PM To 05:18 PM', 'user-dp/ bgg.jpg', 'pending'),
(112, 'dfG%633sdd', 'ds', 'dfs', '1', 'fds', '05:43 PM To 11:37 PM', 'user-dp/ bgg.jpg', 'pending'),
(113, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(114, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(115, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(116, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(117, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(118, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(119, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(120, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(121, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(122, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(123, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(124, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(125, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(126, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(127, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(128, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(129, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'pending'),
(130, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(132, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(133, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(134, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(135, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(136, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(137, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(138, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(139, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(140, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(141, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(142, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(143, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(144, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(145, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(146, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(147, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(148, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(149, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(150, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(151, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(152, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(153, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'pending'),
(154, 'HYR5#adffd', 'dsa', 'd', '21', 'ds', '05:49 PM To 05:49 PM', 'user-dp/ bgg.jpg', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `work-data`
--

CREATE TABLE `work-data` (
  `case_id` int(10) NOT NULL,
  `id` int(11) NOT NULL,
  `client-name` varchar(20) NOT NULL,
  `case-type` varchar(50) NOT NULL,
  `case-desc` varchar(300) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `case_cls_desc` varchar(300) DEFAULT NULL,
  `document` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work-data`
--

INSERT INTO `work-data` (`case_id`, `id`, `client-name`, `case-type`, `case-desc`, `status`, `created_at`, `case_cls_desc`, `document`) VALUES
(1, 2, 'sujalbhai', 'civil', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent efficitur nulla vitae enim aliquet sagittis. Fusce suscipit massa', 'pending', '2024-11-22 09:29:52', '', 'documents/case id 1/_html_logo-removebg-preview.png,documents/case id 1/_figma to web.jpg,documents/case id 1/_html-logo.svg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all-adv`
--
ALTER TABLE `all-adv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD UNIQUE KEY `entry` (`entry`);

--
-- Indexes for table `temp_user`
--
ALTER TABLE `temp_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work-data`
--
ALTER TABLE `work-data`
  ADD PRIMARY KEY (`case_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all-adv`
--
ALTER TABLE `all-adv`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `work-data`
--
ALTER TABLE `work-data`
  MODIFY `case_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
