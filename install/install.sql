-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2015 at 11:54 AM
-- Server version: 5.5.43-MariaDB-1ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `walletbrute`
--

-- --------------------------------------------------------

--
-- Table structure for table `wallets_found`
--

DROP TABLE IF EXISTS `wallets_found`;
CREATE TABLE IF NOT EXISTS `wallets_found` (
  `private_key` varchar(256) NOT NULL,
  `public_key` varchar(9999) NOT NULL,
  `wallet_address` varchar(256) NOT NULL,
  `dictionary_word` varchar(256) NOT NULL,
  `current_balance` decimal(11,8) NOT NULL,
  `received_bitcoins` decimal(11,8) NOT NULL,
  `last_updated` varchar(256) NOT NULL,
  `wallet_exists` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wallets_found`
--
ALTER TABLE `wallets_found`
  ADD PRIMARY KEY (`private_key`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
