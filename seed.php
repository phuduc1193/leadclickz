<?php
# Seed to create initial DB (work with mySQL)
  
  # Users table
  $db->query("CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `client` int(5) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT 0,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`username`),
  FOREIGN KEY (`client`) REFERENCES clients(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
  
  # Clients table
  $db->query("CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `logo` varchar(40) DEFAULT NULL,
  `street` varchar(40) DEFAULT '',
  `city` varchar(20) DEFAULT '',
  `state` varchar(2) DEFAULT 'TX',
  `zip_code` varchar(5) DEFAULT '',
  `phone` varchar(20) DEFAULT '',
  `email` varchar(254) DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` TIMESTAMP NOT NULL DEFAULT 0,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

?>