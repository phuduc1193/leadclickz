<?php
# Seed to create initial DB (work with mySQL)
  require_once('config.php');
  require_once('class_lib.php');
  
  # Users table
  $db->query("CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT '',
  `client` int(5) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `password` varchar(40) DEFAULT '',
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

  # States table
  $db->query("CREATE TABLE IF NOT EXISTS `states` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `us_ansi` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name`), UNIQUE KEY (`us_ansi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

  # Initial States
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Alabama', 'AL');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Alaska', 'AK');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Arizona', 'AZ');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Arkansas', 'AR');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('California', 'CA');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Colorado', 'CO');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Connecticut', 'CT');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Delaware', 'DE');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Florida', 'FL');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Georgia', 'GA');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Hawaii', 'HI');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Idaho', 'ID');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Illinois', 'IL');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Indiana', 'IN');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Iowa', 'IA');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Kansas', 'KS');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Kentucky', 'KY');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Louisiana', 'LA');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Maine', 'ME');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Maryland', 'MD');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Massachusetts', 'MA');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Michigan', 'MI');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Minnesota', 'MN');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Mississippi', 'MS');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Missouri', 'MO');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Montana', 'MT');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Nebraska', 'NE');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Nevada', 'NV');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('New Hampshire', 'NH');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('New Jersey', 'NJ');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('New Mexico', 'NM');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('New York', 'NY');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('North Carolina', 'NC');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('North Dakota', 'ND');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Ohio', 'OH');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Oklahoma', 'OK');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Oregon', 'OR');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Pennsylvania', 'PA');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Rhode Island', 'RI');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('South Carolina', 'SC');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('South Dakota', 'SD');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Tennessee', 'TN');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Texas', 'TX');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Utah', 'UT');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Vermont', 'VT');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Virginia', 'VA');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Washington', 'WA');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('West Virginia', 'WV');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Wisconsin', 'WI');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Wyoming', 'WY');");
  $db->query("INSERT INTO states (name, us_ansi) VALUES ('Not Applicable', 'NA');");
  
  # Services table
  $db->query("CREATE TABLE IF NOT EXISTS `services` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT 0,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

  $admin = User::find('leadclickz');
  if ($admin == false)
    $db->query("INSERT INTO users (username, password, is_admin, created_at, updated_at) VALUES ('leadclickz', 'Lc@254259!New', '0', NOW(), NOW());");
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/seed.php')
    header('Location: ' . $home_url);
?>