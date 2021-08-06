-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 08:06 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ui_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbluniversities`
--

CREATE TABLE `tbluniversities` (
  `uni_id` int(11) NOT NULL,
  `uni_name` varchar(1024) NOT NULL,
  `uni_code` varchar(256) NOT NULL,
  `uni_logo` varchar(1024) NOT NULL,
  `uni_active` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluniversities`
--

INSERT INTO `tbluniversities` (`uni_id`, `uni_name`, `uni_code`, `uni_logo`, `uni_active`) VALUES
(1, 'University Of Colombo', 'COL', 'img/universities/COL.png', 1),
(2, 'Eastern University', 'EST', 'img/universities/EST.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `usr_id` int(11) NOT NULL,
  `usr_name` varchar(1024) NOT NULL,
  `usr_email` varchar(1024) NOT NULL,
  `usr_password` varchar(1024) NOT NULL,
  `usr_type` int(11) NOT NULL DEFAULT 0 COMMENT '0 - User, 1 - Admin',
  `usr_last_login` varchar(256) NOT NULL DEFAULT '',
  `usr_last_ip` varchar(256) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`usr_id`, `usr_name`, `usr_email`, `usr_password`, `usr_type`, `usr_last_login`, `usr_last_ip`) VALUES
(1, 'Administrator', 'admin@admin.com', 'cGFzc3dvcmQ=', 1, '', ''),
(5, 'User', 'user@user.com', 'cGFzc3dvcmQ=', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbluniversities`
--
ALTER TABLE `tbluniversities`
  ADD PRIMARY KEY (`uni_id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbluniversities`
--
ALTER TABLE `tbluniversities`
  MODIFY `uni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
