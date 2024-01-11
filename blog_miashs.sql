-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 jan. 2024 à 00:24
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
-- Base de données : `blog_miashs`
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
(3, 'Le renard', 'animaux', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus quod voluptatem consequuntur asperiores nobis facilis aut impedit, totam, laudantium aliquam non tempore, quidem vero deleniti earum in error labore.\n    Quis natus dolorem sequi quia, eligendi quasi quaerat. Facilis, quo nobis, molestiae quae exercitationem dignissimos voluptatem dolor quos, similique repudiandae consectetur esse!', 'https://static.wixstatic.com/media/eb3ed76506c24299a581c815a954e3e3.jpeg/v1/fill/w_940,h_529,fp_0.50_0.50,q_90,enc_auto/eb3ed76506c24299a581c815a954e3e3.jpeg', '2023-11-01 17:21:07', 1),
(5, 'Le monde du developpement web', 'web', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus quod voluptatem consequuntur asperiores nobis facilis aut impedit, totam, laudantium aliquam non tempore, quidem vero deleniti earum in error labore.\n    Quis natus dolorem sequi quia, eligendi quasi quaerat. Facilis, quo nobis, molestiae quae exercitationem dignissimos voluptatem dolor quos, similique repudiandae consectetur esse!', 'https://static.wixstatic.com/media/10b4b25953f140b8abd712c30cf89608.jpg/v1/fill/w_940,h_529,fp_0.50_0.50,q_90,enc_auto/10b4b25953f140b8abd712c30cf89608.jpg', '2023-11-04 08:37:07', 3),
(6, 'Le léopard', 'animaux', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus quod voluptatem consequuntur asperiores nobis facilis aut impedit, totam, laudantium aliquam non tempore, quidem vero deleniti earum in error labore.&#13;&#10;    Quis natus dolorem sequi quia, eligendi quasi quaerat. Facilis, quo nobis, molestiae quae exercitationem dignissimos voluptatem dolor quos, similique repudiandae consectetur esse!', 'http://localhost/blog_miashs/assets/images/1702104116_gwen-weustink-I3C1sSXj1i8-unsplash.jpg', '2023-12-09 07:41:56', 1),
(8, 'La Lamborghini', 'vehicule', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus quod voluptatem consequuntur asperiores nobis facilis aut impedit, totam, laudantium aliquam non tempore, quidem vero deleniti earum in error labore.\r\n    Quis natus dolorem sequi quia, eligendi quasi quaerat. Facilis, quo nobis, molestiae quae exercitationem dignissimos voluptatem dolor quos, similique repudiandae consectetur esse!', 'http://localhost/blog_miashs/assets/images/1702148599_stefan-rodriguez-2AovfzYV3rc-unsplash.jpg', '2023-12-09 09:50:22', 1),
(9, 'Les Papillons de nuit', 'animaux', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus quod voluptatem consequuntur asperiores nobis facilis aut impedit, totam, laudantium aliquam non tempore, quidem vero deleniti earum in error labore.\r\n    Quis natus dolorem sequi quia, eligendi quasi quaerat. Facilis, quo nobis, molestiae quae exercitationem dignissimos voluptatem dolor quos, similique repudiandae consectetur esse!', 'http://localhost/blog_miashs/assets/images/1702206674_boris-smokrovic-lyvCvA8sKGc-unsplash.jpg', '2023-12-10 12:10:46', 1),
(10, 'Les cerfs sauvage', 'animaux', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo accusamus quod voluptatem consequuntur asperiores nobis facilis aut impedit, totam, laudantium aliquam non tempore, quidem vero deleniti earum in error labore.&#13;&#10;    Quis natus dolorem sequi quia, eligendi quasi quaerat. Facilis, quo nobis, molestiae quae exercitationem dignissimos voluptatem dolor quos, similique repudiandae consectetur esse!', 'http://localhost/blog_miashs/assets/images/1702221082_laura-college-K_Na5gCmh38-unsplash.jpg', '2023-12-10 16:11:22', 3);

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
(1, 'Je ne suis pas d\'accord avec cette article, je pense que c\'est faux', '2023-11-05 05:28:37', 1, 3),
(3, 'Bonjour cet article me semble tr&egrave;s pertinente merci beaucoup.', '2024-01-11 22:25:41', 3, 3),
(6, 'merci pour cet article', '2024-01-11 23:20:07', 3, 10);

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
(60, 1, 6),
(61, 1, 6),
(62, 1, 5),
(65, 1, 3),
(66, 1, 3),
(67, 1, 3),
(71, 3, 9),
(72, 3, 9),
(73, 3, 6),
(74, 3, 6),
(75, 3, 10),
(76, 3, 10),
(77, 3, 3),
(78, 3, 3);

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
(1, 'naskao', 'naskao@hotmail.fr', 'Liminose123', 'http://localhost/blog_miashs/assets/images/1698946117_nas.jpg'),
(2, 'Zawou', 'nas@ht.fr', '123', 'https://media.licdn.com/dms/image/C4D03AQE0E3JK6DItcA/profile-displayphoto-shrink_200_200/0/1571898833509?e=1704931200&v=beta&t=ybjidMZ9RuuIWVAwaPIv4h9jW4eHn5_fzoe5iaMA0QI'),
(3, 'imou', 'imou@hotmail.fr', '$argon2id$v=19$m=65536,t=4,p=1$ZEp5TEZYeEVreWpKdHRkNg$5rUyCImjxJC5kyJKpunLYrBvxm+4ZuCoHpUQIeq7JhI', 'http://localhost/blog_miashs/assets/images/avatars1704617649_seven-shooter-ZzE9uKOAchc-unsplash.jpg'),
(4, 'loulou', 'loulou@hotmail.fr', '$argon2id$v=19$m=65536,t=4,p=1$dnRMbFE1ZS9HZ3JKaWhsdA$Um7GBl+hBteR8HO9FDyp4d3PphrH0DjiIKN5+hT4Ysc', 'http:///blog_miashs/assets/images/avatars/default-user-avatars.jpg'),
(5, 'loulou2', 'loulou2@hotmail.fr', '$argon2id$v=19$m=65536,t=4,p=1$WVFvYm1vUEJiOTJUckpMOA$nG2kFEMoMggm/dED3nrVrBt0sBvVly3bN+R06XH3JuU', 'http://localhost/blog_miashs/assets/images/avatars/default-user-avatars.jpg');

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
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `coment`
--
ALTER TABLE `coment`
  MODIFY `id_coment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `likearticle`
--
ALTER TABLE `likearticle`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `foreignKey_coment_article` FOREIGN KEY (`id_article_coment`) REFERENCES `article` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreignKey_coment_user` FOREIGN KEY (`id_user_coment`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likearticle`
--
ALTER TABLE `likearticle`
  ADD CONSTRAINT `foreignKey_like_article` FOREIGN KEY (`id_article_like`) REFERENCES `article` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreignKey_like_user` FOREIGN KEY (`id_user_like`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
