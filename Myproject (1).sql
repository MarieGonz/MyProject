-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2023 at 04:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `titel`) VALUES
(1, 'starters'),
(2, 'main'),
(3, 'dessert'),
(4, 'drinks');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` text NOT NULL,
  `cat_id` int(10) UNSIGNED DEFAULT NULL,
  `inactive_from` date DEFAULT NULL,
  `sorting` int(11) NOT NULL,
  `inactive` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `quantity`, `unit`, `price`, `cat_id`, `inactive_from`, `sorting`, `inactive`) VALUES
(1, 'The Shell', 'One empty shell, with salad.', 1, 'p.', '€12', 1, '2023-05-25', 1, 1),
(2, 'The filled shell', 'One filled shell, with olive oil.', 1, 'p.', '€13', 1, NULL, 2, 0),
(3, 'The Coolest Salad Mix', 'Mixed veggies salad bowl.', 1, 'p.', '€15', 2, NULL, 1, 0),
(4, 'The Coolest Meat Mix', 'Mixed meat, veggies & fries.', 1, 'p.', '€18', 2, NULL, 2, 0),
(5, 'The Apperry Sorbet', 'Apple & Berries mixed sorbet.', 1, 'p.', '€8', 3, NULL, 1, 0),
(6, 'The Lava bomb', 'Choco explosion with fresh fruits.', 1, 'p.', '€8', 3, NULL, 2, 0),
(8, 'Lemonish', 'Refreshing water with lemon and herbs.', 35, 'cl.', '€5', 4, NULL, 1, 0),
(9, 'Heaven', 'Herbal summery cocktail with lemon, ice and vodka.', 40, 'cl.', '€8', 4, NULL, 2, 0),
(11, 'Winter soup', 'veggies mix', 1, 'p.', '€ 5', 1, NULL, 1, 0),
(12, 'Fall soup', 'Pumpking soup', 1, 'p.', '€4', 1, '2023-05-22', 1, 1),
(13, 'The Apperry Sorbet', 'Apple & Berries mixed sorbet.', 1, 'p.', '€8', 3, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Marie', '$2y$10$/ouQI1PQEjPqcslIzXSa.u5vTk6pgXYMxiAklg7KD0.MsA78eii0G'),
(2, 'Julia', 'julia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
