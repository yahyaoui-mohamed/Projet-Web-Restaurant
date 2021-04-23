-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2021 at 09:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(20) NOT NULL,
  `food_price` int(11) NOT NULL,
  `food_description` varchar(200) NOT NULL,
  `food_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_price`, `food_description`, `food_img`) VALUES
(1, 'Hamburger', 5, 'Making a reservation at Délicious restaurant is easy and takes just a couple of minutes.', 'food\\hamburger.jpg'),
(2, 'Sandwich', 8, 'Making a reservation at Délicious restaurant is easy and takes just a couple of minutes.', 'food\\sandwich.jpg'),
(3, 'Steak', 4, 'Making a reservation at Délicious restaurant is easy and takes just a couple of minutes.', 'food\\steak.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservetable`
--

CREATE TABLE `reservetable` (
  `id` int(11) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `tel` varchar(8) NOT NULL,
  `nbr_personne` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservetable`
--

INSERT INTO `reservetable` (`id`, `nom`, `prenom`, `tel`, `nbr_personne`, `date`) VALUES
(1, 'Yahyaoui', 'yahyaouui', '55048804', 5, '2021-04-29'),
(2, 'ala', 'yahyaouui', '55048804', 5, '2021-04-22'),
(3, 'ala', 'yahyaoui', '55048804', 555, '2021-04-23'),
(4, 'Yahyaoui', 'med', '55048804', 2, '2021-04-22'),
(5, 'Yahyaoui', 'med', '55048804', 2, '2021-04-22'),
(6, 'Yahyaoui', 'med', '55048804', 2, '2021-04-22'),
(7, 'Yahyaoui', 'mohaled', '55048804', 5, '2021-04-13'),
(8, 'ahmde', 'amine', '47854785', 54, '2021-04-30'),
(9, 'jamil', 'hedi', '22014521', 5, '2021-04-14'),
(10, 'eteat', 'aeteat', '52486320', 7, '2021-05-08'),
(11, 'Yahyaoui', 'khouloud', '55478547', 3, '2021-04-22'),
(12, 'aziz', 'hamed', '85478545', 3, '2021-04-16'),
(13, 'ala', 'med', '55048804', 4, '2021-04-08'),
(14, 'aet', 'aeteataet', 'aet', 4, '2021-04-09'),
(15, 'ala', 'yahyaouui', '55048804', 7, '2021-04-29'),
(16, 'Yahyaoui', 'med', '47854785', 2, '2021-04-08'),
(17, 'Yahyaoui', 'yahyaouui', '47854785', -1, '2021-04-05'),
(18, 'mohamed', 'yahyaouui', '55048804', 4, '2021-04-09'),
(19, 'Yahyaoui', 'med', '47854785', 2, '2021-04-14'),
(20, 'zzz', 'zzz', '55048804', 2, '2021-04-14'),
(21, 'ala', 'med', '55048804', 2, '2021-04-09'),
(22, 'aezraeraetae', '', '', 0, '0000-00-00'),
(23, 'eeagqf', 'qdgqdg', '25874524', 4, '2021-04-16'),
(24, 'zry', 'zry', '75874524', 5, '2021-04-20'),
(25, 'aeteat', 'aet', '45212541', 2, '2021-04-30'),
(26, 'aet', 'aet', '47854521', 4, '2021-04-06'),
(27, 'zetg', 'zrg', '21548795', 8, '2021-04-21'),
(28, 'zrt', 'zrt', '64587932', 5, '2021-04-15'),
(29, 'ezfs', 'dgfgb', '25417852', 3, '2021-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `tel` varchar(8) NOT NULL,
  `profile_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `mdp`, `tel`, `profile_image`) VALUES
(1, 'Yahyaoui', 'Mohamed Alaa', 'med@med.com', '1234', '', 'img/users/5.jpg'),
(2, 'mohamed', 'yahyaoui', 'ala@ala.com', '123', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `reservetable`
--
ALTER TABLE `reservetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservetable`
--
ALTER TABLE `reservetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
