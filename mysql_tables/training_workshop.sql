-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 10:23 AM
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
-- Table structure for table `training_workshop`
--

CREATE TABLE `training_workshop` (
  `training_id` int(10) UNSIGNED NOT NULL,
  `training_name` varchar(255) NOT NULL,
  `training_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_workshop`
--

INSERT INTO `training_workshop` (`training_id`, `training_name`, `training_type`) VALUES
(1, 'Leadership & Communication 101', 'Leadership & Communication skills'),
(2, 'Art of Listening\r\n', 'Negotiation skills'),
(3, 'Master Communication Skills', 'Presentation skills'),
(4, 'Open Body Language', 'Leadership & Communication skills'),
(5, 'Effective Verbal Communication', 'Negotiation skills'),
(6, 'Advanced Negotiation', 'Negotiation skills');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `training_workshop`
--
ALTER TABLE `training_workshop`
  ADD PRIMARY KEY (`training_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `training_workshop`
--
ALTER TABLE `training_workshop`
  MODIFY `training_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
