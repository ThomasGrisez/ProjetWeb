-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 28 mars 2021 à 21:59
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
  `date` date NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id_auction`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `auction`
--

INSERT INTO `auction` (`id_auction`, `id_buyer`, `id_seller`, `id_item`, `price`, `date`, `status`) VALUES
(1, -1, 2, 20, 20, '2021-03-28', 'inprogress'),
(3, 1, 2, 26, 90, '2021-03-28', 'inprogress');

-- --------------------------------------------------------

--
-- Structure de la table `bestoffer`
--

DROP TABLE IF EXISTS `bestoffer`;
CREATE TABLE IF NOT EXISTS `bestoffer` (
  `id_bestoffer` int(11) NOT NULL AUTO_INCREMENT,
  `id_buyer` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `num_of_negotiations` int(11) NOT NULL,
  PRIMARY KEY (`id_bestoffer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `buyer`
--

INSERT INTO `buyer` (`id`, `last_name`, `first_name`, `address`, `email`, `password`) VALUES
(1, 'grisez', 'thomas', 'bougival', 'thomas.grisez@gmail.com', 1234),
(2, 'test', 'test', 'pari', 'a@a.com', 123);

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `buyitnow`
--

INSERT INTO `buyitnow` (`id_buyitnow`, `id_seller`, `id_buyer`, `price`, `status`, `id_item`, `quantity`) VALUES
(25, 2, 1, 50, 'payed', 7, 1),
(21, 2, 1, 250, 'payed', 8, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `category`, `photo1`, `photo2`, `photo3`, `video`, `quantity`, `type_of_selling`, `id_seller`) VALUES
(9, 'Short', 'Short de sport, parfait pour la course Ã  pieds', 35, 'clothe', '2-Short-1.jpg', '', '', '', 10, 'buyitnow', 2),
(8, 'Banc de musculation', 'Banc professionnel adaptÃ©e aux salles de sport ', 250, 'equipment', '2-Banc_de_musculation-1.jpg', '', '', '', 10, 'buyitnow', 2),
(7, 'Halteres 10kg', 'Halteres de musculations', 50, 'equipment', '2-Halteres_10kg-1.jpg', '', '', '', 7, 'buyitnow', 2),
(10, 'Mass Gainer', 'Optimum Nutrition, Top qualitÃ©', 30, 'complement', '2-Mass_Gainer-1.jpg', '', '', '', 10, 'buyitnow', 2),
(11, 'ABwheel', 'excellent pour les abdos', 20, 'equipment', '2-ABwheel-1.jpg', '', '', '', 10, 'buyitnow', 2),
(14, 'test', 'Halteres de musculations', 20, 'equipment', '2-test-1.jpg', '2-test-2.jpg', '2-test-3.jpg', '', 1, 'buyitnow', 2),
(20, 'Elastiques avec poignets', 'Elastiques d Ã©chauffement', 20, 'equipment', '2-Elastiques_avec_poignets-1.jpg', '', '', '', 1, 'auction', 2),
(26, 'auctiontest', 'neiuobhernt', 90, 'equipment', '2-auctiontest-1.jpg', '', '', '', 1, 'auction', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
