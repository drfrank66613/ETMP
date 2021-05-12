-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 12:42 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
-- Table structure for table `training_itinerary`
--

CREATE TABLE `training_itinerary` (
  `training_itinerary_id` int(11) UNSIGNED NOT NULL,
  `training_id` int(11) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `training_itinerary_status` varchar(100) NOT NULL,
  `current_used_date` varchar(30) NOT NULL,
  `current_used_time` varchar(30) NOT NULL,
  `modification_date` varchar(30) NOT NULL,
  `modification_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_itinerary`
--

INSERT INTO `training_itinerary` (`training_itinerary_id`, `training_id`, `form_id`, `training_itinerary_status`, `current_used_date`, `current_used_time`, `modification_date`, `modification_time`) VALUES
(1, 1, 6, 'Unconfirmed', '2021-05-10', '10:00 AM', '-', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `training_itinerary`
--
ALTER TABLE `training_itinerary`
  ADD PRIMARY KEY (`training_itinerary_id`),
  ADD KEY `fk_training_workshop` (`training_id`),
  ADD KEY `fk_request_form` (`form_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `training_itinerary`
--
ALTER TABLE `training_itinerary`
  MODIFY `training_itinerary_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `training_itinerary`
--
ALTER TABLE `training_itinerary`
  ADD CONSTRAINT `fk_request_form` FOREIGN KEY (`form_id`) REFERENCES `request_form` (`form_id`),
  ADD CONSTRAINT `fk_training_workshop` FOREIGN KEY (`training_id`) REFERENCES `training_workshop` (`training_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
