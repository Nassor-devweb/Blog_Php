-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 08 déc. 2023 à 16:13
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dyma_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `titre_article` varchar(50) NOT NULL,
  `categorie_article` varchar(20) NOT NULL,
  `contenu_article` varchar(1000) NOT NULL,
  `image_article` varchar(300) NOT NULL,
  `date_article` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `titre_article`, `categorie_article`, `contenu_article`, `image_article`, `date_article`, `id_user`) VALUES
(3, 'Le javascript dans toute sa splendeur', 'web', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus quod voluptatem consequuntur asperiores nobis facilis aut impedit, totam, laudantium aliquam non tempore, quidem vero deleniti earum in error labore.\n    Quis natus dolorem sequi quia, eligendi quasi quaerat. Facilis, quo nobis, molestiae quae exercitationem dignissimos voluptatem dolor quos, similique repudiandae consectetur esse!', 'https://static.wixstatic.com/media/eb3ed76506c24299a581c815a954e3e3.jpeg/v1/fill/w_940,h_529,fp_0.50_0.50,q_90,enc_auto/eb3ed76506c24299a581c815a954e3e3.jpeg', '2023-11-01 17:21:07', 1),
(4, 'Le javascript', 'web', 'blablaprrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 'http://localhost/dyma_php_blog/assets/images/1698946117_nas.jpg', '2023-11-02 18:28:37', 1),
(5, 'Le monde du developpement web', 'web', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus quod voluptatem consequuntur asperiores nobis facilis aut impedit, totam, laudantium aliquam non tempore, quidem vero deleniti earum in error labore.\r\n    Quis natus dolorem sequi quia, eligendi quasi quaerat. Facilis, quo nobis, molestiae quae exercitationem dignissimos voluptatem dolor quos, similique repudiandae consectetur esse!', 'https://static.wixstatic.com/media/10b4b25953f140b8abd712c30cf89608.jpg/v1/fill/w_940,h_529,fp_0.50_0.50,q_90,enc_auto/10b4b25953f140b8abd712c30cf89608.jpg', '2023-11-04 08:37:07', 2);

-- --------------------------------------------------------

--
-- Structure de la table `coment`
--

CREATE TABLE `coment` (
  `id_coment` int(11) NOT NULL,
  `contenu_coment` varchar(800) NOT NULL,
  `date_coment` datetime NOT NULL,
  `id_user_coment` int(11) NOT NULL,
  `id_article_coment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `coment`
--

INSERT INTO `coment` (`id_coment`, `contenu_coment`, `date_coment`, `id_user_coment`, `id_article_coment`) VALUES
(1, 'Je ne suis pas d\'accord avec cette article, je pense que c\'est faux', '2023-11-05 05:28:37', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `likearticle`
--

CREATE TABLE `likearticle` (
  `id_like` int(11) NOT NULL,
  `id_user_like` int(11) NOT NULL,
  `id_article_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `likearticle`
--

INSERT INTO `likearticle` (`id_like`, `id_user_like`, `id_article_like`) VALUES
(3, 2, 3),
(44, 1, 3),
(46, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(30) NOT NULL,
  `email_user` varchar(60) NOT NULL,
  `password_user` varchar(300) NOT NULL,
  `photo_user` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_user`, `email_user`, `password_user`, `photo_user`) VALUES
(1, 'naskao', 'naskao@hotmail.fr', 'Liminose123', 'http://localhost/dyma_php_blog/assets/images/1698946117_nas.jpg'),
(2, 'Zawou', 'nas@ht.fr', '123', 'https://media.licdn.com/dms/image/C4D03AQE0E3JK6DItcA/profile-displayphoto-shrink_200_200/0/1571898833509?e=1704931200&v=beta&t=ybjidMZ9RuuIWVAwaPIv4h9jW4eHn5_fzoe5iaMA0QI');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `foreignKey_user_article` (`id_user`);

--
-- Index pour la table `coment`
--
ALTER TABLE `coment`
  ADD PRIMARY KEY (`id_coment`),
  ADD KEY `foreignKey_coment_article` (`id_article_coment`),
  ADD KEY `foreignKey_coment_user` (`id_user_coment`);

--
-- Index pour la table `likearticle`
--
ALTER TABLE `likearticle`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `foreignKey_like_article` (`id_article_like`),
  ADD KEY `foreignKey_like_user` (`id_user_like`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `coment`
--
ALTER TABLE `coment`
  MODIFY `id_coment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `likearticle`
--
ALTER TABLE `likearticle`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `foreignKey_user_article` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `coment`
--
ALTER TABLE `coment`
  ADD CONSTRAINT `foreignKey_coment_article` FOREIGN KEY (`id_article_coment`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `foreignKey_coment_user` FOREIGN KEY (`id_user_coment`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `likearticle`
--
ALTER TABLE `likearticle`
  ADD CONSTRAINT `foreignKey_like_article` FOREIGN KEY (`id_article_like`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `foreignKey_like_user` FOREIGN KEY (`id_user_like`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
