DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
	`id` int(16) NOT NULL auto_increment,
	`username` varchar(50) NOT NULL default 'no name',
	`password` varchar(50) NOT NULL default 'no pass',
	`timedisplay` varchar(50),
	`administrator` boolean NOT NULL default '0',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
	`id` int(16) NOT NULL auto_increment,
	`name` varchar(50) NOT NULL default 'no name',
	`priority` int(16) NOT NULL auto_increment,
	`createdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` int(16),
	`details` TEXT,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `sprints`;
CREATE TABLE `sprints` (
	`id` int(16) NOT NULL auto_increment,
	`parentid` int(16),
	`name` varchar(50) NOT NULL default 'no name',
	`createuser` int(16),
	`moduser` int(16),
	`priority` int(16) NOT NULL auto_increment,
	`createdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` int(16),
	/*`moddate` datetime NOT NULL default '0000-00-00 00:00:00',
	`duedate` datetime NOT NULL default '0000-00-00 00:00:00',*/
	`details` TEXT,
	PRIMARY KEY (`id`),
	KEY (`parentid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `features`;
CREATE TABLE `features` (
	`id` int(16) NOT NULL auto_increment,
	`parentid` int(16),
	`name` varchar(50) NOT NULL default 'no name',
	`createuser` int(16),
	`moduser` int(16),
	`priority` int(16) NOT NULL auto_increment,
	`createdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` int(16),
	/*`moddate` datetime NOT NULL default '0000-00-00 00:00:00',
	`duedate` datetime NOT NULL default '0000-00-00 00:00:00',*/
	`details` TEXT,
	PRIMARY KEY (`id`),
	KEY (`parentid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `user_stories`;
CREATE TABLE `user_stories` (
	`id` int(16) NOT NULL auto_increment,
	`parentid` int(16),
	`name` varchar(50) NOT NULL default 'no name',
	`createuser` int(16),
	`moduser` int(16),
	`priority` int(16) NOT NULL auto_increment,
	`createdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` int(16),
	/*`moddate` datetime NOT NULL default '0000-00-00 00:00:00',
	`duedate` datetime NOT NULL default '0000-00-00 00:00:00',*/
	`details` TEXT,
	PRIMARY KEY (`id`),
	KEY (`parentid`)
) ENGINE=MyISAM;
/* what was this pass?  ba9adb7296fdc28911356e3875bf4129aacbc36d */
INSERT INTO `users` (`username`, `password`, `timedisplay`, `administrator`) VALUES ('admin', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'F j, Y. g:i:s A', '1');
INSERT INTO `products` (`