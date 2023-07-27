-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 06:48 PM
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
-- Database: `be19_cr4_heshamahmed_biglibrary`
--
CREATE DATABASE IF NOT EXISTS `be19_cr4_heshamahmed_biglibrary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be19_cr4_heshamahmed_biglibrary`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `ISBN` int(20) NOT NULL,
  `big_description` varchar(400) NOT NULL,
  `short_description` varchar(200) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `author_firstname` varchar(200) NOT NULL,
  `author_lastname` varchar(200) NOT NULL,
  `publisher_name` varchar(200) NOT NULL,
  `publisher_address` varchar(200) NOT NULL,
  `price` int(20) NOT NULL,
  `publish_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `used` tinyint(1) NOT NULL,
  `fk_supplierId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `picture`, `ISBN`, `big_description`, `short_description`, `categorie`, `author_firstname`, `author_lastname`, `publisher_name`, `publisher_address`, `price`, `publish_date`, `status`, `used`, `fk_supplierId`) VALUES
(113, 'PHP for Beginners - Part 1', '64c03effdefd5.webp', 31432324, 'This full-color book is packed with inspiring code examples, infographics and photography that not only teach you the PHP language and how to work with databases, but also show you how to build new applications from scratch. It demonstrates practical techniques that you will recognize from popular sites where visitors can: * Register as a member and log in * Create articles, posts and profiles tha', 'About PHP ', 'Book, Coding', 'Charlie', 'Harper', 'Codefactory', 'Kettenbrückengasse 22', 122, '1212-12-12', 1, 0, 2),
(114, 'PHP for Beginners - Part 2', '64c03f49f1959.webp', 234234, 'This full-color book is packed with inspiring code examples, infographics and photography that not only teach you the PHP language and how to work with databases, but also show you how to build new applications from scratch. It demonstrates practical techniques that you will recognize from popular sites where visitors can: * Register as a member and log in * Create articles, posts and profiles tha', 'About PHP ', 'Book, Coding', 'Alan', 'Harper', 'Codefactory', 'Kettenbrückengasse 22', 322, '1212-12-12', 1, 0, 1),
(115, 'PHP for Beginners - Part 3', '64c0400a523d8.webp', 788778, 'This full-color book is packed with inspiring code examples, infographics and photography that not only teach you the PHP language and how to work with databases, but also show you how to build new applications from scratch. It demonstrates practical techniques that you will recognize from popular sites where visitors can: * Register as a member and log in * Create articles, posts and profiles tha', 'About PHP ', 'Book, Coding', 'Alan', 'Harper', 'Codefactory', 'Kettenbrückengasse 22', 233, '1212-12-12', 1, 1, 1),
(116, 'PHP for Beginners - Part 4', '64c04066cfa4a.webp', 89498, 'This full-color book is packed with inspiring code examples, infographics and photography that not only teach you the PHP language and how to work with databases, but also show you how to build new applications from scratch. It demonstrates practical techniques that you will recognize from popular sites where visitors can: * Register as a member and log in * Create articles, posts and profiles tha', 'About PHP ', 'Book, Coding', 'Alan', 'Harper', 'Codefactory', 'Kettenbrückengasse 22', 767, '1212-12-12', 0, 0, 1),
(122, 'PHP for Professional - P3', '64c0b6a5b2d5f.webp', 34234, 'This full-color book is packed with inspiring code examples, infographics and photography that not only teach you the PHP language and how to work with databases, but also show you how to build new applications from scratch. It demonstrates practical techniques that you will recognize from popular sites where visitors can: * Register as a member and log in * Create articles, posts and profiles tha', 'About PHP ', 'Book, Coding', 'Charlie', 'Harper', 'Codefactory', 'Kettenbrückengasse 22', 22, '1222-12-12', 1, 0, 2),
(123, 'PHP for Beginners - Part 5', '64c0b6d813570.webp', 564564, 'This full-color book is packed with inspiring code examples, infographics and photography that not only teach you the PHP language and how to work with databases, but also show you how to build new applications from scratch. It demonstrates practical techniques that you will recognize from popular sites where visitors can: * Register as a member and log in * Create articles, posts and profiles tha', 'About PHP ', 'Book, Coding', 'Alan', 'Harper', 'Codefactory2', 'Kettenbrückengasse 22', 555, '2023-12-12', 0, 0, 2),
(124, 'PHP for Professional - P4', '64c0b85a67236.webp', 346457, 'This full-color book is packed with inspiring code examples, infographics and photography that not only teach you the PHP language and how to work with databases, but also show you how to build new applications from scratch. It demonstrates practical techniques that you will recognize from popular sites where visitors can: * Register as a member and log in * Create articles, posts and profiles tha', 'About PHP ', 'Book, Coding', 'Alan', 'Harper', 'Codefactory2', 'Kettenbrückengasse 22', 122, '2024-06-12', 1, 0, 2),
(130, 'PHP for Professional - P2', '64c13f50d67c7.webp', 87877887, 'BIG DESC', 'About PHP ', 'Book, Coding', 'Charlie', 'Harper', 'Codefactory', 'Kettenbrückengasse 22', 0, '0000-00-00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierId` int(11) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_email` varchar(50) DEFAULT NULL,
  `sup_website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierId`, `sup_name`, `sup_email`, `sup_website`) VALUES
(1, 'Shopy International LLC', 'shopy@mail.com', 'shopy.international.com'),
(2, 'Amazon INC', 'amazon@mail.com', 'amazon.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(4, 'Mark                 ', 'Zuckerberg                ', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1313-12-13', 'hello2@hello.com', '64c040e6a8327.jpg', 'user'),
(5, 'Elon        ', 'Musk        ', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1212-12-12', 'elonMusk@teslaCorp.com', '64c033d4531b2.jpg', 'user'),
(6, 'Charlie ', 'Harper ', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1212-12-12', 'hello4@hello.com', '64c011a487b51.jpg', 'user'),
(7, 'Bill James', 'Gates  ', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1212-12-12', 'hello5@hello.com', '64c011cc457d0.jpg', 'user'),
(11, 'Code', 'Factory', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1212-12-12', 'hello@hello.com', '64c0e9ead6825.jpg', 'adm'),
(12, 'Heinz Christian ', 'Strache ', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1212-12-12', 'hallo7@hallo.com', '64c0eababc8f6.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_supplierId` (`fk_supplierId`) USING BTREE;

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`fk_supplierId`) REFERENCES `suppliers` (`supplierId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
