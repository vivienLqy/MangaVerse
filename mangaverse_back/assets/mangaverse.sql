-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 avr. 2024 à 20:52
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mangaverse`
--

-- --------------------------------------------------------

--
-- Structure de la table `adress`
--

DROP TABLE IF EXISTS `adress`;
CREATE TABLE IF NOT EXISTS `adress` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `name`) VALUES
(1, 'Eiichiro Oda'),
(2, 'Tite Kubo'),
(3, 'Kentaro Miura'),
(4, 'Shuichi Shigeno '),
(5, 'Kohei Horikoshi'),
(6, 'Gong Chu'),
(7, 'Yuuki Tabata'),
(8, 'Koyoharu Gotoge'),
(9, 'Gege Akutami'),
(10, 'Takuya Mitsuda'),
(11, 'Hajime Komoto'),
(12, 'Masashi Kishimoto'),
(13, 'Mokoto Yukimura'),
(14, 'Tatsuki Fujimoto'),
(15, 'Fukui Tukumi'),
(16, 'Kaneshiro Muneyuki'),
(17, 'Furudate Haruichi'),
(18, 'Akira Toriyama'),
(19, 'ONE'),
(20, 'Togashi Yoshihiro');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(1, 'mangas'),
(2, 'Dvd');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240327113024', '2024-03-27 11:31:29', 283),
('DoctrineMigrations\\Version20240327113251', '2024-03-27 11:33:05', 38),
('DoctrineMigrations\\Version20240327115822', '2024-03-27 11:58:34', 837),
('DoctrineMigrations\\Version20240327154625', '2024-03-27 15:47:26', 258);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'action'),
(2, 'fantasy');

-- --------------------------------------------------------

--
-- Structure de la table `genre_oeuvre`
--

DROP TABLE IF EXISTS `genre_oeuvre`;
CREATE TABLE IF NOT EXISTS `genre_oeuvre` (
  `genre_id` int NOT NULL,
  `oeuvre_id` int NOT NULL,
  PRIMARY KEY (`genre_id`,`oeuvre_id`),
  KEY `IDX_DE4D1EDE4296D31F` (`genre_id`),
  KEY `IDX_DE4D1EDE88194DE8` (`oeuvre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre_oeuvre`
--

INSERT INTO `genre_oeuvre` (`genre_id`, `oeuvre_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre`
--

DROP TABLE IF EXISTS `oeuvre`;
CREATE TABLE IF NOT EXISTS `oeuvre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `auteur_id` int DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double DEFAULT NULL,
  `pegi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `update_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_35FE2EFE60BB6FE6` (`auteur_id`),
  KEY `IDX_35FE2EFEBCF5E72D` (`categorie_id`),
  KEY `IDX_35FE2EFEC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oeuvre`
--

INSERT INTO `oeuvre` (`id`, `auteur_id`, `categorie_id`, `name`, `text`, `rating`, `pegi`, `created_at`, `update_at`, `picture`, `type_id`) VALUES
(1, 1, 1, 'One Piece', 'Fortune, gloire et pouvoir, c\'est ce que possédait Gold Roger, le tout puissant roi des pirates, avant de mourir sur l\'échafaud. Mais ses dernières paroles ont éveillées bien des convoitises, et lança la fabuleuse \"ère de la piraterie\", chacun voulant trouver le fabuleux trésor qu\'il disait avoir laissé.\r\n\r\nBien des années plus tard, Shanks, un redoutable pirate aux cheveux rouges, rencontre Luffy, un jeune garçon d\'une dizaine d\'années dans un petit port de pêche. Il veut devenir pirate et le rejoindre, mais Shanks lui répond qu\'il est trop jeune. Plus tard, Luffy avalera accidentellement le fruit Gomu Gomu qui rendra son corps élastique, mais aussi maudit par les eaux. Incapable de nager, Luffy ne veut pourtant pas renoncer à son rêve. Pour le consoler lorsqu\'il part, Shanks lui offre son chapeau. Luffy jure alors de le rejoindre un jour avec son propre équipage.\r\n\r\nA 16 ans, Luffy prend la mer dans une petite barque avec pour but de réunir un équipage de pirates, mais de pirates pas comme les autres, qui devront partager sa conception un peu étrange de la piraterie. L\'aventure est lancée.', 10, '', '1997-07-22 08:00:00', '2024-03-25 08:00:00', 'OpT1.jpg', 1),
(2, 2, 1, 'Bleach', 'Kurosaki Ichigo, un étudiant de quinze ans aux cheveux orange qui aime la bagarre (comme son père) a la particularité de voir les fantômes ainsi que de pouvoir les toucher. Cela l\'amène à rencontrer Kuchiki Rukia, un Shinigami (dieu de la mort) qui combat', 8, '', '2001-08-07 14:12:55', '2024-03-25 13:12:54', 'BleachT1.jpg', 1),
(3, 3, 1, 'Berserk', 'Dans un monde médiéval et marqué par un passé difficile, erre un mercenaire solitaire nommé Guts, décidé à être seul maître de son destin. Autrefois contraint par un pari perdu à rejoindre les Faucons, une troupe de mercenaires dirigés par Griffith, Guts ', 9, '', '1989-10-01 17:08:43', '2024-03-25 16:08:43', 'BerserkT1.jpg', 2),
(4, 4, 1, 'Initial D', 'Takumi est un jeune lycéen de 18 ans, travaillant dans une station essence avec son ami Itsuki. Cela fait 5 ans qu\'il effectue des livraisons au volant d\'une AE86 pour son père qui tient un magasin de Tofu. Lorsqu\'il a commença à effectuer les livraisons ', 8, '', '1995-06-26 17:11:28', '2024-03-25 16:11:28', 'InitialDT1.jpg', 2),
(5, 5, 1, 'My Hero Academia', 'Dans un futur proche suite à une mutation génétique, 80% de la population mondiale possède des super-pouvoirs appelés \"Alters\". Les super-héros protègent la population mondiale face aux super-vilains qui utilisent leur Alter à des fins maléfiques. Le plus', 8, '', '2014-07-07 17:11:28', '2024-03-25 16:11:28', 'MhaT1.jpg', 1),
(6, 6, 1, 'Solo Leveling', 'Lorsque d\'étranges portails sont apparus aux quatre coins du monde, l\'humanité a dû trouver une solution pour ne pas finir massacrée par les monstres qui en sortent. Dans le même temps, certaines personnes ont développé des capacités permettant de les cha', 9, '', '2021-01-25 17:17:32', '2024-03-25 16:17:32', 'SoloLevelingT1.jpg', 7),
(7, 7, 1, 'Black Clover', 'Asta et Yuno sont deux adolescents de 15 ans qui ont grandi ensemble dans un petit village du royaume de Clover. Leur but ultime à tous les deux est de devenir le prochain empereur-mage !\r\nÉtrangement, dans ce royaume, Asta est le seul qui soit incapable de produire la moindre étincelle magique. Loin d\'être découragé, il participe tout de même avec son ami (et rival) Yuno à la cérémonie annuelle de remise des grimoires qui rassemble les jeunes de 15 ans dans tout le royaume de Clover. Lors de cette cérémonie, Yuno recevra un grimoire légendaire. Ce qui n\'est pas le cas d\'Asta car malheureusement pour lui, aucun grimoire ne lui sera attribué ce jour là. Mais Asta ne se laissera pas abattre, peut importe les efforts qu\'il aura à fournir, il compte bien rivaliser avec Yuno pour aller au bout de son rêve....', 8.3, '7', '2024-03-26 16:18:06', '2024-03-26 16:18:06', 'blackcloverT1.jpg', 1),
(8, 8, 1, 'Demon Slayer', 'Depuis les temps anciens, il existe des rumeurs concernant des démons mangeurs d\'hommes qui se cachent dans les bois. Pour cette raison, les citadins locaux ne s\'y aventurent jamais la nuit. La légende raconte aussi qu\'un tueur de démons déambule la nuit, chassant ces démons assoiffés de sang. Pour le jeune Tanjirô, ces rumeurs vont bientôt devenir sa dure réalité ...\r\n\r\nDepuis la mort de son père, Tanjirô a pris sur lui pour subvenir aux besoins de sa famille. Malgré cette tragédie, ils réussissent à trouver un peu de bonheur au quotidien.\r\n\r\nCependant, ce peu de bonheur se retrouve détruit le jour où Tanjirô découvre que sa famille s\'est faite massacrer et que la seule survivante, sa sœur Nezuko, est devenue un démon. À sa grande surprise, Nezuko montre encore des signes d\'émotion et de pensées humaines. Ainsi, commence la dure tâche de Tanjirô, celle de combattre les démons et de faire redevenir sa sœur humaine.', 9, '12', '2024-03-26 16:18:06', '2024-03-26 16:18:06', 'demonslayerT1.jpg', 1),
(9, 9, 1, 'Jujutsu Kaisen', 'Chaque année au Japon, on recense plus de 10 000 morts inexpliquées et portés disparus.\r\n\r\nDans la majorité des cas, ce sont les sentiments négatifs des êtres humains qui sont en cause. Souffrance, regrets, humiliation : leur accumulation dans un même endroit provoque des malédictions souvent fatales...\r\n\r\nC\'est ce que va découvrir à ses dépens Yuji Itadori, lycéen et membre du club de spiritisme. Il ne croit pas aux fantômes, mais sa force physique hors du commun est un précieux atout pour les missions du groupe... jusqu\'à ce que l\'une d\'elles tourne mal. La relique qu\'ils dénichent, le doigt sectionné d\'une créature millénaire, attire les monstres ! Le jeune homme n\'hésite pas une seconde : il avale la relique pour conjurer le mauvais sort !\r\n\r\nLe voilà possédé par Ryomen Sukuna, le célèbre démon à deux visages. Contre toute attente, Yuji réussit à reprendre le contrôle de son corps. C\'est du jamais vu ! Malgré tout, il est condamné à mort par l\'organisation des exorcistes... Une sentence qui ne pourra être repoussée qu\'à une seule condition : trouver et ingérer tous les doigts de Sukuna afin d\'éliminer la menace une fois pour toutes. Et pour ça, l\'adolescent va devoir s\'initier à l\'art occulte et mystérieux de l\'exorcisme !\r\n\r\nMonstres assoiffés de sang, combats épiques et magie surpuissante : découvrez la nouvelle bombe dark fantasy ! Au cœur d\'une lutte millénaire entre exorcistes et démons, comment garder son humanité alors même que le mal se tapit au plus profond de soi ?', 9.5, '', '2024-03-26 16:18:06', '2024-03-26 16:18:06', 'JJKaisenT1.jpg', 1),
(10, 10, 1, 'Major', 'Gorô Honda, 5 ans au début de l\'histoire, est le fils du joueur de baseball professionnel Shigeharu Honda, lanceur chez les Oceans. Plein d\'admiration pour son père, il hérite de la passion de ce dernier envers ce sport, et rêve de devenir lui-même un joueur professionnel.\r\n\r\nCe manga nous fait suivre la vie de Gorô, bravant défis et obstacles pour atteindre son rêve.', 8.9, '', '2024-03-26 16:18:06', '2024-03-26 16:18:06', 'majorT1.jpg', 1),
(11, 11, 1, 'Mashle', 'Dans un monde où la magie fait loi, il était une fois Mash Burnedead ! Élevé au fin fond de la forêt, le jeune garçon passe ses journées entre séances de musculation et dégustations de choux à la crème.\r\nMais un jour, un agent de police découvre son secret : il est né sans pouvoirs magiques, ce qui est puni de mort ! Pour survivre, il va devoir postuler à Easton, une prestigieuse académie de magie, et en devenir le meilleur élève...\r\nLa magie n\'a plus qu\'à bien se tenir : avec sa musculature affûtée et sa force hors du commun, Mash compte bien pulvériser tous les sorts et briser les codes de cette société !', 8.3, '', '2024-03-26 16:18:06', '2024-03-26 16:18:06', 'mashleT1.jpg', 1),
(12, 12, 1, 'Naruto', 'Il y a de cela douze ans, Kyūbi, un démon ayant la forme d\'un renard à neuf queues, entreprit la destruction du village de Konoha, mais le quatrième Hokage neutralisa ce démon en le scellant dans le corps d\'un nouveau-né : Naruto Uzumaki. Le quatrième Hokage se sacrifia ainsi pour sauver le village de Konoha.\r\n\r\nL\'histoire commence pendant l\'adolescence de Naruto, vers ses douze ans. Orphelin, éternel cancre et grand farceur, il fait toutes les bêtises possibles pour se faire remarquer. Son rêve : devenir Hokage afin d\'être reconnu par les habitants de son village. En effet, le démon scellé en lui a attisé la crainte et le mépris des autres villageois, qui, avec le temps, ne font plus de différence entre le Kyūbi et Naruto. Malgré cela, Naruto s\'entraîne dur afin de devenir genin, le premier niveau chez les ninjas.', 8.7, '', '2024-03-26 16:18:06', '2024-03-26 16:18:06', 'narutoT1.jpg', 1),
(13, 13, 1, 'Vinland Saga', 'Vinland Saga nous raconte l\'histoire d\'un jeune Viking, Thorfinn. Ce dernier fait partie de l\'équipage d\'un chef de guerre du nom d\'Askeladd, qui est l\'assassin du père de Thorfinn !\r\nEnchainant les combats et les missions dangereuses, Thorfinn s\'endurcit et gagne en maturité. Il a un objectif : venger son père de manière loyale...', 9.28, '', '2024-03-26 16:18:06', '2024-03-26 16:18:06', 'VinlandSagaT1.jpg', 2),
(14, 14, 1, 'Chaisaw Man', 'Pour rembourser ses dettes, Denji, jeune homme dans la dèche la plus totale, est exploité en tant que Devil Hunter avec son chien-démon-tronçonneuse, \"Pochita\". Mais suite à une cruelle trahison, il voit enfin une possibilité de se tirer des bas-fonds où il croupit ! Devenu surpuissant après sa fusion avec Pochita, Denji est recruté par une organisation et part à la chasse aux démons...', 8.5, '', '2024-03-28 10:15:20', '2024-03-28 10:15:20', 'ChainsawManT1.jpg', 2),
(15, 15, 1, 'Valkyrie Apocalypse', 'Cette fois, la patience des dieux est à bout. Entre guerres incessantes et pollution extrême, les humains n\'évoluent décidément pas et passent le plus clair de leur temps à semer le chaos sur terre. Les divinités décident donc à l\'unanimité d\'anéantir l\'humanité en déclenchant l\'apocalypse !\r\n\r\nSeules les valkyries, ces guerrières chargées de guider les âmes des morts vers le Valhalla, se rebellent contre ce jugement. Brunehilde, leur aînée, lance un défi aux créateurs du monde : que le sort des mortels soit soumis au Ragnarök, un affrontement ultime entre 13 divinités et 13 champions de l\'humanité ! Mais les plus célèbres héros de notre passé feront-ils le poids face à Zeus, Belzébuth ou Shiva ?', 8.6, '', '2024-03-28 10:15:20', '2024-03-28 10:15:20', 'ValkyrieApocalypseT1.jpg', 2),
(16, 18, 1, 'Dragon Ball', 'Alors qu\'elle parcourt les routes de montagnes à moto, Bulma fait une bien étrange rencontre en la personne de Sangoku, un petit garçon étonnamment fort, résistant et possédant une queue, comme les singes. Il possède un trésor qu\'elle recherche, une boule de cristal, mais ne veut pas la lui céder, c\'est un cadeaux que lui a laissé son grand-père Sangohan. Ils trouvent finalement un compromis, et Sangoku part avec elle à la recherche des 7 boules de cristal dont on dit qu\'elles exaucent n\'importe quel souhait une fois réunis.', 9.15, '10', '2024-04-03 20:32:36', '2024-04-03 20:32:36', 'DragonBallT1.jpg', 1),
(17, 15, 1, 'Haikyū!!', 'Shôyô Hinata a un talent inné pour le volley-ball malgré sa petite taille. Mais après une défaite contre l\'équipe du \"roi du terrain\", Tobio Kageyama, son club de volley-ball au collège perd tous ses membres. Il décide de renouer avec le volley-ball à son entrée au lycée, car cette défaite lui a laissé un goût amer et son but ultime est de surpasser Tobio. Sauf qu\'il se rend compte que celui-ci a rejoint le même lycée que lui, et qu\'il doit par conséquent jouer dans son équipe ! Et pour redorer le blason de l\'équipe de volley-ball du lycée Karasuno, considérée comme \"les champions déchus\", il va falloir que Shôyô et Tobio se reconnaissent comme coéquipiers et non comme rivaux ! Ce qui risque d\'être un peu compliqué...', 9.39, '12', '2024-04-03 20:32:36', '2024-04-03 20:32:36', 'HaikyuT1.jpg', 1),
(18, 19, 1, 'One Punch Man', 'Lorsque le super-héros Saitama se présente à ses ennemis, ces derniers ne le prennent jamais au sérieux. Il faut dire qu\'entre sa carrure (plutôt banale) et son allure désinvolte, il n\'y a pas vraiment de quoi avoir peur... surtout pour un être surpuissant qui a déjà causé d\'impressionnants ravages. Toutefois, il faut toujours se méfier des apparences car Saitama possède une puissance colossale, qui lui permet de terrasser ses adversaires en un seul coup !\r\n\r\nCette puissance est dû à un entrainement très intensif (au point que Saitama en ait perdu ses cheveux) de 3 ans. Le problème, c\'est que depuis, il s\'ennuie. Personne n\'a encore pu rivaliser avec lui et il cherche désespérément celui qui pourra lui offrir un vrai combat', 8.87, '14', '2024-04-03 20:32:36', '2024-04-03 20:32:36', 'OnePunchManT1.jpg', 2),
(19, 16, 1, 'Blue Lock', 'Coupe du monde 2018, l\'équipe de football du Japon est éliminée en huitièmes de finale... Ce nouvel échec incite l\'Union japonaise de football à fonder le \"Blue Lock\" : un centre de formation révolutionnaire rassemblant les 300 meilleurs attaquants lycéens du pays.\r\n\r\nL\'objectif du coach du Blue Lock, Jinpachi Ego, est clair : détecter l\'unique attaquant qui écrasera tous ses rivaux par son talent et son hyper-individualisme ! Pour Yoichi Isagi, joueur bouillonnant encore inconnu, il n\'y a pas d\'alternative... S\'il veut survivre au programme hautement sélectif qui l\'attend, il devra abandonner le jeu collectif et se transcender pour devenir l\'attaquant ultime !', 8.95, '12', '2024-04-03 20:40:06', '2024-04-03 20:40:06', 'BlueLockT1.jpg', 1),
(20, 20, 1, 'Hunter X Hunter', 'Gon Freecs, 12 ans, vit sur une île reculée. Son père ayant disparu, il vit avec sa tante et sa grand-mère. Mais le jour où il apprend que son père, Jin Freecs, est un Hunter et qui plus est l\'un des meilleurs de son temps, il décide de se rendre au très réputé examen de Hunter pour décrocher le certificat de Hunter et ainsi pouvoir se mettre à la recherche de son père.\r\n\r\nCependant l\'examen qui a lieu chaque année est très difficile et dangereux, les participants peuvent y mourir à tout moment. On raconte même que sur dix mille candidats, un seul arrive jusqu\'à l\'examen, mais cela ne décourage pas le jeune héros qui est plus déterminé que jamais.\r\n\r\nDurant l\'examen il va rencontrer plusieurs personnes, amies comme ennemies dont : Kurapika dont le seul but est de devenir un Hunter pour venger son clan assassiné ; Leolio qui lui veut simplement de l\'argent mais au plus profond c\'est pour financer ses études de médecine et ainsi être assez riche pour ne jamais demander d\'argent à un patient qui n\'en a pas les moyens ; Kirua qui a le même âge que Gon, fils d\'une famille d\'assassins d\'élite très réputée, il s\'est enfui car il déteste qu\'on décide de sa vie à sa place, s\'il devient Hunter il fera enfermer sa famille et touchera les primes ; et enfin le très redoutable Hisoka dont le seul plaisir est de se battre contre des guerriers extrêmement forts, dans le cas contraire il massacre froidement ses ennemis.\r\n\r\nGon va devoir se frayer un chemin parmi tous ses concurrents mais son charisme, son courage et surtout son incroyable capacité à s\'attirer la sympathie des gens le tireront des mauvais pas bien des fois...', 9.12, '12', '2024-04-03 20:42:07', '2024-04-03 20:42:07', 'HunterXHunterT1.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `oeuvres_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantiter` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `categorie_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD4928CE22` (`oeuvres_id`),
  KEY `IDX_D34A04ADBCF5E72D` (`categorie_id`),
  KEY `IDX_D34A04ADC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `oeuvres_id`, `name`, `prix`, `picture`, `quantiter`, `created_at`, `categorie_id`, `type_id`) VALUES
(1, 1, 'Tome 1', 6.99, 'OpT1.jpg', 26, '2024-03-26 15:05:18', 1, 1),
(2, 1, 'Tome 2', 6.99, 'OpT2.jpg', NULL, '2024-03-26 15:05:18', 1, 1),
(3, 1, 'Tome 3', 6.99, 'OpT3.jpg', 50, '2024-03-26 15:05:18', 1, 1),
(4, 1, 'Tome 4', 6.99, 'OpT4.jpg', 15, '2024-03-26 15:05:18', 1, 1),
(5, 1, 'Tome 5', 6.99, 'OpT5.jpg', 6, '2024-03-26 15:05:18', 1, 1),
(6, 1, 'Tome 6', 6.99, 'OpT6.jpg', 153, '2024-03-26 15:05:18', 1, 1),
(7, 2, 'Tome 1', 6.99, 'BleachT1.jpg', 50, '2024-03-26 15:12:09', 1, 1),
(8, 2, 'Tome 2', 6.99, 'BleachT2.jpg', 50, '2024-03-26 15:12:09', 1, 1),
(9, 2, 'Tome 3', 6.99, 'BleachT3.jpg', 50, '2024-03-26 15:12:09', 1, 1),
(10, 2, 'Tome 4', 6.99, 'BleachT4.jpg', 50, '2024-03-26 15:12:09', 1, 1),
(11, 2, 'Tome 5', 6.99, 'BleachT5.jpg', 50, '2024-03-26 15:12:09', 1, 1),
(12, 2, 'Tome 6', 6.99, 'BleachT6.jpg', 50, '2024-03-26 15:12:09', 1, 1),
(13, 6, 'Tome 1', 8.99, 'sololevelingT1.jpg', 26, '2024-03-26 15:12:30', 1, 7),
(14, 6, 'Tome 2', 8.99, 'sololevelingT2.jpg', 15, '2024-03-26 15:12:30', 1, 7),
(15, 6, 'Tome 3', 8.99, 'sololevelingT3.jpg', 22, '2024-03-26 15:12:30', 1, 7),
(16, 6, 'Tome 4', 8.99, 'sololevelingT4.jpg', 33, '2024-03-26 15:12:30', 1, 7),
(17, 6, 'Tome 5', 8.99, 'sololevelingT5.jpg', 33, '2024-03-26 15:12:30', 1, 7),
(18, 6, 'Tome 6', 8.99, 'sololevelingT6.jpg', 33, '2024-03-26 15:12:30', 1, 7),
(19, 4, 'Tome 1', 5.99, 'initialDT1.jpg', 50, '2024-03-26 15:17:27', 1, 2),
(20, 4, 'Tome 2', 5.99, 'initialDT2.jpg', 50, '2024-03-26 15:17:27', 1, 2),
(21, 4, 'Tome 3', 5.99, 'initialDT3.jpg', 50, '2024-03-26 15:17:27', 1, 2),
(22, 4, 'Tome 4', 5.99, 'initialDT4.jpg', 50, '2024-03-26 15:17:27', 1, 2),
(23, 4, 'Tome 5', 5.99, 'initialDT5.jpg', 50, '2024-03-26 15:17:27', 1, 2),
(24, 4, 'Tome 6', 5.99, 'initialDT6.jpg', 50, '2024-03-26 15:17:27', 1, 2),
(25, 3, 'Tome 1', 6.99, 'BerserkT1.jpg', 301, '2024-03-26 15:14:45', 1, 2),
(26, 3, 'Tome 2', 6.99, 'BerserkT2.jpg', 211, '2024-03-26 15:14:45', 1, 2),
(27, 3, 'Tome 3', 3.99, 'BerserkT3.jpg', 88, '2024-03-26 15:14:45', 1, 2),
(28, 3, 'Tome 4', 3.99, 'BerserkT4.jpg', 105, '2024-03-26 15:14:45', 1, 2),
(29, 3, 'Tome 5', 3.99, 'BerserkT5.jpg', 23, '2024-03-26 15:14:45', 1, 2),
(30, 3, 'Tome 6', 3.99, 'BerserkT6.jpg', 98, '2024-03-26 15:14:45', 1, 2),
(31, 5, 'Tome 1', 3.5, 'MhaT1.jpg', 60, '2024-03-26 15:18:37', 1, 1),
(32, 5, 'Tome 2', 3.5, 'MhaT2.jpg', 55, '2024-03-26 15:18:37', 1, 1),
(33, 5, 'Tome 3', 3.5, 'MhaT3.jpg', 55, '2024-03-26 15:18:37', 1, 1),
(34, 5, 'Tome 4', 3.5, 'MhaT4.jpg', 60, '2024-03-26 15:18:37', 1, 1),
(35, 5, 'Tome 5', 3.5, 'MhaT5.jpg', 58, '2024-03-26 15:18:37', 1, 1),
(36, 5, 'Tome 6', 3.5, 'MhaT6.jpg', 58, '2024-03-26 15:18:37', 1, 1),
(37, 7, 'Tome 1', 14.99, 'BlackcloverT1.jpg', 75, '2024-03-27 17:03:22', 1, 1),
(38, 7, 'Tome 2', 14.99, 'BlackcloverT2.jpg', 44, '2024-03-27 17:03:22', 1, 1),
(39, 7, 'Tome 3', 14.99, 'BlackcloverT3.jpg', 44, '2024-03-27 17:03:22', 1, 1),
(40, 7, 'Tome 4', 14.99, 'BlackcloverT4.jpg', 54, '2024-03-27 17:03:22', 1, 1),
(41, 7, 'Tome 5', 14.99, 'BlackcloverT5.jpg', 66, '2024-03-27 17:03:22', 1, 1),
(42, 7, 'Tome 6', 14.99, 'BlackcloverT6.jpg', 22, '2024-03-27 17:03:22', 1, 1),
(43, 8, 'Tome 1', 14.99, 'DemonslayerT1.jpg', 49, '2024-03-27 17:11:52', 1, 1),
(44, 8, 'Tome 2', 14.99, 'DemonslayerT2.jpg', 49, '2024-03-27 17:11:52', 1, 1),
(45, 8, 'Tome 3', 14.99, 'DemonslayerT3.jpg', 49, '2024-03-27 17:11:52', 1, 1),
(46, 8, 'Tome 4', 14.99, 'DemonslayerT4.jpg', 49, '2024-03-27 17:11:52', 1, 1),
(47, 8, 'Tome 5', 14.99, 'DemonslayerT5.jpg', 49, '2024-03-27 17:11:52', 1, 1),
(48, 8, 'Tome 6', 14.99, 'DemonslayerT6.jpg', 49, '2024-03-27 17:11:52', 1, 1),
(49, 1, 'Tome 7', 6.99, 'OpT7.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(50, 1, 'Tome 8', 6.99, 'OpT8.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(51, 1, 'Tome 9', 6.99, 'OpT9.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(52, 1, 'Tome 10', 6.99, 'OpT10.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(53, 1, 'Tome 11', 6.99, 'OpT11.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(54, 1, 'Tome 12', 6.99, 'OpT12.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(55, 1, 'Tome 13', 6.99, 'OpT13.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(56, 1, 'Tome 14', 50, 'OpT14.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(57, 1, 'Tome 15', 50, 'OpT15.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(58, 1, 'Tome 16', 6.99, 'OpT16.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(59, 1, 'Tome 17', 6.99, 'OpT17.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(60, 1, 'Tome 18', 6.99, 'OpT18.jpg', 7, '2024-03-27 21:41:18', 1, 1),
(61, 1, 'Tome 19', 6.99, 'OpT19.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(62, 1, 'Tome 20', 6.99, 'OpT20.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(63, 1, 'Tome 21', 6.99, 'OpT21.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(64, 1, 'Tome 22', 6.99, 'OpT22.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(65, 1, 'Tome 23', 6.99, 'OpT23.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(66, 1, 'Tome 24', 6.99, 'OpT24.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(67, 1, 'Tome 25', 6.99, 'OpT25.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(68, 1, 'Tome 26', 50, 'OpT26.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(69, 1, 'Tome 27', 50, 'OpT27.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(70, 1, 'Tome 28', 6.99, 'OpT28.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(71, 1, 'Tome 29', 6.99, 'OpT29.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(72, 1, 'Tome 30', 6.99, 'OpT30.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(73, 1, 'Tome 31', 6.99, 'OpT31.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(74, 1, 'Tome 32', 6.99, 'OpT32.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(75, 1, 'Tome 33', 6.99, 'OpT33.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(76, 1, 'Tome 34', 6.99, 'OpT34.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(77, 1, 'Tome 35', 6.99, 'OpT35.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(78, 1, 'Tome 36', 6.99, 'OpT36.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(79, 1, 'Tome 37', 6.99, 'OpT37.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(80, 1, 'Tome 38', 6.99, 'OpT38.jpg', 7, '2024-03-27 21:41:18', 1, 1),
(81, 1, 'Tome 40', 6.99, 'OpT40.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(82, 1, 'Tome 41', 6.99, 'OpT41.jpg', 7, '2024-03-27 21:41:18', 1, 1),
(83, 1, 'Tome 42', 6.99, 'OpT42.jpg', 7, '2024-03-27 21:41:18', 1, 1),
(84, 1, 'Tome 43', 6.99, 'OpT43.jpg', 50, '2024-03-27 21:41:18', 1, 1),
(85, 1, 'Tome 44', 8000.99, 'OpT44.jpg', 2, '2024-03-27 21:41:18', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Shonen'),
(2, 'Seinen'),
(3, 'Shojo'),
(4, 'Josei'),
(5, 'Seijin'),
(6, 'Kodomo'),
(7, 'manhwa');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`) VALUES
(1, 'admin@admin.fr', '[\"ROLE_USER\", \"ROLE ADMIN\"]', '$2y$13$N1YE1XzG2zMNaDT.U0IwoeJj1JqT60Rv.GBBP8F7qIcjg0xt174Vm', 0),
(2, 'user@user.fr', '[]', '$2y$13$ystAXLy11xcWuk0TAIBrxuh6LI92Eaan/8w1IohclvFJ5eBhW9sui', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `genre_oeuvre`
--
ALTER TABLE `genre_oeuvre`
  ADD CONSTRAINT `FK_DE4D1EDE4296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DE4D1EDE88194DE8` FOREIGN KEY (`oeuvre_id`) REFERENCES `oeuvre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD CONSTRAINT `FK_35FE2EFE60BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`),
  ADD CONSTRAINT `FK_35FE2EFEBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_35FE2EFEC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD4928CE22` FOREIGN KEY (`oeuvres_id`) REFERENCES `oeuvre` (`id`),
  ADD CONSTRAINT `FK_D34A04ADBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_D34A04ADC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
