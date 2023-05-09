-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 09:52 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `ID` int(11) NOT NULL,
  `USERID` varchar(100) NOT NULL,
  `PRODUCTID` varchar(100) NOT NULL,
  `DATEOFINSERTION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`ID`, `USERID`, `PRODUCTID`, `DATEOFINSERTION`) VALUES
(7, '13', '10', '2022-11-25 00:00:00'),
(9, '13', '8', '2022-11-25 00:00:00'),
(10, '13', '9', '2022-11-25 00:00:00'),
(11, '14', '5', '2022-11-26 00:00:00'),
(12, '14', '10', '2022-11-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `PRODUCTCODE` varchar(100) NOT NULL,
  `PRICE` float NOT NULL,
  `DATEOFWITHDRAWAL` datetime NOT NULL,
  `SELLERNAME` varchar(100) NOT NULL,
  `CATEGORY` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `NAME`, `PRODUCTCODE`, `PRICE`, `DATEOFWITHDRAWAL`, `SELLERNAME`, `CATEGORY`) VALUES
(5, 'asdfasdfasdfasdfasdfasdfasdfasdfas', 'asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasfda', 23452300, '0000-00-00 00:00:00', 'abc', 'dfasfa'),
(8, 'sadf', 'asdf', 21412300000, '0000-00-00 00:00:00', 'jack', 'dsafasdfasdfafd'),
(10, 'potion', 'potion', 50, '0000-00-00 00:00:00', 'abc', 'potions'),
(11, 'af', 'af', 54, '0000-00-00 00:00:00', 'abc', 't');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `SURNAME` varchar(50) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `ROLE` enum('ADMIN','PRODUCTSELLER','USER') NOT NULL,
  `CONFIRMED` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `NAME`, `SURNAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `ROLE`, `CONFIRMED`) VALUES
(1, 'chris', 'ioannidis', 'cioannidis', '12345', 'kitsos@mail', 'ADMIN', 1),
(4, 'abc', 'abc', 'abc', 'abc', 'abc', 'PRODUCTSELLER', 1),
(7, 'qwr', 'qwre', 'iamnotqur', 'qwre', 'qwre', 'PRODUCTSELLER', 1),
(11, 'jack', 'of all trades', 'jack', '123', 'jack', 'PRODUCTSELLER', 1),
(13, 'c', 'c', 'c', 'c', 'c', 'USER', 1),
(14, 'koorihime', '12345', 'koori', '12345', '1', 'USER', 1),
(15, '', '', '', '', '', 'ADMIN', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
