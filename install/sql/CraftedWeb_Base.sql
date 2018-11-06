

DROP TABLE IF EXISTS `account_data`;
CREATE TABLE IF NOT EXISTS `account_data` 
(
  `id` int(32) NOT NULL auto_increment,
  `vp` int(32) DEFAULT '0',
  `dp` int(32) DEFAULT '0',
  `forum_account` varchar(255) DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE IF NOT EXISTS `admin_log` 
(
  `id` int(15) NOT NULL auto_increment,
  `full_url` varchar(150) DEFAULT '0',
  `ip` varchar(150) DEFAULT '0',
  `timestamp` int(10) DEFAULT '0',
  `action` varchar(150) DEFAULT '0',
  `account` int(64) DEFAULT NULL,
  `extended_inf` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `custom_pages`;
CREATE TABLE IF NOT EXISTS `custom_pages` 
(
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(255) DEFAULT '0',
  `filename` varchar(255) DEFAULT '0',
  `content` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `db_version`;
CREATE TABLE IF NOT EXISTS `db_version` 
(
  `version` varchar(50) DEFAULT '1.0',
  UNIQUE KEY `version` (`version`),
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `db_version` VALUES ('1.5');

DROP TABLE IF EXISTS `disabled_pages`;
CREATE TABLE IF NOT EXISTS `disabled_pages` 
(
  `filename` varchar(255) DEFAULT NULL,
  UNIQUE KEY `filename` (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `disabled_plugins`;
CREATE TABLE IF NOT EXISTS `disabled_plugins` 
(
  `foldername` varchar(255) DEFAULT NULL,
  UNIQUE KEY `foldername` (`foldername`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `instance_data`;
CREATE TABLE IF NOT EXISTS `instance_data` 
(
  `map` int(4) DEFAULT NULL,
  `name` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `instance_data` VALUES (33,'Shadowfang keep'),(36,'Deadmines'),(43,'Wailing caverns'),(47,'Razorfen kraul'),(48,'Blackfathom deeps'),(70,'Uldaman'),(90,'Gnomeregan'),(109,'Sunken temple'),(129,'Razorfen downs'),(189,'Scarlet monastery'),(209,'Zulfarrak'),(229,'Blackrock spire'),(230,'Blackrock depths'),(249,'Onyxias lair'),(269,'Dark portal'),(289,'Scholomance'),(309,'Zulgurub'),(329,'Stratholme'),(409,'Molten core'),(469,'Blackwing lair'),(509,'Ruins of ahnqiraj'),(531,'Temple of ahnqiraj'),(532,'Karazhan'),(615,'Obsidian sanctum'),(534,'Hyjal'),(540,'Shattered halls'),(542,'Blood furnace'),(543,'Ramparts'),(544,'Magtheridons lair'),(545,'Steam vault'),(548,'Serpent shrine'),(550,'The eye'),(552,'Arcatraz'),(554,'Mechanar'),(555,'Shadow labyrinth'),(556,'Sethekk halls'),(560,'Old hillsbrad'),(564,'Black temple'),(565,'Gruuls lair'),(568,'Zulaman'),(580,'Sunwell plateau'),(585,'Magisters terrace'),(574,'Utgarde keep'),(575,'Utgarde pinnacle'),(576,'Nexus'),(578,'Oculus'),(533,'Naxxramas'),(608,'Violet hold'),(604,'Gundrak'),(602,'Halls of lightning'),(599,'Halls of stone'),(601,'Azjol nerub'),(619,'Ahnkahet'),(600,'Drak tharon'),(595,'Culling of stratholme'),(616,'Eye of eternity'),(624,'Archavon'),(603,'Ulduar'),(650,'Trial of the champion'),(649,'Trial of the crusader'),(631,'Icecrown citadel'),(632,'Forge of souls'),(658,'Pit of saron'),(668,'Halls of reflection'),(724,'Ruby sanctum');

DROP TABLE IF EXISTS `item_icons`;
CREATE TABLE IF NOT EXISTS `item_icons` 
(
  `displayid` int(11) NOT NULL,
  `icon` text NOT NULL,
  PRIMARY KEY  (`displayid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(100) NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `news`(`title`, `body`, `author`, `date`) VALUES ('Welcome to Your New Website!', 'If you\'re seing this message, most likely, the CraftedWeb database has been installed successfully. \n\nNow, check out your configuration file to customize your website even further if you havent done that already. You may edit this news post by logging onto your Admin panel. \n\nWe sincerely hope that you will enjoy our work. Thanks!', 'CraftedDev', '2012-01-30 22:40:07');

DROP TABLE IF EXISTS `news_comments`;
CREATE TABLE IF NOT EXISTS `news_comments` 
(
  `id` int(20) NOT NULL auto_increment,
  `newsid` int(20) DEFAULT '0',
  `text` text,
  `poster` int(11) DEFAULT NULL,
  `ip` varchar(64) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE IF NOT EXISTS `password_reset` 
(
  `id` int(15) NOT NULL auto_increment,
  `code` varchar(255) DEFAULT NULL,
  `account_id` int(32) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `payments_log`;
CREATE TABLE IF NOT EXISTS `payments_log` 
(
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `userid` varchar(255) NOT NULL DEFAULT '',
  `paymentstatus` varchar(15) NOT NULL DEFAULT '',
  `buyer_email` varchar(100) NOT NULL DEFAULT '',
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `country` varchar(20) NOT NULL DEFAULT '',
  `mc_gross` varchar(6) NOT NULL DEFAULT '',
  `mc_fee` varchar(5) NOT NULL DEFAULT '',
  `itemname` varchar(255) DEFAULT NULL,
  `itemnumber` varchar(50) DEFAULT NULL,
  `paymenttype` varchar(10) NOT NULL DEFAULT '',
  `paymentdate` varchar(50) NOT NULL DEFAULT '',
  `txnid` varchar(30) NOT NULL DEFAULT '',
  `pendingreason` varchar(10) DEFAULT NULL,
  `reasoncode` varchar(20) NOT NULL DEFAULT '',
  `datecreation` date NOT NULL DEFAULT '1000-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `realms`;
CREATE TABLE IF NOT EXISTS `realms` 
(
  `id` int(32) AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `char_db` varchar(255) DEFAULT NULL,
  `port` int(32) DEFAULT NULL,
  `rank_user` varchar(255) DEFAULT NULL,
  `rank_pass` varchar(255) DEFAULT NULL,
  `ra_port` varchar(255) DEFAULT NULL,
  `soap_port` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `sendType` enum('soap','ra') DEFAULT NULL,
  `mysqli_host` varchar(255) DEFAULT NULL,
  `mysqli_user` varchar(255) DEFAULT NULL,
  `mysqli_pass` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `service_prices`;
CREATE TABLE IF NOT EXISTS `service_prices` 
(
  `service` varchar(255) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `currency` enum('vp','dp') DEFAULT NULL,
  `enabled` enum('TRUE','FALSE') DEFAULT NULL,
  UNIQUE KEY `service` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `service_prices` VALUES ('reset',20,'vp','TRUE'),('appearance',5,'dp','TRUE'),('name',3,'dp','TRUE'),('faction',15,'dp','FALSE'),('race',10,'dp','TRUE'),('teleport',10,'vp','TRUE'),('unstuck',0,'vp','TRUE'),('revive',0,'vp','TRUE');

DROP TABLE IF EXISTS `shopitems`;
CREATE TABLE IF NOT EXISTS `shopitems` 
(
  `id` int(15) NOT NULL auto_increment,
  `entry` int(15) NOT NULL,
  `name` varchar(100) DEFAULT '0',
  `in_shop` varchar(255) DEFAULT NULL,
  `displayid` int(16) DEFAULT NULL,
  `type` int(100) DEFAULT NULL,
  `itemlevel` int(5) DEFAULT '0',
  `quality` int(1) DEFAULT '0',
  `price` int(5) DEFAULT '0',
  `class` varchar(50) DEFAULT NULL,
  `faction` int(1) DEFAULT NULL,
  `subtype` int(100) DEFAULT NULL,
  `flags` int(100) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `shopitems` VALUES (520007,25,'Worn Shortsword','vote',1542,2,2,1,5,'-1',-1,7,0),(520008,35,'Bent Staff','vote',472,2,2,1,10,'-1',-1,10,0),(520009,36,'Worn Mace','vote',5194,2,2,1,5,'-1',-1,4,0),(520010,37,'Worn Axe','vote',14029,2,2,1,5,'-1',-1,0,0);

DROP TABLE IF EXISTS `site_links`;
CREATE TABLE IF NOT EXISTS `site_links` 
(
  `position` int(3) NOT NULL auto_increment,
  `title` varchar(100) DEFAULT '0',
  `url` varchar(150) DEFAULT '0',
  `shownWhen` enum('notlogged', 'logged', 'always') DEFAULT NULL,
  UNIQUE KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `site_links` VALUES 
(1,'Home',        '?page=home',    'always'),
(2,'Register',    '?page=register','notlogged'),
(3,'My Account',  '?page=account', 'logged'),
(4,'Vote',        '?page=vote',    'logged'),
(5,'Donate',      '?page=donate',  'always'),
(6,'Forum',       '/forum/',    'always');

DROP TABLE IF EXISTS `slider_images`;
CREATE TABLE IF NOT EXISTS `slider_images` 
(
  `position` int(10) NOT NULL auto_increment,
  `path` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  UNIQUE KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `slider_images`(`path`) VALUES 
('styles/global/slideshow/images/1.jpg'),
('styles/global/slideshow/images/2.jpg');

DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` 
(
  `id` int(32) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `path` varchar(100) NOT NULL,
  `applied` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `template`(`name`, `path`, `applied`) VALUES ('default','default','1');

DROP TABLE IF EXISTS `user_log`;
CREATE TABLE IF NOT EXISTS `user_log` 
(
  `id` int(32) NOT NULL auto_increment,
  `account` int(32) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `timestamp` int(32) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `realmid` int(32) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `votelog`;
CREATE TABLE IF NOT EXISTS `votelog` 
(
  `id` int(64) NOT NULL auto_increment,
  `siteid` int(32) DEFAULT NULL,
  `userid` int(32) DEFAULT NULL,
  `timestamp` int(32) DEFAULT NULL,
  `next_vote` int(32) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `votingsites`;
CREATE TABLE IF NOT EXISTS `votingsites` 
(
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(255) DEFAULT NULL,
  `points` int(32) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `votingsites`(`title`,`points`,`image`,`url`) VALUES 
('OpenWoW',       2,'http://cdn.cavernoftime.com/toplist/vote_small.jpg','http://www.cavernoftime.com/'),
('Xtremetop100',  2,'http://www.xtremeTop100.com/votenew.jpg',      'http://www.xtremetop100.com/');

DROP TABLE IF EXISTS `shopLog`;
CREATE TABLE `shoplog` 
(
  `id` int(64) NOT NULL auto_increment,
  `entry` int(64) DEFAULT '0',
  `char_id` int(64) DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `shop` enum('vote','donate') DEFAULT NULL,
  `account` int(64) DEFAULT NULL,
  `realm_id` int(64) DEFAULT NULL,
  `amount` int(64) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;