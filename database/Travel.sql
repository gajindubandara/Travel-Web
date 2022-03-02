-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2022 at 07:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`ID`, `Username`, `Password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Package` int(11) NOT NULL,
  `Start` date NOT NULL,
  `BDay` date NOT NULL,
  `Des` varchar(255) NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT '0',
  `No` int(11) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BID`, `Name`, `Package`, `Start`, `BDay`, `Des`, `Status`, `No`, `Total`) VALUES
(23, '10', 66, '2022-03-17', '2022-02-28', '', '3', 3, 18000),
(24, '10', 73, '2022-03-16', '2022-02-28', '', '1', 6, 42000),
(25, '10', 72, '2022-04-13', '2022-02-28', '', '0', 16, 80000),
(26, '11', 75, '2022-03-24', '2022-02-28', '', '0', 5, 40000),
(27, '11', 68, '2022-03-23', '2022-02-28', '', '0', 6, 54000),
(28, '12', 76, '2022-03-24', '2022-02-28', '', '0', 3, 36000),
(29, '12', 74, '2022-03-23', '2022-02-28', '', '0', 5, 40000),
(30, '12', 67, '2022-03-24', '2022-02-28', '', '1', 7, 56000),
(33, '13', 73, '2022-05-19', '2022-02-28', '', '2', 11, 77000),
(34, '14', 68, '2022-03-25', '2022-02-28', '', '3', 6, 54000),
(36, '14', 76, '2022-04-15', '2022-02-28', '', '0', 9, 108000),
(37, '15', 62, '2022-03-11', '2022-02-28', '', '0', 2, 20000),
(38, '15', 67, '2022-03-23', '2022-02-28', 'We are so excited to go on this tour :)', '2', 9, 72000),
(39, '16', 62, '2022-03-24', '2022-02-28', '', '0', 4, 40000),
(40, '17', 74, '2022-05-20', '2022-02-28', '', '0', 6, 48000),
(41, '18', 73, '2022-03-16', '2022-02-28', '', '0', 10, 70000),
(42, '19', 76, '2022-04-21', '2022-02-28', '', '0', 12, 144000),
(43, '23', 76, '2022-03-25', '2022-02-28', '', '0', 5, 60000),
(44, '10', 67, '2022-03-18', '2022-02-28', '', '2', 2, 16000),
(45, '10', 62, '2022-03-17', '2022-03-02', '', '0', 3, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Img` varchar(200) NOT NULL,
  `Des` varchar(255) NOT NULL,
  `Acc` varchar(255) NOT NULL,
  `Food` varchar(255) NOT NULL,
  `Transport` varchar(255) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`ID`, `Name`, `Img`, `Des`, `Acc`, `Food`, `Transport`, `Price`, `Time`) VALUES
(62, 'Pilgrimage Tour - Anuradhapura', 'packageImages/62.jpg', 'This is a perfect tour for those who wish to visit all the religious places in Anuradhapura city\r\n', 'Anuradhapura City Hotel (Full board)', 'Buffet', 'Tourist Bus', '10000', '4 Days 3 Nights'),
(66, 'City Tour - Galle ', 'packageImages/66.jpg', 'A perfect tour to experience the coastal side of Sri Lanka', 'Galle Beach View Hotel (Full Board)', 'Buffet', 'Tourist Bus', '6000', '2 Days 1 Night'),
(67, 'Whale Watching - Mirissa ', 'packageImages/67.jpg', 'It\'s a really wonderful and unforgettable trip of whale watching in the southern sea of the island ', 'Not Applicable', 'Sea Food Meal', 'Tourist Bus & Tourist Boats', '8000', '1 Day'),
(68, 'National Park Safari - Yala ', 'packageImages/68.jpg\r\n', 'We take you through hotpots for watching elephants and other wild animals in their natural habitats', 'Not Applicable', 'Buffet from the Yala City Resort', ' Tourist Bus & Safari Jeeps', '9000', '1 Day'),
(71, 'City Tour - Nuwara Eliya', 'packageImages/71.jpg', 'Let\'s visit Horton plains, Gregory lake, Sita temple, and lover\'s leap which are some of the top attractions in Nuwara Eliya', 'Nuwara Eliya city hotel (Full board)', 'Buffet', 'Tourist Bus', '10000', '3 Days 2 Nights'),
(72, 'Sigiriya Fortress - Matale', './packageImages/72.jpg', 'A perfect tour to watch Sigiriya which is a rock fortress and a palace located in the Matale district of Sri Lanka.', ' Not Applicable', 'Food packs (vegetable, chicken, fish)', 'Tourist Bus', '5000', '1 Day'),
(73, 'Bird Sanctuary - Hambantota ', 'packageImages/73.jpg', 'Great tour for the bird lovers to watch birds from all around the world', ' Not Applicable', 'Food packs (vegetable, chicken, fish)', 'Tourist BUs', '7000', '1 Day'),
(74, 'Camping - Knuckles ', 'packageImages/74.jpg', 'Superb camping experience in the Knuckles mountain range', 'Camping tents', 'Night - BBQ  & Garlic Bread\r\nMorning - Noodles', 'Tourist Bus & rest of the tour will be on foot to the summit of the mountain', '8000', '2 Days 1 Night'),
(75, 'Turtle Hatching - Mirissa', 'packageImages/75.jpg', 'Get new experience about turtles by visiting the turtle hatchery centers in Mirissa', 'Not Applicable', 'Seafood meal', 'Tourist Bus', '8000', '1 Day'),
(76, 'City Tour - Colombo', './packageImages/76.jpg', 'Get a new experience about Colombo city by visiting all the attractive places', 'Colombo City Hotel (Full Board)', 'Buffet', 'Tourist Bus', '12000', '2 Days 1 Night');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `No` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Day` date NOT NULL,
  `Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `Name`, `No`, `Email`, `Username`, `Password`, `Day`, `Address`) VALUES
(10, 'Ben Tennyson ', '9544659333', 'ben10@gmail.com', 'ben10', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '3677 West Fork Drive Deerfield Beach, FL 33442'),
(11, 'Amelia Scott', '9088299367', 'amelia@gmail.com', 'scott_00', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '995 Beechwood Avenue Weehawken, NJ 07087'),
(12, 'Angelica Chambers', '9739839156', 'angelica@gmail.com', 'ang22', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '181 Hudson Street Denville, NJ 07866'),
(13, 'Adam Hoffman', '7182244330', 'adam@gmail.com', 'adam_ho', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '2834 Alfred Drive Bayside, NY 11361'),
(14, 'Patrick Ferris', '1236547890', 'pat@gmail.com', 'PatFerris', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '800 New Street Eugene, OR 97401'),
(15, 'Dustin Lawrence', '5018640431', 'dustin@gmail.com', 'dustin66', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '4165 Dawson Drive Little Rock, AR 72211'),
(16, 'Timothy Greer', '3019916230', 'tim@gmail.com', 'tim', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '2611 Lake Floyd Circle Hagerstown, MD 21740'),
(17, 'Ivan Balderrama', '7732950453', 'ivan@gmail.com', 'ivan_b', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '2761 Oakmound Road Chicago, IL 60661'),
(18, 'Oscar Dendy', '6202341324', 'oscar@gmail.com', 'oscar', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '4630 Roosevelt Road Stafford, KS 67578'),
(19, 'William Marshall', '9365673582', 'will@gmail.com', 'will', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '2490 Mulberry Street Houston, TX 77006'),
(23, 'Mark Yates', '6514056768', 'mark@gmail.com', 'mark42', '5d41402abc4b2a76b9719d911017c592', '2022-02-28', '4508 Bryan Avenue Eagan, MN 55121');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BID`),
  ADD KEY `FK_pack` (`Package`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `FK_pack` FOREIGN KEY (`Package`) REFERENCES `packages` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
