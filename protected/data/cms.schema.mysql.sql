-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.37-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица cms.tbl_changes
CREATE TABLE IF NOT EXISTS `tbl_changes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица cms.tbl_menu
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) DEFAULT NULL COMMENT 'псевдоним',
  `title` varchar(150) NOT NULL COMMENT 'заголовок',
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT 'родитель',
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'активно',
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'удалено',
  `route` varchar(150) NOT NULL COMMENT 'маршрут (модуль/контроллер/экшн)',
  `params` varchar(200) NOT NULL DEFAULT '' COMMENT 'доп. параметры url',
  `order` int(11) DEFAULT NULL COMMENT 'порядок',
  `level` int(11) NOT NULL DEFAULT '1',
  `outer_link` varchar(200) DEFAULT NULL COMMENT 'Ссылка на внешний источник. Если включена, то внутренний маршрутизатор не обрабатываем, сразу наружу ссылаемся',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`parent`,`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица cms.tbl_news
CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL COMMENT 'Заголовок',
  `description` varchar(200) NOT NULL DEFAULT '' COMMENT 'Краткое описание',
  `text` text NOT NULL COMMENT 'Текст',
  `photo` varchar(50) NOT NULL DEFAULT '' COMMENT 'Изображение',
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Доступна пользователям',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Удалена',
  `time` datetime NOT NULL COMMENT 'Время',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица cms.tbl_page
CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица cms.tbl_question
CREATE TABLE IF NOT EXISTS `tbl_question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(150) NOT NULL COMMENT 'Имя',
  `question` varchar(500) NOT NULL COMMENT 'Вопрос',
  `answer` varchar(500) NOT NULL DEFAULT '' COMMENT 'Ответ',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `answer_date` datetime DEFAULT NULL COMMENT 'Дата ответа',
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'активный',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'удален',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица cms.tbl_tag
CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `model_name` varchar(50) NOT NULL,
  `model_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`model_name`,`model_id`,`name`),
  KEY `model` (`model_name`,`model_id`),
  KEY `tagname` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица cms.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
