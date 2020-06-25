-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 25 juin 2020 à 20:21
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `codflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

CREATE TABLE `episode`
(
    `id`       int(11)      NOT NULL,
    `serie_id` int(11)      NOT NULL,
    `saison`   int(11)      NOT NULL,
    `episode`  int(11)      NOT NULL,
    `name`     varchar(254) NOT NULL,
    `url`      varchar(100) NOT NULL,
    `time`     time         NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Déchargement des données de la table `episode`
--

INSERT INTO `episode` (`id`, `serie_id`, `saison`, `episode`, `name`, `url`, `time`)
VALUES (1, 4, 1, 1, 'DBZ 1', 'https://www.youtube.com/embed/EkTM3960pt8', '00:20:00'),
       (2, 4, 1, 2, 'DBZ 2', 'https://www.youtube.com/embed/L-iGOHfX-wg', '00:20:00'),
       (3, 4, 1, 3, 'DBZ 3', 'https://www.youtube.com/embed/8iib5U3l_NE', '00:20:00'),
       (4, 4, 1, 4, 'DBZ 4', 'https://www.youtube.com/embed/PtUhjyZIaHA', '00:23:00'),
       (5, 4, 1, 5, 'DBZ 5', 'https://www.youtube.com/embed/-uj5YrX32rA', '00:20:00'),
       (6, 4, 1, 6, 'DBZ 6', 'https://www.youtube.com/embed/SwBCZ4u_P5Y', '00:22:00'),
       (7, 4, 1, 7, 'DBZ 7', 'https://www.youtube.com/embed/Pzk7Vza9yzs', '00:20:00'),
       (8, 4, 1, 8, 'DBZ 8', 'https://www.youtube.com/embed/UZJR_uDGils', '00:21:00'),
       (9, 4, 2, 1, ' DBZ 1', 'https://www.youtube.com/embed/Wpfz1uan4Rs', '00:20:30'),
       (10, 4, 3, 1, 'DBZ 1', 'https://www.youtube.com/embed/063Pzii3bqk', '00:20:50'),
       (11, 4, 2, 2, 'DBZ 2', 'https://www.youtube.com/embed/4DZX4ys6H1U', '00:20:00'),
       (12, 4, 2, 3, 'DBZ 3', 'https://www.youtube.com/embed/mxHDJF1yKP4', '00:20:40'),
       (13, 4, 2, 4, 'DBZ 4', 'https://www.youtube.com/embed/jTJql8Yhd8s', '00:20:00');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre`
(
    `id`   int(11)     NOT NULL,
    `name` varchar(50) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`)
VALUES (1, 'Action'),
       (2, 'Horreur'),
       (3, 'Science-Fiction'),
       (4, 'Humour');

-- --------------------------------------------------------

--
-- Structure de la table `history_episode`
--

CREATE TABLE `history_episode`
(
    `id`             int(11)    NOT NULL,
    `user_id`        int(11)    NOT NULL,
    `media_id`       int(11)    NOT NULL,
    `episode_id`     int(11)    NOT NULL,
    `start_date`     tinyint(1) NOT NULL DEFAULT 0,
    `finish_date`    tinyint(1) NOT NULL DEFAULT 0,
    `watch_duration` int(11)    NOT NULL DEFAULT 0 COMMENT 'in seconds'
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `history_episode`
--

INSERT INTO `history_episode` (`id`, `user_id`, `media_id`, `episode_id`, `start_date`, `finish_date`, `watch_duration`)
VALUES (9, 3, 4, 3, 0, 0, 0),
       (11, 3, 4, 7, 0, 0, 0),
       (13, 2, 4, 6, 0, 0, 0),
       (14, 2, 4, 1, 0, 0, 0),
       (15, 3, 4, 2, 0, 0, 0),
       (104, 1, 4, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `history_media`
--

CREATE TABLE `history_media`
(
    `id`             int(11)    NOT NULL,
    `user_id`        int(11)    NOT NULL,
    `media_id`       int(11)    NOT NULL,
    `start_date`     tinyint(1) NOT NULL DEFAULT 0,
    `finish_date`    tinyint(1) NOT NULL DEFAULT 0,
    `watch_duration` int(11)    NOT NULL DEFAULT 0 COMMENT 'in seconds'
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `history_media`
--

INSERT INTO `history_media` (`id`, `user_id`, `media_id`, `start_date`, `finish_date`, `watch_duration`)
VALUES (8, 3, 3, 0, 0, 0),
       (10, 3, 1, 0, 0, 0),
       (11, 2, 3, 0, 0, 0),
       (12, 3, 3, 0, 0, 0),
       (37, 1, 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media`
(
    `id`           int(11)      NOT NULL,
    `genre_id`     int(11)      NOT NULL,
    `title`        varchar(100) NOT NULL,
    `type`         varchar(20)  NOT NULL,
    `status`       varchar(20)  NOT NULL,
    `release_date` date         NOT NULL,
    `summary`      longtext     NOT NULL,
    `trailer_url`  varchar(100) NOT NULL,
    `url`          varchar(100) NOT NULL,
    `time`         time         NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `release_date`, `summary`, `trailer_url`, `url`,
                     `time`)
VALUES (1, 1, 'Lord of the ring', 'Film', 'Média publié', '1990-10-30',
        ' Le Seigneur des anneaux (The Lord of the Rings) est un roman en trois volumes de J. R. R. Tolkien paru en 1954 et 1955.\nPrenant place dans le monde de fiction de la Terre du Milieu, il suit la quête du hobbit Frodo Bessac, qui doit détruire l\'Anneau unique afin que celui-ci ne tombe pas entre les mains de Sauron, le Seigneur des ténèbres. Plusieurs personnages lui viennent en aide, parmi lesquels son serviteur Sam, le mage Gandalf ou encore l\'humain Aragorn, héritier d\'une longue lignée de rois.',
        'https://www.youtube.com/embed/V75dMMIW2B4', 'https://www.youtube.com/embed/LML6SoNE7xE', '03:50:00'),
       (3, 1, 'Rambo', 'Film', 'Média publié', '1981-11-18',
        'John Rambo est un ancien béret vert américain, le dernier survivant d\'un commando d\'élite formé durant la guerre du Viêt Nam et dirigé par le colonel Samuel Trautman. Après la guerre du Viêt Nam où il a, entre autres, été capturé et torturé par l\'ennemi, John Rambo est de retour aux États-Unis. Il se heurte à l\'hostilité de \'Amérique envers les anciens soldats et n\'arrive pas à se réinsérer socialement.',
        'https://www.youtube.com/embed/YPuhNtG47M0', 'https://www.youtube.com/embed/jOPVEIjjgYU', '01:30:00'),
       (4, 4, 'Dragon ball', 'Serie', 'Média publié', '1985-11-16',
        'Dragon Ball (???????, Doragon B?ru, litt. Dragon Ball) est une série de mangas créée par Akira Toriyama, celui-ci inspirant librement du roman de Wu Chengen La Pérégrination vers lOuest. ... Dragon Ball raconte le parcours de Son Goku, depuis lenfance jusquà lâge adulte',
        'https://www.youtube.com/embed/I-UJ9ACAPWM', 'https://www.youtube.com/embed/CbdaDZGzlEw', '00:20:00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user`
(
    `id`       int(11)      NOT NULL,
    `email`    varchar(254) NOT NULL,
    `password` varchar(80)  NOT NULL,
    `isActive` tinyint(1)   NOT NULL DEFAULT 0
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `isActive`)
VALUES (1, 'francihart@yahoo.fr', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0),
       (2, 'francihartyahoo.fr', '12', 0),
       (3, 'a@a.fr', 'a', 0),
       (8, 'fraart@yahoo.fr', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0),
       (9, 'franciart@yahoo.fr', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0),
       (10, 'f@f.fr', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 0),
       (11, 'fr@yah.fr', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0),
       (12, 'francart@hoo.fr', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `episode`
--
ALTER TABLE `episode`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_media_serie_id` (`serie_id`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history_episode`
--
ALTER TABLE `history_episode`
    ADD PRIMARY KEY (`id`),
    ADD KEY `history_user_episode_id_fk_media_id` (`user_id`),
    ADD KEY `history_media_episode_id_fk_media_id` (`media_id`),
    ADD KEY `history_episode_id_fk_media_id` (`media_id`),
    ADD KEY `history_episode_number_fk_media_id` (`episode_id`);

--
-- Index pour la table `history_media`
--
ALTER TABLE `history_media`
    ADD PRIMARY KEY (`id`),
    ADD KEY `history_user_id_fk_media_id` (`user_id`),
    ADD KEY `history_media_id_fk_media_id` (`media_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
    ADD PRIMARY KEY (`id`),
    ADD KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE;

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `episode`
--
ALTER TABLE `episode`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT pour la table `history_episode`
--
ALTER TABLE `history_episode`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 105;

--
-- AUTO_INCREMENT pour la table `history_media`
--
ALTER TABLE `history_media`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 38;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `episode`
--
ALTER TABLE `episode`
    ADD CONSTRAINT `fk_media_serie_episode_id` FOREIGN KEY (`serie_id`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `history_episode`
--
ALTER TABLE `history_episode`
    ADD CONSTRAINT `history_episode_number_fk_media_id` FOREIGN KEY (`episode_id`) REFERENCES `episode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `history_media_episode_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `history_user_episode_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `history_media`
--
ALTER TABLE `history_media`
    ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
    ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
