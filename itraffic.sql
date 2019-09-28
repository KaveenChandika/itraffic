-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2019 at 10:28 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itraffic`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(200) NOT NULL,
  `u_mobile` int(15) NOT NULL,
  `u_tel` int(15) NOT NULL,
  `u_address` varchar(250) NOT NULL,
  `u_email` varchar(200) NOT NULL,
  `u_type` int(11) NOT NULL,
  `u_status` tinyint(2) NOT NULL,
  `u_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`u_id`, `u_name`, `username`, `password`, `u_mobile`, `u_tel`, `u_address`, `u_email`, `u_type`, `u_status`, `u_created_date`) VALUES
(1, 'admin', 'admin', '202cb962ac59075b964b07152d234b70', 0, 0, '', '', 1, 0, '2019-06-22 00:47:12'),
(2, 'Kaveen Gunawardhane', 'kaveen', '202cb962ac59075b964b07152d234b70', 777484383, 912246712, 'Galle', 'ckaveen17@gmail.com', 2, 0, '2019-06-24 06:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `u_tp_id` int(11) NOT NULL,
  `u_type_name` varchar(200) NOT NULL,
  `u_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`u_tp_id`, `u_type_name`, `u_status`) VALUES
(1, 'admin', 0),
(2, 'driver', 0),
(3, 'passenger', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_belong_users`
--

CREATE TABLE `tbl_vehicle_belong_users` (
  `v_id` int(11) NOT NULL,
  `v_u_id` int(11) NOT NULL,
  `v_number` varchar(200) NOT NULL,
  `v_name` varchar(200) NOT NULL,
  `v_type` varchar(200) NOT NULL,
  `latitude` varchar(500) NOT NULL,
  `longtitude` varchar(500) NOT NULL,
  `v_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `v_status` tinyint(2) NOT NULL COMMENT 'active=1 ,deactive =0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle_belong_users`
--

INSERT INTO `tbl_vehicle_belong_users` (`v_id`, `v_u_id`, `v_number`, `v_name`, `v_type`, `latitude`, `longtitude`, `v_created_at`, `v_status`) VALUES
(1, 2, 'HW-4673', '', 'CAR', '6.064147', '80.200326', '2019-06-24 06:59:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`u_tp_id`);

--
-- Indexes for table `tbl_vehicle_belong_users`
--
ALTER TABLE `tbl_vehicle_belong_users`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `u_tp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_vehicle_belong_users`
--
ALTER TABLE `tbl_vehicle_belong_users`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
