-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 01:39 PM
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
-- Table structure for table `itinerary_management`
--

CREATE TABLE `itinerary_management` (
  `itinerary_management_id` int(11) UNSIGNED NOT NULL,
  `form_id` int(11) UNSIGNED NOT NULL,
  `training_itinerary_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itinerary_management`
--
ALTER TABLE `itinerary_management`
  ADD PRIMARY KEY (`itinerary_management_id`),
  ADD KEY `fk_form_id` (`form_id`),
  ADD KEY `fk_training_itinerary_id` (`training_itinerary_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itinerary_management`
--
ALTER TABLE `itinerary_management`
  MODIFY `itinerary_management_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itinerary_management`
--
ALTER TABLE `itinerary_management`
  ADD CONSTRAINT `fk_form_id` FOREIGN KEY (`form_id`) REFERENCES `request_form` (`form_id`),
  ADD CONSTRAINT `fk_training_itinerary_id` FOREIGN KEY (`training_itinerary_id`) REFERENCES `training_itinerary` (`training_itinerary_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
