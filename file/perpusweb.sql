-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 07:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `college_data`
--

CREATE TABLE `college_data` (
  `id` int(10) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `npsn` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `accreditation` varchar(255) NOT NULL,
  `education_form` varchar(255) NOT NULL,
  `owner_status` varchar(255) NOT NULL,
  `college_sk` varchar(255) NOT NULL,
  `sk_date` varchar(255) NOT NULL,
  `permit_sk` varchar(255) NOT NULL,
  `permit_date` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_data`
--

INSERT INTO `college_data` (`id`, `college_name`, `npsn`, `status`, `accreditation`, `education_form`, `owner_status`, `college_sk`, `sk_date`, `permit_sk`, `permit_date`, `logo`) VALUES
(1, 'SMK Fatahillah Cileungsi', '20258413', 'Private', 'Accredited A', 'Vocational High School', 'Foundation', '60/YF.01/SK/VI/2006', '6/16/2006', '421/59-Disdik', '1/13/2010', 'fatahillah.png');

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE `book_list` (
  `book_id` int(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `publish_year` varchar(255) NOT NULL,
  `index` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `stock` int(16) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`book_id`, `title`, `author`, `publisher`, `publish_year`, `index`, `location`, `stock`, `photo`) VALUES
(1, 'Talent Is Never Enough', 'John C. Maxwell', 'CV Rameda Wijaya', '2016-02-10', '6HF83JGFW', 'B4-3', 15, 'talentnever.jpg'),
(2, 'Coding Javascript', 'Andre Pratama', 'CV Rameda Wijaya', '2014-06-10', '3FER456', 'B1-1', 25, 'jsbook.jpg'),
(3, 'Indonesian Language', 'Muryani J. Semita', 'Gramedia Indonesia', '2013-06-13', 'KJ48T84T', 'B1-2', 40, 'bhsindo.jpg'),
(4, 'Children Stories', 'Andre Pratama', 'CV Rameda Wijaya', '2011-10-04', '8FH3OF35', 'B3-2', 19, 'dongeng.jpg'),
(5, 'Physics', 'Wawan Purnama', 'Gramedia Indonesia', '2016-06-03', 'ADJSGF46E5', 'B1-3', 40, 'fisika.jpg'),
(6, 'Japanese-Indonesian Dictionary', 'Najwa Kirana', 'CV Rameda Wijaya', '2017-07-05', 'NSF46IGBN7', 'B4-3', 15, 'kamusjepang.jpg'),
(7, 'German-Indonesian Dictionary', 'Travin Masyandi', 'Gramedia Indonesia', '2019-02-15', 'ADJSGF46E5', 'B3-2', 20, 'kamusjerman.jpg'),
(8, 'Database', 'Darsono', 'Gramedia Indonesia', '2018-06-03', '3FER456', 'B2-2', 25, 'bssdata.png'),
(9, 'Mathematics', 'Nanang Priatna', 'Gramedia Indonesia', '2016-02-11', 'UYYRI2423', 'B3-2', 100, 'matematika.jpg'),
(10, 'Work Work Rich', 'Andre Pratama', 'CV Rameda WijayA', '2016-02-17', '845JGOES', 'B3-1', 20, 'kerjakaya.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member_list`
--

CREATE TABLE `member_list` (
  `member_id` int(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nis` int(16) NOT NULL,
  `gender` varchar(36) NOT NULL,
  `birth_place` varchar(64) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `class` varchar(128) NOT NULL,
  `major_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_list`
--

INSERT INTO `member_list` (`member_id`, `name`, `nis`, `gender`, `birth_place`, `birth_date`, `address`, `class`, `major_name`) VALUES
(1, 'Muhammad Faqih', 312456, 'Male', 'Bekasi', '05/03/2004', 'Grand Nusa Indah', 'XI', 'Software Engineering'),
(2, 'Handito Satrio', 312456, 'Male', 'Jakarta', '01/08/2004', 'Perum Paspampres', 'XI', 'Computer and Network Engineering'),
(3, 'Ajeung Suci', 312456, 'Female', 'Jakarta', '07/05/2004', 'Desa Dayeuh', 'XI', 'Office Management Automation'),
(4, 'Muhammad Udin Mansur', 312456, 'Male', 'Bogor', '11/09/2003', 'Citra Indah City', 'XI', 'Software Engineering'),
(5, 'Indah Rahmadewi', 312456, 'Female', 'Bandung', '09/06/2004', 'Jonggolan', 'XII', 'Office Management Automation'),
(6, 'Jamaludin Akbar', 312456, 'Male', 'Bandung', '06/02/2002', 'Desa Dayueh', 'XII', 'Computer and Network Engineering'),
(7, 'Aksya Anandito', 312456, 'Male', 'Jakarta', '05/04/2004', 'Citra Indah City', 'XI', 'Software Engineering'),
(8, 'Rizky Hilmiawan', 312456, 'Male', 'Solo', '09/10/2003', 'Duta Cileungsi Kidul', 'XI', 'Software Engineering'),
(9, 'Muhamad Akmal', 312456, 'Male', 'Jakarta', '10/12/2003', 'Permata Puri Harmoni', 'XI', 'Computer and Network Engineering'),
(10, 'Gigin Permana', 312456, 'Male', 'Solo', '08/15/2004', 'Permata Puri Harmoni', 'XI', 'Software Engineering'),
(11, 'Muhammad Samsiar', 312456, 'Male', 'Bandung', '05/12/2004', 'Jalan Tunggeulis', 'XI', 'Software Engineering'),
(12, 'Siti Ubaidah', 312456, 'Female', 'Bogor', '12/24/2003', 'Duta Cileungsi Kidul', 'XII', 'Office Management Automation');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_list`
--

CREATE TABLE `borrow_list` (
  `borrow_id` int(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `borrow_date` varchar(255) NOT NULL,
  `return_date` varchar(255) NOT NULL,
  `quantity` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow_list`
--

INSERT INTO `borrow_list` (`borrow_id`, `title`, `name`, `borrow_date`, `return_date`, `quantity`) VALUES
(4, 'Children Stories', 'Ajeung Suci', '2022-07-01', '2022-07-08', 1);

--
-- Triggers `borrow_list`
--
DELIMITER $$
CREATE TRIGGER `returnBook` AFTER DELETE ON `borrow_list` FOR EACH ROW BEGIN

   UPDATE book_list SET stock = stock + 1

   WHERE title=OLD.title;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reduceStock` AFTER INSERT ON `borrow_list` FOR EACH ROW BEGIN

   UPDATE book_list SET stock = stock - 1

   WHERE title=NEW.title;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `level` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `username`, `password`, `email`, `phone`, `photo`, `level`) VALUES
('Akhmad Ridlo', 'akhmad', 'c85b5738485dae80d7d85efe9b3f2efc', 'akhmadd432@gmail.com', '+6282122941060', 'muka.jpg', 'Admin'),
('Renita Aprilia', 'renita', '2a17731826edd7111390deae84b4c604', '', '', 'renita.png', 'Supervisor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college_data`
--
ALTER TABLE `college_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `member_list`
--
ALTER TABLE `member_list`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `borrow_list`
--
ALTER TABLE `borrow_list`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `title` (`title`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college_data`
--
ALTER TABLE `college_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
  MODIFY `book_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `member_list`
--
ALTER TABLE `member_list`
  MODIFY `member_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `borrow_list`
--
ALTER TABLE `borrow_list`
  MODIFY `borrow_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
