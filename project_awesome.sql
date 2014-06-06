-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 05 jun 2014 kl 13:48
-- Serverversion: 5.5.16
-- PHP-version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `project_awesome`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `summary_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `summay_id` (`summary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `date`, `content`, `summary_id`) VALUES
(1, '2014-05-06 15:00:00', 'This is a comment', 1),
(2, '2014-06-03 13:34:07', 'This is also a comment', 1),
(3, '2014-06-03 13:35:24', 'And this is ALSO a comment!', 1),
(4, '2014-06-03 14:16:12', 'Det var en fin bild det!', 6),
(5, '2014-06-04 08:24:55', '*Var sÃ¥ god!', 6),
(6, '2014-06-05 10:34:27', 'Det var alldeles fÃ¶r kort!', 5),
(7, '2014-06-05 10:38:08', 'I will now right the longest comment in this post so far, just to test how it looks like when the comment&#39;s length reaches the far end of the comment field. I do not know how long this comment is yet, but I guess it&#39;ll soon reach the end. This summary is way too short, there&#39;s pretty much nothing in there!', 1),
(8, '2014-06-05 10:38:19', 'Okay, it worked :)', 1),
(9, '2014-06-05 12:25:02', 'Hey', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumpning av Data i tabell `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Matte'),
(2, 'Svenska'),
(3, 'Engelska'),
(4, 'Fysik'),
(5, 'GrÃ¤nssnittsdesign'),
(6, 'Programmering'),
(8, 'Webbserverprogrammering'),
(9, 'Idrott och HÃ¤lsa'),
(10, 'Webbutveckling'),
(11, 'Teknik');

-- --------------------------------------------------------

--
-- Tabellstruktur `summaries`
--

CREATE TABLE IF NOT EXISTS `summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(32) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumpning av Data i tabell `summaries`
--

INSERT INTO `summaries` (`id`, `title`, `content`, `image`, `subject_id`) VALUES
(1, 'The first summary', 'All in English!', '', 3),
(2, 'The second summary', 'This one is also in English!', 'http://www.serebii.net/art/th/65', 3),
(5, 'En kort laboration', 'Detta är sammanfattningen', '', 4),
(6, 'En fin bild', 'Vassego!', 'http://www.serebii.net/art/th/65', 5),
(7, 'Muskler', 'Gluteus Maximus', '', 9),
(8, 'Mekanik', 'Broar!', '', 11);

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`summary_id`) REFERENCES `summaries` (`id`);

--
-- Restriktioner för tabell `summaries`
--
ALTER TABLE `summaries`
  ADD CONSTRAINT `summaries_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
