-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 05 jan. 2019 à 11:17
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mondb`
--

-- --------------------------------------------------------

--
-- Structure de la table `dps_table`
--

CREATE TABLE `dps_table` (
  `id_dps` int(11) NOT NULL,
  `date_dps` date NOT NULL,
  `imputation` varchar(50) NOT NULL,
  `num_dps` int(11) NOT NULL,
  `dps_par` enum('DTE','District Djelfa','District Ain Oussera','District Hassi Bahbah','District EL Idrissia','Distict Messaad') NOT NULL,
  `dps_vers` enum('SAG','DTE','DD') NOT NULL,
  `type_dps` enum('vehicule','prise en charge') DEFAULT NULL,
  `nom_dps` enum('kangoo','partner','doblo','total','partial') DEFAULT NULL,
  `matricule` enum('04765-115-17','01662-107-17') DEFAULT NULL,
  `objet_dps` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dps_table`
--

INSERT INTO `dps_table` (`id_dps`, `date_dps`, `imputation`, `num_dps`, `dps_par`, `dps_vers`, `type_dps`, `nom_dps`, `matricule`, `objet_dps`, `id_user`) VALUES
(2, '2018-10-22', '9284H21', 56916, 'Distict Messaad', 'SAG', 'vehicule', 'kangoo', '04765-115-17', 'changement corroie<br />\r\nchangement glicierre', 1),
(3, '2018-11-04', '9284H21', 57123, 'DTE', 'SAG', 'vehicule', 'kangoo', '01662-107-17', 'test DPS', 2),
(4, '2018-10-30', '9284H21', 56935, 'DTE', 'SAG', 'prise en charge', 'total', '01662-107-17', 'prise en charge total', 2),
(5, '2018-10-25', '9284H21', 56970, 'DTE', 'SAG', '', '', '', 'Changement de DPS', 1);

-- --------------------------------------------------------

--
-- Structure de la table `information`
--

CREATE TABLE `information` (
  `id_info` int(11) NOT NULL,
  `date_ent` date NOT NULL,
  `date_sor` date NOT NULL,
  `marque_v` enum('peugeot','renault','fiat') NOT NULL,
  `type_v` enum('partner','kangoo','doblo') NOT NULL,
  `matricule` enum('17256-107-17','18079-115-17','01478-112-17','22601-110-17') NOT NULL,
  `piece` varchar(50) DEFAULT NULL,
  `montant_p` float DEFAULT NULL,
  `numero_p` int(11) DEFAULT NULL,
  `nom_mec` varchar(50) DEFAULT NULL,
  `nom_agent` varchar(50) DEFAULT NULL,
  `com` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `information`
--

INSERT INTO `information` (`id_info`, `date_ent`, `date_sor`, `marque_v`, `type_v`, `matricule`, `piece`, `montant_p`, `numero_p`, `nom_mec`, `nom_agent`, `com`) VALUES
(1, '2018-10-03', '2018-10-16', 'peugeot', 'partner', '18079-115-17', 'roue', 100, 1501, 'med', 'hamza', 'descriptions'),
(2, '2018-10-17', '2018-10-21', 'renault', 'kangoo', '18079-115-17', 'paneau', 102.15, 1622, 'med', 'rabeh', 'descriptions 2'),
(3, '2018-10-21', '2018-10-01', 'fiat', 'doblo', '17256-107-17', 'volant', 1300, 16, 'fadi', 'hamza', 'N/A'),
(4, '2018-10-03', '2018-10-02', 'peugeot', 'partner', '22601-110-17', 'retroveseur', 1500, 13, 'med', 'helib', 'commentaire'),
(5, '2018-10-17', '2018-10-10', 'renault', 'kangoo', '18079-115-17', 'moteur', 12500.4, 1622, 'med', 'hamza', 'N/A'),
(6, '2018-10-16', '2018-10-10', 'fiat', 'doblo', '18079-115-17', 'par de prise', 16000, 15, 'morad', 'chebiri', 'commentaire'),
(8, '2018-10-24', '2018-10-03', 'renault', 'kangoo', '01478-112-17', 'suspontion', 125.01, 1632, 'morad', 'helib', 'NA'),
(9, '2018-10-24', '2018-10-03', 'renault', 'partner', '17256-107-17', '', 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`id`, `nom`, `prenom`) VALUES
(1, 'hamza', 'djennad'),
(2, 'hamza', 'djennad'),
(3, 'hamza', 'djennad');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(250) NOT NULL,
  `role_user` enum('admin','moderator','ordinary') NOT NULL,
  `pass_user` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_user`, `role_user`, `pass_user`) VALUES
(1, 'admin.admin', 'admin', '577b8eb711461da3d18b0db473fc2658'),
(2, 'user.user', 'ordinary', 'a3e9cba414a9c48e4e8f9796fd145041'),
(3, 'djennad.hamza', 'admin', '7c5c59db2ed3d91ae389d0c3a7e95a20'),
(4, 'helib.belgacem', 'ordinary', '725d47c05daddaaa4841335ffb7f7ba9');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dps_table`
--
ALTER TABLE `dps_table`
  ADD PRIMARY KEY (`id_dps`);

--
-- Index pour la table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id_info`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dps_table`
--
ALTER TABLE `dps_table`
  MODIFY `id_dps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `information`
--
ALTER TABLE `information`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
