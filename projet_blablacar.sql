-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 26 mai 2024 à 18:28
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_blablacar`
--

-- --------------------------------------------------------

--
-- Structure de la table `campus`
--

CREATE TABLE `campus` (
  `nom_campus` int(11) NOT NULL,
  `adresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `campus`
--

INSERT INTO `campus` (`nom_campus`, `adresse`) VALUES
(1, 'ECE Lyon'),
(2, 'ECE Paris'),
(3, 'ECE Bordeaux'),
(4, 'ECE Rennes');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ID_client` int(11) NOT NULL,
  `nom` char(50) NOT NULL,
  `Prenom` char(50) NOT NULL,
  `mail` char(50) NOT NULL,
  `MDP` char(255) NOT NULL,
  `Photo` text NOT NULL,
  `Num_Tel` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `Etat_conducteur` tinyint(1) NOT NULL,
  `permis` text NOT NULL,
  `Modele` varchar(50) NOT NULL,
  `PhotoV` text NOT NULL,
  `Plaque` varchar(10) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `preferences` varchar(255) NOT NULL,
  `cagnotte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `ID_trajet` int(11) NOT NULL,
  `ID_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `ID_trajet` int(11) NOT NULL,
  `Depart` varchar(255) NOT NULL,
  `arrivee` varchar(255) NOT NULL,
  `Distance` int(11) NOT NULL,
  `Duree` time NOT NULL,
  `Date` date NOT NULL,
  `prix` decimal(15,3) NOT NULL,
  `Nb_personne` int(11) NOT NULL,
  `sens_trajet` int(11) NOT NULL,
  `nom_campus` int(11) NOT NULL,
  `ID_conducteur` int(11) NOT NULL,
  `heuredep` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`nom_campus`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_client`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`ID_trajet`,`ID_client`),
  ADD KEY `Participe_Client1_FK` (`ID_client`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`ID_trajet`),
  ADD KEY `Trajet_Campus0_FK` (`nom_campus`),
  ADD KEY `Trajet_Conducteur1_FK` (`ID_conducteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `campus`
--
ALTER TABLE `campus`
  MODIFY `nom_campus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `ID_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `ID_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `Participe_Client1_FK` FOREIGN KEY (`ID_client`) REFERENCES `client` (`ID_client`),
  ADD CONSTRAINT `Participe_Trajet0_FK` FOREIGN KEY (`ID_trajet`) REFERENCES `trajet` (`ID_trajet`);

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `Trajet_Campus0_FK` FOREIGN KEY (`nom_campus`) REFERENCES `campus` (`nom_campus`),
  ADD CONSTRAINT `Trajet_Conducteur1_FK` FOREIGN KEY (`ID_conducteur`) REFERENCES `client` (`ID_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
