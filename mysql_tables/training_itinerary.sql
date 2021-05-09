-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 03:21 PM
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
  `day` varchar(10) NOT NULL,
  `activity` text NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_itinerary`
--

INSERT INTO `training_itinerary` (`training_itinerary_id`, `training_id`, `day`, `activity`, `date`, `time`) VALUES
(1, 1, 'day 1', '9:30 Opening Ceremony\r\n10:30 Ice Breaking', '2021-05-10', '09:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `training_itinerary`
--
ALTER TABLE `training_itinerary`
  ADD PRIMARY KEY (`training_itinerary_id`),
  ADD KEY `fk_training_workshop` (`training_id`);

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
  ADD CONSTRAINT `fk_training_workshop` FOREIGN KEY (`training_id`) REFERENCES `training_workshop` (`training_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
