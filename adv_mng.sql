-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2024 at 02:53 PM
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
(188, 'q', 'q', 'q', 'q', '', '07:01 PM To 07:01 PM', 'user-dp/ bgg.jpg');

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
  `id` int(30) NOT NULL,
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
(117, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(118, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(120, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(121, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(122, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(123, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(124, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(125, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(126, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(127, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(128, 'sadaE#4sf', 'dsf', 'd', '1', 'sd', '05:46 PM To 09:46 PM', 'user-dp/ bgg.jpg', 'approved'),
(130, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(132, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(133, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(134, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(135, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(136, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(137, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(138, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(139, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(140, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(141, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(142, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(143, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(144, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(145, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(146, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(148, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(150, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(153, 'Nasim^435', 'dsa', 'asd', '1', 'ads', '05:53 PM To 05:53 PM', 'user-dp/ bgg.jpg', 'approved'),
(155, 'Naimish$sdad#3', 'as', 'a', '1', 'sa', '06:57 PM To 06:58 PM', 'user-dp/ bgg.jpg', 'approved'),
(156, 'a', 'sd', 'sd', 's', 's', 's', 's', 'approved'),
(157, 'a', 'sd', 'sd', 's', 's', 's', 's', 'approved'),
(158, 'a', 'sd', 'sd', 's', 's', 's', 's', 'approved'),
(159, 'a', 'sd', 'sd', 's', 's', 's', 's', 'approved'),
(160, 'a', 'sd', 'sd', 's', 's', 's', 's', 'approved'),
(161, 'a', 'sd', 'sd', 's', 's', 's', 's', 'approved'),
(162, 'a', 'sd', 'sd', 's', 's', 's', 's', 'approved'),
(163, 'a', 'sd', 'sd', 's', 's', 's', 's', 'approved'),
(164, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(165, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(166, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(167, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(168, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(169, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(170, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(171, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(172, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(175, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(176, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(184, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'approved'),
(186, 'a', 'a', 'a', 'a', 'a', 'a', '', 'approved'),
(187, 'a', 'a', 'a', 'a', 'a', 'a', '', 'approved');

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
(1, 2, 'sujalbhai', 'civil', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent efficitur nulla vitae enim aliquet sagittis. Fusce suscipit massa', 'pending', '2024-11-22 09:29:52', '', 'documents/case id 1/_html_logo-removebg-preview.png,documents/case id 1/_figma to web.jpg,documents/case id 1/_html-logo.svg'),
(15, 0, '', '', '', 'pending', '2024-12-11 11:59:06', NULL, NULL);

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `work-data`
--
ALTER TABLE `work-data`
  MODIFY `case_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
