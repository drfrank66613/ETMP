-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 02:35 PM
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
  `training_id` int(11) UNSIGNED NOT NULL,
  `training_type_id` int(11) UNSIGNED NOT NULL,
  `training_name` varchar(255) NOT NULL,
  `training_price` int(11) UNSIGNED NOT NULL,
  `training_duration` varchar(32) NOT NULL,
  `training_image_link` varchar(50) NOT NULL,
  `training_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_workshop`
--

INSERT INTO `training_workshop` (`training_id`, `training_type_id`, `training_name`, `training_price`, `training_duration`, `training_image_link`, `training_details`) VALUES
(1, 1, 'Leadership Agility', 300, '1 day', 'images/leadership.jfif', 'This workshop helps workers and leaders cultivate the agile mentality needed to keep up with changing practices and technology in their industries. Employees must be able to adjust to unforeseen changes, identify opportunities, and seize them, while leaders must be able to evolve, set trends, and put their company\'s vision into action. Participants in this course will explore cognitive prejudices that could be blocking them from maximizing their leadership agility, as well as techniques for overcoming these biases using the IDEA Agility Model: Investigate, Design, Energize, and Apply. Participants can achieve a comprehensive understanding of their existing agility capabilities and shortcomings, as well as realistic strategies for improving their IDEA abilities.'),
(2, 2, 'Art of Listening\r\n', 250, '1 day', 'images/negotiation.jfif', 'The aim of this workshop on the art of listening is to learn what the speaker has to say about a subject. Employees benefit about each other as they pay attention to each other. A workplace where workers are continually learning from one another will benefit from a free flow of ideas that are genuinely listened to.'),
(3, 3, 'Master Communication Skills', 280, '2 days', 'images/presentation.jfif', 'This workshop will help you develop your communication skills dramatically. You\'ll learn how to deal with people in the corporate world and, as a result, achieve success. Both verbally and nonverbally, you will be able to attract and hold people\'s interest. Your body can transform into a powerful tool, allowing you to enthrall and captivate the audience and your interlocutors.'),
(4, 1, 'Open Body Language', 325, '1 day', 'images/leadership-2.jfif', 'This fascinating professional development training workshop will teach you how to read people\'s body language, hand movements, and facial expressions to figure out what they\'re really thinking and feeling. There are also cultural distinctions to note, such as the fact that some cultures use very colorful and wild gesturing while others use very somber and reserved gestures. Gender-related body language trends should also be taken into account.'),
(5, 2, 'Effective Verbal Communication', 250, '2 days ', 'images/negotiation-2.jfif', 'This workshop addresses the concepts and practices of excellent communication skills within any community through discussions of how people interact and why communication is necessary. Participants may address communication barriers and focus on the advantages of effective communication. Specific communication skills, such as active listening, will be discussed in addition to common communication concepts.'),
(6, 2, 'Advanced Negotiation', 200, '1 day', 'images/negotiation-3.jfif', 'Our advanced negotiating skills training workshop was designed to prepare negotiators for more dynamic, team-based, big, strategic, or foreign deals. As you work your way through real-life negotiations, you\'ll get no-holds-barred input from Negotiation Experts. You\'ll master the techniques and logical dimensions while still using the interpersonal soft skills.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `training_workshop`
--
ALTER TABLE `training_workshop`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `fk_id_training_type` (`training_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `training_workshop`
--
ALTER TABLE `training_workshop`
  MODIFY `training_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `training_workshop`
--
ALTER TABLE `training_workshop`
  ADD CONSTRAINT `fk_id_training_type` FOREIGN KEY (`training_type_id`) REFERENCES `training_type` (`training_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
