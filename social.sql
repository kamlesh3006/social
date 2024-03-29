-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 03:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `quote` text DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `quote`, `date`, `user_id`, `datetime`) VALUES
(13, 'I am fine.', 'Jan. 12, 2024', 1, '2024-01-12 19:03:25'),
(28, 'this is my first post', 'Jan. 17, 2024', 2, '2024-01-17 20:28:37'),
(33, 'asdasdasdasd', 'Jan. 24, 2024', 1, '2024-01-24 13:30:31'),
(35, 'Heyyyyyyyyyyyyy', 'Feb. 11, 2024', 4, '2024-02-11 17:03:14'),
(36, 'okayyyy', 'Feb. 15, 2024', 1, '2024-02-15 19:48:38'),
(37, 'woof woooof', 'Feb. 19, 2024', 6, '2024-02-19 19:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reported_user` int(11) NOT NULL,
  `report_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `post_id`, `user_id`, `reported_user`, `report_data`) VALUES
(1, 30, 1, 2, 'it is irrelevant'),
(4, 29, 1, 2, 'irrelevant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT 0,
  `sec` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `user_role`, `sec`) VALUES
(1, 'Kamlesh Khatod', 'kamleshkhatod42@gmail.com', '$2y$10$3nFCFpw6Z9XVvY8TKbdjge/CIeXFiAQlTFgOzFY00VAlP3IpmqDSu', 1, ''),
(2, 'Onjal Khatod', 'onjalkhatod12@gmail.com', '$2y$10$LiFuehHhHoXsa/vL5miQzezisUUo.7sbWBS06lRkJAm4ejoBvHi0S', 0, ''),
(3, 'Admin', 'admin@admin.com', '$2y$10$oZOAaYcm.Isly7ulc0qQqeWOVgK7BedxFDMoHWHgr6QKjlXybSPkS', 2, ''),
(4, 'Rakhi Khatod', 'rakhikhatodjp@gmail.com', '$2y$10$G3R..cqyTiprMs..HeZexOxU4FksZsGjcHce9tT5BmMwKY4EsZPSy', 0, ''),
(5, 'JP', 'jpshoppy@gmail.com', '$2y$10$tmtLCX8lpduW1XvWHr4cNuOwuXAnk8hcluHaNwYtatkRRfRgid142', 0, ''),
(6, 'Happy', 'happy@gmail.com', '$2y$10$18zdpqa9B6mGMC80D55snuNOfwYkltg/cTizNbmACxrusXbqVn1.m', 0, 'bone');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
