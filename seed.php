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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

?>