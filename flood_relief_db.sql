-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2026 at 07:44 AM
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
-- Database: `flood_relief_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `relief_requests`
--

CREATE TABLE `relief_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `relief_type` varchar(50) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `divisional_secretariat` varchar(100) DEFAULT NULL,
  `gn_division` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `family_members` int(11) DEFAULT NULL,
  `severity_level` enum('Low','Medium','High') DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relief_requests`
--

INSERT INTO `relief_requests` (`id`, `user_id`, `relief_type`, `district`, `divisional_secretariat`, `gn_division`, `contact_person`, `contact_number`, `address`, `family_members`, `severity_level`, `description`) VALUES
(1, 1, 'Water', 'Kaluthara', 'perera', 'Bandaragama', 'Yasodara Sewmini', '0775357373', '14/A Rerukana road veedagama Bandaragama', 2, 'Medium', 'as soon as possible'),
(2, 1, 'Food,Water', 'Kandy', 'kandy', 'nuwara', 'pamidi ranushika', '0770421886', '20/12 abathale,nuwara.', 3, 'High', 'need help urgently'),
(3, 3, 'Water,Medicine,Clothes', 'Colombo', 'Colombo-North', 'Kolonnawa', 'D.S.Pathirana', '0780999655', '10/B,Flower lane, Kolonnawa', 10, 'Medium', 'A baby is in a critical condition'),
(7, 4, 'Clothes,Shelter', 'Colombo', 'kg', 'yggl', 'hui', '0123456789', 'jhkflfl', 5, 'Low', 'kvjxj');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'yasodara', 'sewminiyasodara@gmail.com', '$2y$10$f3Yiwt5pXRMONEKbeH2rn.eIs.9WFhG7PgWzZTfCg.BHABlMv.HV6', 'user'),
(2, 'admin', 'admin@gmail.com', '$2y$10$WooIAKX6yZI./VYBjxMuMO37./SX4ExX4YSBPAiyFIzVW08RgFcMG', 'admin'),
(3, 'D.S.Pathirana', 'dspathirna@gmail.com', '$2y$10$CaNbiQJ/0w2d5ZGSV6DP9uKeTF654sAgNd5q.rMkj2.O.JPBLsbhy', 'user'),
(4, 'Dammini Perera', 'damminipr@gmail.com', '$2y$10$lRj0Ivt1N959e.L4g233EeR4Ej/C/4laEGr5mofsoV07.ww//7j7m', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `relief_requests`
--
ALTER TABLE `relief_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `relief_requests`
--
ALTER TABLE `relief_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `relief_requests`
--
ALTER TABLE `relief_requests`
  ADD CONSTRAINT `relief_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
