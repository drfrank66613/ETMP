-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 03:30 PM
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
-- Table structure for table `unconfirmed_training_workshop`
--

CREATE TABLE `unconfirmed_training_workshop` (
  `unconfirmed_training_id` int(11) UNSIGNED NOT NULL,
  `form_id` int(11) UNSIGNED NOT NULL,
  `training_id` int(11) UNSIGNED NOT NULL,
  `training_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unconfirmed_training_workshop`
--

INSERT INTO `unconfirmed_training_workshop` (`unconfirmed_training_id`, `form_id`, `training_id`, `training_status`) VALUES
(1, 2, 3, 'unconfirmed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `unconfirmed_training_workshop`
--
ALTER TABLE `unconfirmed_training_workshop`
  ADD PRIMARY KEY (`unconfirmed_training_id`),
  ADD KEY `fk_id_form` (`form_id`),
  ADD KEY `fk_workshop_training` (`training_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `unconfirmed_training_workshop`
--
ALTER TABLE `unconfirmed_training_workshop`
  MODIFY `unconfirmed_training_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `unconfirmed_training_workshop`
--
ALTER TABLE `unconfirmed_training_workshop`
  ADD CONSTRAINT `fk_id_form` FOREIGN KEY (`form_id`) REFERENCES `request_form` (`form_id`),
  ADD CONSTRAINT `fk_workshop_training` FOREIGN KEY (`training_id`) REFERENCES `training_workshop` (`training_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
