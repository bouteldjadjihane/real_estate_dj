-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 juin 2023 à 14:52
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `real_estate_dj`
--

-- --------------------------------------------------------

--
-- Structure de la table `agency`
--

CREATE TABLE `agency` (
  `agency_id` int(11) NOT NULL,
  `agency_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nrc` int(20) NOT NULL,
  `city` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(20) CHARACTER SET utf8 NOT NULL,
  `logo` longtext CHARACTER SET utf8 NOT NULL DEFAULT '\'images/manger.jpg\'',
  `password` varchar(20) CHARACTER SET utf8 NOT NULL,
  `md5_pass` varchar(20) CHARACTER SET utf8 NOT NULL,
  `approved` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `agency`
--

INSERT INTO `agency` (`agency_id`, `agency_name`, `nrc`, `city`, `email`, `mobile`, `logo`, `password`, `md5_pass`, `approved`) VALUES
(2, 'hello', 23445666, 'annaba', 'bouteldjadjihane@gma', '0656454316', '\'images/manger.jpg\'', '111111', '96e79218965eb72c92a5', 0),
(3, 'jiji', 23445666, 'annaba', 'bouteldjadjihane@gma', '0656454316', '\'images/manger.jpg\'', '123456', 'e10adc3949ba59abbe56', 1),
(9, 'ahmedb', 21456987, 'aga', 'ahmed@example.com', '000-000-000', '\'images/manger.jpg\'', '123456789', '25f9e794323b453885f5', 1),
(10, 'Rahma', 23445666, 'annaba', 'bouteldjadjihane@gma', '0656454316', '\'images/manger.jpg\'', '111111', '96e79218965eb72c92a5', 1),
(12, 'Luxury', 0, '', 'bouteldjadjihane@gma', '', '\'images/manger.jpg\'', '123456', '', 1),
(13, 'amani4', 23445666, 'annaba', 'bouteldjadjihane@gmail.com', '0656454316', '\'images/manger.jpg\'', '111111', '96e79218965eb72c92a5', 1);

-- --------------------------------------------------------

--
-- Structure de la table `apply`
--

CREATE TABLE `apply` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `offer` tinyint(1) DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `expected_end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `apply`
--

INSERT INTO `apply` (`order_id`, `user_id`, `property_id`, `agency_id`, `approved`, `offer`, `order_date`, `expected_end_date`) VALUES
(50, 108, 41, 3, 1, 2, '2023-05-30 20:17:31', '2024-05-30 00:00:00'),
(67, 137, 43, 12, 1, 0, '2023-05-31 14:32:01', '2029-05-31 00:00:00'),
(72, 147, 42, 13, NULL, 3, '2023-05-31 21:24:13', '2029-05-31 00:00:00'),
(73, 150, 29, 9, 1, 3, '2023-06-01 01:42:14', '2029-06-01 00:00:00'),
(75, 152, 42, 13, NULL, 0, '2023-06-01 02:06:39', '2029-06-01 00:00:00'),
(76, 153, 42, 13, NULL, 2, '2023-06-01 02:10:39', '2024-06-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `property_id` int(11) NOT NULL,
  `full_name` char(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `appointment_date`, `property_id`, `full_name`, `phone`, `agency_id`, `completed`) VALUES
(12, '2023-07-13', 42, 'Amani', '0000000000', 3, 1),
(13, '2023-06-22', 46, 'Ahmed_bouchta', '+213 656434516', 3, NULL),
(14, '2023-06-30', 41, 'djihane bouteldja', '+213 656434516', 3, NULL),
(15, '2023-06-23', 41, 'sana salhi', '+213 657853328', 3, NULL),
(16, '2023-06-22', 46, 'Ahmed_bouchta', '+213 656434516', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `price` decimal(20,5) NOT NULL,
  `for_sale` tinyint(4) DEFAULT NULL,
  `for_rent` tinyint(4) DEFAULT NULL,
  `property_owner` int(11) DEFAULT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`property_id`, `type`, `address`, `status`, `price`, `for_sale`, `for_rent`, `property_owner`, `description`) VALUES
(28, 'apartement', 'Annaba, El Bouni 900', 'rented', '700.00000', 0, 1, 3, ' functional living space in a tranquil neighborhood. This charming apartment features an open-concept layout with ample natural light, a well-equipped kitchen, a comfortable bedroom, and a stylish bathroom. Perfect for those seeking a comfortable and convenient home in a compact size.'),
(29, 'Villa', '12 Rue des Oliviers, Alger Centre, Algiers', 'Sold', '6.00000', 1, 0, 9, ' Villa Serenity - a luxurious haven of elegance and privacy. With stunning views, spacious living areas, and top-of-the-line finishes, this villa offers the epitome of refined living.'),
(40, 'House', 'Guelma', 'rented', '333.00000', 0, 1, 9, 'none'),
(41, 'Villa', 'skikda', 'Sold', '100.50000', 1, 0, 3, 'good'),
(42, 'apartement', 'Bouza', 'available', '300.00000', 1, 0, 13, '  none'),
(43, 'office', '32 Rue Ahmed Ben Bella, Algiers, Algiers 16000, Algeria', 'available', '77.00000', 1, 0, 12, 'Office Serenity - a luxurious haven of elegance and privacy. With stunning views, spacious living areas, and top-of-the-line finishes, this villa offers the epitome of refined living'),
(44, 'apartement', '5 Rue Emir Abdelkader, Constantine, Constantine 25000, Algeria', 'rented', '9.00000', 0, 1, 3, 'Welcome to this stunning modern condominium located in the heart of the city. This spacious and tastefully designed 2-bedroom apartment offers a perfect blend of luxury and functionality. The open-concept living area boasts large windows'),
(45, 'Batiment', 'Guelma', 'rented', '5.00000', 0, 1, 3, '  nothing'),
(46, 'condo', '10 Avenue Jijel', 'rented', '70.00000', 0, 1, 3, 'The total area of the property, including the number of rooms, bedrooms, bathrooms, living areas, kitchen, etc.');

-- --------------------------------------------------------

--
-- Structure de la table `property_photos`
--

CREATE TABLE `property_photos` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `property_photos`
--

INSERT INTO `property_photos` (`id`, `property_id`, `photo`) VALUES
(4, 25, 'ap2.jpg'),
(5, 25, 'ap3.png'),
(6, 25, 'app2.jpg'),
(7, 26, 'ap2.jpg'),
(8, 26, 'ap3.png'),
(9, 26, 'app2.jpg'),
(10, 27, 'apartment-6882571_1280.jpg'),
(11, 28, 'apartment-3090517_1280.jpg'),
(12, 28, 'apartment-6882571_1280.jpg'),
(13, 28, 'bathroom-1336162_1280.jpg'),
(14, 28, 'bedroom-g21a89d4c0_1280.jpg'),
(15, 29, 'interior-2685521_1280.jpg'),
(16, 29, 'pool-5055009_1280.jpg'),
(17, 29, 'residence-2219972_1280.jpg'),
(18, 29, 'travel-1737168_1280.jpg'),
(19, 29, 'window-g97b8d0683_1280.jpg'),
(20, 30, 'single-family-home-1026371_1280.jpg'),
(21, 30, 'apartment-gbefa1f9a1_1280.jpg'),
(22, 30, 'apartment-lounge-3147892_1280.jpg'),
(23, 30, 'bathroom-1336162_1280.jpg'),
(24, 30, 'bedroom-g21a89d4c0_1280.jpg'),
(25, 31, 'single-family-home-1026371_1280.jpg'),
(26, 31, 'apartment-gbefa1f9a1_1280.jpg'),
(27, 31, 'apartment-lounge-3147892_1280.jpg'),
(28, 31, 'bathroom-1336162_1280.jpg'),
(29, 31, 'bedroom-g21a89d4c0_1280.jpg'),
(30, 32, 'single-family-home-1026371_1280.jpg'),
(31, 32, 'apartment-gbefa1f9a1_1280.jpg'),
(32, 32, 'apartment-lounge-3147892_1280.jpg'),
(33, 32, 'bathroom-1336162_1280.jpg'),
(34, 32, 'bedroom-g21a89d4c0_1280.jpg'),
(35, 33, 'single-family-home-1026371_1280.jpg'),
(36, 33, 'apartment-gbefa1f9a1_1280.jpg'),
(37, 33, 'apartment-lounge-3147892_1280.jpg'),
(38, 33, 'bathroom-1336162_1280.jpg'),
(39, 33, 'bedroom-g21a89d4c0_1280.jpg'),
(40, 34, 'single-family-home-1026371_1280.jpg'),
(41, 34, 'apartment-gbefa1f9a1_1280.jpg'),
(42, 34, 'apartment-lounge-3147892_1280.jpg'),
(43, 34, 'bathroom-1336162_1280.jpg'),
(44, 34, 'bedroom-g21a89d4c0_1280.jpg'),
(45, 35, 'living-room-g54ce31aa8_1280.jpg'),
(46, 35, 'bathroom-389262_1280.jpg'),
(47, 35, 'home-3150500_1280.jpg'),
(48, 35, 'interior-1026447_1280.jpg'),
(49, 39, 'apartment-gbefa1f9a1_1280.jpg'),
(50, 39, 'apartment-lounge-3147892_1280.jpg'),
(51, 39, 'architecture-5339245_1280.jpg'),
(52, 40, 'apartment-6882571_1280.jpg'),
(53, 40, 'apartment-gbefa1f9a1_1280.jpg'),
(54, 40, 'apartment-lounge-3147892_1280.jpg'),
(55, 40, 'architecture-5339245_1280.jpg'),
(56, 40, 'bathroom-1336162_1280.jpg'),
(57, 41, 'apartment-gbefa1f9a1_1280.jpg'),
(58, 41, 'apartment-lounge-3147892_1280.jpg'),
(59, 41, 'architecture-5339245_1280.jpg'),
(60, 41, 'home-2486092_1280.jpg'),
(61, 41, 'home-3150500_1280.jpg'),
(62, 42, 'apartment-lounge-3147892_1280.jpg'),
(63, 42, 'appartment-building-835817_1280.jpg'),
(64, 42, 'architecture-5339245_1280.jpg'),
(65, 43, 'apartment-gbefa1f9a1_1280.jpg'),
(66, 43, 'chairs-2181960_1280 (1).jpg'),
(67, 43, 'office-730681_1280.jpg'),
(68, 44, 'appartment-building-835817_1280.jpg'),
(69, 44, 'bedroom-g32b6b3890_1280.jpg'),
(70, 44, 'home-1622401_1280.jpg'),
(71, 44, 'home-1680800_1280.jpg'),
(72, 45, 'apartment-6882571_1280.jpg'),
(73, 45, 'appartment-building-835817_1280.jpg'),
(74, 45, 'architecture-5339245_1280.jpg'),
(75, 46, 'apartment-3090517_1280.jpg'),
(76, 46, 'bathroom-1228427_1280.jpg'),
(77, 46, 'bathroom-1336162_1280.jpg'),
(78, 46, 'bathroom-3563272_1280.jpg'),
(79, 46, 'chairs-2181960_1280 (1).jpg');

-- --------------------------------------------------------

--
-- Structure de la table `tenancy`
--

CREATE TABLE `tenancy` (
  `tenancy_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  `date_start` date NOT NULL DEFAULT current_timestamp(),
  `date_end` date NOT NULL,
  `approved` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tenancy`
--

INSERT INTO `tenancy` (`tenancy_id`, `user_id`, `property_id`, `date_start`, `date_end`, `approved`) VALUES
(29, 12, 40, '2023-05-30', '2023-07-31', NULL),
(31, 114, 44, '2023-05-31', '2023-08-31', 1),
(32, 115, 41, '2023-05-31', '2023-08-31', NULL),
(36, 135, 43, '2023-06-24', '2023-12-12', NULL),
(40, 144, 28, '2023-05-21', '2023-07-12', 1),
(43, 148, 46, '2023-05-01', '2023-06-05', 1),
(44, 149, 46, '2023-06-01', '2023-06-11', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `md5_pass` varchar(32) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` varchar(11) NOT NULL,
  `profile_picture` longtext NOT NULL,
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `md5_pass`, `gender`, `birthday`, `profile_picture`, `approved`) VALUES
(12, 'yacine', 'cjvfyv@gmail.com', '111111', '96e79218965eb72c92a549dd5a330112', 'male', '16-7-1998', 'pexels-photo-2379004.jpeg', 1),
(14, 'djihane_bouteldja', 'djihabebou@gmail.com', '123456789', '25f9e794323b453885f5181f1b624d0b', 'female', '9-7-2000', 'no-profile-picture-female.jpg', 1),
(41, 'ahmedb', 'ahmed@example.com', '123456789', '25f9e794323b453885f5181f1b624d0b', 'male', '2-2-1990', 'no-profile-picture.jpg', 1),
(58, 'djihane', 'bouteldjadjihane@gmail.co', '111111', '96e79218965eb72c92a549dd5a330112', 'female', '18-11-2007', 'no-profile-picture-female.jpg', 1),
(59, 'djihane_bouteldja', 'bouteldjadjihane@gmail.co', '123456', '', '', '', '', 1),
(62, 'amani_bouteldja', 'do3858068@gmail.com', '1111111', '7fa8282ad93047a4d6fe6111c93b308a', 'female', '14-9-2005', '343854641_768071031694610_6675507456635723081_n.jpg', 1),
(108, 'khaoula', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '18-4-2003', 'CHAUD_Celine-W_78-FRANCE_24-FACIES-LVMH-CALLIGARO_Sandra-V.jpg', 1),
(109, 'redoune', 'redoune@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '17-7-1994', 'no-profile-picture-female.jpg', 0),
(110, 'redoune1', 'redoune@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '16-4-2006', 'no-profile-picture.jpg', 0),
(111, 'anis_anis', 'anis@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '18-5-2008', 'no-profile-picture.jpg', 0),
(112, 'mouaad', 'mouaad@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '16-4-2007', 'no-profile-picture.jpg', 0),
(113, 'ahmed_me', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '21-2-2005', 'no-profile-picture.jpg', 0),
(114, 'hanani', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '17-2-2003', 'no-profile-picture.jpg', 0),
(115, 'abdelaziz', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '18-1-2003', 'no-profile-picture.jpg', 0),
(116, 'username', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '20-3-2004', 'no-profile-picture.jpg', 0),
(117, 'werunoutofnamse', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '18-2-2005', 'no-profile-picture.jpg', 0),
(120, 'ahmed_bouchta', 'ahmed@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '16-8-1985', 'no-profile-picture.jpg', 1),
(121, 'ahmed_bouchta1', 'ahmed@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '16-6-1990', 'no-profile-picture.jpg', 1),
(122, 'ahmed_bouchta2', 'ahmed@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '18-10-2007', 'no-profile-picture.jpg', 1),
(123, 'khadija', 'khadija@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '18-7-1982', 'no-profile-picture-female.jpg', 1),
(124, 'ikram10', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '19-11-1943', 'no-profile-picture-female.jpg', 1),
(125, 'fatima zahraa', 'fatimazahraa@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '18-11-1961', 'no-profile-picture-female.jpg', 1),
(126, 'halima', 'halima@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '18-11-1979', 'no-profile-picture-female.jpg', 1),
(128, 'rayhana', 'rayhana@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '18-11-1969', 'no-profile-picture-female.jpg', 1),
(129, 'fatifleur', 'fatifleur@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '1-2-1966', 'no-profile-picture-female.jpg', 1),
(130, 'abdelrzzak', 'abdel@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '1-3-1980', 'no-profile-picture.jpg', 1),
(131, 'jiji_jiji', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '2-4-1965', 'no-profile-picture-female.jpg', 1),
(132, 'xxxxxxxxxxx', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '3-3-2021', 'no-profile-picture.jpg', 1),
(133, 'zzzzzzzzzzzzzzz', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '18-2-2006', 'no-profile-picture.jpg', 1),
(134, 'nnnnnnnnnnnnn', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '17-5-2005', 'no-profile-picture.jpg', 1),
(135, 'qqqqqqqqq', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '19-3-2003', 'no-profile-picture.jpg', 1),
(136, 'dddddddddddd', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '18-1-2006', 'no-profile-picture.jpg', 1),
(137, 'someone', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '2-2-2019', 'no-profile-picture.jpg', 1),
(138, 'something', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '1-1-2021', 'no-profile-picture.jpg', 1),
(139, 'whoknows', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '2-3-2020', 'no-profile-picture.jpg', 1),
(140, 'whatelse', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '3-2-2012', 'no-profile-picture.jpg', 1),
(141, 'sabri sabri', 'sabri@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '10-6-1964', 'no-profile-picture.jpg', 1),
(143, 'chaima salhi', 'chaima@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '14-5-1969', 'no-profile-picture-female.jpg', 1),
(144, 'sarah sarah', 'sarah@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '11-6-1992', 'no-profile-picture-female.jpg', 1),
(145, 'kaouther', 'kaouther@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '3-7-2006', 'no-profile-picture-female.jpg', 1),
(146, 'newuser', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '2-4-1997', 'no-profile-picture.jpg', 1),
(147, 'khaoula33', 'bouteldjadjihane@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '16-6-2006', 'no-profile-picture-female.jpg', 1),
(148, 'zakaria', 'zakaria@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '30-3-1982', 'download.jpg', 1),
(149, 'kholoud', 'kholoud@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '17-7-1994', 'no-profile-picture-female.jpg', 0),
(150, 'aymeen', 'eymen@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '19-3-1972', 'photo-1506794778202-cad84cf45f1d.jpg', 1),
(151, 'yahya_yahya', 'yahya@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '17-8-1999', 'no-profile-picture.jpg', 0),
(152, 'yasmin', 'yasmin@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'female', '21-3-1983', 'no-profile-picture-female.jpg', 0),
(153, 'abdelwahhab', 'abdelwahhab@gmail.com', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'male', '17-3-1970', 'no-profile-picture.jpg', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`agency_id`);

--
-- Index pour la table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `apply_user_id_fk` (`user_id`),
  ADD KEY `apply_agency_id_fk` (`agency_id`),
  ADD KEY `apply_property_id_fk` (`property_id`);

--
-- Index pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `app_agency_id_fk` (`agency_id`),
  ADD KEY `app_property_id_fk` (`property_id`);

--
-- Index pour la table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `property_owner_fk` (`property_owner`);

--
-- Index pour la table `property_photos`
--
ALTER TABLE `property_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id_fk` (`property_id`);

--
-- Index pour la table `tenancy`
--
ALTER TABLE `tenancy`
  ADD PRIMARY KEY (`tenancy_id`),
  ADD KEY `ten_user_id_fk` (`user_id`),
  ADD KEY `ten_property_id_fk` (`property_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agency`
--
ALTER TABLE `agency`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `apply`
--
ALTER TABLE `apply`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `property_photos`
--
ALTER TABLE `property_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `tenancy`
--
ALTER TABLE `tenancy`
  MODIFY `tenancy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_agency_id_fk` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apply_property_id_fk` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apply_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `app_agency_id_fk` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `app_property_id_fk` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_owner_fk` FOREIGN KEY (`property_owner`) REFERENCES `agency` (`agency_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `property_photos`
--
ALTER TABLE `property_photos`
  ADD CONSTRAINT `property_id_fk` FOREIGN KEY (`property_id`) REFERENCES `property_photos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tenancy`
--
ALTER TABLE `tenancy`
  ADD CONSTRAINT `ten_property_id_fk` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ten_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
