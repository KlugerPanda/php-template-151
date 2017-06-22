-- Adminer 4.2.5 MySQL dump

USE app;

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1000) DEFAULT NULL,
  `datum` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `post_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_ID`),
  KEY `user_ID` (`user_ID`),
  KEY `post_ID` (`post_ID`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_ID`) REFERENCES `post` (`post_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `post_ID` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(50) DEFAULT NULL,
  `post` varchar(3000) DEFAULT NULL,
  `datum` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`post_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `upvote`;
CREATE TABLE `upvote` (
  `upvote_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) DEFAULT NULL,
  `post_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`upvote_ID`),
  KEY `user_ID` (`user_ID`),
  KEY `post_ID` (`post_ID`),
  CONSTRAINT `upvote_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  CONSTRAINT `upvote_ibfk_2` FOREIGN KEY (`post_ID`) REFERENCES `post` (`post_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwort` varchar(1000) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`user_ID`, `username`, `email`, `passwort`, `link`, `status`) VALUES
(38,	'test1234',	'Nerd07a@gmail.com',	'$2y$10$aBDEyKSOGoVMZOVG8zLu0OHh2zmI0nDHk4CB.aUQCvM.KCBvJ8SN6',	'7,$mRkxSEkur3ztpYaikZyH?CG',	1);

-- 2017-06-22 14:14:09
