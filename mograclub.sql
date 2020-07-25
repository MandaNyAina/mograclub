-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 25 juil. 2020 à 22:33
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `random-game`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_complaint`
--

CREATE TABLE `t_complaint` (
  `id` int(11) NOT NULL,
  `ticket_id` varchar(15) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `id_user` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `message_type` varchar(255) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `solved` tinyint(1) NOT NULL,
  `date_sender` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_order`
--

CREATE TABLE `t_order` (
  `numOrder` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_winning` float DEFAULT NULL,
  `selected` varchar(255) NOT NULL,
  `type` varchar(2) NOT NULL,
  `is_win` tinyint(1) NOT NULL,
  `id_winner_period` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `converted` tinyint(1) DEFAULT NULL,
  `groups` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_params`
--

CREATE TABLE `t_params` (
  `id` int(11) NOT NULL,
  `paypalAccount` varchar(255) NOT NULL,
  `paypalPassword` varchar(255) NOT NULL,
  `gpayAccount` varchar(255) NOT NULL,
  `gpayPassword` varchar(255) NOT NULL,
  `defaults` varchar(255) NOT NULL,
  `wallet` float NOT NULL,
  `wallet_profit` float NOT NULL,
  `nbr_winner` int(11) NOT NULL,
  `AGATE` varchar(255) DEFAULT NULL,
  `BERYL` varchar(255) DEFAULT NULL,
  `CELESTINE` varchar(255) DEFAULT NULL,
  `DIAMOND` varchar(255) DEFAULT NULL,
  `EMERALD` varchar(255) DEFAULT NULL,
  `FLINT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_params`
--

INSERT INTO `t_params` (`id`, `paypalAccount`, `paypalPassword`, `gpayAccount`, `gpayPassword`, `defaults`, `wallet`, `wallet_profit`, `nbr_winner`, `AGATE`, `BERYL`, `CELESTINE`, `DIAMOND`, `EMERALD`, `FLINT`) VALUES
(1, 'roe0aVIU5I08F6RYuN0X', 'roe0aVI1/YIk', 'roe0aVIU85wkHutZ8Q==', 'roe0aVI1/YIk', 'paypal', 35, 107, 0, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `t_recharge`
--

CREATE TABLE `t_recharge` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_redenvelop`
--

CREATE TABLE `t_redenvelop` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `send_value` float DEFAULT NULL,
  `received_value` float DEFAULT NULL,
  `order_type` varchar(1) NOT NULL,
  `used` tinyint(1) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_rel_promotion`
--

CREATE TABLE `t_rel_promotion` (
  `id` int(11) NOT NULL,
  `t_user_property` varchar(50) NOT NULL,
  `t_user_rel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_reward`
--

CREATE TABLE `t_reward` (
  `id` int(11) NOT NULL,
  `id_para` varchar(50) NOT NULL,
  `nbr_pers` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `active` int(11) NOT NULL,
  `contribution` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_reward`
--

INSERT INTO `t_reward` (`id`, `id_para`, `nbr_pers`, `id_user`, `active`, `contribution`) VALUES
(1, '20200720AXDM', 0, 'LF9eL9e33qLFq9933SSkSqFLLq9YFxk9YSq33SYL3eY9q9k993', 0, 0),
(2, '20200720AXDL', 0, 'S39FSSLFkLqeqL33LqeL9YYYkkqYLYL9kekeexSFS39qxx3Y33', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_task`
--

CREATE TABLE `t_task` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `objectif` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `stop_date` date DEFAULT NULL,
  `get_date` date DEFAULT NULL,
  `price` float NOT NULL,
  `number_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_task`
--

INSERT INTO `t_task` (`id`, `name`, `objectif`, `start_date`, `stop_date`, `get_date`, `price`, `number_ref`) VALUES
(3, '5 referrals to recharge and complete the transaction', NULL, '2020-07-22', '2020-07-23', '2020-07-22', 500, 5),
(4, '10 referrals to recharge and complete the transaction', NULL, '2020-07-22', '2020-07-23', '2020-07-22', 1000, 10),
(5, '30 referral to recharge and complete the transaction', NULL, '2020-07-22', '2020-07-23', '2020-07-22', 3000, 30),
(6, '50 referrals to recharge and complete the transaction', NULL, '2020-07-22', '2020-07-23', '2020-07-22', 5000, 50),
(8, '500 referrals to recharge and complete the transaction', NULL, '2020-07-22', '2020-07-23', '2020-07-31', 50000, 500);

-- --------------------------------------------------------

--
-- Structure de la table `t_task_user`
--

CREATE TABLE `t_task_user` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_task` int(11) NOT NULL,
  `finish` int(11) NOT NULL,
  `is_finish` tinyint(1) NOT NULL,
  `key_task` varchar(50) NOT NULL,
  `id_associate` varchar(255) DEFAULT NULL,
  `date_finish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `id` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `type`, `active`) VALUES
('9xeqx9e9FSF9eeSS9L3q9qqSFY9Lex9FkYSSS99SqFLkqe3xY3', 'user', '$2y$10$v7pFpSaarSVdwAfvD1B8N.BouycEyQCiqiooexyblTKi7CFCNb5kG', NULL, 1),
('q99exLq999x9LqkxSx9LFxY39S33kLYFkxqqq3k3YeFqFF93Lk', 'admin', '$2y$10$YYbixpXLc.juoT.FkhlIF.EZVnQU4NgDh8Pg.God8pBCDHoRpO99e', 'ADMIN', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_user_bank`
--

CREATE TABLE `t_user_bank` (
  `id` varchar(50) NOT NULL,
  `beneId` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ifsc` varchar(255) NOT NULL,
  `bankAccount` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_user_info`
--

CREATE TABLE `t_user_info` (
  `id` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `id_login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_user_info`
--

INSERT INTO `t_user_info` (`id`, `first_name`, `last_name`, `phone`, `mail`, `active`, `code`, `address`, `id_login`) VALUES
('LF9eL9e33qLFq9933SSkSqFLLq9YFxk9YSq33SYL3eY9q9k993', 'Admininstrator', 'Admin', '9442836155', 'service@mogra.club', 1, 'xkYYY', 'India', 'q99exLq999x9LqkxSx9LFxY39S33kLYFkxqqq3k3YeFqFF93Lk'),
('S39FSSLFkLqeqL33LqeL9YYYkkqYLYL9kekeexSFS39qxx3Y33', 'user test', 'test', '00000000', 'qmodgerjilkpbnnymk@awdrt.net', 1, 'L9qYx', 'Address test', '9xeqx9e9FSF9eeSS9L3q9qqSFY9Lex9FkYSSS99SqFLkqe3xY3');

-- --------------------------------------------------------

--
-- Structure de la table `t_user_params`
--

CREATE TABLE `t_user_params` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `balance` float NOT NULL,
  `bonus` float NOT NULL,
  `first_pay` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_user_params`
--

INSERT INTO `t_user_params` (`id`, `id_user`, `balance`, `bonus`, `first_pay`) VALUES
(1, 'LF9eL9e33qLFq9933SSkSqFLLq9YFxk9YSq33SYL3eY9q9k993', 35, 0, 1),
(3, 'S39FSSLFkLqeqL33LqeL9YYYkkqYLYL9kekeexSFS39qxx3Y33', 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_winner`
--

CREATE TABLE `t_winner` (
  `id` int(11) NOT NULL,
  `period` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `number` int(11) NOT NULL,
  `result` varchar(255) NOT NULL,
  `groups` varchar(255) NOT NULL,
  `showing` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_complaint`
--
ALTER TABLE `t_complaint`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`numOrder`);

--
-- Index pour la table `t_params`
--
ALTER TABLE `t_params`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_recharge`
--
ALTER TABLE `t_recharge`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_redenvelop`
--
ALTER TABLE `t_redenvelop`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_rel_promotion`
--
ALTER TABLE `t_rel_promotion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_reward`
--
ALTER TABLE `t_reward`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `t_task`
--
ALTER TABLE `t_task`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_task_user`
--
ALTER TABLE `t_task_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `t_user_bank`
--
ALTER TABLE `t_user_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_bank` (`id_user`);

--
-- Index pour la table `t_user_info`
--
ALTER TABLE `t_user_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_login` (`id_login`);

--
-- Index pour la table `t_user_params`
--
ALTER TABLE `t_user_params`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_balance` (`id_user`);

--
-- Index pour la table `t_winner`
--
ALTER TABLE `t_winner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_complaint`
--
ALTER TABLE `t_complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_params`
--
ALTER TABLE `t_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_recharge`
--
ALTER TABLE `t_recharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_redenvelop`
--
ALTER TABLE `t_redenvelop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_rel_promotion`
--
ALTER TABLE `t_rel_promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_reward`
--
ALTER TABLE `t_reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `t_task`
--
ALTER TABLE `t_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `t_task_user`
--
ALTER TABLE `t_task_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_user_params`
--
ALTER TABLE `t_user_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `t_winner`
--
ALTER TABLE `t_winner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_reward`
--
ALTER TABLE `t_reward`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `t_user_info` (`id`);

--
-- Contraintes pour la table `t_user_bank`
--
ALTER TABLE `t_user_bank`
  ADD CONSTRAINT `id_user_bank` FOREIGN KEY (`id_user`) REFERENCES `t_user_info` (`id`);

--
-- Contraintes pour la table `t_user_info`
--
ALTER TABLE `t_user_info`
  ADD CONSTRAINT `id_user_login` FOREIGN KEY (`id_login`) REFERENCES `t_user` (`id`);

--
-- Contraintes pour la table `t_user_params`
--
ALTER TABLE `t_user_params`
  ADD CONSTRAINT `id_user_balance` FOREIGN KEY (`id_user`) REFERENCES `t_user_info` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
