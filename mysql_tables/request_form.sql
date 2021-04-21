-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 11:56 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `request_form`
--

CREATE TABLE `request_form` (
  `form_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `training_type_id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `request_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `training_venue` varchar(20) NOT NULL,
  `training_date` varchar(20) NOT NULL,
  `training_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_form`
--

INSERT INTO `request_form` (`form_id`, `user_id`, `training_type_id`, `fname`, `lname`, `request_status`, `request_date`, `phone`, `address`, `city`, `state`, `training_venue`, `training_date`, `training_time`) VALUES
(1, 1, 1, 'Tensan', 'Alesandro', 'Pending', '2021-04-05 20:52:46', '01230123', 'asdfv', 'asdf', 'sadf', 'Kuching Branch', '2021-04-23', '15:10'),
(2, 2, 2, 'Erida', 'Winardi', 'Pending', '2021-04-05 20:54:21', '012301233', 'asdf', 'asdf', 'gdf', 'Kuching Branch', '2021-04-23', '12:05'),
(3, 1, 1, 'Bryan', 'Ichsan', 'Canceled', '2021-04-21 00:02:43', '08524820698', 'Gusti Hamzah, no.22', 'Sambas', 'Kedah', 'Miri Branch', '2021-04-23', '00:05'),
(4, 3, 3, 'Bryan', 'Ichsan', 'Pending', '2021-04-21 15:47:02', '08524820698', 'Gusti Hamzah, no.22', 'Sambas', 'Selangor', 'Miri Branch', '2021-04-29', '03:49'),
(5, 2, 2, 'George', 'Kennedy', 'In Progress', '2021-04-21 15:57:51', '08524820698', 'Gusti Hamzah, no.22', 'Sambas', 'Kedah', 'Sibu Branch', '2021-04-24', '03:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request_form`
--
ALTER TABLE `request_form`
  ADD PRIMARY KEY (`form_id`),
  ADD KEY `fk_id_user` (`user_id`),
  ADD KEY `fk_training_type_id` (`training_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request_form`
--
ALTER TABLE `request_form`
  MODIFY `form_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_form`
--
ALTER TABLE `request_form`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`user_id`) REFERENCES `user_information` (`id`),
  ADD CONSTRAINT `fk_training_type_id` FOREIGN KEY (`training_type_id`) REFERENCES `training_type` (`training_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
