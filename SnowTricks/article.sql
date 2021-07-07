-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 15 nov. 2019 à 13:19
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E66F675F31B` (`author_id`),
  KEY `IDX_23A0E667A45358C` (`groupe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `author_id`, `groupe_id`, `title`, `content`, `published_at`) VALUES
(155, 23, 112, 'Grab', 'Le grab, comment ça marche?\r\nIl faut d\'abord faire un saut, un simple ollie par exemple comme on peut le voir sur le tuto du ollie. Bien plier les jambes une fois en l’air pour se regrouper, et aller chercher la planche avec la main. Attention il ne faut pas que le buste se casse en deux pour aller chercher la board : ce sont bien les genoux qui remontent pour amener la board vers la main.Un grab est d\'autant plus réussi que la saisie est longue. De plus, le saut est d\'autant plus esthétique que la saisie du snowboard est franche, ce qui permet au rideur d\'accentuer la torsion de son corps grâce à la tension de sa main sur la planche. On dit alors que le grab est tweaké (le verbe anglais to tweak signifie « pincer » mais a également le sens de « peaufiner »). ', '2019-08-19 07:43:03'),
(156, 23, 114, 'flip', 'Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.\r\n\r\nIl est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation.\r\n\r\nLes flips agrémentés d\'une vrille existent aussi (Mac Twist, Hakon Flip, ...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées.\r\n\r\nNéanmoins, en dépit de la difficulté technique relative d\'une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks. ', '2019-09-12 07:43:03'),
(157, 23, 113, 'Rotation', 'On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.Une rotation peut être frontside ou backside : une rotation frontside correspond à une rotation orientée vers la carre backside. Cela peut paraître incohérent mais l\'origine étant que dans un halfpipe ou une rampe de skateboard, une rotation frontside se déclenche naturellement depuis une position frontside (i.e. l\'appui se fait sur la carre frontside), et vice-versa. Ainsi pour un rider qui a une position regular (pied gauche devant), une rotation frontside se fait dans le sens inverse des aiguilles d\'une montre.', '2019-10-09 07:43:03'),
(158, 23, 117, 'One foot Trick', 'Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n\'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception. ', '2019-10-21 07:43:03'),
(159, 23, 115, 'Rotation Désaxées', 'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu\'initialement horizontales, font passer la tête en bas.\r\nBien que certaines de ces rotations soient plus faciles à faire sur un certain nombre de tours (ou de demi-tours) que d\'autres, il est en théorie possible de d\'attérir n\'importe quelle rotation désaxée avec n\'importe quel nombre de tours, en jouant sur la quantité de désaxage afin de se retrouver à la position verticale au moment voulu.\r\n\r\nIl est également possible d\'agrémenter une rotation désaxée par un grab. ', '2019-10-08 07:43:03'),
(160, 23, 116, 'Slide', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.\r\nOn peut slider avec la planche centrée par rapport à la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c\'est-à-dire l\'avant de la planche sur la barre, ou en tail slide, l\'arrière de la planche sur la barre. ', '2019-08-15 07:43:03'),
(161, 23, 118, 'Old School tada', 'Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school) :\r\n\r\n    figures désuètes : Japan air, rocket air, ...\r\n    rotations effectuées avec le corps tendu\r\n    figures saccadées, par opposition au style new school qui privilégie l\'amplitude\r\n\r\nÀ noter que certains tricks old school restent indémodables :\r\n\r\n    Backside Air\r\n    Method Air', '2019-10-24 07:43:03'),
(162, 23, 112, 'Les differents style de Grabs', 'Voici la liste de tous les style de grab :     mute : saisie de la carre frontside de la planche entre les deux pieds avec la main avant ;\r\n    sad ou melancholie ou style week : saisie de la carre backside de la planche, entre les deux pieds, avec la main avant ;\r\n    indy : saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière ;\r\n    stalefish : saisie de la carre backside de la planche entre les deux pieds avec la main arrière ;\r\n    tail grab : saisie de la partie arrière de la planche, avec la main arrière ;\r\n    nose grab : saisie de la partie avant de la planche, avec la main avant ;\r\n    japan ou japan air : saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.\r\n    seat belt: saisie du carre frontside à l\'arrière avec la main avant ;\r\n    truck driver: saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)', '2019-09-23 07:43:03'),
(163, 23, 116, 'Les Barres de Slide', 'Pour les barres de slide, la dénomination se fait de la manière suivante :\r\n\r\n    d\'abord le nom de la figure d\'entrée si elle est autre qu\'un 90, suivi du mot anglais to\r\n    le nom du slide (nose slide ou tail slide) ou le mot anglais rail si le slide est classique\r\n    enfin le nom de la figure de sortie si elle est autre qu\'un 90, précédée du mot anglais to\r\n\r\nPar exemple, un switch 270 to rail signifie que le rideur part du côté non naturel, qu\'il effectue trois quarts de tour avant de slider normalement sur la barre, puis qu\'il sort avec un quart de tour.\r\n\r\nUn « rail to switch » signifie que le rider est sorti de la barre avec un quart de tour qui l\'a amené de son côté non naturel. De même, le « switch to rail » consiste à entrer sur la barre en partant en arrière et en effectuant un quart de tour.\r\n\r\nLorsque le rideur effectue une rotation au milieu de la barre, on rajoute au nom de la figure un « to figure to rail ». Par exemple, un 270 to rail to 180 to rail to switch signifie que le rideur rentre sur la barre avec 3 quarts de tours, puis effectue un demi-tour en milieu de barre (que les riders appellent aussi « sexchange »), et sort enfin avec un quart de tour qui le fait atterrir en arrière.\r\n\r\nParfois, quand seule la figure d\'entrée ou de sortie est notable, par exemple un 630, on parle d\'un « 630 in » ou « 630 out ». ', '2019-08-23 07:43:03'),
(164, 23, 116, 'Slide', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.\r\n\r\nOn peut slider avec la planche centrée par rapport à la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c\'est-à-dire l\'avant de la planche sur la barre, ou en tail slide, l\'arrière de la planche sur la barre. ', '2019-08-07 07:43:03');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E667A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_23A0E66F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
