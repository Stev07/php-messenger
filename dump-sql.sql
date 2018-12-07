SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `Conversations` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Conversations` (`id`, `author_id`, `subject`) VALUES
(1, 1, 'La vie'),
(2, 2, 'Le php'),
(3, 3, 'Le SQL'),
(4, 4, 'Les objets');

CREATE TABLE `Messages` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `author_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Messages` (`id`, `date`, `author_id`, `conversation_id`, `content`) VALUES
(17, '2018-12-06', 1, 1, 'contenu sur la vie de val'),
(18, '2018-12-06', 2, 1, 'contenu sur la vie de Marie'),
(19, '2018-12-06', 3, 1, 'contenu sur la vie de Steve'),
(20, '2018-12-06', 4, 1, 'contenu sur la vie de Béné'),
(21, '2018-12-06', 1, 2, 'contenu sur le PHP de val'),
(22, '2018-12-06', 2, 2, 'contenu sur le PHP de Marie'),
(24, '2018-12-06', 4, 2, 'contenu sur le PHP de Béné'),
(25, '2018-12-06', 1, 3, 'contenu sur le SQL de val'),
(27, '2018-12-06', 3, 3, 'contenu sur le SQL de Steve'),
(28, '2018-12-06', 4, 3, 'contenu sur le SQL de Béné'),
(29, '2018-12-06', 1, 4, 'contenu sur les objets de val'),
(30, '2018-12-06', 2, 4, 'contenu sur les objets de Marie'),
(32, '2018-12-06', 4, 4, 'contenu sur les objets de Béné');

CREATE TABLE `Reactions` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `emoji` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Reactions` (`id`, `author_id`, `message_id`, `emoji`) VALUES
(13, 2, 19, '&#128077;'),
(14, 1, 18, '&#128077;'),
(15, 3, 27, '&#128513;'),
(16, 4, 21, '&#128544;'),
(26, 1, 17, '&#128544;');

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Users` (`id`, `firstname`, `lastname`, `email`, `password`, `avatar`) VALUES
(1, 'Valentin', 'Grégoire', 'valentin@gmail.com', '$2y$12$Zv65OUMTcoa4g9ypGYNnzeCicD6IvxzrZ5HShw6zZJnmKLKDTA0ia', ''),
(2, 'Steve', 'Dossin', 'steve@gmail.com', '$2y$12$hBsoDVEItrGWB6NahQHFTeOseATrWTAKavo14jy3g3/tNeDPMWiN6', ''),
(3, 'Marie', 'Grosjean', 'marie@gmail.com', '$2y$12$Mdi7ossFg/1OFprA/jlgg.oRcEcOfC1eVBSC26VTlv5IN.KL63nWS', ''),
(4, 'Bénédicte', 'Struvay', 'benedicte@gmail.com', '$2y$12$PBjG69ILoiJufcP142WOKuRnrOMz5HgBYAAQPYPSG8XP0i7T.4YVK', '');


ALTER TABLE `Conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Conversations_ibfk_1` (`author_id`);

ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Messages_ibfk_1` (`author_id`),
  ADD KEY `Messages_ibfk_2` (`conversation_id`);

ALTER TABLE `Reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reactions_ibfk_1` (`author_id`),
  ADD KEY `Reactions_ibfk_2` (`message_id`);

ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `firstname` (`firstname`),
  ADD UNIQUE KEY `lastname` (`lastname`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `Conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `Conversations`
  ADD CONSTRAINT `Conversations_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `Conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Reactions`
  ADD CONSTRAINT `Reactions_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Reactions_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `Messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;