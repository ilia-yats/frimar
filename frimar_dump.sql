-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 29 2016 г., 04:19
-- Версия сервера: 5.5.45
-- Версия PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `frimar`
--
CREATE DATABASE IF NOT EXISTS `frimar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `frimar`;

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `street_id` int(11) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_contacts_streets1_idx` (`street_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `street_id`, `name`, `email`, `phone`) VALUES
(6, 3, 'a aaa', 'a@mail.com', '598493842'),
(7, 6, 'b bbb', 'b@mail.com', '194804023'),
(8, 8, 'c ccc', 'c@mail.com', '983492844'),
(9, 18, 'd ddd', 'd@mail.com', '243929832'),
(10, 25, 'f fff', 'f@mail.com', '493928392');

-- --------------------------------------------------------

--
-- Структура таблицы `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `districts`
--

INSERT INTO `districts` (`id`, `name`) VALUES
(10, 'district_a'),
(11, 'district_b'),
(12, 'district_c'),
(13, 'district_d');

-- --------------------------------------------------------

--
-- Структура таблицы `streets`
--

CREATE TABLE IF NOT EXISTS `streets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(11) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_streets_districts_idx` (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `streets`
--

INSERT INTO `streets` (`id`, `district_id`, `name`) VALUES
(3, 10, 'street_a_a'),
(4, 10, 'street_a_b'),
(5, 10, 'street_a_c'),
(6, 10, 'street_a_d'),
(7, 10, 'street_a_f'),
(8, 10, 'street_a_g'),
(9, 10, 'street_a_h'),
(10, 10, 'street_a_i'),
(11, 11, 'street_b_a'),
(12, 11, 'street_b_b'),
(13, 11, 'street_b_c'),
(14, 11, 'street_b_d'),
(15, 11, 'street_b_f'),
(16, 11, 'street_b_g'),
(17, 11, 'street_b_h'),
(18, 11, 'street_b_i'),
(19, 12, 'street_c_a'),
(20, 12, 'street_c_b'),
(21, 12, 'street_c_c'),
(22, 12, 'street_c_d'),
(23, 12, 'street_c_f'),
(24, 12, 'street_c_g'),
(25, 12, 'street_c_h'),
(26, 12, 'street_c_i'),
(27, 13, 'street_d_a'),
(28, 13, 'street_d_b'),
(29, 13, 'street_d_c'),
(30, 13, 'street_d_d'),
(31, 13, 'street_d_f'),
(32, 13, 'street_d_g'),
(33, 13, 'street_d_h'),
(34, 13, 'street_d_i');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_streets1` FOREIGN KEY (`street_id`) REFERENCES `streets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `streets`
--
ALTER TABLE `streets`
  ADD CONSTRAINT `fk_streets_districts` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
