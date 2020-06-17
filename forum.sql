-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 07:22 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(30) NOT NULL,
  `category_description` text NOT NULL,
  `category_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_description`, `category_date`) VALUES
(1, 'Python', 'Python is an interpreted, high-level, general-purpose programming language. Created by Guido van Rossum and first released in 1991. Python\'s design philosophy emphasizes code readability with its notable use of significant whitespace.', '2020-06-15 11:32:25'),
(2, 'Javascript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification.  JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', '2020-06-15 11:33:11'),
(4, '.Net Framework', '.NET Framework is a software framework developed by Microsoft that runs primarily on Microsoft Windows. t includes a large class library called Framework Class Library and provides language interoperability across several programming languages', '2020-06-15 11:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_by` int(8) NOT NULL,
  `thread_id` int(8) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_by`, `thread_id`, `comment_time`) VALUES
(1, 'Hello it is easy', 0, 1, '2020-06-17 14:44:56'),
(2, 'This can fix very easily via troubleshoot', 0, 1, '2020-06-17 20:17:14'),
(3, 'This can be done via trouble shoot.', 0, 1, '2020-06-17 20:18:19'),
(4, 'You can google it simple!', 0, 1, '2020-06-17 20:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(7) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int(7) NOT NULL,
  `thread_user_id` int(7) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES
(1, 'I am unable install tensor flow', 'PHP Forum Project: Creating A Table To Store Forum Threads | PHP Tutorial #53. PHP Forum Project: Creating A TableStore Forum Threads | PHP Tutorial #53', 1, 0, '2020-06-15 16:26:47'),
(2, 'Python is not installing', 'I am unable to use previous version python', 1, 0, '2020-06-15 16:39:30'),
(3, 'I can\'t find my package in python', 'Unable to access package due to some issues.', 1, 0, '2020-06-17 11:16:03'),
(4, 'How to install python?', 'Can anyone guide me how can I get started with python', 1, 0, '2020-06-17 11:20:36'),
(5, 'How to install python?', 'Can anyone guide me how can I get started with python', 1, 0, '2020-06-17 11:21:17'),
(6, 'What is ES6', 'Anybody please tell me what is ecma script 6', 2, 0, '2020-06-17 11:27:00'),
(8, 'What is javascript?', 'is it the form of java or not?', 2, 0, '2020-06-17 14:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `time`) VALUES
(1, 'rizwan@this.com', '123', '2020-06-17 21:41:23'),
(8, 'rehan@gmail.com', '$2y$10$3fgEsTCqt713NWN8eukSveihqi1aUnbF3sRMjLNQ4qJ.hNvNFvata', '2020-06-17 21:45:54'),
(18, 'rizwan@that.com', '$2y$10$q/uw10C7ZqKmVEVdlrz4LODznGm3G0njGYOUB6g0BnDdm8ihjGOei', '2020-06-17 22:09:07'),
(19, 'kainat@that.com', '$2y$10$WsfpbGDXLjuy0wgL5hyZsePKl3Dv3Ghq3vcY0iaf3gg34XOsPJtwm', '2020-06-17 22:12:26'),
(20, 'kainat@this.com', '$2y$10$64GR0RYsOvPAvZRPMz7U/ORXo8neo1xsDeFG/8xlYN6SejtLWSnpu', '2020-06-17 22:19:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
