-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2025 at 05:00 AM
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
(222, 'q', 'q', 'q', 'q', 'q', '04:02 PM To 04:04 PM', 'user-dp/ bgg.jpg'),
(245, 'test@123ABC', 'vishal', 'mca', '4', 'w', '12:21 AM To 11:24 AM', 'user-dp/ bgg.jpg'),
(246, 'dfsfH#4555', 'ramss', 'dsfsf', '12', 'sdsasas', '02:30 PM To 02:31 PM', 'user-dp/ bgg.jpg'),
(247, 'Naisdg@314', 'sadad', 'asds', '23', 'sdadsda', '06:45 PM To 07:44 PM', 'user-dp/ logos.png');

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
(1, 'Mr. Vishal solanki', '2024-12-26 10:52:22', '2024-12-31 06:57:55'),
(1, 'Mr. Vishal solanki', '2024-12-27 09:14:38', '2024-12-31 06:57:55'),
(1, 'Mr. Vishal solanki', '2024-12-31 05:59:57', '2024-12-31 06:57:55'),
(1, 'Mr. Vishal solanki', '2025-01-24 08:49:35', '0000-00-00 00:00:00'),
(2, 'Mr. Naimish rathod', '2025-01-24 08:50:20', '2025-01-24 08:54:12');

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
(222, 'q', 'q', 'q', 'q', 'q', '04:02 PM To 04:04 PM', 'user-dp/ bgg.jpg', 'approved'),
(223, 'q', 'q', 'q', 'q', 'q', '04:02 PM To 04:04 PM', 'user-dp/ bgg.jpg', 'approved'),
(242, 'Naimish@123', 'ds', 'sad', '12', 'dddsf', '10:27 AM To 10:33 AM', 'user-dp/ bgg.jpg', 'approved'),
(243, 'sdf$534532D', 'dsfdsf', 'sdf', '12', 'asdrrwr', '10:38 AM To 10:38 AM', 'user-dp/ bgg.jpg', 'approved'),
(244, 'Naimish$1233', 'naimish', 'vasd', '23', 'sadad', '10:42 AM To 04:36 AM', 'user-dp/ bgg.jpg', 'approved'),
(245, 'test@123ABC', 'vishal', 'mca', '4', 'w', '12:21 AM To 11:24 AM', 'user-dp/ bgg.jpg', 'approved'),
(246, 'dfsfH#4555', 'ramss', 'dsfsf', '12', 'sdsasas', '02:30 PM To 02:31 PM', 'user-dp/ bgg.jpg', 'approved'),
(247, 'Naisdg@314', 'sadad', 'asds', '23', 'sdadsda', '06:45 PM To 07:44 PM', 'user-dp/ logos.png', 'approved');

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
  `email` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `case_cls_desc` varchar(300) DEFAULT NULL,
  `document` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `work-data`
--
ALTER TABLE `work-data`
  MODIFY `case_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
