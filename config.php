<?php
   ob_start();
   session_start();
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);

  define('DB_SERVER', getenv('IP'));
  define('DB_USERNAME', getenv('C9_USER'));
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'c9');
  define('DB_PORT', 3306);
  $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
   
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  echo "Connected successfully (".$db->host_info.")";
?>