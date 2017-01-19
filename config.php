<?php
   ob_start();
   session_start();
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);

  define('DB_SERVER', 'leadclickzname.db.11745466.hostedresource.com');
  define('DB_USERNAME', 'leadclickzname');
  define('DB_PASSWORD', 'Lc@254259!db');
  define('DB_DATABASE', 'leadclickzname');
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  echo "Connected successfully";
?>