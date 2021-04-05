-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 avr. 2021 à 16:19
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fitnet`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrator`
--

INSERT INTO `administrator` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `auction`
--

DROP TABLE IF EXISTS `auction`;
CREATE TABLE IF NOT EXISTS `auction` (
  `id_auction` int(11) NOT NULL AUTO_INCREMENT,
  `id_buyer` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `secondbestprice` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id_auction`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `auction`
--

INSERT INTO `auction` (`id_auction`, `id_buyer`, `id_seller`, `id_item`, `price`, `secondbestprice`, `date`, `status`) VALUES
(12, -1, 2, 51, 15, 15, '2021-04-05', 'inprogress');

-- --------------------------------------------------------

--
-- Structure de la table `bestoffer`
--

DROP TABLE IF EXISTS `bestoffer`;
CREATE TABLE IF NOT EXISTS `bestoffer` (
  `id_bestoffer` int(11) NOT NULL AUTO_INCREMENT,
  `id_buyer` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `num_of_negotiations` int(11) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id_bestoffer`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bestoffer`
--

INSERT INTO `bestoffer` (`id_bestoffer`, `id_buyer`, `id_seller`, `id_item`, `price`, `num_of_negotiations`, `status`) VALUES
(4, -1, 2, 45, 250, 0, 'inprogress');

-- --------------------------------------------------------

--
-- Structure de la table `buyer`
--

DROP TABLE IF EXISTS `buyer`;
CREATE TABLE IF NOT EXISTS `buyer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` text NOT NULL,
  `first_name` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `password` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `buyer`
--

INSERT INTO `buyer` (`id`, `last_name`, `first_name`, `address`, `email`, `password`) VALUES
(1, 'Grisez', 'Thomas', 'Bougival', 'thomas.grisez@gmail.com', 1234);

-- --------------------------------------------------------

--
-- Structure de la table `buyitnow`
--

DROP TABLE IF EXISTS `buyitnow`;
CREATE TABLE IF NOT EXISTS `buyitnow` (
  `id_buyitnow` int(11) NOT NULL AUTO_INCREMENT,
  `id_seller` int(11) NOT NULL,
  `id_buyer` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` text NOT NULL,
  `id_item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id_buyitnow`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category` text NOT NULL,
  `photo1` text NOT NULL,
  `photo2` text NOT NULL,
  `photo3` text NOT NULL,
  `video` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `type_of_selling` text NOT NULL,
  `id_seller` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `category`, `photo1`, `photo2`, `photo3`, `video`, `quantity`, `type_of_selling`, `id_seller`) VALUES
(48, 'Light Cookie', 'Delicious high-protein cookie, ideal for a snack on the go', 15, 'complement', '2-Light_Cookie-1.jpg', '2-Light_Cookie-2.jpg', '2-Light_Cookie-3.jpg', '', 10, 'buyitnow', 2),
(47, 'Weight Gainer', 'This super supplement contains 31g of protein, 50g of carbohydrates and a total of 388 calories per serving: the perfect combo to help you gain mass while promoting recovery after intense exercise.', 18, 'complement', '2-Weight_Gainer-1.jpg', '2-Weight_Gainer-2.jpg', '', '', 15, 'buyitnow', 2),
(46, 'Hexagonal dumbbell 30 kg', 'Its hexagonal shape stops it from rolling on the ground (6 anti-roll sides). Its durable and resistant rubber coating protects from shocks and minimises noise. Ergonomic chrome-plated handle with non-slip area for a perfect grip. Ideal for private and professional use. Sold by unit.', 100, 'equipment', '2-Hexagonal_dumbbell_30_kg-1.jpg', '', '', '', 10, 'buyitnow', 2),
(45, 'Training Bench', 'This professional bench boasts a refined backrest to respect the biomechanical movements of the body during basic weight training exercises with dumbbells or barbell. 2 integrated wheels for easy movement. 7 backret positions with inclination angles from 0 to 90Â°.  Assembly instructions and set of screws provided.', 250, 'equipment', '2-Training_Bench-1.jpg', '2-Training_Bench-2.jpg', '', '', 1, 'bestoffer', 2),
(44, 'Half Rack', 'Cage designed for home training. Its small size will allow you to optimize the space for your home training area. Its solid design ensures stability and safety during training. The spotters can be adjusted to different heights for a complete workout. The bar supports can be set very high (ideal for squats).  Assembly instructions and screw set included.', 290, 'equipment', '2-Half_Rack-1.jpg', '2-Half_Rack-2.jpg', '2-Half_Rack-3.jpg', '', 1, 'buyitnow', 2),
(49, 'Chalk Tank', 'In the Chalk Tank, thereâ€™s no rep too far and no set too sweaty. Weâ€™ve mixed performance technology with authentic bodybuilding silhouettes, to create a product for the new era of lifter. A airy fit and unrestrictive cut-off sleeves, along with breathable mesh and sweat-wicking capabilities to the front, ensure youâ€™ll always feel light and fresh, no matter how heavy the weight.', 25, 'clothe', '2-Chalk_Tank-1.jpg', '2-Chalk_Tank-2.jpg', '2-Chalk_Tank-3.jpg', '', 100, 'buyitnow', 2),
(50, 'City Joggers', 'Move with ease anywhere you please in the CTY Joggers. A regular fit and double waistband keep you comfortable, whilst cuffed drawcord ankles add extra style points. Wear this staple piece on the go during your active rest days.', 40, 'clothe', '2-City_Joggers-1.jpg', '2-City_Joggers-2.jpg', '2-City_Joggers-3.jpg', '', 100, 'buyitnow', 2),
(51, 'Heavy Resistance Band', 'The Heavy Reistance Band offers a challenging resistance without all the equipment, making it easy to take your leg training with you anywhere. Alternatively, up the ante by adding it into your next weight session.', 15, 'equipment', '2-HEAVY_RESISTANCE_BAND-1.jpg', '2-HEAVY_RESISTANCE_BAND-2.jpg', '', '', 1, 'auction', 2);

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` text NOT NULL,
  `first_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `photo` text NOT NULL,
  `favorite_background` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `seller`
--

INSERT INTO `seller` (`id`, `last_name`, `first_name`, `email`, `password`, `photo`, `favorite_background`) VALUES
(1, 'Gautier', 'Thibault', 'thibault.gautier@edu.ece.fr', '1234', 'default.jpg', ''),
(2, 'Grisez', 'Thomas', 'thomas.grisez@edu.ece.fr', '1234', 'ID=2_60608a89492229.21754342.jpg', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
